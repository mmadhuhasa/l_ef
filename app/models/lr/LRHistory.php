<?php

namespace App\models\lr;

use Illuminate\Database\Eloquent\Model;

class LRHistory extends Model {

    protected $table = 'lr_history';
    protected $fillable = ['id', 'updated_by', 'lr_licence_details_id', 'lr_licence_details_user_id',
        'lr_license_type_id', 'lr_from_date', 'lr_to_date', 'lr_is_active', 'lr_is_delete', 'lr_user_id2',
        'lr_license_type_id2', 'lr_from_date2', 'lr_to_date2', 'lr_is_active2', 'lr_is_delete2',
        'lr_action', 'ip_address', 'reason', 'udated_on', 'lr_renewed_date', 'lr_renewed_date2',
        'lr_license_number', 'lr_license_number2', 'license_name', 'license_name2', 'user_name', 'user_name2',
        'updated_on', 'is_active', 'is_delete', 'created_at',
        'updated_at'];

}
