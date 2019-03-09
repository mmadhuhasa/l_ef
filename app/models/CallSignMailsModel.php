<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CallSignMailsModel extends Model {

    protected $table = "callsign_mails";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('aircraft_callsign', 'mail_ids', 'mobile_number', 'login_number', 'rnav', 'non_rnav', 'is_active');

    public static function getAll() {
	$result = CallSignMailsModel::get();
	return $result;
    }

    public static function get_callsign_data($id) {
	$result = CallSignMailsModel::where('id', $id)->first();
	return $result;
    }

    public function delete_record($id) {
	$result = CallSignMailsModel::where('id', $id)->delete();
	return $result;
    }

    public static function get_callsign_mail_id($aircraft_callsign) {
	$result = CallSignMailsModel::where('aircraft_callsign', $aircraft_callsign)
			->where('is_active', 1)->first();
	return ($result) ? $result->mail_ids : '';
    }

    public static function get_callsign_mobile_numbers($aircraft_callsign) {
	$result = CallSignMailsModel::where('aircraft_callsign', trim($aircraft_callsign))
			->where('is_active', 1)->first();
	return ($result) ? $result->mobile_number : '9739939581';
    }

}
