@extends('layouts.new_index_layout',array('aircraft_callsign'=>'loadandtrim'))
@section('content')
<style type="text/css">
    .bg-v-white {
        background: #ffffff;
        box-shadow: 0 0 3px 1px #999999;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .bg-v-white p {
        font-size: 15px;
    }

    .bg-v-grey {
        background: #fff;
        box-shadow: 0 0 1px 1px #999999;
        margin-bottom: 10px;
    }

    .bg-v-grey:hover {
        box-shadow: 0 0 1px 1px red;
    }
    .bg-v-grey h5 {
        margin:0;
    }

    .about_us {
        padding: 20px;      
    }

    .about-head-text, .about-values-text {
        text-transform: none;
        font-family: sans-serif;
        color: #222222;
    }

    .about-us-text1 {
        padding-top: 15px;
        padding-bottom: 30px;
        text-align: justify;
    }

    .about-us-text1 p {
        font-size: 15px;
    }

    .about-v-box {
        background: rgba(192,192,192,0.1);
        margin-bottom: 20px;
        padding: 10px 5px;
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
        border-left: 3px solid #bbb;
        min-height: 85px; 
    }

    .about-v-box:hover {

        background: #eeeeee;
    }

    .about-v-box h6 {
        color: #444;
        margin-top: 0px;
        margin-bottom: 0px;
        padding-left: 3%;
    }

    .about-v-box p {
        padding-left: 8%;
        margin-top: 5px;
        font-size:15px;
    }

    .about-us-video1, .about-us-video2 {
        padding-top: 30px;
    }
    .about-us-plans {
        background: #eeeeee;
        padding-bottom: 20px;
    }
    .about-us-plans h4 {
        text-align:left; 
        text-transform:none;
    }

    .about-us-plans h5 {
       
        padding: 15px 0;
        color:#ffffff;
        background: #333333;

    }

    .about-us-plans p {
        padding: 10px;
        border-bottom: 1px solid #d5d5d5;
        font-size: 13px;
        margin:0;
        color: #555555;
    }


    .about-us-plans h6 {
        margin:0;
        padding: 22px 15px;
        background: #ffffff;
        font-size: 15px;
        cursor: pointer;

    }



    .about-img-box h2 {
        margin:0 70px;
        line-height:30px;
        color:#f1292b;
    }

    .about-fact-image {
        text-align: center;
        padding-top: 38px;
    }

    .about-img-box .mask {
        background-color: #ffffff;
    }

    .about-img-box p {
        padding:2px;
    }

    .req-quote{
        color: #fff;
        padding: 6px 17px;
        background: #f1292b;
        border-radius:4px;
    }

    .req-quote:hover {
        background: #333333;
        -moz-transition: 0.3s all ease;
        -o-transition: 0.3s all ease;
        -webkit-transition: 0.3s all ease;
        transition: 0.3s all ease;
    }

    .req-quote:hover, .req-quote:focus, .req-quote:active {
        text-decoration: none;
        color: #fff;
    }

    .pad-r-0 {
        padding-right: 0;
    }

    .text-justify {
        text-align: justify;
    }

    .text-center {
        text-align: center;
    }

    .p-b-10 {
        padding-bottom: 10px;
    }

    .p-b-20 {
        padding-bottom: 20px;
    }

    .p-b-30 {
        padding-bottom: 30px;
    }

    .p-b-40 {
        padding-bottom: 40px;
    }

    .p-t-15 {
        padding-top: 15px;
    }

    .p-t-30 {
        padding-top: 30px;
    }

    .pad-lr-0 {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .view-tenth .mask p {
        background: url('media/images/home/about-us-logo1.png') no-repeat;
        background-size: 100% 100%;
        background-position:  center;
        min-height: 250px;
    }
/*    .b-0 {
        border:0 !important;
    }*/

    @media only screen and (min-width : 320px) and (max-width : 767px) {
        .about_us {
            padding:20px 0;     
        }

        .about-fact-image {
            text-align: center;
            padding-top: 10px;
        }       
    }

    @media only screen and (min-width : 768px) and (max-width : 1024px) {
        .about-fact-image {
            padding-top: 10px;
            width: 100%;
            float: left;
            padding-left: 23%;
            padding-bottom: 30px;
        }

        .about-us-text1 {
            padding-bottom: 10px;
        }

        .container {
            width: 100%;
        }

        .bg-v-grey {
            margin-bottom: 30px;
        }
    }
    
    @media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
        .about-fact-image {
            width:50%;
            padding-left: 0;
            padding-top: 60px;
        }
        .about-v-box {
            padding-bottom: 0;
        }
        .email_main_box {
            width: 76.3%;
        }
    
    }
    .newbtn_black{
    width: 70px;
    height: 33px;
    padding: 8px 6px;
    color:#fff;
    line-height: 18px;
    }
    .newbtn:hover, .newbtn_black:hover, .newbtnv1:hover{
    color:#fff;
    }
    .yesedit{
    width:100%;
    text-align:center;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        $('.req-quote,  .about-us-plans h6').on('click', function () {
            $("#f_c_name").focus();
        });
    });
</script>
<div class="page">  
    @include('includes.new_header',[])
    <main>
        <section class="about_us">
            <div class="container bg-v-white">
                <div class="row">
                    <div class="col-md-12">

                        <h4 class="about-head-text">About <span style="color:#f1292b">Us</span></h4>

                    </div>
                    <div class="col-md-6 about-us-text1">

                        <p><span style="color: #f1292b;font-size:14px;font-weight:bold">EFLIGHT</span> has evolved from being just a ATC Flight Planning Company to India’s # 1 Trip Support company in just 2 years !! Founded in 2015 by Prem, an aviation enthusiast, and now powered by Pravahya Consulting Pvt Ltd for a vision to create an Indian company with global solution plus reduce flight planning costs. Today, EFLIGHT serves more than 40 Business Aviation clients in India and handles on an average of 150 Flights a day.</p>

                        <p>Indian Charter Aviation market is unregulated with lot of uncertainties before the conduct of each flight be it from knowing Ground Handling rates,
                            Star Hotel room rates for 8 Hours Day Stay or 24 Hours Night Stay, Fuel &amp; Doctor availability, Crew Transportation etc. Plus, every time flight is delayed,
                            all concerned players to be informed over phone starting from ATC. EFLIGHT logo symbolizes what we offer, a simple one-stop solution for all the complicated &amp; time consuming pre &amp; post flight services. In short, just an SMS or Phone Call or email to our qualified dispatch team 24 x 7, will guarantee You a hassle free flight with even savings thru group discount.</p>

                    </div>
                    <div class="col-md-6 about-fact-image">
                        <div class="view view-tenth about-img-box">
                            <img src="{{url('media/images/home/about-us-img1.png')}}" alt="">
                            <div class="mask">

                                <p></p>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row p-b-20">
                    <div class="col-md-12 p-b-20">          
                        <h4 class="about-values-text">Our <span style="color:#f1292b;">Values</span></h4>
                    </div>
                    <div class="col-md-6">
                        <div class="about-v-box">
                            <h6>Quality</h6>
                            <p>-- We strive for continuous quality improvement in all that we do.</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="about-v-box">
                            <h6>Ambition</h6>
                            <p>-- We are ambitious both professionally and personally.</p>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="about-v-box">
                            <h6>Responsibility</h6>
                            <p>-- We are responsible in every sense – towards work, environment and clients.</p>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="about-v-box">
                            <h6>Cooperation</h6>
                            <p>-- We cooperate bringing out the best in each other and creating strong and successful working relationships.</p>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="about-v-box">
                            <h6>Trust</h6>
                            <p>-- We want an open, honest and realistic relationship with our customers, suppliers and each other.</p>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="about-v-box">
                            <h6>Innovation</h6>
                            <p>-- We aim to innovate, not replicate, and to address tomorrow's challenges today.</p>
                        </div>
                    </div>
                </div>
                <div class="row about-us-plans text-center">
                    <div class="col-xs-12 p-b-10">
                        <h4 style="padding-top:10px;">Our <span style="color:#f1292b;">Plans</span></h4>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="bg-v-grey">
                            <h5>Basic</h5>
                            <p>Online Flight Planning</p>
                            <p>FIC-ADC via SMS</p>
                            <p>iOS &amp; Android Mobile APP</p>
                            <p>Notams on Maps</p>
                            <p>Weather Decoded</p>
                            <p class="b-0">FDTL Offline Calculator</p>
                            <h6><a class="req-quote">Request Quote</a></h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="bg-v-grey">
                            <h5>Starter</h5>
                            <p>All Basic Plan Features Plus</p>
                            <p class="pad-lr-0">NAV LOG based on latest Winds</p>
                            <p>Unlimited Test Plans</p>
                            <p class="pad-lr-0">Load Trim as per approved format</p>
                            <p>Load Trim works offline in APP</p>
                            <p class="b-0">24 x 7 Dispatch Support</p>
                            <h6> <a class="req-quote" > Request Quote</a></h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="bg-v-grey">
                            <h5>Professional</h5>
                            <p>All Starter Plan Features Plus</p>
                            <p>APG Runway Analysis</p>
                            <p>Single Engine Procedure</p>
                            <p>8,500 Worldwide Airports</p>
                            <p>iPAD APP</p>
                            <p class="b-0">24 x 7 Dispatch Support</p>
                            <h6><a class="req-quote" >Request Quote</a></h6>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="bg-v-grey">
                            <h5>Premium</h5>
                            <p class="pad-lr-0">All Professional Plan Features Plus</p>
                            <p>Login Access to 2 Pilots</p>
                            <p>Perform NAV LOG, LOAD TRIM</p>
                            <p>Check RUNWAY ANANLYSIS</p>
                            <p>Dedicated Manager</p>
                            <p>24 x 7 Dispatch Support</p>
                            

                            <h6><a class="req-quote" >Request Quote</a></h6>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                        <div class="col-md-6 col-sm-6 about-us-video1">

                <img src="{{url('media/images/home/vimeo.png')}}" alt="" class="img-responsive abt-us-video-img">

                </div>
                <div class="col-md-6 col-sm-6 about-us-video2">
        <img src="{{url('media/images/home/vimeo.png')}}" alt="" class="img-responsive abt-us-video-img">
    </div>
                </div> -->
                <div class="row p-t-10">
                    <div class="col-md-12 text-justify">
                        <p><span style="color: #f1292b;font-size:14px;font-weight:bold">EFLIGHT</span> offers low operating and direct running cost with the highest cost/ benefit ratio among all our competitors. Get in touch with us to know more about why we are India’s No. 1 Domestic Trip Support Company &amp; how you can avail FREE 30 Day trial with No Obligation for Contract &amp; Zero Cancellation Fee.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>   
    @include('includes.new_footer',[])
</div>
@stop