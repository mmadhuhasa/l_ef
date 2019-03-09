<style>
    .pdfsec {font-family: sans-serif;font-size: 12px;}
    .rcal_table1, .rcal_table3 {width: 100%;}
    .rcal_table2 {width: 70%;margin:0 auto;}
    .rcal_table3, .rcal_table3 th, .rcal_table3 td {border:1px solid #000;border-collapse: collapse;}
    .rcal_table3 {text-align: center;}
    .comput_text {text-align: center;text-transform: uppercase;text-decoration: underline;font-weight: bold;padding-top: 10px;}
</style>

<div class="pdfsec" style="margin-top:-15px;">
    <p style="text-align: center">LOGO</p>
    <p style="text-align: center;font-weight: bold;margin: 0;">Reliance Commercial Dealers Limited</p>
    <p style="text-align: center;text-decoration: underline;font-weight: bold;margin:0;margin-top:5px;">LOAD AND TRIM SHEET</p>
    <p style="text-align: center;margin-top:5px;">(Approved Vide DGCA Letter No. : A7/NMA/515/14 dated 20 March 2014)</p>
    <table class="rcal_table1">
                    <tr>
                        <td style="width: 20%;">Type of Helicoptor</td>
                        <td style="width:4%;" class="text-center">:</td>
                        <td style="width: 26%;">Sikorsky S 76C</td>
                        <td style="width: 20%;">Type of Engine</td>
                        <td style="width:4%;" class="text-center">:</td>
                        <td style="width: 26%;">Arriel 2S2 Engine</td>
                    </tr>
                    <tr>
                        <td>Registration No.</td>
                        <td class="text-center">:</td>
                        <td>VT-NMA</td>
                        <td>A/C Serial No.</td>
                        <td class="text-center">:</td>
                        <td>760727</td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td class="text-center">:</td>
                        <td>{{$date}}</td>
                        <td>Flight Sector</td>
                        <td class="text-center">:</td>
                        <td>RCO-RCP</td>
                    </tr>
                    <tr>
                        <td>OAT</td>
                        <td class="text-center">:</td>
                        <td>39</td>
                        <td>Pr Altitude</td>
                        <td class="text-center">:</td>
                        <td>20</td>
                    </tr>
                </table>
                <p class="comput_text">Computation</p>
                <table class="rcal_table2">
                    <tr>
                        <td style="text-align: right;">a)</td>
                        <td>MAX TAKE OFF WEIGHT</td>
                        <td>:</td>
                        <td>11700 Lbs (5307 Kgs)</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">b)</td>
                        <td>DATUM</td>
                        <td>:</td>
                        <td>200 inches forward of the M/R centroid</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">c)</td>
                        <td>EMPTY WEIGHT</td>
                        <td>:</td>
                        <td>8396.53 Lbs</td>
                    </tr>
                    <tr>
                        <td style="text-align: right;">d)</td>
                        <td>EMPTY WEIGHT CG</td>
                        <td>:</td>
                        <td>206.86 Inches</td>
                    </tr>
                </table>
                <br>
                <table class="rcal_table3">
                    <tr>
                        <th style="width: 49%;">Description</th>
                        <th style="width: 17%;">Weight (Lbs)</th>
                        <th style="width: 17%;">Arm (Inch)</th>
                        <th style="width: 17%;">Moment (Lbs inch)</th>
                    </tr>
                    <tr>
                        <td>Basic Empty Weight</td>
                        <td>{{$empty_weight['weight']}}</td>
                        <td>{{$empty_weight['arm']}}</td>
                        <td>{{$empty_weight['mom']}}</td>
                    </tr>
                    <tr>
                        <td>Pilot</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['weight'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['arm'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['mom'])}}</td>
                    </tr>
                    <tr>
                        <td>Co-Pilot</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['weight'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['arm'])}}</td>
                        <td>{{sprintf('%.2f',$pilot_co_pilot['mom'])}}</td>
                    </tr>
                    <tr>
                        <td>Aft Facing Passenger (3 Max)</td>
                        <td>{{sprintf('%.2f',$aft_sum_pax)}}</td>
                        <td>133</td>
                        <td>{{sprintf('%.2f',$aft_sum_mom)}}</td>
                    </tr>
                    <tr>
                        <td>Fwd Facing Passenger (2 Max)</td>
                        <td>{{sprintf('%.2f',$fwd_sum_pax)}}</td>
                        <td>233</td>
                        <td>{{sprintf('%.2f',$fwd_sum_mom)}}</td>
                    </tr>
                    <tr>
                        <td>Baggage Compartment (600 Lbs Max)</td>
                        <td>{{sprintf('%.2f',$cargo['weight'])}}</td>
                        <td>{{sprintf('%.2f',$cargo['arm'])}}</td>
                        <td>{{sprintf('%.2f',$cargo['mom'])}}</td>
                    </tr>
                    <tr>
                        <td>Fuel (1884 Lbs Max)</td>
                        <td>{{sprintf('%.2f',$take_off_fuel['weight'])}}</td>
                        <td>{{sprintf('%.2f',$take_off_fuel['arm'])}}</td>
                        <td>{{sprintf('%.2f',$take_off_fuel['momentum'])}}</td>
                    </tr>
                    <tr>
                        <td>TOTAL</td>
                        <td>{{sprintf('%.2f',$total_takeoff_weight['weight'])}}</td>
                        <td></td>
                        <td>{{sprintf('%.2f',$total_takeoff_weight['momentum'])}}</td>
                    </tr>
                </table>
                  <p style="position: relative;font-weight: bold; padding-top:10px; padding-left: 15px;">CG for the Flight &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<span style="border-bottom: 1px solid #000;position: absolute;top:-7px;">&nbsp; {{sprintf('%.2f',$total_takeoff_weight['momentum'])}} &nbsp;</span><span style="position: absolute;top:20px;left:22%;">{{sprintf('%.2f',$total_takeoff_weight['weight'])}}</span><span style="padding-left: 100px;padding-right: 50px;">:</span><span style="padding-right: 50px;">sumit height</span>Inches</p>
                  <p style="padding-left:15px;">It is certified that the CG falls within allowable range as per RFM CG graph image 1.4 (Part 1 Section I) / 2.2 (Part 2 Section II)</p>
                  <p style="font-weight: bold;padding-top: 50px;padding-left: 15px;">Signature of PIC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<span>____________</span><span style="padding-left: 30%;padding-right: 30px; ">Name & Licence No.</span>: <span>&nbsp; ____________</span></p>
</div>