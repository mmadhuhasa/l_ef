@extends('layouts.new_index_layout',array('1'=>'1'))
@section('content')
<div class="page" id="app">


    <style>
        .fa-spinner:hover{color: grey !important}
        .fa-spinner{color: #f1292b !important}
        @media (min-width:1200px) {
            .container {
                width: 1000px;
            }
        }
        ul.read-list {
            font-weight: bold;
        }
        .cust-video {
            position:relative;
            width:100%;
            height:0;
            padding-bottom:56.27198%;
            margin-bottom: 15px;
        }
        .cust-video iframe{
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:100%;
        }
    </style>

    @include('includes.new_header',[])

    <main>
        <section>
            <div class="flexslider">
                <ul class="slides hidden">
                     <li>
                        <img src="{{url('media/images/home/new-airbus.png')}}">
                        <p class="flex-caption">AWARDED FOR GPS IOS & ANDROID APP</p>
                    </li>
                    <li>
                        <img src="{{url('media/images/home/banner_v02.jpg')}}">

                        <p class="flex-caption" style="text-transform: uppercase">                          
                            AIRBUS BIZLAB 6 MONTHS ACCELERATION PROGRAM
                        </p>
                    </li>
                    <li>
                        <img src="{{url('media/images/home/banner-1.jpg')}}">

                        <p class="flex-caption">INDIA'S # 1 TRIP SUPPORT COMPANY</p>
                    </li>
                    <li>
                        <img src="{{url('media/images/home/banner-2-a.jpg')}}">
                        <p class="flex-caption">PLAN ON LAPTOP, MOBILE &amp; TABLET</p>
                    </li>
                    <li>
                        <img src="{{url('media/images/home/banner-3.jpg')}}">
                        <p class="flex-caption">MADE IN INDIA &amp; GOING GLOBAL</p>
                    </li>
                    <li>
                        <img src="{{url('media/images/home/banner-9.jpg')}}">
                        <p class="flex-caption">TRY FREE 30 DAY TRIAL OFFER</p>
                    </li>
                </ul>
                <div class="loader_img" id="loader_img" width="100%" style="width: 100%;height: 100%;text-align: center;margin-top: 100px"><a href="#"><img src="{{url('media/images/home/loader.gif')}}" alt="loader" class="img-responsive"></a></div>
            </div>
            <!--<div class="camera_container">
                <div id="camera" class="camera_wrap">
                     <div data-src="{{url('app/new_temp/images/banner-1.jpg')}}">
                        <div class="camera_caption fadeIn">
                           India's # 1 Full Trip Support Company
                        </div>
                    </div>
                    <div data-src="{{url('app/new_temp/images/banner-2-a.jpg')}}">
                        <div class="camera_caption fadeIn">
                            PLAN &nbsp; FILE on Laptop, Tablet &nbsp; Mobile
                        </div>
                    </div>
                   
                    <div data-src="{{url('app/new_temp/images/banner-3.jpg')}}">
                        <div class="camera_caption fadeIn">
                           NOTAMS on Map with Email &nbsp; SMS alert
                        </div>
                    </div>
                    <div data-src="{{url('app/new_temp/images/banner-4.jpg')}}">
                        <div class="camera_caption fadeIn">
                           Over 75 Airports Weather with ATIS
                        </div>
                    </div>                  
                </div>
            </div>-->
        </section>
        <!--  <div style="background:#eeeeee;"> -->
        <section class="well bg-1 welcome">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="background:#ffffff;padding:10px 15px 30px 15px;border-top:1px solid #ccc;border-right:1px solid #ccc;border-left:1px solid #ccc;">
                        <h2 class="home-cb">Trip Planning Made Easy</h2>

                        <p class="home-cb">With a vision to provide Simple, Fast &amp; Cost-Saving Trip Support Service for Business Aviation in India, EFLIGHT has launched 1st patented one-stop solution that allows a Pilot to easily plan, log &amp; fly more safely. Pilots in Business Aviation end up doing more planning work before every Flight such as Filing Plan with ATC, Obtaining Clearance, Coordinating with Ground Handler, Booking Hotel, Arranging Fuel and manually prepare NAV LOG, LOAD TRIM Sheet plus still ensure that plan times are within stipulated Flying Duty Limits !!!</p>
                        <p class="home-cb">Now using a Laptop, Tablet or Smart Phone, a Business Aviation Pilot can access our cloud hosted website, iOS &amp; Android APP 24 x 7 &amp; easily perform calculations that gives precise Fuel Burn based on latest forecasted winds within seconds plus allows to file ATC Plan online &amp; receive FIC-ADC via SMS to any airport in India!! Filtered relevant NOTAMs that are plotted on a Map for easy understanding along with METAR, TAF &amp; ATIS are just a click away. FDTL calculations are instantly thrown up when ATC FPL is planned and even when departure time is revised, duty time limit is again performed &amp; awaits further action by Pilot if any violation is found.</p>
                        <p class="home-cb">Last minute change in PAX numbers or Fuel, common in business flights, can now be easily handled with our offline Load Trim APP. Calculations are customised to specific weight of Aircraft and print out is in same format as approved by DGCA for each Operator.</p>
                        <p class="home-cb">Sign up for FREE 30 Day trial and experience simplified trip support services and start saving from next flight thru our aggregator business model. <a data-toggle="modal" data-target="#welcontent" class="btn-2 read-btn"><span style="font-size:16px"> Read More >></span></a></p>
                    </div>
                    <!-- <div class="col-lg-4 col-md-5 col-sm-4  col-xs-12 text-right text-xs-center ins1 btn-group">
                        <a href="#" class="btn btn__secondary"><span>About us</span></a>
                        <a href="#" class="btn btn__primary"><span>Services</span></a>
                    </div> -->
                </div>
            </div>
        </section>

        <section class="well-1 cstwell text-xs-center" style="padding-bottom:0px">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 home-border-lr" style="background:#ffffff;padding-bottom:15px;">
                        <div class="row">

                            <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay=".3s">
                                <article>
                                    <img src="{{url('media/images/home/page-1_img001.png')}}" alt="" class="img-style">
                                </article>
                                <h3 class="home-cb">Online FPL</h3>
                                <ul class="marked-list read-list home-cb">
                                    <li>Connected via AFTN to AAI Airports</li>
                                    <li>Receive FIC-ADC via SMS</li>  
                                    <li>Stores Old Plans up to 1 year</li>

                                    <li>Easily Edit Old Plan &amp; File in Seconds</li>
                                    <li>Revise Time Online or thru Dispatch SMS</li>	

                                </ul>
                                <!-- <div class="clearfix"></div>
                    <a data-toggle="modal" data-target="#onlinefpl" class="btn-2 read-btn">Read More >></a> -->
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay=".6s">
                                <article> 
                                    <img src="{{url('media/images/home/page-1_img002.png')}}" alt="" class="img-style">
                                </article>
                                <h3 class="home-cb">NOTAMS</h3>

                                <ul class="marked-list read-list home-cb">
                                    <li>Plots Notams on Google Aviation Map</li>    
                                    <li>Decoded Notams of all Indian Airports</li>	
                                    <li>New Notams Notifications via email</li>
                                    <li>Lookup for future dates Notams</li>
                                    <li>Check Notams for Routes, Watch Hours etc</li>
                                </ul>
                                <!-- <div class="clearfix"></div>
                                <a data-toggle="modal" data-target="#navload" class="btn-2 read-btn">Read More >></a> -->
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay=".9s">
                                <article>
                                    <img src="{{url('media/images/home/page-1_img003.png')}}" alt="" class="img-style">
                                </article>
                                <h3 class="home-cb">WEATHER</h3>
                                <ul class="marked-list read-list home-cb">		   
                                    <li>Latest Decoded METAR, TAF &amp; ATIS</li>
                                    <li>Updates via SMS during bad weather flights</li>
                                    <li>Upper Wind Temp Charts</li>				    
                                    <li>Local Area Forecasts </li>
                                    <li>Animated Satellite Images</li>                      
                                </ul>
                                <!-- <div class="clearfix"></div>
                                <a data-toggle="modal" data-target="#fdtl" class="btn-2 read-btn">Read More >></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:0">
                    <div class="col-md-12 home-border-lr" style="background:#ffffff;padding-bottom:30px;">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay=".3s">
                                <article>
                                    <img src="{{url('media/images/home/page-1_img004.png')}}" alt="" class="img-style">
                                </article>
                                <h3 class="home-cb">FDTL</h3>
                                <ul class="marked-list read-list home-cb">         
                                    <li>For Fixed Wing, Helicopters &amp; Cabin Crew</li>
                                    <li>Calculates for Domestic &amp; Intl Flights</li>
                                    <li>Get last Take Off &amp; Next Day earliest Take Off</li>                 
                                    <li>Predicts possible solution to avoid Violations</li>
                                    <li>Enter Flight Time Offline &amp; auto sync via APP</li>                      
                                </ul>
                                <!-- <div class="clearfix"></div>
                                <a data-toggle="modal" data-target="#fdtl" class="btn-2 read-btn">Read More >></a> -->
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay=".6s">
                                <article>
                                    <img src="{{url('media/images/home/page-1_img005.png')}}" alt="" class="img-style">
                                </article>
                                <h3 class="home-cb">NAV LOG</h3>
                                <ul class="marked-list read-list home-cb">         
                                    <li>Most Precise Fuel Burn Calculations</li>
                                    <li>Indicates Max &amp; Min Fuel required</li>
                                    <li>Historical Winds of last 30 years Stored</li>                 
                                    <li>SID &amp; STAR points included in Route check</li>
                                    <li>Customised for each Aircraft Performance</li>                      
                                </ul>
                                <!-- <div class="clearfix"></div>
                                <a data-toggle="modal" data-target="#fdtl" class="btn-2 read-btn">Read More >></a> -->
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-delay=".9s">
                                <article>
                                    <img src="{{url('media/images/home/page-1_img006.png')}}" alt="" class="img-style">
                                </article>
                                <h3 class="home-cb">LOAD TRIM</h3>
                                <ul class="marked-list read-list home-cb">         
                                    <li>Offline &amp; Online Calculation thru APP</li>
                                    <li>Print out same as approved DGCA format</li>
                                    <li>Auto sync NAV LOG values to avoid entries</li>                 
                                    <li>Interactive C.G. Graph that gives rich insights</li>
                                    <li>User friendly design that outputs in seconds</li>   
                                </ul>
                                <!-- <div class="clearfix"></div>
                                <a data-toggle="modal" data-target="#fdtl" class="btn-2 read-btn">Read More >></a> -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section class="well-2 cst-well bg-default " style="background:#eeeeee;padding:0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 home-border-lr" style="background:#ffffff;padding-bottom:30px;">
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <h5 class="text-center" style="color: #f1292b;margin:0;font-weight: bold; font-size: 16px;">FLIGHT PLANNING VIDEO</h5>
                                <div class="embed-responsive embed-responsive-4by3 cust-video">
                                    <div class="cust-video"><iframe width='560' height='315' src="https://www.youtube.com/embed/J5OpH-D9IfU?&theme=light&autohide=1&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe></div><div style='font-size: 0.8em'></div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <h5 class="text-center" style="color: #f1292b;margin:0;font-weight: bold; font-size: 16px;">TRIP SUPPORT VIDEO</h5>
                                <div class="embed-responsive embed-responsive-4by3 cust-video">
                                    <div class="cust-video"><iframe width='560' height='315' src="https://www.youtube.com/embed/Rw8l1wAI5Pw?&theme=light&autohide=1&showinfo=0&rel=0" frameborder="0" allowfullscreen></iframe></div><div style='font-size: 0.8em'></div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- <section class="well nobtmborder">
            <div class="container">
                <h3 class="text-center">NOTAMS</h3>

                <div class="row">
                    <div class="col-md-3 wow fadeInUp" data-wow-delay=".3s">
                        <h6>VIDF</h6>
                        <ul class="marked-list">
                            <li><a data-toggle="modal" data-target="#a0277">A0277/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0270">A0270/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0264">A0264/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0212">A0212/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0203">A0203/16</a></li>

                        </ul>
                    </div>

                    <div class="col-md-3 wow fadeInUp" data-wow-delay=".6s">
                        <h6>VABF</h6>
                        <ul class="marked-list">
                            <li><a data-toggle="modal" data-target="#a0363">A0363/16</a></li>

                            <li><a data-toggle="modal" data-target="#a0342">A0342/16</a> </li>
                            <li><a data-toggle="modal" data-target="#a0339">A0339/16</a> </li>
                            <li><a data-toggle="modal" data-target="#a0266">A0266/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0129">A0129/16</a> </li>

                        </ul>
                    </div>

                    <div class="col-md-3 wow fadeInUp" data-wow-delay=".9s">
                        <h6>VOMF</h6>
                        <ul class="marked-list">
                            <li><a data-toggle="modal" data-target="#a0571">A0571/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0568">A0568/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0552">A0552/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0550">A0550/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0548">A0548/16</a></li>

                        </ul>
                    </div>

                    <div class="col-md-3 wow fadeInUp" data-wow-delay="1.2s">
                        <h6>VECC</h6>
                        <ul class="marked-list">
                            <li><a data-toggle="modal" data-target="#a0556">A0556/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0486">A0486/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0468">A0468/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0429">A0429/16</a></li>
                            <li><a data-toggle="modal" data-target="#a0187">A0187/16</a></li>

                        </ul>
                    </div>
                </div>
            </div>
        </section> -->

        <section class="well nobtmborder bg-default" style="background:#eeeeee;border:none;box-shadow:none;padding:0">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 home-border-lr" style="background:#ffffff">
                        <h3 class="text-center home-cb"><span style="text-transform:capitalize">Why Choose</span> EFLIGHT</h3>

                        <div class="row">
                            <div class="col-md-3 wow fadeInRight" data-wow-delay=".3s">
                                <h4 class="home-cb">Plan &amp; Fly Safe</h4>

                                <p class="home-cb" style="text-align:justify">
                                    <small>Fast, intuitive, web-based tool that assesses weather conditions, generates flight routes and files flight plans online from any internet connected device to all Airports in India connected via AFTN within seconds and also send ADC thru SMS. Created to simplify and automate the entire flight planning process to make flying more safer.
                                    </small>
                                </p>
                                <!-- <a href="#" class="btn-2">read more >></a> -->
                            </div>
                            <div class="col-md-3 wow fadeInRight" data-wow-delay=".6s">
                                <h4 class="home-cb">Made for India</h4>

                                <p class="home-cb" style="text-align:justify">
                                    <small>Think globally, act locally has been the mantra for the last 2 years in development. With feedback from Pilots who wish to see an Indian company offer solution customised to varied Indian region needs, we are proud to offer Patented One-Stop Solution for both Pre &amp; Post Flight Services. Experience India’s 1st iOS &amp; Android APP exclusive for business aviation pilots.
                                    </small>
                                </p>
                                <!-- <a href="#" class="btn-2">read more >></a> -->
                            </div>
                            <div class="col-md-3 wow fadeInRight" data-wow-delay=".9s">
                                <h4 class="home-cb">Cost Savings</h4>

                                <p class="home-cb" style="text-align:justify">
                                    <small>Unlike Global Companies who charge for worldwide subscription, we tailor make service cost thereby giving at least 50% savings plus billing in Indian Rupee. Our integrated planning system reduces operating costs and ensures successful trips from beginning to end to any Airport in India. Get in touch with us today to know more about how you can start savings from the very next flight.
                                    </small>
                                </p>
                                <!-- <a href="#" class="btn-2">read more >></a> -->
                            </div>
                            <div class="col-md-3 wow fadeInRight" data-wow-delay="1.2s">
                                <h4 class="home-cb">24 x 7 Support</h4>

                                <p class="home-cb" style="text-align:justify">
                                    <small>Our Support Team consists of FAA certified dispatchers &amp; CPL holders, who are just a Phone call away anytime of the day to help you process plans, file &amp; obtain clearance numbers. Our other mode of contacts can be even via Email or SMS or WhatsApp.
                                    </small>
                                </p>
                                <!-- <a href="#" class="btn-2">read more >></a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--<section class="parallax well-4" data-url="{{url('app/new_temp/images/parallax2.jpg')}}" data-mobile="true">
            <div class="container white">
                <ul class="row index-list">
                    <li class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft">
                        <h2 class="white">Fuel Filling</h2>
                        <h6 class="white">We are the leading providers of comprehensive environmental solutions </h6>

                        <p>Every day throughout the UK we deliver energy management services to meet the energy
                            challenges faced by our customers across industry and the public sector. From industrial
                            manufacturing to hospitals, educational facilities to district heating networks, our energy
                            expertise permits our clients to focus on their core business while helping them attain
                            their energy performance and environmental targets.</p>

                        
                        <a href="#" class="btn btn__secondary"><span>Learn more</span></a>
                    </li>
                    <li class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight">
                        <h2 class="white">Hazardous waste</h2>
                        <h6 class="white">We offer efficient recycling and <br>
                            waste management services </h6>

                        <p>To achieve the best results from our integrated approach to waste  management, we have
                            invested in a nationwide infrastructure to support our  recycling, collection, treatment,
                            recovery and disposal activities.  </p>

                        <a href="#" class="btn btn__secondary"><span>Learn more</span></a>
                    </li>
                </ul>
            </div>
        </section>-->

        <section class="well-5 bg-default client-row" style="background:#eeeeee;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 home-border-lr" style="background:#ffffff;border-bottom:1px solid #ccc;margin-bottom: 10px;">
                        <h3 class="text-center home-cb">Our Clients</h3>
                        <div class="client-slider"> 
                            <div class="clients_wrapper">
                                <ul id="carousel">
                                    <li class="img-responsive client-logo client-logo1"></li>
                                    <li class="img-responsive client-logo client-logo2"></li>
                                    <li class="img-responsive client-logo client-logo3"></li>
                                    <!--                                    <li class="img-responsive client-logo client-logo4"></li>-->
                                    <li class="img-responsive client-logo client-logo5"></li>
                                    <!--                                    <li class="img-responsive client-logo client-logo6"></li>-->
                                    <li class="img-responsive client-logo client-logo7"></li>
                                    <!--                                    <li class="img-responsive client-logo client-logo8"></li>-->
                                    <li class="img-responsive client-logo client-logo9"></li>
                                    <li class="img-responsive client-logo client-logo10"></li>
                                    <li class="img-responsive client-logo client-logo11"></li>
                                    <!--                                    <li class="img-responsive client-logo client-logo12"></li>-->
                                    <li class="img-responsive client-logo client-logo13"></li>
                                    <li class="img-responsive client-logo client-logo14"></li>
                                    <li class="img-responsive client-logo client-logo15"></li>
                                    <li class="img-responsive client-logo client-logo16"></li>
                                    <li class="img-responsive client-logo client-logo17"></li>
                                    <li class="img-responsive client-logo client-logo18"></li>
                                    <li class="img-responsive client-logo client-logo19"></li>
                                    <li class="img-responsive client-logo client-logo20"></li>
                                    <li class="img-responsive client-logo client-logo21"></li>
                                    <li class="img-responsive client-logo client-logo22"></li>
                                    <li class="img-responsive client-logo client-logo23"></li>
                                    <li class="img-responsive client-logo client-logo24"></li>
                                    <li class="img-responsive client-logo client-logo25"></li>
                                </ul>
                            </div>
                        </div>
                    </div>           
                </div>
            </div>
        </section>
        <!-- </div> -->

        <!-- <section class="well">
            <div class="container text-center">
                <h2>News</h2>
                <div class="row wow fadeInLeft">
                    <div class="col-md-4 col-sm-4 col-xs-12"> -->
        <!--<article>
            <img src="{{url('app/new_temp/images/jobs.jpg')}}" alt="">
           
        </article>-->
        <!-- <article>
            <div class="view view-tenth">
                <img src="{{url('app/new_temp/images/jobs.jpg')}}" alt="">
                <div class="mask">
                    <h2>Aviation News</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <a href="#" class="info">Read More</a>
                </div>
            </div>
        </article>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-12">
        <article> -->
<!--                           <img src="{{url('app/new_temp/images/crew_lease.jpg')}}" alt="">-->
        <!-- <div class="view view-tenth">
            <img src="{{url('app/new_temp/images/crew_lease.jpg')}}" alt="">
            <div class="mask">
                <h2>Crew Lease</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a class="info">Read More</a>
            </div>
        </div>
    </article>
</div>
<div class="col-md-4 col-sm-4 col-xs-12">
    <article> -->
<!--                           <img src="{{url('app/new_temp/images/empty_flights.jpg')}}" alt="">
        -->                          
        <!-- <div class="view view-tenth">
            <img src="{{url('app/new_temp/images/empty_flights.jpg')}}" alt="">
            <div class="mask">
                <h2>Empty Charter Flights</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#" class="info">Read More</a>
            </div>
        </div>
    </article>
</div>
</div>
<div class="row wow fadeInRight">
<div class="col-md-4 col-sm-4 col-xs-12">
    <article> -->
        <!--<img src="{{url('app/new_temp/images/charter.jpg')}}" alt="">-->
        <!-- <div class="view view-tenth">
            <img src="{{url('app/new_temp/images/charter.jpg')}}" alt="">
            <div class="mask">
                <h2>Private Charter Flights</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#" class="info">Read More</a>
            </div>
        </div>
    </article>
</div>
<div class="col-md-4 col-sm-4 col-xs-12">
    <article> -->
        <!--<img src="{{url('app/new_temp/images/aircraft_sale.jpg')}}" alt="">-->
        <!-- <div class="view view-tenth">
            <img src="{{url('app/new_temp/images/aircraft_sale.jpg')}}" alt="">
            <div class="mask">
                <h2>Aircraft Management Solution</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#" class="info">Read More</a>
            </div>
        </div>
    </article>
</div>

<div class="col-md-4 col-sm-4 col-xs-12">
    <article> -->
        <!--<img src="{{url('app/new_temp/images/Events.jpg')}}" alt="">-->
        <!-- <div class="view view-tenth">
            <img src="{{url('app/new_temp/images/Events.jpg')}}" alt="">
            <div class="mask">
                <h2>Upcoming Aero Events</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#" class="info">Read More</a>
            </div>
        </div>
    </article>
</div>
</div>
</div>
</section> -->


    </main>
    @include('includes.new_footer',[])
   
</div>
@stop
