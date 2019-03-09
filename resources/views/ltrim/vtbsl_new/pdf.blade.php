<!DOCTYPE html>
<html>
<head>
<style>
td, th {
border: 1px solid #000;
}
</style>
</head>
<body>
<h3 style="text-align:center;text-decoration:underline;padding-top:20px;">Bhushan Aviation Limited</h3>
<table style="padding-bottom:10px;border-collapse: collapse;width: 100%;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
  <tr>
    <th style="border:none;text-align:left;font-weight:normal;font-size:14px;">Aircraft Registration: <span style="font-weight:bold;">VT-BSL</span></th>
    <th style="border:none;text-align:right;font-weight:normal;font-size:14px;">Aircraft S/N: 560-5816</th>
  </tr>
</table>
<h5 style="text-align:center;color:#595959;text-decoration:underline;">Loading Schedule Cessna Citation 560XL (Citation XLS)</h5>
<table style="border-collapse: collapse;width: 100%;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
  <tr>
    <th colspan="4" style="text-align:center;font-size:12px;">PAYLOAD COMPUTATIONS</th>
    <th style="text-align:center;font-size:12px;">ITEM</th>
    <th style="text-align:center;font-size:12px;">WEIGHT <br>(POUNDS)</th>
	<th style="text-align:center;font-size:12px;">MOMENT/ <br>100</th>
  </tr>
  <tr>
    <td style="text-align:center;font-weight:bold;font-size:12px;">ITEM</td>
	<td style="text-align:center;font-weight:bold;font-size:12px;">ARM <br>(INCHES)</td>
	<td style="text-align:center;font-weight:bold;font-size:12px;">WEIGHT <br>(POUNDS)</td>
	<td style="text-align:center;font-weight:bold;font-size:12px;">MOMENT/ <br>100</td>
	<td style="text-align:left;font-size:12px;">1. <span style="font-weight:bold;">BASIC EMPTY WEIGHT</span><br>*BEW CG = 336.10</td>
	<td style="text-align:center;font-size:12px;">{{$empty_weight['weight']}}</td>
	<td style="text-align:center;font-size:12px;">{{$empty_weight['mom']}}</td>
  </tr>
  <tr >
    <td style="text-align:left;border-bottom:0;font-size:12px;padding-top:7px;padding-bottom:7px;">PILOT</td>
	<td style="text-align:center;border-bottom:0;border-left:0;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$pilot_co_pilot['arm']}}</td>
	<td style="text-align:center;border-bottom:0;border-left:0;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$pilot_co_pilot['weight']}}</td>
	<td style="text-align:center;border-bottom:0;border-left:0;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$pilot_co_pilot['mom']}}</td>
	<td style="text-align:left;font-size:12px;">2. <span style="font-weight:bold;padding-top:7px;padding-bottom:7px;">PAYLOAD</span></td>
	<td style="text-align:center;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$payload['weight']}}</td>
	<td style="text-align:center;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$payload['mom']}}</td>
  </tr>
  <tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;">CO PILOT</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pilot_co_pilot['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pilot_co_pilot['weight']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pilot_co_pilot['mom']}}</td>
	<td style="text-align:left;font-size:12px;">3. <span style="font-weight:bold;">ZERO FUEL WEIGHT </span> <span style="color:#595959;">(Do not</span> <span style="color:#595959;">exceed 15,100 lbs)</span></td>
	<td style="text-align:center;font-size:12px;">{{$zfw['weight']}}</td>
	<td style="text-align:center;font-size:12px;">{{$zfw['mom']}}</td>
  </tr>
  <tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;">SEAT 10</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[0]['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">@if($pax[0]['weight']!=0){{$pax[0]['weight']}}@endif</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[0]['mom']}}</td>
	<td colspan="3" style="text-align:center;font-weight:bold;font-size:12px;border-right:1px solid #000;">ZFW CG = {{$zfw['arm']}}</td>
  </tr>
  <tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;padding-top:7px;padding-bottom:7px;">SEAT 3</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$pax[1]['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;padding-top:7px;padding-bottom:7px;">@if($pax[1]['weight']!=0){{$pax[1]['weight']}}@endif</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$pax[1]['mom']}}</td>
	<td style="text-align:left;font-size:12px;">4. <span style="font-weight:bold;padding-top:7px;padding-bottom:7px;">FUEL</span> LOADING</td>
	<td style="text-align:center;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$fuel_loading['weight']}}</td>
	<td style="text-align:center;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$fuel_loading['mom']}}</td>
  </tr>
	<tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;">SEAT 4</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[2]['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">@if($pax[2]['weight']!=0){{$pax[2]['weight']}}@endif</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[2]['mom']}}</td>
	<td style="text-align:left;font-size:12px;">5. <span style="font-weight:bold;">RAMP WEIGHT</span> <span style="color:#595959;">(Do not exceed</span> <br><span style="color:#595959;">20,400 lbs)</span></td>
	<td style="text-align:center;font-size:12px;">{{$ramp_weight['weight']}}</td>
	<td style="text-align:center;font-size:12px;">{{$ramp_weight['mom']}}</td>
  </tr>
	<tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;">SEAT 5</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[3]['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">@if($pax[3]['weight']!=0){{$pax[3]['weight']}}@endif</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[3]['mom']}}</td>
	<td colspan="3" style="text-align:center;font-weight:bold;font-size:12px;">RAMP CG = {{$ramp_weight['arm']}}</td>
  </tr>
	<tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;padding-top:7px;padding-bottom:7px;">SEAT 6</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$pax[4]['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;padding-top:7px;padding-bottom:7px;">@if($pax[4]['weight']!=0){{$pax[4]['weight']}}@endif</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$pax[4]['mom']}}</td>
	<td style="text-align:left;font-size:12px;padding-top:7px;padding-bottom:7px;">6. LESS FUEL FOR TAXING</td>
	<td style="text-align:center;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$lessfuel_taxing['weight']}}</td>
	<td style="text-align:center;font-size:12px;padding-top:7px;padding-bottom:7px;">{{$lessfuel_taxing['mom']}}</td>
  </tr>
	<tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;">SEAT 7</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[5]['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">@if($pax[5]['weight']!=0){{$pax[5]['weight']}}@endif</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[5]['mom']}}</td>
	<td style="text-align:left;font-size:12px;">7. <span style="font-weight:bold;">TAKE OFF WEIGHT</span> <span style="color:#595959;">(Do not exceed</span> <br><span style="color:#595959;">20,200 lbs)</span></td>
	<td style="text-align:center;font-size:12px;">{{$tow['weight']}}</td>
	<td style="text-align:center;font-size:12px;">{{$tow['mom']}}</td>
  </tr>
  <tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;">SEAT 8</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[6]['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">@if($pax[6]['weight']!=0){{$pax[6]['weight']}}@endif</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[6]['mom']}}</td>
	<td colspan="3" style="text-align:center;font-weight:bold;font-size:12px;">TAKE OFF CG = {{$tow['arm']}}</td>
  </tr>
	<tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;">SEAT AFT SFS</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[7]['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">@if($pax[7]['weight']!=0){{$pax[7]['weight']}}@endif</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$pax[7]['mom']}}</td>
	<td style="text-align:left;font-size:12px;">8. LESS FUEL TO DESTINATION</td>
	<td style="text-align:center;font-size:12px;">{{$lessfuel_dest['weight']}}</td>
	<td style="text-align:center;font-size:12px;">{{$lessfuel_dest['mom']}}</td>
  </tr>
 <tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;">TAILCONE BAGGAGE <br><span style="font-size:12px;font-style:italic;color:#595959;font-weight:bold;">Do not exceed 700 lbs</span></td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$cargo['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$cargo['weight']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$cargo['mom']}}</td>
	<td style="text-align:left;font-size:12px;">9. <span style="font-weight:bold;">LANDING WEIGHT</span> <span style="color:#595959;">(Do not exceed</span><span style="color:#595959;">18,700 lbs)</span></td>
	<td style="text-align:center;font-size:12px;">{{$landing['weight']}}</td>
	<td style="text-align:center;font-size:12px;">{{$landing['mom']}}</td>
  </tr>
  <tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;font-style:italic;color:#595959;font-weight:bold;font-size:12px;"></td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;"></td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;"></td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;"></td>
	<td colspan="3" style="text-align:center;font-weight:bold;font-size:12px;">LANDING CG = {{$landing['arm']}}</td>
  </tr>
	<tr>
    <td style="text-align:left;border-top:0;border-bottom:0;font-size:12px;">LH REFRESHMENT <br>CENTER <br><span style="font-size:12px;font-style:italic;color:#595959;font-weight:bold;">Do not exceed 133 lbs</span></td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$refreshment_center['arm']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$refreshment_center['weight']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;border-bottom:0;font-size:12px;">{{$refreshment_center['mom']}}</td>
	<td colspan="3" style="text-align:center;font-style:italic;color:#595959;font-size:12px;">For MTOW - 20200 lbs (9162 kgs)<br>Fwd C.G Limit - 324.25 in, 21.3% MAC<br>Aft C.G Limit - 331.0 in, 29.3% MAC</td>
  </tr>
   <tr>
    <td style="text-align:center;border-top:0;font-weight:bold;font-size:12px;">PAYLOAD</td>
	<td style="text-align:center;border-left:0;border-top:0;font-weight:bold;font-size:12px;"></td>
	<td style="text-align:center;border-left:0;border-top:0;font-weight:bold;font-size:12px;">{{$payload['weight']}}</td>
	<td style="text-align:center;border-left:0;border-top:0;font-weight:bold;font-size:12px;">{{$payload['mom']}}</td>
	<td colspan="3" style="text-align:center;font-size:11px;">CG PERCENT MAC = <span style="text-decoration:underline;">(TAKE OFF CG - 306.59) / 0.8223</span><br><span style="font-weight:bold;">CG % MAC = {{$cg_percent_mac}}</span></td>
  </tr>
  <tr>
    <td colspan="7" style="text-align:center;font-size:12px;">AIRPLANE CG =<span style="text-decoration:underline;">(MOMENT/100) </span>X 100<br><span style="padding-left:60px;">WEIGHT</span></td>
  </tr>
	<tr>
    <td style="font-size:12px;font-style:italic;text-decoration:underline;text-align:center;border-bottom:0;font-weight:bold;padding-bottom:12px;" colspan="7">Certification</td>
  </tr>
  <tr>
	<td style="font-size:12px;font-style:italic;border-top:0;border-bottom:0;text-align:center;padding-bottom:12px;" colspan="7">It is certified that the airplane is satisfactorily loaded as per Airplane Flight Manual & the CG is within limits.</td>
  </tr>
  <tr>
		<td style="text-align:left;border-right:0;border-top:0;border-bottom:0;font-weight:bold;font-size:13px;">PIC Name:</td>
		<td colspan="6" style="border-left:0;border-top:0;border-bottom:0;font-weight:bold;font-size:13px;padding-left:-15px;" >{{$pilot}}</td>
  </tr>
	<tr>
  <td colspan="7" style="text-align:left;border-top:0;border-bottom:0;font-weight:bold;font-size:13px;">Signature of PIC:</td>
  </tr>
	 <tr>
  <td style="text-align:left;border-top:0;font-weight:bold;border-right:0;font-size:13px;">License No.:</td>
	<td style="border-left:0;border-top:0;border-right:0;font-weight:bold;font-size:13px;padding-left:-15px;">3110</td>
	<td colspan="2" style="text-align:right;border-left:0;border-top:0;border-right:0;font-weight:bold;font-size:13px;">Date: {{$date}}</td>
	<td colspan="3" style="text-align:right;border-left:0;border-top:0;font-weight:bold;font-size:13px;padding-right:75px;">Sector: <span style="margin-left:25px;">{{$from}}-{{$to}}</span></td>
  </tr>
</table>
<table style="margin-top:20px;border-collapse: collapse;width: 100%;font-family:'Lucida Grande','Lucida Sans Unicode','Lucida Sans',Verdana,Tahoma,sans-serif;">
 <tr>
    <td style="font-size:10px;border:0;">Note: Conversion factor used 1kg = 2.2.46 lbs</td>
		<td style="font-size:10px;border:0;"></td>
 </tr>
 <tr>
    <td style="font-size:10px;border:0;">Note: Decimals rounded off to nearest fig.</td>
		<td style="font-size:10px;border:0;"></td>
 </tr>
 <tr>
    <td style="font-size:10px;border:0;">Wt of Adult Pax (male & female) = 165.34 lbs = 165 lbs</td>
	  <td style="font-style:italic;border:0;text-align:center;font-size:12px;">Prepared by: Capt {{$pilot}}</td>
 </tr>
 <tr>
    <td style="font-size:10px;border:0;">Wt of Child pax (2-12 yrs) = 77.16 lb s= 77lbs</td>
	  <td style="font-style:italic;border:0;text-align:center;font-size:12px;">PIC: ATPL 3110</td>
 </tr>
 <tr>
    <td style="font-size:10px;border:0;">Wt of Infant pax (less than 2yrs) = 22.04 lbs = 22 lbs</td>
		<td style="font-size:10px;border:0;"></td>
 </tr>
 <tr>
    <td colspan="2" style="font-size:10px;border:0;font-weight:bold;">Revision 02 dated Oct - 2013, Approved by O/o Deputy Director General of Civil Aviation (NR) Vide letter no</td>
		
 </tr>
 <tr>
    <td style="font-size:10px;border:0;font-weight:bold;">F-Approval/BAL/2132 dated 02/10/2013</td>
		<td style="font-size:10px;border:0;"></td>
 </tr>
</table>
</body>
</html>
