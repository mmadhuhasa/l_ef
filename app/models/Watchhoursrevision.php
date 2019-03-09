<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Watchhoursrevision extends Model {

    protected $table = 'watchhours_revision';
    protected $fillable = ['user_id', 'watchhours_id','status','created_at', 'updated_at'];
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

}
