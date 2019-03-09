<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class Handlerrevision extends Model
{
   protected $table = 'handler_revision';
   protected $fillable = ['user_id', 'handler_id',
       'callsign', 'handler', 'basic_rate', 'royalty','status','created_at', 'updated_at'];

   public function user() {
       return $this->belongsTo('App\User', 'user_id');
   }
}
