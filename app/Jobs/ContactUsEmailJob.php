<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

class ContactUsEmailJob extends Job implements ShouldQueue {

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
	if (env('APP_ENV') == 'local') {
	    $to = "dev.eflight@pravahya.com";	  
	}  else {
	    $to = "prem@eflight.aero";	   
	}			
	date_default_timezone_set('Asia/Kolkata');
	$india_time = date('H:i:s');
	$subject = 'Enquiry at ' . $india_time . ' on ' . date('d-M-Y');
	
	$this->mail_headers = [
	    'from' => env('FROM', "support@eflight.aero"),
	    'from_name' => env('FROM_NAME', "Support | EFLIGHT"),
	    'subject' => $subject,
	    'to' => $to,
	    // 'bcc' => "dev.eflight@pravahya.com"
	    'bcc' => "sk20900@gmail.com"
	];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer) {
	$data = $this->data;
	$mail_headers = $this->mail_headers ;
	$mailer->send('emails.home.contact_form', $data, function($message) use($mail_headers) {
	    $message->from($mail_headers['from'], $mail_headers['from_name']);
	    $message->subject($mail_headers['subject']);
	    $message->to($mail_headers['to']);
	    $message->bcc($mail_headers['bcc']);
	});
    }

}
