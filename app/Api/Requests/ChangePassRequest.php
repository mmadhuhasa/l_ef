<?php

namespace App\Api\Requests;

use Dingo\Api\Http\FormRequest;

class ChangePassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'old_password' => 'required|min:4',
            'password' => 'required|confirmed|min:4',
        ];
    }
}
