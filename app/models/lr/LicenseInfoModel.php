<?php

namespace App\models\lr;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Log;

class LicenseInfoModel extends Model {

    protected $table = 'lr_license_info';
    public $timestamps = false;
    protected $fillable = ['id', 'operator_email_id', 'user_name', 'mobile_number', 'email', 'designation', 'password',
        'bcrypt', 'license_name', 'license_number', 'renewed_date', 'expire_date', 'remarks'];

}
