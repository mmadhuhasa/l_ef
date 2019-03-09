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
                    <div class="col-md-3 pull-right search" style="width:40%;">
                    <form action="{{url('/getAirportWeather/')}}" name="search" method="POST" id="search" role="form">
                        <div class="form-group" >
                        <div class="input-group">
                            <input type="text" id="txtAirportCode" name="txtAirportCode" class="form-control" placeholder="AIRPORT CODE">
<input name="_token" type="hidden" value="{{ csrf_token() }}">
                            <script type="text/javascript">
$(document).ready(function() {
	var airportCode = $('#txtAirportCode').val();
	$("#txtAirportCode").tokenInput("{{ url('/autoCompleteAirports/') }}",
		{
			method:"POST",
			queryParam:'location',
			//resultsFormatter: function(item){ return "<li>" + item.name + "</li>" },
			//tokenFormatter: function(item) { return "<li>" + item.name + "</li>" },
			 <?php
			if(isset($searchString))
			{
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
										 if(is_array($geo_lookup))
										 {
											 $statusCode		= $geo_lookup['Status_Code'];
											 $statusDesc		= $geo_lookup['Status_Desc'];
											 $weatherDetails	= $geo_lookup['weatherDetails'];
											 if($statusDesc == 'Success')
											 {
												$city  = $weatherDetails['city'];
												$country  = $weatherDetails['country'];
												$station_code  = $weatherDetails['station_code'];
												$weather  = $weatherDetails['weather'];
												$temperature_f  = $weatherDetails['temperature_f'];
												$temperature_c  = $weatherDetails['temperature_c'];
												$relative_humidity  = $weatherDetails['relative_humidity'];
												$wind_string  = $weatherDetails['wind_string'];
												$wind_dir  = $weatherDetails['wind_dir'];
												$wind_degrees  = $weatherDetails['wind_degrees'];
												$wind_mph  = $weatherDetails['wind_mph'];
												$wind_gust_mph  = $weatherDetails['wind_gust_mph'];
												$pressure_mb  = $weatherDetails['pressure_mb'];
												$pressure_in  = $weatherDetails['pressure_in'];
												$pressure_trend  = $weatherDetails['pressure_trend'];
												$dewpoint_string  = $weatherDetails['dewpoint_string'];
												$dewpoint_f  = $weatherDetails['dewpoint_f'];
												$dewpoint_c  = $weatherDetails['dewpoint_c'];
												$visibility_km  = $weatherDetails['visibility_km'];
												$visibility_mi  = $weatherDetails['visibility_mi'];
												$UV  = $weatherDetails['UV'];
												$precip_1hr_string  = $weatherDetails['precip_1hr_string'];
												$precip_today_string  = $weatherDetails['precip_today_string'];
												$forecast_url  = $weatherDetails['forecast_url'];
												?>
										  <div class="per35" style="width:100%;">
											<div class="weatherBoxBorderCurrent"> 
												<div class="nowText" style="font-size: 14px;padding-left: 5px;padding-top: 5px;"><h2>CURRENT WEATHER</h2></div> 
												<div class="currentWeather">
													<div ><!--class="per50"-->
														<div id="currentTemperature" style="height:auto;">
															<h3><span class="_temp"><span class="c"><?php echo $temperature_c; ?></span><span class="f"><?php echo $temperature_f; ?></span>°<span class="_degreec">c</span><span class="_degreef">f</span></span></h3>
														</div>
														<div class="currentHumidity">
															RH        <div class="humidity"></div>
															<?php echo $relative_humidity; ?>
															<div class="clrBoth"></div>
														</div>
														<div class="currentHumidity">
															Dew Point   : <?php echo $dewpoint_f; ?>f
															&nbsp;&nbsp;&nbsp;
															UV : <?php echo $UV; ?>
															<div class="clrBoth"></div>
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
										 else
										 {
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
                                    <?php if(is_array($metar_abbreviation)) { ?>
                                        <div class="row btmargin">
                                            <div class="col-md-6 location">
                                                <span class="city">vabb (Mumbai)</span> metar time:
                                            </div>
                                            <div class="col-md-6">
                                                <?php if(isset($metar_abbreviation['time'])) echo $metar_abbreviation['time']; else echo '--NA--'; ?>
                                            </div>
                                        </div>
                                        <div class="row btmargin">
                                            <div class="col-md-6 lessleftpad">
                                                <span class="sumhead">Visibility:</span><span class="value"><?php if(isset($metar_abbreviation['visibility'])) echo $metar_abbreviation['visibility']; else echo '--NA--'; ?></span>
                                            </div>
                                            <div class="col-md-6 lessleftpad">
                                                <span class="sumhead">Winds:</span><span class="value"><?php if(isset($metar_abbreviation['wind'])) echo $metar_abbreviation['wind']; else echo '--NA--'; ?></span>
                                            </div>
                                        </div>
                                        <div class="row btmargin">
                                            <div class="col-md-12 lessleftpad">
                            <span class="sumhead">Clouds:</span><span class="value"><?php if(isset($metar_abbreviation['cloudReport'])) echo $metar_abbreviation['cloudReport']; else echo '--NA--'; ?></span>
                                            </div>                                                       
                                        </div>
                                        <div class="row btmargin">
                                            <div class="col-md-4 lessleftpad">
                                                    <span class="sumhead">Temperature:</span><span class="value"><?php if(isset($metar_abbreviation['temperature'])) echo $metar_abbreviation['temperature']; else echo '--NA--'; ?></span>
                                            </div>
                                            <div class="col-md-4 lessleftpad">
                                                <span class="sumhead">Dew Point:</span><span class="value"> <?php if(isset($metar_abbreviation['dewPoint'])) echo $metar_abbreviation['dewPoint']; else echo '--NA--'; ?></span>
                                            </div>
                                            <div class="col-md-4 lessleftpad">
                                                    <span class="sumhead">Pressure:</span><span class="value"><?php if(isset($metar_abbreviation['wind'])) echo $metar_abbreviation['wind']; else echo '--NA--'; ?></span>
                                            </div>
                                        </div>
                                        <div class="row btmargin">
                                            <div class="col-md-12 lessleftpad">
                            <span class="sumhead">Trend:</span><span class="value"><?php if(isset($metar_abbreviation['trend'])) echo $metar_abbreviation['trend']; else echo '--NA--'; ?></span>
                                            </div>                                                       
                                        </div>
                                       <?php } else { 
									   		echo "The location doesn't have metar information";
									   }?> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 empty-box-b">
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row temp-content">
                            <div class="col-md-8 empbt-box-a" style="height:auto;">
                            	<div class="Forecast7Day">
								<?php
								 //echo '<pre>'; print_r($forecast);
								if(is_array($forecast))
								{
								 $foreCastCount = 0;
								 $forecastDetails	= $forecast['forecastDetails'];
								 foreach($forecastDetails as $forecastKey=>$forecastValue)
								 {
									 if($foreCastCount == 7)
									 {
										 break;
									 }
									$date = $forecastValue['date'];
									$highFahrenheit = $forecastValue['highFahrenheit'];
									$lowFahrenheit = $forecastValue['lowFahrenheit'];
									$highCelsius = $forecastValue['highCelsius'];
									$lowCelsius = $forecastValue['lowCelsius'];
									$maxwindMPH = $forecastValue['maxwindMPH'];
									$maxwindKPH = $forecastValue['maxwindKPH'];
									$maxwindDirection = $forecastValue['maxwindDirection'];
									$maxwindDegrees = $forecastValue['maxwindDegrees'];
									$avewindMPH = $forecastValue['avewindMPH'];
									$avewindKPH = $forecastValue['avewindKPH'];
									$avewindDirection = $forecastValue['avewindDirection'];
									$avewindDegrees = $forecastValue['avewindDegrees'];
									$qpfAlldayIn = $forecastValue['qpfAlldayIn'];
									$qpfAlldayMm = $forecastValue['qpfAlldayMm'];
									$snowAllDayIn = $forecastValue['snowAllDayIn'];
									$snowAllDayMm = $forecastValue['snowAllDayMm'];
									$avehumidity = $forecastValue['avehumidity'];
									$maxhumidity = $forecastValue['maxhumidity'];
									$minhumidity = $forecastValue['minhumidity'];
									$precipitation = $forecastValue['precipitation'];
									$conditions = $forecastValue['conditions'];
									$conditionIcon = $forecastValue['conditionIcon'];
									$skyIcon = $forecastValue['skyIcon']; 
									$cur_date = $forecastValue['cur_date'];
									$dayCondition = $forecastValue['dayCondition'];
									$dayConditionURL = $forecastValue['dayConditionURL'];
									$dayFCText = $forecastValue['dayFCText'];
									$dayFCMetric = $forecastValue['dayFCMetric'];
									$dayPOP = $forecastValue['dayPOP'];
									$nightCondition = $forecastValue['nightCondition'];
									$nightConditionURL = $forecastValue['nightConditionURL'];
									$nightFCText = $forecastValue['nightFCText'];
									$nightFCMetric = $forecastValue['nightFCMetric'];
									$nightPOP = $forecastValue['nightPOP']; 
									
									if(strtotime($date) == strtotime(date('d-m-Y')))
									{
										$weekDay = 'Today';
									}
									else
									{
										$weekDay = date('l', strtotime($date));
									}
									?>
                                    <div class="forecastBox w30p ml2p">
                                      <div class="fcBox">
                                            <div class="forecastHeading"><h3><?php echo $weekDay; ?></h3></div>
                                            <div class="ForcastDate">
                                               <div class="fcDate"><?php echo date('F d', strtotime($date)); ?></div>
                                            </div>
                                            <div class="fcCondition">
                                                <div class="weathericon large" style="background-position: -805px -85px;" alt="clearsky"></div>
                                            </div>
                                            <div class="fcConditionText"><h3><?php echo $conditions; ?></h3></div>
                                            <div class="fcTemperature"><h3>
                                               <span class="maxt"><span class="_temp"><span class="c"><?php echo $highCelsius; ?></span><span class="f"><?php echo $highFahrenheit; ?></span>°</span></span>
                                               <span class="mint">/<span class="_temp"><span class="c"><?php echo $lowCelsius; ?></span><span class="f"><?php echo $lowFahrenheit; ?></span>°<span class="_degreec">c</span><span class="_degreef">f</span></span></span></h3>
                                             </div>
                                             <div class="fcWind fcItem">
                                                <div class="fcleft">Wind</div>
                                                <div class="fcMiddle"><div class="wind"></div></div>
                                                <div class="fcRight"><?php echo $avewindKPH; ?>&nbsp;km/h, <?php echo $avewindDirection; ?></div>
                                                <div class="clrBoth"></div>
                                              </div>
                                              <div class="fchumidity fcItem">
                                                  <div class="fcleft">RH</div>
                                                  <div class="fcMiddle"><div class="humidity"></div></div>
                                                  <div class="fcRight">
                                                        <?php echo $avehumidity; ?>&nbsp;% <!--| 80&nbsp;%                             -->
                                                   </div>
                                                  <div class="clrBoth"></div>
                                                </div>
                                                <div class="fcRain fcItem">
                                                        <div class="fcleft">QPF</div>
                                                        <div class="fcMiddle"><div class="rain"></div></div>
                                                        <div class="fcRight">
                                                            <?php echo $qpfAlldayIn; ?>&nbsp;inches | <?php echo $qpfAlldayMm; ?>&nbsp;mm                                					</div>
                                                        <div class="clrBoth"></div>
                                                     </div>
                                                     <div class="clrBoth"></div>
                                                </div>
                                                <div class="fcRain fcItem">
                                                        <div class="fcleft">Snow</div>
                                                        <div class="fcMiddle"><div class="rain"></div></div>
                                                        <div class="fcRight">
                                                            <?php echo $snowAllDayIn; ?>&nbsp;inches | <?php echo $snowAllDayMm; ?>&nbsp;mm                                					</div>
                                                        <div class="clrBoth"></div>
                                                     </div>
                                                     <div class="clrBoth"></div>
                                                     <div class="WeatherCondition warm"><h5><?php echo $dayCondition; ?></h5></div>
                                                </div>
                                            
                                       
                                    <?php
								 	$foreCastCount++;							
								 }
								}
								else
								{
									echo "The location doesn't have forecast details.";
								}
								?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 bt-emp-boxb">
                                        
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