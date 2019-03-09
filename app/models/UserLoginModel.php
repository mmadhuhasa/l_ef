<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserLoginModel extends Model {

    //
    protected $table = "userlogin";
    protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id', 'uname', 'password', 'displayname', 'opname', 'usermailid', 'status', 'remember_token');

    public static function loginFetch($mobile_number, $password) {
	return UserLoginModel::where('uname', '=', $mobile_number)->where('password', '=', $password)->first();
    }

}
