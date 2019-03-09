<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CallsignHandlersModel extends Model {

    protected $table = 'callsign_handlers';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id','aircraft_callsign','departure_airport','name','email', 'mobile_number','is_active'];

    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    public static $instance;
    public static $counter = 0;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance() {
	if (!isset(CallsignHandlersModel::$instance)) {
	    CallsignHandlersModel::$instance = new CallsignHandlersModel();
	}

	return CallsignHandlersModel::$instance;
    }

    public static function get_all() {
	$result = CallsignHandlersModel::where('is_active', 1)->get();
	return $result;
    }

    public static function get_callsign_handlers($aircraft_callsign = '', $departure_aerodrome = '') {
	if (!$aircraft_callsign) {
	    $aircraft_callsign = 'TESTA';
	}
	if (!$departure_aerodrome) {
	    $departure_aerodrome = 'VOPC';
	}
	$result = CallsignHandlersModel::where('is_active', 1)			
			->where('departure_airport', $departure_aerodrome)->first();
	return $result;
    }
    

}
