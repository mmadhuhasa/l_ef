<?php

namespace App\Http\Controllers\EflightAdmin;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Jobs\UsersCreateJob;
use Log;
use App\models\lr\LicenseDetailsModel;

class UserController extends Controller {

    public function index() {
        return view('EflightAdmin.users.users_list');
    }

    public function create() {
        return view('EflightAdmin.users.add_users');
    }

    public function store(Request $request) {
        $data = $request->all();
        $type = 'update';
        $id = $request->id;
        $result = '';

        if ($type == 'update') {
            unset($data['type']);
            unset($data['_token']);
            unset($data['url']);
            $result = User::where('id', $id)->update($data);
        }
        return redirect()->back()->with('success', 'USER DETAILS SUCCESSFULLY UPDATED');
    }

    public function user_list() {
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
        $aColumns = array('id', 'name', 'email', 'operator_user_id', 'user_role_id', 'password', 'mobile_number', 'operator', 'additional_emails',
            'user_callsigns', 'remember_token', 'is_admin', 'is_active', 'is_delete', 'is_app', 'updated_by');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";
        /* DB table to use */
        $sTable = "users";
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

        $name = (isset($_GET['name'])) ? $_GET['name'] : '';
        $email = (isset($_GET['email'])) ? $_GET['email'] : '';
        $mobile_number = (isset($_GET['mobile_number'])) ? $_GET['mobile_number'] : '';
        $operator = (isset($_GET['operator'])) ? $_GET['operator'] : '';
        $user_role_id = (isset($_GET['user_role_id'])) ? $_GET['user_role_id'] : '';

        $to_date = (isset($_GET['to_date'])) ? $_GET['to_date'] : '';
        $url = (isset($_GET['url'])) ? $_GET['url'] : '';
        $date_of_flight = (isset($_GET['date_of_flight'])) ? $_GET['date_of_flight'] : '';


        if ($sWhere == "") {
            $sWhere = "WHERE is_active=1";
        } else {
            $sWhere .= " AND is_active=1 ";
        }

        if ($name != '') {
            $sWhere .= " AND name LIKE '%$name%'";
        }
        if ($email != '') {
            $sWhere .= " AND email LIKE '%$email%'";
        }
        if ($operator != '') {
            $sWhere .= " AND operator LIKE '%$operator%'";
        }
        if ($mobile_number != '') {
            $sWhere .= " AND mobile_number = '$mobile_number'";
        }
        if ($user_role_id != "") {
            $sWhere .= " AND user_role_id = '$user_role_id'";
        }


        /*
         * SQL queries
         * Get data to display
         */
        $sOrder = " ORDER BY name asc"; //"ORDER BY date_of_flight desc,departure_time_hours desc,departure_time_minutes desc";

        $sQuery = "
        SELECT SQL_CALC_FOUND_ROWS " . str_replace(" , ", " ", implode(", ", $aColumns)) . " from $sTable
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
//	    $aircraft_callsign = $aRow['aircraft_callsign'];
            //	    $pilot_in_command = $aRow['pilot_name'];

            $is_admin = ($aRow['is_admin']) ? 'YES' : 'NO';
            $is_active = ($aRow['is_active']) ? 'ACTIVE' : 'INACTIVE';
            $company_color = ($is_active) ? 'company_color' : '';
            $user_name = str_replace('.', '', strtoupper($aRow['name']));
            $operator_user_id = $aRow['operator_user_id'];

            $operator_data = User::where('id', $operator_user_id)->first(['email', 'name', 'operator']);
            $operator_user_email = ($operator_data) ? $operator_data->email : '';
            $operator_name = $aRow['operator'];
            $user_role = $aRow['user_role_id'];
            switch ($user_role) {
                case '1':
                    $user_role = "EFL ADMIN";
                    break;
                case '2':
                    $user_role = "EFL OPS";
                    break;
                case '3':
                    $user_role = "OPS ADMIN";
                    break;
                case '1':
                    $user_role = "USER";
                    break;
                default:
                    $user_role = "USER";
                    break;
            }


            $row = array(0 => $sno,
                1 => $user_name,
                2 => str_limit($aRow['email'], 24),
                3 => $aRow['mobile_number'],
                5 => str_limit(strtolower($operator_user_email), 24),
                4 => str_limit(strtoupper($operator_name), 13),
                6 => $user_role,
                7 => "<a href='#' data-url='users' class='edit_users' data-value= '$id' id='edit_$id'><i class='fa fa-edit fa-2x'></i></a>
                                <a href='#'  data-url='users' class='delete_users' data-value='$id' id='delete_$id'><i class='fa fa-trash fa-2x'></i></a>
                            ",
            );
            $sno++;
            $output['aaData'][] = $row;
        }
        return $output;
    }

    public function show(Request $request) {
        $id = $request->id;
        $pilots_data = User::where('id', $id)->first();

        $operator_user_id = $pilots_data->operator_user_id;

        $operator_data = User::where('id', $operator_user_id)->first(['email', 'operator']);
        $operator_user_email = ($operator_data) ? $operator_data->email : '';
        $operator = ($operator_data) ? $operator_data->operator : '';

//        $pilots_data['operator'] = $operator;
        $pilots_data['operator_email'] = $operator_user_email;
        return response()->json(['response' => $pilots_data]);
    }

    public function add_users(Request $request) {
        try {
            $data = $request->all();
            $name = $request->name;
            $mobile_number = $request->user_mobile_number;
            $email = $request->email;
            $password = $request->inputpassword;
            $confirm_password = $request->confirm_password;
            $data['password'] = bcrypt($password);
            $data['mobile_number'] = $mobile_number;
            $data['is_active'] = 1;
            $data['pass'] = $password;
            $operator = $request->operator;
            $user_role = $request->user_role_id;
            $user_callsigns = $request->user_callsigns;
            $operator_email = $request->operator_email;


            $operator_data = User::where('is_active', 1)
                            ->where('email', $operator_email)->first(['id']);

            $operator_user_id = ($operator_data) ? $operator_data->id : '0';

            if ($user_role == 4) {
                $data['operator_user_id'] = $operator_user_id;
            }
            if ($name == '' || $mobile_number == '' || $email == '' || $password == '' || $confirm_password == '') {
                return response()->json(['success' => '', 'STATUS_DESC' => 'Please enter all the fields']);
            }
            if ($user_callsigns == '' && $user_role != 2 && $user_role != 1) {
                return response()->json(['success' => '', 'STATUS_DESC' => 'Please enter callsign']);
            }
            if ($operator_email == '' && $user_role == 4) {
                return response()->json(['success' => '', 'STATUS_DESC' => 'Please enter Operator Admin email']);
            }
            if ($password != $confirm_password) {
                return response()->json(['success' => '', 'STATUS_DESC' => 'Passwords does not match']);
            }
            $get_user_details = User::get_user_details($email);
            if ($get_user_details) {
                return response()->json(['success' => '', 'STATUS_DESC' => 'EMAIL ALREADY EXIST']);
            }

            $get_user_details2 = User::get_user_details('', $mobile_number);
            if ($get_user_details2) {
                return response()->json(['success' => '', 'STATUS_DESC' => 'MOBILE NUMBER ALREADY EXIST']);
            }

            $result = User::create($data);

            if ($user_role != 4) {
                $operator_user_id = $result->id;
                User::where('id', $operator_user_id)->update(['operator_user_id' => $operator_user_id]);
            }

            $data['subject'] = "Welcome $name to EFLIGHT //" . date('d-M-Y');
            Log::info('Users Job start');
            $this->dispatch(new UsersCreateJob($data));
            Log::info('Users Job end');

            if ($result) {
                return response()->json(['success' => 'success', 'STATUS_DESC' => 'USER ADDED SUCCESSFULLY']);
            } else {
                return response()->json(['success' => '']);
            }
        } catch (\Exception $ex) {
            Log::info('Users Create  ' . $ex->getMessage() . ' ' . $ex->getLine());
        }
    }

    public function update_users(Request $request) {
        $data = $request->all();
        $type = 'update';
        $id = $request->id;
        $result = '';
        $operator = $request->operator;
        $operator_email = $request->operator_email;
        $user_role = $request->user_role_id;
        $name = $request->name;
        $email = $request->email;

        $operator_data = User::where('is_active', 1)
                        ->where(function($query) use($operator, $operator_email, $user_role, $name, $email) {
                            if ($user_role == 4) {
                                $query->where('email', $operator_email);
                            } else {
                                $query->where('email', $email);
                            }
                        })->first(['id']);

        $operator_user_id = ($operator_data) ? $operator_data->id : '';

        $user_details = User::where('email', $email)->first(['id']);
        $user_id = ($user_details) ? $user_details->id : 0;

        if ($operator == '' && $user_role == 4) {
            return response()->json(['success' => '', 'STATUS_DESC' => 'Please enter Operator']);
        }

        LicenseDetailsModel::where('user_id', $user_id)->update(['operator_user_id' => $operator_user_id]);

//        print_r($data);exit;
        if ($type == 'update') {
            unset($data['type']);
            unset($data['_token']);
            unset($data['url']);
            unset($data['operator_email']);
            $data['operator_user_id'] = $operator_user_id;
            $result = User::where('id', $id)->update($data);
        }
        return response()->json(['STATUS_DESC' => 'USER DETAILS SUCCESSFULLY UPDATED']);
    }

    public function get_user_details() {
        return view('EflightAdmin.users.filter_users');
    }

    public function auto_email(Request $request) {
        $term = $request->term;
        $ops_admin = ($request->ops_admin) ? $request->ops_admin : "";
        $info_result = User::where('email', 'LIKE', '%' . $term . '%')
                        ->where('is_active', 1)
                        ->where(function($query) use($ops_admin) {
                            if ($ops_admin != "") {
                                $query->where('user_role_id', '=', '3');
                            }
                        })
                        ->groupBy('email')
                        ->take(10)->get(['email']);
        $result = [];
        foreach ($info_result as $value) {
            $result[] = ['label' => $value->email, 'value' => $value->email];
        }
        return $result;
    }

    public function auto_mobile(Request $request) {
        $term = $request->term;
        $info_result = User::where('mobile_number', 'LIKE', '%' . $term . '%')
                        ->where('is_active', 1)->take(10)->get(['name', 'mobile_number', 'email']);
        $result = [];
        foreach ($info_result as $value) {
            $result[] = ['label' => $value->mobile_number, 'value' => $value->mobile_number];
        }
        return $result;
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

    public function auto_name(Request $request) {
        $term = $request->term;
        $info_result = User::where('name', 'LIKE', '%' . $term . '%')
                        ->where('is_active', 1)->take(10)->get(['name', 'mobile_number', 'email']);
        $result = [];
        foreach ($info_result as $value) {
            $result[] = ['label' => $value->name, 'value' => $value->name];
        }
        return $result;
    }

    public function delete_user(Request $request) {
        $id = $request->id;
        $result = User::where('id', $id)->update(['is_active' => 0]);
        LicenseDetailsModel::where('user_id', $id)->update(['is_active' => 0,'is_delete' => 1]);
        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'USER DETAILS SUCCESSFULLY UPDATED']);
    }

    public function get_user_data(Request $request) {
        $name = $request->name;
        $email = $request->email;
        $mobile_number = $request->user_mobile_number;
        $result = User::where('is_active', 1)
                        ->where(function($query) use($name, $email) {
                            if ($name != "") {
                                $query->where('operator', $name);
                            }
                            if ($email != "") {
                                $query->where('email', $email);
                            }
                        })->first(['name', 'email', 'operator']);

        if ($mobile_number) {
            $result = User::where('is_active', 1)->where('mobile_number', $mobile_number)->count();
            $result = ($result) ? TRUE : FALSE;
        }

        return response()->json(['STATUS_CODE' => 1, 'STATUS_DESC' => 'success', 'result' => $result]);
    }

}
