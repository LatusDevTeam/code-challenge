@php
$image = $item->images[0]->url ?? null;
if (isset($item->album)) {
$image = $item->album->images[0]->url ?? $image;
}
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>{{ $item->name }}</title>
</head>

<body>
    <div class="bg-slate-900 text-white min-h-screen flex">
        <div class="m-auto text-center">
            <h1>{{ $item->name }}</h1>
                @if(isset($image))
                <img src="{{ $image }}" alt="{{ $item->name }}" class="w-32 block mx-auto mt-3">
                @else
                <img src="{{ asset('img/no_image.png') }}" alt="{{ $item->name }}" class="w-32 block mx-auto mt-3">
                @endif
            @if(isset($item->album))
            <p>Album: {{ $item->album->name }}</p>
            @endif
            @if(isset($item->artists))
            <p>Artists: {{ implode(', ', array_map(function ($artist){return $artist->name;}, $item->artists)) }}</p>
            @endif
            @if(isset($item->albums))
            <p>Albums: {{ implode(', ', array_map(function ($a){return $a->name;}, $item->albums)) }}</p>
            @endif
            @if(isset($item->preview_url))
            <p>Preview:</p>
            <audio src="{{ $item->preview_url }}" controls>
                @endif

                @if(isset($item->external_urls->spotify))
                    <a href="{{ $item->external_urls->spotify }}" target="_blank" class="inline-block m-4 bg-green-600 font-bold p-4 rounded-xl">Open on Spotify</a>
                @endif
        </div>
    </div>
</body>

</html>