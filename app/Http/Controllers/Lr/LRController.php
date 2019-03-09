<?php

namespace App\Http\Controllers\Lr;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\lr\LicenseDetailsModel;
use App\Jobs\Lr\DeleteLicenseDetailEmailJob;
use Log;
use Auth;
use App\Events\Lr\AddUserEvent;
use App\Jobs\Lr\AddUserEmailJob;
use App\User;
use App\Jobs\Lr\AddLicenseEmailJob;
use App\Jobs\Lr\EditLicenseDetailEmailJob;
use Response;
use PDF;
use App\Jobs\TestEmailJob;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;
use App\models\lr\LicenseTypesModel;
use App\models\lr\LRHistory;
use App\models\DesignationModel;
use Image;
use Illuminate\Support\Facades\Storage;

class LRController extends Controller {

    public function index(Request $request) {
        $page = $request->page;
        $success = $request->success;
        $data = ['success' => $success];

//        return view('lr.license_reminder3');
        if ($success) {
            return redirect('lr')->with($data);
        }
        switch ($page) {
            case 'new2':
                return view('lr.license_reminder2');
                break;
            case 'new3':
                return redirect('/lr');
                break;
            default:
                return view('lr.license_reminder3');
                break;
        }
    }

    public function lr_list() {

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
        $aColumns = array('id', 'operator_user_id', 'user_id', 'license_type_id', 'from_date', 'to_date',
            'is_active', 'is_delete');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";
        /* DB table to use */
        $sTable = "lr_license_details";
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

        $status_type = (isset($_GET['status_type'])) ? $_GET['status_type'] : '';
        $s_type = (isset($_GET['s_type'])) ? $_GET['s_type'] : '';
        $add_licence_type = (isset($_GET['add_licence_type'])) ? $_GET['add_licence_type'] : '';
        $action = (isset($_GET['action'])) ? $_GET['action'] : '';

        $filter_user_name = (isset($_GET['filter_user_name'])) ? $_GET['filter_user_name'] : '';
        $filter_license_type = (isset($_GET['filter_license_type'])) ? $_GET['filter_license_type'] : '';
        $filter_from_date = (isset($_GET['filter_from_date'])) ? $_GET['filter_from_date'] : '';
        $filter_to_date = (isset($_GET['filter_to_date'])) ? $_GET['filter_to_date'] : '';

        $filter_operator = (isset($_GET['filter_operator'])) ? $_GET['filter_operator'] : '';

        $to_date = (isset($_GET['to_date'])) ? $_GET['to_date'] : '';
        $url = (isset($_GET['url'])) ? $_GET['url'] : '';
        $date_of_flight = (isset($_GET['date_of_flight'])) ? $_GET['date_of_flight'] : '';
        $current_date = date('ymd');
        $due_date = date('ymd', strtotime("+31 days"));
        $user_id = Auth::user()->id;
        $user_role_id = Auth::user()->user_role_id;



        if ($sWhere == "") {
            $sWhere = "WHERE $sTable.is_active=1  AND users.is_active=1";
        } else {
            $sWhere .= " AND $sTable.is_active=1  AND users.is_active=1";
        }

        if ($user_role_id == 3) {
            $sWhere .= " AND users.operator_user_id= $user_id";
        }
        if ($user_role_id == 4) {
            $sWhere .= " AND users.id= $user_id";
        }
        $status_color = 'expire_color';
        if ($status_type != '') {
            if ($status_type == 'expire') {
                $sWhere .= " AND $sTable.to_date < $current_date";
                $status_color = 'expire_color';
            } else if ($status_type == 'due') {
                $sWhere .= " AND $sTable.to_date >= $current_date AND $sTable.to_date < $due_date";
                $status_color = 'due_color';
            } else {
                $sWhere .= " AND $sTable.to_date >= $current_date";
                $status_color = 'valid_color';
                $status_type = 'valid';
            }
        }
        
        else if($add_licence_type != ""){
            if ($add_licence_type == 'DUE') {
                $sWhere .= " AND $sTable.to_date >= $current_date AND $sTable.to_date < $due_date";
                $status_color = 'due_color';
            } else if ($add_licence_type == 'VALID') {
                $sWhere .= " AND $sTable.to_date >= $current_date";
                $status_color = 'valid_color';
            } else {
                $sWhere .= " AND $sTable.to_date < $current_date";
            }
        }
        
        else {
            $status_type = '';
//            $sWhere .= " AND $sTable.to_date < $current_date";

            $_GET['type'] = 1;
            $expire = LicenseDetailsModel::search_lr_count($_GET);

//            print_r($_GET);exit;

            $_GET['type'] = 3;
            $due = LicenseDetailsModel::search_lr_count($_GET);

            $_GET['type'] = 2;
            $valid = LicenseDetailsModel::search_lr_count($_GET);

            if ($expire) {
                $sWhere .= " AND $sTable.to_date < $current_date";
            } else if ($due) {
                $sWhere .= " AND $sTable.to_date >= $current_date AND $sTable.to_date < $due_date";
                $status_color = 'due_color';
            } else if ($valid) {
                $sWhere .= " AND $sTable.to_date >= $current_date";
                $status_color = 'valid_color';
            } else {
                $sWhere .= " AND $sTable.to_date < $current_date";
            }
        }


        if ($filter_user_name != '') {
            $sWhere .= " AND users.name LIKE '%$filter_user_name%' ";
        }
        if ($filter_operator != '') {
            $op_det = User::where('operator', 'LIKE', '%'.$filter_operator.'%')->where('is_active',1)
                    ->first(['id','operator_user_id', 'name', 'email']);
            $ops_user_id = ($op_det) ? $op_det->operator_user_id : '0';
            $sWhere .= " AND users.operator_user_id = $ops_user_id ";
        }
        if ($filter_license_type != '') {
            $sWhere .= " AND lr_license_types.name LIKE '%$filter_license_type%' ";
        }
        if ($filter_from_date != '' && $filter_to_date != '' && $status_type == '' && $s_type == 'dates') {
            $filter_from_date = date('ymd', strtotime($filter_from_date));
            $filter_to_date = date('ymd', strtotime($filter_to_date));
            $sWhere .= " AND $sTable.to_date BETWEEN $filter_from_date AND $filter_to_date ";
        }
        /*
         * SQL queries
         * Get data to display
         */

//        if ($sOrder == "") {
            if ($status_type == 'expire' || $status_type == '') {
                $sOrder = " ORDER BY $sTable.to_date desc";
                if($action =="edit"){
                    $sOrder = " ORDER BY $sTable.updated_at desc";
                }
            } else if ($status_type == 'due') {
                $sOrder = " ORDER BY $sTable.to_date asc";
                if($action =="edit"){
                    $sOrder = " ORDER BY $sTable.updated_at desc";
                }
            } else {
                $sOrder = " ORDER BY $sTable.to_date asc";
                if($action =="edit"){
                    $sOrder = " ORDER BY $sTable.updated_at desc";
                }
            }
//        }

       $sQuery = "
        SELECT $sTable.id, users.operator_user_id, user_id, license_type_id, $sTable.from_date, $sTable.to_date,$sTable.number as number,$sTable.renewed_date as renewed_date,
                $sTable.is_active, $sTable.is_delete,$sTable.message,
                users.name as user_name,lr_license_types.name as license_name,lr_license_types.short_name,lr_license_types.license_type from $sTable
            JOIN users ON users.id = $sTable.user_id
            JOIN lr_license_types ON lr_license_types.id = $sTable.license_type_id    
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
            "sEcho" => (isset($_GET['sEcho'])) ? intval($_GET['sEcho']) : '',
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array(),
        );
        $sno = (isset($_GET['iDisplayStart'])) ? intval($_GET['iDisplayStart']) + 1 : '';
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
            $to_date = $aRow['to_date'];
            $current_date = strtotime(date('Ymd'));
            $expire_date = strtotime('20' . trim($to_date)); //echo floor($datediff / (60 * 60 * 24));
            $valid_days = ceil(($expire_date - $current_date) / 86400);

            $expire_date = date('d-M-Y', $expire_date);
            $renewed_date = $aRow['renewed_date'];
            $renewed_date = date('d-M-Y', strtotime('20' . $renewed_date));
//            $is_admin = ($aRow['is_admin']) ? 'YES' : 'NO';
            $is_active = ($aRow['is_active']) ? 'ACTIVE' : 'INACTIVE';
            $company_color = ($is_active) ? 'company_color' : '';

            $user_name = $aRow['user_name'];
            $license_name = str_limit($aRow['license_name'], 35);
            $short_name = str_limit($aRow['short_name'], 25);
            $license_number = $aRow['number'];
            $license_number2 = str_limit($aRow['number'],20);
            $license_type = $aRow['license_type'];
            $message = str_limit($aRow['number'], 35);
            
            if(strlen($license_number) >= '20'){
                $tool_20 = "<span style='left:-15px;' class='tooltip_edit_position t_dp'>$license_number</span><span style='left:80px;' class='tooltip_tri_shape3'></span>";
            }else{
                $tool_20 = "";
            }
            
            $operator_user_id = $aRow['operator_user_id'];
            $operator_name = User::where('id',$operator_user_id)->first(['operator']);
            $operator_name = ($operator_name) ? $operator_name->operator : '';

            if ($short_name == 'X') {
                $license_name = $message;
            }

            if ($valid_days >= 0 && $valid_days <= 31) {
                $status = 'DUE';
//                $status_color = 'due_color';
            } else if ($valid_days < 0) {
                $status = 'EXPIRED';
            } else {
                $status = 'VALID';
//                $status_color = 'valid_color';
            }

            if ($valid_days >= 0 && $valid_days <= 31) {
                $status = 'DUE';
//                $status_color = 'due_color';
            } else if ($valid_days < 0) {
                $status = 'EXPIRED';
//                $status_color = 'expire_color';
            } else {
                $status = 'VALID';
//                $status_color = 'valid_color';
            }
            if ($status_type == 'expire') {
                $valid_days =  $valid_days;
            }
            $row = array(0 => $sno + 1,
                1 => "<div data-value='$id' id='user_name$id'>$user_name</div>",
                2 => "<div data-value='$id' id='license_name$id' data-toggle='tooltip' title='$license_name'>$short_name</div>",
                3 => "<div data-value='$id' id='license_type$id'>$operator_name</div>",
                4 => "<div class='tooltip_rel'><div data-value='$id' id='license_number$id'>$license_number2 $tool_20</div></div>", //$renewed_date, //$aRow['renewed_date'],
                5 => "<div data-value='$id' id='to_date$id'>$expire_date</div>", //$expire_date,
                6 => "<div data-value='$id' id='valid_days$id' class='$status_color'>$valid_days</div>", //$valid_days,
                7 => "<div class='tooltip_rel'>
                </span><a class = 'edit_license' id='edit_license$id' data-value='$id'><i class='fa fa-pencil-square'></i></a><span class='p-l-9'></span>
                <span class='tooltip_edit_position'>Edit License</span><span class='tooltip_tri_shape1'></span></div>
                
                <div class='tooltip_rel'><a @click='viewhistory' class ='viewhistory' id='viewhistory$id' data-value='$id'>
                <i class='fa fa-history'></i></a><span class='p-l-9'></span><span class='tooltip_edit_position t_vh'>view history</span>
                <span class='tooltip_tri_shape2'></span></div>
                
                <div class='tooltip_rel'>
                <a href='#' class = 'delete_license' data-license='$license_name' data-user='$user_name' id='delete_license$id' data-value='$id'><i class='fa fa-trash'></i></a>
                <span class='tooltip_edit_position t_dp'>Delete license</span><span class='tooltip_tri_shape3'></span></div>"
            );
            $sno++;
            $output['aaData'][] = $row;

          
        }
//          var_dump($output);
//            exit();
        return response()->json($output);
    }

    public function license_types(Request $request) {
        return view('lr.licence-types');
    }

    public function add_license_type(Request $request) {
        return view('lr.add-licence-type');
    }

    public function users_list(Request $request) {
        return view('lr.users-list');
    }

    public function add_users(Request $request) {
        try {

            $data = []; //$request->all();
            $entered_by = Auth::user()->name;
            $entered_user_email = Auth::user()->email;
            date_default_timezone_set('Asia/Kolkata');
            $entered_date = date('d-M-Y');
            $entered_time = date('H:i:s');
            $operator_name = $request->operator_name;

            $operator_data = User::where('name', $operator_name)->first(['id', 'email']);
            $operator_user_id = ($operator_data) ? $operator_data->id : Auth::user()->id;

            $entered_user_email = Auth::user()->email;
            $operator_user_email = ($operator_data) ? $operator_data->email : Auth::user()->email;


            $modal_type = 'add_user';
            $name_modal_type = 'name_' . $modal_type;
            $user_role_id_modal_type = 'user_role_id_' . $modal_type;
            $mobile_number_modal_type = 'mobile_number_' . $modal_type;
            $email_modal_type = 'email_' . $modal_type;
            $password_modal_type = 'password_' . $modal_type;
            $confirm_password_modal_type = 'confirm_password_' . $modal_type;

            $name = $request->$name_modal_type;
            $user_role_id = $request->$user_role_id_modal_type;
            $mobile_number = $request->$mobile_number_modal_type;
            $email = $request->$email_modal_type;
            $password = $request->$password_modal_type;
            $confirm_password = $request->$confirm_password_modal_type;

//            $operator = Auth::user()->operator;

            $data['name'] = $name;
            $data['email'] = $email;
            $data['password'] = bcrypt($password);
            $data['mobile_number'] = $mobile_number;
            $data['is_active'] = 1;
            $data['user_role_id'] = 4;
            $data['operator_user_id'] = $operator_user_id;
            $data['operator'] = $operator_name;
            $data['is_lr'] = 1;

            if ($name == '' || $mobile_number == '' || $email == '' || $password == '') {
                return response()->json(['STATUS_CODE' => '0', 'STATUS_DESC' => 'Pls enter required fields']);
            }

            if ($password != $confirm_password) {
                return response()->json(['success' => '', 'STATUS_DESC' => 'Passwords do not match']);
            }

            $get_user_details = User::get_user_details($email);

            if ($get_user_details) {
                User::where('email', $email)->update($data);
                return response()->json(['STATUS_CODE' => 1, 'success' => 'success', 'STATUS_DESC' => 'USER UPDATED SUCCESSFULLY']);
            }

            $get_user_details2 = User::get_user_details('', $mobile_number);
            if ($get_user_details2) {
                User::where('mobile_number', $mobile_number)->update($data);
                return response()->json(['STATUS_CODE' => 1, 'success' => 'success', 'STATUS_DESC' => 'USER UPDATED SUCCESSFULLY']);
            }

            $result = event(new AddUserEvent($data)); //DD-MON-YY at HH:MM:SS

            $data['entered_by'] = $entered_by;
            $data['entered_date'] = $entered_date;
            $data['entered_time'] = $entered_time;

            $data['entered_by2'] = "Entered  By: <span style=color:#f1292b;>$entered_by</span>";
            $data['entered_date2'] = "<span style='padding-left:30px'>Entered  Date: <span style=color:#f1292b;>$entered_date</span></span>";
            $data['entered_time2'] = "<span style='padding-left:30px'>Entered  Time: <span style=color:#f1292b;>$entered_time</span></span>";

            $data['user_name'] = $name;
            $data['entered_user_email'] = $entered_user_email;
            $data['operator_user_email'] = $operator_user_email;

            $data['subject'] = 'Welcome to EFLIGHT License Reminder List // ' . $entered_date . ' at ' . $entered_time;
            $data['password'] = $request->$password_modal_type;
            Log::info('Users Job start');
            $this->dispatch(new AddUserEmailJob($data));
            Log::info('Users Job end');

            if ($result) {
                return response()->json(['STATUS_CODE' => 1, 'success' => 'success', 'STATUS_DESC' => 'USER ADDED SUCCESSFULLY']);
            } else {
                return response()->json(['success' => '']);
            }
        } catch (\Exception $ex) {
            Log::info('Users Create  ' . $ex->getMessage() . ' ' . $ex->getLine());
        }
    }

    public function lr_history(Request $request) {
        return view('lr.history');
    }

    public function lr_filter(Request $request) {
        $data = $request->all();
        return view('lr.filter_lr', $data);
    }

    public function delete_license(Request $request) {
        try {
            $id = $request->delete_license_id;
            $entered_by = Auth::user()->name;
            date_default_timezone_set('Asia/Kolkata');
            $entered_date = date('d-M-Y');
            $entered_time = date('H:i:s');
            $user_id = Auth::user()->id;

            if ($id) {
                $result = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                                ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                                ->select('lr_license_details.number', 'lr_license_types.name as license_name', 'users.name as user_name', 'lr_license_details.*', 'users.email', 'users.operator_user_id')
                                ->where('lr_license_details.is_active', 1)
                                ->where('lr_license_details.is_delete', 0)
                                ->where('lr_license_details.id', $id)->first();
                $data = ['user_name' => $result->user_name, 'license_name' => $result->license_name, 'number' => $result->number];

                $user_email = ($result) ? $result->email : '';
                $operator_user_id = ($result) ? $result->operator_user_id : '';
                $license_type = ($result) ? $result->license_type_id : '';
                $license_number = ($result) ? $result->number : '';
                $license_name = ($result) ? $result->license_name : '';

                $data['email'] = $user_email;
                $data['entered_by'] = $entered_by;
                $data['entered_date'] = $entered_date;
                $data['entered_time'] = $entered_time;

                $data['entered_by2'] = "Entered  By: <span style=color:#f1292b;>$entered_by</span>";
                $data['entered_date2'] = "<span style='padding-left:30px'>Entered  Date: <span style=color:#f1292b;>$entered_date</span></span>";
                $data['entered_time2'] = "<span style='padding-left:30px'>Entered  Time: <span style=color:#f1292b;>$entered_time</span></span>";

                $operator_data = User::where('id', $operator_user_id)->first(['email', 'id']);

                $entered_user_email = Auth::user()->email;
                $operator_user_email = ($operator_data) ? $operator_data->email : Auth::user()->email;

                $data['entered_user_email'] = $entered_user_email;
                $data['operator_user_email'] = $operator_user_email;

                $data['user_name'] = $result->user_name;

                if ($license_type == '25') {
                    $license_name = $license_number;
                }
                $data['license_name'] = $license_name;
                $data['subject'] = "DELETED " . $license_name . ' of ' . $result->user_name . " // " . $entered_date . ' at ' . $entered_time;


                $result = LicenseDetailsModel::delete_license($id);
                Log::info('Job started');
                $this->dispatch(new DeleteLicenseDetailEmailJob($data));
                Log::info('Job ended');

                $req_data = $request->all();
                $req_data['type'] = 1;

                $expire = LicenseDetailsModel::search_lr_count($req_data);
                $req_data['type'] = 2;
                $valid = LicenseDetailsModel::search_lr_count($req_data);
                $req_data['type'] = 3;
                $due = LicenseDetailsModel::search_lr_count($req_data);

                $delete_data = [
                    'expire' => $expire,
                    'valid' => $valid,
                    'due' => $due
                ];
                return response()->json(['STATUS_DESC' => 'LICENSE DELETED SUCCESSFULLY',
                            'STATUS_CODE' => '1', 'result' => $delete_data]);
            } else {
                return response()->json(['STATUS_DESC' => 'Fail', 'STATUS_CODE' => '0']);
            }
        } catch (\Exception $ex) {
            Log::info("Delete LIcense " . $ex->getMessage());
        }
    }

    public function edit_license(Request $request) {
        try {
//            print_r($request->all());
//            exit;
            $id = $request->edit_license_id;
            $renewed_date = date('ymd', strtotime($request->renewed_date)); //$request->renewed_date;
            $expire_date = date('ymd', strtotime($request->to_date)); //$request->to_date;
            $license_number = $request->number;
            $license_type = $request->edit_license_type_id;
            $remarks = $request->remarks;

            $filter_user_name = $request->edit_user_name;
            $filter_license_type = $request->edit_license_name;
            $edit_file_name = $request->edit_file_name;

            date_default_timezone_set('Asia/Kolkata');

            $entered_by = Auth::user()->id;
            $entered_user_name = Auth::user()->name;
            $entered_date = date('d-M-Y');
            $entered_time = date('H:i:s');


            $uploaded_file = $request->lr_file;
            $add_file_name = $request->add_file_name;
            $file_ext = "";
            if ($add_file_name != "") {
                $add_file_ext = explode(".", $add_file_name);
                $file_ext = $add_file_ext['1'];
            }



            $license_data = LicenseDetailsModel::get_license_details($id);
            $user_name = ($license_data) ? $license_data->user_name : '';

//            if ($renewed_date > $expire_date) {
//                return response()->json(['STATUS_DESC' => 'Renewed Date cannot be greater than Expiry Date', 'STATUS_CODE' => '0']);
//            }

            $user_id = ($license_data) ? $license_data->user_id : '';
            $operator_user_id = ($license_data) ? $license_data->operator_user_id : '';
            $user_email = ($license_data) ? $license_data->email : '';
            $lr_license_type_id = ($license_data) ? $license_data->license_type_id : '';
            $lr_to_date = ($license_data) ? $license_data->to_date : '';
            $lr_renewed_date = ($license_data) ? $license_data->renewed_date : '';
            $lr_license_number = ($license_data) ? $license_data->number : '';

            $user_name2 = ($license_data) ? $license_data->user_name : '';
            $license_name2 = ($license_data) ? $license_data->lr_license_name : '';

            $user_data = User::where('id', $user_id)->first(['name']);
            $user_name = ($user_data) ? $user_data->name : '';
            $license_data = LicenseTypesModel::where('id', $license_type)->first(['name', 'short_name', 'license_type']);
            $license_name = ($license_data) ? $license_data->name : '';

            $short_name = ($license_data) ? $license_data->short_name : '';

            $license_type_name = ($license_data) ? $license_data->license_type : '';

            $history_data = [
                'updated_by' => $entered_by,
                'lr_licence_details_id' => $id,
                'lr_user_id' => $user_id,
                'lr_license_type_id' => $lr_license_type_id,
                'lr_to_date' => $lr_to_date,
                'lr_renewed_date' => $lr_renewed_date,
                'lr_license_number' => $lr_license_number,
                'lr_user_id2' => $user_id,
                'lr_license_type_id2' => $license_type,
                'license_type_name' => $license_type_name,
                'lr_to_date2' => $expire_date,
                'lr_renewed_date2' => $renewed_date,
                'lr_license_number2' => $license_number,
                'reason' => $remarks,
                'updated_on' => date('ymd h:i:s'),
                'user_name' => $user_name,
                'user_name2' => $user_name2,
                'license_name' => $license_name,
                'license_name2' => $license_name2,
                'action' => 4
            ];

            LRHistory::create($history_data);

            $data = [
                'renewed_date' => $renewed_date,
                'to_date' => $expire_date,
                'number' => $license_number,
                'message' => $remarks
            ];

            if ($edit_file_name == '' && $uploaded_file == "") {
                $data['file_name'] = "";
            }

            if ($license_type) {
                $data['license_type_id'] = $license_type;
            }
            $result = LicenseDetailsModel::where('id', $id)->update($data);

            if ($uploaded_file && $uploaded_file != '') {
                $file_size = $request->add_file_size;
                $mime_type = $request->add_mime_type;
                $file_name = time() . ".$file_ext";

                $valid_extentions = ['pdf', 'jpg', 'png', 'jpeg'];
                if ($file_size > 2000000) {
                    return response()->json(['STATUS_DESC' => 'Max 2 MB file size allowed.', 'STATUS_CODE' => '0']);
                }
                if (!in_array($file_ext, $valid_extentions)) {
                    return response()->json(['STATUS_DESC' => 'Upload only PDF, PNG, JPEG extension file.', 'STATUS_CODE' => '0']);
                }

                if (env('APP_ENV') == 'local') {
                    list($type, $uploaded_file) = explode(';', $uploaded_file);
                    list(, $uploaded_file) = explode(',', $uploaded_file);
                    $uploaded_file = base64_decode($uploaded_file);
                    file_put_contents(public_path('media/lr/' . $file_name), $uploaded_file);
                } else {
                    $s3 = Storage::disk('s3');
                    $filePath = "/media/$user_name/lr/" . $file_name;
                    $s3->put($filePath, file_get_contents($request->lr_file), 'public');
                }

                $file_data = ['file_original_name' => $add_file_name,
                    'file_size' => $file_size,
                    'mime_type' => $mime_type, 'file_name' => $file_name];
                $result = LicenseDetailsModel::where('id', $id)->update($file_data);
            }

            $data['entered_by'] = $entered_user_name;
            $data['email'] = $user_email;
            $data['entered_date'] = $entered_date;
            $data['entered_time'] = $entered_time;
            $data['expire_date'] = date('d-M-Y', strtotime('20' . $expire_date));

            $operator_data = User::where('id', $operator_user_id)->first(['email', 'id']);

            $entered_user_email = Auth::user()->email;
            $operator_user_email = ($operator_data) ? $operator_data->email : Auth::user()->email;

            $data['entered_user_email'] = $entered_user_email;
            $data['operator_user_email'] = $operator_user_email;

            $data['entered_by2'] = "Entered  By: <span style=color:#f1292b;>$entered_user_name</span>";
            $data['entered_date2'] = "<span style='padding-left:30px'>Entered  Date: <span style=color:#f1292b;>$entered_date</span></span>";
            $data['entered_time2'] = "<span style='padding-left:30px'>Entered  Time: <span style=color:#f1292b;>$entered_time</span></span>";

            if ($license_type == '25') {
                $license_name = $license_number;
            }

            $data['user_name'] = $user_name;
            $data['license_name'] = $license_name;

            $data['subject'] = $license_name . ' LICENSE of ' . $user_name . ' EDITED // ' . $entered_date . ' at ' . $entered_time;

            $user_type = 1;
            $expire = LicenseDetailsModel::get_lr_count($user_id, $user_type, 1, $filter_user_name, $filter_license_type);
            $valid = LicenseDetailsModel::get_lr_count($user_id, $user_type, 2, $filter_user_name, $filter_license_type);
            $due = LicenseDetailsModel::get_lr_count($user_id, $user_type, 3, $filter_user_name, $filter_license_type);

            $current_date = strtotime(date('Ymd'));
            $expire_date = strtotime('20' . $expire_date); //echo floor($datediff / (60 * 60 * 24));
            $valid_days = ceil(($expire_date - $current_date) / 86400);
            
            if ($valid_days >= 0 && $valid_days <= 31) {
                $status = 'DUE';
            } else{
                $status = 'VALID';
            }

            $edit_data = [
                'renewed_date' => $request->renewed_date,
                'to_date' => $request->to_date,
                'license_number' => $license_number,
                'license_name' => $license_name,
                'short_name' => $short_name,
                'remarks' => $remarks,
                'valid_days' => $valid_days,
                'expire' => $expire,
                'valid' => $valid,
                'due' => $due
            ];

            if ($result) {
                if ($lr_to_date != date('ymd', strtotime($request->to_date))) {
                    $this->dispatch(new EditLicenseDetailEmailJob($data));
                }
                return response()->json(['result' => $edit_data,
                            'STATUS_DESC' => 'LICENSE UPDATED SUCCESSFULLY',
                            'STATUS_CODE' => '1', 'status' => $status]);
            } else {
                return response()->json(['STATUS_DESC' => 'No data updated', 'STATUS_CODE' => '0']);
            }
        } catch (\Exception $ex) {
            Log::info("edit license " . $ex->getMessage());
        }
    }

    public function add_license_details(Request $request) {
        try {
//            print_r($request->all());
            date_default_timezone_set('Asia/Kolkata');
            $modal_type = "add_ld";
            $user_modal_type = 'user_id_' . $modal_type;
            $renewed_date_modal_type = 'renewed_date_' . $modal_type;
            $expire_date_modal_type = 'to_date_' . $modal_type;
            $license_number_modal_type = 'number_' . $modal_type;
            $license_type_modal_type = 'license_type_' . $modal_type;
            $remarks_modal_type = 'remarks_' . $modal_type;

            $user_id = $request->$user_modal_type;
            $renewed_date = date('ymd', strtotime($request->$renewed_date_modal_type));
            $expire_date = date('ymd', strtotime($request->$expire_date_modal_type));
            $license_number = $request->$license_number_modal_type;
            $license_type = $request->$license_type_modal_type;
            $remarks = $request->$remarks_modal_type;

            $user_data = User::where('id', $user_id)->first(['name', 'email', 'operator_user_id']);
            $user_name = ($user_data) ? $user_data->name : '';
            $user_email = ($user_data) ? $user_data->email : '';
            $operator_user_id = ($user_data) ? $user_data->operator_user_id : '';

            $license_data = LicenseTypesModel::where('id', $license_type)->first(['name']);
            $license_name = ($license_data) ? $license_data->name : '';

            $check_license_count = LicenseDetailsModel::join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                    ->where('lr_license_details.user_id', $user_id)
                    ->where('license_type_id', $license_type)
                    ->where('lr_license_types.short_name', '!=', 'X')
                    ->where('lr_license_types.short_name', '!=', 'VISA')
                    ->where('lr_license_details.is_active', 1)
                    ->count();
            if ($check_license_count) {
                return response()->json(['STATUS_DESC' => 'LICENSE ALREADY EXIST', 'STATUS_CODE' => '0']);
            }

            $post_image = $request->lr_file;
            $add_file_name = $request->add_file_name;
            $file_ext = "";
            if ($add_file_name != "") {
                $add_file_ext = explode(".", $add_file_name);
                $file_ext = $add_file_ext['1'];
            }

            $file_size = $request->add_file_size;
            $mime_type = $request->add_mime_type;
            $file_name = time() . ".$file_ext";

            $valid_extentions = ['pdf', 'jpg', 'png', 'jpeg'];



            if ($post_image && $post_image != '') {

                if ($file_size > 2000000) {
                    return response()->json(['STATUS_DESC' => 'Max 2 MB file size allowed.', 'STATUS_CODE' => '0']);
                }

                if (!in_array($file_ext, $valid_extentions)) {
                    return response()->json(['STATUS_DESC' => 'Upload only PDF, PNG, JPEG extension file.', 'STATUS_CODE' => '0']);
                }

                if (env('APP_ENV') == 'local') {
                    list($type, $post_image) = explode(';', $post_image);
                    list(, $post_image) = explode(',', $post_image);
                    $post_image = base64_decode($post_image);
                    file_put_contents(public_path('media/lr/' . $file_name), $post_image);
//                    $file_path = public_path('media/lr/' . $file_name);
//                    Image::make($post_image)->save($file_path, 50);
                } else {
                    $s3 = Storage::disk('s3');
                    $filePath = "/media/$user_name/lr/" . $file_name;
//                    $jpg = (string) Image::make($post_image)->resize(315, 180)->encode('jpg', 70);
//                    $s3->put($filePath, $jpg, 'public');
                    $s3->put($filePath, file_get_contents($request->lr_file), 'public');
                }
            }

            $data = [
                'operator_user_id' => $operator_user_id,
                'user_id' => $user_id,
                'renewed_date' => $renewed_date,
                'to_date' => $expire_date,
                'number' => $license_number,
                'license_type_id' => $license_type,
                'message' => $remarks,
                'file_name' => $file_name,
                'file_original_name' => $add_file_name,
                'file_size' => $file_size,
                'mime_type' => $mime_type,
                'added_by' => Auth::user()->id,
                'is_active' => 1,
                'is_delete' => 0
            ];

            $result = LicenseDetailsModel::create($data);



            if ($post_image && $post_image != '') {
                $file_data = ['file_size' => $file_size, 'mime_type' => $mime_type];
            }


            $operator_data = User::where('id', $operator_user_id)->first(['email']);

            $entered_user_email = Auth::user()->email;
            $operator_user_email = ($operator_data) ? $operator_data->email : Auth::user()->email;

            $data['entered_user_email'] = $entered_user_email;
            $data['operator_user_email'] = $operator_user_email;

            $entered_by = Auth::user()->name;
            $entered_date = date('d-M-Y');
            $entered_time = date('H:i:s');

            $data['entered_by'] = $entered_by;
            $data['entered_date'] = $entered_date;
            $data['entered_time'] = $entered_time;
            $data['expire_date'] = date('d-M-Y', strtotime('20' . $expire_date));

            $data['entered_by2'] = "Entered  By: <span style=color:#f1292b;>$entered_by</span>";
            $data['entered_date2'] = "<span style='padding-left:30px'>Entered  Date: <span style=color:#f1292b;>$entered_date</span></span>";
            $data['entered_time2'] = "<span style='padding-left:30px'>Entered  Time: <span style=color:#f1292b;>$entered_time</span></span>";

            if ($license_type == '25') {
                $license_name = $license_number;
            }

            $data['user_name'] = $user_name;
            $data['license_name'] = $license_name;
            $data['email'] = $user_email;

            $data['subject'] = "$license_name ADDED // " . $entered_date . ' at ' . $entered_time;
            
            $current_date = strtotime(date('Ymd'));
            $expire_date = strtotime('20' . $expire_date); //echo floor($datediff / (60 * 60 * 24));
            $valid_days = ceil(($expire_date - $current_date) / 86400);
            
            if ($valid_days >= 0 && $valid_days <= 31) {
                $status = 'DUE';
            } else{
                $status = 'VALID';
            }

            if ($result) {
                Log::info('AddLicenseEmailJob started');
                dispatch(new AddLicenseEmailJob($data));
                Log::info('AddLicenseEmailJob ended');
                return response()->json(['STATUS_DESC' => 'LICENSE ADDED SUCCESSFULLY', 'STATUS_CODE' => '1','status' => $status]);
            } else {
                return response()->json(['STATUS_DESC' => 'Fail', 'STATUS_CODE' => '0']);
            }
        } catch (\Exception $ex) {
            Log::info("Add license " . $ex->getMessage() . ' ' . $ex->getLine());
        }
    }

    public function get_license_details(Request $request) {
        try {
            $id = $request->id;
            $result = LicenseDetailsModel::get_license_details($id);
            $user_name = $result->user_name;
            $file_name = $result->file_name;
            $file_original_name = $result->file_original_name;
            $file_exists = '';
            if (env('APP_ENV') != 'local' && $file_name != "") {
                $file_exists = Storage::disk('s3')->exists("media/$user_name/lr/$file_name");
            } else if ($file_name != "") {
                $file_exists = (file_exists(public_path('/media/lr/' . $file_name))) ? 1 : '';
            }
//            echo 'kk '.env('APP_ENV').' j '.$file_exists;
            $result->renewed_date = date('d-M-Y', strtotime('20' . $result->renewed_date)); //$request->renewed_date;
            $result->to_date = date('d-M-Y', strtotime('20' . $result->to_date)); //$request->to_date;

            return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success', 'result' => $result, 'file_exist' => $file_exists, 'file_original_name' => $file_original_name]);
        } catch (\Exception $ex) {
            Log::info("Delete LIcense " . $ex->getMessage());
        }
    }

    public function delete_file(Request $request) {
        try {
            $id = $request->id;
            $data = ['file_name' => ''];
            $result = LicenseDetailsModel::where('id', $id)->update($data);
            return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success', 'result' => $result]);
        } catch (\Exception $ex) {
            Log::info("Delete LIcense " . $ex->getMessage());
        }
    }

    public function autocomplete_user_name(Request $request) {
        try {
            $term = $request->term;
            $aircraft_callsign = $request->aircraft_callsign;
            $operator_user_id = Auth::user()->operator_user_id;
            $user_role_id = Auth::user()->user_role_id;
            $user_names = User::where('name', 'LIKE', '%'.$term . '%')
                    ->where('is_active', 1)
                    ->where('is_lr', 1)
                    ->where(function($query) use($operator_user_id, $user_role_id) {
                        if ($user_role_id == '3') {
                            $query->where('operator_user_id', $operator_user_id);
                        }
                    })
                    ->get();
            $results[] = '';
            if (in_array($user_role_id, ['1', '2', '3'])) {
                foreach ($user_names as $user_names) {
                    $results[] = ['value' => $user_names->name];
                }
            }
            return Response::json($results);
        } catch (\Exception $ex) {
            Log::error('lr Controller autocomplete_user_name: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('lr Controller autocomplete_user_name : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function autocomplete_license_type(Request $request) {
        try {
            $term = $request->term;
            $aircraft_callsign = $request->aircraft_callsign;
            $license_type = LicenseTypesModel::where('is_active', 1)
                    ->where(function($query) use($term) {
                        $query->where('name', 'LIKE', '%' .$term . '%')
                        ->orWhere('short_name', 'LIKE', '%' .$term . '%');
                    })
                    ->get();
            $results[] = '';
            foreach ($license_type as $license_type_values) {
                $results[] = ['value' => strtoupper($license_type_values->name)];
            }
            return Response::json($results);
        } catch (\Exception $ex) {
            Log::error('Fpl Controller pilot_in_command: Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
            throw new customException($ex->getMessage());
            Bugsnag::notifyException('Fpl Controller pilot_in_command : Exception Message- ' . $ex->getMessage() . ' Line: ' . $ex->getLine());
        }
    }

    public function pdf(Request $request) {
        $data = [];
//        $pdf = PDF::loadView('templates.pdf.lr.lr_user_pdf')->setPaper('a4', 'landscape')->setWarnings(false)->output();
//        return $pdf->download('Anand.pdf');

        $current_date = date('ymd');

        $id = $request->id;

        $operator_count = User::where('operator_user_id', $id)->count();

        $result1 = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                        ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                        ->select('lr_license_details.user_id', 'lr_license_details.from_date', 'lr_license_details.renewed_date', 'lr_license_details.to_date', 'lr_license_details.number', 'lr_license_details.license_type_id', 'lr_license_types.name as lr_license_name', 'lr_license_types.license_type', 'users.name as user_name')
                        ->where('lr_license_details.is_active', 1)
                        ->where('lr_license_details.is_delete', 0)
                        ->where(function($query) use($id, $operator_count) {
                            if (!$operator_count) {
                                $query->where('users.id', $id);
                            } else {
                                $query->where('users.operator_user_id', $id);
                            }
                        })
                        ->where('to_date', '<', $current_date)
                        ->where('users.is_active', '=', 1)        
                        ->orderBy('to_date', 'desc')->get();

        $result2 = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                        ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                        ->select('lr_license_details.user_id', 'lr_license_details.from_date', 'lr_license_details.renewed_date', 'lr_license_details.to_date', 'lr_license_details.number', 'lr_license_details.license_type_id', 'lr_license_types.name as lr_license_name', 'lr_license_types.license_type', 'users.name as user_name')
                        ->where('lr_license_details.is_active', 1)
                        ->where('lr_license_details.is_delete', 0)
                        ->where(function($query) use($id, $operator_count) {
                            if (!$operator_count) {
                                $query->where('users.id', $id);
                            } else {
                                $query->where('users.operator_user_id', $id);
                            }
                        })
                        ->where('to_date', '>=', $current_date)
                        ->where('users.is_active', '=', 1)
                        ->orderBy('to_date', 'asc')->get();


        $array = array_merge($result1->toArray(), $result2->toArray());
        //    return Response::json($array);

        $result = json_decode(json_encode($array));


        $data['lr_data'] = $result;

        $user_data = User::where('id', $id)->first(['name', 'operator']);
        $user_name = ($user_data) ? $user_data->name : '';
        $operator = ($user_data) ? $user_data->operator : '';

        $data['user_name'] = $user_name;
        $data['operator'] = $operator;

        $filePath = public_path('media/pdf/lr/downloads/');

        if (!$operator_count) {
            $lr_user_pdf = view('templates.pdf.lr.lr_user_pdf', $data);
        } else {
            $lr_user_pdf = view('templates.pdf.lr.lr_operator_pdf', $data);
        }

        $current_date = date('d-M-Y');

        $fileName = $current_date . ' - License records details for ' . $user_name . '.pdf';
        $pdf = PDF::loadHTML($lr_user_pdf)
                ->setPaper('a4')
                ->setOrientation('landscape');
//                ->save($filePath . $fileName);

        return $pdf->download($fileName);

//        return response()->download($filePath . $fileName);
    }

    public function get_lr_count(Request $request) {
        $data = $request->all();
        $data['type'] = 1;
//        print_r($data);exit;
        $expire = LicenseDetailsModel::search_lr_count($data);
        $data['type'] = 2;
        $valid = LicenseDetailsModel::search_lr_count($data);
        $data['type'] = 3;
        $due = LicenseDetailsModel::search_lr_count($data);

        $result = [
            'expire' => $expire,
            'valid' => $valid,
            'due' => $due
        ];

        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'Success', 'result' => $result]);
    }

    public function get_history_details(Request $request) {
        try {
            $id = $request->id;
            $get_history = LRHistory::where('lr_licence_details_id', $id)->orderBy('updated_at', 'desc')
                    ->get(['lr_license_number', 'lr_license_number2', 'lr_to_date', 'lr_to_date2', 'user_name', 'user_name2', 'license_name', 'updated_by', 'updated_at']);
            $added_data = LicenseDetailsModel::join('users', 'users.id', '=', 'lr_license_details.user_id')
                            ->join('lr_license_types', 'lr_license_types.id', '=', 'lr_license_details.license_type_id')
                            ->select('lr_license_details.created_at as created_at2', 'lr_license_details.operator_user_id', 'users.name as user_name', 'lr_license_types.name as license_name', 'lr_license_details.added_by')
                            ->where('lr_license_details.is_active', 1)
                            ->where('lr_license_details.is_delete', 0)
                            ->where('lr_license_details.id', $id)->orderBy('to_date', 'desc')->first(); //LicenseDetailsModel::where('id', $id)->first(['created_at','user_id','license_type_id']);
            $created_at = ($added_data) ? $added_data->created_at2 : '';
            $operator_user_id = ($added_data) ? $added_data->operator_user_id : '0';
            $added_by = ($added_data) ? ($added_data->added_by) ? $added_data->added_by : $operator_user_id : '0';
            $operator_name = User::get_user_details('', '', $added_by);
            $operator_name = ($operator_name) ? $operator_name->name : '';
            $created_at = date('d-M-Y H:i:s', strtotime($created_at));
            $history_result = '';
            $history_result2 = '';
            $k = 0;
            $selected = "";
            $header_details = "HISTORY OF " . $added_data->user_name . ' - ' . $added_data->license_name;
            $j = 1;
            foreach ($get_history as $get_history_value) {
                $updated_by = $get_history_value->updated_by;

                $user_data = User::where('id', $updated_by)->first(['name']);
                $updated_by = ($user_data) ? $user_data->name : '';

                $updated_at = date('d-M-Y H:i:s', strtotime($get_history_value->updated_at));
                $history_result2 .= "<tr><td>$j</td><td>edit</td><td>updated at: $updated_at (IST)</td><td>$updated_by</td></tr>";
                $j++;
            }
            $history_result2 .= "<tr><td>$j</td><td>Add</td><td>Created at: $created_at (IST)</td><td>$operator_name</td></tr>";
            $history_result = "<table class='table table-hover table-responsive desk-plan dataTable history_table'>
                     <thead><tr><th>SL</th><th>Action</th><th>Date</th><th>By</th></tr></thead>
                     <tbody>
                     
                     $history_result2
                    
                    </tbody>

                    </table>";

            $data = [
                'get_history' => $get_history,
                'added_time' => $created_at,
                'history_result' => $history_result,
                'header' => $header_details
            ];

            return response()->json($data);
        } catch (\Exception $ex) {
            Log::info('Exc: ' . $ex->getMessage());
        }
    }

    public function test_email(Request $request) {
        try {
            $data = ['subject' => 'TEST EMAIL'];
            $current_date = date('ymd');
            $due_result = LicenseDetailsModel::get_due_records();

            foreach ($due_result as $due_result_value) {
                $user_name = $due_result_value->user_name;
                $due_result = LicenseDetailsModel::get_due_records2($user_name);
                $data['subject'] = "$user_name Due Licenses";
                $data['due_result'] = $due_result;
                $data['user_name'] = $user_name;
                Log::info('TestEmailJob Starts');
                dispatch(new TestEmailJob($data));
                Log::info('TestEmailJob Ends');
            }

            return 'success';
        } catch (\Exception $ex) {
            Log::info('test_email: ' . $ex->getMessage());
        }
    }

//    public function auto_remainder(Request $request) {
//        try {
//            $data = [];
//            $current_date = date('ymd');
//            $due_result = LicenseDetailsModel::get_due_records();
//            foreach ($due_result as $due_result_value) {
//                $user_name = $due_result_value->user_name;
//                $due_result = LicenseDetailsModel::get_due_records2($user_name);
//                $data['subject'] = "$user_name Due Licenses";
//                $data['due_result'] = $due_result;
//                $data['user_name'] = $user_name;
//                Log::info('auto_remainder Starts');
//                dispatch(new \App\Jobs\Lr\AutoRemainderEmailJob($data));
//                Log::info('auto_remainder Ends');
//            }
//
//            return 'success';
//        } catch (\Exception $ex) {
//            Log::info('auto_remainder: ' . $ex->getMessage());
//        }
//    }
//
//    public function auto_remainder2(Request $request) {
//        try {
////            $entered_by = Auth::user()->name;
////            $entered_date = date('Y-M-d');
////            $entered_time = date('H:i:s');
////
////            $data['entered_by'] = $entered_by;
////            $data['entered_date'] = $entered_date;
////            $data['entered_time'] = $entered_time;
////            $data['expire_date'] = date('Y-M-d', strtotime($expire_date));
////
////            $data['entered_by2'] = "Entered  By: <span style=color:#f1292b;>$entered_by</span>";
////            $data['entered_date2'] = "Entered  Date: <span style=color:#f1292b;>$entered_date</span>";
////            $data['entered_time2'] = "Entered  Time: <span style=color:#f1292b;>$entered_time</span>";
//            $current_date = date('ymd');
//            $due_result = LicenseDetailsModel::get_due_records();
//
//            foreach ($due_result as $due_result_value) {
//                $user_name = $due_result_value->name;
//                $due_result = LicenseDetailsModel::get_due_records2($user_name);
//                $data['subject'] = "$user_name Due Licenses";
//                Log::info('auto_remainder started');
//                dispatch(new \App\Jobs\Lr\AutoRemainderEmailJob($data));
//                Log::info('auto_remainder ended');
//            }
//
//            return response()->json(['STATUS_DESC' => 'License added successfully', 'STATUS_CODE' => '1']);
//        } catch (\Exception $ex) {
//            Log::info("edit license " . $ex->getMessage() . ' ' . $ex->getLine());
//        }
//    }

    public function get_operators(Request $request) {
        $term = $request->term;
        $result = User::where('is_active', 1)
                ->where('operator', 'LIKE', '%' .$term . '%')
                ->whereIn('user_role_id', ['1', '2', '3'])
                ->groupBy('operator')
                ->get(['name', 'id','operator']);
        $data = [];
        foreach ($result as $result_value) {
            $data[] = ['value' => $result_value->operator];
        }
        return response()->json($data);
    }

    public function users_upload(Request $request) {
        try {
            ini_set('max_execution_time', 300);
            $is_admin = \Illuminate\Support\Facades\Auth::user()->is_admin;

            if (!$is_admin) {
                return 'fail';
            }
            $this->j = 0;
            Excel::load(Input::file('fx'), function($reader) {
                $results = $reader->get();
//                print_r($results);exit;
                foreach ($results as $results_value) {
                    $json_res = json_encode($results_value);
                    $results_value = json_decode($json_res, TRUE);
//                    print_r($results_value);exit;
                    $mobile_number = ($results_value) ? $results_value['mobile_number'] : '0';
                    $operator_email_id = ($results_value) ? $results_value['operator_email_id'] : '';
                    $email = ($results_value) ? $results_value['email'] : '';
                    $user_name = ($results_value) ? $results_value['user_name'] : '';
                    $designation = ($results_value) ? $results_value['designation'] : '';
                    $password = ($results_value) ? $results_value['pasword'] : '';
                    $password = ($password) ? bcrypt($password) : '';

                    $designation = DesignationModel::get_id_name('', $designation);
                    $user_details = User::where('mobile_number', $mobile_number)->first(['name']);
                    $operator_details = User::where('email', $operator_email_id)->first(['id']);

                    $user_data = [
                        'name' => $user_name,
                        'email' => $email,
                        'mobile_number' => $mobile_number,
                        'designation' => $designation,
                        'operator_email_id' => $operator_email_id,
                        'user_role_id' => 4,
                        'is_lr' => 1,
                        'is_fpl' => 1,
                        'password' => $password
                    ];

                    if (!$user_details) {
                        $user_create = User::create($user_data);
                        $this->j++;
                    }
                    if ($operator_details && ($operator_email_id != $email)) {
                        $operator_user_id = $operator_details->id;
                        $users_update = ['operator_user_id' => $operator_user_id, 'is_lr' => 1, 'is_fpl' => 1];
                        $users_update = User::where('mobile_number', $mobile_number)
                                ->update($users_update);
                    } else if ($operator_email_id == $email) {
                        $operator_user_id = $user_create->id;
                        $users_update = ['operator_user_id' => $operator_user_id,
                            'user_role_id' => 3, 'is_lr' => 1, 'is_fpl' => 1];
                        $users_update = User::where('mobile_number', $mobile_number)
                                ->update($users_update);
                    }
                }
            });


            return back()->with('success', "Successfully $this->j users created!");
        } catch (\Exception $ex) {
            Log::info('Line Num ' . $ex->getLine() . ' ' . $ex->getMessage());
        }
    }

    public function lr_upload(Request $request) {
        try {
            ini_set('max_execution_time', 300);
            $is_admin = \Illuminate\Support\Facades\Auth::user()->is_admin;

            if (!$is_admin) {
                return 'fail';
            }
            $this->j = 0;
            $this->k = 0;
            Excel::load(Input::file('fx'), function($reader) {
                $results = $reader->get();
//                print_r($results);exit;
                foreach ($results as $results_value) {
                    $json_res = json_encode($results_value);
                    $results_value = json_decode($json_res, TRUE);
//                    print_r($results_value);exit;
                    $mobile_number = ($results_value) ? $results_value['mobile_number'] : '0';
                    $license_name = ($results_value) ? $results_value['license_name'] : '0';
                    $license_number = ($results_value) ? $results_value['license_number'] : '';
                    $renewed_date = ($results_value) ? $results_value['renewed_date'] : '';
                    $expire_date = ($results_value) ? $results_value['expire_date'] : '';
                    $remarks = ($results_value) ? $results_value['remarks'] : '';

                    $renewed_date = date('ymd', strtotime($renewed_date['date']));
                    $expire_date = date('ymd', strtotime($expire_date['date']));

                    $user_details = User::where('mobile_number', $mobile_number)->first(['id', 'operator_user_id', 'name', 'email']);

                    if (!$user_details) {
                        return back()->with('success', "User details of $mobile_number does not exist!");
                    }

                    if ($license_name == '' || $mobile_number == '') {
                        return back()->with('success', "Please enter all the details!");
                    }

                    $user_id = ($user_details) ? $user_details->id : '0';
                    $operator_user_id = ($user_details) ? $user_details->operator_user_id : '0';

                    $license_type_id = LicenseTypesModel::get_license_type('', $license_name);
                    $check_license = LicenseDetailsModel::check_license_exist($user_id, $license_type_id);

                    $lr_data = [
                        'user_id' => $user_id,
                        'operator_user_id' => $operator_user_id,
                        'renewed_date' => $renewed_date,
                        'to_date' => $expire_date,
                        'number' => $license_number,
                        'license_type_id' => $license_type_id,
                        'message' => $remarks,
                        'is_active' => 1,
                        'is_delete' => 0
                    ];
                    if (!$check_license) {
                        LicenseDetailsModel::create($lr_data);
                        $this->j++;
                    } else {
                        LicenseDetailsModel::where('id', $check_license)->update($lr_data);
                        $this->k++;
                    }
                }
            });
            return back()->with('success', "Successfully $this->j Licenses created!")
                            ->with('insert_count', $this->j)
                            ->with('update_count', $this->k);
        } catch (\Exception $ex) {
            Log::info('Line Num ' . $ex->getLine() . ' ' . $ex->getMessage());
        }
    }

    public function users_upload_page(Request $request) {
        return view('lr.users_upload_page');
    }

    public function lr_upload_page(Request $request) {
        return view('lr.lr_upload_page');
    }

    public function user_excel_download(Request $request) {
        $is_admin = Auth::user()->is_admin;
        if (!$is_admin) {
            return 'fail';
        } else {
            $notams = User::where('id', 89)->select('users.operator_email_id', 'users.name as user_name', 'mobile_number', 'email', 'designation', 'id as pasword')->get();
            $fileName = "lr_users";
            Excel::create($fileName, function($excel) use ($notams) {
                $excel->sheet('notam_sheet', function($sheet) use ($notams) {
                    $sheet->fromModel($notams);
                    $sheet->setOrientation('landscape');
                });
            })->export('xls');
        }
    }

    public function lr_excel_download(Request $request) {
        $is_admin = Auth::user()->is_admin;
        if (!$is_admin) {
            return 'fail';
        } else {
            $notams = LicenseDetailsModel::where('user_id', 89)->orWhere('operator_user_id', 89)
                            ->select('id as mobile_number', 'number as license_number', 'license_type_id as license_name', 'from_date as renewed_date', 'to_date as expire_date', 'message as remarks')->take(1)->get();
            $fileName = "lr_details";
            Excel::create($fileName, function($excel) use ($notams) {
                $excel->sheet('notam_sheet', function($sheet) use ($notams) {
                    $sheet->fromModel($notams);
                    $sheet->setOrientation('landscape');
                });
            })->export('xls');
        }
    }

}
