<?php

namespace App\Http\Controllers;

use App\Connections\Spotify\SpotifyRequest;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function search(Request $oRequest)
    {
        // Get the user's query string
        $sQuery = $oRequest->get('query');

        $oSpotify = new SpotifyRequest();

        // Make the search
        $aResults = $oSpotify->search($sQuery);

        // Set an empty array to retun in the even of no results
        $aItems = [];

        if (!empty($aResults)) {
            foreach ($aResults as $aResult) {
                $aItems = $aResult['items'];
            }
        }

        return view('results', compact('aItems'));
    }
}
