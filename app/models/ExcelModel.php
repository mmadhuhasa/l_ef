<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ExcelModel extends Model {

    protected $table = "new_excel";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = array('id', 'Date', 'Aircraft', 'SignOn', 'OffBlock', 'OnBlock', 'SignOff', 'landings', 'duty_tyme', 'flying_time');

    
    public static function getAll(){
	return ExcelModel::get();
    }
    
    public static function getsigndata($date){
	return ExcelModel::where('Date',$date)->first();
    }
    
    public static function update_data($date,$data){
	$res = ExcelModel::where('Date',$date)->update($data);
	return $res;
    }
    
     public static function landings($date){
	$res = ExcelModel::where('Date',$date)->count();
	return $res;
    }
    
    
//    public static function maxSignOff($date){
//	return ExcelModel::where('Date',$date)->max('SignOff');
//    }
//    
//     public static function minSignOn($date){
//	return ExcelModel::where('Date',$date)->min('SignOn');
//    }
//    
//     public static function maxOnBlock($date){
//	return ExcelModel::where('Date',$date)->max('OnBlock');
//    }
//    
//     public static function minOffBlock($date){
//	return ExcelModel::where('Date',$date)->min('OffBlock');
//    }
    
}
