<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Season $season)
    {
        return view('episodes.index')->with('episodes', $season->episodes);
    }

    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = $request->episodes;
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array($episode->id, is_array($watchedEpisodes) ? $watchedEpisodes : []);
        });
        // update
        $season->push();

        return to_route('episodes.index', $season->id);
    }
}
