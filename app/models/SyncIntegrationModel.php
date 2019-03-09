<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class SyncIntegrationModel extends Model {
    protected $table = "sync_integration";
    protected $primaryKey = "id";
    public $timestamps = true;
    protected $fillable = ['id', 'is_fpl', 'is_mng', 'is_evening', 'sync_time','date_of_sync', 'is_active', 'is_delete',
        'created_at', 'updated_at'];

}
