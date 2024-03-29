<x-layout title="Series" :message="$message">
    @auth
    <a href="{{ route('series.create') }}" class="btn btn-dark mb-2">Add</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                @if(!is_null($serie->cover))
                    <img src="{{ asset('storage/' . $serie->cover) }}" width="100" alt="Cover" class="img-thumbnail me-3">
                @endif
                    
                @auth
                <a href="{{ route('seasons.index', $serie->id) }}" class="link-primary">
                @endauth
                    {{ $serie->name }}
                @auth    
                </a>
                @endauth
            </div>
            
            @auth
            <span class="d-flex">
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">
                        X
                    </button>
                </form>
            </span>
            @endauth
        </li>
        @endforeach
    </ul>
</x-layout>