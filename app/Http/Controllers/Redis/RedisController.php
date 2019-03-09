<?php

namespace App\Http\Controllers\Redis;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller {

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    public function redis() {
	$redis = Redis::connection();

	$redis->set('user_details', json_encode(array('first_name' => 'Alex',
	    'last_name' => 'Richards'
			)
		)
	);
	return view('welcome');
    }

}
