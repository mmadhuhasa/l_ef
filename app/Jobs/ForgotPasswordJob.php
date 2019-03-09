<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use App\myfolder\myFunction;

class ForgotPasswordJob extends Job implements ShouldQueue {

    use InteractsWithQueue,
        SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
    protected $mail_headers;

    public function __construct($data) {
        $this->data = $data;
        $user_email = $data['email'];
        $this->mail_headers = [
            'from' => env('FROM', "support@eflight.aero"),
            'from_name' => env('FROM_NAME', "Support | EFLIGHT"),
            'to' => $user_email,
            'cc' => myFunction::get_cc_mails($data, 1),
            'bcc' => myFunction::get_bcc_mails()
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
        $mailer->send('emails.api.forgot_password', $data, function($message) use($mail_headers, $data) {
            $message->from($mail_headers['from'], $mail_headers['from_name']);
            $message->to($mail_headers['to']);
            $message->subject($data['subject']);
//            $message->cc($mail_headers['cc']);
          //  $message->bcc($mail_headers['bcc']);
        });
    }

}
