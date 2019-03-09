<?php

namespace App\Listeners\Lr;

use App\Events\Lr\DeleteUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteUserListeners
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
     * @param  DeleteUserEvent  $event
     * @return void
     */
    public function handle(DeleteUserEvent $event)
    {
        //
    }
}
