<?php

namespace App\Http\Controllers\fpl;

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
use Illuminate\Http\Request;
use Log;
use Redirect;
use Response;
use Crypt;
use App\models\CallsignInfoModel;
use App\models\FPLStatsModel;
use Maatwebsite\Excel\Facades\Excel;
use App\User;
use DB;

class NewfplController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function index(Request $request) {
        try {
            $page = $request->page;
            switch ($page) {
                case 'quick_plan':
                    return view('fpl.check_quick_plan');
                    break;
                default:
                    $get_all = FlightPlanDetailsModel::fetch_fpl_records();
                    $get_day_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
                    $get_month_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('', '1'));
                    $get_year_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
                    $get_total_count_fpl = count(FlightPlanDetailsModel::get_count_fpl());
                    $get_dates_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
                    $get_user_count_fpl = count(FlightPlanDetailsModel::get_count_fpl('1'));
                    $input = [];
                    $data = ['get_all' => $get_all,
                        'get_day_count_fpl' => $get_day_count_fpl,
                        'get_month_count_fpl' => $get_month_count_fpl,
                        'get_year_count_fpl' => $get_year_count_fpl,
                        'get_total_count_fpl' => $get_total_count_fpl,
                        'get_dates_count_fpl' => $get_dates_count_fpl,
                        'get_user_count_fpl' => $get_user_count_fpl,
                        'input_data' => $input,
                    ];

                    return view('fpl.check_quick_plan', $data);
                    break;
            }
        } catch (\Exception $ex) {
            Log::error('Fpl Controller: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $flag = $request->flag;
        $inputs = $request->all();
        $new_plan = $request->is_new_plan;
        switch ($flag) {
            case 'File':
                $result = $this->file_the_process($inputs);
//                echo $result;exit;
                if ($result) {
                    return redirect::to('fpl/new_quick')->with('success', 'Flight plan processed successfully!')
                                    ->with('id', $result->id)
                                    ->with('file_name', $result->file_name)
                                    ->with('pdf_path', $result->pdf_path)
                                    ->with('departure_aerodrome', $result->departure_aerodrome)
                                    ->with('destination_aerodrome', $result->destination_aerodrome)
                                    ->with('date_of_flight', $result->date_of_flight)
                                    ->with('aircraft_callsign', $result->aircraft_callsign)
                                    ->with('pilot_in_command', $result->pilot_in_command)
                                    ->with('mobile_number', $result->mobile_number)
                                    ->with('copilot', $result->copilot)
                                    ->with('cabincrew', $result->cabincrew)
                                    ->with('departure_station', $result->departure_station)
                                    ->with('departure_latlong', $result->departure_latlong)
                                    ->with('destination_station', $result->destination_station)
                                    ->with('destination_latlong', $result->destination_latlong)
                                    ->with('is_plan_filed', '1')
                    ;
                } else {
                    return redirect::to('fpl/new_quick')->with('error', 'Something went wrong!');
                }
                break;
            case 'Edit':
                if ($new_plan) {
                    $result = 1;
                    if ($result) {
                        return view('fpl.new_full_fpl', $inputs);
                    } else {
                        return Redirect::back()->with('error', 'Something went wrong!');
                    }
                } else {
                    $result = $this->on_edit_plan($inputs);
                    if ($result) {
                        return view('fpl.new_edit_fpl', $result);
                    } else {
                        return Redirect::back()->with('error', 'Something went wrong!');
                    }
                }
                break;
            case 'Process':
                $check_flight_details = FlightPlanDetailsModel::get_flight_details($inputs);
                if (!$check_flight_details) {
                    $result = $this->process_quick_plan($inputs, 'edit_page');
                    return view('fpl.new_edit_fpl', $result);
                } else {
                    $result = $this->process_quick_plan($inputs);
                    if ($result) {
                        return view('fpl.new_quick_fpl', $result);
                    } else {
                        return Redirect::back()->with('error', 'Something went wrong!');
                    }
                }
                break;

            case 'search':
                $input = $request->all();
                $get_all = FlightPlanDetailsModel::get_fpl_filter_data($input);
                $get_day_count_fpl = count($get_all);
                $get_month_count_fpl = count($get_all);
                $get_year_count_fpl = count($get_all);
                $get_total_count_fpl = count($get_all);
                $get_dates_count_fpl = count($get_all);
                $get_user_count_fpl = count($get_all);

                $data = ['get_all' => $get_all,
                    'get_day_count_fpl' => $get_day_count_fpl,
                    'get_month_count_fpl' => $get_month_count_fpl,
                    'get_year_count_fpl' => $get_year_count_fpl,
                    'get_total_count_fpl' => $get_total_count_fpl,
                    'get_dates_count_fpl' => $get_dates_count_fpl,
                    'get_user_count_fpl' => $get_user_count_fpl,
                    'input_data' => $input,
                ];
                return view('fpl.new_quick_fpl', $data);

                break;
            default:
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    public function fpl_list() {
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
            'departure_time_minutes', 'fic', 'adc', 'plan_status', 'departure_station');

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
        if ($filter_stats == 'trip_kit') {
            $sWhere .= " AND ((SUBSTRING(`aircraft_callsign`,1,5) in ($navlog_list)  AND plan_status =1) OR (SUBSTRING(`aircraft_callsign`,1,6) in ('ZOM101', 'ZOM301')) AND plan_status =1 )";
        }
        if ($filter_stats == 'wing_plans') {
            if ($wing_type == 1) {
                $sWhere .= " AND aircraft_type IN ($helicopter_list)  AND plan_status =1";
            } else {
                $sWhere .= " AND aircraft_type NOT IN ($helicopter_list)  AND plan_status =1 AND aircraft_callsign NOT LIKE 'TESTA' AND aircraft_callsign NOT LIKE 'TESTX' ";
            }
        }
        if ($filter_stats == 'cancel_plans') {
            $sWhere .= " AND plan_status =2";
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

//	SUBSTRING(`aircraft_callsign`,1,5) in ('VTAAT', 'VTANF', 'VTAUV', 'VTAVS', 'VTBAJ', 'VTBRK', 'VTCMO', 'VTDBC', 'VTEJZ', 
//		'VTFAF', 'VTGKB', 'VTJSK', 'VTJUI', 'VTKJB', 'VTKNB', 'VTKZN', 'VTLTC', 'VTMAM', 'VTOMM', 'VTPRS', 'VTPSB', 'VTRAM',
//		'VTRSR', 'VTSAI', 'VTSRC', 'VTSSF', 'VTTVM', 'VTUDR', 'VTUPJ', 'VTUPM', 'VTUPR', 'VTVRL') or 
//		(`is_active` = '1' and `date_of_flight` = '170226' and `plan_status` = '1' and SUBSTRING(`aircraft_callsign`,1,6) 
//		in ('ZOM101', 'ZOM301'))


        /*
         * SQL queries
         * Get data to display
         */
        $sOrder = "ORDER BY date_of_flight desc,departure_time_hours desc,departure_time_minutes desc,id desc";

        $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . ",departure_latlong, destination_station,
	    destination_latlong, is_active,is_etd_changed
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
            $aircraft_callsign = $aRow['aircraft_callsign'];
            $departure_aerodrome = $aRow['departure_aerodrome'];
            $destination_aerodrome = $aRow['destination_aerodrome'];
//	    $equipment = $aRow['equipment'];
            $departure_time_hours = $aRow['departure_time_hours'];
            $departure_time_minutes = $aRow['departure_time_minutes'];
            $fic = $aRow['fic'];
            $adc = $aRow['adc'];
            /* sumit code */
            $is_etd_changed = $aRow['is_etd_changed'];
            /* sumit code */
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

            $aRow['is_active'] = ($aRow['is_active']) ? 'Active' : 'Inactive';
            $hi = gmdate('Hi');
            $cursor_disable = ($is_plan_active) ? "" : "style='cursor:not-allowed !important;'";
            $fic_cursor_disable = ($is_fic_active) ? "" : "style='cursor:not-allowed !important;'";
            $fic_disabled = ($is_fic_active) ? '' : 'disabled="disabled"';
            $fic_readonly = ($fic) ? 'readonly=readonly' : '';

            $adc_readonly = ($adc) ? 'readonly=readonly' : '';
            $check_revise = ($is_plan_active) ? 'check_revise' : '';
            $encoded = Crypt::encrypt($id);
            $cancel_disabled = ($plan_status == 1) ? '' : 'disabled="disabled"';
            //\App\myfolder\HelperClass::encrypt($id);
            $gmt_time = gmdate('Hi');
            $is_change_allowed = '';
            $date_of_flight_display = date('d-M', strtotime('20' . $date_of_flight));
            $date_of_flight_notams = date('d-M-Y', strtotime('20' . $date_of_flight));

            if($is_etd_changed==1 && ($fic!="" || !isset($fic)) && ($adc!="" || !isset($adc))){
               $fic_readonly=''; 
               $adc_readonly='';
               $background_white = 'background-white';
               
            }
            $row = array(0 => $sno,
                1 => "<div class='dof'><span class='flightdate  $plan_status_class  add_cancel_class$id'>" . $date_of_flight_display . "</span>
                                                
			<div class='tooltip_cancel'><span class='delete'><img src='$url/media/ananth/images/close.png' is-plan-active='$is_plan_active' class='img-responsive  modal_class' modal-type='cancel' $cursor_disable  data-value='$id' data-url='$url/new_fpl/modal_popups' alt='delete'>
		   </span><span class='tooltip_cancel_position'>CANCEL</span><div class='tooltip_tri_shape1'></div></div>",
                2 => "<div class='calsign'>
			<div class='tooltip_cancel'>
				<span $cursor_disable data-dept-aero='$departure_aerodrome' data-dest-aero='$destination_aerodrome' data-callsign='$aircraft_callsign' data-dof='$date_of_flight' data-value='$id' class='csgn $plan_status_class add_cancel_class$id $fdtl_popup'>$aircraft_callsign</span><span class='tooltip_fpl_position1'>Edit FDTL</span>
				<div class='tooltip_tri_shape11'></div>
			</div>
                                                <div class='tooltip_cancel'>
                                                    <a href='#'><img src='$url/app/new_temp/images/mail1.png' width='18' style='float:left;cursor:pointer;margin-top:4px;'></a>
                                                    <div class='tooltip_fpl_position2'>SEND EMAIL</div>
                                                    <div class='tooltip_tri_shape12'></div>
                                                </div>
			<div class='tooltip_cancel'>
				<span class='eye'><img src='$url/media/ananth/images/preview.png' is-plan-active='$is_plan_active' modal-type='preview' data-value='$id' class='img-responsive modal_class' data-url='$url/new_fpl/modal_popups' alt='preview'></span><span class='tooltip_fpl_position'>FPL PREVIEW</span>
				<div class='tooltip_tri_shape2'></div>
			</div>
	</div>",
                5 => "<div class='from $plan_status_class  add_cancel_class$id deptpopover'><div class='$tooltip_cancel'><span href='#'>$departure_aerodrome</span><span class='tooltip_dept_position'>$departure_station</span><div class='tooltip_tri_shape4'></div></div></div>",
                6 => "<div class='to $plan_status_class add_cancel_class$id deptpopover'><div class='$tooltip_cancel2'><span href='#'>$destination_aerodrome</span><span class='tooltip_dest_position'>$destination_station</span><div class='tooltip_tri_shape5'></div></div></div>",
                3 => "<div class='depart-time'>
		    <form action='$url/new_fpl/revice_time' name='' id='' method='POST' >
			 <input type='hidden' name='current_time' data-value='$id' id='current_time' value='$hi' />
                         <input type='hidden' name='current_dof' data-value='$id' id='current_dof' value='$date_of_flight' />
                         <input type='hidden' name='a_current_date' data-value='$id' id='a_current_date' value='$current_date' />    
			 <input type='hidden' id='current_dept_time$id' data-value='$id' value='$departure_time_hours$departure_time_minutes' />
			<div class='mod-time tooltip_revise_dbl tooltip_revise_time tooltip_revise_valid'>
			    <input type='text' style='text-align:center' $cursor_disable $cancel_disabled value='$departure_time_hours$departure_time_minutes' id='departure_time$id' data-value='$id' name='departure_time$id' readonly='readonly' class='form-control alt-time $plan_status_class add_cancel_class$id enable_class numeric departure_time $background_white' minlength='4' maxlength='4' placeholder='Time'>
                                                    <div class='tooltip_tri_shape'></div>
                                                    <span class='tooltip_revise_dbl_position'>Double Click to Revise Time</span>
						    <div class='tooltip_tri_shape_valid'></div>
                                                    <span class='tooltip_revise_dbl_position_valid'>Revise Time in multiples of 5 only</span>
			</div>
			<div class='tooltip_cancel'>
			<div class='time-icon'>
			    <img src='$url/media/ananth/images/time.png' id='time_img$id' class='$check_revise' data-value='$id' $cursor_disable $cancel_disabled is-plan-active='$is_plan_active' modal-type='revise_confirm' data-url='$url/new_fpl/modal_popups'>
			</div>
			<span class='tooltip_revise_position'>REVISE TIME</span><div class='tooltip_tri_shape3'></div>
			</div>
		    </form>
		</div>",
                4 => "<div class='fic-adc'>
		    <form method='post' name='ficadc' action='#'>
			<div class='fic'>
			    <input type='text' style='text-align:center' data-toggle ='popover' data-placement='right' class='form-control $plan_status_class numeric fic_valid add_cancel_class$id' data-value='$id'  id='fic$id' value='$fic' name='fic$id' $fic_readonly  placeholder='FIC' minlength='4' maxlength='4' $fic_disabled>
			</div>
			<div class='adc'>
			    <input type='text' style='text-align:center' data-toggle ='popover' data-placement='right'  data-dept-aero='$departure_aerodrome' data-dest-aero='$destination_aerodrome' id='adc$id' name='adc$id' value='$adc' data-placement='bottom' class='form-control $plan_status_class adc_valid text_uppercase add_cancel_class$id' $adc_readonly data-value='$id' maxlength ='6' placeholder='ADC' $fic_disabled>
			</div>
			<div class='send'>
			    <input type='button' class='form-control sendbtn modal_class'  is-fic-active ='$is_fic_active' modal-type='fic_adc' data-value='$id' $fic_cursor_disable value='Send' data-url='$url/new_fpl/modal_popups' data-from='$departure_aerodrome' data-dof='$date_of_flight'>
			</div>
		    </form>
		</div>",
                7 => "<span class='flmodify'><div class='tooltip_cancel'><img src='$url/media/ananth/images/modify.png' class='img-responsive modal_class' $cursor_disable $is_change_allowed is_change_allowed='$is_change_allowed' data-value='$id' data-encoded='$encoded' data-url='$url/new_fpl/modal_popups' is-plan-active='$is_plan_active' modal-type='change_plan' alt='modify'>
			<span class='tooltip_change_position'>CHANGE FPL</span><div class='tooltip_tri_shape6'></div>
			</div></span>",
                8 => "<div class='weather' style='visibility:hidden;'>
                                <div class='tooltip_cancel'>
                                        <a href='$url/fpl/file_plan/$id'><img src='$url/media/ananth/images/pdf.png' class='img-responsive' alt='pdf' width='45px'></a>
                                        <span class='tooltip_pdf_position'>ICAO ATC</span><div class='tooltip_tri_shape8'></div>
                                </div>
                            </div>",
                9 => "<div class='notams' style='visibility:hidden;'>
                                <div class='tooltip_cancel'>
                                        <a  class= '$fpl_notams' $notam_cursor_disable data-dof='$date_of_flight_notams' data-value='$id' target='_self'><img src='$url/media/ananth/images/notam.png' class='img-responsive' alt='notam'></a>
                                        <span class='tooltip_notam_position'>FILTERED NOTAMS</span><div class='tooltip_tri_shape9'></div>
                                </div>
                                </div>",
                10 => "<div class='fildate' style='visibility:hidden;'>
                                <div class='tooltip_cancel'>
                                        <a href='#' target='_self'><img src='$url/media/ananth/images/weather.png' class='img-responsive' alt='weather'></a>
                                        <span class='tooltip_wx_position'>WEATHER BRIEF</span><div class='tooltip_tri_shape10'></div>
                                </div>
                            </div>",
            );
            $sno--;
            $output['aaData'][] = $row;
        }

        return $output;
    }

    public function get_filter_data(Request $request) {
        $clicked_btn = $request->clicked_btn;
        $filter_stats = $request->filter_stats;
        $wing_type = $request->wing_type;
        return view('fpl.filter_quick_plan', ['clicked_btn' => $clicked_btn,
            'filter_stats' => $filter_stats, 'wing_type' => $wing_type]);
    }

    public function modal_popups(Request $request) {
        $id = $request->id;
        $modal_type = $request->modal_type;
        $fpl_details = FlightPlanDetailsModel::find($id);
        $date_of_flight = ($fpl_details) ? $fpl_details->date_of_flight : '';
        $aircraft_callsign = ($fpl_details) ? $fpl_details->aircraft_callsign : '';
        $departure_aerodrome = ($fpl_details) ? $fpl_details->departure_aerodrome : '';
        $destination_aerodrome = ($fpl_details) ? $fpl_details->destination_aerodrome : '';
        $equipment = ($fpl_details) ? $fpl_details->equipment : '';
        $departure_time_hours = ($fpl_details) ? $fpl_details->departure_time_hours : '';
        $departure_time_minutes = ($fpl_details) ? $fpl_details->departure_time_minutes : '';
        $fic = ($fpl_details) ? $fpl_details->fic : '';
        $adc = ($fpl_details) ? $fpl_details->adc : '';
        $plan_status = ($fpl_details) ? $fpl_details->plan_status : '';
        $plan_status_class = ($plan_status == 2) ? "company_color" : '';
        $id = ($fpl_details) ? $fpl_details->id : '';

        $fpl_json_encode = json_encode($fpl_details);
        $data = json_decode($fpl_json_encode, TRUE);

        $total_flying_hours = (array_key_exists('total_flying_hours', $data)) ? $data['total_flying_hours'] : '';
        $total_flying_minutes = (array_key_exists('total_flying_minutes', $data)) ? $data['total_flying_minutes'] : '';
        $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
        $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
        $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
        $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
        $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
        $get_day_of_flight = date("l", strtotime($get_day_of_flight));
        $is_watch_hour_valid = 1;

        $is_watch_hour_valid = myFunction::get_watch_hours($data);

        $data['is_watch_hour_valid'] = $is_watch_hour_valid;
        if ($is_watch_hour_valid) {
            $entered_departure_time = $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes;
        } else {
            $entered_departure_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes . '</span>';
        }
        if ($is_watch_hour_valid) {
            $entered_destination_time = $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes;
        } else {
            $entered_destination_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="Time is beyond Watch Hours">' . $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes . '</span>';
        }

        $data['entered_departure_time'] = $entered_departure_time;
        $data['entered_destination_time'] = $entered_destination_time;
        $atc_fpl_view = myFunction::fpl_atc_info($data);

        $get_dep_zzzz_name = myFunction::get_dep_zzzz_name($data);
        $get_dest_zzzz_name = myFunction::get_dest_zzzz_name($data);

        switch ($modal_type) {
            case 'cancel':
                $modal_message = "Do you wish to Cancel ";
                $modal_message .= (isset($aircraft_callsign)) ? $aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                $modal_message .= " Plan? ";
                $header_title = 'Cancel Plan';
                break;
            case 'preview':
                $modal_message = myFunction::fpl_atc_info($data);
//		$modal_message = str_ireplace('<br>', "<span class='clearfix'></span>", $modal_message);
                $header_title = 'FPL Preview ';
                break;
            case 'revise_confirm':
                $modal_message = "Are you sure to revise departure time for";
                $modal_message .= (isset($aircraft_callsign)) ? $aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                $modal_message .= " Plan? ";
                $header_title = 'Revise Time';
                break;
            case 'fic_adc':
                $modal_message = "Confirm you wish to send SMS for ";
                $modal_message .= (isset($aircraft_callsign)) ? $aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                $modal_message .= " Time? ";
                $header_title = 'FIC ADC Plan';
                break;
            case 'change_plan':
                $modal_message = "Are you sure to Change Plan details for ";
                $modal_message .= (isset($aircraft_callsign)) ? $aircraft_callsign . ': ' . $get_dep_zzzz_name . ' &gt;&gt; ' . $get_dest_zzzz_name : '';
                $modal_message .= " Plan? ";
                $header_title = 'Change Plan';
                break;
            case 'tableview':
                $modal_message = '
<div class="table-responsive">
<table class="table table-bordered">
  <thead class="table-inverse">
    <tr>
      <th class="sno">SI</th>
      <th class="desig">Designation</th>
      <th class="name">Name</th>
      <th class="email"><span>Email</span> <img src="media/ananth/images/copyema-con.png" alt="copyema-con" style="vertical-align:top;" /></th>
      <th class="mob">Mobile</th>
    </tr>
  </thead>
  <tbody>
	  <tr>
		<td>1</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
	  <tr>
		<td>2</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
	  <tr>
		<td>3</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
	  <tr>
		<td>4</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
	  <tr>
		<td>5</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
	  <tr>
		<td>6</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
	  <tr>
		<td>7</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
	  <tr>
		<td>8</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
	  <tr>
		<td>9</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
	  <tr>
		<td>10</td>
		<td>webdeveloper</td>
		<td>lavanya</td>
		<td>lavanya.gondrala84@gmail.com</td>
		<td>1234567890</td>
	  </tr>
  </tbody>
</table>

	</div><!-- end of pilots information -->
';
                $header_title = 'VT-UPJ & VT-UPR ';
            default:
                break;
        }

        return response()->json(['header_title' => $header_title, 'modal_message' => $modal_message]);
    }

    public function get_auto_num_details(Request $request) {
        $data = $request->all();
        $result = FlightPlanDetailsModel::get_auto_num_details($data, '1');
        $result = (count($result)) ? 1 : '';
        return response()->json(['success' => $result]);
    }

    public function revice_time(Request $request) {
//	print_r($request->all());exit;
        $id = $request->id;
        $fpl_details = FlightPlanDetailsModel::find($id);
        $fpl_json_encode = json_encode($fpl_details);
        $data = json_decode($fpl_json_encode, TRUE);

        $is_update = '';
        if ($data['departure_time_hours'] . $data['departure_time_minutes'] != $request->departure_time) {
            $is_update = 1;
        }

        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = substr($request->departure_time, 0, 2);
        $departure_time_minutes = substr($request->departure_time, 2, 2);
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $revised_by = $this->user_name;
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
        $get_zzzz_value = myFunction::get_zzzz_value($data);

        //Status update
        $update_plan_status = FlightPlanDetailsModel::where('id', $id)->update(['departure_time_hours' => $departure_time_hours, 'departure_time_minutes' => $departure_time_minutes,'is_etd_changed'=>1]);

        //Notifiacations
        $notification_data = ['user_id' => $data['user_id'], 'action' => 3, 'unique_id' => $id,
            'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Revised successfully',
            'is_active' => 1];
        WebNotificationsModel::create($notification_data);

        $revised_time = gmdate('Y-m-d H:i:s');
        $fpl_stats_data = ['revised_by' => $data['user_id'], 'revised_time' => $revised_time];

        FPLStatsModel::where('fpl_id', $id)->update($fpl_stats_data);

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

        if ($departure_aerodrome == 'ZZZZ' && $departure_station != '') {
            $departure_aerodrome2 = $departure_station;
        } else {
            $departure_aerodrome2 = $departure_aerodrome;
        }

        if ($destination_aerodrome == 'ZZZZ' && $destination_station != '') {
            $destination_aerodrome2 = $destination_station;
        } else {
            $destination_aerodrome2 = $destination_aerodrome;
        }
        $date_format = date('d-M-Y', strtotime('20' . $date_of_flight));
        $subject = "NEW ETD " . $departure_time_hours . $departure_time_minutes . ' ' . $aircraft_callsign . ' ' . $departure_aerodrome2 . '-' . $destination_aerodrome2 . " // " . $date_format;
        $data['revised_by'] = "Revised By: <span style=color:#f00;>$revised_by</span>";
        $data['revised_date'] = "<span style='margin-left:27px;color:#404040;'></span>Revised Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";

        date_default_timezone_set('Asia/Calcutta');
        $data['revised_time'] = "<span style='margin-left:27px;color:#404040;'></span> Revised Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['revised_via'] = "<span style='margin-left:33px;color:#404040;'></span>Revised Via: " . $_SERVER['HTTP_HOST'];

        $data['revice_time_heading'] = "(DLA-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
                $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";

        $data['get_zzzz_value'] = $get_zzzz_value;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
            'cc' => myFunction::get_cc_mails([]),
            'bcc' => myFunction::get_bcc_mails()
        ];
        $data['email'] = $this->user_email;
        $data['subject'] = $subject;
        if ($is_update) {
//	    Mail::send('emails.fpl.myaccount.revice_time', $data, function($message) use($mail_headers) {
            //		$message->from($mail_headers['from'], $mail_headers['from_name']);
            //		$message->to($mail_headers['to']);
            //		$message->subject($mail_headers['subject']);
            //		$message->cc($mail_headers['cc']);
            //		$message->bcc($mail_headers['bcc']);
            //	    });
            $this->dispatch(new DelayEmailJob($data));
        }
//	if($is_update){
        return Response::json(['success' => $aircraft_callsign . ' Departure Time Revised Successfully']);
//	}else{
        //	   return Response::json(['success' => ' Departure Time not changed!']);
        //	}
    }

    public function fpl_cancel(Request $request) {
        $id = $request->id;
        $fpl_details = FlightPlanDetailsModel::find($id);
        $fpl_json_encode = json_encode($fpl_details);
        $data = json_decode($fpl_json_encode, TRUE);

        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];
        $cancelled_by = $this->user_name;
        //Status update
//	$update_plan_status = FlightPlanDetailsModel::where('departure_aerodrome', $departure_aerodrome)
//			->where('destination_aerodrome', $destination_aerodrome)
//			->where('date_of_flight', $date_of_flight)
//			->where('departure_time_hours', $departure_time_hours)
//			->where('departure_time_minutes', $departure_time_minutes)->update(['plan_status' => '2']);

        $update_plan_status = FlightPlanDetailsModel::where('id', $id)->update(['plan_status' => '2']);

        //Notifiacations & FPL stats
        $notification_data = ['user_id' => $data['user_id'], 'action' => 2, 'unique_id' => $id,
            'subject' => $aircraft_callsign . ' > ' . $departure_aerodrome . ' > ' . $destination_aerodrome . ' Cancelled successfully',
            'is_active' => 1];
        WebNotificationsModel::create($notification_data);

        $cancelled_time = gmdate('Y-m-d H:i:s');
        $fpl_stats_data = ['cancelled_by' => $data['user_id'], 'cancelled_time' => $cancelled_time];
        FPLStatsModel::where('fpl_id', $id)->update($fpl_stats_data);

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

        if ($departure_aerodrome == 'ZZZZ' && $departure_station != '') {
            $departure_aerodrome = $departure_station;
        }

        if ($destination_aerodrome == 'ZZZZ' && $destination_station != '') {
            $destination_aerodrome = $destination_station;
        }

        $data['subject_type'] = 'cancel';
        $subject = myFunction::get_subject($data);
        $data['cancelled_by'] = " <span style='color:red;'> Cancelled By: $cancelled_by</span>";
        $data['cancelled_date'] = "<span style='margin-left:27px;color:#404040;'></span>Cancelled Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['cancelled_time'] = "<span style='margin-left:27px;color:#404040;'></span> Cancelled Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['cancelled_via'] = "<span style='margin-left:38px;color:#404040;'></span>Cancelled Via: " . $_SERVER['HTTP_HOST'];
        $data['cancelled_heading'] = "(CNL-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
                $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";
        $data['heading_top'] = "CANCEL";
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['email'] = $this->user_email;
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
            'cc' => myFunction::get_cc_mails([]),
            'bcc' => myFunction::get_bcc_mails()
        ];
//	Mail::send('emails.fpl.fpl_cancel', $data, function($message) use($mail_headers) {
        //	    $message->from($mail_headers['from'], $mail_headers['from_name']);
        //	    $message->to($mail_headers['to']);
        //	    $message->subject($mail_headers['subject']);
        //	    $message->cc($mail_headers['cc']);
        //	    $message->bcc($mail_headers['bcc']);
        //	});

        $this->dispatch(new CancelEmailJob($data));

        return Response::json(['success' => $aircraft_callsign . ' Plan cancelled successfully']);
    }

    public function change_fic_adc(Request $request) {
        $id = $request->id;
        $fpl_details = FlightPlanDetailsModel::find($id);
        $fpl_json_encode = json_encode($fpl_details);
        $data = json_decode($fpl_json_encode, TRUE);

        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

        $date_of_flight = (array_key_exists('date_of_flight', $data)) ? $data['date_of_flight'] : '';

        if ($departure_aerodrome == 'ZZZZ' && $departure_station != '') {
            $departure_aerodrome = $departure_station;
        }

        if ($destination_aerodrome == 'ZZZZ' && $destination_station != '') {
            $destination_aerodrome = $destination_station;
        }

        $entered_by = $this->user_name;
        $adc_updated_by = $this->user_id;
        $adc_updated_time = date('y-m-d H:i:s');

        $fic = $request->fic;
        $adc = strtoupper($request->adc);

        $is_update = '';
        if ($data['fic'] . $data['adc'] != $fic . $adc) {
            $is_update = 1;
        }
        $fic_update = ['fic' => $fic, 'adc' => $adc, 'adc_updated_by' => $adc_updated_by, 'adc_updated_time' => $adc_updated_time,'is_etd_changed'=>0];
        //Update FIC and ADC
        $update_plan_status = FlightPlanDetailsModel::where('id', $id)
                ->update($fic_update);

        //Notifiacations
        $notification_data = ['user_id' => $data['user_id'], 'action' => 4, 'unique_id' => $id,
            'subject' => $aircraft_callsign . " FIC " . $fic . " & ADC " . $adc,
            'is_active' => 1];
        WebNotificationsModel::create($notification_data);

        $adc_updated_time = gmdate('Y-m-d H:i:s');
        $fpl_stats_data = ['adc_updated_by' => $this->user_id, 'adc_updated_time' => $adc_updated_time];
        FPLStatsModel::where('fpl_id', $id)->update($fpl_stats_data);

        $date_format = date('d-M-Y', strtotime('20' . $date_of_flight));

        $subject = $aircraft_callsign. " " . $departure_aerodrome. " " .
                $departure_time_hours. "" . $departure_time_minutes . " - " . $destination_aerodrome. " FIC " . $fic . " & ADC " . $adc    .  ' (' . $date_format . ')';

        $data['entered_by'] = "Entered  By: <span style='color:red;'>$entered_by</span>";
        $data['entered_date'] = "<span style='margin-left:27px;color:#404040;'></span>Entered  Date: <span style='color:red;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['entered_time'] = "<span style='margin-left:27px;color:#404040;'></span> Entered  Time: <span style='color:red;'>" . date('H:i') . "  IST" . "</span>";
        $data['entered_via'] = "<span style='margin-left:33px;color:#404040;'></span>Entered  Via: " . $_SERVER['HTTP_HOST'];

        $data['fic_adc_heading'] = $subject;
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
            'cc' => myFunction::get_cc_mails([]),
            'bcc' => myFunction::get_bcc_mails()
        ];
        $data['email'] = $this->user_email;
        $data['subject'] = $subject;
//	if ($is_update) {
//	    Mail::send('emails.fpl.myaccount.fic_adc', $data, function($message) use($mail_headers) {
        //		$message->from($mail_headers['from'], $mail_headers['from_name']);
        //		$message->to($mail_headers['to']);
        //		$message->subject($mail_headers['subject']);
        //		$message->cc($mail_headers['cc']);
        //		$message->bcc($mail_headers['bcc']);
        //	    });
        Log::info('FICADC Email Job Starts ' . $subject);
        $this->dispatch(new FICADCEmailJob($data));
        Log::info('FICADC Email Job Ends ' . $this->user_email);
        //SMS
        $message = "" . $aircraft_callsign . " FIC " . $fic . " ADC " . $adc . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes . " - " . $destination_aerodrome . ". Call +91 8861660160 for Support. HAVE A NICE FLIGHT:)";
        $user = "eflight";
        $password = "PCpl2016";
//	    $to = CallSignMailsModel::get_callsign_mobile_numbers($aircraft_callsign);
        $to = CallsignInfoModel::get_mobile_numbers($data);
//	    $to = '9739939581';
        $text = urlencode($message);
        $url = "https://cloud.smsindiahub.in/vendorsms/pushsms.aspx?user=$user&password=$password&msisdn=$to&sid=EFLYTE&msg=$text&fl=0&gwid=2";
        $ret = file($url);
        $MessageData = $ret['0'];
        $abc = json_decode($MessageData)->MessageData;

        foreach ($abc as $value) {
            $mob = $value->Number;
            $MessageParts = $value->MessageParts;
            foreach ($MessageParts as $Msg_value) {
                $msg_id = $Msg_value->MsgId;
                $def = "https://cloud.smsindiahub.in/vendorsms/checkdelivery.aspx?user=$user&password=$password&messageid=$msg_id";
            }
        }
        //SMS
//	}
        return Response::json(['success' => $aircraft_callsign . ' FIC ADC Updated Successfully']);
    }

    public function change_plan(Request $request) {
        $id = $request->id;
        $fpl_details = FlightPlanDetailsModel::find($id);
        $fpl_json_encode = json_encode($fpl_details);
        $data[] = array();
        $data = json_decode($fpl_json_encode, TRUE);
        $data['route1'] = '';
        $data['remarks1'] = '';
        $data['callsign'] = (array_key_exists('aircraft_callsign', $data)) ? $data['aircraft_callsign'] : '';
        $data['is_myaccount'] = '1';
        $data['is_id'] = $id;
//	return $data;
        return view('fpl.new_full_fpl', $data);
    }

    public function auto_operator(Request $request) {
        $term = $request->term;
        $info_result = User::where('operator', 'LIKE', '%' . $term . '%')
                ->where('is_active', 1)
                ->groupBy('operator')
                ->take(10)
                ->get(['operator']);
        $result = [];
        foreach ($info_result as $value) {
            $result[] = ['label' => $value->operator, 'value' => $value->operator];
        }
        return $result;
    }

    public function auto_callsigns(Request $request) {
        $term = $request->term;
        $user_id = $this->user_id;

        if ($this->is_admin) {
            $ops = 1;
        } else {
            $ops = "";
        }

        $info_result = User::get_user_callsigns($user_id, $term, $ops);
//        $result = [];
//        foreach ($info_result as $value) {
//            $result[] = ['label' => $value, 'value' => $value];
//        }
        return $info_result;
    }

}
