<?php

namespace App\Jobs\Emailtracker;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

class AutoRemainderEmailJob extends Job implements ShouldQueue {

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
        $user_email = 'ops@eflight.aero';

        if (env('APP_ENV') == 'local') {
            $cc = 'sk20900@gmail.com';
        } else {
            $cc = 'prem@eflight.aero';
        }

        $this->mail_headers = [
            'from' => env('FROM', "support@eflight.aero"),
            'from_name' => env('FROM_NAME', "Support | EFLIGHT"),
            'to' => $user_email,
            'cc' => $cc, //myFunction::get_cc_mails($data),
            'bcc' => 'dev.eflight@pravahya.com'
        ];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer) {
        $data = $this->data;
        $mail_headers = $this->mail_headers;
        // echo $mail_headers['to']."<br>";
        // var_dump($mail_headers['cc']);
        //dd($data);
        $mailer->send('emails.emailtracker.auto_remainder_email', $data, function($message) use($mail_headers, $data) {
            $message->from($mail_headers['from'], $mail_headers['from_name']);
            $message->to($mail_headers['to']);
            $message->subject($data['subject']);
            $message->cc($mail_headers['cc']);
//            $message->bcc($mail_headers['bcc']);
        });
    }

}
