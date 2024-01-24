<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function update(Episode $episode, Request $request)
    {
        $episode->watched = $request->watched;
        $episode->save();
        return response()
            ->json($episode);
    }
}
