<x-layout title="Episodes" :message="$message">
    <form method="post">
        @csrf
        <ul class="list-group">
            @foreach ($episodes as $episode)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                    Episode: {{ $episode->number }}
                    <input type="checkbox" name="episodes[]" value="{{ $episode->id }}" @if ($episode->watched) checked @endif>
            </li>
            @endforeach
        </ul>
        <button class="btn btn-primary my-2">Save</button>
    </form>
</x-layout>