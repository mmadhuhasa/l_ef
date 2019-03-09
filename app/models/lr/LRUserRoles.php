<?php

namespace App\models\lr;

use Illuminate\Database\Eloquent\Model;

class LRUserRoles extends Model {

    protected $table = 'lr_user_roles';
    protected $fillable = ['id', 'name', 'is_active'];

}
