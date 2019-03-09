<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TotalFTModel extends Model {

    protected $table = "fdtl_total_ft";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'no_of_plans', 'day', 'night');

    public static function getAll($total_count_fpl_plans) {
        $result = TotalFTModel::where('no_of_plans', $total_count_fpl_plans)->first();
        return $result;
    }

}
