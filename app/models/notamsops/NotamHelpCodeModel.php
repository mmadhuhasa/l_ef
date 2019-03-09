<?php

namespace App\models\notamsops;

use Illuminate\Database\Eloquent\Model;

class NotamHelpCodeModel extends Model
{
    protected $table = "notam_help_codes";
    protected $primaryKey = "id";
    public $timestamps = true;

    public static function getAll(){
    	$result = NotamHelpCodeModel::get();
    	return $result;
    }
    public static function getSignification($code,$grp_num){
    	$result = NotamHelpCodeModel::where('code','=',$code)->where('group_number','=',$grp_num)->first();
    	return $result;
    }
  
}
