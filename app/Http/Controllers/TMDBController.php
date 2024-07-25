<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TMDBService;

class TMDBController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function tmdbSearchMovies(Request $request)
    {
        $query = $request->input('query');
        $movies = $this->tmdbService->searchMovies($query);
        return view('search', ['movies' => $movies]);
    }
}
