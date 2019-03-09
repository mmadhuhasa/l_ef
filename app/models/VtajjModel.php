<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class VtajjModel extends Model
{
    protected $table = 'lnt_vtajj_reference';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'fuel_weight', 'moment', 'is_active'];
}
