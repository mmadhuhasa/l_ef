<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PilotMasterModel extends Model {

    protected $table = "pilot_master";
    protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'name', 'email', 'mobile_number', 'is_pilot', 'is_copilot', 'is_cabin_crew','is_client_ops','is_admin_manager','is_ops_staff','is_active', 'created_at', 'updated_at');

    public static function get_all() {
	return PilotMasterModel::where('is_active', '1')->get();
    }

    public static function get_pilot_details($id = '', $name = '') {
	if ($id) {
	    $result = PilotMasterModel::where('is_active', '1')->where('id', '=', $id)->firstOrFail();
	}
	if ($name) {
	    $result = PilotMasterModel::where('is_active', '1')->where('name', '=', $name)->firstOrFail();
	}
	return $result;
    }
    /**
     * Always capitalize the name when we retrieve it
     */
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

}
