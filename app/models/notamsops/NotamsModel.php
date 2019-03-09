<?php

namespace App\models\notamsops;

use Illuminate\Database\Eloquent\Model;

class NotamsModel extends Model {

    protected $table = "notam_info_ops";
    protected $primaryKey = "id";
    public $timestamps = true;

    public static function getAll() {
        $result = NotamsModel::get();
        return $result;
    }

    public static function getNotamCount() {
        $result = NotamsModel::selectRaw('COUNT(*) as count,notam_info_ops.aerodrome,stations.aero_name')
                ->join('stations', 'notam_info_ops.aerodrome', '=', 'stations.aero_id')
                ->where('notam_info_ops.is_delete', '=', 0)
                ->groupBy('notam_info_ops.aerodrome')
                ->orderBy('notam_info_ops.aerodrome', 'asc')
                ->get();
        return $result;
    }

    public static function getByAerodrome($aero_id) {
        $result = NotamsModel::where('aerodrome', 'like', $aero_id)->orderBy('aerodrome', 'asc')->where('is_delete', '=', 0)->orderBy('time', 'desc')->get();
        return $result;
    }
    public static function getNotamByNum($notam_no,$aerodrome) {
        $result = NotamsModel::where('notam_no', 'like', $notam_no)->where('aerodrome', 'like', $aerodrome)->orderBy('aerodrome', 'asc')->where('is_delete', '=', 0)->get();
        return $result;
    }
    public static function getNotamById($notam_id) {
        $result = NotamsModel::where('id', '=', $notam_id)->orderBy('aerodrome', 'asc')->where('is_delete', '=', 0)->get();
        return $result;
    }

    public static function getCountbyAerodrome($aero_id) {
        $result = NotamsModel::where('aerodrome', '=', $aero_id)->where('is_delete', '=', 0)->count();
        return $result;
    }

    public static function getLastupdateTime($aero_id) {
        $result = NotamsModel::where('aerodrome', 'like', $aero_id)->orderBy('created_at', 'desc')->first(['created_at']);
        return $result ? $result : (object) array('created_at' => 'NA');
    }

    public static function updatestatus($id, $val) {
        NotamsModel::where('notam_no', $id)->update(array('is_active' => $val,'is_updated' => 1));
    }
    public static function updateEmailStatus($id, $val) {
        NotamsModel::where('notam_no', $id)->update(array('enable_email' => $val,'is_updated' => 1));
    }
    
    public static function updatecancel($id, $val) {
        NotamsModel::where('notam_no', $id)->update(['is_delete' => $val]);
    }
    public static function updateNotamTime($id, $time) {
        NotamsModel::where('id', $id)
        ->update(array('start_time' => $time['start'],'end_time' => $time['end'],'is_daily'=>1,'is_weekly'=>0,'is_date_specific'=>0));
    }

    public static function updateNotamTimeForWeekDays($id, $updateInfo) {
        NotamsModel::where('id', $id)
        ->update($updateInfo);
    }
    public static function updateNotamSpecificDays($id, $time,$date) {
        NotamsModel::where('id', $id)
        ->update(array('datespecific_start_time' => $time['start'],'datespecific_end_time' => $time['end'],'notam_dates'=>$date,'is_date_specific'=>1));
    }
    
    public static function setAllasDeleted($aero_id, $val) {
        NotamsModel::where('aerodrome', 'like', $aero_id)->update(['is_delete' => $val]);
    }

    public static function updateDescription($desc, $id,$is_updated) {
        NotamsModel::where('notam_no', $id)->update(array('description' => $desc,'is_updated' => $is_updated));
    }

    public static function getLastInsertedNotamsForExcel($aero_id, $count) {
        $result = NotamsModel::where('aerodrome', 'like', $aero_id)->where('is_delete', '=', 0)->orderBy('created_at', 'desc')->limit($count)->get();
        return $result;
    }
    public static function getLastInsertedNotams($aero_id, $count) {
        $result = NotamsModel::where('aerodrome', 'like', $aero_id)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->orderBy('created_at', 'desc')->orderBy('e_start_date', 'desc')->limit($count)->get();
        return $result;
    }

    public static function filterNotamsData($aero_id, $fromDate, $toDate, $notamNo, $routeNotams, $notamCategory) {
        $endCharacters = array(".", ",", "-", " ", "/");
        if($aero_id[0]==""){
             $result = NotamsModel::where(function($q) use ($fromDate, $toDate) {
                    $q->whereRaw('? between e_start_date and e_end_date', [$fromDate])->
                    orWhereRaw('? between e_start_date and e_end_date', [$toDate]);
                })->
                where(function($q) use ($notamNo) {
                    if (!empty($notamNo)) {
                        $q->orWhere("notam_no", '=', $notamNo);
                    }
                })->
                where(function($q) use ($notamCategory) {
                    foreach ($notamCategory as $key) {
                        $key = "%" . $key . "%";
                        $q->orWhere("decoded_qline", 'like', $key);
                    }
                })->
                where(function($q) use ($routeNotams, $endCharacters) {
                    if (!empty($routeNotams)) {
                        for ($i = 0; $i < sizeof($endCharacters); $i++) {
                            $key = "%" . $routeNotams . $endCharacters[$i] . "%";
                            $q->orWhere("description", 'like', $key);
                        }
                    }
                })->
                where('is_delete', '=', 0)->
                orderBy('aerodrome', 'asc')->
                orderBy('e_start_date', 'desc')->
                get();
                return $result;
        }


        $result = NotamsModel::where(function($q) use ($aero_id) {
                    foreach ($aero_id as $key) {
                        $key = "%" . $key . "%";
                        if($key!="%%"){
                          $q->orWhere('aerodrome', 'like', $key);
                        }
                    }
                })->
                where(function($q) use ($fromDate, $toDate) {
                    $q->whereRaw('? between e_start_date and e_end_date', [$fromDate])->
                    orWhereRaw('? between e_start_date and e_end_date', [$toDate]);
                })->
                where(function($q) use ($notamNo) {
                    if (!empty($notamNo)) {
                        $q->orWhere("notam_no", '=', $notamNo);
                    }
                })->
                where(function($q) use ($notamCategory) {
                    foreach ($notamCategory as $key) {
                        $key = "%" . $key . "%";
                        $q->orWhere("decoded_qline", 'like', $key);
                    }
                })->
                orWhere(function($q) use ($routeNotams, $endCharacters) {
                    if (!empty($routeNotams)) {
                        for ($i = 0; $i < sizeof($endCharacters); $i++) {
                            $key = "%" . $routeNotams . $endCharacters[$i] . "%";
                            $q->orWhere("description", 'like', $key);
                        }
                    }
                })->
                where('is_delete', '=', 0)->
                orderBy('aerodrome', 'asc')->
                orderBy('e_start_date', 'desc')->
                get();
        return $result;
    }

    public static function getDataForPDF($aero_id, $fromDate, $toDate, $notamNo, $routeNotams, $notamCategory) {
        $endCharacters = array(".", ",", "-", " ", "/");
     
        $result = NotamsModel::where('aerodrome', 'like', $aero_id)->
                where('e_start_date', '>=', '2016-01-01')->
                where('is_active', '=', 1)->
                where('is_delete', '=', 0)->
                where(function($q) use ($fromDate, $toDate) {
                    $q->whereRaw('? between e_start_date and e_end_date', [$fromDate])->
                    orWhereRaw('? between e_start_date and e_end_date', [$toDate]);
                })->
                where(function($q) use ($notamNo) {
                    if (!empty($notamNo)) {
                        $q->orWhere("notam_no", '=', $notamNo);
                    }
                })->
                where(function($q) use ($notamCategory) {
                    foreach ($notamCategory as $key) {
                        $key = "%" . $key . "%";
                        $q->orWhere("decoded_qline", 'like', $key);
                    }
                })->
                where(function($q) use ($routeNotams, $endCharacters) {
                    if (!empty($routeNotams)) {
                        $q->where(function($d) use ($routeNotams, $endCharacters) {
                            for ($i = 0; $i < sizeof($endCharacters); $i++) {
                                $key = "%" . $routeNotams . $endCharacters[$i] . "%";
                                $d->orWhere("description", 'like', $key);
                            }
                        });
                        $q->where(function($v) {
                            $v->where('e_start_date', '>=', '2016-01-01');
                            $v->where('is_active', '=', 1);
                            $v->where('is_delete', '=', 0);
                        });
                    }
                })->
                orderBy('aerodrome', 'asc')->
                orderBy('e_start_date', 'desc')->
                get();
        return $result;
    }

}
