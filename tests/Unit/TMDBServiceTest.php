<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\TMDbService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
use Mockery;

class TMDBServiceTest extends TestCase
{
    protected $tmdbService;
    protected $mockClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockClient = Mockery::mock(Client::class);
        $this->tmdbService = new TMDbService($this->mockClient);
    }

    public function testSearchMoviesSuccess()
    {
        $this->mockClient
            ->shouldReceive('request')
            ->with('GET', 'search/movie', [
                'query' => [
                    'api_key' => env('TMDB_API_KEY'),
                    'query'   => 'Inception',
                ]
            ])
            ->andReturn(new Response(200, [], json_encode(['results' => ['movie1', 'movie2']])))
            ->once();

        $result = $this->tmdbService->searchMovies('Inception');

        $this->assertArrayHasKey('results', $result);
        $this->assertCount(2, $result['results']);
    }

    public function testSearchMoviesFailure()
    {
        $this->mockClient
            ->shouldReceive('request')
            ->with('GET', 'search/movie', [
                'query' => [
                    'api_key' => env('TMDB_API_KEY'),
                    'query'   => 'Inception',
                ]
            ])
            ->andThrow(new RequestException('Error Communicating with Server', Mockery::mock(\Psr\Http\Message\RequestInterface::class)))
            ->once();

        $result = $this->tmdbService->searchMovies('Inception');

        $this->assertArrayHasKey('error', $result);
        $this->assertEquals('Error Communicating with Server', $result['error']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
