<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FPLStatsUIModel extends Model {

    protected $table = 'fpl_stats_ui';
    protected $fillable = ['id', 'helicopter_plans', 'navlog_plans', 'weather_plans',
        'lnt_plans', 'runway_plans', 'is_active', 'is_delete', 'created_at', 'updated_at'];

    public static function get_all() {
        $result = self::where('is_active', 1)->first();
        return $result;
    }

    public static function update_stats($data) {
        $result = self::where('id', '1')->update($data);
    }

}
