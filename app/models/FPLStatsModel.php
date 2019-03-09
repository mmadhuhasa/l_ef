<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FPLStatsModel extends Model {
    protected $table = 'fpl_stats';
    protected $fillable = ['id', 'fpl_id', 'user_id','date_of_flight', 'filed_time', 'cancelled_by', 'cancelled_time', 'revised_by',
        'revised_time', 'adc_updated_by', 'adc_updated_time', 'changed_by', 'changed_time', 'created_at', 'updated_at'];

}
