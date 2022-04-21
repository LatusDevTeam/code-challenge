<?php

namespace App\Interfaces;

interface SpotifyApiInterface
{
    public function search(string $search, array $types = []);
    
    public function searchArtists(string $search);
    
    public function searchTracks(string $search);
    
    public function searchAlbums(string $search);
    
}