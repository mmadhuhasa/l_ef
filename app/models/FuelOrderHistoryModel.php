<?php

namespace App\models;
use Auth;
use Illuminate\Database\Eloquent\Model;

class FuelOrderHistoryModel extends Model {

    protected $table = "fuel_order_history";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = ['id', 'fpl_id', 'user_id', 'fuel_order', 'is_active', 'is_delete', 'created_at', 'updated_at'];

    public static function get_history($fpl_id) {
        $user_id = Auth::user()->id;
        $result = self::where('is_active', 1)->where('fpl_id', $fpl_id)
        // $result = self::where('is_active', 1)->where('user_id', $user_id)
                ->take(4)
                ->get(['fpl_id', 'user_id', 'fuel_order', 'updated_at']);
        return $result;
    }

}
