<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        // $series = Serie::query()->orderBy('name')->get();
        $series = Series::all();
        $messageSuccess = session()->get('message.success');
        // return view('series-list', ['series' => $series]);
        // return view('series-list', compact('series'));
        return view('series.index')
            ->with('series', $series)
            ->with('message', $messageSuccess);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        // local validation - moved to Requests module
        // $request->validate([
        //     'name' => ['required', 'min:3']
        // ]);

        $series = DB::transaction(function () use ($request) {
            $series = Series::create($request->all());
            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $series->id,
                    'number' => $i,
                ];
            }

            // insert seasons
            Season::insert($seasons);

            $episodes = [];
            foreach ($series->seasons as $season) {
                for ($i = 1; $i <= $request->episodesQty; $i++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $i,
                    ];
                }
            }

            // insert episodes
            Episode::insert($episodes);

            return $series;
        });


        // with: add flash message
        return to_route('series.index')->with('message.success', "Series '{$series->name}' created successfully");
    }

    public function destroy(Series $series)
    {
        $series->delete();
        // with: add flash message
        return to_route('series.index')->with('message.success', "Series '{$series->name}' deleted successfully");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('series', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();
        return to_route('series.index')->with('message.success', "Series '{$series->name}' updated successfully");
    }
}
