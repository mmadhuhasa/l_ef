<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\notams\NotamsModel;
use App\models\airport\Location;
use App\models\airport\Radail;
use App\models\airport\Bearing;
use App\models\airport\Nearbyairport;
use App\models\airport\Runway;
use App\models\airport\Communication;
use App\models\airport\Operation;
use App\models\airport\State;
use App\models\airport\Country;
use App\models\Fuelprice;
use App\models\lr\LicenseDetailsModel;
use App\User;
use DB;
use Hash;
use Auth;
ini_set('max_execution_time', 3000);
class AirportController extends Controller
{
     /*public function index(Request $request)
     {
        if(empty($request->airport_code))
         $ap_code='VIDP';
        else
         $ap_code=$request->airport_code; 
        $today=date("l");
        $airport=Location::where('airport_code',$ap_code)->first();
        $state_id=$airport->state_id;
        $state=State::find($state_id);
        $state_name=$state->statename;
        $state_slug=$state->slug;
        $country=Country::find($state->country_id);
        $country_name=$country->countryname;
        $country_slug=$country->slug;
        $anchortext="Airports in $state_name,$country_name.";
        $anchorlink="$country_slug/$state_slug";
        $airportname=substr($airport->airport_name,7);
        $airports=Location::find($airport->id);
        $notamCount=NotamsModel::where('aerodrome',$airport->airport_code)->count();
        return view('airport.index')->with(['airports'=>$airports,'airportname'=>$airportname,'anchortext'=>$anchortext,'anchorlink'=>$anchorlink,'today'=>$today,'notam_count'=>$notamCount]);
     }*/
      public function index(Request $request)
     {
        $ap_code=array('VIDP','VABB','VOBL','VOMM','VECC'); 
        foreach ($ap_code as $ap) 
        {
            $airports[]=Location::where('airport_code',$ap)->first();
        }
        //dd($airports);
        return view('airport.index')->with(['ap'=>$airports]);
     }
     public function index_post(Request $request)
     {

        $ap_code=$request->airportcode; 
        $today=date("l");
        $airport=Location::where('airport_code',$ap_code)->first();
        $state_id=$airport->state_id;
        $state=State::find($state_id);
        $state_name=$state->statename;
        $state_slug=$state->slug;
        $country=Country::find($state->country_id);
        $country_name=$country->countryname;
        $country_slug=$country->slug;
        $anchortext="Airports in $state_name,$country_name.";
        $anchorlink="$country_slug/$state_slug";
        $airportname=substr($airport->airport_name,7);
        $airports=Location::find($airport->id);
        $notamCount=NotamsModel::where('aerodrome',$airport->airport_code)->count();

        return view('airport.index')->with(['airports'=>$airports,'airportname'=>$airportname,'anchortext'=>$anchortext,'anchorlink'=>$anchorlink,'today'=>$today,'notam_count'=>$notamCount]);
     }
     public function ap_info($apcode,$ap_name)
     {
        $today=date("l");
        $airport=Location::where('airport_code',$apcode)->first();
        $state_id=$airport->state_id;
        $state=State::find($state_id);
        $state_name=$state->statename;
        $state_slug=$state->slug;
        $country=Country::find($state->country_id);
        $country_name=$country->countryname;
        $country_slug=$country->slug;
        $anchortext="Airports in $state_name,$country_name.";
        $anchorlink="$country_slug/$state_slug";
     	$airportname=substr($airport->airport_name,7);
     	$airports=Location::find($airport->id);
        $notamCount=NotamsModel::where('aerodrome',$airport->airport_code)->count(); 
        return view('airport.info')->with(['airports'=>$airports,'airportname'=>$airportname,'anchortext'=>$anchortext,'anchorlink'=>$anchorlink,'today'=>$today,'notam_count'=>$notamCount]);
     }
     public function search(Request $request)
     {
     
     	 $this->validate($request, ['search' => 'required']);
     	 $name=$request->search;
         $airport=Location::where('airport_name',$name)->first();
         if(!empty($airport))
         {	
          	$ap_short_code=str_replace(' ', '', $airport->airport_name);
           
          	return redirect("/airport/$airport->airport_code/$ap_short_code");
         }
         else
         {
            return back()->withInput()->with('message', 'No result found');
         }  
     }
     public function autosuggest()
     {
         $airports_names = DB::table('locations')->pluck('airport_name');
          return json_encode($airports_names);
     }
     public function validate_airport(Request $request)
     {
         $name=$request->airport_name;
         $airport=Location::where('airport_name',$name)->first();
         if(empty($airport))
         {  
            return json_encode(false);
         }  
     }
     public function autosuggest_post(Request $request)
     {
          $airports_names = DB::table('locations')->whereNotIn('airport_code', ['VIDP','VABB','VOBL','VOMM','VECC'])->pluck('airport_name');
         return json_encode($airports_names);
     }

     public function add_licence_user()
     {
       
        $path=public_path('lr\VENTURA_AIRCONNET_LICENSE.csv'); 
        $file = fopen($path,"r");
        while(!feof($file))
        {
            
            $data=fgetcsv($file);
             if($data==false)
                break;
            $name=$data[0];
            $desig=$data[1];
            $mobile=$data[2];
            $email_id=$data[3];
            $user_role_id=$data[4];
            $parts = explode('@',$email_id);
            $pwd=Hash::make($parts[0].'2017');
            $is_lr=1;
            $is_active=1;
            $check_user=User::where('mobile_number',$mobile)->first();
            if(empty($check_user))
            $user = new User;
            else
             $user =User::find($check_user->id);   
            $user->name=$name;
            $user->mobile_number=$mobile;
            $user->email=$email_id;
            $user->user_role_id=$user_role_id;
            $user->password=$pwd;
            $user->is_lr=$is_lr;
            $user->is_active=$is_active;
            $user->operator_user_id=Auth::user()->id;
            $user->operator=Auth::user()->operator;
            $user->save();
        }
        fclose($file);
     }
     public function add_licence_detail()
     {
       
        $path=public_path('lr\ventura_license_detail.csv'); 
        $l_type=array('ATPL'=>1,'AVSEC'=>2,'CHPL'=>3,'CPL'=>4,'CRM'=>5,'DGR'=>6,'ENGLISH PROFICIENCY'=>7,'EO'=>8,'FATA'=>9,'FRTOL'=>10,'GTR'=>11,'IR'=>12,'LVTO'=>13,'MEDICAL CLASS 1'=>14,'MONSOON'=>15,'PASS'=>16,'PBN'=>17,'PPC'=>18,'RC'=>19,'RNAV'=>20,'RTR'=>21,'RVSM'=>22,'SEP'=>23,'VISA'=>24,'X'=>25);
        $file = fopen($path,"r");
        while(!feof($file))
        {
            
             $data=fgetcsv($file);
             if($data==false)
                break;
            $name=$data[0];
            $licencytype=$data[3];
            $licence_number=$data[4];
            $issue_date=date_create($data[5]);
            $license_issue=date_format($issue_date,"ymd");
            $expire_date=date_create($data[6]);
            $expire_issue=date_format($expire_date,"ymd");
            $licence_expiry=$data[6];
            $is_active=1;
            $user=User::where('name',$name)->first();
            $user_id=$user->id;
             $licensedetails= new LicenseDetailsModel;
             $licensedetails->user_id=$user_id;
             $licensedetails->license_type_id=$l_type[$licencytype];
             $licensedetails->to_date=$license_issue;
             $licensedetails->renewed_date=$expire_issue;
             $licensedetails->number=$licence_number;
             $licensedetails->is_active=$is_active;
             $licensedetails->operator_user_id=Auth::user()->id;
             $licensedetails->save();
        }
        fclose($file);
     }

     public function vtauv()
     {
       
        $path=public_path('license_reminder_csv_files\vtauv.csv'); 
        $file = fopen($path,"r");
        while(!feof($file))
        {
            
            $data=fgetcsv($file);
             $total_fuel=$data[0];
             $main_tank_arm=$data[1];
             $main_tank_mac=$data[2];
             $aux_tank_arm=$data[3];
             $aux_tank_mac=$data[4];
             $tail_tank_arm=$data[5];
             $tail_tank_mac=$data[6];

             DB::table('load_trim_vtauv')->insert(
               ['total_fuel' => $total_fuel, 'main_tank_arm' =>$main_tank_arm,'main_percent_mac'=>$main_tank_mac,'aux_tank_arm'=>$aux_tank_arm,'aux_percent_mac'=>$aux_tank_mac,'tail_tank_arm'=>$tail_tank_arm,'tail_percent_mac'=>$tail_tank_mac]);
        }
        fclose($file);
     }
     //vtavs
     public function vtssf()
     {

        $aero =
array('VAAH'=>'AHMEDABAD',                          
'VAAU'=>'AURANGABAD',                           
'VABB'=>'MUMBAI',                           
'VABJ'=>'BHUJ',                         
'VABO'=>'VADODARA',                         
'VABP'=>'BHOPAL',                           
'VAID'=>'INDORE',                           
'VAJB'=>'JABALPUR',                         
'VAJJ'=>'JUHU MUMBAI',                          
'VAJM'=>'JAMNAGAR',                         
'VANP'=>'NAGPUR',                           
'VANY'=>'NALIYA',                           
'VAPO'=>'PUNE',                         
'VAUD'=>'UDAIPUR',                          
'VEAT'=>'AGARTALA',                         
'VEBD'=>'BAGODGRA',                         
'VEBN'=>'VARANASI',                         
'VEBS'=>'BHUBANESHWAR',                         
'VECC'=>'KOLKOTA',                          
'VEDG'=>'DURGAPUR',                         
'VEGT'=>'GUWAHATI',                         
'VEIM'=>'IMPHAL',                           
'VEMN'=>'DIBRUGARH',                            
'VEMR'=>'DIMAPUR',                          
'VEPT'=>'PATNA',                            
'VERC'=>'RANCHI',                           
'VERP'=>'RAIPUR',                           
'VIAR'=>'AMRITSAR',                         
'VICG'=>'CHANDIGARH',                           
'VIDN'=>'DEHRADUN',                         
'VIDP'=>'DELHI - T2',                           
'VIDP'=>'DELHI T-3',                            
'VIDP'=>'DELHI PALAM T-1',                          
'VIGG'=>'GAGGAL',                            
'VIGR'=>'GWALIOR',                          
'VIJP'=>'JAIPUR',                           
'VIJU'=>'JAMMU',                            
'VILK'=>'LUCKNOW',                          
'VOBG'=>'BANGALORE - HAL',                          
'VOBL'=>'BANGALORE INTL',                           
'VOBM'=>'BELGAUM',                          
'VOBZ'=>'VIJAYWADA',                            
'VOCB'=>'COIMBATORE',                           
'VOCI'=>'COCHIN',                           
'VOCL'=>'CALICUT',                          
'VOGO'=>'GOA',                          
'VOHB'=>'HUBLI',                            
'VOHS'=>'HYDERABAD INTL',                           
'VOJV'=>'VIDYANAGAR',                           
'VOMD'=>'MADURAI',                          
'VOML'=>'MANGALORE',                            
'VOMM'=>'CHENNAI',                          
'VORY'=>'RAJAMUNDRY',                           
'VOTP'=>'TIRUPATI',                         
'VOTR'=>'TRICHY',                           
'VOTV'=>'TRIVANDRUM',                           
'VOVZ'=>'VIZAG');                           


            foreach ($aero as $key => $value) 
            {
                $fuelprice = new Fuelprice;
                $fuelprice->user_id =222;
                $fuelprice->airport_code =$key;
                $fuelprice->city = $value;
                $fuelprice->save();
                 // DB::table('fuel_price')->insert(
                 //   ['user_id'=>222,'fuel' => $key, 'moment' =>$value]);
            }
       
     }

}