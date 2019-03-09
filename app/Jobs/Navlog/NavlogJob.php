<?php

namespace App\Jobs\Navlog;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use App\myfolder\myFunction;

class NavlogJob extends Job implements ShouldQueue {

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
        $user_email = $data['email'];
//        if(env('APP_ENV') == 'local'){
//            $user_email = "dev.eflight@pravahya.com";
//        }
        $this->mail_headers = [
            'from' => env('FROM', "support@eflight.aero"),
            'from_name' => env('FROM_NAME', "Support | EFLIGHT"),
            'to' => $user_email,
            'cc' => myFunction::get_navlog_cc_mails($data),
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
        $mailer->send('emails.navlog.order', $data, function($message) use($mail_headers, $data) {
            $message->from($mail_headers['from'], $mail_headers['from_name']);
            $message->to($mail_headers['to']);
            $message->subject($data['subject']);
            $message->cc($mail_headers['cc']);
            $message->attach($data['file_path'], array(
            'as' =>$data['pdf_name'],
            'mime' => 'application/pdf')
            );
        });
        //unlink($data['folder_path']);
    }

}
