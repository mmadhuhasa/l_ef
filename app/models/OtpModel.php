<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class OtpModel extends Model {

    public $table = "otp";
    protected $fillable = ['id', 'user_id', 'otp', 'is_active', 'created_at', 'updated_at'];

}
