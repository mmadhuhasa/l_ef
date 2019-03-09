<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TransportTimeModel extends Model
{
    protected $table = "fdtl_transport_time";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'transport_time_period');
    
    public static function get_transport_time($data) {
        
       $result =  TransportTimeModel::where('id',$data);
       return $result;
        
    }
}
