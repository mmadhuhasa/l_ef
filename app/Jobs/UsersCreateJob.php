<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\myfolder\myFunction;
use Illuminate\Mail\Mailer;
use Log;

class UsersCreateJob extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public $mail_headers;

    public function __construct($data) {
	$this->data = $data;
	$user_email = $data['email'];
	$bcc = ['dev.eflight@pravahya.com'];
	
	if(env('APP_ENV') == 'local'){
	    $bcc = ['dev.eflight@pravahya.com'];
	}  else {
	$bcc = ['dev.eflight@pravahya.com','prem@eflight.aero'];    
	}
	
	$this->mail_headers = [
	    'from' => env('FROM', "support@eflight.aero"),
	    'from_name' => env('FROM_NAME', "Support | EFLIGHT"),
	    'to' => $user_email,
//	    'cc' => myFunction::get_cc_mails($data,'',1),
	    'bcc' => $bcc
	];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer) {
	try{
	$data = $this->data;
	$mail_headers = $this->mail_headers;
//	$data['subject'] = "Welcome to EFLIGHT";
	$mailer->send('emails.api.register', $data, function($message) use($mail_headers,$data) {
	    $message->from($mail_headers['from'], $mail_headers['from_name']);
	    $message->to($mail_headers['to']);
	    $message->subject($data['subject']);
//	    $message->cc($mail_headers['cc']);
	    $message->bcc($mail_headers['bcc']);
	});
	} catch (\Exception $ex) {
		    Log::info('Users Create  '.$ex->getMessage().' '.$ex->getLine());
		}
    }
}
