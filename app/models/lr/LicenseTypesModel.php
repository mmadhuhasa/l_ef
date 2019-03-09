<?php

namespace App\models\lr;

use Illuminate\Database\Eloquent\Model;
use App\models\lr\LicenseTypesModel;

class LicenseTypesModel extends Model {

    protected $table = 'lr_license_types';
    protected $fillable = ['id', 'short_name', 'name', 'number','license_type', 'is_active'];

    public static function get_license_type($id = '', $name = '') {
        $result = '0';
        if ($name != '') {
            $license_type = LicenseTypesModel::where('is_active', 1)
                    ->where(function($query) use($name) {
                        $query->where('name', 'LIKE', $name . '%')
                        ->orWhere('short_name', 'LIKE', $name . '%');
                    })
                    ->first(['id']);
            $result = ($license_type) ? $license_type->id : '0';
        } else if ($id != "") {
            $license_type = LicenseTypesModel::where('is_active', 1)
                    ->where('id', $id)
                    ->first(['short_name']);
            $result = ($license_type) ? $license_type->short_name : '0';
        }
        return $result;
    }

}
