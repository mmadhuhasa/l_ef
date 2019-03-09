@extends('layouts.new_index_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" href="{{url('app/new_temp/css/animate.css')}}">
<style>
    .cust-container {
        background: #ffffff;
        margin:20px auto;
        box-shadow: 0 0 3px 1px #999999;
    }
    .tp_main_heading {
        text-align: center;
        font-family:inherit;
        font-size: 36px;
        margin:0;
    }
    .tp_main_img {
        width: 70%;
        margin: 0 auto;
        moz-transition: 0.5s all ease;
        -o-transition: 0.5s all ease;
        -webkit-transition: 0.5s all ease;
        transition: 0.5s all ease;
    }
    .tp_main_img:hover, .tp_sec_img:hover {
        -moz-transform: scale(1.1);
        -ms-transform: scale(1.1);
        -o-transform: scale(1.1);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
        moz-transition: 0.5s all ease;
        -o-transition: 0.5s all ease;
        -webkit-transition: 0.5s all ease;
        transition: 0.5s all ease;
    }
    .color-red {
        color: #f1292b;
        font-weight: bold;
    }
    .tp_list li {
        list-style-image: url('media/images/tripsupport/bullet.png');
        font-size: 14px;
        font-weight: bold;
    }
    .tp_sec_img {
        width:90%;
        moz-transition: 0.5s all ease;
        -o-transition: 0.5s all ease;
        -webkit-transition: 0.5s all ease;
        transition: 0.5s all ease;
    }
    @media (max-width:768px) {
        .tp_main_img {
            width: 90%;
        }
        .tp_main_heading {
            font-size: 19px;
        }
    }
</style>

<div class="page" id="app">
    @include('includes.new_header',[])
    <main>
        <div class="container cust-container">
            <div class="row">
                <h1 class="tp_main_heading">INDIA'S # 1 TRIP SUPPORT COMPANY</h1>
            </div>
            <div class="row" style="margin-top:0;">
                <img class="img-responsive tp_main_img" src="{{url('media/images/tripsupport/tripsupport.png')}}">
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <p class="text-justify">As a small, mid-size or start-up airline or charter flight operator, you have probably discovered that it is time-consuming and difficult to stay up-to-date on all these issues, while remaining focused on your core business which is to fly safely & quickly. To make it even more difficult, every country's civil aviation authority, and even airports within India has its own set of policies, rules, and requirements.</p>
                    <p class="text-justify">You need a customizable and flexible trip-planning solution from <span class="color-red">EFLIGHT</span> that lets you focus on just flying, and which addresses your trip planning, dispatch, and fuelling requirements. Our 24 x 7 support team performs trip planning tasks in a coordinated environment for Last-minute changes or unforeseen events. These are just a few of the challenges you might face every day and this is where we bring our aviation expertise into your flights similar like how 40,000 flights have taken across India in the past 2 years. We fill any operational gaps and make your flights a little bit easier and smooth. Our services are tailored to each operator's policies and government regulations. We provide a full-featured Trip Support Service that can handle all your planning needs. We understand that Trip Support means more than completing just a checklist. It means proactively anticipating, staying on top of, and quickly adapting to whatever challenges may arise.</p>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-4">
                    <ul class="tp_list">
                        <li>TEST & LIVE FLIGHT PLANS</li>
                        <li>EFFECTIVE NOTAMS</li>
                        <li>LATEST WORLDWIDE WEATHER</li>
                        <li>OVERFLIGHT & LANDING PERMITS</li>
                        <li>WATCH HOURS EXTENSION</li>
                        <li>AOR & YA PERMITS</li>
                        <li>GROUND HANDLING</li>
                        <li>FUEL thru HP & BP</li>
                        <li>CORPORATE HOTEL RATES</li>
                        <li>PRE or POST FLIGHT MEDICAL</li>
                        <li>1 CONSOLIDATED BILL</li>
                        <li>14 DAYS CREDIT PERIOD</li>
                    </ul>
                </div>
                <div class="col-sm-8">
                    <img class="img-responsive tp_sec_img" src="{{url('media/images/tripsupport/tripsupport2.png')}}">
                </div>
                <div class="col-md-12">
                    <p class="text-justify"><span class="color-red">EFLIGHT</span> offers low operating and direct running cost with the highest cost/ benefit ratio among all our competitors. Get in touch with us to know more about why we are India’s No. 1 Domestic Trip Support Company & how you can avail FREE 30 Day trial with No Obligation for Contract & Zero Cancellation Fee.</p>
                </div>
            </div>
        </div>

    </main>
    @include('includes.new_footer',[])
</div>

@stop