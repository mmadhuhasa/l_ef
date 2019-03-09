<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Fuelprice extends Model {

    protected $fillable = ['user_id', 'airport_code', 'city', 'fuel_type',
        'eflight_price', 'basic_price', 'tax', 'tax_amount', 'hp_price', 'from_date', 'to_date', 'status', 'created_at', 'updated_at'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }

}
