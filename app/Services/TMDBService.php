<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class TMDBService
{
    protected $client;
    protected $apiKey;

    public function __construct(Client $client)
    {
        $this->client = $client;
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
            return ['error' => $e->getMessage()];
        }
    }
    public function getPopularMovies()
    {
        try {
            $response = $this->client->request('GET', 'movie/popular', [
                'query' => [
                    'api_key' => $this->apiKey,
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }
}