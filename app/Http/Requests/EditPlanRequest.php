<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditPlanRequest extends Request
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
	    'crushing_speed_indication' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
	    'crushing_speed' => array('required', 'digits_between:3,4', 'numeric', 'regex:/^[0-9]+$/'),
	    'flight_level_indication' => array('required', 'size:1', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
	    'flight_level' => array('required', 'min:3', 'numeric', 'regex:/^[0-9]+$/'),
	    'total_flying_hours' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'total_flying_minutes' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'route' => array('required', 'min:2', 'max:151', 'regex:/^[a-zA-Z0-9\/ ]+$/'),
	    'first_alternate_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'second_alternate_aerodrome' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
//	    'take_off_altn' => array('required', 'size:4', 'Alpha', 'regex:/^[a-zA-Z]+$/'),
	    'endurance_hours' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
	    'endurance_minutes' => array('required', 'numeric', 'regex:/^[0-9]+$/'),
//	    'remarks' => array('required', 'min:2', 'max:150', 'regex:/^[a-zA-Z0-9\/ ]+$/'),
	    'indian' =>'required'
	];
    }
}
