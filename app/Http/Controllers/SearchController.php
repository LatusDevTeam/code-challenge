<?php

namespace App\Http\Controllers;

use App\Interfaces\SpotifyApiInterface;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function search(Request $request, SpotifyApiInterface $spotify)
    {
        $query = $request->get('query');
        $search = $spotify->search($query, ['artist', 'album', 'track',]);


        return view('search', [
            'searchTerm' => $query,
            'artists' => $search->artists->items,
            'tracks' => $search->tracks->items,
            'albums' => $search->albums->items,
        ]);
    }

    public function info(string $type, string $id, SpotifyApiInterface $spotify)
    {
        $item = $spotify->getInfo($type, $id);

        return view('info', ['item' => $item]);
    }
}
