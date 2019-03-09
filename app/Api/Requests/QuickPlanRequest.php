<?php

namespace App\Api\Requests;

use Dingo\Api\Http\FormRequest;

class QuickPlanRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
	return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
	$data = [
	    'aircraft_callsign' => array('required', 'min:5', 'max:7', 'alpha_num', 'regex:/^[a-zA-Z0-9]+$/'),
	    'departure_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
	    'destination_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
	    'departure_time_hours' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'departure_time_minutes' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'date_of_flight' => array('required', 'numeric', 'regex:/^[0-9]+$/'),	    	    
	];
	
	return $data;
    }

}
