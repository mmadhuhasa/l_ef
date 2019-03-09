<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">
        <title>Document</title>
<style type="text/css">
   .sec_container{
        width:100%; 
       font-family:arial,sans-serif;
background: #fff;
   }
   .sec_vrl{
     text-align: center;
    font-size: 12px;
    font-weight: bold;
   }
   .sec_air{
    text-align: center;
    font-size: 11px;
    font-weight: bold;
    padding-left: 94px;
   }
   .p-lr-0{
    padding-left: 0;
    padding-right: 0;
   }
   .sec_ser>thead>tr>td{
    font-size: 12px;
    border-right: 1px solid #333;
    border:1px solid #333;
    font-weight: bold;
   }
   .sec_ser>tbody>tr>td{
    font-size: 12px;
    border-right: 1px solid #333;
    padding: 0;
    text-align: center;
     border:1px solid #333;
   }
   .sec_ser>tbody>tr>td:nth-child(2){
    text-align: left;
    padding-left: 5px;
   }
   .sec_wt{
    padding-left: 40px;
    font-size: 12px;
   }
   .sec_wt1{
   padding-left: 133px;
   font-size: 12px;
   }
   .sec_wt2{
   padding-left: 51px;
   font-size: 12px;
   }
   .sec_wt3{
   padding-left: 71px;
   font-size: 12px;
   }
   .sec_ser, .sec_ser th, .sec_ser td {border-collapse:collapse;}
   .sec_ser {border: 2px solid #000;width: 100%;}
</style>
</head>
<body>
<div class="page">
    <main>
      <div class="container sec_container">
      <div class="download_img">
          <div>
              <p class="sec_vrl" style="text-align:center;margin-bottom:0;">
              <span style="border-bottom:2px solid #333;display:inline;">VRL LOGISTICS LIMITED (AVIATION DIVISION)</span></p>
              <p class="sec_air" style="margin-top:0;">
              Aircraft Type : Premier 1 (VT-ANF)                               
                </p> 
                <div  style="width:50%;display: inline-block;padding-left: 40px;">
                <p style="font-size: 13px;">
                From : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$from}}
                </p>
                </div>
                <div style="width:30%;display: inline-block;">
                <p style="text-align: right;font-size: 13px;">
                TO :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{$to}}
                </p> 
                </div>                                        
          </div>
          <div class="col-md-12 sec_wei  p-lr-0">
              
              <table class="sec_ser table table-bordered">
                  <thead>
                      <tr>
                          <td colspan="5" style="vertical-align:bottom;"><p style="margin-bottom:0;text-align:center;">WEIGHT AND BALANCE LOADING FORM</p></td>
                      </tr>
                      <tr>
                          <td colspan="3">
                              <span style="width: 50%;display: inline-block;text-align: center;border-right: 1px solid #333;">SERIAL NO : <u>RB 218</u>
                          </span>
                              <span style="width: 50%;display: inline-block;text-align: center;">REGISTRATION NO: <u>VT-ANF</u></span>
                          </td>
                          <td> DATE:</td>
                          <td style="text-align:center;">12-Feb-16</td>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td style="text-align: center;width: 5%;">LINE</td>
                        <td style="text-align: center; width: 59%;">ITEM</td>
                        <td style="width:13%;">WEIGHT (LB)</td>
                        <td style="width:11%;">C.G(IN)</td>
                        <td style="width:15%;">MOM/100 (LB-IN)</td>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>Basic Empty Weight</td>
                        <td>{{$empty_weight['weight']}}</td>
                        <td>{{sprintf('%.2f',$empty_weight['arm'])}}</td>
                        <td>{{sprintf('%.2f',$empty_weight['mom'])}}</td>
                      </tr>
                      <tr>
                        <td >2</td>
                        <td>Crew</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['weight'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['arm'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['mom'])}}</td>
                      </tr>
                      <tr style="font-weight: bold;">
                        <td style="font-weight: normal;font-size: 12px;border:2px solid black;border-right: 1px solid #000;">
                        4
                        </td>
                        <td style="font-size: 13px;text-align: center;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000">
                        OPERATING WEIGHT
                        </td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">
                        {{sprintf('%.2f',$empty_os['wt'])}}
                        </td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">
                        {{sprintf('%.2f',$empty_os['arm'])}}
                        </td>
                        <td style="font-size: 13px;border:2px solid black;border-left: 1px solid #000;">
                        {{sprintf('%.2f',$empty_os['mom'])}}
                        </td>
                      </tr>
                      <tr>
                        <td >5</td>
                        <td style="text-align: center;">Passengers</td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Forward RH Aft Facing </td>
                         <td>@if(array_key_exists("calculate_wt",$paxs[0])) {{sprintf('%.2f',$paxs[0]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[0]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[0])) {{sprintf('%.2f',$paxs[0]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Forward LH Aft Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[1])) {{sprintf('%.2f',$paxs[1]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[1]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[1])) {{sprintf('%.2f',$paxs[1]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Center, Forward Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[2])) {{sprintf('%.2f',$paxs[2]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[2]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[2])) {{sprintf('%.2f',$paxs[2]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Center, Forward Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[3])) {{sprintf('%.2f',$paxs[3]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[3]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[3])) {{sprintf('%.2f',$paxs[3]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Aft, Forward Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[4])) {{sprintf('%.2f',$paxs[4]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[4]['arm']}}</td>
                        <td>@if(array_key_exists("calculate_mom",$paxs[4])) {{sprintf('%.2f',$paxs[4]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Aft, Forward Facing  </td>
                        <td>@if(array_key_exists("calculate_wt",$paxs[5])) {{sprintf('%.2f',$paxs[5]['calculate_wt'])}} @else 0.00 @endif</td>
                        <td>{{$paxs[5]['arm']}}</td>
                         <td>@if(array_key_exists("calculate_mom",$paxs[5])) {{sprintf('%.2f',$paxs[5]['calculate_mom'])}} @else 0.00 @endif</td>
                      </tr>
                      <tr>
                        <td >6</td>
                        <td style="text-align: center;">
                        Baggage
                        </td>
                        <td>0</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Nose</td>
                        <td>0</td>
                        <td>100</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Aft, Cabin</td>
                        <td>0</td>
                        <td>330</td>
                        <td>0.00</td>
                      </tr>
                      <tr>
                        <td ></td>
                        <td>Aft, Fuselage-Fwd</td>
                         <td>0</td>
                        <td>371</td>
                        <td>0</td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>Aft,Fuselage-Aft</td>
                        <td>{{$cargo['weight']}}</td>
                        <td>{{$cargo['arm']}}</td>
                        <td>{{sprintf('%.2f',$cargo['mom'])}}</td>
                      </tr>
                      <tr>
                        <td>7</td>
                        <td>Cabinet Contents</td>
                        <td>0</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr style="font-weight: bold;font-size: 12px;">
                        <td style="font-weight:normal;border:2px solid #000;border-right: 1px solid #000;">8</td>
                        <td style="font-size: 12px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">
                        ZERO FUEL WEIGHT( DO NOT EXCEED 10000 LBS/4535.93 KGS)</td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">{{sprintf('%.2f',$zero_fuel_weight['weight'])}}</td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">{{sprintf('%.2f',$zero_fuel_weight['arm'])}}</td>
                        <td style="font-size: 13px;border:2px solid #000;border-left: 1px solid #000;">{{sprintf('%.2f',$zero_fuel_weight['momentum'])}}</td>
                      </tr>
                      <tr>
                        <td >9</td>
                        <td>Fuel @ 6.7lb/Gal</td>
                        <td>{{$take_off_fuel['weight']}}</td>
                        <td></td>
                        <td>{{$take_off_fuel['momentum']}}</td>
                      </tr>

                      <tr style="font-weight: bold;font-size: 12px;">
                        <td style="font-weight:normal;border:2px solid #000;border-right:1px solid #000;">10</td>
                        <td style="border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">RAMP WEIGHT ( DO NOT EXCEED 1259 LBS/5711.19 KGS)</td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">{{sprintf('%.2f',$ramp_weight['weight'])}}</td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">{{sprintf('%.2f',$ramp_weight['arm'])}}</td>
                        <td style="font-size: 13px;border:2px solid black;border-left: 1px solid #000;">{{sprintf('%.2f',$ramp_weight['momentum'])}}</td>
                      </tr>
                       <tr>
                        <td >11</td>
                        <td>Less Fuel for Start, Taxi and Take Off</td>
                        <td>{{$less_fuel_start['weight']}}</td>
                        <td></td>
                        <td>{{$less_fuel_start['mom']}}</td>
                      </tr>

                       <tr style="font-weight: bold;font-size: 12px;">
                        <td style="font-weight:normal;border:2px solid #000;border-right:1px solid #000;">12</td>
                        <td style="border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">TAKE OFF WEIGHT ( DO NOT EXCEED 12500 LBS/5670 KGS)</td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">{{sprintf('%.2f',$total_takeoff_weight['weight'])}}</td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">{{sprintf('%.2f',$total_takeoff_weight['arm'])}}</td>
                        <td style="font-size: 13px;border:2px solid black;border-left: 1px solid #000;">{{sprintf('%.2f',$total_takeoff_weight['momentum'])}}</td>
                      </tr>
                      <tr>
                        <td >13</td>
                        <td>Total Fuel from Line 9</td>
                        <td>{{$take_off_fuel['weight']}}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td >14</td>
                        <td>Less Fuel used to Destination including Start, Taxi and Take Off</td>
                        <td>{{$lessfuel_dest['weight']}}</td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td >15</td>
                        <td>Total fuel remaining</td>
                        <td>{{$remaining_fuel['weight']}}</td>
                        <td></td>
                        <td>{{sprintf('%.2f',$remaining_fuel['momentum'])}}</td>
                      </tr>
                       <tr>
                        <td >16</td>
                        <td>ZERO FUEL WEIGHT from Line 8</td>
                        <td>{{sprintf('%.2f',$zero_fuel_weight['weight'])}}</td>
                        <td>{{sprintf('%.2f',$zero_fuel_weight['arm'])}}</td>
                        <td>{{sprintf('%.2f',$zero_fuel_weight['momentum'])}}</td>
                      </tr>
                       <tr>
                        <td >17</td>
                        <td>Add fuel remaining from Line 15</td>
                        <td>{{$remaining_fuel['weight']}}</td>
                        <td></td>
                        <td>{{sprintf('%.2f',$remaining_fuel['momentum'])}}</td>
                      </tr>
                      <tr style="font-weight: bold;font-size: 12px;">
                        <td style="font-weight:normal;border:2px solid #000;border-right:1px solid #000;">18</td>
                        <td style="border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">LANDING WEIGHT (DO NOT EXCEED 11600 LBS/5261.68 KGS)</td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">{{sprintf('%.2f',$total_landing_weight['weight'])}}</td>
                        <td style="font-size: 13px;border:2px solid black;border-right: 1px solid #000;border-left: 1px solid #000;">{{sprintf('%.2f',$total_landing_weight['arm'])}}</td>
                        <td style="font-size: 13px;border:2px solid black;border-left: 1px solid #000;">{{sprintf('%.2f',$total_landing_weight['momentum'])}}</td>
                      </tr>
                  </tbody>
              </table>  
          </div><br>
          <div class="col-md-12">
              <p style="margin:0px;">
                  <span style="font-size: 12px;">Note 1:</span>
                  <b><span style="border-bottom:1px solid #333;font-size: 12px;">Passenger Weights</span></b>
              </p>
              <p style="margin:0;"><span class="sec_wt">Wt of each Adult Pax</span> 
              <span class="sec_wt1">75Kgs = 165.34 lbs</span></p>
              <p style="margin:0;margin-top:-3px;"><span class="sec_wt">Wt of each Child Pax (2 yrs to 12 yrs)</span> 
              <span class="sec_wt2">35Kgs = 77.14 Lb</span></p>
            <p style="margin:0;"><span class="sec_wt">Wt of each infant (Less than 2 yrs)</span><span class="sec_wt3">10Kgs = 22.04 Lbs</span></p><br>
            <p style="font-size: 12px;margin-bottom: 0;">Note 2: CG in Inches = (MOMENT ÷ WEIGHT) x 100</p>
             <p style="font-size: 12px;margin-top: 0;margin-bottom: 0;">
             Note 3:  Allowable forward CG Upto 5670 Kgs(12500 Lbs) = F.S.294.37 
            </p>
            <p style="font-size: 12px;padding-left: 40px;margin:0;">
            <span>
            Aft CG Up to4535.93 Kgs (10000 Kgs )
            </span>
            <span style="padding-left: 53px;">
            = F.S.307.97
            </span>
            </p>
            <p style="font-size: 12px;padding-left: 40px;margin:0;">
            <span>
            Aft CG Up to5670 Kgs (12500 Lbs)
            </span>
            <span style="padding-left: 75px;">
            = F.S.300.14
            </span>
            </p>
            <span style="text-align: left;font-size: 12px;">
              Prepared By:
            </span>
            <p style="text-align: right;font-size: 12px;margin-bottom:0">
            
            <span style="padding-right: 37px;">
            Captain :
            </span> 
            <span style="font-weight: bold;">
            Capt Vinod Mittal
            </span>
            </p>
            <p style="text-align: right;font-size: 12px;margin-top: 0;">
            <span style="padding-right: 57px;padding-bottom: 0;">
            ATPL :
            </span> 
            <span style="font-weight: bold;padding-right:15px;">
            ATPL-3452
            </span>
            </p>
          </div>
      </div>
    </main>
</div>
</body>
</html>