<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QucikPlanRequest extends Request {

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
	return [
	    'aircraft_callsign' => array('required', 'min:5', 'max:7', 'alpha_num', 'regex:/^[a-zA-Z0-9]+$/'),
	    'departure_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
	    'destination_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
	    'departure_time_hours' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'departure_time_minutes' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'date_of_flight' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'pilot_in_command' => array('required', 'min:2', 'max:25', 'regex:/^[a-zA-Z ]+$/'),
	    'mobile_number' => array('required', 'digits_between:10,11', 'numeric', 'regex:/^[0-9]+$/'),
	    'copilot' => array('required', 'min:2', 'max:25', 'regex:/^[a-zA-Z ]+$/'),
	    'cabincrew' => array('required', 'min:2', 'max:25', 'regex:/^[a-zA-Z ]+$/')
	];
    }

}
