<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        $series = ['Punisher', 'Lost', 'Grey\'s Anatomy'];
        // return view('series-list', ['series' => $series]);
        // return view('series-list', compact('series'));
        return view('series.index')->with('series', $series);
    }
}
