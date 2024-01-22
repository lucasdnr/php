<?php

namespace App\Listeners;

use App\Events\SeriesDeleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class DeleteSeriesCover
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SeriesDeleted  $event
     * @return void
     */
    public function handle(SeriesDeleted $event)
    {
        if(!isNull($event->seriesCoverPath) && $event->seriesCoverPath !== ""){
            Storage::disk('public')->delete($event->seriesCoverPath);
        }
    }
}
