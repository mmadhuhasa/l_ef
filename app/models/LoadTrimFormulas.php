<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LoadTrimFormulas extends Model {

    protected $table = 'load_trim_formulas';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'formula', 'purpose', 'is_active', 'created_at', 'updated_at'];

    public static function get_all() {
	return LoadTrimFormulas::where('is_active', 1)->get();
    }

    public static function get_formula($name) {
	$result = LoadTrimFormulas::where('is_active', 1)->where('name', $name)->first();
	return $result;
    }

}
