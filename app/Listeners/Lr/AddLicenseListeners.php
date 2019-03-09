<?php

namespace App\Listeners\Lr;

use App\Events\Lr\AddLicenseEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddLicenseListeners
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
     * @param  AddLicenseEvent  $event
     * @return void
     */
    public function handle(AddLicenseEvent $event)
    {
        //
    }
}
