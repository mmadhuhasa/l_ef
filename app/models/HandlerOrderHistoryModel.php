<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class HandlerOrderHistoryModel extends Model
{
	 
	protected $table = 'handler_order_history'; 
    protected $fillable = ['user_id', 'handler_id',
       'fpl_id','remarks','created_at', 'updated_at'];
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }   
}
