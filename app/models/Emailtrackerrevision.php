<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Emailtrackerrevision extends Model
{
    protected $table = 'email_trackers_revisions';
    protected $fillable = ['type','emailtracker_id','user_id','operator','callsign',
        'subject', 'email_date', 'email_completed_by', 'completed_time', 'status', 'remarks','action','created_at', 'updated_at'];
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }    

}
