<?php

namespace App\Listeners\Home;

use App\Events\Home\ContactUsEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\models\ContactFormModel;

class ContactUsListeners
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
     * @param  ContactUsEvent  $event
     * @return void
     */
    public function handle(ContactUsEvent $event)
    {
	$data = $event->data;
	$result = ContactFormModel::create($data);
	if($result){
	    return 1;
	}else{
	    return 0;
	}
    }
}
