<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PhoneModel extends Model {

    protected $table = 'phone';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'customer_id', 'phone', 'created_at', 'updated_at', 'is_active'];

    /**
     * Get the user that owns the phone.
     */
    public function user() {
	return $this->belongsTo('App\User');
    }

}
