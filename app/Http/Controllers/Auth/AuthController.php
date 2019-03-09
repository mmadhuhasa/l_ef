<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Session;
use Redirect;
use Auth;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Mail;
use Log;
use App\Exceptions\customException;
use Illuminate\Support\Facades\Hash;
use App\myfolder\myFunction;
use Crypt;
use App\Jobs\ForgotPasswordJob;
use App\Jobs\ChangePasswordJob;
use App\Jobs\ResetPasswordJob;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public $bcc;
    public $cc;
    public $from;
    public $from_name;

    public function __construct() {
	$this->bcc = env('BCC', "dev.eflight@pravahya.com");
	$this->cc = env('CC', "dev.eflight@pravahya.com");
	$this->from = env('FROM', "support@eflight.aero");
	$this->from_name = env('FROM_NAME', "Support | EFLIGHT");

	$this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
	return Validator::make($data, [
		    'name' => 'required|max:255',
		    'email' => 'required|email|max:255|unique:users',
		    'password' => 'required|confirmed|min:6',
	]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
	return User::create([
		    'name' => $data['name'],
		    'email' => $data['email'],
		    'password' => bcrypt($data['password']),
	]);
    }

    public function postRegister(AuthRequest $request) {
	$data = $request->all();
	$data['password'] = bcrypt($data['password']);
	$data['is_active'] = 1;
	
	$event_result = event(new \App\Events\UserRegisterEvent($data));	
	$result = $event_result['0'];	
	if ($result) {
	    return redirect::to('account/register');
	} else {
	    return redirect::to('/');
	}
    }

    public function getLogout() {
	Auth::logout();
	return redirect::to('/');
    }

    public function forgot_password(Request $request) {
	try {
	    $data = [];
	    $email = $request->email;
	    $mobile_number = $request->mobile_number;
            $url = $request->url;
	    if ($request->email) {
		$data['email'] = 'required|email';
	    } else {
		$data['mobile_number'] = 'required|min:10|max:10';
	    }
	    $validator = Validator::make($request->all(), $data);

	    if ($validator->fails()) {
		return response()->json(['error_message' => 'Enter Valid Email or Mobile Number', 'STATUS_CODE' => 0, 'error' => '1']);
	    } else {
                if($mobile_number !=''){
                    $user_details = User::where('mobile_number', $mobile_number)
			->first();
                }else{
                    $user_details = User::where('email', $email)->first();
                }
		$mobile_number = ($user_details) ? $user_details->mobile_number : "" ;
//		return myFunction::get_bcc_mails();exit;
		if ($user_details) {
                    $email = $user_details->email;
		    $mail_headers = [
			'from' => $this->from,
			'from_name' => $this->from_name,
			'subject' => "RESET PASSWORD for $mobile_number",
			'to' => $email,
			'cc' => myFunction::get_cc_mails([], '1'),
			'bcc' => myFunction::get_bcc_mails()
		    ];
		    $name = ucfirst($user_details->name);
                    $encoded = encrypt($mobile_number);
		    $mail_data = ['name' => $name,
                        'email' => $email,
                        'encoded'=>$encoded,
                        'email' =>$email,
                        'subject' => "RESET PASSWORD for $mobile_number",
                        'url'=>$url
                        ];

//		    Mail::send('emails.api.forgot_password', $mail_data, function($message) use($mail_headers) {
//			$message->from($mail_headers['from'], $mail_headers['from_name']);
//			$message->subject($mail_headers['subject']);
//			$message->to($mail_headers['to']);
//			$message->cc($mail_headers['cc']);
//			$message->bcc($mail_headers['bcc']);
//		    });
                    Log::info('Forgot Password Job started');
                    $this->dispatch(new ForgotPasswordJob($mail_data));
                    Log::info('Forgot Password Job ended');
		    return response()->json(['success' => 1, 'error' => '0', 'success_message' => 'Please check your email to reset password']);
		} else {
		    return response()->json(['success' => 0, 'error' => '1', 'error_message' => 'User does not exist.']);
		}
	    }
	} catch (\Exception $ex) {
	    Log::error('Auth Controller forgot_password: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	}
    }

    public function change_password(Request $request) {
	try {
	    $rules = [
		'old_password' => 'required|min:4',
		'password' => 'required|min:4|confirmed'
	    ];
	    $validator = Validator::make($request->all(), $rules);

	    if ($validator->fails()) {
		return response()->json(['STATUS_DESC' => 'Enter All valid fields', 'STATUS_CODE' => 0]);
	    } else {
		$user_details = User::where('email', $request->email)->where('is_active', '1')->first();
		if (!$user_details) {
		    return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0], 402);
		}
		$mobile_number = $user_details->mobile_number;

		$db_pass = ($user_details) ? $user_details->password : '';
		$enter_pass = $request->get('old_password');

		$name = ucfirst($user_details->name);
		$mail_data = ['name' => $name,
		    'encoded' => 'dsfsdf'];
		$mail_headers = [
		    'from' => $this->from,
		    'from_name' => $this->from_name,
		    'subject' => "PASSWORD CHANGED FOR (" . $mobile_number . ") " . $name,
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

			$credentials = ['mobile_number' => $user_details->mobile_number, 'password' => $request->password];
			$attempt = Auth::attempt($credentials);

			return response()->json(['STATUS_DESC' => 'Password Changed successfully', 'STATUS_CODE' => 1]);
		    } else {
			return response()->json(['STATUS_DESC' => 'User does not exist', 'STATUS_CODE' => 0]);
		    }
		} else {
		    return response()->json(['STATUS_DESC' => 'Enter Correct Password', 'STATUS_CODE' => 0]);
		}
	    }
	} catch (\Exception $ex) {
	    Log::error('Api Change Password Auth Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
	    throw new customException($ex->getMessage());
	}
    }

    public function reset_password(Request $request) {
        $decrypt = decrypt($request->_key);
	return view('auth.reset',['decrypt' =>$decrypt]);
    }

    public function post_reset_password(Request $request) {

	$rules = [
	    'mobile_number' => 'required|min:4',
	    'password' => 'required|min:4|confirmed'
	];
	$validator = Validator::make($request->all(), $rules);

	if ($validator->fails()) {
	    return response()->json(['error_message' => 'Enter All valid fields', 'STATUS_CODE' => 0]);
	}

	$email = ($request) ? $request->email : '';
	$mobile_number = ($request) ? $request->mobile_number : '';
        
         $decrypt = decrypt($request->_key);
         if($mobile_number != $decrypt){
           return response()->json(['error_message' => 'Key and Email does not match', 'STATUS_CODE' => 0]);  
         }

         if($email != ''){
             $user_details = User::where('email', $email)->first();
         }elseif($mobile_number !=''){
             $user_details = User::where('mobile_number', $mobile_number)->first();
         }
	
	$mobile_number = ($user_details) ? $user_details->mobile_number : '';

	$name = ucfirst($user_details->name);
	$mail_data = ['name' => $name];
	$mail_headers = [
	    'from' => $this->from,
	    'from_name' => $this->from_name,
	    'subject' => "PASSWORD CHANGED FOR (" . $mobile_number . ") " . $name,
	    'to' => $user_details->email,
	    'cc' => myFunction::get_cc_mails([], '1'),
	    'bcc' => myFunction::get_bcc_mails()
	];

	$result = User::where('mobile_number', $mobile_number)
		->update(['password' => bcrypt($request->get('password'))]);
	if ($user_details) {
	    Mail::send('emails.api.change_password', $mail_data, function($message) use($mail_headers) {
		$message->from($mail_headers['from'], $mail_headers['from_name']);
		$message->subject($mail_headers['subject']);
		$message->to($mail_headers['to']);
//		$message->cc($mail_headers['cc']);
//		$message->bcc($mail_headers['bcc']);
	    });

//	    $credentials = ['mobile_number' => $user_details->mobile_number, 'password' => $request->password];
//	    $attempt = Auth::attempt($credentials);
	    return response()->json(['success_message' => 'Password updated successfully', 'STATUS_CODE' => 1]);
	} else {
	    return response()->json(['error_message' => 'User does not exist', 'STATUS_CODE' => 0]);
	}
    }

    public function get_user_details(Request $request) {
	$email = ($request->email) ? trim($request->email) : '';
	$mobile_number = ($request->mobile_number) ? trim($request->mobile_number) : '';
	$result = User::where('is_active', 1)
			->where('email', $email)
			->orWhere('mobile_number', $mobile_number)->first();
	if($result){
	    return response()->json(['success'=>1,'error'=>0]);
	}else{
	    return response()->json(['success'=>0,'error'=>1]);
	}
    }

}
