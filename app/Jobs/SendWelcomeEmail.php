<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;
use App\myfolder\myFunction;

class SendWelcomeEmail extends Job implements ShouldQueue {

    use InteractsWithQueue,
	SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public $mail_headers;



    public function __construct($data) {
	$this->data = $data;		
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer) {
	$mailer->send('emails.welcome', $this->data, function ($message) {
	    $message->from('support@eflight.aero', 'Christian Nwmaba');
	    $message->to('dev.eflight@pravahya.com');
	});
    }

}
