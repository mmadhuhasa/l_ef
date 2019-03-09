@extends('layouts.navlog_layout',array('1'=>'1'))
@section('content')


<div class="page">  
    @include('includes.new_header',[])
    <main>

        <!--========================================================
                              CONTENT
    =========================================================-->
        <section class="bg-1 welcome weather-page">
            <div class="container">
                <div class="row">
                    <div class="">
                        <div class="col-xs-12 col-md-4 noleftpad">
                            <div class="effect1 leftcontent">
                                <div class="navlog-header" style="padding:0px;">
                                    <div class="col-xs-12 col-sm-12 p-5 p-l-10">
                                        <!-- <span><i class="fa fa-plane fa-2x"></i></span> -->
                                        <!-- <span class="p-l-5" style="color:#ff0000;font-weight:bold">VTVAU</span>&nbsp;&nbsp; -->
                                        <div class="w30 pull-left" style="line-height:25px;">nav log </div>
                                        <div class="w70 pull-left p-l-20 p-r-10">
                                            <div class="form-group m-0">
                                                <div class="input-group">
                                                    <input type="text" class="form-control text_uppercase alphabets font-bold"  placeholder="Search" style="height:25px;">
                                                    <div class="input-group-addon search-addon p-0"  style="border:none;">
                                                        <button type="submit" name="flag" value="search" class="searchicon-button btn btn__secondary"><span class="glyphicon glyphicon-search"></span></button>
                                                    </div>
                                                </div>
                                            </div></div>
                                               <!--  <span><a class="loadtrim-save-buttom" href="#">SAVE</a></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="#" class="loadtrim-print-buttom">PRINT</a></span> -->
                                    </div>
                                </div><!-- end of laodtrim-header -->
                                <div class="clearfix"></div>
                                <div class="trimandplane" style="width:100%; float:left;">
                                    <form id="trim_setting_calculation">
                                        <div class="col-xs-12 col-sm-12 col-lg-12  p-t-20 p-b-20">


                                            <div class="form-row">
                                                <div class="form-search-row-left lt-tac">
                                                    <div class="form-group">
                                                        <input required type="text" data-toggle="popover" data-placement="bottom" minlength="4" 
                                                               maxlength="" class="text-center font-bold text_uppercase  form-control"
                                                               placeholder="call sign" id="dow_weight">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                    <input type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control"
                                                        placeholder="Bags" id="bag_weight">
                                                </div> -->
                                                </div>
                                                <div class="form-search-row-right lt-tac">                                          
                                                    <div class="form-group">
                                                        <input type="text" data-toggle="popover" data-placement="bottom"  class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip"
                                                               placeholder="From" tabindex="1" >

                                                    </div>



                                                </div>
                                                <div class="form-search-row-right1 lt-tac">
                                                    <div class="form-group">
                                                        <input type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control"
                                                               placeholder="To" >
                                                    </div>
                                                </div>
                                            </div>





                                            <div class="form-row">
                                                <div class="form-search-row-left lt-tac">
                                                    <div class="form-group relative">

                                                        <textarea  autocomplete="off" class="form-control text-center font-bold from_date datepicker pointer hasDatepicker" name="from_date" id="from_date" minlength="6" maxlength="6" tabindex="5" readonly></textarea>
							<img class="ui-datepicker-trigger" src="{{url('media/images/from-icon.PNG')}}"  alt="..." title="...">	

                                                        <!--<label class="labelplaceholder">Flight Date</label>-->
                                                    </div>
                                                </div>
                                                <div class="form-search-row-right lt-tac">
                                                    <div class="form-group relative">

							<textarea placeholder="Time (UTC)"  autocomplete="off" class="clock form-control text-center font-bold datepicker pointer hasDatepicker" name="from_date" id="from_date" minlength="6" maxlength="6" tabindex="5" readonly></textarea>
							<i class="fa fa-clock-o ui-clock-trigger"></i>


                                                        <!--<label class="labelplaceholder">Time (UTC)</label>-->
                                                    </div>
                                                </div>
                                                <div class="form-search-row-right1 lt-tac">
                                                    <div class="form-group">
                                                        <input type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control"
                                                               placeholder="ALTN">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <input required type="text" data-toggle="popover" data-placement="bottom" minlength="" maxlength="" class="text-center font-bold text_uppercase  form-control"
                                                           placeholder="Main route">
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-search-row-left lt-tac">
                                                    <div class="form-group">
                                                        <input required type="text" data-toggle="popover" data-placement="bottom" minlength="4" 
                                                               maxlength="" class="text-center font-bold text_uppercase  form-control"
                                                               placeholder="flight level">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                    <input type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control"
                                                        placeholder="Bags" id="bag_weight">
                                                </div> -->
                                                </div>
                                                <div class="form-search-row-right lt-tac">                                          
                                                    <div class="form-group">
                                                        <input type="text" data-toggle="popover" data-placement="bottom"  class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip"
                                                               placeholder="No. of PAX">

                                                    </div>



                                                </div>
                                                <div class="form-search-row-right1 lt-tac">
                                                    <div class="form-group">
                                                        <input type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control"
                                                               placeholder="total load" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <input required type="text" data-toggle="popover" data-placement="bottom" minlength="" maxlength="" class="text-center font-bold text_uppercase  form-control"
                                                           placeholder="ALTN route">
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="form-row">
                                                <div class="form-search-row-left lt-tac">
                                                    <div class="form-group">
                                                        <input required type="text" data-toggle="popover" data-placement="bottom" minlength="4" 
                                                               maxlength="" class="text-center font-bold text_uppercase  form-control"
                                                               placeholder="ALTn level">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                    <input type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control"
                                                        placeholder="Bags" id="bag_weight">
                                                </div> -->
                                                </div>
                                                <div class="form-search-row-right lt-tac">                                          
                                                    <div class="form-group">
                                                        <input type="text" data-toggle="popover" data-placement="bottom"  class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip"
                                                               placeholder="Fuel">

                                                    </div>



                                                </div>
                                                <div class="form-search-row-right1 lt-tac">
                                                    <div class="form-group">
                                                        <input type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control"
                                                               placeholder="cruise" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <input required type="text" data-toggle="popover" data-placement="bottom" minlength="" maxlength="" class="text-center font-bold text_uppercase  form-control"
                                                           placeholder="PIC">
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div class="form-row">
                                                <div class="form-group">
                                                    <input required type="text" data-toggle="popover" data-placement="bottom" minlength="" maxlength="" class="text-center font-bold text_uppercase  form-control"
                                                           placeholder="co pilot">
                                                </div>
                                            </div>

                                            <div class="form-row" style="padding:0px 30%;">
                                                <div class="form-group" style="padding:18px 0px;">
                                                    <input type="button" value="request plan" class="trimcalc-btn">
                                                </div>
                                            </div>



                                            <div class="clearfix"></div>
                                            <div class="form-row hidden">
                                                <div class="form-search-row-left w50">
                                                    <div class="form-group"  data-toggle="modal" data-target="#xmlrestbtn"   style="padding:18px 0px;">
                                                        <input type="button" value="reset" class="trimcalc-btn">
                                                    </div>
                                                    <!-- <div class="form-group">
                                                    <input type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control"
                                                        placeholder="Bags" id="bag_weight">
                                                </div> -->
                                                </div>
                                                <div class="form-search-row-right w50">
                                                    <div class="form-group"  data-toggle="modal" data-target="#xmlfileplan" style="padding:18px 0px;">
                                                        <input type="button" value="file plan" class="trimcalc-btn">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-row hidden"  style="padding:0px 30%;">
                                                <div class="form-group" data-toggle="modal" data-target="#xmlplannext" style="padding:18px 0px;">
                                                    <input type="button" value="plan next" class="trimcalc-btn">
                                                </div>
                                            </div>




                                            <!-- <div class="form-row">
                                                    <div class="form-search-row-left">
                                                         <div class="form-group">
                                                            <input type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control"
                                                                placeholder="PIC Name" id="pic_name">
                                                        </div> 
                                                    </div>
                                                    <div class="form-search-row-right">
                                                         <div class="form-group">
                                                            <input required type="text" data-toggle="popover" data-placement="bottom" minlength="4" maxlength="4" class="text-center font-bold text_uppercase  form-control"
                                                                placeholder="CO Pilotname" id="sic_name">
                                                        </div> 
                                                    </div>
                                                </div> -->

                                        </div>
                                    </form>
                                </div><!-- end of trimandplane -->
                            </div><!-- end of column -->
                        </div><!-- end of leftcontent -->
                        <div class="col-xs-12 col-md-8 noleftpad norightpad">                        
                            <div class="effect1 rightcontent">
                                @if(1)
                                <div class="navlogdata">
                                    <div class="navlog-header" style="padding:0px;">
                                        <div class="col-xs-12 col-sm-12 p-r-10">
                                            <!-- <span><i class="fa fa-plane fa-2x"></i></span> -->
                                            <!-- <span class="p-l-5" style="color:#ff0000;font-weight:bold">VTVAU</span>&nbsp;&nbsp; -->
                                            <span style="width:22%;float:left;">Vabb to vidp</span>
                                            <span style="width:34%;float:left;" class="text-center">flight date: 05-jul-2015</span>
                                            <span style="width:42%;float:left;" class="text-right">departure time: 1000 (utc) 1530 (ist)</span>
                                           <!--  <span><a class="loadtrim-save-buttom" href="#">SAVE</a></span>&nbsp;&nbsp;&nbsp;&nbsp;<span><a href="#" class="loadtrim-print-buttom">PRINT</a></span> -->
                                        </div>
                                    </div><!-- end of laodtrim-header -->
                                    <div class="clearfix"></div>
                                    <!--                                <div class="trim-graph" >
                                                                        <img src="{{url('media/images/xml-receipt.png')}}" class=" box-shadow" alt="xml-receipt" />
                                                                    </div> end of trim-graph -->


                                    <div class="tabs animated-slide-2">
                                        <ul class="tab-links">

                                            <li id="navlog"><a class="active" href="#tab1">NAV LOG</a></li>

                                            <li id="trim" class=""><a href="#tab2">LOAD TRIM</a></li>

                                            <li id="notams" class=""><a href="#tab3">NOTAMS</a></li>
                                            <li id="weather" class=""><a href="#tab4">WEATHER</a></li>
                                            <li id="fdtl" class=""><a href="#tab5">FDTL</a></li>
                                            <li id="airport" class=""><a href="#tab6">AIRPORT</a></li>
                                        </ul>

                                        <div class="tabs-downarrow"></div>

                                        <div class="tab-content">
                                            <div id="tab1" class="tab active">
                                                <p>Tab #1 content goes here!</p>
                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                            </div>

                                            <div id="tab2" class="tab">
                                                <p>Tab #2 content goes here!</p>
                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>
                                            </div>

                                            <div id="tab3" class="tab">
                                                <p>Tab #3 content goes here!</p>
                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>
                                            </div>


                                            <div id="tab4" class="tab">
                                                <p>Tab #4 content goes here!</p>
                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>
                                            </div>


                                            <div id="tab5" class="tab">
                                                <p>Tab #5 content goes here!</p>
                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>
                                            </div>

                                            <div id="tab6" class="tab">
                                                <p>Tab #6 content goes here!</p>
                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>

                                                <p style="padding:5px 0px;">Donec pulvinar neque sed semper lacinia. Curabitur lacinia ullamcorper nibh; quis imperdiet velit eleifend ac. Donec blandit mauris eget aliquet lacinia! Donec pulvinar massa interdum risus ornare mollis.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end of navlog data -->
                                @else
                                <div class="flightanimation" style="width:100%; background-color: #fff; min-height: 500px;">
                                    <img src="{{url('media/images/flightanimation.gif')}}" alt="flightanimation" style="position: absolute; top:40%; left:33%;" />                               

                                </div><!-- end of navlog data -->
                                @endif
                            </div>
                        </div><!-- end of rightcontent -->


                    </div>
                </div>
            </div>
        </section>


    </main>

    @include('includes.new_footer',[])

    @include('includes.xml_reset',[])
</div>
@stop