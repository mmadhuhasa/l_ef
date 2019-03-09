<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use App\myfolder\myFunction;

class AircraftJob extends Job implements ShouldQueue {

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
       if(env('APP_ENV') == 'local')
           $cc = ['sk20900@gmail.com'];
       else
           //$cc = ['ops@eflight.aero','sk20900@gmail.com'];
            $cc = ['prem@eflight.aero','ops@eflight.aero','sk20900@gmail.com'];
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
        $mailer->send('emails.newaircraft.signup', $data, function($message) use($mail_headers, $data) {
            $message->from($mail_headers['from'], $mail_headers['from_name']);
            $message->to($mail_headers['to']);
            $message->subject($data['subject']);
            $message->cc($mail_headers['cc']);
            // if (array_key_exists("file_path",$data)){
            //      for ($i=0; $i<count($data['file_path']);$i++){
            //         $message->attach($data['file_path'][$i]);
            //      }
            // }
            if($data['file_path1']!="") 
              $message->attach($data['file_path1']);
            
            if($data['file_path2']!="") 
              $message->attach($data['file_path2']);

            if($data['file_path3']!="") 
              $message->attach($data['file_path3']);

            if($data['file_path4']!="") 
              $message->attach($data['file_path4']);
            //dd($message);   
            //$message->attach($data['file_path']);
            // $message->attach($data['file_path'], array(
            // 'as' =>'xx',
            // 'mime' => 'application/pdf')
            // );
        });
        //unlink($data['folder_path']);
    }

}
