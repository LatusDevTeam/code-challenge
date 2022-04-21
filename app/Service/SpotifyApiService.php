<?php

namespace App\Service;

use App\Interfaces\SpotifyApiInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

class SpotifyApiService implements SpotifyApiInterface
{
    private $client;
    private $token;

    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?? new Client([
            'timeout' => 30,
        ]);
    }

    public function searchArtists(string $search)
    {
        return $this->search($search, ['artist'])->artists->items;
    }

    public function searchTracks(string $search)
    {
        return $this->search($search, ['track'])->tracks->items;
    }

    public function searchAlbums(string $search)
    {
        return $this->search($search, ['album'])->albums->items;
    }

    public function search(string $search, array $types = [])
    {
        $response = $this->authenticatedRequest('GET', 'https://api.spotify.com/v1/search', [
            'query' => [
                'q' => $search,
                'type' => $types ? implode(',', $types) : '',
            ],
        ]);

        return json_decode($response->getBody(), false);
    }

    public function getInfo(string $type, string $id)
    {
        $response = $this->authenticatedRequest('GET', "https://api.spotify.com/v1/{$type}/{$id}");

        return json_decode($response->getBody(), false);
    }

    protected function authenticatedRequest(string $method, string $uri, array $options = []): ResponseInterface
    {
        $token = $this->getToken();
        $options['headers']['Authorization'] = "Bearer $token";

        return $this->client->request($method, $uri, $options);
    }

    protected function fetchToken()
    {
        $auth = base64_encode(config('spotify.client_id') . ':' . config('spotify.client_secret'));
        $response = $this->client->request('POST', 'https://accounts.spotify.com/api/token', [
            'headers' => [
                'Authorization' => "Basic $auth"
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ],
        ]);
        $body = json_decode($response->getBody(), false);

        $this->token = $body->access_token;
    }

    protected function getToken(): string
    {
        if (!$this->token) {
            $this->fetchToken();
        }

        return $this->token;
    }
}
