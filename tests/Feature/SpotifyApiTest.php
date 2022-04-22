<?php

namespace Tests\Feature;

use App\Interfaces\SpotifyApiInterface;
use App\Service\SpotifyApiService;
use GuzzleHttp\Exception\ClientException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpotifyApiTest extends TestCase
{
    public function test_implementation()
    {
        $service = $this->getService();
        
        $this->assertInstanceOf(SpotifyApiService::class, $service);
    }
    
    public function test_search()
    {
        $service = $this->getService();
        $search = 'Arctic';
        $results = $service->search($search, ['artist', 'album', 'track']);

        $this->assertNotEmpty($results->artists->items);
        $this->assertNotEmpty($results->albums->items);
        $this->assertNotEmpty($results->tracks->items);

        $this->assertContains($search, $results->artists->items[0]->name, '', true);
    }

    public function test_invalid_search()
    {
        $service = $this->getService();
        $this->expectException(ClientException::class);
        $service->search('Mini Cooper', ['vehicles']);
    }

    private function getService(): SpotifyApiInterface
    {
        return app(SpotifyApiInterface::class);
    }
}
