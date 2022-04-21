<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Code Challenge</title>
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: sans-serif;
            height: 100vh;
            margin: 50px;
        }

        .full-height {
            height: 100vh;
        }

        .result {}
    </style>
</head>

<body>
    <div class="full-height">
        <div class="result">
            Your Search Term Was: <b>{{$searchTerm}}</b>
        </div>
        <div class="grid grid-cols-3">
            <div class="m-1 rounded bg-white shadow p-3 bg-slate-800 text-white">
                <h2 class="font-bold text-xl text-green-400">Artists</h2>
                @if(count($artists))
                @foreach($artists as $artist)
                @include('parts.result', [
                'id' => $artist->id,
                'name' => $artist->name,
                'image' => $artist->images[0]->url ?? null,
                ])
                @endforeach
                @else
                <p>No artists found</p>
                @endif
            </div>
            <div class="m-1 rounded bg-white shadow p-3 bg-slate-800">
                <h2 class="font-bold text-xl text-green-400">Tracks</h2>
                @if(count($tracks))
                @foreach($tracks as $track)
                @include('parts.result', [
                'id' => $track->id,
                'name' => $track->name,
                'image' => $track->album->images[0]->url ?? null,
                ])
                @endforeach
                @else
                <p>No tracks found</p>
                @endif
            </div>
            <div class="m-1 rounded bg-white shadow p-3 bg-slate-800">
                <h2 class="font-bold text-xl text-green-400">Albums</h2>
                @if(count($albums))
                @foreach($albums as $album)
                @include('parts.result', [
                'id' => $album->id,
                'name' => $album->name,
                'image' => $album->images[0]->url ?? null,
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