<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SpeedModel extends Model
{
    protected $table = "speed";
	protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id','cs_id','cs_desc','status');

    public static function fetch_speed(){
	 return SpeedModel::get(array('cs_id'));
    }
}
