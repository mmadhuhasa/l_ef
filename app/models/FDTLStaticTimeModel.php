<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FDTLStaticTimeModel extends Model {

    protected $table = "fdtl_static_time";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'reporting_time', 'flight_time', 'chocks_off', 'chocks_on',
        'duty_end_time', 'is_active');

    public static function get_single_row() {
        $result = FDTLStaticTimeModel::where('id', '1')->where('is_active', '1')->first();
        return $result;
    }

}
