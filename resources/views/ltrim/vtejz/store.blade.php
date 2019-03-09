@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtejz.css')}}">
@endpush

@section('content')
<div class="page">
    @include('includes.new_header',[])
    <main>
     <div class="container sec-container">
     <div class="row">
     	<div class="col-md-12">
               <p style="text-align: center;padding-top:15px;padding-bottom: 10px;font-size:18px;font-weight:bold;">
               
               <span style="display: inline-block;border-bottom:1px solid #333;margin:0 auto;">

               SARAYA AVIATION PVT. LTD.
               </span>
               </p>
               <P style="text-align: center;padding-bottom: 25px;font-size:18px;font-weight:bold;">
               <span style="display: inline-block;border-bottom:1px solid #333;margin:0 auto;">
               NEW DELHI
               </span></P>
        </div>
           <div class="col-md-12" style="padding-bottom:20px; ">
               <P style="text-align: center;font-size: 16px;font-weight: bold;">
               LOAD & TRIM SHEET - KING AIR C-90A (S.NO. LJ-1100/REG.NO. VT-EJZ)
               </P>
               <P style="text-align: center;font-size: 15px;font-weight: bold;">
               (PASSENGER CONFIGURATION)</P>
            </div>
             <div class="col-md-12">
               <p style="padding-bottom: 15px;">
               <span style="padding-left:78px;font-size: 12px;font-weight: bold;">DATE :</span>
               <span style="padding-left:188px;font-size: 12px;font-weight: bold;">SECTOR :</span>
               </p>
             </div>
             <div class="col-md-12" style="margin-bottom:15px;">
               <div class="col-md-7" style="padding-left: 78px;">
                 <P style="font-size:13px;padding-bottom: 5px;">
                 <span style="display: inline-block;border-bottom:1px solid #333;margin:0 auto;font-weight:bold;">COMPUTATIONS:</span>
                 </P>
                 <P style="font-size:12px;font-weight: bold;">
                 <span style="padding-right: 20px;">A.</span>
                  <span>MAX. TAKE-OFF WEIGHT</span> 
                  <span style="padding-right:10px;">:10353 Lbs/4697Kg</span>
                  </P>
                 <P style="font-size:12px;font-weight: bold;">
                   <span style="padding-right: 20px;">B.</span>  
                   <span>MAX. RAMP WEIGHT </span> 
                   <span style="padding-left: 23px;">: 10410 Lbs/4723Kg</span>
                 </P>
                 <P style="font-size:12px;font-weight: bold;">
                 <span style="padding-right: 20px;">C.</span> 
                  <span> EWCG</span>
                   <span style="padding-left: 105px;">: 153.69 INCHES AFT OF DATUM</span>
                   </P>
                 <P style="font-size:12px;font-weight: bold;">
                 <span style="padding-right: 20px;">D.</span>  
                 <span>MAX. LANDING WEIGHT</span> 
                 <span style="padding-left: 4px;">: 9700 Lbs/4401 Kgs</span>
                 </P>
               </div>
               <div class="col-md-12">
               <table class="table table-bordered sec_vtejz">
               <thead>
                   <tr style="text-align: center;font-size: 12PX;font-weight: bold;text-align: center;">
                     <th style="width:3%;border-bottom:0px;">S/N</th>
                     <th style="width:26%;border-bottom:0px;padding-left:10px;">DESCRIPTION</th>
                     <th style="width:7%;border-bottom:0px;">WEIGHT (LB)</th>
                     <th style="width: 7%;border-bottom:0px;">ARM (INCH)</th>
                     <th style="width: 10%;vertical-align: text-top;border-bottom:0px;">MOMENT/100 (INCH LB)</th>
                     <th colspan="3" style="width: 15%;"> TO BE FILLED BY <p>PILOT IN COMMAND</p></th>
                   </tr>
                   <tr style="text-align: center;font-size: 12PX;font-weight: bold;text-align: center;">
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th>WEIGHT (LB)</th>
                     <th colspan="2">Moment/100 <p>(INCH LB)</p></th>
                   </tr>
                 </thead>
                 <tbody style="font-size:12PX;">
                   <tr style="text-align: center;">
                     <td>1.</td>
                     <td style="text-align: left;padding-left: 5px;">BASIC EMPTY WEIGHT</td>
                     <td>6890.85</td>
                     <td>153.69</td>
                     <td>10590.55</td>
                     <td>6890.85</td>
                     <td colspan="2">10590.55</td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>2.</td>
                     <td style="text-align: left;padding-left: 5px;">PILOT & CO-PILOT</td>
                     <td>374.78</td>
                     <td>129.00</td>
                     <td>483.47</td>
                     <td>374.78</td>
                     <td colspan="2">483.47</td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>3.</td>
                     <td style="text-align: left;">LH Pax 1 (Adult)<p style="border-top:1px solid #000;">LH Pax 1 (Child)</p></td>
                     <td>165.35<p style="border-top:1px solid #000;">77.16</p></td>
                     <td>168.00<p style="border-top:1px solid #000;">168.00</p></td>
                     <td>277.79<p style="border-top:1px solid #000;">129.63</p></td>
                     <td style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                    <td colspan="2" style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>4.</td>
                     <td style="text-align: left;">RH Pax 1 (Adult)<p style="border-top:1px solid #000;">RH Pax 1 (Child)</p></td>
                     <td>165.35<p style="border-top:1px solid #000;">77.16</p></td>
                     <td>168.00<p style="border-top:1px solid #000;">168.00</p></td>
                     <td>277.79<p style="border-top:1px solid #000;">129.63</p></td>
                     <td style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                    <td colspan="2" style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>5.</td>
                     <td style="text-align: left;">LH Pax 2 (Adult)<p style="border-top:1px solid #000;">LH Pax 2 (Child)</p></td>
                     <td>165.35<p style="border-top:1px solid #000;">77.16</p></td>
                     <td>212.00<p style="border-top:1px solid #000;">212.00</p></td>
                     <td>350.54<p style="border-top:1px solid #000;">163.583</p></td>
                     <td style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                    <td colspan="2" style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>6.</td>
                     <td style="text-align: left;">RH Pax 2 (Adult)<p style="border-top:1px solid #000;">RH Pax 2 (Child)</p></td>
                     <td>165.35<p style="border-top:1px solid #000;">77.16</p></td>
                     <td>212.00<p style="border-top:1px solid #000;">212.00</p></td>
                     <td>350.54<p style="border-top:1px solid #000;">163.583</p></td>
                     <td style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                     <td colspan="2" style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>                   
                   </tr>
                   <tr style="text-align: center;">
                     <td>7.</td>
                     <td style="text-align: left;">RH Pax 3 (Adult)<p style="border-top:1px solid #000;">RH Pax 3 (Child)</p></td>
                     <td>165.35<p style="border-top:1px solid #000;">77.16</p></td>
                     <td>243.00<p style="border-top:1px solid #000;">212.00</p></td>
                     <td>401.80<p style="border-top:1px solid #000;">163.583</p></td>
                     <td style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                     <td colspan="2" style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>                   
                   </tr>
                   <tr style="text-align: center;">
                     <td>8.</td>
                     <td style="text-align: left;">LH LAV SEAT (Adult)<p style="border-top:1px solid #000;">LH LAV SEAT (Child)</p></td>
                     <td>165.35<p style="border-top:1px solid #000;">77.16</p></td>
                     <td>285.00<p style="border-top:1px solid #000;">285.00</p></td>
                     <td>471.25<p style="border-top:1px solid #000;">219.91</p></td>
                     <td style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                     <td colspan="2" style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>9.</td>
                     <td style="text-align: left;padding-left:5px;">
                     <table>
                     <tbody>
                     <tr>
                     	<td style="border-right: 1px solid #000;padding-right: 30px;">BAGGAGE</td>
                     	<td style="border-left: 1px solid #000;padding-left: 1px;">FRONT<p style="border-top:1px solid #000;width: 376%;">AFT</p></td>
                     </tr>
                     </tbody>
                     </table>
                     </td>
                     <td>xxxxx<p style="border-top:1px solid #000;">xxxxx</p></td>
                     <td>70.00<p style="border-top:1px solid #000;">282.00</p></td>
                     <td>xxxxx<p style="border-top:1px solid #000;">xxxxx</p></td>
                      <td style="color: #fff;">1<p style="border-top:1px solid #000;"></p></td>
                      <td colspan="2" style="color: #fff;">2<p style="border-top:1px solid #000;"></p></td>
                   <tr style="text-align: center;">
                     <td>10.</td>
                     <td style="text-align: left;padding-left: 5px;">FUEL FOR TAKE OFF (MAX <P style="padding-left: 40px;">LB)</P></td>
                     <td colspan="3" style="padding-top: 10px;">As Per table Given in  AFM Page 6-9</td>
                     <td></td>
                     <td colspan="2"></td>
                   </tr>
                   <tr style="text-align: center;">
                  	 <td colspan="5" style="text-align: right;padding-right:25px;font-weight: bold;">Total</td>
                   	 <td></td>
                     <td colspan="2"></td>
                   </tr>
                   <tr>
                     <td colspan="8" style="font-weight:bold;">C.G Calculation (In Inches) : Total Moment / Total Weight =</td>
                   </tr>
                 </tbody>
               </table>
             </div>
             <div class="col-md-12" style="margin-bottom:15px;">
               <p style="font-size:12px;font-weight:bold;padding-left: 55px;">C.G LIMITS :</p>
             </div>
             <div class="col-md-12">
               <table class="table table-bordered sec-cond" style="width:650px;margin-left: 50px;">
                 <tbody style="font-size: 12px;">
                   <tr>
                     <td style="padding: 0px;padding-left: 5px;text-align: center;font-weight: bold;">FWD. CG LIMIT (IN.)</td>
                     <td style="padding: 0px;padding-left: 5px;text-align: center;font-weight: bold;">AFT CG LIMIT (IN.)</td>
                   </tr>
                   <tr>
                     <td style="padding: 0px;padding-left: 5px;text-align: center;">152.5</td>
                     <td style="padding: 0px;padding-left: 5px;text-align: center;">160.00</td>
                   </tr>
                 </tbody>
               </table>
             </div>
             <div class="col-md-12" style="margin-bottom:25px;">
               <p style="padding-left: 55px;font-size: 12px;margin: 0px;">* 1 Kg = 2.2046 LBS AND 1 INCH = 2.54 CM</p>
             </div>
             <div class="col-md-12" style="margin-bottom: 20px;">
               <p style="padding-left: 55px;font-size:13px;font-weight: normal;">It is certified that the C.G falls within the allowble range as per Weight and balance graph overleaf from Aircraft </p>
               <p style="padding-left: 55px;font-size:13px;">Flight Manual</p>
             </div>
             <div class="col-md-12" style="margin-bottom: 20px;">
             	<p style="padding-left: 55px;font-size:12px;font-weight: bold;">Signature of PIC:</p>
             </div>
     </div>
     </div>
    </main>@include('includes.new_footer',[])
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
     