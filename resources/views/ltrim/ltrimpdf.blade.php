<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
     <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>

     <style>
        .main-container{
            width: 80%;
            margin: 0 auto;
        }
        .table{
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        td,th{
            border: 1px solid #ddd;
            border-top: 1px solid #ddd;
            padding: 5px;
        }
     </style>
</head>
<body>
    
    <h3 style="text-align:center;">Load and Trim Details</h3>

    <div class="main-container">
        <table class="table">
            <tr>
                <td>Registration: VT-ATS</td>
                <td>Serial No : 1234567890</td>
                <td>Date: {{ $date }}</td>
            </tr>

            <tr>
                <td>From : {{ $from}}</td>
                <td>To : {{ $to}}</td>
            </tr>

            <tr>
                <td>Pilot : {{ $pilot}}</td>
                <td>Co-Pilot : {{ $co_pilot}}</td>
            </tr>
        </table>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Details</th>
                    <th>weights</th>
                    <th>Arm</th>
                    <th>Moment (Wt X Arm)</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                <tr>
                    <td>i)</td>
                    <td>Empty weight</td>
                    <td>{{ $empty_weight['weight'] }}</td>
                    <td>{{ $empty_weight['arm'] }}</td>
                    <td>{{ round($empty_weight['weight']*$empty_weight['arm'],2) }}</td>
                </tr>

                <tr>
                    <td>{{ $count++ }}</td>
                    <td>Pilot &amp; Co Pilot</td>
                    <td>{{ $pilot_co_pilot['weight'] }}</td>
                    <td>{{ $pilot_co_pilot['arm'] }}</td>
                    <td>{{ $pilot_co_pilot['weight']*$pilot_co_pilot['arm'],2}}</td>
                </tr>
                @php
                    $pax_count = 1;
                @endphp

                @foreach ($paxs as $pax)
                    @if (isset($pax['weight']))
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>PAX {{ $pax_count++ }}</td>
                        <td>{{ $pax['weight'] }}</td>
                        <td>{{ $pax['arm'] }}</td>
                        <td>{{ $pax['weight']*$pax['arm'] }}</td>
                    </tr>
                    @endif
                @endforeach

                <tr>
                    <td>{{ $count++ }}</td>
                    <td>Fwd, Baggage Compt (Max 66 Lbs)</td>
                    <td>{{ $fwd_baggege_compt['weight'] }}</td>
                    <td>{{ $fwd_baggege_compt['arm'] }}</td>
                    <td>{{ $fwd_baggege_compt['weight']*$fwd_baggege_compt['arm'] }}</td>
                </tr>

                <tr>
                    <td>{{ $count++ }}</td>
                    <td>Wardrobe/ Refreshment Cabinet</td>
                    <td>{{ $wardrobe_refreshment_cabinet['weight'] }}</td>
                    <td>{{ $wardrobe_refreshment_cabinet['arm'] }}</td>
                    <td>{{ $wardrobe_refreshment_cabinet['weight']*$wardrobe_refreshment_cabinet['arm'] }}</td>
                </tr>

                <tr>
                    <td>{{ $count++ }}</td>
                    <td>Lavatory Cabinet (Max 353 Lbs)</td>
                    <td>{{ $lavatory_cabinet['weight'] }}</td>
                    <td>{{ $lavatory_cabinet['arm'] }}</td>
                    <td>{{ $lavatory_cabinet['weight']*$lavatory_cabinet['arm'] }}</td>
                </tr>

                <tr>
                    <td>{{ $count++ }}</td>
                    <td>Aft Baggage Compt (Max 353 Lbs)</td>
                    <td>{{ $aft_baggage_compt['weight'] }}</td>
                    <td>{{ $aft_baggage_compt['arm'] }}</td>
                    <td>{{ $aft_baggage_compt['weight']*$aft_baggage_compt['arm'] }}</td>
                </tr>

                <tr>
                    <td>ii)</td>
                    <td><b>Total Zero Fuel (i+1 to {{$dd=$count-1}})</b></td>
                    <td><b>{{ $total_zero_fuel['weight'] }}</b></td>
                    <td><b>{{ round($total_zero_fuel['arm'],2) }}</b></td>
                    <td><b>{{ round($total_zero_fuel['momentum'],2) }}</b></td>
                </tr>

                <tr>
                    <td></td>
                    <td>Max Zero Fuel Weight (8444 Lbs)</td>
                    <td><b>ZFW CG as % MAC = (Arm - 209.64) x 100 / 64.57=
                    {{ round($max_zero_fuel_weight,2) }}</b></td>
                </tr>

                <tr>
                    <td>iii)</td>
                    <td><b>Take Off fuel</b></td>
                    <td>{{ $take_off_fuel['weight'] }}</td>
                    <td>{{ $take_off_fuel['arm'] }}</td>
                    <td>{{ $take_off_fuel['momentum'] }}</td>
                </tr>

                <tr>
                    <td>iv)</td>
                    <td><b>Total take off weight (ii+iii)</b></td>
                    <td><b>{{ $total_take_off_weight['weight'] }}</b></td>
                    <td><b>{{ round($total_take_off_weight['arm'],2) }}</b></td>
                    <td><b>{{ round($total_take_off_weight['momentum'],2) }}</b></td>
                </tr>                                                       

                <tr>
                    <td></td>
                    <td>Max Take Off Weight (10472 Lbs)</td>

                    <td><b>TAKE OFF WT CG % M.A.C. ={{ round($max_take_off_weight,2) }}</b></td>
                </tr>

                <tr>
                    <td>v)</td>
                    <td><b>Landing Fuel</b></td>
                    <td>{{ $landing_fuel['weight'] }}</td>
                    <td>{{ round($landing_fuel['arm'],4) }}</td>
                    <td>{{ $landing_fuel['momentum'] }}</td>
                </tr>

                <tr>
                    <td>vi)</td>
                    <td><b>Total landing weight (ii+v)</b></td>
                    <td>{{ $total_landing_weight['weight'] }}</td>
                    <td>{{  round($total_landing_weight['arm'],2) }}</td>
                    <td>{{  round($total_landing_weight['momentum'],2) }}</td>
                </tr>

                <tr>
                    <td></td>
                    <td>Max Landing Weight (9766 Lbs)</td>
                    <td><b>LANDING WT CG % M.A.C={{ round($max_landing_weight,2) }}</b></td>
                </tr>                                                                                       
            </tbody>
        </table>
    </div>
</body>
</html>