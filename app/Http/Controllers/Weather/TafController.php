<?php

namespace App\Http\Controllers\weather;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\weather\LongTaf;
use Session;

class TafController extends Controller {

    public function index() {
         
        $long_taf = LongTaf::orderBy('created_at', 'desc')->get();
        $long_taf = $long_taf->unique('airport_code');
        foreach ($long_taf as $lt) {
            echo '<pre>';
            print_r($lt->raw_taf);
        }
//        return view('weather.weather_v.index',["data1"=>$long_taf]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    public function upload() {
        return view('weather.weather_v.taf_upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $error = false;
        $explode_using_search = explode('Search', $request->taf);
        if(strpos($explode_using_search[1],'View Decoded') !== false) {
            $remove_view_decoded = str_replace('View Decoded', '', $explode_using_search[1]);
            $remove_zone_fir = str_replace('CHENNAI FIR', '', $remove_view_decoded);
        }
        else {
        $remove_zone_fir = str_replace('CHENNAI FIR', '', $explode_using_search[1]);
        }
        $remove_zone_fir = str_replace('KOLKATA FIR', '', $remove_zone_fir);
        $remove_zone_fir = str_replace('MUMBAI FIR', '', $remove_zone_fir);
        $remove_zone_fir = str_replace('DELHI FIR', '', $remove_zone_fir);
        $replace_slash_n = trim(preg_replace('/\s\s+/', ' ', $remove_zone_fir));
        $replace_taf = str_replace('TAF', '', $replace_slash_n);
        $airports_taf = explode('=', $replace_taf);
        array_pop($airports_taf);
        $long_taf = array();
        
        foreach ($airports_taf as $key) {
            $split_taf = array();
            $key = trim($key);
            $key = trim(preg_replace('/\s\s+/', ' ', $key));
            $split_taf['airport_code'] = substr($key, 0, 4);
            $split_taf['raw_taf'] = $key;
            
            if (strpos(substr($key, 0, 13), 'Z') !== false) {
                
                $current_date = getdate();
//                dd($current_date);
                //   $today_date = $current_date();
                $current_year = $current_date['year'];
                $current_month = sprintf('%02d', $current_date['mon']);
                $split_taf['taf_date'] = $current_year . '-' . $current_month . '-' . substr($key, 5, 2);
                $split_taf['taf_time_gmt'] = substr($key, 7, 4);
            }
            array_push($long_taf, $split_taf);
        }
        //    dd($long_taf);
        if ($error == false) {
            foreach ($long_taf as $ltaf) {
                $long_cnt = LongTaf::where('airport_code', $ltaf['airport_code'])->where('taf_date', $ltaf['taf_date'])->where('taf_time_gmt', $ltaf['taf_time_gmt'])->first();
                if (count($long_cnt) > 0) {
                    LongTaf::find($long_cnt->id)->delete();
                }
            }
            LongTaf::insert($long_taf);
            Session::flash('message', 'Successfully uploaded Long Taf');
        }
        return view("weather.weather_v.taf_upload");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
