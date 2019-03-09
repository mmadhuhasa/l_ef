<?php

namespace App\models\notams;

use Illuminate\Database\Eloquent\Model;

class NotamsModel extends Model {

    protected $table = "notam_info";
    protected $primaryKey = "id";
    public $timestamps = true;

    public static function getAll() {
        $result = NotamsModel::all();
        return $result;
    }

    public static function getNotamCount() {
        $result = NotamsModel::selectRaw('COUNT(*) as count,notam_info.aerodrome,stations.aero_name')
                ->join('stations', 'notam_info.aerodrome', '=', 'stations.aero_id')
                ->where('notam_info.is_delete', '=', 0)
                ->groupBy('notam_info.aerodrome')
                ->orderBy('notam_info.aerodrome', 'asc')
                ->get();
        return $result;
    }

    public static function getNotamCountForAirport($aero_id) {
        $result = NotamsModel::selectRaw('COUNT(*) as count,notam_info.aerodrome,stations.aero_name')
                ->join('stations', 'notam_info.aerodrome', '=', 'stations.aero_id')
                ->where('notam_info.is_delete', '=', 0)
                ->where('notam_info.aerodrome', '=', $aero_id)
                ->groupBy('notam_info.aerodrome')
                ->orderBy('notam_info.aerodrome', 'asc')
                ->get();
        return $result;
    }

    public static function getByAerodrome($aero_id) {
        $result = NotamsModel::where('aerodrome', 'like', $aero_id)->orderBy('aerodrome', 'asc')->where('is_delete', '=', 0)->orderBy('time', 'desc')->get();
        return $result;
    }

    public static function getNotamByNum($notam_no, $aerodrome) {
        $result = NotamsModel::where('notam_no', 'like', $notam_no)->where('aerodrome', 'like', $aerodrome)->orderBy('aerodrome', 'asc')->where('is_delete', '=', 0)->get();
        return $result;
    }

    public static function getCountbyAerodrome($aero_id) {
        $result = NotamsModel::where('aerodrome', '=', $aero_id)->where('is_delete', '=', 0)->count();
        return $result;
    }

    public static function getLastupdateTime($aero_id) {
        $result = NotamsModel::where('aerodrome', 'like', $aero_id)->orderBy('updated_at', 'desc')->first(['updated_at']);
        return $result ? $result : (object) array('updated_at' => 'NA');
    }

    public static function updatestatus($id, $val) {
        NotamsModel::where('notam_no', $id)->update(array('is_active' => $val, 'is_update_skipped' => 0, 'is_updated' => 0));
    }

    public static function updateEmailStatus($id, $val) {
        NotamsModel::where('notam_no', $id)->update(array('enable_email' => $val, 'is_update_skipped' => 0, 'is_updated' => 0));
    }

    public static function updatecancel($id, $val) {
        NotamsModel::where('notam_no', $id)->update(['is_delete' => $val]);
    }

    public static function setAllasDeleted($aero_id, $val) {
        NotamsModel::where('aerodrome', 'like', $aero_id)->update(['is_delete' => $val]);
    }

    public static function updateDescription($desc, $id) {
        NotamsModel::where('notam_no', $id)->update(array('description' => $desc, 'is_update_skipped' => 0, 'is_updated' => 0));
    }

    public static function getLastInsertedNotams($aero_id, $count) {
        $result = NotamsModel::where('aerodrome', 'like', $aero_id)->where('is_primary', '=', 1)->where('is_delete', '=', 0)->orderBy('created_at', 'desc')->orderBy('e_start_date', 'desc')->limit($count)->get();
        return $result;
    }

    public static function getUpdatePendingNotams($aero_id) {
        $result = NotamsModel::where('aerodrome', 'like', $aero_id)->where('is_update_skipped', '=', 1)->orderBy('created_at', 'desc')->orderBy('e_start_date', 'desc')->get();
        return $result;
    }
    public static function filterNotamsDataFpl($aero_id, $fromDate, $toDate, $notamNo, $routeNotams, $notamCategory, $startTime, $endTime, $notamDates) {
        if ($startTime == "") {
            $startTime = "0000";
        }
        if ($endTime == "") {
            $endTime = "2359";
        }
        $daynameStartTimeFieldName = substr(strtolower((date("l"))), 0, 3) . "_start_time";
        $daynameEndTimeFieldName = substr(strtolower((date("l"))), 0, 3) . "_end_time";
        $endCharacters = array(".", ",", "-", " ", "/");
        if ($aero_id[0] == "") {
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
                    where(function($q) use ($startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName) {
                        $q->whereRaw('? between start_time and end_time', [$startTime])->
                        orWhereRaw('? between start_time and end_time', [$endTime])->
                        whereRaw($daynameStartTimeFieldName . ' between ? and ?', [$startTime, $endTime])->
                        orWhereRaw($daynameEndTimeFieldName . ' between ? and ?', [$startTime, $endTime]);
                    })->
                    where(function($q) use ($startTime, $endTime, $notamDates) {
                        for ($i = 0; $i < sizeof($notamDates); $i++) {
                            $key = "%" . $notamDates[$i] . "%";
                            $q->orWhere("notam_dates", 'like', $key);
                        }
                        $q->whereRaw('? between start_time and end_time', [$startTime])->
                        orWhereRaw('? between start_time and end_time', [$endTime]);
                    })->
                    where('is_delete', '=', 0)->
                    where('is_primary', '=', 1)->
                    orderBy('aerodrome', 'asc')->
                    orderBy('e_start_date', 'desc')->
                    get();
            return $result;
        }
        $result = NotamsModel::
                where(function($r) use ($aero_id, $fromDate, $toDate, $notamNo, $notamCategory, $routeNotams, $endCharacters, $startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName, $notamDates) {
                    $r->where(function($q) use ($aero_id) {
                        foreach ($aero_id as $key) {
                            $key = "%" . $key . "%";
                            if ($key != "%%") {
                                $q->orWhere('aerodrome', 'like', $key);
                            }
                        }
                    })->where('is_daily', '=', 1)->
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
                            for ($i = 0; $i < sizeof($endCharacters); $i++) {
                                $key = "%" . $routeNotams . $endCharacters[$i] . "%";
                                $q->orWhere("description", 'like', $key);
                            }
                        }
                    })->
                    where(function($q) use ($startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName) {
                        $q->whereRaw('start_time between ? and ?', [$startTime, $endTime])->
                        orWhereRaw('end_time between ? and ?', [$startTime, $endTime])->
                        orWhereRaw('start_time = 0000')->
                        orWhereRaw('end_time = 2359');
                    })->
                    where(function($v) {
                        $v->where('e_start_date', '>=', '2016-01-01');
                        $v->where('is_active', '=', 1);
                        $v->where('is_delete', '=', 0);
                    });
                })->
                orWhere(function($r) use ($aero_id, $fromDate, $toDate, $notamNo, $notamCategory, $routeNotams, $endCharacters, $startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName, $notamDates) {
                    $r->where(function($q) use ($aero_id) {
                        foreach ($aero_id as $key) {
                            $key = "%" . $key . "%";
                            if ($key != "%%") {
                                $q->orWhere('aerodrome', 'like', $key);
                            }
                        }
                    })->where('is_weekly', '=', 1)->
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
                            for ($i = 0; $i < sizeof($endCharacters); $i++) {
                                $key = "%" . $routeNotams . $endCharacters[$i] . "%";
                                $q->orWhere("description", 'like', $key);
                            }
                        }
                    })->
                    where(function($q) use ($startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName) {
                        $q->whereRaw($daynameStartTimeFieldName . ' between ? and ?', [$startTime, $endTime])->
                        orWhereRaw($daynameEndTimeFieldName . ' between ? and ?', [$startTime, $endTime]);
                    })->
                    where(function($v) {
                        $v->where('e_start_date', '>=', '2016-01-01');
                        $v->where('is_active', '=', 1);
                        $v->where('is_delete', '=', 0);
                    });
                })->
                orWhere(function($r) use ($aero_id, $fromDate, $toDate, $notamNo, $notamCategory, $routeNotams, $endCharacters, $startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName, $notamDates) {
                    $r->where(function($q) use ($aero_id) {
                        foreach ($aero_id as $key) {
                            $key = "%" . $key . "%";
                            if ($key != "%%") {
                                $q->orWhere('aerodrome', 'like', $key);
                            }
                        }
                    })->where('is_date_specific', '=', 1)->
                    where(function($q) use ($startTime, $endTime, $notamDates) {
                        for ($i = 0; $i < sizeof($notamDates); $i++) {
                            $key = "%" . $notamDates[$i] . "%";
                            $q->orWhere("notam_dates", 'like', $key);
                        }
                        $q->whereRaw('? between datespecific_start_time and datespecific_end_time', [$startTime])->
                        orWhereRaw('? between datespecific_start_time and datespecific_end_time', [$endTime]);
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
                    where(function($v) {
                        $v->where('e_start_date', '>=', '2016-01-01');
                        $v->where('is_active', '=', 1);
                        $v->where('is_delete', '=', 0);
                    });
                })->
                where('is_delete', '=', 0)->
                where('is_primary', '=', 1)->
                orderBy('start_time', 'asc')->
                get();
        return $result;
    }
    public static function filterNotamsData($aero_id, $fromDate, $toDate, $notamNo, $routeNotams, $notamCategory, $startTime, $endTime, $notamDates) {
        if ($startTime == "") {
            $startTime = "0000";
        }
        if ($endTime == "") {
            $endTime = "2359";
        }
        $daynameStartTimeFieldName = substr(strtolower((date("l"))), 0, 3) . "_start_time";
        $daynameEndTimeFieldName = substr(strtolower((date("l"))), 0, 3) . "_end_time";

        $endCharacters = array(".", ",", "-", " ", "/");
        if ($aero_id[0] == "") {
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
                    where(function($q) use ($startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName) {
                        $q->whereRaw('? between start_time and end_time', [$startTime])->
                        orWhereRaw('? between start_time and end_time', [$endTime])->
                        whereRaw($daynameStartTimeFieldName . ' between ? and ?', [$startTime, $endTime])->
                        orWhereRaw($daynameEndTimeFieldName . ' between ? and ?', [$startTime, $endTime]);
                    })->
                    where(function($q) use ($startTime, $endTime, $notamDates) {
                        for ($i = 0; $i < sizeof($notamDates); $i++) {
                            $key = "%" . $notamDates[$i] . "%";
                            $q->orWhere("notam_dates", 'like', $key);
                        }
                        $q->whereRaw('? between start_time and end_time', [$startTime])->
                        orWhereRaw('? between start_time and end_time', [$endTime]);
                    })->
                    where('is_delete', '=', 0)->
                    where('is_primary', '=', 1)->
                    orderBy('aerodrome', 'asc')->
                    orderBy('notam_no', 'desc')->
                    get();
            return $result;
        }
        $result = NotamsModel::
                where(function($r) use ($aero_id, $fromDate, $toDate, $notamNo, $notamCategory, $routeNotams, $endCharacters, $startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName, $notamDates) {
                    $r->where(function($q) use ($aero_id) {
                        foreach ($aero_id as $key) {
                            $key = "%" . $key . "%";
                            if ($key != "%%") {
                                $q->orWhere('aerodrome', 'like', $key);
                            }
                        }
                    })->where('is_daily', '=', 1)->
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
                    where(function($q) use ($startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName) {
                        $q->whereRaw('start_time between ? and ?', [$startTime, $endTime])->
                        orWhereRaw('end_time between ? and ?', [$startTime, $endTime])->
                        orWhereRaw('start_time = 0000')->
                        orWhereRaw('end_time = 2359');
                    });
                })->
                orWhere(function($r) use ($aero_id, $fromDate, $toDate, $notamNo, $notamCategory, $routeNotams, $endCharacters, $startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName, $notamDates) {
                    $r->where(function($q) use ($aero_id) {
                        foreach ($aero_id as $key) {
                            $key = "%" . $key . "%";
                            if ($key != "%%") {
                                $q->orWhere('aerodrome', 'like', $key);
                            }
                        }
                    })->where('is_weekly', '=', 1)->
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
                    where(function($q) use ($startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName) {
                        $q->whereRaw($daynameStartTimeFieldName . ' between ? and ?', [$startTime, $endTime])->
                        orWhereRaw($daynameEndTimeFieldName . ' between ? and ?', [$startTime, $endTime]);
                    });
                })->
                orWhere(function($r) use ($aero_id, $fromDate, $toDate, $notamNo, $notamCategory, $routeNotams, $endCharacters, $startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName, $notamDates) {
                    $r->where(function($q) use ($aero_id) {
                        foreach ($aero_id as $key) {
                            $key = "%" . $key . "%";
                            if ($key != "%%") {
                                $q->orWhere('aerodrome', 'like', $key);
                            }
                        }
                    })->where('is_date_specific', '=', 1)->
                    where(function($q) use ($startTime, $endTime, $notamDates) {
                        for ($i = 0; $i < sizeof($notamDates); $i++) {
                            $key = "%" . $notamDates[$i] . "%";
                            $q->orWhere("notam_dates", 'like', $key);
                        }
                        $q->whereRaw('? between datespecific_start_time and datespecific_end_time', [$startTime])->
                        orWhereRaw('? between datespecific_start_time and datespecific_end_time', [$endTime]);
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
                    });
                })->
                where('is_delete', '=', 0)->
                where('is_primary', '=', 1)->
                orderBy('start_time', 'asc')->
                get();
        return $result;
    }

    public static function getDataForPDF($aero_id, $fromDate, $toDate, $notamNo, $routeNotams, $notamCategory, $startTime, $endTime, $notamDates) {
        // print_r($aero_id);
        /* old code start

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
          old code end
         */
        if ($startTime == "") {
            $startTime = "0000";
        }
        if ($endTime == "") {
            $endTime = "2359";
        }
        $daynameStartTimeFieldName = substr(strtolower((date("l"))), 0, 3) . "_start_time";
        $daynameEndTimeFieldName = substr(strtolower((date("l"))), 0, 3) . "_end_time";

        $endCharacters = array(".", ",", "-", " ", "/");
        $result = NotamsModel::
                where(function($r) use ($aero_id, $fromDate, $toDate, $notamNo, $notamCategory, $routeNotams, $endCharacters, $startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName, $notamDates) {
                    $r->where('aerodrome', 'like', $aero_id)
                    ->where('is_daily', '=', 1)->
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
                    where(function($q) use ($startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName) {
                        $q->whereRaw('start_time between ? and ?', [$startTime, $endTime])->
                        orWhereRaw('end_time between ? and ?', [$startTime, $endTime])->
                        orWhereRaw('start_time = 0000')->
                        orWhereRaw('end_time = 2359');
                    })->
                    where(function($v) {
                        $v->where('e_start_date', '>=', '2016-01-01');
                        $v->where('is_active', '=', 1);
                        $v->where('is_delete', '=', 0);
                    });
                })->
                orWhere(function($r) use ($aero_id, $fromDate, $toDate, $notamNo, $notamCategory, $routeNotams, $endCharacters, $startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName, $notamDates) {
                    $r->where('aerodrome', 'like', $aero_id)->
                    where('is_weekly', '=', 1)->
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
                    where(function($q) use ($startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName) {
                        $q->whereRaw($daynameStartTimeFieldName . ' between ? and ?', [$startTime, $endTime])->
                        orWhereRaw($daynameEndTimeFieldName . ' between ? and ?', [$startTime, $endTime]);
                    })->
                    where(function($v) {
                        $v->where('e_start_date', '>=', '2016-01-01');
                        $v->where('is_active', '=', 1);
                        $v->where('is_delete', '=', 0);
                    });
                })->
                orWhere(function($r) use ($aero_id, $fromDate, $toDate, $notamNo, $notamCategory, $routeNotams, $endCharacters, $startTime, $endTime, $daynameStartTimeFieldName, $daynameEndTimeFieldName, $notamDates) {
                    $r->where('aerodrome', 'like', $aero_id)->
                    where('is_date_specific', '=', 1)->
                    where(function($q) use ($startTime, $endTime, $notamDates) {
                        for ($i = 0; $i < sizeof($notamDates); $i++) {
                            $key = "%" . $notamDates[$i] . "%";
                            $q->orWhere("notam_dates", 'like', $key);
                        }
                        $q->whereRaw('? between datespecific_start_time and datespecific_end_time', [$startTime])->
                        orWhereRaw('? between datespecific_start_time and datespecific_end_time', [$endTime]);
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
                    where(function($v) {
                        $v->where('e_start_date', '>=', '2016-01-01');
                        $v->where('is_active', '=', 1);
                        $v->where('is_delete', '=', 0);
                    });
                })->
                where('is_delete', '=', 0)->
                get();
        return $result;
    }

}
