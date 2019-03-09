<?php

namespace App\Listeners\Lr;

use App\Events\Lr\EditUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EditUserListeners
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
     * @param  EditUserEvent  $event
     * @return void
     */
    public function handle(EditUserEvent $event)
    {
        //
    }
}
