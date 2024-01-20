<x-layout title="New Series">
    {{--
    <x-series.form :action="route('series.store')" :name="old('name')" :update="false" /> --}}
    <form action="{{ route('series.store') }}" method="post">
        @csrf
        <div class="row mb-3">
            <div class="col-8">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            </div>
            <div class="col-2">
                <label for="seasonsQty" class="form-label">Seasons Qty:</label>
                <input type="text" name="seasonsQty" id="seasonsQty" class="form-control" value="{{ old('seasonsQty') }}">
            </div>
            <div class="col-2">
                <label for="episodesQty" class="form-label">Episodes:</label>
                <input type="text" name="episodesQty" id="episodesQty" class="form-control" value="{{ old('episodesQty') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-layout>