@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtltc.css')}}">
@endpush

@section('content')
<div class="page">
    @include('includes.new_header',[])
  <main>
       <div class="container sec-container">
          <div class="row">
           <div class="col-md-12" style="margin-top: 15px;">
       	<p style="text-align: center;font-size: 12px;font-weight: bold;text-decoration:underline;padding-left:77px;">L&T AVIATION SERVICES PVT.LTD.</p>
       	<p style="text-align: center;font-size: 12px;font-weight: bold;text-decoration:underline;padding-left:148px;">LOAD AND TRIM SHEET</p>
            </div>
       	<div class="col-md-12">
       	  <table class="sec-ltc" style="width:780px;margin-left: 30px;">
       	     <tbody>
       		<tr style="line-height: 13px;">
       		  <td style="width:6%;"></td>
       		  <td colspan="7" style="text-align: left;"><span style="font-weight: bold;padding-left: 10px;">A/C Type: Hawker 900XP</span><span style="font-weight: bold;padding-left: 20px;">SerialNo. HA-0185 </span><span style="font-weight: bold;padding-left: 20px;">A/C Regn. : VT-LTC</span><span style="font-weight: bold;padding-left: 20px;">Approved Vide DGCA letter Ref No.A-7/LTC/</span></td>
       		</tr>
       		<tr style="line-height: 13px;">
       		  <td style="border-bottom: 0px;"></td>
       		  <td colspan="7" style="border-bottom: 0px;text-align: left;font-weight: bold;"><span style="padding-left: 10px;">SECTOR:</span><span style="padding-left:10px;">From____________</span>
       			<span style="padding-left:20px;">To______________</span>
       		       <span style="padding-left:20px;">PIC:_____________</span>
       			<span style="padding-left:20px;">FO:_______________</span>
       			<span style="padding-left:20px;">Date:</span></td>
       		</tr>
       	   </tbody>
       	 </table>
       	</div>
       	<div class="col-md-12" style="margin-bottom: 15px;margin-left:12px;">
       	 <table class="sec-ltc" style="width:780px;margin-left: 18px;">
       	  <thead>
       	       <tr style="line-height: 13px;">
       		  <th style="width:6%;text-align: left;padding-left: 2px;">Sr.No.</th>
       		  <th style="width: 35%;"></th>
       		  <th>WT (&nbsp;lbs.)</th>
       		  <th>ARM(&nbsp;ft.)</th>
       		  <th style="width:10%;">MoM(&nbsp;ft.lbs)</th>
       		</tr>
       	  </thead>
       	  <tbody>
       		  <tr style="line-height:13px;">       			    <td style="font-weight:bold;padding-top:12px;">I</td>
       			<td style="text-align: left;padding-left:2px;font-weight:bold;">Empty Wt( iteam A of them Approved<p>Weight schedule</p></td>
       			<td style="padding-top: 12px;">16196.66</td>
       			<td style="padding-top: 12px;">1.05</td>
       			<td style="padding-top: 12px;">17083.88</td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       		      <td style="font-weight:bold;padding-top: 12px;">II</td>
       			<td style="text-align: left;padding-left:2px;font-weight: bold;">BOW( iteam A + B + C + D2 of the <p>approved weight schedule)</p></td>
       			<td style="padding-top:12px;">16768.89</td>
       			<td style="padding-top:12px;">0.56</td>
       			<td style="padding-top:12px;">9294.26</td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color:#fff">1</td>
       			<td style="text-align:left;padding-left:2px;font-weight: bold;"></td>
       			<td></td>
       			<td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="font-weight: bold;">III</td>
       			<td style="text-align: left;padding-left:2px;font-weight:bold;">Passenger Seating</td>
       			<td></td>
       			<td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td>1</td>
       			<td style="text-align:left;padding-left:2px;">Jump Seat</td>
       			<td></td>
       			<td>-14</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       		       <td>2</td>
       			<td style="text-align: left;padding-left:2px;">Row 1 LH</td>
       			<td></td>
       			<td>-8.0</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td>3</td>
       			<td style="text-align: left;padding-left:2px;">Row 1 RH</td>
       		       <td></td>
       			<td>-8.0</td>
       		       <td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td>4</td>
       			<td style="text-align: left;padding-left:2px;">Row 2 L/H</td>
       			<td></td>
       			<td>-3.8</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height:13px;">
       			<td>5</td>
       			<td style="text-align: left;padding-left:2px;">Row 2 R/H</td>
       			<td></td>
       			<td>-4.1</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height:13px;">
       		      <td>6</td>
       		      <td style="text-align: left;padding-left:2px;">Aft Right Seat</td>
       		      <td></td>
       		     <td>0.3</td>
       		      <td></td>
       		  </tr>
       	         <tr style="line-height:13px;">
       			<td>7</td>
       			<td style="text-align: left;padding-left:2px;">Front Divan</td>
       			<td></td>
       			<td>-1.2</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height:13px;">
       			<td>8</td>
       			<td style="text-align: left;padding-left:2px;">Middle Divan</td>
       			<td></td>
       			<td>0.5</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height:13px;">
       			<td>9</td>
       			<td style="text-align: left;padding-left:2px;">Aft Divan</td>
       			<td></td>
       			<td>2.2</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td>10</td>
       			<td style="text-align: left;padding-left:2px;">Lav Seat</td>
       			<td></td>
       			<td>4.6</td>
       			<td></td>
       		 </tr>
       		 <tr style="line-height: 13px;">
       			<td style="font-weight: bold;">IV</td>
       		       <td style="text-align: left;padding-left:2px;font-weight: bold;">BAGGEGES</td>
       			<td></td>
       			<td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td>1</td>
       			<td style="text-align: left;padding-left:2px;">Fwd Bag Cmp ( 250 lbs max )</td>
       			<td></td>
       			<td>-11.6</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td>2</td>
       			<td style="text-align: left;padding-left:2px;">Aft Coal Closet ( 100 lbs max )</td>
       			<td></td>
       			<td>2.5</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td>3</td>
       			<td style="text-align: left;padding-left:2px;">Aft RH Baggage ( 45 lbs max )</td>
       			<td></td>
       			<td>4.6</td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       		      <td style="color:#fff;">1</td>
       			<td style="text-align: left;padding-left:2px;"></td>
       			<td></td>
       			<td></td>
       		      <td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="font-weight: bold;">V</td>
       			<td rowspan="2" style="text-align: left;padding-left:2px;padding-top: 5px;padding-bottom: 5px;font-weight: bold;">Zero Fuel Weight (18450 lbs max) (<p>I+II+III+IV)</p></td>
       			<td rowspan="2"></td>
       			<td rowspan="2"></td>
       			<td rowspan="2"></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td  style="color: #fff;">1</td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td></td>
       			<td style="text-align:left;padding-left:2px;">Wing</td>
       			<td></td>
       			<td></td>
       			<td></td>
       		 </tr>
       	        <tr style="line-height: 13px;">
       			<td></td>
       			<td style="text-align: left;padding-left:2px;">VENTRAL</td>
       			<td></td>
       			<td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">1</td>
       			<td style="text-align: left;padding-left:2px;"></td>
       			<td></td>
       			<td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="font-weight: bold;">VI</td>
       			<td rowspan="2" style="text-align: left;padding-left:2px;font-weight: bold;">Ramp Wt (28120 lbs max) (V+Fuel)=</td>
       			<td rowspan="2"></td>
       			<td rowspan="2"></td>
       			<td rowspan="2"></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       	              <td style="color: #fff;">1</td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td></td>
       			<td style="text-align: left;padding-left:2px;">Taxi Fuel</td>
       			<td>250</td>
       			<td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">1</td>
       			<td style="text-align: left;padding-left:2px;" ></td>
       			<td></td>
       		      <td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="padding-top:5px;padding-bottom: 5px;font-weight: bold;">VII</td>
       			<td rowspan="2" style="text-align: left;padding-left:2px;font-weight: bold;">Max To (280000 lbs max) ( VI-Taxi out<p>Fuel )=</p></td>
       			<td rowspan="2"></td>
       			<td rowspan="2"></td>
       			<td rowspan="2"></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">1</td>
       		  </tr>
       	         <tr style="line-height: 13px;">
       			<td></td>
       			<td style="text-align: left;padding-left:2px;">Fuel to Destination / Apporach )</td>
       			<td ></td>
       			<td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">1</td>
       			<td style="text-align: left;padding-left:2px;"></td>
       			<td></td>
       		      <td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">1</td>
       			<td rowspan="2" style="text-align: left;padding-left:2px;font-weight: bold;">Landing Wt(23350 lbs max)</td>
       			<td rowspan="2"></td>
       			<td rowspan="2"></td>
       			<td rowspan="2"></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">2</td>     	
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">1</td>
       			<td style="text-align: left;padding-left:2px;"></td>
       			<td></td>
       			<td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td></td>
       			<td style="text-align: left;padding-left:2px;">Diversion Fuel</td>
       			<td></td>
       			<td></td>
       			<td></td>
       	         </tr>
       		  <tr style="line-height: 13px;">
       			<td></td>
       			<td style="text-align: left;padding-left:2px;">Landing Weight at Alternate</td>
       			<td></td>
       			<td></td>
       			<td></td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">1</td>
       			<td rowspan="18" colspan="4" style="text-align: left;padding-left:2px;vertical-align: text-top;">
       			  <p>It is Certified that the C.G falls within the envelope as per the graph in</p>
       			  <p style="padding-bottom: 15px;">AFM Section 6 Page 6</p>
       			  <p style="padding-bottom: 15px;"><span>Sign of PIC:</span><span style="padding-left: 550px;">ATPL/CPL No.</span></p>
       			  <p>Date:</p>
       			  <p style="padding-top: 2px;">Note</p>
       			  <p style="line-height: 16px;">1. As per CAR Section 2 Series X Part II . Standard Weignt of Crew</p>
       			  <p>is 85 Kgs ( 187 Lbs). Adult Passengers, Male & Female is 75 Kgs (165 lbs).</p>
       			  <p>Children between 2-12 years is 35 kags(77 lbs) ,infants ( less than 2 years )</p>
       			  <p>10 Kgs (22 lbs).</p>
       			  <p style="line-height: 18px;">2. Life Raft Weight 53.3 lbs ( 24.2 Kgs.) and is kept in the Aft Coal Closet.</p>
       			  <p>The weight and moment is to be reflected in the Load & Trim Sheet as an</p>
       			  <p>when the Life raft is carried on board.</p>
       			  <p>3. Pilot will ensure that all the cargo is properly loadde.</p>
       			  <p>4. Pilots will ensure that CG falls within the envelope.</p>
       			  <p>5."The JUMP SEAT Is NOT TO BE OCCUPLED BY PASSENGERS"</p>
       			  <p>6.Refer next page for fuel weight/moment c.g table and CG linits table.</p>
       			</td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">2</td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       			<td style="color: #fff;">3</td>		
                       </tr>
       		  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">4</td>
       		  </tr>
       		  <tr style="line-height: 13px;">
       		       <td style="padding-bottom: 0px;color: #fff;">5</td>
                       </tr>	
       		  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">6</td>
                       </tr>
       		  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">7</td>
                       </tr>
                       <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">8</td>
                       </tr>
                       <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">9</td>
                       </tr>
       		  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">10</td>
                       </tr>
       		  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">11</td>
                       </tr>
			  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">12</td>
                       </tr>
       		  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">13</td>
                       </tr>
       		  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">14</td>
                       </tr>
       		  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">15</td>
                       </tr>
       		  <tr style="line-height: 13px;">
       		       <td style="padding-bottom: 0px;color: #fff;">16</td>
                       </tr>
       		  <tr style="line-height: 13px;">
       		       <td style="padding-bottom: 0px;color: #fff;">17</td>
                       </tr>
       		  <tr style="line-height: 13px;">
       			<td style="padding-bottom: 0px;color: #fff;">18</td>
                       </tr>	       							
       	  </tbody>           </table>
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