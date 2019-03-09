<?php
namespace App\models\airport;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $guarded = ['id']; 
    public function near_by_airport()
    {
        return $this->hasMany('App\models\airport\Nearbyairport','locid', 'id');
    }
    public function radail()
    {
        return $this->hasMany('App\models\airport\Radail','locid', 'id');
    }
    public function bearing()
    {
        return $this->hasMany('App\models\airport\Bearing','locid', 'id');
    }
    public function runway()
    {
        return $this->hasMany('App\models\airport\Runway','locid', 'id');
    }
    public function communication()
    {
        return $this->hasMany('App\models\airport\Communication','locid', 'id');
    }
    public function operation()
    {
        return $this->hasOne('App\Operation','locid', 'id');
    }
    public function watchhours()
    {
         return $this->hasMany('App\models\WatchHoursModel','aerodrome', 'airport_code');
    }
}
