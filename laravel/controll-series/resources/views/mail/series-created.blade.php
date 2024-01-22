@component('mail::message')

# {{ $nameSeries }} has been created!

The series {{ $nameSeries }} with {{ $seasonsQty }} seasons and {{ $seasonsEpisodes }} episodes by season has been created.

Access here: 

@component('mail::button', ['url' => route('seasons.index', $idSeries)])
    Check It Out
@endcomponent

@endcomponent