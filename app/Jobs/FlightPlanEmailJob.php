<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\myfolder\myFunction;
use Illuminate\Mail\Mailer;

class FlightPlanEmailJob extends Job implements ShouldQueue {

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
	$user_email = $data['email'];
	$this->mail_headers = [
	    'from' => env('FROM', "support@eflight.aero"),
	    'from_name' => env('FROM_NAME', "Support | EFLIGHT"),
	    'to' => $user_email,
	    'cc' => myFunction::get_cc_mails($data,'',1,1),
	    'bcc' => myFunction::get_bcc_mails()
	];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer) {
	$mail_headers = $this->mail_headers;
	$data = $this->data;
	$user_email = $data['email'];
	$mailer->send('emails.fpl.flight_plan', $data, function ($message) use($mail_headers, $data, $user_email) {
	    $message->from($mail_headers['from'], $mail_headers['from_name']);
	    $message->subject($data['subject']);
	    $message->to($user_email);
	    $message->cc($mail_headers['cc']);
	   // $message->bcc($mail_headers['bcc']);
	    
	    if ($data['departure_aerodrome'] == 'VABB') {
		$message->attach($data['pdf_path']['merge_path'], array(
		    'as' => $data['fileName'],
		    'mime' => 'application/pdf')
		);
	    }
	    else if ($data['departure_aerodrome'] == 'TTTT') {
		$message->attach($data['pdf_path']['merge_path'], array(
		    'as' => $data['fileName'],
		    'mime' => 'application/pdf')
		);
	    }else{
		$message->attach($data['pdf_path']['pathToFile'], array(
		'as' => $data['fileName'],
		'mime' => 'application/pdf')
	    );
	    }
	});
	$filePath = public_path('media/images/fpl/downloads/');
//	unlink($filePath . 'AnnexureCopy.pdf');
//	unlink(public_path('media/pdf/fpl/' . $data['fileName']));
    }

}
