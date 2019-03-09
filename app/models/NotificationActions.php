<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class NotificationActions extends Model {

    protected $table = "notification_actions";
    protected $PrimaryKey = "id";
    public $timestamps = true;
    protected $fillable = ['id', 'action', 'is_active', 'is_delete', 'created_at', 'updated_at'];

    public function getAll() {
	$result = NotificationActions::get(['id', 'action', 'is_active', 'is_delete', 'created_at', 'updated_at']);
	return $result;
    }

    public function web_notifications() {
	return $this->hasMany('\App\models\WebNotificationsModel');
    }

}
