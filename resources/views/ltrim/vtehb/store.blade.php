@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtehb.css')}}">
@endpush

@section('content')
<div class="page">
    @include('includes.new_header',[])
    <main>

         <div class="container sec-container">
           <div class="row">
             <div class="col-md-12" style="margin-top: 15px;margin-bottom: 15px;">
               <p style="text-align: center;text-decoration:underline;font-size: 15px;font-weight: bold;">SARAYA AVIATION PVT. LTD.</p>
               <p style="text-align: center;text-decoration:underline;font-size: 15px;font-weight: bold;">IGI AIRPORT,PALAM,NEW DELHI</p>
               <P style="text-align: center;text-decoration:underline;font-size: 15px;font-weight: bold;">LOAD AND TRIM SHEET (PASSENGER CONFIGURATION)</P>
             </div>
             <div style="padding-left: 50px;">
             <div class="col-md-12" style="margin-bottom: 15px;">
               <p style="font-size:13px;font-weight: bold;"><span style="font-weight: bold;">TYPE OF AIRCRAFT : SUPER KING AIR B-200</span>
               <span style="padding-left: 70px;">AIRCRAFT REGN : VT-EHB</span></p>
             </div>
             <div class="col-md-12">
               <p style="font-size:13px;font-weight: bold;
               ">SECTOR:</p>
               <p style="font-size:13px;font-weight: bold;"><span style="">Date:</span><span style="font-size:12px;font-weight: bold;padding-left:500px;">PRESSURE  ALTITUDE </span><span><img style="margin-top: -107px;padding-left: 40px;" src="{{url('media/images/lnt/vtehb/vtehb_stamp.PNG')}}" </span></p>
               <p style="font-weight: bold;font-size:12px;text-align: right;padding-right: 196px;">TEMPERATURE</p>
             </div>
             </div>
             <div class="col-md-12" style="margin-bottom: 15px;">
               <table class="table table-bordered sec-hb-table">
                 <thead>
                   <tr style="text-align: center;font-size: 12PX;font-weight: bold;text-align: center;">
                     <th style="width:3%;border-bottom:0px;"></th>
                     <th style="width:26%;border-bottom:0px;padding-left:10px;">DESCRIPTION</th>
                     <th style="width: 7%;vertical-align: text-top;border-bottom:0px;">Weight <p>(Kgs)</p></th>
                     <th style="width:7%;vertical-align: text-top;border-bottom:0px;">Weight <p>(Lbs)</p></th>
                     <th style="width: 7%;vertical-align: text-top;border-bottom:0px;">ARM <p>(INCH)</p></th>
                     <th style="width: 10%;vertical-align: text-top;border-bottom:0px;">MOMENT/100 <p>(In-lbs)</p></th>
                     <th colspan="2" style="width: 15%;padding: 0px;"> To be filled by the Pilot <br><br></th>
                   </tr>
                   <tr style="text-align: center;font-size: 12PX;font-weight: bold;text-align: center;">
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="border-top:0px;"></th>
                     <th style="vertical-align: text-top;">Weight <p>(Lbs)</p></th>
                     <th>Moment/100 <p>(in - lbs)</p></th>
                   </tr>
                 </thead>
                 <tbody style="font-size: 12px;">
                   <tr>
                     <td style="text-align: center;">1</td>
                     <td style="font-weight: bold;">Basic Empty Weight</td>
                     <td style="text-align: center;">3697.19</td>
                     <td style="text-align: center;">8150.90</td>
                     <td style="text-align: center;">186.54</td>
                     <td style="text-align: center;">15204.69</td>
                     <td style="text-align: center;">8150.90</td>
                     <td style="text-align: center;">15204.69</td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">2</td>
                     <td>PILOT & Co-PILOT</td>
                     <td style="text-align: center;">170</td>
                     <td style="text-align: center;">374</td>
                     <td style="text-align: center;">129</td>
                     <td style="text-align: center;">482.46</td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">3</td>
                     <td>1 Adult<p>1 Child</p></td>
                     <td style="text-align: center;">75<p>35</p></td>
                     <td style="text-align: center;">165<p>77</p></td>
                     <td style="text-align: center;">163<p>163</p></td>
                     <td style="text-align: center;">268.95<p>125.51</p></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">4</td>
                     <td>1 Adult<p>1 Child</p></td>
                     <td style="text-align: center;">75<p>35</p></td>
                     <td style="text-align: center;">165<p>77</p></td>
                     <td style="text-align: center;">176<p>176</p></td>
                     <td style="text-align: center;">290.40<p>135.52</p></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">5</td>
                     <td>1 Adult<p>1 Child</p></td>
                     <td style="text-align: center;">75<p>35</p></td>
                     <td style="text-align: center;">165<p>77</p></td>
                     <td style="text-align: center;">183<p>183</p></td>
                     <td style="text-align: center;">301.95<p>140.91</p></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">6</td>
                     <td>1 Adult<p>2 Adult</p><p>1 Child</p><p>2 Children</p></td>
                     <td style="text-align: center;">75<p>150</p><p>35</p><p>70</p></td>
                     <td style="text-align: center;">165<p>330</p><p>77</p><p>154</p></td>
                     <td style="text-align: center;">215<p>215</p><p>215</p><p>215</p></td>
                     <td style="text-align: center;">354.75<p>709.50</p><p>165.55</p><p>331.10</p></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">7</td>
                     <td>1 Adult<p>2 Adult</p><p>1 Child</p><p>2 Children</p></td>
                     <td style="text-align: center;">75<p>150</p><p>35</p><p>70</p></td>
                     <td style="text-align: center;">165<p>330</p><p>77</p><p>154</p></td>
                     <td style="text-align: center;">259<p>259</p><p>259</p><p>259</p></td>
                     <td style="text-align: center;">427.35<p>854.70</p><p>199.43</p><p>398.86</p></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">8</td>
                     <td>Lav Seat<p>1 Adult</p><p>1 Child</p></td>
                     <td style="text-align:center;vertical-align:bottom;">75<p>35</p></td>
                    <td style="text-align:center;vertical-align:bottom;">165<p>77</p></td>
                    <td style="text-align:center;vertical-align:bottom;vertical-align:bottom;">293<p>293</p></td>
                    <td style="text-align:center;vertical-align:bottom;">483.45<p>225.61</p></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                       <td style="text-align: center;">9</td>
                     <td>Rear Compt.(Aft Folding Seat)<p><span>Max 550 Lbs</span> <span style="padding-left: 30px;">1 Adult</span></p><p style="text-align: center;padding-right: 67px;">1 Child</p><p style="text-align: center;padding-right: 67px;">2 Adult</p><p style="text-align: center;padding-right: 51px;">2 Children</p><p style="text-align: center;padding-right: 51px;">Baggage</p></td>
                     <td style="padding-top: 20px;text-align: center;">75<p>35</p><p>150</p><p>70</p></td>
                     <td style="padding-top: 20px;text-align: center;">165<p>77</p><p>330</p><p>154</p></td>
                     <td style="padding-top: 20px;text-align: center;">330<p>330</p><p>330</p><p>330</p><p>330</p></td>
                    <td style="padding-top: 20px;text-align: center;">544.50<p>254.10</p><p>1089.00</p><p>508.20</p></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                    <td style="text-align: center;">10</td>
                     <td><p style="font-weight: bold;">Zero Fuel Weight (Max 11000 Lbs.)</p><p>Sub Total (1+2+3+4+5+6+7+8+9)</p></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">11</td>
                     <td style="font-weight: bold;">Fuel Loading (Max 3590 Lbs)</td>
                     <td colspan="4" style="text-align: center;">For Moment :- Refer Table in Flight Manual Pg.No.6-11</td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">12</td>
                     <td><p style="font-weight: bold;">RAMP Weight (Max 12590 Lbs)</p><p>Sub Total (10+11)</p></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">13</td>
                     <td style="font-style: italic;font-weight: bold;">Less Fuel For Start, Taxi & Take-off</td>
                     <td style="text-align: center;">-41</td>
                     <td style="text-align: center;">-90</td>
                     <td></td>
                     <td style="text-align: center;">-177</td>
                     <td style="text-align: center;">-90</td>
                     <td style="text-align: center;">-177</td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">14</td>
                     <td><p style="font-weight: bold;">Take Off Weight</p> <p>(MTOW 12590 Lbs)</p><p>Sub Total (12+13)</p></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                   </tr>
                   
                   <tr>
                     <td style="text-align: center;">15</td>
                     <td style="font-style: italic;font-weight: bold;">Less Fuel For Start,Taxi & Take-off</td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                   </tr>
                   <tr>
                     <td style="text-align: center;">16</td>
                     <td><p style="font-weight: bold;">Landing Weight</p><p>Sub Total (14+15)</p></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td></td>
                   </tr>
                    <tr>
                     <td style="text-align: center;">17</td>
                     <td><p style="font-weight: bold;">CG Range as per Graph overleaf at</p> <p>Take Off Condition</p></td>
                     <td></td>
                     <td></td>
                     <td></td>
                     <td style="text-decoration:underline;border-right:0px;">Forward</td>
                     <td style="text-decoration:underline;border-right: 0px;border-left: 0px;text-align: right;">Obtained</td>
                     <td style="text-decoration:underline;border-left: 0px;text-align: right;padding-right:10px;">Aft</td>
                   </tr>
                 </tbody>
               </table>
             </div>
             <div class="col-md-12" style="font-size: 12px;padding-left:70px;margin-bottom:15px;">
                            <p style="padding-left:410px;"><i>Total Moment</i></p>
                            <p><i >C.G. for the Days Flight <span style="padding-left: 150px">= </span> &nbsp;<span style="padding-left: 120px;"> ____________</span>&nbsp; x 100   </i></p>
                            <p style="padding-left:410px;"><i>Total Weight</i></p>
                        </div>
                        <div class="col-md-12" style="font-weight: bold;font-size: 12px;">
                          <p style="padding-left: 12px;">DATUM : The reference datum is located 83.5 in. forward of the Center of the front jack point</p>
                        </div>
                        <div class="col-md-12" style="padding-left: 0px;font-size: 12px;border:1px solid #333;margin-left: 14px;width: 97%;">
                          <p style="padding-left: 13px;">Limitation . NOTE . Select the lowest weight of the Following:</p>
                          <p style="padding-left: 13px;">Limited Max . Allowable TOW for the runway to be used with reference to altitude and temperature <span style="padding-left: 190px;"> ____________Lbs.</span></p>
                          <p style="padding-left: 13px;">Limited TOW considering enroute performance <span style="padding-left: 466px;"> ____________Lbs.</span></p>
                          <p style="padding-left: 13px;">Max TOW considering limitations of landing weight at destination airport <span style="padding-left: 331px;"> ____________Lbs.</span></p>
                          <p style="padding-left: 13px;padding-bottom: 15;">Maximum Take Off weight <span style="padding-left: 584px;">12500</span></p>
                        </div>
                        <div class="col-md-12" style="font-size: 12px;padding-left:28PX;">
                          <p>It is certified that the CG falls within the allowable range</p>
                          <P style="text-align: right;padding-right: 150px;">Sign of PIC:</P>
                          <p style="text-align: right;padding-right: 150px;">License NO:</p>
                        </div>
                        <div class="col-md-12" style="font-size:12px;">
                          <p style="padding-left: 10px;padding-bottom: 10px;">IMPORTANT</p>
                          <p><span style="padding-left: 25px;">1 </span> 
                          <span style="padding-left: 20px;">Maximum Ramp Weight - 12590 Lbs. (5723Kgs.)</span></p>
                          <p> <span style="padding-left: 25px;">2 </span>
                          <span style="padding-left: 20px;">Maximum Landing Weight - 12500 Lbs. (5682Kgs.)</span></p>
                          <p> <span style="padding-left: 25px;">3</span>
                          <span style="padding-left: 20px;">01 Kg = 22046 Lbs.</span></p>
                          <p> <span style="padding-left: 25px;">4</span>
                          <span style="padding-left: 20px;">Empty Weight C.G - 186.54 inches aft of the Datum</span></p>
                          <p> <span style="padding-left: 25px;">5 </span>
                          <span style="padding-left: 20px;">Maximum Capacity of rear baggage compartment is 550 Lbs with any combination passengers and / or baggage and/ or equipment</span></p>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 50px;">
                          <img style="margin-top: -19px;padding-left: 500px;" src="{{url('media/images/lnt/vtehb/vtehb_stamp1.PNG')}}" </span>
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