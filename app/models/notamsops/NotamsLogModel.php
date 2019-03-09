<?php

namespace App\models\notamsops;

use Illuminate\Database\Eloquent\Model;

class NotamsLogModel extends Model {

    protected $table = "notam_update_logs";
    protected $primaryKey = "id";
    public $timestamps = true;

}

?>