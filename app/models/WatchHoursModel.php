<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class WatchHoursModel extends Model {

    protected $table = 'watch_hours';
    protected $fillable = ['aerodrome', 'monday_open',
        'monday_close', 'monday_remarks', 'tuesday_open', 'tuesday_close', 'tuesday_remarks', 'wednesday_open','wednesday_close', 'wednesday_remarks','thursday_open', 'thursday_close', 'thursday_remarks', 'friday_open', 'friday_close', 'friday_remarks','saturday_open','saturday_close','saturday_remarks','sunday_open','sunday_close','sunday_remarks','notam_no','w_start_date','w_end_date','remarks','notams','is_active','created_at', 'updated_at'];

    public static function getAll() {
        $result = WatchHoursModel::get(array('id', 'aerodrome', 'monday_open', 'monday_close', 'tuesday_open', 'tuesday_close',
                    'wednesday_open', 'wednesday_close', 'thursday_open', 'thursday_close', 'friday_open', 'friday_close', 'saturday_open',
                    'saturday_close', 'sunday_open', 'sunday_close', 'created_at', 'updated_at'));
        return $result;
    }

    public static function get_watch_hours_data($id) {
        $result = WatchHoursModel::where('id', $id)->first();
        return $result;
    }

    public static function get_aerodrome_watch_hours($aerodrome) {
        $result = WatchHoursModel::where('aerodrome', $aerodrome)->first();
        return $result;
    }
    
     public static function get_aerodrome_watch_hours2($aerodrome,$dow,$date_of_flight='') {
        $dow    =    strtolower($dow);      
        $date_of_flight = date('Y-m-d',  strtotime('20'.$date_of_flight));
        $result = WatchHoursModel::where('aerodrome', $aerodrome)
                ->where('w_start_date','<=', $date_of_flight)
                ->where('w_end_date','>', $date_of_flight)
                ->where($dow.'_open','!=', '')
                ->get([$dow.'_open',$dow.'_close']);
        
        return $result;
    }
    
    public static function update_aerodromes() {
        
    }
    
    public static function check_watch_hours($aerodrome, $date_of_flight,$time){
        $dow = strtolower(date('l',  strtotime('20'.$date_of_flight)));
        $get_aerodrome_watch_hours2 = self::get_aerodrome_watch_hours2($aerodrome, $dow,$date_of_flight);
        $count = count($get_aerodrome_watch_hours2);
        $watch_hour_data = [];
        $dow_open = $dow . '_open';
        $dow_close = $dow . '_close';
        foreach ($get_aerodrome_watch_hours2 as $get_watch_hours) {            
            $open = $get_watch_hours->$dow_open;
            $close= $get_watch_hours->$dow_close;
            if ($open == 'CLOSED' || $close == 'CLOSED') {
                $watch_hour_data[] = 'false';
            }else{
                if($time > $open && $time < $close){
                  $watch_hour_data[] = 'true';   
                }else{
                  $watch_hour_data[] = '';     
                }
            }
        }
        if($count){
        if(in_array('true', $watch_hour_data)){
            return 1;
        }else{
            return 0;
        }
        }else{
            return 1;
        }
    }
    public function user() {
        return $this->belongsTo('App\User', 'user_id');
    }
    

}
