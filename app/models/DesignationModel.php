<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DesignationModel extends Model {

    protected $table = 'designations';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'name', 'comments', 'is_active'];

    public static function get_all() {
        $result = DesignationModel::where('is_active', '1')
                        ->orderBy('id', 'asc')->select('name')->get();
        return $result;
    }

    public static function get_id_name($id = '', $name = '') {
        $result2 = '0';
        if ($id != '') {
            $result = DesignationModel::where('id', $id)->first(['name']);
            $result2 = ($result) ? $result->name : '';
        } else if ($name != '') {
            $result = DesignationModel::where('name', 'LIKE', $name)->first(['id']);
            $result2 = ($result) ? $result->id : '';
        }
        return $result2;
    }

}
