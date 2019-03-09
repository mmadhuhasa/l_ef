<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AerodromeMailsModel extends Model {

    protected $table = "aerodrome_mails";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'aerodrome','name','email','mobile_number', 'mail_ids', 'departure_only', 'destination_only', 'is_active');

    public static function getAll() {
	$result = AerodromeMailsModel::get();
	return $result;
    }

    public static function get_form_data($id) {
	$result = AerodromeMailsModel::where('id', $id)->first();
	return $result;
    }

    public function delete_record($id) {
	$result = AerodromeMailsModel::where('id', $id)->delete();
	return $result;
    }

    public static function get_dep_cc_mail($dept, $dept_station) {
	$result = AerodromeMailsModel::where('is_active', 1)
			->where('departure_only', 1)
			->where(function ($query) use($dept, $dept_station) {
			    $query->where('aerodrome', $dept)
			    ->orWhere('aerodrome', $dept_station);
			})->first();
	return ($result) ? $result->mail_ids : '';
    }

    public static function get_dest_cc_mail($dest, $dest_station) {
	$result = AerodromeMailsModel::where('is_active', 1)
			->where('destination_only', 1)
			->where(function ($query) use($dest, $dest_station) {
			    $query->where('aerodrome', $dest)
			    ->orWhere('aerodrome', $dest_station);
			})->first();
	return ($result) ? $result->mail_ids : '';
    }

    public static function get_airport_data($aerodrome = null) {
	if (!$aerodrome) {
	    $aerodrome = 'VOPC';
	}
	$result = AerodromeMailsModel::where('aerodrome', $aerodrome)->first();
	return $result;
    }

    /**
     * Always lower the email when we retrieve it
     */
    public function getAerodromeAttribute($value) {
	return strtoupper($value);
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

    /**
     * Always lower the email when we retrieve it
     */
    public function setAerodromeAttribute($value) {
	$this->attributes['aerodrome'] = strtoupper($value);
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
