<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Fuelpricerevision extends Model {

    protected $table = 'fuelprice_revision';
    protected $fillable = ['user_id', 'fuelprice_id',
        'eflight_price', 'basic_price', 'tax', 'from_date', 'to_date', 'status', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

}
