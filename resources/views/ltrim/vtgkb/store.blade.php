@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtgkb.css')}}">
@endpush

@section('content')
<div class="page">
    @include('includes.new_header',[])
    <main>
     <div class="container sec-container">
     	<div class="row">
     		<div class="col-md-12" style="margin-top: 15px;margin-bottom: 5px;">
     			<table style="border:1px solid #000;border-collapse: collapse;margin-left: 13px;">
     				<tbody>
     				<tr>
     					<td style="width:10%;border-right: 1px solid #000;border-collapse: collapse;color:#fff">111112212</td>
     					<td colspan="4" style="text-align: center;width:90%;font-weight: bold;border-left: 1px solid #000;border-collapse: collapse;">
     						<p style="font-size: 19px;text-transform: uppercase;">orbit aviation private limited</p>
     						<p style="font-size: 12px;padding-right: 7px;">Near Hangar # 4, I.G.I Airport, palam, New Delhi - 11003</p>
     						<p style="font-size: 14px;text-transform: uppercase;">gulfstream g-150, vt.gkb, msn.280</p>
     						<p style="font-size: 13px;text-transform: uppercase;">load and trim sheet</p>
     					</td>
     					</tr>
     				</tbody> 
     			</table>
     		</div>
     		<div class="col-md-12">
     		<table style="border:1px solid #000;border-collapse: collapse;width: 771px;font-size: 12px;border-bottom: 0px;margin-left: 13px;">
     			<tbody>
     				<tr style="line-height: 13px;">
     					<td colspan="1" style="width: 30%;padding-left: 10px;">DATE:</td>
     					<td colspan="4" style="width: 70%;padding-left: 102px;">SECTOR:</td>
     				</tr>
     				
     				<tr style="line-height:13px;border-top:1px solid #000;border-collapse: collapse;">
     					<td colspan="1" style="width: 30%;padding-left: 10px;">CAPT:</td>
     					<td colspan="4" style="width: 70%;padding-left: 102px;">CO-PILOT:</td>
     				</tr>
     					<tr style="line-height:13px;border-top:1px solid #000;border-collapse: collapse;font-size: 12px;">
     						<td style="padding-left: 10px;border-right: 1px solid #000;">Max Ramp Weight</td>
     						<td style="padding-left: 10px;border-left: 1px solid #000;border-right: 1px solid #000;">: 11,906 kgs/26.250 lbs</td>
     						<td style="padding-left: 10px;border-left: 1px solid #000;border-right: 1px solid #000;">Maximum Take-off Weight</td>
     						<td style="padding-left: 10px;border-left: 1px solid #000;">: 11,838kgs/26.100 lbs</td>
     						<td></td>
     					</tr>
     					<tr style="line-height:13px;border-top:1px solid #000;border-collapse: collapse;font-size: 12px;">
     						<td style="padding-left: 10px;border-right: 1px solid #000;">Max Usable Weight</td>
     						<td style="padding-left: 10px;border-left: 1px solid #000;border-right: 1px solid #000;">: 4672 kgs/10.300 lbs</td>
     						<td style="padding-left: 10px;border-left: 1px solid #000;border-right: 1px solid #000;">Maximum Landing Weight</td>
     						<td style="padding-left: 10px;border-left: 1px solid #000;">: 9842kgs/21.700 lbs</td>
     						<td></td>
     					</tr>
     					<tr style="line-height:13px;border-top:1px solid #000;border-collapse: collapse;font-size: 12px;">
     						<td style="padding-left: 10px;border-right: 1px solid #000;">Maximum Zero Fuel Weight</td>
     						<td style="padding-left: 10px;border-left: 1px solid #000;border-right: 1px solid #000;">: 7937kgs/17.500 lbs</td>
     						<td style="padding-left: 10px;border-left: 1px solid #000;border-right: 1px solid #000;">Maximum Baggage Capacity</td>
     						<td style="padding-left: 10px;border-left: 1px solid #000;">: 498kgs/1.00 lbs</td>
     						<td></td>
     					</tr>
     			</tbody>
     		</table>
     		<table class="sec_gkb" style="width: 771px;font-size: 12px;margin-left: 13px;">
     			<thead>
     				<tr style="line-height:13px;">
     					<th style="text-align: left;padding-left: 10px;width: 36%;">ITEMS</th>
     					<th style="width:15%">Weight (lbs)</th>
     					<th style="width:13%">Arm (in)</th>
     					<th style="width:13%">Moment (lbs*in)</th>
     					<th style="width:13%">MAC</th>
     				</tr>
     			</thead>
     			<tbody>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">BASIC WEIGHT</td>
     					<td style="padding-right: 10px;">14,909</td>
     					<td style="padding-right: 10px;">349.92</td>
     					<td style="padding-right: 10px;">5216957.3</td>
     					<td style="padding-right: 10px;">3806</td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Crew: Pilot & Copilot (including baggage)</td>
     					<td style="padding-right: 10px;">374</td>
     					<td style="padding-right: 10px;">115.90</td>
     					<td style="padding-right: 10px;">43347</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Manuals</td>
     					<td style="padding-right: 10px;">46</td>
     					<td style="padding-right: 10px;">13.90</td>
     					<td style="padding-right: 10px;">6619</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Galley contents</td>
     					<td style="padding-right: 10px;">64</td>
     					<td style="padding-right: 10px;">159.60</td>
     					<td style="padding-right: 10px;">10214</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Galley fluid</td>
     					<td style="padding-right: 10px;">11</td>
     					<td style="padding-right: 10px;">159.60</td>
     					<td style="padding-right: 10px;">1756</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Left Closet Stowage</td>
     					<td style="padding-right: 10px;">17</td>
     					<td style="padding-right: 10px;">175.00</td>
     					<td style="padding-right: 10px;">2975</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Aft Lavatory Vanity Contents</td>
     					<td style="padding-right: 10px;">35</td>
     					<td style="padding-right: 10px;">338.10</td>
     					<td style="padding-right: 10px;">11834</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Lavatory Fluid</td>
     					<td style="padding-right: 10px;">14.2</td>
     					<td style="padding-right: 10px;">338.10</td>
     					<td style="padding-right: 10px;">11834</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Potable Water</td>
     					<td style="padding-right: 10px;">13.7</td>
     					<td style="padding-right: 10px;">343.00</td>
     					<td style="padding-right: 10px;">4801</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Life Raft (FWD R.H. Closet)</td>
     					<td style="padding-right: 10px;">55</td>
     					<td style="padding-right: 10px;">153.00</td>
     					<td style="padding-right: 10px;">8415</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">Life Raft (AFT L.H. Closet)</td>
     					<td style="padding-right: 10px;">55</td>
     					<td style="padding-right: 10px;">325.90</td>
     					<td style="padding-right: 10px;">17925</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;vertical-align: top;font-weight: bold;">LIFE RAFT lOCATED IN FWD R.H & AFT L.H<P>CLOSETS.</P></td>
     					<td ><p style="border-bottom: 1px solid #000;padding-right: 10px;color: #fff;">1</p><p style="border-bottom: 1px solid #000;padding-right: 10px;color: #fff;">2</p><p style="padding-right: 10px;color: #fff;">3</p></td>
     					<td><p style="border-bottom: 1px solid #000;padding-right: 10px;color: #fff;">1</p><p style="border-bottom: 1px solid #000;padding-right: 10px;color: #fff;">2</p><p style="padding-right: 10px;color: #fff;">3</p></td>
     					<td><p style="border-bottom: 1px solid #000;padding-right: 10px;color: #fff;">1</p><p style="border-bottom: 1px solid #000;padding-right: 10px;color: #fff;">2</p><p style="padding-right: 10px;color: #fff;">3</p></td>
     					<td><p style="border-bottom: 1px solid #000;padding-right: 10px;color: #fff;">1</p><p style="border-bottom: 1px solid #000;padding-right: 10px;color: #fff;">2</p><p style="padding-right: 10px;color: #fff;">3</p></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;font-weight: bold;">BASIC OPERATING WEIGHT (BOW)</td>
     					<td style="padding-right: 10px;font-weight: bold;">15,594</td>
     					<td style="padding-right: 10px;font-weight: bold;">341.77</td>
     					<td style="padding-right: 10px;font-weight: bold;">5329542</td>
     					<td style="padding-right: 10px;font-weight: bold;">28.61</td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Baggage Compartment (Ref.AFM Section VIII Pg. <p>VIII-19, Figure 8-10)</p></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;padding-top: 10px;">452</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Aft facing L.H Single Seat</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;">194.10</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Aft facing R.H Single Seat</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;">194.10</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Fwd facing L.H Single Seat</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;">258.56</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Fwd facing R.H Single Seat</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;">258.56</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">
     					Aft L.H Single Seat</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;">306.56</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Aft R.H Single Seat</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;">306.56</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Lavatory Seat</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;">330.10</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Zero Fuel Weight (ZFW)</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Usable Fuel (Max 10,300 lbs) (Ref. AFM Section)<p>VIII Pg. VIII-22 to 26,figure 8-12)</p></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Ramp Weight</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Fuel Burn off Before Take-off</td>
     					<td style="padding-right: 10px;">150</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;">77786</td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td style="text-align: left;padding-left: 10px;">Take-off Weight</td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     					<td style="padding-right: 10px;"></td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td colspan="5" style="text-align: left;padding-left: 10px;padding-top: 20px;">
     						
     					<p style="padding-left:115px;font-size: 12px;line-height:0px;padding-top: 10px;margin:0px;"><i>Total Moment</i></p>
                            <p style="font-size: 12px;"><i>C.G. of Flight = &nbsp;<span style="padding-left:22px;">____________</span> <span style="padding-left:30px;"> = ....................</span>  &nbsp;&nbsp;&nbsp;</i></p>
                            <p style="padding-left:115px;font-size: 12px;"><i>Total Weight</i></p>
     					</td>
     				</tr>
     				<tr style="line-height:13px;">
     					<td colspan="5" style="text-align: left;padding-left: 10px;padding-bottom: 10px;">
     						<p style="padding-left:97px;font-size: 12px;line-height:0px;padding-top: 10px;margin:0px;"><i>Arm (in)-317.087</i></p>
                            <p style="font-size: 12px;"><i><span>%MAC</span> <span style="padding-left: 17px;">=</span> &nbsp;<span style="padding-left:22px;">_______________</span> <span style="padding-left:30px;"> x 100</span>  &nbsp;&nbsp;&nbsp;</i></p>
                            <p style="padding-left:121px;font-size: 12px;"><i>86.26</i></p>
     					</td>
     				</tr>
     			</tbody>
     		</table>
     		</div>
     		<div class="col-md-12" style="margin-bottom: 15px;margin-left: 13px;">
     			<p><span style="font-weight: bold;font-size:12px;">NOTE-1: </span><span  style="font-size:12px;">When loading baggage in excess of 440 lbs, ensure that aft ground handling cg limit of 358.5 in (48% MAC) is not exceeded.</span></p>
     			<p><span style="font-weight: bold;font-size:12px;">NOTE-2: </span><span style="font-size:12px;"> All calculations are with landing gear down. Moment change due to landing gear retraction is: [-]1300 lb.in</span></p>
     			<p><span style="font-weight: bold;font-size:12px;">NOTE-3:</span><span style="font-size:12px;">The datum (sation 0) is located 139.724 in.forward of frame Sta. 139.724 in. (fuselage nose jack point).</span></p>
     			<p style="font-size: 12px;padding-top: 10px;padding-bottom: 10px;"><span>SIGNATURE</span><span style="padding-left: 50px;">:...............</span><span style="padding-left:207px;">ATPL NO:..........</span></p>
     			<p style="font-size: 12px;padding-bottom: 10px;"><span>NAME OF THE PILOT:...............</span><span style="padding-left:207px;">DATED</span><span style="padding-left: 10px;">:..........</span></p>
     			<p style="font-size: 11px;font-weight: bold;">CONVERSION TABLE</p>
     			<p style="font-size: 12px;"><span>1 lbs</span><span style="padding-left: ">=0.45359237 Kgs</span></p>
     			<p style="font-size: 12px;"><span>1 inches </span><span>=0.0254 mtrs</span></p>
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