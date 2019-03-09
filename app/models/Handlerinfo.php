<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Handlerinfo extends Model
{
    protected $fillable = ['handler_name', 'address','contact_name1','contact_name2','contact_name3','designation1',
        'designation2', 'designation3', 'email1', 'email2', 'email3', 'mobile1', 'mobile2', 'mobile3', 'created_at', 'updated_at'];
    
}
