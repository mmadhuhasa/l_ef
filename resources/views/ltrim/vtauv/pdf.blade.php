<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
<style>
     .sec_air-cr, .sec_air-cr th, .sec_air-cr td {border-collapse:collapse;}
   .sec_air-cr {border: 1px solid #000;width: 100%;}
    .sec_air-cr>tbody>tr>td{
      padding: 0px;
      font-size: 12px;
        border: 1px solid #333;
        text-align: center;
    }
</style>
</head>
<body>
<div class="page">
    <main>
        <div style="width:100%; font-family:arial,sans-serif;background: #fff;
                  margin: 0;padding: 0;">
          <div style="    text-align: center;font-size: 17px;text-transform: uppercase; font-weight: bold;padding-top:0; padding-bottom: 0;
            border: 2px solid #333;">
            <p style="margin:0;">FLY-BY-WIRE INTERNATIONAL PVT. LTD.</p>
            <p style="padding-left: 70px;font-size: 17px;margin-top: 10px;
              margin-bottom: 3px;">LOAD and TRIM SHEET</p>
          </div>
            <table class="table  table-bordered" style="margin-bottom: 0px;">
              <tbody>
                <tr style="font-size: 14px;">
                <td style="padding-left: 10px;"><span style="font-weight: bold;padding-left: 0px;">Aircraft Type:</span> CL 600-2B16(605) </td>
                <td style="font-weight: bold;padding-left: 60px;
                      ">AIRCRAFT REGN: VT-AUV</td>
                <td style="font-weight: bold;padding-left: 90px;
                    ">MSN: 5706 </td>
                </tr>
              </tbody>
            </table>
              <table class="sec_air-cr table table-bordered" style="margin-bottom: 2px;">
                <thead>
                <tr style="background:#ccc;font-weight:bold;font-size: 14px;border-top: 1PX solid #333;border: 1px solid #333;text-align: center;font-size: 14px;">
                        <th style=" border:2px solid #333;padding-left: 5px;padding-right: 5px;width:5%">
                       
                        </th>
                        <th style="text-align: center;width: 40%;border:2px solid #333;">
                        ITEM
                        </th>
                        <th style="width: 20%;border:2px solid #333;">WEIGHT (LBS)</th>
                        <th style="width: 10%;border:2px solid #333;">ARM (INCH)</th>
                        <th style="width: 15%;border:2px solid #333;">MOMENT/1000 (LBS.INCH)</th>
                        <th style="width: 5%;border:2px solid #333;">CG</th>
                      </tr>
                </thead>
                <tbody>
                  <tr>
                    <td style="padding:2px;font-weight: bold;">A</td>
                    <td style="text-align: left;padding:2px; ">BASIC EMPTY WEIGHT</td>
                    <td>{{sprintf('%.2f',$empty_weight['weight'])}}</td>
                    <td>{{sprintf('%.2f',$empty_weight['arm'])}}</td>
                    <td>{{sprintf('%.2f',$empty_weight['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr>
                  <tr>
                    <td style="padding:2px;font-weight: bold;">B</td>
                    <td style="text-align: left;padding:2px; "> CREW</td>
                    <td>{{sprintf('%.2f',$pilot_co_pilot['weight'])}}</td>
                    <td>{{sprintf('%.2f',$pilot_co_pilot['arm'])}}</td>
                    <td>{{sprintf('%.2f',$pilot_co_pilot['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">C</td>
                    <td style="text-align: left;padding:2px; ">JUMP SEAT</td>
                    <td>{{sprintf('%.2f',$jump['weight'])}}</td>
                    <td>{{sprintf('%.2f',$jump['arm'])}}</td>
                    <td>{{sprintf('%.2f',$jump['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr>
                  <tr >
                    <td style="padding:2px;font-weight: bold;">D</td>
                    <td style="text-align: left;padding:2px;font-weight: bold; ">Removable items</td>
                     <td style="background:#555"></td>
                    <td style="background:#555"></td>
                    <td style="background:#555"></td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">1</td>
                    <td style="text-align: left;padding:2px; ">POTABLE WATER (83.29 LBS MAX)</td>
                    <td>{{sprintf('%.2f',$potable_water['weight'])}}</td>
                    <td>{{sprintf('%.2f',$potable_water['arm'])}}</td>
                    <td>{{sprintf('%.2f',$potable_water['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">2</td>
                    <td style="text-align: left;padding:2px; ">CATERING ALLOWANCE (175 LBS MAX)</td>
                   <td>{{sprintf('%.2f',$catering_allowance['weight'])}}</td>
                    <td>{{sprintf('%.2f',$catering_allowance['arm'])}}</td>
                    <td>{{sprintf('%.2f',$catering_allowance['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">3</td>
                    <td style="text-align: left;padding:2px; ">TOILET CHARGE (18.52 LBS MAX)</td>
                    <td>{{sprintf('%.2f',$toilet_charge['weight'])}}</td>
                    <td>{{sprintf('%.2f',$toilet_charge['arm'])}}</td>
                    <td>{{sprintf('%.2f',$toilet_charge['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">4</td>
                    <td style="text-align: left;padding:2px; ">LIFE RAFT (131.00 LBS, QTY 2)</td>
                    <td>{{sprintf('%.2f',$lift_raft['weight'])}}</td>
                    <td>{{sprintf('%.2f',$lift_raft['arm'])}}</td>
                    <td>{{sprintf('%.2f',$lift_raft['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">E</td>
                    <td style="text-align: left;padding:2px;font-weight: bold; ">DRY OPERATING WEIGHT</td>
                    <td>{{sprintf('%.2f',$dry_os['weight'])}}</td>
                    <td>{{sprintf('%.2f',$dry_os['arm'])}}</td>
                    <td>{{sprintf('%.2f',$dry_os['moment'])}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold">F</td>
                    <td style="text-align: left;padding:2px;font-weight: bold ">Passengers</td>
                    <td style="background:#555 "></td>
                    <td style="background:#555 "></td>
                    <td style="background:#555 "></td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">1</td>
                    <td style="text-align: left;padding:2px; ">AFT FACING SEAT (SEAT #4)</td>
                    <td>@if(array_key_exists("weight",$paxs[0])) {{sprintf('%.0f',$paxs[0]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[0]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[0])) {{sprintf('%.2f',$paxs[0]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">2</td>
                    <td style="text-align: left;padding:2px; ">AFT FACING SEAT (SEAT #5)</td>
                     <td>@if(array_key_exists("weight",$paxs[1])) {{sprintf('%.0f',$paxs[1]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[1]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[1]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">3</td>
                    <td style="text-align: left;padding:2px; ">FWD FACING SEAT (SEAT #6)</td>
                    <td>@if(array_key_exists("weight",$paxs[2])) {{sprintf('%.0f',$paxs[2]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[2]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[2]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">4</td>
                    <td style="text-align: left;padding:2px; ">FWD FACING SEAT (SEAT #7)</td>
                    <td>@if(array_key_exists("weight",$paxs[3])) {{sprintf('%.0f',$paxs[3]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[3]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[3]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">5</td>
                    <td style="text-align: left;padding:2px; ">AFT FACING SEAT (SEAT #8)</td>
                    <td>@if(array_key_exists("weight",$paxs[4])) {{sprintf('%.0f',$paxs[4]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[4]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[4]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">6</td>
                    <td style="text-align: left;padding:2px; ">FWD FACING SEAT (SEAT#9)</td>
                    <td>@if(array_key_exists("weight",$paxs[5])) {{sprintf('%.0f',$paxs[5]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[5]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[5]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">7</td>
                    <td style="text-align: left;padding:2px; ">DIVAN SEAT (SEAT #10)</td>
                    <td>@if(array_key_exists("weight",$paxs[6])) {{sprintf('%.0f',$paxs[6]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[6]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[6]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">8</td>
                    <td style="text-align: left;padding:2px; ">DIVAN SEAT (SEAT #11)</td>
                    <td>@if(array_key_exists("weight",$paxs[7])) {{sprintf('%.0f',$paxs[7]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[7]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[7]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="text-align: right;padding:2px;">9</td>
                    <td style="text-align: left;padding:2px; ">DIVAN SEAT (SEAT #12)</td>
                    <td>@if(array_key_exists("weight",$paxs[8])) {{sprintf('%.0f',$paxs[8]['weight'])}} @else 0 @endif</td>
                    <td>{{sprintf('%.2f',$paxs[8]['arm'])}}</td>
                    <td>@if(array_key_exists("moment",$paxs[8])) {{sprintf('%.2f',$paxs[8]['moment'])}} @else 0 @endif</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">G</td>
                    <td style="text-align: left;padding:2px; ">BAGGAGE (MAX 900 LBS)</td>
                    <td>{{$baggage['weight']}}</td>
                    <td>{{$baggage['arm']}}</td>
                    <td>{{$baggage['moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;font-style: italic; ">
                    <td style="padding:2px;">H</td>
                    <td style="text-align: left;padding:2px; ">Zero Fuel weight (32000lbs max) (A+B+C+D+E)</td>
                    <td>{{$zero_fuel_weight['weight']}}</td>
                    <td></td>
                    <td>{{$zero_fuel_weight['moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;background: #fff;"></td>
                  </tr><tr>
                    <td style="padding:2px;"></td>
                    <td style="text-align: left;padding:2px; ">MAIN TANK</td>
                    <td>{{$tank['main_tank_weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$tank['main_tank_moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;"></td>
                    <td style="text-align: left;padding:2px; ">AUX TANK</td>
                    <td>{{$tank['aux_tank_weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$tank['aux_tank_moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;"></td>
                    <td style="text-align: left;padding:2px; ">TAIL TANK</td>
                    <td>{{$tank['tail_tank_weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$tank['tail_tank_moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">I</td>
                    <td style="text-align: left;padding:2px; ">TOTAL</td>
                    <td style="font-weight: bold;">{{$take_off_fuel}}</td>
                    <td style="background: #555;"></td>
                    <td></td>
                    <td style="border-bottom:0px;border-top: 0px;"></td>
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;font-style: italic;">
                    <td style="padding:2px;">J</td>
                    <td style="text-align: left;padding:2px; ">Ramp weight (48300 lbs max) (F + Fuel)</td>
                    <td>{{$ramp_weight['weight']}}</td>
                    <td></td>
                    <td>{{$ramp_weight['moment']}}</td>
                    <td style="border-bottom:0px;border-top: 0px;background: #fff;"></td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;">K</td>
                    <td style="text-align: left;padding:2px; ">Taxi-Out Fuel</td>
                    <td>{{$taxi_out_fuel['weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$taxi_out_fuel['moment']}}</td>
                    <td style="font-weight: bold;">CG</td>
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;font-style: italic;">
                    <td style="padding:2px;">L</td>
                    <td style="text-align: left;padding:2px; ">Take-off weight (48200 lbs max) (G - Taxi out Fuel)</td>
                    <td>{{$take_off_weight['weight']}}</td>
                    <td>{{$take_off_weight['arm']}}</td>
                    <td>{{$take_off_weight['moment']}}</td>
                    <td style="font-weight: bold;">{{$cg_tof_wt}}</td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;text-align:center;">M</td>
                    <td style="text-align: left;padding:2px; ">Fuel  to Destination/ ApproachT</td>
                    <td>{{$block_fuel['weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$block_fuel['moment']}}</td>
                    <td></td>
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;font-style: italic;">
                    <td style="padding:2px;text-align:center;">N</td>
                    <td style="text-align: left;padding:2px;">Landing Weight (38000 lbs max)</td>
                    <td>{{$landing_weight['weight']}}</td>
                    <td>{{$landing_weight['arm']}}</td>
                    <td>{{$landing_weight['moment']}}</td>
                    <td style="font-weight: bold;">{{$cg_land_wt}}</td>
                  </tr><tr>
                    <td style="padding:2px;font-weight: bold;text-align:center;">O</td>
                    <td style="text-align: left;padding:2px;">Diversion Fuel</td>
                    <td>{{$diversion_fuel['weight']}}</td>
                    <td style="background: #555;"></td>
                    <td>{{$diversion_fuel['moment']}}</td>
                    <td style="border-bottom:0px;"></td>
                  </tr>
                  <tr style="background: #ccc;font-weight: bold;">
                    <td style="padding:2px;font-style: italic;text-align:center;">P</td>
                    <td style="text-align: left;padding:2px; ">Landing weight at alternate</td>
                    <td>{{$landing_fuel_alternate['weight']}}</td>
                    <td>{{$landing_fuel_alternate['arm']}}</td>
                    <td>{{$landing_fuel_alternate['moment']}}</td>
                    <td style="border-top: 0px;background: #fff;"></td>
                  </tr>
                </tbody>
              </table>
               <div style="font-size: 12px;border:1px solid #333;font-weight: normal;padding: 2px; ">
              <div>
                <p>IT IS CERTIFIED THAT THE CG FALLS WITHIN THE ENVELOPE AS PER THE GRAPH IN CL-604 WEIGHT & BALANCE MANUAL FIGURE 5 ON PAGE NO.64.</p>
                <p style="border-bottom:1px solid #333;padding-bottom: 2px;">
                   SIGNATURE OF THE PIC.______________&nbsp;&nbsp;ALTP NO. _______________ &nbsp;DATE: ________________</p>
                </div>
                <div style="font-size:12px;">
                  <p>* Note: Total Dry Operating Weight will vary as per the weight of person on Jump Seat,Catering Allowance and Life Raft on board    Note 2: Diversion Fuel should be taken as per CAR Section 8 Series Ó'Part-II   Note 3:  Std Wt of pax as per Op Manual Issue:1 Rev:0 dated 07.04.2015 are Crew: 187 lbs (85Kg), Adult Pax: 170 lbs (77Kg), Children (Age 2-12yrs): 77 lbs (35Kg),Infant< 2 Years 22 lbs(10 Kg)</p>
                </div>
            </div>
        </div>
    </main>
</div>

</body>
</html>
