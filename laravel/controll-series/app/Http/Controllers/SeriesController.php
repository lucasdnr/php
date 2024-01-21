<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        
    }

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
        $series = $this->repository->add($request);

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
