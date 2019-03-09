@extends('layouts.new_weather_layout',array('1'=>'1'))
@section('content')
<div class="page">
    <style>
        table.dataTable thead .sorting, 
        table.dataTable thead .sorting_asc, 
        table.dataTable thead .sorting_desc {
            background : none;
        }
        .wheather_sec {
            background: #fff;
            margin-bottom: 25px;
        }
        .whe-header {
            background: linear-gradient(to right, #ffffff 0%, #e5e5e5 50%, #ffffff 100%);
        }
        .v_cust-container {
            background: #fff;
            box-shadow: 3px 3px 12px 0px #999;
        }
        .effect2 {
            box-shadow: none;
        }
        .border-rig {
            border-right:0;
        }
        .search-input {
            background: transparent;
        }
        .ifr-vfr {
            background:transparent;
            color: #000;
        }
        .search-input-btn {
            background: #000;
            transition: 0.5s all;
        }

    </style>
    @include('includes.new_header',[])
    <main>
        <!--========================================================
                             CONTENT
   =========================================================-->
        <section class="bg-1 welcome page-box">
            <div class="container v_cust-container">        
                <div class="row">
                    <div class="wheather_sec">
                        <div class="whe-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 col-lg-6 p-t-5 p-b-5 border-rig effect2">
                                <div class="col-xs-12 noleftpad norightpad">
                                    <span style="float:left"><i class="fa fa-plane fa-2x"></i></span>
                                    <p style="float:left"><span>VAAH</span><span>Sardar Vallabhbhai Patel Intternational Airport</span><p>
<!--                                    <span class="ifr-vfr">ifr</span>-->
                                </div>
<!--                                <div class="col-xs-12 col-sm-4 col-lg-6 bold  noleftpad norightpad" style="color:#333">
                                    <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                    <span class="size13"><b class="lorange">5:53</b> am IST</span>
                                    <span class="p-r-5 p-l-25"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                    <span class="size13"><b class="dorange">7:35</b> pm IST</span>
                                </div>-->
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-6 pull-right p-2">
                                <input type="text" class="search-input text-left" placeholder="ENTER ICAO CODE OF OTHER AIRPORTS FOR LATEST WEATHER" />
                                <span style="width:11%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>

                        </div>
                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-6 col-lg-6 border-rig effect1">
                                <div class="whe-left-col">
                                    <div class="col-xs-12 col-sm-12 col-lg-8 noleftpad norightpad">
                                        <div class="left-degr">
                                            <div class="col-xs-6 col-sm-7 col-lg-7 noleftpad norightpad">
                                                <div class="whe-image">
                                                    <div class="sunny img-responsive"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-lg-5 noleftpad norightpad">
                                                <div class="whe-temp"><span class="main-degree">30<sup>&deg;c</sup></span></div>
                                            </div>
                                        </div><!-- end of left-degr -->
                                        <div class="clearfix"></div>
                                        <div class="left-dgr-visi p-l-15">
                                            <div class="visibility">
                                                <p class="w30 fleft">Visibility</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                            <div class="clouds">
                                                <p class="w30 fleft">Clouds</p>
                                                <p class="w70 fright"><b>Few 365</b> m <br>
                                                    <b>Scattered Clouds</b> <b>2438</b>m </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pressure">
                                                <p class="w30 fleft">Pressure</p><p class="w70 fright"><b>1011</b> hpa</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="dewpoint">
                                                <p class="w30 fleft">Dew point</p><p class="w70 fright"><b>18</b> &deg;c</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="trend">
                                                <p class="w30 fleft">Trend</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                        </div><!-- left-dgr-visi -->
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-4 p-t-10 m-t-20-visible border-top-visible">
                                        <div class="windcirle-height">
                                            <div class="wind-info fleft">
                                                <div class="direction size12">
                                                    <p>11</p>
                                                </div>
                                                <div class="arrow">
                                                    <div class="circle"></div>                                                
                                                    <div class="triangle"></div>
                                                </div>
                                            </div><!-- end of wind-info -->
                                        </div>
                                        <div class="wind-text size13">Wind from <b>East</b></div>
                                    </div>




                                </div><!-- whe-left-col-->
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 noleftpad norightpad effect2">
                                <div class="wher-right-col">


                                    <div class="db-decode border-top-visible  p-10 p-l-15 size13 bold text-uppercase effect3">
                                            <!--<p>VAAH 190530Z 27007KT 5000 FU NSC 41/16 Q1001 NOSIG=</p>
                                        <p>TAF VAAH 190500Z 1906/2012 29008KT 6000 FEW080</p>
                                        <p class="p-l-25">BECMG 1912/1914 27005KT 4000 FU SCT100 </p>
                                        <p class="p-l-25"> BECMG 2001/2003 32005KT 3000 HZ FU</p> 
                                        <p class="p-l-25">BECMG 2004/2006 27008KT 6000 SCT080</p>-->
                                        <p class="p-t-210 p-b-10" style="min-height:50px;">metar 10:30 ist (0500 utc)</p>
                                        <p class="p-t-210 p-b-10" style="min-height:100px;">taf</p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="watch-row  border-top p-l-15">
                                        <!--<div class="col-xs-4 col-sm-5 col-lg-4 p-10">
                                        <p class="weekdays">Sun</p> 
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                            <span class="size12"><b class="lorange">5:53</b> am</span>
                                                
                                        </div>
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                            <span class="size12"><b class="dorange">7:35</b> pm</span>
                                                
                                        </div>
                                    </div>-->
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-10">
                                            <p class="weekdays p-b-10 dpink text-uppercase">Watch Hours</p> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink ">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end of wher-right-col -->
                            </div>
                        </div><!-- end of wheather_midd -->
                        <div class="clearfix"></div>
                        <div class="forecast border-top box-shadow">
                            <!--<div class="p-5 p-l-15 fore-head">Wheather Forecast</div>-->
                            <div class="col-xs-12 col-lg-12 p-t-210">
                                <div class="col-xs-12 col-lg-11 col-lg-offset-1">
                                    <!--<div class="col-xs-12 col-lg-2 noleftpad norightpad">-->
                                    <ul class="fcul">
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of first -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of second li -->
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of third li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fourth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fifth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of six li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of seven li -->

                                    </ul>
                                    <!-- </div>forect column -->                               

                                </div>
                            </div>
                        </div><!-- forecast -->
                    </div><!-- en dof wheather_sec -->
                </div><!-- end of row -->
                <div class="row">
                    <div class="wheather_sec">
                        <div class="whe-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 col-lg-6 p-t-5 p-b-5 border-rig effect2">
                                <div class="col-xs-12 col-sm-4 col-lg-6 noleftpad norightpad">
                                    <span><i class="fa fa-plane fa-2x"></i></span>
                                    <span class="p-l-5">HAL Bangalore</span>
                                    <span class="ifr-vfr">ifr</span>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-6 bold  noleftpad norightpad" style="color:#333">
                                    <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                    <span class="size13"><b class="lorange">5:53</b> am IST</span>
                                    <span class="p-r-5 p-l-25"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                    <span class="size13"><b class="dorange">7:35</b> pm IST</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-6 pull-right p-2">
                                <input type="text" class="search-input text-left" placeholder="ENTER ICAO CODE OF OTHER AIRPORTS FOR LATEST WEATHER" />
                                <span style="width:11%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>

                        </div>
                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-6 col-lg-6 border-rig effect1">
                                <div class="whe-left-col">
                                    <div class="col-xs-12 col-sm-12 col-lg-8 noleftpad norightpad">
                                        <div class="left-degr">
                                            <div class="col-xs-6 col-sm-7 col-lg-7 noleftpad norightpad">
                                                <div class="whe-image">
                                                    <div class="sunny img-responsive"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-lg-5 noleftpad norightpad">
                                                <div class="whe-temp"><span class="main-degree">30<sup>&deg;c</sup></span></div>
                                            </div>
                                        </div><!-- end of left-degr -->
                                        <div class="clearfix"></div>
                                        <div class="left-dgr-visi p-l-15">
                                            <div class="visibility">
                                                <p class="w30 fleft">Visibility</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                            <div class="clouds">
                                                <p class="w30 fleft">Clouds</p>
                                                <p class="w70 fright"><b>Few 365</b> m <br>
                                                    <b>Scattered Clouds</b> <b>2438</b>m </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pressure">
                                                <p class="w30 fleft">Pressure</p><p class="w70 fright"><b>1011</b> hpa</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="dewpoint">
                                                <p class="w30 fleft">Dew point</p><p class="w70 fright"><b>18</b> &deg;c</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="trend">
                                                <p class="w30 fleft">Trend</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                        </div><!-- left-dgr-visi -->
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-4 p-t-10 m-t-20-visible border-top-visible">
                                        <div class="windcirle-height">
                                            <div class="wind-info fleft">
                                                <div class="direction size12">
                                                    <p>11</p>
                                                </div>
                                                <div class="arrow">
                                                    <div class="circle"></div>                                                
                                                    <div class="triangle"></div>
                                                </div>
                                            </div><!-- end of wind-info -->
                                        </div>
                                        <div class="wind-text size13">Wind from <b>East</b></div>
                                    </div>




                                </div><!-- whe-left-col-->
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 noleftpad norightpad effect2">
                                <div class="wher-right-col">


                                    <div class="db-decode border-top-visible  p-10 p-l-15 size13 bold text-uppercase effect3">
                                            <!--<p>VAAH 190530Z 27007KT 5000 FU NSC 41/16 Q1001 NOSIG=</p>
                                        <p>TAF VAAH 190500Z 1906/2012 29008KT 6000 FEW080</p>
                                        <p class="p-l-25">BECMG 1912/1914 27005KT 4000 FU SCT100 </p>
                                        <p class="p-l-25"> BECMG 2001/2003 32005KT 3000 HZ FU</p> 
                                        <p class="p-l-25">BECMG 2004/2006 27008KT 6000 SCT080</p>-->
                                        <p class="p-t-210 p-b-10" style="min-height:50px;">metar 10:30 ist (0500 utc)</p>
                                        <p class="p-t-210 p-b-10" style="min-height:100px;">taf</p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="watch-row  border-top p-l-15">
                                        <!--<div class="col-xs-4 col-sm-5 col-lg-4 p-10">
                                        <p class="weekdays">Sun</p> 
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                            <span class="size12"><b class="lorange">5:53</b> am</span>
                                                
                                        </div>
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                            <span class="size12"><b class="dorange">7:35</b> pm</span>
                                                
                                        </div>
                                    </div>-->
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-10">
                                            <p class="weekdays p-b-10 dpink text-uppercase">Watch Hours</p> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink ">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end of wher-right-col -->
                            </div>
                        </div><!-- end of wheather_midd -->
                        <div class="clearfix"></div>
                        <div class="forecast border-top box-shadow">
                            <!--<div class="p-5 p-l-15 fore-head">Wheather Forecast</div>-->
                            <div class="col-xs-12 col-lg-12 p-t-210">
                                <div class="col-xs-12 col-lg-11 col-lg-offset-1">
                                    <!--<div class="col-xs-12 col-lg-2 noleftpad norightpad">-->
                                    <ul class="fcul">
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of first -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of second li -->
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of third li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fourth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fifth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of six li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of seven li -->

                                    </ul>
                                    <!-- </div>forect column -->                               

                                </div>
                            </div>
                        </div><!-- forecast -->
                    </div><!-- en dof wheather_sec -->
                </div><!-- end of row -->
                <div class="row">
                    <div class="wheather_sec">
                        <div class="whe-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 col-lg-6 p-t-5 p-b-5 border-rig effect2">
                                <div class="col-xs-12 col-sm-4 col-lg-6 noleftpad norightpad">
                                    <span><i class="fa fa-plane fa-2x"></i></span>
                                    <span class="p-l-5">HAL Bangalore</span>
                                    <span class="ifr-vfr">ifr</span>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-6 bold  noleftpad norightpad" style="color:#333">
                                    <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                    <span class="size13"><b class="lorange">5:53</b> am IST</span>
                                    <span class="p-r-5 p-l-25"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                    <span class="size13"><b class="dorange">7:35</b> pm IST</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-6 pull-right p-2">
                                <input type="text" class="search-input text-left" placeholder="ENTER ICAO CODE OF OTHER AIRPORTS FOR LATEST WEATHER" />
                                <span style="width:11%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>

                        </div>
                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-6 col-lg-6 border-rig effect1">
                                <div class="whe-left-col">
                                    <div class="col-xs-12 col-sm-12 col-lg-8 noleftpad norightpad">
                                        <div class="left-degr">
                                            <div class="col-xs-6 col-sm-7 col-lg-7 noleftpad norightpad">
                                                <div class="whe-image">
                                                    <div class="sunny img-responsive"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-lg-5 noleftpad norightpad">
                                                <div class="whe-temp"><span class="main-degree">30<sup>&deg;c</sup></span></div>
                                            </div>
                                        </div><!-- end of left-degr -->
                                        <div class="clearfix"></div>
                                        <div class="left-dgr-visi p-l-15">
                                            <div class="visibility">
                                                <p class="w30 fleft">Visibility</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                            <div class="clouds">
                                                <p class="w30 fleft">Clouds</p>
                                                <p class="w70 fright"><b>Few 365</b> m <br>
                                                    <b>Scattered Clouds</b> <b>2438</b>m </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pressure">
                                                <p class="w30 fleft">Pressure</p><p class="w70 fright"><b>1011</b> hpa</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="dewpoint">
                                                <p class="w30 fleft">Dew point</p><p class="w70 fright"><b>18</b> &deg;c</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="trend">
                                                <p class="w30 fleft">Trend</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                        </div><!-- left-dgr-visi -->
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-4 p-t-10 m-t-20-visible border-top-visible">
                                        <div class="windcirle-height">
                                            <div class="wind-info fleft">
                                                <div class="direction size12">
                                                    <p>11</p>
                                                </div>
                                                <div class="arrow">
                                                    <div class="circle"></div>                                                
                                                    <div class="triangle"></div>
                                                </div>
                                            </div><!-- end of wind-info -->
                                        </div>
                                        <div class="wind-text size13">Wind from <b>East</b></div>
                                    </div>




                                </div><!-- whe-left-col-->
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 noleftpad norightpad effect2">
                                <div class="wher-right-col">


                                    <div class="db-decode border-top-visible  p-10 p-l-15 size13 bold text-uppercase effect3">
                                            <!--<p>VAAH 190530Z 27007KT 5000 FU NSC 41/16 Q1001 NOSIG=</p>
                                        <p>TAF VAAH 190500Z 1906/2012 29008KT 6000 FEW080</p>
                                        <p class="p-l-25">BECMG 1912/1914 27005KT 4000 FU SCT100 </p>
                                        <p class="p-l-25"> BECMG 2001/2003 32005KT 3000 HZ FU</p> 
                                        <p class="p-l-25">BECMG 2004/2006 27008KT 6000 SCT080</p>-->
                                        <p class="p-t-210 p-b-10" style="min-height:50px;">metar 10:30 ist (0500 utc)</p>
                                        <p class="p-t-210 p-b-10" style="min-height:100px;">taf</p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="watch-row  border-top p-l-15">
                                        <!--<div class="col-xs-4 col-sm-5 col-lg-4 p-10">
                                        <p class="weekdays">Sun</p> 
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                            <span class="size12"><b class="lorange">5:53</b> am</span>
                                                
                                        </div>
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                            <span class="size12"><b class="dorange">7:35</b> pm</span>
                                                
                                        </div>
                                    </div>-->
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-10">
                                            <p class="weekdays p-b-10 dpink text-uppercase">Watch Hours</p> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink ">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end of wher-right-col -->
                            </div>
                        </div><!-- end of wheather_midd -->
                        <div class="clearfix"></div>
                        <div class="forecast border-top box-shadow">
                            <!--<div class="p-5 p-l-15 fore-head">Wheather Forecast</div>-->
                            <div class="col-xs-12 col-lg-12 p-t-210">
                                <div class="col-xs-12 col-lg-11 col-lg-offset-1">
                                    <!--<div class="col-xs-12 col-lg-2 noleftpad norightpad">-->
                                    <ul class="fcul">
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of first -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of second li -->
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of third li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fourth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fifth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of six li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of seven li -->

                                    </ul>
                                    <!-- </div>forect column -->                               

                                </div>
                            </div>
                        </div><!-- forecast -->
                    </div><!-- en dof wheather_sec -->
                </div><!-- end of row -->
                <div class="row">
                    <div class="wheather_sec">
                        <div class="whe-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 col-lg-6 p-t-5 p-b-5 border-rig effect2">
                                <div class="col-xs-12 col-sm-4 col-lg-6 noleftpad norightpad">
                                    <span><i class="fa fa-plane fa-2x"></i></span>
                                    <span class="p-l-5">HAL Bangalore</span>
                                    <span class="ifr-vfr">ifr</span>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-6 bold  noleftpad norightpad" style="color:#333">
                                    <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                    <span class="size13"><b class="lorange">5:53</b> am IST</span>
                                    <span class="p-r-5 p-l-25"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                    <span class="size13"><b class="dorange">7:35</b> pm IST</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-6 pull-right p-2">
                                <input type="text" class="search-input text-left" placeholder="ENTER ICAO CODE OF OTHER AIRPORTS FOR LATEST WEATHER" />
                                <span style="width:11%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>

                        </div>
                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-6 col-lg-6 border-rig effect1">
                                <div class="whe-left-col">
                                    <div class="col-xs-12 col-sm-12 col-lg-8 noleftpad norightpad">
                                        <div class="left-degr">
                                            <div class="col-xs-6 col-sm-7 col-lg-7 noleftpad norightpad">
                                                <div class="whe-image">
                                                    <div class="sunny img-responsive"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-lg-5 noleftpad norightpad">
                                                <div class="whe-temp"><span class="main-degree">30<sup>&deg;c</sup></span></div>
                                            </div>
                                        </div><!-- end of left-degr -->
                                        <div class="clearfix"></div>
                                        <div class="left-dgr-visi p-l-15">
                                            <div class="visibility">
                                                <p class="w30 fleft">Visibility</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                            <div class="clouds">
                                                <p class="w30 fleft">Clouds</p>
                                                <p class="w70 fright"><b>Few 365</b> m <br>
                                                    <b>Scattered Clouds</b> <b>2438</b>m </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pressure">
                                                <p class="w30 fleft">Pressure</p><p class="w70 fright"><b>1011</b> hpa</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="dewpoint">
                                                <p class="w30 fleft">Dew point</p><p class="w70 fright"><b>18</b> &deg;c</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="trend">
                                                <p class="w30 fleft">Trend</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                        </div><!-- left-dgr-visi -->
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-4 p-t-10 m-t-20-visible border-top-visible">
                                        <div class="windcirle-height">
                                            <div class="wind-info fleft">
                                                <div class="direction size12">
                                                    <p>11</p>
                                                </div>
                                                <div class="arrow">
                                                    <div class="circle"></div>                                                
                                                    <div class="triangle"></div>
                                                </div>
                                            </div><!-- end of wind-info -->
                                        </div>
                                        <div class="wind-text size13">Wind from <b>East</b></div>
                                    </div>




                                </div><!-- whe-left-col-->
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 noleftpad norightpad effect2">
                                <div class="wher-right-col">


                                    <div class="db-decode border-top-visible  p-10 p-l-15 size13 bold text-uppercase effect3">
                                            <!--<p>VAAH 190530Z 27007KT 5000 FU NSC 41/16 Q1001 NOSIG=</p>
                                        <p>TAF VAAH 190500Z 1906/2012 29008KT 6000 FEW080</p>
                                        <p class="p-l-25">BECMG 1912/1914 27005KT 4000 FU SCT100 </p>
                                        <p class="p-l-25"> BECMG 2001/2003 32005KT 3000 HZ FU</p> 
                                        <p class="p-l-25">BECMG 2004/2006 27008KT 6000 SCT080</p>-->
                                        <p class="p-t-210 p-b-10" style="min-height:50px;">metar 10:30 ist (0500 utc)</p>
                                        <p class="p-t-210 p-b-10" style="min-height:100px;">taf</p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="watch-row  border-top p-l-15">
                                        <!--<div class="col-xs-4 col-sm-5 col-lg-4 p-10">
                                        <p class="weekdays">Sun</p> 
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                            <span class="size12"><b class="lorange">5:53</b> am</span>
                                                
                                        </div>
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                            <span class="size12"><b class="dorange">7:35</b> pm</span>
                                                
                                        </div>
                                    </div>-->
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-10">
                                            <p class="weekdays p-b-10 dpink text-uppercase">Watch Hours</p> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink ">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end of wher-right-col -->
                            </div>
                        </div><!-- end of wheather_midd -->
                        <div class="clearfix"></div>
                        <div class="forecast border-top box-shadow">
                            <!--<div class="p-5 p-l-15 fore-head">Wheather Forecast</div>-->
                            <div class="col-xs-12 col-lg-12 p-t-210">
                                <div class="col-xs-12 col-lg-11 col-lg-offset-1">
                                    <!--<div class="col-xs-12 col-lg-2 noleftpad norightpad">-->
                                    <ul class="fcul">
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of first -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of second li -->
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of third li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fourth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fifth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of six li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of seven li -->

                                    </ul>
                                    <!-- </div>forect column -->                               

                                </div>
                            </div>
                        </div><!-- forecast -->
                    </div><!-- en dof wheather_sec -->
                </div><!-- end of row -->
                <div class="row">
                    <div class="wheather_sec">
                        <div class="whe-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 col-lg-6 p-t-5 p-b-5 border-rig effect2">
                                <div class="col-xs-12 col-sm-4 col-lg-6 noleftpad norightpad">
                                    <span><i class="fa fa-plane fa-2x"></i></span>
                                    <span class="p-l-5">HAL Bangalore</span>
                                    <span class="ifr-vfr">ifr</span>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-6 bold  noleftpad norightpad" style="color:#333">
                                    <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                    <span class="size13"><b class="lorange">5:53</b> am IST</span>
                                    <span class="p-r-5 p-l-25"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                    <span class="size13"><b class="dorange">7:35</b> pm IST</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-6 pull-right p-2">
                                <input type="text" class="search-input text-left" placeholder="ENTER ICAO CODE OF OTHER AIRPORTS FOR LATEST WEATHER" />
                                <span style="width:11%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>

                        </div>
                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-6 col-lg-6 border-rig effect1">
                                <div class="whe-left-col">
                                    <div class="col-xs-12 col-sm-12 col-lg-8 noleftpad norightpad">
                                        <div class="left-degr">
                                            <div class="col-xs-6 col-sm-7 col-lg-7 noleftpad norightpad">
                                                <div class="whe-image">
                                                    <div class="sunny img-responsive"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-lg-5 noleftpad norightpad">
                                                <div class="whe-temp"><span class="main-degree">30<sup>&deg;c</sup></span></div>
                                            </div>
                                        </div><!-- end of left-degr -->
                                        <div class="clearfix"></div>
                                        <div class="left-dgr-visi p-l-15">
                                            <div class="visibility">
                                                <p class="w30 fleft">Visibility</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                            <div class="clouds">
                                                <p class="w30 fleft">Clouds</p>
                                                <p class="w70 fright"><b>Few 365</b> m <br>
                                                    <b>Scattered Clouds</b> <b>2438</b>m </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pressure">
                                                <p class="w30 fleft">Pressure</p><p class="w70 fright"><b>1011</b> hpa</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="dewpoint">
                                                <p class="w30 fleft">Dew point</p><p class="w70 fright"><b>18</b> &deg;c</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="trend">
                                                <p class="w30 fleft">Trend</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                        </div><!-- left-dgr-visi -->
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-4 p-t-10 m-t-20-visible border-top-visible">
                                        <div class="windcirle-height">
                                            <div class="wind-info fleft">
                                                <div class="direction size12">
                                                    <p>11</p>
                                                </div>
                                                <div class="arrow">
                                                    <div class="circle"></div>                                                
                                                    <div class="triangle"></div>
                                                </div>
                                            </div><!-- end of wind-info -->
                                        </div>
                                        <div class="wind-text size13">Wind from <b>East</b></div>
                                    </div>




                                </div><!-- whe-left-col-->
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 noleftpad norightpad effect2">
                                <div class="wher-right-col">


                                    <div class="db-decode border-top-visible  p-10 p-l-15 size13 bold text-uppercase effect3">
                                            <!--<p>VAAH 190530Z 27007KT 5000 FU NSC 41/16 Q1001 NOSIG=</p>
                                        <p>TAF VAAH 190500Z 1906/2012 29008KT 6000 FEW080</p>
                                        <p class="p-l-25">BECMG 1912/1914 27005KT 4000 FU SCT100 </p>
                                        <p class="p-l-25"> BECMG 2001/2003 32005KT 3000 HZ FU</p> 
                                        <p class="p-l-25">BECMG 2004/2006 27008KT 6000 SCT080</p>-->
                                        <p class="p-t-210 p-b-10" style="min-height:50px;">metar 10:30 ist (0500 utc)</p>
                                        <p class="p-t-210 p-b-10" style="min-height:100px;">taf</p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="watch-row  border-top p-l-15">
                                        <!--<div class="col-xs-4 col-sm-5 col-lg-4 p-10">
                                        <p class="weekdays">Sun</p> 
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                            <span class="size12"><b class="lorange">5:53</b> am</span>
                                                
                                        </div>
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                            <span class="size12"><b class="dorange">7:35</b> pm</span>
                                                
                                        </div>
                                    </div>-->
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-10">
                                            <p class="weekdays p-b-10 dpink text-uppercase">Watch Hours</p> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink ">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end of wher-right-col -->
                            </div>
                        </div><!-- end of wheather_midd -->
                        <div class="clearfix"></div>
                        <div class="forecast border-top box-shadow">
                            <!--<div class="p-5 p-l-15 fore-head">Wheather Forecast</div>-->
                            <div class="col-xs-12 col-lg-12 p-t-210">
                                <div class="col-xs-12 col-lg-11 col-lg-offset-1">
                                    <!--<div class="col-xs-12 col-lg-2 noleftpad norightpad">-->
                                    <ul class="fcul">
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of first -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of second li -->
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of third li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fourth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of fifth li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of six li -->

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                        <!-- end of seven li -->

                                    </ul>
                                    <!-- </div>forect column -->                               

                                </div>
                            </div>
                        </div><!-- forecast -->
                    </div><!-- en dof wheather_sec -->
                </div><!-- end of row -->

            </div>
        </section>

<!--        <section class="bg-1 welcome page-box">
            <div class="container">        
                <div class="row">
                    <div class="wheather_sec">
                        <div class="whe-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 col-lg-8" style="padding-top:5px; padding-bottom:5px;">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <span><i class="fa fa-plane fa-2x"></i></span>
                                    <span class="p-l-5">HAL Bangalore</span>
                                    <span class="ifr-vfr">ifr</span>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-7 bold" style="color:"#333;">
                                    <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                    <span class="size13"><b class="lorange">5:53</b> am IST</span>
                                    <span class="p-r-5 p-l-25"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                    <span class="size13"><b class="dorange">7:35</b> pm IST</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4 pull-right norightpad">
                                    <input type="text" class="search-input text-left" placeholder="search for new weather" />
                                    <span style="width:15%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>

                        </div>
                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-6 col-lg-6 border-rig effect1">
                                <div class="whe-left-col">
                                    <div class="col-xs-12 col-sm-12 col-lg-8 noleftpad norightpad">
                                        <div class="left-degr">
                                            <div class="col-xs-6 col-sm-7 col-lg-7 noleftpad norightpad">
                                                <div class="whe-image">
                                                    <div class="sunny img-responsive"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-lg-5 noleftpad norightpad">
                                                <div class="whe-temp"><span class="main-degree">30<sup>&deg;c</sup></span></div>
                                            </div>
                                        </div> end of left-degr 
                                        <div class="clearfix"></div>
                                        <div class="left-dgr-visi p-l-15">
                                            <div class="visibility">
                                                <p class="w30 fleft">Visibility</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                            <div class="clouds">
                                                <p class="w30 fleft">Clouds</p>
                                                <p class="w70 fright"><b>Few 365</b> m <br>
                                                    <b>Scattered Clouds</b> <b>2438</b>m </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pressure">
                                                <p class="w30 fleft">Pressure</p><p class="w70 fright"><b>1011</b> hpa</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="dewpoint">
                                                <p class="w30 fleft">Dew point</p><p class="w70 fright"><b>18</b> &deg;c</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="trend">
                                                <p class="w30 fleft">Trend</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                        </div> left-dgr-visi 
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-4 p-t-10 m-t-20-visible border-top-visible">
                                        <div class="windcirle-height">
                                            <div class="wind-info fleft">
                                                <div class="direction size12">
                                                    <p>11</p>
                                                </div>
                                                <div class="arrow">
                                                    <div class="circle"></div>                                                
                                                    <div class="triangle"></div>
                                                </div>
                                            </div> end of wind-info 
                                        </div>
                                        <div class="wind-text size13">Wind from <b>East</b></div>
                                    </div>




                                </div> whe-left-col
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 noleftpad norightpad effect2">
                                <div class="wher-right-col">


                                    <div class="db-decode border-top-visible  p-10 p-l-15 size13 bold text-uppercase effect3">
                                            <p>VAAH 190530Z 27007KT 5000 FU NSC 41/16 Q1001 NOSIG=</p>
                                        <p>TAF VAAH 190500Z 1906/2012 29008KT 6000 FEW080</p>
                                        <p class="p-l-25">BECMG 1912/1914 27005KT 4000 FU SCT100 </p>
                                        <p class="p-l-25"> BECMG 2001/2003 32005KT 3000 HZ FU</p> 
                                        <p class="p-l-25">BECMG 2004/2006 27008KT 6000 SCT080</p>
                                        <p class="p-t-210 p-b-10" style="min-height:50px;">metar 10:30 ist (0500 utc)</p>
                                        <p class="p-t-210 p-b-10" style="min-height:100px;">taf</p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="watch-row  border-top p-l-15">
                                        <div class="col-xs-4 col-sm-5 col-lg-4 p-10">
                                        <p class="weekdays">Sun</p> 
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                            <span class="size12"><b class="lorange">5:53</b> am</span>
                                                
                                        </div>
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                            <span class="size12"><b class="dorange">7:35</b> pm</span>
                                                
                                        </div>
                                    </div>
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-10">
                                            <p class="weekdays p-b-10 dpink text-uppercase">Watch Hours</p> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink ">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> end of wher-right-col 
                            </div>
                        </div> end of wheather_midd 
                        <div class="clearfix"></div>
                        <div class="forecast border-top box-shadow">
                            <div class="p-5 p-l-15 fore-head">Wheather Forecast</div>
                            <div class="col-xs-12 col-lg-12 p-t-210">
                                <div class="col-xs-12 col-lg-11 col-lg-offset-1">
                                    <div class="col-xs-12 col-lg-2 noleftpad norightpad">
                                    <ul class="fcul">
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of first 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of second li 
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of third li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of fourth li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of fifth li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of six li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of seven li 

                                    </ul>
                                     </div>forect column                                

                                </div>
                            </div>
                        </div> forecast 
                    </div> en dof wheather_sec 
                </div> end of row 
            </div>
        </section>



        <section class="bg-1 welcome page-box">
            <div class="container">        
                <div class="row">
                    <div class="wheather_sec">
                        <div class="whe-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 col-lg-8" style="padding-top:5px; padding-bottom:5px;">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <span><i class="fa fa-plane fa-2x"></i></span>
                                    <span class="p-l-5">HAL Bangalore</span>
                                    <span class="ifr-vfr">ifr</span>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-7 bold" style="color:"#333;">
                                    <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                    <span class="size13"><b class="lorange">5:53</b> am IST</span>
                                    <span class="p-r-5 p-l-25"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                    <span class="size13"><b class="dorange">7:35</b> pm IST</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4 pull-right norightpad">
                                    <input type="text" class="search-input text-left" placeholder="search for new weather" />
                                    <span style="width:15%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>

                        </div>
                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-6 col-lg-6 border-rig effect1">
                                <div class="whe-left-col">
                                    <div class="col-xs-12 col-sm-12 col-lg-8 noleftpad norightpad">
                                        <div class="left-degr">
                                            <div class="col-xs-6 col-sm-7 col-lg-7 noleftpad norightpad">
                                                <div class="whe-image">
                                                    <div class="sunny img-responsive"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-lg-5 noleftpad norightpad">
                                                <div class="whe-temp"><span class="main-degree">30<sup>&deg;c</sup></span></div>
                                            </div>
                                        </div> end of left-degr 
                                        <div class="clearfix"></div>
                                        <div class="left-dgr-visi p-l-15">
                                            <div class="visibility">
                                                <p class="w30 fleft">Visibility</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                            <div class="clouds">
                                                <p class="w30 fleft">Clouds</p>
                                                <p class="w70 fright"><b>Few 365</b> m <br>
                                                    <b>Scattered Clouds</b> <b>2438</b>m </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pressure">
                                                <p class="w30 fleft">Pressure</p><p class="w70 fright"><b>1011</b> hpa</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="dewpoint">
                                                <p class="w30 fleft">Dew point</p><p class="w70 fright"><b>18</b> &deg;c</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="trend">
                                                <p class="w30 fleft">Trend</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                        </div> left-dgr-visi 
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-4 p-t-10 m-t-20-visible border-top-visible">
                                        <div class="windcirle-height">
                                            <div class="wind-info fleft">
                                                <div class="direction size12">
                                                    <p>11</p>
                                                </div>
                                                <div class="arrow">
                                                    <div class="circle"></div>                                                
                                                    <div class="triangle"></div>
                                                </div>
                                            </div> end of wind-info 
                                        </div>
                                        <div class="wind-text size13">Wind from <b>East</b></div>
                                    </div>




                                </div> whe-left-col
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 noleftpad norightpad effect2">
                                <div class="wher-right-col">


                                    <div class="db-decode border-top-visible  p-10 p-l-15 size13 bold text-uppercase effect3">
                                            <p>VAAH 190530Z 27007KT 5000 FU NSC 41/16 Q1001 NOSIG=</p>
                                        <p>TAF VAAH 190500Z 1906/2012 29008KT 6000 FEW080</p>
                                        <p class="p-l-25">BECMG 1912/1914 27005KT 4000 FU SCT100 </p>
                                        <p class="p-l-25"> BECMG 2001/2003 32005KT 3000 HZ FU</p> 
                                        <p class="p-l-25">BECMG 2004/2006 27008KT 6000 SCT080</p>
                                        <p class="p-t-210 p-b-10" style="min-height:50px;">metar 10:30 ist (0500 utc)</p>
                                        <p class="p-t-210 p-b-10" style="min-height:100px;">taf</p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="watch-row  border-top p-l-15">
                                        <div class="col-xs-4 col-sm-5 col-lg-4 p-10">
                                        <p class="weekdays">Sun</p> 
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                            <span class="size12"><b class="lorange">5:53</b> am</span>
                                                
                                        </div>
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                            <span class="size12"><b class="dorange">7:35</b> pm</span>
                                                
                                        </div>
                                    </div>
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-10">
                                            <p class="weekdays p-b-10 dpink text-uppercase">Watch Hours</p> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink ">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> end of wher-right-col 
                            </div>
                        </div> end of wheather_midd 
                        <div class="clearfix"></div>
                        <div class="forecast border-top box-shadow">
                            <div class="p-5 p-l-15 fore-head">Wheather Forecast</div>
                            <div class="col-xs-12 col-lg-12 p-t-210">
                                <div class="col-xs-12 col-lg-11 col-lg-offset-1">
                                    <div class="col-xs-12 col-lg-2 noleftpad norightpad">
                                    <ul class="fcul">
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of first 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of second li 
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of third li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of fourth li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of fifth li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of six li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of seven li 

                                    </ul>
                                     </div>forect column                                

                                </div>
                            </div>
                        </div> forecast 
                    </div> en dof wheather_sec 
                </div> end of row 
            </div>
        </section>



        <section class="bg-1 welcome page-box">
            <div class="container">        
                <div class="row">
                    <div class="wheather_sec">
                        <div class="whe-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 col-lg-8" style="padding-top:5px; padding-bottom:5px;">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <span><i class="fa fa-plane fa-2x"></i></span>
                                    <span class="p-l-5">HAL Bangalore</span>
                                    <span class="ifr-vfr">ifr</span>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-7 bold" style="color:"#333;">
                                    <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                    <span class="size13"><b class="lorange">5:53</b> am IST</span>
                                    <span class="p-r-5 p-l-25"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                    <span class="size13"><b class="dorange">7:35</b> pm IST</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4 pull-right norightpad">
                                    <input type="text" class="search-input text-left" placeholder="search for new weather" />
                                    <span style="width:15%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>

                        </div>
                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-6 col-lg-6 border-rig effect1">
                                <div class="whe-left-col">
                                    <div class="col-xs-12 col-sm-12 col-lg-8 noleftpad norightpad">
                                        <div class="left-degr">
                                            <div class="col-xs-6 col-sm-7 col-lg-7 noleftpad norightpad">
                                                <div class="whe-image">
                                                    <div class="sunny img-responsive"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-lg-5 noleftpad norightpad">
                                                <div class="whe-temp"><span class="main-degree">30<sup>&deg;c</sup></span></div>
                                            </div>
                                        </div> end of left-degr 
                                        <div class="clearfix"></div>
                                        <div class="left-dgr-visi p-l-15">
                                            <div class="visibility">
                                                <p class="w30 fleft">Visibility</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                            <div class="clouds">
                                                <p class="w30 fleft">Clouds</p>
                                                <p class="w70 fright"><b>Few 365</b> m <br>
                                                    <b>Scattered Clouds</b> <b>2438</b>m </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pressure">
                                                <p class="w30 fleft">Pressure</p><p class="w70 fright"><b>1011</b> hpa</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="dewpoint">
                                                <p class="w30 fleft">Dew point</p><p class="w70 fright"><b>18</b> &deg;c</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="trend">
                                                <p class="w30 fleft">Trend</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                        </div> left-dgr-visi 
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-4 p-t-10 m-t-20-visible border-top-visible">
                                        <div class="windcirle-height">
                                            <div class="wind-info fleft">
                                                <div class="direction size12">
                                                    <p>11</p>
                                                </div>
                                                <div class="arrow">
                                                    <div class="circle"></div>                                                
                                                    <div class="triangle"></div>
                                                </div>
                                            </div> end of wind-info 
                                        </div>
                                        <div class="wind-text size13">Wind from <b>East</b></div>
                                    </div>




                                </div> whe-left-col
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 noleftpad norightpad effect2">
                                <div class="wher-right-col">


                                    <div class="db-decode border-top-visible  p-10 p-l-15 size13 bold text-uppercase effect3">
                                            <p>VAAH 190530Z 27007KT 5000 FU NSC 41/16 Q1001 NOSIG=</p>
                                        <p>TAF VAAH 190500Z 1906/2012 29008KT 6000 FEW080</p>
                                        <p class="p-l-25">BECMG 1912/1914 27005KT 4000 FU SCT100 </p>
                                        <p class="p-l-25"> BECMG 2001/2003 32005KT 3000 HZ FU</p> 
                                        <p class="p-l-25">BECMG 2004/2006 27008KT 6000 SCT080</p>
                                        <p class="p-t-210 p-b-10" style="min-height:50px;">metar 10:30 ist (0500 utc)</p>
                                        <p class="p-t-210 p-b-10" style="min-height:100px;">taf</p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="watch-row  border-top p-l-15">
                                        <div class="col-xs-4 col-sm-5 col-lg-4 p-10">
                                        <p class="weekdays">Sun</p> 
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                            <span class="size12"><b class="lorange">5:53</b> am</span>
                                                
                                        </div>
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                            <span class="size12"><b class="dorange">7:35</b> pm</span>
                                                
                                        </div>
                                    </div>
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-10">
                                            <p class="weekdays p-b-10 dpink text-uppercase">Watch Hours</p> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink ">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> end of wher-right-col 
                            </div>
                        </div> end of wheather_midd 
                        <div class="clearfix"></div>
                        <div class="forecast border-top box-shadow">
                            <div class="p-5 p-l-15 fore-head">Wheather Forecast</div>
                            <div class="col-xs-12 col-lg-12 p-t-210">
                                <div class="col-xs-12 col-lg-11 col-lg-offset-1">
                                    <div class="col-xs-12 col-lg-2 noleftpad norightpad">
                                    <ul class="fcul">
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of first 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of second li 
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of third li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of fourth li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of fifth li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of six li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of seven li 

                                    </ul>
                                     </div>forect column                                

                                </div>
                            </div>
                        </div> forecast 
                    </div> en dof wheather_sec 
                </div> end of row 
            </div>
        </section>



        <section class="bg-1 welcome page-box">
            <div class="container">        
                <div class="row">
                    <div class="wheather_sec">
                        <div class="whe-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 col-lg-8" style="padding-top:5px; padding-bottom:5px;">
                                <div class="col-xs-12 col-sm-4 col-lg-4">
                                    <span><i class="fa fa-plane fa-2x"></i></span>
                                    <span class="p-l-5">HAL Bangalore</span>
                                    <span class="ifr-vfr">ifr</span>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-lg-7 bold" style="color:"#333;">
                                    <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                    <span class="size13"><b class="lorange">5:53</b> am IST</span>
                                    <span class="p-r-5 p-l-25"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                    <span class="size13"><b class="dorange">7:35</b> pm IST</span>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-4 pull-right norightpad">
                                    <input type="text" class="search-input text-left" placeholder="search for new weather" />
                                    <span style="width:15%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>

                        </div>
                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-6 col-lg-6 border-rig effect1">
                                <div class="whe-left-col">
                                    <div class="col-xs-12 col-sm-12 col-lg-8 noleftpad norightpad">
                                        <div class="left-degr">
                                            <div class="col-xs-6 col-sm-7 col-lg-7 noleftpad norightpad">
                                                <div class="whe-image">
                                                    <div class="sunny img-responsive"></div>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-5 col-lg-5 noleftpad norightpad">
                                                <div class="whe-temp"><span class="main-degree">30<sup>&deg;c</sup></span></div>
                                            </div>
                                        </div> end of left-degr 
                                        <div class="clearfix"></div>
                                        <div class="left-dgr-visi p-l-15">
                                            <div class="visibility">
                                                <p class="w30 fleft">Visibility</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                            <div class="clouds">
                                                <p class="w30 fleft">Clouds</p>
                                                <p class="w70 fright"><b>Few 365</b> m <br>
                                                    <b>Scattered Clouds</b> <b>2438</b>m </p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="pressure">
                                                <p class="w30 fleft">Pressure</p><p class="w70 fright"><b>1011</b> hpa</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="dewpoint">
                                                <p class="w30 fleft">Dew point</p><p class="w70 fright"><b>18</b> &deg;c</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="trend">
                                                <p class="w30 fleft">Trend</p><p class="w70 fright"><b>10.0</b> kilometers</p>
                                            </div>
                                        </div> left-dgr-visi 
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-lg-4 p-t-10 m-t-20-visible border-top-visible">
                                        <div class="windcirle-height">
                                            <div class="wind-info fleft">
                                                <div class="direction size12">
                                                    <p>11</p>
                                                </div>
                                                <div class="arrow">
                                                    <div class="circle"></div>                                                
                                                    <div class="triangle"></div>
                                                </div>
                                            </div> end of wind-info 
                                        </div>
                                        <div class="wind-text size13">Wind from <b>East</b></div>
                                    </div>




                                </div> whe-left-col
                            </div>
                            <div class="col-xs-12 col-sm-6 col-lg-6 noleftpad norightpad effect2">
                                <div class="wher-right-col">


                                    <div class="db-decode border-top-visible  p-10 p-l-15 size13 bold text-uppercase effect3">
                                            <p>VAAH 190530Z 27007KT 5000 FU NSC 41/16 Q1001 NOSIG=</p>
                                        <p>TAF VAAH 190500Z 1906/2012 29008KT 6000 FEW080</p>
                                        <p class="p-l-25">BECMG 1912/1914 27005KT 4000 FU SCT100 </p>
                                        <p class="p-l-25"> BECMG 2001/2003 32005KT 3000 HZ FU</p> 
                                        <p class="p-l-25">BECMG 2004/2006 27008KT 6000 SCT080</p>
                                        <p class="p-t-210 p-b-10" style="min-height:50px;">metar 10:30 ist (0500 utc)</p>
                                        <p class="p-t-210 p-b-10" style="min-height:100px;">taf</p>
                                    </div>

                                    <div class="clearfix"></div>
                                    <div class="watch-row  border-top p-l-15">
                                        <div class="col-xs-4 col-sm-5 col-lg-4 p-10">
                                        <p class="weekdays">Sun</p> 
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/nor-sun.png')}}" alt="nor-sun" /></span>
                                            <span class="size12"><b class="lorange">5:53</b> am</span>
                                                
                                        </div>
                                        <div>
                                                <span class="p-r-5"><img src="{{url('media/whe-icons/too-hot.png')}}" /></span>
                                            <span class="size12"><b class="dorange">7:35</b> pm</span>
                                                
                                        </div>
                                    </div>
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-10">
                                            <p class="weekdays p-b-10 dpink text-uppercase">Watch Hours</p> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink ">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div> 
                                            <div class="size12 dpink">
                                                <span>MON = </span>
                                                <span>0000 to 1230 IST and 0000 to 1230 IST</span>
                                            </div>
                                        </div>
                                    </div>
                                </div> end of wher-right-col 
                            </div>
                        </div> end of wheather_midd 
                        <div class="clearfix"></div>
                        <div class="forecast border-top box-shadow">
                            <div class="p-5 p-l-15 fore-head">Wheather Forecast</div>
                            <div class="col-xs-12 col-lg-12 p-t-210">
                                <div class="col-xs-12 col-lg-11 col-lg-offset-1">
                                    <div class="col-xs-12 col-lg-2 noleftpad norightpad">
                                    <ul class="fcul">
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of first 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of second li 
                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of third li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of fourth li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of fifth li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of six li 

                                        <li>
                                            <div class="forectcolumn">
                                                <h4 class="size14 text-center text-capitalize border-bot m-0 normal">Mon <span class="p-l-5">05/07</span></h4>
                                                <div class="fc-temp text-center">
                                                    <span class="hightemp dpink size13 p-r-5">30&deg;c</span> | 
                                                    <span class="lowtemp sky-blue size13 p-l-5">30&deg;c</span>
                                                </div>
                                                <div class="tc-temp-image text-center">
                                                    <img src="{{url('media/whe-icons/thunderstorm.png')}}" alt="thunderstorm" />
                                                </div>
                                                <div class="fc-name sky-blue text-center">
                                                    Thunderstrom
                                                </div>
                                            </div>
                                        </li>
                                         end of seven li 

                                    </ul>
                                     </div>forect column                                

                                </div>
                            </div>
                        </div> forecast 
                    </div> en dof wheather_sec 
                </div> end of row 
            </div>
        </section>-->



    </main>   
    @include('includes.new_footer',[])
</div>
@stop