<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DayNightTimeModel extends Model
{
    protected $table ="fdtl_day_night_timings";
    protected $primarykey="id";
    public $timestamps = true;
    protected $fillable = array('id', 'day_time_from', 'day_time_to', 'night_time_from', 'night_time_to');
     public static function getAll() {
	$result = DayNightTimeModel::where('id', '2')->first();
	return $result;
    }
}
