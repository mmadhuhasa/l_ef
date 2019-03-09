<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class WeightCategoryModel extends Model {

    protected $table = "weight_category";
    protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'wt_id', 'wt_desc', 'status', 'order');

    public static function fetch_wt_category() {
	return WeightCategoryModel::get(array('wt_id'));
    }

}
