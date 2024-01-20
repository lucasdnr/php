<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    public function index(Series $series)
    {
        // eager loading, getting from relation seasons() instead seasons collection
        $seasons = $series->seasons()->with('episodes')->get();

        return view('seasons.index')
            ->with('seasons', $seasons)
            ->with('series', $series);
    }
}
