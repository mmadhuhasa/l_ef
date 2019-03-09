<?php

namespace App\Api\Requests;

use Dingo\Api\Http\FormRequest;

class EditPlanRequest extends FormRequest {

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
	    'crushing_speed_indication' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
	    'crushing_speed' => array('required', 'digits_between:3,4', 'numeric', 'regex:/^[0-9]+$/'),
	    'flight_level_indication' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
	    'flight_level' => array('required', 'min:3', 'numeric', 'regex:/^[0-9]+$/'),
	    'total_flying_hours' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'total_flying_minutes' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'route' => array('required', 'min:2', 'max:250', 'regex:/^[a-zA-Z0-9\/ ]+$/'),
	    'first_alternate_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),	    
	    'endurance_hours' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'endurance_minutes' => array('required', 'numeric', 'regex:/^[0-9]+$/')
	];
    }

}
