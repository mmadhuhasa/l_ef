<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use PDF;
ini_set('max_execution_time', 300);
class LoadAndTrimController extends Controller
{
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

	public function vtanf_calculate(Request $request)
	{
	
		$this->empty_weight = array('weight' => 8356.81,'arm' => 308.46);
		$this->pilot_co_pilot = array('weight' => 374.78,'arm' => 167);
		$this->baggage_nose = array('arm' => 100,'weight'=>0,'mom'=>0);
		$this->baggage_aft_cabin = array('arm' =>330,'weight'=>0,'mom'=>0);
		$this->aft_fuselage_baggage_forward = array('arm' => 371);
		$this->aft_fuselage_baggage_aft = array('arm' => 413);
        $this->lessfuel_start=array('weight'=>-91,'mom'=>-268);
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
        $empty_weight_momentum =25791.90;
        array_push($this->momentum,$empty_weight_momentum);   
        $this->empty_weight['mom']=$empty_weight_momentum; //dd
        array_push($this->weights, $this->empty_weight['weight']);
        $pilot_co_pilot_momentum =($this->pilot_co_pilot['weight'] * $this->pilot_co_pilot['arm'])/100;
        $this->pilot_co_pilot['mom']=$pilot_co_pilot_momentum;
        array_push($this->momentum,$pilot_co_pilot_momentum); 
        array_push($this->weights, $this->pilot_co_pilot['weight']);
        $empty_os=array('wt' =>array_sum($this->weights),'arm'=>300.27,'mom'=>26418.15);
        if($request->cargo)
        {
         $this->cargo['weight']=$request->cargo;    
         $this->cargo['mom']=($request->cargo*$this->cargo['arm'])/100;
         array_push($this->weights,$request->cargo);
         array_push($this->momentum,$this->cargo['mom']);
        }

        if($request->less_fuel)
        {
        	$this->lessfuel_dest['weight']=$request->less_fuel;
        }
        $p_weight=array();
        $p_weight_count=$request->paxs;
        
        for($i=0;$i<$p_weight_count;$i++)
        {
                $mom = (165*$this->pax[$i]['arm'])/100;
	    		$this->pax[$i]['calculate_mom']=$mom;
	    		$this->pax[$i]['calculate_wt']=165;
	    		array_push($this->momentum,$mom);
				array_push($this->weights,165);	
        }	
    	$total_zero_fuel = array(
    		'weight' => array_sum($this->weights),
    		'momentum' => array_sum($this->momentum),
    		'arm' => sprintf('%.2f',(array_sum($this->momentum)/array_sum($this->weights))*100)
    	); 
    	$take_off_fuel = array(
    		'weight' => $request->take_off_fuel+91,
    		'momentum' => $request->take_off_fuel*2.86,
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
    		'weight' => ($request->take_off_fuel+91)-$request->less_fuel,
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
			'call_sign'=>'VTVRL',
			'pax_no'=>$pax_count,
		);
        $request->session()->put('data',$data);
        return view('ltrim.vtanf.show')->with($data);
	}
    public function calculate(Request $request)
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
		if($request->cargo)
		{
		 $this->cargo['weight']=$request->cargo;	
		 $this->cargo['mom']=($request->cargo*$this->cargo['arm'])/100;
		 array_push($this->weights,$request->cargo);
		 array_push($this->momentum,$this->cargo['mom']);
		}

        if($request->less_fuel)
        {
        	$this->lessfuel_dest['weight']=$request->less_fuel;
        }
        $p_weight=array();
         $p_weight_count=$request->pax;
        for($i=0;$i<$p_weight_count;$i++)
        {
                $mom = (165*$this->pax[$i]['arm'])/100;
	    		$this->pax[$i]['calculate_mom']=$mom;
	    		$this->pax[$i]['calculate_wt']=165;
	    		array_push($this->momentum,$mom);
				array_push($this->weights,165);	
        }	
    	$total_zero_fuel = array(
    		'weight' => array_sum($this->weights),
    		'momentum' => array_sum($this->momentum),
    		'arm' => sprintf('%.2f',(array_sum($this->momentum)/array_sum($this->weights))*100)
    	); 
    	$take_off_fuel = array(
    		'weight' => $request->take_off_fuel+91,
    		'momentum' => $request->take_off_fuel*2.86,
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
    		'weight' => ($request->take_off_fuel+91)-$request->less_fuel,
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
			'call_sign'=>'VTVRL',
			'pax_no'=>$pax_count,
		);
        $request->session()->put('data',$data);
    	return view('ltrim.vtvrl.show')->with($data);
    }
     public function ltrim_graph(Request $request)
    {
          $session_data=$request->session()->get('data');
    	  return json_encode($session_data);
    }
    public function checkvalidation(Request $request)
    {
    	if (array_key_exists($request->take_off_fuel,$this->fuel_momentum)==false)
    		return json_encode(true);
    	else
    		return json_encode(false); 
    }   
    public function ltrimround(Request $request)
    {
     	$val=$request->data;
        $mod=$val%25;
        if($mod<=12)
        	$result=$val-$mod;
        else
        {
        	$add_res=25-$mod;
            $result=$val+$add_res;
        }
        if($val<50)
          $result=50;	
        if($val>2750)
           $result=2750;
        return json_encode($result);
    }  

    public function pastelnt()
    {
    	return view('ltrim.pastelnt');
    }
    public function pdf($call_sign,Request $request)
    {
  
    	if($call_sign=='vtavs')
    	{
    		$session_data=$request->session()->get('data');
	     	$pdf = PDF::loadView('ltrim.ltrim',$session_data);
	     	$pdfname='LnT VTAVS '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
	     	return $pdf->download($pdfname); 
    	}	
        elseif($call_sign=='vtvrl')
        {
        	$session_data=$request->session()->get('data');
	        $pdf = PDF::loadView('ltrim.vtvrl.pdf',$session_data);
	        $pdfname='LnT VTVRL '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
          	
            return $pdf->download($pdfname); 
        }
        elseif($call_sign=='vtssf')
        {
          	$session_data=$request->session()->get('data');
	      	$pdf = PDF::loadView('ltrim.vtssf_old.pdf',$session_data);
	      	$pdfname='LnT VTSSF '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
	      	// return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }
        elseif($call_sign=='vtssfnew')
        {
            $session_data=$request->session()->get('data');
            $pdf = PDF::loadView('ltrim.vtssf.pdf',$session_data);
            $pdfname='LnT VTSSF '.$session_data['from'].' s'.$ession_data['to'].'-'.$session_data['date'].'.pdf';
             return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }
        elseif($call_sign=='vtanf')
        {
        	$session_data=$request->session()->get('data');
	        $pdf = PDF::loadView('ltrim.vtanf.pdf',$session_data);
	        $pdfname='LnT VTANF '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
	        return $pdf->download($pdfname); 
        }	
        elseif($call_sign=='vtnma')
        {
            $session_data=$request->session()->get('data');
            $pdf = PDF::loadView('ltrim.vtnma.pdf',$session_data);
            $pdfname='LnT VTNMA '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            return $pdf->download($pdfname);  
            return $pdf->stream($pdfname); 
        } 
        elseif($call_sign=='vtauv')
        {
            $session_data=$request->session()->get('data');
            $pdf = PDF::loadView('ltrim.vtauv.pdf',$session_data);
            $pdfname='LnT VTAUV '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            return $pdf->download($pdfname); 
        }   
        elseif($call_sign=='vtram')
        {
            //$session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
            // $pdfname='LnT VTRAM '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            // return view('ltrim.vtram.pdf');
            $pdf = PDF::loadView('ltrim.vtram.pdf');
            $pdfname='LnT VTRAM '.'.pdf';
            return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }   
        elseif($call_sign=='vtehb')
        {
            //$session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
            // $pdfname='LnT VTRAM '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            // return view('ltrim.vtram.pdf');
            $pdf = PDF::loadView('ltrim.vtehb.pdf');
            $pdfname='LnT VTEHB '.'.pdf';
            return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }   
        elseif($call_sign=='vtmam')
        {
            //$session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
            // $pdfname='LnT VTRAM '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            //return view('ltrim.vtram.pdf');
            $pdf = PDF::loadView('ltrim.vtmam.pdf');
            $pdfname='LnT VTMAM '.'.pdf';
            return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }   
        elseif($call_sign=='vtsrc')
        {

            
            //$session_data=$request->session()->get('data');
            //$pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
            //$pdfname='LnT VTRAM '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            // return view('ltrim.vtram.pdf');
            $pdf = PDF::loadView('ltrim.vtsrc.pdf');
            $pdfname='LnT VTSRC '.'.pdf';
            return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }  
         elseif($call_sign=='vtgkb')
        {

            
            //$session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
            // $pdfname='LnT VTRAM '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            // return view('ltrim.vtram.pdf');
            $pdf = PDF::loadView('ltrim.vtgkb.pdf');
            $pdfname='LnT VTGKB '.'.pdf';
            return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }   
         elseif($call_sign=='vtejz')
        {
            //$session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
            // $pdfname='LnT VTRAM '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            //return view('ltrim.vtram.pdf');
            $pdf = PDF::loadView('ltrim.vtejz.pdf');
            $pdfname='LnT VTEJZ '.'.pdf';
            return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }   
         elseif($call_sign=='vtdbc')
        {
            //$session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
            // $pdfname='LnT VTRAM '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            //return view('ltrim.vtram.pdf');
            $pdf = PDF::loadView('ltrim.vtdbc.pdf');
            $pdfname='LnT VTDBC '.'.pdf';
            return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }   
           elseif($call_sign=='vtltc')
        {
             //$session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
            // $pdfname='LnT VTRAM '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
            // return view('ltrim.vtram.pdf');
            $pdf = PDF::loadView('ltrim.vtltc.pdf');
            $pdfname='LnT VTLTC '.'.pdf';
            return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }  
        elseif($call_sign=='vtjhp')
        {
             //  dd("ss"); 
            //$session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
            // $pdfname='LnT VTRAM '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
             // return view('ltrim.vtjhp.pdf');
            $pdf = PDF::loadView('ltrim.vtjhp.pdf');
            $pdfname='LnT VTJHP '.'.pdf';
            return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }   
        elseif($call_sign=='vtbsl')
        {
            
            $session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
             $pdfname='LnT VTBSL '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
             // return view('ltrim.vtjhp.pdf');
            $pdf = PDF::loadView('ltrim.vtbsl_new.pdf',$session_data);
            //$pdfname='LnT VTBSL '.'.pdf';
           // return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }   
        elseif($call_sign=='vtepu')
        {
            
            $session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
             $pdfname='LnT VTEPU '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
             // return view('ltrim.vtjhp.pdf');
            $pdf = PDF::loadView('ltrim.vtepu.pdf',$session_data);
            //$pdfname='LnT VTBSL '.'.pdf';
           //return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }
        elseif($call_sign=='vtfiu')
        {
            
            $session_data=$request->session()->get('data');
            // $pdf = PDF::loadView('ltrim.vtram.pdf',$session_data);
             $pdfname='LnT VTFIU '.$session_data['from'].' '.$session_data['to'].'-'.$session_data['date'].'.pdf';
             // return view('ltrim.vtjhp.pdf');
            $pdf = PDF::loadView('ltrim.vtfiu.pdf',$session_data);
            //$pdfname='LnT VTBSL '.'.pdf';
           //return $pdf->stream($pdfname); 
            return $pdf->download($pdfname); 
        }   
    } 
}
