@extends('layouts.lnt_layout',array('1'=>'1'))
@section('content')
<div class="page">
    @include('includes.new_fpl_header',[])
    <main>
	<section class="bg-1 welcome weather-page">
            <div class="container">        
                <div class="row">
                    <div class="full-contentbox">

                        <div class="laodtrim-header border-bot effect1" style="padding:0px;">
                            <div class="col-xs-12 col-sm-12 p-10">
                                <span><i class="fa fa-plane fa-2x"></i></span>
                                <span class="p-l-5">Load & Trim</span>
                            </div>
                            <!--<div class="col-xs-12 col-sm-4 col-lg-4 pull-right norightpad">
                                    <input type="text" class="search-input text-left" placeholder="search for new weather" />
                                    <span style="width:15%; float:right;"><i class="fa fa-search search-input-btn"></i></span>
                            </div>-->

                        </div>

                        <div class="clearfix"></div>

                        <div class="wheather_midd box-shadow">
                            <div class="col-xs-12 col-sm-4 col-lg-4 border-rig effect1 p-t-10 p-b-10">
                                <div class="search trim-search">
                                    <div class="form-group">
                                        <input type="text" id="passengers" data-toggle="popover" data-placement="bottom" minlength="5" maxlength="7"  class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip" placeholder="No. of passengers" tabindex="1" >
					<div id="loader_slider"></div>
                                        <div class="slider-bar" style="margin:10px 0px;position: relative;">
                                            <div style="width:100%; background-color:#ccc; height:5px; border-radius:10px;"></div>
                                            <input type="range"  id="range_slider" min="0" max="10" value="0" step="1" />                                           
                                            <div id="color-bar" style="background-color:#ff0000;top:0; position: absolute; height:6px; border-radius:10px;"></div>                                            
                                            <div id="slider-range" class="numbering" style="width:100%;">                                            
                                                @for($i = 0;$i < 10; $i++)
                                                <span class="colour-dynamic size12" style="width:10%; padding-top:5px; text-align: right; float:left; cursor: pointer">{{$i+1}}</span>                                                     
                                                @endfor                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="form-group">  
                                        <dl class="dropdown m-0 form-control " data-toggle="popover" data-placement="top" >
                                            <dt><a>
                                                    <span id="dep_time_hours" readonly="">Infants</span>
                                                </a>
                                            </dt>
                                        </dl>
                                        <label class="m-0 size12 normal">Infant place can be added only to seat no 3 & 6</label>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-search-row-left">
                                            <div class="form-group">
                                                <input required="required" type="text" data-toggle="popover" data-placement="bottom" minlength="4" maxlength="4" name="departure_aerodrome" autocomplete="off" id="departure_aerodrome" value="" class="alphabets redirect text-center font-bold text_uppercase validation_class form-control ui-autocomplete-input" placeholder="From" data-redirect-url="http://localhost:8080/pvtflightnew/public/fpl?page=new_full_fpl" data-url="http://localhost:8080/pvtflightnew/public/fpl/check_callsign_exist" tabindex="2" data-original-title="" title="">
                                            </div>
                                        </div>
                                        <div class="form-search-row-right">
                                            <div class="form-group">
                                                <input required="required" type="text" data-toggle="popover" data-placement="bottom" minlength="4" maxlength="4" class="alphabets text-center font-bold text_uppercase validation_class form-control ui-autocomplete-input" autocomplete="off" placeholder="To" value="" name="destination_aerodrome" id="destination_aerodrome" tabindex="3" data-original-title="" title="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-search-row-left">
                                            <div class="form-group">
                                                <input  type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control" placeholder="Bags" >
                                            </div>
                                        </div>
                                        <div class="form-search-row-right">
                                            <div class="form-group">
                                                <input required="required" type="text" data-toggle="popover" data-placement="bottom" minlength="4" maxlength="4" class="text-center font-bold text_uppercase  form-control" placeholder="Basic Wt" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" data-toggle="popover" data-placement="bottom" minlength="5" maxlength="7"  class="alpha_numeric text-center font-bold text_uppercase validation_class form-control modtooltip" placeholder="FC(Forward Closet Wt)" tabindex="1" >
                                    </div>

                                    <div class="form-row">
                                        <div class="form-search-row-left">
                                            <div class="form-group">
                                                <input  type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control" placeholder="PIC Name" >
                                            </div>
                                        </div>
                                        <div class="form-search-row-right">
                                            <div class="form-group">
                                                <input required="required" type="text" data-toggle="popover" data-placement="bottom" minlength="4" maxlength="4" class="text-center font-bold text_uppercase  form-control" placeholder="CO Pilotname" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-search-row-left">
                                            <div class="form-group">
                                                <input  type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control" placeholder="Trip Fuel" >
                                            </div>
                                        </div>
                                        <div class="form-search-row-right">
                                            <div class="form-group">
                                                <input required="required" type="text" data-toggle="popover" data-placement="bottom" minlength="4" maxlength="4" class="text-center font-bold text_uppercase  form-control" placeholder="Landing Fuel" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-search-row-left">
                                            <div class="form-group">
                                                <input  type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control" placeholder="Takeoff Fuel" >
                                            </div>
                                        </div>
                                        <div class="form-search-row-right">
                                            <div class="form-group">
                                                <input required="required" type="text" data-toggle="popover" data-placement="bottom" minlength="4" maxlength="4" class="text-center font-bold text_uppercase  form-control" placeholder="Max Takeoff Wt" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-search-row-left">
                                            <div class="form-group">
                                                <input  type="text" data-toggle="popover" data-placement="bottom" class="text-center font-bold text_uppercase validation_class form-control" placeholder="Max Landing Wt" >
                                            </div>
                                        </div>
                                        <div class="form-search-row-right">
                                            <div class="form-group">
                                                <label class="pull-right p-t-5 size12">Trim Settings <i class="fa fa-cogs"></i></label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-3 noleftpad norightpad effect2">
                                <div class="aeroplane">
                                    <img src="{{url('media/images/red-seat.png')}}" />
                                </div><!-- end of wher-right-col -->
                            </div>
                            <div class="col-xs-12 col-sm-4 col-lg-5 noleftpad norightpad effect2">
                                <div class="trim-graph">
                                    <img src="{{url('media/images/Load-Trim-Graph-2.png')}}" />
                                </div><!-- end of wher-right-col -->
                            </div>
                        </div><!-- end of wheather_midd -->
                    </div>
                </div>
            </div>
        </section>
    </main>   
    @include('includes.new_footer',[])
</div>
@stop