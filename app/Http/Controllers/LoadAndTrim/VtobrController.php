<?php

namespace App\Http\Controllers\LoadAndTrim;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;
ini_set('max_execution_time', 300);

class VtobrController extends Controller
{
    protected $validation=array('vtobr'=>array('Max_Take_Off_Weight'=>28000,'Max_Zero_Fuel_Weight'=>18450));
    public function index() {
        
        return view('loadandtrim.vtobr.index')->with('date','');
    }
    public function store(Request $request) {
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
        $zero_fuel_weight = sprintf('%.2f',$total_weight + 16442.12);
        $zero_fuel_moment = sprintf('%.2f',$total_moment+ 9076.74);
        
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
                     return redirect('/vtobr')->with('message', 'Total Take Off Weight Exceeds Maximum value');   
                    }
                    if($zero_fuel_weight>$this->validation['vtobr']['Max_Zero_Fuel_Weight'])
                    {
                     return redirect('/vtobr')->with('message', 'Total Zero Fuel Weight Exceeds Maximum value');
                    }
        $request->session()->put('data',$data);
        return view('loadandtrim.vtobr.store')->with($data);
    }
    public function ltrimpdf(Request $request)
   {
        $session_data=$request->session()->get('data');

         $pdf = PDF::loadView('loadandtrim.vtobr.pdf',$session_data);
         $pdfname='LnT VTOBR '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
         return $pdf->download($pdfname);
//           return view('loadandtrim.vtobr.pdf',$session_data);
   }
}
