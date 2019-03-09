<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\myfolder\ccAvenue;
use App\Jobs\Payment\SuccessEmailJob;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\myfolder\HelperClass;

class CcavenueController extends Controller {

    public function index(Request $request) {
        return 1;
    }

    public function ccavenue(Request $request) {
        return view('payments.ccavRequestHandler');
    }

    public function ccavenue_response(Request $request) {
        $data = $request->all();
//        print_r($data);
//        exit;
        $encResponse = $request->encResp;
        $order_no = $request->orderNo;

        $workingKey = '729A0984E9B26F093AF8C360F571DB56';  //Working Key should be provided here.
        $rcvdString = ccAvenue::decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
        $order_status = "";
        $decryptValues = explode('&', $rcvdString);
        $dataSize = sizeof($decryptValues);

        for ($i = 0; $i < $dataSize; $i++) {
            $information = explode('=', $decryptValues[$i]);
            if ($i == 3)
                $order_status = $information[1];
            if ($i == 10)
                $order_amount = $information[1];
        }

//        echo "<table cellspacing=4 cellpadding=4>";
//        for ($i = 0; $i < $dataSize; $i++) {
//            $information = explode('=', $decryptValues[$i]);
//            echo '<tr><td>' . $information[0] . '</td><td>' . urldecode($information[1]) . '</td></tr>';
//        }
//        echo "</table><br>";

        $number = (int) $order_amount;
        $words = HelperClass::figure_words($number);

        $type = ($request->type) ? ucfirst($request->type) : 'Fuel';
        $typefirst = substr($type, 0, 1);
        $ordernumber = "$typefirst-MAR10-10001-AVS";
        $fileName = "$ordernumber.pdf";
        $filePath = public_path('media/images/fpl/downloads/');
        $ipaddress = $_SERVER['REMOTE_ADDR'];

        $subject = "Order Confirmation //$ordernumber Successfully Placed";

        $data = ['email' => Auth::user()->email,
            'user_name' => Auth::user()->name,
            'subject' => $subject,
            'type' => $type,
            'typefirst' => $typefirst,
            'fileName' => $fileName,
            'ipaddress' => $ipaddress,
            'order_amount' => $order_amount,
            'words' => $words
        ];

        if ($order_status === "Success" || $order_status === "Failure" || $order_status === "Aborted") {
            $payment_alert_pdf = view('payments.payment_alert_pdf', $data);
            PDF::loadHTML($payment_alert_pdf)
                    ->setPaper('a4')
                    ->setOrientation('portrait')
                    ->save($filePath . $fileName);

            $pdf_path = ['pathToFile' => public_path('media/images/fpl/downloads/' . $fileName)];
            $data['pdf_path'] = $pdf_path;
            $data['fileName'] = $fileName;

            dispatch(new SuccessEmailJob($data));
        }


        return view('payments.ccavResponseHandler', ['encResponse' => $encResponse, 'order_no' => $order_no]);
    }

    public function cancel_url(Request $request) {
        $data = $request->all();
        return view('payments.cancel_url');
    }

}
