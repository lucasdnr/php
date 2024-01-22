<?php

namespace App\Listeners;

use App\Events\SeriesCreated as EventsSeriesCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SeriesCreated;
use App\Models\User;

class EmailUsersAboutSeriesCreated
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
     * @param  object  $event
     * @return void
     */
    public function handle(EventsSeriesCreated $event)
    {
        $userList = User::all();
        foreach ($userList as $index => $user) {
            // send email
            $email = new SeriesCreated(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesQty,
            );
            $when = now()->addSeconds($index * 2);
            Mail::to($user)->later($when, $email);
            // Mail::to($user)->queue($email);
        }
    }
}
