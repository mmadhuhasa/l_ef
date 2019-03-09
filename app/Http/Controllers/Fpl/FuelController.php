<?php

namespace App\Http\Controllers\Fpl;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Exceptions\customException;
use App\Http\Controllers\Controller;
use App\Jobs\CancelEmailJob;
use App\Jobs\DelayEmailJob;
use App\Jobs\FICADCEmailJob;
use App\models\CallSignMailsModel;
use App\models\FlightPlanDetailsModel;
use App\models\WatchHoursModel;
use App\models\WebNotificationsModel;
use App\myfolder\myFunction;
use Auth;
use Log;
use Redirect;
use Response;
use Crypt;
use App\models\CallsignInfoModel;
use App\models\FPLStatsModel;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use DB;
use Carbon\Carbon;
use App\Jobs\FuelOrderJob;

class FuelController extends Controller {

    public $bcc;
    public $cc;
    public $from;
    public $from_name;
    public $user_id;
    public $user_name;
    public $user_email;
    public $is_admin;
    public $user_callsigns;

    public function __construct() {
        $this->bcc = env('BCC', "dev.eflight@pravahya.com");
        $this->cc = env('CC', "dev.eflight@pravahya.com");
        $this->from = env('FROM', "support@eflight.aero");
        $this->from_name = env('FROM_NAME', "Support | EFLIGHT");
        $this->user_id = Auth::user()->id;
        $this->user_name = Auth::user()->name;
        $this->user_email = Auth::user()->email;
        $this->is_admin = Auth::user()->is_admin;
        $this->user_callsigns = Auth::user()->user_callsigns;
    }

    public function fuel_list() {
        /*
         * Script:    DataTables server-side script for PHP and MySQL
         * Copyright: 2010 - Allan Jardine, 2012 - Chris Wright
         * License:   GPL v2 or BSD (3-point)
         */

        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Easy set variables
         */

        /* Array of database columns which should be read and sent back to DataTables. Use a space where
         * you want to insert a non-database field (for example a counter or static image)
         */
        $aColumns = array('id', 'date_of_flight', 'aircraft_callsign', 'departure_aerodrome', 'destination_aerodrome', 'departure_time_hours',
            'departure_time_minutes', 'fic', 'adc', 'plan_status', 'departure_station', 'operator', 'total_flying_hours', 'total_flying_minutes', 'fuel_value', 'pob', 'fuel_required');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";

        /* DB table to use */
        $sTable = "flight_plan_details";

        $gaSql['user'] = \Config::get('database.connections.mysql.username');
        $gaSql['password'] = \Config::get('database.connections.mysql.password');
        $gaSql['db'] = \Config::get('database.connections.mysql.database');
        $gaSql['server'] = \Config::get('database.connections.mysql.host');

        /*         * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * If you just want to use the basic configuration for DataTables with PHP server-side, there is
         * no need to edit below this line
         */
        /*
         * Local functions
         */

        function fatal_error($sErrorMessage = '') {
            header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error');
            die($sErrorMessage);
        }

        /*
         * MySQL connection
         */
        if (!$gaSql['link'] = mysqli_connect($gaSql['server'], $gaSql['user'], $gaSql['password'], $gaSql['db'])) {
            fatal_error('Could not open connection to server');
        }
//    print_r($gaSql);exit;
        if (!mysqli_select_db($gaSql['link'], $gaSql['db'])) {
            fatal_error('Could not select database ');
        }

        /*
         * Paging
         */
        $sLimit = "";
        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT " . intval($_GET['iDisplayStart']) . ", " .
                    intval($_GET['iDisplayLength']);
        }

        /*
         * Ordering
         */
        $sOrder = "";
        if (isset($_GET['iSortCol_0'])) {
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . "
                    " . ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") {
                $sOrder = "";
            }
        }

        /*
         * Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */
        $sWhere = "";
        if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($aColumns); $i++) {
                if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true") {
                    $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch']) . "%' OR ";
                }
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
        }

        /* Individual column filtering */
        for ($i = 0; $i < count($aColumns); $i++) {
            if (isset($_GET['bSearchable_' . $i]) && $_GET['bSearchable_' . $i] == "true" && $_GET['sSearch_' . $i] != '') {
                if ($sWhere == "") {
                    $sWhere = "WHERE ";
                } else {
                    $sWhere .= " AND ";
                }
                $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch_' . $i]) . "%' ";
            }
        }

        $operator = (isset($_GET['operator'])) ? $_GET['operator'] : '';
        $departure_aerodrome = (isset($_GET['departure_aerodrome'])) ? $_GET['departure_aerodrome'] : '';
        $destination_aerodrome = (isset($_GET['destination_aerodrome'])) ? $_GET['destination_aerodrome'] : '';
        $aircraft_callsign = (isset($_GET['aircraft_callsign'])) ? $_GET['aircraft_callsign'] : '';
        $from_date = (isset($_GET['from_date'])) ? $_GET['from_date'] : '';
        $to_date = (isset($_GET['to_date'])) ? $_GET['to_date'] : '';
        $url = (isset($_GET['url'])) ? $_GET['url'] : '';
        $date_of_flight = (isset($_GET['date_of_flight'])) ? $_GET['date_of_flight'] : '';
        $clicked_btn = (isset($_GET['clicked_btn'])) ? $_GET['clicked_btn'] : '';
        $is_admin = $this->is_admin;
        $filter_stats = (isset($_GET['filter_stats'])) ? $_GET['filter_stats'] : '';

        $wing_type = (isset($_GET['wing_type'])) ? $_GET['wing_type'] : '';

        $get_fpl_stats_ui = \App\models\FPLStatsUIModel::get_all();

        $navlog_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->navlog_plans : '';
        $navlog_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $navlog_list);
        $navlog_list = str_replace("'", "", $navlog_list);
        $navlog_list = explode(",", $navlog_list);
        $navlog_list = "'" . implode("','", $navlog_list) . "'";

        $weather_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->weather_plans : '';
        $weather_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $weather_list);
        $weather_list = str_replace("'", "", $weather_list);
        $weather_list = explode(",", $weather_list);
        $weather_list = "'" . implode("','", $weather_list) . "'";

        $helicopter_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->helicopter_plans : '';
        $helicopter_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $helicopter_list);
        $helicopter_list = str_replace("'", "", $helicopter_list);
        $helicopter_list = explode(",", $helicopter_list);
        $helicopter_list = "'" . implode("','", $helicopter_list) . "'";

        if ($date_of_flight != '') {
            $date_of_flight = date('ymd', strtotime($date_of_flight));
        }
        if ($from_date != '' && $to_date != '') {
            $from_date = date('ymd', strtotime($from_date));
            $to_date = date('ymd', strtotime($to_date));
        }

        $current_date = date('ymd');
        $yesterday = date('ymd', strtotime("-1 day"));
        $fourth_day = date('ymd', strtotime("+4 days"));

        $filter = [];
        if ($sWhere == "") {
            $sWhere = "WHERE is_active=1";
        } else {
            $sWhere .= " AND is_active=1 ";
        }
        if ($operator != '') {
            $sWhere .= " AND operator LIKE '%$operator%'";
        }
        if ($departure_aerodrome != '') {
            $sWhere .= " AND (departure_aerodrome LIKE '%$departure_aerodrome%' OR departure_station  LIKE '%$departure_aerodrome%')";
        }
        if ($destination_aerodrome != '') {
            $sWhere .= " AND (destination_aerodrome  LIKE '%$destination_aerodrome%' OR destination_station  LIKE '%$destination_aerodrome%')";
        }
        if ($aircraft_callsign != '') {
            $current_date = date('ymd');
            $yesterday = date('ymd', strtotime("-1 day"));
            $fourth_day = date('ymd', strtotime("+4 days"));
            if ($departure_aerodrome == '' && $destination_aerodrome == '' && $from_date == '' && $to_date == '') {
                $sWhere .= " AND aircraft_callsign LIKE '%$aircraft_callsign%' AND date_of_flight BETWEEN $yesterday AND $fourth_day";
            } else {
                $sWhere .= " AND aircraft_callsign LIKE '%$aircraft_callsign%'";
            }
        }
        if ($from_date != '' && $to_date != '') {
            $sWhere .= " AND date_of_flight BETWEEN '$from_date' AND '$to_date'";
        }
        if ($date_of_flight != '') {
            $sWhere .= " AND date_of_flight = '$date_of_flight'";
        }
        if ($filter_stats == 'wx_notams') {
            $sWhere .= " AND SUBSTRING(`aircraft_callsign`,1,5) in ($weather_list) AND plan_status =1";
        }
        if (1) {
            // AND plan_status =1
            $sWhere .= " AND ((SUBSTRING(`aircraft_callsign`,1,5) in ($navlog_list)) OR (SUBSTRING(`aircraft_callsign`,1,6) in ('ZOM101', 'ZOM301')))";
        }
        if ($filter_stats == 'wing_plans') {
            if ($wing_type == 1) {
                $sWhere .= " AND aircraft_type IN ($helicopter_list)  AND plan_status =1";
            } else {
                $sWhere .= " AND aircraft_type NOT IN ($helicopter_list)  AND plan_status =1 AND aircraft_callsign NOT LIKE 'TESTA' AND aircraft_callsign NOT LIKE 'TESTX' ";
            }
        }

        if (!$is_admin) {
            if ($this->user_callsigns) {
                $user_callsigns_array = explode(",", $this->user_callsigns);
                $user_callsigns_string = "'" . implode("','", $user_callsigns_array) . "'";
                $sWhere .= " AND (user_id = '$this->user_id' OR SUBSTR(`aircraft_callsign`,1,5) in ($user_callsigns_string))";
            } else {
                $sWhere .= " AND user_id = '$this->user_id'";
            }
        }

        /*
         * SQL queries
         * Get data to display
         */
        $sOrder = "ORDER BY date_of_flight desc,departure_time_hours desc,departure_time_minutes desc,id desc";

        $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . ",departure_latlong, destination_station,
	    destination_latlong, is_active
        FROM   $sTable
        $sWhere
        $sOrder
        $sLimit
    ";
        $rResult = mysqli_query($gaSql['link'], $sQuery) or fatal_error('MySQL Error: ' . mysqli_error($gaSql['link']));

        /* Data set length after filtering */
        $sQuery = "
        SELECT FOUND_ROWS()
    ";
        $rResultFilterTotal = mysqli_query($gaSql['link'], $sQuery) or fatal_error('MySQL Error: ' . mysqli_error($gaSql['link']));
        $aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
        $iFilteredTotal = $aResultFilterTotal[0];

        /* Total data set length */
        $sQuery = "
        SELECT COUNT(" . $sIndexColumn . ")
        FROM   $sTable
    ";
        $rResultTotal = mysqli_query($gaSql['link'], $sQuery) or fatal_error('MySQL Error: ' . mysqli_error($gaSql['link']));
        $aResultTotal = mysqli_fetch_array($rResultTotal);
        $iTotal = $aResultTotal[0];

        /*
         * Output
         */
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array(),
        );
        $sno = $iFilteredTotal - ($_GET['iDisplayStart']);
        while ($aRow = mysqli_fetch_array($rResult)) {
            $row = array();
            for ($i = 0; $i < count($aColumns); $i++) {
                if ($aColumns[$i] == "version") {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[$aColumns[$i]] == "0") ? '-' : $aRow[$aColumns[$i]];
                } else if ($aColumns[$i] != ' ') {
                    /* General output */
                    $row[] = $aRow[$aColumns[$i]];
                }
            }
            $id = $aRow['id'];
            $date_of_flight = $aRow['date_of_flight'];
            
            $c_date=date('ymd');

            

            $aircraft_callsign = $aRow['aircraft_callsign'];
            $departure_aerodrome = $aRow['departure_aerodrome'];
            $destination_aerodrome = $aRow['destination_aerodrome'];
            $operator = $aRow['operator'];
            $departure_time_hours = $aRow['departure_time_hours'];
            $departure_time_minutes = $aRow['departure_time_minutes'];
            $flying_time_hours = $aRow['total_flying_hours'];
            $flying_time_minutes = $aRow['total_flying_minutes'];
            $fuel_value = ($aRow['fuel_value']) ? $aRow['fuel_value'] : '';
            $fuel_required = ($aRow['fuel_required']) ? $aRow['fuel_required'] : '';
            $pob = ($aRow['pob'] != '') ? $aRow['pob'] : '';
            $fic = $aRow['fic'];
            $adc = $aRow['adc'];
            $plan_status = $aRow['plan_status'];
            $plan_status_class = ($plan_status == 2) ? "company_color" : 'text-black';
            $current_date = date('ymd');
            $is_plan_active = '';
            $is_fic_active = '';
            $background_white = '';
            if ($date_of_flight >= $current_date && $plan_status == 1) {
                $is_plan_active = 1;
            }
            if ($date_of_flight == $current_date && $plan_status == 1 && $is_admin) {
                $is_fic_active = '1';
                $background_white = ($fic && $adc) ? '' : 'background-white';
            }
            $fuel_required_class = ($fuel_required) ? "fuel_required_class" : "";
            $fuel_required_row_class = ($fuel_required) ? "fuel_required_row_class":'';
            $cursor_disable = ($is_plan_active) ? '' : 'cursor_disable';
            $departure_station = '';
            $destination_station = '';
            $tooltip_cancel = '';
            $tooltip_cancel2 = '';

            if (($departure_aerodrome == 'ZZZZ' && $destination_aerodrome == 'ZZZZ') || ($plan_status == 2)) {
                $notam_cursor_disable = "style='cursor:not-allowed !important;'";
                $fpl_notams = "";
            } else {
                $notam_cursor_disable = "style='cursor:pointer !important;'";
                $fpl_notams = "fpl_notams";
            }

            if ($departure_aerodrome == 'ZZZZ') {
                $tooltip_cancel = 'tooltip_cancel';
            }
            if ($destination_aerodrome == 'ZZZZ') {
                $tooltip_cancel2 = 'tooltip_cancel';
            }

            if ($departure_aerodrome == 'ZZZZ') {
                $departure_aerodrome = substr($aRow['departure_station'], 0, 16);
                $departure_station = $aRow['departure_station'];
            }
            if ($destination_aerodrome == 'ZZZZ') {
                $destination_aerodrome = substr($aRow['destination_station'], 0, 16);
                $destination_station = $aRow['destination_station'];
            }

            if ($is_plan_active) {
                $fdtl_popup = "fdtl_popup";
            } else {
                $fdtl_popup = "";
            }
            
            if($date_of_flight>=$c_date)
               $modal_button_disabled=0;
             else
               $modal_button_disabled=1;

            $aRow['is_active'] = ($aRow['is_active']) ? 'Active' : 'Inactive';
            $hi = gmdate('Hi');
            $cursor_disable = ($is_plan_active) ? "" : "style='cursor:not-allowed !important;'";
            $fic_cursor_disable = ($is_fic_active) ? "" : "style='cursor:not-allowed !important;'";
            $fic_disabled = ($is_fic_active) ? '' : 'disabled="disabled"';
            $fuel_readonly = ($fuel_value) ? 'readonly=readonly' : '';
            $pob_readonly = ($pob != "") ? 'readonly=readonly' : '';
            $check_revise = ($is_plan_active) ? 'check_revise' : '';
            $encoded = Crypt::encrypt($id);
            $cancel_disabled = ($plan_status == 1) ? '' : 'disabled="disabled"';

            $cursor_disable1 = ($plan_status == 1) ? "style='cursor:pointer !important;'" : "style='cursor:not-allowed !important;'";


            //\App\myfolder\HelperClass::encrypt($id);
            $gmt_time = gmdate('Hi');
            $is_change_allowed = '';
            $date_of_flight_display = date('d-M', strtotime('20' . $date_of_flight));
            $date_of_flight_notams = date('d-M-Y', strtotime('20' . $date_of_flight));

            $startTime = Carbon::parse($flying_time_hours . $flying_time_minutes);
            $flyingDuration = $startTime->addMinutes(10);
            $flyingDuration = date('Hi', strtotime($flyingDuration));
           
            
            $row = array(0 => $sno,
                1 => "<div class='dof $fuel_required_row_class $plan_status_class'><span class='flightdate  $fuel_required_class'>" . $date_of_flight_display . "</span>
                      </div>
                <div class='tooltip_cancel'>
		<span class='eye'>
                <img $cursor_disable1 src='$url/media/images/fuel/fuelicon.png' modal-type='preview' data-callsign='$aircraft_callsign' data-aero='$departure_aerodrome' data-value='$id' class='img-responsive FuelRequest' 
                 data-button='$modal_button_disabled' data-plan_status='$plan_status'>
                </span>
                <span class='tooltip_fpl_position' style='left:30px;'  >ORDER FUEL</span>
				<div class='tooltip_tri_shape2' style='right: 14px;'></div>
			</div>"
                ,
                2 => "<div class='calsign $fuel_required_class $plan_status_class'>
			$operator
	</div>",
                4 => "<div class='from $fuel_required_class deptpopover $plan_status_class'><div class='$tooltip_cancel'><span href='#'>$departure_aerodrome</span><span class='tooltip_dept_position'>$departure_station</span><div class='tooltip_tri_shape4'></div></div></div>",
                5 => "<div class='to $fuel_required_class deptpopover $plan_status_class'><div class='$tooltip_cancel2'><span href='#'>$destination_aerodrome</span><span class='tooltip_dest_position'>$destination_station</span><div class='tooltip_tri_shape5'></div></div></div>",
                3 => "<div class='depart-time  $fuel_required_class $plan_status_class'>
		   $aircraft_callsign
		</div>",
                6 => "<div class='fic-adc $fuel_required_class $plan_status_class'>
		    $departure_time_hours$departure_time_minutes
		</div>",
                7 => "<div class='fic-adc $fuel_required_class $plan_status_class'>
		    $flyingDuration
		</div>",
                8 => "<div class='fic-adc $plan_status_class'>
                       <div class='' style='width:100%'>
                         <input type='text' data-toggle='popover' data-placement='top' style='text-align:center' $pob_readonly class='form-control numeric pobc' data-value='$id'  id='pob$id' value='$pob' name='pob$id ' placeholder='POB' maxlength='3' $cancel_disabled data-plan_status='$plan_status'>
                      </div>
		   </div>",
                9 => "<div class='fic-adc $plan_status_class'>
                        <form method='post' name='ficadc' action='#'>
                            <div class='fic' style='width:69%'>
                                <input type='text' data-toggle='popover' data-placement='top' style='text-align:center' $fuel_readonly class='form-control numeric fuelc' data-value='$id'  id='fuel$id' value='$fuel_value' name='fuel$id' placeholder='BLOCK' maxlength='5' $cancel_disabled 
                                data-plan_status='$plan_status'>
                            </div>
                            <div class='fuelsend'>
                                <input type='button' class='form-control sendbtn fuel_submit'  is-fic-active ='$is_fic_active' modal-type='fuel' data-value='$id' value='Send' data-url='$url/fuel/update'  >
                            </div>
                        </form>
		</div>"
            );
            $sno--;
            $output['aaData'][] = $row;
        }

        return $output;
    }

    public function fuel_update(Request $request) {
        $id = $request->id;
        $fuel_value = $request->fuel_value;
        $pob = $request->pob;

        $fpl_data = FlightPlanDetailsModel::where('id', $id)->first(['aircraft_callsign']);
        $aircraft_callsign = ($fpl_data) ? $fpl_data->aircraft_callsign : "";

        $aircraft_callsign1 = substr($aircraft_callsign, 0, 5);
        $aircraft_callsign2 = substr($aircraft_callsign, 0, 6);
        
        $list1 = ['VTOMM', 'VTIBP', 'VTLTD', 'VTEPU', 'VTFIU', 'VTJSI']; 
        /*$list1 = ['VTOMM', 'VTIBP', 'VTZOA', 'VTZOC', 'VTLTD', 'VTKJG'];
        $list2 = ['ZOM101', 'ZOM301'];

        if (in_array($aircraft_callsign1, $list1)) {
            $fuel_value = round(($fuel_value * 2.2046), 2);
        } elseif (in_array($aircraft_callsign2, $list2)) {
            $fuel_value = round(($fuel_value * 2.2046), 2);
        }
        */
        if (in_array($aircraft_callsign1, $list1)) {
            $fuel_value = round(($fuel_value * 2.2046), 2);
        }
        $result = FlightPlanDetailsModel::where('id', $id)->update(['fuel_value' => $fuel_value, 'pob' => $pob]);

        return response()->json(['STATUS_CODE' => '1', 'STATUS_DESC' => 'FUEL DATA UPDATED SUCCESSFULLY!', 'result' => $result]);
    }

    public function download_excel(Request $request) {
        $is_admin = Auth::user()->is_admin;
        if (!$is_admin) {
            return 'fail';
        } else {
            $current_day = date('ymd');
            $get_fpl_stats_ui = \App\models\FPLStatsUIModel::get_all();
            $navlog_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->navlog_plans : '';
            $navlog_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $navlog_list);
            $navlog_list = str_replace("'", "", $navlog_list);
            $navlog_list = explode(",", $navlog_list);

            $departure_aerodrome = $request->departure_aerodrome2;
            $destination_aerodrome = $request->destination_aerodrome2;
            $aircraft_callsign = $request->aircraft_callsign2;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $date_of_flight = $request->date_of_flight;
            $operator2 = $request->operator2;


//            $navlog_list = "'" . implode("','", $navlog_list) . "'";
            $navlog_plans = FlightPlanDetailsModel::where('is_active', '1')
                    ->where('plan_status', '1')
                    ->where(function($query) use($navlog_list) {
                        $query->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), $navlog_list);
                        $query->orWhere(function($query2) {
                            $query2->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,6)"), ['ZOM101', 'ZOM301']);
                        });
                    })
                    ->where(function($query) use($departure_aerodrome) {
                        if ($departure_aerodrome != "") {
                            $query->where('departure_aerodrome', $departure_aerodrome);
                        }
                    })
                    ->where(function($query) use($destination_aerodrome) {
                        if ($destination_aerodrome != "") {
                            $query->where('destination_aerodrome', $destination_aerodrome);
                        }
                    })
                    ->where(function($query) use($aircraft_callsign) {
                        if ($aircraft_callsign != "") {
                            $query->where('aircraft_callsign', $aircraft_callsign);
                        }
                    })
                    ->where(function($query) use($operator2) {
                        if ($operator2 != "") {
                            $query->where('operator', $operator2);
                        }
                    })
                    ->where(function($query) use($from_date, $to_date, $current_day) {
                        if ($from_date != "" && $to_date != "") {
                            $from_date2 = date('ymd', strtotime($from_date));
                            $to_date2 = date('ymd', strtotime($to_date));
                            $query->whereBetween('date_of_flight', [$from_date2, $to_date2]);
                        } else {
                            $query->where('date_of_flight', $current_day);
                        }
                    })
                    ->get(['operator', 'date_of_flight', 'aircraft_callsign', 'departure_aerodrome', 'destination_aerodrome', 'departure_time_hours',
                'departure_time_minutes', 'total_flying_hours', 'total_flying_minutes', 'fuel_value as block_fuel', 'pob']);


            if ($from_date != "" && $to_date != "") {
                if ($from_date != $to_date) {
                    $fileName = "$from_date - $to_date FUEL DATA";
                } else {
                    $fileName = "$from_date FUEL DATA";
                }
            } else {
                $fileName = date("d-M-Y") . " FUEL DATA";
            }
            Excel::create($fileName, function($excel) use ($navlog_plans) {
                $excel->sheet('fuel_sheet', function($sheet) use ($navlog_plans) {
                    $sheet->fromModel($navlog_plans);
                    $sheet->setOrientation('landscape');
                });
            })->export('csv');
        }
    }

    public function get_filter_fuel(Request $request) {
        $clicked_btn = $request->clicked_btn;
        $filter_stats = $request->filter_stats;
        $wing_type = $request->wing_type;
        $data = $request->all();
//        print_r($data);exit;
        return view('fpl.filter_fuel', $data);
    }

    public function fuel_count(Request $request) {
       
        $is_admin = Auth::user()->is_admin;
        if (!$is_admin) {
            return 'fail';
        } else {
            $current_day = date('ymd');
            $get_fpl_stats_ui = \App\models\FPLStatsUIModel::get_all();
            $navlog_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->navlog_plans : '';
            $navlog_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $navlog_list);
            $navlog_list = str_replace("'", "", $navlog_list);
            $navlog_list = explode(",", $navlog_list);

            $departure_aerodrome = $request->departure_aerodrome2;
            $destination_aerodrome = $request->destination_aerodrome2;
            $aircraft_callsign = $request->aircraft_callsign2;
            $from_date = $request->from_date;
            $to_date = $request->to_date;
            $date_of_flight = $request->date_of_flight;
            $operator2 = $request->operator2;

//            $navlog_list = "'" . implode("','", $navlog_list) . "'";
            $navlog_plans = FlightPlanDetailsModel::where('is_active', '1')
                    ->where('plan_status', '1')
                    ->where(function($query) use($navlog_list) {
                        $query->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), $navlog_list);
                        $query->orWhere(function($query2) {
                            $query2->whereIn(DB::raw("SUBSTRING(`aircraft_callsign`,1,6)"), ['ZOM101', 'ZOM301']);
                        });
                    })
                    ->where(function($query) use($departure_aerodrome) {
                        if ($departure_aerodrome != "") {
                            $query->where('departure_aerodrome', "LIKE", "%$departure_aerodrome%");
                        }
                    })
                    ->where(function($query) use($destination_aerodrome) {
                        if ($destination_aerodrome != "") {
                            $query->where('destination_aerodrome', "LIKE", "%$destination_aerodrome%");
                        }
                    })
                    ->where(function($query) use($aircraft_callsign) {
                        if ($aircraft_callsign != "") {
                            $query->where('aircraft_callsign', "LIKE", "%$aircraft_callsign%");
                        }
                    })
                    ->where(function($query) use($operator2) {
                        if ($operator2 != "") {
                            $query->where('operator', "LIKE", "%$operator2%");
                        }
                    })
                    ->where(function($query) use($from_date, $to_date, $current_day) {
                        if ($from_date != "" && $to_date != "") {
                            $from_date2 = date('ymd', strtotime($from_date));
                            $to_date2 = date('ymd', strtotime($to_date));
                            $query->whereBetween('date_of_flight', [$from_date2, $to_date2]);
                        } else {
                            $query->where('date_of_flight', $current_day);
                        }
                    })
                    ->get(['total_flying_hours', 'total_flying_minutes', 'fuel_value as block_fuel']);


            $no_of_flight = count($navlog_plans);
            $total_flying = Carbon::parse('0000');
            $total_fth = 0;
            $total_ftm = 0;
            $total_block_fuel = 0;
            foreach ($navlog_plans as $navlog_plans_value) {
                $total_flying_hours = $navlog_plans_value->total_flying_hours;
                $total_flying_minutes = $navlog_plans_value->total_flying_minutes;
                $block_fuel = $navlog_plans_value->block_fuel;

                $startTime = Carbon::parse($total_flying_hours . $total_flying_minutes);
                $flyingDuration = $startTime->addMinutes(10);
                $flyingDuration = date('Hi', strtotime($flyingDuration));

                $fth = substr($flyingDuration, 0, 2);
                $ftm = substr($flyingDuration, 2, 4);
                $total_fth = $total_fth + $fth;
                $total_ftm = $total_ftm + $ftm;
                $total_block_fuel = $total_block_fuel + $block_fuel;
            }
            $total_flying = \App\myfolder\HelperClass::convertToHoursMins($total_ftm, $total_fth);
            $kilo_total_fuel = round((($total_block_fuel / 1.76) / 1000), 2);
//            $total_block_fuel = $total_block_fuel/1000 ;

            $data = ['no_of_flight' => $no_of_flight,
                'total_flying' => $total_flying,
                'total_block_fuel' => $total_block_fuel, 'kilo_total_fuel' => $kilo_total_fuel];

            return response()->json(['STATUS_CODE' => '1', 'STATUS_DESC' => 'FUEL DATA UPDATED SUCCESSFULLY!', 'result' => $data]);
        }
    }

    public function fuel_price(Request $request) {
        return view('fuel.fuel_price');
    }

    public function order(Request $request) {
        $id = $request->id;
        $fuel_required = $request->fuel_order;

        $email = $this->user_email;
        $user_name = $this->user_name;

        $result = FlightPlanDetailsModel::where('id', $id)
                ->first(['aircraft_callsign', 'departure_aerodrome',
            'date_of_flight', 'departure_time_hours', 'departure_time_minutes', 'registration']);

        $aircraft_callsign = ($result) ? $result->aircraft_callsign : "";
        $departure_aerodrome = ($result) ? $result->departure_aerodrome : "";
        $date_of_flight = ($result) ? $result->date_of_flight : "";
        $date_of_flight = date('d-M-Y', strtotime('20' . $date_of_flight));
        $registration = ($result) ? $result->registration : "";

        $dept_hour = ($result) ? $result->departure_time_hours : "";
        $dept_minutes = ($result) ? $result->departure_time_minutes : "";
        $dept = $dept_hour . ':' . $dept_minutes;

        $dept = Carbon::parse($dept);
        $dept = $dept->addHours(5)->addMinutes(30);
        $dept = date('H:i', strtotime($dept));

        $aircraft_callsign = substr($aircraft_callsign, 0, 5);

        $fuel_result = \App\models\Fuelprice::where('airport_code', $departure_aerodrome)
                ->first([
            'user_id', 'airport_code', 'city', 'fuel_type',
            'eflight_price', 'basic_price', 'tax', 'tax_amount', 'hp_price', 'from_date', 'to_date', 'status'
        ]);

        $city = ($fuel_result) ? $fuel_result->city : "";

        $user_data = User::where('user_callsigns', 'LIKE', "%$aircraft_callsign%")->first(['operator']);
        $operator = ($user_data) ? $user_data->operator : "";

        $subject = "$aircraft_callsign FUEL REQUEST at $departure_aerodrome // $date_of_flight";

        $entered_date = date('d-M-Y');
        $entered_time = date('H:i:s');
        
        $entered_time = Carbon::parse($entered_time);
        $entered_time = $entered_time->addHours(5)->addMinutes(30);
        $entered_time = date('H:i', strtotime($entered_time));

        $data = ['email' => $email, 'subject' => $subject,
            'departure_aerodrome' => $departure_aerodrome, 'aircraft_callsign' => $aircraft_callsign,
            'city' => $city, 'dept' => $dept, 'fuel_required' => $fuel_required,
            'date_of_flight' => $date_of_flight, 'operator' => $operator,
            'registration' => $registration, 'entered_by' => $user_name,
            'entered_date' => $entered_date, 'entered_time' => $entered_time
        ];
        Log::info('FuelOrderJob started!');
        dispatch(new FuelOrderJob($data));
        Log::info('FuelOrderJob ended!');
        $result = FlightPlanDetailsModel::where('id', $id)->update(['fuel_required' => $fuel_required]);

        $history_data = [
            'fpl_id' => $id,
            'user_id' => Auth::user()->id,
            'fuel_order' => $fuel_required
        ];
        $history = \App\models\FuelOrderHistoryModel::create($history_data);
        return response()->json(['STATUS_CODE' => '1', 'STATUS_DESC' => 'FUEL ORDER PLACED SUCCESSFULLY!', 'result' => $result]);
    }

    public function get_price_data(Request $request) {
        $current_date=date('Ymd');

        $id = $request->id;
        $airportcode = $request->airportcode;

        $result = \App\models\Fuelprice::where('airport_code', $airportcode)
                ->where(function($query) use($airportcode) {
                    if ($airportcode == "VIDP") {
                        $query->where('city', "LIKE", 'DELHI PALAM T1');
                    }
                })->where('from_Date','<=',$current_date)->orderBy('from_date','DESC')
                ->first([
            'user_id', 'airport_code', 'city', 'fuel_type',
            'eflight_price', 'basic_price', 'tax', 'tax_amount', 'hp_price', 'from_date', 'to_date', 'status'
        ]);

        $from_date = ($result) ? date('d-M-Y', strtotime($result->from_date)) : "";
        $to_date = ($result) ? date('d-M-Y', strtotime($result->to_date)) : "";

        $fpl_data = FlightPlanDetailsModel::where('id', $id)->first(['fuel_required']);
        $fuel = ($fpl_data) ? $fpl_data->fuel_required : "";

        $result2 = ($result) ? TRUE : FALSE;

        $history = \App\models\FuelOrderHistoryModel::get_history($id);


        foreach ($history as $key => $history_value) {
            $user_id = $history_value->user_id;
            $user_name = User::where('id', $user_id)->first(['name']);
            $user_name = ($user_name) ? $user_name->name : "";
            $upda = $history_value->updated_at;
            $history[$key]['updated_date'] = date("d-M-Y", strtotime($upda));
            $history[$key]['updated_by'] = $user_name;
        }

        return response()->json(['STATUS_CODE' => '1',
                    'STATUS_DESC' => 'FUEL DATA SUCCESSFULLY!',
                    'result' => $result, 'from_date' => $from_date,
                    'to_date' => $to_date, 'fuel' => $fuel, 'result2' => $result2, 'history' => $history]);
    }

    public function get_call_ops(Request $request) {
        $call_list = [];

        $navlog_plans = FlightPlanDetailsModel::where('is_active', '1')
                ->where('plan_status', '1')
                ->select(['aircraft_callsign'])
                ->groupBy(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"))
                ->get();

        foreach ($navlog_plans as $value) {

            $aircraft_callsign = $value->aircraft_callsign;
            $user_data = User::where('user_callsigns', 'LIKE', "%$aircraft_callsign%")->first(['operator']);
            if (!$user_data) {
                $call_list[] = $aircraft_callsign;
            }
        }

        return $call_list;
    }

}
