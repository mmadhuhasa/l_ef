<?php

namespace App\Listeners\Lr;

use App\Events\Lr\AddUserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class AddUserListeners
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
     * @param  AddUserEvent  $event
     * @return void
     */
    public function handle(AddUserEvent $event)
    {
        $data = $event->data;
         User::create($data);
    }
}
