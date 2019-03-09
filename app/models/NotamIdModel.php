<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class NotamIdModel extends Model {

    protected $table = 'notam_id';
    protected $fillable = array('notam_id', 'admin_name', 'status', 'created_at', 'updated_at');

    public static function getAll() {
        $result = NotamRoutesModel::get(array('notam_id', 'admin_name', 'status', 'created_at', 'updated_at'));
        return $result;
    }
    public static function get_max_id(){
        $result = NotamIdModel::orderBy('notam_id','desc')->first();
        return ($result) ? $result->notam_id : '';
    }

}
