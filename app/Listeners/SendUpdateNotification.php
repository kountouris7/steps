<?php

namespace App\Listeners;

use App\Events\GroupUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUpdateNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  GroupUpdated  $event
     * @return void
     */
    public function handle(GroupUpdated $event)
    {
        //var_dump($event->group .  'was updated');
    }
}
