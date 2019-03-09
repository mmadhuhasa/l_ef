<?php

namespace App\models\weather;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model {

    protected $table = 'weather_metars';

    public function airport_name() {
        return $this->hasOne('App\models\StationsModel', 'aero_id', 'airport_code');
    }
    
    public function ta() {
        return $this->hasMany('App\models\weather\LongTaf','airport_code','airport_code')->orderBy('created_at', 'desc');
    }
}
