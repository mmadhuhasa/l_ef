<!DOCTYPE html>
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
padding:1px;
}
.Airport_Authority_icon {
display: block;
margin-left: auto;
margin-right: auto;
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
.container{
width:800px;
margin:0 auto;
}
.fontsize14{
font-size:14px;
}
.fontsize12{
font-size:12px;
}
.fontsize13{
font-size:13px;
}
.fontsize11{
font-size:11px;
}
.noBorder{
border:0;
}
</style>
</head>
<body>
<table>
 <tr>
    <th style="padding-top:3px;" class="center"><img src="https://www.eflight.aero/media/images/loadtrim/vtfiu/vtfiu1.png"/></th>
    <th colspan="3" style="font-size:15px;" class="center font_weight border_right0">LOAD & TRIM SHEET</th>
    <th class="center fontsize14 border_left0"><img src="https://www.eflight.aero/media/images/loadtrim/vtfiu/b.PNG"/></th>
</tr>
</table>
<table>
<tr>
    <td class="left fontsize12 border_right0 border_bottom0 border_top0">SUPER KING AIR <span class="font_weight">B300</span></td>
    <td colspan="2" style="padding-left:60px;" class="left border_right0 fontsize12 border_left0 border_bottom0 border_top0">AIRCRAFT REGISTRATION: <span class="font_weight">VT-FIU</span></td>
    <td colspan="2" class="right fontsize12 border_left0 border_bottom0 border_top0">AIRCRAFT SERIAL NO: <span class="font_weight">FL-478</span></td>
</tr>
</table>
 <table>
	  <tr>
  	   <th class="center fontsize13">S/N</th>
  	   <th class="left fontsize13">DESCRIPTION</th>
  	   <th class="center fontsize13" style="width:110px;">WEIGHT (Kgs)</th>
  	   <th class="center fontsize13" style="width:60px;">F.S. (in)</th>
  	   <th class="center fontsize13" style="width:110px;">MOM/100 (kg-in)</th>
	  </tr>
	  <tr>
  	   <td class="center fontsize12" style="width:60px;">1</td>
  	   <td class="left fontsize12">Basic Empty Weight</td>
  	   <td class="center fontsize12">{{$empty_weight['weight']}}</td>
  	   <td class="center fontsize12">{{$empty_weight['arm']}}</td>
  	   <td class="center fontsize12">{{$empty_weight['mom']}}</td>
	  </tr>
	  <tr>
  	   <td class="center fontsize12">2</td>
  	   <td class="left fontsize12">Pilot Seat</td>
  	   <td class="center fontsize12">{{$pilot_co_pilot['weight']}}</td>
  	   <td class="center fontsize12">{{$pilot_co_pilot['arm']}}</td>
  	   <td class="center fontsize12">{{$pilot_co_pilot['mom']}}</td>
	  </tr>
	  <tr>
	     <td class="center fontsize12">3</td>
	     <td class="left fontsize12">Co-Pilot Seat</td>
	     <td class="center fontsize12">{{$pilot_co_pilot['weight']}}</td>
	     <td class="center fontsize12">{{$pilot_co_pilot['arm']}}</td>
	     <td class="center fontsize12">{{$pilot_co_pilot['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">4</td>
	   <td class="left fontsize12">Passenger Seat 1 (cabin seat RH aft facing)</td>
	   <td class="center fontsize12">@if($pax[0]['weight']!=0){{$pax[0]['weight']}} @endif</td>
	   <td class="center fontsize12">@if($pax[0]['arm']!=0){{$pax[0]['arm']}} @endif</td>
	   <td class="center fontsize12">@if($pax[0]['mom']!=0){{$pax[0]['mom']}} @endif</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">5</td>
	   <td class="left fontsize12">Passenger Seat 2 (cabin center seat LH fwd facing)</td>
	   <td class="center fontsize12">@if($pax[1]['weight']!=0){{$pax[1]['weight']}} @endif</td>
     <td class="center fontsize12">@if($pax[1]['arm']!=0){{$pax[1]['arm']}} @endif</td>
     <td class="center fontsize12">@if($pax[1]['mom']!=0){{$pax[1]['mom']}} @endif</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">6</td>
	   <td class="left fontsize12">Passenger Seat 3 (cabin center seat RH fwd facing)</td>
	   <td class="center fontsize12">@if($pax[2]['weight']!=0){{$pax[2]['weight']}} @endif</td>
     <td class="center fontsize12">@if($pax[2]['arm']!=0){{$pax[2]['arm']}} @endif</td>
     <td class="center fontsize12">@if($pax[2]['mom']!=0){{$pax[2]['mom']}} @endif</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">7</td>
	   <td class="left fontsize12">Passenger Seat 4 (cabin seat LH fwd facing)</td>
	   <td class="center fontsize12">@if($pax[3]['weight']!=0){{$pax[3]['weight']}} @endif</td>
	   <td class="center fontsize12">@if($pax[3]['arm']!=0){{$pax[3]['arm']}} @endif</td>
	   <td class="center fontsize12">@if($pax[3]['mom']!=0){{$pax[3]['mom']}} @endif</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">8</td>
	   <td class="left fontsize12">Total Cabinet Content</td>
	   <td class="center fontsize12"></td>
	   <td class="center fontsize12">------</td>
	   <td class="center fontsize12"></td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">9</td>
	   <td class="left fontsize12">Baggage (Max. 181.44 Kgs)</td>
	   <td class="center fontsize12">{{$cargo['weight']}}</td>
	   <td class="center fontsize12">{{$cargo['arm']}}</td>
	   <td class="center fontsize12">{{$cargo['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">10</td>
	   <td>
	      <table>
		  <tr>
		  <th class="border0 fontsize12" style="padding:0px;">Subtotal - Zero Fuel Weight</th>
		  <th class="border0 right fontsize12" style="padding:0px;">DO</th>
		  </tr>
		  <tr>
		  <th colspan="2" class="border0 fontsize12" style="padding-top:5px;padding-right: 0;padding-left: 0;padding-bottom: 0;">NOT EXCEED 12,500 LBS (5,670 KGS)</th>
		  </tr>
		</table>
	   </td>
	   <td class="center font_weight fontsize12">{{$zfw['weight']}}</td>
	   <td class="center font_weight fontsize12">{{$zfw['arm']}}</td>
	   <td class="center font_weight fontsize12">{{$zfw['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">11</td>
	   <td class="left font_weight fontsize12">Fuel (Max 1638 Kgs/ 3611 Lbs)<span style="font-weight:normal;padding-left:60px;">0 lbs</span></td>
	   <td class="center font_weight fontsize12">{{$fuel_loading['weight']}}</td>
	   <td class="center font_weight fontsize12"></td>
	   <td class="center font_weight fontsize12">{{$fuel_loading['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">12</td>
	   <td>
	      <table>
		  <tr>
		  <th class="border0 fontsize12" style="padding:0px;">Subtotal - Ramp Weight</th>
		  <th class="border0 right fontsize12" style="padding:0px;">DO</th>
		  </tr>
		  <tr>
		  <th colspan="2" class="border0 fontsize12" style="padding-top:5px;padding-right: 0;padding-left: 0;padding-bottom: 0;">NOT EXCEED 15,100 LBS (6,849 KGS)</th>
		  </tr>
		</table>
	   </td>
	   <td class="center font_weight fontsize12">{{$ramp_weight['weight']}}</td>
	   <td class="center font_weight fontsize12">{{$ramp_weight['arm']}}</td>
	   <td class="center font_weight fontsize12">{{$ramp_weight['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">13</td>
	   <td class="left font_weight fontsize12">Less Fuel for Start, Taxi and Take off**</td>
	   <td class="center font_weight fontsize12">{{$lessfuel_taxing['weight']}}</td>
	   <td class="center fontsize12"></td>
	   <td class="center font_weight fontsize12">{{$lessfuel_taxing['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">14</td>
	   <td>
	      <table>
		  <tr>
		  <th class="border0 fontsize12" style="padding:0px;">Total Take-Off Weight</th>
		  <th class="border0 right fontsize12" style="padding:0px;">DO</th>
		  </tr>
		  <tr>
		  <th colspan="2" class="border0 fontsize12" style="padding-top:5px;padding-right: 0;padding-left: 0;padding-bottom: 0;">NOT EXCEED 15,000 LBS (6,804 KGS)</th>
		  </tr>
		</table>
	   </td>
	   <td class="center font_weight fontsize12">{{$tow['weight']}}</td>
	   <td class="center font_weight fontsize12">{{$tow['arm']}}</td>
	   <td class="center font_weight fontsize12">{{$tow['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12"></td>
	   <td class="left font_weight fontsize12"><span style="padding-left:50px;">C.G Computation =</span> <span style="border-bottom:1px solid #000;">Total Moment</span> X 100<br><span style="padding-left:167px;">Total Weight</span></td>
	   <td colspan="3" class="center fontsize12"></td>
	  </tr>
	  <tr>
	   <td colspan="5" class="fontsize12">*Enter units based kg and kg-in</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="fontsize12">**Fuel for start, taxi and take-off is normally 100 lbs (45 kg) at an average moment/100 off 227 lb.in (103 kg.in)</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="center font_weight fontsize12">LANDING WEIGHT DETERMINATION</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">15</td>
	   <td class="left fontsize12">Fuel Loading From Line 11</td>
	   <td class="center fontsize12">{{$fuel_loading['weight']}}</td>
	   <td class="center fontsize12"></td>
	   <td class="center fontsize12"></td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">16</td>
	   <td class="left fontsize12">Less Fuel Used To Destination (including fuel for start,<br>taxi and take-off)</td>
	   <td class="center fontsize12"></td>
	   <td class="center fontsize12"></td>
	   <td class="center fontsize12"></td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">17</td>
	   <td class="left fontsize12">Total Fuel Remaining (Moment/100 from Usable Fuel<br>Weight and Moment Table)</td>
	   <td class="center fontsize12">{{$landing_fuel['weight']}}</td>
	   <td class="center fontsize12"></td>
	   <td class="center fontsize12">{{$landing_fuel['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">18</td>
	   <td class="left fontsize12">Zero Fuel Weight from Line 10</td>
	   <td class="center fontsize12">{{$zfw['weight']}}</td>
	   <td class="center fontsize12"></td>
	   <td class="center fontsize12">{{$ramp_weight['mom']}}</td>
	  </tr>
	  <tr>
	   <td class="center fontsize12">19</td>
	   <td class="left font_weight fontsize12">Total Landing Weight (17 + 18)</td>
	   <td class="center font_weight fontsize12">{{$landing['weight']}}</td>
	   <td class="center font_weight fontsize12">{{$landing['arm']}}</td>
	   <td class="center font_weight fontsize12">{{$landing['mom']}}</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="center border_left0 border_right0 fontsize12">Note: Shaded areas in the above tables indicate values that are not required to arrive at final weight and balance</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="center font_weight fontsize12">CENTER OF GRAVITY LIMITS</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="fontsize12">AFT LIMIT: 208.0 inches (5283 mm) at of the datum at all weights</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="fontsize12">FORWARD LIMITS: 191.4 Inches (4861 mm) aft of the datum at 11,800 pounds (5352 kg) or less, with straight line<br>variation to 199.4 Inches (5064 mm) aft of the datum at 15,000 pounds (6804 kg).</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="fontsize12">DATUM: The reference datum is located 83.5 Inches (2121 mm) forward of the center of the front jack point.</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="center font_weight fontsize12">CENTER OF GRAVITY LIMITS (LANDING GEAR DOWN)</td>
	  </tr>
	  <tr>
	   <td colspan="2" class="center font_weight fontsize12">WEIGHT CONDITION</td>
	   <td colspan="2" class="center font_weight fontsize12">FORWARD C.G LIMIT (IN)</td>
	   <td class="center font_weight fontsize12">AFT C.G LIMIT (IN)</td>
	  </tr>
	  <tr>
	   <td colspan="2" class="left fontsize12">15,000 LB (6804 KG) (MAXIMUM TAKE OFF OR LANDING)</td>
	   <td colspan="2" class="center fontsize12">199.4</td>
	   <td class="center fontsize12">208.0</td>
	  </tr>
	  <tr>
	   <td colspan="2" class="left fontsize12">11,800 LB (5352 KG) OR LESS</td>
	   <td colspan="2" class="center fontsize12">191.4</td>
	   <td class="center fontsize12">208.0</td>
	  </tr>
	  <tr>
	   <td colspan="5" class="fontsize12">I certify that the aircraft has been satisfactorily loaded as per Airplane Flight Manual.</td>
	  </tr>
	  <tr>
	  <td colspan="2" class="border_right0" style="padding-top:5px;padding-bottom:5px;">
	    <table>
		 <tr>
		   <td class="border0 fontsize12" style="width:41%;padding-right:0;padding-left:0;"><span>Signature of Pilot-in-command:</span></td>
		   <td style="width:52%;" class="border_left0 border_top0 fontsize12 border_right0"><span class="font_weight">{{$pilot}}</span></td>
		   <td class="border0 fontsize12 border_right0"></td>
		 </tr>
		</table>
	  </td>
	   <td colspan="3" class="border_left0">
	    <table>
		 <tr>
		   <td class="border0 fontsize12" style="width:45%;padding-right:0;padding-left:0;"><span>License No. CPL/ATPL:</span></td>
		   <td style="width:30%;padding-bottom:3px;" class="border_left0 border_right0 border_top0 fontsize12"><span class="font_weight">{{$co_pilot}}</span></td>
		   <td class="border0 fontsize12"></td>
		 </tr>
		</table>
	  </td>
	  </tr>
	  <tr>
	   <td colspan="2" class="fontsize12 border_right0">Sector: <span class="font_weight">{{$from}}</span>-<span class="font_weight">{{$to}}</span></td>
	   <td colspan="3" class="fontsize12 border_left0 center">Date: <span class="font_weight">{{$date}}</span></td>
	  </tr>
    </table>
	<table style="margin-top:10px;">
	<tr>
	 <td class="border0 fontsize13" colspan="4">Conversion Factors Used:</td>
	</tr>
	<tr>
	 <td class="border0 fontsize12">1 kg = 2.2046 lb</td>
	 <td class="border0 fontsize12">1 inch = 2.54 cm</td>
	 <td class="border0 fontsize12">1 Gallon = 3.785412 It</td>
	 <td class="border0 fontsize12">Fuel specific gravity = 0.803 kg/It</td>
	</tr>
	<tr>
	 <td colspan="3" class="font_weight border0 fontsize12">Approved by Dy. DGCA (NR) vide letter No. A7/FIU/1569</td>
	 <td class="border0 font_weight fontsize12 left">Dated: 11-08-2017</td>
	</tr>
	<tr>
	 <td style="padding-bottom:20px;"colspan="4" class="border0 fontsize13">FLIGHT INSPECTION UNIT, AIRPORTS AUTHORITY OF INDIA, SAFDARJUNG AIRPORT, NEW DELHI 110003</td>
	</tr>
	</table>
</body>
</html>
