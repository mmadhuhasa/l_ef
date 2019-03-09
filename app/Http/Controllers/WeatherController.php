<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Input;
use App\Http\Controllers\Controller;
use App\Exceptions\customException;
use App\models\WeatherModel;
use App\models\WeatherForecastModel;

use Redirect;
use Auth;

class WeatherController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    function geoLookUp($location)
	{
		$json_string = file_get_contents("http://api.wunderground.com/api/259af49b0d92da5a/geolookup/conditions/q/India/".$location.".json");					
		$data  = $this->getRequiredParameters($json_string);
		//$parsed_json = json_decode($json_string, true);
		//return $parsed_json;
		return $data;
	}
	
	function forecast($location)
	{   
		$json_string = file_get_contents("http://api.wunderground.com/api/259af49b0d92da5a/forecast10day/q/India/".$location.".json");			
		$data  = $this->getRequiredForecastParameters($json_string);
		//$parsed_json = json_decode($json_string, true);
		//return $parsed_json;
		return $data;
	}
	
	function getRequiredParameters($jsonString)
	{
		$parsed_json = json_decode($jsonString, true);
		//echo '<pre>'; print_r($parsed_json);
		
		$finalInformation = array();
		if(isset($parsed_json['response']['error']))
		{
			$finalInformation['Status_Code'] = 1;
			$finalInformation['Status_Desc'] = $parsed_json['response']['error']['description'];
			return $finalInformation;
		}
		
		$finalInformation['Status_Code'] = 0;
		$finalInformation['Status_Desc'] = "Success";
		
		
		$city 				= $parsed_json['location']['city'];
		$country			= $parsed_json['location']['country_name'];
		
		$currentObservation = $parsed_json['current_observation'];
		
		$stationID 			= $currentObservation['station_id'];		
		$weather    		= $currentObservation['weather'];
		$temp_f    			= $currentObservation['temp_f'];
		$temp_c    			= $currentObservation['temp_c'];
		$relative_humidity    = $currentObservation['relative_humidity'];
		$wind_string    	= $currentObservation['wind_string'];
		$wind_dir    		= $currentObservation['wind_dir'];		
		$wind_degrees    	= $currentObservation['wind_degrees'];
		$wind_mph    		= $currentObservation['wind_mph'];
		$wind_gust_mph    	= $currentObservation['wind_gust_mph'];
		$wind_kph    		= $currentObservation['wind_kph'];
		$wind_gust_kph    	= $currentObservation['wind_gust_kph'];
		$pressure_mb    	= $currentObservation['pressure_mb'];
		$pressure_in    	= $currentObservation['pressure_in'];
		$pressure_trend    	= $currentObservation['pressure_trend'];
		$dewpoint_string    = $currentObservation['dewpoint_string'];
		$dewpoint_f    		= $currentObservation['dewpoint_f'];
		$dewpoint_c    		= $currentObservation['dewpoint_c'];           				
		$forecast_url   	= $currentObservation['forecast_url'];
		$dewpoint_string	= $currentObservation['dewpoint_string'];
		$heat_index_string  = $currentObservation['heat_index_string'];
		$windchill_string   = $currentObservation['windchill_string'];
		$feelslike_string   = $currentObservation['feelslike_string'];
		$visibility_mi    	= $currentObservation['visibility_mi'];
		$visibility_km    	= $currentObservation['visibility_km'];
		$precip_1hr_string  = $currentObservation['precip_1hr_string'];		//Precipitation is rain, snow, sleet, or hail 
		$precip_1hr_in  	= $currentObservation['precip_1hr_in'];	
		$precip_1hr_metric  = $currentObservation['precip_1hr_metric'];	
		$precip_today_string= $currentObservation['precip_today_string'];
		$precip_today_in  	= $currentObservation['precip_today_in'];	
		$precip_today_metric= $currentObservation['precip_today_metric'];	
		$UV					= $currentObservation['UV'];		
		$icon    			= $currentObservation['icon'];
		$icon_url    		= $currentObservation['icon_url'];
		$forecast_url		= $currentObservation['forecast_url'];		
		$history_url    	= $currentObservation['history_url'];
						
		
		$weather = array(
					"city" 			=> $city,
					'country' 		=>  $city,
					'station_code'	=>  $stationID,
					'weather'		=>  $weather,		//Clear,
					'temperature_f'	=>  $temp_f,
					'temperature_c'	=>  $temp_c,
					'relative_humidity'=>  $relative_humidity,
					'wind_string'	=>  $wind_string,		
					'wind_dir'		=>  $wind_dir,
					'wind_degrees'	=>  $wind_degrees,		
					'wind_mph'		=>  $wind_mph,
					'wind_gust_mph'	=>  $wind_gust_mph,		
					'pressure_mb'	=>  $pressure_mb,		
					'pressure_in'	=>  $pressure_in,
					'pressure_trend'=>  $pressure_trend,
					'dewpoint_string'=>  $dewpoint_string,		
					'dewpoint_f'	=>  $dewpoint_f,
					'dewpoint_c'	=>  $dewpoint_c,		
					'visibility_km'	=>  $visibility_km,
					'visibility_mi'	=>  $visibility_mi,
					'UV'			=>  $UV,
					'precip_1hr_string' => $precip_1hr_string,
					'precip_today_string'=> $precip_today_string,
					'forecast_url'	=> $forecast_url,
					'history_url'	=> $history_url
				);
		
		$finalInformation['weatherDetails'] = $weather;		
		
		return $finalInformation;
	}
	
	function getRequiredForecastParameters($jsonString)
	{
		$parsed_json = json_decode($jsonString, true);
		//echo '<pre>'; print_r($parsed_json);
		
		$finalInformation = array();
		$weather		  = array();		
		
		if(isset($parsed_json['response']['error']))
		{
			$finalInformation['Status_Code'] = 1;
			$finalInformation['Status_Desc'] = $parsed_json['response']['error']['description'];
			return $finalInformation;
		}
		
		$finalInformation['Status_Code'] = 0;
		$finalInformation['Status_Desc'] = "Success";
		
		//--------------START Forecast Text array ----------------------------------
		$txtForecast = $parsed_json['forecast']['txt_forecast']['forecastday'];
		$fcArray = array();
		for($p = 0, $f = 0; $p < count($txtForecast); $p++)
		{			
			$fcText 		= $txtForecast[$p]['fcttext'];
			$fcTextMetric 	= $txtForecast[$p]['fcttext_metric'];
			$pop 			= $txtForecast[$p]['pop'];
			$icon 			= $txtForecast[$p]['icon'];
			$icon_url 		= $txtForecast[$p]['icon_url'];
			
			
			if($p == 0)
			{			
				$dayName	= date('l');
				$fcDate		= date('d-m-Y');
				if(strtolower($dayName) == strtolower($txtForecast[$p]['title']) )
				{
					$fcDate		= date('d-m-Y');
				}
			}
			
			if($p % 2 == 0)
			{
				$fcTextArray[$f][] = $fcArray[] = array(
										'cur_date' => $fcDate,
										'dayCondition' => $icon,
										'dayConditionURL' => $icon_url,
										'dayFCText' => $fcText,
										'dayFCMetric' => $fcTextMetric,
										'dayPOP' => $pop
										);	
			}
			else
			{
				$fcTextArray[$f][] = $fcArray[] = array(
										'nightCondition' => $icon,
										'nightConditionURL' => $icon_url,
										'nightFCText' => $fcText,
										'nightFCMetric' => $fcTextMetric,
										'nightPOP' => $pop
										);	
			}
						
			if($p % 2 == 1)
			{
				$f++;
				$fcDate = date('d-m-Y',strtotime($fcDate . "+1 day"));
			}			
		}
		
		for($i=0; $i<count($fcTextArray); $i++)
		{
			$fcFinalArray[] = array_merge($fcTextArray[$i][0], $fcTextArray[$i][1]);
		}		
		//echo '<pre>'; print_r($fcFinalArray); exit;
		//--------------ENd Forecast Text array ----------------------------------
		
		//--------------START SIMPLE forecast Information-------------------------------------
		
		$simpleforecast = $parsed_json['forecast']['simpleforecast']['forecastday'];
		//echo '<pre>'; print_r($simpleforecast);	
		$tf = 0;	
		foreach($simpleforecast as $key => $val)
		{
			$forecastDay = $val;
			
			$day = $forecastDay['date']['day'];
			$month = $forecastDay['date']['month'];
			$year = $forecastDay['date']['year'];
			$monthname = $forecastDay['date']['monthname'];
			$weekday = $forecastDay['date']['weekday'];
			$ampm = $forecastDay['date']['ampm'];
			
			$date = $day.'-'.$month.'-'.$year;
			
			$highFahrenheit = $forecastDay['high']['fahrenheit'];
			$highCelsius 	= $forecastDay['high']['celsius'];
			$lowFahrenheit  = $forecastDay['low']['fahrenheit'];
			$lowCelsius 	= $forecastDay['low']['celsius'];		
			
			$maxwindMPH 	= $forecastDay['maxwind']['mph'];
			$maxwindKPH 	= $forecastDay['maxwind']['kph'];
			$maxwindDirection = $forecastDay['maxwind']['dir'];
			$maxwindDegrees = $forecastDay['maxwind']['degrees'];
			
			$avewindMPH 	= $forecastDay['avewind']['mph'];
			$avewindKPH 	= $forecastDay['avewind']['kph'];
			$avewindDirection = $forecastDay['avewind']['dir'];
			$avewindDegrees = $forecastDay['avewind']['degrees'];
			
			$qpfAlldayIn 	= $forecastDay['qpf_allday']['in'];	//Quantitative Precipitation Forecasts
			$qpfAlldayMm 	= $forecastDay['qpf_allday']['mm'];
			$snowAllDayIn   = $forecastDay['snow_allday']['in'];
			$snowAllDayMm 	= $forecastDay['snow_allday']['cm'];
			
			$avehumidity 	= $forecastDay['avehumidity'];
			$maxhumidity 	= $forecastDay['maxhumidity'];
			$minhumidity 	= $forecastDay['minhumidity'];
			
			$pop 			= $forecastDay['pop'];			//probability of precipitation
			$conditions 	= $forecastDay['conditions'];
			$conditionIcon 	= $forecastDay['icon_url'];
			$skyIcon 		= $forecastDay['skyicon'];
			
			$forecast = array(
							'date' 			=> $date,
							'highFahrenheit' 		=> $highFahrenheit,
							'lowFahrenheit'	=> $lowFahrenheit,
							'highCelsius'		=> $highCelsius,		//Clear,
							'lowCelsius'	=> $lowCelsius,							
							'maxwindMPH'	=> $maxwindMPH,
							'maxwindKPH'	=> $maxwindKPH,
							'maxwindDirection'	=> $maxwindDirection,		
							'maxwindDegrees'		=> $maxwindDegrees,							
							'avewindMPH'	=> $avewindMPH,		
							'avewindKPH'		=> $avewindKPH,
							'avewindDirection'	=> $avewindDirection,		
							'avewindDegrees'	=> $avewindDegrees,									
							'qpfAlldayIn'	=> $qpfAlldayIn,
							'qpfAlldayMm'=> $qpfAlldayMm,
							'snowAllDayIn'=> $snowAllDayIn,		
							'snowAllDayMm'	=> $snowAllDayMm,							
							'avehumidity'	=> $avehumidity,		
							'maxhumidity'	=> $maxhumidity,
							'minhumidity'	=> $minhumidity,							
							'precipitation'			=> $pop,
							'conditions' => $conditions,
							'conditionIcon'=> $conditionIcon,
							'skyIcon'	=> $skyIcon
						);
			$result     = array_merge($forecast, $fcFinalArray[$tf]);				
						
			$weather[]	= $result;	
			$tf++;				
		}
		
		$finalInformation['forecastDetails'] = $weather;			
		return $finalInformation;
	}
	
	function getMetAbbreviation($metar)
	{
		if($metar == '')
		{
			$metarOriginal = 'VIAR 272300 IST 00000KT 1600 BR NSC 16/16 Q1019 BECMG 1500';	
		}
		else
		{
			$metarOriginal = $metar;
		}
		$metarSubCode = array();
		$words = preg_split('/\s+/', $metarOriginal);
		$metarNew = '';
		$currentDateTime = date("Y-m-d H:i:s");
		$metarAbbreviation = array();
		for($j = 0; $j<count($words); $j++)
		{
			$metarCodes = trim(ltrim(rtrim($words[$j])));
			$wordLength = strlen($metarCodes);						
			//echo $metarCodes;
			
			if($wordLength == 4)
			{
				if(ctype_alpha($metarCodes))
				{
					$metarAbbreviation['airportCode'] = $metarCodes;
				}
			}
			
			if($metarCodes == 'IST')
			{
				$newIndex = $j-1;
				$metarAbbreviation['time'] = $words[$newIndex].' '.$metarCodes;
			}
			
			$stringIdentifier = strpos($metarCodes, '/');
			if($stringIdentifier != false)
			{
				if($metarCodes[0] == 'R')
				{
					$metarAbbreviation['runwayVisibility'] = $metarCodes;
				}
				else
				{
					$temperatureArray  = explode('/', $metarCodes);
					
					$temperature = $temperatureArray[0];
					$dewPoint 	 = $temperatureArray[1];
					
					$metarAbbreviation['temperature'] = $temperature;
					$metarAbbreviation['dewPoint'] = $dewPoint;
				}
			}
			
			$last2Letters = substr($metarCodes, -2);
			if($last2Letters == 'KT')
			{
				$wind = $metarCodes;
				$metarAbbreviation['wind'] = $wind;
			}
			else if($last2Letters == 'SM')
			{
				$visibility	= $metarCodes;
				$metarAbbreviation['visibility'] = $visibility;
			}
			else if($last2Letters == 'FT')
			{
				$runwayVisualRange	= $metarCodes;
				$metarAbbreviation['runwayVisualRange'] = $runwayVisualRange;
			}
			
			$cloudReport = '';
			$first3Letters = substr($metarCodes, 0, 3);
			switch($first3Letters)
			{		
				case 'SKC':				
						$cloudReport = "No cloud/Sky clear";
						break;
				case 'CLR':				
						$cloudReport = "No clouds below 12,000 ft (3,700 m) (U.S.) or 10,000 ft (3,000 m) (Canada)";
						break;
				case 'NSC':				
						$cloudReport = "No significant cloud";
						break;
				case 'FEW':				
						$cloudReport = "Few";
						break;
				case 'SCT':				
						$cloudReport = "Scattered";
						break;
				case 'BKN':				
						$cloudReport = "Broken";
						break;
				case 'OVC':				
						$cloudReport = "Overcast";
						break;
				case 'RMK':
						
						break;		
				default:
						$cloud		 = $metarCodes;
						break;
			}
			if($cloudReport != '')
			{
				$metarAbbreviation['cloudReport'] = $cloudReport;
			}
			
			if($metarCodes == 'NOSIG')
			{
				$trend = 'No Significant Change';
				$metarAbbreviation['trend'] = $trend;
			}												
		}
		
		//echo 'Metar is :'.$metarOriginal.'<br/>';
		//print_r($metarAbbreviation);
		return $metarAbbreviation;
	}
	
	public function autoCompleteLocation(Request $request)
    { 
        //$searchString	= htmlspecialchars($_REQUEST['location']);
		$location = $request->location;
        $get_auto_complete_results = WeatherForecastModel::getAirports($location);
		//print_r($get_auto_complete_results); exit;
		$tokenInputsArr = array();

		for($i=0; $i <count($get_auto_complete_results); $i++)
		{
			$listOfTokens['id'] = $get_auto_complete_results[$i]->state;
			$listOfTokens['name'] = $get_auto_complete_results[$i]->state;
			$tokenInputsArr[] = $listOfTokens;
		}		
		$json_array = json_encode($tokenInputsArr);
        //$json_response = json_encode($result);
		//print_r($json_array); exit;
		return $json_array;
    }
	
	public function loadwather()
	{		
		$data = ['metar_abbreviation' => '',
			'geo_lookup' => '',
			'forecast' => '',			
		];
		return view('weather.weather', $data);
	}
	
	public function getAirportLocationWeather1($location)
	{
		//$location = $_REQUEST['location'];
		$result = WeatherForecastModel::getAirportInformation($location);
		$metar  = $result[0]->metar;
		
		if (strpos($location, 'Hyderabad') !== false || strpos($location, 'Bangalore') !== false) {
			$locationArray = explode(' ', $location);
			$location = $locationArray[0];
		}
		
		$metarAbbreviation = $this->getMetAbbreviation($metar);
		$geoLookup 	= $this->geoLookUp($location);
		$forecast	= $this->forecast($location);	
		
	
		$data = ['metar_abbreviation' => $metarAbbreviation,
			'geo_lookup' => $geoLookup,
			'forecast' => $forecast,			
		];
		return view('weather.weather', $data);
	}
	
	public function getAirportLocationWeather(Request $request)
	{		
		$location	= $request->txtAirportCode;
		$metarAbbreviation = '';
		$geoLookup	= '';
		$forecast	= '';
		$aiportcode = 'Bangalore (VOBG)';
		
		if($location == '')
		{
			$location = $aiportcode;
		}
		$searchString  = $location;		
		
		$result = WeatherForecastModel::getAirportInformation($location);
		if(count($result) > 0)
		{
			$metar  = $result[0]->metar;
			
			if (strpos($location, 'Hyderabad') !== false || strpos($location, 'Bangalore') !== false) {
				$locationArray = explode(' ', $location);
				$location = $locationArray[0];
			}
			
			$metarAbbreviation = $this->getMetAbbreviation($metar);
			$geoLookup 	= $this->geoLookUp($location);
			$forecast	= $this->forecast($location);							
			
			$data = ['metar_abbreviation' => $metarAbbreviation,
				'geo_lookup' => $geoLookup,
				'forecast' => $forecast,
				'searchString'=> $searchString			
			];
		}
		else
		{
			$data = ['metar_abbreviation' => $metarAbbreviation,
				'geo_lookup' => $geoLookup,
				'forecast' => $forecast,
				'searchString'=> $searchString			
			];
		}
		return view('weather.weather', $data);
	}

	public function weather_get()
	{
      $xml=simplexml_load_file("https://aviationweather.gov/adds/dataserver_current/httpparam?dataSource=metars&requestType=retrieve&format=xml&stationString=VAAH,VAAU,VABB,VABJ,VABO,VABP,VABV,VADN,VAGD,VAID,VAJB,VAJJ,VAJL,VAJM,VAKE,VAKP,VAKS,VOND,VANP,VAPO,VAPR,VARG,VARK,VASL,VASU,VAUD,VEAT,VEBD,VEBN,VEBS,VECC,VEGK,VEGT,VEGY,VEPT,VERC,VERP,VIAG,VIAH,VIDD,VIDN,VIDP,VIFB,VILD,VILH,VILK,VIPT,VOBG,VOBL,VOBM,VOBR,VOBZ,VOCB,VOCI,VOCL,VOCP,VODG,VOGO,VOHS,VOHY,VOMD,VOML,VOMM,VOPB,VOPC,VOPN,VORY,VOSM,VOTK,VOTP,VOTR,VOTV&hoursBeforeNow=.5") or die("Error: Cannot create object");
	    $meta=array();
	    if(isset($xml->data->METAR))
	    {	
	     foreach ($xml->data->METAR as $metar) {
  	
               $meta[]=array('raw_text'=>$metar->raw_text
               	// ,'station_id'=>$metar->station_id,'observation_time'=>$metar->observation_time,'latitude'=>$metar->latitude,'longitude'=>$metar->longitude,'temp_c'=>$metar->temp_c,'dewpoint_c'=>$metar->dewpoint_c,'wind_dir_degrees'=>$metar->wind_dir_degrees,'wind_speed_kt'=>$metar->wind_speed_kt,'visibility_statute_mi'=>$metar->visibility_statute_mi,'altim_in_hg'=>$metar->altim_in_hg,'flight_category'=>$metar->flight_category,'metar_type'=>$metar->metar_type,'elevation_m'=>$metar->elevation_m,'sky_cover'=>$metar->sky_condition[0]['sky_cover'],'cloud_base_ft_agl'=>$metar->sky_condition[0]['cloud_base_ft_agl']
               	);	 
	     }  
	     }  
	     return view('weather.weather_index')->with(['data'=>$meta]);
	}
	// public function weather_parse(Request $request)
	// {
      
	// 	$apcode=$request->airport_code;
	// 	$before_now=$request->before_now;
	//     $xml=simplexml_load_file("https://aviationweather.gov/adds/dataserver_current/httpparam?dataSource=metars&requestType=retrieve&format=xml&stationString=$apcode&hoursBeforeNow=$before_now") or die("Error: Cannot create object");
	//     $meta=array();
	//     if(isset($xml->data->METAR))
	//     {	
	//      foreach ($xml->data->METAR as $metar) {
  	
 //               $meta[]=array('raw_text'=>$metar->raw_text,'station_id'=>$metar->station_id,'observation_time'=>$metar->observation_time,'latitude'=>$metar->latitude,'longitude'=>$metar->longitude,'temp_c'=>$metar->temp_c,'dewpoint_c'=>$metar->dewpoint_c,'wind_dir_degrees'=>$metar->wind_dir_degrees,'wind_speed_kt'=>$metar->wind_speed_kt,'visibility_statute_mi'=>$metar->visibility_statute_mi,'altim_in_hg'=>$metar->altim_in_hg,'flight_category'=>$metar->flight_category,'metar_type'=>$metar->metar_type,'elevation_m'=>$metar->elevation_m,'sky_cover'=>$metar->sky_condition[0]['sky_cover'],'cloud_base_ft_agl'=>$metar->sky_condition[0]['cloud_base_ft_agl']);	 
	//      }    
	//     }
 //     return view('weather.weather_index')->with(['data'=>$meta,'apcode'=>$apcode,'before_now'=>$before_now]);

	// }
	public function taf_get()
	{
        $xml=simplexml_load_file("https://aviationweather.gov/adds/dataserver_current/httpparam?dataSource=tafs&requestType=retrieve&format=xml&stationString=VAAH,VAAU,VABB,VABJ,VABO,VABP,VABV,VADN,VAGD,VAID,VAJB,VAJJ,VAJL,VAJM,VAKE,VAKP,VAKS,VOND,VANP,VAPO,VAPR,VARG,VARK,VASL,VASU,VAUD,VEAT,VEBD,VEBN,VEBS,VECC,VEGK,VEGT,VEGY,VEPT,VERC,VERP,VIAG,VIAH,VIDD,VIDN,VIDP,VIFB,VILD,VILH,VILK,VIPT,VOBG,VOBL,VOBM,VOBR,VOBZ,VOCB,VOCI,VOCL,VOCP,VODG,VOGO,VOHS,VOHY,VOMD,VOML,VOMM,VOPB,VOPC,VOPN,VORY,VOSM,VOTK,VOTP,VOTR,VOTV&hoursBeforeNow=.5") or die("Error: Cannot create object");
	    $taff=array();
	    if(isset($xml->data->TAF))
	    {	
		     foreach ($xml->data->TAF as $taf) 
		     {
                  $taff[]=array('raw_text'=>$taf->raw_text);
	  	         // foreach ($taf->forecast as $forecast)
	  	         // {
	            //          $taff[]=array('raw_text'=>$taf->raw_text,
	               				// 'station_id'=>$taf->station_id,
	               				// 'issue_time'=>$taf->issue_time,
	               				// 'bulletin_time'=>$taf->bulletin_time,
	               				// 'valid_time_from'=>$taf->valid_time_from,
	               				// 'valid_time_to'=>$taf->valid_time_to,
	               				// 'latitude'=>$taf->latitude,
	               				// 'longitude'=>$taf->longitude,
	               				// 'elevation_m'=>$taf->elevation_m,
	                   //          'fcst_time_from'=>$forecast->fcst_time_from,
	                   //          'fcst_time_to'=>$forecast->fcst_time_to,
	                   //          'wind_dir_degrees'=>$forecast->wind_dir_degrees,
	                   //          'wind_speed_kt'=>$forecast->wind_speed_kt,
	                   //          'sky_cover'=>$forecast->sky_condition['sky_cover'],
	                   //          'cloud_base_ft_agl'=>$forecast->sky_condition['cloud_base_ft_agl'],
	              // 				);		         	
	  	        // }  
		     }
	    }
	    return view('weather.taf_index')->with(['data'=>$taff]);
	}
	// public function taf_parse(Request $request)
	// {
      
	// 	$apcode=$request->airport_code;
	// 	$before_now=$request->before_now;
	//     $xml=simplexml_load_file("https://aviationweather.gov/adds/dataserver_current/httpparam?dataSource=tafs&requestType=retrieve&format=xml&stationString=$apcode&hoursBeforeNow=$before_now") or die("Error: Cannot create object");
	//     $taff=array();
	//     if(isset($xml->data->TAF))
	//     {	
	// 	     foreach ($xml->data->TAF as $taf) 
	// 	     {

	//   	         foreach ($taf->forecast as $forecast)
	//   	         {
	//                      $taff[]=array('raw_text'=>$taf->raw_text,
	//                				'station_id'=>$taf->station_id,
	//                				'issue_time'=>$taf->issue_time,
	//                				'bulletin_time'=>$taf->bulletin_time,
	//                				'valid_time_from'=>$taf->valid_time_from,
	//                				'valid_time_to'=>$taf->valid_time_to,
	//                				'latitude'=>$taf->latitude,
	//                				'longitude'=>$taf->longitude,
	//                				'elevation_m'=>$taf->elevation_m,
	//                             'fcst_time_from'=>$forecast->fcst_time_from,
	//                             'fcst_time_to'=>$forecast->fcst_time_to,
	//                             'wind_dir_degrees'=>$forecast->wind_dir_degrees,
	//                             'wind_speed_kt'=>$forecast->wind_speed_kt,
	//                             'sky_cover'=>$forecast->sky_condition['sky_cover'],
	//                             'cloud_base_ft_agl'=>$forecast->sky_condition['cloud_base_ft_agl'],
	//                				);		         	
	//   	         }  
	// 	     }
	//     }
	//     return view('weather.taf_index')->with(['data'=>$taff,'apcode'=>$apcode,'before_now'=>$before_now]);

	// }
}

?>