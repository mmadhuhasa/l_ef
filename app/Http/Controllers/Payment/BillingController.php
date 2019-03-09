<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\models\OtpModel;
use App\Jobs\Payment\OtpJob;
use App\models\Fuelprice;
use PDF;
use Carbon\Carbon;
use DB;
use App\myfolder\HelperClass;
use App\User;

class BillingController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $bcc;
    public $cc;
    public $from;
    public $from_name;
    public $user_id;
    public $user_name;
    public $user_email;
    public $is_admin;
    public $user_callsigns;

    public function __construct() {
        $this->bcc = env('BCC', "dev.eflight@pravahya.com");
        $this->cc = env('CC', "dev.eflight@pravahya.com");
        $this->from = env('FROM', "support@eflight.aero");
        $this->from_name = env('FROM_NAME', "Support | EFLIGHT");
        $this->user_id = Auth::user()->id;
        $this->user_name = Auth::user()->name;
        $this->user_email = Auth::user()->email;
        $this->is_admin = Auth::user()->is_admin;
        $this->user_callsigns = Auth::user()->user_callsigns;
    }

    public function index(Request $request) {
        return 1;
    }

    public function billing(Request $request) {
        return view('payments.billing');
    }

    public function check_otp(Request $request) {
        $otp = $request->otp;
        $user_id = $this->user_id;

        date_default_timezone_set('Asia/Kolkata');
        $date1 = date("Y-m-d H:i:s");
        $date3 = Carbon::parse($date1);
        $date3 = $date3->addMinutes(-5);
        $date3 = date('Y-m-d H:i:s', strtotime($date3));

        $check_otp = OtpModel::where('user_id', $user_id)->where('otp', $otp)->count();

        $is_expire = OtpModel::where('user_id', $user_id)
                        ->where('updated_at', '>=', $date3)
                        ->where('otp', $otp)->count();

        $is_otp_valid = ($check_otp) ? TRUE : FALSE;
        $is_valid = ($is_expire) ? TRUE : FALSE;
        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success',
                    'is_otp_valid' => $is_otp_valid, 'is_valid' => $is_valid]);
    }

    public function process(Request $request) {
        $otp = $request->otp;
        $user_id = $this->user_id;
        $fuel = ($request->fuel) ? $request->fuel : "";
        $handling = ($request->handling) ? $request->handling : "";
        $hotel = ($request->hotel) ? $request->hotel : "";
        $cab = ($request->cab) ? $request->cab : "";
        $misc = ($request->misc) ? $request->misc : "";

        $data = ['fuel' => $fuel,
            'handling' => $handling,
            'hotel' => $hotel,
            'cab' => $cab,
            'misc' => $misc];
//        dd($data);
        $check_otp = OtpModel::where('user_id', $user_id)->where('otp', $otp)->count();
        if (!$fuel && !$handling && !$hotel && !$cab && !$misc) {
            return redirect('/billing')->with($data);
        }

        return view('payments.process', $data);
    }

    public function send_otp(Request $request) {
        $data = $request->all();
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string_shuffled = str_shuffle($string);
        $password = substr($string_shuffled, 1, 6);
        $data['password'] = $password;
        $data['email'] = $this->user_email;
        $data['user_name'] = $this->user_name;
        date_default_timezone_set('Asia/Kolkata');
        $date2 = date("d-M-Y H:i:s");
        $data['subject'] = "One Time Password (OTP) for BILLING // " . $date2;

        $date1 = date("d-M-Y H:i:s");
        $date3 = Carbon::parse($date2);
        $date3 = $date3->addMinutes(5);
        $date3 = date('H:i:s', strtotime($date3));

        $data['date2'] = $date3;
        dispatch(new OtpJob($data));
        $user_id = $this->user_id;
        $check_otp = OtpModel::where('user_id', $user_id)->count();
        if (!$check_otp) {
            $res = OtpModel::create(['otp' => $password, 'user_id' => $user_id]);
        } else {
            $res = OtpModel::where('user_id', $user_id)->update(['otp' => $password]);
        }

        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success', 'date2' => $date2]);
    }

    public function PaymentAlertPdf(Request $request) {

        // return view('payments.payment_alert_pdf');
        $pdf = PDF::loadView('payments.payment_alert_pdf');
        return $pdf->stream('payment_alert_pdf');
    }

    public function AutoSuggest() {
        $airports = DB::table('fuelprices')->groupBy('airport_code', 'city')->get();
        foreach ($airports as $airport) {
            $data[] = $airport->airport_code . ' - ' . $airport->city;
        }
        return json_encode($data);
    }

    public function FuelAgencyInfo(Request $request) {
        $current_date = date('Ymd');
        if ($request->airport_code == 'VOBG - BANGALORE - HAL') {
            $city = substr($request->airport_code, 7);
            $code = substr($request->airport_code, 0, 4);
        } else {
            $airport_code = explode(' - ', $request->airport_code);
            $city = $airport_code[1];
            $code = $airport_code[0];
        }

        $fuelprice = Fuelprice::where('airport_code', $code)
                ->where('city', $city)
                ->where('from_Date', '<=', $current_date)
                ->orderBy('from_date', 'DESC')
                ->first();

        return json_encode($fuelprice);
    }

    public function AmountInWords(Request $request) {
        $number = (int) $request->number;
        $words = HelperClass::figure_words($number);
        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success', 'words' => $words]);
    }

    public function callsign_operator(Request $request) {
        $aircraft_callsign = $request->aircraft_callsign;
        $user_data = User::where('user_callsigns', 'LIKE', "%$aircraft_callsign%")->first(['operator']);
        $operator = ($user_data) ? $user_data->operator : "";
        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success', 'operator' => $operator]);
    }

}
