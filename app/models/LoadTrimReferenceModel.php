<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LoadTrimReferenceModel extends Model {

    protected $table = 'load_trim_reference';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'fuel_in_lbs', 'main_percentage_mac', 'aux_percentage_mac',
	'tail_percentage_mac', 'is_active', 'created_at', 'updated_at'];

    public static function get_all() {
	return LoadTrimReferenceModel::where('is_active', 1)->get();
    }

    public static function get_main_percentage_mac2($fuel_in_lbs = '', $aux = '', $tail = '') {
	$result = LoadTrimReferenceModel::where('is_active', 1)
			->where(function($query) use($fuel_in_lbs, $aux, $tail) {
			    if ($fuel_in_lbs && $aux && $tail) {
				$bal_fuel = $fuel_in_lbs - 16888;
				$tail_fuel = round($bal_fuel / 3.65);
				$aux_fuel = $bal_fuel - $tail_fuel;
				if ($aux_fuel > 7168) {
				    $bal_aux_fuel = $aux_fuel - 7168;
				    $tail_fuel = $tail_fuel + $bal_aux_fuel;
				}
				$query->where('fuel_in_lbs', $tail_fuel);
			    } elseif ($fuel_in_lbs && $aux) {
				$bal_fuel = $fuel_in_lbs - 16888;
				$tail_fuel = round(($bal_fuel / 3.65), 2);
				$aux_fuel = $bal_fuel - $tail_fuel;
				if ($aux_fuel > 7168) {
				    $aux_fuel = 7168;
				}
				$query->where('fuel_in_lbs', $aux_fuel);
			    } else {
				if ($fuel_in_lbs > 9720) {
				    $fuel_in_lbs = 9720;
				}
				$query->where('fuel_in_lbs', $fuel_in_lbs);
			    }
			})->first();
	return $result;
    }

    public static function get_main_percentage_mac($fuel_in_lbs) {
	$result = LoadTrimReferenceModel::where('is_active', 1)
			->where('fuel_in_lbs', $fuel_in_lbs)->first();
	return $result;
    }

    public static function get_aux_percentage_mac($fuel_in_lbs) {
	$result = LoadTrimReferenceModel::where('is_active', 1)
			->where('fuel_in_lbs', $fuel_in_lbs)->first();
	return $result;
    }

    public static function get_tail_percentage_mac($fuel_in_lbs) {
	$result = LoadTrimReferenceModel::where('is_active', 1)
			->where('fuel_in_lbs', $fuel_in_lbs)->first();
	return $result;
    }

}
