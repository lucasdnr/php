<?php

namespace Tests\Feature;

use App\Http\Requests\SeriesFormRequest;
use App\Repositories\SeriesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SeriesRepositoryTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created()
    {
        // Arrange
        // We will create a instance from a service that was set up in Services Provider
        // to do this we will use app->make passing the interface
        $repository = $this->app->make(SeriesRepository::class);
        
        $request = new SeriesFormRequest();
        $request->name = 'Series Name';
        $request->seasonsQty = 1;
        $request->episodesQty = 1;
        
        // Act
        $repository->add($request);

        // Assert
        $this->assertDatabaseHas('series', ['name' => 'Series Name']);
        $this->assertDatabaseHas('seasons', ['number' => '1']);
        $this->assertDatabaseHas('episodes', ['number' => '1']);
        
    }
}
