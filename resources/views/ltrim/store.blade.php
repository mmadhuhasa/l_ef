 @extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<!-- <script src="{{url('app/js/highcharts/highcharts.js')}}"></script>
<script src="{{url('app/js/highcharts/data.js')}}"></script>
<script src="{{url('app/js/highcharts/exporting.js')}}"></script>
<script src="{{url('app/js/highcharts/offline-exporting.js')}}"></script>
<script src="{{url('app/js/highcharts/highslide-full.min.js')}}"></script>
<script src="{{url('app/js/highcharts/highslide.config.js')}}" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="{{url('app/js/highcharts/highslide.css')}}" /> -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://www.highcharts.com/samples/static/highslide-full.min.js"></script>
<script src="https://www.highcharts.com/samples/static/highslide.config.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="https://www.highcharts.com/samples/static/highslide.css" />
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/style.css')}}">

<style type="text/css">
    .vtobr_heading {
        margin-bottom: 30px;
        text-align: center;
        padding: 7px 0;
        font-weight: 600;
        font-size: 15px;
        color: #fff;
        font-family: 'pt_sansregular', sans-serif;
        background: #a6a6a6;
        background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
    }
    .p-lr-0{
        padding-right: 0 !important;
        padding-left: 0 !important;

    }
    .pos-rel {position: relative;}
    .seat1_selected, .seat2_selected, .seat3_selected, .seat4_selected {position:absolute;background: url(../media/images/lnt/vtavs/seat_selected.png)center top no-repeat;width: 63px;height: 49px;background-size: 38px;}
    .seat1_selected {top: 66px;left: 320px;}
    .seat2_selected {top: 18px;left: 320px;}
    .seat3_selected {top: 46px;left: 401px;transform: rotate(180deg);}
    .seat4_selected {top: -1px;left: 401px;transform: rotate(180deg);}
    @media (min-width:1200px) {
        .turbo_result {
            width: 900px;
        }    
    }
    .turbo_result {
        margin:10px auto;
    }
    .ltrim_sec .ui-datepicker-trigger {
        right: 6px !important;
    }
    .newbtnv1 {
        z-index: 0 !important;
    }
    select.form-control {
        background-position: 95% !important;
    }
    #select_date.form-control[readonly]{
  background:none !important;
}
.ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus{
            background: #F26232 !important;
    background: #f1292b !important;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
    background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
    background: -moz-linear-gradient(top, #f1292b, #f37858);
    }
</style>
@endpush
@section('content')
<div class="page">
    @include('includes.new_header',[])
    <main>
        <div class="container ltim_container">
            <div class="ltrim_sec">
                <div class="row"><div class="col-md-12"><p class="vtobr_heading" style="text-transform: uppercase;">{{$call_sign}}</p></div></div>
                <form action='{{url('loadtrim/vtavs')}}' method='POST' id="vtavsform">
                    <div class="row">
                        <input type="hidden" class="form-control" value="1" name="post">
                        <div class="col-md-12">
                            <div class="col-md-2">
                                <div class="form-group dynamiclabel">
                                    <input type="text" class="form-control" id="callsign" placeholder="call sign" value="{{$call_sign}}" style="text-transform: uppercase;" readonly>
                                    <label>call sign</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group dynamiclabel">
                                    <input type="text" class="form-control alphabets clear" placeholder="from" value="{{$from}}" name="from" id="from" autocomplete="off" data-toggle="popover" data-placement="top">
                                    <label>from</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group dynamiclabel">
                                    <input type="text" class="form-control alphabets clear" placeholder="to"  value="{{$to}}" name="to" id='to' autocomplete="off" data-toggle="popover" data-placement="top">
                                    <label>to</label>
                                </div>
                            </div>
                            {!! csrf_field() !!}
                            <div class="col-md-2">
                                <div class="form-group dynamiclabel">
                                    <input type="text" class="form-control  clear" value="{{$date}}" id="select_date" name="date" autocomplete="off" readonly>
                                    <img class="ui-datepicker-trigger" src="{{url('media/ananth/images/calender-icon1.png')}}" alt="..." title="..." >
                                    <label>date</label>
                                </div>
                            </div>
                            <div class="col-md-2">

                                <div class="form-group dynamiclabel">
                                    <select name="paxs" class="form-control clear" id="pax">
                                        <option value="">Select</option>
                                        <option value="1" @if($pax_no== '1') {{'selected'}} @endif>1</option>
                                        <option value="2" @if($pax_no== '2') {{'selected'}}@endif>2</option>
                                        <option value="3" @if($pax_no== '3') {{'selected'}}@endif>3</option>
                                        <option value="4" @if($pax_no== '4') {{'selected'}}@endif>4</option>
                                    </select>
                                    <label for="pax">Pax</label>
                                </div>
                            </div>
                            <div class="col-md-2">

                                <div class="form-group dynamiclabel">
                                    <select name="aft_baggage_compt_weight" class="form-control clear" id="cargo" data-toggle="popover" data-placement="top">
                                        <option value="">Select</option>
                                        <option value="50" @if($cargo=='50') {{'selected'}} @endif>50</option>
                                        <option value="100" @if($cargo=='100') {{'selected'}} @endif>100</option>

                                    </select>
                                    <label for="cargo">Cargo</label>
                                </div>    
                            </div>
                            <div class="col-md-4">
                                <div class="form-group dynamiclabel">
                                    <input type="text" class="form-control alphabets_with_space clear" placeholder="pilot name" value="{{$pilot}}" name="pilot" id="pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top">
                                    <label>pilot name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group dynamiclabel">
                                    <input type="text" class="form-control alphabets_with_space clear" placeholder="co pilot name" value="{{$co_pilot}}" name="co_pilot" id="co_pilot" style="text-transform: uppercase;" autocomplete="off" data-toggle="popover" data-placement="top">
                                    <label>Co pilot name</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group dynamiclabel clear">
                                    <input type="text" class="form-control take_off_fuel_roundoff_vtavs numbers clear" placeholder="Take off fuel" value="{{$take_off_fuel['weight']}}" name="take_off_fuel" id="take_off_fuel" autocomplete="off" data-toggle="popover" data-placement="top">
                                    <label>Take off fuel</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group dynamiclabel">
                                    <input type="text" class="form-control landing_fuel_roundoff_vtavs numbers clear" placeholder="Landing Fuel" value="{{$landing_fuel['weight']}}" name="landing_fuel" id="landing_fuel" autocomplete="off" data-toggle="popover" data-placement="top">
                                    <label>Landing Fuel</label>
                                </div>
                            </div>
                            <div class="col-md-12 p-lr-0 form-group">
                                <div class="col-md-2">  
                                    <button type="submit" class="form-control newbtnv1">Submit</button></div>
                                <div class="col-md-8 text-center pos-rel">
                                    <img src="{{url('media/images/lnt/vtavs/flight.png')}}"  width="75%">
                                    <div class="seat seat1 @if(array_key_exists("weight",$paxs[0])) seat1_selected @endif"></div>
                                    <div class="seat seat2 @if(array_key_exists("weight",$paxs[1])) seat2_selected @endif"></div>
                                    <div class="seat seat3 @if(array_key_exists("weight",$paxs[2])) seat3_selected @endif"></div>
                                    <div class="seat seat4 @if(array_key_exists("weight",$paxs[3])) seat4_selected @endif"></div>
                                </div>
                                <div class="col-md-2 pull-right"> <button type="button" id="reset" class="form-control newbtnv1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
        <div class="turbo_result">
            <div class="download-parent">
                <img id="graph_print" class="pull-right" src="{{url('media/images/download-all.png')}}" style="    margin-top: 35px;">
                <span class="tooltip-download">Download</span>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <img src="{{url('media/turbo.png')}}" width="150" height="50" id="img_pro">
                </div>
                <div class="col-md-4 width-auto" id="heading">
                    <p>TURBO AVIATION PVT LTD</p>
                    <p>Load and Trim Sheet</p>
                    <p>MODEL EMBRAER 500 - PHENOM 100</p>
                </div>
                <div class="col-md-offset-4">
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 t_bcol1 padd-l-5" >
                    Registration: <span style="text-decoration: underline;">VT-AVS</span>
                </div>
                <div class="col-md-4 col-md-offset-1  t_bcol1 padd-lr-25" style="width:auto;">
                    SERIAL NUMBER - 500000204
                </div>
                <div class="col-md-3  t_bcol1" style="text-transform: uppercase;    float: right;width: auto; padding-left: 5px;">
                    DATE:{{ $date }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 t_bcol1 auto_caps padd-l-5">
                    FROM: {{ $from}}
                </div>
                <div class="col-md-3 col-md-offset-1 t_bcol1 auto_caps padd-l-5">
                    TO: {{ $to}}
                </div>
                <div class="col-md-6 ">

                </div>
            </div>
            <div class="row">
                <div class="col-md-4 t_bcol1 auto_caps padd-l-5">
                    PIC: {{ $pilot}}
                </div>
                <div class="col-md-3 ">

                </div>
                <div class="col-md-5  t_bcol1 auto_caps padd-l-5">
                    CO PILOT : {{ $co_pilot}}
                </div>
            </div>
            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <th class="f_w th-padd-tb-2">Sl.</th>
                    <th class="f_w th-padd-tb-2">Details</th>
                    <th id="td_t" class="f_w th-padd-tb-2">Weight (lbs)</th>
                    <th id="td_t" class="f_w th-padd-tb-2">Arm (ln)</th>
                    <th id="td_t" class="f_w th-padd-tb-2">Moment (Wt X Arm)</th>
                    </thead>
                    <tbody class="b_col">
                        <tr>
                            <td>i)</td>
                            <td class="data_align">Empty Weight</td>
                            <td id="td_t">{{ $empty_weight['weight'] }}</td>
                            <td id="td_t">{{ $empty_weight['arm'] }}</td>
                            <td id="td_t">{{ round($empty_weight['weight']*$empty_weight['arm'],2) }}</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Pilot & Co Pilot</td>
                            <td id="td_t">{{ sprintf('%.2f',$pilot_co_pilot['weight']) }}</td>
                            <td id="td_t">{{ $pilot_co_pilot['arm'] }}</td>
                            <td id="td_t">{{sprintf('%.2f',  $pilot_co_pilot['weight']*$pilot_co_pilot['arm'])}}</td>
                        </tr>
                        @php
                        $pax_count = 1; $count=1;
                        @endphp
                        @foreach ($paxs as $pax)
                        <tr>
                            <td>{{ $count++ }}</td>
                            <td>Pax {{ $pax_count++ }}</td>
                            <td id="td_t">@if(isset($pax['weight']))  {{ sprintf('%.2f',$pax['weight']) }} @else {{'0.00'}} @endif</td>
                            <td id="td_t">{{ $pax['arm'] }}</td>
                            <td id="td_t">@if(isset($pax['weight'])) {{ sprintf('%.2f', $pax['weight']*$pax['arm']) }} @else {{ '0.00'}} @endif</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td>6</td>
                            <td>Fwd, Baggage Compt (Max 66 Lbs)</td>
                            <td id="td_t">{{ sprintf('%.2f',$fwd_baggege_compt['weight']) }}</td>
                            <td id="td_t">{{ $fwd_baggege_compt['arm'] }}</td>
                            <td id="td_t">{{ $fwd_baggege_compt['weight']*$fwd_baggege_compt['arm'] }}</td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td>Wardrobe/ Refreshment Cabinet</td>
                            <td id="td_t">{{ sprintf('%.2f',$wardrobe_refreshment_cabinet['weight']) }}</td>
                            <td id="td_t">{{ $wardrobe_refreshment_cabinet['arm'] }}</td>
                            <td id="td_t">{{ 
                        sprintf('%.2f', $wardrobe_refreshment_cabinet['weight']*$wardrobe_refreshment_cabinet['arm']) }}</td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td>Lavatory Cabinet (Max 353 Lbs)</td>
                            <td id="td_t">{{ sprintf('%.2f',$lavatory_cabinet['weight']) }}</td>
                            <td id="td_t">{{ $lavatory_cabinet['arm'] }}</td>
                            <td id="td_t">{{ sprintf('%.2f', $lavatory_cabinet['weight']*$lavatory_cabinet['arm']) }}</td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td>Aft Baggage Compt (Max 353 Lbs)</td>
                            <td id="td_t">{{ sprintf('%.2f',$aft_baggage_compt['weight']) }}</td>
                            <td id="td_t">{{ $aft_baggage_compt['arm'] }}</td>
                            <td id="td_t">{{ sprintf('%.2f', $aft_baggage_compt['weight']*$aft_baggage_compt['arm']) }}</td>
                        </tr>
                        <tr> 
                            <td class="b_c">ii)</td>
                            <td class="f_w">Total Zero Fuel (i+1 to 9)</td>
                            <td class="f_w" id="td_t" >{{ $total_zero_fuel['weight'] }}</td>
                            <td class="f_w" id="td_t" >{{ sprintf('%.2f',$total_zero_fuel['arm']) }}</td>
                            <td class="f_w" id="td_t" >{{ sprintf('%.2f', $total_zero_fuel['momentum']) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="f_i">Max Zero Fuel Weight (8444 Lbs)</td>
                            <td colspan="2" class="f_b cg-right">ZFW CG % M.A.C = </td>
                            <td class="f_b cg-value">{{ sprintf('%.2f',$max_zero_fuel_weight) }}</td>
                        </tr>
                        <tr>
                            <td>iii)</td>
                            <td class=""><b>Take Off Fuel</b> <span>(Max. 2750 Lbs)</span></td>
                            <td class="f_a" id="td_t">{{ $take_off_fuel['weight'] }}</td>
                            <td id="td_t">{{ sprintf('%.2f',$take_off_fuel['arm']) }}</td>
                            <td id="td_t">{{ sprintf('%.2f',$take_off_fuel['momentum']) }}</td>
                        </tr>
                        <tr>
                            <td class="b_c">iv)</td>
                            <td class="f_w">Total Take Off Weight (ii+iii)</td>
                            <td class="f_w" id="td_t">{{ $total_take_off_weight['weight'] }}</td>
                            <td class="f_w" id="td_t">{{ sprintf('%.2f',$total_take_off_weight['arm']) }}</td>
                            <td class="f_w" id="td_t">{{ sprintf('%.2f',$total_take_off_weight['momentum']) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="f_i">Max Take Off Weight (10472 Lbs)</td>
                            <td colspan="2" class="f_b cg-right">TAKE OFF WT CG % M.A.C = </td>
                            <td class="f_b cg-value">{{ sprintf('%.2f',$max_take_off_weight) }}</td>
                        </tr>
                        <tr>
                            <td>v)</td>
                            <td class="f_a">Landing Fuel</td>
                            <td class="f_a" id="td_t">{{ $landing_fuel['weight']}}</td>
                            <td  id="td_t">{{  sprintf('%.2f',$landing_fuel['arm']) }}</td>
                            <td  id="td_t">{{  sprintf('%.2f',$landing_fuel['momentum']) }}</td>
                        </tr>
                        <tr>
                            <td class="b_c">vi)</td>
                            <td class="f_w">Total Landing Weight (ii+v)</td>
                            <td class="f_w" id="td_t">{{ sprintf('%.2f',$total_landing_weight['weight']) }}</td>
                            <td class="f_w" id="td_t">{{ sprintf('%.2f', $total_landing_weight['arm']) }}</td>
                            <td class="f_w" id="td_t">{{  sprintf('%.2f',$total_landing_weight['momentum']) }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="f_i">Max Landing Weight (9766 Lbs)</td>
                            <td colspan="2" class="f_b cg-right">LANDING WT CG % M.A.C = </td>
                            <td class="f_b cg-value">{{ sprintf('%.2f',$max_landing_weight) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-md-5 t_bcol1 zfw" >
                    ZFW CG as % MAC = (Arm - 209.64) x 100 / 64.57
                </div>
            </div>
            <div class="row">
                <div class="col-md-1 note"> Note :</div>
                <div class="col-md-11 note">
                    <ol>
                        <li> Maximum seating permissible is 04 PAX Lavatory not to be occupied.</li>
                        <li> PIC to brief the passenger occuping RH AFT FWD facing seat, which is next to exit about opening procedure of over wing exit.</li>
                        <li> Standard weight as per CAR section 2 series X part -ll follows- <br>Adult passanger (both male and female):165 lbs.Child (Between 2 years and 12 years age):77 lbs.and infant less than 2 years:22 lbs.</li>
                    </ol>
                </div>
            </div>

            <p class="p">I certify that aircraft is properly loaded and CG is within limits as per AFM
            </p>
            <p class="p"><b>Signature of PIC:</b></p>
            <span class="p"><b>ATPL:</b></span>
        </div>
</div>
<div class="container graph_container">
    <div class="row">
        <div class="col-sm-8 col-md-12">
            <div id="Div1"></div>                      
        </div>
    </div>
</div>
</main>
<!-- <div id='v_toTop'><span></span></div> -->
@include('includes.new_footer',[])
</div>
<script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
<script>
$("#pax").change(function()
{
  var i;var j=1;
  
  $(".seat").each(function(){
        $(this).removeClass("seat"+j+"_selected");
        j++;
    });
  for(i=1;i<=$(this).val();i++)
  {
    console.log($(this).val());
      $(".seat"+i).addClass("seat"+i+"_selected")
  } 
   
});
$("#select_date").datepicker({
minDate: 0,
        dateFormat: 'dd-M-yy',
        onSelect: function(dateText, inst)
        {
        $("#select_date").css("border", "1px solid #999");
        }
});
$(document).ready(function () {
$('#reset').click(function(){
  var j=1;
     $('.clear').val('');
      $(".seat").each(function(){
        $(this).removeClass("seat"+j+"_selected");
        j++;
    });
});
$(function () {
var landing_data = [<?php echo $max_landing_weight; ?>,<?php echo $total_landing_weight['weight']; ?>];
var landing_data1 = [<?php echo $max_landing_weight; ?>,<?php echo $total_landing_weight['weight'] - 200; ?>];
var take_off_data = [<?php echo $max_take_off_weight; ?>,<?php echo $total_take_off_weight['weight']; ?>];
var take_off_data1 = [<?php echo $max_take_off_weight; ?>,<?php echo $total_take_off_weight['weight'] - 30; ?>];
var lr_data = [take_off_data1, landing_data];
var fromm = "<?php echo $from; ?>";
var to = "<?php echo $to; ?>";
var date = "<?php echo $date ?>";
console.log(take_off_data1);
console.log(take_off_data);
var curve_color = '#000';
var zero_fuel_color = 'darkgrey';
var landing_fuel_color = '#000';
var take_off_fuel_color = '#000';
var zfg_color = '#2cc38a';
$("#Div1").highcharts({
exporting: {
allowHTML: true,
        chartOptions: {// specific options for the exported image
        plotOptions: {
        series: {
        dataLabels: {
        enabled: false
        }
        }
        },
                legend: {
                enabled: true,
                        verticalAlign: 'bottom',
                        align: 'right',
                        y: 0
                },
                title: {
                text: `<div class="col-md-3 col-md-offset-1  t_bcol1" style="text-transform:uppercase; margin-bottom: 10px;font-weight:bold;font-size: 37px;">${date}</div><div class="col-md-3 col-md-offset-1  t_bcol1" style="text-transform:uppercase;font-weight:bold;margin-bottom: 10px;font-size: 37px;">${fromm}-${to}</div>`,
                        useHTML: true,
                        y: 626,
                        align: 'center',
                        x: 1180,
                },
                subtitle: {
                },
                margin: 0,
                chart: {
                width: 2480,
                        height: 3508,
                        spacingBottom:1407,
                        spacingRight:205,
                        marginTop:1035,
                        marginLeft:405,
                        events: {
                        load: function () {

                        this.renderer.image('https://www.eflight.aero/media/graph5.png', '0', '50', 2480, 3508)
                                .add();
                        }
                        }
                },
                series: [{
                showInLegend: false,
                        name: 'ZFW',
                        type: 'spline',
                        color: curve_color,
                        "marker": {
                        "symbol": "circle"
                        },
                        lineWidth: 1.1,
                        data: lr_data
                },
                {
                showInLegend: false,
                        name: 'LW',
                        type: 'scatter',
                        color: landing_fuel_color,
                        "marker": {
                        enabled: true,
                                "symbol": "circle",
                                radius: 10
                        },
                        data: [landing_data],
                        dataLabels: {
                        enabled: false,
                                formatter: function () {
                                return  parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                                },
                                style: {fontFamily: '\'calibri\', sans-serif', lineHeight: '0px', fontSize: '30px', fontWeight: 'bold'}
                        }
                },
                {
                showInLegend: false,
                        name: 'LW',
                        type: 'scatter',
                        color: landing_fuel_color,
                        "marker": {
                        enabled: false,
                                "symbol": "circle",
                                radius: 4
                        },
                        data: [landing_data1],
                        dataLabels: {
                        enabled: true,
                                formatter: function () {
                                return  parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y + 200) + ' lbs)';
                                },
                                style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '30px', fontWeight: 'bold'}
                        }
                },
                {
                showInLegend: false,
                        name: 'TOW',
                        type: 'scatter',
                        color: take_off_fuel_color,
                        "marker": {
                        enabled:true,
                                "symbol": "triangle",
                                radius: 10
                        },
                        //enabled: false,
                        data: [take_off_data1],
                        dataLabels: {
                        enabled: false,
                                formatter: function () {

                                return   parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                                },
                                style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '30px', fontWeight: 'bold'}
                        }
                },
                {
                showInLegend: false,
                        name: 'TOW',
                        type: 'scatter',
                        color: take_off_fuel_color,
                        "marker": {
                        enabled:false,
                                "symbol": "triangle",
                                radius: 10
                        },
                        data: [take_off_data],
                        dataLabels: {
                        enabled: true,
                                formatter: function () {

                                return   parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                                },
                                style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '30px', fontWeight: 'bold'}
                        }
                },
                ]
        },
        scale: 3,
        fallbackToExportServer: false,
        },
        chart: {
        width: 900,
                height: 482,
                marginTop: 10,
                marginLeft: 137,
                spacingRight:46,
                spacingBottom: 60,
                events: {
                load: function () {
                this.renderer.image('https://www.eflight.aero/media/vt_avs.png', '0', '0', 900, 482)
                        .add();
                }
                }
        },
        credits: {
        enabled: false
        },
        navigation: {
        buttonOptions: {
        enabled: false
        }
        },
        title: {
        showInLegend: false,
                text: '',
                x: - 20 //center
        },
        xAxis: {

        lineColor: 'transparent',
                min: 10,
                max: 50,
                tickInterval: 10,
                tickPositions: [10, 20, 30, 40, 50],
                tickPosition: 'inside',
                tickLength: 0,
                tickColor:'blue',
                tickWidth:5,
                labels: {
                style: {
                color: '#0000',
                        fontSize: '12px'
                },
                        // y: 13,
                        enabled: false
                }
        },
        yAxis: {

        lineColor: 'transparent',
                gridLineWidth: 0,
                min: 6200,
                max: 11000,
                tickPositions: [6200, 6600, 7000, 7400, 7800, 8200, 8600, 9000, 9400, 9800, 10200, 10600, 11000],
                tickLength: 0,
                tickWidth:5,
                tickColor:'blue',
                tickInterval: 400,
                lineWidth: 1,
                title: {
                text: ''

                },
                plotLines: [{
                value: 0,
                        width: 10,
                        color: '#808080'
                }],
                labels: {
                // x: -10,
                style: {
                color: 'black',
                        fontSize: '12px'
                },
                        enabled: false
                }
        },
        tooltip: {
        valueSuffix: ''
        },
        legend: {
        layout: 'horizontal',
                align: 'right',
                verticalAlign: 'top',
                borderWidth: 0
        },
        plotOptions: {
        spline: {
        marker: {
        enabled: false
        }
        },
                series: {
                states: {
                hover: {
                enabled: false
                }
                }
                }
        },
        tooltip: {
        enabled: false
        },
        series: [{
        showInLegend: false,
                name: 'ZFW',
                type: 'spline',
                color: curve_color,
                "marker": {
                "symbol": "circle"
                },
                lineWidth: 1.1,
                data: lr_data
        },
        {
        showInLegend: false,
                name: 'LW',
                type: 'scatter',
                color: landing_fuel_color,
                "marker": {
                enabled: true,
                        "symbol": "circle",
                        radius: 3
                },
                data: [landing_data],
                dataLabels: {
                enabled: false,
                        formatter: function () {

                        return  parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'}
                }
        },
        {
        showInLegend: false,
                name: 'LW',
                type: 'scatter',
                color: landing_fuel_color,
                "marker": {
                enabled: false,
                        "symbol": "circle",
                        radius: 3
                },
                data: [landing_data1],
                dataLabels: {
                enabled: true,
                        formatter: function () {
                        return  parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y + 200) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'}
                }
        },
        {
        showInLegend: false,
                name: 'TOW',
                type: 'scatter',
                color: take_off_fuel_color,
                "marker": {
                enabled:true,
                        "symbol": "triangle",
                        radius: 4
                },
                enabled: false,
                data: [take_off_data1],
                dataLabels: {
                enabled: false,
                        formatter: function () {

                        return   parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'},
                }
        },
        {
        showInLegend: false,
                name: 'TOW',
                type: 'scatter',
                color: take_off_fuel_color,
                "marker": {
                enabled:false,
                        "symbol": "triangle",
                        radius: 4
                },
                enabled:false,
                data: [take_off_data],
                dataLabels: {
                enabled: true,
                        formatter: function () {

                        return   parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'},
                }
        },
        ]
        });
$('#graph_print').click(function (e) {
$.ajax({
url: "/ltrim_graph",
        dataType: 'json',
        success: function (data, textStatus, jqXHR) {
        // aircraft_callsign=data.call_sign;
        departure_aerodrome = data.from;
        destination_aerodrome = data.to;
        date_of_flight = data.date;
        },
        async: false,
        error: function (jqXHR, textStatus, errorThrown) {
        }
});

var chart = $('#Div1').highcharts();
var graph_name = 'GRAPH VTAVS' + ' ' + departure_aerodrome + ' ' + destination_aerodrome + '-' + date_of_flight;
if ($(this).hasClass('disabled')) {
e.preventDefault();
return false;
}

chart.exportChart({
type: 'application/pdf',
        filename: graph_name,
        width: 600,
        height: 400,
        marginTop: 118,
        events: {
        load: function () {
        this.renderer.image('https://www.eflight.aero/media/avs_graph.png', '0', '0', 600, 400)
                .add();
        }
        }
});
setTimeout(function(){
var url = "<?php echo URL::to('/'); ?>";
window.location = url + "/ltrimpdf/vtavs";
}, 5000)
        });
});
$("#from_date, #to_date,#date_of_flight,.ui-datepicker-trigger").click(function () {
$(".notify-bg-v").fadeIn();
$('.notify-bg-v').css('height', $(document).height());
});
});
$(window).scroll(function () {
if ($(this).scrollTop()) {
$('#v_toTop').fadeIn();
} else {
$('#v_toTop').fadeOut();
}
});
$("#v_toTop").click(function () {
$("html, body").animate({scrollTop: 0}, 500);
});
</script>


@stop