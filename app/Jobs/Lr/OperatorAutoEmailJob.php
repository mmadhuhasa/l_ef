<?php

namespace App\Jobs\Lr;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

class OperatorAutoEmailJob extends Job implements ShouldQueue {

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

        if (env('APP_ENV') == 'local') {
            $user_email = ['sk20900@gmail.com'];
            $cc = ['dev.eflight@pravahya.com'];
        } else {
            $cc = ['ops@eflight.aero','prem@eflight.aero'];
        }

        $this->mail_headers = [
            'from' => env('FROM', "support@eflight.aero"),
            'from_name' => env('FROM_NAME', "Support | EFLIGHT"),
            'to' => $user_email,
            'cc' => $cc
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
        $mailer->send('emails.lr.operator_auto_email', $data, function($message) use($mail_headers, $data) {
            $message->from($mail_headers['from'], $mail_headers['from_name']);
            $message->to($mail_headers['to']);
            $message->subject($data['subject']);
            $message->cc($mail_headers['cc']);
        });
    }

}
