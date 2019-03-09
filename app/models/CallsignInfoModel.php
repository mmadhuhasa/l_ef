<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CallsignInfoModel extends Model {

    protected $table = 'callsign_info';
    protected $PrimaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id', 'aircraft_callsign', 'designation', 'pilot_master_id', 'name', 'email', 'mobile_number', 'is_active'];

    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    public static $instance;
    public static $counter = 0;

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function getInstance() {
        if (!isset(CallsignInfoModel::$instance)) {
            CallsignInfoModel::$instance = new CallsignInfoModel();
        }

        return CallsignInfoModel::$instance;
    }

    /**
     * Always capitalize the name when we retrieve it
     */
    public function getNameAttribute($value) {
        return strtoupper($value);
    }

    /**
     * Always lower the email when we retrieve it
     */
    public function getEmailAttribute($value) {
        return strtolower($value);
    }

    public function setNameAttribute($value) {
        $this->attributes['name'] = strtoupper($value);
    }

    /**
     * Always lower the email when we retrieve it
     */
    public function setEmailAttribute($value) {
        $this->attributes['email'] = strtolower($value);
    }

    public static function get_all() {
        return CallsignInfoModel::where('is_active', 1)->get();
    }

    public static function get_callsign_info($aircraft_callsign = '', $id = '', $is_fpl = '', $is_email = '') {
        if (!$aircraft_callsign) {
            $aircraft_callsign = 'TESTA';
        }
//        $aircraft_callsign = substr($aircraft_callsign, 0, 5);
        if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        } else {
            $aircraft_callsign = $aircraft_callsign;
        }
        if ($is_fpl) {
            $result = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                    ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                            , 'pilot_master.mobile_number', 'callsign_info.is_active')
                    ->where('aircraft_callsign', $aircraft_callsign)
                    ->where('is_fpl', '1')
                    ->where('is_change', '1')
                    ->get();
        } else if ($aircraft_callsign) {
            if ($is_email == '') {
                $result = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                        ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                                , 'pilot_master.mobile_number', 'callsign_info.is_active')
                        ->where('aircraft_callsign', $aircraft_callsign)
                        ->orderByRaw("FIELD(callsign_info.designation,'1','2','3','5','4') ASC")
                        ->orderBy("pilot_master.name", "ASC")
                        ->get();
            } else {
                $result = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                        ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                                , 'pilot_master.mobile_number', 'callsign_info.is_active')
                        ->where('aircraft_callsign', $aircraft_callsign)
                        ->whereIn('callsign_info.designation', [4, 5])
                        ->get();
            }
        }
        if ($id) {
            $result = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                    ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                            , 'pilot_master.mobile_number', 'callsign_info.is_active')
                    ->where('callsign_info.id', $id)
                    ->first();
        }
        return $result;
    }

    public static function get_callsign_info2($aircraft_callsign = '', $id = '', $is_fpl = '') {
        if (!$aircraft_callsign) {
            $aircraft_callsign = 'TESTA';
        }
        $aircraft_callsign = substr($aircraft_callsign, 0, 5);
        if ($is_fpl) {
            $result = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                    ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                            , 'pilot_master.mobile_number', 'callsign_info.is_active')
                    ->where('aircraft_callsign', $aircraft_callsign)
                    ->where('is_fpl', '1')
                    ->where('is_change', '1')
                    ->get();
        } else if ($aircraft_callsign) {
            $result = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                    ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                            , 'pilot_master.mobile_number', 'callsign_info.is_active')
                    ->where('aircraft_callsign', $aircraft_callsign)
                    ->get();
        }
        if ($id) {
            $result = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                    ->select('callsign_info.id', 'callsign_info.aircraft_callsign', 'callsign_info.designation', 'pilot_master.name', 'pilot_master.email'
                            , 'pilot_master.mobile_number', 'callsign_info.is_active')
                    ->where('callsign_info.id', $id)
                    ->first();
        }
        return $result;
    }

    public static function check_callsign_info($ca, $des, $name) {
        $result = CallsignInfoModel::where('aircraft_callsign', $ca)
                        ->where('designation', $des)
                        ->where('name', $name)
                        ->where('is_active', 1)->first();
        return $result;
    }

    public static function get_mails($data, $is_fpl = '') {
      
//        $is_fpl = 1; //(array_key_exists('is_fpl', $data)) ? $data['is_fpl'] :'';
        $aircraft_callsign = array_key_exists('aircraft_callsign', $data) ? $data['aircraft_callsign'] : '';
	
	 if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        } else {
            $aircraft_callsign = $aircraft_callsign;
        }
	
        $get_data = self::get_callsign_info($aircraft_callsign, '', $is_fpl, '1');
        $mails = [];
        foreach ($get_data as $info_data) {
            $data_array = explode(',', $info_data->email);
            if (count($data_array) == 1) {
                $email = $info_data->email;
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mails[] = $email;
                }
            } else {
                foreach ($data_array as $email_value) {
                    if (filter_var($email_value, FILTER_VALIDATE_EMAIL)) {
                        $mails[] = $email_value;
                    }
                }
            }
        }


        $pilot_in_command = array_key_exists('pilot_in_command', $data) ? $data['pilot_in_command'] : '';
        $pilot_mobile_number = array_key_exists('mobile_number', $data) ? $data['mobile_number'] : '';
        $copilot = array_key_exists('copilot', $data) ? $data['copilot'] : '';
        if ($is_fpl == '') {
            if ($pilot_in_command) {
                $get_pilot_data = self::get_pilot_data($aircraft_callsign, $pilot_in_command);
                $get_pilot_email = ($get_pilot_data) ? $get_pilot_data->email : '';
                if (filter_var($get_pilot_email, FILTER_VALIDATE_EMAIL)) {
                    $mails[] = $get_pilot_email;
                }
            }
            if ($copilot != '' && $copilot != 'NA') {
                $get_copilot_data = self::get_pilot_data($aircraft_callsign, $copilot);
                $get_copilot_email = ($get_copilot_data) ? $get_copilot_data->email : '';
                if (filter_var($get_copilot_email, FILTER_VALIDATE_EMAIL)) {
                    $mails[] = $get_copilot_email;
                }
            }
        }
//	print_r($mails);exit;
        $email_data = implode(',', $mails);
        return $email_data;
    }
        public static function get_navlog_mails($data, $is_fpl = '') {
       
//        $is_fpl = 1; //(array_key_exists('is_fpl', $data)) ? $data['is_fpl'] :'';
        $aircraft_callsign = array_key_exists('callsign', $data) ? $data['callsign'] : '';
    
     if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        } else {
            $aircraft_callsign = $aircraft_callsign;
        }
    
        $get_data = self::get_callsign_info($aircraft_callsign, '', $is_fpl, '1');
        $mails = [];
        foreach ($get_data as $info_data) {
            $data_array = explode(',', $info_data->email);
            if (count($data_array) == 1) {
                $email = $info_data->email;
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mails[] = $email;
                }
            } else {
                foreach ($data_array as $email_value) {
                    if (filter_var($email_value, FILTER_VALIDATE_EMAIL)) {
                        $mails[] = $email_value;
                    }
                }
            }
        }


        $pilot_in_command = array_key_exists('pilot', $data) ? $data['pilot'] : '';
        $pilot_mobile_number = array_key_exists('mobile', $data) ? $data['mobile'] : '';
        $copilot = array_key_exists('co_pilot', $data) ? $data['co_pilot'] : '';
        if ($is_fpl == '') {
            if ($pilot_in_command) {
                $get_pilot_data = self::get_pilot_data($aircraft_callsign, $pilot_in_command);
                $get_pilot_email = ($get_pilot_data) ? $get_pilot_data->email : '';
                if (filter_var($get_pilot_email, FILTER_VALIDATE_EMAIL)) {
                    $mails[] = $get_pilot_email;
                }
            }
            if ($copilot != '' && $copilot != 'NA') {
                $get_copilot_data = self::get_pilot_data($aircraft_callsign, $copilot);
                $get_copilot_email = ($get_copilot_data) ? $get_copilot_data->email : '';
                if (filter_var($get_copilot_email, FILTER_VALIDATE_EMAIL)) {
                    $mails[] = $get_copilot_email;
                }
            }
        }
//  print_r($mails);exit;
        $email_data = implode(',', $mails);
        return $email_data;
    }
    public static function get_mobile_numbers($data) {
        $is_fpl = 1; //(array_key_exists('is_fpl', $data)) ? $data['is_fpl'] :'';
//        $aircraft_callsign = array_key_exists('aircraft_callsign', $data) ? substr($data['aircraft_callsign'], 0, 5) : '';
        
        $aircraft_callsign = array_key_exists('aircraft_callsign', $data) ? $data['aircraft_callsign'] : '';
	
	 if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        } else {
            $aircraft_callsign = $aircraft_callsign;
        }
        
        $get_data = self::get_callsign_info($aircraft_callsign, '', '', 1);
        $mobile_numbers = [];
        foreach ($get_data as $info_data) {
            $data_array = explode(',', $info_data->mobile_number);
            if (count($data_array) == 1) {
                $mobile_number = $info_data->mobile_number;
                if (strlen($mobile_number) == 10) {
                    $mobile_numbers[] = $mobile_number;
                }
            } else {
                foreach ($data_array as $mobile_number_value) {
                    if (strlen($mobile_number_value) == 10) {
                        $mobile_numbers[] = $mobile_number_value;
                    }
                }
            }
        }
        $pilot_in_command = array_key_exists('pilot_in_command', $data) ? $data['pilot_in_command'] : '';
        $pilot_mobile_number = array_key_exists('mobile_number', $data) ? $data['mobile_number'] : '';
        $copilot = array_key_exists('copilot', $data) ? $data['copilot'] : '';
        if ($pilot_in_command) {
            $get_pilot_data = self::get_pilot_data($aircraft_callsign, $pilot_in_command);
            $get_pilot_number = ($get_pilot_data) ? $get_pilot_data->mobile_number : '';
            $mobile_numbers[] = $pilot_mobile_number;
        }
        if ($copilot != '' && $copilot != 'NA') {
            $get_pilot_data = self::get_pilot_data($aircraft_callsign, $copilot);
            $get_pilot_number = ($get_pilot_data) ? $get_pilot_data->mobile_number : '';
            $mobile_numbers[] = $get_pilot_number;
        }
        $mobile_numbers_data = implode(',', $mobile_numbers);
        return $mobile_numbers_data;
    }
    public static function get_navlog_mobile_numbers($data) {
        
        $is_fpl = 1; //(array_key_exists('is_fpl', $data)) ? $data['is_fpl'] :'';
//        $aircraft_callsign = array_key_exists('aircraft_callsign', $data) ? substr($data['aircraft_callsign'], 0, 5) : '';
        
        $aircraft_callsign = array_key_exists('callsign', $data) ? $data['callsign'] : '';
    
     if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        } else {
            $aircraft_callsign = $aircraft_callsign;
        }
        
        $get_data = self::get_callsign_info($aircraft_callsign, '', '', 1);
        $mobile_numbers = [];
        foreach ($get_data as $info_data) {
            $data_array = explode(',', $info_data->mobile_number);
            if (count($data_array) == 1) {
                $mobile_number = $info_data->mobile_number;
                if (strlen($mobile_number) == 10) {
                    $mobile_numbers[] = $mobile_number;
                }
            } else {
                foreach ($data_array as $mobile_number_value) {
                    if (strlen($mobile_number_value) == 10) {
                        $mobile_numbers[] = $mobile_number_value;
                    }
                }
            }
        }
        $pilot_in_command = array_key_exists('pilot', $data) ? $data['pilot'] : '';
        $pilot_mobile_number = array_key_exists('mobile', $data) ? $data['mobile'] : '';
        $copilot = array_key_exists('co_pilot', $data) ? $data['co_pilot'] : '';
        if ($pilot_in_command) {
            $get_pilot_data = self::get_pilot_data($aircraft_callsign, $pilot_in_command);
            $get_pilot_number = ($get_pilot_data) ? $get_pilot_data->mobile_number : '';
            $mobile_numbers[] = $pilot_mobile_number;
        }
        if ($copilot != '' && $copilot != 'NA') {
            $get_pilot_data = self::get_pilot_data($aircraft_callsign, $copilot);
            $get_pilot_number = ($get_pilot_data) ? $get_pilot_data->mobile_number : '';
            $mobile_numbers[] = $get_pilot_number;
        }
        $mobile_numbers_data = implode(',', $mobile_numbers);
        return $mobile_numbers_data;
    }

    public static function pilot_in_command($aircraft_callsign, $term) {
        $result = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                ->where('aircraft_callsign', $aircraft_callsign)
                ->where('is_pilot', '=', 1)
                ->distinct('pilot_master.name')
                ->orderBy('pilot_master.name', 'asc')
                ->select('pilot_master.name')
                ->get();
        return $result;
    }

    public static function get_pilot_details($pilot) {
        $result = CallsignInfoModel::where('pilot', '=', $pilot)->first();
        return $result;
    }

    public static function copilot($aircraft_callsign, $term) {
        $result = CallsignInfoModel::join('pilot_master', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                ->where('aircraft_callsign', $aircraft_callsign)
                ->where('is_copilot', '=', 1)
                ->distinct('pilot_master.name')
                ->orderBy('pilot_master.name', 'asc')
                ->select('pilot_master.name')
                ->get();
        return $result;
    }

    public static function get_pilot_data($aircraft_callsign, $name) {
        $aircraft_callsign = substr($aircraft_callsign, 0, 5);
        $name = trim($name);
        $result = PilotMasterModel::join('callsign_info', 'pilot_master.id', '=', 'callsign_info.pilot_master_id')
                ->where('aircraft_callsign', $aircraft_callsign)
                ->where('pilot_master.name', $name)
                ->select('pilot_master.name', 'pilot_master.email', 'pilot_master.mobile_number')
                ->first();
        return $result;
    }

    public static function callsign_info_count($aircraft_callsign) {
        $result = CallsignInfoModel::where('aircraft_callsign', $aircraft_callsign)
                ->where('is_active', 1)
                ->count();
        return $result;
    }

}
