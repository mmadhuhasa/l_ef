<?php

namespace App\Api\Requests;

use Dingo\Api\Http\FormRequest;
use Input;

class AdminRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
	$email = Input::get('email');
	$user_details = \App\User::where('email', $email)->where('is_active', '1')->first();
	return $result = ($user_details) ? (($user_details->is_admin ==1) ? TRUE : FALSE) : FALSE ;	
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
	return [
	    
	];
    }

}
