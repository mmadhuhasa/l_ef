<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'mobile_number', 'password', 'email', 'display_name', 'operator_name', 'user_type', 'cc_mails', 'bcc_mails', 'admin_mobile_numbers', 'callsigns', 'is_active','remember_token');

     public static function getAll(){
    	$result = UserModel::get();
    	return $result;
    }

    public static function get_form_data($id){
    	$result = UserModel::where('id',$id)->first();
    	return $result;
    }

    public function delete_record($id){
    	$result = UserModel::where('id',$id)->delete();
    	return $result;
    }

   
}
