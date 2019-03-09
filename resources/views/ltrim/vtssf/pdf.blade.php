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
            .bg_grey {background: #eee;}
            .container {font-size: 11px;}
            .font-normal {font-weight: normal}
            .f-13 {font-size: 11px;}
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
            .main_table > tbody > tr > td:nth-child(2) {text-align:left;padding-left: 5px;} //
            .font-bold {font-weight: bold;}
            .pic_table th{border-bottom: none;}
            .row{clear: both;}

        </style>
    </head>
    <body>

        <div class="container" style="font-family: arial,sans-serif;">
            <div class="row" style="clear: both;">
                <div class="col-md-12">
                        <table style="margin-bottom:10px; border-spacing: 0;border-collapse: collapse;width: 100%;">
                        <tbody style="border:1px solid #333;">
                        <tr>
                        <td style="border-right: 1px solid #333;width:10%;" >
                        <img src="http://demo.privateflight.co.in/media/images/loadtrim/vtssf/logo.png" height="70px">
                        <td colspan="6" style="border-left:1px solid #000;width:90%;">
                        <P style="text-align: center;font-weight: bold;border-bottom: 1px solid #333;font-size: 15px;">LOAD & TRIM SHEET</P>
                        <P><span>Type Of Aircarf: </span> <span style="font-weight: bold;">Hawker Beechcraft Crop. 390 (Permier 1A) </span> 
                        <span style="font-weight: bold;padding-left:10px; ">Date:</span>
                        </P>
                        <p style="padding-top: 5px;"><span>Aircraft Regn : </span> <span style="font-weight: bold;padding-left:5px;"> VT-SSF</span> <span style="font-weight: bold;padding-left: 183px;"> Sector:</span></p>
                        <p style="padding-top: 5px;"><span>Serial NO: </span><span style="padding-left:33px; font-weight: bold;">RB243</span><span style="padding-left: 207px;font-weight: bold;">PIC:</span><span style="padding-left:70px;font-weight: bold; ">CO-PILOT:</span></p>
                        </td>
                        </tr>
                        <tbody>
                        </table>
                        </div>
                    </div>
                    
                    <div class="row" style="clear: both;">
                        <div class="col-md-12">
                            <table class="main_table fullwidth" style="border-spacing: 0;border-collapse: collapse;width: 100%;">
                                <thead>
                                    <tr>
                                        <th rowspan="2">SL.NO.</th>
                                        <th rowspan="2" style="width: 43%;border-right: 0;">DETAILS</th>
                                        <th style="width:5%;border-bottom: 0;border-left:0;"></th>
                                        <th style="border-bottom: 0;">Weight</th>
                                        <th style="border-bottom: 0;">Arm</th>
                                        <th style="width:16%;border-bottom: 0;border-right: 1px solid #333;">MOMENT</th>
                                    </tr>
                                    <tr>
                                    <th style="border-top:0;border-left:0; "></th>
                                        <th class="font-normal" style="border-top:0;font-weight: normal">(W) (LBS.)</th>
                                        <th class="font-normal" style="border-top:0;font-weight: normal">(INCH)</th>
                                        <th class="font-normal" style="border-top:0;border-right: 1px solid #333;font-weight: normal">(M)/100 (LB. IN)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td style="font-weight: bold;border-right:0; ">Basic Empty Weight</td>
                                        <td style="border-left: 0;">A</td>
                                        <td>{{$empty_weight['weight']}}</td>
                                        <td>{{$empty_weight['arm']}}</td>
                                        <td>{{$empty_weight['arm']}}</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Pilot</td>
                                        <td rowspan="8" style="font-weight: bold;">B</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{$pilot_co_pilot['arm']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Co-Pilot</td>
                                        <td>{{$pilot_co_pilot['weight']}}</td>
                                        <td>{{$pilot_co_pilot['arm']}}</td>
                                        <td>{{sprintf('%.0f',$pilot_co_pilot['mom'])}}</td>
                                      
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Seat 1 (LH Row 1, Aft Facing)</td>
                                      
                                        <td>@if(array_key_exists("calculate_wt",$paxs[0])) {{$paxs[0]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[0]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[0])) {{sprintf('%.0f',$paxs[0]['calculate_mom'])}} @else 0 @endif</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Seat 2(RH Row 1, Aft Facing)</td>
                                       <td>@if(array_key_exists("calculate_wt",$paxs[1])) {{$paxs[1]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[1]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[1])) {{sprintf('%.0f',$paxs[1]['calculate_mom'])}} @else 0 @endif</td>
                                      
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Seat 3 (LH Row 2, Fwd Facing)</td>
                                       <td>@if(array_key_exists("calculate_wt",$paxs[2])) {{$paxs[2]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[2]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[2])) {{sprintf('%.0f',$paxs[2]['calculate_mom'])}} @else 0 @endif</td>
                                      
                                    </tr>
                                    <tr>
                                        <td>7</td>
                                        <td>Seat 4 (RH Row 2, Fwd Facing)</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[3])) {{$paxs[3]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[3]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[3])) {{sprintf('%.0f',$paxs[3]['calculate_mom'])}} @else 0 @endif</td>
                                      
                                    </tr>
                                    <tr>
                                        <td>8</td>
                                        <td>Seat 5 (LH Row 3, Fwd Facing)</td>
                                        <td>@if(array_key_exists("calculate_wt",$paxs[4])) {{$paxs[4]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[4]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[4])) {{sprintf('%.0f',$paxs[4]['calculate_mom'])}} @else 0 @endif</td>
                                     
                                    </tr>
                                    <tr>
                                        <td>9</td>
                                        <td>Seat 6 (RH Row 3, Fwd Facing)</td>
                                         <td>@if(array_key_exists("calculate_wt",$paxs[5])) {{$paxs[5]['calculate_wt']}}@endif</td>
                                        <td>{{$paxs[5]['arm']}}</td>
                                        <td>@if(array_key_exists("calculate_mom",$paxs[5])) {{sprintf('%.0f',$paxs[5]['calculate_mom'])}} @else 0 @endif</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>10</td>
                                        <td>Baggage (Nose) Max 150 lbs</td>
                                        <td rowspan="4" style="font-weight: bold;"> C</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{$baggage_nose['arm']}}</td>
                                       
                                    </tr>
                                    <tr>
                                        <td>11</td>
                                        <td>Baggage (AFT Cabin) Max 140 lbs</td>
                                        <td></td>
                                        <td>{{$baggage_aft_cabin['arm']}}</td>
                                        <td></td>
                                       
                                    </tr>
                                    <tr>
                                        <td>12</td>
                                        <td>Aft Fuselage Baggage-Forward (Max 200 lb)</td>
                                
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_forward['arm']}}</td>
                                        <td></td>
                                       
                                    </tr>
                                    <tr>
                                        <td>13</td>
                                        <td>Aft Fuselage Baggage-Aft (Max 200 lb)</td>
                                        
                                        <td></td>
                                        <td>{{$aft_fuselage_baggage_aft['arm']}}</td>
                                        <td></td>
                                       
                                    </tr>
                                    <tr class="font-bold" style="font-weight: bold;">
                                        <td>14</td>
                                        <td class="bg_grey" style="background: #eee;">Total-Zero Fuel Weight - (A+B+C)
                                        <p class="font-normal" style="font-weight: normal">Max. Zero Fuel Weight (10,000 lbs)</p></td>
                                        <td>D</td>
                                        <td></td>
                                        <td>{{$zero_fuel_weight['arm']}}</td>
                                       <td></td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td><b>Total Fuel Uplift</b> 
                                        <p>Fuel (Max Usable 3670 lbs)</p></td>
                                        <td style="font-weight: bold;">E</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                       
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:top">16</td>
                                        <td class="font-bold" style="font-weight: bold;">Total Ramp Weight (D+E)
                                        <p class="font-normal" style="font-weight: normal">(Do Not Exceed 12,591 lbs)</p></td>
                                        <td style="font-weight: bold;">F</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>Less Fuel for Take Off and Taxi</td>
                                        <td style="font-weight: bold;">G</td>
                                        <td>{{$less_fuel_start['weight']}}</td>
                                        <td></td>
                                        <td>{{$less_fuel_start['mom']}}</td>
                                       
                                    </tr>
                                    <tr class="font-bold" style="font-weight: bold;">
                                        <td class="font-normal" style="vertical-align:top;font-weight: normal">18</td>
                                        <td class="bg_grey" style="background: #eee;">Total Take Off Weight and Moment (F-G)
                                        <p class="font-normal" style="font-weight: normal">(Do Not Exceed 12,500 lbs)</p></td>
                                        <td>H</td>
                                        <td></td>
                                        <td class="bg_grey" style="background: #eee;">{{$total_takeoff_weight['arm']}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>19</td>
                                        <td>Total Anticipated Fuel Remaining at Landing
                                        <p>(refer Fuel Mom. Table)</p> </td>
                                        <td style="font-weight: bold;">I</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>20</td>
                                        <td class="font-bold" style="font-weight: bold;">Total Landing Weight (H-I)
                                        <p class="font-normal" style="font-weight: normal">(Do Not Exceed 11,600 lbs)</p></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="6" style="text-align:left;padding:5px;">
                                            I certify that the aircraft has been satisfactorily loaded as per Airplane Flight Manual.
                                            <p><span style="font-weight: bold;">Licence No. ALTP: </span>
                                            <span style="padding-left: 215px;font-weight: bold;">Signature of PIC:</span></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    

                    <div class="row" style="clear: both;">
                        <div class="col-md-12" style="font-size: 12px;">
                            <p style="padding-left:90px;"><i>Total Moment</i></p>
                            <p><i>C.G. of Flight = &nbsp; ---------------&nbsp; x 100 = &nbsp;&nbsp;&nbsp;inch</i></p>
                            <p style="padding-left:90px;"><i>Total Weight</i></p>
                        </div>
                    </div>
                    <div class="row" style="clear: both;">
                        <div style="width:100%;font-size: 12px;">
                        
                              <p class="font-bold" style="margin-bottom: 30px;font-style: italic;font-weight: bold;"><span>Allowable Fwd C.G. up to 12,500 lbs = 294.37</span>  
                              <span style="padding-left:130px; ">AFT C.G. up to 10,000 lbs = 303.97 inch </span></p>
                              <p style="font-style: italic;"><span>Approved vide DDG, Mumbai. Letter No. A-7/SSF/1800 </span>
                               <span style="padding-left: 88px;">Dated : 01-07-2013 </span></p>
                        </div> 
                </div>
            </div>
    </body>
</html>