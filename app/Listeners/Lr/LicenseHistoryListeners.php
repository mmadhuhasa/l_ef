<?php

namespace App\Listeners\Lr;

use App\Events\Lr\LicenseHistoryEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LicenseHistoryListeners
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
     * @param  LicenseHistoryEvent  $event
     * @return void
     */
    public function handle(LicenseHistoryEvent $event)
    {
        //
    }
}
