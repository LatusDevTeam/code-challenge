<a href="{{ route('info', ['type' => $type, 'id' => $id]) }}" class="block bg-slate-900 mb-1 p-2 flex items-center hover:text-green-500 transition-all">
    <div class="w-20">
        @if(isset($image))
        <img src="{{ $image }}" alt="{{ $name }}">
        @else
        <img src="{{ asset('img/no_image.png') }}" alt="{{ $name }}">
        @endif
    </div>
    <div class="p-2">
        <p>{{ $name }}</p>
    </div>
</a>