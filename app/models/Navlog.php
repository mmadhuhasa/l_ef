<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Navlog extends Model
{
    protected $fillable = ['user_id','plan_status','navlog_masterid','no_of_flight', 'flight_date','callsign','registration',
        'departure','dep_airport_name','destination','dest_airport_name','dep_time','pax','load','fuel','min_max','pilot','mobile','co_pilot','cabin','remarks','dept_place','dept_lat','dest_place','dest_lat','speed','level1','main_route','alternate1','alt1_airport_name','level2','alternate1route','alternate2','alt2_airport_name','level3','alternate2route','take_off_alternate','toff_airport_name','level4','take_off_alternate_route','adc_updated_by','adc_updated_time','created_at','updated_at','deptime_ist','fic','adc','live_test_mode','filed_date','navlog_no','txtspeed','speed_change','text_speed_change','level1_change','main_route_change','alternate1_change','alternate2_change','remarks_change','co_pilot_change','mobile_change','pilot_change','take_off_alternate_route_change','level4_change','fuel_change','alternate2route_change','level3_change','alternate1route_change','level2_change','load_change','pax_change','cabin_change','take_off_altn_change','registration_change','dep_time_change','flying_time','block_fuel','route','distance','navlog_load','min_fuel','max_fuel','altn','altn_dis','flight_rules','flight_type','aircraft_type','weight_category','equipment', 'transponder','crushing_speed_indication','flight_level_indication','endurance_hours','endurance_minutes','indian','foreigner','foreigner_nationality','cabincrew','operator','sel','fir_crossing_time','pbn','nav', 'code','per','tcas','credit','no_credit','emergency_uhf', 'emergency_vhf','emergency_elba', 'polar', 'desert', 'maritime', 'jungle', 'light', 'floures', 'jacket_uhf', 'jacket_vhf','number', 'capacity', 'cover', 'color', 'aircraft_color','fpl_id','is_etd_changed'];

    public function setFlightDateAttribute($value)
    {
        $this->attributes['flight_date'] = date('Ymd', strtotime($value));
    } 
    // public function setDepTimeAttribute($value)
    // {
    //     $this->attributes['dep_time'] = substr($value,0,2).substr($value,5,2);
    // }  
    public function setCallsignAttribute($value)
    {
        $this->attributes['callsign'] =strtoupper($value);
    }  
    public function setRegistrationAttribute($value)
    {
        $this->attributes['registration'] =strtoupper($value);
    } 
    public function setDepartureAttribute($value)
    {
        $this->attributes['departure'] =strtoupper($value);
    }
    public function setDepAirportNameAttribute($value)
    {
        $this->attributes['dep_airport_name'] =strtoupper($value);
    }
    public function setDestinationAttribute($value)
    {
        $this->attributes['destination'] =strtoupper($value);
    }
    public function setDestAirportNameAttribute($value)
    {
        $this->attributes['dest_airport_name'] =strtoupper($value);
    }
    public function setPilotAttribute($value)
    {
        $this->attributes['pilot'] =strtoupper($value);
    }  
    public function setCopilotAttribute($value)
    {
        $this->attributes['co_pilot'] = strtoupper($value);
    }   
    public function setRemarksAttribute($value)
    {
        $this->attributes['remarks'] = strtoupper($value);
    }  
    public function setDeptPlaceAttribute($value)
    {
        $this->attributes['dept_place'] = strtoupper($value);
    }  
    public function setDeptLatAttribute($value)
    {
        $this->attributes['dept_lat'] = strtoupper($value);
    }  
    public function setDestPlaceAttribute($value)
    {
        $this->attributes['dest_place'] = strtoupper($value);
    }  
    public function setDestLatAttribute($value)
    {
        $this->attributes['dest_lat'] =strtoupper($value);
    }   
    public function setLevel1Attribute($value)
    {
        $this->attributes['level1'] = strtoupper($value);
    }
    public function setMainRouteAttribute($value)
    {
        $this->attributes['main_route'] = strtoupper($value);
    }      
    public function setAlternate1Attribute($value)
    {
        $this->attributes['alternate1'] = strtoupper($value);
    } 
    public function setAlt1AirportNameAttribute($value)
    {
        $this->attributes['alt1_airport_name'] =strtoupper($value);
    }
    public function setLevel2Attribute($value)
    {
        $this->attributes['level2'] = strtoupper($value);
    } 
    public function setAlternate1routeAttribute($value)
    {
        $this->attributes['alternate1route'] = strtoupper($value);
    }
    public function setAlternate2Attribute($value)
    {
        $this->attributes['alternate2'] = strtoupper($value);
    } 
    public function setAlt2AirportNameAttribute($value)
    {
        $this->attributes['alt2_airport_name'] =strtoupper($value);
    }
    public function setLevel3Attribute($value)
    {
        $this->attributes['level3'] = strtoupper($value);
    } 
    public function setAlternate2routeAttribute($value)
    {
        $this->attributes['alternate2route'] = strtoupper($value);
    }  
    public function setTakeOffAlternateAttribute($value)
    {
        $this->attributes['take_off_alternate'] = strtoupper($value);
    } 
    public function setToffAirportNameAttribute($value)
    {
        $this->attributes['toff_airport_name'] =strtoupper($value);
    }
    public function setLevel4Attribute($value)
    {
        $this->attributes['level4'] = strtoupper($value);
    }  
    public function setTakeOffAlternateRouteAttribute($value)
    {
        $this->attributes['take_off_alternate_route'] = strtoupper($value);
    }  
    public function setTxtspeedAttribute($value)
    {
        $this->attributes['txtspeed'] = strtoupper($value);
    } 
    public function setAltnAttribute($value)
    {
        $this->attributes['altn'] = strtoupper($value);
    } 
}
