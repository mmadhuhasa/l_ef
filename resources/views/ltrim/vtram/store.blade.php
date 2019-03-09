@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtram.css')}}">
@endpush
  
@section('content')
<div class="page">
    @include('includes.new_header',[])
    <main>
         <div class="container sec-container" style="width: 900px;
              background: #fff;font-family: arial,sans-serif;
                margin-top: 15px;margin-bottom: 15px;" >
           <div class="row" style="margin-left:20px;">
             <div class="col-md-12">
             <div class="col-md-3">
               <img style="padding-top: 15px;margin-left:60px;margin-top: 9px; " src="{{url('media/images/lnt/vtram/vtram_logo.PNG')}}">
             </div>
             <div class="col-md-6">
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
               <div class="col-md-3">
                 <img style="padding-top: 15px;" src="{{url('media/images/lnt/vtram/vtram_stamp1.PNG')}}">
               </div>
             </div>
             <div class="col-md-12" style="padding-bottom:20px; ">
               <P style="text-align: center;font-size: 16px;font-weight: bold;">
               LOAD & TRIM SHEET - KING AIR C-90 (S.NO. LJ-790/REG.NO. VT-RAM)
               </P>
               <P style="text-align: center;font-size: 15px;font-weight: bold;">
               (PASSENGER CONFIGURATION)</P>
             </div>
             <div class="col-md-12">
               <p style="padding-bottom: 15px;">
               <span style="padding-left:70px;font-size: 12px;font-weight: bold;">DATE :</span>
               <span style="padding-left:300px;font-size: 12px;font-weight: bold;">SECTOR :</span>
               </p>
             </div>
             <div class="col-md-12" style="margin-bottom:15px;">
               <div class="col-md-7" style="padding-left: 70px;">
                 <P style="font-size:13px;padding-bottom: 5px;">
                 <span style="display: inline-block;border-bottom:1px solid #333;margin:0 auto;font-weight:bold;">COMPUTATIONS:</span>
                 </P>
                 <P style="font-size:12px;font-weight: bold;">
                 <span style="padding-right: 20px;">A.</span>
                  <span>MAX. TAKE-OFF WEIGHT</span> 
                  <span style="padding-right:10px;">: 9650.00 LBS / 4377.14  KG</span>
                  </P>
                 <P style="font-size:12px;font-weight: bold;">
                   <span style="padding-right: 20px;">B.</span>  
                   <span>MAX. RAMP WEIGHT </span> 
                   <span style="padding-left: 24px;">: 9705.00 LBS / 4402.18  KG</span>
                 </P>
                 <P style="font-size:12px;font-weight: bold;">
                 <span style="padding-right: 20px;">C.</span> 
                  <span> EWCG</span>
                   <span style="padding-left: 98px;">: 153.87 INCHES AFT OF DATUM</span>
                   </P>
                 <P style="font-size:12px;font-weight: bold;">
                 <span style="padding-right: 20px;">D.</span>  
                 <span>MAX. LANDING WEIGHT</span> 
                 <span style="padding-left: 4px;">: 9168 LBS / 4158.51 KG</span>
                 </P>
                 <P style="font-size:12px;font-weight: bold;">
                 <span style="padding-right: 20px;">E.</span> 
                  <span>ZERO FUEL WEIGHT</span> 
                  <span style="padding-left: 25px;">: NO STRUCTURAL LIMITATION</span>
                  </P>
               </div>
               <div class="col-md-5" style="border:1PX solid #333;padding: 0px;margin-top: 20px;width:20%;font-size: 13px;font-weight: bold;">
                 <p style="border-bottom:1PX solid #333;padding:10px 0px 3px 5px;font-weight: bold;">OAT</p>
                 <P style="padding-top: 5px;padding-left:5px;margin:0px;padding-bottom: 0px;font-weight: bold;">PRESSURE</P>
                 <P style="padding-bottom: 5px;padding-left:5px;margin:0px;padding-top: 0px;font-weight: bold;">ALTITUDE</P>
               </div>
             </div>
             <div class="col-md-12">
               <table class="table table-bordered sec_descr">
               <thead>
                   <tr style="text-align: center;font-size: 12PX;font-weight: bold;text-align: center;">
                     <th style="width:3%;border-bottom:0px;"></th>
                     <th style="width:26%;vertical-align: text-top;border-bottom:0px;text-align: left;padding-left:10px;">DESCRIPTION</th>
                     <th style="width: 7%;vertical-align: text-top;border-bottom:0px;">WEIGHT (KG)</th>
                     <th style="width:7%;vertical-align: text-top;border-bottom:0px;">WEIGHT (LB)</th>
                     <th style="width: 7%;vertical-align: text-top;border-bottom:0px;">ARM (INCH)</th>
                     <th style="width: 10%;vertical-align: text-top;border-bottom:0px;">MOMENT/100 (INCH LB)</th>
                     <th colspan="2" style="width: 15%;"> TO BE FILLED BY <p>PILOT IN COMMAND</p></th>
                   </tr>
                   <tr style="text-align: center;font-size: 12PX;font-weight: bold;text-align: center;">
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th>WEIGHT (LB)</th>
                     <th>Moment/100 (inch LB)</th>
                   </tr>
                 </thead>
                 <tbody style="font-size:12PX;">
                   <tr style="text-align: center;">
                     <td>1.</td>
                     <td style="text-align: left;">BASIC EMPTY WEIGHT</td>
                     <td>2862.32</td>
                     <td>6310.22</td>
                     <td>153.87</td>
                     <td>9709.53</td>
                     <td>6310.22</td>
                     <td>9709.53</td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>2.</td>
                     <td style="text-align: left;">PILOT & CO-PILOT</td>
                     <td>170.00</td>
                     <td>374.79</td>
                     <td>129.00</td>
                     <td>483.47</td>
                     <td>374.79</td>
                     <td>483.46</td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>3.</td>
                     <td style="text-align: left;">DRY OPERATING WEIGHT</td>
                     <td>3032.32</td>
                     <td>6685.00</td>
                     <td>152.47</td>
                     <td>10192.62</td>
                     <td>6685.00</td>
                     <td>10192.62</td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>4.</td>
                     <td style="text-align: left;">ROW 1 <p>02 x 75 KG</p> <p>01 x 75 KG</p><p>01 x 35 KG</p><p>02 x 35 KG</p>
                     </td>
                     <td><p style="margin-top:20px;">150.00</p> <p>75.00</p><p>70.00</p><p>35.00</p></td>
                     <td><p style="margin-top:20px;">330.69</p><p>165.35</p><p>154.32</p><p>77.16</p></td>
                     <td><p style="margin-top:20px;">168.00</p><p>168.00</p><p>168.00</p><p>168.00</p></td>
                     <td><p style="margin-top:20px;">555.56</p><p>277.78</p><p>259.26</p><p>129.63</p></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>5.</td>
                     <td style="text-align: left;">ROW 2 <p>2 x 75 KG</p><p></p>01 x 75 KG<p>01 x 35 KG</p><p>02 x 35 KG</p></td>
                     <td><p style="margin-top:20px;">150.00</p><p>75.00</p><p>35.00</p><p>70.00</p></td>
                     <td><p style="margin-top:20px;">330.69</p><p>165.35</p><p>77.16</p><p>154.32</p></td>
                     <td><p style="margin-top:20px;">212.00</p><p>212.00</p><p>212.00</p><p>259.26</p></td>
                     <td><p style="margin-top:20px;">701.07</p><p>350.54</p><p>163.58</p><p>259.26</p></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>6.</td>
                     <td style="text-align: left;">AISLE FACING SEAT<P>01 X 75 KG</P></td>
                     <td>75.00</td>
                     <td>165.35</td>
                     <td>245.00</td>
                     <td>405.10</td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>7.</td>
                     <td style="text-align: left;">LAV SEAT <P>01 X 75 KG</P></td>
                     <td>75.00</td>
                     <td>165.35</td>
                     <td>285.00</td>
                     <td>471.24</td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>8.</td>
                     <td style="text-align: left;">Less Fuel start, Taxi, Take-Off</td>
                     <td></td>
                     <td>-55</td>
                     <td></td>
                     <td>-85</td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>9.</td>
                     <td style="text-align: left;">BAGGAGE</td>
                     <td colspan="4">350 Lbs.</td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr style="text-align: center;">
                     <td>10.</td>
                     <td style="text-align: left;">FUEL FOR TAKE OFF<P>(MAX........................LB)</P></td>
                     <td colspan="4"></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr style="text-align: center;">
                   <td></td>
                     <td colspan="7" style="font-weight:bold;">C.G FOR FLIGHT=TOTAL MOMENT / TOTAL WEIGHT</td>
                   </tr>
                 </tbody>
               </table>
             </div>
             <div class="col-md-11" style="margin-bottom:15px;">
               <p style="font-size:12px;font-weight:bold;padding-left: 55px;">C.G LIMITS :</p>
             </div>
             <div class="col-md-12">
               <table class="table table-bordered sec-cond" style="width:665px;margin-left: 50px;">
                 <tbody style="font-size: 12px;">
                   <tr>
                     <td style="padding: 0px;padding-left: 5px;">WEIGHT CONDITION</td>
                     <td style="padding: 0px;padding-left: 5px;">FWD. CG LIMIT (IN)</td>
                     <td style="padding: 0px;padding-left: 5px;">AFT CG LIMIT (IN)</td>
                   </tr>
                   <tr>
                     <td style="padding: 0px;padding-left: 5px;">9650 Lbs. (MTOW)</td>
                     <td style="padding: 0px;padding-left: 5px;">153.2</td>
                     <td style="padding: 0px;padding-left: 5px;">160.00</td>
                   </tr>
                   <tr>
                     <td style="padding: 0px;padding-left: 5px;">9168 Lbs. (MLW)</td>
                     <td style="padding: 0px;padding-left: 5px;">151.4</td>
                     <td style="padding: 0px;padding-left: 5px;">160.00</td>
                   </tr>
                   <tr>
                     <td style="padding: 0px;padding-left: 5px;">7400 Lbs. or Less</td>
                     <td style="padding: 0px;padding-left: 5px;">144.7</td>
                     <td style="padding: 0px;padding-left: 5px;">160.00</td>
                   </tr>
                 </tbody>
               </table>
             </div>
             <div class="col-md-12" style="margin-bottom:25px;">
               <p style="padding-left: 55px;font-size: 12px;margin: 0px;">* 1 Kg = 2.204 lbs. and 1 inch = 2.54 cm</p>
             </div>
             <div class="col-md-12" style="margin-bottom: 30px;">
               <p style="padding-left: 55px;font-size:13px;font-weight: normal;">It is certified that the C.G falls within the allowble range as per Weight and balance graph overleaf from Aircraft </p>
               <p style="padding-left: 55px;font-size:13px;">Flight Manul</p>
             </div>
             <div class="col-md-12">
             <div class="col-md-9">
               <p style="font-size:13px;font-weight: bold;padding-left: 40px;">Signature of PIC :</p>
               </div>
               <div class="col-md-3" style="margin-bottom: 30px;">
                 <img src="{{url('media/images/lnt/vtram/vtram_stamp2.PNG')}}">
               </div>
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