<x-layout title="Seasons of '{!! $series->name !!}'">
    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Season: {{ $season->number }}
            <span class="badge bg-secondary">
                {{ $season->episodes->count() }}
            </span>
        </li>
        @endforeach
    </ul>
</x-layout>