<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <!--  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
    
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script> -->

        <style>
            body{
                font-family: arial,sans-serif;
            }
            p {margin:0;}
            table {border-spacing: 0;border-collapse: collapse;width: 100%;}
            .p-l-5 {padding-left: 5px;}
            .p-b-10 {padding-bottom: 10px;}
            .p-tb-10 {padding-top: 10px;padding-bottom: 10px;}
            .p-t-15 {padding-top: 15px;}
            .p-b-15 {padding-bottom: 15px;}
            .p-b-30 {padding-bottom: 30px;}
            .p-tb-15 {padding-top: 15px;padding-bottom: 15px;}
            .col-md-1 {width: 8.33333333%;}
            .col-md-2 {width: 16.66666667%;}
            .col-md-3 {width: 25%;}
            .col-md-4 {width: 33.33333333%;}
            .col-md-5 {width: 41.6667%;}
            .col-md-6 {width: 50%;}
            .col-md-7 {width: 58.33333333%;}
            .col-md-8 {width: 66.66666667%;}
            .col-md-9 {width: 75%;}
            .col-md-10 {width: 83.33333333%;}
            .col-md-11 {width: 91.66666667%;}
            .col-md-12 {width: 100%;}
            .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9 {
                display: inline-block; min-height: 1px;
            }
            .bg_grey {background: #eee;}
            .container {font-size: 13px;}
            .font-normal {font-weight: normal}
            .f-13 {font-size: 13px;}
            .text-center {text-align: center !important;}
            .text-right {text-align: right;}
            .logo {height: 90px;}
            .heading {font-weight: bold; text-align: center;font-size: 14px; padding-top:40px;margin-bottom: 15px;}
            .heading p {margin:0;}
            .head_table {width: 100%;margin:0;}
            .head_table th {width:21%; border-bottom: none;}
            .border-black {border:1px solid #000;}
            .fullwidth {width:100%;}
            .main_table th, .main_table td {border:1px solid #000;border-collapse: collapse;}
            .main_table th {text-align: center; vertical-align: top;background: #eee;}
            .main_table td {text-align: center;}
            .main_table > tbody > tr > td:nth-child(2) {text-align:left;padding-left: 5px;}
            .font-bold {font-weight: bold;}
            .pic_table th{border-bottom: none;}
            .row{clear: both;}
            
        </style>
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4"><img src="https://www.eflight.aero/media/images/loadtrim/vtssf/logo.png" height="70px"></div>
                        <!-- <div class="col-md-4"><img class="logo" src="{{url('media/images/loadtrim/vtssf/logo.png')}}"></div> -->
                        <div class="col-md-4"><div class="heading"><p>SimmSamm Airways Pvt. Ltd.</p><p>Load & Trim Sheet</p></div></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8"><p>Aircraft Type : <b>Hawker Beechcraft Corp. 390 (Premier 1A)</b></p></div>
                        <div class="col-md-4 text-right"><p>Regn. No.  : <b>VT-SSF</b></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="head_table">
                                <thead>
                                    <tr>
                                        <th class="border-black p-l-5"><span style="text-transform: uppercase;">{{$date}}</span></th>
                                        <th></th>
                                        <th class="border-black p-l-5">From : <span style="text-transform: uppercase;">{{$from}}</span></th>
                                        <th></th>
                                        <th class="border-black p-l-5">To : <span style="text-transform: uppercase;">{{$to}}</span></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="pic_table fullwidth">
                                <thead>
                                    <tr>
                                        <th class="border-black p-l-5" style="text-align:left;width:51.6%;">Capt :  <span style="text-transform: uppercase;">{{$pilot}}</span></th>
                                        <th class="border-black p-l-5" style="text-align:left;">Co-Pilot : <span style="text-transform: uppercase;">{{$co_pilot}}</span></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="main_table fullwidth">
                                <thead>
                                    <tr>
                                        <th rowspan="2">S/N</th>
                                        <th rowspan="2" style="width: 39%;">Item</th>
                                        <th>Weight</th>
                                        <th>Arm</th>
                                        <th>Mom/100</th>
                                        <th class="font-normal f-13" colspan="2">To be filled by PIC</th>
                                    </tr>
                                    <tr>
                                        <th class="font-normal">(lbs)</th>
                                        <th class="font-normal">(in)</th>
                                        <th class="font-normal">(lbs.in)</th>
                                        <th>Wt (lbs)</th>
                                        <th>Mom/100</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Basic Empty Weight</td>
                                        <td>{{$empty_weight['weight']}}</td>
                                        <td>{{$empty_weight['arm']}}</td>
                                        <td>{{sprintf('%.0f',$empty_weight['mom'])}}</td>
                                        <td>{{$empty_weight['weight']}}</td>
                                        <td>{{sprintf('%.0f',$empty_weight['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Pilot</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{$pilot_co_pilot['arm']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Co-Pilot</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{$pilot_co_pilot['arm']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Provisions / Misc.</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$provision}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Empty Operating Weight</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="bg_grey"><b>{{$empty_os['wt']}}</b></td>
                                        <td class="bg_grey"><b>{{sprintf('%.0f',$empty_os['mom'])}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Seat 1 (LH Row 1, Aft Facing)</td>
                                        <td>{{$paxs[0]['show_off_weight']}}</td>
                                        <td>{{$paxs[0]['arm']}}</td>
                                        <td>{{$paxs[0]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[0])) {{$paxs[0]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[0])) {{sprintf('%.0f',$paxs[0]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Seat 2 (RH Row 1, Aft Facing)</td>
                                        <td>{{$paxs[1]['show_off_weight']}}</td>
                                        <td>{{$paxs[1]['arm']}}</td>
                                        <td>{{$paxs[1]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[1])) {{$paxs[1]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[1])) {{sprintf('%.0f',$paxs[1]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Seat 3 (LH Row 2, Fwd Facing)</td>
                                        <td>{{$paxs[2]['show_off_weight']}}</td>
                                        <td>{{$paxs[2]['arm']}}</td>
                                        <td>{{$paxs[2]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[2])) {{$paxs[2]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[2])) {{sprintf('%.0f',$paxs[2]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Seat 4 (LH Row 2, Fwd Facing)</td>
                                        <td>{{$paxs[3]['show_off_weight']}}</td>
                                        <td>{{$paxs[3]['arm']}}</td>
                                        <td>{{$paxs[3]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[3])) {{$paxs[3]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[3])) {{sprintf('%.0f',$paxs[3]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Seat 5 (LH Row 3, Fwd Facing)</td>
                                        <td>{{$paxs[4]['show_off_weight']}}</td>
                                        <td>{{$paxs[4]['arm']}}</td>
                                        <td>{{$paxs[4]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[4])) {{$paxs[4]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[4])) {{sprintf('%.0f',$paxs[4]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Seat 6 (RH Row 3, Fwd Facing)</td>
                                        <td>{{$paxs[5]['show_off_weight']}}</td>
                                        <td>{{$paxs[5]['arm']}}</td>
                                        <td>{{$paxs[5]['show_off_mom']}}</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[5])) {{$paxs[5]['calculate_wt']}}@endif</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[5])) {{sprintf('%.0f',$paxs[5]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Baggage (Nose) Max 150 lbs</td>
                                        <td></td>
                                        <td>{{$baggage_nose['arm']}}</td>
                                        <td></td>
                                        <td>{{$baggage_nose['weight']}}</td>
                                        <td>{{sprintf('%.0f',$baggage_nose['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Baggage (AFT Cabin) Max 140 lbs</td>
                                        <td></td>
                                        <td>{{$baggage_aft_cabin['arm']}}</td>
                                        <td></td>
                                        <td>{{$baggage_aft_cabin['weight']}}</td>
                                        <td>{{sprintf('%.0f',$baggage_aft_cabin['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>Aft Fuselage Baggage-Forward (Max 200 lb)</td>
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_forward['arm']}}</td>
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_forward['weight']}}</td>
                                        <td>{{sprintf('%.0f',$aft_fuselage_baggage_forward['mom'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>Aft Fuselage Baggage-Aft (Max 200 lb)</td>
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_aft['arm']}}</td>
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_aft['weight']}}</td>
                                        <td>{{sprintf('%.0f',$aft_fuselage_baggage_aft['mom'])}}</td>
                                    </tr>
                                    <tr class="font-bold">
                                        <td class="font-normal" style="vertical-align:top">16</td>
                                        <td class="bg_grey">Zero Fuel Weight<br> (Do Not Exceed 10,000 lbs)</td>
                                        <td></td>
                                        <td class="bg_grey">{{$zero_fuel_weight['arm']}}</td>
                                        <td></td>
                                        <td class="bg_grey">{{$zero_fuel_weight['weight']}}</td>
                                        <td class="font-normal bg_grey">{{sprintf('%.0f',$zero_fuel_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>Take Off Fuel <b>(Max Usable 3670 lbs)</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>{{$take_off_fuel['weight']}}</b></td>
                                        <td>{{$take_off_fuel['momentum']}}</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top">18</td>
                                        <td>Ramp Weight<br><b>(Do Not Exceed 12,591 lbs)</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$ramp_weight['weight']}}</td>
                                        <td>{{sprintf('%.0f',$ramp_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>19</td>
                                        <td>Less Fuel for Start and Taxi</td>
                                        <td>{{$less_fuel_start['weight']}}</td>
                                        <td></td>
                                        <td>{{$less_fuel_start['mom']}}</td>
                                        <td>{{$less_fuel_start['weight']}}</td>
                                        <td>{{$less_fuel_start['mom']}}</td>
                                    </tr>
                                    <tr class="font-bold">
                                        <td class="font-normal" style="vertical-align:top">16</td>
                                        <td class="bg_grey">Total Take Off Weight<br> (Do Not Exceed 12,500 lbs)</td>
                                        <td></td>
                                        <td class="bg_grey">{{$total_takeoff_weight['arm']}}</td>
                                        <td></td>
                                        <td class="bg_grey">{{$total_takeoff_weight['weight']}}</td>
                                        <td class="font-normal bg_grey">{{sprintf('%.0f',$total_takeoff_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td colspan="6" class="text-center"><b>Landing Weight Determination</b></td>
                                    </tr>
                                    <tr>
                                        <td>21</td>
                                        <td>Zero Fuel Weight from Line 16</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$zero_fuel_weight['weight']}}</td>
                                        <td>{{sprintf('%.0f',$zero_fuel_weight['momentum'])}}</td>
                                    </tr>
                                    <tr>
                                        <td>22</td>
                                        <td>Total Anticipated Landing Fuel Remaining</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>{{$remaining_fuel['weight']}}</b></td>
                                        <td>{{$remaining_fuel['momentum']}}</td>
                                    </tr>
                                    <tr class="font-bold">
                                        <td class="font-normal" style="vertical-align:top">23</td>
                                        <td class="bg_grey">Total Landing Weight<br> (Do Not Exceed 11,600 lbs)</td>
                                        <td></td>
                                        <td class="bg_grey">{{$total_landing_weight['arm']}}</td>
                                        <td></td>
                                        <td class="bg_grey">{{$total_landing_weight['weight']}}</td>
                                        <td class="font-normal bg_grey">{{round($total_landing_weight['momentum'])}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-tb-10"><p><i># For C.G. Limit Ref C.G. envelope on AFM, Section 6 - Weight & Balance, Page 6-16 on reverse</p></i></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p style="padding-left:90px;"><i>Total Moment</i></p>
                            <p><i>C.G. of Flight = &nbsp; ---------------&nbsp; x 100 = &nbsp;&nbsp;&nbsp;inch</i></p>
                            <p style="padding-left:90px;"><i>Total Weight</i></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-tb-10">
                            <p><i>Allowable Fwd C.G. up to 12,500 lbs = 294.37 inch ; AFT CG up to 10,000 lbs = 303.97 inch ; Aft C.G. up to</i></p>
                            <p><i>12,500 lbs = 300.14 inch</i></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 p-b-10"><p>It is certified that C.G. falls within the limits.</p></div>
                    </div>
                    <div class="row" style="height:35px;">
                        <div class="font-bold" style="width:60%;display: inline-block;">Date: <span style="text-transform: uppercase;">{{$date}}</span></div>
                        <div class="font-bold" style="width:40%;display: inline-block;padding: 0;margin:0;"><p>Signature of PIC :</p><p>License No :</p></div>
                    </div>
                    <div class="row">
                        <p style="width:60%;display: inline-block;">Approved vide DDG, Mumbai. Letter No. A-7/SSF/1800</p>
                        <p style="width:40%;display: inline-block;">Dated : 01-JUL-2013</p>
                    </div>
                </div>
            </div>
    </body>
</html>