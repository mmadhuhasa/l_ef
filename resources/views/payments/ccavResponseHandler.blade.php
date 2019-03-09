@extends('layouts.check_quick_plan_layout',array('1'=>'1'))

@section('content')
<div class="page" id="quick_app">
    <style>
        .new_fpl_heading,.search_heading {
            margin-bottom:20px;text-align: center;padding: 7px 0;font-weight: 600;font-size: 15px;color:#fff;
            font-family:'pt_sansregular', sans-serif;background: #a6a6a6;
            background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
        }
        .search_heading {margin-bottom:5px;text-transform: uppercase; padding: 15px 0px 15px 0px;}
        .mainwrapper{
            width:1000px;
            margin:0 auto;
        }
        .subwrapper{
            box-shadow: 3px 3px 12px 0px #999;
            padding-left: 0;
            padding-right: 0;
            margin-top:20px;
            margin-bottom: 30px;
            background: white;
        }
        .columnrow{
            box-shadow: 0 6px 8px 0px #a7a7a7;
            margin: 0;
        }
        .failedimg_wrapper{
            padding-left: 0; 
        }
        .imagefailed{
            margin-left:20px;
        }
        .sorry{
            color:#22b14c;
            font-weight: bold;
            font-size: 23px;
            margin-top:26px;
            margin-bottom: 8px;
        }
        .verify_wrapper{
            font-style: italic;
            font-size: 14px;
            font-weight: bold;
        }
        .info_failed_wrapper{
            padding-right: 0; 
        }
        .amount{
            color: #f1292b;
            font-style: normal;
        }
        .order_number{
            font-style: normal;
            text-decoration: underline;
            color: #0000ff;
        }
        .amount_words{
            margin-right: 5px; 
        }
        .or_wrapper{
            font-style: italic;
            font-weight:bold;
            margin:8px 0px 8px 0px;
            font-size: 14px;
        }
        .wrongcard_wrapper{
            font-style: italic;
            font-weight:bold;
            font-size: 14px; 
        }
        .ifyouhave_any{
            margin:45px 0px 5px 0px;
        }
        .contact_us{
            font-size: 13px;
            margin-left: 10%;
            color: #777;
            font-style: italic;
        }
        .clickhere{
            text-decoration: underline;
            color: #0000ff;
        }
        .emailed{
            font-style: italic;
            font-size: 14px;
            color: #777;
            font-weight: bold;
        }
        .order_wrapper{
            color:#000;
            font-weight:bold;
            font-size:15px;
            margin-top: 15px;
        }
        .amountpaid_wrapper{
            font-size: 15px;
            font-weight: bold;
            margin: 2px 0px 2px 0px;
        }
        .amount_paid{
            color:#f1292b;
        }
        .towards_wrapper{
            font-size: 15px;
            font-weight: bold;
            color:#4c4c4c;
        }
        .amountpaid_success_words{
            color: #4c4c4c; 
        }
        .towards_span{
            color:#000;
        }
    </style>
    @include('includes.new_header',[])


    <?php

    use App\myfolder\ccAvenue;

//error_reporting(0);

    $workingKey = '729A0984E9B26F093AF8C360F571DB56';  //Working Key should be provided here.
//$encResponse = $_POST["encResp"];   //This is the response sent by the CCAvenue Server
    $rcvdString = ccAvenue::decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
    $order_status = "";
    $decryptValues = explode('&', $rcvdString);
    $dataSize = sizeof($decryptValues);
    echo "<center>";

//print_r($rcvdString);exit;

    for ($i = 0; $i < $dataSize; $i++) {
        $information = explode('=', $decryptValues[$i]);
        if ($i == 3)
            $order_status = $information[1];
    }


//else if ($order_status === "Aborted") {
//    echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
//} else if ($order_status === "Failure") {
//    echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
//} else {
//    echo "<br>Security Error. Illegal access detected";
//}
//
//echo "<br><br>";
//
//echo "<table cellspacing=4 cellpadding=4>";
//for ($i = 0; $i < $dataSize; $i++) {
//    $information = explode('=', $decryptValues[$i]);
//    echo '<tr><td>' . $information[0] . '</td><td>' . urldecode($information[1]) . '</td></tr>';
//}
//
//echo "</table><br>";
//echo "</center>";
    ?>
    <?php if ($order_status === "Success") { ?>
        <div class="row mainwrapper">
            <div class="col-md-12 p-lr-0 subwrapper">
                <p class="search_heading"></p>
                <div class="row columnrow">
                    <div class="col-md-1 failedimg_wrapper">
                        <img src="{{url('media/ananth/images/thumbsup-success.jpg')}}" style="" class="imagefailed">
                    </div>
                    <div class="col-md-10 info_failed_wrapper">
                        <p class="sorry">Payment Successful !!</p>
                        <p class="emailed">We have emailed receipt to your registered address.</p>
                        <p class="order_wrapper">
                            <span>Order ID:</span>
                            <span class="order_number">F-JAN18-1001-AVS</span>
                        </p>
                        <p class="amountpaid_wrapper">
                            <span>Amount Paid:</span>
                            <span class="amount_paid">Rs. 26650.75</span>
                            <span class="amountpaid_success_words">(Rupees Twenty Thousand Six Hundred Fifty and seventy Five Paise)</span>
                        </p>
                        <p class="towards_wrapper">
                            <span class="towards_span">Towards:</span>
                            <span>HP FUEL</span>
                            <span>at</span>
                            <span>VOBL</span>
                            <span>(BANGALORE INTERNATIONAL AIRPORT)</span>
                            <span>for</span>
                            <span>450</span>
                            <span>Litres</span>
                        </p>
                    </div>
                    <div class="col-md-12 ifyouhave_any">
                        <p class="contact_us">If you have any questions about this order, please contact our accounts team on +91 9886454717 or email accounts@eflight.aero</p>
                    </div>
                </div><!--columnrow-->
            </div><!--subwrapper-->
        </div><!--mainwrapper-->
        <?php
    } else if ($order_status === "Failure") {
        ?>
        <div class="row mainwrapper">
            <div class="col-md-12 p-lr-0 subwrapper">
                <p class="search_heading"></p>
                <div class="row columnrow">
                    <div class="col-md-2 failedimg_wrapper">
                        <img src="{{url('media/ananth/images/thumbsup-failed.jpg')}}" style="" class="imagefailed">
                    </div>
                    <div class="col-md-9 info_failed_wrapper">
                        <p class="sorry">Sorry,  something went wrong</p>
                        <p class="verify_wrapper">
                            <span>Please verify that sufficient balance is available in your card to pay</span> 
                            <span class="amount">Rs. 26650.75</span>
                            <span class="amount_words">(Rupees Twenty Thousand Six Hundred Fifty and Seventy Five Paise) for paying Order Number</span>
                            <span class="order_number">F-JAN18-1001-AVS</span>
                        </p>
                        <p class="or_wrapper">OR</p>
                        <p class="wrongcard_wrapper">
                            <span>Wrong card details might have been entered,</span>
                            <span class="clickhere">Click here</span>
                            <span>to try paying again</span>
                        </p>
                    </div>
                    <div class="col-md-12 ifyouhave_any">
                        <p class="contact_us">If you have any questions about this order, please contact our accounts team on +91 9886454717 or email accounts@eflight.aero</p>
                    </div>
                </div><!--columnrow-->
            </div><!--subwrapper-->
        </div><!--mainwrapper-->
        <?php
    } else if ($order_status === "Aborted") {
        ?>
        <div class="row mainwrapper">
            <div class="col-md-12 p-lr-0 subwrapper">
                <p class="search_heading"></p>
                <div class="row columnrow">
                    <div class="col-md-2 failedimg_wrapper">
                        <img src="{{url('media/ananth/images/thumbsup-failed.jpg')}}" style="" class="imagefailed">
                    </div>
                    <div class="col-md-9 info_failed_wrapper">
                        <p class="sorry">Sorry,  something went wrong</p>
                        <p class="verify_wrapper">
                            <span>Please verify that sufficient balance is available in your card to pay</span> 
                            <span class="amount">Rs. 26650.75</span>
                            <span class="amount_words">(Rupees Twenty Thousand Six Hundred Fifty and Seventy Five Paise) for paying Order Number</span>
                            <span class="order_number">F-JAN18-1001-AVS</span>
                        </p>
                        <p class="or_wrapper">OR</p>
                        <p class="wrongcard_wrapper">
                            <span>Wrong card details might have been entered,</span>
                            <span class="clickhere">Click here</span>
                            <span>to try paying again</span>
                        </p>
                    </div>
                    <div class="col-md-12 ifyouhave_any">
                        <p class="contact_us">If you have any questions about this order, please contact our accounts team on +91 9886454717 or email accounts@eflight.aero</p>
                    </div>
                </div><!--columnrow-->
            </div><!--subwrapper-->
        </div><!--mainwrapper-->
        <?php
    } else {
        echo "<br>Security Error. Illegal access detected";
    }
    ?>





    @include('includes.new_footer',[])
</div>


@stop