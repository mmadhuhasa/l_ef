<?php

namespace App\models\lr;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Log;
use App\User;

class LicenseDetailsModel extends Model {

    protected $table = 'lr_license_details';
    protected $fillable = ['id', 'operator_user_id', 'user_id', 'license_type_id', 'number',
        'from_date', 'to_date', 'renewed_date', 'license_status', 'message', 'added_at', 'file_name',
        'file_size', 'mime_type', 'file_original_name','added_by',
        'is_active', 'is_delete', 'created_at', 'updated_at'];

    public static function get_lr_count($user_id, $user_type, $type, $user_name = '', $lt = '') {
        $current_date = date('ymd');
        $due_date = date('ymd', strtotime("+31 days"));
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->user_role_id;
        $result = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                        ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                        ->where('lr_license_details.is_active', 1)
                        ->where('lr_license_details.is_delete', 0)
                        ->where('users.is_active', 1)
                        ->where(function($query) use($user_role_id, $user_id, $type, $current_date, $due_date, $user_name, $lt) {
                            switch ($user_role_id) {
                                case 0:
                                    $query->where('users.id', $user_id);
                                    break;
                                case 4:
                                    $query->where('users.id', $user_id);
                                    break;
                                case 3:
                                    $query->where('users.operator_user_id', $user_id);
                                    break;
                                default:
                                    break;
                            }

                            if ($user_name != '') {
                                $query->where('users.name', '=', $user_name);
                            }
                            if ($lt != '') {
                                $query->where('lr_license_types.name', '=', $lt);
                            }
                            switch ($type) {
                                case 1:
                                    $query->where('to_date', '<', $current_date);
                                    break;
                                case 2:
                                    $query->where('to_date', '>=', $current_date);
                                    break;
                                case 3:
                                    $query->where('to_date', '>=', $current_date);
                                    $query->where('to_date', '<', $due_date);
                                    break;
                                default:
                                    break;
                            }
                        })->count();

        return $result;
    }

    public static function search_lr_count($data) {
        $user_id = Auth::user()->id;
        $user_type = (array_key_exists('user_type', $data)) ? $data['user_type'] : '';
        $type = (array_key_exists('type', $data)) ? $data['type'] : '';
        $filter_user_name = (array_key_exists('filter_user_name', $data)) ? $data['filter_user_name'] : '';
        $filter_license_type = (array_key_exists('filter_license_type', $data)) ? $data['filter_license_type'] : '';
        $filter_from_date = (array_key_exists('filter_from_date', $data)) ? date('ymd', strtotime($data['filter_from_date'])) : '';
        $filter_to_date = (array_key_exists('filter_to_date', $data)) ? date('ymd', strtotime($data['filter_to_date'])) : '';

        $filter_operator = (array_key_exists('filter_operator', $data)) ? $data['filter_operator'] : '';
        $op_det = User::where('operator', 'LIKE', "%".$filter_operator."%")->where('is_active',1)
                ->first(['id','operator_user_id', 'name', 'email']);
        $ops_user_id = ($op_det) ? $op_det->operator_user_id : '0';

        $s_type = (array_key_exists('s_type', $data)) ? $data['s_type'] : '';

        $current_date = date('ymd');
        $due_date = date('ymd', strtotime("+31 days"));
        $user_role_id = Auth::user()->user_role_id;
        $operator_user_id = Auth::user()->operator_user_id;

//        print_r($data);exit;

        $result = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                        ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                        ->where('lr_license_details.is_active', 1)
                        ->where('lr_license_details.is_delete', 0)
                        ->where('users.is_active', 1)
                        ->where(function($query) use($filter_license_type, $filter_user_name, $filter_from_date, $filter_to_date, $user_role_id, $operator_user_id, $filter_operator, $ops_user_id, $s_type,$user_id) {
                            if ($filter_license_type != '') {
                                $query->where('lr_license_types.name', 'LIKE', '%' . $filter_license_type . '%');
                            }if ($filter_user_name != '') {
                                $query->where('users.name', 'LIKE', '%' . $filter_user_name . '%');
                            }
                            if ($s_type != 'fields') {
                                $query->whereBetween('lr_license_details.to_date', [$filter_from_date, $filter_to_date]);
                            }
                            if ($user_role_id == '3') {
                                $query->where('users.operator_user_id', $operator_user_id);
                            }
                            if ($user_role_id == '4') {
                                $query->where('users.id', $user_id);
                            }
                            if ($filter_operator != "") {
                                $query->where('users.operator_user_id', $ops_user_id);
                            }
                        })
                        ->where(function($query) use($user_type, $user_id, $type, $current_date, $due_date) {
                            switch ($type) {
                                case 1:
                                    $query->where('to_date', '<', $current_date);
                                    break;
                                case 2:
                                    $query->where('to_date', '>=', $current_date);
                                    break;
                                case 3:
                                    $query->where('to_date', '>=', $current_date);
                                    $query->where('to_date', '<', $due_date);
                                    break;
                                default:
                                    break;
                            }
                        })->count();
        return $result;
    }

    public static function delete_license($id) {
        $result = LicenseDetailsModel::where('id', $id)->delete();
        return $result;
    }

    public static function get_license_details($id) {
        try {
            $result = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                            ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                            ->select('users.operator_user_id', 'lr_license_details.from_date', 'lr_license_details.renewed_date', 'lr_license_details.to_date', 'lr_license_details.number', 'lr_license_details.file_name', 'lr_license_details.mime_type', 'lr_license_details.file_original_name', 'lr_license_details.license_type_id', 'lr_license_types.name as lr_license_name', 'users.name as user_name', 'users.id as user_id','lr_license_details.message', 'users.email')
                            ->where('lr_license_details.is_active', 1)
                            ->where('lr_license_details.is_delete', 0)
                            ->where('lr_license_details.id', $id)->first();

            return $result;
        } catch (\Exception $ex) {
            Log::info("Delete LIcense " . $ex->getMessage());
        }
    }

    public static function get_due_records() {
        $current_date = date('ymd');
        $due_date = date('ymd', strtotime("+31 days"));

        $p_60_days = date('ymd', strtotime("+60 days"));
        $p_30_days = date('ymd', strtotime("+30 days"));
        $p_15_days = date('ymd', strtotime("+15 days"));
        $p_7_days = date('ymd', strtotime("+7 days"));
        $p_6_days = date('ymd', strtotime("+6 days"));
        $p_5_days = date('ymd', strtotime("+5 days"));
        $p_4_days = date('ymd', strtotime("+4 days"));
        $p_3_days = date('ymd', strtotime("+3 days"));
        $p_2_days = date('ymd', strtotime("+2 days"));
        $p_1_days = date('ymd', strtotime("+1 days"));
        $p_0_days = date('ymd');
        $s_1_days = date('ymd', strtotime("-1 days"));
        $s_2_days = date('ymd', strtotime("-2 days"));
        $s_3_days = date('ymd', strtotime("-3 days"));
        $s_4_days = date('ymd', strtotime("-4 days"));
        $s_5_days = date('ymd', strtotime("-5 days"));
        $s_6_days = date('ymd', strtotime("-6 days"));
        $s_7_days = date('ymd', strtotime("-7 days"));
        $s_15_days = date('ymd', strtotime("-15 days"));
        $s_30_days = date('ymd', strtotime("-30 days"));

        $auto_dates = [
            $p_60_days,
            $p_30_days,
            $p_15_days,
            $p_7_days,
            $p_6_days,
            $p_5_days,
            $p_4_days,
            $p_3_days,
            $p_2_days,
            $p_1_days,
            $p_0_days,
            $s_1_days,
            $s_2_days,
            $s_3_days,
            $s_4_days,
            $s_5_days,
            $s_6_days,
            $s_7_days,
            $s_15_days,
            $s_30_days,
        ];

        $result = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
//                ->where('lr_license_details.is_active', 1)
//                ->where('lr_license_details.is_delete', 0)
                ->where('users.is_active', 1)
//                ->where(function($query) use($current_date, $due_date,$auto_dates) {
//                    $query->whereIn('to_date', $auto_dates);
//                })
                ->whereIn('to_date', $auto_dates)
                ->select(['users.email as email'])
                ->groupBy('users.email')
                ->get();
//        print_r($result);exit;
        return $result;
    }

    public static function get_due_records2($email) {
        $current_date = date('ymd');
        $due_date = date('ymd', strtotime("+31 days"));

        $p_60_days = date('ymd', strtotime("+60 days"));
        $p_30_days = date('ymd', strtotime("+30 days"));
        $p_15_days = date('ymd', strtotime("+15 days"));
        $p_7_days = date('ymd', strtotime("+7 days"));
        $p_6_days = date('ymd', strtotime("+6 days"));
        $p_5_days = date('ymd', strtotime("+5 days"));
        $p_4_days = date('ymd', strtotime("+4 days"));
        $p_3_days = date('ymd', strtotime("+3 days"));
        $p_2_days = date('ymd', strtotime("+2 days"));
        $p_1_days = date('ymd', strtotime("+1 days"));
        $p_0_days = date('ymd');
        $s_1_days = date('ymd', strtotime("-1 days"));
        $s_2_days = date('ymd', strtotime("-2 days"));
        $s_3_days = date('ymd', strtotime("-3 days"));
        $s_4_days = date('ymd', strtotime("-4 days"));
        $s_5_days = date('ymd', strtotime("-5 days"));
        $s_6_days = date('ymd', strtotime("-6 days"));
        $s_7_days = date('ymd', strtotime("-7 days"));
        $s_15_days = date('ymd', strtotime("-15 days"));
        $s_30_days = date('ymd', strtotime("-30 days"));

        $auto_dates = [
            $p_60_days,
            $p_30_days,
            $p_15_days,
            $p_7_days,
            $p_6_days,
            $p_5_days,
            $p_4_days,
            $p_3_days,
            $p_2_days,
            $p_1_days,
            $p_0_days,
            $s_1_days,
            $s_2_days,
            $s_3_days,
            $s_4_days,
            $s_5_days,
            $s_6_days,
            $s_7_days,
            $s_15_days,
            $s_30_days,
        ];


        $result1 = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                ->where('lr_license_details.is_active', 1)
                ->where('lr_license_details.is_delete', 0)
                ->where('users.email', $email)
//                ->where('users.is_active', 1)
                ->whereIn('to_date', $auto_dates)
                ->where('to_date', '<', $current_date)
                ->orderBy('lr_license_details.to_date', 'desc')
                ->select(['users.name as user_name', 'lr_license_types.name as license_name', 'lr_license_types.license_type', 'lr_license_details.to_date as to_date','lr_license_details.number as l_number'])
                ->get();

        $result2 = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                ->where('lr_license_details.is_active', 1)
                ->where('lr_license_details.is_delete', 0)
                ->where('users.email', $email)
                ->where('users.is_active', 1)
                ->whereIn('to_date', $auto_dates)
                ->where('to_date', '>=', $current_date)
                ->orderBy('lr_license_details.to_date', 'asc')
                ->select(['users.name as user_name', 'lr_license_types.name as license_name', 'lr_license_types.license_type', 'lr_license_details.to_date as to_date','lr_license_details.number as l_number'])
                ->get();
        $result = array_merge($result1->toArray(), $result2->toArray());
        $result = json_decode(json_encode($result));
        return $result;
    }

    public static function get_operator_due_records() {
        $current_date = date('ymd');
        $due_date = date('ymd', strtotime("+31 days"));

        $p_60_days = date('ymd', strtotime("+60 days"));
        $p_30_days = date('ymd', strtotime("+30 days"));
        $p_15_days = date('ymd', strtotime("+15 days"));
        $p_7_days = date('ymd', strtotime("+7 days"));
        $p_6_days = date('ymd', strtotime("+6 days"));
        $p_5_days = date('ymd', strtotime("+5 days"));
        $p_4_days = date('ymd', strtotime("+4 days"));
        $p_3_days = date('ymd', strtotime("+3 days"));
        $p_2_days = date('ymd', strtotime("+2 days"));
        $p_1_days = date('ymd', strtotime("+1 days"));
        $p_0_days = date('ymd');
        $s_1_days = date('ymd', strtotime("-1 days"));
        $s_2_days = date('ymd', strtotime("-2 days"));
        $s_3_days = date('ymd', strtotime("-3 days"));
        $s_4_days = date('ymd', strtotime("-4 days"));
        $s_5_days = date('ymd', strtotime("-5 days"));
        $s_6_days = date('ymd', strtotime("-6 days"));
        $s_7_days = date('ymd', strtotime("-7 days"));
        $s_15_days = date('ymd', strtotime("-15 days"));
        $s_30_days = date('ymd', strtotime("-30 days"));

        $auto_dates = [
            $p_60_days,
            $p_30_days,
            $p_15_days,
            $p_7_days,
            $p_6_days,
            $p_5_days,
            $p_4_days,
            $p_3_days,
            $p_2_days,
            $p_1_days,
            $p_0_days,
            $s_1_days,
            $s_2_days,
            $s_3_days,
            $s_4_days,
            $s_5_days,
            $s_6_days,
            $s_7_days,
            $s_15_days,
            $s_30_days,
        ];

        $result = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.operator_user_id')
                ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
//                ->where('lr_license_details.is_active', 1)
//                ->where('lr_license_details.is_delete', 0)
                ->where('users.is_active', 1)
                ->where(function($query) use($current_date,$auto_dates){
                    $query->whereIn('to_date', $auto_dates)->oRwhere('to_date' , '<=', $current_date);
                })
                ->select(['users.email as email'])
                ->groupBy('users.email')
                ->get();
//        print_r($result);exit;
        return $result;
    }

    public static function get_operator_due_records2($email) {
        $current_date = date('ymd');
        $due_date = date('ymd', strtotime("+31 days"));

        $p_60_days = date('ymd', strtotime("+60 days"));
        $p_30_days = date('ymd', strtotime("+30 days"));
        $p_15_days = date('ymd', strtotime("+15 days"));
        $p_7_days = date('ymd', strtotime("+7 days"));
        $p_6_days = date('ymd', strtotime("+6 days"));
        $p_5_days = date('ymd', strtotime("+5 days"));
        $p_4_days = date('ymd', strtotime("+4 days"));
        $p_3_days = date('ymd', strtotime("+3 days"));
        $p_2_days = date('ymd', strtotime("+2 days"));
        $p_1_days = date('ymd', strtotime("+1 days"));
        $p_0_days = date('ymd');
        $s_1_days = date('ymd', strtotime("-1 days"));
        $s_2_days = date('ymd', strtotime("-2 days"));
        $s_3_days = date('ymd', strtotime("-3 days"));
        $s_4_days = date('ymd', strtotime("-4 days"));
        $s_5_days = date('ymd', strtotime("-5 days"));
        $s_6_days = date('ymd', strtotime("-6 days"));
        $s_7_days = date('ymd', strtotime("-7 days"));
        $s_15_days = date('ymd', strtotime("-15 days"));
        $s_30_days = date('ymd', strtotime("-30 days"));


        $auto_dates1 = [
            $s_1_days,
            $s_2_days,
            $s_3_days,
            $s_4_days,
            $s_5_days,
            $s_6_days,
            $s_7_days,
            /*$s_15_days,    /*sumit commented this line*
            $s_30_days */
        ];

        $auto_dates2 = [
            $p_60_days,
            $p_30_days,
            $p_15_days,
            $p_7_days,
            $p_6_days,
            $p_5_days,
            $p_4_days,
            $p_3_days,
            $p_2_days,
            $p_1_days,
            $p_0_days
        ];




        $result1 = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.operator_user_id')
                ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                ->where('lr_license_details.is_active', 1)
                ->where('lr_license_details.is_delete', 0)
                ->where('users.email', $email)
//                ->where('users.is_active', 1)
//                ->whereIn('to_date', $auto_dates1)
                ->where('to_date','<', $current_date)
                ->orderBy('lr_license_details.to_date', 'desc')
                ->select(['lr_license_details.user_id', 'lr_license_details.number', 'users.name as user_name', 'lr_license_types.name as license_name', 'lr_license_types.license_type', 'lr_license_details.to_date as to_date'])
                ->get();
        /* result 3 sumit's code*/
        $result3 = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.operator_user_id')
                ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                ->where('lr_license_details.is_active', 1)
                ->where('lr_license_details.is_delete', 0)
                ->where('users.email', $email)
                ->whereIn('to_date', $auto_dates1)
                ->orderBy('lr_license_details.to_date', 'desc')
                ->select(['lr_license_details.user_id', 'lr_license_details.number', 'users.name as user_name', 'lr_license_types.name as license_name', 'lr_license_types.license_type', 'lr_license_details.to_date as to_date'])
                ->get();
           
        $result2 = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.operator_user_id')
                ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                ->where('lr_license_details.is_active', 1)
                ->where('lr_license_details.is_delete', 0)
                ->where('users.email', $email)
                ->where('users.is_active', 1)
                ->whereIn('to_date', $auto_dates2)
//                ->where('to_date', '>', $s_1_days)
                ->orderBy('lr_license_details.to_date', 'asc')
                ->select(['lr_license_details.user_id', 'lr_license_details.number', 'users.name as user_name', 'lr_license_types.name as license_name', 'lr_license_types.license_type', 'lr_license_details.to_date as to_date'])
                ->get();
        
        /*$result = array_merge($result1->toArray(), $result2->toArray()); *//* Anand's old code*/
        if(count($result2)>0){
         $result = array_merge($result1->toArray(), $result2->toArray());
        }
        else{
          $result = $result3->toArray();
        }
        $result = json_decode(json_encode($result));
        return $result;
    }

    public static function check_license_exist($user_id, $license_type_id) {
        $check_license_count = LicenseDetailsModel::where('user_id', $user_id)
                ->where('license_type_id', $license_type_id)
                ->where('is_active', 1)
                ->first(['id']);
        return ($check_license_count) ? $check_license_count->id : '';
    }

}
