<x-layout title="Series">
    <a href="/series/new" class="btn btn-dark mb-2">Add</a>
    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item">{{ $serie; }}</li>
        @endforeach
    </ul>
</x-layout>