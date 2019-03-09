<?php

namespace App\models\navlog;

use Illuminate\Database\Eloquent\Model;

class NavLogRecords extends Model {

    protected $table = "navlog_records";
    protected $primaryKey = "id";
    public $timestamps = false;

    public static function getAll() {
        $result = NotamsModel::all();
        return $result;
    }

}
