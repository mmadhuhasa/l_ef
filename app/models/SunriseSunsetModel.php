<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SunriseSunsetModel extends Model {

    protected $table = 'sunrise_sunset';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'aerodrome', 'day', 'date', 'month', 'year', 'sunrise', 'sunset'];

    public static function getAll() {
	$result = SunriseSunsetModel::where('is_active', 1)->get('id', 'aerodrome', 'day', 'date', 'month', 'year', 'sunrise', 'sunset');
	return $result;
    }

    public static function get_sunrise_sunset($aerodrome,$date) {
	    $result = SunriseSunsetModel::where('is_active', 1)
			    ->where('aerodrome', $aerodrome)
			    ->where('date', $date)->first();
	return $result;
    }

}
