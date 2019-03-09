<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FlightRuleModel extends Model
{
    protected $table = "flight_rule";
	protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id','fr_id','fr_desc','status');

    public static function fetchFlightRules(){
	 return FlightRuleModel::get(array('fr_id'));
    }
}
