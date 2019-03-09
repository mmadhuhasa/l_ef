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
            margin-left:10px;
        }
        .sorry{
            color: #f1292b;
            font-weight: bold;
            font-size: 23px;
            margin-top:26px;
            margin-bottom: 8px;
        }
        .verify_wrapper{
            font-style: italic;
            font-size: 14px;
        }
        .amount{
            color: #f1292b;
            font-style: normal;
            font-weight:bold;
        }
        .order_number{
            font-style: normal;
            color: #2E64FE;
            font-weight:bold;
            cursor:pointer;
        }
        .order_number:hover{
            text-decoration: underline;
        }
        .amount_words{
           margin-right: 5px; 
           color:gray;
        }
        .or_wrapper{
           font-style: italic;
           font-weight:bold;
           margin:8px 0px 8px 0px;
           font-size: 14px;
        }
        .wrongcard_wrapper{
           font-style: italic;
           font-weight:normal;
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
            color: #2E64FE;
            cursor:pointer;
            font-weight:bold;
        }
        .clickhere:hover{
            color: #2E64FE;
            text-decoration: underline;
        }
    </style>
@include('includes.new_header',[])

<div class="row mainwrapper">
<div class="col-md-12 p-lr-0 subwrapper">
    <p class="search_heading"></p>
<div class="row columnrow">
   <div class="col-md-2 failedimg_wrapper">
     <img src="{{url('media/ananth/images/thumbsup-failed.jpg')}}" style="" class="imagefailed">
   </div>
   <div class="col-md-10 info_failed_wrapper">
       <p class="sorry">Sorry,  something went wrong</p>
       <p class="verify_wrapper">
            <span>Please verify that sufficient balance is available in your card to pay</span> 
            <span class="amount">Rs. 126650.75</span>
            <span class="amount_words">(Rupees One Lakh Twenty Thousand Six Hundred Fifty and Seventy Five Paise) <span style="color:#000;">for Order Number</span></span>
            <span class="order_number">F-JAN18-1001-AVS</span>
            <span><img src="https://www.eflight.aero/media/ananth/images/pdf.png"/></span>
       </p>
       <p class="or_wrapper">OR</p>
       <p class="wrongcard_wrapper">
       <span>Wrong card details might have been entered,</span>
       <a href="http://localhost:8000/billing" class="clickhere">CLICK HERE</a>
       <span>to try paying again</span>
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