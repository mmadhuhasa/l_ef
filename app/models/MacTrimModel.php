<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MacTrimModel extends Model {

    protected $table = 'mac_trim';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'percentage_mac', 'trim', 'is_active', 'created_at', 'updated_at'];

    public static function get_all() {
	return MacTrimModel::where('is_active', 1)->get();
    }

    public static function get_mac_trim($percentage_mac = '', $trim = '') {
	$result = MacTrimModel::where('is_active', 1)
			->where(function($query) use($trim, $percentage_mac) {
			    if ($percentage_mac) {
				$query->where('percentage_mac', $percentage_mac);
			    }
			    if ($trim) {
				$query->where('trim', $trim);
			    }
			})->first();

	return $result;
    }

}
