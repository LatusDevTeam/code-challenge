<?php

namespace App\Http\Controllers;

use App\Interfaces\SpotifyApiInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function search(Request $request, SpotifyApiInterface $spotify)
    {
        $query = $request->get('query');
        if (!$query) {
            $error = 'Search query is required';

            return back()->with(['error' => $error]);
        }
        try {
            $search = $spotify->search($query, ['artist', 'album', 'track',]);
        } catch (BadResponseException $e) {
            $error = 'Something went wrong, please try again';
            if ($e instanceof ClientException) {
                $error = 'Invalid search, please try again';
            }
            if ($e instanceof ServerException) {
                Log::error($e->getMessage());
            }
        }

        if (isset($error)) {
            return back()->with(['error' => $error]);
        }


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
