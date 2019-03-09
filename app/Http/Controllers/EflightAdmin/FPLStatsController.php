<?php

namespace App\Http\Controllers\EflightAdmin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class FPLStatsController extends Controller
{
    public function fplstats(Request $request){
        return view('EflightAdmin.stats.fplstatsui');
    }
    
    public function update_fplstats(Request $request){
        $data = $request->all();
        unset($data['flag']);
        unset($data['_token']);
//        print_r($data);exit;
        $result = \App\models\FPLStatsUIModel::update_stats($data);
        return response()->json(['STATUS_DESC' => 'FPL STATS DATA UPDATED SUCCESSFULLY', 'STATUS_CODE' => '1']);
    }
}
