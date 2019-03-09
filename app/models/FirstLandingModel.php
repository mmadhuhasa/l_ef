<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FirstLandingModel extends Model
{
     protected $table = "fdtl_first_landing";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'ten_hours', 'fourty_five_min',
        'twelve_thirty', 'five_hours', 'twelve_hours', 
        'one_hour_thirty_min', 'fourteen_thirty', 'two_thirty');
    
    public static function getAll(){
       $result = FirstLandingModel::first();
       return $result;
    }
}
