<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Handler extends Model
{
    protected $fillable = ['callsign', 'airport_code','city','handler_name','trim_handler_name','basic_rate',
        'royalty', 'gst_amount', 'total', 'created_at', 'updated_at'];
    
    public function setCallsignAttribute($value)
    {
        $this->attributes['callsign'] =strtoupper($value);
    } 
    public function setHandlerNameAttribute($value)
    {
        $this->attributes['handler_name'] =strtoupper($value);
    } 
}
