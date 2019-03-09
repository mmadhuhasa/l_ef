<?php

namespace App\Http\Controllers\Fpl;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Jobs\FDTLPopupJob;

class FDTLPopUpController extends Controller {

    public function FDTLPopup(Request $request) {
        $chocks_on = $request->chocks_on;
        $landing_time = $request->landing_time;
        $chocks_off = $request->chocks_off;
        $airborne_time = $request->airborne_time;
    }

}
