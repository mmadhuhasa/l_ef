<html>
<head>
<style>
table {
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}
td, th {
border: 1px solid #000;
text-align: left;
padding:6px 1px 6px 1px;
}
.center{
text-align:center;
}
.font_weight{
font-weight:bold;
}
.left{
text-align:left;
}
.right{
text-align:right;
}
.border_right0{
border-right: 0!important;
}
.border_left0{
border-left: 0!important;
}
.border_top0{
border-top:0!important;
}
.border_bottom0{
border-bottom:0!important;
}
.border0{
border:none;
}
.fontsize14{
font-size:12px;
}
.fontsize12{
font-size:11px;
}
.noBorder{
border:0;
}
</style>
</head>
<body>
      <img style="display:block;margin-left: auto;margin-right: auto;" src="https://www.eflight.aero/media/images/loadtrim/vtepu/Airport-Authority.png"/>
       <table style="padding-top:0px;margin-top:100px;">
          <tr>
             <th style="border:none;font-size:16px;">Weight and Balance</th>
          </tr>
       </table>
       <table style="margin-bottom:10px;width:100%;">
          <tr>
             <th class="border_right0" style="font-size:15px;">Call Sign. VTEPU</th>
             <th class="center border_right0 border_left0" style="font-size:15px;">Registration No.</th>
             <th class="center border_left0" style="font-size:15px;">Date {{$date}}</th>
          </tr>
       </table>
       <table>
          <tr>
             <th colspan="4" class="center fontsize14">Passanger, Baggage, Cargo and Service Load</th>
             <th class="center fontsize14">REF</th>
             <th class="center fontsize14">ITEM</th>
             <th class="center fontsize14">WEIGHT <br>(Kg)</th>
             <th class="center fontsize14">MOMENT <br>(m Kg)</th>
             <th class="center fontsize14"></th>
          </tr>
          <tr>
             <td class="center font_weight fontsize14">ITEM</td>
             <td class="center font_weight fontsize14">ARM <br>(m)</td>
             <td class="center font_weight fontsize14">WEIGHT <br>(kg)</td>
             <td class="center font_weight fontsize14">MOMENT <br>(m Kg)</td>
             <td class="center font_weight fontsize14">1.</td>
             <td class="center font_weight fontsize14"><span>BASIC WEIGHT</span><br>(Ldg. Gaar Down)</td>
             <td class="center fontsize14 font_weight">{{$empty_weight['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$empty_weight['mom']}}</td>
             <td rowspan="3" class="center fontsize14"></td>
          </tr>
          <tr>
             <td class="center border_bottom0 font_weight fontsize14">Seat - 1</td>
             <td class="center font_weight border_left0 border_bottom0 fontsize14 font_weight">@if($pax[0]['arm']!=0){{$pax[0]['arm']}} @endif</td>
             <td class="center border_left0 border_bottom0 fontsize14 font_weight">@if($pax[0]['weight']!=0){{$pax[0]['weight']}} @endif</td>
             <td class="center border_left0 border_bottom0 fontsize14 font_weight">@if($pax[0]['mom']!=0){{$pax[0]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">2.</td>
             <td class="center fontsize14"><span class="font_weight">Pilots</span></td>
             <td class="center font_weight fontsize14">{{$pilot_co_pilot['weight']}}</td>
             <td class="center font_weight fontsize14">{{$pilot_co_pilot['mom']}}</td>

          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 2</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[1]['arm']!=0){{$pax[1]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[1]['weight']!=0){{$pax[1]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[1]['mom']!=0){{$pax[1]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">3.</td>
             <td class="center fontsize14"><span class="font_weight">Total Payload</span></td>
             <td class="center font_weight fontsize14">{{$payload['weight']}}</td>
             <td class="center font_weight fontsize14">{{$payload['mom']}}</td>
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 3</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[2]['arm']!=0){{$pax[2]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[2]['weight']!=0){{$pax[2]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[2]['mom']!=0){{$pax[2]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">4.</td>
             <td class="center fontsize14"><span class="font_weight">Zero fuel weight <br>sub.Total <br>(Max.5590 kg)</span></td>
             <td class="center fontsize14 font_weight">{{$zfw['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$zfw['mom']}}</td>
             <td class="center font_weight fontsize14">%MAC <br>{{$zfw['mac']}}</td>
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 4</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[3]['arm']!=0){{$pax[3]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[3]['weight']!=0){{$pax[3]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[3]['mom']!=0){{$pax[3]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">5.</td>
             <td class="center font_weight fontsize14"><span>Fuel</span> Loading</td>
             <td class="center fontsize14 font_weight">{{$fuel_loading['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$fuel_loading['mom']}}</td>
             <td class="center fontsize14 font_weight">{{sprintf('%.0f', $fuel_loading['weight']*2.205)}}<br>Lbs</td>
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 5</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[4]['arm']!=0){{$pax[4]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[4]['weight']!=0){{$pax[4]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[4]['mom']!=0){{$pax[4]['mom']}} @endif</td>
             <td class="center font_weight fontsize14">6.</td>
             <td class="center font_weight fontsize14"><span>Ramp weight</span><br><span>(Max. 6010 kg)</span></td>
             <td class="center fontsize14 font_weight">{{$ramp_weight['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$ramp_weight['mom']}}</td>
             <td rowspan="3" class="center font_weight fontsize14"></td>
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 6</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[5]['arm']!=0){{$pax[5]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[5]['weight']!=0){{$pax[5]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[5]['mom']!=0){{$pax[5]['mom']}} @endif</td>
             <td rowspan="2" class="center font_weight fontsize14">7.</td>
             <td rowspan="2" class="center font_weight fontsize14"><span>Subtract Fuel for</span><br><span>Eng.Start, Taxi</span></td>
             <td rowspan="2" class="center font_weight fontsize14">-30</td>
             <td rowspan="2" class="center font_weight fontsize14">-238</td>
          
          </tr>
          <tr>
             <td class="center font_weight border_top0 border_bottom0 fontsize14">Seat - 7</td>
             <td class="center font_weight border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[6]['arm']!=0){{$pax[6]['arm']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[6]['weight']!=0){{$pax[6]['weight']}} @endif</td>
             <td class="center border_left0 border_top0 border_bottom0 fontsize14 font_weight">@if($pax[6]['mom']!=0){{$pax[6]['mom']}} @endif</td>
          </tr>
          <tr>
             <td class="left font_weight fontsize14" style="padding-left:5px;">Front Baggage <br> Compartment</td>
             <td class="center font_weight fontsize14">{{$front_cargo['arm']}}</td>
             <td class="center font_weight fontsize14">{{$front_cargo['weight']}}</td>
             <td class="center font_weight fontsize14">{{$front_cargo['mom']}}</td>
             <td class="center font_weight fontsize14">8.</td>
             <td class="center font_weight fontsize14">Take off weight <br>(Max.5980 kg)</td>
             <td class="center fontsize14 font_weight">{{$tow['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$tow['mom']}}</td>
             <td class="center font_weight fontsize14 font_weight">%MAC <br>{{$tow['mac']}}</td>
          </tr>
          <tr>
             <td class="left font_weight fontsize14" style="padding-left:5px;">Rear Baggage <br> Compartment</td>
             <td class="center font_weight fontsize14">{{$rear_cargo['arm']}}</td>
             <td class="center font_weight fontsize14">{{$rear_cargo['weight']}}</td>
             <td class="center font_weight fontsize14">{{$rear_cargo['mom']}}</td>
             <td class="center font_weight fontsize14">9.</td>
             <td class="center font_weight fontsize14">Subtract Fuel to<br>Destination</td>
             <td class="center fontsize14 font_weight">{{$lessfuel_dest['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$lessfuel_dest['mom']}}</td>
              <td class="center font_weight fontsize14">{{sprintf('%.0f', $lessfuel_dest['weight']*2.205)}}<br>Lbs</td>
          </tr>
          <tr>
             <td class="left font_weight fontsize14" style="padding-left:5px;">Total Payload</td>
             <td class="center fontsize14"></td>
             <td class="center fontsize14 font_weight">{{$payload['weight']}}</td>
             <td class="center fontsize14 font_weight" >{{$payload['mom']}}</td>
             <td class="center font_weight fontsize14">10.</td>
             <td class="center font_weight fontsize14">Landing Weight<br>(Max.5900 kg)</td>
             <td class="center fontsize14 font_weight">{{$landing['weight']}}</td>
             <td class="center fontsize14 font_weight">{{$landing['mom']}}</td>
             <td style="padding-left:5px;"class="center font_weight fontsize14">%MAC <br>{{$landing['mac']}}</td>
          </tr>
          <tr>
             <td colspan="6" class="left font_weight fontsize14 border_right0"><img src="https://www.eflight.aero/media/images/loadtrim/vtepu/tdview_note2.png"/></td>
             <td colspan="3" class="font_weight right border_left0" style="font-size:11px;">CG MUST BE WITH IN LIMITS (17.0%<br>-35.0% MAC) AT<br>5980 KGS FOR T/O<br>and 5900 kgs for Idgs</td>
          </tr>
           <tr>
             <td colspan="4" class="left font_weight fontsize14 border_bottom0" style="padding-left:5px;">Computed by <span style="padding-right:150px;;border-bottom:1px solid #000;margin-left:2px;">{{$co_pilot}}</span></td>
             <td colspan="5" class="left fontsize14 border_bottom0 font_weight" style="padding-left:5px;">Pilot  {{$pilot}}</td>
          </tr>
          <tr>
             <td colspan="4" class="font_weight fontsize14 border_top0" style="padding-top:25px;padding-left:30px;">Signature <hr style="width:100%;display:inline-block;margin-right:80px;margin-top:1.5em;border:0;background-color:#000;"></td>
             <td colspan="5" class="font_weight fontsize14 border_top0" style="padding-top:25px;padding-left:50px;">Signature <hr style="width:100%;display:inline-block;margin-right:80px;margin-top:1.5em;border:0;background-color:#000;"></td>
          </tr>
       </table>
        <table style="margin-top:15px;">
          <tr>
            <td colspan="4" class="noBorder left fontsize12 font_weight"><img src="https://www.eflight.aero/media/images/loadtrim/vtepu/vtepu_last_pdf.png"/></td>
          </tr>
          <tr>
            <td colspan="4" class="font_weight fontsize14 noBorder center">Weight and Balance Loading Form</td>
          </tr>
          <tr>
            <td colspan="3" class="font_weight fontsize14 noBorder left">Approved by the Director of Airworthiness, Delhi Region, New Delhi vide his letter<br>NO.AWI/F-APP/2373 dated 07/01/2003</td>
          </tr>
        </table>
</body>
</htm>