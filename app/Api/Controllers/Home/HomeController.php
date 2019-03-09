<?php

namespace App\Api\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\models\ContactFormModel;
use App\Jobs\ContactUsEmailJob;
use App\Events\Home\ContactUsEvent;
use App\Http\Requests\ContactRequest;
use Log;
use Response;

class HomeController extends Controller
{
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public $bcc;
	public $cc;
	public $from;
	public $from_name;
	public $customer_id;

	public function __construct() {
		$this->bcc = env('BCC', "dev.eflight@pravahya.com");
		$this->cc = env('CC', "dev.eflight@pravahya.com");
		$this->from = env('FROM', "support@eflight.aero");
		$this->from_name = env('FROM_NAME', "EFLIGHT");
	}

	public function index(Request $request) {
		return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
			. 'is absolutely forbidden for some reason'], 403);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
			. 'is absolutely forbidden for some reason'], 403);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
			. 'is absolutely forbidden for some reason'], 403);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
			. 'is absolutely forbidden for some reason'], 403);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
			. 'is absolutely forbidden for some reason'], 403);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
			. 'is absolutely forbidden for some reason'], 403);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
			. 'is absolutely forbidden for some reason'], 403);
	}
        
        
         /**
     * @api {POST} /api/home/contact-us  User Contact Form
     * @apiName Contact-us
     * @apiGroup Home API's
     *
     * @apiParam {String} name Users name.    
     * @apiParam {String} email Users email.
     * @apiParam {Number} mobile_number Users mobile_number.    
     * @apiParam {String} operator Company Name.
     * @apiParam {String} message Comments.    
        
   
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     * 
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "STATUS_DESC": "Success"
      "STATUS_CODE": 1
      }

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *    
     */
        
        
        public function contact_us(ContactRequest $request){
            	$data = $request->all();
		$page = $request->page;

		$result = event(new ContactUsEvent($data));
                $result_val = $result[0];

		$mail_data['name'] = strtoupper($request->name);
		$mail_data['email'] = $request->email;
		$mail_data['mobile_number'] = $request->mobile_number;
                $mail_data['operator'] = strtoupper($request->operator);
		$mail_data['contact_message'] = strtoupper($request->message);
                $mail_data['is_app'] = 1;
                $data['is_app'] = 1;
                $data['contact_message'] = strtoupper($request->message);

		Log::info('ContactUsEmailJob Queue begins');
		$this->dispatch((new ContactUsEmailJob($mail_data))->delay(10));
		Log::info('ContactUsEmailJob Queue ends');
		if ($result_val) {
			return Response::json(['success' => 'Thank you for contacting us. We will respond shortly.']);
		} else {
			return redirect::to('contact-us')->with('success', 'Thank you for contacting us. We will respond shortly.');
		}
        }
            
}
