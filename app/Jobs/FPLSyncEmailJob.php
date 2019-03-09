<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;

class FPLSyncEmailJob extends Job implements ShouldQueue {

    use InteractsWithQueue,
        SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
    public $mail_headers;

    public function __construct($data) {
        $this->data = $data;
        if (env('APP_ENV') == 'local') {
            $to = ['dev.eflight@pravahya.com']; //$data['email'];
            $cc = ['dev.eflight@pravahya.com'];
        } else {
            $to = 'ops@eflight.aero';
            $cc = ['prem@eflight.aero','dev.eflight@pravahya.com'];
        }
        $this->mail_headers = [
            'from' => env('FROM', "support@eflight.aero"),
            'from_name' => env('FROM_NAME', "Support | EFLIGHT"),
            'to' => $to,
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
        $mailer->send('emails.api.fpl_sync', $data, function($message) use($mail_headers, $data) {
            $message->from($mail_headers['from'], $mail_headers['from_name']);
            $message->to($mail_headers['to']);
            $message->subject($data['subject']);
            $message->cc($mail_headers['cc']);
            //$message->bcc($mail_headers['bcc']);
        });
    }

}
