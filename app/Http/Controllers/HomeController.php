<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use Mail;
use App\Jobs\SendWelcomeEmail;

class HomeController extends Controller {

    public function index() {
	return view('test.queue');
    }

    public function send() {
	Log::info("Request Cycle with Queues Begins");
	$this->dispatch((new SendWelcomeEmail(['a1' => 'anand', 'a2' => 'Anand']))->delay(1));
	Log::info("Request Cycle with Queues Ends");
    }

}
