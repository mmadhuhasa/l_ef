@extends('layouts.weather_layout',array('1'=>'1'))
@section('content')

<div id="page">
    @include('includes.header',[])


    <section>
	<div class="container cust-container">
	    <div class="row">
		<div class="content box-content">
		    <div class="col-md-12">
			<div class="row">
			    <div class="col-md-3 pull-right search">
				<form action="{{url('/getGoogleWeather/')}}" name="search" method="POST" id="search" role="form">
				    <div class="form-group">
					<div class="input-group">
					    <input type="text" id="txtAirportCode" name="txtAirportCode" class="form-control" placeholder="AIRPORT CODE">
					    <input name="_token" type="hidden" value="{{ csrf_token() }}">
					    <script type="text/javascript">
                                                $(document).ready(function () {
                                                    var airportCode = $('#txtAirportCode').val();
                                                    $("#txtAirportCode").tokenInput("{{ url('/autoCompleteAirports/') }}",
                                                    {
                                                    method:"POST",
                                                            queryParam:'location',
<?php
if (isset($searchString)) {
    ?>
                                                        prePopulate:[{id: "<?php echo $searchString; ?>", name: "<?php echo $searchString; ?>"}],
<?php } ?>
                                                    tokenLimit: 1,
                                                            resultsLimit: 10
                                                });
                                                });
                                                        function validateAirport()
                                                        {
                                                            var airportCode = $('#txtAirportCode').val();
                                                            $('#search').submit();
                                                        }
					    </script>
					    <span class="input-group-addon search-addon" onclick="validateAirport()">
						<span class="glyphicon glyphicon-search search-icon"></span>
						<!--<input type="submit" value="Submit" />-->
					    </span>
					</div>
				    </div>
				</form>
			    </div>
			</div>
			<div class="row weather">
			    <div class="col-lg-12">
				<div class="row">
				    <div class="col-md-5 box-a">
					<div class="row">
					    <div class="col-md-12 box-ab empty-box-ab">
						<?php
						//echo '<pre>'; print_r($geo_lookup);
						if (is_array($geo_lookup)) {
						    $statusCode = $geo_lookup['Status_Code'];
						    $statusDesc = $geo_lookup['Status_Desc'];
						    $weatherDetails = $geo_lookup['weatherDetails'];
						    if ($statusDesc == 'Success') {
							$city = $weatherDetails['city'];
							$country = $weatherDetails['country'];
							$station_code = $weatherDetails['station_code'];
							$weather = $weatherDetails['weather'];
							$weatherID = $weatherDetails['weatherID'];
							$weatherDescription = $weatherDetails['weatherDescription'];
							$weatherIon = $weatherDetails['weatherIon'];
							$temperature = $weatherDetails['temperature'];
							$temperature_min = $weatherDetails['temperature_min'];
							$temperature_max = $weatherDetails['temperature_max'];
							$relative_humidity = $weatherDetails['relative_humidity'];
							$windSpeed = $weatherDetails['wind_speed'];
							$wind_degrees = $weatherDetails['wind_degrees'];
							$pressure = $weatherDetails['pressure'];
							$sea_level = $weatherDetails['sea_level'];
							$grnd_level = $weatherDetails['grnd_level'];
							$visibility = $weatherDetails['visibility'];
							$clouds = $weatherDetails['clouds'];
							$rain = $weatherDetails['rain'];
							$snow = $weatherDetails['snow'];
							$weatherIconUrl = $weatherDetails['weatherIconUrl'];
							?>
							<div class="per35" style="width:100%;">
							    <div class="weatherBoxBorderCurrent"> 
								<div class="nowText" style="font-size: 14px;padding-left: 5px;padding-top: 5px;"><h2>CURRENT WEATHER</h2></div> 
								<div class="currentWeather">
								    <div ><!--class="per50"-->
									<div id="currentTemperature" style="height:auto;">
									    <h3><span class="_temp"><span class="c"><?php echo $temperature; ?></span><span class="f"><?php echo $temperature_max; ?></span>°<span class="_degreec">c</span><span class="_degreef">f</span></span></h3>
									</div>

									<div class="row">
									    <div class="col-xs-12 col-md-6">Pressure</div>
									    <div class="col-xs-12 col-md-6">
										<?php if ($pressure != '')
										    echo $pressure;
										else
										    echo 'N/A';
										?>
									    </div>
									</div>
									<div class="row">
									    <div class="col-xs-12 col-md-6">Humidity</div>
									    <div class="col-xs-12 col-md-6">
	<?php if ($relative_humidity != '')
	    echo $relative_humidity . '%';
	else
	    echo 'N/A';
	?>
									    </div>
									</div>
									<div class="row">
									    <div class="col-xs-12 col-md-6">WindSpeed</div>
									    <div class="col-xs-12 col-md-6">
	<?php if ($windSpeed != '')
	    echo $windSpeed . ' m/s';
	else
	    echo 'N/A';
	?>
									    </div>
									</div>

								    </div>

								    <div class="clrBoth"></div>
								</div>
								<div class="WeatherCondition pleasant"><h5><?php echo $weather; ?></h5></div>
							    </div>
							</div>
	<?php
    }
}
else {
    echo "The location is not avaialable.It doesn't have geo information.";
}
?>
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12 empty-box-abc">

					    </div>
					</div>
				    </div>
				    <div class="col-md-7 box-b">
					<div class="row forecast">
					    <div class="col-md-12">
<?php if (is_array($metar_abbreviation)) { ?>
    						<div class="row btmargin">
    						    <div class="col-md-6 location">
    							<span class="city">vabb (Mumbai)</span> metar time:
    						    </div>
    						    <div class="col-md-6">
    <?php if (isset($metar_abbreviation['time']))
	echo $metar_abbreviation['time'];
    else
	echo '--NA--';
    ?>
    						    </div>
    						</div>
    						<div class="row btmargin">
    						    <div class="col-md-6 lessleftpad">
    							<span class="sumhead">Visibility:</span><span class="value"><?php if (isset($metar_abbreviation['visibility']))
	echo $metar_abbreviation['visibility'];
    else
	echo '--NA--';
    ?></span>
    						    </div>
    						    <div class="col-md-6 lessleftpad">
    							<span class="sumhead">Winds:</span><span class="value"><?php if (isset($metar_abbreviation['wind']))
	echo $metar_abbreviation['wind'];
    else
	echo '--NA--';
    ?></span>
    						    </div>
    						</div>
    						<div class="row btmargin">
    						    <div class="col-md-12 lessleftpad">
    							<span class="sumhead">Clouds:</span><span class="value"><?php if (isset($metar_abbreviation['cloudReport']))
	echo $metar_abbreviation['cloudReport'];
    else
	echo '--NA--';
    ?></span>
    						    </div>                                                       
    						</div>
    						<div class="row btmargin">
    						    <div class="col-md-4 lessleftpad">
    							<span class="sumhead">Temperature:</span><span class="value"><?php if (isset($metar_abbreviation['temperature']))
								echo $metar_abbreviation['temperature'];
							    else
								echo '--NA--';
							    ?></span>
    						    </div>
    						    <div class="col-md-4 lessleftpad">
    							<span class="sumhead">Dew Point:</span><span class="value"> <?php if (isset($metar_abbreviation['dewPoint']))
								echo $metar_abbreviation['dewPoint'];
							    else
								echo '--NA--';
							    ?></span>
    						    </div>
    						    <div class="col-md-4 lessleftpad">
    							<span class="sumhead">Pressure:</span><span class="value"><?php if (isset($metar_abbreviation['wind']))
								echo $metar_abbreviation['wind'];
							    else
								echo '--NA--';
    ?></span>
    						    </div>
    						</div>
    						<div class="row btmargin">
    						    <div class="col-md-12 lessleftpad">
    							<span class="sumhead">Trend:</span><span class="value"><?php if (isset($metar_abbreviation['trend']))
						    echo $metar_abbreviation['trend'];
						else
						    echo '--NA--';
    ?></span>
    						    </div>                                                       
    						</div>
						    <?php
						} else {
						    echo "The location doesn't have metar information";
						}
						?> 
					    </div>
					</div>
					<div class="row">
					    <div class="col-md-12 empty-box-b">

					    </div>
					</div>
				    </div>
				</div>
				<div class="row temp-content">
				    <!--<div class="col-md-8 empbt-box-a" style="height:auto;">-->
				    <div class="container" style="width:100%;">
					<div id="products" class="row list-group">
					    <div class="Forecast7Day" style="margin-bottom:3px;">
						<?php
						//echo '<pre>'; print_r($forecast);
						if (is_array($forecast)) {
						    $foreCastCount = 0;
						    $forecastDetails = $forecast['forecastDetails'];
						    foreach ($forecastDetails as $forecastKey => $forecastValue) {
							if ($foreCastCount == 7) {
							    break;
							}
							$date = '';
							$date = (int) $forecastValue['date'];
							$tempDay = $forecastValue['tempDay'];
							$tempMin = $forecastValue['tempMin'];
							$tempMax = $forecastValue['tempMax'];
							$tempNight = $forecastValue['tempNight'];
							$tempEve = $forecastValue['tempEve'];
							$tempMrng = $forecastValue['tempMrng'];
							$pressure = $forecastValue['pressure'];
							$humidity = $forecastValue['humidity'];
							$windSpeed = $forecastValue['windSpeed'];
							$windDegrees = $forecastValue['windDegrees'];
							$clouds = $forecastValue['clouds'];
							$rain = $forecastValue['rain'];
							$weatherID = $forecastValue['weatherID'];
							$weather = $forecastValue['weather'];
							$weatherDescription = $forecastValue['weatherDescription'];
							$weatherIon = $forecastValue['weatherIon'];
							$weatherIconUrl = $forecastValue['weatherIconUrl'];


							if ($date == strtotime(date('d-m-Y'))) {
							    $weekDay = 'Today';
							} else {
							    $weekDay = date('l', $date);
							}
							?>

							<div class="item  col-xs-4 col-lg-4">
							    <div class="thumbnail">
								<div class="forecastHeading"><h3><?php echo $weekDay; ?></h3></div>
								<div class="ForcastDate">
								    <div class="fcDate"><?php echo date('F d', $date); ?></div>
								</div>

								<div class="caption">
								    <table border="0" style="width:100%;">
									<tr>
									    <td>
										<img class="group list-group-image" src="<?php echo $weatherIconUrl; ?>" alt="" />
										<br />
	<?php echo date('d/m', $date); ?>
									    </td>
									    <td style="border-left:1px solid #ccc; padding-left:5px;">
										<div style="font-size:15px; font-weight:bold;"><?php echo $tempDay . '&deg;C'; ?></div>
										<div><?php echo $tempMin . '&deg;C /' . $tempMax . '&deg;C'; ?></div>
										<div><?php echo $weatherDescription; ?></div>
									    </td>
									</tr>
									<tr>
									    <td colspan="2">


										<div class="row">
										    <div class="col-xs-12 col-md-6">Pressure</div>
										    <div class="col-xs-12 col-md-6">
	<?php if ($pressure != '')
	    echo $pressure;
	else
	    echo 'N/A';
	?>
										    </div>
										</div>
										<div class="row">
										    <div class="col-xs-12 col-md-6">Humidity</div>
										    <div class="col-xs-12 col-md-6">
	<?php if ($humidity != '')
	    echo $humidity . '%';
	else
	    echo 'N/A';
	?>
										    </div>
										</div>
										<div class="row">
										    <div class="col-xs-12 col-md-6">WindSpeed</div>
										    <div class="col-xs-12 col-md-6">
							<?php if ($windSpeed != '')
							    echo $windSpeed . ' m/s';
							else
							    echo 'N/A';
							?>
										    </div>
										</div>
										<div class="row">
										    <div class="col-xs-12 col-md-6">WindDegrees</div>
										    <div class="col-xs-12 col-md-6">
	<?php if ($windDegrees != '')
	    echo $windDegrees . ' degrees';
	else
	    echo 'N/A';
	?>
										    </div>
										</div>
										<div class="row">
										    <div class="col-xs-12 col-md-6">Clouds</div>
										    <div class="col-xs-12 col-md-6">
	<?php if ($clouds != '')
	    echo $clouds . ' %';
	else
	    echo 'N/A';
	?>
										    </div>
										</div>
										<div class="row">
										    <div class="col-xs-12 col-md-6">Rain</div>
										    <div class="col-xs-12 col-md-6">
	<?php if ($rain != '')
	    echo $rain . ' mm';
	else
	    echo 'N/A';
	?>
										    </div>
										</div>

									    </td>
									</tr>
								    </table>                                            
								</div>
							    </div>
							</div>

	<?php
	$foreCastCount++;
    }
}
else {
    echo "The location doesn't have forecast details.";
}
?>
					    </div>
					</div>
				    </div>
				</div>

			    </div>		
			</div>
		    </div>

		</div>
            </div>
        </div>
</div>
</section>


@include('includes.footer',[])

<!-- Beginning of Login Modal Box -->
@include('includes.login',[])
<!-- End of Login Modal Box --> 



</div>
@stop