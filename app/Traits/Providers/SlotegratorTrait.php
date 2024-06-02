<?php

namespace App\Traits\Providers;

use App\Models\Category;
use App\Models\Game;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletChange;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as ResponseAlias;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use JsonException;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\HttpFoundation\Response;

trait SlotegratorTrait
{
    /**
     * @var String $merchantUrl
     * @var String $merchantId
     * @var String $merchantKey
     */
    protected Client $client;
    protected string $merchantId, $merchantKey, $merchantUrl;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->merchantId = config('services.slotegrator.merchant_id');
        $this->merchantKey = config('services.slotegrator.merchant_key');
    }


    /**
     * @throws GuzzleException
     */
    protected function downloadAndSaveGame($gameData): void
    {
        $game = Game::where('uuid', $gameData['uuid'])->first();
        if ($game) {
            Log::info('Game already exists: ' . $gameData['name']);
            return;
        }

        $imageUrl = $gameData['image'];
        if ($imageUrl) {
            $imageContents = $this->client->get($imageUrl)->getBody()->getContents();
            $imagePath = 'games/' . basename($imageUrl);
            Storage::disk('public')->put($imagePath, $imageContents);
        }

        $category = $gameData['type'];
        $categoryDb = Category::where('slug', $category)->first();
        if (!$categoryDb) {
            $categoryDb = Category::create([
                'name' => $category,
                'description' => 'Description',
                'slug' => $category
            ]);
        }

        Game::create([
            'uuid' => $gameData['uuid'],
            'name' => $gameData['name'],
            'image' => $imagePath ?? null,
            'type' => $gameData['type'],
            'provider' => $gameData['provider'],
            'technology' => $gameData['technology'],
            'has_lobby' => $gameData['has_lobby'],
            'is_mobile' => $gameData['is_mobile'],
            'has_freespins' => $gameData['has_freespins'],
            'has_tables' => $gameData['has_tables'],
            'freespin_valid_until_full_day' => $gameData['freespin_valid_until_full_day'],
            'category_id' => $categoryDb->id
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getGames($page): void
    {

        $requestParams = [
            'expand' => 'tags,parameters,images',
            'page' => $page
        ];

        $auth_headers = $this->getAuthHeaders($requestParams);


        $response = $this->client->get('games', [
            'headers' => $auth_headers,
            'query' => $requestParams
        ]);

        $games = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        foreach ($games['items'] as $game) {
            $this->downloadAndSaveGame($game);
        }

        $nextPage = $games['_links']['next']['href'] ?? null;
        if ($nextPage) {
            $parsedUrl = parse_url($nextPage);
            $queryParams = [];
            if (isset($parsedUrl['query'])) {
                parse_str($parsedUrl['query'], $queryParams);
            }
            $pageNumber = $queryParams['page'] ?? null;

            sleep(1.2);
            $this->getGames($pageNumber);
        }
    }

    public function getAuthHeaders($requestParams): array
    {
        $base_headers = [
            'X-Merchant-Id' => $this->merchantId,
            'X-Timestamp' => time(),
            'X-Nonce' => md5(uniqid(mt_rand(), true)),
        ];

        $mergedParams = array_merge($requestParams, $base_headers);
        ksort($mergedParams);
        $hashString = http_build_query($mergedParams);
        $xsign = hash_hmac('sha1', $hashString, $this->merchantKey);

        return array_merge($base_headers, ['X-Sign' => $xsign]);
    }

    /**
     * @param string $gameUuid
     * @return array
     * @throws Exception
     * @throws GuzzleException
     */
    public function startGameSlotegrator(string $gameUuid): string | null
    {

        if (auth()->check()) {
            $game = Game::find($gameUuid);

            $requestParams = [
                'game_uuid' => $gameUuid,
                'player_id' => auth()->user()->id,
                'player_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'return_url' => url('/'),
                'currency' => 'EUR',
                'session_id' => Str::random(25),
                'language' => 'pt',
            ];

            if ($game->has_lobby) {
                $lobby_data = $this->getLobbyData($gameUuid);
                if ($lobby_data) {
                    $requestParams['lobby_data'] = $lobby_data['lobbyData'];
                } else {
                    return null;
                }
            }

            $response = $this->client->post('games/init', [
                'headers' => $this->getAuthHeaders($requestParams),
                'form_params' => $requestParams
            ]);


            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
            return $data['url'];
        }
    }

    /**
     * @return JsonResponse
     * @throws GuzzleException|JsonException
     */
    public function selfvalidation(): JsonResponse
    {
        $response = $this->client->post('self-validate', [
            'headers' => $this->getAuthHeaders([]),
        ]);

        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        return response()->json($data);
    }

    /**
     * @throws JsonException
     * @throws GuzzleException
     */
    public function getLobbyData($gameUuid): array|null
    {
        $requestParams = [
            'game_uuid' => $gameUuid,
            'currency' => 'EUR',
        ];

        $response = $this->client->get('games/lobby', [
            'headers' => $this->getAuthHeaders($requestParams),
            'query' => $requestParams
        ]);

        $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        // check if $data is not empty array
        if (!empty($data) && isset($data['lobby'])) {
            return collect($data['lobby'])->firstWhere('isOpen', true);
        }
        return null;
    }

    /**
     * @param $request
     * @return JsonResponse|void
     */
    public function webhooks($request)
    {
        $headers = [
            'X-Merchant-Id' => $request->header('X-Merchant-Id'),
            'X-Timestamp' => $request->header('X-Timestamp'),
            'X-Nonce' => $request->header('X-Nonce'),
        ];

        $XSign = $request->header('X-Sign');
        $mergedParams = array_merge($request->toArray(), $headers);
        ksort($mergedParams);

        $hashString = http_build_query($mergedParams);
        $expectedSign = hash_hmac('sha1', $hashString, $this->merchantKey);

        if ($XSign !== $expectedSign) {
            return response()->json([
                'error_code' => 'INTERNAL_ERROR',
                'error_description' => 'Unauthorized Request'
            ]);
        }

        if ($request->action === 'balance') {
            $balance = $this->getCurrentBalance($request);
            return response()->json(['balance' => $balance]);
        }
        if ($request->action === 'win') {
            $this->processWin($request);
        }
        if ($request->action === 'bet') {
            $this->processBet($request);
        }
        if ($request->action === 'refund') {
            $this->processRefund($request);
        }
        if ($request->action === 'rollback') {
            $this->processRollback($request);
        }
    }

    protected function processRollback($request): JsonResponse
    {
        DB::beginTransaction();

        $user = User::find($request->player_id);
        $rollbacked = [];
        foreach ($request->rollback_transactions as $rollback) {
            $rollbackOrder = Order::find($rollback['transaction_id']);
            if (!$rollbackOrder || $rollbackOrder->status === 'rollback') {
                continue;
            }

            if ($rollback['action'] === 'bet') {
                if ($rollbackOrder->used_type_money === 'mixed') {
                    $user->wallet->increment('balance_bonus', $rollbackOrder->bonus_bet);
                    $user->wallet->increment('balance', $rollbackOrder->bet);
                } else {
                    $user->wallet->increment($rollbackOrder->used_type_money, $rollbackOrder->bet);
                }
            }

            if ($rollback['action'] === 'win') {
                if ($rollbackOrder->used_type_money === 'mixed') {
                    $user->wallet->decrement('balance_bonus', $rollbackOrder->bonus_bet);
                    $user->wallet->decrement('balance', $rollbackOrder->bet);
                } else {
                    $user->wallet->decrement($rollbackOrder->used_type_money, $rollbackOrder->bet);
                }
            }
            $rollbackOrder->status = 'rollback';
            $rollbackOrder->save();
            $rollbacked[] = $rollback['transaction_id'];
        }
            DB::commit();

            return response()->json([
                'balance' => $this->getCurrentBalance($request),
                'transaction_id' => $request->transaction_id,
                'rollback_transactions' => $rollbacked,
            ]);
    }

    protected function processRefund($request): JsonResponse
    {
        DB::beginTransaction();

        $order = Order::where('transaction_id', $request->bet_transaction_id)::first();

        if ($order->status === 'refund') {
            return response()->json(); // already refund, just return successful
        }

        $order->status = 'refund';
        $order->save();

        $user = User::find($request->player_id);

        if ($order->used_type_money === 'mixed') {
            $user->wallet->increment('balance_bonus', $order->bonus_bet);
            $user->wallet->increment('balance', $order->bet);
        } else {
            $user->wallet->increment($order->used_type_money, $order->bet);
        }

        DB::commit();

        return response()->json([
            'balance' => $this->getCurrentBalance($request),
            'transaction_id' => $request->bet_transaction_id
        ]);
    }

    protected function consumeBalance($request, User $user): array|null
    {
        $value = $request->amount;
        $wallet = $user->wallet()->first();
        if (!$wallet) {
            return null;
        }
        if ($wallet->balance_bonus >= $value) {
            $wallet->decrement('balance_bonus', $value);
            return ['balance_bonus', $value];
        }

        if ($wallet->balance >= $value) {
            $wallet->decrement('balance', $value);
            return ['balance', $value];
        }

        $balance_bonus = $wallet->balance_bonus;
        $current_balance = $this->getCurrentBalance($request);

        if ($current_balance >= $value) {
            $wallet->balance_bonus = 0;
            $wallet->decrement('balance', $value - $balance_bonus);
            return ['mixed', $balance_bonus];
        }
        return null;
    }

    protected function getCurrentBalance($request): float
    {
        $user = User::find($request->player_id);
        $user->wallet->refresh();
        $balance = $user->wallet->balance;
        $balance_bonus = $user->wallet->balance_bonus;
        return (float) bcadd($balance, $balance_bonus, 2);
    }

    protected function processBet($request): JsonResponse
    {
        DB::beginTransaction();

        $user = User::find($request->player_id);
        $consumeBalance = $this->consumeBalance($request, $user);
        if (!$consumeBalance) {
            return response()->json(['error_code' => 'INSUFFICIENT_FUNDS',
                'error_description' => 'Saldo insuficiente']);
        }

        $game_name = Game::find($request->game_uuid)->name;

        $orderExists = Order::where('transaction_id', $request->transaction_id)->exists();
        if ($orderExists) {
            return response()->json(); // just return successful
        }

        Order::create([
            'user_id' => $request->player_id,
            'session_id' => $request->session_id,
            'transaction_id' => $request->transaction_id,
            'type' => $request->type, // bet, tip, freespin
            'used_type_money' => $consumeBalance[0],
            'game_uuid' => $request->game_uuid,
            'game_name' => $game_name,
            'round_id' => $request->round_id,
            'bet' => $consumeBalance[0] === 'mixed' ? $request->amount - $consumeBalance[1] : $consumeBalance[1],
            'bonus_bet' => $consumeBalance[0] === 'mixed' ? $consumeBalance[1] : 0,
            // only store bonus_bet in mixed, otherwise, see the used_type_money and bet
            'status' => 'loss', // status as lose by default
        ]);
        DB::commit();

        return response()->json([
            'balance' => $this->getCurrentBalance($request),
            'transaction_id' => $request->transaction_id
        ]);
    }

    protected function processWin($request): JsonResponse
    {
        DB::beginTransaction();

        $user = User::find($request->player_id);
        $order = Order::where('transaction_id', $request->transaction_id)
            ::where('status', 'loss')::first();

        if (!$order) {
            return response()->json(); // already processed, just return successful
        }

        $order->status = 'win';
        $order->won_amount = $request->amount;
        $order->save();
        $user->wallet->increment('balance', $request->amount);

        DB::commit();

        return response()->json([
            'balance' => $this->getCurrentBalance($request),
            'transaction_id' => $request->transaction_id
        ]);
    }
}
