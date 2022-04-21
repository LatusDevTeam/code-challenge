<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Search Results</title>
</head>

<body>
    <div class="min-h-screen bg-slate-900 text-white">
        <div class="p-3 text-white">
            Your Search Term Was: <b>{{$searchTerm}}</b>
        </div>
        <div class="grid grid-cols-3">
            <div class="m-1 rounded bg-white shadow p-3 bg-slate-800 text-white">
                <h2 class="font-bold text-xl text-green-500 mb-3">Artists</h2>
                @if(count($artists))
                @foreach($artists as $artist)
                @include('parts.result', [
                'id' => $artist->id,
                'name' => $artist->name,
                'image' => $artist->images[0]->url ?? null,
                'type' => 'artists',
                ])
                @endforeach
                @else
                <p>No artists found</p>
                @endif
            </div>
            <div class="m-1 rounded bg-white shadow p-3 bg-slate-800">
                <h2 class="font-bold text-xl text-green-500 mb-3">Tracks</h2>
                @if(count($tracks))
                @foreach($tracks as $track)
                @include('parts.result', [
                'id' => $track->id,
                'name' => $track->name,
                'image' => $track->album->images[0]->url ?? null,
                'type' => 'tracks',
                ])
                @endforeach
                @else
                <p>No tracks found</p>
                @endif
            </div>
            <div class="m-1 rounded bg-white shadow p-3 bg-slate-800">
                <h2 class="font-bold text-xl text-green-500 mb-3">Albums</h2>
                @if(count($albums))
                @foreach($albums as $album)
                @include('parts.result', [
                'id' => $album->id,
                'name' => $album->name,
                'image' => $album->images[0]->url ?? null,
                'type' => 'albums',
                ])
                @endforeach
                @else
                <p>No albums found</p>
                @endif
            </div>
        </div>
    </div>
</body>

</html>