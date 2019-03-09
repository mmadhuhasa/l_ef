<?php

namespace App\Http\Controllers\EflightAdmin;

use App\Http\Controllers\Controller;
use App\models\AerodromeMailsModel;
use App\models\CallsignHandlersModel;
use App\models\CallsignInfoModel;
use App\models\DesignationModel;
use App\models\PilotMasterModel;
use App\models\PilotsInfoModel;
use Illuminate\Http\Request;
use Response;
use App\myfolder\myFunction;
use Log;

class InfoController extends Controller {

    public function __construct() {
        
    }

    public function index() {
        $callsign_info_obj = CallsignInfoModel::getInstance();
        $callsign_info = $callsign_info_obj->get_callsign_info();
//	$callsign_handlers = CallsignHandlersModel::get_callsign_handlers('', '');
        $callsign_handlers = \App\models\AerodromeMailsModel::get_airport_data();

        $data = ['callsign_info' => $callsign_info,
            'callsign_handlers' => $callsign_handlers,
            'aircraft_callsign' => 'TESTA',
            'departure_aerodrome' => 'VOPC'];

        return view('EflightAdmin.fpl.view_info', $data);
    }

    public function create() {
        return view('EflightAdmin.create_info', []);
    }

    public function store(Request $request) {
        $data = $request->all();
        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome = $request->departure_aerodrome;

        for ($i = 0; $i <= 10; $i++) {
            $designation = $request->designation[$i];
            $name = $request->name[$i];
            $email = $request->email[$i];
            $mobile_number = $request->mobile_number[$i];

            $check = CallsignInfoModel::check_callsign_info($aircraft_callsign, $designation, $name);
            $count = count($check);

            $data_create = ['aircraft_callsign' => $aircraft_callsign,
                'designation' => $designation,
                'name' => $name,
                'email' => $email,
                'mobile_number' => $mobile_number,
                'is_active' => 1];

            if ($designation != 'Select Designation') {
                if ($count == 0 && $name != '' && $email != '' && $mobile_number != '') {
                    CallsignInfoModel::create($data_create);
                } elseif ($count && $name != '' && $email != '' && $mobile_number != '') {
                    CallsignInfoModel::where('id', $check->id)->update($data_create);
                }
            }
        }
        $name = $request->name[10];
        $email = $request->email[10];
        $mobile_number = $request->mobile_number[10];
        $data_create = [
            'departure_airport' => $departure_aerodrome,
            'name' => $name,
            'email' => $email,
            'mobile_number' => $mobile_number,
            'is_active' => 1];
        $callsign_handlers = CallsignHandlersModel::get_callsign_handlers($aircraft_callsign, $departure_aerodrome);
        if (!$callsign_handlers) {
            CallsignHandlersModel::create($data_create);
        } else {
            CallsignHandlersModel::where('departure_airport', $departure_aerodrome)->update($data_create);
        }

        return 1;
    }

    public function show(Request $request) {
        $id = $request->id;
        $callsign_info_obj = CallsignInfoModel::getInstance();
        $callsign_info = $callsign_info_obj->get_callsign_info('', $id);
//	var_dump($callsign_info);exit;
        $designation_id = ($callsign_info) ? $callsign_info->designation : 0;
        $designation = '';
        if ($designation_id) {
            $designation_data = DesignationModel::where('id', $designation_id)->first();
            $designation = $designation_data->name;
        }
        return response()->json(['response' => $callsign_info, 'designation' => $designation]);
    }

    public function get_designations(Request $request) {
        $get_designations = DesignationModel::get_all();
        $result = [];
        foreach ($get_designations as $get_designations_value) {
            $result[] = ['value' => $get_designations_value->name];
        }
        unset($result[3]);
        unset($result[4]);
        $result[3] = ['value' => 'OPS STAFF'];
        $result[4] = ['value' => 'ADMIN MANAGER'];
        return response::json($result);
    }

    public function get_callsign_info(Request $request) {
        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome = $request->departure_aerodrome;
        $callsign_info_obj = CallsignInfoModel::getInstance();
//	$callsign_handlers_obj = CallsignHandlersModel::getInstance();
        //	$callsign_handlers = $callsign_handlers_obj->get_callsign_handlers('', $departure_aerodrome);

        $callsign_handlers = \App\models\AerodromeMailsModel::get_airport_data($departure_aerodrome);
        $callsign_info = $callsign_info_obj->get_callsign_info($aircraft_callsign);
        $data = ['aircraft_callsign' => $aircraft_callsign, 'callsign_info' => $callsign_info, 'callsign_handlers' => $callsign_handlers, 'departure_aerodrome' => $departure_aerodrome];
        return view('EflightAdmin.fpl.search_view_info', $data);
    }

    public function save_callsign_info(Request $request) {
        $data = $request->all();

        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome = $request->departure_aerodrome;
        $data_id = $request->data_id;
        $new_id = '';
//        $res = myFunction::get_cc_mails2($data);
        //        print_r($res);exit;

        $designation = trim($request->designation);
        $name = $request->name;
        $email = trim($request->email, '.');
        $mobile_number = trim($request->mobile_number, '.');

        $designation_data = DesignationModel::where('name', $designation)->first();
        $designation_id = ($designation_data) ? $designation_data->id : 0;

        $data_create = ['aircraft_callsign' => $aircraft_callsign,
            'designation' => $designation_id,
            'name' => $name,
//	    'email' => $email,
            //	    'mobile_number' => $mobile_number,
            'is_active' => 1];
        if ($data_id) {
            $callsign_info_update = CallsignInfoModel::where('id', $data_id)->update([
                'designation' => $designation_id,
                'name' => $name,
                'is_active' => 1]);
            if ($designation_id == 1) {
                $is_pilot = 1;
                $is_copilot = 0;
            } elseif ($designation_id == 2 || $designation_id == 3) {
                $is_pilot = 0;
                $is_copilot = 1;
            }
            $data_pilot_create = [
                'name' => $name,
                'email' => $email,
                'mobile_number' => $mobile_number,
                'is_pilot' => $is_pilot,
                'is_copilot' => $is_copilot];
            $get_callsign_info_details = CallsignInfoModel::where('id', $data_id)->first();
            $pilot_master_id = ($get_callsign_info_details) ? $get_callsign_info_details->pilot_master_id : '1';
            $update_master = PilotMasterModel::where('id', $pilot_master_id)->update($data_pilot_create);
        } elseif ($designation != 'Select Designation' && $designation != '') {
            if ($name != '' && $email != '' && $mobile_number != '') {
                $pilot_master_result = '';
                $pilot_master_data = PilotMasterModel::where('name', $name)->first();
                if ($designation == 'Pilot') {
                    $data_pilot_create = [
                        'name' => $name,
                        'email' => $email,
                        'mobile_number' => $mobile_number,
                        'is_pilot' => 1,
                        'is_active' => 1];
                    $data_create = ['aircraft_callsign' => $aircraft_callsign,
                        'name' => $name,
                        'email' => $email,
                        'mobile_number' => $mobile_number,
                        'is_pilot' => 1,
                        'is_active' => 1];
                    if (!$pilot_master_data) {
                        $pilot_master_result = PilotMasterModel::create($data_pilot_create);
                        $pilot_info_data = ['aircraft_callsign' => $aircraft_callsign, 'pilot_id' => $pilot_master_result->id, 'is_active' => 1];
                        $pilots_info = PilotsInfoModel::create($pilot_info_data);
                    } else {
                        $pilot_master_update = PilotMasterModel::where('id', $pilot_master_data->id)->update($data_pilot_create);
                    }
                } elseif ($designation == 'Co-pilot' || $designation == 'Cabin Crew') {
                    $data_create = ['aircraft_callsign' => $aircraft_callsign,
                        'name' => $name,
                        'email' => $email,
                        'mobile_number' => $mobile_number,
                        'is_copilot' => 1,
                        'is_active' => 1];
                    $data_pilot_create = [
                        'name' => $name,
                        'email' => $email,
                        'mobile_number' => $mobile_number,
                        'is_copilot' => 1,
                        'is_active' => 1];
                    if (!$pilot_master_data) {
                        $pilot_master_result = PilotMasterModel::create($data_pilot_create);
                        $get_pilot_info_data = PilotsInfoModel::where('aircraft_callsign', $aircraft_callsign)->first();
                        $pilot_info_data = ['aircraft_callsign' => $aircraft_callsign, 'pilot_id' => $pilot_master_result->id, 'is_active' => 1];
                        $pilots_info = PilotsInfoModel::create($pilot_info_data);
                    } else {
                        $pilot_master_update = PilotMasterModel::where('id', $pilot_master_data->id)->update($data_pilot_create);
                    }
                } else {
                    $data_pilot_create = [
                        'name' => $name,
                        'email' => $email,
                        'mobile_number' => $mobile_number,
                        'is_client_ops' => 1,
                        'is_active' => 1];
                    if (!$pilot_master_data) {
                        $pilot_master_result = PilotMasterModel::create($data_pilot_create);
                    } else {
                        $pilot_master_update = PilotMasterModel::where('id', $pilot_master_data->id)->update($data_pilot_create);
                    }
                }
            }
            $data_create = ['aircraft_callsign' => $aircraft_callsign,
                'designation' => $designation_id,
                'pilot_master_id' => ($pilot_master_result) ? $pilot_master_result->id : 1,
                'name' => $name,
                'email' => $email,
                'mobile_number' => $mobile_number,
                'is_active' => 1];
            $callsign_info_result = CallsignInfoModel::create($data_create);
            $data_id = ($callsign_info_result) ? $callsign_info_result->id : '';
            $new_id = $data_id;
        }
        return response()->json(['data_id' => $data_id, 'new_id' => $new_id]);
    }

    public function save_callsign_handlers(Request $request) {
        $data = $request->all();
        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome = $request->departure_aerodrome;
        $data_id = $request->data_id;

        $name = $request->name;
        $email = trim($request->email, '.');
        $mobile_number = trim($request->mobile_number, '.');
//	$data_create = [
        //	    'departure_airport' => $departure_aerodrome,
        //	    'name' => $name,
        //	    'email' => $email,
        //	    'mobile_number' => $mobile_number,
        //	    'is_active' => 1];

        $data_create = [
            'aerodrome' => $departure_aerodrome,
            'name' => $name,
            'email' => $email,
            'mobile_number' => $mobile_number,
            'is_active' => 1];

        $callsign_handlers = AerodromeMailsModel::where('is_active', 1)
                        ->where('aerodrome', $departure_aerodrome)->first();
        if (!$data_id) {
            AerodromeMailsModel::create($data_create);
        } else {
            AerodromeMailsModel::where('id', $data_id)->update($data_create);
        }

        return 1;
    }

    public function modal_msg_text(Request $request) {
        $modal_type = $request->modal_type;
        $data_id = $request->data_id;
        $designation = $request->designation;
        $name = $request->name;

        switch ($modal_type) {
            case 'email':
                $email = trim($request->email, '.');
                $data = ['email' => $email];
                CallsignInfoModel::where('id', $data_id)->update($data);
                $get_callsign_info_details = CallsignInfoModel::where('id', $data_id)->first();
                $pilot_master_id = ($get_callsign_info_details) ? $get_callsign_info_details->pilot_master_id : '1';
                $update_master = PilotMasterModel::where('id', $pilot_master_id)->update($data);
                break;
            case 'mobile_number':
                $mobile_number = trim($request->mobile_number, '.');
                $data = ['mobile_number' => $mobile_number];
                CallsignInfoModel::where('id', $data_id)->update($data);
                $get_callsign_info_details = CallsignInfoModel::where('id', $data_id)->first();
                $pilot_master_id = ($get_callsign_info_details) ? $get_callsign_info_details->pilot_master_id : '1';
                $update_master = PilotMasterModel::where('id', $pilot_master_id)->update($data);
                break;
            default:
                break;
        }

        return 1;
    }

    public function checkbox_info(Request $request) {
        $aircraft_callsign = $request->aircraft_callsign;
        $departure_aerodrome = $request->departure_aerodrome;
        $data_id = $request->data_id;
        $is_fpl_checked = ($request->is_fpl_checked) ? 1 : 0;

        $designation = trim($request->designation);
        $name = $request->name;
        $email = trim($request->email, '.');
        $mobile_number = trim($request->mobile_number, '.');
        if ($name != '' && $email != '' && $mobile_number != '' && $designation != '' && $data_id != '') {
            $callsign_info = CallsignInfoModel::where('id', $data_id)->update(['is_fpl' => $is_fpl_checked]);
            return response()->json(['success' => 1, 'error' => 0, 'result' => $callsign_info]);
        } else {
            return response()->json(['success' => 0, 'error' => 1]);
        }
    }

    public function destroy(Request $request) {
        $id = $request->id;
        if ($id) {
            $callsigninfo = CallsignInfoModel::where('id', $id)->first(['pilot_master_id']);
            $pilot_master_id = ($callsigninfo) ? $callsigninfo->pilot_master_id : 0;
//            $pilot_delete    = PilotMasterModel::where('id',$pilot_master_id)->delete();
            $result = CallsignInfoModel::where('id', $id)->delete();
            return response()->json(['STATUS_DESC' => 'INFO DATA DELETED SUCCESSFULLY', 'STATUS_CODE' => 1]);
        } else {
            return response()->json(['STATUS_DESC' => '', 'STATUS_CODE' => 0]);
        }
    }

    public function update_callsign_info(Request $request) {
        try {
            $data = $request->all();
//	    print_r($data);exit;
            $aircraft_callsign = $request->aircraft_callsign2;
            $designation = trim($request->designation);
            $name = $request->name;
            $email = trim($request->email, '.');
            $mobile_number = trim($request->mobile_number, '.');
            $departure_aerodrome = $request->departure_aerodrome;
            $data_id = $request->id;
            $is_active = ($request->is_active) ? 1 : 0;
            $new_id = '';
            $data_value = ($request->id) ? $request->id : $request->data_value;
            $designation_data = DesignationModel::where('name', $designation)->first();
            $designation_id = ($designation_data) ? $designation_data->id : 0;
            $id=$request->id;
            $is_pilot = 0;
            $is_copilot = 0;
            $is_cabin_crew = 0;
            $is_client_ops = 0;
            $is_ops_staff = 0;
            $pilot_id = '';

            if($email!="" && $id==''){
                $is_email_exist = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                                ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                                        , 'pilot_master.mobile_number', 'callsign_info.is_active')
                                ->where('aircraft_callsign', $aircraft_callsign)
                                ->where('pilot_master.email',$email)
                                ->count();
                if($is_email_exist>0)
                return response()->json(['STATUS_DESC' => 'DATA ALREADY EXISTS, UNABLE TO ADD',
                'STATUS_CODE' => 0]);                    
            }
            if($email!="" && $id!=''){
                $callsigninfo=CallsignInfoModel::find($id);
                $is_email_exist = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                                ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                                        , 'pilot_master.mobile_number', 'callsign_info.is_active')
                                ->where('aircraft_callsign', $aircraft_callsign)
                                ->where('pilot_master.id','!=',$callsigninfo->pilot_master_id)
                                ->where('pilot_master.email',$email)
                                ->count();
                if($is_email_exist>0)
                return response()->json(['STATUS_DESC' => 'DATA ALREADY EXISTS, UNABLE TO ADD',
                'STATUS_CODE' => 0]);                    
            }
            if($mobile_number!="" && $id==''){                    
                $is_mobile_exist = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                                ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                                        , 'pilot_master.mobile_number', 'callsign_info.is_active')
                                ->where('aircraft_callsign', $aircraft_callsign)
                                ->where('pilot_master.mobile_number',$mobile_number)
                                ->count();
                if($is_mobile_exist>0)
                return response()->json(['STATUS_DESC' => 'DATA ALREADY EXISTS, UNABLE TO ADD',
                    'STATUS_CODE' => 0]);
            }
            if($mobile_number!="" && $id!=''){             
                $callsigninfo=CallsignInfoModel::find($id);       
                $is_mobile_exist = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                                ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                                        , 'pilot_master.mobile_number', 'callsign_info.is_active')
                                ->where('aircraft_callsign', $aircraft_callsign)
                                ->where('pilot_master.id','!=',$callsigninfo->pilot_master_id)
                                ->where('pilot_master.mobile_number',$mobile_number)
                                ->count();
                if($is_mobile_exist>0)
                return response()->json(['STATUS_DESC' => 'DATA ALREADY EXISTS, UNABLE TO ADD',
                    'STATUS_CODE' => 0]);
            }                                        
            if ($data_id) {
                $get_callsign_info_details = CallsignInfoModel::where('id', $data_id)->first();
                $pilot_id = ($get_callsign_info_details) ? $get_callsign_info_details->pilot_master_id : '';
            }

            if ($data_id && $pilot_id != 1) {
                $callsign_info_update = CallsignInfoModel::where('id', $data_id)->update([
                    'designation' => $designation_id,
                    'is_active' => $is_active]);

                if ($designation == 'PILOT') {
                    $type = 1;
                    $is_pilot = 1;
                } else if ($designation == 'CO-PILOT') {
                    $type = 2;
                    $is_copilot = 1;
                } else if ($designation == 'CABIN CREW') {
                    $type = 3;
                    $is_cabin_crew = 1;
                } else if ($designation == 'ADMIN MANAGER') {
                    $is_client_ops = 1;
                    $type = 4;
                } else if ($designation == 'OPS STAFF') {
                    $is_ops_staff = 1;
                    $type = 5;
                }
                $data_pilot_create = [
                    'name' => $name,
                    'email' => $email,
                    'mobile_number' => $mobile_number,
                    'is_pilot' => $is_pilot,
                    'is_copilot' => $is_copilot,
                    'is_cabin_crew' => $is_cabin_crew,
                    'is_ops_staff' => $is_ops_staff,
                    'is_client_ops' => $is_client_ops,
                    'is_active' => $is_active];
                $pilot_master_id = ($get_callsign_info_details) ? $get_callsign_info_details->pilot_master_id : '1';
                if ($pilot_master_id != 0 && $pilot_master_id != '' && $pilot_master_id != 1) {
                    $update_master = PilotMasterModel::where('id', $pilot_master_id)->update($data_pilot_create);
                }
            } elseif ($designation != 'Select Designation' && $designation != '') {
                $pilot_master_result = '';
                $pilot_master_result = PilotMasterModel::where('mobile_number', $mobile_number)
                        ->where('mobile_number', '!=', '0')
                        ->where('mobile_number', '!=', '')
                        ->orwhere(function($query) use($email) {
                            $query->where('email', $email);
                            $query->where('email', '!=', '0');
                            $query->where('email', '!=', '');
                        })
                        /*->orwhere(function($query) use($name) {
                            $query->where('name', $name);
                            $query->where('name', '!=', '0');
                            $query->where('name', '!=', '');
                        })*/   /* sumit commented*/
                        ->first();
                if ($name != '') {
                    $is_pilot = 0;
                    $is_copilot = 0;
                    $is_cabin_crew = 0;
                    $is_client_ops = 0;
                    if ($designation == 'PILOT') {
                        $type = 1;
                        $is_pilot = 1;
                    } else if ($designation == 'CO-PILOT') {
                        $type = 2;
                        $is_copilot = 1;
                    } else if ($designation == 'CABIN CREW') {
                        $type = 3;
                        $is_cabin_crew = 1;
                    } else if ($designation == 'ADMIN MANAGER') {
                        $is_client_ops = 1;
                        $type = 4;
                    } else if ($designation == 'OPS STAFF') {
                        $is_ops_staff = 1;
                        $type = 5;
                    }
                    $data_pilot_create = [
                        'name' => $name,
                        'email' => $email,
                        'mobile_number' => $mobile_number,
                        'is_pilot' => $is_pilot,
                        'is_copilot' => $is_copilot,
                        'is_cabin_crew' => $is_cabin_crew,
                        'is_client_ops' => $is_client_ops,
                        'is_ops_staff' => $is_ops_staff,
                        'is_active' => $is_active];
                    if (!$pilot_master_result) {
                        $pilot_master_result = PilotMasterModel::create($data_pilot_create);
                    } else {
                        if ($pilot_master_result->id != 0 && $pilot_master_result->id != '' && $pilot_master_result->id != 1) {
                            $pilot_master_update = PilotMasterModel::where('id', $pilot_master_result->id)->update($data_pilot_create);
                        }
                    }
                }
                $data_create = ['aircraft_callsign' => $aircraft_callsign,
                    'designation' => $designation_id,
                    'pilot_master_id' => ($pilot_master_result) ? $pilot_master_result->id : 1,
                    'name' => $name,
                    'email' => $email,
                    'mobile_number' => $mobile_number,
                    'is_active' => $is_active];

                $callsign_info_count = CallsignInfoModel::callsign_info_count($aircraft_callsign);
                if ($callsign_info_count < 15) {
                    $callsign_info_result = CallsignInfoModel::create($data_create);
                    $data_id = ($callsign_info_result) ? $callsign_info_result->id : '';
                    $new_id = $data_id;

                    if ($email == 'prem@eflight.aero' || $email == 'dev.eflight@pravahya.com') {
                        $callsign_info_update = CallsignInfoModel::where('id', $data_id)
                                ->update(['is_fpl' => 1, 'is_change' => 1]);
                    }
                }
            }
            
            $data_result = [
                    'data_value'  => $data_value,  
                    'designation' => $designation,
                    'name' => $name,
                    'email' => $email,
                    'mobile_number' => $mobile_number];
            
            return response()->json(['STATUS_DESC' => 'Info data updated successfully!',
                'STATUS_CODE' => 1, 'data_result' => $data_result]);
//        return back()->with('success', $aircraft_callsign . ' Details updated successfully!')->with('aircraft_callsign', $aircraft_callsign);
        } catch (\Exception $ex) {
            Log::info('Users Create  ' . $ex->getMessage() . ' ' . $ex->getLine());
        }
    }

    public function auto_email(Request $request) {
        $term = $request->term;
        $info_result = PilotMasterModel::where('email', 'LIKE', '%' . $term . '%')
                        ->where('is_active', 1)
                        ->groupBy('email')
                        ->take(10)->get(['name', 'mobile_number', 'email']);
        $result = [];
        foreach ($info_result as $value) {
            $result[] = ['label' => $value->email, 'value' => $value->email];
        }
        return $result;
    }

    public function auto_mobile(Request $request) {
        $term = $request->term;
        $info_result = PilotMasterModel::where('mobile_number', 'LIKE', '%' . $term . '%')
                        ->where('is_active', 1)
                        ->groupBy('mobile_number')
                        ->take(10)->get(['name', 'mobile_number', 'email']);
        $result = [];
        foreach ($info_result as $value) {
            $result[] = ['label' => $value->mobile_number, 'value' => $value->mobile_number];
        }
        return $result;
    }
    
    public function auto_name(Request $request) {
        $term = $request->term;
        $info_result = PilotMasterModel::where('name', 'LIKE', '%' . $term . '%')
                        ->where('is_active', 1)
                        ->groupBy('name')
                        ->take(10)
                        ->get(['name', 'mobile_number', 'email']);
        $result = [];
        foreach ($info_result as $value) {
            $result[] = ['label' => $value->name, 'value' => $value->name];
        }
        return $result;
    }

    public function get_pilot_data(Request $request) {
        $email = $request->email;
        $mobile_number = $request->mobile_number;
        $name = $request->name;
        $get_pilot_details = PilotMasterModel::where('email', $email)
                        ->orwhere('mobile_number', $mobile_number)
                        ->orwhere('name', $name)
                ->first(['name', 'email', 'mobile_number','is_active','is_pilot','is_copilot','is_cabin_crew','is_ops_staff','is_admin_manager']);
//        $mobile_number = ($get_pilot_details) ? $get_pilot_details->mobile_number : '';
        return response::json($get_pilot_details);
    }

}
