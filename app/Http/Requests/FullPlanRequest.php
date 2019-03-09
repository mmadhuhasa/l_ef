<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FullPlanRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'aircraft_callsign' => array('required', 'min:5', 'max:7', 'alpha_num', 'regex:/^[a-zA-Z0-9]+$/'),
//	    'flight_rules' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'flight_type' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'aircraft_type' => array('required', 'min:4', 'alpha_num', 'regex:/^[a-zA-Z0-9]+$/'),
//	    'weight_category' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'equipment' => array('required', 'min:1', 'max:32', 'alpha_num', 'regex:/^[a-zA-Z0-9]+$/'),
//	    'transponder' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'departure_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'departure_time_hours' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
//	    'departure_time_minutes' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
//	    'date_of_flight' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
//	    'crushing_speed_indication' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'crushing_speed' => array('required', 'digits_between:3,4', 'numeric', 'regex:/^[0-9]+$/'),
//	    'flight_level_indication' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'flight_level' => array('required', 'min:3', 'numeric', 'regex:/^[0-9]+$/'),
//	    'route' => array('required', 'min:2', 'max:150', 'regex:/^[a-zA-Z0-9\/ ]+$/'),
//	    'destination_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'total_flying_hours' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
//	    'total_flying_minutes' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
//	    'first_alternate_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'pilot_in_command' => array('required', 'min:2', 'max:25', 'regex:/^[a-zA-Z ]+$/'),
//	    'mobile_number' => array('required', 'digits_between:10,11', 'numeric', 'regex:/^[0-9]+$/'),
//	    'copilot' => array('required', 'min:2', 'max:25', 'regex:/^[a-zA-Z ]+$/'),
//	    'endurance_hours' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
//	    'endurance_minutes' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
//	    'operator' => array('required', 'min:3', 'max:50', 'regex:/^[a-zA-Z0-9 ]+$/'),
//	    'registration' => array('required', 'min:5', 'max:7', 'alpha_num', 'regex:/^[a-zA-Z0-9]+$/'),
//	    'aircraft_color' => array('required'),
//	    'credit' => array('required')
        ];
    }
}
