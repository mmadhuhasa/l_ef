<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class NotamUsersModel extends Model {

    protected $table = 'notam_users';
    protected $fillable = array('notam_id', 'first_name', 'last_name', 'email', 'mobile_number', 'password', 'user_type',
        'membership_start_date', 'membership_expire_date', 'password_updated_at', 'last_login_time', 'operator',
        'airport1', 'airport2', 'airport3', 'airport4', 'airport5', 'all_airports', 'route1', 'route2', 'route3',
        'route4', 'route5', 'all_routes', 'description', 'status', 'created_at', 'updated_at');

    public function getAll() {
        $result = NotamUsersModel::get(array('notam_id', 'first_name', 'last_name', 'email', 'mobile_number', 'password', 'user_type',
                    'membership_start_date', 'membership_expire_date', 'password_updated_at', 'last_login_time', 'operator',
                    'airport1', 'airport2', 'airport3', 'airport4', 'airport5', 'all_airports', 'route1', 'route2', 'route3',
                    'route4', 'route5', 'all_routes', 'description', 'status', 'created_at', 'updated_at'));

        return $result;
    }

    public function get_users() {
        $result = NotamUsersModel::where('status', '1')->get();

        return $result;
    }

    public function select_single_user($id) {
        $result = NotamUsersModel::where('notam_id', $id)->first();

        return $result;
    }

    public function delete_notam_user($id) {
        $result = NotamUsersModel::where('notam_id', $id)->delete();

        return $result;
    }

    public function update_password($data) {
        $password = bcrypt($data['password']);
        $email = $data['email'];
        $result = NotamUsersModel::where('email', $email)->update(['password' => $password]);
        return $result;
    }

    public static function update_notam_user_details($id, $data) {
        $result = NotamUsersModel::where('notam_id', $id)->update(array('airport1'=>'VOBG'));
    }

}
