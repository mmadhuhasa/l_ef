<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LntCalculatedValuesModel extends Model
{
    protected $table = 'lnt_calculated_values';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = ['id', 'fuel_weight', 'cg_value', 'is_active', 'created_at', 'updated_at'];
    
    
    
}
