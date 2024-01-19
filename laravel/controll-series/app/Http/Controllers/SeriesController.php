<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('name')->get();
        // return view('series-list', ['series' => $series]);
        // return view('series-list', compact('series'));
        return view('series.index')->with('series', $series);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request){
        $name = $request->name;
        $serie = new Serie();
        $serie->name = $name;
        $serie->save();
        return redirect('/series');
    }
}
