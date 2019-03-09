<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TotalFDPModel extends Model
{
     protected $table = "fdtl_total_fdp";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'no_of_plans', 'fdp', 'max_12hours_for_min_rest_period');
    
    public static function get_max_fdp_for_first_landing($data) {
       $result =  TotalFDPModel::where('no_of_plans', $data)->first();
       return $result;
    }
}
