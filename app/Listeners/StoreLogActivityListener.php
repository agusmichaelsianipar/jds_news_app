<?php

namespace App\Listeners;

use App\Events\LogActivityEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Log;

class StoreLogActivityListener
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
     * @param  \App\Events\LogActivityEvent  $event
     * @return void
     */
    public function handle(LogActivityEvent $event)
    {
        Log::record(
            $event->name,
            $event->user_id,
            $event->url,
            $event->method,
            $event->ip_address,
            $event->user_agent
        );
    }
}
