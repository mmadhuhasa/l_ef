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
            color:red;
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

<div class="row mainwrapper">
<div class="col-md-12 p-lr-0 subwrapper">
    <p class="search_heading"></p>
<div class="row columnrow">
   <div class="col-md-1 failedimg_wrapper">
     <img src="{{url('media/ananth/images/thumbsup-success.jpg')}}" style="" class="imagefailed">
   </div>
   <div class="col-md-10 info_failed_wrapper">
       <p class="sorry">Payment Cancelled !!</p>
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
@include('includes.new_footer',[])
</div>


@stop