<?php

namespace App\Listeners\Lr;

use App\Events\Lr\EditLicenseEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditLicenseListeners
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
     * @param  EditLicenseEvent  $event
     * @return void
     */
    public function handle(EditLicenseEvent $event)
    {
        //
    }
}
