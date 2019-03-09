@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/weather/style_new.css')}}">
@endpush
@section('content')
<?php
$sig_weather = ['CLOUDY' => 'Cloudy', 'P/CLOUDY' => 'Partially Cloudy', 'DRDU' => 'Drifting dust', 'BLDU' => 'Blowing dust', 'FG' => 'Smog', 'FU' => 'Smoke', 'GR' => 'Hail', 'GS' => 'Small Hail/Snow Pellets', 'HZ' => 'Haze', 'IC' => 'Ice Crystals', 'PE' => 'Ice Pellets', 'PO' => 'Dust/Sand Whirls', 'PY' => 'Spray', 'RA' => 'Rain', 'SA' => 'Sand', 'SG' => 'Snow Grains', 'SN' => 'Snow', 'SQ' => 'Squall', 'SS' => 'Sandstorm', 'UP' => 'Unknown Precipitation (Automated Observations)', 'VA' => 'Volcanic Ash', 'BR' => 'Mist', 'DS' => 'Dust Storm', 'DU' => 'Widespread Dust', 'DZ' => 'Drizzle', 'FC' => 'Funnel Cloud', '+FC' => 'Tornado/Water Spout', 'BC' => 'Patches', 'BL' => 'Blowing', 'DR' => 'Low Drifting', 'FZ' => 'Supercooled/Freezing', 'MI' => 'Shallow', 'PR' => 'Partial', 'SH' => 'Showers','SHRA'=>'Showers of Rain', 'TSRA' => 'Thunderstorm', 'TS' => 'Thunderstorm', 'TSGR' => 'Thunderstorms hail'];
$intensity = ['-' => 'Light', '+' => 'Heavy'];
$clouds = ['SCT' => 'Scattered', 'NSC' => 'No Significant Clouds', 'FEW' => 'Few', 'BKN' => 'Broken', 'SKC' => 'Sky Clear', 'OVC' => 'Overcast'];
$cloud_types = ['CB' => 'CB', 'TCU' => 'TCU'];
$trend_significance = ['BECMG' => 'Becoming', 'N0SIG' => 'NoSig', 'NOSIG' => 'NoSig', 'TEMPO' => 'Temporary', 'NOSIG(.)' => 'NoSig'];
?>
<div id="page">
    @include('includes.new_header',[])
    <div class="container cust-container">
        <div class="row">
            <div class="col-md-12 p-lr-0">
                <p class="wx_head">WEATHER METARS</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach ($data as $wx)
                <?php // dd($sig_weather[$wx->wx_main]); // dd($wx); ?>
                @if($wx->less_than_twohours == 'true')
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12 weather_forecast_sec">
                            <div class="airport_name_head">@if(isset($wx->airport_name)) {{$wx->airport_name->aero_name}}, @endif {{$wx->airport_code}}</div>

                            <div class="col-md-6">
                                <div class="col-md-6 p-l-0"><img src="{{url('media/images/weather/sun.png')}}"></div>
                                <div class="col-md-6 p-lr-0"><p class="temp_text">@if(isset($wx->temp_minus)){{$wx->temp_minus}}@endif @if($wx->temperature >= 32)<span style="color:red">{{ltrim($wx->temperature,'0')}}&deg; c</span> @else {{ltrim($wx->temperature,'0')}}&deg; c @endif </p>@if(isset($sig_weather[$wx->wx_main]) && array_key_exists($wx->wx_main, $sig_weather))<p class="wx_text">@if(isset($wx->wx_intensity) && array_key_exists($wx->wx_intensity, $intensity)) {{$intensity[$wx->wx_intensity]}} @endif {{$sig_weather[$wx->wx_main]}}</p>@endif</div>
                                {{-- <div class="col-md-6 p-l-0 wind_sec"><p style="color:grey;font-size: 10px;">N</p><img src="{{url('media/images/weather/wind1.png')}}" class="wind_image" style="transform:rotate({{ltrim($wx->wind_direction,'0')}}deg);"><p class="wind_speed">@if($wx->wind_speed != '00' ){{ltrim($wx->wind_speed,'0')}}@else {{'0'}}@endif</p></div>  --}}
                            <style>
                                .windCompassSec {
                                    width: 65px;
                                    height: 65px;
                                    margin-left: 4px;
                                }
                                .dial {
                                    border-radius: 50%;
                                    width: 50px;
                                    height: 50px;
                                    border: 3px solid #000;
                                    position: relative;
                                }
                                .arrow-direction {
                                    width: 0;
                                    height: 0;
                                    border-left: 4px solid transparent;
                                    border-right: 4px solid transparent;
                                    border-top: 14px solid #f1292b;
                                    position: absolute;
                                    left: 18.5px;
                                    top: -7px;
                                }
                                .wind_speed_sec {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    display: block;
                                    text-align: center;
                                    font-weight: 500;
                                    line-height: 50px;
                                    font-size: 1.125rem;
                                }
                                .wind_value {width: 88px;font-weight: bold;font-size: 17px;}
                            </style>
                            <div class="col-md-12"><p style="color:grey;font-size: 10px;padding-left: 27px; -webkit-margin-after: 0px;">N</p></div>
                            <div class="col-md-12">
                                <div class="windCompassSec">
                                    <div class="windcompass">
                                        <div class="dial" style="transform:rotate({{ltrim($wx->wind_direction,'0')}}deg);">
                                            <div class="arrow-direction"></div>
                                        </div>
                                    </div>
                                    <div class="wind_speed_sec">
                                        <div class="wind_value">@if($wx->wind_speed != '00' ){{ltrim($wx->wind_speed,'0')}}@else {{'0'}}@endif</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6 weather_forecast_right_sec">
                            <div class="col-md-4 p-lr-0"><p>Visibility</p></div><div class="col-md-8 p-lr-0"><p class="text-bold">{{$wx->visibility}} Meters</p></div>

                            @if(isset($wx->clouds))
                            <div class="col-md-4 p-lr-0"><p>Clouds</p></div>
                            @foreach($wx->clouds_data as $c_datakey=>$c_data)
                            @if($c_datakey>0)
                            <div class="col-md-4"></div>
                            @endif
                            <div class="col-md-8 p-lr-0">
                                <p class="text-bold">@if(array_key_exists($c_data[0], $clouds)) {{$clouds[$c_data[0]]}} @endif @if(isset($c_data[1])) {{$c_data[1]}} Feet  @endif @if(isset($c_data[2]) && array_key_exists($c_data[2], $cloud_types)) , {{$cloud_types[$c_data[2]]}} @endif </p>
                            </div>
                            @endforeach
                            @endif

                            <div class="col-md-4 p-lr-0"><p>Dew Point</p></div><div class="col-md-8 p-lr-0"><p class="text-bold">@if(isset($wx->dew_minus)){{$wx->dew_minus}}@endif{{ltrim($wx->dew_point,'0')}}&deg; c</p></div>
                            <div class="col-md-4 p-lr-0"><p>Pressure</p></div><div class="col-md-8 p-lr-0"><p class="text-bold">QNH {{$wx->pressure}} hPa</p></div>

                            @if(isset($wx->trend_sky))

                            <p class="text-bold trend_head_text">Trend for next 2 hours</p>
                            <div class="col-md-4 p-lr-0"><p>Trend</p></div><div class="col-md-8 p-lr-0"><p class="text-bold">@if(array_key_exists($wx->trend_sky, $trend_significance)) {{$trend_significance[$wx->trend_sky]}} @else {{'Error'}} @endif</p></div>
                            @if(isset($wx->trend_wind_direction))
                            <div class="col-md-4 p-lr-0"><p>Wind</p></div><div class="col-md-8 p-lr-0"><p class="text-bold">
                                    @if($wx->trend_wind_direction == 'VRB')  Variable in direction  at {{$wx->wind_speed}} knots 
                                    @elseif( $wx->trend_wind_direction != '000' && $wx->trend_wind_speed != '00' ) Winds from {{ltrim($wx->trend_wind_direction,'0')}}&deg; at {{$wx->trend_wind_speed}} knots
                                    @else Calm
                                    @endif 
                                    @if(isset($wx->trend_wind_gust)) with gusts up to {{$wx->trend_wind_gust}} knots 
                                    @endif
                                </p>
                            </div>
                            @endif
                            @if(isset($wx->trend_visibility))
                            <div class="col-md-4 p-lr-0"><p>Visibility</p></div><div class="col-md-8 p-lr-0"><p class="text-bold">{{$wx->trend_visibility}} meter's</p></div>
                            @endif
                            @if(isset($wx->trend_wx) && array_key_exists($wx->trend_wx, $sig_weather)) 
                            <div class="col-md-4 p-lr-0"><p>Weather</p></div><div class="col-md-8 p-lr-0"><p class="text-bold">@if(isset($wx->trend_wx_intensity)) {{$intensity[$wx->trend_wx_intensity]}} @endif {{$sig_weather[$wx->trend_wx]}}</p></div>
                            @endif

                            @endif




                        </div>
                        <div class="col-md-12"><p class="last_updated">Updated : {{$wx->wx_time_ist}} IST ({{$wx->wx_time_gmt}} UTC @if(isset($weather->previous_gmt_date)){{$weather->previous_gmt_date}}@endif)@if(isset($wx->previous_date)) of {{$wx->previous_date}}@endif</p></div>
                    </div>
                </div>
            </div>

            @endif
            @endforeach
        </div>
    </div>
</div>
@include('includes.new_footer',[])
</div>
@stop