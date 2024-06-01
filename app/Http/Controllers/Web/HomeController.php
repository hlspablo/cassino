<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gamesPopulars = Game::orderBy('views', 'desc')->whereActive(1)->limit(12)->get();
        $games = Game::limit(42)->whereActive(1)->get();

        $gamesSuggestions = Game::whereActive(1)->inRandomOrder()->limit(6)->get();

        return view('web.home.index', [
            'gamesPopulars' => $gamesPopulars,
            'games' => $games,
            'gamesSuggestions' => $gamesSuggestions
        ]);
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function banned()
    {
        return view('web.banned.index');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function howWorks()
    {
        return view('web.home.how-works');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function aboutUs()
    {
        return view('web.home.about-us');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function suporte()
    {
        return view('web.home.suporte');
    }

    /**
     * Display the specified resource.
     */
    public function showGameByCategory(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category !== null) {
            $games = Game::where('category_id', $category->id)->whereActive(1)->paginate();

            return view('web.categories.index', compact(['games', 'category']));
        }

        return back();
    }

}
