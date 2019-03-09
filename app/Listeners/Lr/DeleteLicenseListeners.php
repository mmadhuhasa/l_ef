<?php

namespace App\Listeners\Lr;

use App\Events\Lr\DeleteLicenseEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteLicenseListeners
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
     * @param  DeleteLicenseEvent  $event
     * @return void
     */
    public function handle(DeleteLicenseEvent $event)
    {
        //
    }
}
