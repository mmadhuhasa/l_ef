<?php

namespace App\Http\Controllers\EflightAdmin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\FlightPlanDetailsModel;
use App\models\WebNotificationsModel;
use Log;

class StatsController extends Controller {

    public function index() {
        return view('EflightAdmin.stats.fpl_stats');
    }

    public function get_fpl_stats(Request $request) {
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $dof = $request->dof;
            $flag = $request->flag;
            $revised_count = 0;
            $changed_count = 0;
            $adc_time_diff = 0;

            $revised_count2 = 0;
            $changed_count2 = 0;
            $adc_time_diff2 = 0;

            $month_count = 0;
            $current_day = date('ymd');

            $aircraft_callsign = ($request->aircraft_callsign) ? $request->aircraft_callsign : 'TESTA';
            if ($dof) {
                $current_day = $dof;
            }
            $total_count = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                    ->where('is_active', '1')
                    ->count();

            //Month Count
            $start_day_month = date("Ym") . "01";
            $last_day_month = date("Ym") . "31";
            $start_day_month = date("ymd", strtotime($start_day_month));
            $last_day_month = date("ymd", strtotime($last_day_month));

            $month_count = FlightPlanDetailsModel::where('is_active', '1')
                            ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                            ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')->count();

            $get_fpl_count_by_app2 = FlightPlanDetailsModel::where('is_active', '1')
                            ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                            ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                            ->where('is_app', '1')->count();

            $get_cancel_fpl_count2 = FlightPlanDetailsModel::where('is_active', '1')
                            ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                            ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                            ->where('plan_status', '2')->count();

            $get_active_fpl_count2 = FlightPlanDetailsModel::where('is_active', '1')
                            ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                            ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                            ->where('plan_status', '1')->count();

            $get_fpl_stats_data = WebNotificationsModel::get_fpl_stats2($aircraft_callsign, $from_date, $to_date, $flag, 1);
            foreach ($get_fpl_stats_data as $get_fpl_stats_data) {
                if ($get_fpl_stats_data->action == 4) {
                    $adc_updated_time = $get_fpl_stats_data->created_at;
                    $adc_updated_time = date("Hi", strtotime($adc_updated_time));
                    $departure_time = $get_fpl_stats_data->departure_time_hours . $get_fpl_stats_data->departure_time_minutes;

                    $diff_time = (strtotime($departure_time) - strtotime($adc_updated_time)) / 60;
                    if ($diff_time < 30) {
                        $adc_time_diff2++;
                    }
                }

                if ($get_fpl_stats_data->action == '3') {
                    $revised_count2++;
                }
                if ($get_fpl_stats_data->action == '5') {
                    $changed_count2++;
                }
            }
            $fpl_plans2 = FlightPlanDetailsModel::where('is_active', '1')
                            ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])->count();
            $helicopter_plans2 = FlightPlanDetailsModel::where('is_active', '1')
                    ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                    ->whereIN('aircraft_type', ['A109', 'A119', 'A139', 'AS35', 'B206', 'B230',
                        'B407', 'B412', 'B420', 'B429', 'B430', 'MICR', 'R44R', 'S350', 'S365', 'S76C', 'SK76'])
                    ->count();

            $fixed_wing_plans2 = $fpl_plans2 - $helicopter_plans2;

            $whether_plans2 = FlightPlanDetailsModel::where('is_active', '1')
                            ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                            ->whereIn('aircraft_callsign', ['VTBRT', 'VTBMD', 'VTCJB', 'VTTNT', 'VTJPV',
                                'VTJMG', 'VTSAZ', 'VTNAV', 'VTMRV', 'VTMHM', 'VTRPO', 'VTDBH', 'VTRKB', 'VTUPO',
                                'VTUPK', 'VTUPB', 'VTUPL', 'VTVSR', 'VTJPV', 'VTJPS', 'VTJIT', 'VTJPA', 'VTJHP',
                                'VTOSF', 'VTOSC'])->count();

            $navlog_plans2 = FlightPlanDetailsModel::where('is_active', '1')
                            ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                            ->whereIn('aircraft_callsign', ['VTAAT', ' VTANF', ' VTAUV', ' VTAVS', ' VTBAJ',
                                ' VTBRK', ' VTCMO', ' VTDBC', ' VTEJZ', ' VTFAF', ' VTGKB', ' VTJSK', ' VTJUI',
                                ' VTKJB', ' VTKNB', ' VTKZN', ' VTLTC', ' VTMAM', ' VTOMM', ' VTPRS', ' VTPSB',
                                ' VTRAM', ' VTRSR', ' VTSAI', ' VTSRC', ' VTSSF', ' VTTVM', ' VTUDR', ' VTUPJ',
                                ' VTUPM', ' VTUPR', ' VTVRL'])->count();

            $lnt_plans2 = FlightPlanDetailsModel::where('is_active', '1')
                            ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                            ->whereIn('aircraft_callsign', ['VTANF', ' VTAUV', ' VTAVS', ' VTBAJ', ' VTEJZ',
                                ' VTFAF', ' VTJUI', ' VTKJB', ' VTKNB', ' VTKZN', ' VTLTC', ' VTMAM', ' VTPRS',
                                ' VTPSB', ' VTSRC', ' VTSSF', ' VTTVM', ' VTUDR', ' VTUPJ', ' VTUPM', ' VTUPR',
                                ' VTVRL'])->count();

            $runway_plans2 = FlightPlanDetailsModel::where('is_active', '1')
                            ->whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                            ->whereIn('aircraft_callsign', ['VTAUV', 'VTMAM'])->count();

            if ($flag == 'callsign_operator') {
                $get_day_count_fpl = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')->count();

                $get_fpl_count_by_app = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                                ->where('is_app', '1')->count();

                $get_cancel_fpl_count = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                                ->where('plan_status', '2')->count();

                $get_active_fpl_count = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                                ->where('plan_status', '1')->count();

                $get_fpl_stats_data = WebNotificationsModel::get_fpl_stats2($aircraft_callsign, $from_date, $to_date, $flag);
                foreach ($get_fpl_stats_data as $get_fpl_stats_data) {
                    if ($get_fpl_stats_data->action == 4) {
                        $adc_updated_time = $get_fpl_stats_data->created_at;
                        $adc_updated_time = date("Hi", strtotime($adc_updated_time));
                        $departure_time = $get_fpl_stats_data->departure_time_hours . $get_fpl_stats_data->departure_time_minutes;

                        $diff_time = (strtotime($departure_time) - strtotime($adc_updated_time)) / 60;
                        if ($diff_time < 30) {
                            $adc_time_diff++;
                        }
                    }

                    if ($get_fpl_stats_data->action == '3') {
                        $revised_count++;
                    }
                    if ($get_fpl_stats_data->action == '5') {
                        $changed_count++;
                    }
                }
                $fpl_plans = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)->count();
                
                $helicopter_plans = FlightPlanDetailsModel::where('is_active', '1')
                        ->where('date_of_flight', $current_day)
                        ->whereIN('aircraft_type', ['A109', 'A119', 'A139', 'AS35', 'B206', 'B230',
                            'B407', 'B412', 'B420', 'B429', 'B430', 'MICR', 'R44R', 'S350', 'S365', 'S76C', 'SK76'])
                        ->count();
                $fixed_wing_plans = $fpl_plans - $helicopter_plans;
                $whether_plans = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->whereIn('aircraft_callsign', ['VTBRT', 'VTBMD', 'VTCJB', 'VTTNT', 'VTJPV',
                                    'VTJMG', 'VTSAZ', 'VTNAV', 'VTMRV', 'VTMHM', 'VTRPO', 'VTDBH', 'VTRKB', 'VTUPO',
                                    'VTUPK', 'VTUPB', 'VTUPL', 'VTVSR', 'VTJPV', 'VTJPS', 'VTJIT', 'VTJPA', 'VTJHP',
                                    'VTOSF', 'VTOSC'])->count();
                $navlog_plans = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->whereIn('aircraft_callsign', ['VTAAT', ' VTANF', ' VTAUV', ' VTAVS', ' VTBAJ',
                                    ' VTBRK', ' VTCMO', ' VTDBC', ' VTEJZ', ' VTFAF', ' VTGKB', ' VTJSK', ' VTJUI',
                                    ' VTKJB', ' VTKNB', ' VTKZN', ' VTLTC', ' VTMAM', ' VTOMM', ' VTPRS', ' VTPSB',
                                    ' VTRAM', ' VTRSR', ' VTSAI', ' VTSRC', ' VTSSF', ' VTTVM', ' VTUDR', ' VTUPJ',
                                    ' VTUPM', ' VTUPR', ' VTVRL'])->count();
                $lnt_plans = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->whereIn('aircraft_callsign', ['VTANF', ' VTAUV', ' VTAVS', ' VTBAJ', ' VTEJZ',
                                    ' VTFAF', ' VTJUI', ' VTKJB', ' VTKNB', ' VTKZN', ' VTLTC', ' VTMAM', ' VTPRS',
                                    ' VTPSB', ' VTSRC', ' VTSSF', ' VTTVM', ' VTUDR', ' VTUPJ', ' VTUPM', ' VTUPR',
                                    ' VTVRL'])->count();
                $runway_plans = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)
                                ->whereIn('aircraft_callsign', ['VTAUV', 'VTMAM'])->count();
            } else {
                $get_day_count_fpl = FlightPlanDetailsModel::where('is_active', '1')
                                ->whereBetween('date_of_flight', [$from_date, $to_date])
                                ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')->count();

                $get_fpl_count_by_app = FlightPlanDetailsModel::where('is_active', '1')
                                ->whereBetween('date_of_flight', [$from_date, $to_date])
                                ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                                ->where('is_app', '1')->count();

                $get_cancel_fpl_count = FlightPlanDetailsModel::where('is_active', '1')
                                ->whereBetween('date_of_flight', [$from_date, $to_date])
                                ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                                ->where('plan_status', '2')->count();

                $get_active_fpl_count = FlightPlanDetailsModel::where('is_active', '1')
                                ->whereBetween('date_of_flight', [$from_date, $to_date])
                                ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                                ->where('plan_status', '1')->count();

                $get_fpl_stats_data = WebNotificationsModel::get_fpl_stats2($aircraft_callsign, $from_date, $to_date, $flag);
                foreach ($get_fpl_stats_data as $get_fpl_stats_data) {
                    if ($get_fpl_stats_data->action == 4) {
                        $adc_updated_time = $get_fpl_stats_data->created_at;
                        $adc_updated_time = date("Hi", strtotime($adc_updated_time));
                        $departure_time = $get_fpl_stats_data->departure_time_hours . $get_fpl_stats_data->departure_time_minutes;

                        $diff_time = (strtotime($departure_time) - strtotime($adc_updated_time)) / 60;
                        if ($diff_time < 30) {
                            $adc_time_diff++;
                        }
                    }

                    if ($get_fpl_stats_data->action == '3') {
                        $revised_count++;
                    }
                    if ($get_fpl_stats_data->action == '5') {
                        $changed_count++;
                    }
                }
                
                
                $fpl_plans = $get_day_count_fpl;
                $helicopter_plans = FlightPlanDetailsModel::where('is_active', '1')
                        ->whereBetween('date_of_flight', [$from_date, $to_date])
                        ->whereIN('aircraft_type', ['A109', 'A119', 'A139', 'AS35', 'B206', 'B230',
                            'B407', 'B412', 'B420', 'B429', 'B430', 'MICR', 'R44R', 'S350', 'S365', 'S76C', 'SK76'])
                        ->count();
                $fixed_wing_plans = $fpl_plans - $helicopter_plans;
                $whether_plans = FlightPlanDetailsModel::where('is_active', '1')
                                ->where('date_of_flight', $current_day)->whereBetween('date_of_flight', [$from_date, $to_date])
                                ->whereIn('aircraft_callsign', ['VTBRT', 'VTBMD', 'VTCJB', 'VTTNT', 'VTJPV',
                                    'VTJMG', 'VTSAZ', 'VTNAV', 'VTMRV', 'VTMHM', 'VTRPO', 'VTDBH', 'VTRKB', 'VTUPO',
                                    'VTUPK', 'VTUPB', 'VTUPL', 'VTVSR', 'VTJPV', 'VTJPS', 'VTJIT', 'VTJPA', 'VTJHP',
                                    'VTOSF', 'VTOSC'])->count();
                $navlog_plans = FlightPlanDetailsModel::where('is_active', '1')
                                ->whereBetween('date_of_flight', [$from_date, $to_date])
                                ->whereIn('aircraft_callsign', ['VTAAT', ' VTANF', ' VTAUV', ' VTAVS', ' VTBAJ',
                                    ' VTBRK', ' VTCMO', ' VTDBC', ' VTEJZ', ' VTFAF', ' VTGKB', ' VTJSK', ' VTJUI',
                                    ' VTKJB', ' VTKNB', ' VTKZN', ' VTLTC', ' VTMAM', ' VTOMM', ' VTPRS', ' VTPSB',
                                    ' VTRAM', ' VTRSR', ' VTSAI', ' VTSRC', ' VTSSF', ' VTTVM', ' VTUDR', ' VTUPJ',
                                    ' VTUPM', ' VTUPR', ' VTVRL'])->count();
                $lnt_plans = FlightPlanDetailsModel::where('is_active', '1')
                                ->whereBetween('date_of_flight', [$from_date, $to_date])
                                ->whereIn('aircraft_callsign', ['VTANF', ' VTAUV', ' VTAVS', ' VTBAJ', ' VTEJZ',
                                    ' VTFAF', ' VTJUI', ' VTKJB', ' VTKNB', ' VTKZN', ' VTLTC', ' VTMAM', ' VTPRS',
                                    ' VTPSB', ' VTSRC', ' VTSSF', ' VTTVM', ' VTUDR', ' VTUPJ', ' VTUPM', ' VTUPR',
                                    ' VTVRL'])->count();
                $runway_plans = FlightPlanDetailsModel::where('is_active', '1')
                                ->whereBetween('date_of_flight', [$from_date, $to_date])
                                ->whereIn('aircraft_callsign', ['VTAUV', 'VTMAM'])->count();     
            }
            $data = ['get_day_count_fpl' => $get_day_count_fpl,
                'get_fpl_count_by_app' => $get_fpl_count_by_app,
                'get_cancel_fpl_count' => $get_cancel_fpl_count,
                'get_active_fpl_count' => $get_active_fpl_count,
                'revised_count' => $revised_count,
                'changed_count' => $changed_count,
                'adc_time_diff' => $adc_time_diff,
                'fpl_plans' => $fpl_plans,
                'helicopter_plans' => $helicopter_plans,
                'fixed_wing_plans' => $fixed_wing_plans,
                'weather_plans' => $whether_plans,
                'navlog_plans' => $navlog_plans,
                'lnt_plans' => $lnt_plans,
                'runway_plans' => $runway_plans,
                'fpl_plans2' => $fpl_plans2,
                'helicopter_plans2' => $helicopter_plans2,
                'fixed_wing_plans2' => $fixed_wing_plans2,
                'weather_plans2' => $whether_plans2,
                'navlog_plans2' => $navlog_plans2,
                'lnt_plans2' => $lnt_plans2,
                'runway_plans2' => $runway_plans2,
                'month_count' => $month_count,
                'get_fpl_count_by_app2' => $get_fpl_count_by_app2,
                'get_cancel_fpl_count2' => $get_cancel_fpl_count2,
                'get_active_fpl_count2' => $get_active_fpl_count2,
                'revised_count2' => $revised_count2,
                'changed_count2' => $changed_count2,
                'adc_time_diff2' => $adc_time_diff2,
                'total_plans' => $total_count];
            return view('EflightAdmin.stats.search_stats', $data);
        } catch (\Exception $e) {
            Log::info('Stats ' . $e->getMessage() . ' Line ' . $e->getLine());
        }
    }

    public function get_fpl_stats2(Request $request) {
        try {
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $dof = $request->dof;
            $flag = $request->flag;
            $revised_count = 0;
            $changed_count = 0;
            $adc_time_diff = 0;
            $start_day_month = date("Ym") . "01";
            $last_day_month = date("Ym") . "31";
            $start_day_month = date("ymd", strtotime($start_day_month));
            $last_day_month = date("ymd", strtotime($last_day_month));
            $aircraft_callsign = ($request->aircraft_callsign) ? $request->aircraft_callsign : 'TESTA';
            $current_day = date('ymd');
            if ($dof) {
                $current_day = $dof;
            }

            $month_count = FlightPlanDetailsModel::whereBetween('date_of_flight', [$start_day_month, $last_day_month])
                    ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                    ->where('is_active', '1')
                    ->count();
            $total_count = FlightPlanDetailsModel::where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                    ->where('is_active', '1')
                    ->count();


            $get_fpl_stats_data = FlightPlanDetailsModel::get_fpl_stats2($aircraft_callsign, $from_date, $to_date, $flag);

            foreach ($get_fpl_stats_data as $get_fpl_stats_data) {
                if ($get_fpl_stats_data->revised_by != 0) {
                    $revised_count++;
                }
                if ($get_fpl_stats_data->changed_by != 0) {
                    $changed_count++;
                }
                $adc_updated_by = $get_fpl_stats_data->adc_updated_by;
                $adc_updated_time = $get_fpl_stats_data->adc_updated_time;
                $adc_updated_time = date("Hi", strtotime($adc_updated_time));
                $departure_time = $get_fpl_stats_data->departure_time_hours . $get_fpl_stats_data->departure_time_minutes;
                if ($adc_updated_by) {
                    $diff_time = (strtotime($departure_time) - strtotime($adc_updated_time)) / 60;
                    if ($diff_time < 30) {
                        $adc_time_diff++;
                    }
                }
            }
            $revised_count = WebNotificationsModel::get_fpl_notifications($current_day, '1');
            $changed_count2 = WebNotificationsModel::get_fpl_notifications($current_day);

            if ($changed_count2) {
                $changed_count = $changed_count2;
            }

            $get_day_count_fpl = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $current_day)
                            ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')->count();

            $get_fpl_count_by_app = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $current_day)
                            ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                            ->where('is_app', '1')->count();

            $get_cancel_fpl_count = FlightPlanDetailsModel::where('is_active', '1')
                            ->where('date_of_flight', $current_day)
                            ->where('aircraft_callsign', 'LIKE', '%' . $aircraft_callsign . '%')
                            ->where('plan_status', '2')->count();

            $data = ['get_day_count_fpl' => $get_day_count_fpl,
                'get_fpl_count_by_app' => $get_fpl_count_by_app,
                'get_cancel_fpl_count' => $get_cancel_fpl_count,
                'revised_count' => $revised_count,
                'changed_count' => $changed_count,
                'adc_time_diff' => $adc_time_diff,
                'month_count' => $month_count,
                'totla_plans' => $total_count,
                '$month_count' => $month_count];

            return view('EflightAdmin.stats.search_stats', $data);
        } catch (\Exception $e) {
            Log::info('Stats ' . $e->getMessage() . ' Line ' . $e->getLine());
        }
    }
    
    public function get_callsign_stats(Request $request){
        return view('EflightAdmin.stats.callsign_stats');
    }

}
