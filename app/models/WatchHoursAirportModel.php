<?php

namespace App\models;
use Illuminate\Database\Eloquent\Model;

class WatchHoursAirportModel extends Model
{
   protected $table = 'watch_hours_aerodrome_list';
   public $timestamps = false;
   protected $fillable = ['code','name'];
}
