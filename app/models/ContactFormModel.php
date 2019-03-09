<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ContactFormModel extends Model
{
    protected $table = 'contact_form';
    protected $fillable = array('id', 'name', 'email', 'mobile_number','operator' ,'message', 'is_active');
    
    public static function get_all(){
	return ContactFormModel::where('is_active','1')->get();
    }
    
    public function getNameAttribute($value) {
		return strtoupper($value);
	}

	/**
	 * Always lower the email when we retrieve it
	 */
	public function getEmailAttribute($value) {
		return strtolower($value);
	}

	public function setNameAttribute($value) {
		$this->attributes['name'] = strtoupper($value);
	}

	/**
	 * Always lower the email when we retrieve it
	 */
	public function setEmailAttribute($value) {
		$this->attributes['email'] = strtolower($value);
	}

	public function getOperatorAttribute($value) {
		return strtoupper($value);
	}

	public function setOperatorAttribute($value) {
		$this->attributes['operator'] = strtoupper($value);
	}
        
        public function getMessageAttribute($value) {
		return strtoupper($value);
	}

	public function setMessageAttribute($value) {
		$this->attributes['message'] = strtoupper($value);
	}
    
}
