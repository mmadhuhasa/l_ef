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
<link rel="stylesheet" type="text/css" href="{{url('app/css/loadandtrim/vtobr.css')}}">
@endpush
<style>
    .pos-rel {position:relative;}
    .seat1_selected, .seat2_selected, .seat3_selected, .seat4_selected, .seat5_selected,.seat9_selected {position:absolute;background: url('/media/images/lnt/vtobr/vtobr_seat.png') center top no-repeat;width: 63px;height: 49px;background-size: 38px;}
    .seat6_selected, .seat7_selected, .seat8_selected {position: absolute;width: 63px;height: 49px;}
    .seat1_selected {top: 12px;left: 251px;}
    .seat2_selected {top: 65px;left: 251px;}
    .seat3_selected {top: -7px;left: 320px;transform: rotate(180deg);}
    .seat4_selected {top: 46px;left: 320px;transform: rotate(180deg);}
    .seat5_selected {top:-7px;left:386px;transform: rotate(180deg);}
    .seat9_selected {top: 57px;left: 442px;transform: rotate(90deg);}
    .seat6_selected {background: url('/media/images/lnt/vtobr/seat6.png') center top no-repeat; top: 65px; left: 356px; background-size: 54%;}
    .seat7_selected {background: url('/media/images/lnt/vtobr/seat7.png') center top no-repeat; top: 66px;left: 387px;background-size: 44%;}
    .seat8_selected {background: url('/media/images/lnt/vtobr/seat8.png') center top no-repeat;top:65px;left: 417px;background-size: 53%;}
    .ui-state-hover, .ui-widget-content .ui-state-hover, .ui-widget-header .ui-state-hover, .ui-state-focus, .ui-widget-content .ui-state-focus, .ui-widget-header .ui-state-focus{
            background: #F26232;
    background: #f1292b;
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#f37858');
    background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
    background: -moz-linear-gradient(top, #f1292b, #f37858);
    }
</style>
@section('content')
<div id="page">
    @include('includes.new_header',[])
    
    <div class="container cust-container">
        <div class="row ltrim_sec">
            <div class="col-md-12 p-lr-0"><p class="vtobr_heading">VTOBR</p></div>
            @if(isset($copypaste))
            <div class="col-md-12 p-lr-0">
                <form action="{{url('/vtobr')}}" method="post" id="calc_form">
                    {{ csrf_field() }}
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" value="VTOBR" disabled>
                            <label>call sign</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase " name="from" placeholder="FROM" value="{{$from}}" disabled id="dept_aero">
                            <label>from</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase" name="to" placeholder="TO" value="{{$to}}" disabled id="dest_aero">
                            <label>to</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" id='dd' class="form-control" name="date" placeholder="Date" disabled value="{{$date}}">
                            <label>date</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="jump_box">
                                <label style="padding-right: 8px;">Jump</label>
                                <input type="radio" name="jump" value="165.35" @if(isset($jump_weight) && $jump_weight!==0)  {{ 'checked'}} @endif disabled> Yes 
                                <input type="radio" name="jump" value="0" @if(isset($jump_weight) && $jump_weight==0) {{'checked'}} @else @endif disabled> No
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" name="pax_count" placeholder="pax count" value="{{$pax_count}}" disabled>
                            <label>Pax Count</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" placeholder="Baggage Fwd" name="baggage_fwd" value="{{(int)$baggage_fwd_weight}}" disabled>
                            <label>Baggage Fwd</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" placeholder="Baggage Aft" name="baggage_aft" value="{{(int)$baggage_aft_weight}}" disabled>
                            <label>Baggage Aft</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" placeholder="Fuel Wing Tank" name="fuel_wing_tank" value="{{(int)$fuel_wing_tank_weight}}"  disabled>               
                            <label>Fuel Wing Tank</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" placeholder="Fuel Ventral Tank" name="fuel_ventral_tank" value="{{(int)$fuel_ventral_tank_weight}}"disabled>
                            <label>Fuel Ventral Tank</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase" placeholder="Pilot" name="pilot_name" value="{{$pilot}}" disabled>
                            <label>pilot</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase" placeholder="Co pilot" name="copilot_name" value="{{$copilot}}" disabled>
                            <label>co pilot</label>
                        </div>
                    </div>
                    @if(isset($from))
                    @else
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="form-control newbtnv1">Submit</button>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-2">
                        <div class="form-group">
                            @if(isset($fuel_wing_tank_weight))<a href="JavaScript:void(0);"><button type="button" class="form-control newbtnv1" id="download_pdf">Download PDF</button></a>@endif
                        </div>
                    </div>
                </form>
            </div>
            @else
            <div class="col-md-12 p-lr-0">
                <form action="{{url('/loadtrim/vtobr')}}" method="post" id="calc_form" class="calc_form_validate">
                    {{ csrf_field() }}
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control" value="VTOBR" disabled id="callsign">
                            <label>call sign</label>
                        </div>
                    </div>
                    <input type="hidden" name="copypaste" value="false">
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase alphabets" data-toggle="popover" data-placement="top" name="from" placeholder="FROM" 
                            @if(isset($from)) value="{{$from}}" @else  value="{{ Session::get('from') }}" @endif id="dept_aero" autocomplete="off"/>
                            <label>from</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase alphabets" data-toggle="popover" data-placement="top" name="to"
                            placeholder="TO"  @if(isset($to)) value="{{$to}}" @else  value="{{ Session::get('to') }}" @endif id="dest_aero" autocomplete="off">
                            <label>to</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" id='select_date' class="form-control datepicker" data-toggle="popover" data-placement="top" name="date" placeholder="Date" autocomplete="off"   value="{{ Session::get('date') }}">
                            <label>date</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <div class="jump_box">
                                <label style="padding-right: 8px;">Jump</label>
                                <input type="radio" name="jump"  class="jump" value="165.35" @if(isset($jump_weight) && $jump_weight!==0)  {{ 'checked'}} @elseif(Session::get('jump_weight')=='165.35') {{'checked'}} @endif> Yes 
                                <input type="radio" name="jump" value="0" class="jump" @if(isset($jump_weight) && $jump_weight==0) {{'checked'}} @elseif(Session::get('jump_weight')=='0') {{'checked'}} @endif> No
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control numbers" data-toggle="popover" data-placement="top" name="pax_count" placeholder="pax count"  @if(isset($pax_count)) value="{{$pax_count}}" @else  value="{{ Session::get('pax_no') }}" @endif id="pax_vtobr" autocomplete="off">
                            <label>Pax Count</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control numbers" placeholder="Baggage Fwd" data-toggle="popover" data-placement="top" name="baggage_fwd" 
                              @if(isset($baggage_fwd_weight)) value="{{(int)$baggage_fwd_weight}}" @else value="{{ Session::get('baggage_fwd_weight') }}" @endif id="baggage_fwd_vtobr" autocomplete="off"/>
                            <label>Baggage Fwd</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control numbers" placeholder="Baggage Aft" data-toggle="popover" data-placement="top" name="baggage_aft" 
                             @if(isset($baggage_fwd_weight)) value="{{(int)$baggage_aft_weight}}" @else value="{{ Session::get('baggage_aft_weight') }}" @endif id="baggage_aft_vtobr" autocomplete="off"/>
                            <label>Baggage Aft</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control numbers" placeholder="Fuel Wing Tank" data-toggle="popover" data-placement="top" name="fuel_wing_tank" @if(isset($fuel_wing_tank_weight)) value="{{(int)$fuel_wing_tank_weight}}" @else value="{{ Session::get('fuel_wing_tank_weight') }}" @endif/ id="fuel_wing_tank_vtobr" autocomplete="off">  
                            <label>Fuel Wing Tank</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control numbers" placeholder="Ventral Tank" data-toggle="popover" data-placement="top" name="fuel_ventral_tank"  @if(isset($fuel_ventral_tank_weight)) value="{{(int)$fuel_ventral_tank_weight}}" @else value="{{ Session::get('fuel_ventral_tank_weight') }}" @endif id="fuel_ventral_tank_vtobr" autocomplete="off"/>
                            <label>Fuel Ventral Tank</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase alphabets_with_space" data-toggle="popover" data-placement="top" placeholder="Pilot" name="pilot_name" @if(isset($pilot)) value="{{$pilot}}" @else value="{{ Session::get('pilot') }}" @endif id="pilot" autocomplete="off">
                            <label>pilot</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group dynamiclabel">
                            <input type="text" class="form-control text-uppercase alphabets_with_space" data-toggle="popover" data-placement="top" placeholder="Co pilot" name="copilot_name" @if(isset($copilot)) value="{{$copilot}}" @else value="{{ Session::get('co_pilot') }}" @endif id="co_pilot" autocomplete="off">
                            <label>co pilot</label>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <button type="submit" class="form-control newbtnv1">Submit</button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            @if(isset($fuel_wing_tank_weight))<a href="JavaScript:void(0);"><button type="button" class="form-control newbtnv1" id="download_pdf">Download PDF</button></a>@endif
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-8 text-center pos-rel">
                <img src="{{url('media/images/lnt/vtobr/vtobr_flight.png')}}" style="width:72%;">
                <div class="seat @if(isset($pax_weight['pax1']))seat1_selected @endif"></div>
                <div class="seat @if(isset($pax_weight['pax2']))seat2_selected @endif"></div>
                <div class="seat @if(isset($pax_weight['pax3']))seat3_selected @endif"></div>
                <div class="seat @if(isset($pax_weight['pax4']))seat4_selected @endif"></div>
                <div class="seat @if(isset($pax_weight['pax5']))seat5_selected @endif"></div>
                <div class="seat @if(isset($pax_weight['pax6']))seat6_selected @endif"></div>
                <div class="seat @if(isset($pax_weight['pax7']))seat7_selected @endif"></div>
                <div class="seat @if(isset($pax_weight['pax8']))seat8_selected @endif"></div>
                <div class="seat @if(isset($pax_weight['pax9']))seat9_selected @endif"></div>
            </div>
        </div>
        <div class="row calc-sec">
            <div class="col-md-12 p-lr-0"><p class="vtobr_heading">LOAD TRIM SHEET</p></div>
            <div class="col-md-12">
                <table class="table table-bordered calc_table">
                    <thead>
                        <tr>
                            <th rowspan="2" colspan="2" style="width: 25%;">Description</th>
                            <th rowspan="2">Weight (KG.)</th>
                            <th rowspan="2">Weight (LB)</th>
                            <th rowspan="2">Arm FT.</th>
                            <th rowspan="2">Moment (FT. LB)</th>
                            <th colspan="2">To be filled by pilot in command</th>
                        </tr>
                        <tr>
                            <th>Weight <span style="font-weight: normal;font-size: 11px;text-transform: none;">(LB)</span></th>
                            <th>Monent <span style="font-weight: normal;font-size: 11px;text-transform: none;">(ft. LB)</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2" style="text-align: left">Basic Empty Weight of Aircraft (Including weight of Crews & Weight of removable Equipment (Para B of Weight Schedule))</td>
                            <td style="text-align: center;"><b>7502.09</b></td>
                            <td>16539.12</td>
                            <td>0.56</td>
                            <td>9415.13</td>
                            <td>16539.12</td>
                            <td>9415.13</td>
                        </tr>
                        <?php //dd($jump_moment);  ?>
                        <tr>
                            <td>1.</td>
                            <td>Jump Seat (observer)</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>- 14.00</td>
                            <td>-2314.9</td>
                            <td>@if(isset($jump_weight) &&$jump_weight != '0'){{$jump_weight}}@endif</td>
                            <td>@if(isset($jump_moment) && $jump_moment != '-0'){{$jump_moment}}@endif</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>LH AFT Facing Seat Row 1</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>-8.00</td>
                            <td>-1322.8</td>
                            <td>@if(isset($pax_weight['pax1'])){{$pax_weight['pax1']}}@endif</td>
                            <td>@if(isset($pax_moment['pax1'])){{$pax_moment['pax1']}}@endif</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>RH AFT Facing Seat Row 1</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>-8.00</td>
                            <td>-1322.8</td>
                            <td>@if(isset($pax_weight['pax2'])){{$pax_weight['pax2']}}@endif</td>
                            <td>@if(isset($pax_moment['pax2'])){{$pax_moment['pax2']}}@endif</td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>LH Front Facing Seat Row 2</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>-3.80</td>
                            <td>-628.33</td>
                            <td>@if(isset($pax_weight['pax3'])){{$pax_weight['pax3']}}@endif</td>
                            <td>@if(isset($pax_moment['pax3'])){{$pax_moment['pax3']}}@endif</td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td>RH Front Facing Seat Row 2</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>-4.10</td>
                            <td>-677.93</td>
                            <td>@if(isset($pax_weight['pax4'])){{$pax_weight['pax4']}}@endif</td>
                            <td>@if(isset($pax_moment['pax4'])){{$pax_moment['pax4']}}@endif</td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>RH Front Facing Seat Row 3</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>0.30</td>
                            <td>49.60</td>
                            <td>@if(isset($pax_weight['pax5'])){{$pax_weight['pax5']}}@endif</td>
                            <td>@if(isset($pax_moment['pax5'])){{$pax_moment['pax5']}}@endif</td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td>LH Sofa Fwd. Seat</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>-1.20</td>
                            <td>-198.42</td>
                            <td>@if(isset($pax_weight['pax6'])){{$pax_weight['pax6']}}@endif</td>
                            <td>@if(isset($pax_moment['pax6'])){{$pax_moment['pax6']}}@endif</td>
                        <tr>
                            <td>8.</td>
                            <td>LH Sofa Middle Seat</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>0.50</td>
                            <td>82.67</td>
                            <td>@if(isset($pax_weight['pax7'])){{$pax_weight['pax7']}}@endif</td>
                            <td>@if(isset($pax_moment['pax7'])){{$pax_moment['pax7']}}@endif</td>
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td>LH Sofa Aft Seat</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>2.20</td>
                            <td>363.77</td>
                            <td>@if(isset($pax_weight['pax8'])){{$pax_weight['pax8']}}@endif</td>
                            <td>@if(isset($pax_moment['pax8'])){{$pax_moment['pax8']}}@endif</td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td>LH Lav. Seat</td>
                            <td>75.00</td>
                            <td>165.35</td>
                            <td>4.60</td>
                            <td>760.61</td>
                            <td>@if(isset($pax_weight['pax9'])){{$pax_weight['pax9']}}@endif</td>
                            <td>@if(isset($pax_moment['pax9'])){{$pax_moment['pax9']}}@endif</td>
                        </tr>
                        <tr>
                            <td>11.</td>
                            <td>Baggage Fwd. Max.<b>250lbs.</b></td>
                            <td></td>
                            <td></td>
                            <td>-11.60</td>
                            <td></td>
                            <td>@if(isset($baggage_fwd_weight) && $baggage_fwd_weight != '0'){{$baggage_fwd_weight}}@endif</td>
                            <td>@if(isset($baggage_fwd_moment) && $baggage_fwd_moment != '0'){{$baggage_fwd_moment}}@endif</td>
                        </tr>
                        <tr>
                            <td>12.</td>
                            <td>Baggage Aft. Max.<b>45 lbs.</b></td>
                            <td></td>
                            <td></td>
                            <td>4.60</td>
                            <td></td>
                            <td>@if(isset($baggage_aft_weight) && $baggage_aft_weight != '0'){{$baggage_aft_weight}}@endif</td>
                            <td>@if(isset($baggage_aft_moment) && $baggage_aft_moment != '0'){{$baggage_aft_moment}}@endif</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="text-align: center;">Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>@if(isset($total_weight)){{$total_weight}}@endif</td>
                            <td>@if(isset($total_moment)){{$total_moment}}@endif</td>
                        </tr>
                        <tr>
                            <td>13.</td>
                            <td>Zero fuel weight Max.<b>18450 Lbs.</b></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>@if(isset($zero_fuel_weight)){{$zero_fuel_weight}}@endif</td>
                            <td>@if(isset($zero_fuel_moment)){{$zero_fuel_moment}}@endif</td>
                        </tr>
                        <tr>
                            <td>14.</td>
                            <td>Fuel wing tank &nbsp;&nbsp;8416 Lbs max.</td>
                            <td></td>
                            <td></td>
                            <td>0.69</td>
                            <td></td>
                            <td>@if(isset($fuel_wing_tank_weight) && $fuel_wing_tank_weight != '0'){{$fuel_wing_tank_weight}}@endif</td>
                            <td>@if(isset($fuel_wing_tank_moment) && $fuel_wing_tank_moment != '0'){{$fuel_wing_tank_moment}}@endif</td>
                        </tr>
                        <tr>
                            <td>15.</td>
                            <td>Fuel ventral tank 1496 Lbs max.</td>
                            <td></td>
                            <td></td>
                            <td>8.36</td>
                            <td></td>
                            <td>@if(isset($fuel_ventral_tank_weight) && $fuel_ventral_tank_weight != '0'){{$fuel_ventral_tank_weight}}@endif</td>
                            <td>@if(isset($fuel_ventral_tank_moment) && $fuel_ventral_tank_moment != '0'){{$fuel_ventral_tank_moment}}@endif</td>
                        </tr>
                        <tr>
                            <td>16.</td>
                            <td>Ramp weight Max. 28120 Lbs</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>@if(isset($ramp_weight)){{$ramp_weight}}@endif</td>
                            <td>@if(isset($ramp_moment)){{$ramp_moment}}@endif</td>
                        </tr>
                        <tr>
                            <td>17.</td>
                            <td>Fuel for taxi subtract</td>
                            <td></td>
                            <td>-120</td>
                            <td>0.69</td>
                            <td></td>
                            <td>-120</td>
                            <td>-82.8</td>                            
                        </tr>
                        <tr>
                            <td>18.</td>
                            <td>Take off weight Max. 28,000 Lbs.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>@if(isset($take_off_weight)){{$take_off_weight}}@endif</td>
                            <td>@if(isset($take_off_moment)){{$take_off_moment}}@endif</td>                            
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: right;">C.G. FOR FLIGHT: TOTAL MOMENT /TOTAL WEIGHT =</td>
                            <td style="text-align: center;">@if(isset($cg)){{$cg}}@endif</td>
                            <td>Feet (X)</td>
                        </tr>
                        <tr>
                            <td colspan="6"  style="text-align: right;"><p>C.G. % SMC = (X + 1.308) X 100 =</p><p class="divide_text">7.263</p></td>
                            <td style="text-align: center;">@if(isset($cg_smc)){{$cg_smc}}%@endif</td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 p-lr-0"><p class="vtobr_heading">Graph</p></div>
            <div class="col-md-offset-1 col-md-10">
                <div id="graph"></div>
            </div>
        </div>
    </div>
    <script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
    <script>

 $(".datepicker").datepicker({
     minDate:0
 });
$(function () {
   
   //$( "#select_date" ).datepicker( "setDate", new Date());
    var d="<?php echo Session::get('date')  ?>";
    var d1="<?php echo $date  ?>";
   if(d!="")
   $("#select_date").datepicker().datepicker("setDate",d);
   else if(d1!="")
   $("#select_date").datepicker().datepicker("setDate",d1);
   else
    $("#select_date").datepicker().datepicker("setDate",new Date());
    var plot_data = [<?php
                        if (isset($cg)) {
                            echo $cg;
                        }
                        ?>,<?php
                        if (isset($take_off_weight)) {
                            echo $take_off_weight;
                        }
                        ?>];
    var landing_fuel_color = '#000';
    $("#graph").highcharts({
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
                    text: ``,
                            useHTML: true,
                    y: 626,
                    align: 'center',
                    x: 1180,
                },
                subtitle: {
                },
                margin: 0,
                chart: {
                    width: 745,
                    height: 1053,
                    spacingBottom: 245,
                    spacingRight: 111,
                    marginTop: 214,
                    marginLeft: 166,
                    events: {
                        load: function () {

                            this.renderer.image('https://www.eflight.aero/media/images/lnt/vtobr/VTOBR-PDFGRAPH.png', '0', '0', 745,1053)
                                    .add();
                        }
                    }
                },
            },
            scale: 3,
            fallbackToExportServer: false,
        },
        chart: {
            width: 745,
            height: 923,
            marginTop: 55,
            marginLeft: 93,
            spacingRight: 23,
            spacingBottom: 64,
            events: {
                load: function () {
                    this.renderer.image(base_url+'/media/images/lnt/vtobr/graph.png', '0', '0', 745, 923)
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
            x: -20 //center
        },
        xAxis: {
            lineColor: 'transparent',
            min: -0.3,
            max: 1.4,
            tickInterval: 0.1,
            tickPositions: [-0.3, -0.2, -0.1, 0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1.0, 1.1, 1.2, 1.3, 1.4],
            tickPosition: 'inside',
            tickLength: 0,
            tickColor: 'blue',
            tickWidth: 5,
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
            min: 13000,
            max: 29000,
            tickPositions: [13000, 14000, 15000, 16000, 17000, 18000, 19000, 20000, 21000, 22000, 23000, 24000, 25000, 26000, 27000, 28000, 29000],
            tickLength: 0,
            tickWidth: 5,
            tickColor: 'blue',
            tickInterval: 1000,
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
        series: [
            {
                showInLegend: false,
                name: 'LW',
                type: 'scatter',
                color: landing_fuel_color,
                "marker": {
                    enabled: true,
                    "symbol": "triangle",
                    radius: 4
                },
                data: [plot_data],
                dataLabels: {
                    enabled: true,
                    formatter: function () {

                        return  '(' + parseFloat(this.key).toFixed(2) + ',' + Math.round(this.y) + ' lbs)';
                    },
                    style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '12px', fontWeight: 'bold', background: 'white'}
                }
            }
        ]
    });
     $('#download_pdf').click(function (e) {
            var departure_aerodrome = $("#dept_aero").val().toUpperCase();
            var destination_aerodrome =$("#dest_aero").val().toUpperCase();
            var date_of_flight = $("#select_date").val();
            if(date_of_flight==undefined)
                date_of_flight = $("#dd").val();
            var chart = $('#graph').highcharts();
            var graph_name = 'GRAPH VTOBR' + ' '+departure_aerodrome + ' ' + destination_aerodrome + '-' + date_of_flight;
            if ($(this).hasClass('disabled')) {
                e.preventDefault();
                return false;
            }

            chart.exportChart({
                type: 'application/pdf',
                filename: graph_name,
                width: 595,
                height: 841,
                 marginTop: 0,
                events: {
                    load: function () {
                        this.renderer.image('https://www.eflight.aero/media/images/lnt/vtobr/VTOBR-PDFGRAPH.png', '0', '0', 595,841)
                                .add();
                    }
                }
            });
            setTimeout(function(){
                var url="<?php echo URL::to('/');?>"; 
                window.location = url+"/vtobrpdf";
            },5000)
        }); 


});
    </script>
    @include('includes.new_footer',[])
</div>
@stop