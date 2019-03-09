<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LatLongElevation extends Model
{
    protected $table = 'lat_long_elevation';   
    protected $fillable = ['lattitude', 'longitude','elevation', 'is_active'];
    
    
}
