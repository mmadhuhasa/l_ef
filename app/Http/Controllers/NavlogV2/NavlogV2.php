<?php
namespace App\Http\Controllers\NavlogV2;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Log;
use PDF;
use App\models\navlog\NavLogRecords;

class NavlogV2 extends Controller{
	
    public function index(){
		return view('navlog.indexv2');
    }
    public function store(Request $request){
      $navlog_i = new NavLogRecords;
      $navlog_i->callsign = $request->callsign; 
    //   $bindings = array_map(function($value){
    //     if(! is_array( $value )){
    //         return $value;
    //     } else {
    //         return json_encode($value);
    //     }
    // },$request->navlog_ext_data);
    $bindings = array();
      foreach ($request->navlog_ext_data as $key => $value) {
        # code...
          if(! is_array( $value )){
            $bindings[$key] = $value;
        } else {
            $bindings[$key] = json_encode($value);
        }
      }
      $bindings_atc = array();
      foreach ($request->atc_fpl_data as $key => $value) {
        # code...
          if(! is_array( $value )){
            $bindings_atc[$key] = $value;
        } else {
            $bindings_atc[$key] = json_encode($value);
        }
      }
      $bindings_altn = array();
      foreach ($request->navlog_ext_data_altn as $key => $value) {
        # code...
          if(! is_array( $value )){
            $bindings_altn[$key] = $value;
        } else {
            $bindings_altn[$key] = json_encode($value);
        }
      }
    
    // unset($bindings['routeArr']);
    // unset($bindings['airportArr']);
    // unset($bindings['formattedRoute']);
    // unset($bindings['windListArr']);
    // unset($bindings['airportListArr']);
    // unset($bindings['routeArr']);
    // unset($bindings['avgWindTime']);
    // unset($bindings['windsArr']);
    // unset($bindings['tas']);
    // unset($bindings['fir']);
    // unset($bindings['fLevel']);
    // unset($bindings['altnFuel']);
    
    
    
    // dd($bindings_atc);


      $navlog_i->navlog_ext_data = json_encode($bindings); 
      $navlog_i->atc_fpl_data = json_encode($bindings_atc); 
      $navlog_i->navlog_ext_data_altn = json_encode($bindings_altn); 

      $navlog_i->pilot_name = $request->pilot; 
      $navlog_i->co_pilot = $request->copilot; 
      $navlog_i->pilot_mobile = $request->pilot_mobile; 
      $navlog_i->co_pilot_mobile = $request->copilot_mobile; 
      $navlog_i->callsign = $request->callsign; 
      $navlog_i->save();
      return array('message'=>'success');
      // return view('navlog.indexv2');
    }
    public function pdfdownload(){

      $navlog_i = new NavLogRecords;
     $res=  NavLogRecords::where('id',2)->get();
     $atc_fpl_data = json_decode($res[0]->atc_fpl_data);
     $navlog_ext_data_altn = json_decode($res[0]->navlog_ext_data_altn);
     $navlog_ext_data_altn->fLevel= json_decode($navlog_ext_data_altn->fLevel);
     $navlog_ext_data_altn->formattedRoute= json_decode($navlog_ext_data_altn->formattedRoute);

     $navlog_ext_data = json_decode($res[0]->navlog_ext_data);
     $navlog_ext_data->tOffFuel = intval($navlog_ext_data->blockFuel) - intval($navlog_ext_data->taxiFuel);
     $navlog_ext_data->bWt = intval($navlog_ext_data->zfw)-intval($navlog_ext_data->load);
     $navlog_ext_data->addtFuel = intval($navlog_ext_data->extraFuel)-intval($navlog_ext_data->contingency);
     $navlog_ext_data->ete = explode("hr", $navlog_ext_data->ete);
     $navlog_ext_data->ete = implode("hr ", $navlog_ext_data->ete);
    //  dd($atc_fpl_data); 
    
    $navlog_ext_data->callsign= strtoupper($navlog_ext_data->callsign);
    $atc_fpl_data->callsign= strtoupper($atc_fpl_data->callsign);
    $atc_fpl_data->pilot_name = $res[0]->pilot_name;
    $atc_fpl_data->co_pilot = $res[0]->co_pilot;
    $atc_fpl_data->co_pilot_mobile = $res[0]->co_pilot_mobile;
    $atc_fpl_data->pilot_mobile = $res[0]->pilot_mobile;

    $navlog_ext_data->fLevel= json_decode($navlog_ext_data->fLevel);
    $navlog_ext_data->routeArr= json_decode($navlog_ext_data->routeArr);
    $navlog_ext_data->windsArr= json_decode($navlog_ext_data->windsArr);
    $navlog_ext_data->windListArr= json_decode($navlog_ext_data->windListArr);
    $navlog_ext_data->formattedRoute= json_decode($navlog_ext_data->formattedRoute);
    $navlog_ext_data->airportListArr= json_decode($navlog_ext_data->airportListArr);
    $navlog_ext_data->airportArr= json_decode($navlog_ext_data->airportArr);
    $navlog_ext_data->avgWindTime= json_decode($navlog_ext_data->avgWindTime);
    $navlog_ext_data->fir= json_decode($navlog_ext_data->fir);
    $navlog_ext_data->tas= json_decode($navlog_ext_data->tas);
    $navlog_ext_data->altnFuel= json_decode($navlog_ext_data->altnFuel);
    if($navlog_ext_data->extraTime[0] =='0'){
       $navlog_ext_data->extraTime= substr($navlog_ext_data->extraTime,1);
    }
    

    
    //  dd($navlog_ext_data_altn);
      $filePath = public_path('media/pdf/notams/');
      $fileName = 'NAVLOG.pdf';

		// return view('emails.pdf.navlog_page');
      $notams_pdf_content_new = view('emails.pdf.navlog_page', ['atc_fpl_data'=>$atc_fpl_data,'navlog_ext_data'=>$navlog_ext_data,'navlog_ext_data_altn'=>$navlog_ext_data_altn]);
    // return $notams_pdf_content_new;

      $pdf = PDF::loadHTML($notams_pdf_content_new)
                ->setPaper('a4', 'portrait')
                ->save($filePath . $fileName);
                // ->stream();

        $path = $filePath . $fileName;
        return response()->download($path);
      // return $res[0]->id;
    }
    
    
}
