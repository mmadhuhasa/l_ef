<?php

namespace App\Api\Controllers;

use App\User;
use Dingo\Api\Facade\API;
use Illuminate\Http\Request;
use App\Api\Requests\UserRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Session\SessionInterface;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;
use Log;
use App\Exceptions\customException;
use App\Api\Requests\ChangePassRequest;
use Illuminate\Support\Facades\Hash;
use Input;
use App\Api\Requests\AdminRequest;
use App\myfolder\myFunction;

//use App\Http\Requests\Request;

class AuthController extends BaseController {

    public $bcc;
    public $cc;
    public $from;
    public $from_name;
    public $prem_mail_id;

    public function __construct() {
	$this->bcc = env('BCC', "dev.eflight@pravahya.com");
	$this->cc = env('CC', "dev.eflight@pravahya.com");
	$this->from = env('FROM', "support@eflight.aero");
	$this->from_name = env('FROM_NAME', "Support | EFLIGHT");
	$this->prem_mail_id = "prem@eflight.aero";
    }

    public function index(Request $request) {
	return response()->make(['error' => 'Accessing the page or resource you were trying to reach '
		    . 'is absolutely forbidden for some reason'], 403);
    }

    public function me(Request $request) {
	try {
	    return JWTAuth::parseToken()->authenticate();
	} catch (\Exception $ex) {
	    Log::error('Api destroy Auth Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	} catch (JWTException $e) {
	    // something went wrong whilst attempting to encode the token
	    return response()->json(['STATUS_DESC' => 'could_not_create_token', 'STATUS_CODE' => 0], 500);
	}
    }

    public function validateToken() {
	// Our routes file should have already authenticated this token, so we just return success here
	return API::response()->array(['status' => 'success'])->statusCode(200);
    }

    /**
     * @api {POST} /api/login  User Authentication
     * @apiName Authentication
     * @apiGroup Auth API's
     *
     * @apiParam {Number} mobile_number Users unique ID.
     *
     * * @apiParam {String} password Users Password.
     *
     * @apiSuccess {String} token Generated token on Authentication.
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     * @apiSuccess {String} email  store in session .
     * 
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQyLCJpc3MiOiJodHRwOlwvXC9wcml2YXRlZmxpZ2h0LmNvLmluXC9hcGlcL3JlZ2lzdGVyIiwiaWF0IjoxNDU2MTMxNjE0LCJleHAiOjE0NTk3MzE2MTQsIm5iZiI6MTQ1NjEzMTYxNCwianRpIjoiNDE2Y2U1MWM4OGY5YmIzYjc3N2VhOGIxMjA0Mzc1NzEifQ.VSOMMW9gJTPXzdhGcvoRfRoIcaoeOe5aiphk5emTLlY"
      "STATUS_DESC": "Success"
      "STATUS_CODE": 1
      "email": "anand.vuppu@pravahya.com"
      }

     * @apiErrorExample Error-Response:
     *     HTTP/1.1 404 Not Found
     *     {
     *       "not_found": true
     *     }
     *    
     */
    public function authenticate(Request $request) {
	// grab credentials from the request
	$credentials = $request->only('mobile_number', 'password');
	$credentials['is_active'] = 1;
	try {
	    // attempt to verify the credentials and create a token for the user
	    if (!$token = JWTAuth::attempt($credentials)) {
		return response()->json(['STATUS_DESC' => 'invalid_credentials', 'STATUS_CODE' => 0], 401);
	    } else {
		// all good so return the token
		$user_details = User::where('mobile_number', $request->mobile_number)->first();
		$email = ($user_details) ? $user_details->email : '';
		return response()->json(['token' => $token, 'STATUS_DESC' => 'Success', 'STATUS_CODE' => 1, 'email' => $email], 200);
	    }
	} catch (\Exception $ex) {
	    Log::error('Api destroy Auth Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	} catch (JWTException $e) {
	    // something went wrong whilst attempting to encode the token
	    return response()->json(['STATUS_DESC' => 'could_not_create_token', 'STATUS_CODE' => 0], 500);
	}
    }

    /**
     * @api {POST} /api/register  User Registration
     * @apiName Registration
     * @apiGroup Auth API's
     *
     * @apiParam {String} name Users name.    
     * @apiParam {String} email Users email.
     * @apiParam {Number} mobile_number Users mobile_number.    
     * @apiParam {String} operator Users Admin.
     * @apiParam {String} password Users Password.    
     * @apiParam {String} password_confirmation Users Password.
     *
     * @apiSuccess {String} token Generated token on Authentication.
     * @apiSuccess {String} STATUS_DESC  Success .
     * @apiSuccess {String} STATUS_CODE  1 .
     * 
     * * @apiSuccessExample Success-Response:
     *      HTTP/1.1 200 OK
      {
      "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjQyLCJpc3MiOiJodHRwOlwvXC9wcml2YXRlZmxpZ2h0LmNvLmluXC9hcGlcL3JlZ2lzdGVyIiwiaWF0IjoxNDU2MTMxNjE0LCJleHAiOjE0NTk3MzE2MTQsIm5iZiI6MTQ1NjEzMTYxNCwianRpIjoiNDE2Y2U1MWM4OGY5YmIzYjc3N2VhOGIxMjA0Mzc1NzEifQ.VSOMMW9gJTPXzdhGcvoRfRoIcaoeOe5aiphk5emTLlY"
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
    public function register(UserRequest $request) {
	try {
	    $name = ucfirst($request->name);
	    $email = $request->get('email');
	    $mobile_number = $request->get('mobile_number');
	    $operator = $request->get('operator');

	    $newUser = [
		'name' => $name,
		'email' => $email,
		'password' => bcrypt($request->get('password')),
		'mobile_number' => $mobile_number,
		'operator' => $operator
	    ];
	    $newUser['is_active'] = 1;
	    $user_details = User::where('email', $email)
			    ->orWhere('mobile_number', $mobile_number)->first();

	    if ($user_details) {
		return response()->json(['STATUS_DESC' => 'User already exist', 'STATUS_CODE' => 0], 402);
	    }
	    $newUser['is_app'] = 1;
	    $user = User::create($newUser);
	    $token = JWTAuth::fromUser($user);
	    $current_date = date('d-M-Y');
	    $current_time = date('H:i:s');

	    $mail_headers = [
		'from' => $this->from,
		'from_name' => $this->from_name,
		'subject' => "NEW SIGN UP for APP on " . $current_date . " at " . $current_time,
		'to' => $this->prem_mail_id,
		'cc' => myFunction::get_cc_mails([], '1'),
		'bcc' => myFunction::get_bcc_mails()
	    ];
	    $mail_data = ['name' => $name,
		'email' => $email,
		'mobile_number' => $mobile_number,
		'operator' => $operator,'is_app'=>1];

	    Mail::send('emails.api.register', $mail_data, function($message) use($mail_headers) {
		$message->from($mail_headers['from'], $mail_headers['from_name']);
		$message->subject($mail_headers['subject']);
		$message->to($mail_headers['to']);
		$message->cc($mail_headers['cc']);
		$message->bcc($mail_headers['bcc']);
	    });


	    // all good so return the token
	    return response()->json(['token' => $token, 'STATUS_DESC' => 'Success', 'STATUS_CODE' => 1], 200);
	} catch (\Exception $ex) {
	    Log::error('Api Register Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	} catch (JWTException $e) {
	    // something went wrong whilst attempting to encode the token
	    return response()->json(['STATUS_DESC' => 'could_not_create_token', 'STATUS_CODE' => 0], 500);
	}
    }

    /**
     * @api {POST} /api/forgot_password  Forgot Password
     * @apiName Forgot Password
     * @apiGroup Auth API's
     *

     * @apiParam {String} email Users email.
     * @apiParam {Number} mobile_number Users mobile_number.    

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
    public function forgot_password(Request $request) {
	try {
	    $data = [];
	    $email = $request->email;
	    $mobile_number = $request->mobile_number;
	    if ($request->email) {
		$data['email'] = 'required|email';
	    } else {
		$data['mobile_number'] = 'required|min:10|max:10';
	    }
	    $validator = Validator::make($request->all(), $data);

	    if ($validator->fails()) {
		return response()->json(['STATUS_DESC' => 'Enter Valid Email or Password', 'STATUS_CODE' => 0], 402);
	    } else {
		$user_details = User::where('email', $email)->where('is_active', '1')
				->orWhere(function ($query) use($mobile_number) {
				    $query->where('mobile_number', $mobile_number);
				    $query->where('is_active', '1');
				})->first();

		if (!$user_details) {
		    return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 402);
		}
		$mail_headers = [
		    'from' => $this->from,
		    'from_name' => $this->from_name,
		    'subject' => "Reset Password for " . $mobile_number,
		    'to' => $user_details->email,
		    'cc' => myFunction::get_cc_mails([], '1'),
		    'bcc' => myFunction::get_bcc_mails()
		];
		$name = ucfirst($user_details->name);
		$mail_data = ['name' => $name,'is_app'=>1];
		if ($user_details) {
		    Mail::send('emails.api.forgot_password', $mail_data, function($message) use($mail_headers) {
			$message->from($mail_headers['from'], $mail_headers['from_name']);
			$message->subject($mail_headers['subject']);
			$message->to($mail_headers['to']);
			$message->cc($mail_headers['cc']);
			$message->bcc($mail_headers['bcc']);
		    });
		    return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => 1], 200);
		} else {
		    return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 402);
		}
	    }
	} catch (\Exception $ex) {
	    Log::error('Api Register Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	} catch (JWTException $e) {
	    // something went wrong whilst attempting to encode the token
	    return response()->json(['STATUS_DESC' => 'could_not_create_token', 'STATUS_CODE' => 0], 500);
	}
    }

    /**
     * @api {POST} /api/change_password  User change password
     * @apiName change password
     * @apiGroup Auth API's
     *
     * @apiParam {String} old_password Users old_password.    
     * @apiParam {String} email Users email.
     * @apiParam {Number} mobile_number Users mobile_number.      
     * @apiParam {String} password Users Password.    
     * @apiParam {String} password_confirmation Users Password.
     *    
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
    public function change_password(ChangePassRequest $request) {
	try {
	    $rules = [
		'old_password' => 'required|min:4',
		'password' => 'required|min:4'
	    ];
	    $validator = Validator::make($request->all(), $rules);

	    if ($validator->fails()) {
		return response()->json(['STATUS_DESC' => 'Enter All valid fields', 'STATUS_CODE' => 0], 402);
	    } else {
		$user_details = User::where('email', $request->email)->where('is_active', '1')->first();
		if (!$user_details) {
		    return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 402);
		}
		$mobile_number = $user_details->mobile_number;
		$db_pass = ($user_details) ? $user_details->password : '';
		$enter_pass = $request->get('old_password');

		$name = ucfirst($user_details->name);
		$mail_data = ['name' => $name,'is_app'=>1];
		$mail_headers = [
		    'from' => $this->from,
		    'from_name' => $this->from_name,
		    'subject' => "Password Changed for (" . $mobile_number . ") " . $name,
		    'to' => $user_details->email,
		    'cc' => myFunction::get_cc_mails([], '1'),
		    'bcc' => myFunction::get_bcc_mails()
		];
		if (Hash::check($enter_pass, $db_pass)) {
		    $result = User::where('email', $request->email)
			    ->update(['password' => bcrypt($request->get('password'))]);
		    if ($user_details) {
			Mail::send('emails.api.change_password', $mail_data, function($message) use($mail_headers) {
			    $message->from($mail_headers['from'], $mail_headers['from_name']);
			    $message->subject($mail_headers['subject']);
			    $message->to($mail_headers['to']);
//			    $message->cc($mail_headers['cc']);
//			    $message->bcc($mail_headers['bcc']);
			});
			return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => 1], 200);
		    } else {
			return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 402);
		    }
		} else {
		    return response()->json(['STATUS_DESC' => 'Enter Correct Password', 'STATUS_CODE' => 0], 402);
		}
	    }
	} catch (\Exception $ex) {
	    Log::error('Api Change Password Auth Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	} catch (JWTException $e) {
	    // something went wrong whilst attempting to encode the token
	    return response()->json(['STATUS_DESC' => 'could_not_create_token', 'STATUS_CODE' => 0], 500);
	}
    }
 
    public function users_list(AdminRequest $request) {
	try {
	    $result = User::where('is_active', 1)->get();
	    return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => '1', 'result' => $result], 200);
	} catch (\Exception $ex) {
	    Log::error('Api destroy Auth Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	} catch (JWTException $e) {
	    // something went wrong whilst attempting to encode the token
	    return response()->json(['STATUS_DESC' => 'could_not_create_token', 'STATUS_CODE' => 0], 500);
	}
    }
 
    public function destroy(AdminRequest $request, $id) {
	try {
	    $customer_details = User::where('is_active', 1)->where('id', $id)->first();
	    if (!$customer_details) {
		return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 500);
	    }
	    $result = User::where('id', $id)->delete();
	    return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => '1'], 200);
	} catch (\Exception $ex) {
	    Log::error('Api destroy Auth Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	} catch (JWTException $e) {
	    // something went wrong whilst attempting to encode the token
	    return response()->json(['STATUS_DESC' => 'could_not_create_token', 'STATUS_CODE' => 0], 500);
	}
    }

    public function update(Request $request, $id) {
	try {
	    $customer_details = User::where('is_active', 1)->where('id', $id)->first();
	    if (!$customer_details) {
		return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 500);
	    }
	    $User_data = [
		'name' => Input::get('name'),
		'mobile_number' => Input::get('mobile_number'),
		'operator' => Input::get('operator')
	    ];
	    $result = User::where('id', $id)->update($User_data);
	    if ($result) {
		return response()->json(['STATUS_DESC' => 'Success', 'STATUS_CODE' => '1'], 200);
	    } else {
		return response()->json(['STATUS_DESC' => 'Data does not update', 'STATUS_CODE' => '0'], 200);
	    }
	} catch (\Exception $ex) {
	    Log::error('Api destroy Auth Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	} catch (JWTException $e) {
	    // something went wrong whilst attempting to encode the token
	    return response()->json(['STATUS_DESC' => 'could_not_create_token', 'STATUS_CODE' => 0], 500);
	}
    }

}
