<?php

namespace App\Http\Controllers\Api;

use App\Events\SeriesDeleted;
use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }
    public function index(Request $request)
    {
        $query = Series::query();

        if ($request->has('name')) {
            $query->where('name', $request->name);
        }
        // return Series::whereName($request->name)->get();
        // return $query->get();
        return $query->paginate(2);
    }

    public function store(SeriesFormRequest $request)
    {

        $series = $this->seriesRepository->add($request);

        return response()
            ->json($series, 201);
    }

    public function show(int $series)
    {
        $series = Series::whereId($series)->with('seasons.episodes')->first();
        if (is_null($series)) {
            return response()
                ->json(['message' => 'Series not found'], 404);
        }
        return response()
            ->json($series);
    }

    public function update(int $series, SeriesFormRequest $request)
    {
        // $series->fill($request->all());
        // $series->save();
        Series::where('id', $series)->update($request->all());
        return response()
            ->json($series);
    }

    public function destroy(Series $series)
    {
        Series::destroy($series->id);

        // trigger event to delete image from store
        // add event
        $seriesDeleted = new SeriesDeleted(
            $series->cover ?? '',
        );
        event($seriesDeleted);

        return response()->noContent();
    }

    public function getEpisodes(Series $series)
    {
        return response()
            ->json($series->episodes);
    }

    public function getSeasons(Series $series)
    {
        return response()
            ->json($series->seasons);
    }
}
