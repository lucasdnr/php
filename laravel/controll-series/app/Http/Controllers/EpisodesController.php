<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    public function index(Season $season)
    {
        return view('episodes.index')
            ->with('episodes', $season->episodes)
            ->with('message', session('message.success'));
    }

    public function update(Request $request, Season $season)
    {
        $watchedList = [];
        $unwatchedList = [];

        $watchedEpisodes = is_array($request->episodes) ? $request->episodes : [];

        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes, &$watchedList, &$unwatchedList) {
            // improve number of requests to update watched episode field
            $checked = in_array($episode->id, $watchedEpisodes);
            if ($episode->watched === true && !$checked) {
                $unwatchedList[] = $episode->id;
            } elseif ($episode->watched === false && $checked) {
                $watchedList[] = $episode->id;
            }
            // $episode->watched = in_array($episode->id, $watchedEpisodes);
            $episode->watched = $checked;
        });
        
        try {
            DB::beginTransaction();
            // update
            // $season->push();
            if (count($watchedList) > 0) {
                Episode::whereIn('id', $watchedList)->update(['watched' => true]);
            }
            if (count($unwatchedList) > 0) {
                Episode::whereIn('id', $unwatchedList)->update(['watched' => false]);
            }

            DB::commit();

            return to_route('episodes.index', $season->id)
                ->with('message.success', 'Episodes updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }
}
