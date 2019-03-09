@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtmam.css')}}">
@endpush

@section('content')
<div class="page">
    @include('includes.new_header',[])
    <main>
        <div class="container sec-container">
          <div class="row">
            <div class="col-md-12" style="margin-top:15px;margin-bottom: 15px;">
              <table class="sec-mam" style="width:80%;margin-left:85px;">
              <thead>
              <tr>
              <th></th>
              <th colspan="5">
                <p style="text-align: center;text-decoration: underline;font-weight: bold;font-size: 12px;text-transform: uppercase;">mahindra& mahindraltd</p>
                <p style="text-align: center;text-decoration: underline;font-weight: bold;font-size: 12px;text-transform: uppercase;">load & trim sheet</p>
                </th>
                </tr>
                <tr>
                  <th colspan="6" style="font-size: 12px;text-align: left;">
                    <p ><span>Type of Aircraft:</span><span style="text-transform: uppercase;padding-left:100px;text-decoration:underline;font-weight: bold;">LEARJET60XR</span><span style="padding-left:180px;">Date:</span></p>
                    <p><span>AircraftRegn:</span><span style="text-transform: uppercase;padding-left:115px;text-decoration:underline;font-weight: bold;">vt-mam</span><span style="padding-left:216px;">Sector:</span></p>
                    <p><span>Serial No:</span><span style="text-transform: uppercase;padding-left:135px;text-decoration:underline;font-weight: bold;">60-394</span><span style="padding-left:227px;">Pilot-in Command:</span></p>
                  </th>
                </tr>
                <tr style="font-size: 12px;">
                  <th style="width: 6%;">SL.<p>NO.</p></th>
                  <th style="width:40%;vertical-align:top;">DETAILS</th>
                  <th style="width:4%;"></th>
                  <th style="width:25%;">WEIGHT<P>(lb.)</P></th>
                  <th style="width:10%">ARM<P>(in.)</P></th>
                  <th style="width:15%;">MOMENT<p>(in.lb.)</p></th>
                </tr>
                </thead>
                <tbody style="text-align: center;font-size:12px;padding: 0px;padding-left:0px;">
                  <tr>
                    <td style="font-weight:bold;">l)</td>
                    <td style="text-align: left;">Basic Empty Weight</td>
                    <td style="font-weight: bold;">A</td>
                    <td style="font-weight: bold;">14653.38lb.</td>
                    <td style="font-weight: bold;">379.77</td>
                    <td style="font-weight: bold;">5558096</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">1.</td>
                    <td style="text-align: left;">Pilot and Co-Pilot</td>
                    <td rowspan ="14" style="font-weight: bold;"><div class="arrow-up"></div>
                    <div class="line"></div>B
                    <div class="line"></div>
                    <div class="arrow-down"></div></td>
                    <td style="font-weight: bold;">374.79</td>
                    <td style="font-weight: bold;">144.60</td>
                    <td style="font-weight: bold;">54194.63</td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">2.</td>
                    <td style="text-align: left;">Operational Items(145 lb.max.)</td>
                    <td></td>
                    <td style="font-weight:bold;">204.10</td>
                    <td></td>                   
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">3.</td>
                    <td style="text-align: left;">LH Closet(65 lb.max.)</td>
                    <td></td>
                    <td style="font-weight:bold;">170.5</td>
                    <td></td>                  
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">4.</td>
                    <td style="text-align: left;">RH side facings of a seat(75Kgseach)</td>
                    <td></td>
                    <td style="font-weight:bold;">203.2</td>
                    <td></td>                   
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">5.</td>
                    <td style="text-align: left;">RH side facings of a seat</td>
                    <td></td>
                    <td style="font-weight:bold;">223.2</td>
                    <td></td>                    
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">6.</td>
                    <td style="text-align: left;">LH side fwd facing seat</td>
                    <td></td>
                    <td style="font-weight:bold;">229.3</td>
                    <td></td>                  
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">7.</td>
                    <td style="text-align: left;">RH side aft facing  seat</td>
                    <td></td>
                    <td style="font-weight:bold;">259.1</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">8.</td>
                    <td style="text-align: left;">LH side aft facing  seat</td>
                    <td></td>
                    <td style="font-weight:bold;">259.1</td>
                    <td></td>                  
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">9.</td>
                    <td style="text-align: left;">RH side fwd facing  seat</td>
                    <td></td>
                    <td style="font-weight:bold;">308.3</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">10.</td>
                    <td style="text-align: left;">LH side fwd facing  seat</td>
                    <td></td>
                    <td style="font-weight:bold;">308.3</td>
                    <td></td>                   
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">11.</td>
                    <td style="text-align: left;">RH side Facing Lavatory seat</td>
                    <td></td>
                    <td style="font-weight:bold;">333.6</td>
                    <td></td>                   
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">12.</td>
                    <td style="text-align: left;">Baggage -Cabin (350lb.max.includingLife raft(58<p>lb)ifcarriedonboard)</p></td>
                    <td></td>
                    <td style="font-weight:bold;vertical-align: top;">360.0</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">13.</td>
                    <td style="text-align: left;">Life Raft-BaggageCabin(58 lb.)</td>
                    <td></td>
                    <td style="font-weight:bold;">360.0</td>
                    <td></td>                   
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">14.</td>
                    <td style="text-align: left;">Baggage -Tail(300lb.max.)</td>
                    <td></td>
                    <td style="font-weight:bold;">505.00</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">15.</td>
                    <td style="text-align: left;">RH Galley Supply(180.lb.max.)</td>
                    <td rowspan="5" style="font-weight:bold;"><div class="arrow-up1"></div>
                    <div class="line1"></div>C
                    <div class="line1"></div>
                    <div class="arrow-down1"></div></td>
                    <td></td>
                    <td style="font-weight:bold;">177.0</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">16.</td>
                    <td style="text-align: left;">Vanity Stowage(21lb.max.)</td>
                    <td></td>
                    <td style="font-weight:bold;">335.4</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">17.</td>
                    <td style="text-align: left;">Toiletries Stowage(35lb.max.)</td>
                    <td></td>
                    <td style="font-weight:bold;">334.9</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">18.</td>
                    <td style="text-align: left;">Sink Provisions(15lb.max.)</td>
                    <td></td>
                    <td style="font-weight:bold;">338.8</td>
                    <td></td>                  
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">19.</td>
                    <td style="text-align: left;">A/VShelf(30lb.max.)</td>
                    <td></td>
                    <td style="font-weight:bold;">350.3</td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">ll)</td>
                    <td style="text-align: left;font-weight:bold;">TotalZeroFuleWt.(A+B+C)andMoment</td>
                    <td style="font-weight:bold;">D</td>
                    <td></td>
                    <td style="font-weight:bold;"></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">lll)</td>
                    <td style="text-align: left;">Max.ZeroFuelWt</td>
                    <td style="background: #000;"></td>
                    <td style="font-weight:bold;">17000 lb./7711.00kg</td>
                    <td style="font-weight:bold;">MZFW</td>
                    <td style="background: #000;"></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">lv)</td>
                    <td style="text-align: left;">WingFuel</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="text-align: left;">Fuselagefuel</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="text-align: left;">Less fuel for Takeoff and taxi</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td style="text-align: left;">Takeoff fuel</td>
                    <td style="font-weight:bold;">E</td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">v)</td>
                    <td style="text-align: left;font-weight:bold;">Total takeoffweight(D+E)andMoment</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">vl)</td>
                    <td style="text-align: left;font-weight:bold;">Trip Fuel</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">vll)</td>
                    <td style="text-align: left;font-weight:bold;">Landing Weight (MLW- 19500lbs)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td style="font-weight:bold;">vlll)</td>
                    <td style="text-align: left;">MaximumTake-offWeight
                    <td style="background: #000;"></td>
                    <td style="font-weight:bold;">23501 lb./10660.00kg</td>
                    <td style="font-weight:bold;">MTOW</td>
                    <td style="background: #000;"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="5">
                      <p style="font-size: 12px;text-align: left;border-bottom:1px solid #333;border-collapse: collapse;"><span style="font-weight: bold;">C.G.Ranges:</span  style="font-weight: bold;">Straight line variation between points.(Please refer page 03 of 03)</p>
                      </td>
                      </tr>
                      <tr>
                       <td></td>
                      <td colspan="5">
                      <p style="font-size: 12px;text-align: left;border-bottom:1px solid #333;border-collapse: collapse;"><span style="font-weight: bold;">NOTE:</span>Trim Setting may also be calculated automatically from AFMS CDU after fedding % of MAC</p>
                      </td>
                      </tr>
                      <tr>
                      <td></td>
                     
                      <td colspan="3">
                      <p><span style="display: block;font-weight: bold;text-align:left;font-size:12px;">C.G.inpercentMAC:-</span></p>
                            <p style="font-size:12px;margin:0px;padding-right: 43px;"><i> (FuselageStation(Center ofGravity) -365.085)x100</i></p>
                            <p style="text-align: left;font-weight: bold;margin:0px;font-size: 12px;line-height:0px;"><i >Formula:<span> ___________________________________</span></p>
                            <p style="padding-right: 179px;padding-top: 2px;"><i>80.09</i></p> 
                          </td> 
                          <td colspan="2">
                           <p style="font-size:12px;margin:0px;margin:0px;"><i>Total moment</i></p>
                            <p style="text-align: left;font-weight: bold;margin:0px;font-size: 12px;line-height:1px;"><i >ARM =<span style="padding-left:6px; "> __________</span></p>
                            <p style="margin: 0px;"><i>Total moment</i></p>
                  </tr>
                  <tr>
                    <td></td>
                    <td colspan="5">
                      <p style="font-style:12px;text-align: left;">This is to certify that Aircraft is satisfactorily loaded,with respect to total load,the distribution of the load and proper securing of the load in aircraft (lashing of the load).The distribution of the laod shall be such that the C.G.position will remain within the specified limits at the time of takeoff,during the progress of flight and at the time of landing. </p>
                      <p style="text-align: left;"><span style="font-weight: bold;font-size: 12px;">LicenseNo.C.P.L/ALTP:______________</span><span style="font-weight: bold;font-size: 12px;padding-left: 30px;"> SignatureofPilot-command:______________</span></p>
                    </td>
                  </tr>
                  <tr>
                    <td style="text-align: left;font-weight: bold;">Note:</td>
                    <td colspan="5">
                      <p style="font-size: 12px;text-align: left;">Pilot-in Command to brief the passenger accupying RH Fwd Facing Executive Seat which is next to Emergency exit about opening procedureof overwing exit</p>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="6" style="text-align: left;"><p style="font-size: 12px;margin-top: 15px;"><span style="font-weight: bold;">PREPARED BY:</span><span>RAMCHANDRAS.CHAUBEY</span><span></span></p>
                    <p style="font-size:12px;">CAM,AWI,MUMBAI</p>
                    </td>                    
                  </tr>
                </tbody>
                 </table>
            </div>
          </div>
        </div>
    </main>
    @include('includes.new_footer',[])
</div>
<script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
<script type="text/javascript">
 $("#select_date" ).datepicker({ 
  minDate: 0,
  dateFormat: 'dd-M-yy',
  onSelect: function(dateText, inst) 
  { 
                    $("#select_date").css("border", "1px solid #999");
  }
});
  $('document').ready(function(){
    $('#reset').click(function(){
          $('.clear').val('');  
          $('.clear').prop('checked', false); 
        });
});
</script>
@stop