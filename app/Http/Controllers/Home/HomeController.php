<?php

namespace App\Http\Controllers\Home;

use App\Events\Home\ContactUsEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Jobs\ContactUsEmailJob;
use App\Logic\Render\PageRender;
use App\models\notams\FavouritesNotamsModel;
use App\models\notams\FavouritesRoutesModel;
use App\models\notams\FavouritesWxModel;
use Illuminate\Support\Facades\Hash;
use App\models\StationsModel;
use Illuminate\Http\Request;
use Log;
use Redirect;
use Response;
use Auth;
use Validator;
use App\User;
use Input;

class HomeController extends Controller {

    public $from;
    public $from_name;
    public $pagerender;

    public function __construct(PageRender $pagerender) {
        $this->from = "info@eflight.aero";
        $this->from_name = "Info | EFLIGHT";
        $this->pagerender = $pagerender;
    }

    public function index(Request $request) {
//	 $page = Cache::tags('index-tag')->get('index-key');
        //	 if($page != null){
        //	     return $page;
        //	 }
        $page = $request->page;
        switch ($page) {
            case $page:
                if ($page) {
                    return view($page);
                } else {
                    return $this->pagerender->getHome();
                }
                break;
            default:
                return $this->pagerender->getHome();
                break;
        }
    }

    public function store(Request $request) {
        
    }

    public function contact_us(Request $request) {
//	$page = Cache::tags('contact')->get('contact');
        //	if($page != null){
        //	    return $page;
        //	}
        return $this->pagerender->getContactUs();
    }

    public function about_us(Request $request) {
//	$page = Cache::tags('about')->get('about');
        //	if($page != null){
        //	    return $page;
        //	}
        return $this->pagerender->getAboutUs();
    }

    public function contact_form(ContactRequest $request) {
        $data = $request->all();
        $page = $request->page;

        $rules = ['g-recaptcha-response' => 'required|captcha'];

        $validator = Validator::make($data, $rules);
//        if ($validator->fails()) {
//            if (env('APP_ENV') != 'local' && $page != 'contact_us') {
//                if ($validator->fails()) {
//                    return Response::json(['success' => 'Please enter valid reCAPTCHA.']);
//                }
//            } elseif (env('APP_ENV') != 'local') {
//                return redirect::to('contact-us')->with('success', 'Please enter valid reCAPTCHA.');
//            }
//        }
        if($request->email2!="")
            return Response::json(['success' =>false]);
        $result = event(new ContactUsEvent($data));
        $result = $result[0];

//	date_default_timezone_set('Asia/Kolkata');
        //	$india_time = date('H:i:s');
        //	$subject = 'Enquiry at ' . $india_time . ' on ' . date('d-M-Y');
        //
		//	if (env('APP_ENV') == 'local') {
        //	    $to = "dev.eflight@pravahya.com";
        //	}  else {
        //	    $to = "prem@eflight.aero";
        //	}
        //	$mail_headers = [
        //	    'from' => $this->from,
        //	    'from_name' => $this->from_name,
        //	    'subject' => $subject,
        //	    'to' => $to,
        //	    'bcc' => "dev.eflight@pravahya.com"
        //	];
        $mail_data['name'] = strtoupper($request->name);
        $mail_data['email'] = $request->email;
        $mail_data['mobile_number'] = $request->mobile_number;
        $mail_data['contact_message'] = strtoupper($request->message);
//	if ($result) {
        //	    Mail::send('emails.home.contact_form', $mail_data, function($message) use($mail_headers) {
        //		$message->from($mail_headers['from'], $mail_headers['from_name']);
        //		$message->subject($mail_headers['subject']);
        //		$message->to($mail_headers['to']);
        //		$message->bcc($mail_headers['bcc']);
        //	    });
        //	}
        Log::info('ContactUsEmailJob Queue begins');
        $this->dispatch((new ContactUsEmailJob($mail_data))->delay(10));
        Log::info('ContactUsEmailJob Queue ends');
        // if ($page != 'contact_us') {
        //     return Response::json(['success' => 'Thank you for contacting us. We will respond shortly.']);
        // } else {
        //     return redirect::to('contact-us')->with('success', 'Thank you for contacting us. We will respond shortly.');
        // }
        return Response::json(['success' => 'Thank you for contacting us. We will respond shortly.']);
    }

    public function contact_us2(Request $request) {
        return view('home.contact_us2');
    }

    public function update_user_fav(Request $request) {

        $data = $request->all();
        unset($data['_token']);
        if ($data['type'] == "fav_aerodrome_notams") {
            for ($i = 0; $i < sizeof($data['value']); $i++) {
                if (FavouritesNotamsModel::where('user_id',$data['user_id'])->where("fav_aerodrome_notams", "=", $data['value'][$i])->first() == false) {
                    $dbObj = new FavouritesNotamsModel;
                    $dbObj->user_id = $data['user_id'];
                    $dbObj->fav_aerodrome_notams = $data['value'][$i];
                    $dbObj->save();
                }
            }
        } else if ($data['type'] == "fav_aerodrome_weather") {
            for ($i = 0; $i < sizeof($data['value']); $i++) {
                if (FavouritesWxModel::where('user_id',$data['user_id'])->where("fav_aerodrome_weather", "=", $data['value'][$i])->first() == false) {
                    $dbObj = new FavouritesWxModel;
                    $dbObj->user_id = $data['user_id'];
                    $dbObj->fav_aerodrome_weather = $data['value'][$i];
                    $dbObj->save();
                }
            }
        } else {
             for ($i = 0; $i < sizeof($data['value']); $i++) {
                if (FavouritesRoutesModel::where('user_id',$data['user_id'])->where("fav_routes", "=", $data['value'][$i])->first() == false) {
                    $dbObj = new FavouritesRoutesModel;
                    $dbObj->user_id = $data['user_id'];
                    $dbObj->fav_routes = $data['value'][$i];
                    $dbObj->save();
                }
            }
        }
        // FavouritesModel::insert($data);

        return $data;
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
        // $mail_headers = [
        //     'from' => $this->from,
        //     'from_name' => $this->from_name,
        //     'subject' => "Password Changed for (" . $mobile_number . ") " . $name,
        //     'to' => $user_details->email,
        //     'cc' => myFunction::get_cc_mails([], '1'),
        //     'bcc' => myFunction::get_bcc_mails()
        // ];
        if (Hash::check($enter_pass, $db_pass)) {
            $result = User::where('email', $request->email)
                ->update(['password' => bcrypt($request->get('password'))]);
            if ($user_details) {
//             Mail::send('emails.api.change_password', $mail_data, function($message) use($mail_headers) {
//                 $message->from($mail_headers['from'], $mail_headers['from_name']);
//                 $message->subject($mail_headers['subject']);
//                 $message->to($mail_headers['to']);
// //              $message->cc($mail_headers['cc']);
// //              $message->bcc($mail_headers['bcc']);
//             });

            // $credentials = ['mobile_number' => $user_details->mobile_number, 'password' => $request->password];
            // $attempt = Auth::attempt($credentials);

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
    public function update_user(Request $request) {
        $data = $request->all();
        unset($data['_token']);
        User::where('id', $request->id)->update($data);
        return $data;
    }

    public function getuser(Request $request) {
        $data = array('user_info' => Auth::user(),
            "fav_wx" => FavouritesWxModel::where("fav_aerodrome_weather", "!=", NULL)->where("user_id", "=", Auth::id())->get(['fav_aerodrome_weather']),
            "fav_notams_aero" => FavouritesNotamsModel::where("fav_aerodrome_notams", "!=", NULL)->where("user_id", "=", Auth::id())->get(['fav_aerodrome_notams']),
            "fav_routes" => FavouritesRoutesModel::where("fav_routes", "!=", NULL)->where("user_id", "=", Auth::id())->get(['fav_routes']),
        );
        return $data;
    }

    public function getAirportList() {
        return StationsModel::where("aero_id", "!=", "ZZZZ")->get(['aero_id']);
    }

    public function remove_fav(Request $request) {
       $data = $request->all();
        unset($data['_token']);
        if ($data['type'] == "fav_aerodrome_notams") {
           FavouritesNotamsModel::where("fav_aerodrome_notams","=",$data['aero_code'])->delete();
        } else if ($data['type'] == "fav_aerodrome_weather") {
           FavouritesWxModel::where("fav_aerodrome_weather","=",$data['aero_code'])->delete();
        } else {
            FavouritesRoutesModel::where("fav_routes","=",$data['aero_code'])->delete();
        }
        return $request->all();
    }

    public function cfp2() {
        return view('navlog.index');
    }

    public function profile() {

        $user_info = Auth::user();

        return view('home.profile', $user_info);
    }
    public function pilot_profile() {
        return view('home.pilot_profile');
    }

}
