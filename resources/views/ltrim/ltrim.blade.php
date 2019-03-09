<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>

            tbody:before, tbody:after { display: none; }
            .ltrim_container{
                padding-right: 0px;
                padding-left: 0px;
                margin-right: auto;
                margin-left: auto;
                max-width:900px;
                overflow:hidden;
                min-height:0px;
            }
            .myimage
            {
                width:200px;
                margin-top: 15px;
                margin-bottom: 0px;
                padding-bottom: 0px;
                position: relative;

            }

            .company_name
            {    
                text-align: center;
                font-size: 16px;
                font-weight: bold;
                font-family: arial,sans-serif;
                margin-left: 2px;
            }
            .top_right_sign{
                position: absolute;
                top: 106px;
                right: 15px;
            }
            .first_row
            {
                margin-top: 10px;
                margin-bottom: 10px;
            }
            .company_name p {margin-bottom: 2px;margin-top:5px;}
            .company_name p:last-child {margin-bottom: 20px;}
            .left_col_width{
                display: inline-block;
                width: 180px;
                font-size: 15px;
                font-family: arial,sans-serif;
                padding: 1px 0px 1px 1px;
                border: 1px solid black;
                font-weight: bold;
                margin-right: 10px;
            }
            .right_col_width{
                display: inline-block;
                width: 180px;
                font-size: 15px;
                font-family: arial,sans-serif;
                padding: 1px 0px 1px 1px;
                border: 1px solid black;
                font-weight: bold;
            }
            .col_1{
                display: inline-block;
                width: 260px;
                text-align: center;
                margin-right: 4px;
                font-size: 15px;
                font-family: arial,sans-serif;
                margin-top: 1px;
                padding-left: 1px;
                border: 1px solid black;
                font-weight: bold;
            } 
            .col_1-margin{
                margin-left: 20px;
            }
            .second_row
            {
                margin-top:5px; 
                margin-bottom: 10px;
            }
            .col_2{
                display: inline-block;
                width: 205px;
                font-size: 13px;
                margin-top: 1px;
                padding-left: 1px;
                border: 1px solid black;
                font-weight: bold;
            }
            .margin_col2{
                margin-left: 20px;
            }
            .third_row
            {
                margin-top:5px;  
            }
            .margin_col3{
                margin-left: 169px;
                width: 300px;
            }
            .parent_heading_data{
                margin-bottom: 10px;
            }
            .third_row {
                margin-bottom: 13px;
            }
            .table th, .table td {
                border: 1px solid black;
            }
            table {
                border-collapse: collapse;
                width: 100%;
            }
            .table_2{
                margin-top: 10px;
                margin-bottom: 20px;
                font-weight: bold;
                width: 42%;
            }
            td:nth-child(1){
                padding-left:5px;
                margin-left: 10px;
            }
            td:nth-child(2){
                padding-left: 5px;
            }
            .first_nine{
                color:#000;
            }
            td:nth-child(3){
                color: #000;
            }
            td:nth-child(5){
                color:#000;
            }
            td:nth-child(4)
            {
                color:#000;
            }
            .th_col1{
                text-align: left;
                padding-left: 4px;
            }
            .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th{
                border: 1px solid #000;
                font-size:12px;
                font-family: arial,sans-serif;
                height:18.5px;
            }
            .table>thead:first-child>tr:first-child>th {
                border: 1px solid #000;
            }
            .table-bordered>tbody>tr>th {
                font-size: 15px;
            }

            .table-bordered>tbody>tr>td
            {
                border: 1px solid black; 
                font-size: 15px;  
                margin-left: 10px;
                letter-spacing: 0.3px;

            }
            table tr th{
                padding-top:0px !important;
                padding-bottom:0px !important;
                border: 1px solid black !important; 

            }
            table tr td{
                padding-top:0px !important;
                padding-bottom:0px !important;
                border: 1px solid black !important; 
            }
            .middle{
                text-align: center;
            }
            .middle_italic{
                font-style: italic;
            }
            .myclass
            {
                background-color: #eee;
            }
            .col1_col2{
                font-weight: bold;
            }
            .note
            {
                font-size: 12px;
                word-spacing: 1px;
                color:#000;
                letter-spacing: 0.5px;
            }
            .note_left{
                width: 10px;
                letter-spacing: 2px;
                font-family: arial,sans-serif;
            }
            .note_right{
                margin-left:30px;
                width: 650px;
                margin-top: 15px;
                font-family: arial,sans-serif;
            }
            .note_left,.note_right{
                display: inline-block;
            }
            .certify
            {
                margin-top: 35px;
                margin-bottom: 45px;
                margin-left: 43px;
                font-size: 12px;
                font-family: arial,sans-serif;
                color:#000;
                letter-spacing: 0.5px;
            }
            .sign
            {
                padding-bottom: 100px;
                margin-left: 43px;
                font-family: arial,sans-serif;
                color:#000;
                letter-spacing: 0.5px;
            }
            .note_sign{
                font-size: 14px;
                font-family: arial,sans-serif;
                color:#000;
                letter-spacing: 0.5px;
                font-weight: bold;

            }
            .zfw_font {font-size: 13px !important;}
            #mysign{
                padding-bottom: 2px;
            }
            .mycolor{
                background-color: #bbb;
                font-weight: bold;
                text-align: right;
                font-size: 14px !important;
            }
            .auto_caps{
                text-transform: uppercase;
            }
            .pic_width {width: 213px;}
            .date_width {
                width: 190px;
                text-transform: uppercase;
            }
        </style>
    </head>

    <body>
        <div class="container ltrim_container">
            <div class="myimage">
                <img src="https://www.eflight.aero/media/turbo.png" height="60px" width="195px">
            </div>
            <div class="company_name">
                <p>TURBO AVIATION PVT LTD</p>
                <P>Load and Trim Sheet</P>
                <p>MODEL EMBRAER 500 - PHENOM 100</p>
            </div>
            <div class="top_right_sign">
                <img src="https://www.eflight.aero/media/si.png" height="70px" width="180px;">              
            </div>
            <div class="row">
                <div class="parent_heading_data">
                    <div class="first_row">
                        <div class="left_col_width" style="background-color: #eee;">
                            Registration: <span style="text-decoration: underline;">VT-AVS</span>
                        </div>
                        <div class="col_1 col_1-margin" style="background-color: #eee;">
                            SERIAL NUMBER - 500000204
                        </div>
                        <div class="col_1-margin right_col_width date_width" style="font-size: 13px;">
                            DATE: {{$date}}
                        </div>
                    </div>
                    <div class="second_row">
                        <div class="left_col_width auto_caps">
                            FROM: {{$from}}
                        </div>

                        <div class="margin_col2 right_col_width auto_caps">
                            TO: {{$to}}
                        </div>
                    </div>
                    <div class="third_row">
                        <div class="left_col_width auto_caps pic_width" >
                            PIC: {{$pilot}}
                        </div>
                        <div class="margin_col3 right_col_width auto_caps">
                            CO PILOT: {{$co_pilot}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 table-responsive">
                    <table class="table table-bordered" >
                       <!--  <thead> -->
                        <tr>
                            <th class="th_col1" >Sl.</th>
                            <th class="th_col1">Details</th>
                            <th class="middle">Weight (lbs)</th>
                            <th class="middle">Arm (ln)</th>
                            <th class="middle">Moment (Wt X Arm)</th>
                        </tr>
                        <!--  </thead>
                         <tbody> -->
                        <tr>
                            <td class="first_nine">i)</td>
                            <td class="first_nine">Empty Weight</td>
                            <td class="middle">{{ $empty_weight['weight'] }}</td>
                            <td class="middle">{{ $empty_weight['arm'] }}</td>
                            <td class="middle">{{ round($empty_weight['weight']*$empty_weight['arm'],2) }}</td>
                        </tr>
                        <tr>
                            <td class="first_nine">1</td>
                            <td class="first_nine">Pilot & Co Pilot</td>
                            <td class="middle">{{ sprintf('%.2f',$pilot_co_pilot['weight']) }}</td>
                            <td class="middle">{{ $pilot_co_pilot['arm'] }}</td>
                            <td class="middle">{{ sprintf('%.2f',  $pilot_co_pilot['weight']*$pilot_co_pilot['arm'])}}</td>
                        </tr>
                        <?php $count = 2;
                        $pax_count = 1; ?>
                        @foreach ($paxs as $pax)
                        <tr>
                            <td class="first_nine">{{ $count++ }}</td>
                            <td class="first_nine">Pax {{ $pax_count++ }}</td>
                            <td class="middle">@if(isset($pax['weight'])) {{sprintf('%.2f',$pax['weight']) }} @else {{'0.00'}} @endif</td>
                            <td class="middle">{{ $pax['arm'] }}</td>
                            <td class="middle">@if(isset($pax['weight'])) {{ sprintf('%.2f', $pax['weight']*$pax['arm']) }} @else {{ '0.00'}} @endif</td>
                        </tr>
                        @endforeach    
                        <tr>
                            <td class="first_nine">6</td>
                            <td class="first_nine">Fwd,Baggage Compt (Max 66 Lbs)</td>
                            <td class="middle">{{ sprintf('%.2f', $fwd_baggege_compt['weight']) }}</td>
                            <td class="middle">{{ $fwd_baggege_compt['arm'] }}</td>
                            <td class="middle">{{ $fwd_baggege_compt['weight']*$fwd_baggege_compt['arm'] }}</td>
                        </tr>
                        <tr>
                            <td class="first_nine">7</td>
                            <td class="first_nine">Wadrobe/ Refreshment Cabinet</td>
                            <td class="middle">{{ sprintf('%.2f', $wardrobe_refreshment_cabinet['weight']) }}</td>
                            <td class="middle">{{ $wardrobe_refreshment_cabinet['arm'] }}</td>
                            <td class="middle">{{ 
                        sprintf('%.2f', $wardrobe_refreshment_cabinet['weight']*$wardrobe_refreshment_cabinet['arm']) }}</td>
                        </tr>
                        <tr>
                            <td class="first_nine">8</td>
                            <td class="first_nine">Lavatory Cabinet (Max 353 Lbs)</td>
                            <td class="middle">{{ sprintf('%.2f', $lavatory_cabinet['weight']) }}</td>
                            <td class="middle">{{ $lavatory_cabinet['arm'] }}</td>
                            <td class="middle">{{ sprintf('%.2f', $lavatory_cabinet['weight']*$lavatory_cabinet['arm']) }}</td>
                        </tr>
                        <tr>
                            <td class="first_nine">9</td>
                            <td class="first_nine">Aft Baggage Compt (Max 353 Lbs)</td>
                            <td class="middle">{{ sprintf('%.2f', $aft_baggage_compt['weight']) }}</td>
                            <td class="middle">{{ $aft_baggage_compt['arm'] }}</td>
                            <td class="middle">{{ sprintf('%.2f', $aft_baggage_compt['weight']*$aft_baggage_compt['arm']) }}</td>
                        </tr>
                        <tr class="myclass">
                            <td class="first_nine">ii)</td>
                            <td class="col1_col2">Total Zero Fuel (i+1 to 9)</td>
                            <td class="middle"><b>{{ sprintf('%.2f',$total_zero_fuel['weight']) }}</b></td>
                            <td class="middle"><b>{{ sprintf('%.2f',$total_zero_fuel['arm']) }}</b></td>
                            <td class="middle"><b>{{ sprintf('%.2f', $total_zero_fuel['momentum']) }}</b></td>
                        </tr>
                        <tr>
                            <td class="first_nine"></td>
                            <td class="middle middle_italic first_nine">Max Zero Fuel Weight (8444Lbs)</td>
                            <td colspan="2" class="middle mycolor" >ZFW CG % M.A.C. =</td>
                            <td class="mycolor" style="text-align:left;"> {{ sprintf('%.2f',$max_zero_fuel_weight) }}</td>
                        </tr>
                        <tr>
                            <td class="first_nine">iii)</td>
                            <td class="first_nine"><b>Take Off Fuel</b> (Max. 2750 Lbs)</td>
                            <td class="middle"><b>{{$take_off_fuel['weight']}}</b></td>
                            <td class="middle">{{ sprintf('%.2f',$take_off_fuel['arm']) }}</td>
                            <td class="middle">{{ sprintf('%.2f', $take_off_fuel['momentum']) }}</td>
                        </tr>
                        <tr class="myclass">
                            <td class="first_nine">iv)</td>
                            <td class="col1_col2">Total Take Off Weight (ii+iii)</td>
                            <td class="middle"><b>{{ sprintf('%.2f',$total_take_off_weight['weight']) }}</b></td>
                            <td class="middle"><b>{{ sprintf('%.2f',$total_take_off_weight['arm']) }}</b></td>
                            <td class="middle"><b>{{ sprintf('%.2f', $total_take_off_weight['momentum']) }}</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="middle middle_italic first_nine">Max Take Off Weight (10472 Lbs)</td>
                            <td colspan="2" class="middle mycolor">TAKE OFF WT CG% M.A.C. =</td>
                            <td class="mycolor" style="text-align:left;"> {{ sprintf('%.2f',$max_take_off_weight) }}</td>
                        </tr>
                        <tr>
                            <td class="first_nine">v)</td>
                            <td class="col1_col2">Landing Fuel</td>
                            <td class="middle"><b>{{ $landing_fuel['weight']}}</b></td>
                            <td class="middle">{{ sprintf('%.2f',$landing_fuel['arm']) }}</td>
                            <td class="middle">{{ sprintf('%.2f',$landing_fuel['momentum']) }}</td>
                        </tr>
                        <tr class="myclass">
                            <td class="first_nine">vi)</td>
                            <td class="col1_col2">Total Landing Weight (ii+v)</td>
                            <td class="middle"><b>{{ sprintf('%.2f',$total_landing_weight['weight']) }}</b></td>
                            <td class="middle"><b>{{ sprintf('%.2f', $total_landing_weight['arm']) }}</b></td>
                            <td class="middle"><b>{{  sprintf('%.2f',$total_landing_weight['momentum']) }}</b></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="middle middle_italic first_nine">Max Landing Weight (9766 Lbs)</td>
                            <td colspan="2" class="middle  mycolor">LANDING WT CG % M.A.C. =</td>
                            <td class="mycolor" style="text-align:left;"> {{ sprintf('%.2f',$max_landing_weight) }}</td>
                        </tr>
                        <!--  </tbody> -->
                    </table>
                </div>
            </div>
            <table class="table table-bordered table_2">
                <tr>
                    <td style="width: 250px;padding-left: 1px;padding-right: 1px;letter-spacing: -0.3px;" class="zfw_font">ZFW CG as % MAC = (Arm - 209.64) x 100 / 64.57</td>
                    <!-- <td> Arm = Total Moment/Total Weight</td> -->
                </tr>
            </table>
            <div class="row_width">
                <div class="note note_left">Note:</div>
                <div class="note note_right" >
                    1.Maximum seating permissible is 04 PAX Lavatory not to be occupied.<br>
                    2.PIC to brief the passenger occupying RH AFT FWD facing seat, which is next to exit about opening procedure of over wing exit. <br>
                    3.Standard weight as per CAR section 2 series X part - II follows- <br> Adult passenger (both male and female):165 lbs, Child (Between 2 years and 12 years age):77 lbs, and infant less than 2 years: 22 lbs.
                </div>
            </div>
            <div class="row">
                <div class="certify">
                    I certify that aircraft is properly loaded and CG is within limits as per AFM
                </div>
            </div>
            <div class="row"> 
                <div class="note_sign">
                    <div id="mysign">Signature of PIC:</div>
                    <span>ATPL:</span>
                </div>
            </div>
        </div>
    </body>
</html>