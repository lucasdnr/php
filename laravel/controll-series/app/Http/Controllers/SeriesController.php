<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()->orderBy('name')->get();
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

    public function store(Request $request){
        $series = Serie::create($request->all());
        session()->flash('message.success', "Series '{$series->name}' created successfully");
        return to_route('series.index');
    }

    public function destroy(Serie $series){
        $series->delete();
        session()->flash('message.success', "Series '{$series->name}' deleted successfully");
        return to_route('series.index');
    }
}
