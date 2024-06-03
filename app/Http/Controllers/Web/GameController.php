<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Traits\Providers\SlotegratorTrait;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Octane\Exceptions\DdException;

class GameController extends Controller
{
    use SlotegratorTrait;


    /**
     * @throws GuzzleException
     * @throws DdException
     */
    public function index(Request $request, $slug)
    {
        $game = Game::where('slug', $slug)->first();
        if ($game !== null) {
            if (auth()->check()) {
                if (auth()->user()->banned) {
                    return redirect()->to('/banned');
                }
                //dd($game->has_lobby);
                $gameUrl = $this->startGameSlotegrator($game);
                if ($gameUrl !== null) {
                    //return redirect()->to($gameUrl);
                    return view('web.game.index', ['gameUrl' => $gameUrl]);
                }
                return redirect()->to(url()->current());
            }

            return redirect()->to('/?action=login');
        }

        return back()->with('error', 'Você precisa fazer login para jogar');
    }


    public function getListGame(Request $request)
    {
        $games = $this->listProvider($request);

        $search = $request->searchTerm ?? '';
        $tab = $request->tab;

        return view('web.game.list', compact(['games', 'search', 'tab']));
    }


    private function listProvider($request)
    {
        $query_games = Game::query()->whereActive(1);

        if (isset($request->tab) && $request->tab === 'popular') {
            $query_games->orderBy('views', 'desc');
        }

        if (!empty($request->searchTerm) && strlen($request->searchTerm) > 3) {
            $query_games->whereLike(['name', 'provider'], $request->searchTerm);
        }

        return $query_games->paginate(30);
    }
}
