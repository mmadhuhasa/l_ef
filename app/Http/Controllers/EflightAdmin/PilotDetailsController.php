<?php

namespace App\Http\Controllers\EflightAdmin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\models\FlightPlanDetailsModel;
use Response;
use Input;
use Log;
use Mail;
use Auth;
use PDF;
use Redirect;
use App\myfolder\myFunction;
use App\models\CallSignMailsModel;
use App\models\PilotsInfoModel;
use App\models\PilotMasterModel;
use Image;

class PilotDetailsController extends Controller {

    public function index(Request $request) {
        try {
            $page = $request->page;
            switch ($page) {
                case 'history2':
                    $result = PilotsInfoModel::get_callsign_pilots_info();
                    return view('EflightAdmin.pilots.pilots_history2', ['get_all' => $result]);
                    break;
                case 'history':
                    $result = PilotsInfoModel::get_callsign_pilots_info();
                    return view('EflightAdmin.pilots.pilots_history3', ['get_all' => $result]);
                    break;
                case 'upload':
                    $result = PilotsInfoModel::get_callsign_pilots_info();
                    return view('EflightAdmin.pilots.upload', ['get_all' => $result]);
                    break;
                default:
                    $result = ''; //PilotsInfoModel::get_callsign_pilots_info();
                    return view('EflightAdmin.pilots.pilots_history3', ['get_all' => $result]);
                    break;
            }
        } catch (\Exception $ex) {
            Log::info('Pilot Index' . $ex->getMessage());
        }
    }

    public function create() {
        return view('EflightAdmin.pilots.add_pilots', ['data' => 'data']);
    }

    public function store(Request $request) {
        $data = $request->all();
        $pilot_id = $request->id;
        
        $pilot_master_data = PilotMasterModel::where('id', $pilot_id)->first();
        $aircraft_callsign = $request->aircraft_callsign2;
        $name = ($request) ? $request->name2 : '';
        $email = ($request) ? $request->email2 : '';
        $mobile_number = ($request) ? $request->mobile_number2 : '';
        $is_pilot = ($request) ? $request->is_pilot : '';
        $is_copilot = ($request) ? $request->is_copilot : '';
        $is_active = ($request) ? $request->is_active : '';
        $img_sign  = ($request) ? $request->img_sign : '';

        $pilot_input_data = ['name' => $name, 'email' => $email, 'mobile_number' => $mobile_number,
            'is_pilot' => $is_pilot, 'is_copilot' => $is_copilot, 'is_active' => $is_active];

        $update_pilot_master = PilotMasterModel::where('id', $pilot_id)->update($pilot_input_data);

        $file_name = $request->signature2;
        $image = Input::file('signature2');
        
        $file_original_name = $_FILES['signature2']['name'];
        
        $name = str_replace(" ", "", $name);

        $aircraft_callsign_path = public_path('media/pdf/fpl/signatures/' . $aircraft_callsign . '.png');
        $pilot_signature_path = public_path('media/pdf/fpl/signatures/' . $name . '.png');

        if (!file_exists($aircraft_callsign_path) && $file_original_name) {          
            Image::make($image)->resize(36, 30)->save($aircraft_callsign_path);           
        } elseif (file_exists($pilot_signature_path) && $file_original_name) {            
            unlink($pilot_signature_path);
            Image::make($image)->resize(36, 30)->save($pilot_signature_path);
        } elseif ($file_original_name) {           
            Image::make($image)->resize(36, 30)->save($pilot_signature_path);
        }
        elseif($img_sign == '0'){
            unlink($pilot_signature_path);
        }
//        return back()->with('success', 'Pilots details updated successfully');
        
        return response()->json(['STATUS_CODE' => 1,'STATUS_DESC' => 'Pilots details updated successfully']);
    }

    public function show(Request $request) {
        $id = $request->id;
        $pilots_data = PilotMasterModel::leftJoin('callsign_info', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                ->where('pilot_master.id', $id)
                ->select('pilot_master.*', 'callsign_info.aircraft_callsign')
                ->first();

        if ($pilots_data) {
            $aircraft_callsign = ($pilots_data) ? $pilots_data->aircraft_callsign : '';
            $pilot_in_command = ($pilots_data) ? $pilots_data->name : ''; //$aRow['pilot_name'];

            $aircraft_callsign_exists = "media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ";
            $aircraft_callsign_path = url("media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ");
            $aircraft_callsign_signature = (file_exists($aircraft_callsign_exists)) ? '<img src=' . $aircraft_callsign_path . ' />' : ''; //				     
            $pilot_in_command_strip = preg_replace('/( *)/', '', $pilot_in_command);
            $pilot_in_command_exists = "media/pdf/fpl/signatures/" . $pilot_in_command_strip . ".png";
            $pilot_in_command_path = url('media/pdf/fpl/signatures/' . $pilot_in_command_strip . '.png');
            $pilot_in_command_signature = (file_exists($pilot_in_command_exists)) ? '<img src=' . $pilot_in_command_path . ' />' : '';
            $signature = (file_exists($pilot_in_command_exists)) ? $pilot_in_command_signature : $aircraft_callsign_signature;
            
            $is_pilot_sign =  (file_exists($pilot_in_command_exists)) ? '1' : '';

            return response()->json(['response' => $pilots_data, 'signature' => $signature, 'is_pilot_sign' => $is_pilot_sign]);
        } else {
            return response()->json(['response' => '', 'signature' => '']);
        }
    }

    public function pilot_list() {
        try {

            /*
             * Script:    DataTables server-side script for PHP and MySQL
             * Copyright: 2010 - Allan Jardine, 2012 - Chris Wright
             * License:   GPL v2 or BSD (3-point)
             */

            /*             * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
             * Easy set variables
             */

            /* Array of database columns which should be read and sent back to DataTables. Use a space where
             * you want to insert a non-database field (for example a counter or static image)
             */
//	$aColumns = array('aircraft_callsign', 'aircraft_callsign', 'aircraft_callsign','aircraft_callsign','aircraft_callsign','aircraft_callsign',
//	    'aircraft_callsign','aircraft_callsign','aircraft_callsign','aircraft_callsign');
            $aColumns = array('aircraft_callsign');

            /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = "id";

            /* DB table to use */
            $sTable = "callsign_info";

            $gaSql['user'] = \Config::get('database.connections.mysql.username');
            $gaSql['password'] = \Config::get('database.connections.mysql.password');
            $gaSql['db'] = \Config::get('database.connections.mysql.database');
            $gaSql['server'] = \Config::get('database.connections.mysql.host');

            /*             * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
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
            $sWhere = "WHERE (pilots.is_pilot =1 OR  is_copilot=1)";
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
                        $sWhere = "";
                    } else {
                        $sWhere .= " AND ";
                    }
                    $sWhere .= $aColumns[$i] . " LIKE '%" . mysqli_real_escape_string($gaSql['link'], $_GET['sSearch_' . $i]) . "%' ";
                }
            }

            $aircraft_callsign = (isset($_GET['aircraft_callsign'])) ? $_GET['aircraft_callsign'] : '';
            $email = (isset($_GET['email'])) ? $_GET['email'] : '';
            $name = (isset($_GET['name'])) ? $_GET['name'] : '';
            $mobile_number = (isset($_GET['mobile_number'])) ? $_GET['mobile_number'] : '';
            $url = (isset($_GET['url'])) ? $_GET['url'] : '';
            
            if ($sWhere == "") {
                $sWhere = "WHERE pilots.is_active=1";
            } else {
                $sWhere .= " AND pilots.is_active=1 ";
            }
            
            if ($aircraft_callsign != '') {
	    $sWhere .= " AND aircraft_callsign LIKE '%$aircraft_callsign%'";
	    }
            if ($email != '') {
	    $sWhere .= " AND pilots.email LIKE '%$email%'";
	    }            
            if ($name != '') {
	    $sWhere .= " AND pilots.name LIKE '%$name%'";
	    }
            if ($mobile_number != '') {
	    $sWhere .= " AND pilots.mobile_number = '$mobile_number'";
	    }
            $group_by = " GROUP BY aircraft_callsign, pilots.name, pilots.mobile_number";
            /*
             * SQL queries
             * Get data to display
             */
            $sOrder = " ORDER BY aircraft_callsign asc"; //"ORDER BY date_of_flight desc,departure_time_hours desc,departure_time_minutes desc";

           $sQuery = "
           SELECT SQL_CALC_FOUND_ROWS DISTINCT " . str_replace(" , ", " ", implode(", ", $aColumns)) . ", pilots.name AS name, 
	    pilots.mobile_number AS mobile_number,pilots.email AS email, pilots.id, pilots.is_active AS is_active,pilots.is_pilot AS is_pilot
	    ,pilots.is_copilot AS is_copilot from pilot_master as pilots
		JOIN $sTable on $sTable.pilot_master_id = pilots.id		
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
                "aaData" => array()
            );
            $sno = $_GET['iDisplayStart'] + 1;
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
                $aircraft_callsign = $aRow['aircraft_callsign'];
                $pilot_in_command = $aRow['name'];

                $aircraft_callsign_exists = "media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ";
                $aircraft_callsign_path = url("media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ");
                $aircraft_callsign_signature = (file_exists($aircraft_callsign_exists)) ? '<img src=' . $aircraft_callsign_path . ' />' : ''; //				     
                $pilot_in_command_strip = preg_replace('/( *)/', '', $pilot_in_command);
                $pilot_in_command_exists = "media/pdf/fpl/signatures/" . $pilot_in_command_strip . ".png";
                $pilot_in_command_path = url('media/pdf/fpl/signatures/' . $pilot_in_command_strip . '.png');
                $pilot_in_command_signature = (file_exists($pilot_in_command_exists)) ? '<img src=' . $pilot_in_command_path . ' />' : '';
                $signature = (file_exists($pilot_in_command_exists)) ? $pilot_in_command_signature : $aircraft_callsign_signature;

                $is_pilot = ($aRow['is_pilot']) ? '<p style="color:#32af32;">&#10004;</p>' : '<p style="color:#f1292b;">&#x2716;</p>';
                $is_copilot = ($aRow['is_copilot'] || $is_pilot) ? '<p style="color:#32af32;">&#10004;</p>' : '<p style="color:#f1292b;">&#x2716;</p>';

                $row = array(0 => $sno,
                    1 => "<div class='pilots_name_popup font_bold_14'>$aircraft_callsign </div>",
                    2 => "<div class='pilots_name_popup font_bold_14'>$pilot_in_command</div>",
                    3 => "<div class='font_bold_14'>".$aRow['mobile_number']."</div>",
                    4 => "<div class='font_bold_14'>".$aRow['email']."</div>",
                    5 => $is_pilot,
                    6 => $is_copilot,
                    7 => $signature,
                  
                    8 => "<div class='edit_rel'><a href='#' data-url='pilots' class='edit_pilots' data-value= '$id' id='edit_$id'><i class='fa fa-edit'></i></a><div class='edit_tooltip'>edit</div></div>
		<div class='delete_rel'><a href='#'  class='alert_delete_pilots' data-aircraft='$aircraft_callsign' data-value= '$id' id='delete_$id'><i class='fa fa-trash'></i></a><div class='delete_tooltip'>delete</div></div>",
                );
                $sno++;
                $output['aaData'][] = $row;
            }

            return $output;
        } catch (\Exception $ex) {
            Log::info('Pilot List' . $ex->getMessage());
        }
    }

    public function upload() {
        print_r($_FILES);
    }

    public function add_pilots(Request $request) {
        $data = $request->all();
        $result = PilotMasterModel::create($data);
        return redirect('pilots/creats')->with('success', 'success');
    }

    public function destroy(Request $request) {
        try {
            $id = $request->id;
            if ($id) {
//                $pilot_data = PilotMasterModel::where('id', $id)->delete();
                 $pilot_data = \App\models\CallsignInfoModel::where('pilot_master_id', $id)->delete();
                return response()->json(['STATUS_DESC' => 'PILOT DATA DELETED SUCCESSFULLY', 'STATUS_CODE' => 1]);
            } else {
                return response()->json(['STATUS_DESC' => '', 'STATUS_CODE' => 0]);
            }
        } catch (\Exception $ex) {
            Log::info('Dele'.$ex->getMessage());
        }
    }
    
    public function filter_pilots(Request $request){
        return view('EflightAdmin.pilots.search_pilots');
    }

}
