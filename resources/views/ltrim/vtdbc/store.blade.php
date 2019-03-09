@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtdbc.css')}}">
@endpush

@section('content')
<div class="page">
    @include('includes.new_header',[])
    <main>
        <div class="container sec-container">
         <div class="row">
           <div class="col-md-12" style="width:700px;margin-left: 100px;margin-top:15px;border:1px solid #000;border-collapse: collapse;">
             <p style="font-size: 13px;font-weight: bold;text-align: center;text-decoration: underline;">DECORE EXXOILS PRIVATE LIMITED</p>
             <p style="font-size: 13px;font-weight: bold;text-align: center;">LOAD & TRIM SHEET</p>
           </div>
           <div class="col-md-12" style="width:700px;margin-left: 100px;border:1px solid #000;border-collapse: collapse;border-top: 0px;border-bottom: 0px;">
             <p style="font-size: 12px;"><span>Type of Aircraft:</span><span style="font-weight: bold;padding-left: 10px;text-decoration: underline;">LEARJET 60XR</span><span style="padding-left:329px;">Date:_________________</span></p>
            <p style="font-size: 12px;"><span>Aircraft Regn:</span><span style="font-weight: bold;padding-left: 20px;text-decoration: underline;">VT-DBC</span><span style="padding-left:372px;">Sector:________________</span></p>
             <p style="font-size: 12px;"><span>Serial No:</span><span style="font-weight: bold;padding-left: 40px;text-decoration: underline;">60-384</span><span style="padding-left:379px;">Pilot-in Command:_______</span></p>
           </div>
           <div class="col-md-12">
             <table class="sec-vtdbc" style="width:700px;margin-left: 85px;">
               <thead>
                 <tr style="line-height: 13px;">
                   <th style="width:7%;font-size: 12px;">SL.<p>No.</p></th>
                   <th style="width:36%;font-size: 12px;vertical-align: text-top;">DETAILS</th>
                   <th style="width:5%;"></th>
                   <th style="width:17%;font-size: 12px;vertical-align: text-top;">WEIGHT (lb.)</th>
                   <th style="width:16%;font-size: 12px;vertical-align: text-top;">ARM (in.)</th>                  
                   <th style="width:19%;font-size: 12px;vertical-align: text-top;">MOMENT (in.ib.)</th>
                 </tr>
               </thead>
               <tbody>
                 <tr style="line-height: 13px;">
                   <td style="font-weight: bold;">I)</td>
                   <td style="text-align: left;padding-left: 5px;">Basic Empty Weight</td>
                   <td style="font-weight: bold;">A</td>
                   <td>14764 lb</td>
                   <td style="background:#000;"></td>
                   <td>5592637.2</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>1.</td>
                   <td style="text-align: left;padding-left: 5px;">Pilot and Co-pilot</td>
                   <td rowspan="11" style="font-weight: bold;vertical-align:text-top;">B</td>
                   <td>375.00</td>
                   <td>144.50</td>
                   <td>54187.5</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>2.</td>
                   <td style="text-align: left;padding-left: 5px;">Operation Items</td>
                   <td>125</td>
                   <td>202.60</td>
                   <td>35455</td>
                  
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>3.</td>
                   <td style="text-align: left;padding-left: 5px;">Flight Bag</td>
                   <td>25</td>
                   <td>200.00</td>
                   <td>5000 </td>
                  
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>4.</td>
                   <td style="text-align: left;padding-left: 5px;">RH Aft facing Seat (75 Kgs each)</td>
                   <td></td>
                   <td>224.70</td>
                   <td></td>
                  
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>5.</td>
                   <td style="text-align: left;padding-left: 5px;">LH Aft facing Seat</td>
                   <td></td>
                   <td>286.60</td>
                   <td></td>
                   
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>6.</td>
                   <td style="text-align: left;padding-left: 5px;">RH Fwd facing Seat</td>
                   <td></td>
                   <td>257.50</td>
                   <td></td>
                   
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>7.</td>
                  <td style="text-align: left;padding-left: 5px;">LH Fwd facing Seat</td>
                   <td></td>
                   <td>257.50</td>
                   <td></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>8.</td>
                   <td style="text-align: left;padding-left: 5px;">RH Fwd facing Seat</td>
                   <td></td>
                   <td>301.90</td>
                   <td></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>9.</td>
                   <td style="text-align: left;padding-left: 5px;">LH Fwd facing Seat</td>
                   <td></td>
                   <td>301.90</td>
                   <td></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>10.</td>
                   <td style="text-align: left;padding-left: 5px;">RH Side facing Seat</td>
                   <td></td>
                   <td>333.70</td>
                   <td></td>
                  
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>11.</td>
                   <td style="text-align: left;padding-left: 5px;">Baggage - Tail</td>
                   <td></td>
                   <td>515.00</td>
                   <td></td>
                  
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="color: #fff;">1</td>
                   <td style="color: #fff;">2</td>
                   <td style="color: #fff;">3</td>
                   <td style="color: #fff;">4</td>
                   <td style="color: #fff;">5</td>
                   <td style="color: #fff;">6</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>12.</td>
                   <td style="text-align: left;padding-left: 5px;">Galley Supply (155 lb. max.)</td>
                   <td rowspan="3" style="font-weight:bold;vertical-align: text-top;">C</td>
                   <td>155</td>
                   <td>212.80</td>
                   <td>32984</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>13.</td>
                   <td style="text-align: left;padding-left: 5px;">Vanity Stowage (20 lb. max.)</td>
                   <td>20</td>
                   <td>440.88</td>
                   <td>8817.6</td>
                   
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>14.</td>
                   <td style="text-align: left;padding-left: 5px;">Toiletries Stowage (5 lb. max.)</td>
                   <td>5</td>
                   <td>453.08</td>
                   <td>2265.4</td>
                   
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="color: #fff;">1</td>
                   <td style="color: #fff;">2</td>
                   <td style="color: #fff;">3</td>
                   <td style="color: #fff;">4</td>
                   <td style="color: #fff;">5</td>
                   <td style="color: #fff;">6</td>
                 </tr>
                <tr style="line-height: 13px;">
                   <td style="color: #fff;">1</td>
                   <td style="color: #fff;">2</td>
                   <td style="color: #fff;">3</td>
                   <td style="color: #fff;">4</td>
                   <td style="color: #fff;">5</td>
                   <td style="color: #fff;">6</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="font-weight: bold;">ll)</td>
                   <td style="text-align: left;padding-left: 5px;font-weight: bold;">Total Zero Fuel Wt. (A+B+C) and Moment</td>
                   <td style="font-weight: bold;">D</td>
                   <td></td>
                   <td></td>
                   <td></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="font-weight:bold;">lll)</td>
                   <td style="text-align: left;padding-left: 5px;font-weight:bold;">Max. Zero Fuel Wt.</td>
                   <td style="border-right: 0px;background:#000;"></td>
                   <td style="border-left: 0px;background:#000;"></td>
                   <td>MZFW</td>
                   <td>17000lb./7711 kg</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="font-weight: bold;">lV)</td>
                   <td style="text-align: left;padding-left: 5px;">Wing Fuel</td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td></td>
                   <td style="text-align: left;padding-left: 5px;">Fuselage Fuel</td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td></td>
                   <td style="text-align: left;padding-left: 5px;">Less Fuel Take-off and taxi</td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td></td>
                   <td style="text-align: left;padding-left: 5px;font-weight:bold;">Take off fuel</td>
                   <td style="font-weight: bold;">E</td>
                   <td></td>
                   <td></td>
                   <td></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="font-weight: bold;">V)</td>
                   <td style="text-align: left;padding-left: 5px;font-weight: bold;">Total Take-off weight (D+E) and Moment</td>
                   <td style=""></td>
                   <td></td>
                   <td></td>
                   <td></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="font-weight: bold;">Vl)</td>
                   <td style="text-align: left;padding-left: 5px;font-weight: bold;">Maximum Take-off Weight</td>
                   <td rowspan="2" style="background: #000;border-right: 0px;"></td>
                   <td rowspan="2" style="background: #000;border-left: 0px;"></td>
                   <td>MTOW</td>
                   <td>23500 lb./10660 kg</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="border-bottom: 0px;font-weight: bold;">Vll)</td>
                   <td style="text-align: left;padding-left: 5px;font-weight: bold;">Landing Weight</td>
                   <td>MLW</td>
                   <td>19500 lb./8845 kg</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="border-top: 0px;"></td>
                   <td colspan="5" style="text-align: left;padding-left: 5px;font-weight: bold;">C.G. Range:Straight line variation between points.</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td>2</td>
                   <td colspan="5"></td>
                 </tr>
                 <tr style="line-height: 17px;">
                   <td></td>
                   <td colspan="4" style="text-align: left;padding-left: 5px;"><p><span style="display: block;font-weight: bold;text-align:left;font-size:12px;padding-bottom: 6px;">C.G.in percent MAC:-</span></p>
                            <p style="font-size:12px;margin:0px;line-height: 2px;">Formula: Fuselage Station (Center of Gravity) -365.085 X 100</p>
                            <p style="text-align: left;font-weight: bold;margin:0px;font-size: 12px;line-height:0px;padding-left: 50px;"><i ><span> __________________________________________</span></p>
                            <p style="padding-left:213px;padding-top:6px;">80.09</p> </td>
                   <td><p style="font-size:12px;margin:0px;line-height: 2px;">Arm=Total moment</p>
                            <p style="text-align: left;font-weight: bold;margin:0px;font-size: 12px;line-height:1px;"><span style="padding-left:50px; "> __________</span></p>
                            <p style="margin: 0px;padding-top: 5px;padding-left: 32px;">Total moment</td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td></td>
                   <td colspan="5" style="text-align: left;padding-left: 5px;"><p style="padding-bottom: 10px;">I Certify that the aircraft has been satisfactorily loaded as per Airplane Flight Manual.</p><p><span style="font-weight: bold;">Licence No. C.P.L./ALTP:__________</span><span style="padding-left: 130px;font-weight: bold;">Signature of Pilot-in-Command:__________</span></p></td>
                 </tr>
                 <tr style="line-height: 13px;">
                   <td style="font-weight: bold;vertical-align: text-top;">NOTE:</td>
                   <td colspan="5"  style="text-align: left;padding-left: 5px;"><p>Pilot-in Command to brief the passenger accupying RH Fwd Facing Executive Seat which is next to Emergency exit about opening procedureof overwing exit</p>
                    </td>
                 </tr>
               </tbody>
             </table>
           </div>
           <div class="col-md-12" style="width:700px;margin-left: 100px;font-size: 12px;font-weight: bold;margin-bottom: 20px;">
             <p>Approved Vide DDAW Bhopal Letter No:A7/DBC/262 Dated:28/07/2015</p>
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