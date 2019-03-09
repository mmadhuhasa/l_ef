<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DecodesModel extends Model {

    protected $table = 'notam_decodes';
    protected $fillable = array('id', 'code1', 'signification1', 'code2', 'signification2', 'status', 'created_at', 'updated_at');

    public static function getAll() {
        $result = DecodesModel::get(array('id', 'code1', 'signification1', 'code2', 'signification2', 'status', 'created_at', 'updated_at'));
        return $result;
    }

    public static function get_decodes($id) {
        $result = DecodesModel::where('id', $id)->first();
        return $result;
    }

    public static function update_decodes($id, $data) {
        $result = DecodesModel::where('id', $id)->update(array('code1'=>'code1'));
        return $result;
    }

    public static function get_Q_decoded_signification1($code1) {
        $result = DecodesModel::where('code1', $code1)->first();
        return ($result) ? $result->code1 : '';
    }

    public static function get_Q_decoded_signification2($code2) {
        $result = DecodesModel::where('code2', $code2)->first();
        return ($result) ? $result->code2 : '';
    }

}
