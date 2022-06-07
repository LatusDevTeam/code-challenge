@php

use App\Connections\Spotify\SpotifyRequest;

@endphp

@extends('layouts/layout')

@section('page-header', 'Search Results')
@section('page-title',  'Search Results')

@section('content')

    @if (count($aItems) > 0)
        <div class="table-responsive-md mb-4">
            <table class="table table-hover table-sm">
                <thead>
                    <tr>
                        <th>{!! 'Cover' !!}</th>
                        <th align="left">{!! 'Artists' !!}</th>
                        <th align="left">{!! 'Title' !!}</th>
                        <th>{!! 'Tracks' !!}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aItems as $aItem)

                    @php

                        $oSpotify = new SpotifyRequest();

                        $aTracks = $oSpotify->getTracks($aItem['id']);

                        $aTrackNames = [];

                        foreach ($aTracks['items'] as $aTrack) {
                            $aTrackNames[] = $aTrack['name'];
                        }

                        $aItem['tracks'] = implode(', ', $aTrackNames);

                    @endphp

                        <tr class="" valign="top">
                            <td width="70px"><img src="{{ $aItem['images'][2]['url'] }}"></td>
                            <td width="300px">{{ $aItem['artists'][0]['name'] }} </td>
                            <td width="450px">{{ $aItem['name'] }}</td>
                            <td>{{ $aItem['tracks'] }}</td>
                        </tr>
                        <tr><td colspan=4><hr></td></tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    @else

        <div>No items were found for your search request</div>

    @endif

@endsection
