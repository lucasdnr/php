<x-layout title="Seasons of '{!! $series->name !!}'">
    @if(!is_null($series->cover))
    <div class="text-center mb-2">
        <img src="{{ asset('storage/' .$series->cover) }}" alt="Cover" height="400" class="img-fuild">
    </div>
    @endif

    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('episodes.index', $season->id) }}">
                Season: {{ $season->number }}
            </a>
            <span class="badge bg-secondary">
                {{ $season->numberOfWatchedEpisodes() }} / {{ $season->episodes->count() }}
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>