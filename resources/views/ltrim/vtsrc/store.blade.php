@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/ltrim/vtsrc.css')}}">
@endpush

@section('content')
<div class="page">
    @include('includes.new_header',[])
  <main>
    <div class="container sec-container">
      <div class="row">
        <div class="col-md-12" style="margin-top: 15px;margin-bottom:15px;">
          <p style="text-transform: uppercase;text-align:center;text-decoration:underline;font-size: 13px;font-weight: bold;">orbit aviation pvt . ltd</p>
          <p style="text-transform: uppercase;text-align:center;text-decoration:underline;font-size: 13px;font-weight: bold;">igi airport, palam, new delhi</p>
          <p style="text-transform: uppercase;text-align:center;text-decoration:underline;font-size: 13px;font-weight: bold;">load and trim sheet (corporate)</p>
        </div>
        <div class="col-md-12" style="margin-bottom: 15px;">
          <p><span style="font-size: 11px;text-transform: uppercase;font-weight: bold;padding-left: 65px;">type of aircraft:</span><span style="font-size: 11px;text-transform: uppercase;padding-left: 10px;font-weight: bold;">super king air b-200c</span><span style="font-size: 11px;text-transform: uppercase;padding-left: 156px;font-weight: bold;">aircraft regn:</span><span style="font-size: 11px;text-transform: uppercase;font-weight: bold;padding-left: 20px;">vt-src</span><span style="font-size: 11px;text-transform: uppercase;font-weight: bold;padding-left: 50px;">si.no.bl.139</span></p>
        </div>
        <div class="col-md-12">
          <p><span style="padding-left: 65px;text-transform: uppercase;font-size: 11px;font-weight: bold;">sector</span><span style="text-transform: uppercase;font-size:12px;font-weight: bold;padding-left:82px;">pressure altitude:</span><span style="text-transform: uppercase;font-weight: bold;font-size: 12px;padding-left: 102px;">temerature:</span><span style="font-size: 12px;font-weight: bold;text-transform: uppercase;padding-left: 94px;">date:</span></p>
        </div>
        <div class="col-md-12">
          <table class="table table-bordered sec-sre" style="width:710px;margin-left:50px;">
            <thead>
              <tr>
                <th style="width:5%;border-bottom:0px;vertical-align:middle;">S/N</th>
                <th style="width:30%;border-bottom:0px;vertical-align:middle;">DESCRIPTION</th>
                <th style="width:20%;border-bottom:0px;">Weight</th>
                <th style="width:20%;border-bottom:0px;">ARM</th>
                <th style="width:25%;border-bottom:0px;">MOMENT/100</th>
              </tr>
              <tr>
                <th style="border-top: 0px;"></th>
                  <th style="border-top: 0px;"></th>
                  <th style="border-top: 0px;">(ibs)</th>
                  <th style="border-top: 0px;">(inch)</th>
                  <th style="border-top: 0px;">(in-ibs)</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td style="padding: 0px;">1</td>
                <td style="text-align: left;padding: 0px;padding-left:9px;">Basic Empty Weight</td>
                <td style="padding: 0px;">8516.36</td>
                <td style="padding: 0px;">187.39</td>
                <td style="padding: 0px;">15958.80</td>
              </tr>
              <tr>
                <td style="padding: 0px;">2</td>
                <td style="text-align: left;padding: 0px;padding-left:9px;">Pilot & Co-Pilot</td>
                <td style="padding: 0px;">374</td>
                <td style="padding: 0px;">129</td>
                <td style="padding: 0px;">482.46</td>
              </tr>
              <tr>
                <td>3</td>
                <td style="text-align: left;">Passenger (Couch 1<sup>st</sup> row LH)</td>
                <td></td>
                <td>163</td>
                <td></td>
              </tr>
              <tr>
                <td>4</td>
                <td style="text-align: left;">Passenger (Couch 1<sup>st</sup> row LH)</td>
                <td></td>
                <td>163</td>
                <td></td>
              </tr>
              <tr>
                <td>5</td>
                <td style="text-align: left;">Passenger (1<sup>st</sup> row RH)</td>
                <td></td>
                <td>175</td>
                <td></td>
              </tr>
              <tr>
                <td>6</td>
                <td style="text-align: left;">Passenger (2<sup>nd</sup> row LH)</td>
                <td></td>
                <td>212</td>
                <td></td>
              </tr>
              <tr>
                <td>7</td>
                <td style="text-align: left;">Passenger (2<sup>nd</sup> row RH)</td>
                <td></td>
                <td>212</td>
                <td></td>
              </tr>
              <tr>
                <td>8</td>
                <td style="text-align: left;">Passenger (3<sup>rd</sup> row RH)</td>
                <td></td>
                <td>259</td>
                <td></td>
              </tr>
              <tr>
                <td>9</td>
                <td style="text-align: left;">Passenger (3<sup>rd</sup> row LH)</td>
                <td></td>
                <td>259</td>
                <td></td>
              </tr>
              <tr>
                <td>10</td>
                <td style="text-align: left;">LI Seat Passenger (4<sup>th</sup> row RH)</td>
                <td></td>
                <td>293</td>
                <td></td>
              </tr>
              <tr>
                <td>11</td>
                <td style="text-align: left;padding-bottom: 0px;padding-top: 0px;">Bagggage (Maxmum Baggage<p>Weight Limit 550 L.b.s)</p></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
                <td style="padding-bottom: 0px;padding-top: 0px;">293</td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
              </tr>
              <tr>
                <td>12</td>
                <td style="text-align: left;padding-bottom: 0px;padding-top: 0px;">Zero Fuel weight (Max 11000 L.b.s)<p>Sub total</p><p>(1+2+3+4+5+6+7+8+9+10+11)</p></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
              </tr>
              <tr>
                <td>13</td>
                <td style="text-align: left;padding-bottom: 0px;padding-top: 0px;">Fuel loading (Max 3590 Lbs)for<p>Moment refer Table in Flight</p><p>manual Pg. No. 6.35</p></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
              </tr>
              <tr>
                <td>14</td>
                <td style="text-align: left;padding-bottom: 0px;padding-top: 0px;">Ramp Weight (Max 12590 Lbs)<p>Sub total (14+15)</p></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
                <td style="padding-bottom: 0px;padding-top: 0px;"></td>
            </tr>
            <tr>
              <td>15</td>
                <td style="text-align: left;">Less Fuel for Start & Taxi</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
              <td>16</td>
              <td style="text-align: left;padding-bottom: 0px;padding-top: 0px;">Take off Weight<p>(MTOW 12500 Lbs)</p><p>Sub Total (14+15)</p></td>
              <td style="padding-bottom: 0px;padding-top: 0px;"></td>
              <td style="padding-bottom: 0px;padding-top: 0px;"></td>
              <td style="padding-bottom: 0px;padding-top: 0px;"></td>
            </tr>
            <tr>
              <td>17</td>
              <td style="text-align: left;">Less Fuel to DESTINATION</td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>18</td>
              <td style="text-align: left;padding-bottom: 0px;padding-top: 0px;">Landing Weight<p>Sub Total (16+17)</p></td>
              <td style="padding-bottom: 0px;padding-top: 0px;"></td>
              <td style="padding-bottom: 0px;padding-top: 0px;"></td>
              <td style="padding-bottom: 0px;padding-top: 0px;"></td>
            </tr>
            <tr>
              <td>19</td>
              <td style="text-align: left;padding-bottom: 0px;padding-top: 0px;">CG Range as per Graph 
                      Overleaf at<p>Take off Condition (AFM,SECV)</p><p>(Pg 6-4.0)</p></td>
              <td style="padding-bottom: 0px;padding-top: 0px;"><p style="text-decoration: underline;padding-top: 2px;">(Forward)</p><p>185.0 Inches</p></td>
              <td style="padding-bottom: 0px;padding-top: 0px;text-decoration:underline;padding-top: 2px;">(Obtained)</td>
              <td style="padding-bottom: 0px;padding-top: 0px;"><p style="padding-top: 2px;text-decoration: underline;">(Aft)</p><p>1964 
                  Inches</p></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-md-12" style="font-weight: bold;">
        <p style="padding-left:300px;font-size: 12px;line-height: 1px;"><i>Total Moment</i></p>
        <p style="font-size: 12px;"><i style="padding-left: 130px;">C.G. of Flight = &nbsp;<span style="padding-left:80px;"> ____________&nbsp; &nbsp; x 100 </span>  &nbsp;&nbsp;&nbsp;</i></p>
        <p style="padding-left:300px;font-size: 12px;"><i>Total Weight</i></p>
      </div>
      <div class="col-md-12" style="font-weight: bold;font-size: 11px;">
        <p style="padding-left: 11px;">DATUM : The reference datum is located 83.5 in. forward of the center of the front jack point</p>
      </div>
      <div class="col-md-12" style="padding-left: 0px;font-size: 11px;border:1px solid #333;margin-left: 46px;width: 82%;font-weight: bold;">
        <p style="padding-left: 13px;">Limitation . NOTE . Select the lowest weight of the Following:</p>
        <p style="padding-left: 13px;">Limited Max . Allowable TOW for the runway to be used with reference to altitude and temperature <span style="padding-left: 85px;"> ____________Lbs.</span></p>
        <p style="padding-left: 13px;">Limited TOW considering enroute performance <span style="padding-left: 352px;"> ____________Lbs.</span></p>
        <p style="padding-left: 13px;">Max TOW considering limitations of landing weight at destination airport <span style="padding-left: 219px;"> ____________Lbs.</span></p>
        <p style="padding-left: 13px;padding-bottom: 15;">Maximum Take Off weight <span style="padding-left: 462px;">____________Lbs.</span></p>
      </div>
      <div class="col-md-12" style="font-size: 11px;padding-left:28PX;font-weight: bold;">
        <p>It is certified that the CG falls within the allowable range</p>
        <P style="text-align: right;padding-right: 150px;">Sign of PIC:</P>
        <p style="text-align: right;padding-right: 150px;">License NO:</p>
      </div>
      <div class="col-md-12" style="font-size:10px;font-weight: bold;margin-bottom: 15px;">
        <p style="padding-left: 10px;padding-bottom: 10px;">IMPORTANT</p>
        <p><span style="padding-left: 25px;">1 </span<span style="padding-left: 20px;">Maximum Ramp Weight - 12590 Lbs. (5710.78 Kgs.)</span></p>
        <p> <span style="padding-left: 25px;">2 </span<span style="padding-left: 20px;">Maximum Landing Weight - 12500 Lbs. (5669.96 Kgs.)</span></p>
        <p> <span style="padding-left: 25px;">3</span> <span style="padding-left: 20px;">01 Kg = 2.2046 Lbs.</span></p>
        <p> <span style="padding-left: 25px;">4</span>
          <span style="padding-left: 20px;">Empty Weight C.G - 187.39 inches aft of the Datum</span></p>
        <p> <span style="padding-left: 25px;">5 </span>
          <span style="padding-left: 20px;">Maximum Capacity of rear baggage compartment is 550 Lbs. with any combination passengers and / or </span></p>
        <p style="padding-left: 53px;">baggage and/ or equipment</p>
      </div>
                      <!--   <div class="col-md-12" style="margin-bottom: 50px;">
                          <img style="padding-left: 500px;" src="{{url('media/images/lnt/vtehb/vtehb_.PNG')}}" >
                        </div> -->
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