<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;

class LandingController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDBService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function index()
    {
        $movies = $this->tmdbService->getPopularMovies();
        return view('index', ['movies' => $movies]);
    }
}
