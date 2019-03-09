<?php

namespace App\Http\Controllers\LoadAndTrim;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\LoadTrimReferenceModel;
use App\models\LoadTrimFormulas;
use App\models\MacTrimModel;
use Response;
use Log;
use PDF;
use App\Exceptions\customException;
use Image;
use Input;
use DB;

class LoadAndTrimController extends Controller {

    protected $empty_weight;
    protected $pilot_co_pilot;
    protected $fwd_baggege_compt;
    protected $wardrobe_refreshment_cabinet;
    protected $lavatory_cabinet;
    protected $aft_baggage_compt;
    protected $paxs;
    protected $fuel_momentum;
    protected $momentum = array();
    protected $weights = array();
    protected $cargo = array();
    protected $jump_vtauv = array();
    protected $potable_water = array('arm' =>574.50);
    protected $catering_allowance = array();
    protected $toilet_charge = array();
    protected $lift_raft = array();
    protected $dry_os = array();
    protected $vtauv_tank = array();
    protected $taxi_out_fuel = array('weight'=>100,'moment'=>60);
    protected $diversion_fuel = array('weight'=>1500,'moment'=>800);
    
    
    protected $validation=array('vtavs'=>array('Take_Off_Fuel' => 2750,'Max_Take_Off_Weight'=>10472,'Max_Landing_Weight'=>9766,'Max_Zero_Fuel_Weight'=>8444),
           'vtssf'=>array('Take_Off_Fuel' => 3650,'Max_Take_Off_Weight'=>12500,'Max_Landing_Weight'=>11600,'Max_Zero_Fuel_Weight'=>10000),
            'vtanf'=>array('Take_Off_Fuel' => 3650,'Max_Take_Off_Weight'=>12500,'Max_Landing_Weight'=>11600,'Max_Zero_Fuel_Weight'=>10000),
            'vtvrl'=>array('Take_Off_Fuel' => 3650,'Max_Take_Off_Weight'=>12500,'Max_Landing_Weight'=>11600,'Max_Zero_Fuel_Weight'=>10000),
            'vtauv'=>array('Take_Off_Fuel' => 20000,'Max_Take_Off_Weight'=>48200,'Max_Landing_Weight'=>38000,'Max_Zero_Fuel_Weight'=>32000),
            'vtobr'=>array('Max_Take_Off_Weight'=>28000,'Max_Zero_Fuel_Weight'=>18450),
            'vtnma'=>array('Take_Off_Fuel'=>1884,'Max_Take_Off_Weight'=>11700),
            'vtnit'=>array('Take_Off_Fuel'=>1884,'Max_Take_Off_Weight'=>11700),
            'vtbsl'=>array('Take_Off_Fuel' => 6790,'Max_Take_Off_Weight'=>20200,'Max_Landing_Weight'=>18700,'Max_Zero_Fuel_Weight'=>15100),
            'vtepu'=>array('Take_Off_Fuel' => 1885,'Max_Take_Off_Weight'=>5980,'Max_Landing_Weight'=>5980,'Max_Zero_Fuel_Weight'=>5590,'Max_Ramp_Weight'=>6010),
            'vtfiu'=>array('Take_Off_Fuel' => 1638,'Max_Take_Off_Weight'=>6804,'Max_Landing_Weight'=>6804,'Max_Zero_Fuel_Weight'=>5670,'Max_Ramp_Weight'=>6849),
            );
    public function index(Request $request) {
    $page = $request->page;
    $callsign = ($request->callsign) ? strtolower($request->callsign) : '';
    switch ($callsign) {
        case $callsign:
        if ($callsign) {
            if ($callsign == 'vtngs') {
            return view('loadandtrim.new_trim_setting');
            }
            elseif ($callsign == 'vtvrl') 
            {
              $data=array('call_sign'=>'vtvrl',
                           'post'=>0);  
              return view('ltrim.vtanf.index')->with($data);
            }
             elseif ($callsign == 'vtkbn') 
            {
              $data=array('call_sign'=>'vtkbn',
                           'post'=>0);  
              return view('ltrim.vtanf.index')->with($data);
            }
            elseif ($callsign == 'vtanf') 
            {
              $data=array('call_sign'=>'vtanf',
                           'post'=>0);  
              return view('ltrim.vtanf.index')->with($data);
            } 
            elseif ($callsign == 'vtssf_old') 
            {
              $data=array('call_sign'=>'vtssf_old',
                           'post'=>0);  
              return view('ltrim.vtanf.index')->with($data);
            } 
            elseif ($callsign == 'vtssf') 
            {
               
              $data=array('call_sign'=>'vtssf',
                           'post'=>0);  
              return view('ltrim.vtanf.index')->with($data);
            } 
             elseif ($callsign == 'vtavs') 
            {
              $data=array('call_sign'=>'vtavs',
                           'post'=>0);  
              return view('ltrim.vtanf.index')->with($data);
            } 
            elseif ($callsign == 'vtnma') 
            {
              $data=array('call_sign'=>'vtnma',
                           'post'=>0);  
              return view('ltrim.vtanf.index')->with($data);
            } 
            elseif ($callsign == 'vtnit') 
            {
              $data=array('call_sign'=>'vtnit',
                           'post'=>0);  
              return view('ltrim.vtanf.index')->with($data);
            }
            elseif ($callsign == 'vtauv') 
            {
              $data=array('call_sign'=>'vtauv',
                           'post'=>0);  
              return view('ltrim.vtauv.index')->with($data);
            } 
            elseif ($callsign == 'vtobr') 
            {
                return view('loadandtrim.vtobr.index')->with('date','');
            } 
            elseif ($callsign == 'vtbsl') 
            {
                return view('ltrim.vtbsl.index')->with('date','');
            } 
            elseif ($callsign == 'vtbsl_new') 
            {
                // $data = array(
                //     'from' => '',
                //     'to' => '',
                //     'date' => '',
                //     'pilot' => '',
                //     'co_pilot' => '',
                //     //'pax' => '',
                //     'landing' =>'',
                //     'lessfuel_dest' =>'',
                //     'tow' => '',
                //     'lessfuel_taxing' => '',
                //     'ramp_weight' => '',
                //     'fuel_loading' => '',
                //     'zfw' => '',
                //     'payload' =>'',
                //     'cargo' =>'',
                //     'pax' =>'',
                //     'refreshment_center' => '',
                //     'empty_weight' => '',
                //     'pilot_co_pilot' => '',

                //     );
                return view('ltrim.vtbsl_new.index');
            } 
            elseif ($callsign == 'vtepu') 
            {
                return view('ltrim.vtepu.index');
            } 
            elseif ($callsign == 'vtfiu') 
            {
                return view('ltrim.vtfiu.index');
            } 
            elseif ($callsign == 'paste') {
                 return view('ltrim.pastelnt');
              }      
            else {
            return view('loadandtrim.' . $callsign);
            }
        }

        else 
        {
            return view('ltrim.landing');
        }
        break;
        default:
        return view('ltrim.landing');
        break;
        }
    }

    public function create() {
        
    }

    public function store(Request $request, $callsign) {
        if ($callsign == 'vtavs') {

            $this->empty_weight = array('weight' => 7010.69, 'arm' => 236.06);
            $this->pilot_co_pilot = array('weight' => 375, 'arm' => 115.16);
            $this->fwd_baggege_compt = array('weight' => 5, 'arm' => 45.47);
            $this->wardrobe_refreshment_cabinet = array('weight' => 10, 'arm' => 143.46);
            $this->lavatory_cabinet = array('weight' => 10, 'arm' => 249.76);
            $this->aft_baggage_compt = array('arm' => 314.29);

            $this->paxs = array(
                array(
                    'arm' => 170.71
                ),
                array(
                    'arm' => 170.71
                ),
                array(
                    'arm' => 220.94
                ),
                array(
                    'arm' => 220.94
                )
            );
            $mod = 0;
            if ($request->take_off_fuel > 2750) {
                $mod = $request->take_off_fuel - 2750;
                $take_off_fuel_val = 2750;
            } else {
                $take_off_fuel_val = $request->take_off_fuel;
            }
            $take_off_fuel_result = $take_off_fuel_val;
            $landing_fuel_val = $request->landing_fuel;
            $landing_fuel_result = $landing_fuel_val;
            $empty_weight_momentum = $this->empty_weight['weight'] * $this->empty_weight['arm'];
            array_push($this->momentum, $empty_weight_momentum);
            array_push($this->weights, $this->empty_weight['weight']);
            $pilot_co_pilot_momentum = $this->pilot_co_pilot['weight'] * $this->pilot_co_pilot['arm'];
            array_push($this->momentum, $pilot_co_pilot_momentum);
            array_push($this->weights, $this->pilot_co_pilot['weight']);
            $fwd_baggege_compt_momentum = $this->fwd_baggege_compt['weight'] * $this->fwd_baggege_compt['arm'];
            array_push($this->momentum, $fwd_baggege_compt_momentum);
            array_push($this->weights, $this->fwd_baggege_compt['weight']);
            $wardrobe_refreshment_cabinet_momentum = $this->wardrobe_refreshment_cabinet['weight'] * $this->wardrobe_refreshment_cabinet['arm'];
            array_push($this->momentum, $wardrobe_refreshment_cabinet_momentum);
            array_push($this->weights, $this->wardrobe_refreshment_cabinet['weight']);
            $lavatory_cabinet_momentum = $this->lavatory_cabinet['weight'] * $this->lavatory_cabinet['arm'];
            array_push($this->momentum, $lavatory_cabinet_momentum);
            array_push($this->weights, $this->lavatory_cabinet['weight']);
            $this->aft_baggage_compt['weight'] = $request->aft_baggage_compt_weight;
            $aft_baggage_compt_momentum = $this->aft_baggage_compt['weight'] * $this->aft_baggage_compt['arm'];
            array_push($this->momentum, $aft_baggage_compt_momentum);
            array_push($this->weights, (int) $this->aft_baggage_compt['weight']);
            if (isset($request->paxs)) {

                for ($i = 0; $i < $request->paxs; $i++) {
                    $this->paxs[$i]['weight'] = 165;
                    array_push($this->momentum, $this->paxs[$i]['weight'] * $this->paxs[$i]['arm']);
                    array_push($this->weights, $this->paxs[$i]['weight']);
                }
            }
            $total_zero_fuel = array(
                'weight' => array_sum($this->weights),
                'momentum' => array_sum($this->momentum),
                'arm' => (array_sum($this->momentum) / array_sum($this->weights))
            );
            $max_zero_fuel_weight = ($total_zero_fuel['arm'] - 209.64) * 100 / 64.57;
            $take_off_fuel_result_fuel_moment=DB::table('load_trim_vtavs')->where('fuel',$take_off_fuel_result)->first();
            $landing_fuel_result_fuel_moment=DB::table('load_trim_vtavs')->where('fuel',$landing_fuel_result)->first();
           $take_off_fuel = array(
                'weight' => $take_off_fuel_result,
                'arm' => ($take_off_fuel_result_fuel_moment->moment / $take_off_fuel_result),
                'momentum' => $take_off_fuel_result_fuel_moment->moment,
            );
            $total_take_off_weight = array(
                'weight' => $total_zero_fuel['weight'] + $take_off_fuel['weight'] + $mod,
                'arm' => ($total_zero_fuel['momentum'] + $take_off_fuel['momentum']) / ($total_zero_fuel['weight'] + $take_off_fuel['weight']),
                'momentum' => $total_zero_fuel['momentum'] + $take_off_fuel['momentum'],
            );
            $max_take_off_weight = ($total_take_off_weight['arm'] - 209.64) * 100 / 64.57;
            $landing_fuel = array(
                'weight' => $landing_fuel_result,
                'arm' => ($landing_fuel_result_fuel_moment->moment / $landing_fuel_result),
                'momentum' => $landing_fuel_result_fuel_moment->moment,
            );
            $total_landing_weight = array(
                'weight' => $total_zero_fuel['weight'] + $landing_fuel['weight'],
                'arm' => ($total_zero_fuel['momentum'] + $landing_fuel['momentum']) / ($total_zero_fuel['weight'] + $landing_fuel['weight']),
                'momentum' => $total_zero_fuel['momentum'] + $landing_fuel['momentum'],
            );
            $max_landing_weight = ($total_landing_weight['arm'] - 209.64) * 100 / 64.57;

            $data = array(
                'from' => $request->from,
                'to' => $request->to,
                'date' => $request->date,
                'pilot' => $request->pilot,
                'co_pilot' => $request->co_pilot,
                'empty_weight' => $this->empty_weight,
                'pilot_co_pilot' => $this->pilot_co_pilot,
                'fwd_baggege_compt' => $this->fwd_baggege_compt,
                'wardrobe_refreshment_cabinet' => $this->wardrobe_refreshment_cabinet,
                'lavatory_cabinet' => $this->lavatory_cabinet,
                'aft_baggage_compt' => $this->aft_baggage_compt,
                'paxs' => $this->paxs,
                'total_zero_fuel' => $total_zero_fuel,
                'max_zero_fuel_weight' => $max_zero_fuel_weight,
                'take_off_fuel' => $take_off_fuel,
                'total_take_off_weight' => $total_take_off_weight,
                'max_take_off_weight' => $max_take_off_weight,
                'landing_fuel' => $landing_fuel,
                'total_landing_weight' => $total_landing_weight,
                'max_landing_weight' => $max_landing_weight,
                'call_sign' => $request->callsign,
                'cargo' => $request->aft_baggage_compt_weight,
                'pax_no' => $request->paxs,
            );
             $request->session()->put('data', $data);
            if ($request->has('post')) 
            {  
                     $request->session()->flash('from', $request->from);
                     $request->session()->flash('to', $request->to);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pilot', $request->pilot);
                     $request->session()->flash('co_pilot', $request->co_pilot);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pax_no', $request->paxs);
                     $request->session()->flash('take_off_fuel', $request->take_off_fuel);
                     $request->session()->flash('landing_fuel', $request->landing_fuel);
                     $request->session()->flash('cargo', $request->aft_baggage_compt_weight);
                   $data['post'] =1;
                   if($total_landing_weight['weight']>$this->validation['vtavs']['Max_Landing_Weight'])
                   {
                     $message[]= "Landing Weight ".$total_landing_weight['weight']."  (Maximum Limit 9766)";  
                   }
                    if($total_take_off_weight['weight']>$this->validation['vtavs']['Max_Take_Off_Weight'])
                    {
                       $message[]= "Total Take Off Weight ".$total_take_off_weight['weight']." (Maximum Limit 10472)";  
                    }
                    if($total_zero_fuel['weight']>$this->validation['vtavs']['Max_Zero_Fuel_Weight'])
                    {
                      $message[]= 'Total Zero Fuel Weight '.$total_zero_fuel['weight'].'(Maximum Limit 8444)';
                    }
                    if($request->take_off_fuel>$this->validation['vtavs']['Take_Off_Fuel'])
                    { 
                      $message[]='Take Off Fuel '.$request->take_off_fuel.' (Maximum Limit 2750)'; 
                    }
                    if($total_landing_weight['weight']>$this->validation['vtavs']['Max_Landing_Weight']||$total_take_off_weight['weight']>$this->validation['vtavs']['Max_Take_Off_Weight']||$total_zero_fuel['weight']>$this->validation['vtavs']['Max_Zero_Fuel_Weight']|| $request->take_off_fuel>$this->validation['vtavs']['Take_Off_Fuel'])
                      return redirect('loadtrim/vtavs')->with('message',$message);    
                   return view('ltrim.store')->with($data);    
            }
            return view('ltrim.index')->with($data);
        } elseif ($callsign =='vtssf_old') {
            
            $this->empty_weight = array('weight' => 8428, 'arm' => 306.49);
            $this->pilot_co_pilot = array('weight' => 187, 'arm' => 167);
            $this->provisons = 201;
            $this->baggage_nose = array('arm' => 100, 'weight' => 0, 'mom' => 0);
            $this->baggage_aft_cabin = array('arm' => 330, 'weight' => 0, 'mom' => 0);
            $this->aft_fuselage_baggage_forward = array('arm' => 371);
            $this->aft_fuselage_baggage_aft = array('arm' => 413);
            $this->lessfuel_start = array('weight' => -91, 'mom' => -264);
            $this->pax = array(
                array(
                    'arm' => 230,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '380/177/51',
                ),
                array(
                    'arm' => 228,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '376/176/50',
                ),
                array(
                    'arm' => 281,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '464/216/62',
                ),
                array(
                    'arm' => 281,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '464/216/62',
                ),
                array(
                    'arm' => 309,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '510/238/68',
                ),
                array(
                    'arm' => 309,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '510/238/68',
                )
            );
            $take_off_fuel_val = ($request->take_off_fuel) + 91;
            $take_off_fuel_mod =0;
            $take_off_fuel_result = $take_off_fuel_val - $take_off_fuel_mod;
            $landing_fuel_val = $request->landing_fuel;
            $landing_fuel_mod = 0;
            $landing_fuel_result = $landing_fuel_val - $landing_fuel_mod;
            if ($landing_fuel_val > 3650)
                $landing_fuel_result = 3650;
            $pax_count = 0;
            $empty_weight_momentum = ($this->empty_weight['weight'] * $this->empty_weight['arm']) / 100;
            $this->empty_weight['mom'] = $empty_weight_momentum; //dd
            array_push($this->weights, $this->empty_weight['weight']);
            $pilot_co_pilot_momentum = ($this->pilot_co_pilot['weight'] * $this->pilot_co_pilot['arm']) / 100;
            $this->pilot_co_pilot['mom'] = $pilot_co_pilot_momentum;
            array_push($this->weights, $this->pilot_co_pilot['weight']);
            array_push($this->weights, $this->pilot_co_pilot['weight']);
            array_push($this->momentum, 26455);
            $empty_os = array('wt' => array_sum($this->weights), 'mom' => 26455);
            if($request->has('post'))
            {  
                    $aft_fuselage_baggage_forward_momentum = ($request->baggage_aft_cabin_fuselage_forward*$this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = $request->baggage_aft_cabin_fuselage_forward;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    array_push($this->weights,$request->baggage_aft_cabin_fuselage_forward);
                    $aft_fuselage_baggage_aft_momentum = ($request->baggage_aft_cabin_fuselage * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $request->baggage_aft_cabin_fuselage;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    array_push($this->weights,$request->baggage_aft_cabin_fuselage);
                   
                   $baggage_aft_cabin_momentum = ($request->baggage_aft_cabin * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = $request->baggage_aft_cabin;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                     array_push($this->weights, $request->baggage_aft_cabin);
                    $baggage_nose_momentum = ($request->baggage_nose * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = $request->baggage_nose;
                    array_push($this->momentum, $baggage_nose_momentum); 
                    array_push($this->weights, $request->baggage_nose);
            }
            else
            {
                array_push($this->weights, $request->aft_baggage_compt_weight);
                if (($request->aft_baggage_compt_weight == 20)||($request->aft_baggage_compt_weight>20 && $request->aft_baggage_compt_weight<40) ) 
                {
                    $baggage_fourth=$request->aft_baggage_compt_weight-10;
                    $aft_fuselage_baggage_forward_momentum = (10 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 10;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                }
                if ($request->aft_baggage_compt_weight == 40 ||($request->aft_baggage_compt_weight>40 && $request->aft_baggage_compt_weight<60)) 
                   {
                    $baggage_fourth=$request->aft_baggage_compt_weight-30;
                    $aft_fuselage_baggage_forward_momentum = (10 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 10;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (10 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 10;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (10 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 10;
                    array_push($this->momentum, $baggage_nose_momentum);
                }
                 
                if ($request->aft_baggage_compt_weight == 60 ||($request->aft_baggage_compt_weight>60 && $request->aft_baggage_compt_weight<80)) {
                     $baggage_fourth=$request->aft_baggage_compt_weight-40;
                    $aft_fuselage_baggage_forward_momentum = (20 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 20;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (10 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 10;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (10 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 10;
                    array_push($this->momentum, $baggage_nose_momentum);
                }
                if ($request->aft_baggage_compt_weight == 80 ||($request->aft_baggage_compt_weight>80 && $request->aft_baggage_compt_weight<100)) 
                   {
                    $baggage_fourth=$request->aft_baggage_compt_weight-50; 
                    $aft_fuselage_baggage_forward_momentum = (30 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 30;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (10 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 10;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (10 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 10;
                    array_push($this->momentum, $baggage_nose_momentum);
                }
                if ($request->aft_baggage_compt_weight == 100 ||($request->aft_baggage_compt_weight>100 && $request->aft_baggage_compt_weight<=120)) {
                    $baggage_fourth=$request->aft_baggage_compt_weight-70; 
                    $aft_fuselage_baggage_forward_momentum = (30 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 30;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (20 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 20;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (20 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 20;
                    array_push($this->momentum, $baggage_nose_momentum);
                 }   
            }    
            $p_weight = array();
            $p_weight_count = $request->paxs;  
             for ($j = 0; $j < $p_weight_count; $j++) {
                    $p_weight[] = 165;
                }
            if($request->has('post'))
            {
                   if(!empty($request->pax))
                   {
                         foreach($request->pax as $pax_key => $pax_value) 
                         {    
                              $mom = (165 * $this->pax[$pax_key]['arm']) / 100;
                              $this->pax[$pax_key]['calculate_mom'] = $mom;
                              $this->pax[$pax_key]['calculate_wt'] = 165;
                              array_push($this->momentum, $mom);
                              array_push($this->weights,165);
                         }
                   }
            }
            else
            {   
                if ($p_weight_count == 1) 
                {
                    $mom = ($p_weight[0] * $this->pax[3]['arm']) / 100;
                    $this->pax[3]['calculate_mom'] = $mom;
                    $this->pax[3]['calculate_wt'] = $p_weight[0];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[0]);
                }
                if ($p_weight_count == 2) {
                    $mom = ($p_weight[0] * $this->pax[2]['arm']) / 100;
                    $this->pax[2]['calculate_mom'] = $mom;
                    $this->pax[2]['calculate_wt'] = $p_weight[0];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[0]);

                    $mom = ($p_weight[1] * $this->pax[3]['arm']) / 100;
                    $this->pax[3]['calculate_mom'] = $mom;
                    $this->pax[3]['calculate_wt'] = $p_weight[1];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[1]);
                }
                if ($p_weight_count == 3) {
                    $mom = ($p_weight[0] * $this->pax[1]['arm']) / 100;
                    $this->pax[1]['calculate_mom'] = $mom;
                    $this->pax[1]['calculate_wt'] = $p_weight[0];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[0]);

                    $mom = ($p_weight[1] * $this->pax[2]['arm']) / 100;
                    $this->pax[2]['calculate_mom'] = $mom;
                    $this->pax[2]['calculate_wt'] = $p_weight[1];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[1]);

                    $mom = ($p_weight[2] * $this->pax[3]['arm']) / 100;
                    $this->pax[3]['calculate_mom'] = $mom;
                    $this->pax[3]['calculate_wt'] = $p_weight[2];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[2]);
                }
                if ($p_weight_count == 4 || $p_weight_count == 5 || $p_weight_count == 6) {
                    $i = 0;
                    foreach ($p_weight as $w_value) {
                        $mom = ($w_value * $this->pax[$i]['arm']) / 100;
                        $this->pax[$i]['calculate_mom'] = $mom;
                        $this->pax[$i]['calculate_wt'] = $w_value;
                        array_push($this->momentum, $mom);
                        array_push($this->weights, $w_value);
                        $i++;
                    }
                }
            }
            $total_zero_fuel = array(
                'weight' => array_sum($this->weights),
                'momentum' => array_sum($this->momentum),
                'arm' => sprintf('%.1f', (array_sum($this->momentum) / array_sum($this->weights)) * 100)
            );
            $take_off_fuel_result_fuel_moment=DB::table('load_trim_vtssf')->where('fuel',$take_off_fuel_result)->first();
            $landing_fuel_result_fuel_moment=DB::table('load_trim_vtssf')->where('fuel',$landing_fuel_result)->first();
            $take_off_fuel = array(
                'weight' => $take_off_fuel_result,
                'momentum' => $take_off_fuel_result_fuel_moment->moment,
            );
            $ramp_weight = array(
                'weight' => $total_zero_fuel['weight'] + $take_off_fuel['weight'],
                'momentum' => $total_zero_fuel['momentum'] + $take_off_fuel['momentum'],
            );
            $total_takeoff_weight = array(
                'weight' => $ramp_weight['weight'] + $this->lessfuel_start['weight'] +
                $take_off_fuel_mod,
                'momentum' => $ramp_weight['momentum'] + $this->lessfuel_start['mom'],
            );
            $total_takeoff_weight['arm'] = sprintf('%.1f', ($total_takeoff_weight['momentum'] / $total_takeoff_weight['weight']) * 100);
            $remaining_fuel = array(
                'weight' => $landing_fuel_result,
                'momentum' => $landing_fuel_result_fuel_moment->moment,
            );
            $total_landing_weight = array(
                'weight' => $total_zero_fuel['weight'] + $remaining_fuel['weight'] +
                $landing_fuel_mod,
                'momentum' => $total_zero_fuel['momentum'] + $remaining_fuel['momentum'],
            );

            $total_landing_weight['arm'] = sprintf('%.1f', ($total_landing_weight['momentum'] / $total_landing_weight['weight']) * 100);
            $data = array(
                'from' => $request->from,
                'to' => $request->to,
                'date' => $request->date,
                'pilot' => $request->pilot,
                'co_pilot' => $request->co_pilot,
                'empty_weight' => $this->empty_weight,
                'pilot_co_pilot' => $this->pilot_co_pilot,
                'provision' => $this->provisons,
                'baggage_nose' => $this->baggage_nose,
                'baggage_aft_cabin' => $this->baggage_aft_cabin,
                'aft_fuselage_baggage_forward' => $this->aft_fuselage_baggage_forward,
                'aft_fuselage_baggage_aft' => $this->aft_fuselage_baggage_aft,
                'paxs' => $this->pax,
                'zero_fuel_weight' => $total_zero_fuel,
                'ramp_weight' => $ramp_weight,
                'take_off_fuel' => $take_off_fuel,
                'less_fuel_start' => $this->lessfuel_start,
                'total_takeoff_weight' => $total_takeoff_weight,
                'remaining_fuel' => $remaining_fuel,
                'total_landing_weight' => $total_landing_weight,
                'empty_os' => $empty_os,
                'call_sign' => $request->callsign,
                'pax_no' => $request->paxs,
                'cargo' => $request->aft_baggage_compt_weight,
                't_off_fuel'=>$request->take_off_fuel,
                'pax_count' => $pax_count);
            $request->session()->put('data', $data);
             //dd($data);
            if ($request->has('post')) 
            {  
                $data['post'] =1;
                $request->session()->flash('from', $request->from);
                     $request->session()->flash('to', $request->to);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pilot', $request->pilot);
                     $request->session()->flash('co_pilot', $request->co_pilot);
                     if(array_key_exists("calculate_wt",$this->pax[0])) 
                      $request->session()->flash('pax0','checked');
                     if(array_key_exists("calculate_wt",$this->pax[1])) 
                      $request->session()->flash('pax1','checked');
                     if(array_key_exists("calculate_wt",$this->pax[2])) 
                      $request->session()->flash('pax2','checked');
                     if(array_key_exists("calculate_wt",$this->pax[3])) 
                      $request->session()->flash('pax3','checked');
                     if(array_key_exists("calculate_wt",$this->pax[4])) 
                      $request->session()->flash('pax4','checked');
                     if(array_key_exists("calculate_wt",$this->pax[5])) 
                         $request->session()->flash('pax5','checked');
                     $request->session()->flash('take_off_fuel', $request->take_off_fuel);
                     $request->session()->flash('landing_fuel', $request->landing_fuel);
                     $request->session()->flash('cargo', $request->aft_baggage_compt_weight);
                     $request->session()->flash('baggage_nose', $request->baggage_nose);
                     $request->session()->flash('baggage_aft_cabin', $request->baggage_aft_cabin);
                     $request->session()->flash('aft_fuselage_baggage_forward', $request->baggage_aft_cabin_fuselage_forward);
                   $request->session()->flash('aft_fuselage_baggage_aft', $request->baggage_aft_cabin_fuselage);

                    if($total_landing_weight['weight']>$this->validation['vtssf']['Max_Landing_Weight'])
                    {
                       $message[]= "Landing Weight ".$total_landing_weight['weight']."  (Maximum Limit 11600)";   
                    }
                    if($total_takeoff_weight['weight']>$this->validation['vtssf']['Max_Take_Off_Weight'])
                    {
                       $message[]= "Total Take Off Weight ".$total_takeoff_weight['weight']." (Maximum Limit 12500)";
                    }
                    if($total_zero_fuel['weight']>$this->validation['vtssf']['Max_Zero_Fuel_Weight'])
                    {
                       $message[]= 'Total Zero Fuel Weight '.$total_zero_fuel['weight'].'(Maximum Limit 10000)';
                    }
                    if($request->take_off_fuel>$this->validation['vtssf']['Take_Off_Fuel'])
                    {
                      $message[]='Take Off Fuel '.$request->take_off_fuel.' (Maximum Limit 3650)';
                    } 
                    if($total_landing_weight['weight']>$this->validation['vtssf']['Max_Landing_Weight']||$total_takeoff_weight['weight']>$this->validation['vtssf']['Max_Take_Off_Weight']||$total_zero_fuel['weight']>$this->validation['vtssf']['Max_Zero_Fuel_Weight']|| $request->take_off_fuel>$this->validation['vtssf']['Take_Off_Fuel'])
                        return redirect('loadtrim/vtssf_old')->with('message',$message); 

                return view('ltrim.vtssf_old.store')->with($data);    
            }
            else
            return view('ltrim.vtssf_old.show')->with($data);
        } 
        elseif ($callsign =='vtssf') {
           // dd("hii");
            //$this->empty_weight = array('weight' => 8428, 'arm' => 306.49);
            $this->empty_weight = array('weight' => 8412.67, 'arm' => 307.57);
            $this->pilot_co_pilot = array('weight' => 187, 'arm' => 167);
            $this->provisons = 201;
            $this->baggage_nose = array('arm' => 100, 'weight' => 0, 'mom' => 0);
            $this->baggage_aft_cabin = array('arm' => 330, 'weight' => 0, 'mom' => 0);
            $this->aft_fuselage_baggage_forward = array('arm' => 371);
            $this->aft_fuselage_baggage_aft = array('arm' => 413);
            $this->lessfuel_start = array('weight' => -91, 'mom' => -264);
            $this->pax = array(
                array(
                    'arm' => 230,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '380/177/51',
                ),
                array(
                    'arm' => 228,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '376/176/50',
                ),
                array(
                    'arm' => 281,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '464/216/62',
                ),
                array(
                    'arm' => 281,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '464/216/62',
                ),
                array(
                    'arm' => 309,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '510/238/68',
                ),
                array(
                    'arm' => 309,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '510/238/68',
                )
            );

            $take_off_fuel_val = ($request->take_off_fuel) + 91;
            $take_off_fuel_mod =0;
            $take_off_fuel_result = $take_off_fuel_val - $take_off_fuel_mod;
            $landing_fuel_val = $request->landing_fuel;
            $landing_fuel_mod = 0;
            $landing_fuel_result = $landing_fuel_val - $landing_fuel_mod;
            if ($landing_fuel_val > 3650)
                $landing_fuel_result = 3650;
            $pax_count = 0;
            $empty_weight_momentum = ($this->empty_weight['weight'] * $this->empty_weight['arm']) / 100;
            $this->empty_weight['mom'] = $empty_weight_momentum; //dd
            array_push($this->weights, $this->empty_weight['weight']);
            $pilot_co_pilot_momentum = ($this->pilot_co_pilot['weight'] * $this->pilot_co_pilot['arm']) / 100;
            $this->pilot_co_pilot['mom'] = $pilot_co_pilot_momentum;
            array_push($this->weights, $this->pilot_co_pilot['weight']);
            array_push($this->weights, $this->pilot_co_pilot['weight']);
            array_push($this->momentum, 26499);
            $empty_os = array('wt' => array_sum($this->weights), 'mom' => 26499);
            //array_push($this->momentum, 26455);
            //$empty_os = array('wt' => array_sum($this->weights), 'mom' => 26455);
                        
            if($request->has('post'))
            {                       
                   $aft_fuselage_baggage_forward_momentum = ($request->baggage_aft_cabin_fuselage_forward*$this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = $request->baggage_aft_cabin_fuselage_forward;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    array_push($this->weights,$request->baggage_aft_cabin_fuselage_forward);
                    $aft_fuselage_baggage_aft_momentum = ($request->baggage_aft_cabin_fuselage * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $request->baggage_aft_cabin_fuselage;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    array_push($this->weights,$request->baggage_aft_cabin_fuselage);
                   
                   $baggage_aft_cabin_momentum = ($request->baggage_aft_cabin * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = $request->baggage_aft_cabin;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                     array_push($this->weights, $request->baggage_aft_cabin);
                    $baggage_nose_momentum = ($request->baggage_nose * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = $request->baggage_nose;
                    array_push($this->momentum, $baggage_nose_momentum); 
                    array_push($this->weights, $request->baggage_nose);
            }
            else
            { 
                array_push($this->weights, $request->aft_baggage_compt_weight);
                if (($request->aft_baggage_compt_weight == 20)||($request->aft_baggage_compt_weight>20 && $request->aft_baggage_compt_weight<40) ) 
                {
                    $baggage_fourth=$request->aft_baggage_compt_weight-10;
                    $aft_fuselage_baggage_forward_momentum = (10 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 10;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                }
                if ($request->aft_baggage_compt_weight == 40 ||($request->aft_baggage_compt_weight>40 && $request->aft_baggage_compt_weight<60)) 
                   {
                    $baggage_fourth=$request->aft_baggage_compt_weight-30;
                    $aft_fuselage_baggage_forward_momentum = (10 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 10;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (10 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 10;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (10 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 10;
                    array_push($this->momentum, $baggage_nose_momentum);
                }
               
                if ($request->aft_baggage_compt_weight == 60 ||($request->aft_baggage_compt_weight>60 && $request->aft_baggage_compt_weight<80)) {
                     $baggage_fourth=$request->aft_baggage_compt_weight-40;
                    $aft_fuselage_baggage_forward_momentum = (20 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 20;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (10 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 10;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (10 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 10;
                    array_push($this->momentum, $baggage_nose_momentum);
                }
                if ($request->aft_baggage_compt_weight == 80 ||($request->aft_baggage_compt_weight>80 && $request->aft_baggage_compt_weight<100)) 
                   {
                    $baggage_fourth=$request->aft_baggage_compt_weight-50; 
                    $aft_fuselage_baggage_forward_momentum = (30 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 30;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (10 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 10;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (10 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 10;
                    array_push($this->momentum, $baggage_nose_momentum);
                }
                if ($request->aft_baggage_compt_weight == 100 ||($request->aft_baggage_compt_weight>100 && $request->aft_baggage_compt_weight<=120)) {
                    $baggage_fourth=$request->aft_baggage_compt_weight-70; 
                    $aft_fuselage_baggage_forward_momentum = (30 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 30;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (20 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 20;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (20 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 20;
                    array_push($this->momentum, $baggage_nose_momentum);
                 }   
            }    
           
            $p_weight = array();
            $p_weight_count = $request->paxs;  
             for ($j = 0; $j < $p_weight_count; $j++) {
                    $p_weight[] = 165;
                }
            if($request->has('post'))
            {
                   if(!empty($request->pax))
                   {
                         foreach($request->pax as $pax_key => $pax_value) 
                         {    
                             /*if($pax_key==2)
                              {
                                $mom = (175 * $this->pax[$pax_key]['arm']) / 100;
                                $this->pax[$pax_key]['calculate_mom'] = $mom;
                                $this->pax[$pax_key]['calculate_wt'] = 175;
                                array_push($this->momentum, $mom);
                                array_push($this->weights,175);
                              }
                              else{ */ 
                              $mom = (165 * $this->pax[$pax_key]['arm']) / 100;
                              $this->pax[$pax_key]['calculate_mom'] = $mom;
                              $this->pax[$pax_key]['calculate_wt'] = 165;
                              array_push($this->momentum, $mom);
                              array_push($this->weights,165);
                             //}
                         }
                   }
            }
            else
            {   
                if ($p_weight_count == 1) 
                {
                    $mom = ($p_weight[0] * $this->pax[3]['arm']) / 100;
                    $this->pax[3]['calculate_mom'] = $mom;
                    $this->pax[3]['calculate_wt'] = $p_weight[0];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[0]);
                }
                if ($p_weight_count == 2) {
                    $mom = ($p_weight[0] * $this->pax[2]['arm']) / 100;
                    $this->pax[2]['calculate_mom'] = $mom;
                    $this->pax[2]['calculate_wt'] = $p_weight[0];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[0]);

                    $mom = ($p_weight[1] * $this->pax[3]['arm']) / 100;
                    $this->pax[3]['calculate_mom'] = $mom;
                    $this->pax[3]['calculate_wt'] = $p_weight[1];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[1]);
                }
                if ($p_weight_count == 3) {
                    $mom = ($p_weight[0] * $this->pax[1]['arm']) / 100;
                    $this->pax[1]['calculate_mom'] = $mom;
                    $this->pax[1]['calculate_wt'] = $p_weight[0];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[0]);

                    $mom = ($p_weight[1] * $this->pax[2]['arm']) / 100;
                    $this->pax[2]['calculate_mom'] = $mom;
                    $this->pax[2]['calculate_wt'] = $p_weight[1];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[1]);

                    $mom = ($p_weight[2] * $this->pax[3]['arm']) / 100;
                    $this->pax[3]['calculate_mom'] = $mom;
                    $this->pax[3]['calculate_wt'] = $p_weight[2];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[2]);
                }
                if ($p_weight_count == 4 || $p_weight_count == 5 || $p_weight_count == 6) {
                    $i = 0;
                    foreach ($p_weight as $w_value) {
                        $mom = ($w_value * $this->pax[$i]['arm']) / 100;
                        $this->pax[$i]['calculate_mom'] = $mom;
                        $this->pax[$i]['calculate_wt'] = $w_value;
                        array_push($this->momentum, $mom);
                        array_push($this->weights, $w_value);
                        $i++;
                    }
                }
            }

            $total_zero_fuel = array(
                'weight' => array_sum($this->weights),
                'momentum' => array_sum($this->momentum),
                'arm' => sprintf('%.1f', (array_sum($this->momentum) / array_sum($this->weights)) * 100)
            );
            $take_off_fuel_result_fuel_moment=DB::table('load_trim_vtssf')->where('fuel',$take_off_fuel_result)->first();
            $landing_fuel_result_fuel_moment=DB::table('load_trim_vtssf')->where('fuel',$landing_fuel_result)->first();
            $take_off_fuel = array(
                'weight' => $take_off_fuel_result,
                'momentum' => $take_off_fuel_result_fuel_moment->moment,
            );
            $ramp_weight = array(
                'weight' => $total_zero_fuel['weight'] + $take_off_fuel['weight'],
                'momentum' => $total_zero_fuel['momentum'] + $take_off_fuel['momentum'],
            );

            $total_takeoff_weight = array(
                'weight' => $ramp_weight['weight'] + $this->lessfuel_start['weight'] +
                $take_off_fuel_mod,
                'momentum' => $ramp_weight['momentum'] + $this->lessfuel_start['mom'],
            );
            $total_takeoff_weight['arm'] = sprintf('%.1f', ($total_takeoff_weight['momentum'] / $total_takeoff_weight['weight']) * 100);

            $remaining_fuel = array(
                'weight' => $landing_fuel_result,
                'momentum' => $landing_fuel_result_fuel_moment->moment,
            );
            
            $total_landing_weight = array(
                'weight' => $total_zero_fuel['weight'] + $remaining_fuel['weight'] +
                $landing_fuel_mod,
                'momentum' => $total_zero_fuel['momentum'] + $remaining_fuel['momentum'],
            );
            
            $total_landing_weight['arm'] = sprintf('%.1f', ($total_landing_weight['momentum'] / $total_landing_weight['weight']) * 100);
            $data = array(
                'from' => $request->from,
                'to' => $request->to,
                'date' => $request->date,
                'pilot' => $request->pilot,
                'co_pilot' => $request->co_pilot,
                'empty_weight' => $this->empty_weight,
                'pilot_co_pilot' => $this->pilot_co_pilot,
                'provision' => $this->provisons,
                'baggage_nose' => $this->baggage_nose,
                'baggage_aft_cabin' => $this->baggage_aft_cabin,
                'aft_fuselage_baggage_forward' => $this->aft_fuselage_baggage_forward,
                'aft_fuselage_baggage_aft' => $this->aft_fuselage_baggage_aft,
                'paxs' => $this->pax,
                'zero_fuel_weight' => $total_zero_fuel,
                'ramp_weight' => $ramp_weight,
                'take_off_fuel' => $take_off_fuel,
                'less_fuel_start' => $this->lessfuel_start,
                'total_takeoff_weight' => $total_takeoff_weight,
                'remaining_fuel' => $remaining_fuel,
                'total_landing_weight' => $total_landing_weight,
                'empty_os' => $empty_os,
                'call_sign' => $request->callsign,
                'pax_no' => $request->paxs,
                'cargo' => $request->aft_baggage_compt_weight,
                't_off_fuel'=>$request->take_off_fuel,
                'pax_count' => $pax_count
               
              );
              $request->session()->put('data', $data);
  
            if ($request->has('post')) 
            {  
                $data['post'] =1;
                $request->session()->flash('from', $request->from);
                     $request->session()->flash('to', $request->to);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pilot', $request->pilot);
                     $request->session()->flash('co_pilot', $request->co_pilot);
                     if(array_key_exists("calculate_wt",$this->pax[0])) 
                      $request->session()->flash('pax0','checked');
                     if(array_key_exists("calculate_wt",$this->pax[1])) 
                      $request->session()->flash('pax1','checked');
                     if(array_key_exists("calculate_wt",$this->pax[2])) 
                      $request->session()->flash('pax2','checked');
                     if(array_key_exists("calculate_wt",$this->pax[3])) 
                      $request->session()->flash('pax3','checked');
                     if(array_key_exists("calculate_wt",$this->pax[4])) 
                      $request->session()->flash('pax4','checked');
                     if(array_key_exists("calculate_wt",$this->pax[5])) 
                         $request->session()->flash('pax5','checked');
                     $request->session()->flash('take_off_fuel', $request->take_off_fuel);
                     $request->session()->flash('landing_fuel', $request->landing_fuel);
                     $request->session()->flash('cargo', $request->aft_baggage_compt_weight);
                     $request->session()->flash('baggage_nose', $request->baggage_nose);
                     $request->session()->flash('baggage_aft_cabin', $request->baggage_aft_cabin);
                     $request->session()->flash('aft_fuselage_baggage_forward', $request->baggage_aft_cabin_fuselage_forward);
                   $request->session()->flash('aft_fuselage_baggage_aft', $request->baggage_aft_cabin_fuselage);

                    if($total_landing_weight['weight']>$this->validation['vtssf']['Max_Landing_Weight'])
                    {
                       $message[]= "Landing Weight ".$total_landing_weight['weight']."  (Maximum Limit 11600)";   
                    }
                    if($total_takeoff_weight['weight']>$this->validation['vtssf']['Max_Take_Off_Weight'])
                    {
                       $message[]= "Total Take Off Weight ".$total_takeoff_weight['weight']." (Maximum Limit 12500)";
                    }
                    if($total_zero_fuel['weight']>$this->validation['vtssf']['Max_Zero_Fuel_Weight'])
                    {
                       $message[]= 'Total Zero Fuel Weight '.$total_zero_fuel['weight'].'(Maximum Limit 10000)';
                    }
                    if($request->take_off_fuel>$this->validation['vtssf']['Take_Off_Fuel'])
                    {
                      $message[]='Take Off Fuel '.$request->take_off_fuel.' (Maximum Limit 3650)';
                    } 
                    if($total_landing_weight['weight']>$this->validation['vtssf']['Max_Landing_Weight']||$total_takeoff_weight['weight']>$this->validation['vtssf']['Max_Take_Off_Weight']||$total_zero_fuel['weight']>$this->validation['vtssf']['Max_Zero_Fuel_Weight']|| $request->take_off_fuel>$this->validation['vtssf']['Take_Off_Fuel'])
                        return redirect('loadtrim/vtssf')->with('message',$message); 

                return view('ltrim.vtssf.store')->with($data);    
            }
            else
            return view('ltrim.vtssf.show')->with($data);
        }
         elseif ($callsign =='vtfiu') {
            //var_dump($request->all());
            $this->empty_weight = array('weight' => 4668, 'arm' => 203.05,'mom'=>9478.37);
            $this->pilot_co_pilot = array('arm' => sprintf('%.2f',129.00), 'weight' => 85,'mom'=>109.65);
             array_push($this->weights, $this->empty_weight['weight']);
             array_push($this->momentum,$this->empty_weight['mom']);
             array_push($this->weights, $this->pilot_co_pilot['weight']);
             array_push($this->weights, $this->pilot_co_pilot['weight']);
             array_push($this->momentum,$this->pilot_co_pilot['mom']);
             $this->pax = array(
                array(
                    'arm' => sprintf('%.2f',167.00),
                    'weight' => 0, 
                    'mom' => 0
                ),
                array(
                    'arm' => sprintf('%.2f',216.00),
                    'weight' => 0, 
                    'mom' => 0
                ),
                array(
                    'arm' => sprintf('%.2f',216.00),
                    'weight' => 0, 
                    'mom' => 0
                ),
                array(
                    'arm' => sprintf('%.2f',294.00),
                    'weight' => 0, 
                    'mom' => 0
                )
            );
              $cargo= array('arm' => sprintf('%.2f',359.00), 'weight' => 0, 'mom' => 0);
              if(!empty($request->pax))
              {
                    foreach($request->pax as $pax_key => $pax_value) 
                    {    
                         $mom = (75 * $this->pax[$pax_key]['arm'])/100;
                         $this->pax[$pax_key]['mom'] =  sprintf('%.2f',$mom);
                         $this->pax[$pax_key]['weight'] = 75;
                         array_push($this->weights, 75);
                         array_push($this->momentum, $mom);
                    }
              }
              else{
                  for($i=0;$i<$request->paxs;$i++){
                    $mom = (75 * $this->pax[$i]['arm']) / 100;
                    $this->pax[$i]['mom'] =  sprintf('%.2f',$mom);
                    $this->pax[$i]['weight'] = 165;
                    array_push($this->weights, 165);
                    array_push($this->momentum, $mom);
                  }

              }
              $cabinet=100;
               //array_push($this->weights, $cabinet);
              if(!empty($request->cargo)){ 
                $cargo['weight'] =$request->cargo;
                $cargo['mom']=sprintf('%.2f',(($request->cargo*$cargo['arm'])/100));

                array_push($this->weights, $cargo['weight']);
                array_push($this->momentum,$cargo['mom']);
              }
              if($request->load){
                  $cargo['weight'] =$request->load-($request->paxs*75);
                  $cargo['mom']=sprintf('%.2f',(($cargo['weight']*$cargo['arm'])/100));

                  array_push($this->weights, $cargo['weight']);
                  array_push($this->momentum,$cargo['mom']);
              }
              //dd($this->weights);
              $payload=array('weight'=>array_sum($this->weights),'mom'=>array_sum($this->momentum));
              $zfw=array('weight'=>$payload['weight'],
                        'mom'=>sprintf('%.2f',$payload['mom']),
                        'arm'=>sprintf('%.2f',((($payload['mom'])*100)/($payload['weight']))),
                     );
              $tof_moment=DB::table('load_trim_vtfiu')->where('weight',$request->take_off_fuel)->first();
              $fuel_loading=array('weight'=>$request->take_off_fuel,'mom'=>$tof_moment->moment);
              $ramp_weight=array(
                   'weight'=>$zfw['weight']+$fuel_loading['weight'],
                   'mom'=>sprintf('%.2f',$fuel_loading['mom']+$zfw['mom']),

                 ); 
              $ramp_weight['arm']=sprintf('%.2f',($ramp_weight['mom']*100)/$ramp_weight['weight']);
              $lessfuel_taxing= array('weight' =>45 ,'mom'=>sprintf('%.2f',103));
              $tow=array(
               'weight'=>$ramp_weight['weight']-$lessfuel_taxing['weight'],
               'mom'=>sprintf('%.2f',$ramp_weight['mom']-$lessfuel_taxing['mom']),
               'arm'=>sprintf('%.2f',((($ramp_weight['mom']-$lessfuel_taxing['mom'])*100)/($ramp_weight['weight']-$lessfuel_taxing['weight'])))
              );
              $trim_landing_fuel=trim(preg_replace("/[^0-9]/", "", $request->landing_fuel));
              $trip_fuel_moment=DB::table('load_trim_vtfiu')->where('weight',$trim_landing_fuel)->first();
              $landing_fuel=array(
                   'weight'=>$trim_landing_fuel,
                   'mom'=>sprintf('%.2f',$trip_fuel_moment->moment)
                 );
              $landing=array(
                  'weight'=>$zfw['weight']+$landing_fuel['weight'],
                  'mom'=>sprintf('%.2f',$zfw['mom']+$landing_fuel['mom']),
                  'arm'=>sprintf('%.2f',((($zfw['mom']+$landing_fuel['mom'])*100)/($zfw['weight']+$landing_fuel['weight']))) 
                );
                $data = array(
                  'from' => $request->from,
                  'to' => $request->to,
                  'date' => $request->date,
                  'pilot' => $request->pilot,
                  'co_pilot' => $request->co_pilot,
                  'landing' =>$landing,
                  'tow' => $tow,  
                  'lessfuel_taxing' => $lessfuel_taxing,
                  'ramp_weight' => $ramp_weight,
                  'fuel_loading' => $fuel_loading,
                  'zfw' => $zfw,
                  'payload' => $payload,
                  'cargo' => $cargo,
                  'pax' => $this->pax,
                  'empty_weight' => $this->empty_weight,
                  'pilot_co_pilot' => $this->pilot_co_pilot,
                  'landing_fuel'=>$landing_fuel
                  ); 
                 if($landing['weight']>$this->validation['vtfiu']['Max_Landing_Weight'])
                 {
                    $message[]= "Landing Weight ".$landing['weight']."  (Maximum Limit 6804)";   
                 }
                 if($tow['weight']>$this->validation['vtfiu']['Max_Take_Off_Weight'])
                 {
                    $message[]= "Total Take Off Weight ".$tow['weight']." (Maximum Limit 6804)";
                 }
                 if($zfw['weight']>$this->validation['vtfiu']['Max_Zero_Fuel_Weight'])
                 {
                    $message[]= 'Total Zero Fuel Weight '.$zfw['weight'].'(Maximum Limit 5670)';
                 }
                 if($ramp_weight['weight']>$this->validation['vtfiu']['Max_Ramp_Weight'])
                 {
                    $message[]= 'Total Zero Fuel Weight '.$zfw['weight'].'(Maximum Limit 6849)';
                 }
                 if($landing['weight']>$this->validation['vtfiu']['Max_Landing_Weight']||$tow['weight']>$this->validation['vtfiu']['Max_Take_Off_Weight']||$zfw['weight']>$this->validation['vtfiu']['Max_Zero_Fuel_Weight']||$ramp_weight['weight']>$this->validation['vtfiu']['Max_Ramp_Weight']){
                     $request->session()->flash('vtfiu_data', $data);
                     return redirect('loadtrim/vtfiu')->with('message',$message); 
                 } 
                 $request->session()->put('data', $data);
                 //var_dump($data);
                 return view('ltrim.vtfiu.store')->with($data); 
         } 
        elseif ($callsign =='vtepu') {
            $this->empty_weight = array('weight' => 3989, 'arm' => 0,'mom'=>30766);
            $this->pilot_co_pilot = array('arm' => 0, 'weight' => 170,'mom'=>716);
            $this->pax = array(
                array(
                    'arm' => 9.08,
                    'weight' => 0, 
                    'mom' => 0
                ),
                array(
                    'arm' => 9.08,
                    'weight' => 0, 
                    'mom' => 0
                ),
                array(
                    'arm' => 9.87,
                    'weight' => 0, 
                    'mom' => 0
                ),
                array(
                    'arm' => 5.39,
                    'weight' => 0, 
                    'mom' => 0
                ),
                array(
                    'arm' => 6.79,
                    'weight' => 0, 
                    'mom' => 0
                ),
                array(
                    'arm' => 9.94,
                    'weight' => 0, 
                    'mom' => 0
                ),
                array(
                    'arm' => 7.65,
                    'weight' => 0, 
                    'mom' => 0
                )
            );
            $front_cargo= array('arm' => sprintf('%.2f',2.54), 'weight' => 0, 'mom' => 0);
            $rear_cargo= array('arm' => sprintf('%.2f',13.14), 'weight' => 0, 'mom' => 0);
            if(!empty($request->pax))
            {
                  foreach($request->pax as $pax_key => $pax_value) 
                  {    
                       $mom = (75 * $this->pax[$pax_key]['arm']);
                       $this->pax[$pax_key]['mom'] =  sprintf('%.0f',$mom);
                       $this->pax[$pax_key]['weight'] = 75;
                       array_push($this->weights, 75);
                       array_push($this->momentum, $mom);
                  }
            }
            else{
                for($i=0;$i<$request->paxs;$i++){
                  $mom = (75 * $this->pax[$i]['arm']) / 100;
                  $this->pax[$i]['mom'] =  sprintf('%.2f',$mom);
                  $this->pax[$i]['weight'] = 75;
                  array_push($this->weights, 75);
                  array_push($this->momentum, $mom);
                }

            }
            
            if(!empty($request->front_cargo)){
              $front_cargo_moment=DB::table('load_trim_vtepu_front_baggage')->where('weight',$request->front_cargo)->first();  
              $front_cargo['weight'] =$request->front_cargo;
              $front_cargo['mom']=sprintf('%.0f',$front_cargo_moment->moment);
              array_push($this->weights, $front_cargo['weight']);
              array_push($this->momentum,$front_cargo['mom']);
            }
            
            if(!empty($request->rear_cargo)){
              $rear_cargo_moment=DB::table('load_trim_vtepu_rear_baggage')->where('weight',$request->rear_cargo)->first();  
              $rear_cargo['weight'] =$request->rear_cargo;
              $rear_cargo['mom']=sprintf('%.0f',$rear_cargo_moment->moment);
              array_push($this->weights, $rear_cargo['weight']);
              array_push($this->momentum,$rear_cargo['mom']);
            }
            // if($request->load){
            //     $total_cargo =$request->load-($request->paxs*75);
            //     $front__cargo=($total_cargo/2);
            //     $rear__cargo=($total_cargo/2);
            //     echo $front__cargo;
            //     $front_cargo_moment=DB::table('load_trim_vtepu_front_baggage')->where('weight',$front__cargo)->first();  
            //     dd($front_cargo_moment);
            //     $front_cargo['weight'] =$front__cargo;
            //     $front_cargo['mom']=sprintf('%.0f',$front_cargo_moment->moment);
            //     array_push($this->weights, $front_cargo['weight']);
            //     array_push($this->momentum,$front_cargo['mom']);
            //    dd($front_cargo); 
            //     $rear_cargo_moment=DB::table('load_trim_vtepu_rear_baggage')->where('weight',$rear__cargo)->first();  
            //     $rear_cargo['weight'] =$rear__cargo;
            //     $rear_cargo['mom']=sprintf('%.0f',$rear_cargo_moment->moment);
            //     array_push($this->weights, $rear_cargo['weight']);
            //     array_push($this->momentum,$rear_cargo['mom']);

            //   }

            $payload=array('weight'=>array_sum($this->weights),'mom'=>array_sum($this->momentum));
            $zfw=array('weight'=>$payload['weight']+$this->empty_weight['weight']+$this->pilot_co_pilot['weight'],
                        'mom'=>sprintf('%.0f',$payload['mom']+$this->empty_weight['mom']+$this->pilot_co_pilot['mom']),
                        'arm'=>sprintf('%.2f',((($payload['mom']+$this->empty_weight['mom']+$this->pilot_co_pilot['mom'])*100)/($payload['weight']+$this->empty_weight['weight']+$this->pilot_co_pilot['weight']))),
                     );
            $zfw['mac']=sprintf('%.2f',(($zfw['arm']-726)/2.046));
            $tof_moment=DB::table('load_trim_vtepu')->where('weight',$request->take_off_fuel)->first();
            $fuel_loading=array('weight'=>$request->take_off_fuel,'mom'=>$tof_moment->moment);
            $ramp_weight=array(
                 'weight'=>$zfw['weight']+$fuel_loading['weight'],
                 'mom'=>sprintf('%.0f',$fuel_loading['mom']+$zfw['mom'])
               ); 
            $lessfuel_taxing= array('weight' =>-30 ,'mom'=>-240);
            $tow=array(
               'weight'=>$ramp_weight['weight']+$lessfuel_taxing['weight'],
               'mom'=>sprintf('%.0f',$ramp_weight['mom']+$lessfuel_taxing['mom']),
               'arm'=>sprintf('%.2f',((($ramp_weight['mom']+$lessfuel_taxing['mom'])*100)/($ramp_weight['weight']+$lessfuel_taxing['weight'])))
           );  
           $tow['mac']=sprintf('%.2f',(($tow['arm']-726)/2.046)); 
           $trim_trip_fuel=trim(preg_replace("/[^0-9]/", "", $request->trip_fuel));
           $trip_fuel_moment=DB::table('load_trim_vtepu')->where('weight',$trim_trip_fuel)->first();
           $lessfuel_dest=array(
                'weight'=>$trim_trip_fuel,
                'mom'=>sprintf('%.0f',$trip_fuel_moment->moment)
              );
           $landing=array(
               'weight'=>$tow['weight']-$lessfuel_dest['weight'],
               'mom'=>sprintf('%.0f',$tow['mom']-$lessfuel_dest['mom']),
               'arm'=>sprintf('%.2f',((($tow['mom']-$lessfuel_dest['mom'])*100)/($tow['weight']-$lessfuel_dest['weight']))) 
             );
            $landing['mac']=sprintf('%.2f',(($landing['arm']-726)/2.046));
            $data = array(
              'from' => $request->from,
              'to' => $request->to,
              'date' => $request->date,
              'pilot' => $request->pilot,
              'co_pilot' => $request->co_pilot,
              'landing' =>$landing,
              'lessfuel_dest' =>$lessfuel_dest,
              'tow' => $tow,  
              'lessfuel_taxing' => $lessfuel_taxing,
              'ramp_weight' => $ramp_weight,
              'fuel_loading' => $fuel_loading,
              'zfw' => $zfw,
              'payload' => $payload,
              'front_cargo' => $front_cargo,
              'rear_cargo' => $rear_cargo,
              'pax' => $this->pax,
              'empty_weight' => $this->empty_weight,
              'pilot_co_pilot' => $this->pilot_co_pilot,
              );

             //$request->session()->flash('data', $data);
             if($landing['weight']>$this->validation['vtepu']['Max_Landing_Weight'])
             {
                $message[]= "Landing Weight ".$landing['weight']."  (Maximum Limit 5980)";   
             }
             if($tow['weight']>$this->validation['vtepu']['Max_Take_Off_Weight'])
             {
                $message[]= "Total Take Off Weight ".$tow['weight']." (Maximum Limit 5980)";
             }
             if($zfw['weight']>$this->validation['vtepu']['Max_Zero_Fuel_Weight'])
             {
                $message[]= 'Total Zero Fuel Weight '.$zfw['weight'].'(Maximum Limit 5590)';
             }
             if($ramp_weight['weight']>$this->validation['vtepu']['Max_Ramp_Weight'])
             {
                $message[]= 'Total Zero Fuel Weight '.$zfw['weight'].'(Maximum Limit 6010)';
             }
             if($landing['weight']>$this->validation['vtepu']['Max_Landing_Weight']||$tow['weight']>$this->validation['vtepu']['Max_Take_Off_Weight']||$zfw['weight']>$this->validation['vtepu']['Max_Zero_Fuel_Weight']||$ramp_weight['weight']>$this->validation['vtepu']['Max_Ramp_Weight']){
                 $request->session()->flash('vtepu_data', $data);
                 return redirect('loadtrim/vtepu')->with('message',$message); 
             }
             $request->session()->put('data', $data);
             return view('ltrim.vtepu.store')->with($data);
         }   
        elseif ($callsign =='vtbsl_new') {
          $this->empty_weight = array('weight' => 12580.32, 'arm' => sprintf('%.2f',336.10),'mom'=>42282.45);
          $this->pilot_co_pilot = array('arm' => 136.32, 'weight' => 187,'mom'=>254.92);
          array_push($this->weights, $this->pilot_co_pilot['weight']);
          array_push($this->momentum,$this->pilot_co_pilot['mom']);
          array_push($this->weights, $this->pilot_co_pilot['weight']);
          array_push($this->momentum,$this->pilot_co_pilot['mom']);
          $this->pax = array(
              array(
                  'arm' => sprintf('%.2f',205.60),
                  'weight' => 0, 
                  'mom' => 0
              ),
              array(
                  'arm' => 234.39,
                  'weight' => 0, 
                  'mom' => 0
              ),
              array(
                  'arm' => 234.39,
                  'weight' => 0, 
                  'mom' => 0
              ),
              array(
                  'arm' => 286.54,
                  'weight' => 0, 
                  'mom' => 0
              ),
              array(
                  'arm' => 286.54,
                  'weight' => 0, 
                  'mom' => 0
              ),
              array(
                  'arm' => 322.62,
                  'weight' => 0, 
                  'mom' => 0
              ),
              array(
                  'arm' => 322.62,
                  'weight' => 0, 
                  'mom' => 0
              ),
              array(
                  'arm' => 357.99,
                  'weight' => 0, 
                  'mom' => 0
              ),
          );
          $this->baggage_nose = array('arm' => sprintf('%.2f',431), 'weight' => 0, 'mom' => 0);
          $refreshment_center = array('arm' => sprintf('%.2f',172.30), 'weight' => 100, 'mom' => sprintf('%.2f',172.30));
         // array_push($this->weights, $refreshment_center['weight']);
          //array_push($this->momentum,$refreshment_center['mom']);

          if(!empty($request->pax))
          {
                foreach($request->pax as $pax_key => $pax_value) 
                {    
                     $mom = (165 * $this->pax[$pax_key]['arm']) / 100;
                     $this->pax[$pax_key]['mom'] =  sprintf('%.2f',$mom);
                     $this->pax[$pax_key]['weight'] = 165;
                     array_push($this->weights, 165);
                     array_push($this->momentum, $mom);
                }
          }
          else{
              for($i=0;$i<$request->paxs;$i++){
                $mom = (165 * $this->pax[$i]['arm']) / 100;
                $this->pax[$i]['mom'] =  sprintf('%.2f',$mom);
                $this->pax[$i]['weight'] = 165;
                array_push($this->weights, 165);
                array_push($this->momentum, $mom);
              }

          }
          if(!empty($request->cargo)){
              if(isset($request->pax))
                $pax_count=count($request->pax);
              else      
                $pax_count=0;
              if($pax_count==0)
                $this->baggage_nose['mom']=0;
               else 
              $this->baggage_nose['mom'] = sprintf('%.2f',((count($request->pax)*25 * $this->baggage_nose['arm']) / 100));
              // $this->baggage_nose['weight'] = $request->cargo;
              $this->baggage_nose['weight'] =$pax_count*25;
              array_push($this->weights, $this->baggage_nose['weight']);
              array_push($this->momentum, $this->baggage_nose['mom']);
             
              $refreshment_center['weight']=$request->cargo;
              $refreshment_center['mom']=sprintf('%.2f',(($refreshment_center['weight'] * $refreshment_center['arm']) / 100));
              // dd($refreshment_center['weight']);
              array_push($this->weights, $refreshment_center['weight']);
              array_push($this->momentum,$refreshment_center['mom']);
          }

          if(!empty($request->load)){
            // $cargo=($request->load)-(($request->paxs*165)+374+100);
             $cargo=$request->paxs*25;
             $refreshment_center['weight']=($request->load)-(($request->paxs*165)+374+$cargo);
             $refreshment_center['mom']=sprintf('%.2f',(($refreshment_center['weight'] * $refreshment_center['arm']) / 100));
             array_push($this->weights, $refreshment_center['weight']);
             array_push($this->momentum,$refreshment_center['mom']);
             $this->baggage_nose['mom'] = sprintf('%.2f',(($cargo * $this->baggage_nose['arm']) / 100));
             $this->baggage_nose['weight'] = $cargo;

             array_push($this->weights, $cargo);
             array_push($this->momentum, $this->baggage_nose['mom']);
          }
          $payload=array('arm' =>0, 'weight' =>array_sum($this->weights), 'mom' => sprintf('%.2f',array_sum($this->momentum)));
          $zfw=array('weight'=>$payload['weight']+$this->empty_weight['weight'],
                     'mom'=>sprintf('%.2f',$payload['mom']+$this->empty_weight['mom']),
                     'arm'=>sprintf('%.2f',((($payload['mom']+$this->empty_weight['mom'])*100)/($payload['weight']+$this->empty_weight['weight'])))
                    );
          $tof_moment=DB::table('load_trim_vtbsl')->where('weight',$request->take_off_fuel)->first();
          
          $fuel_loading=array('weight'=>$request->take_off_fuel,'mom'=>$tof_moment->moment);
          
          $ramp_weight=array(
               'weight'=>$zfw['weight']+$fuel_loading['weight'],
               'mom'=>sprintf('%.2f',$fuel_loading['mom']+$zfw['mom']),
               'arm'=>sprintf('%.2f',((($fuel_loading['mom']+$zfw['mom'])*100)/($zfw['weight']+$fuel_loading['weight'])))
             ); 
          
          $lessfuel_taxing= array('weight' =>200 ,'mom'=>695.02);
          
          $tow=array(
               'weight'=>$ramp_weight['weight']-$lessfuel_taxing['weight'],
               'mom'=>sprintf('%.2f',$ramp_weight['mom']-$lessfuel_taxing['mom']),
               'arm'=>sprintf('%.2f',((($ramp_weight['mom']-$lessfuel_taxing['mom'])*100)/($ramp_weight['weight']-$lessfuel_taxing['weight'])))
           );  
          $trim_trip_fuel=trim(preg_replace("/[^0-9]/", "", $request->trip_fuel));
          $landing_fuel_moment=DB::table('load_trim_vtbsl')->where('weight',$trim_trip_fuel)->first();
          $lessfuel_dest=array(
                // 'weight'=>trim($request->trip_fuel),
                'weight'=>$trim_trip_fuel,
                'mom'=>sprintf('%.2f',$landing_fuel_moment->moment));
      //dd($request->all());
       
          $landing=array(
               'weight'=>$tow['weight']-$lessfuel_dest['weight'],
               'mom'=>sprintf('%.2f',$tow['mom']-$lessfuel_dest['mom']),
               'arm'=>sprintf('%.2f',((($tow['mom']-$lessfuel_dest['mom'])*100)/($tow['weight']-$lessfuel_dest['weight']))) 
             );
          
           $cg_percent_mac=sprintf('%.2f',($tow['arm']-306.59)/0.8224);

          $data = array(
              'from' => $request->from,
              'to' => $request->to,
              'date' => $request->date,
              'pilot' => $request->pilot,
              'co_pilot' => $request->co_pilot,
              'landing' =>$landing,
              'lessfuel_dest' =>$lessfuel_dest,
              'tow' => $tow,  
              'lessfuel_taxing' => $lessfuel_taxing,
              'ramp_weight' => $ramp_weight,
              'fuel_loading' => $fuel_loading,
              'zfw' => $zfw,
              'payload' => $payload,
              'cargo' => $this->baggage_nose,
              'pax' => $this->pax,
              'refreshment_center' => $refreshment_center,
              'empty_weight' => $this->empty_weight,
              'pilot_co_pilot' => $this->pilot_co_pilot,
              'cg_percent_mac'=>$cg_percent_mac
              );
          //$request->session()->flash('data', $data);
          if($landing['weight']>$this->validation['vtbsl']['Max_Landing_Weight'])
          {
             $message[]= "Landing Weight ".$landing['weight']."  (Maximum Limit 18700)";   
          }
          if($tow['weight']>$this->validation['vtbsl']['Max_Take_Off_Weight'])
          {
             $message[]= "Total Take Off Weight ".$tow['weight']." (Maximum Limit 12500)";
          }
          if($zfw['weight']>$this->validation['vtbsl']['Max_Zero_Fuel_Weight'])
          {
             $message[]= 'Total Zero Fuel Weight '.$zfw['weight'].'(Maximum Limit 15100)';
          }
          if($landing['weight']>$this->validation['vtbsl']['Max_Landing_Weight']||$tow['weight']>$this->validation['vtbsl']['Max_Take_Off_Weight']||$zfw['weight']>$this->validation['vtbsl']['Max_Zero_Fuel_Weight']){
              $request->session()->flash('vtbsl_data', $data);
              return redirect('loadtrim/vtbsl_new')->with('message',$message); 
          }
          $request->session()->put('data', $data);
          return view('ltrim.vtbsl_new.store')->with($data);
        }   
        elseif ($callsign =='vtkbn') {
            
            $this->empty_weight = array('weight' => 8428, 'arm' => 306.49);
            $this->pilot_co_pilot = array('weight' => 187, 'arm' => 167);
            $this->provisons = 201;
            $this->baggage_nose = array('arm' => 100, 'weight' => 0, 'mom' => 0);
            $this->baggage_aft_cabin = array('arm' => 330, 'weight' => 0, 'mom' => 0);
            $this->aft_fuselage_baggage_forward = array('arm' => 371);
            $this->aft_fuselage_baggage_aft = array('arm' => 413);
            $this->lessfuel_start = array('weight' => -91, 'mom' => -264);
            $this->pax = array(
                array(
                    'arm' => 230,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '380/177/51',
                ),
                array(
                    'arm' => 228,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '376/176/50',
                ),
                array(
                    'arm' => 281,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '464/216/62',
                ),
                array(
                    'arm' => 281,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '464/216/62',
                ),
                array(
                    'arm' => 309,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '510/238/68',
                ),
                array(
                    'arm' => 309,
                    'show_off_weight' => '165/77/22',
                    'show_off_mom' => '510/238/68',
                )
            );

            $take_off_fuel_val = ($request->take_off_fuel) + 91;
            $take_off_fuel_mod =0;
            $take_off_fuel_result = $take_off_fuel_val - $take_off_fuel_mod;
            $landing_fuel_val = $request->landing_fuel;
            $landing_fuel_mod = 0;
            $landing_fuel_result = $landing_fuel_val - $landing_fuel_mod;
            if ($landing_fuel_val > 3650)
                $landing_fuel_result = 3650;
            $pax_count = 0;
            $empty_weight_momentum = ($this->empty_weight['weight'] * $this->empty_weight['arm']) / 100;
            $this->empty_weight['mom'] = $empty_weight_momentum; //dd
            array_push($this->weights, $this->empty_weight['weight']);
            $pilot_co_pilot_momentum = ($this->pilot_co_pilot['weight'] * $this->pilot_co_pilot['arm']) / 100;
            $this->pilot_co_pilot['mom'] = $pilot_co_pilot_momentum;
            array_push($this->weights, $this->pilot_co_pilot['weight']);
            array_push($this->weights, $this->pilot_co_pilot['weight']);
            array_push($this->momentum, 26455);
            $empty_os = array('wt' => array_sum($this->weights), 'mom' => 26455);
            
            if($request->has('post'))
            {                       
                   $aft_fuselage_baggage_forward_momentum = ($request->baggage_aft_cabin_fuselage_forward*$this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = $request->baggage_aft_cabin_fuselage_forward;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    array_push($this->weights,$request->baggage_aft_cabin_fuselage_forward);
                    $aft_fuselage_baggage_aft_momentum = ($request->baggage_aft_cabin_fuselage * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $request->baggage_aft_cabin_fuselage;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    array_push($this->weights,$request->baggage_aft_cabin_fuselage);
                   
                   $baggage_aft_cabin_momentum = ($request->baggage_aft_cabin * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = $request->baggage_aft_cabin;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                     array_push($this->weights, $request->baggage_aft_cabin);
                    $baggage_nose_momentum = ($request->baggage_nose * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = $request->baggage_nose;
                    array_push($this->momentum, $baggage_nose_momentum); 
                    array_push($this->weights, $request->baggage_nose);
            }
            else
            { 
                array_push($this->weights, $request->aft_baggage_compt_weight);
                if (($request->aft_baggage_compt_weight == 20)||($request->aft_baggage_compt_weight>20 && $request->aft_baggage_compt_weight<40) ) 
                {
                    $baggage_fourth=$request->aft_baggage_compt_weight-10;
                    $aft_fuselage_baggage_forward_momentum = (10 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 10;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                }
                if ($request->aft_baggage_compt_weight == 40 ||($request->aft_baggage_compt_weight>40 && $request->aft_baggage_compt_weight<60)) 
                   {
                    $baggage_fourth=$request->aft_baggage_compt_weight-30;
                    $aft_fuselage_baggage_forward_momentum = (10 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 10;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (10 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 10;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (10 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 10;
                    array_push($this->momentum, $baggage_nose_momentum);
                }
               
                if ($request->aft_baggage_compt_weight == 60 ||($request->aft_baggage_compt_weight>60 && $request->aft_baggage_compt_weight<80)) {
                     $baggage_fourth=$request->aft_baggage_compt_weight-40;
                    $aft_fuselage_baggage_forward_momentum = (20 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 20;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (10 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 10;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (10 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 10;
                    array_push($this->momentum, $baggage_nose_momentum);
                }
                if ($request->aft_baggage_compt_weight == 80 ||($request->aft_baggage_compt_weight>80 && $request->aft_baggage_compt_weight<100)) 
                   {
                    $baggage_fourth=$request->aft_baggage_compt_weight-50; 
                    $aft_fuselage_baggage_forward_momentum = (30 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 30;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (10 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 10;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (10 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 10;
                    array_push($this->momentum, $baggage_nose_momentum);
                }
                if ($request->aft_baggage_compt_weight == 100 ||($request->aft_baggage_compt_weight>100 && $request->aft_baggage_compt_weight<=120)) {
                    $baggage_fourth=$request->aft_baggage_compt_weight-70; 
                    $aft_fuselage_baggage_forward_momentum = (30 * $this->aft_fuselage_baggage_forward['arm']) / 100;
                    $this->aft_fuselage_baggage_forward['mom'] = $aft_fuselage_baggage_forward_momentum;
                    $this->aft_fuselage_baggage_forward['weight'] = 30;
                    array_push($this->momentum, $aft_fuselage_baggage_forward_momentum);
                    $aft_fuselage_baggage_aft_momentum = ($baggage_fourth * $this->aft_fuselage_baggage_aft['arm']) / 100;
                    $this->aft_fuselage_baggage_aft['mom'] = $aft_fuselage_baggage_aft_momentum;
                    $this->aft_fuselage_baggage_aft['weight'] = $baggage_fourth;
                    array_push($this->momentum, $aft_fuselage_baggage_aft_momentum);
                    $baggage_aft_cabin_momentum = (20 * $this->baggage_aft_cabin['arm']) / 100;
                    $this->baggage_aft_cabin['mom'] = $baggage_aft_cabin_momentum;
                    $this->baggage_aft_cabin['weight'] = 20;
                    array_push($this->momentum, $baggage_aft_cabin_momentum);
                    $baggage_nose_momentum = (20 * $this->baggage_nose['arm']) / 100;
                    $this->baggage_nose['mom'] = $baggage_nose_momentum;
                    $this->baggage_nose['weight'] = 20;
                    array_push($this->momentum, $baggage_nose_momentum);
                 }   
            }    
           
            $p_weight = array();
            $p_weight_count = $request->paxs;  
             for ($j = 0; $j < $p_weight_count; $j++) {
                    $p_weight[] = 165;
                }
            if($request->has('post'))
            {
                   if(!empty($request->pax))
                   {
                         foreach($request->pax as $pax_key => $pax_value) 
                         {    
                              $mom = (165 * $this->pax[$pax_key]['arm']) / 100;
                              $this->pax[$pax_key]['calculate_mom'] = $mom;
                              $this->pax[$pax_key]['calculate_wt'] = 165;
                              array_push($this->momentum, $mom);
                              array_push($this->weights,165);
                         }
                   }
            }
            else
            {   
                if ($p_weight_count == 1) 
                {
                    $mom = ($p_weight[0] * $this->pax[3]['arm']) / 100;
                    $this->pax[3]['calculate_mom'] = $mom;
                    $this->pax[3]['calculate_wt'] = $p_weight[0];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[0]);
                }
                if ($p_weight_count == 2) {
                    $mom = ($p_weight[0] * $this->pax[2]['arm']) / 100;
                    $this->pax[2]['calculate_mom'] = $mom;
                    $this->pax[2]['calculate_wt'] = $p_weight[0];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[0]);

                    $mom = ($p_weight[1] * $this->pax[3]['arm']) / 100;
                    $this->pax[3]['calculate_mom'] = $mom;
                    $this->pax[3]['calculate_wt'] = $p_weight[1];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[1]);
                }
                if ($p_weight_count == 3) {
                    $mom = ($p_weight[0] * $this->pax[1]['arm']) / 100;
                    $this->pax[1]['calculate_mom'] = $mom;
                    $this->pax[1]['calculate_wt'] = $p_weight[0];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[0]);

                    $mom = ($p_weight[1] * $this->pax[2]['arm']) / 100;
                    $this->pax[2]['calculate_mom'] = $mom;
                    $this->pax[2]['calculate_wt'] = $p_weight[1];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[1]);

                    $mom = ($p_weight[2] * $this->pax[3]['arm']) / 100;
                    $this->pax[3]['calculate_mom'] = $mom;
                    $this->pax[3]['calculate_wt'] = $p_weight[2];
                    array_push($this->momentum, $mom);
                    array_push($this->weights, $p_weight[2]);
                }
                if ($p_weight_count == 4 || $p_weight_count == 5 || $p_weight_count == 6) {
                    $i = 0;
                    foreach ($p_weight as $w_value) {
                        $mom = ($w_value * $this->pax[$i]['arm']) / 100;
                        $this->pax[$i]['calculate_mom'] = $mom;
                        $this->pax[$i]['calculate_wt'] = $w_value;
                        array_push($this->momentum, $mom);
                        array_push($this->weights, $w_value);
                        $i++;
                    }
                }
            }

            $total_zero_fuel = array(
                'weight' => array_sum($this->weights),
                'momentum' => array_sum($this->momentum),
                'arm' => sprintf('%.1f', (array_sum($this->momentum) / array_sum($this->weights)) * 100)
            );
            $take_off_fuel_result_fuel_moment=DB::table('load_trim_vtssf')->where('fuel',$take_off_fuel_result)->first();
            $landing_fuel_result_fuel_moment=DB::table('load_trim_vtssf')->where('fuel',$landing_fuel_result)->first();
            $take_off_fuel = array(
                'weight' => $take_off_fuel_result,
                'momentum' => $take_off_fuel_result_fuel_moment->moment,
            );
            $ramp_weight = array(
                'weight' => $total_zero_fuel['weight'] + $take_off_fuel['weight'],
                'momentum' => $total_zero_fuel['momentum'] + $take_off_fuel['momentum'],
            );

            $total_takeoff_weight = array(
                'weight' => $ramp_weight['weight'] + $this->lessfuel_start['weight'] +
                $take_off_fuel_mod,
                'momentum' => $ramp_weight['momentum'] + $this->lessfuel_start['mom'],
            );
            $total_takeoff_weight['arm'] = sprintf('%.1f', ($total_takeoff_weight['momentum'] / $total_takeoff_weight['weight']) * 100);

            $remaining_fuel = array(
                'weight' => $landing_fuel_result,
                'momentum' => $landing_fuel_result_fuel_moment->moment,
            );
            
            $total_landing_weight = array(
                'weight' => $total_zero_fuel['weight'] + $remaining_fuel['weight'] +
                $landing_fuel_mod,
                'momentum' => $total_zero_fuel['momentum'] + $remaining_fuel['momentum'],
            );

            $total_landing_weight['arm'] = sprintf('%.1f', ($total_landing_weight['momentum'] / $total_landing_weight['weight']) * 100);

            $data = array(
                'from' => $request->from,
                'to' => $request->to,
                'date' => $request->date,
                'pilot' => $request->pilot,
                'co_pilot' => $request->co_pilot,
                'empty_weight' => $this->empty_weight,
                'pilot_co_pilot' => $this->pilot_co_pilot,
                'provision' => $this->provisons,
                'baggage_nose' => $this->baggage_nose,
                'baggage_aft_cabin' => $this->baggage_aft_cabin,
                'aft_fuselage_baggage_forward' => $this->aft_fuselage_baggage_forward,
                'aft_fuselage_baggage_aft' => $this->aft_fuselage_baggage_aft,
                'paxs' => $this->pax,
                'zero_fuel_weight' => $total_zero_fuel,
                'ramp_weight' => $ramp_weight,
                'take_off_fuel' => $take_off_fuel,
                'less_fuel_start' => $this->lessfuel_start,
                'total_takeoff_weight' => $total_takeoff_weight,
                'remaining_fuel' => $remaining_fuel,
                'total_landing_weight' => $total_landing_weight,
                'empty_os' => $empty_os,
                'call_sign' => $request->callsign,
                'pax_no' => $request->paxs,
                'cargo' => $request->aft_baggage_compt_weight,
                't_off_fuel'=>$request->take_off_fuel,
                'pax_count' => $pax_count);
            $request->session()->put('data', $data);
            
            if ($request->has('post')) 
            {  
                $data['post'] =1;
                $request->session()->flash('from', $request->from);
                     $request->session()->flash('to', $request->to);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pilot', $request->pilot);
                     $request->session()->flash('co_pilot', $request->co_pilot);
                     if(array_key_exists("calculate_wt",$this->pax[0])) 
                      $request->session()->flash('pax0','checked');
                     if(array_key_exists("calculate_wt",$this->pax[1])) 
                      $request->session()->flash('pax1','checked');
                     if(array_key_exists("calculate_wt",$this->pax[2])) 
                      $request->session()->flash('pax2','checked');
                     if(array_key_exists("calculate_wt",$this->pax[3])) 
                      $request->session()->flash('pax3','checked');
                     if(array_key_exists("calculate_wt",$this->pax[4])) 
                      $request->session()->flash('pax4','checked');
                     if(array_key_exists("calculate_wt",$this->pax[5])) 
                         $request->session()->flash('pax5','checked');
                     $request->session()->flash('take_off_fuel', $request->take_off_fuel);
                     $request->session()->flash('landing_fuel', $request->landing_fuel);
                     $request->session()->flash('cargo', $request->aft_baggage_compt_weight);
                     $request->session()->flash('baggage_nose', $request->baggage_nose);
                     $request->session()->flash('baggage_aft_cabin', $request->baggage_aft_cabin);
                     $request->session()->flash('aft_fuselage_baggage_forward', $request->baggage_aft_cabin_fuselage_forward);
                   $request->session()->flash('aft_fuselage_baggage_aft', $request->baggage_aft_cabin_fuselage);

                    if($total_landing_weight['weight']>$this->validation['vtssf']['Max_Landing_Weight'])
                    {
                       $message[]= "Landing Weight ".$total_landing_weight['weight']."  (Maximum Limit 11600)";   
                    }
                    if($total_takeoff_weight['weight']>$this->validation['vtssf']['Max_Take_Off_Weight'])
                    {
                       $message[]= "Total Take Off Weight ".$total_takeoff_weight['weight']." (Maximum Limit 12500)";
                    }
                    if($total_zero_fuel['weight']>$this->validation['vtssf']['Max_Zero_Fuel_Weight'])
                    {
                       $message[]= 'Total Zero Fuel Weight '.$total_zero_fuel['weight'].'(Maximum Limit 10000)';
                    }
                    if($request->take_off_fuel>$this->validation['vtssf']['Take_Off_Fuel'])
                    {
                      $message[]='Take Off Fuel '.$request->take_off_fuel.' (Maximum Limit 3650)';
                    } 
                    if($total_landing_weight['weight']>$this->validation['vtssf']['Max_Landing_Weight']||$total_takeoff_weight['weight']>$this->validation['vtssf']['Max_Take_Off_Weight']||$total_zero_fuel['weight']>$this->validation['vtssf']['Max_Zero_Fuel_Weight']|| $request->take_off_fuel>$this->validation['vtssf']['Take_Off_Fuel'])
                        return redirect('loadtrim/vtssf')->with('message',$message); 

                return view('ltrim.vtkbn.store')->with($data);    
            }
            else
            return view('ltrim.vtkbn.show')->with($data);
        }
        else if ($callsign == 'vtobr') 
        {
          
            if(isset($request->copypaste))
             {

                 $jump_weight=sprintf('%.2f',$request->jump);
                 $jump_moment = sprintf('%.2f',$jump_weight* (-14.00));
                 $arm=[-8.00,-8.00,-3.80,-4.10,0.30,-1.20,0.50,2.20,4.60];
                 $pax_weight = [];
                 $pax_moment = [];
                 for($i=0;$i<$request->pax_count;$i++) {
                     $pax[$i]=165.35;
                     $pax_weight['pax'.($i+1)]=sprintf('%.2f',$pax[$i]);
                     $pax_moment['pax'.($i+1)]= sprintf('%.2f',$pax[$i]*$arm[$i]);
                 }
                 $baggage_fwd_weight = sprintf('%.2f',$request->baggage_fwd);
                 $baggage_fwd_moment = sprintf('%.2f',$baggage_fwd_weight * (-11.60));
                 
                 $baggage_aft_weight= sprintf('%.2f',$request->baggage_aft);
                 $baggage_aft_moment= sprintf('%.2f',$baggage_aft_weight * 4.60);
                 $total_weight= sprintf('%.2f',$jump_weight + array_sum($pax_weight) + $baggage_fwd_weight + $baggage_aft_weight);
                 $total_moment =sprintf('%.2f',$jump_moment + array_sum($pax_moment) +$baggage_fwd_moment+$baggage_aft_moment);
                 $zero_fuel_weight = sprintf('%.2f',$total_weight + 16539.12);
                 $zero_fuel_moment = sprintf('%.2f',$total_moment+ 9415.13);
                 
                 $fuel_wing_tank_weight = sprintf('%.2f',$request->fuel_wing_tank);
                 $fuel_wing_tank_moment = sprintf('%.2f',$request->fuel_wing_tank * 0.69); 
                 $fuel_ventral_tank_weight = sprintf('%.2f',$request->fuel_ventral_tank);
                 $fuel_ventral_tank_moment = sprintf('%.2f',$request->fuel_ventral_tank * 8.36);
                 
                 $ramp_weight = sprintf('%.2f',$zero_fuel_weight + $fuel_wing_tank_weight + $fuel_ventral_tank_weight);
                 $ramp_moment = sprintf('%.2f',$zero_fuel_moment + $fuel_wing_tank_moment + $fuel_ventral_tank_moment);
                 
                 $take_off_weight = sprintf('%.2f',$ramp_weight-120);
                 $take_off_moment=sprintf('%.2f',$ramp_moment-82.8);
                 
                 $cg = sprintf('%.3f',$take_off_moment/$take_off_weight);
                 $cg_smc = sprintf('%.2f',(($cg+1.308)*100)/7.263);
                 
                 $data = ["from"=>$request->from,
                                 "jump_weight"=>$jump_weight, 
                                "jump_moment"=>$jump_moment, 
                                "pax_weight"=>$pax_weight, 
                                "pax_moment"=>$pax_moment,
                                "baggage_fwd_weight"=>$baggage_fwd_weight,
                                "baggage_fwd_moment"=>$baggage_fwd_moment,
                                "baggage_aft_weight"=>$baggage_aft_weight,
                                "baggage_aft_moment"=>$baggage_aft_moment,
                                "total_weight"=>$total_weight,
                                "total_moment"=>$total_moment,
                                "zero_fuel_weight"=>$zero_fuel_weight,
                                "zero_fuel_moment"=>$zero_fuel_moment,
                                "fuel_wing_tank_weight"=>$fuel_wing_tank_weight,
                                "fuel_wing_tank_moment"=>$fuel_wing_tank_moment,
                                "fuel_ventral_tank_weight"=>$fuel_ventral_tank_weight,
                                "fuel_ventral_tank_moment"=>$fuel_ventral_tank_moment,
                                "ramp_weight"=>$ramp_weight,
                                "ramp_moment"=>$ramp_moment,
                                "take_off_weight"=>$take_off_weight,
                                "take_off_moment"=>$take_off_moment,
                                "cg"=>$cg,
                                "cg_smc"=>$cg_smc,
                                "to"=>$request->to,
                                "date"=>$request->date,
                                "pilot"=>$request->pilot_name,
                                "copilot"=>$request->copilot_name,
                                'pax_count'=>$request->pax_count
                                     ];
                             if($take_off_weight>$this->validation['vtobr']['Max_Take_Off_Weight']||$zero_fuel_weight>$this->validation['vtobr']['Max_Zero_Fuel_Weight'])
                             {
                                $request->session()->flash('jump_weight', $jump_weight);
                                $request->session()->flash('from', $request->from);
                                $request->session()->flash('to', $request->to);
                                $request->session()->flash('date', $request->date);
                                $request->session()->flash('pilot', $request->pilot_name);
                                $request->session()->flash('co_pilot', $request->copilot_name);
                                $request->session()->flash('pax_no', $request->pax_count);
                                $request->session()->flash('baggage_fwd_weight', $request->baggage_fwd);
                                $request->session()->flash('baggage_aft_weight', $request->baggage_aft);
                                $request->session()->flash('fuel_wing_tank_weight', $request->fuel_wing_tank); 
                                $request->session()->flash('fuel_ventral_tank_weight', $request->fuel_ventral_tank);
                             }  
                             if($take_off_weight>$this->validation['vtobr']['Max_Take_Off_Weight'])
                             {
                               $message[]= "Total Take Off Weight ".$take_off_weight." (Maximum Limit 28000)";   
                             }
                             if($zero_fuel_weight>$this->validation['vtobr']['Max_Zero_Fuel_Weight'])
                             {
                               $message[]= 'Total Zero Fuel Weight '.$zero_fuel_weight.'(Maximum Limit 18450)';
                             }
                            
                             if($take_off_weight>$this->validation['vtobr']['Max_Take_Off_Weight']||$zero_fuel_weight>$this->validation['vtobr']['Max_Zero_Fuel_Weight'])
                             {
                                return redirect('/loadtrim/vtobr')->with('message',$message);  
                             }
                             $request->session()->put('data',$data);
                             return view('loadandtrim.vtobr.store')->with($data);
             }   
            else
            {
                  
                $pax_count = $request->paxs;
                if($pax_count>9) {
                    $pax_count=9;
                    $jump_weight=165.35;
                    $jump_moment=$jump_weight*(-14.00);
                }
                else {
                    $jump_weight=0;
                    $jump_moment=0;
                }          
                
                $arm = [-8.00, -8.00, -3.80, -4.10, 0.30, -1.20, 0.50, 2.20, 4.60];
                $pax_weight = [];
                $pax_moment = [];
                for ($i = 0; $i < $pax_count; $i++) {
                    $pax[$i] = 165.35;
                    $pax_weight['pax' . ($i + 1)] = sprintf('%.2f', $pax[$i]);
                    $pax_moment['pax' . ($i + 1)] = sprintf('%.2f', $pax[$i] * $arm[$i]);
                }
                $baggage = $request->aft_baggage_compt_weight;
                
                $baggage_fwd_weight = round($request->load-($pax_count*165.35)-45);
                if($baggage_fwd_weight>250) {
                    $baggage_fwd_weight=250;
                }
                else if($baggage_fwd_weight<=0) {
                    $baggage_fwd_weight=0;
                }
                $baggage_fwd_moment = sprintf('%.2f', $baggage_fwd_weight * (-11.60));

                $baggage_aft_weight = 45;
                $baggage_aft_moment = sprintf('%.2f', $baggage_aft_weight * 4.60);
                $total_weight = round($jump_weight + array_sum($pax_weight) + $baggage_fwd_weight + $baggage_aft_weight);
                $total_moment = sprintf('%.2f', $jump_moment + array_sum($pax_moment) + $baggage_fwd_moment + $baggage_aft_moment);
                //$zero_fuel_weight = round($total_weight + 16442);
                //$zero_fuel_moment = sprintf('%.2f', $total_moment + 9076.74);

                $zero_fuel_weight = sprintf('%.2f',$total_weight + 16539.12);
                $zero_fuel_moment = sprintf('%.2f',$total_moment+ 9415.13);
                $take_off_fuel=$request->take_off_fuel+120;
                if($take_off_fuel>8416){
                    $fuel_wing_tank_weight = 8416;
                    $fuel_ventral_tank_weight = $take_off_fuel-8416;
                }
                else {
                    $fuel_wing_tank_weight=$take_off_fuel;
                    $fuel_ventral_tank_weight=0;
                }
                $fuel_wing_tank_moment = sprintf('%.2f', $fuel_wing_tank_weight * 0.69);
                $fuel_ventral_tank_moment = sprintf('%.2f', $fuel_ventral_tank_weight * 8.36);

                $ramp_weight = round($zero_fuel_weight + $fuel_wing_tank_weight + $fuel_ventral_tank_weight);
                $ramp_moment = sprintf('%.2f', $zero_fuel_moment + $fuel_wing_tank_moment + $fuel_ventral_tank_moment);

                $take_off_weight = round($ramp_weight - 120);
                $take_off_moment = sprintf('%.2f', $ramp_moment - 82.8);

                $cg = sprintf('%.3f', $take_off_moment / $take_off_weight);
                $cg_smc = (($cg + 1.308) * 100) / 7.263;
                $cg_smc= floor($cg_smc*100)/100;
                $data = ["from" => $request->from,
                    "jump_weight" => $jump_weight,
                    "jump_moment" => $jump_moment,
                    "pax_weight" => $pax_weight,
                    "pax_moment" => $pax_moment,
                    "baggage_fwd_weight" => $baggage_fwd_weight,
                    "baggage_fwd_moment" => $baggage_fwd_moment,
                    "baggage_aft_weight" => $baggage_aft_weight,
                    "baggage_aft_moment" => $baggage_aft_moment,
                    "total_weight" => $total_weight,
                    "total_moment" => $total_moment,
                    "zero_fuel_weight" => $zero_fuel_weight,
                    "zero_fuel_moment" => $zero_fuel_moment,
                    "fuel_wing_tank_weight" => $fuel_wing_tank_weight,
                    "fuel_wing_tank_moment" => $fuel_wing_tank_moment,
                    "fuel_ventral_tank_weight" => $fuel_ventral_tank_weight,
                    "fuel_ventral_tank_moment" => $fuel_ventral_tank_moment,
                    "ramp_weight" => $ramp_weight,
                    "ramp_moment" => $ramp_moment,
                    "take_off_weight" => $take_off_weight,
                    "take_off_moment" => $take_off_moment,
                    "cg" => $cg,
                    "cg_smc" => $cg_smc,
                    "to" => $request->to,
                    "date" => $request->date,
                    "pilot" => $request->pilot,
                    "copilot" => $request->co_pilot,
                    "pax_count"=>$pax_count,
                    "copypaste"=>true
                ];
                $request->session()->put('data', $data);
                return view('loadandtrim.vtobr.store')->with($data);
             }   
        } 
        elseif ($callsign == 'vtvrl') 
         {
                $this->empty_weight = array('weight' => 8423.25,'arm' => 306.20);
                $this->pilot_co_pilot = array('weight' => 375,'arm' => 167);
                $this->baggage_nose = array('arm' => 100,'weight'=>0,'mom'=>0);
                $this->baggage_aft_cabin = array('arm' =>330,'weight'=>0,'mom'=>0);
                $this->aft_fuselage_baggage_forward = array('arm' => 392);
                $this->aft_fuselage_baggage_aft = array('arm' => 413);
                $this->lessfuel_start=array('weight'=>-91,'mom'=>-268);
                $this->lessfuel_dest=array();
                $this->cargo=array('arm'=>392);

                $this->pax = array(
                    array('arm' => 228, 
                    ),
                    array(
                        'arm' => 230,
                    ),
                    array(
                        'arm' => 281,
                    ),
                    array(
                        'arm' => 281,
                    ),
                    array(
                        'arm' => 309,
                    ),
                    array(
                        'arm' => 309,
                    )
                );
                $pax_count=0;
                $empty_weight_momentum =25791.90;
                array_push($this->momentum,$empty_weight_momentum);   
                $this->empty_weight['mom']=$empty_weight_momentum; //dd
                array_push($this->weights, $this->empty_weight['weight']);
                $pilot_co_pilot_momentum =($this->pilot_co_pilot['weight'] * $this->pilot_co_pilot['arm'])/100;
                $this->pilot_co_pilot['mom']=$pilot_co_pilot_momentum;
                array_push($this->momentum,$pilot_co_pilot_momentum); 
                array_push($this->weights, $this->pilot_co_pilot['weight']);
                $empty_os=array('wt' =>array_sum($this->weights),'arm'=>300.27,'mom'=>26418.15);
                if($request->aft_baggage_compt_weight)
                {
                  $this->cargo['weight']=$request->aft_baggage_compt_weight;    
                 $this->cargo['mom']=($request->aft_baggage_compt_weight*$this->cargo['arm'])/100;
                 array_push($this->weights,$this->cargo['weight']);
                 array_push($this->momentum,$this->cargo['mom']);
                }
                    $this->lessfuel_dest['weight']=($request->take_off_fuel+91)-$request->landing_fuel;
                $p_weight=array();
                 $p_weight_count=$request->paxs;
                for($i=0;$i<$p_weight_count;$i++)
                {
                        $mom = (165.34*$this->pax[$i]['arm'])/100;
                        $this->pax[$i]['calculate_mom']=$mom;
                        $this->pax[$i]['calculate_wt']=165.34;
                        array_push($this->momentum,$mom);
                        array_push($this->weights,165.34); 
                }   
                $total_zero_fuel = array(
                    'weight' => array_sum($this->weights),
                    'momentum' => array_sum($this->momentum),
                    'arm' => sprintf('%.2f',(array_sum($this->momentum)/array_sum($this->weights))*100)
                ); 
                $take_off_fuel = array(
                    'weight' => $request->take_off_fuel+91,
                    'momentum' => ($request->take_off_fuel+91)*2.86,
                );
                $ramp_weight = array(
                    'weight' => $total_zero_fuel['weight'] + $take_off_fuel['weight'],
                    'momentum' => $total_zero_fuel['momentum'] + $take_off_fuel['momentum'],
                );
                $ramp_weight['arm']=sprintf('%.2f',($ramp_weight['momentum']*100)/$ramp_weight['weight']);
                $total_takeoff_weight = array(
                    'weight' => $ramp_weight['weight'] + $this->lessfuel_start['weight'],
                    'momentum' => $ramp_weight['momentum'] + $this->lessfuel_start['mom'],
                ); 
                $total_takeoff_weight['arm'] = sprintf('%.2f',($total_takeoff_weight['momentum']/$total_takeoff_weight['weight'])*100);
                 $remaining_fuel = array(
                    'weight' => $request->landing_fuel,
                );
                $remaining_fuel['momentum']=$remaining_fuel['weight']*2.8;
                $total_landing_weight = array(
                    'weight' => $total_zero_fuel['weight'] + $remaining_fuel['weight'],
                    'momentum' => $total_zero_fuel['momentum'] + $remaining_fuel['momentum'],
                ); 
              $total_landing_weight['arm'] = sprintf('%.2f',($total_landing_weight['momentum']/$total_landing_weight['weight'])*100);   
                $data = array(
                    'from' => $request->from,
                    'to' => $request->to,
                    'date' => $request->date,
                    'pilot' => $request->pilot,
                    'co_pilot' => $request->co_pilot,
                    'empty_weight' => $this->empty_weight,
                    'pilot_co_pilot' => $this->pilot_co_pilot,
                    'cargo'=>$this->cargo,
                    'paxs' =>$this->pax,
                    'zero_fuel_weight' => $total_zero_fuel,
                    'ramp_weight' => $ramp_weight,
                    'take_off_fuel' => $take_off_fuel,
                    'less_fuel_start'=>$this->lessfuel_start,
                    'total_takeoff_weight' => $total_takeoff_weight,
                    'remaining_fuel' => $remaining_fuel,
                    'total_landing_weight'=>$total_landing_weight,
                    'empty_os'=>$empty_os,
                    'lessfuel_dest'=>$this->lessfuel_dest,
                    'pax_count'=>$pax_count,
                    'pax_count'=>$pax_count,
                    'call_sign'=>$request->callsign,
                    'pax_no'=>$request->paxs,
                    't_off_fuel'=>$request->take_off_fuel,
                    'load'=>$request->load-($request->paxs*165),
                );

                  $request->session()->put('data', $data);
                if ($request->has('post')) 
                 {  
                   $data['post'] =1; 
                   $request->session()->flash('from', $request->from);
                     $request->session()->flash('to', $request->to);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pilot', $request->pilot);
                     $request->session()->flash('co_pilot', $request->co_pilot);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pax_no', $request->paxs);
                     $request->session()->flash('take_off_fuel', $request->take_off_fuel);
                     $request->session()->flash('landing_fuel', $request->landing_fuel);
                     $request->session()->flash('cargo', $request->aft_baggage_compt_weight);
                    if($total_landing_weight['weight']>$this->validation['vtvrl']['Max_Landing_Weight'])
                    {   
                      $message[]= "Landing Weight ".$total_landing_weight['weight']."  (Maximum Limit 11600)";  
                    }
                    if($total_takeoff_weight['weight']>$this->validation['vtvrl']['Max_Take_Off_Weight'])
                    {
                       $message[]= "Total Take Off Weight ".$total_takeoff_weight['weight']." (Maximum Limit 12500)"; 
                    }
                    if($total_zero_fuel['weight']>$this->validation['vtvrl']['Max_Zero_Fuel_Weight'])
                    {
                       $message[]= 'Total Zero Fuel Weight '.$total_zero_fuel['weight'].'(Maximum Limit 10000)';
                    }
                    if($request->take_off_fuel>$this->validation['vtvrl']['Take_Off_Fuel'])
                    {
                       $message[]='Take Off Fuel '.$request->take_off_fuel.' (Maximum Limit 3650)';    
                    } 
                    if($total_landing_weight['weight']>$this->validation['vtvrl']['Max_Landing_Weight']||$total_takeoff_weight['weight']>$this->validation['vtvrl']['Max_Take_Off_Weight']||$total_zero_fuel['weight']>$this->validation['vtvrl']['Max_Zero_Fuel_Weight']||$request->take_off_fuel>$this->validation['vtvrl']['Take_Off_Fuel'])
                      return redirect('loadtrim/vtvrl')->with('message',$message);
                   return view('ltrim.vtvrl.store')->with($data);    
                 }
                 else
                return view('ltrim.vtvrl.show')->with($data);
         }
         elseif($callsign == 'vtanf') 
         {
            $this->empty_weight = array('weight' => 8356.81,'arm' => 308.46);
            $this->pilot_co_pilot = array('weight' => 374.78,'arm' => 167);
            $this->baggage_nose = array('arm' => 100,'weight'=>0,'mom'=>0);
            $this->baggage_aft_cabin = array('arm' =>330,'weight'=>0,'mom'=>0);
            $this->aft_fuselage_baggage_forward = array('arm' => 371);
            $this->aft_fuselage_baggage_aft = array('arm' => 413);
            $this->lessfuel_start=array('weight'=>-91,'mom'=>-264.36);
            $this->lessfuel_dest=array('weight'=>300);
            $this->cargo=array('arm'=>413);
            $this->pax = array(
                array('arm' => 228, 
                ),
                array(
                    'arm' => 230,
                ),
                array(
                    'arm' => 281,
                ),
                array(
                    'arm' => 281,
                ),
                array(
                    'arm' => 309,
                ),
                array(
                    'arm' => 309,
                )
            );
            $pax_count=0;
            $empty_weight_momentum =25777.42;
            array_push($this->momentum,$empty_weight_momentum);   
                $this->empty_weight['mom']=$empty_weight_momentum; //dd
                array_push($this->weights, $this->empty_weight['weight']);
                $pilot_co_pilot_momentum =($this->pilot_co_pilot['weight'] * $this->pilot_co_pilot['arm'])/100;
                $this->pilot_co_pilot['mom']=$pilot_co_pilot_momentum;
                array_push($this->momentum,$pilot_co_pilot_momentum); 
                array_push($this->weights, $this->pilot_co_pilot['weight']);
                $empty_os=array('wt' =>array_sum($this->weights),'arm'=>300.27,'mom'=>26418.15);
                if($request->aft_baggage_compt_weight)
                {
                 $this->cargo['weight']=$request->aft_baggage_compt_weight;    
                 $this->cargo['mom']=($request->aft_baggage_compt_weight*$this->cargo['arm'])/100;
                 array_push($this->weights,$this->cargo['weight']);
                 array_push($this->momentum,$this->cargo['mom']);
                }
                $this->lessfuel_dest['weight']=($request->take_off_fuel+91)-$request->landing_fuel;
                $p_weight=array();
                 $p_weight_count=$request->paxs;
                for($i=0;$i<$p_weight_count;$i++)
                {
                        $mom = (165.34*$this->pax[$i]['arm'])/100;
                        $this->pax[$i]['calculate_mom']=$mom;
                        $this->pax[$i]['calculate_wt']=165.34;
                        array_push($this->momentum,$mom);
                        array_push($this->weights,165.34); 
                }   
                $total_zero_fuel = array(
                    'weight' => array_sum($this->weights),
                    'momentum' => array_sum($this->momentum),
                    'arm' => sprintf('%.2f',(array_sum($this->momentum)/array_sum($this->weights))*100)
                ); 
                $take_off_fuel = array(
                    'weight' => $request->take_off_fuel+91,
                    'momentum' => ($request->take_off_fuel+91)*2.86,
                );
                $ramp_weight = array(
                    'weight' => $total_zero_fuel['weight'] + $take_off_fuel['weight'],
                    'momentum' => $total_zero_fuel['momentum'] + $take_off_fuel['momentum'],
                );
                $ramp_weight['arm']=sprintf('%.2f',($ramp_weight['momentum']*100)/$ramp_weight['weight']);
                $total_takeoff_weight = array(
                    'weight' => $ramp_weight['weight'] + $this->lessfuel_start['weight'],
                    'momentum' => $ramp_weight['momentum'] + $this->lessfuel_start['mom'],
                ); 
                $total_takeoff_weight['arm'] = sprintf('%.2f',($total_takeoff_weight['momentum']/$total_takeoff_weight['weight'])*100);
                 $remaining_fuel = array(
                    'weight' => $request->landing_fuel,
                );
                $remaining_fuel['momentum']=$remaining_fuel['weight']*2.8;
                $total_landing_weight = array(
                    'weight' => $total_zero_fuel['weight'] + $remaining_fuel['weight'],
                    'momentum' => $total_zero_fuel['momentum'] + $remaining_fuel['momentum'],
                ); 
              $total_landing_weight['arm'] = sprintf('%.2f',($total_landing_weight['momentum']/$total_landing_weight['weight'])*100);   
                $data = array(
                    'from' => $request->from,
                    'to' => $request->to,
                    'date' => $request->date,
                    'pilot' => $request->pilot,
                    'co_pilot' => $request->co_pilot,
                    'empty_weight' => $this->empty_weight,
                    'pilot_co_pilot' => $this->pilot_co_pilot,
                    'cargo'=>$this->cargo,
                    'paxs' =>$this->pax,
                    'zero_fuel_weight' => $total_zero_fuel,
                    'ramp_weight' => $ramp_weight,
                    'take_off_fuel' => $take_off_fuel,
                    'less_fuel_start'=>$this->lessfuel_start,
                    'total_takeoff_weight' => $total_takeoff_weight,
                    'remaining_fuel' => $remaining_fuel,
                    'total_landing_weight'=>$total_landing_weight,
                    'empty_os'=>$empty_os,
                    'lessfuel_dest'=>$this->lessfuel_dest,
                    'pax_count'=>$pax_count,
                    'call_sign'=>$request->callsign,
                    'pax_no'=>$request->paxs,
                    't_off_fuel'=>$request->take_off_fuel,
                    'load'=>$request->load-($request->paxs*165),
                );      
                $request->session()->put('data', $data);
                if ($request->has('post')) 
                 {  
                   $data['post'] =1; 
                     $request->session()->flash('from', $request->from);
                     $request->session()->flash('to', $request->to);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pilot', $request->pilot);
                     $request->session()->flash('co_pilot', $request->co_pilot);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pax_no', $request->paxs);
                     $request->session()->flash('take_off_fuel', $request->take_off_fuel);
                     $request->session()->flash('landing_fuel', $request->landing_fuel);
                     $request->session()->flash('cargo', $request->aft_baggage_compt_weight);
                    if($total_landing_weight['weight']>$this->validation['vtanf']['Max_Landing_Weight'])
                    {
                      $message[]= "Landing Weight ".$total_landing_weight['weight']."  (Maximum Limit 11600)";  
                    }
                    if($total_takeoff_weight['weight']>$this->validation['vtanf']['Max_Take_Off_Weight'])
                    {
                      $message[]= "Total Take Off Weight ".$total_takeoff_weight['weight']." (Maximum Limit 12500)";     
                    }
                    if($total_zero_fuel['weight']>$this->validation['vtanf']['Max_Zero_Fuel_Weight'])
                    {
                      $message[]= 'Total Zero Fuel Weight '.$total_zero_fuel['weight'].'(Maximum Limit 10000)';  
                    }
                    if($request->take_off_fuel>$this->validation['vtanf']['Take_Off_Fuel'])
                    {   
                     $message[]='Take Off Fuel '.$request->take_off_fuel.' (Maximum Limit 3650)'; 
                    } 

                   if($total_landing_weight['weight']>$this->validation['vtanf']['Max_Landing_Weight']||$total_takeoff_weight['weight']>$this->validation['vtanf']['Max_Take_Off_Weight']||$total_zero_fuel['weight']>$this->validation['vtanf']['Max_Zero_Fuel_Weight']|| $request->take_off_fuel>$this->validation['vtanf']['Take_Off_Fuel'])
                      return redirect('loadtrim/vtanf')->with('message',$message);   
                      

                   return view('ltrim.vtanf.store')->with($data);    
                 } 
                else
                 {  
                  return view('ltrim.vtanf.show')->with($data);
                 }
         }
         elseif ($callsign =='vtbsl') {
             $data=$request->all();
             
             return view('ltrim.vtbsl.store')->with($data);
         }   
         elseif($callsign=='vtnma')
         {
            $this->empty_weight = array('weight' => 8396.53,'arm' => 206.86);
            $this->pilot_co_pilot = array('weight' => 187.00,'arm' => 102.50);
            $this->cargo=array('arm'=>235);
            $this->pax = array(
                array('arm' => 203, 
                ),
                array(
                    'arm' => 203,
                ),
                array(
                    'arm' => 133,
                ),
                array(
                    'arm' => 133,
                ),
                array(
                    'arm' => 133,
                ));
             $fwd_sum_pax=0;
              $aft_sum_pax=0;
            if($request->paxs)
             {
                for($i=0;$i<$request->paxs;$i++)
                {      
                    $mom = (175*$this->pax[$i]['arm']);
                    $this->pax[$i]['calculate_mom']=$mom;
                    $this->pax[$i]['calculate_wt']=175;
                    array_push($this->momentum,$mom);
                    array_push($this->weights,175);  
                }
             } 
               for($j=0;$j<=1;$j++)
                { 
                    if(array_key_exists('calculate_wt',$this->pax[$j]))
                    {  
                        $fwd_sum_pax=$fwd_sum_pax+$this->pax[$j]['calculate_wt'];
                    }
                } 
              for($k=2;$k<=4;$k++)
                { 
                    if(array_key_exists('calculate_wt',$this->pax[$k]))
                    {  
                        $aft_sum_pax=$aft_sum_pax+$this->pax[$k]['calculate_wt'];
                    }
                }    
               $empty_weight_momentum =1736927.09;
                array_push($this->momentum,$empty_weight_momentum);   
                $this->empty_weight['mom']=$empty_weight_momentum; //dd
                array_push($this->weights, $this->empty_weight['weight']);
                $pilot_co_pilot_momentum =($this->pilot_co_pilot['weight'] * $this->pilot_co_pilot['arm']);
               $this->pilot_co_pilot['mom']=$pilot_co_pilot_momentum;
                array_push($this->momentum,$pilot_co_pilot_momentum); 
                array_push($this->weights, $this->pilot_co_pilot['weight']);
                array_push($this->momentum,$pilot_co_pilot_momentum); 
                array_push($this->weights, $this->pilot_co_pilot['weight']);
                if($request->aft_baggage_compt_weight)
                {
                    $this->cargo['weight']=$request->aft_baggage_compt_weight;    
                    $this->cargo['mom']=($request->aft_baggage_compt_weight*$this->cargo['arm']);
                    array_push($this->weights,$this->cargo['weight']);
                    array_push($this->momentum,$this->cargo['mom']);
                }
                $take_off_fuel = array(
                    'weight' => $request->take_off_fuel,
                    'arm'=>216,
                    'momentum' => ($request->take_off_fuel)*216,
                );
                array_push($this->weights,$take_off_fuel['weight']);
                array_push($this->momentum,$take_off_fuel['momentum']);
                $total_takeoff_weight = array('weight' => array_sum($this->weights),'momentum' => array_sum($this->momentum));
                 $total_takeoff_weight['arm']= $total_takeoff_weight['momentum']/$total_takeoff_weight['weight'];
                $data = array(
                    'from' => $request->from,
                    'to' => $request->to,
                    'date' => $request->date,
                    'pilot' => $request->pilot,
                    'co_pilot' => $request->co_pilot,
                    'empty_weight' => $this->empty_weight,
                    'pilot_co_pilot' => $this->pilot_co_pilot,
                    'cargo'=>$this->cargo,
                    'paxs' =>$this->pax,
                    'take_off_fuel' => $take_off_fuel,
                    'total_takeoff_weight' => $total_takeoff_weight,
                    'pax_count'=>$request->paxs,
                    'call_sign'=>$request->callsign,
                    'pax_no'=>$request->paxs,
                    't_off_fuel'=>$request->take_off_fuel,
                    'aft_sum_pax'=>$aft_sum_pax,
                    'aft_sum_mom'=>$aft_sum_pax*133,
                    'fwd_sum_pax'=>$fwd_sum_pax,
                    'fwd_sum_mom'=>$fwd_sum_pax*203,
                );
                 $request->session()->put('data',$data);

                    if($total_takeoff_weight['weight']>$this->validation['vtnma']['Max_Take_Off_Weight'])
                    {
                       $message[]= "Total Take Off Weight ".$total_takeoff_weight['weight']." (Maximum Limit 11700)"; 
                    }
                    if($request->take_off_fuel>$this->validation['vtnma']['Take_Off_Fuel'])
                    {
                       $message[]='Take Off Fuel '.$request->take_off_fuel.' (Maximum Limit 1884)';    
                    } 
                    if($total_takeoff_weight['weight']>$this->validation['vtnma']['Max_Take_Off_Weight']||$request->take_off_fuel>$this->validation['vtnma']['Take_Off_Fuel'])
                     {
                     $request->session()->flash('from', $request->from);
                     $request->session()->flash('to', $request->to);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pilot', $request->pilot);
                     $request->session()->flash('co_pilot', $request->co_pilot);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pax_no', $request->paxs);
                     $request->session()->flash('take_off_fuel', $request->take_off_fuel);
                     $request->session()->flash('cargo', $request->aft_baggage_compt_weight);
                   
   
                      return redirect('loadtrim/vtnma')->with('message',$message);
                     }
                 return view('ltrim.vtnma.show')->with($data);    
                          
         }   
         elseif($callsign=='vtnit')
         {

            $this->empty_weight = array('weight' => 8303.00,'arm' => 207.52);
            $this->pilot_co_pilot = array('weight' => 187.00,'arm' => 102.50);
            $this->cargo=array('arm'=>235);
             $this->pax = array(
                array('arm' => 203, 
                ),
                array(
                    'arm' => 203,
                ),
                array('arm' => 203, 
                ),
                array(
                    'arm' => 203,
                ),
                array(
                    'arm' => 133,
                ),
                array(
                    'arm' => 133,
                ),
                array(
                    'arm' => 133,
                ),
                array(
                    'arm' => 133,
                ),
                );
              $fwd_sum_pax=0;
              $aft_sum_pax=0;
           if($request->paxs)
             {
                for($i=0;$i<$request->paxs;$i++)
                {      
                    $mom = (175*$this->pax[$i]['arm']);
                    $this->pax[$i]['calculate_mom']=$mom;
                    $this->pax[$i]['calculate_wt']=175;
                    array_push($this->momentum,$mom);
                    array_push($this->weights,175);  
                }
             }
              for($j=0;$j<=3;$j++)
                { 
                    if(array_key_exists('calculate_wt',$this->pax[$j]))
                    {  
                        $fwd_sum_pax=$fwd_sum_pax+$this->pax[$j]['calculate_wt'];
                    }
                } 
              for($k=4;$k<=7;$k++)
                { 
                    if(array_key_exists('calculate_wt',$this->pax[$k]))
                    {  
                        $aft_sum_pax=$aft_sum_pax+$this->pax[$k]['calculate_wt'];
                    }
                }     
                $empty_weight_momentum =1722921.30;
                array_push($this->momentum,$empty_weight_momentum);   
                $this->empty_weight['mom']=$empty_weight_momentum; //dd
                array_push($this->weights, $this->empty_weight['weight']);
                $pilot_co_pilot_momentum =($this->pilot_co_pilot['weight'] * $this->pilot_co_pilot['arm']);
                $this->pilot_co_pilot['mom']=$pilot_co_pilot_momentum;
                array_push($this->momentum,$pilot_co_pilot_momentum); 
                array_push($this->weights, $this->pilot_co_pilot['weight']);
                array_push($this->momentum,$pilot_co_pilot_momentum); 
                array_push($this->weights, $this->pilot_co_pilot['weight']);
                if($request->aft_baggage_compt_weight)
                {
                    $this->cargo['weight']=$request->aft_baggage_compt_weight;    
                    $this->cargo['mom']=($request->aft_baggage_compt_weight*$this->cargo['arm']);
                    array_push($this->weights,$this->cargo['weight']);
                    array_push($this->momentum,$this->cargo['mom']);
                }
                $take_off_fuel = array(
                    'weight' => $request->take_off_fuel,
                    'arm'=>216,
                    'momentum' => ($request->take_off_fuel)*216,
                );
                array_push($this->weights,$take_off_fuel['weight']);
                array_push($this->momentum,$take_off_fuel['momentum']);
                $total_takeoff_weight = array('weight' => array_sum($this->weights),'momentum' => array_sum($this->momentum));
                 $total_takeoff_weight['arm']= $total_takeoff_weight['momentum']/$total_takeoff_weight['weight'];
                $data = array(
                    'from' => $request->from,
                    'to' => $request->to,
                    'date' => $request->date,
                    'pilot' => $request->pilot,
                    'co_pilot' => $request->co_pilot,
                    'empty_weight' => $this->empty_weight,
                    'pilot_co_pilot' => $this->pilot_co_pilot,
                    'cargo'=>$this->cargo,
                    'paxs' =>$this->pax,
                    'take_off_fuel' => $take_off_fuel,
                    'total_takeoff_weight' => $total_takeoff_weight,
                    'pax_count'=>$request->paxs,
                    'call_sign'=>$request->callsign,
                    'pax_no'=>$request->paxs,
                    'aft_sum_pax'=>$aft_sum_pax,
                    'fwd_sum_pax'=>$fwd_sum_pax,
                    't_off_fuel'=>$request->take_off_fuel,
                    'aft_sum_mom'=>$aft_sum_pax*133,
                    'fwd_sum_mom'=>$fwd_sum_pax*203,
                );      

               $request->session()->put('data',$data);
               if($total_takeoff_weight['weight']>$this->validation['vtnma']['Max_Take_Off_Weight'])
                    {
                       $message[]= "Total Take Off Weight ".$total_takeoff_weight['weight']." (Maximum Limit 11700)"; 
                    }
                    if($request->take_off_fuel>$this->validation['vtnma']['Take_Off_Fuel'])
                    {
                       $message[]='Take Off Fuel '.$request->take_off_fuel.' (Maximum Limit 1884)';    
                    } 
                    if($total_takeoff_weight['weight']>$this->validation['vtnma']['Max_Take_Off_Weight']||$request->take_off_fuel>$this->validation['vtnma']['Take_Off_Fuel'])
                     {
                     $request->session()->flash('from', $request->from);
                     $request->session()->flash('to', $request->to);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pilot', $request->pilot);
                     $request->session()->flash('co_pilot', $request->co_pilot);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pax_no', $request->paxs);
                     $request->session()->flash('take_off_fuel', $request->take_off_fuel);
                     $request->session()->flash('cargo', $request->aft_baggage_compt_weight);
                   
   
                      return redirect('loadtrim/vtnit')->with('message',$message);
                     }
                     //dd($data);
               return view('ltrim.vtnit.show')->with($data);    
         }     
         elseif($callsign=='vtauv')
         {
   
             $this->paxs = array(
                array(
                    'arm' => 372.50
                ),
                array(
                    'arm' => 372.50
                ),
                array(
                    'arm' => 427.50
                ),
                array(
                    'arm' => 427.50
                ),
                 array(
                    'arm' => 477.50
                ),
                array(
                    'arm' => 532.50
                ),
                array(
                    'arm' => 462.00
                ),
                array(
                    'arm' => 488.00
                ),
                array(
                    'arm' => 514.00
                )
                
            );
            $this->fwd_baggege_compt['arm']=603.75;
            $this->empty_weight = array('weight' => 26727.00, 'arm' =>523.29,'moment'=>13985.97);
            array_push($this->momentum, $this->empty_weight['moment']);
            array_push($this->weights, $this->empty_weight['weight']);

            $this->pilot_co_pilot = array('weight' => 374.00, 'arm' => 255.00,'moment'=>95.37);
            array_push($this->momentum, $this->pilot_co_pilot['moment']);
            array_push($this->weights, $this->pilot_co_pilot['weight']);
            
            $this->jump_vtauv = array('arm' =>290.75);
            if ($request->has('jump')) 
              $this->jump_vtauv['weight']=$request->jump;
            else
              $this->jump_vtauv['weight']=0;
            $this->jump_vtauv['moment']=sprintf('%.2f',($request->jump*$this->jump_vtauv['arm'])/1000);
            array_push($this->momentum, $this->jump_vtauv['moment']);
            array_push($this->weights, $this->jump_vtauv['weight']);
            
            $this->potable_water = array('arm' =>574.50);
             if ($request->has('portable_water')) 
               $this->potable_water['weight']=$request->portable_water;
            else
               $this->potable_water['weight']=83.29;
            $this->potable_water['moment']=sprintf('%.2f',($this->potable_water['weight']*$this->potable_water['arm'])/1000);
            array_push($this->momentum, $this->potable_water['moment']);
            array_push($this->weights, $this->potable_water['weight']);
            $this->catering_allowance= array('arm' =>316.00);
              if ($request->has('catering_allowance'))
                $this->catering_allowance['weight']=$request->catering_allowance;
            else
                $this->catering_allowance['weight']=175;
            $this->catering_allowance['moment']=sprintf('%.2f',($this->catering_allowance['weight']*$this->catering_allowance['arm'])/1000);
            array_push($this->momentum, $this->catering_allowance['moment']);
            array_push($this->weights, $this->catering_allowance['weight']);

            $this->toilet_charge = array('arm' =>574.50);
            if($request->has('toilet_charge'))
            $this->toilet_charge['weight']=$request->toilet_charge;
            else
            $this->toilet_charge['weight']=18.52;
            $this->toilet_charge['moment']=sprintf('%.2f',($this->toilet_charge['weight']*$this->toilet_charge['arm'])/1000);
            array_push($this->momentum, $this->toilet_charge['moment']);
            array_push($this->weights, $this->toilet_charge['weight']);
            
            $this->lift_raft = array('arm' =>517.1);
            if($request->has('life_raft'))
                $this->lift_raft['weight']=$request->life_raft;
            else
                $this->lift_raft['weight']=131;
            $this->lift_raft['moment']=sprintf('%.2f',($this->lift_raft['weight']*$this->lift_raft['arm'])/1000);
            array_push($this->momentum, $this->lift_raft['moment']);
            array_push($this->weights, $this->lift_raft['weight']);

            $this->dry_os['weight']=array_sum($this->weights);
            $this->dry_os['moment']=sprintf('%.2f',array_sum($this->momentum));
            $this->dry_os['arm']=sprintf('%.2f',($this->dry_os['moment']/$this->dry_os['weight'])*1000);
             if (isset($request->paxs)) 
             {   
               if($request->has('post'))
               { 
                    foreach ($request->paxs as $pax_key => $pax_value) 
                    {
                        $this->paxs[$pax_key]['weight'] = 170;
                        $this->paxs[$pax_key]['moment']=($this->paxs[$pax_key]['weight'] * $this->paxs[$pax_key]['arm'])/1000;
                        array_push($this->momentum,$this->paxs[$pax_key]['moment']);
                        array_push($this->weights, $this->paxs[$pax_key]['weight']);
                    }
               }
               else 
               {
                   for($pax_key=0 ;$pax_key<$request->paxs;$pax_key++)
                   {
                      $this->paxs[$pax_key]['weight'] = 170;
                        $this->paxs[$pax_key]['moment']=($this->paxs[$pax_key]['weight'] * $this->paxs[$pax_key]['arm'])/1000;
                        array_push($this->momentum,$this->paxs[$pax_key]['moment']);
                        array_push($this->weights, $this->paxs[$pax_key]['weight']);
                   } 
               } 
            }
            $this->fwd_baggege_compt['weight']=$request->aft_baggage_compt_weight;
            $this->fwd_baggege_compt['moment']=sprintf('%.2f',($this->fwd_baggege_compt['weight']*$this->fwd_baggege_compt['arm'])/1000);
            array_push($this->momentum, $this->fwd_baggege_compt['moment']);
            array_push($this->weights, $this->fwd_baggege_compt['weight']);
            $zero_fuel_weight=array('weight'=>array_sum($this->weights),'moment'=>array_sum($this->momentum));
            $take_off_fuel=$request->take_off_fuel;
            if($take_off_fuel>9720)
            { 
                $this->vtauv_tank['main_tank_weight']=9720;
                $this->vtauv_tank['tail_tank_weight']=sprintf('%.0f',($take_off_fuel-$this->vtauv_tank['main_tank_weight'])/3.65);
                $this->vtauv_tank['aux_tank_weight']=sprintf('%.0f',$take_off_fuel-($this->vtauv_tank['main_tank_weight']+ $this->vtauv_tank['tail_tank_weight'])); 
            }
            else
            {
               $this->vtauv_tank['main_tank_weight']=$take_off_fuel;
               $this->vtauv_tank['tail_tank_weight']=0;
               $this->vtauv_tank['aux_tank_weight']=0; 
               $this->vtauv_tank['tail_tank_moment']=0;
               $this->vtauv_tank['aux_tank_moment']=0; 
            }
             array_push($this->weights,$this->vtauv_tank['main_tank_weight']);
             $main_tank_data = DB::table('load_trim_vtauv')->where('total_fuel',$this->vtauv_tank['main_tank_weight'])->first();
             if(!empty($main_tank_data))
              {
                  $this->vtauv_tank['main_tank_moment']=sprintf('%.0f',$main_tank_data->main_percent_mac);
                  array_push($this->momentum,$this->vtauv_tank['main_tank_moment']);
              }  
             array_push($this->weights,$this->vtauv_tank['tail_tank_weight']);
             $tail_tank_data = DB::table('load_trim_vtauv')->where('total_fuel',$this->vtauv_tank['tail_tank_weight'])->first();
             if(!empty($tail_tank_data))
              {
                  $this->vtauv_tank['tail_tank_moment']=sprintf('%.0f',$tail_tank_data->tail_percent_mac);
                  array_push($this->momentum,$this->vtauv_tank['tail_tank_moment']);
              }
             array_push($this->weights,$this->vtauv_tank['aux_tank_weight']);
             $aux_tank_data = DB::table('load_trim_vtauv')->where('total_fuel',$this->vtauv_tank['aux_tank_weight'])->first();
             if(!empty($aux_tank_data))
              {
                  $this->vtauv_tank['aux_tank_moment']=sprintf('%.0f',$aux_tank_data->aux_percent_mac);
                  array_push($this->momentum,$this->vtauv_tank['aux_tank_moment']);
              }
                $ramp_weight=array('weight'=>array_sum($this->weights),'moment'=>array_sum($this->momentum));
                $taxi_out_fuel=array('weight'=>100,'moment'=>60);
                $take_off_weight=array('weight'=>array_sum($this->weights)-$taxi_out_fuel['weight'],'moment'=>sprintf('%.2f',array_sum($this->momentum)-$taxi_out_fuel['moment']));
        
                $take_off_weight['arm']=sprintf('%.2f',($take_off_weight['moment']/$take_off_weight['weight'])*1000);
                $block_fuel['weight']=$request->block_fuel;
                $block_fuel_data = DB::table('load_trim_vtauv')->where('total_fuel',$request->block_fuel)->first();  
                if(!empty($block_fuel_data))
                {
                    $block_fuel['moment']=sprintf('%.0f',$block_fuel_data->main_percent_mac);
                } 
                $landing_weight=array('weight'=>array_sum($this->weights)-($block_fuel['weight']+$taxi_out_fuel['weight']),'moment'=>array_sum($this->momentum)-($block_fuel['moment']+$taxi_out_fuel['moment']));
                $landing_weight['arm']=sprintf('%.2f',($landing_weight['moment']/$landing_weight['weight'])*1000);

                $diversion_fuel=array('weight'=>1500,'moment'=>800);
                $landing_fuel_alternate=array(
                          'weight'=>$landing_weight['weight']-$diversion_fuel['weight'],
                          'moment'=>$landing_weight['moment']-$diversion_fuel['moment']);
                $landing_fuel_alternate['arm']=sprintf('%.2f',($landing_fuel_alternate['moment']/$landing_fuel_alternate['weight'])*1000);
               
                $cg_take_off_wt=sprintf('%.2f',$take_off_weight['arm']-488.025);
                $cg_take_off_wt1=sprintf('%.2f',($cg_take_off_wt/92.64)*100);

                $cg_landing_wt=sprintf('%.2f',$landing_weight['arm']-488.025);
                $cg_landing_wt1=sprintf('%.2f',($cg_landing_wt/92.64)*100);
                
                 $data = array(
                'from' => $request->from,
                'to' => $request->to,
                'date' => $request->date,
                'pilot' => $request->pilot,
                'co_pilot' => $request->co_pilot,
                'empty_weight' => $this->empty_weight,
                'pilot_co_pilot' => $this->pilot_co_pilot,
                'potable_water' => $this->potable_water,
                'catering_allowance' => $this->catering_allowance,
                'toilet_charge' => $this->toilet_charge,
                'lift_raft' => $this->lift_raft,
                'jump'=>$this->jump_vtauv,   
                'dry_os'=>$this->dry_os,
                'paxs' => $this->paxs,
                'zero_fuel_weight' =>$zero_fuel_weight,
                'take_off_fuel' =>$request->take_off_fuel,
                'tank' => $this->vtauv_tank,
                'ramp_weight' => $ramp_weight,
                'taxi_out_fuel' => $taxi_out_fuel,
                'take_off_weight'=>$take_off_weight,
                'block_fuel'=>$block_fuel,
                'landing_weight'=>$landing_weight,
                'diversion_fuel'=>$diversion_fuel,
                'landing_fuel_alternate' => $landing_fuel_alternate,
                'baggage'=>$this->fwd_baggege_compt,
                'cg_tof_wt'=>$cg_take_off_wt1,
                'cg_land_wt'=>$cg_landing_wt1,

                'call_sign'=>'VTAUV',
                 );
               $request->session()->put('data',$data);
                if ($request->has('post'))
                {
                     $request->session()->flash('from', $request->from);
                     $request->session()->flash('to', $request->to);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pilot', $request->pilot);
                     $request->session()->flash('co_pilot', $request->co_pilot);
                     $request->session()->flash('date', $request->date);
                     $request->session()->flash('pax_no', $request->paxs);
                     $request->session()->flash('take_off_fuel', $request->take_off_fuel);
                     $request->session()->flash('block_fuel', $request->block_fuel);
                     $request->session()->flash('cargo', $request->aft_baggage_compt_weight);
                     $request->session()->flash('portable_water', $request->portable_water);
                     $request->session()->flash('catering_allowance', $request->catering_allowance);
                     $request->session()->flash('toilet_charge', $request->toilet_charge);
                     $request->session()->flash('lift_raft', $request->life_raft);

                     if($this->jump_vtauv['weight']==0)
                        $request->session()->flash('jump0','checked');
                      else
                       $request->session()->flash('jump1','checked');
                     if(array_key_exists("weight",$this->paxs[0])) 
                      $request->session()->flash('pax0','checked');
                     if(array_key_exists("weight",$this->paxs[1])) 
                      $request->session()->flash('pax1','checked');
                     if(array_key_exists("weight",$this->paxs[2])) 
                      $request->session()->flash('pax2','checked');
                     if(array_key_exists("weight",$this->paxs[3])) 
                      $request->session()->flash('pax3','checked');
                     if(array_key_exists("weight",$this->paxs[4])) 
                      $request->session()->flash('pax4','checked');
                     if(array_key_exists("weight",$this->paxs[5])) 
                      $request->session()->flash('pax5','checked');
                     if(array_key_exists("weight",$this->paxs[6])) 
                      $request->session()->flash('pax6','checked');
                    if(array_key_exists("weight",$this->paxs[7])) 
                      $request->session()->flash('pax7','checked');
                    if(array_key_exists("weight",$this->paxs[8])) 
                      $request->session()->flash('pax8','checked');
                    if($landing_weight['weight']>$this->validation['vtauv']['Max_Landing_Weight'])
                     {   
                        $message[]= "Landing Weight ".$landing_weight['weight']."  (Maximum Limit 38000)";
                     }
                    if($take_off_weight['weight']>$this->validation['vtauv']['Max_Take_Off_Weight'])
                    {
                       $message[]= "Total Take Off Weight ".$take_off_weight['weight']." (Maximum Limit 48200)";  
                    }
                    if($zero_fuel_weight['weight']>$this->validation['vtauv']['Max_Zero_Fuel_Weight'])
                    {
                        $message[]= 'Total Zero Fuel Weight '.$zero_fuel_weight['weight'].'(Maximum Limit 32000)';
                    }
                    if($request->take_off_fuel>$this->validation['vtauv']['Take_Off_Fuel'])
                    {
                         $message[]='Take Off Fuel '.$request->take_off_fuel.' (Maximum Limit 20000)';    
                    } 


                    if($landing_weight['weight']>$this->validation['vtauv']['Max_Landing_Weight']||$take_off_weight['weight']>$this->validation['vtauv']['Max_Take_Off_Weight']||$zero_fuel_weight['weight']>$this->validation['vtauv']['Max_Zero_Fuel_Weight']||$request->take_off_fuel>$this->validation['vtauv']['Take_Off_Fuel'])
                      return redirect('loadtrim/vtauv')->with('message',$message);

                    return view('ltrim.vtauv.store')->with($data);
                }
                else  
                   return view('ltrim.vtauv.show')->with($data);
         }
        else {
            try {
                $take_off_fuel_weight1 = $request->take_off_fuel_weight1;
                $landing_fuel_weight1 = $request->landing_fuel_weight1;
                $zero_fuel_weight = $request->zero_fuel_weight;
                $take_off_fuel_result = 1;
                $landing_fuel_result = 1;
                $get_formula = LoadTrimFormulas::get_formula('center_of_gravity');
                $center_of_gravity_formula = ($get_formula) ? $get_formula->formula : '';
                $take_off_fuel_moment1 = 0;
                $landing_fuel_moment1 = 0;
                $landing_fuel_increment_moment_array = [];
                $landing_fuel_increment_arm_array = [];

                if ($take_off_fuel_result) {
                    if ($take_off_fuel_weight1 > 9720) {
                        $bal_fuel = $take_off_fuel_weight1 - 9720;
                        $tail_fuel = round($bal_fuel / 3.65);
                        $aux_fuel = $bal_fuel - $tail_fuel;
                        if ($aux_fuel > 7168) {
                            $bal_aux_fuel = $aux_fuel - 7168;
                            $aux_fuel = 7168;
                            $tail_fuel = $tail_fuel + $bal_aux_fuel;
                        }
                        $main_fuel = 9720;
                        $tail_result = LoadTrimReferenceModel::get_tail_percentage_mac($tail_fuel);
                        $tail_percentage_mac = ($tail_result) ? $tail_result->tail_percentage_mac : 0;
                        $aux__result = LoadTrimReferenceModel::get_aux_percentage_mac($aux_fuel);
                        $aux_percentage_mac = ($aux__result) ? $aux__result->aux_percentage_mac : 0;
                        $main_result = LoadTrimReferenceModel::get_main_percentage_mac($main_fuel);
                        $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                        $take_off_fuel_moment1 = $tail_percentage_mac + $aux_percentage_mac + $main_percentage_mac;
                    } else {
                        $main_result = LoadTrimReferenceModel::get_main_percentage_mac($take_off_fuel_weight1);
                        $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                        $take_off_fuel_moment1 = $main_percentage_mac;
                    }
                }
                if ($landing_fuel_result) {
                    if ($landing_fuel_weight1 > 9720) {
                        $bal_fuel = $landing_fuel_weight1 - 9720;
                        $tail_fuel = round($bal_fuel / 3.65);
                        $aux_fuel = $bal_fuel - $tail_fuel;
                        if ($aux_fuel > 7168) {
                            $bal_aux_fuel = $aux_fuel - 7168;
                            $aux_fuel = 7168;
                            $tail_fuel = $tail_fuel + $bal_aux_fuel;
                        }
                        $main_fuel = 9720;
                        $tail_result = LoadTrimReferenceModel::get_tail_percentage_mac($tail_fuel);
                        $tail_percentage_mac = ($tail_result) ? $tail_result->tail_percentage_mac : 0;
                        $aux__result = LoadTrimReferenceModel::get_aux_percentage_mac($aux_fuel);
                        $aux_percentage_mac = ($aux__result) ? $aux__result->aux_percentage_mac : 0;
                        $main_result = LoadTrimReferenceModel::get_main_percentage_mac($main_fuel);
                        $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                        $landing_fuel_moment1 = $tail_percentage_mac + $aux_percentage_mac + $main_percentage_mac;
                    } else {
                        $main_result = LoadTrimReferenceModel::get_main_percentage_mac($landing_fuel_weight1);
                        $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                        $landing_fuel_moment1 = $main_percentage_mac;
                    }
                }
                if ($take_off_fuel_weight1) {
                    $take_off_fuel_arm1 = ($take_off_fuel_moment1 / $take_off_fuel_weight1) * 1000;
                } else {
                    $take_off_fuel_arm1 = 0;
                }if ($landing_fuel_weight1) {
                    $landing_fuel_arm1 = ($landing_fuel_moment1 / $landing_fuel_weight1) * 1000;
                } else {
                    $landing_fuel_arm1 = 0;
                }
                for ($i = 1; $i <= $take_off_fuel_weight1; $i+=50) {
                    if ($i > 9720) {
                        $bal_fuel = $i - 9720;
                        $tail_fuel = round($bal_fuel / 3.65);
                        $aux_fuel = $bal_fuel - $tail_fuel;
                        if ($aux_fuel > 7168) {
                            $bal_aux_fuel = $aux_fuel - 7168;
                            $aux_fuel = 7168;
                            $tail_fuel = $tail_fuel + $bal_aux_fuel;
                        }
                        $main_fuel = 9720;
                        $tail_result = LoadTrimReferenceModel::get_tail_percentage_mac($tail_fuel);
                        $tail_percentage_mac = ($tail_result) ? $tail_result->tail_percentage_mac : 0;
                        $aux__result = LoadTrimReferenceModel::get_aux_percentage_mac($aux_fuel);
                        $aux_percentage_mac = ($aux__result) ? $aux__result->aux_percentage_mac : 0;
                        $main_result = LoadTrimReferenceModel::get_main_percentage_mac($main_fuel);
                        $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                        $take_off_fuel_moment11 = $tail_percentage_mac + $aux_percentage_mac + $main_percentage_mac;
                    } else {
                        $main_result = LoadTrimReferenceModel::get_main_percentage_mac($i);
                        $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                        $take_off_fuel_moment11 = $main_percentage_mac;
                    }
                    $take_off_fuel_arm11 = round(($take_off_fuel_moment11 / 1000) * 1000, 2);
                    $landing_fuel_increment_moment_array[$i] = round($take_off_fuel_moment11, 2);
                    $landing_fuel_increment_arm_array[] = round($take_off_fuel_arm11, 2);
                }

                return response()->json(['take_off_fuel_moment1' => round($take_off_fuel_moment1, 2),
                            'landing_fuel_moment1' => round($landing_fuel_moment1, 2),
                            'take_off_fuel_arm1' => round($take_off_fuel_arm1, 2),
                            'landing_fuel_arm1' => round($landing_fuel_arm1, 2),
                            'landing_fuel_increment_moment_array' => $landing_fuel_increment_moment_array,
                            'landing_fuel_increment_arm_array' => $landing_fuel_increment_arm_array]);
            } catch (\Exception $ex) {
                Log::error('Load and trim Controller new_edit: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
                throw new customException($ex->getMessage());
            }
        }
    }

    public function get_trim_setting(Request $request) {
        $take_off_fuel_cg = $request->take_off_fuel_cg;
        $take_off_fuel_cg = ($take_off_fuel_cg) ? round($take_off_fuel_cg, 1) : 0;
        $landing_fuel_cg = $request->landing_fuel_cg;
        $landing_fuel_cg = ($landing_fuel_cg) ? round($landing_fuel_cg, 1) : 0;

        $result = MacTrimModel::get_mac_trim($take_off_fuel_cg);
        $take_off_trim_setting = ($result) ? $result->trim : 0;

        if (!$take_off_trim_setting) {
            $take_off_fuel_cg = ($take_off_fuel_cg) ? round($take_off_fuel_cg) : 0;
            if ($take_off_fuel_cg > 38) {
                $take_off_fuel_cg = 38;
            }
            $result = MacTrimModel::get_mac_trim($take_off_fuel_cg);
            $take_off_trim_setting = ($result) ? $result->trim : 0;
        }

        $result2 = MacTrimModel::get_mac_trim($landing_fuel_cg);
        $landing_fuel_trim_setting = ($result2) ? $result2->trim : 0;

        if (!$landing_fuel_trim_setting) {
            if ($landing_fuel_cg > 38) {
                $landing_fuel_cg = 38;
            }
            $result2 = MacTrimModel::get_mac_trim($landing_fuel_cg);
            $landing_fuel_trim_setting = ($result2) ? $result2->trim : 0;
        }


        return response()->json(['take_off_trim_setting' => $take_off_trim_setting, 'landing_fuel_trim_setting' => $landing_fuel_trim_setting]);
    }

    public function print_lnt(Request $request) {
        try {
            $id = $request->id;
            $landing_fuel_trim_setting = $request->landing_fuel_trim_setting;
            if ($id) {
                $result = \App\models\LntDataModel::FindorFail($id);
                $json_data = json_encode($result);
                $data = json_decode($result, TRUE);
                $aircraft_callsign = array_key_exists('aircraft_callsign', $data) ? strtolower($data['aircraft_callsign']) : '';
            } else {
                $data = $request->all(); //from dom start
                $aircraft_callsign = $request->aircraft_callsign;
            }
            $data['landing_fuel_trim_setting'] = $landing_fuel_trim_setting;
            switch ($aircraft_callsign) {
                case 'VTNGS':
                    $pdf = PDF::loadView('templates.pdf.lnt.vtngs', $data);
                    break;
                default:
                    $pdf = PDF::loadView('templates.pdf.lnt.vtngs', $data);
                    break;
            }
            return $pdf->stream('vtngs.pdf'); //from dom end
            //Save pdf start
//      $lnt_pdf_content = view('templates.pdf.lnt.' . $aircraft_callsign, $data);
//      PDF::loadHTML($lnt_pdf_content)
//          ->setPaper('a4')
//          ->setOrientation('portrait')
//          ->save(public_path('media\pdf\lnt\download\vtngs.pdf'));
//      //Save pdf end
//
//
//
//      $pdf = new \Clegginabox\PDFMerger\PDFMerger();
//      $pdf->addPDF(public_path('media\pdf\lnt\download\vtngs.pdf'), '1');
//      $pdf->addPDF(public_path('media\pdf\lnt\download\chart.pdf'), '1');
//
////    $pdf->merge('file', public_path('media\pdf\lnt\download\result.pdf'), 'P');
//      $pdf->merge('download', 'vtngs_graph.pdf', 'P');
//      switch ($aircraft_callsign) {
//      case $aircraft_callsign:
//          $pdf = PDF::loadView('templates.pdf.lnt.' . $aircraft_callsign, $data);
//          break;
//      default:
//          break;
//      }
//      return $pdf->download('vtngs.pdf');
        } catch (\Exception $ex) {
            Log::error('LoadAndTrimController print_lnt function: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
        }
    }

    public function trim_setting(Request $request) {
        try {
            $take_off_fuel_weight1 = $request->take_off_fuel_weight1;
            $landing_fuel_weight1 = $request->landing_fuel_weight1;
            $take_off_fuel_result = 1; //LoadTrimReferenceModel::get_main_percentage_mac($take_off_fuel_weight1);
            $landing_fuel_result = 1; //LoadTrimReferenceModel::get_main_percentage_mac($landing_fuel_weight1);
            $get_formula = LoadTrimFormulas::get_formula('center_of_gravity');
            $center_of_gravity_formula = ($get_formula) ? $get_formula->formula : '';
            $take_off_fuel_moment1 = 0;
            $landing_fuel_moment1 = 0;

            if ($take_off_fuel_result) {
                if ($take_off_fuel_weight1 > 9720) {
                    //MAIN = 9720 , AUX = 7168 
                    $bal_fuel = $take_off_fuel_weight1 - 9720;
                    $tail_fuel = round($bal_fuel / 3.65);
                    $aux_fuel = $bal_fuel - $tail_fuel;
                    if ($aux_fuel > 7168) {
                        $bal_aux_fuel = $aux_fuel - 7168;
                        $aux_fuel = 7168;
                        $tail_fuel = $tail_fuel + $bal_aux_fuel;
                    }
                    $main_fuel = 9720;

//          echo $tail_fuel.' '.$aux_fuel.' '.$main_fuel;exit;

                    $tail_result = LoadTrimReferenceModel::get_tail_percentage_mac($tail_fuel);
                    $tail_percentage_mac = ($tail_result) ? $tail_result->tail_percentage_mac : 0;
                    $aux__result = LoadTrimReferenceModel::get_aux_percentage_mac($aux_fuel);
                    $aux_percentage_mac = ($aux__result) ? $aux__result->aux_percentage_mac : 0;
                    $main_result = LoadTrimReferenceModel::get_main_percentage_mac($main_fuel);
                    $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                    $take_off_fuel_moment1 = $tail_percentage_mac + $aux_percentage_mac + $main_percentage_mac;
                } else if ($take_off_fuel_weight1 > 9720 && $take_off_fuel_weight1 < 16888) {
                    $aux__result = LoadTrimReferenceModel::get_main_percentage_mac($take_off_fuel_weight1, 1);
                    $aux_percentage_mac = ($aux__result) ? $aux__result->aux_percentage_mac : 0;
                    $main_result = LoadTrimReferenceModel::get_main_percentage_mac($take_off_fuel_weight1);
                    $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                    $take_off_fuel_moment1 = $aux_percentage_mac + $main_percentage_mac;
                } else {
                    $main_result = LoadTrimReferenceModel::get_main_percentage_mac($take_off_fuel_weight1);
                    $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                    $take_off_fuel_moment1 = $main_percentage_mac;
                }
            }
            if ($landing_fuel_result) {
                if ($landing_fuel_weight1 > 9720) {
                    //MAIN = 9720 , AUX = 7168 
                    $bal_fuel = $landing_fuel_weight1 - 9720;
                    $tail_fuel = round($bal_fuel / 3.65);
                    $aux_fuel = $bal_fuel - $tail_fuel;
                    if ($aux_fuel > 7168) {
                        $bal_aux_fuel = $aux_fuel - 7168;
                        $aux_fuel = 7168;
                        $tail_fuel = $tail_fuel + $bal_aux_fuel;
                    }
                    $main_fuel = 9720;

//          echo $tail_fuel.' '.$aux_fuel.' '.$main_fuel;exit;

                    $tail_result = LoadTrimReferenceModel::get_tail_percentage_mac($tail_fuel);
                    $tail_percentage_mac = ($tail_result) ? $tail_result->tail_percentage_mac : 0;
                    $aux__result = LoadTrimReferenceModel::get_aux_percentage_mac($aux_fuel);
                    $aux_percentage_mac = ($aux__result) ? $aux__result->aux_percentage_mac : 0;
                    $main_result = LoadTrimReferenceModel::get_main_percentage_mac($main_fuel);
                    $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                    $landing_fuel_moment1 = $tail_percentage_mac + $aux_percentage_mac + $main_percentage_mac;
                } else if ($landing_fuel_weight1 > 9720 && $landing_fuel_weight1 < 16888) {
                    $aux__result = LoadTrimReferenceModel::get_main_percentage_mac($landing_fuel_weight1, 1);
                    $aux_percentage_mac = ($aux__result) ? $aux__result->aux_percentage_mac : 0;
                    $main_result = LoadTrimReferenceModel::get_main_percentage_mac($landing_fuel_weight1);
                    $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                    $landing_fuel_moment1 = $aux_percentage_mac + $main_percentage_mac;
                } else {
                    $main_result = LoadTrimReferenceModel::get_main_percentage_mac($landing_fuel_weight1);
                    $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                    $landing_fuel_moment1 = $main_percentage_mac;
                }
            }
            if ($take_off_fuel_weight1) {
                $take_off_fuel_arm1 = ($take_off_fuel_moment1 / $take_off_fuel_weight1) * 1000;
            } else {
                $take_off_fuel_arm1 = 0;
            }if ($landing_fuel_weight1) {
                $landing_fuel_arm1 = ($landing_fuel_moment1 / $landing_fuel_weight1) * 1000;
            } else {
                $landing_fuel_arm1 = 0;
            }

            return response()->json(['take_off_fuel_moment1' => round($take_off_fuel_moment1, 2),
                        'landing_fuel_moment1' => round($landing_fuel_moment1, 2),
                        'take_off_fuel_arm1' => round($take_off_fuel_arm1, 2),
                        'landing_fuel_arm1' => round($landing_fuel_arm1, 2),
            ]);
        } catch (\Exception $ex) {
            Log::error('Load and trim Controller new_edit: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
        }
    }

    public function insert_lnt_values(Request $request) {
        foreach ($request->all() as $key => $value) {
            foreach ($value as $value2) {
                $data = ['cg_value' => $value2[0], 'fuel_weight' => $value2[1] * 1000, 'is_active' => 1];
                \App\models\LntCalculatedValuesModel::create($data);
            }
        }
    }

    public function get_zfg_cg(Request $request) {
        $fuel_weight = $request->fuel_weight;
        $x = $request->x;
        $y = $request->y;


        for ($i = 1; $i <= $take_off_fuel_weight1; $i+=50) {
//          echo $i;
            if ($i > 9720) {
                //MAIN = 9720 , AUX = 7168 
                $bal_fuel = $i - 9720;
                $tail_fuel = round($bal_fuel / 3.65);
                $aux_fuel = $bal_fuel - $tail_fuel;
                if ($aux_fuel > 7168) {
                    $bal_aux_fuel = $aux_fuel - 7168;
                    $aux_fuel = 7168;
                    $tail_fuel = $tail_fuel + $bal_aux_fuel;
                }
                $main_fuel = 9720;
//          echo $tail_fuel.' '.$aux_fuel.' '.$main_fuel;exit;
                $tail_result = LoadTrimReferenceModel::get_tail_percentage_mac($tail_fuel);
                $tail_percentage_mac = ($tail_result) ? $tail_result->tail_percentage_mac : 0;
                $aux__result = LoadTrimReferenceModel::get_aux_percentage_mac($aux_fuel);
                $aux_percentage_mac = ($aux__result) ? $aux__result->aux_percentage_mac : 0;
                $main_result = LoadTrimReferenceModel::get_main_percentage_mac($main_fuel);
                $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                $take_off_fuel_moment11 = $tail_percentage_mac + $aux_percentage_mac + $main_percentage_mac;
            } else {
                $main_result = LoadTrimReferenceModel::get_main_percentage_mac($i);
                $main_percentage_mac = ($main_result) ? $main_result->main_percentage_mac : 0;
                $take_off_fuel_moment11 = $main_percentage_mac;
            }
            $take_off_fuel_arm11 = round(($take_off_fuel_moment11 / 1000) * 1000, 2);
            $landing_fuel_increment_moment_array[$i] = round($take_off_fuel_moment11, 2);
            $landing_fuel_increment_arm_array[] = round($take_off_fuel_arm11, 2);
        }


        return $result;
    }

    public function save_lnt_data(Request $request) {
        try {
            $data = $request->all();
//      print_r($data);exit;
            $data['is_active'] = 1;
            $data['aircraft_callsign'] = strtoupper($request->aircraft_callsign);
            $result = \App\models\LntDataModel::create($data);
            if ($result) {
                return response()->json(['Success' => 1, 'error' => 0, 'id' => $result->id]);
            } else {
                return response()->json(['Success' => 0, 'error' => 1]);
            }
        } catch (\Exception $ex) {
            Log::error('Load and trim Controller save_lnt_data: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
        }
    }

    public function merge_pdfs(Request $request) {
        $pdf = new \Clegginabox\PDFMerger\PDFMerger();
//public_path('media/pdf/fpl/AnnexureCopy');
        $pdf->addPDF(public_path('media\images\test\bbb.pdf'), '1');
        $pdf->addPDF(public_path('media\images\test\aaa.pdf'), '1');
//  $pdf->addPDF('samplepdfs/three.pdf', 'all');
//You can optionally specify a different orientation for each PDF
//  $pdf->addPDF('samplepdfs/one.pdf', '1, 3, 4', 'L');
//  $pdf->addPDF('samplepdfs/two.pdf', '1-2', 'P);
        $pdf->merge('file', public_path('media\pdf\lnt\download\result.pdf'), 'P');
//  $pdf->merge('browser', 'vtngs.pdf', 'P');
    }

    public function upload(Request $request) {
        $data = $request->all();
        $file_name = $request->graph_image;
        // open an image file
        $image = Input::file('graph_image');
        $filename = time() . '.png';
//
        $path = public_path($filename);
//
//
//  Image::make($image->getRealPath())->resize(200, 200)->save($path);
//  $user->image = $filename;
//  $user->save();
        // resizing an uploaded file
        Image::make($image)->resize(300, 200)->save($path);
    }
   public function autosuggest_pilot(Request $request)
     {
          $callsign=strtoupper($request->callsign);
          $pilot = DB::table('pilot_master')
            ->join('callsign_info', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
            ->where('callsign_info.aircraft_callsign',$callsign)
            ->where('callsign_info.designation', '1')
            ->pluck('pilot_master.name');
         return json_encode($pilot);
     }
     public function autosuggest_copilot(Request $request)
     {
          $callsign=strtoupper($request->callsign);

          $co_pilot = DB::table('pilot_master')
            ->join('callsign_info', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
            ->where('callsign_info.aircraft_callsign',$callsign)
            ->where('callsign_info.designation', '2')
            ->pluck('pilot_master.name');
         return json_encode($co_pilot);
     }
}
