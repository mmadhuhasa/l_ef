<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Newaircraft extends Model
{
    protected $table = 'aircraft_tbl';
    // protected $fillable = ['type', 'operator','callsign',
    //     'subject', 'email_date', 'email_completed_by', 'completed_time', 'status', 'remarks','action','created_at', 'updated_at'];
     public function user() {
         return $this->belongsTo('App\User', 'user_id');
     }
}
