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
         if($game) {
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
         if(!$categoryDb) {
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
         $base_headers=  [
             'X-Merchant-Id' => $this->merchantId,
             'X-Timestamp' => time(),
             'X-Nonce' => md5(uniqid(mt_rand(), true)),
         ];

         $mergedParams = array_merge($requestParams, $base_headers);
         ksort($mergedParams);
         $hashString = http_build_query($mergedParams);
         $xsign =  hash_hmac('sha1', $hashString, $this->merchantKey);

         return array_merge($base_headers, ['X-Sign' => $xsign]);
     }

     /**
      * @return void
      */
     public function getCredentials(): void
     {
         $setting = \Helper::getSetting();

         $this->merchantUrl = $setting->merchant_url;
         $this->merchantId = $setting->merchant_id;
         $this->merchantKey = $setting->merchant_key;
     }

     /**
      * @param string $gameUuid
      * @return array
      * @throws Exception
      * @throws GuzzleException
      */
     public function startGameSlotegrator(string $gameUuid): array
     {
         //TODO: this is inverted on test
         //if(!auth()->check())

//             $requestParamsDemo = [
//                 'game_uuid' => $gameUuid,
//                 'return_url' => url('/'),
//                 'currency' => 'BRL',
//                 'language' => 'pt',
//             ];


             $requestParams = [
                 'game_uuid' => $gameUuid,
                 'player_id' => auth()->user()->id,
                 'player_name' => auth()->user()->name,
                 'email' => auth()->user()->email,
                 'return_url' => url('/'),
                 'currency' => 'EUR',
                 'session_id' => Str::random(25),
                 'language' => 'pt',
                 //'lobby_data' => $this->getLobby($gameUuid, false),
             ];

             $response = $this->client->post('games/init', [
                 'headers' => $this->getAuthHeaders($requestParams),
                 'form_params' => $requestParams
             ]);


         $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
         dd($data);

     }

     /**
      * @return JsonResponse
      */
     public function selfvalidation(): void
     {
         //TODO: to Implement
     }

     /**
      * @param $gameuuid
      * @param bool $api
      * @return true
      */
     public function getLobby($gameuuid, bool $api = true)
     {
         $url = $this->merchantUrl . 'games/lobby?game_uuid=' . $gameuuid . '&currency=EUR&technology=HTML5';
         $merchantId     = $this->merchantId;
         $merchantKey    = $this->merchantKey;
         $nonce          = md5(uniqid(mt_rand(), true));
         $time           = time();

         $headers = [
             'X-Merchant-Id' => $merchantId,
             'X-Timestamp' => $time,
             'X-Nonce' => $nonce,
         ];

         $requestParams = [
             'game_uuid' => $gameuuid,
             'currency' => 'EUR',
             'technology' => 'HTML5',
         ];

         $mergedParams = array_merge($requestParams, $headers);
         ksort($mergedParams);
         $hashString = http_build_query($mergedParams);

         $XSign = hash_hmac('sha1', $hashString, $merchantKey);

         ksort($requestParams);
         $postdata = http_build_query($requestParams);


         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
         //curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
             'X-Merchant-Id: '.$merchantId,
             'X-Timestamp: '.$time,
             'X-Nonce: '.$nonce,
             'X-Sign: '.$XSign,
             'Accept: application/json',
             'Enctype: application/x-www-form-urlencoded',
         ));

         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
         $result = json_decode(curl_exec($ch));

         if (!$api && isset($result->lobby)) {
             return $result->lobby[0]->lobbyData;
         } else if (!$api) {
             return null;
         }

         return true;
     }

     /**
      * @param $request
      * @return JsonResponse|void
      */
     public function webhooks($request)
     {
         try {
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
                 ], Response::HTTP_OK);
             }

             if($request->action === 'balance') {
                 $balance = $this->getCurrentBalance($request);
                    return response()->json(['balance' => $balance]);
             }

             if($request->action === 'win') {
                 $this->processWin($request);
             }
             if ($request->action === 'bet') {
                 $this->processBet($request);
             }
             if($request->action === 'refund') {
                 $this->processRefund($request);
             }
             if($request->action === 'rollback') {
                 $this->processRollback($request);
             }


         } catch (Exception $e) {
             Log::info('Message error:' .  $e->getMessage());
             Log::info('Line error:' .  $e->getLine());
             return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine()], 400);
         }
     }

     protected function processRollback($request) : JsonResponse
     {
         DB::beginTransaction();
         try {
             $order = Order::find($request->transaction_id);
             $order->status = 'rollback';
             $order->save();

             $user = User::find($request->player_id);

             foreach($request->rollback_transactions as $rollback) {
                 $rollbackOrder = Order::find($rollback['transaction_id']);
                 $rollbackOrder->status = 'rollback';
                 $rollbackOrder->save();

                 if ($rollback['action'] === 'bet') {
                     if ($order->type_money === 'mixed') {
                         $user->wallet->increment('balance_bonus', $order->bonus_bet);
                         $user->wallet->increment('balance', $order->bet);
                     } else {
                         $user->wallet->increment($order->type_money, $order->bet);
                     }
                 }

                 if ($rollback['action'] === 'win') {
                     if ($order->type_money === 'mixed') {
                         $user->wallet->decrement('balance_bonus', $order->bonus_bet);
                         $user->wallet->decrement('balance', $order->bet);
                     } else {
                         $user->wallet->decrement($order->type_money, $order->bet);
                     }
                 }

             }

             DB::commit();
             return response()->json([
                 'balance' => $this->getCurrentBalance($request),
                     'transaction_id' => $request->transaction_id,
                     'rollback_transactions' => collect($request->rollback_transactions)->pluck('transaction_id')->toArray()
                 ]
             );
         } catch (Exception $e) {
             DB::rollBack();
             Log::info('Message error:' .  $e->getMessage());
             Log::info('Line error:' .  $e->getLine());
             return response()->json(['error_code' => 'INTERNAL_ERROR', 'error_description' => 'Error to process rollback']);
         }
     }


     protected function processRefund($request): JsonResponse
     {
         DB::beginTransaction();
         try {
             $order = Order::find($request->transaction_id);
             $order->status = 'refund';
             $order->save();

             $user = User::find($request->player_id);

             if ($order->type_money === 'mixed') {
                 $user->wallet->increment('balance_bonus', $order->bonus_bet);
                 $user->wallet->increment('balance', $order->bet);
             } else {
                 $user->wallet->increment($order->type_money, $order->bet);
             }

             DB::commit();

             return response()->json(['balance' => $this->getCurrentBalance($request), 'transaction_id' => $request->transaction_id]);
         } catch (Exception $e) {
             DB::rollBack();
             Log::info('Message error:' .  $e->getMessage());
             Log::info('Line error:' .  $e->getLine());
             return response()->json(['error_code' => 'INTERNAL_ERROR', 'error_description' => 'Error to process refund']);
         }

         return response()->json(['status' => 'success']);
     }

     protected function consumeBalance($value, User $user): array | null
     {
         $wallet = $user->wallet();
         if($wallet->balance_bonus >= $value) {
            $wallet->decrement('balance_bonus', $value);
            return ['balance_bonus', $value];
         }

         if($wallet->balance >= $value) {
            $wallet->decrement('balance', $value);
            return ['balance', $value];
         }

         $balance_bonus = $wallet->balance_bonus;

         if ($balance_bonus + $wallet->balance >= $value) {
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
         return $user->wallet->balance + $user->wallet->balance_bonus;
     }

     protected function processBet($request): JsonResponse
     {
            // $request->type = bet, tip, freespin
            DB::beginTransaction();
            try {
                $user = User::find($request->player_id);
                $consumeBalance = $this->consumeBalance($request->amount, $user);
                if(!$consumeBalance) {
                    return response()->json(['error_code' => 'INSUFFICIENT_FUNDS', 'error_description' => 'Insufficient funds']);
                }
                $user = User::find($request->player_id);
                $game_name = Game::find($request->game_uuid)->name;
                Order::create([
                    'user_id' => $request->player_id,
                    'session_id' => $request->session_id,
                    'transaction_id' => $request->transaction_id,
                    'type' => $request->type,
                    'type_money' => $consumeBalance[0],
                    'game_uuid' => $request->game_uuid,
                    'game_name' => $game_name,
                    'round_id' => $request->round_id,
                    'bet' => $consumeBalance[0] === 'mixed' ? $request->amount - $consumeBalance[1] : $consumeBalance[1],
                    'bonus_bet' => $consumeBalance[0] === 'mixed' ? $consumeBalance[1] : 0,
                    // only store bonus_bet in mixed, otherwise, see the type_money and bet
                    'status' => 'loss',
                ]);
                DB::commit();

                return response()->json(['balance' => $this->getCurrentBalance($request), 'transaction_id' => $request->transaction_id]);

            } catch (Exception $e) {
                DB::rollBack();
                Log::info('Message error:' .  $e->getMessage());
                Log::info('Line error:' .  $e->getLine());
                return response()->json(['error_code' => 'INTERNAL_ERROR', 'error_description' => 'Error to process bet']);
            }

            return response()->json(['status' => 'success']);
     }

     protected function processWin($request): JsonResponse
     {
         DB::beginTransaction();
         try {
             $user = User::find($request->player_id);
             $order = Order::find($request->transaction_id);
             $order->status = 'win';
             $order->won_amount = $request->amount;
             $order->save();
             $user->wallet->increment('balance', $request->amount);

             DB::commit();
         } catch (Exception $e) {
            DB::rollBack();
            Log::info('Message error:' .  $e->getMessage());
            Log::info('Line error:' .  $e->getLine());
            return response()->json(['error_code' => 'INTERNAL_ERROR', 'error_description' => 'Error to process win']);
         }

         return response()->json(['status' => 'success']);
     }

     /**
      * @param $request
      * @param $type
      * @param $nameGame
      * @param $gameId
      * @param bool $changeBonus
      * @return void
      */
     private function generateHistory($request, $type, $nameGame, $gameId, bool $changeBonus = false): void
     {
         Order::create([
             'user_id' => $request->player_id,
             'session_id' => $request->session_id,
             'transaction_id' => $request->transaction_id,
             'type' => $type,
             'type_money' => $changeBonus ? 'balance_bonus' : 'balance',
             'amount' => (float)$request->amount,
             'providers' => 'SloteGrator',
             'game' => $nameGame,
             'game_uuid' => $gameId,
             'round_id' => $request->round_id,
         ]);
     }

     /**
      * @param $request
      * @param $user
      * @param $nameGame
      * @param $historyBet
      * @return void
      */
     private function generateWalletChange($request, $user, $nameGame, $historyBet = null): void
     {
         $title = $request->action === 'bet' ? $nameGame . ' play' : $nameGame . ' win';

         $hisBet = 0;
         if ($historyBet !== null) {
             $hisBet = $historyBet->amount;
         }

         WalletChange::create([
             'reason' => $title,
             'change' => $request->action === 'bet' ? -number_format($request->amount, 2, '.', '') : number_format($request->amount, 2, '.', ''),
             'value_bonus' => 0,
             'value_total' => $request->amount,
             'value_roi' => $request->action === 'bet' ? 0 : $request->amount - $hisBet,
             'value_entry' => $request->action === 'bet' ? $request->amount : $hisBet,
             'game' => $nameGame,
             'user' => $user->email
         ]);
     }

     public function limits(): void
     {
       // TODO: Implement?
     }
 }
