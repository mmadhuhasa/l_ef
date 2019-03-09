<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FlightLevelModel extends Model {

    protected $table = "flight_level";
    protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'fl_id', 'fl_desc', 'status');

    public static function fetch_Flight_Level() {
	return FlightLevelModel::get(array('fl_id'));
    }

}
