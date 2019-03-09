<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TransponderModeModel extends Model
{
    protected $table = "transponder_mode";
	protected $primarykey = "id";
    public $timestamps = true;
    protected $fillable = array('id','tm_id','tm_desc','status');

    public static function fetch_transport_mode(){
	 return TransponderModeModel::get(array('tm_id'));
    }
}
