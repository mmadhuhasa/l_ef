<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Auth;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    use Authenticatable,
        Authorizable,
        CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'operator_user_id', 'user_role_id', 'total_crew', 'name', 'email', 'password',
        'mobile_number', 'operator', 'additional_emails','user_callsigns', 'is_admin', 'is_users_admin', 'user_type',
        'is_fpl', 'is_fdtl', 'is_navlog', 'is_lnt', 'is_notams', 'is_weather', 'is_lr', 'is_runway', 'is_billing',
        'is_active', 'is_delete', 'is_app', 'updated_by'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function phone() {
        return $this->hasOne('App\models\PhoneModel');
    }

    public static function get_user_details($email = '', $mobile_number = '', $id = '') {
        $result = "";
        if ($email != "") {
            $result = User::where('is_active', 1)->where('email', $email)->first();
        } else if ($mobile_number != "") {
            $result = User::where('is_active', 1)
                            ->where('mobile_number', $mobile_number)->first();
        } else if ($id != "") {
            $result = User::where('is_active', 1)->where('id', $id)->first();
        }
        return ($result) ? $result : '';
    }

    public function web_notifications() {
        return $this->hasMany('App\models\WebNotificationsModel')->orderBy('id', 'desc');
    }

    public function getNameAttribute($value) {
        return strtoupper($value);
    }

    /**
     * Always lower the email when we retrieve it
     */
    public function getEmailAttribute($value) {
        return strtolower($value);
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = strtoupper($value);
    }

    /**
     * Always lower the email when we retrieve it
     */
    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }

    public function getOperatorAttribute($value) {
        return strtoupper($value);
    }

    public function setOperatorAttribute($value) {
        $this->attributes['operator'] = strtoupper($value);
    }

    public static function get_user_name($mobile_number) {
        $result = User::where('mobile_number', $mobile_number)->where('is_active', '1')->first();
        return $result;
    }

    public static function get_lr_user_list() {
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->user_role_id;
        $lr_users_list = User::where('is_active', 1)
                ->where('is_lr', 1)
                ->where(function($query) use($user_role_id, $user_id) {
                    if ($user_role_id == 4) {
                        $query->where('id', $user_id);
                    } elseif ($user_role_id == 3) {
                        $query->where('operator_user_id', $user_id);
                    }
                })
                ->orderBy('name', 'asc')
                ->get(['id', 'name']);
//        if (in_array(Auth::user()->user_role_id, [1, 2, 3])) {
//            $lr_users_list = User::where('is_active', 1)
//                    ->where('is_lr', 1)
//                    ->orderBy('name', 'asc')
//                    ->get(['id', 'name']);
//        }
        return $lr_users_list;
    }

    public static function get_user_callsigns($user_id, $term="", $ops = "") {
        $callv = "";
        $new_cs = "";
        if ($ops == "") {
            $result = User::where("is_active", '1')
                    ->where("id", $user_id)
                    ->first(['user_callsigns']);
            $callv = $result->user_callsigns;
        } else {
            $result = User::where("is_active", '1')
                    ->where("user_callsigns", "LIKE", "%$term%")
                    ->get(['user_callsigns']);
            
            foreach ($result as $value) {
                $css = $value->user_callsigns;
                $callv  .= $css.",";
            }
        }
        $callv = trim($callv,",");
        $user_callsigns = ($callv) ? explode(",", $callv) : "";
        $user_callsigns =  (is_array($user_callsigns)) ? array_unique($user_callsigns) : [];
        
        foreach ($user_callsigns as $value) {
            if(strpos($value, $term) !== FALSE){
                $new_cs[] = $value;
            }
        }
        
        (is_array($new_cs)) ? sort($new_cs) : "";
        $new_cs =  (is_array($new_cs)) ? array_slice($new_cs, 0, 20) : [];
        return $new_cs;
    }

}
