<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }
    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {

        $series = $this->seriesRepository->add($request);

        return response()
            ->json($series, 201);
    }

    public function show(int $series){
        $series = Series::whereId($series)->with('seasons.episodes')->first();
        return response()
            ->json($series);
    }

    public function update(int $series){

    }
    
    public function destroy(int $series){
    }

}
