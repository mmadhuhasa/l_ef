<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Input;
use App\Http\Controllers\Controller;
use App\Exceptions\customException;
use App\models\WeatherModel;

use Redirect;
use Auth;

class GoogleWeatherController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    function geoLookUp($location)
	{
		////Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit.
		//API KEY : a70a75fe27aef29681773a5ae152a7c5
		$json_string = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$location.",India&appid=a70a75fe27aef29681773a5ae152a7c5&units=metric");					
		$data  = $this->getRequiredParameters($json_string);
		return $data;
	}
	
	function forecast($location)
	{   
		//Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit.
		$json_string = file_get_contents("http://api.openweathermap.org/data/2.5/forecast/daily?q=".$location.",India&mode=json&units=metric&cnt=7&appid=a70a75fe27aef29681773a5ae152a7c5");			
		$data  = $this->getRequiredForecastParameters($json_string);
		return $data;
	}
	
	function getRequiredParameters($jsonString)
	{
		$parsed_json = json_decode($jsonString, true);
		//echo '<pre>'; print_r($parsed_json); exit;
		
		$finalInformation = array();
		if(isset($parsed_json['cod']) && $parsed_json['cod'] == 404)
		{
			$finalInformation['Status_Code'] = 1;
			$finalInformation['Status_Desc'] = $parsed_json['message'];
			return $finalInformation;
		}
		
		$finalInformation['Status_Code'] = 0;
		$finalInformation['Status_Desc'] = "Success";
		
		$humidity = '';
		$pressure = '';
		$sea_level = '';
		$grnd_level	= '';
		$clouds = '';
		$rain = '';
		$snow = '';
		$wind_deg = '';
		$wind_speed = '';
		$visibility = '';
		
		$city 				= $parsed_json['name'];
		$countryCode		= $parsed_json['sys']['country'];			
		$stationID 			= $parsed_json['id'];			
		$weatherID    		= $parsed_json['weather'][0]['id'];	
		$weather    		= $parsed_json['weather'][0]['main'];
		$weatherDescription = $parsed_json['weather'][0]['description'];
		$weatherIon    		= $parsed_json['weather'][0]['icon'];		
		$temp    			= $parsed_json['main']['temp'];			//Unit Default: Kelvin, Metric: Celsius, Imperial: Fahrenheit.
		$temp_min  			= $parsed_json['main']['temp_min'];		
		$temp_max  			= $parsed_json['main']['temp_max'];	
		
		if(isset($parsed_json['main']['humidity']))
		{	
			$humidity    		= $parsed_json['main']['humidity'];		// %
		}
		if(isset($parsed_json['main']['pressure']))
		{
			$pressure	    	= $parsed_json['main']['pressure'];		//hPa
		}
		
		
		if(isset($parsed_json['main']['sea_level']))
		{
			$sea_level    		= $parsed_json['main']['sea_level'];		//hPa
		}
		if(isset($parsed_json['main']['grnd_level']))
		{
			$grnd_level	    	= $parsed_json['main']['grnd_level'];	//hPa	
		}
		if(isset($parsed_json['visibility']))
		{
			$visibility    		= $parsed_json['visibility'];		
		}
		if(isset($parsed_json['wind']['speed']))
		{
			$wind_speed    		= $parsed_json['wind']['speed'];			// m/s
		}
		if(isset($parsed_json['wind']['deg']))
		{
			$wind_deg    		= $parsed_json['wind']['deg'];			//degrees
		}
		if(isset($parsed_json['clouds']['all']))
		{	
			$clouds		    	= $parsed_json['clouds']['all'];			//%
		}
		if(isset($parsed_json['rain']))
		{
			$rain		    	= $parsed_json['rain']['3h'];			//mm
		}
		if(isset($parsed_json['snow']))
		{
			$snow		    	= $parsed_json['snow']['3h'];			//mm				
		}
		$weatherIconUrl    		= 'http://openweathermap.org/img/w/'.$weatherIon.'.png';
						
		
		$weather = array(
					"city" 			=> $city,
					'country' 		=>  $countryCode,
					'station_code'	=>  $stationID,					
					'weatherID'		=>  $weatherID,
					'weather'		=>  $weather,
					'weatherDescription'=>  $weatherDescription,
					'weatherIon'		=>  $weatherIon,					
					'temperature'	=>  $temp,
					'temperature_min'	=>  $temp_min,
					'temperature_max'	=>  $temp_max,					
					'relative_humidity'=>  $humidity,					
					'pressure'	=>  $pressure,
					'sea_level'	=>  $sea_level,
					'grnd_level'	=>  $grnd_level,
					'visibility'	=>  $visibility,
					'wind_speed'	=>  $wind_speed,		
					'wind_degrees'	=>  $wind_deg,	
					'clouds' => $clouds,																	
					'rain' => $rain,
					'snow'=> $snow,
					'weatherIconUrl'	=> $weatherIconUrl
				);
		
		$finalInformation['weatherDetails'] = $weather;		
		
		return $finalInformation;
	}
	
	function getRequiredForecastParameters($jsonString)
	{
		$parsed_json = json_decode($jsonString, true);
		//echo '<pre>'; print_r($parsed_json); exit;
		
		$finalInformation = array();
		$weatherArray	  = array();		
		
		if(isset($parsed_json['cod']) && $parsed_json['cod'] == 404)
		{
			$finalInformation['Status_Code'] = 1;
			$finalInformation['Status_Desc'] = $parsed_json['message'];
			return $finalInformation;
		}
		
		$finalInformation['Status_Code'] = 0;
		$finalInformation['Status_Desc'] = "Success";
		
		//--------------START Forecast array ----------------------------------
		$forecastDaysCount = $parsed_json['cnt'];		
		$simpleforecast		= $parsed_json['list'];		
		$tf = 0;	
		foreach($simpleforecast as $key => $val)
		{
			$forecastDay = $val;
			//print_r($forecastDay); exit;
			$date = $forecastDay['dt'];						
			
			$pressure	= '';
			$humidity	= '';
			$windSpeed 	= '';
			$windDegrees= '';
			$clouds 	= '';
			$rain 		= '';	
			
			$tempDay 	= $forecastDay['temp']['day'];
			$tempMin 	= $forecastDay['temp']['min'];
			$tempMax 	= $forecastDay['temp']['max'];
			$tempNight 	= $forecastDay['temp']['night'];
			$tempEve 	= $forecastDay['temp']['eve'];
			$tempMrng 	= $forecastDay['temp']['morn'];						
			if(isset($forecastDay['pressure'])) $pressure 	= $forecastDay['pressure'];			
			if(isset($forecastDay['humidity'])) $humidity 	= $forecastDay['humidity'];	
			
				
			if(isset($forecastDay['speed'])) $windSpeed = $forecastDay['speed'];
			if(isset($forecastDay['deg'])) $windDegrees = $forecastDay['deg'];			
			if(isset($forecastDay['clouds'])) $clouds 	= $forecastDay['clouds'];
			if(isset($forecastDay['rain'])) $rain 		= $forecastDay['rain'];
			
			$weatherID    		= $forecastDay['weather'][0]['id'];	
			$weather    		= $forecastDay['weather'][0]['main'];
			$weatherDescription = $forecastDay['weather'][0]['description'];
			$weatherIon    		= $forecastDay['weather'][0]['icon'];
			
			$weatherIconUrl    	= 'http://openweathermap.org/img/w/'.$weatherIon.'.png';
			
			$forecast = array(
							'date' 			=> $date,
							'tempDay' 		=> $tempDay,
							'tempMin'		=> $tempMin,
							'tempMax'		=> $tempMax,		//Clear,
							'tempNight'		=> $tempNight,							
							'tempEve'		=> $tempEve,
							'tempMrng'		=> $tempMrng,
							'pressure'		=> $pressure,		
							'humidity'		=> $humidity,							
							'windSpeed'		=> $windSpeed,		
							'windDegrees'	=> $windDegrees,
							'clouds'		=> $clouds,		
							'rain'			=> $rain,									
							'weatherID'		=> $weatherID,
							'weather'		=> $weather,
							'weatherDescription'=> $weatherDescription,		
							'weatherIon'	=> $weatherIon,							
							'weatherIconUrl'=> $weatherIconUrl									
						);			
						
			$weatherArray[]	= $forecast;	
			$tf++;				
		}
		
		$finalInformation['forecastDetails'] = $weatherArray;			
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
		
		return $metarAbbreviation;
	}
	
	public function autoCompleteLocation(Request $request)
    { 
		$location = $request->location;
        $get_auto_complete_results = WeatherModel::getAirports($location);
		$tokenInputsArr = array();

		for($i=0; $i <count($get_auto_complete_results); $i++)
		{
			$listOfTokens['id'] = $get_auto_complete_results[$i]->state;
			$listOfTokens['name'] = $get_auto_complete_results[$i]->state;
			$tokenInputsArr[] = $listOfTokens;
		}		
		$json_array = json_encode($tokenInputsArr);
		return $json_array;
    }
	
	public function loadwather()
	{		
		$data = ['metar_abbreviation' => '',
			'geo_lookup' => '',
			'forecast' => '',			
		];
		return view('weather.weather_google', $data);
	}
	
	public function getAirportLocationWeather1($location)
	{
		//$location = $_REQUEST['location'];
		$result = WeatherModel::getAirportInformation($location);
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
		return view('weather.weather_google', $data);
	}
	
	public function getAirportLocationWeather(Request $request)
	{		
		$location	= $request->txtAirportCode;
		$metarAbbreviation = '';
		$geoLookup	= '';
		$forecast	= '';
		//$aiportcode = 'Bangalore (VOBG)';
		$aiportcode = 'Delhi';
		
		if($location == '')
		{
			$location = $aiportcode;
		}
		$searchString  = $location;
		
		
		$result = WeatherModel::getAirportInformation($location);
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
		return view('weather.weather_google', $data);
	}
}
?>