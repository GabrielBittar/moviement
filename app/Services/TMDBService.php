<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TMDbService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/',
            'timeout'  => 5.0,
        ]);

        $this->apiKey = env('TMDB_API_KEY');
    }

    public function searchMovies($query)
    {
        try {
            $response = $this->client->request('GET', 'search/movie', [
                'query' => [
                    'api_key' => $this->apiKey,
                    'query'   => $query,
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            // Handle exception
            return ['error' => $e->getMessage()];
        }
    }
}