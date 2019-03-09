@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/weather/style.css')}}">
@endpush
@section('content')
<?php
$sig_weather = ['CLOUDY' => 'Cloudy', 'P/CLOUDY' => 'Partially Cloudy', 'DRDU' => 'Drifting dust', 'BLDU' => 'Blowing dust', 'FG' => 'Smog', 'FU' => 'Smoke', 'GR' => 'Hail', 'GS' => 'Small Hail/Snow Pellets', 'HZ' => 'Haze', 'IC' => 'Ice Crystals', 'PE' => 'Ice Pellets', 'PO' => 'Dust/Sand Whirls', 'PY' => 'Spray', 'RA' => 'Rain', 'SA' => 'Sand', 'SG' => 'Snow Grains', 'SN' => 'Snow', 'SQ' => 'Squall', 'SS' => 'Sandstorm', 'UP' => 'Unknown Precipitation (Automated Observations)', 'VA' => 'Volcanic Ash', 'BR' => 'Mist', 'DS' => 'Dust Storm', 'DU' => 'Widespread Dust', 'DZ' => 'Drizzle', 'FC' => 'Funnel Cloud', '+FC' => 'Tornado/Water Spout', 'BC' => 'Patches', 'BL' => 'Blowing', 'DR' => 'Low Drifting', 'FZ' => 'Supercooled/Freezing', 'MI' => 'Shallow', 'PR' => 'Partial', 'SH' => 'Showers','SHRA'=>'Showers of Rain', 'TSRA' => 'Thunderstorm', 'TS' => 'Thunderstorm', 'TSGR' => 'Thunderstorms hail'];
$intensity = ['-' => 'Light', '+' => 'Heavy'];
$clouds = ['SCT' => 'Scattered Clouds at', 'NSC' => 'No Significant Clouds', 'FEW' => 'Few clouds at', 'BKN' => 'Broken Clouds at', 'SKC' => 'Sky Clear', 'OVC' => 'Overcast at'];
$cloud_types = ['CB' => 'cumulonimbus reported', 'TCU' => 'towering cumulus reported'];
$trend_significance = ['BECMG' => 'Becoming', 'N0SIG' => 'NoSig', 'NOSIG' => 'NoSig', 'TEMPO' => 'Temporary', 'NOSIG(.)' => 'NoSig'];
?>
<style>
    hr:nth-last-child(2) {display: none;}
</style>
<div id="page">
    @include('includes.new_header',[])
    <div class="container cust-container">
        <div class="row">
            <div class="col-md-12 p-lr-0">
                <p class="wx_head">WEATHER METARS</p>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{url('/weather')}}" method="post" id="search_form">
                    {{ csrf_field() }}
                    <div class="col-md-2 p-lr-0 m-b-15">
                        <div class="input-group">
                            <input type="text" id="info" class="form-control airport_code ui-autocomplete-input text-left" placeholder="Airport Code" name="ap_code">
                            <div class="input-group-addon search-addon">
                                <button type="submit" class="btn newbtnv1 search_btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <?php $count = 0;?>
                @foreach ($data as $wx_key=>$wx)
                <?php $count++; ?>
                @if($wx->less_than_twohours == 'true')
                <div class="row">
                    <div class="col-md-6 wx_decoded height<?php echo $count; ?>">
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Airport</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">@if(isset($wx->airport_name)) {{$wx->airport_name->aero_name}} (India), @endif {{$wx->airport_code}}</p></div>
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Time</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">{{$wx->wx_time_ist}} IST ({{$wx->wx_time_gmt}} UTC @if(isset($weather->previous_gmt_date)) {{$weather->previous_gmt_date}}@endif)@if(isset($wx->previous_date)) of {{$wx->previous_date}} @endif</p></div>
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Winds</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0">
                            <p class="dib">
                                @if($wx->wind_direction == 'VRB')  Variable in direction  at {{ltrim($wx->wind_speed,'0')}} knots 
                                @elseif( $wx->wind_direction != '000' && $wx->wind_speed != '00' ) {{ltrim($wx->wind_direction,'0')}}&deg; at {{ltrim($wx->wind_speed,'0')}} knots 
                                @else Calm
                                @endif 
                                @if(isset($wx->wind_gust)) with gusts up to {{ltrim($wx->wind_gust,'0')}} knots @endif<span><img src="{{url('media/images/weather/arrowup.png')}}" style="height:15px;margin-left:30px;float:right; transform:rotate({{ltrim($wx->wind_direction,'0')}}deg);"></span></p></div>
                        @if (isset($wx->var_wind1))
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Variable Winds</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">Variable wind direction between {{$wx->var_wind1}}&deg; and {{$wx->var_wind2}}&deg;</p></div>
                        @endif
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Visibility</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">{{$wx->visibility}} Meters</p></div>
                        @if(isset($wx->runway_no1) && isset($wx->rv1))
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Runway</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">Visual range along runway {{$wx->runway_no1}} is {{$wx->rv1}} meter's</p></div>
                        @if(isset($wx->runway_no2) && isset($wx->rv2))
                        <div class="col-md-3 p-lr-0"></div><div class="col-md-1 colon"></div><div class="col-md-8 p-lr-0"><p class="dib">Visual range along runway {{$wx->runway_no2}} is {{$wx->rv2}} meter's</p></div>
                        @endif
                        @endif

                        @if(isset($sig_weather[$wx->wx_main]) && array_key_exists($wx->wx_main, $sig_weather))
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Weather</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">@if(isset($wx->wx_intensity) && array_key_exists($wx->wx_intensity, $intensity)) {{$intensity[$wx->wx_intensity]}} @endif {{$sig_weather[$wx->wx_main]}}</p></div>
                        @endif

                        @if(isset($wx->clouds))

                        @foreach($wx->clouds_data as $c_data)
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Clouds</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">@if(array_key_exists($c_data[0], $clouds)) {{$clouds[$c_data[0]]}} @endif @if(isset($c_data[1])) {{$c_data[1]}} Feet  @endif @if(isset($c_data[2]) && array_key_exists($c_data[2], $cloud_types)) , {{$cloud_types[$c_data[2]]}} @endif </p></div>
                        @endforeach

                        @endif

                        @if(isset($wx->temperature))
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Temperature</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">@if(isset($wx->temp_minus)){{$wx->temp_minus}}@endif{{ltrim($wx->temperature,'0')}}&deg; C</p></div>
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Dew Point</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">@if(isset($wx->dew_minus)){{$wx->dew_minus}}@endif{{ltrim($wx->dew_point,'0')}}&deg; C</p></div>
                        @endif
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Pressure</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">QNH {{$wx->pressure}} hPa</p></div>
                        @if(isset($wx->trend_sky))
                        <p class="text-bold trend_head_text">Trend for next 2 hours</p>
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Trend</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">@if(array_key_exists($wx->trend_sky, $trend_significance)) {{$trend_significance[$wx->trend_sky]}} @else {{'Error'}} @endif</p></div>
                        @if(isset($wx->trend_wind_direction))
                        <div class="col-md-3 p-lr-0">
                            <p class="text-bold">Wind</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">
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
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Visibility</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">Visibility is {{$wx->trend_visibility}} meter's</p></div>
                        @endif
                        @if(isset($wx->trend_wx) && array_key_exists($wx->trend_wx, $sig_weather)) 
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Weather</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">@if(isset($wx->trend_wx_intensity)) {{$intensity[$wx->trend_wx_intensity]}} @endif {{$sig_weather[$wx->trend_wx]}}</p></div>
                        @endif

                        @if(!empty($wx->remarks))
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Remarks</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">{{$wx->remarks}}</p></div>
                        @endif
                        @if(!empty($wx->caution))
                        <div class="col-md-3 p-lr-0"><p class="text-bold">Caution</p></div><div class="col-md-1 colon">:</div><div class="col-md-8 p-lr-0"><p class="dib">{{$wx->caution}}</p></div>
                        @endif
                        @endif
                    </div>
                   
                    <div class="col-md-6 taf_decoded taf_height<?php echo $count; ?>"> <p><b>TAF</b></p><p>@if(isset($wx->raw_taf)){{$wx->raw_taf}} @else No data for {{$wx->airport_code}} @endif</p></div>
                </div>
                <hr class="hr" style="height:0px; border:1px dashed #999;">
                
                @endif 
                
                @endforeach
                
                <script>
                    $(function () {
                        for (var i = 0; i <= "<?php echo $count; ?>"; i++) {
                            $('.taf_height' + i).css('height', $('.height' + i).height() + 30);
                        }

                        $('#search_form').submit(function () {
                            if ($('#info').val().length == 0) {
                                return false;
                            } else {
                                return true;
                            }
                        });
                        $('#info').keypress(function () {
                            if ($('#info').val().length > 2) {
                                return false;
                            }
                        });

                        $.ajax({
                            url: "weather/autosuggest",
                            dataType: "json",
                            success: function (result)
                            {
                                $("#info").autocomplete({
                                    source: result,
                                    selectFirst: true,
                                    minLength: 3,
                                    select: function (event, ui)
                                    {
                                        $('#info').css({'border':'1px solid #999', 'box-shadow': 'inset 0 1px 1px rgba(0,0,0,.075)'});
                                    }
                                });
                            }
                        });



                    });

                </script>
            </div>
        </div>
    </div>
    @include('includes.new_footer',[])
</div>
@stop