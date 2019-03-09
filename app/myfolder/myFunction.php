<?php

namespace App\myfolder;

use App\Jobs\EquipmentChangeEmailJob;
use App\Jobs\FlightRuleChangeEmailJob;
use App\Jobs\FlyingTimeChangeEmailJob;
use App\Jobs\OtherChangesEmailJob;
use App\Jobs\SpeedChangeEmailJob;
use App\models\AerodromeMailsModel;
use App\models\CallSignMailsModel;
use App\models\FlightPlanDetailsModel;
use App\models\StationsModel;
use App\models\Station_Addresses_model;
use App\models\SunriseSunsetModel;
use App\models\SupportMailsModel;
use App\models\WatchHoursModel;
use App\models\notams\NotamsModel;
use App\User;
use Illuminate\Contracts\Bus\Dispatcher;
use Log;
use Mail;
use App\models\CallsignInfoModel;

class myFunction {

    public $bcc;
    public $cc;
    public $from;
    public $from_name;
    public $user_id;
    public $user_name;
    public $user_email;
    public $user_type;

//    public $environment;

    public function __construct() {
        // $this->bcc = env('BCC', "dev.eflight@pravahya.com");
        // $this->cc = env('CC', "dev.eflight@pravahya.com");
        $this->user_email = Auth::user()->email;
    }

    public static function from() {
        return "support@eflight.aero";
    }

    public static function from_name() {
        return "Support | EFLIGHT";
    }
    public static function navlog_test_preview_info($data) {
        $aircraft_callsign = $data['callsign'];
        $registration = $data['registration'];
        $departure_aerodrome = $data['departure'];
        $departure_time_hours = substr($data['dep_time'], 0, 2);
        $departure_time_minutes = substr($data['dep_time'], 2, 2);
        $destination_aerodrome = $data['destination'];
        $date_of_flight = date('d-M-Y', strtotime($data['flight_date']));
        $dep_airport_name = $data['dep_airport_name'];
        $dest_airport_name = $data['dest_airport_name'];
        $pax = $data['pax'];
        $load = $data['load'];
        $remarks = $data['remarks'];
        $dept_place = $data['dept_place'];
        $dest_place = $data['dest_place'];
        $dept_lat = $data['dept_lat'];
        $dest_lat = $data['dest_lat'];
        $remarks_change = $data["remarks_change"]==1 ? 'red' : ''; 
        $fuel_change = $data["fuel_change"]==1 ? 'red' : ''; 
        $load_change = $data["load_change"]==1 ? 'red' : ''; 
        $pax_change = $data["pax_change"]==1 ? 'red' : ''; 
        $registration_change = $data["registration_change"]==1 ? 'red' : '';
        $dep_time_change = $data["dep_time_change"]==1 ? 'red' : ''; 
        if ($data['fuel'] != 0)
            $fuel = $data['fuel'];
        else if ($data['min_max'] == 2)
            $fuel = 'MAX';
        elseif ($data['min_max'] == 1)
            $fuel = 'MIN';
        elseif ($data['min_max'] == 3)
            $fuel = 'NO REFUEL';
        else 
            $fuel="";
        $info = "";
        $info = $info . "<table style='width:100%;'>
                    <tr style='width:100%;'>
                    <td style='width:50%;'>CALL SIGN: <span class='uppercase fontweight'>$aircraft_callsign</span></td>
                     <td style='width:50%;'>DATE OF FLIGHT: <span class='uppercase fontweight'>$date_of_flight</span></td>
                  </table>
                  <table style='width:100%;'>
                     <tr style='width:100%;'>
                        
         <td style='width:50%;'>FROM: 
                          <span class='uppercase fontweight'>$departure_aerodrome";
        if ($dep_airport_name != "") {
            $info = $info . "<span class='uppercase fontweight'>
                               ($dep_airport_name)
                             </span>";
        }
        $info = $info . "</span>
                             </td>";                
        if($departure_time_hours!="")                
        $info = $info ."<td style='width:50%;'>DEP TIME: <span class='uppercase fontweight $dep_time_change'>$departure_time_hours$departure_time_minutes UTC</span></td>";
         $info = $info ."</tr>
                  </table>
                  <table style='width:100%;' >
                       <tr class='margintop' style='width:100%;'>
                         
                          <td style='width:50%;'>TO: 
                            <span class='uppercase fontweight'>$destination_aerodrome";
        if ($dest_airport_name != "") {
            $info = $info . "<span class='uppercase fontweight'>
                                       ($dest_airport_name)
                                     </span>";
        }
        $info = $info . "</span> 
                         </td>
                       </tr>
                   </table>";
        $info = $info ."<table style='width:100%;'>
                       <tr style='width:100%;'>";
        if($pax!="")
        $info = $info ."<td style='width:20%;'>PAX: <span class='uppercase fontweight $pax_change'>$pax</span></td>";
        if($load!="")
        $info = $info ."<td style='width:17%;'>CARGO: <span class='uppercase fontweight $load_change'>$load</span></td>";
        if($fuel!="")
        $info = $info ."<td style='width:25%;'>FUEL: <span class='uppercase fontweight $fuel_change'>$fuel</span></td>";
        $info = $info ."</tr>
                    </table>
                    ";
        if ($remarks != "" || ($registration!="" && ($aircraft_callsign !=$registration))) {
            $info = $info . "<table style='width:100%;margin-top:15px;margin-bottom:15px;'>
                                <tr style='width:100%;' style='width:100%;'>";
            if($remarks != ""){                    
             $info = $info ."<td style='width:100%;'>REMARKS: <span class='uppercase fontweight $remarks_change'>$remarks</span></td>";
            } 
            if($aircraft_callsign!=$registration){
            $info = $info . "<td style='width:50%;'>REGISTRATION: <span class='uppercase fontweight'>$registration</span></td>";
            }
            $info = $info ."</tr>   
                            </table>";
        }
        if ((isset($dest_place) && $dest_place!="") || (isset($dept_lat) && $dept_lat!="")) {
            $info = $info . "<table style='width:100%;margin-top:10px;'>
                       </table>";
        }
        if ((isset($dest_place) && $dest_place!="") || (isset($dept_place) && $dept_place!="")) {
            $info = $info . "<table style='width:100%;'>
                         <tr class='margintop' style='width:100%;'>";
            if (isset($dept_place) )
                $info = $info . "<td style='width:50%;'>DEP ZZZZ PLACE NAME: <span class='uppercase fontweight'>$dept_place</span></td>";
            if (isset($dest_place))
                $info = $info . "<td style='width:50%;'>DEST ZZZZ PLACE NAME: <span class='uppercase fontweight'>$dest_place</span></td>";
            $info = $info . "</tr></table>";
        }
        if ((isset($dept_lat) && $dept_lat!="") || (isset($dest_lat) && $dest_lat!="")) {

            $info = $info . "<table style='width:100%;'>
                          <tr class='margintop' style='width:100%;'>";
            if (isset($dept_lat))
                $info = $info . "<td style='width:50%;'>DEP ZZZZ LAT LONG: <span class='uppercase fontweight'>$dept_lat</span></td>";
            if (isset($dest_lat))
                $info = $info . "<td style='width:50%;'>DEST ZZZZ LAT LONG: <span class='uppercase fontweight'>$dest_lat</span></td>";
            $info = $info . "</tr></table>";
        }
        return $info;
    }  
    public static function navlog_preview_info($data) {
        $id = $data['id'];
        $flying_time=$data['flying_time'];
        $flying_hr=substr($flying_time,0,2);
        $border_red=$data['flying_time'] ? '' : 'border_red';
        $flying_min=substr($flying_time,2,2);
        $route=$data['route'];
        $altn=$data['altn'];
        $block_fuel=$data['block_fuel'] ? $data['block_fuel'] : '';
        $distance=$data['distance'] ? $data['distance'] : '';
        $navlog_load=$data['navlog_load'] ? $data['navlog_load'] : '';
        $min_fuel=$data['min_fuel'] ? $data['min_fuel'] : '';
        $max_fuel=$data['max_fuel'] ? $data['max_fuel'] : '';
        $altn_dis=$data['altn_dis'] ? $data['altn_dis'] : ''; 
        $aircraft_callsign = $data['callsign'];
        $registration = $data['registration'];
        $departure_aerodrome = $data['departure'];
        $departure_time_hours = substr($data['dep_time'], 0, 2);
        $departure_time_minutes = substr($data['dep_time'], 2, 2);
        $destination_aerodrome = $data['destination'];
        $date_of_flight = date('d-M-Y', strtotime($data['flight_date']));
        $dep_airport_name = $data['dep_airport_name'];
        $dest_airport_name = $data['dest_airport_name'];
        $pilot_in_command = $data['pilot'];
        $mobile_number = $data['mobile'];
        $copilot = $data['co_pilot'];
        $pax = $data['pax'];
        $load = $data['load'];
        $remarks = $data['remarks'];
        $main_route = $data['main_route'];
        $cabin = $data['cabin'];
        $speed = $data['speed'];
        $level1 = $data['level1'];
        $dept_place = $data['dept_place'];
        $dest_place = $data['dest_place'];
        $dept_lat = $data['dept_lat'];
        $dest_lat = $data['dest_lat'];
        $alternate1 = $data['alternate1'];
        $alt1_airport_name = $data['alt1_airport_name'];
        $level2 = $data['level2'];
        $alternate1route = $data['alternate1route'];
        $alternate2 = $data['alternate2'];
        $alt2_airport_name = $data['alt2_airport_name'];
        $level3 = $data['level3'];
        $alternate2route = $data['alternate2route'];
        $take_off_alternate = $data['take_off_alternate'];
        $level4 = $data['level4'];
        $take_off_alternate_route = $data['take_off_alternate_route'];
        $txtspeed = $data['txtspeed'];
        $speed_change = $data["speed_change"]==1 ? 'red' : '';
        $text_speed_change = $data["text_speed_change"]==1 ? 'red' : ''; 
        $level1_change = $data["level1_change"]==1 ? 'red' : '';
        $main_route_change = $data["main_route_change"]==1 ? 'red' : ''; 
        $alternate1_change = $data["alternate1_change"]==1 ? 'red' : '';
        $alternate2_change = $data["alternate2_change"]==1 ? 'red' : ''; 
        $remarks_change = $data["remarks_change"]==1 ? 'red' : ''; 
        $co_pilot_change = $data["co_pilot_change"]==1 ? 'red' : '';
        $mobile_change = $data["mobile_change"]==1 ? 'red' : ''; 
        $pilot_change = $data["pilot_change"]==1 ? 'red' : ''; 
        $take_off_alternate_route_change = $data["take_off_alternate_route_change"]==1 ? 'red' : '';
        $level4_change = $data["level4_change"]==1 ? 'red' : ''; 
        $fuel_change = $data["fuel_change"]==1 ? 'red' : ''; 
        $alternate2route_change = $data["alternate2route_change"]==1 ? 'red' : ''; 
        $level3_change = $data["level3_change"]==1 ? 'red' : ''; 
        $alternate1route_change = $data["alternate1route_change"]==1 ? 'red' : ''; 
        $level2_change = $data["level2_change"]==1 ? 'red' : ''; 
        $load_change = $data["load_change"]==1 ? 'red' : ''; 
        $pax_change = $data["pax_change"]==1 ? 'red' : ''; 
        $cabin_change = $data["cabin_change"]==1 ? 'red' : ''; 
        $take_off_altn_change = $data["take_off_altn_change"]==1 ? 'red' : ''; 
        $registration_change = $data["registration_change"]==1 ? 'red' : '';
        $dep_time_change = $data["dep_time_change"]==1 ? 'red' : ''; 
        
        $toff_airport_name = $data['toff_airport_name'];
        if ($data['fuel'] != 0)
            $fuel = $data['fuel'];
        else if ($data['min_max'] == 2)
            $fuel = 'MAX';
        elseif ($data['min_max'] == 1)
            $fuel = 'MIN';
        elseif ($data['min_max'] == 3)
            $fuel = 'NO REFUEL';
        $info = "";
        $info = $info . "<table style='width:100%;'>
                    <tr style='width:100%;'>
                    <td style='width:50%;'>CALL SIGN: <span class='uppercase fontweight'>$aircraft_callsign</span></td>
                    <td style='width:50%;'>DATE OF FLIGHT: <span class='uppercase fontweight'>$date_of_flight</span></td>
                  </table>
                  <table style='width:100%;'>
                     <tr style='width:100%;'>
                        <td style='width:50%;'>FROM: 
                            <span class='uppercase fontweight'>$departure_aerodrome";
                            if ($dep_airport_name != "") {
                                $info = $info . "<span class='uppercase fontweight'>
                                                   ($dep_airport_name)
                                                 </span>";
                            }
                            $info = $info . "</span>
                          </td>
                        <td style='width:50%;'>DEP TIME: <span class='uppercase fontweight $dep_time_change'>$departure_time_hours$departure_time_minutes UTC</span></td>
                     </tr>
                  </table>
                  <table style='width:100%;' >
                       <tr class='margintop' style='width:100%;'>

                          <td style='width:50%;'>TO: 
                            <span class='uppercase fontweight'>$destination_aerodrome";
        if ($dest_airport_name != "") {
            $info = $info . "<span class='uppercase fontweight'>
                                       ($dest_airport_name)
                                     </span>";
        }
        $info = $info . "</span> 
                         </td>
                       </tr>
                   </table>
                   <table style='width:100%;' class='margintop10'>
                       <tr class='margintop' style='width:100%;'>
                          <td style='width:50%;'>PIC: <span class='uppercase fontweight $pilot_change'>$pilot_in_command</span></td>
                          <td style='width:50%;'>CO-PILOT: <span class='uppercase fontweight $co_pilot_change'>$copilot</span></td>
                       </tr>
                    </table>
                    <table style='width:100%;' >
                       <tr style='width:100%;'>
                          <td style='width:22%;'>MOBILE: <span class='uppercase fontweight $mobile_change'>$mobile_number</span></td>
                          <td style='width:20%;'>PAX: <span class='uppercase fontweight $pax_change'>$pax</span></td>
                          <td style='width:17%;'>CARGO: <span class='uppercase fontweight $load_change'>$load</span></td>
                          <td style='width:25%;'>FUEL: <span class='uppercase fontweight $fuel_change'>$fuel</span></td>
                       </tr>
                    </table>
                    ";
        if (isset($cabin) || isset($speed) || $level1 != "" || isset($txtspeed)) {
            $info = $info . "<table style='width:100%;' class='margintop10'>
               <tr style='width:100%;'>";

            if ($level1 == '')
                $style = 'style=width:14%';
            else if (!isset($cabin))
                $style = 'style=width:17%';
            else
                $style = 'style=width:21%';

            if (!isset($speed))
                $level_style = 'style=width:14%;';
            else
                $level_style = 'style=width:19%;';
            if (isset($speed))
                $info = $info . "<td $style>SPEED: <span class='uppercase fontweight $speed_change'>$speed</span></td>";
            if (isset($txtspeed) && $txtspeed != '')
                $info = $info . "<td $style>SPEED: <span class='uppercase fontweight $text_speed_change'>$txtspeed</span></td>";

            if ($level1 != "")
                $info = $info . "<td $level_style>LEVEL: <span class='uppercase fontweight $level1_change'>$level1</span></td>";
            if (isset($cabin))
                $info = $info . "<td style='width:10%;'>CABIN: <span class='uppercase fontweight $cabin_change'>$cabin</span></td>";

            $info = $info . "<td style='width:30%;'></td>";
            $info = $info . "
               </tr>
               </table>";
        }
        if ($main_route != "") {
            $info = $info . "<table style='width:100%;' class='margintop'>
                                <tr style='width:100%;' style='width:100%;'>
                                    <td style='width:100%;'>MAIN ROUTE: <span class='uppercase fontweight 
                                    $main_route_change'>$main_route</span></td>
                                </tr>    
                            </table>";
        }
        if ($alternate1 != "" || $level2 != "" || $alternate1route != "") {
            $info = $info . "<table style='width:100%;' class='margintop10'>
                   <tr class='margintop' style='width:100%;'>";
            if ($alternate1 != "") {
                $info = $info . "<td style='width:50%;'>ALTN 1:
                                    <span class='uppercase fontweight $alternate1_change'>$alternate1 
                                    <span>";
                if ($alt1_airport_name != "")
                    $info = $info . "(" . $alt1_airport_name . ")";
                $info = $info . "</span></span></td>";
            }
            if ($level2 != "" || $alternate1route != "") {
                $info = $info . "<td style='width:50%;'>";
                if ($alternate1route != "")
                    $info = $info . "ALTN 1 ROUTE: ";
                if ($level2 != "") {
                    $info = $info . "<span>FL</span>
                            <span style='margin-left:2px;' class='uppercase fontweight $level2_change'>$level2 </span>";
                }
                if ($alternate1route != "")
                    $info = $info . "<span class='uppercase fontweight $alternate1route_change'>$alternate1route</span>";

                $info = $info . "</td>";
            }
            $info = $info . "</tr>
                        </table>";
        }
        if ($remarks != "" || ($registration!="" && ($aircraft_callsign !=$registration))) {
            $info = $info . "<table style='width:100%;margin-top:15px;margin-bottom:15px;'>
                                <tr style='width:100%;' style='width:100%;'>";
            if($remarks != ""){                    
            $info = $info . "<td style='width:50%;'>REMARKS: <span class='uppercase fontweight $remarks_change'>$remarks</span></td>";
            }
            if($aircraft_callsign!=$registration){
            $info = $info . "<td style='width:50%;'>REGISTRATION: <span class='uppercase fontweight'>$registration</span></td>";
            }
            $info = $info .  "</tr>   
                            </table>";
        }


        if ($alternate2 != "" || $level3 != "" || $alternate2route !== "") {
            $info = $info . "<table style='width:100%;'>
                       <tr class='margintop' style='width:100%;'>";
            if ($alternate2 != "") {
                $info = $info . "<td style='width:50%;'>ALTN 2:
                                        <span class='uppercase fontweight $alternate2_change'>$alternate2 
                                        <span>";
                if ($alt2_airport_name != "")
                    $info = $info . "(" . $alt2_airport_name . ")";
                $info = $info . "</span></span></td>";
            }
            if ($level3 != "" || $alternate2route != "") {
                $info = $info . "<td style='width:50%;'>";
                if ($alternate2route != "")
                    $info = $info . "ALTN 2 ROUTE: ";
                if ($level2 != "") {
                    $info = $info . "<span>FL</span>
                                <span style='margin-left:2px;' class='uppercase fontweight $level3_change'>$level3 </span>";
                }
                if ($alternate2route != "")
                    $info = $info . "<span class='uppercase fontweight $alternate2route_change'>$alternate2route</span>";

                $info = $info . "</td>";
            }
            $info = $info . "</tr>
                            </table>";
        }
        if ($take_off_alternate != '' || $level4 != '' || $take_off_alternate_route !== '') {
            $info = $info . "<table style='width:100%;'>
                        <tr style='width:100%;'>";
            if ($take_off_alternate != '') {
                $info = $info . "<td style='width:50%;'>T.OFF ALTN:
                               <span class='uppercase fontweight $take_off_altn_change'>$take_off_alternate
                               <span>";
                if ($toff_airport_name != '')
                    $info = $info . "(" . $toff_airport_name . ")";

                $info = $info . '</span></span></td>';
            }
            if ($level4 != '' || $take_off_alternate_route != '') {

                $info = $info . "<td style='width:50%;'>";
                if ($take_off_alternate_route != '')
                    $info = $info . "T. OFF ALTN ROUTE: ";
                if ($level4 != "") {
                    $info = $info . "<span>FL</span>
                               <span style='margin-left:2px;' class='uppercase fontweight $level4_change'>$level4 </span>";
                }
                if ($take_off_alternate_route != "")
                    $info = $info . "<span class='uppercase fontweight $take_off_alternate_route_change'>$take_off_alternate_route</span>";

                $info = $info . "</td>";
            }
            $info = $info . "</tr>
                     </table>";
        }
        if ((isset($dest_place) && $dest_place!="") || (isset($dept_lat) && $dept_lat!="")) {
            $info = $info . "<table style='width:100%;margin-top:10px;'>
                       </table>";
        }
        if ((isset($dest_place) && $dest_place!="") || (isset($dept_place) && $dept_place!="")) {
            $info = $info . "<table style='width:100%;'>
                         <tr class='margintop' style='width:100%;'>";
            if (isset($dept_place) )
                $info = $info . "<td style='width:50%;'>DEP ZZZZ PLACE NAME: <span class='uppercase fontweight'>$dept_place</span></td>";
            if (isset($dest_place))
                $info = $info . "<td style='width:50%;'>DEST ZZZZ PLACE NAME: <span class='uppercase fontweight'>$dest_place</span></td>";
            $info = $info . "</tr></table>";
        }
        if ((isset($dept_lat) && $dept_lat!="") || (isset($dest_lat) && $dest_lat!="")) {

            $info = $info . "<table style='width:100%;'>
                          <tr class='margintop' style='width:100%;'>";
            if (isset($dept_lat))
                $info = $info . "<td style='width:50%;'>DEP ZZZZ LAT LONG: <span class='uppercase fontweight'>$dept_lat</span></td>";
            if (isset($dest_lat))
                $info = $info . "<td style='width:50%;'>DEST ZZZZ LAT LONG: <span class='uppercase fontweight'>$dest_lat</span></td>";
            $info = $info . "</tr></table>";
        }
        if($block_fuel!=""){
        $info = $info . "<table style='width:100%;margin-top:10px'>
                          <tr style='width:100%;text-align:center'>
                            <td style='width:50%;font-weight: bold;color: red;'>
                              NAV LOG DETAILS
                            </td>
                        </tr>
                      </table>";
          $info = $info . "<form id='navlog_form' action='/navlog_info_update'><table style='width:100%;'>
                            <input type='hidden' name='id' value=$id> 
                            <tr style='width:100%;'>
                              <td style='width:50%;'>FLYING TIME: 
                                <span class='uppercase fontweight'>$flying_hr HOUR</span>
                                <span class='uppercase fontweight'>$flying_min MINS</span> 
                              </td>
                              <td style='width:50%;'>BLOCK FUEL: <span class='uppercase fontweight'>$block_fuel</span>
                              </td>
                          </tr>
                        </table>";
          $info = $info . "<table style='width:100%;'>
                            <tr style='width:100%;'>
                              <td style='width:50%;'>ROUTE: <span class='uppercase fontweight'>$route</span>
                              </td>
                          </tr>
                        </table>";
          $info = $info . "<table style='width:100%;'>
                            <tr style='width:100%;'>
                              <td style='width:50%;'>DISTANCE: 
                                <span class='uppercase fontweight'>$distance</span>
                              </td>
                              <td style='width:50%;'>LOAD: <span class='uppercase fontweight'>$navlog_load</span>
                              </td>
                          </tr>
                        </table>";  
          $info = $info . "<table style='width:100%;'>
                            <tr style='width:100%;'>
                              <td style='width:50%;'>MIN FUEL: 
                                <span class='uppercase fontweight'>$min_fuel</span>
                              </td>
                              <td style='width:50%;'>MAX FUEL: <span class='uppercase fontweight'>$max_fuel</span>
                              </td>
                          </tr>
                        </table>";  

        $info = $info . "<table style='width:100%;'>
                          <tr style='width:100%;'>
                            <td style='width:50%;'>ALTN: 
                              <span class='uppercase fontweight'>$altn</span>
                            </td>
                            <td style='width:50%;'>ALTN DISTANCE:<span class='uppercase fontweight'>$altn_dis</span>
                            </td>
                        </tr>
                      </table></form"; 
        }                       
        return $info;
    }
    public static function navlog_info($data) {
        $id = $data['id'];
        $flying_time=$data['flying_time'];
        $flying_hr=substr($flying_time,0,2);
        $border_red=$data['flying_time'] ? '' : 'border_red';
        $flying_min=substr($flying_time,2,2);
        $route=$data['route'];
        $altn=$data['altn'];
        $block_fuel=$data['block_fuel'] ? $data['block_fuel'] : '';
        $distance=$data['distance'] ? $data['distance'] : '';
        $navlog_load=$data['navlog_load'] ? $data['navlog_load'] : '';
        $min_fuel=$data['min_fuel'] ? $data['min_fuel'] : '';
        $max_fuel=$data['max_fuel'] ? $data['max_fuel'] : '';
        $altn_dis=$data['altn_dis'] ? $data['altn_dis'] : '';
        $aircraft_callsign = $data['callsign'];
        $registration = $data['registration'];
        $departure_aerodrome = $data['departure'];
        $departure_time_hours = substr($data['dep_time'], 0, 2);
        $departure_time_minutes = substr($data['dep_time'], 2, 2);
        $destination_aerodrome = $data['destination'];
        $date_of_flight = date('d-M-Y', strtotime($data['flight_date']));
        $dep_airport_name = $data['dep_airport_name'];
        $dest_airport_name = $data['dest_airport_name'];
        $pilot_in_command = $data['pilot'];
        $mobile_number = $data['mobile'];
        $copilot = $data['co_pilot'];
        $pax = $data['pax'];
        $load = $data['load'];
        $remarks = $data['remarks'];
        $main_route = $data['main_route'];
        $cabin = $data['cabin'];
        $speed = $data['speed'];
        $level1 = $data['level1'];
        $dept_place = $data['dept_place'];
        $dest_place = $data['dest_place'];
        $dept_lat = $data['dept_lat'];
        $dest_lat = $data['dest_lat'];
        $alternate1 = $data['alternate1'];
        $alt1_airport_name = $data['alt1_airport_name'];
        $level2 = $data['level2'];
        $alternate1route = $data['alternate1route'];
        $alternate2 = $data['alternate2'];
        $alt2_airport_name = $data['alt2_airport_name'];
        $level3 = $data['level3'];
        $alternate2route = $data['alternate2route'];
        $take_off_alternate = $data['take_off_alternate'];
        $level4 = $data['level4'];
        $take_off_alternate_route = $data['take_off_alternate_route'];
        $txtspeed = $data['txtspeed'];
        $speed_change = $data["speed_change"]==1 ? 'red' : '';
        $text_speed_change = $data["text_speed_change"]==1 ? 'red' : ''; 
        $level1_change = $data["level1_change"]==1 ? 'red' : '';
        $main_route_change = $data["main_route_change"]==1 ? 'red' : ''; 
        $alternate1_change = $data["alternate1_change"]==1 ? 'red' : '';
        $alternate2_change = $data["alternate2_change"]==1 ? 'red' : ''; 
        $remarks_change = $data["remarks_change"]==1 ? 'red' : ''; 
        $co_pilot_change = $data["co_pilot_change"]==1 ? 'red' : '';
        $mobile_change = $data["mobile_change"]==1 ? 'red' : ''; 
        $pilot_change = $data["pilot_change"]==1 ? 'red' : ''; 
        $take_off_alternate_route_change = $data["take_off_alternate_route_change"]==1 ? 'red' : '';
        $level4_change = $data["level4_change"]==1 ? 'red' : ''; 
        $fuel_change = $data["fuel_change"]==1 ? 'red' : ''; 
        $alternate2route_change = $data["alternate2route_change"]==1 ? 'red' : ''; 
        $level3_change = $data["level3_change"]==1 ? 'red' : ''; 
        $alternate1route_change = $data["alternate1route_change"]==1 ? 'red' : ''; 
        $level2_change = $data["level2_change"]==1 ? 'red' : ''; 
        $load_change = $data["load_change"]==1 ? 'red' : ''; 
        $pax_change = $data["pax_change"]==1 ? 'red' : ''; 
        $cabin_change = $data["cabin_change"]==1 ? 'red' : ''; 
        $take_off_altn_change = $data["take_off_altn_change"]==1 ? 'red' : ''; 
        $registration_change = $data["registration_change"]==1 ? 'red' : '';
        $dep_time_change = $data["dep_time_change"]==1 ? 'red' : ''; 
        
        $toff_airport_name = $data['toff_airport_name'];
        if ($data['fuel'] != 0)
            $fuel = $data['fuel'];
        else if ($data['min_max'] == 2)
            $fuel = 'MAX';
        elseif ($data['min_max'] == 1)
            $fuel = 'MIN';
        elseif ($data['min_max'] == 3)
            $fuel = 'NO REFUEL';
        $info = "";
        $info = $info . "<table style='width:100%;'>
                    <tr style='width:100%;'>
                    <td style='width:50%;'>CALL SIGN: <span class='uppercase fontweight'>$aircraft_callsign</span></td>
                    <td style='width:50%;'>REGISTRATION: <span class='uppercase fontweight $registration_change'>$registration</span></td></tr>
                  </table>
                  <table style='width:100%;'>
                     <tr style='width:100%;'>
                        <td style='width:50%;'>DATE OF FLIGHT: <span class='uppercase fontweight'>$date_of_flight</span></td>
                        <td style='width:50%;'>DEP TIME: <span class='uppercase fontweight $dep_time_change'>$departure_time_hours$departure_time_minutes UTC</span></td>
                     </tr>
                  </table>
                  <table style='width:100%;' >
                       <tr class='margintop' style='width:100%;'>
                          <td style='width:50%;'>FROM: 
                          <span class='uppercase fontweight'>$departure_aerodrome";
        if ($dep_airport_name != "") {
            $info = $info . "<span class='uppercase fontweight'>
                               ($dep_airport_name)
                             </span>";
        }
        $info = $info . "</span>
                             </td>
                          <td style='width:50%;'>TO: 
                            <span class='uppercase fontweight'>$destination_aerodrome";
        if ($dest_airport_name != "") {
            $info = $info . "<span class='uppercase fontweight'>
                                       ($dest_airport_name)
                                     </span>";
        }
        $info = $info . "</span> 
                         </td>
                       </tr>
                   </table>
                   <table style='width:100%;' class='margintop10'>
                       <tr class='margintop' style='width:100%;'>
                          <td style='width:50%;'>PIC: <span class='uppercase fontweight $pilot_change'>$pilot_in_command</span></td>
                          <td style='width:50%;'>CO-PILOT: <span class='uppercase fontweight $co_pilot_change'>$copilot</span></td>
                       </tr>
                    </table>
                    <table style='width:100%;' >
                       <tr style='width:100%;'>
                          <td style='width:22%;'>MOBILE: <span class='uppercase fontweight $mobile_change'>$mobile_number</span></td>
                          <td style='width:20%;'>PAX: <span class='uppercase fontweight $pax_change'>$pax</span></td>
                          <td style='width:17%;'>CARGO: <span class='uppercase fontweight $load_change'>$load</span></td>
                          <td style='width:25%;'>FUEL: <span class='uppercase fontweight $fuel_change'>$fuel</span></td>
                       </tr>
                    </table>
                    ";
        if (isset($cabin) || isset($speed) || $level1 != "" || isset($txtspeed)) {
            $info = $info . "<table style='width:100%;' class='margintop10'>
               <tr style='width:100%;'>";

            if ($level1 == '')
                $style = 'style=width:14%';
            else if (!isset($cabin))
                $style = 'style=width:17%';
            else
                $style = 'style=width:21%';

            if (!isset($speed))
                $level_style = 'style=width:14%;';
            else
                $level_style = 'style=width:19%;';
            if (isset($speed))
                $info = $info . "<td $style>SPEED: <span class='uppercase fontweight $speed_change'>$speed</span></td>";
            if (isset($txtspeed) && $txtspeed != '')
                $info = $info . "<td $style>SPEED: <span class='uppercase fontweight $text_speed_change'>$txtspeed</span></td>";

            if ($level1 != "")
                $info = $info . "<td $level_style>LEVEL: <span class='uppercase fontweight $level1_change'>$level1</span></td>";
            if (isset($cabin))
                $info = $info . "<td style='width:10%;'>CABIN: <span class='uppercase fontweight $cabin_change'>$cabin</span></td>";

            $info = $info . "<td style='width:30%;'></td>";
            $info = $info . "
               </tr>
               </table>";
        }
        if ($main_route != "") {
            $info = $info . "<table style='width:100%;' class='margintop'>
                                <tr style='width:100%;' style='width:100%;'>
                                    <td style='width:100%;'>MAIN ROUTE: <span class='uppercase fontweight 
                                    $main_route_change'>$main_route</span></td>
                                </tr>    
                            </table>";
        }
        if ($alternate1 != "" || $level2 != "" || $alternate1route != "") {
            $info = $info . "<table style='width:100%;' class='margintop10'>
                   <tr class='margintop' style='width:100%;'>";
            if ($alternate1 != "") {
                $info = $info . "<td style='width:50%;'>ALTN 1:
                                    <span class='uppercase fontweight $alternate1_change'>$alternate1 
                                    <span>";
                if ($alt1_airport_name != "")
                    $info = $info . "(" . $alt1_airport_name . ")";
                $info = $info . "</span></span></td>";
            }
            if ($level2 != "" || $alternate1route != "") {
                $info = $info . "<td style='width:50%;'>";
                if ($alternate1route != "")
                    $info = $info . "ALTN 1 ROUTE: ";
                if ($level2 != "") {
                    $info = $info . "<span>FL</span>
                            <span style='margin-left:2px;' class='uppercase fontweight $level2_change'>$level2 </span>";
                }
                if ($alternate1route != "")
                    $info = $info . "<span class='uppercase fontweight $alternate1route_change'>$alternate1route</span>";

                $info = $info . "</td>";
            }
            $info = $info . "</tr>
                        </table>";
        }
        if ($remarks != "") {
            $info = $info . "<table style='width:100%;margin-top:15px;margin-bottom:15px;'>
                                <tr style='width:100%;' style='width:100%;'>
                                    <td style='width:100%;'>REMARKS: <span class='uppercase fontweight $remarks_change'>$remarks</span></td>
                                </tr>   
                            </table>";
        }


        if ($alternate2 != "" || $level3 != "" || $alternate2route !== "") {
            $info = $info . "<table style='width:100%;'>
                       <tr class='margintop' style='width:100%;'>";
            if ($alternate2 != "") {
                $info = $info . "<td style='width:50%;'>ALTN 2:
                                        <span class='uppercase fontweight $alternate2_change'>$alternate2 
                                        <span>";
                if ($alt2_airport_name != "")
                    $info = $info . "(" . $alt2_airport_name . ")";
                $info = $info . "</span></span></td>";
            }
            if ($level3 != "" || $alternate2route != "") {
                $info = $info . "<td style='width:50%;'>";
                if ($alternate2route != "")
                    $info = $info . "ALTN 2 ROUTE: ";
                if ($level2 != "") {
                    $info = $info . "<span>FL</span>
                                <span style='margin-left:2px;' class='uppercase fontweight $level3_change'>$level3 </span>";
                }
                if ($alternate2route != "")
                    $info = $info . "<span class='uppercase fontweight $alternate2route_change'>$alternate2route</span>";

                $info = $info . "</td>";
            }
            $info = $info . "</tr>
                            </table>";
        }
        if ($take_off_alternate != '' || $level4 != '' || $take_off_alternate_route !== '') {
            $info = $info . "<table style='width:100%;'>
                        <tr style='width:100%;'>";
            if ($take_off_alternate != '') {
                $info = $info . "<td style='width:50%;'>T.OFF ALTN:
                               <span class='uppercase fontweight $take_off_altn_change'>$take_off_alternate
                               <span>";
                if ($toff_airport_name != '')
                    $info = $info . "(" . $toff_airport_name . ")";

                $info = $info . '</span></span></td>';
            }
            if ($level4 != '' || $take_off_alternate_route != '') {

                $info = $info . "<td style='width:50%;'>";
                if ($take_off_alternate_route != '')
                    $info = $info . "T. OFF ALTN ROUTE: ";
                if ($level4 != "") {
                    $info = $info . "<span>FL</span>
                               <span style='margin-left:2px;' class='uppercase fontweight $level4_change'>$level4 </span>";
                }
                if ($take_off_alternate_route != "")
                    $info = $info . "<span class='uppercase fontweight $take_off_alternate_route_change'>$take_off_alternate_route</span>";

                $info = $info . "</td>";
            }
            $info = $info . "</tr>
                     </table>";
        }
        if ((isset($dest_place) && $dest_place!="") || (isset($dept_lat) && $dept_lat!="")) {
            $info = $info . "<table style='width:100%;margin-top:10px;'>
                       </table>";
        }
        if ((isset($dest_place) && $dest_place!="") || (isset($dept_place) && $dept_place!="")) {
            $info = $info . "<table style='width:100%;'>
                         <tr class='margintop' style='width:100%;'>";
            if (isset($dept_place) )
                $info = $info . "<td style='width:50%;'>DEP ZZZZ PLACE NAME: <span class='uppercase fontweight'>$dept_place</span></td>";
            if (isset($dest_place))
                $info = $info . "<td style='width:50%;'>DEST ZZZZ PLACE NAME: <span class='uppercase fontweight'>$dest_place</span></td>";
            $info = $info . "</tr></table>";
        }
        if ((isset($dept_lat) && $dept_lat!="") || (isset($dest_lat) && $dest_lat!="")) {

            $info = $info . "<table style='width:100%;'>
                          <tr class='margintop' style='width:100%;'>";
            if (isset($dept_lat))
                $info = $info . "<td style='width:50%;'>DEP ZZZZ LAT LONG: <span class='uppercase fontweight'>$dept_lat</span></td>";
            if (isset($dest_lat))
                $info = $info . "<td style='width:50%;'>DEST ZZZZ LAT LONG: <span class='uppercase fontweight'>$dest_lat</span></td>";
            $info = $info . "</tr></table>";
        }
        $info = $info . "<table style='width:100%;margin-top:10px'>
                          <tr style='width:100%;text-align:center'>
                            <td style='width:50%;font-weight: bold;color: red;'>
                              NAV LOG DETAILS
                            </td>
                        </tr>
                      </table>";
        $info = $info . "<form id='navlog_form' action='/navlog_info_update'><table style='width:100%;'>
                          <input type='hidden' name='id' value=$id> 
                          <tr style='width:100%;'>
                            <td style='width:50%;'>FLYING TIME: 
                              <input type='text' id='flying_hr' maxlength='2' style='padding-left: 10px;display: inline-block;'  class='mini_input numeric $border_red' autocomplete='off' placeholder='HH'  name='flying_hr' data-toggle='popover' data-placement='top' value='$flying_hr'>
                               <div style='display:inline-block;' class='slash'>:</div>
                              <input style='padding-left: 10px;display:inline-block' type='text' maxlength='2' class='mini_input numeric  $border_red' id='flying_min' placeholder='MM' autocomplete='off'  name='flying_min' data-toggle='popover' data-placement='top' value='$flying_min'>
                            </td>
                            <td style='width:50%;'>BLOCK FUEL: <span><input class='input_blod numbers $border_red' maxlength='5' id='navlog_block_fuel' type='text'  name='block_fuel' autocomplete='off' style='width:15%;display: inline-block;' data-toggle='popover' data-placement='top' value='$block_fuel'></span>
                            </td>
                        </tr>
                      </table>";
        $info = $info . "<table style='width:100%;'>
                          <tr style='width:100%;'>
                            <td style='width:50%;'>ROUTE: <span><input class='input_blod special_symbols1 $border_red' maxlength='250' id='route' type='text'  name='route' autocomplete='off' style='width:90%;display: inline-block;' data-toggle='popover' data-placement='top' value='$route'></span>
                            </td>
                        </tr>
                      </table>";
        $info = $info . "<table style='width:100%;'>
                          <tr style='width:100%;'>
                            <td style='width:50%;'>DISTANCE: 
                              <span><input class='input_blod numbers $border_red' maxlength='4' id='distance' type='text' name='distance' autocomplete='off' style='width:15%;display: inline-block;' data-toggle='popover' data-placement='top' value='$distance'></span>
                            </td>
                            <td style='width:50%;'>LOAD: <span><input class='input_blod numbers $border_red' maxlength='5' id='navlog_load' type='text' name='navlog_load' autocomplete='off' style='width:15%;display: inline-block;' data-toggle='popover' data-placement='top' value='$navlog_load'></span>
                            </td>
                        </tr>
                      </table>";  
        $info = $info . "<table style='width:100%;'>
                          <tr style='width:100%;'>
                            <td style='width:50%;'>MIN FUEL: 
                              <span><input class='input_blod numbers $border_red' maxlength='5' id='navlog_min_fuel' type='text'  name='min_fuel' autocomplete='off' style='width:15%;display: inline-block;' data-toggle='popover' data-placement='top' value='$min_fuel'></span>
                            </td>
                            <td style='width:50%;'>MAX FUEL: <span><input class='input_blod numbers $border_red' maxlength='5' id='navlog_max_fuel' type='text'  name='max_fuel' autocomplete='off' style='width:15%;display: inline-block;' data-toggle='popover' data-placement='top' value='$max_fuel'></span>
                            </td>
                        </tr>
                      </table>";  

      $info = $info . "<table style='width:100%;'>
                        <tr style='width:100%;'>
                          <td style='width:50%;'>ALTN: 
                            <span><input class='input_blod alphabets $border_red' maxlength='4' id='altn' type='text'  name='altn' autocomplete='off' style='width:15%;display: inline-block;' data-toggle='popover' data-placement='top' value='$altn'></span>
                          </td>
                          <td style='width:30%;'>ALTN DISTANCE: <span><input class='input_blod numbers $border_red' maxlength='4' id='altn_dis' type='text'  name='altn_dis' autocomplete='off' style='width:25%;display: inline-block;' data-toggle='popover' data-placement='top' value='$altn_dis'></span>
                          </td>
                          <td style='width:20%;'>
                          <button class='btn newbtnv1' id='navlog_submit' type='submit' name='submit' disabled>SUBMIT</button>
                          </td>
                      </tr>
                    </table></form";                                    
        return $info;
    }
    public static function fpl_atc_info($data) {
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $cabincrew = $data['cabincrew'];
        $crushing_speed_indication = $data['crushing_speed_indication'];
        $crushing_speed = $data['crushing_speed'];
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
        $flight_level_indication = $data['flight_level_indication'];
        $flight_level = $data['flight_level'];
        $first_alternate_aerodrome = $data['first_alternate_aerodrome'];
        $second_alternate_aerodrome = $data['second_alternate_aerodrome'];

        $total_flying_hours = (array_key_exists('total_flying_hours', $data)) ? $data['total_flying_hours'] : '';
        $total_flying_minutes = (array_key_exists('total_flying_minutes', $data)) ? $data['total_flying_minutes'] : '';


        $is_watch_enabled = \App\models\SupportMailsModel::where('id', 2)->where('is_active', 1)->count();
        $alternate_aero1 = '';
        $alternate_aero2 = '';

//        if ($is_watch_enabled) {
        $dept_time = $departure_time_hours . '' . $departure_time_minutes;
        $alternate_time1 = $dept_time + ($total_flying_hours . '' . $total_flying_minutes) + 30;

        $is_watch_hour_valid1 = WatchHoursModel::check_watch_hours($departure_aerodrome, $date_of_flight, $dept_time);
        $tooltip1 = myFunction::watch_hours_tooltip2($departure_aerodrome, $date_of_flight);

//      $destination_time2 = $dept_time + ($total_flying_hours . '' . $total_flying_minutes);
        $time = "$departure_time_hours:$departure_time_minutes:00";
        $time2 = "$total_flying_hours:$total_flying_minutes:00";
        $secs = strtotime($time2) - strtotime("00:00:00");
        $destination_time2 = date("Hi", strtotime($time) + $secs);

        $is_watch_hour_valid2 = WatchHoursModel::check_watch_hours($destination_aerodrome, $date_of_flight, $destination_time2);
        $tooltip2 = myFunction::watch_hours_tooltip2($destination_aerodrome, $date_of_flight);

        if ($is_watch_hour_valid1) {
            $entered_departure_time = $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes;
        } else {
            $entered_departure_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="' . $tooltip1 . '">' . $departure_aerodrome . "" . $departure_time_hours . '' . $departure_time_minutes . '</span>';
        }
        if ($is_watch_hour_valid2) {
            $entered_destination_time = $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes;
        } else {
            $entered_destination_time = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="' . $tooltip2 . '">' . $destination_aerodrome . "" . $total_flying_hours . "" . $total_flying_minutes . '</span>';
        }

        $is_watch_hour_valid3 = WatchHoursModel::check_watch_hours($first_alternate_aerodrome, $date_of_flight, $alternate_time1);
        $tooltip3 = myFunction::watch_hours_tooltip2($first_alternate_aerodrome, $date_of_flight);

        $is_watch_hour_valid4 = WatchHoursModel::check_watch_hours($second_alternate_aerodrome, $date_of_flight, $alternate_time1);
        $tooltip4 = myFunction::watch_hours_tooltip2($second_alternate_aerodrome, $date_of_flight);


        if ($is_watch_hour_valid3) {
            $alternate_aero1 = $first_alternate_aerodrome;
        } else {
            $alternate_aero1 = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="' . $tooltip3 . '">' . $first_alternate_aerodrome . '</span>';
        }

        if ($is_watch_hour_valid4) {
            $alternate_aero2 = $second_alternate_aerodrome;
        } else {
            $alternate_aero2 = '<span class="watch_hour_popover" style="color:#f1292b" data-toggle = "popover"  data-placement="top" data-trigger="hover" data-content="' . $tooltip4 . '">' . $second_alternate_aerodrome . '</span>';
        }
//        }

        $route = $data['route'];
        $remarks = $data['remarks'];

        if ($destination_aerodrome == 'VAPO') {
            $remarks_value = ' RMK/ARRIVAL COORDINATED WITH PUNE ATC ' . $remarks;
        } else {
            $remarks_value = ($remarks) ? ' RMK/' . $remarks : ' RMK/';
        }

        $endurance_hours = $data['endurance_hours'];
        $endurance_minutes = $data['endurance_minutes'];
        $flight_rules = $data['flight_rules'];
        $flight_type = $data['flight_type'];
        $aircraft_type = $data['aircraft_type'];
        $weight_category = $data['weight_category'];
        $equipment = $data['equipment'];

        if (strpos($equipment, '/') === FALSE) {
            $transponder = ($data['transponder']) ? '/' . $data['transponder'] : '';
        } else {
            $transponder = ($data['transponder']) ? $data['transponder'] : '';
        }

        $entered_departure_time = (isset($entered_departure_time)) ? $entered_departure_time : $data['entered_departure_time'];
        $entered_destination_time = (isset($entered_destination_time)) ? $entered_destination_time : $data['entered_destination_time'];
        $pbn = $data['pbn'];
        $nav = $data['nav'];
        $registration = $data['registration'];
        $fir_crossing_time = $data['fir_crossing_time'];
        $code = $data['code'];
        $sel = $data['sel'];
        $operator = $data['operator'];
        $per = $data['per'];
        $alternate_station = '';
        if ($first_alternate_aerodrome == 'ZZZZ' || $second_alternate_aerodrome == 'ZZZZ') {
            $alternate_station = 'ALL OPEN SPACES AND HELIPAD ENROUTE';
        }
        $take_off_altn = $data['take_off_altn'];
        $route_altn = $data['route_altn'];
        $tcas = $data['tcas'];
        $credit = $data['credit'];
        $indian = $data['indian'];
        $foreigner = $data['foreigner'];
        $foreigner_nationality = $data['foreigner_nationality'];
        $emergency_uhf = $data['emergency_uhf'];
        $emergency_vhf = $data['emergency_vhf'];
        $emergency_elba = $data['emergency_elba'];
        $polar = $data['polar'];
        $desert = $data['desert'];
        $maritime = $data['maritime'];
        $jungle = $data['jungle'];
        $light = $data['light'];
        $floures = $data['floures'];
        $jacket_uhf = $data['jacket_uhf'];
        $jacket_vhf = $data['jacket_vhf'];
        $number = $data['number'];
        $capacity = $data['capacity'];
        $cover = $data['cover'];
        $color = strtoupper($data['color']);
        $aircraft_color = strtoupper($data['aircraft_color']);
        $pbn_value = ($pbn) ? "PBN/" . $pbn . " " : '';
        $nav_value = ($nav) ? "NAV/" . $nav . " " : '';
        $dep_station_details = ($departure_aerodrome == "ZZZZ") ? "DEP/" . $departure_latlong . " " . $departure_station . "<br>" : '';
        $dest_station_details = ($destination_aerodrome == "ZZZZ") ? "DEST/" . $destination_latlong . " " . $destination_station . " " : "";
        $fir_crossing_time_value = ($fir_crossing_time) ? "<br>EET/" . $fir_crossing_time . " " : '';
        $code_value = ($code) ? " CODE/" . $code . "" : '';
        $sel_value = ($sel) ? " SEL/" . $sel . "" : '';
        $per_value = ($per) ? " PER/" . $per . "" : '';
        $alternate_station_value = ($alternate_station) ? " ALTN/" . $alternate_station . "" : '';
        $take_off_altn_value = ($take_off_altn) ? " TALT/" . $take_off_altn . "" : '';
        $route_altn_value = ($route_altn) ? " RALT/" . $route_altn . "" : '';
        $tcas_value = ($tcas == 'YES') ? " TCAS EQUIPPED" : '';

        if(substr($aircraft_callsign, 0, 5)=="VTRNK"||substr($aircraft_callsign, 0, 5)=="VTCLN"||substr($aircraft_callsign, 0, 5)=="VTCLR"||substr($aircraft_callsign, 0, 5)=="VTABY" ||substr($aircraft_callsign, 0, 5)=="VTBPO" ||substr($aircraft_callsign, 0, 5)=="VTVCA")
         $credit_value='';
        else    
         $credit_value = ($credit == "YES") ? " CREDIT FACILITY AVAILABLE WITH AAI" : ' NO CREDIT FACILITY';

        $foreigner_value_callsigns = ['VTOBR', 'VTVRL', 'VTANF', 'VTVAM', 'VTVAK', 'VTZOA', 'VTCLN', 'VTCLR', 'VTRNK','VTEQK'];

        $callsigns_text_not = ['VTCLN', 'VTCLR', 'VTRNK'];
        if (in_array(substr($aircraft_callsign, 0, 5), $callsigns_text_not)) {
            $callsigns_text_not = 0;
        } else {
            $callsigns_text_not = 1;
        }

        if (in_array(substr($aircraft_callsign, 0, 5), $foreigner_value_callsigns) || substr($aircraft_callsign, 0, 2) == 'ZO') {
            $display_all_indians = 0;
        } else {
            $display_all_indians = 1;
        }



        $indian_value = ($indian == "YES" && $display_all_indians) ? "ALL INDIANS ON BOARD " : '';

        $foreigner_value = ($foreigner == "YES" && $callsigns_text_not) ? " FOREIGNER ON BOARD " . $foreigner_nationality : '';
        $cabin_value = ($cabincrew) ? "CABIN CREW: " . $cabincrew . "<br>" : '';
        $uhf_value = ($emergency_uhf == "NO") ? "UHF, " : '';
        $vhf_value = ($emergency_vhf == "NO") ? "VHF, " : '';
        $elba_value = ($emergency_elba == "NO") ? "ELBA" : '';
        $emergency_values = "EMERGENCY RADIO: " . $uhf_value . "" . $vhf_value . "" . $elba_value;
        $emergency_values = trim($emergency_values, ' , ');
        $polar_value = ($polar == "NO") ? "POLAR, " : '';
        $desert_value = ($desert == "NO") ? "DESERT, " : '';
        $maritime_value = ($maritime == "NO") ? "MARITIME, " : '';
        $jungle_value = ($jungle == "NO") ? "JUNGLE" : '';
        $survival_equipment_values = "SURVIVAL EQUIPMENT: " . $polar_value . "" . $desert_value . "" . $maritime_value . "" . $jungle_value;
        $survival_equipment_values = trim($survival_equipment_values, ' , ');
        $jacket_uhf_value = ($jacket_uhf == "NO") ? "UHF, " : '';
        $jacket_vhf_value = ($jacket_vhf == "NO") ? "VHF, " : '';
        $light_value = ($light == "NO") ? "LIGHT, " : '';
        $floures_value = ($floures == "NO") ? "FLUORES" : '';
        $jacket_values = $jacket_uhf_value . "" . $jacket_vhf_value . "" . $light_value . "" . $floures_value;
        $jacket_values = trim($jacket_values, ' , ');
        $number_val = ($number) ? "DINGHIES: " . $number : '';
        $capacity_val = ($capacity) ? "<span style='padding-left:10px'>CAPACITY:</span> " . $capacity . "<br>" : '';
        $cover_val = ($cover == "NO") ? "COVER: " . $cover : '';
        $color_val = ($color) ? "DINGHIES COLOUR: " . $color : '';
        $aircraft_color_val = ($aircraft_color) ? "AIRCRAFT COLOUR & MARKINGS: " . $aircraft_color : '';

        $fpl_info = "(FPL-" . $aircraft_callsign . "-" . $flight_rules . "" . $flight_type .
                "<br>-" . $aircraft_type . "/" . $weight_category . "-" . $equipment . "" . $transponder .
                "<br>-" . $entered_departure_time .
                "<br>-" . $crushing_speed_indication . "" . $crushing_speed . $flight_level_indication . "" . $flight_level . " " . $route .
                "<br>-" . $entered_destination_time . " " . $alternate_aero1 . " " . $alternate_aero2 .
                "<br>-" . $pbn_value . "" . $nav_value . "" . $dep_station_details . "" . $dest_station_details . "DOF/" . $date_of_flight . " REG/" . $registration . "" .
                $fir_crossing_time_value . "" . $code_value . "" . $sel_value . " OPR/" . $operator . "" . $alternate_station_value . $per_value . "" .
                "" . $take_off_altn_value . "" . $route_altn_value . " <br>" . $remarks_value . " " . $tcas_value . "" . $credit_value . " PIC " . $pilot_in_command . "" .
                " MOB " . $mobile_number . " " . $indian_value . "" . $foreigner_value . " ENDURANCE " . $endurance_hours . "" . $endurance_minutes . ")";

        return $fpl_info;
    }

    public static function supplementary_info($data) {
        $copilot = $data['copilot'];
        $cabincrew = $data['cabincrew'];
        $emergency_uhf = $data['emergency_uhf'];
        $emergency_vhf = $data['emergency_vhf'];
        $emergency_elba = $data['emergency_elba'];
        $polar = $data['polar'];
        $desert = $data['desert'];
        $maritime = $data['maritime'];
        $jungle = $data['jungle'];
        $light = $data['light'];
        $floures = $data['floures'];
        $jacket_uhf = $data['jacket_uhf'];
        $jacket_vhf = $data['jacket_vhf'];
        $number = $data['number'];
        $capacity = $data['capacity'];
        $cover = $data['cover'];
        $color = $data['color'];
        $aircraft_color = $data['aircraft_color'];

        $cabin_value = ($cabincrew) ? "CABIN CREW: " . $cabincrew : 'CABIN CREW: NA';
        $uhf_value = ($emergency_uhf == "YES") ? "UHF, " : '';
        $vhf_value = ($emergency_vhf == "YES") ? "VHF, " : '';
        $elba_value = ($emergency_elba == "YES") ? "ELBA" : '';
        $emergency_values = "EMERGENCY RADIO: " . $uhf_value . "" . $vhf_value . "" . $elba_value;
        $emergency_values = trim($emergency_values, ' , ');
        $polar_value = ($polar == "YES") ? "POLAR, " : '';
        $desert_value = ($desert == "YES") ? "DESERT, " : '';
        $maritime_value = ($maritime == "YES") ? "MARITIME, " : '';
        $jungle_value = ($jungle == "YES") ? "JUNGLE" : '';
        $survival_equipment_values = "SURVIVAL EQUIPMENT: " . $polar_value . "" . $desert_value . "" . $maritime_value . "" . $jungle_value;
        $survival_equipment_values = trim($survival_equipment_values, ' , ');
        $jacket_uhf_value = ($jacket_uhf == "YES") ? "UHF, " : '';
        $jacket_vhf_value = ($jacket_vhf == "YES") ? "VHF, " : '';
        $light_value = ($light == "YES") ? "LIGHT, " : '';
        $floures_value = ($floures == "YES") ? "FLUORES" : '';
        $jacket_values = '';
//  if ($jacket_uhf_value == 'YES' || $jacket_vhf_value == 'YES' || $light_value == 'YES' || $floures_value == 'YES') {
        $jacket_values = "JACKETS: " . $jacket_uhf_value . "" . $jacket_vhf_value . "" . $light_value . "" . $floures_value;
        $jacket_values = trim($jacket_values, ' , ');
//  } else {
        //      $jacket_values = "<br>JACKETS: ";
        //  }
        $number_val = ($number) ? "<span style='width: 118px;display: inline-block;'>DINGHIES: " . $number . "</span>" : '';
        $capacity_val = ($capacity) ? "<span  style='width: 118px;display: inline-block;'>CAPACITY: " . $capacity . "</span><br>" : '';
        $cover_val = ($cover == "YES") ? "<span  style='width: 118px;display: inline-block;'>COVER: " . $cover . "</span>" : '';
        $color_val = ($color) ? "<span style=''></span>DINGHIES COLOUR: " . $color : "<span style=''></span>DINGHIES COLOUR: ";
        $aircraft_color_val = ($aircraft_color) ? "AIRCRAFT COLOUR & MARKINGS: " . $aircraft_color : '';

        $supplementary_info = "CO PILOT: " . $copilot . "<br>" . $cabin_value . "<br>" . $emergency_values . "<br>" . $survival_equipment_values . "<br>" .
                $jacket_values . "<br>" . $number_val . " " . $capacity_val . "" . $cover_val . " " . $color_val . "<br>" . $aircraft_color_val;

        return $supplementary_info;
    }

    public static function get_watch_hours($data) {
        $departure_aerodrome = (array_key_exists('departure_aerodrome', $data)) ? $data['departure_aerodrome'] : '';
        $destination_aerodrome = (array_key_exists('destination_aerodrome', $data)) ? $data['destination_aerodrome'] : '';
        $departure_time_hours = (array_key_exists('departure_time_hours', $data)) ? $data['departure_time_hours'] : '';
        $departure_time_minutes = (array_key_exists('departure_time_minutes', $data)) ? $data['departure_time_minutes'] : '';
        $date_of_flight = (array_key_exists('date_of_flight', $data)) ? $data['date_of_flight'] : '';
        $total_flying_hours = (array_key_exists('total_flying_hours', $data)) ? $data['total_flying_hours'] : '';
        $total_flying_minutes = (array_key_exists('total_flying_minutes', $data)) ? $data['total_flying_minutes'] : '';

        $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
        $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
        $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
        $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
        $get_day_of_flight = date("y-m-d", strtotime('20' . $date_of_flight));
        $get_day_of_flight = date("l", strtotime($get_day_of_flight));
        $is_watch_hour_valid = 1;
        if ($get_day_of_flight == 'Monday') {
            $dept_monday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->monday_open : '1';
            $dept_monday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->monday_close : '1';
            $dest_monday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->monday_open : '1';
            $dest_monday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->monday_close : '1';
            if ($dept_monday_open == 'CLOSED' || $dept_monday_close == 'CLOSED' ||
                    $dest_monday_open == 'CLOSED' || $dest_monday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_monday_open || $entered_departure_time > $dept_monday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_monday_open || $entered_destination_time > $dest_monday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Tuesday') {
            $dept_tuesday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->tuesday_open : '1';
            $dept_tuesday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->tuesday_close : '1';
            $dest_tuesday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->tuesday_open : '1';
            $dest_tuesday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->tuesday_close : '1';
            if ($dept_tuesday_open == 'CLOSED' || $dept_tuesday_close == 'CLOSED' ||
                    $dest_tuesday_open == 'CLOSED' || $dest_tuesday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_tuesday_open || $entered_departure_time > $dept_tuesday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_tuesday_open || $entered_destination_time > $dest_tuesday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Wednesday') {
            $dept_wednesday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->wednesday_open : '1';
            $dept_wednesday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->wednesday_close : '1';
            $dest_wednesday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->wednesday_open : '1';
            $dest_wednesday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->wednesday_close : '1';
            if ($dept_wednesday_open == 'CLOSED' || $dept_wednesday_close == 'CLOSED' ||
                    $dest_wednesday_open == 'CLOSED' || $dest_wednesday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_wednesday_open || $entered_departure_time > $dept_wednesday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_wednesday_open || $entered_destination_time > $dest_wednesday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Thursday') {
            $dept_thursday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->thursday_open : '1';
            $dept_thursday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->thursday_close : '1';
            $dest_thursday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->thursday_open : '1';
            $dest_thursday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->thursday_close : '1';
            if ($dept_thursday_open == 'CLOSED' || $dept_thursday_close == 'CLOSED' ||
                    $dest_thursday_open == 'CLOSED' || $dest_thursday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_thursday_open || $entered_departure_time > $dept_thursday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_thursday_open || $entered_destination_time > $dest_thursday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Friday') {
            $dept_friday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->friday_open : '1';
            $dept_friday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->friday_close : '1';
            $dest_friday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->friday_open : '1';
            $dest_friday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->friday_close : '1';
            if ($dept_friday_open == 'CLOSED' || $dept_friday_close == 'CLOSED' ||
                    $dest_friday_open == 'CLOSED' || $dest_friday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_friday_open || $entered_departure_time > $dept_friday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_friday_open || $entered_destination_time > $dest_friday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Saturday') {
            $dept_saturday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->saturday_open : '1';
            $dept_saturday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->saturday_close : '1';
            $dest_saturday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->saturday_open : '1';
            $dest_saturday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->saturday_close : '1';
            if ($dept_saturday_open == 'CLOSED' || $dept_saturday_close == 'CLOSED' ||
                    $dest_saturday_open == 'CLOSED' || $dest_saturday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_saturday_open || $entered_departure_time > $dept_saturday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_saturday_open || $entered_destination_time > $dest_saturday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Sunday') {
            $dept_sunday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->sunday_open : '1';
            $dept_sunday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->sunday_close : '1';
            $dest_sunday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->sunday_open : '1';
            $dest_sunday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->sunday_close : '1';
            if ($dept_sunday_open == 'CLOSED' || $dept_sunday_close == 'CLOSED' ||
                    $dest_sunday_open == 'CLOSED' || $dest_sunday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_sunday_open || $entered_departure_time > $dept_sunday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_sunday_open || $entered_destination_time > $dest_sunday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        }
        return $is_watch_hour_valid;
    }

    public static function get_notams_watch_hours($data) {
        $departure_aerodrome = (array_key_exists('departure_aerodrome', $data)) ? $data['departure_aerodrome'] : '';
        $destination_aerodrome = (array_key_exists('destination_aerodrome', $data)) ? $data['destination_aerodrome'] : '';
        $departure_time_hours = (array_key_exists('departure_time_hours', $data)) ? $data['departure_time_hours'] : '';
        $departure_time_minutes = (array_key_exists('departure_time_minutes', $data)) ? $data['departure_time_minutes'] : '';
        $date_of_flight = (array_key_exists('date_of_flight', $data)) ? $data['date_of_flight'] : '';
        $total_flying_hours = (array_key_exists('total_flying_hours', $data)) ? $data['total_flying_hours'] : '';
        $total_flying_minutes = (array_key_exists('total_flying_minutes', $data)) ? $data['total_flying_minutes'] : '';

        $get_dept_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
        $get_dest_watch_ours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);
        $entered_departure_time = $departure_time_hours . '' . $departure_time_minutes;
        $entered_destination_time = $entered_departure_time + ($total_flying_hours . '' . $total_flying_minutes);
        $get_day_of_flight = date("y-m-d", strtotime($date_of_flight));
        $get_day_of_flight = date("l", strtotime($get_day_of_flight));
        $is_watch_hour_valid = 1;
        if ($get_day_of_flight == 'Monday') {
            $dept_monday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->monday_open : '1';
            $dept_monday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->monday_close : '1';
            $dest_monday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->monday_open : '1';
            $dest_monday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->monday_close : '1';
            if ($dept_monday_open == 'CLOSED' || $dept_monday_close == 'CLOSED' ||
                    $dest_monday_open == 'CLOSED' || $dest_monday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_monday_open || $entered_departure_time > $dept_monday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_monday_open || $entered_destination_time > $dest_monday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Tuesday') {
            $dept_tuesday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->tuesday_open : '1';
            $dept_tuesday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->tuesday_close : '1';
            $dest_tuesday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->tuesday_open : '1';
            $dest_tuesday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->tuesday_close : '1';
            if ($dept_tuesday_open == 'CLOSED' || $dept_tuesday_close == 'CLOSED' ||
                    $dest_tuesday_open == 'CLOSED' || $dest_tuesday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_tuesday_open || $entered_departure_time > $dept_tuesday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_tuesday_open || $entered_destination_time > $dest_tuesday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Wednesday') {
            $dept_wednesday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->wednesday_open : '1';
            $dept_wednesday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->wednesday_close : '1';
            $dest_wednesday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->wednesday_open : '1';
            $dest_wednesday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->wednesday_close : '1';
            if ($dept_wednesday_open == 'CLOSED' || $dept_wednesday_close == 'CLOSED' ||
                    $dest_wednesday_open == 'CLOSED' || $dest_wednesday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_wednesday_open || $entered_departure_time > $dept_wednesday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_wednesday_open || $entered_destination_time > $dest_wednesday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Thursday') {
            $dept_thursday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->thursday_open : '1';
            $dept_thursday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->thursday_close : '1';
            $dest_thursday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->thursday_open : '1';
            $dest_thursday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->thursday_close : '1';
            if ($dept_thursday_open == 'CLOSED' || $dept_thursday_close == 'CLOSED' ||
                    $dest_thursday_open == 'CLOSED' || $dest_thursday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_thursday_open || $entered_departure_time > $dept_thursday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_thursday_open || $entered_destination_time > $dest_thursday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Friday') {
            $dept_friday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->friday_open : '1';
            $dept_friday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->friday_close : '1';
            $dest_friday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->friday_open : '1';
            $dest_friday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->friday_close : '1';
            if ($dept_friday_open == 'CLOSED' || $dept_friday_close == 'CLOSED' ||
                    $dest_friday_open == 'CLOSED' || $dest_friday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_friday_open || $entered_departure_time > $dept_friday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_friday_open || $entered_destination_time > $dest_friday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Saturday') {
            $dept_saturday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->saturday_open : '1';
            $dept_saturday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->saturday_close : '1';
            $dest_saturday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->saturday_open : '1';
            $dest_saturday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->saturday_close : '1';
            if ($dept_saturday_open == 'CLOSED' || $dept_saturday_close == 'CLOSED' ||
                    $dest_saturday_open == 'CLOSED' || $dest_saturday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_saturday_open || $entered_departure_time > $dept_saturday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_saturday_open || $entered_destination_time > $dest_saturday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        } else if ($get_day_of_flight == 'Sunday') {
            $dept_sunday_open = ($get_dept_watch_ours) ? $get_dept_watch_ours->sunday_open : '1';
            $dept_sunday_close = ($get_dept_watch_ours) ? $get_dept_watch_ours->sunday_close : '1';
            $dest_sunday_open = ($get_dest_watch_ours) ? $get_dest_watch_ours->sunday_open : '1';
            $dest_sunday_close = ($get_dest_watch_ours) ? $get_dest_watch_ours->sunday_close : '1';
            if ($dept_sunday_open == 'CLOSED' || $dept_sunday_close == 'CLOSED' ||
                    $dest_sunday_open == 'CLOSED' || $dest_sunday_close == 'CLOSED') {
                $is_watch_hour_valid = 0;
            } elseif ((($entered_departure_time < $dept_sunday_open || $entered_departure_time > $dept_sunday_close) && $departure_aerodrome != 'ZZZZ') ||
                    (($entered_destination_time < $dest_sunday_open || $entered_destination_time > $dest_sunday_close) && $destination_aerodrome != 'ZZZZ')) {
                $is_watch_hour_valid = 0;
            } else {
                $is_watch_hour_valid = 1;
            }
        }
        return $is_watch_hour_valid;
    }

    public static function station_addresses($departure_aerodrome, $destination_aerodrome) {
        $station_address_1 = Station_Addresses_model::get_station_addresses1();
        $station_address_2 = Station_Addresses_model::get_station_addresses2();
        $station_address_3 = Station_Addresses_model::get_station_addresses3();

        $chennai = $station_address_1->chennai;
        $mumbai = $station_address_1->mumbai;
        $kolkata = $station_address_1->kolkata;
        $delhi = $station_address_1->delhi;
        $chennaisubstr = substr($chennai, 0, 2);
        $mumbaisubstr = substr($mumbai, 0, 2);
        $kolkatasubstr = substr($kolkata, 0, 2);
        $delhisubstr = substr($delhi, 0, 2);

        $chennai_id2 = $station_address_2->chennai;
        $mumbai_id2 = $station_address_2->mumbai;
        $kolkata_id2 = $station_address_2->kolkata;
        $delhi_id2 = $station_address_2->delhi;

        $addtion_mumbai_data = $station_address_3->mumbai;
        $addtion_delhi_data = $station_address_3->delhi;

        $pdfdep_aerosubstr = substr($departure_aerodrome, 0, 2);
        $pdfdest_aerosubstr = substr($destination_aerodrome, 0, 2);

        $dep_ztzx = "";
        $dep_zpzx = "";
        $dest_ztzx = "";
        $dep_zqzx = "";
        $dep_zpzx_briefing = "";
        $dest_zqzx_briefing = "";
        $extra_data_vabb = "";
        $extra_data_vidp = "";

        switch (true) {
            case ($departure_aerodrome == 'ZZZZ' and $destination_aerodrome == 'ZZZZ'):
                $dep_ztzx = "";
                $dep_zpzx = "";
                $dest_ztzx = "";
                $dep_zqzx = "";
                $dep_zpzx_briefing = "";
                $dest_zqzx_briefing = "";
                $extra_data_vabb = "";
                $extra_data_vidp = "";
                break;
            case ($departure_aerodrome == 'ZZZZ' and $destination_aerodrome != 'ZZZZ'):
                if ($pdfdest_aerosubstr == $chennaisubstr) {
                    $dep_ztzx = "";
                    $dep_zpzx = "";
                    $dest_ztzx = $destination_aerodrome . "ZTZX";
                    $dep_zqzx = "";
                    $dep_zpzx_briefing = "";
                    $dest_zqzx_briefing = $chennai . "ZQZX";
                    $extra_data_vabb = "";
                    $extra_data_vidp = "";
                } else if ($pdfdest_aerosubstr == $mumbaisubstr) {
                    $dep_ztzx = "";
                    $dep_zpzx = "";
                    $dest_ztzx = $destination_aerodrome . "ZTZX";
                    $dep_zqzx = "";
                    $dep_zpzx_briefing = "";
                    $dest_zqzx_briefing = $mumbai . "ZQZX";
                    $extra_data_vabb = $addtion_mumbai_data;
                    $extra_data_vidp = "";
                } else if ($pdfdest_aerosubstr == $kolkatasubstr) {
                    $dep_ztzx = "";
                    $dep_zpzx = "";
                    $dest_ztzx = $destination_aerodrome . "ZTZX";
                    $dep_zqzx = "";
                    $dep_zpzx_briefing = "";
                    $dest_zqzx_briefing = $kolkata . "ZQZX";
                    $extra_data_vabb = "";
                    $extra_data_vidp = "";
                } else if ($pdfdest_aerosubstr == $delhisubstr) {
                    $dep_ztzx = "";
                    $dep_zpzx = "";
                    $dest_ztzx = $destination_aerodrome . "ZTZX";
                    $dep_zqzx = "";
                    $dep_zpzx_briefing = "";
                    $dest_zqzx_briefing = $delhi . "ZQZX";
                    $extra_data_vabb = "";
                    $extra_data_vidp = $addtion_delhi_data;
                } else {
                    
                }
                break;
            case ($departure_aerodrome != 'ZZZZ' and $destination_aerodrome == 'ZZZZ'):
                if ($pdfdep_aerosubstr == $chennaisubstr) {
                    $dep_ztzx = $departure_aerodrome . "ZTZX";
                    $dep_zpzx = $departure_aerodrome . "ZPZX";
                    $dest_ztzx = "";
                    $dep_zqzx = $chennai . "ZQZX";
                    $dep_zpzx_briefing = $chennai_id2 . "ZPZX";
                    $dest_zqzx_briefing = "";
                    $extra_data_vabb = "";
                    $extra_data_vidp = "";
                } else if ($pdfdep_aerosubstr == $mumbaisubstr) {
                    $dep_ztzx = $departure_aerodrome . "ZTZX";
                    $dep_zpzx = $departure_aerodrome . "ZPZX";
                    $dest_ztzx = "";
                    $dep_zqzx = $mumbai . "ZQZX";
                    $dep_zpzx_briefing = $mumbai_id2 . "ZPZX";
                    $dest_zqzx_briefing = "";
                    $extra_data_vabb = $addtion_mumbai_data;
                    $extra_data_vidp = "";
                } else if ($pdfdep_aerosubstr == $kolkatasubstr) {
                    $dep_ztzx = $departure_aerodrome . "ZTZX";
                    $dep_zpzx = $departure_aerodrome . "ZPZX";
                    $dest_ztzx = "";
                    $dep_zqzx = $kolkata . "ZQZX";
                    $dep_zpzx_briefing = $kolkata_id2 . "ZPZX";
                    $dest_zqzx_briefing = "";
                    $extra_data_vabb = "";
                    $extra_data_vidp = "";
                } else if ($pdfdep_aerosubstr == $delhisubstr) {
                    $dep_ztzx = $departure_aerodrome . "ZTZX";
                    $dep_zpzx = $departure_aerodrome . "ZPZX";
                    $dest_ztzx = "";
                    $dep_zqzx = $delhi . "ZQZX";
                    $dep_zpzx_briefing = $delhi_id2 . "ZPZX";
                    $dest_zqzx_briefing = "";
                    $extra_data_vabb = "";
                    $extra_data_vidp = $addtion_delhi_data;
                } else {
                    
                }
                break;
            case ($departure_aerodrome != 'ZZZZ' and $destination_aerodrome != 'ZZZZ'):
                if ($pdfdep_aerosubstr == $chennaisubstr) {
                    if ($pdfdest_aerosubstr == $chennaisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $chennai . "ZQZX";
                        $dep_zpzx_briefing = $chennai_id2 . "ZPZX";
                        $dest_zqzx_briefing = "";
                        $extra_data_vabb = "";
                        $extra_data_vidp = "";
                    } else if ($pdfdest_aerosubstr == $mumbaisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $chennai . "ZQZX";
                        $dep_zpzx_briefing = $chennai_id2 . "ZPZX";
                        $dest_zqzx_briefing = $mumbai . "ZQZX";
                        $extra_data_vabb = $addtion_mumbai_data;
                        $extra_data_vidp = "";
                    } else if ($pdfdest_aerosubstr == $kolkatasubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $chennai . "ZQZX";
                        $dep_zpzx_briefing = $chennai_id2 . "ZPZX";
                        $dest_zqzx_briefing = $kolkata . "ZQZX";
                        $extra_data_vabb = "";

                        $extra_data_vidp = "";
                    } else if ($pdfdest_aerosubstr == $delhisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $chennai . "ZQZX";
                        $dep_zpzx_briefing = $chennai_id2 . "ZPZX";
                        $dest_zqzx_briefing = $delhi . "ZQZX";
                        $extra_data_vabb = "";
                        $extra_data_vidp = $addtion_delhi_data;
                    } else {
                        
                    }
                } else if ($pdfdep_aerosubstr == $mumbaisubstr) {
                    if ($pdfdest_aerosubstr == $chennaisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $mumbai . "ZQZX";
                        $dep_zpzx_briefing = $mumbai_id2 . "ZPZX";
                        $dest_zqzx_briefing = $chennai . "ZQZX";
                        $extra_data_vabb = $addtion_mumbai_data;
                        $extra_data_vidp = "";
                    } else if ($pdfdest_aerosubstr == $mumbaisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $mumbai . "ZQZX";
                        $dep_zpzx_briefing = $mumbai_id2 . "ZPZX";
                        $dest_zqzx_briefing = "";
                        $extra_data_vabb = $addtion_mumbai_data;
                        $extra_data_vidp = "";
                    } else if ($pdfdest_aerosubstr == $kolkatasubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $mumbai . "ZQZX";
                        $dep_zpzx_briefing = $mumbai_id2 . "ZPZX";
                        $dest_zqzx_briefing = $kolkata . "ZQZX";
                        $extra_data_vabb = $addtion_mumbai_data;
                        $extra_data_vidp = "";
                    } else if ($pdfdest_aerosubstr == $delhisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $mumbai . "ZQZX";
                        $dep_zpzx_briefing = $mumbai_id2 . "ZPZX";
                        $dest_zqzx_briefing = $delhi . "ZQZX";
                        $extra_data_vabb = $addtion_mumbai_data;
                        $extra_data_vidp = $addtion_delhi_data;
                    } else {
                        
                    }
                } else if ($pdfdep_aerosubstr == $kolkatasubstr) {
                    if ($pdfdest_aerosubstr == $chennaisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $kolkata . "ZQZX";
                        $dep_zpzx_briefing = $kolkata_id2 . "ZPZX";
                        $dest_zqzx_briefing = $chennai . "ZQZX";
                        $extra_data_vabb = "";
                        $extra_data_vidp = "";
                    } else if ($pdfdest_aerosubstr == $mumbaisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $kolkata . "ZQZX";
                        $dep_zpzx_briefing = $kolkata_id2 . "ZPZX";
                        $dest_zqzx_briefing = $mumbai . "ZQZX";
                        $extra_data_vabb = $addtion_mumbai_data;
                        $extra_data_vidp = "";
                    } else if ($pdfdest_aerosubstr == $kolkatasubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $kolkata . "ZQZX";
                        $dep_zpzx_briefing = $kolkata_id2 . "ZPZX";
                        $dest_zqzx_briefing = "";
                        $extra_data_vabb = "";
                        $extra_data_vidp = "";
                    } else if ($pdfdest_aerosubstr == $delhisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $kolkata . "ZQZX";
                        $dep_zpzx_briefing = $kolkata_id2 . "ZPZX";
                        $dest_zqzx_briefing = $delhi . "ZQZX";
                        $extra_data_vabb = "";
                        $extra_data_vidp = $addtion_delhi_data;
                    } else {
                        
                    }
                } else if ($pdfdep_aerosubstr == $delhisubstr) {
                    if ($pdfdest_aerosubstr == $chennaisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $delhi . "ZQZX";
                        $dep_zpzx_briefing = $delhi_id2 . "ZPZX";
                        $dest_zqzx_briefing = $chennai . "ZQZX";
                        $extra_data_vabb = "";
                        $extra_data_vidp = $addtion_delhi_data;
                    } else if ($pdfdest_aerosubstr == $mumbaisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $delhi . "ZQZX";
                        $dep_zpzx_briefing = $delhi_id2 . "ZPZX";
                        $dest_zqzx_briefing = $mumbai . "ZQZX";
                        $extra_data_vabb = $addtion_mumbai_data;
                        $extra_data_vidp = $addtion_delhi_data;
                    } else if ($pdfdest_aerosubstr == $kolkatasubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $delhi . "ZQZX";
                        $dep_zpzx_briefing = $delhi_id2 . "ZPZX";
                        $dest_zqzx_briefing = $kolkata . "ZQZX";
                        $extra_data_vabb = "";
                        $extra_data_vidp = $addtion_delhi_data;
                    } else if ($pdfdest_aerosubstr == $delhisubstr) {
                        $dep_ztzx = $departure_aerodrome . "ZTZX";
                        $dep_zpzx = $departure_aerodrome . "ZPZX";
                        $dest_ztzx = $destination_aerodrome . "ZTZX";
                        $dep_zqzx = $delhi . "ZQZX";
                        $dep_zpzx_briefing = $delhi_id2 . "ZPZX";
                        $dest_zqzx_briefing = "";
                        $extra_data_vabb = "";
                        $extra_data_vidp = $addtion_delhi_data;
                    } else {
                        
                    }
                } else {
                    
                }
                break;
            default:
// echo 'nothing';
                break;
        }

        if ($dep_ztzx != "") {
            $dep_ztzx = "<span>" . $dep_ztzx . "&nbsp;</span>";
        } else {
            $dep_ztzx = "<span></span>";
        }
        if ($dep_zpzx != "") {
            $dep_zpzx = "<span>" . $dep_zpzx . "&nbsp;</span>";
        } else {
            $dep_zpzx = "<span></span>";
        }
        if ($dest_ztzx != "") {
            $dest_ztzx = "<span>" . $dest_ztzx . "&nbsp;</span>";
        } else {
            $dest_ztzx = "<span></span>";
        }
        if ($dep_zqzx != "") {
            $dep_zqzx = "<span>" . $dep_zqzx . "&nbsp;</span>";
        } else {
            $dep_zqzx = "<span></span>";
        }
        if ($dep_zpzx_briefing != "") {
            $dep_zpzx_briefing = "<span>" . $dep_zpzx_briefing . "&nbsp;</span>";
        } else {
            $dep_zpzx_briefing = "<span></span>";
        }
        if ($dest_zqzx_briefing != "") {
            $dest_zqzx_briefing = "<span>" . $dest_zqzx_briefing . "&nbsp;</span>";
        } else {
            $dest_zqzx_briefing = "<span></span>";
        }
        if ($extra_data_vabb != "") {
            $extra_data_vabb = "<span>" . $extra_data_vabb . "&nbsp;</span>";
        } else {
            $extra_data_vabb = "<span></span>";
        }
        if ($extra_data_vidp != "") {
            $extra_data_vidp = "<span>" . $extra_data_vidp . "&nbsp;</span>";
        } else {
            $extra_data_vidp = "<span></span>";
        }
        $dep_dest_addtional_data = $dep_ztzx . '' . $dep_zpzx . '' . $dest_ztzx . '' . $dep_zqzx . '' . $dep_zpzx_briefing . '' . $dest_zqzx_briefing . '' . $extra_data_vabb . '' . $extra_data_vidp;
        $dep_dest_addtional_data = implode('&nbsp;', array_unique(explode('&nbsp;', $dep_dest_addtional_data)));

        if (($pdfdep_aerosubstr == 'VI' && $pdfdest_aerosubstr == 'VO') || ($pdfdep_aerosubstr == 'VO' && $pdfdest_aerosubstr == 'VI')) {
            $dep_dest_addtional_data = $dep_dest_addtional_data . ' VABBYFYF VABFZQZX';
        }
        if(($departure_aerodrome == 'VOCI' && $destination_aerodrome!="VOCI")){
           $dep_dest_addtional_data = $dep_dest_addtional_data.' VOCIZRZX'; 
        }
        if($destination_aerodrome == 'VOCI' && $departure_aerodrome!="VOCI"){
           $dep_dest_addtional_data = $dep_dest_addtional_data.' VOCIZRZX VOCIZPZX'; 
        }
        if($destination_aerodrome == 'VOCI' && $departure_aerodrome=="VOCI"){
           $dep_dest_addtional_data = $dep_dest_addtional_data.' VOCIZRZX'; 
        }

//        if($departure_aerodrome == 'VIDP' || $destination_aerodrome == 'VIDP'){
//            $dep_dest_addtional_data = $dep_dest_addtional_data.'VIDPCFTM'; 
//        }
//  
//        if($departure_aerodrome == 'VECC' && $destination_aerodrome == 'VEDG'){
//            $dep_dest_addtional_data = $dep_dest_addtional_data.'VIDPCFTM'; 
//        }

        if ($departure_aerodrome != 'ZZZZ' && $destination_aerodrome != 'ZZZZ') {
            $dep_dest_addtional_data = $dep_dest_addtional_data . ' VIDPCTFM';
        }
        return $dep_dest_addtional_data;
    }

    public static function auto_cancel($data) {
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
        $cancelled_by = (array_key_exists('cancelled_by', $data)) ? $data['cancelled_by'] : 'AUTO';

//Status update
        $update_plan_status = FlightPlanDetailsModel::where('aircraft_callsign', $aircraft_callsign)
                        ->where('departure_aerodrome', $departure_aerodrome)
                        ->where('destination_aerodrome', $destination_aerodrome)
                        ->where('date_of_flight', $date_of_flight)
                        ->where('departure_time_hours', $departure_time_hours)
                        ->where('departure_time_minutes', $departure_time_minutes)->update(['plan_status' => '2']);

        $subject = "AUTO CANCEL " . $aircraft_callsign . " " . $departure_aerodrome . "" . $departure_time_hours . "" . $departure_time_minutes . " " . $destination_aerodrome . " // DOF " . $date_of_flight;

        $data['cancelled_by'] = "<span style='color:#f1292b;'>Cancelled By: $cancelled_by</span>";
        $data['cancelled_date'] = "<span style='margin-left:27px;color:#404040;'></span>Cancelled Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";

        date_default_timezone_set('Asia/Calcutta');
        $data['cancelled_time'] = "<span style='margin-left:27px;color:#404040;'></span> Cancelled Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['cancelled_via'] = "<span style='margin-left:33px;color:#404040;'></span>Cancelled Via: " . $_SERVER['HTTP_HOST'];

        $data['cancelled_heading'] = "(CNL-" . $aircraft_callsign . "-" . $departure_aerodrome . "" . $departure_time_hours . "" .
                $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . ")";
        $data['heading_top'] = "AUTO CANCEL";
        $mail_headers = [
            'from' => $this->from,
            'from_name' => $this->from_name,
            'subject' => $subject,
            'to' => $this->user_email,
            'cc' => $this->cc,
            'bcc' => $this->bcc,
        ];
        Mail::send('emails.fpl.fpl_cancel', $data, function ($message) use ($mail_headers) {
            $message->from($mail_headers['from'], $mail_headers['from_name']);
            $message->to($mail_headers['to']);
            $message->subject($mail_headers['subject']);
            $message->bcc('dev.eflight@pravahya.com');
        });

        return 1;
    }

    public static function get_auto_number($data) {
        $aircraft_callsign = $data['aircraft_callsign'];

        if (substr($aircraft_callsign, 0, 2) == 'VT') {
            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
        }

        $aircraft_callsign_count = $data['aircraft_callsign_count'];
        $aircraft_callsign_count = $aircraft_callsign_count + 1;
//        if($aircraft_callsign != 'VTSAI'){
        $aircraft_callsign = $aircraft_callsign . '' . $aircraft_callsign_count;
//        }
//  echo $aircraft_callsign;exit;
        return $aircraft_callsign;
    }

    public static function get_zzzz_value($data) {
        $departure_aerodrome = $data['departure_aerodrome'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
        $result = '';
        if ($departure_aerodrome == 'ZZZZ' && $destination_aerodrome != 'ZZZZ') {
            $result = 'DEPT. ZZZZ = ' . $departure_station;
        } elseif ($destination_aerodrome == 'ZZZZ' && $departure_aerodrome != 'ZZZZ') {
            $result = 'DEST. ZZZZ = ' . $destination_station;
        } elseif ($departure_aerodrome == 'ZZZZ' && $destination_aerodrome == 'ZZZZ') {
            $result = 'DEPT. ZZZZ = ' . $departure_station . "<span style='margin-left:27px;color:#404040;'></span> DEST. ZZZZ = " . $destination_station;
        }

        return $result;
    }

    public static function get_navlog_zzzz_value($data) {
        $departure_aerodrome = $data['departure'];
        $destination_aerodrome = $data['destination'];
        $result = '';
        if ($departure_aerodrome == 'ZZZZ' && $destination_aerodrome != 'ZZZZ') {
            $result = 'DEPT. ZZZZ = ' . $data['dept_place'];
        } elseif ($destination_aerodrome == 'ZZZZ' && $departure_aerodrome != 'ZZZZ') {
            $result = 'DEST. ZZZZ = ' . $data['dest_place'];
        } elseif ($departure_aerodrome == 'ZZZZ' && $destination_aerodrome == 'ZZZZ') {
            $result = 'DEPT. ZZZZ = ' . $data['dept_place'] . "<span style='margin-left:27px;color:#404040;'></span> DEST. ZZZZ = " . $data['dest_place'];
        }

        return $result;
    }

    public static function get_subject($data) {
        $subject_type = $data['subject_type'];
        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';

        if ($departure_aerodrome == 'ZZZZ' && $departure_station != '') {
            $departure_aerodrome = $departure_station;
        }
        if ($destination_aerodrome == 'ZZZZ' && $destination_aerodrome != '') {
            $destination_aerodrome = $destination_station;
        }

        $date_of_flight = $data['date_of_flight'];
        $date_format = date('d-M-Y', strtotime('20' . $date_of_flight));
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];

        switch ($subject_type) {
            case 'fpl':
                $result = "FPL " . $aircraft_callsign . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes
                        . " - " . $destination_aerodrome . " // " . date('d-M-Y', strtotime('20' . $date_of_flight));
                break;
            case 'cancel':
                $result = "CANCEL " . $aircraft_callsign . " " . $departure_aerodrome . "" . $departure_time_hours . "" . $departure_time_minutes . " " . $destination_aerodrome . " // " . $date_format;
                break;
            case 'fic_adc':

                break;
            case 'revise_time':
                $result = $aircraft_callsign . " " . $departure_aerodrome . "-" . $destination_aerodrome . " REVISED ETD " . $departure_time_hours . "" . $departure_time_minutes . " // DOF " . $date_of_flight;
                break;
            default:
                break;
        }

        return $result;
    }

    // public static function get_navlog_subject($data) {
    //     $subject_type = $data['subject_type'];
    //     $aircraft_callsign = $data['callsign'];
    //     $departure_aerodrome = $data['departure'];
    //     $departure_time_hours = substr($data['dept_time'],0,2);
    //     $departure_time_minutes =substr($data['dept_time'],2,2);
    //     $destination_aerodrome = $data['destination'];
    //     if ($departure_aerodrome == 'ZZZZ') {
    //         $departure_aerodrome = $data['dept_place'];
    //     }
    //     if ($destination_aerodrome == 'ZZZZ') {
    //         $destination_aerodrome = $data['dest_place'];
    //     }
    //     $date_of_flight = $data['flight_date'];
    //     $date_format = date('d-M-Y', strtotime($date_of_flight));
    //     $pilot_in_command = $data['pilot'];
    //     $mobile_number = $data['mobile'];
    //     $copilot = $data['co_pilot'];
    //     switch ($subject_type) {
    //         case 'fpl':
    //             $result = "FPL " . $aircraft_callsign . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes
    //                     . " - " . $destination_aerodrome . " // " . date('d-M-Y', strtotime('20' . $date_of_flight));
    //             break;
    //         case 'cancel':
    //             $result = "CANCEL " . $aircraft_callsign . " " . $departure_aerodrome . "" . $departure_time_hours . "" . $departure_time_minutes . " " . $destination_aerodrome . " // " . $date_format;
    //             break;
    //         case 'fic_adc':
    //             break;
    //         case 'revise_time':
    //             $result = $aircraft_callsign . " " . $departure_aerodrome . "-" . $destination_aerodrome . " REVISED ETD " . $departure_time_hours . "" . $departure_time_minutes . " // DOF " . $date_of_flight;
    //             break;
    //         default:
    //             break;
    //     }
    //     return $result;
    // }
    public static function get_navlog_subject($data) {
        $subject_type = $data['subject_type'];
        $aircraft_callsign = $data['callsign'];
        $departure_aerodrome = $data['departure'];
        $departure_time_hours = substr($data['dep_time'], 0, 2);
        $departure_time_minutes = substr($data['dep_time'], 2, 2);
        $destination_aerodrome = $data['destination'];
        if ($departure_aerodrome == 'ZZZZ') {
            $departure_aerodrome = $data['dept_place'];
        }
        if ($destination_aerodrome == 'ZZZZ') {
            $destination_aerodrome = $data['dest_place'];
        }

        $date_of_flight = $data['flight_date'];
        $date_format = date('d-M-Y', strtotime($date_of_flight));
        $pilot_in_command = $data['pilot'];
        $mobile_number = $data['mobile'];
        $copilot = $data['co_pilot'];
        switch ($subject_type) {
            case 'fpl':
                $result = "FPL " . $aircraft_callsign . " " . $departure_aerodrome . " " . $departure_time_hours . $departure_time_minutes
                        . " - " . $destination_aerodrome . " // " . date('d-M-Y', strtotime($date_of_flight));
                break;
            case 'cancel':
                $result = "CANCEL " . $aircraft_callsign . " " . $departure_aerodrome . "" . $departure_time_hours . "" . $departure_time_minutes . " " . $destination_aerodrome . " // " . $date_format;
                break;
            case 'fic_adc':

                break;
            case 'revise_time':
                $result = $aircraft_callsign . " " . $departure_aerodrome . "-" . $destination_aerodrome . " REVISED ETD " . $departure_time_hours . "" . $departure_time_minutes . " // DOF " . $date_of_flight;
                break;
            default:
                break;
        }

        return $result;
    }

    public static function get_cc_mails2($data, $admin = "") {
        $departure_aerodrome = (array_key_exists('departure_aerodrome', $data)) ? $data['departure_aerodrome'] : '';
        $destination_aerodrome = (array_key_exists('destination_aerodrome', $data)) ? $data['destination_aerodrome'] : '';
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $aircraft_callsign = (array_key_exists('aircraft_callsign', $data)) ? $data['aircraft_callsign'] : '';
        $aircraft_callsign = substr($aircraft_callsign, 0, 5);

        $callsign_mails = CallSignMailsModel::get_callsign_mail_id($aircraft_callsign);
        $departure_aerodrome_mails = AerodromeMailsModel::get_dep_cc_mail($departure_aerodrome, $departure_station);
        $destination_aerodrome_mails = AerodromeMailsModel::get_dest_cc_mail($destination_aerodrome, $destination_station);
        $get_support_mails = SupportMailsModel::get_support_mails();

        $get_local_mails = SupportMailsModel::get_local_mails();
        $get_local_mails = rtrim($get_local_mails, ',');
        $get_local_mails = explode(',', $get_local_mails);

        $callsign_mails = rtrim($callsign_mails, ',');
        $departure_aerodrome_mails = rtrim($departure_aerodrome_mails, ',');
        $destination_aerodrome_mails = rtrim($destination_aerodrome_mails, ',');
        $get_support_mails = rtrim($get_support_mails, ',');

        $departure_aerodrome_mails = ($departure_aerodrome_mails) ? $departure_aerodrome_mails . ',' : '';
        $destination_aerodrome_mails = ($destination_aerodrome_mails) ? $destination_aerodrome_mails . ',' : '';
        $callsign_mails = ($callsign_mails) ? $callsign_mails . ',' : '';
        $get_support_mails = ($get_support_mails) ? $get_support_mails . ',' : '';

        $concat_mails = $callsign_mails . $departure_aerodrome_mails . $destination_aerodrome_mails . $get_support_mails;
        $concat_mails = trim($concat_mails, ',');

        $cc_mails = explode(",", $concat_mails);
        $get_support_mails = rtrim($get_support_mails, ',');
        $get_support_mails = explode(",", $get_support_mails);

        if (count($get_local_mails) == 1) {
            $get_local_mails = SupportMailsModel::get_local_mails();
        }
        if (env('APP_ENV') == 'local') {
            $result = $get_local_mails;
        } else if ($admin != '') {
            $result = ($get_support_mails) ? $get_support_mails : $get_local_mails;
        } else {
            $result = $cc_mails;
        }

        return $result;
    }

    public static function get_navlog_cc_mails($data, $admin = "", $is_fpl = "", $aero_mails = "") {

        $departure_aerodrome = (array_key_exists('departure', $data)) ? $data['departure'] : '';
        $destination_aerodrome = (array_key_exists('destination', $data)) ? $data['destination'] : '';
        $departure_station = (array_key_exists('dept_place', $data)) ? $data['dept_place'] : '';
        $destination_station = (array_key_exists('dest_place', $data)) ? $data['dest_place'] : '';
        $aircraft_callsign = (array_key_exists('callsign', $data)) ? strtoupper($data['callsign']) : '';
        $aircraft_callsign = substr($aircraft_callsign, 0, 5);

        $callsign_array = ['TESTA', 'TESTB', 'TESTC', 'TESTH', 'TESTW'];
        $my_email = "dev.eflight@pravahya.com";

        $callsign_mails = CallsignInfoModel::get_navlog_mails($data, $is_fpl);

        $departure_aerodrome_mails = AerodromeMailsModel::get_dep_cc_mail($departure_aerodrome, $departure_station);
        $destination_aerodrome_mails = AerodromeMailsModel::get_dest_cc_mail($destination_aerodrome, $destination_station);
        $get_support_mails = SupportMailsModel::get_support_mails();

        $get_local_mails = SupportMailsModel::get_local_mails();
        $get_local_mails = rtrim($get_local_mails, ',');
        $get_local_mails = explode(',', $get_local_mails);

        $callsign_mails = rtrim($callsign_mails, ',');
        $departure_aerodrome_mails = rtrim($departure_aerodrome_mails, ',');
        $destination_aerodrome_mails = rtrim($destination_aerodrome_mails, ',');
        $get_support_mails = ($get_support_mails) ? rtrim($get_support_mails, ',') : '';

        $departure_aerodrome_mails = ($departure_aerodrome_mails) ? $departure_aerodrome_mails . ',' : '';
        $destination_aerodrome_mails = ($destination_aerodrome_mails) ? $destination_aerodrome_mails . ',' : '';
        $callsign_mails = ($callsign_mails) ? $callsign_mails . ',' : '';
        $get_support_mails = ($get_support_mails) ? $get_support_mails . ',' : '';

        $my_email = ($my_email) ? $my_email . ',' : '';

        $concat_mails = $callsign_mails . $get_support_mails;

        if (in_array($aircraft_callsign, $callsign_array)) {
            $concat_mails = $callsign_mails . $get_support_mails . $my_email;
        }

        $concat_mails = trim($concat_mails, ',');

        $concat_mails2 = $callsign_mails . $departure_aerodrome_mails . $destination_aerodrome_mails . $get_support_mails;

        if (in_array($aircraft_callsign, $callsign_array)) {
            $concat_mails2 = $concat_mails2 . $my_email;
        }

        $concat_mails2 = trim($concat_mails2, ',');

        $cc_mails = explode(",", $concat_mails);
        $cc_mails2 = explode(",", $concat_mails2);


        $get_support_mails = rtrim($get_support_mails, ',');
        $get_support_mails = explode(",", $get_support_mails);

        if (count($get_local_mails) == 1) {
            $get_local_mails = SupportMailsModel::get_local_mails();
        }
        if (env('APP_ENV') == 'local') {
            $result = $get_local_mails;
        } elseif ($admin != '') {
            $result = ($get_support_mails) ? $get_support_mails : $get_local_mails;
        } else {
            $result = $cc_mails;
        }
        if ($aero_mails) {
            $result = $cc_mails2;
        }
//  print_r($result);exit;
        return $result;
    }

    public static function get_cc_mails($data, $admin = "", $is_fpl = "", $aero_mails = "") {
        $departure_aerodrome = (array_key_exists('departure_aerodrome', $data)) ? $data['departure_aerodrome'] : '';
        $destination_aerodrome = (array_key_exists('destination_aerodrome', $data)) ? $data['destination_aerodrome'] : '';
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $aircraft_callsign = (array_key_exists('aircraft_callsign', $data)) ? $data['aircraft_callsign'] : '';
        $aircraft_callsign = substr($aircraft_callsign, 0, 5);

        $callsign_array = ['TESTA', 'TESTB', 'TESTC', 'TESTH', 'TESTW'];
        $my_email = "dev.eflight@pravahya.com";

        $callsign_mails = CallsignInfoModel::get_mails($data, $is_fpl);

        $departure_aerodrome_mails = AerodromeMailsModel::get_dep_cc_mail($departure_aerodrome, $departure_station);
        $destination_aerodrome_mails = AerodromeMailsModel::get_dest_cc_mail($destination_aerodrome, $destination_station);
        $get_support_mails = SupportMailsModel::get_support_mails();

        $get_local_mails = SupportMailsModel::get_local_mails();
        $get_local_mails = rtrim($get_local_mails, ',');
        $get_local_mails = explode(',', $get_local_mails);

        $callsign_mails = rtrim($callsign_mails, ',');
        $departure_aerodrome_mails = rtrim($departure_aerodrome_mails, ',');
        $destination_aerodrome_mails = rtrim($destination_aerodrome_mails, ',');
        $get_support_mails = ($get_support_mails) ? rtrim($get_support_mails, ',') : '';

        $departure_aerodrome_mails = ($departure_aerodrome_mails) ? $departure_aerodrome_mails . ',' : '';
        $destination_aerodrome_mails = ($destination_aerodrome_mails) ? $destination_aerodrome_mails . ',' : '';
        $callsign_mails = ($callsign_mails) ? $callsign_mails . ',' : '';
        $get_support_mails = ($get_support_mails) ? $get_support_mails . ',' : '';

        $my_email = ($my_email) ? $my_email . ',' : '';

        $concat_mails = $callsign_mails . $get_support_mails;

        if (in_array($aircraft_callsign, $callsign_array)) {
            $concat_mails = $callsign_mails . $get_support_mails . $my_email;
        }

        $concat_mails = trim($concat_mails, ',');

        $concat_mails2 = $callsign_mails . $departure_aerodrome_mails . $destination_aerodrome_mails . $get_support_mails;

        if (in_array($aircraft_callsign, $callsign_array)) {
            $concat_mails2 = $concat_mails2 . $my_email;
        }

        $concat_mails2 = trim($concat_mails2, ',');

        $cc_mails = explode(",", $concat_mails);
        $cc_mails2 = explode(",", $concat_mails2);


        $get_support_mails = rtrim($get_support_mails, ',');
        $get_support_mails = explode(",", $get_support_mails);

        if (count($get_local_mails) == 1) {
            $get_local_mails = SupportMailsModel::get_local_mails();
        }
        if (env('APP_ENV') == 'local') {
            $result = $get_local_mails;
        } else if ($admin != '') {
            $result = ($get_support_mails) ? $get_support_mails : $get_local_mails;
        } else {
            $result = $cc_mails;
        }
        if ($aero_mails) {
            $result = $cc_mails2;
        }
        //  print_r($result);exit;
        return $result;
    }

    public static function get_bcc_mails() {
        $get_bcc_mails = SupportMailsModel::get_bcc_mails();
        $get_bcc_mails = rtrim($get_bcc_mails, ',');
        $bcc_mails = explode(",", $get_bcc_mails);

        $get_local_mails = SupportMailsModel::get_local_mails();
        $get_local_mails = rtrim($get_local_mails, ',');
        $get_local_mails = explode(',', $get_local_mails);

        if (count($get_local_mails) == 1) {
            $get_local_mails = SupportMailsModel::get_local_mails();
        }
        if (env('APP_ENV') == 'local') {
            $result = $get_local_mails;
        } else {
            $result = ($bcc_mails) ? $bcc_mails : $get_local_mails;
        }
        return $result;
    }

    public static function to_mail_ids($data) {
        $id = $data['id'];
        $user_details = User::get_user_details('', '', $id);
        $email = $user_details->additional_emails;
    }

    public static function get_dep_zzzz_name($data) {
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $result = '';
        if ($departure_aerodrome == 'ZZZZ') {
            $result = $departure_station;
        } else {
            $result = $departure_aerodrome;
        }
        return $result;
    }

    public static function get_navlog_dep_zzzz_name($data) {
        $departure_aerodrome = $data['departure'];
        $result = '';
        if ($departure_aerodrome == 'ZZZZ') {
            $result = $data['dept_place'];
        } else {
            $result = $departure_aerodrome;
        }
        return $result;
    }

    public static function get_dest_zzzz_name($data) {
        $destination_aerodrome = $data['destination_aerodrome'];
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $result = '';
        if ($destination_aerodrome == 'ZZZZ') {
            $result = $destination_station;
        } else {
            $result = $destination_aerodrome;
        }
        return $result;
    }

    public static function get_navlog_dest_zzzz_name($data) {
        $destination_aerodrome = $data['destination'];
        $result = '';
        if ($destination_aerodrome == 'ZZZZ') {
            $result = $data['dest_place'];
        } else {
            $result = $destination_aerodrome;
        }
        return $result;
    }

    public static function recurse_copy($src, $dest) {
        $dir = opendir($src);
        @mkdir($dest);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    myFunction::recurse_copy($src . '/' . $file, $dest . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dest . '/' . $file);
                }
            }
        }
        closedir($dir);
        return 'success';
    }

    public static function get_user_details(Request $request) {
        $email = $request->email;
        $mobile_number = $request->mobile_number;
        $result = User::where('is_active', 1)->where('email', $email)->orWhere('mobile_number', $mobile_number)->first();
        return ($result) ? $result : 0;
    }

    public static function get_sunrise_sunset_info($data, $dept = '') {
        $departure_aerodrome = (array_key_exists('departure_aerodrome', $data)) ? $data['departure_aerodrome'] : '';
        $destination_aerodrome = (array_key_exists('destination_aerodrome', $data)) ? $data['destination_aerodrome'] : '';

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';
        $current_date = date('n/j/Y');
        $next_date = date('n/j/Y', strtotime("+1 day"));
        $current_day = date('D');
        $next_day = date('D', strtotime("+1 day"));

        if ($dept) {
            $current_day_sunrise_sunset = SunriseSunsetModel::get_sunrise_sunset($departure_aerodrome, $current_date);
            $next_day_sunrise_sunset = SunriseSunsetModel::get_sunrise_sunset($departure_aerodrome, $next_date);
            $stations_data = StationsModel::get_aerodrome_details($departure_aerodrome, $departure_station);

            $aerodrome_name = ($stations_data) ? $stations_data->aero_name : $departure_station;
            $aero_latlong = ($stations_data) ? $stations_data->aero_latlong : '';
            $elevation = ($stations_data) ? $stations_data->elevation : '';
            $runways = ($stations_data) ? $stations_data->runways : '';
            $length = ($stations_data) ? $stations_data->length : '';
            $status = ($stations_data) ? $stations_data->status : '';

            $current_day_sunrise = ($current_day_sunrise_sunset) ? $current_day_sunrise_sunset->sunrise : '';
            $current_day_sunset = ($current_day_sunrise_sunset) ? $current_day_sunrise_sunset->sunset : '';

            $next_day_sunrise = ($next_day_sunrise_sunset) ? $next_day_sunrise_sunset->sunrise : '';
            $next_day_sunset = ($next_day_sunrise_sunset) ? $next_day_sunrise_sunset->sunset : '';

            $result = "<div class='station_info'>
            <ul>
            <li><h5>$aerodrome_name ($departure_aerodrome)</h5></li>
            <li>ARP: $aero_latlong</li>
            <li>Elevation: $elevation</li>
            </ul>
        </div>
        <div class='stat-desc'>
            <span class='stat-head'>Status :</span> <span class='stat-status'>$status</span>
        </div>
        <div class='stat-desc'>
            <span class='stat-head'>Runways :</span> <span class='stat-status stat-runway'>$runways</span>
            <span class='stat-head'>Length:</span> <span class='stat-status'>$length</span>
        </div>
        <div class='stat-desc'>
            <span class='stat-head'>$current_day Sunrise :</span> <span class='stat-status'>$current_day_sunrise</span>
            <span class='stat-head'>Sunset:</span> <span class='stat-status'>$current_day_sunset</span>
        </div>
        <div class='stat-desc'>
            <span class='stat-head'>$next_day Sunrise:</span> <span class='stat-status stat-riseset'>$next_day_sunrise</span>
            <span class='stat-head'>Sunset:</span> <span class='stat-status'>$next_day_sunset</span>
                </div>";
        } else {
            $current_day_sunrise_sunset = SunriseSunsetModel::get_sunrise_sunset($destination_aerodrome, $current_date);
            $next_day_sunrise_sunset = SunriseSunsetModel::get_sunrise_sunset($destination_aerodrome, $next_date);
            $stations_data = StationsModel::get_aerodrome_details($destination_aerodrome, $destination_station);

            $aerodrome_name = ($stations_data) ? $stations_data->aero_name : $destination_station;
            $aero_latlong = ($stations_data) ? $stations_data->aero_latlong : '';
            $elevation = ($stations_data) ? $stations_data->elevation : '';
            $runways = ($stations_data) ? $stations_data->runways : '';
            $length = ($stations_data) ? $stations_data->length : '';
            $status = ($stations_data) ? $stations_data->status : '';

            $current_day_sunrise = ($current_day_sunrise_sunset) ? $current_day_sunrise_sunset->sunrise : '';
            $current_day_sunset = ($current_day_sunrise_sunset) ? $current_day_sunrise_sunset->sunset : '';

            $next_day_sunrise = ($next_day_sunrise_sunset) ? $next_day_sunrise_sunset->sunrise : '';
            $next_day_sunset = ($next_day_sunrise_sunset) ? $next_day_sunrise_sunset->sunset : '';

            $result = "<div class='station_info'>
            <ul>
            <li><h5>$aerodrome_name ($destination_aerodrome)</h5></li>
            <li>ARP: $aero_latlong</li>
            <li>Elevation: $elevation</li>
            </ul>
        </div>
        <div class='stat-desc'>
            <span class='stat-head'>Status :</span> <span class='stat-status stat-runway'>$status</span>
        </div>
        <div class='stat-desc'>
            <span class='stat-head'>Runways :</span> <span class='stat-status stat-runway'>$runways</span>
            <span class='stat-head'>Length:</span> <span class='stat-status'>$length</span>
        </div>
        <div class='stat-desc'>
            <span class='stat-head'>$current_day Sunrise :</span> <span class='stat-status'>$current_day_sunrise</span>
            <span class='stat-head'>Sunset:</span> <span class='stat-status'>$current_day_sunset</span>
        </div>
        <div class='stat-desc'>
            <span class='stat-head'>$next_day Sunrise:</span> <span class='stat-status stat-riseset'>$next_day_sunrise</span>
            <span class='stat-head'>Sunset:</span> <span class='stat-status'>$next_day_sunset</span>
                </div>";
        }

        return $result;
    }

    public static function get_watch_hours_info($data, $dept = '') {
        $departure_aerodrome = (array_key_exists('departure_aerodrome', $data)) ? $data['departure_aerodrome'] : '';
        $destination_aerodrome = (array_key_exists('destination_aerodrome', $data)) ? $data['destination_aerodrome'] : '';

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

        $get_dept_watch_hours = WatchHoursModel::get_aerodrome_watch_hours($departure_aerodrome);
        $get_dest_watch_hours = WatchHoursModel::get_aerodrome_watch_hours($destination_aerodrome);

        $current_day = strtolower(date('l'));
        $next_day = strtolower(date('l', strtotime("+1 days")));

        $current_day_open_text = $current_day . '_open';
        $current_day_close_text = $current_day . '_close';
        $next_day_open_text = $next_day . '_open';
        $next_day_close_text = $next_day . '_close';

//  $current_day_open_time = $get_dept_watch_hours->$current_day_open_text;
        //  $current_day_close_time = $get_dept_watch_hours->$current_day_close_text;
        //  $next_day_open_time = $get_dept_watch_hours->$next_day_open_text;
        //  $next_day_close_time = $get_dept_watch_hours->$next_day_close_text;
        //  $current_day_timings = ($current_day_open_time != 'CLOSED') ? substr(strtoupper($current_day), 0, 3) . " = " . $current_day_open_time . " to " . $current_day_close_time : 'CLOSED';
        //  $next_day_timings = ($next_day_open_time != 'CLOSED') ? substr(strtoupper($next_day), 0, 3) . " = " . $next_day_open_time . " to " . $next_day_close_time : 'CLOSED';

        if ($dept) {
            $current_day_open_time = ($get_dept_watch_hours) ? $get_dept_watch_hours->$current_day_open_text : '';
            $current_day_close_time = ($get_dept_watch_hours) ? $get_dept_watch_hours->$current_day_close_text : '';
            $next_day_open_time = ($get_dept_watch_hours) ? $get_dept_watch_hours->$next_day_open_text : '';
            $next_day_close_time = ($get_dept_watch_hours) ? $get_dept_watch_hours->$next_day_close_text : '';
            $current_day_timings = ($current_day_open_time != 'CLOSED') ? substr(strtoupper($current_day), 0, 3) . " = " . $current_day_open_time . " to " . $current_day_close_time : 'CLOSED';
            $next_day_timings = ($next_day_open_time != 'CLOSED') ? substr(strtoupper($next_day), 0, 3) . " = " . $next_day_open_time . " to " . $next_day_close_time : 'CLOSED';
            return "<span class='stat-head'>Watch Hours (in UTC):</span> " . $current_day_timings . " , " . $next_day_timings;
        } else {
            $current_day_open_time = ($get_dest_watch_hours) ? $get_dest_watch_hours->$current_day_open_text : '';
            $current_day_close_time = ($get_dest_watch_hours) ? $get_dest_watch_hours->$current_day_close_text : '';
            $next_day_open_time = ($get_dest_watch_hours) ? $get_dest_watch_hours->$next_day_open_text : '';
            $next_day_close_time = ($get_dest_watch_hours) ? $get_dest_watch_hours->$next_day_close_text : '';
            $current_day_timings = ($current_day_open_time != 'CLOSED') ? substr(strtoupper($current_day), 0, 3) . " = " . $current_day_open_time . " to " . $current_day_close_time : 'CLOSED';
            $next_day_timings = ($next_day_open_time != 'CLOSED') ? substr(strtoupper($next_day), 0, 3) . " = " . $next_day_open_time . " to " . $next_day_close_time : 'CLOSED';
            return "<span class='stat-head'>Watch Hours (in UTC):</span> " . $current_day_timings . " , " . $next_day_timings;
        }
    }

    public static function Fpl_change2($data) {

        $email = $data['email'];
        $user_mobile = (array_key_exists('user_mobile', $data)) ? $data['user_mobile'] : '';
        $user_details = User::get_user_name($user_mobile);
        $user_name = ($user_details) ? $user_details->name : '';
        $changed_by = $user_name;

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
        $flight_rule_email = '';
        $speed_email = '';
        $equipment_email = '';
        $flying_email = '';
        $other_changes_email = '';
        $flight_type_changes_email = '';
        $mail_send = '';
        $id = $data['is_id'];

        $fpl_details = FlightPlanDetailsModel::find($id);

        $flight_rules = (array_key_exists('flight_rules', $data)) ? $data['flight_rules'] : '';
        $flight_rules2 = ($fpl_details) ? $fpl_details->flight_rules : '';
        $flight_type2 = ($fpl_details) ? $fpl_details->flight_type : '';
        $flight_type = (array_key_exists('flight_type', $data)) ? $data['flight_type'] : '';


        if ($flight_type != $flight_type2) {
            $flight_type_changes_email = 1;
            $flight_type_text = "<span  style='color:red'>" . $flight_type . '</span>';
        }

        if ($flight_rules2 != $flight_rules) {
            $flight_rule_email = 1;
            $flight_rules_text = "<span  style='color:red'>" . $flight_rules . '</span>';
        }

        $crushing_speed = $data['crushing_speed'];
        $crushing_speed_indication = $data['crushing_speed_indication'];
        $flight_level = $data['flight_level'];
        $flight_level_indication = $data['flight_level_indication'];
        $route = $data['route'];

        $crushing_speed2 = ($fpl_details) ? $fpl_details->crushing_speed : '';
        $crushing_speed_indication2 = ($fpl_details) ? $fpl_details->crushing_speed_indication : '';
        $flight_level2 = ($fpl_details) ? $fpl_details->flight_level : '';
        $flight_level_indication2 = ($fpl_details) ? $fpl_details->flight_level_indication : '';
        $route2 = ($fpl_details) ? $fpl_details->route : '';

        if ($crushing_speed2 != $crushing_speed) {
            $speed_email = 1;
            $crushing_speed = "<span style='color:red'>" . $crushing_speed . '</span>';
        }
        if ($crushing_speed_indication2 != $crushing_speed_indication) {
            $speed_email = 1;
            $crushing_speed_indication = "<span  style='color:red'>" . $crushing_speed_indication . '</span>';
        }
        if ($flight_level2 != $flight_level) {
            $speed_email = 1;
            $flight_level = "<span  style='color:red'>" . $flight_level . '</span>';
        }
        if ($flight_level_indication2 != $flight_level_indication) {
            $speed_email = 1;
            $flight_level_indication = "<span  style='color:red'>" . $flight_level_indication . '</span>';
        }
        if ($route2 != $route) {
            $speed_email = 1;
            $route = "<span  style='color:red'>" . $route . '</span>';
        }


        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        // $changed_by = $this->user_name;
        $equipment = $data['equipment'];
        $transponder = ($data['transponder'] && $data['transponder'] != '') ? ($data['transponder'] != "Transponder Mode") ? $data['transponder'] : "" : ''; //$data['transponder'];


        if (strpos($equipment, '/') === FALSE) {
            $transponder_value = ($data['transponder']) ? '/' . $data['transponder'] : '';
        } else {
            $transponder_value = ($data['transponder']) ? $data['transponder'] : '';
            $transponder_value = ($transponder_value != 'Transponder Mode') ? $transponder_value : "";
        }


        $equipment2 = ($fpl_details) ? $fpl_details->equipment : '';
        $transponder2 = ($fpl_details) ? $fpl_details->transponder : '';

        if ($equipment2 != $equipment) {
            $equipment_email = 1;

            $equipment = "<span style='color:red'>" . $equipment . '</span>';
        }
        if ($transponder2 != $transponder) {
            $equipment_email = 1;

            $transponder_value = "<span  style='color:red'>" . $transponder_value . '</span>';
        }

        $first_alternate_aerodrome = $data['first_alternate_aerodrome'];
        $second_alternate_aerodrome = $data['second_alternate_aerodrome'];

        $total_flying_hours2 = ($fpl_details) ? $fpl_details->total_flying_hours : '';
        $total_flying_minutes2 = ($fpl_details) ? $fpl_details->total_flying_minutes : '';
        $first_alternate_aerodrome2 = ($fpl_details) ? $fpl_details->first_alternate_aerodrome : '';
        $second_alternate_aerodrome2 = ($fpl_details) ? $fpl_details->second_alternate_aerodrome : '';

        if ($total_flying_hours2 != $total_flying_hours) {
            $flying_email = 1;
            $total_flying_hours = "<span style='color:red'>" . $total_flying_hours . '</span>';
        }
        if ($total_flying_minutes2 != $total_flying_minutes) {
            $flying_email = 1;
            $total_flying_minutes = "<span  style='color:red'>" . $total_flying_minutes . '</span>';
        }
        if ($first_alternate_aerodrome2 != $first_alternate_aerodrome) {
            $flying_email = 1;
            $first_alternate_aerodrome = "<span  style='color:red'>" . $first_alternate_aerodrome . '</span>';
        }
        if ($second_alternate_aerodrome2 != $second_alternate_aerodrome) {
            $flying_email = 1;
            $second_alternate_aerodrome = "<span  style='color:red'>" . $second_alternate_aerodrome . '</span>';
        }


        $cabincrew = ($data['cabincrew']) ? $data['cabincrew'] : '';

        $pbn = (array_key_exists('pbn', $data)) ? $data['pbn'] : '';
        $nav = (array_key_exists('nav', $data)) ? $data['nav'] : '';
        $registration = (array_key_exists('registration', $data)) ? $data['registration'] : '';
        $fir_crossing_time = (array_key_exists('fir_crossing_time', $data)) ? $data['fir_crossing_time'] : '';
        $sel = (array_key_exists('sel', $data)) ? $data['sel'] : '';
        $code = (array_key_exists('code', $data)) ? $data['code'] : '';
        $operator = (array_key_exists('operator', $data)) ? $data['operator'] : '';
        $per = (array_key_exists('per', $data)) ? $data['per'] : '';
        $take_off_altn = (array_key_exists('take_off_altn', $data)) ? $data['take_off_altn'] : '';
        $route_altn = (array_key_exists('route_altn', $data)) ? $data['route_altn'] : '';
        $tcas = (array_key_exists('tcas', $data)) ? ($data['tcas'] == 'YES') ? 'YES' : 'NO' : 'NO';
        $credit = (array_key_exists('credit', $data)) ? $data['credit'] : '';
        $remarks = $data['remarks'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $indian = $data['indian'];
        $foreigner = $data['foreigner'];
        $foreigner_nationality = $data['foreigner_nationality'];
        $endurance_hours = $data['endurance_hours'];
        $endurance_minutes = $data['endurance_minutes'];
       // $route = $data['route'];
        $alternate_station = (array_key_exists('alternate_station', $data)) ? $data['alternate_station'] : '';


        $pbn2 = ($fpl_details) ? $fpl_details->pbn : '';
        $nav2 = ($fpl_details) ? $fpl_details->nav : '';
        $registration2 = ($fpl_details) ? $fpl_details->registration : '';
        $fir_crossing_time2 = ($fpl_details) ? $fpl_details->fir_crossing_time : '';
        $sel2 = ($fpl_details) ? $fpl_details->sel : '';
        $code2 = ($fpl_details) ? $fpl_details->code : '';
        $operator2 = ($fpl_details) ? $fpl_details->operator : '';
        $per2 = ($fpl_details) ? $fpl_details->per : '';
        $take_off_altn2 = ($fpl_details) ? $fpl_details->take_off_altn : '';
        $route_altn2 = ($fpl_details) ? $fpl_details->route_altn : '';
        $tcas2 = ($fpl_details) ? ($fpl_details->tcas == 'YES') ? 'YES' : 'NO' : 'NO';
        $credit2 = ($fpl_details) ? $fpl_details->credit : '';
        $remarks2 = ($fpl_details) ? $fpl_details->remarks : '';
        $indian2 = ($fpl_details) ? $fpl_details->indian : '';
        $foreigner2 = ($fpl_details) ? $fpl_details->foreigner : '';
        $foreigner_nationality2 = ($fpl_details) ? $fpl_details->foreigner_nationality : '';
        $pilot_in_command2 = ($fpl_details) ? $fpl_details->pilot_in_command : '';
        $mobile_number2 = ($fpl_details) ? $fpl_details->mobile_number : '';
        $endurance_hours2 = ($fpl_details) ? $fpl_details->endurance_hours : '';
        $endurance_minutes2 = ($fpl_details) ? $fpl_details->endurance_minutes : '';
        $alternate_station2 = ($fpl_details) ? $fpl_details->alternate_station : '';

        $copilot2 = ($fpl_details) ? $fpl_details->copilot : '';
        $cabincrew2 = ($fpl_details) ? $fpl_details->cabincrew : '';
        $indian_value = "<span>ALL INDIANS ON BOARD </span>";

        if ($pbn2 != $pbn) {
            $other_changes_email = 1;
            $pbn = "<span style='color:red'>" . $pbn . '</span>';
        }
        if ($nav2 != $nav) {
            $other_changes_email = 1;

            $nav = "<span  style='color:red'>" . $nav . '</span>';
        }
        if ($registration2 != $registration) {
            $other_changes_email = 1;
            $registration = "<span  style='color:red'>" . $registration . '</span>';
        }
        if ($fir_crossing_time2 != $fir_crossing_time) {
            $other_changes_email = 1;
            $fir_crossing_time = "<span  style='color:red'>" . $fir_crossing_time . '</span>';
        }
        if ($sel2 != $sel) {
            $other_changes_email = 1;

            $sel = "<span  style='color:red'>" . $sel . '</span>';
        }
        if ($code2 != $code) {
            $other_changes_email = 1;

            $code = "<span  style='color:red'>" . $code . '</span>';
        }
        if ($operator2 != $operator) {
            $other_changes_email = 1;

            $operator = "<span  style='color:red'>" . $operator . '</span>';
        }
        if ($per2 != $per) {
            $other_changes_email = 1;

            $per = "<span  style='color:red'>" . $per . '</span>';
        }
        if ($take_off_altn2 != $take_off_altn) {
            $other_changes_email = 1;
            $take_off_altn = "<span  style='color:red'>" . $take_off_altn . '</span>';
        }
        if ($route_altn2 != $route_altn) {
            $other_changes_email = 1;
            $route_altn = "<span  style='color:red'>" . $route_altn . '</span>';
        }
        if ($tcas2 != $tcas) {
            $other_changes_email = 1;
            $tcas_value = ($tcas == 'YES') ? "<span  style='color:red'>TCAS EQUIPPED</span>" : '';
        } else {
            $tcas_value = ($tcas == 'YES') ? "TCAS EQUIPPED" : '';
        }
        if ($credit2 != $credit) {
            $other_changes_email = 1;
            $credit_value = ($credit == "YES") ? "<span style='color:red'> CREDIT FACILITY AVAILABLE WITH AAI </span>" : "<span  style='color:red'> NO CREDIT FACILITY</span>";
        } else {
            $credit_value = ($credit == "YES") ? " CREDIT FACILITY AVAILABLE WITH AAI " : ' NO CREDIT FACILITY';
        }
        if ($remarks2 != $remarks) {
            $other_changes_email = 1;
            $remarks = "<span  style='color:red'>" . $remarks . '</span>';
        }
        if ($indian2 != $indian) {
            $other_changes_email = 1;
//            $indian = "<span  style='color:red'>" . $indian . '</span>';
            $indian_value = "<span  style='color:red'>ALL INDIANS ON BOARD </span>";
        }
        if ($foreigner_nationality2 != $foreigner_nationality) {
            $other_changes_email = 1;
            $foreigner_nationality = "<span  style='color:red'>" . $foreigner_nationality . '</span>';
        }
        if ($pilot_in_command2 != $pilot_in_command) {
            $other_changes_email = 1;
            $pilot_in_command = "<span  style='color:red'>" . $pilot_in_command . '</span>';
        }
        if ($mobile_number2 != $mobile_number) {
            $other_changes_email = 1;
            $mobile_number = "<span  style='color:red'>" . $mobile_number . '</span>';
        }
        if ($endurance_hours2 != $endurance_hours) {
            $other_changes_email = 1;
            $endurance_hours = "<span  style='color:red'>" . $endurance_hours . '</span>';
        }
        if ($endurance_minutes2 != $endurance_minutes) {
            $other_changes_email = 1;
            $endurance_minutes = "<span  style='color:red'>" . $endurance_minutes . '</span>';
        }
        $copilot_value = "<span>CO PILOT " . $copilot . '</span>';
        if ($copilot2 != $copilot) {
            $other_changes_email = 1;
            $copilot_value = "<span  style='color:red'>CO PILOT " . $copilot . '</span>';
        }
        $cabincrew_value = "<span>CABIN CREW " . ($cabincrew) ? $cabincrew : 'NA' . '</span>';
        if ($cabincrew2 != $cabincrew) {
            $other_changes_email = 1;
            $cabincrew_value = "<span  style='color:red'>CABIN CREW " . ($cabincrew) ? $cabincrew : 'NA' . '</span>';
        }

        $pbn_value = ($pbn) ? "PBN/" . $pbn . " " : '';
        $nav_value = ($nav) ? "NAV/" . $nav . " " : '';
        $fir_crossing_time_value = ($fir_crossing_time) ? " EET/" . $fir_crossing_time . " " : '';
        $code_value = ($code) ? " CODE/" . $code . "" : '';
        $sel_value = ($sel) ? " SEL/" . $sel . "" : '';
        $per_value = ($per) ? " PER/" . $per . "" : '';
        $alternate_station_value = ($alternate_station) ? " ALTN/" . $alternate_station . "" : '';
        $take_off_altn_value = ($take_off_altn) ? " TALT/" . $take_off_altn . "" : '';
        $route_altn_value = ($route_altn) ? " RALT/" . $route_altn . "" : '';

        $foreigner_value_callsigns = ['VTOBR', 'VTVRL', 'VTANF', 'VTVAM', 'VTVAK', 'VTZOA','VTEQK'];

        if (in_array(substr($aircraft_callsign, 0, 5), $foreigner_value_callsigns) || substr($aircraft_callsign, 0, 2) == 'ZO') {
            $display_all_indians = 0;
        } else {
            $display_all_indians = 1;
        }

        $indian_value = ($indian == "YES" && $display_all_indians) ? $indian_value : '';
        $foreigner_value = ($foreigner == "YES") ? " FOREIGNER ON BOARD " . $foreigner_nationality : "";

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
        $subject = "CHANGE FPL " . $aircraft_callsign . " " . $departure_aerodrome2 . " " . $departure_time_hours . $departure_time_minutes . " - " . $destination_aerodrome2 . " // " . $date_format;

        $data['changed_by'] = "Changed  By: <span style=color:#f00;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];
 
        if($flight_type_changes_email){
        $data['flight_type_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" .
                $date_of_flight . "-7/" . $flight_rules . $flight_type_text . ")";
        }else{
            $data['flight_type_change_heading'] = "";
        }

        if($flight_rule_email){
        $data['flight_rule_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" .
                $date_of_flight . "-8/" . $flight_rules_text . $flight_type . ")";
        }else{
            $data['flight_rule_change_heading'] = "";
        }
        
        if($speed_email){
        $data['speed_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" .
                $date_of_flight . "-15/" . $crushing_speed_indication . $crushing_speed . $flight_level_indication . $flight_level . " " . $route . ")";
        }else{
          $data['speed_change_heading'] = "";  
        }
        
        if($equipment_email){
        $data['equipments_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . "-10/"
                . $equipment . "" . $transponder_value . ")";
        }else{
            $data['equipments_change_heading'] = "";
        }
        if($flying_email){
        $data['flying_time_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight
                . "-16/" . $destination_aerodrome . $total_flying_hours . $total_flying_minutes
                . " " . $first_alternate_aerodrome . " " . $second_alternate_aerodrome . ")";
        }else{
            $data['flying_time_change_heading'] = "";
        }
        
        if($other_changes_email){
        $data['other_changes_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight
                . "-18/" . $pbn_value . $nav_value . " REG/" . $registration .
                $fir_crossing_time_value . $sel_value . $code_value . " OPR/" . $operator . $alternate_station_value . $take_off_altn_value .
                $route_altn_value . " RMK/ " . $remarks . ' ' . $tcas_value . $credit_value . " PIC " .
                $pilot_in_command . " MOB " . $mobile_number . " " . $indian_value . $foreigner_value . " E" . $endurance_hours . $endurance_minutes . " " . $copilot_value . " " . $cabincrew_value .
                ")";
        }else{
             $data['other_changes_heading'] = "";
        }
        
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => self::from(),
            'from_name' => self::from_name(),
            'subject' => $subject,
            'to' => $email,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        if ($flight_rule_email || $equipment_email || $speed_email || $flying_email || $other_changes_email || $flight_type_changes_email) {
//      Mail::send('emails.fpl.myaccount.flight_rule_change', $data, function($message) use($mail_headers) {
            //      $message->from($mail_headers['from'], $mail_headers['from_name']);
            //      $message->to($mail_headers['to']);
            //      $message->subject($mail_headers['subject']);
            //      $message->cc($mail_headers['cc']);
            //      $message->bcc($mail_headers['bcc']);
            //      });
            $mail_send = 1;
            Log::info("FlightRuleChangeEmailJob Queues Begins");
            app(Dispatcher::class)->dispatch(new FlightRuleChangeEmailJob($data));
            Log::info("FlightRuleChangeEmailJob Queues ends");
        }
        return $mail_send;
    }

    public static function speed_change2($data) {
        $email = $data['email'];
//        $user_details = User::get_user_details($email);
        $user_mobile = (array_key_exists('user_mobile', $data)) ? $data['user_mobile'] : '';
        $user_details = User::get_user_name($user_mobile);
        $user_name = ($user_details) ? $user_details->name : '';
        $changed_by = $user_name;

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
        $crushing_speed = $data['crushing_speed'];
        $crushing_speed_indication = $data['crushing_speed_indication'];
        $flight_level = $data['flight_level'];
        $flight_level_indication = $data['flight_level_indication'];
        $route = $data['route'];
        $mail_send = '';
        $id = $data['is_id'];
        $fpl_details = FlightPlanDetailsModel::find($id);

        $crushing_speed2 = ($fpl_details) ? $fpl_details->crushing_speed : '';
        $crushing_speed_indication2 = ($fpl_details) ? $fpl_details->crushing_speed_indication : '';
        $flight_level2 = ($fpl_details) ? $fpl_details->flight_level : '';
        $flight_level_indication2 = ($fpl_details) ? $fpl_details->flight_level_indication : '';
        $route2 = ($fpl_details) ? $fpl_details->route : '';

        if ($crushing_speed2 != $crushing_speed) {
            $mail_send = 1;
            $crushing_speed = "<span style='color:red'>" . $crushing_speed . '</span>';
        }
        if ($crushing_speed_indication2 != $crushing_speed_indication) {
            $mail_send = 1;
            $crushing_speed_indication = "<span  style='color:red'>" . $crushing_speed_indication . '</span>';
        }
        if ($flight_level2 != $flight_level) {
            $mail_send = 1;
            $flight_level = "<span  style='color:red'>" . $flight_level . '</span>';
        }
        if ($flight_level_indication2 != $flight_level_indication) {
            $mail_send = 1;
            $flight_level_indication = "<span  style='color:red'>" . $flight_level_indication . '</span>';
        }
        if ($route2 != $route) {
            $mail_send = 1;
            $route = "<span  style='color:red'>" . $route . '</span>';
        }


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
        $subject = "CHANGE FPL " . $aircraft_callsign . " " . $departure_aerodrome2 . " " . $departure_time_hours . $departure_time_minutes . " - " . $destination_aerodrome2 . " // " . $date_format;

        $data['changed_by'] = "Changed  By: <span style=color:#f00;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];

        $data['speed_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" .
                $date_of_flight . "-15/" . $crushing_speed_indication . $crushing_speed . $flight_level_indication . $flight_level . " " . $route . ")";

        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => self::from(),
            'from_name' => self::from_name(),
            'subject' => $subject,
            'to' => $email,
//      'cc' => $this->cc,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        if ($mail_send) {
//      Mail::send('emails.fpl.myaccount.speed_change', $data, function($message) use($mail_headers) {
            //      $message->from($mail_headers['from'], $mail_headers['from_name']);
            //      $message->to($mail_headers['to']);
            //      $message->subject($mail_headers['subject']);
            //      $message->cc($mail_headers['cc']);
            //      $message->bcc($mail_headers['bcc']);
            //      });
            Log::info("SpeedChangeEmailJob Queues Begins");
            app(Dispatcher::class)->dispatch(new SpeedChangeEmailJob($data));
            Log::info("SpeedChangeEmailJob Queues ends");
        }
        return $mail_send;
    }

    public static function equipments_change2($data) {
        $id = $data['is_id'];
        $email = $data['email'];
        $user_mobile = (array_key_exists('user_mobile', $data)) ? $data['user_mobile'] : '';
        $user_details = User::get_user_name($user_mobile);
//        $user_details = User::get_user_details($email);
        $user_name = ($user_details) ? $user_details->name : '';
        $changed_by = $user_name;

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
        // $changed_by = $this->user_name;
        $equipment = $data['equipment'];
        $transponder = ($data['transponder'] && $data['transponder'] != '') ? ($data['transponder'] != "Transponder Mode") ? $data['transponder'] : "" : ''; //$data['transponder'];


        if (strpos($equipment, '/') === FALSE) {
            $transponder_value = ($data['transponder']) ? '/' . $data['transponder'] : '';
        } else {
            $transponder_value = ($data['transponder']) ? $data['transponder'] : '';
            $transponder_value = ($transponder_value != 'Transponder Mode') ? $transponder_value : "";
        }

        $mail_send = '';

        $fpl_details = FlightPlanDetailsModel::find($id);

        $equipment2 = ($fpl_details) ? $fpl_details->equipment : '';
        $transponder2 = ($fpl_details) ? $fpl_details->transponder : '';

        if ($equipment2 != $equipment) {
            $mail_send = 1;

            $equipment = "<span style='color:red'>" . $equipment . '</span>';
        }
        if ($transponder2 != $transponder) {
            $mail_send = 1;

            $transponder_value = "<span  style='color:red'>" . $transponder_value . '</span>';
        }

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
        $subject = "CHANGE FPL " . $aircraft_callsign . " " . $departure_aerodrome2 . " " . $departure_time_hours . $departure_time_minutes . " - " . $destination_aerodrome2 . " // " . $date_format;
        $data['changed_by'] = "Changed  By: <span style=color:#f00;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];

        $data['equipments_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight . "-10/"
                . $equipment . "" . $transponder_value . ")";
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => self::from(),
            'from_name' => self::from_name(),
            'subject' => $subject,
            'to' => $email,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        if ($mail_send) {
//      Mail::send('emails.fpl.myaccount.equipments_change', $data, function($message) use($mail_headers) {
            //      $message->from($mail_headers['from'], $mail_headers['from_name']);
            //      $message->to($mail_headers['to']);
            //      $message->subject($mail_headers['subject']);
            //      $message->cc($mail_headers['cc']);
            //      $message->bcc($mail_headers['bcc']);
            //      });
            Log::info("EquipmentChangeEmailJob Queues Begins");
            app(Dispatcher::class)->dispatch(new EquipmentChangeEmailJob($data));
            Log::info("EquipmentChangeEmailJob Queues Begins");
        }
        return $mail_send;
    }

    public static function flying_time_change2($data) {
        $email = $data['email'];
//        $user_details = User::get_user_details($email);
        $user_mobile = (array_key_exists('user_mobile', $data)) ? $data['user_mobile'] : '';
        $user_details = User::get_user_name($user_mobile);
        $user_name = ($user_details) ? $user_details->name : '';
        $changed_by = $user_name;

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
        $first_alternate_aerodrome = $data['first_alternate_aerodrome'];
        $second_alternate_aerodrome = $data['second_alternate_aerodrome'];

        $mail_send = '';
        $id = $data['is_id'];
        $fpl_details = FlightPlanDetailsModel::find($id);

        $total_flying_hours2 = ($fpl_details) ? $fpl_details->total_flying_hours : '';
        $total_flying_minutes2 = ($fpl_details) ? $fpl_details->total_flying_minutes : '';
        $first_alternate_aerodrome2 = ($fpl_details) ? $fpl_details->first_alternate_aerodrome : '';
        $second_alternate_aerodrome2 = ($fpl_details) ? $fpl_details->second_alternate_aerodrome : '';

        if ($total_flying_hours2 != $total_flying_hours) {
            $mail_send = 1;
            $total_flying_hours = "<span style='color:red'>" . $total_flying_hours . '</span>';
        }
        if ($total_flying_minutes2 != $total_flying_minutes) {
            $mail_send = 1;
            $total_flying_minutes = "<span  style='color:red'>" . $total_flying_minutes . '</span>';
        }
        if ($first_alternate_aerodrome2 != $first_alternate_aerodrome) {
            $mail_send = 1;
            $first_alternate_aerodrome = "<span  style='color:red'>" . $first_alternate_aerodrome . '</span>';
        }
        if ($second_alternate_aerodrome2 != $second_alternate_aerodrome) {
            $mail_send = 1;
            $second_alternate_aerodrome = "<span  style='color:red'>" . $second_alternate_aerodrome . '</span>';
        }

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
        $subject = "CHANGE FPL " . $aircraft_callsign . " " . $departure_aerodrome2 . " " . $departure_time_hours . $departure_time_minutes . " - " . $destination_aerodrome2 . " // " . $date_format;
        $data['changed_by'] = "Changed  By: <span style=color:#f00;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];

        $data['flying_time_change_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight
                . "-16/" . $destination_aerodrome . $total_flying_hours . $total_flying_minutes
                . " " . $first_alternate_aerodrome . " " . $second_alternate_aerodrome . ")";

        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => self::from(),
            'from_name' => self::from_name(),
            'subject' => $subject,
            'to' => $email,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];
        if ($mail_send) {
//      Mail::send('emails.fpl.myaccount.flying_time_change', $data, function($message) use($mail_headers) {
            //      $message->from($mail_headers['from'], $mail_headers['from_name']);
            //      $message->to($mail_headers['to']);
            //      $message->subject($mail_headers['subject']);
            //      $message->cc($mail_headers['cc']);
            //      $message->bcc($mail_headers['bcc']);
            //      });
            Log::info("FlyingTimeChangeEmailJob Queues Begins");
            app(Dispatcher::class)->dispatch(new FlyingTimeChangeEmailJob($data));
            Log::info("FlyingTimeChangeEmailJob Queues Begins");
        }
        return $mail_send;
    }

    public static function other_changes2($data) {
        //Values after change
        $email = $data['email'];
//        $user_details = User::get_user_details($email);
        $user_mobile = (array_key_exists('user_mobile', $data)) ? $data['user_mobile'] : '';
        $user_details = User::get_user_name($user_mobile);
        $user_name = ($user_details) ? $user_details->name : '';
        $changed_by = $user_name;

        $aircraft_callsign = $data['aircraft_callsign'];
        $departure_aerodrome = $data['departure_aerodrome'];
        $departure_time_hours = $data['departure_time_hours'];
        $departure_time_minutes = $data['departure_time_minutes'];
        $destination_aerodrome = $data['destination_aerodrome'];
        $date_of_flight = $data['date_of_flight'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $copilot = $data['copilot'];
        $cabincrew = ($data['cabincrew']) ? $data['cabincrew'] : '';
        $total_flying_hours = $data['total_flying_hours'];
        $total_flying_minutes = $data['total_flying_minutes'];

        $pbn = (array_key_exists('pbn', $data)) ? $data['pbn'] : '';
        $nav = (array_key_exists('nav', $data)) ? $data['nav'] : '';
        $registration = (array_key_exists('registration', $data)) ? $data['registration'] : '';
        $fir_crossing_time = (array_key_exists('fir_crossing_time', $data)) ? $data['fir_crossing_time'] : '';
        $sel = (array_key_exists('sel', $data)) ? $data['sel'] : '';
        $code = (array_key_exists('code', $data)) ? $data['code'] : '';
        $operator = (array_key_exists('operator', $data)) ? $data['operator'] : '';
        $per = (array_key_exists('per', $data)) ? $data['per'] : '';
        $take_off_altn = (array_key_exists('take_off_altn', $data)) ? $data['take_off_altn'] : '';
        $route_altn = (array_key_exists('route_altn', $data)) ? $data['route_altn'] : '';
        $tcas = (array_key_exists('tcas', $data)) ? ($data['tcas'] == 'YES') ? 'YES' : 'NO' : 'NO';
        $credit = (array_key_exists('credit', $data)) ? $data['credit'] : '';
        $remarks = $data['remarks'];
        $pilot_in_command = $data['pilot_in_command'];
        $mobile_number = $data['mobile_number'];
        $indian = $data['indian'];
        $foreigner = $data['foreigner'];
        $foreigner_nationality = $data['foreigner_nationality'];
        $endurance_hours = $data['endurance_hours'];
        $endurance_minutes = $data['endurance_minutes'];
        $route = $data['route'];
        $alternate_station = (array_key_exists('alternate_station', $data)) ? $data['alternate_station'] : '';
        $flight_rules = (array_key_exists('flight_rules', $data)) ? $data['flight_rules'] : '';

        $mail_send = '';
        $id = $data['is_id'];
        //Values before change
        $fpl_details = FlightPlanDetailsModel::find($id);

        $pbn2 = ($fpl_details) ? $fpl_details->pbn : '';
        $nav2 = ($fpl_details) ? $fpl_details->nav : '';
        $registration2 = ($fpl_details) ? $fpl_details->registration : '';
        $fir_crossing_time2 = ($fpl_details) ? $fpl_details->fir_crossing_time : '';
        $sel2 = ($fpl_details) ? $fpl_details->sel : '';
        $code2 = ($fpl_details) ? $fpl_details->code : '';
        $operator2 = ($fpl_details) ? $fpl_details->operator : '';
        $per2 = ($fpl_details) ? $fpl_details->per : '';
        $take_off_altn2 = ($fpl_details) ? $fpl_details->take_off_altn : '';
        $route_altn2 = ($fpl_details) ? $fpl_details->route_altn : '';
        $tcas2 = ($fpl_details) ? ($fpl_details->tcas == 'YES') ? 'YES' : 'NO' : 'NO';
        $credit2 = ($fpl_details) ? $fpl_details->credit : '';
        $remarks2 = ($fpl_details) ? $fpl_details->remarks : '';
        $indian2 = ($fpl_details) ? $fpl_details->indian : '';
        $foreigner2 = ($fpl_details) ? $fpl_details->foreigner : '';
        $foreigner_nationality2 = ($fpl_details) ? $fpl_details->foreigner_nationality : '';
        $pilot_in_command2 = ($fpl_details) ? $fpl_details->pilot_in_command : '';
        $mobile_number2 = ($fpl_details) ? $fpl_details->mobile_number : '';
        $endurance_hours2 = ($fpl_details) ? $fpl_details->endurance_hours : '';
        $endurance_minutes2 = ($fpl_details) ? $fpl_details->endurance_minutes : '';
        $alternate_station2 = ($fpl_details) ? $fpl_details->alternate_station : '';
        $flight_rules2 = ($fpl_details) ? $fpl_details->flight_rules : '';

        $copilot2 = ($fpl_details) ? $fpl_details->copilot : '';
        $cabincrew2 = ($fpl_details) ? $fpl_details->cabincrew : '';
        $indian_value = "<span>ALL INDIANS ON BOARD </span>";

        if ($pbn2 != $pbn) {
            $mail_send = 1;
            $pbn = "<span style='color:red'>" . $pbn . '</span>';
        }
        if ($nav2 != $nav) {
            $mail_send = 1;

            $nav = "<span  style='color:red'>" . $nav . '</span>';
        }
        if ($registration2 != $registration) {
            $mail_send = 1;
            $registration = "<span  style='color:red'>" . $registration . '</span>';
        }
        if ($fir_crossing_time2 != $fir_crossing_time) {
            $mail_send = 1;
            $fir_crossing_time = "<span  style='color:red'>" . $fir_crossing_time . '</span>';
        }
        if ($sel2 != $sel) {
            $mail_send = 1;

            $sel = "<span  style='color:red'>" . $sel . '</span>';
        }
        if ($code2 != $code) {
            $mail_send = 1;

            $code = "<span  style='color:red'>" . $code . '</span>';
        }
        if ($operator2 != $operator) {
            $mail_send = 1;

            $operator = "<span  style='color:red'>" . $operator . '</span>';
        }
        if ($per2 != $per) {
            $mail_send = 1;

            $per = "<span  style='color:red'>" . $per . '</span>';
        }
        if ($take_off_altn2 != $take_off_altn) {
            $mail_send = 1;
            $take_off_altn = "<span  style='color:red'>" . $take_off_altn . '</span>';
        }
        if ($route_altn2 != $route_altn) {
            $mail_send = 1;
            $route_altn = "<span  style='color:red'>" . $route_altn . '</span>';
        }
        if ($tcas2 != $tcas) {
            $mail_send = 1;
            $tcas_value = ($tcas == 'YES') ? "<span  style='color:red'>TCAS EQUIPPED</span>" : '';
        } else {
            $tcas_value = ($tcas == 'YES') ? "TCAS EQUIPPED" : '';
        }
        if ($credit2 != $credit) {
            $mail_send = 1;
            $credit_value = ($credit == "YES") ? "<span style='color:red'> CREDIT FACILITY AVAILABLE WITH AAI </span>" : "<span  style='color:red'> NO CREDIT FACILITY</span>";
        } else {
            $credit_value = ($credit == "YES") ? " CREDIT FACILITY AVAILABLE WITH AAI " : ' NO CREDIT FACILITY';
        }
        if ($remarks2 != $remarks) {
            $mail_send = 1;
            $remarks = "<span  style='color:red'>" . $remarks . '</span>';
        }
        if ($indian2 != $indian) {
            $mail_send = 1;
//            $indian = "<span  style='color:red'>" . $indian . '</span>';
            $indian_value = "<span  style='color:red'>ALL INDIANS ON BOARD </span>";
        }
        if ($foreigner_nationality2 != $foreigner_nationality) {
            $mail_send = 1;
            $foreigner_nationality = "<span  style='color:red'>" . $foreigner_nationality . '</span>';
        }
        if ($pilot_in_command2 != $pilot_in_command) {
            $mail_send = 1;
            $pilot_in_command = "<span  style='color:red'>" . $pilot_in_command . '</span>';
        }
        if ($mobile_number2 != $mobile_number) {
            $mail_send = 1;
            $mobile_number = "<span  style='color:red'>" . $mobile_number . '</span>';
        }
        if ($endurance_hours2 != $endurance_hours) {
            $mail_send = 1;
            $endurance_hours = "<span  style='color:red'>" . $endurance_hours . '</span>';
        }
        if ($endurance_minutes2 != $endurance_minutes) {
            $mail_send = 1;
            $endurance_minutes = "<span  style='color:red'>" . $endurance_minutes . '</span>';
        }
        $copilot_value = "<span>CO PILOT " . $copilot . '</span>';
        if ($copilot2 != $copilot) {
            $mail_send = 1;
            $copilot_value = "<span  style='color:red'>CO PILOT " . $copilot . '</span>';
        }
        $cabincrew_value = "<span>CABIN CREW " . ($cabincrew) ? $cabincrew : 'NA' . '</span>';
        if ($cabincrew2 != $cabincrew) {
            $mail_send = 1;
            $cabincrew_value = "<span  style='color:red'>CABIN CREW " . ($cabincrew) ? $cabincrew : 'NA' . '</span>';
        }

        $pbn_value = ($pbn) ? "PBN/" . $pbn . " " : '';
        $nav_value = ($nav) ? "NAV/" . $nav . " " : '';
        $fir_crossing_time_value = ($fir_crossing_time) ? " EET/" . $fir_crossing_time . " " : '';
        $code_value = ($code) ? " CODE/" . $code . "" : '';
        $sel_value = ($sel) ? " SEL/" . $sel . "" : '';
        $per_value = ($per) ? " PER/" . $per . "" : '';
        $alternate_station_value = ($alternate_station) ? " ALTN/" . $alternate_station . "" : '';
        $take_off_altn_value = ($take_off_altn) ? " TALT/" . $take_off_altn . "" : '';
        $route_altn_value = ($route_altn) ? " RALT/" . $route_altn . "" : '';

        $foreigner_value_callsigns = ['VTOBR', 'VTVRL', 'VTANF', 'VTVAM', 'VTVAK', 'VTZOA'];

        if (in_array(substr($aircraft_callsign, 0, 5), $foreigner_value_callsigns) || substr($aircraft_callsign, 0, 2) == 'ZO') {
            $display_all_indians = 0;
        } else {
            $display_all_indians = 1;
        }

        $indian_value = ($indian == "YES" && $display_all_indians) ? $indian_value : '';

        $foreigner_value = ($foreigner == "YES") ? " FOREIGNER ON BOARD " . $foreigner_nationality : "";

        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $departure_latlong = (array_key_exists('departure_latlong', $data)) ? $data['departure_latlong'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $destination_latlong = (array_key_exists('destination_latlong', $data)) ? $data['destination_latlong'] : '';

        $departure_aerodrome2 = $departure_aerodrome;
        $destination_aerodrome2 = $destination_aerodrome;
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
        $subject = "CHANGE FPL " . $aircraft_callsign . " " . $departure_aerodrome2 . " " . $departure_time_hours . $departure_time_minutes . " - " . $destination_aerodrome2 . " // " . $date_format;
        $data['changed_by'] = "Changed  By: <span style=color:#f00;>$changed_by</span>";
        $data['changed_date'] = "<span style='margin-left:27px;color:#404040;'></span>Changed  Date: <span style='color:#f00;'>" . date('d-M-Y') . "</span>";
        date_default_timezone_set('Asia/Calcutta');
        $data['changed_time'] = "<span style='margin-left:27px;color:#404040;'></span> Changed  Time: <span style='color:#f00;'>" . date('H:i') . "  IST" . "</span>";
        $data['changed_via'] = "<span style='margin-left:33px;color:#404040;'></span>Changed  Via: " . $_SERVER['HTTP_HOST'];
        $data['other_changes_heading'] = "(CHG-" . $aircraft_callsign . "-" . $departure_aerodrome . "" .
                $departure_time_hours . "" . $departure_time_minutes . "-" . $destination_aerodrome . "-DOF/" . $date_of_flight
                . "-18/" . $pbn_value . $nav_value . " REG/" . $registration .
                $fir_crossing_time_value . $sel_value . $code_value . " OPR/" . $operator . $alternate_station_value . $take_off_altn_value .
                $route_altn_value . " RMK/ " . $remarks . ' ' . $tcas_value . $credit_value . " PIC " .
                $pilot_in_command . " MOB " . $mobile_number . " " . $indian_value . $foreigner_value . " E" . $endurance_hours . $endurance_minutes . " " . $copilot_value . " " . $cabincrew_value .
                ")";

//  (CHG-CALLSIGN-DEP AERODEP TIME-DEST AERO-DATE OF FLIGHT/YYMMDD-18/PBN/
        //  NAV/  DOF/  REG/  EET/  SEL/  CODE/ OPR/  ALTN/  PER/  TALT/  RALT/  RMK/HELLO TCAS EQUIPPED CREDIT FACILITY AVAILABLE
        //      WITH AAI PIC NAME MOB 1234512345 FOREIGNER ON BOARD ITALIAN E0100)
        $data['get_zzzz_value'] = myFunction::get_zzzz_value($data);
        $data['subject'] = $subject;
        $mail_headers = [
            'from' => self::from(),
            'from_name' => self::from_name(),
            'subject' => $subject,
            'to' => $email,
//      'cc' => $this->cc,
            'cc' => myFunction::get_cc_mails($data),
            'bcc' => myFunction::get_bcc_mails(),
        ];

        if ($mail_send) {
//      Mail::send('emails.fpl.myaccount.other_changes', $data, function($message) use($mail_headers) {
            //      $message->from($mail_headers['from'], $mail_headers['from_name']);
            //      $message->to($mail_headers['to']);
            //      $message->subject($mail_headers['subject']);
            //      $message->cc($mail_headers['cc']);
            //      $message->bcc($mail_headers['bcc']);
            //      });
            Log::info("OtherChangesEmailJob Queues Begins");
            app(Dispatcher::class)->dispatch(new OtherChangesEmailJob($data));
            Log::info("OtherChangesEmailJob Queues Begins");
        }
        return $mail_send;
    }

    public static function watch_hours_tooltip($aerodrome, $date_of_flight) {
        $dof = strtolower(date('l', strtotime($date_of_flight)));
        $day = date('l', strtotime($date_of_flight));
        $result = WatchHoursModel::get_aerodrome_watch_hours2($aerodrome, $dof, $date_of_flight);
        $res1 = '';
        $res2 = '';
        $dof_open = $dof . '_open';
        $dof_close = $dof . '_close';

        foreach ($result as $key => $result_value) {
            $open = ($result_value->$dof_open) ? $result_value->$dof_open : '';
            if ($open) {
                $strlen = strlen($open);
                switch ($strlen) {
                    case '1':
                        $open = '000' . $open;
                        break;
                    case '2':
                        $open = '00' . $open;
                        break;
                    case '3':
                        $open = '0' . $open;
                        break;
                    default:
                        break;
                }
            } else {
                $open = '0000';
            }
            if ($open == 'CLOSED') {
                $ist = 'CLOSED';
            } else if ($open == '0000') {
                $ist = '0000 IST';
            } else {
                $ist = date('Hi', strtotime($open . "+330 minutes")) . ' IST';
            }
            $res1 .= '<p> ' . $open . ' UTC (' . $ist . ')</p>';
        }

        foreach ($result as $key => $result_value) {

            $close = ($result_value->$dof_close) ? $result_value->$dof_close : '';
            if ($close) {
                $strlen = strlen($close);
                switch ($strlen) {
                    case '1':
                        $close = '000' . $close;
                        break;
                    case '2':
                        $close = '00' . $close;
                        break;
                    case '3':
                        $close = '0' . $close;
                        break;
                    default:
                        break;
                }
            } else {
                $close = '0000';
            }

            if ($close == 'CLOSED') {
                $ist = 'CLOSED';
            } else if ($close == '2359') {
                $ist = '2359 IST';
            } else {
                $ist = date('Hi', strtotime($close . "+330 minutes")) . ' IST';
            }
            $res2 .= '<p> ' . $close . ' UTC (' . $ist . ')</p>';
        }

        $img1 = url('media/images/fpl/open-close1.png');
        $img2 = url('media/images/fpl/open-close2.png');

        $res = "<p class='oc-time-day' style='z-index:99999; padding: 3px 0; text-transform: uppercase;'>$day</p>
            <div class='col-md-6 noleftpad norightpad'>
                <img style='margin-bottom:5px;' src='$img1' width='22'>
               $res1
            </div>
            <div class='col-md-6 noleftpad norightpad'>
                <img style='margin-bottom:5px;' src='$img2' width='22'>
               $res2
            </div>";
        return $res;
    }

    public static function watch_hours_tooltip2($aerodrome, $date_of_flight) {
        $dof = strtolower(date('l', strtotime('20' . $date_of_flight)));
        $day = date('l', strtotime('20' . $date_of_flight));
        $result = WatchHoursModel::get_aerodrome_watch_hours2($aerodrome, $dof, $date_of_flight);
        $res1 = '';
        $res2 = '';
        $dof_open = $dof . '_open';
        $dof_close = $dof . '_close';
        $dof_remarks = $dof . '_remarks';
        $dof_remarks_result = WatchHoursModel::where('aerodrome', $aerodrome)
                ->where('w_start_date', '<=', $date_of_flight)
                ->where('w_end_date', '>', $date_of_flight)
                ->first([$dof_remarks]);
        $dof_remarks = ($dof_remarks_result) ? $dof_remarks_result->$dof_remarks : '';

        foreach ($result as $key => $result_value) {
            $open = ($result_value->$dof_open) ? $result_value->$dof_open : '';

            if ($open) {
                $strlen = strlen($open);
                switch ($strlen) {
                    case '1':
                        $open = '000' . $open;
                        break;
                    case '2':
                        $open = '00' . $open;
                        break;
                    case '3':
                        $open = '0' . $open;
                        break;
                    default:
                        break;
                }
            } else {
                $open = '0000';
            }
            if ($open != 'CLOSED') {
                $ist = date('Hi', strtotime($open . "+330 minutes")) . ' IST';
            } else {
                $ist = 'CLOSED';
            }
            $res1 .= '<p> ' . $open . ' UTC (' . $ist . ')</p>';
        }

        foreach ($result as $key => $result_value) {
            $close = ($result_value->$dof_close) ? $result_value->$dof_close : '';
            if ($close) {
                $strlen = strlen($close);
                switch ($strlen) {
                    case '1':
                        $close = '000' . $close;
                        break;
                    case '2':
                        $close = '00' . $close;
                        break;
                    case '3':
                        $close = '0' . $close;
                        break;
                    default:
                        break;
                }
            } else {
                $close = '0000';
            }

            if ($close != 'CLOSED') {
                $ist = date('Hi', strtotime($close . "+330 minutes")) . ' IST';
            } else {
                $ist = 'CLOSED';
            }
            $res2 .= '<p> ' . $close . ' UTC (' . $ist . ')</p>';
        }

        $img1 = url('media/images/fpl/open-close1.png');
        $img2 = url('media/images/fpl/open-close2.png');

        $res = "<div class='oc-time-box1' style='box-shadow: 0 0 3px 1px #000'><p class='oc-time-day' style='z-index:99999; padding: 3px 0; text-transform: uppercase;'>$day</p>
            <div class='col-md-6 noleftpad norightpad'>
                <img style='margin-bottom:5px;' src='$img1' width='22'>
               $res1
            </div>
            <div class='col-md-6 noleftpad norightpad'>
                <img style='margin-bottom:5px;' src='$img2' width='22'>
               $res2
            </div>
            <div class='col-md-12  noleftpad norightpad' style='color:black;margin-top:9px;font-size:12px'>
               $dof_remarks
            </div></div>";
        return $res;
    }

    public static function test() {
        
    }

    public static function getNotamCount($aero_code, $date_of_flight, $departure_time_hours, $departure_time_minutes, $total_flying_hours, $total_flying_minutes, $type) {

        $notams = new NotamsModel;
        $date_of_flight_org = $date_of_flight;
        $date_of_flight = date('d-M-Y', strtotime('20' . $date_of_flight));



        $dept_time = $departure_time_hours . '' . $departure_time_minutes;
        $total_flying_time = ($total_flying_hours * 60) + $total_flying_minutes + 180;
        $endTime = strtotime("+$total_flying_time minutes", strtotime($dept_time));

        $minutes_end_time = date('i', $endTime);
        $endTimeRemainder = 30 - ($minutes_end_time % 30);
        if ($endTimeRemainder > 15) {
            $endTime = strtotime("-" . ($minutes_end_time % 30) . " minutes", $endTime);
        } else {
            $endTime = strtotime("+" . ($endTimeRemainder) . " minutes", $endTime);
        }

        $endTime = date('Hi', $endTime);

        $startTime = strtotime("-120 minutes", strtotime($dept_time));
        $minutes_start_time = date('i', $startTime);
        $startTimeRemainder = 30 - ($minutes_start_time % 30);
        if ($startTimeRemainder > 15) {
            $startTime = strtotime("-" . ($minutes_start_time % 30) . " minutes", $startTime);
        } else {
            $startTime = strtotime("+" . ($startTimeRemainder) . " minutes", $startTime);
        }

        $startTime = date('Hi', $startTime);



        $start_date = date_create("20" . $date_of_flight_org . " " . $dept_time);
        $end_date = date_create("20" . $date_of_flight_org . " " . $dept_time);

        date_add($start_date, date_interval_create_from_date_string("-120 minutes"));
        date_add($end_date, date_interval_create_from_date_string("+$total_flying_time minutes"));

        $date1 = $start_date;
        $date2 = $end_date;
        $diff = date_diff($date1, $date2);
        $notamDatesArr = array(date_format($date1, "d-m-Y"));
        // print_r($diff);
        for ($i = 0; $i < $diff->format("%a") || (date_format($date1, "d-m-Y") != date_format($date2, "d-m-Y")); $i++) {
            date_add($date1, date_interval_create_from_date_string("1 days"));
            array_push($notamDatesArr, date_format($date1, "d-m-Y"));
        }


        switch ($type) {
            case 'dep':
                // $end_date = date_create("20" . $date_of_flight_org . " " . $dept_time);
                // date_add($end_date, date_interval_create_from_date_string("+120 minutes"));
                $endTime = strtotime("+120 minutes", strtotime($dept_time));
                $endTime = date('Hi', $endTime);
                break;
            case 'dest':
                $startTime = strtotime("-240 minutes", strtotime($endTime));
                $startTime = date('Hi', $startTime);
                $endTime = strtotime("-60 minutes", strtotime($endTime));
                $endTime = date('Hi', $endTime);
                break;
            case 'altn':
                $startTime = strtotime("-180 minutes", strtotime($endTime));
                $startTime = date('Hi', $startTime);
                break;
            case 'fir':

                break;
            default:
                # code...
                break;
        }


        $result = $notams::filterNotamsDataFpl(array($aero_code), date_format(($start_date), 'Y-m-d'), date_format(($end_date), 'Y-m-d'), NULL, NULL, array(), $startTime, $endTime, $notamDatesArr);

        return sizeof($result);
    }

    public static function getFirNotams($departure_aerodrome, $destination_aerodrome, $first_alternate_aerodrome, $second_alternate_aerodrome, $date_of_flight, $departure_time_hours, $departure_time_minutes, $total_flying_hours, $total_flying_minutes) {
        $firList = array("VI" => "VIDF", "VE" => "VECF", "VA" => "VABF", "VO" => "VOMF");
        $firArr = array();
        if (!empty($departure_aerodrome)) {
            $firList1 = (array_key_exists(substr($departure_aerodrome, 0, 2), $firList)) ? $firList[substr($departure_aerodrome, 0, 2)] : '';
            array_push($firArr, $firList1);
        }
        if (!empty($destination_aerodrome)) {
            $firList2 = (array_key_exists(substr($destination_aerodrome, 0, 2), $firList)) ? $firList[substr($destination_aerodrome, 0, 2)] : '';
            array_push($firArr, $firList2);
        }
        if (!empty($first_alternate_aerodrome)) {
            $firList3 = (array_key_exists(substr($first_alternate_aerodrome, 0, 2), $firList)) ? $firList[substr($first_alternate_aerodrome, 0, 2)] : '';
            array_push($firArr, $firList3);
            // array_push($firArr, $firList[substr($first_alternate_aerodrome, 0, 2)]);
        }
        if (!empty($second_alternate_aerodrome)) {
            $firList4 = (array_key_exists(substr($second_alternate_aerodrome, 0, 2), $firList)) ? $firList[substr($second_alternate_aerodrome, 0, 2)] : '';
            array_push($firArr, $firList4);
            // array_push($firArr, $firList[substr($second_alternate_aerodrome, 0, 2)]);
        }
        $firArr = array_unique($firArr);
        foreach ($firArr as $value) {
            if (!empty($value)) {
                echo "<p data-a='" . $departure_aerodrome . "' data-b='" . $destination_aerodrome . "'
                  data-c=" . $first_alternate_aerodrome . " data-d='" . $second_alternate_aerodrome . "'
                  data-dep-time='" . $departure_time_hours . ":" . $departure_time_minutes . "'
                  data-flying-time='" . $total_flying_hours . ":" . $total_flying_minutes . "'
                  class='view_the_notams'><span class='aerodrome-name-notams'>" . $value . "</span> : <span class='notam-count'>" . myFunction::getNotamCount($value, $date_of_flight, $departure_time_hours, $departure_time_minutes, $total_flying_hours, $total_flying_minutes, 'fir') . "</span></p>";
            }
        }
    }
    public static function get_fuel_cc_mails($data, $admin = "", $is_fpl = "", $aero_mails = "") {
        $departure_aerodrome = (array_key_exists('departure_aerodrome', $data)) ? $data['departure_aerodrome'] : '';
        $destination_aerodrome = (array_key_exists('destination_aerodrome', $data)) ? $data['destination_aerodrome'] : '';
        $departure_station = (array_key_exists('departure_station', $data)) ? $data['departure_station'] : '';
        $destination_station = (array_key_exists('destination_station', $data)) ? $data['destination_station'] : '';
        $aircraft_callsign = (array_key_exists('aircraft_callsign', $data)) ? $data['aircraft_callsign'] : '';
        $aircraft_callsign = substr($aircraft_callsign, 0, 5);
        $callsign_array = ['TESTA', 'TESTB', 'TESTC', 'TESTH', 'TESTW'];
        $my_email = "dev.eflight@pravahya.com";
        $callsign_mails = CallsignInfoModel::get_mails($data, $is_fpl);
        $departure_aerodrome_mails = AerodromeMailsModel::get_dep_cc_mail($departure_aerodrome, $departure_station);
        $destination_aerodrome_mails = AerodromeMailsModel::get_dest_cc_mail($destination_aerodrome, $destination_station);
        $get_support_mails = SupportMailsModel::get_support_mails();
        $get_local_mails = SupportMailsModel::get_local_mails();
        $get_local_mails = rtrim($get_local_mails, ',');
        $get_local_mails = explode(',', $get_local_mails);

        $callsign_mails = rtrim($callsign_mails, ',');
        $departure_aerodrome_mails = rtrim($departure_aerodrome_mails, ',');
        $destination_aerodrome_mails = rtrim($destination_aerodrome_mails, ',');
        $get_support_mails = ($get_support_mails) ? rtrim($get_support_mails, ',') : '';

        $departure_aerodrome_mails = ($departure_aerodrome_mails) ? $departure_aerodrome_mails . ',' : '';
        $destination_aerodrome_mails = ($destination_aerodrome_mails) ? $destination_aerodrome_mails . ',' : '';
        $callsign_mails = ($callsign_mails) ? $callsign_mails . ',' : '';
        $get_support_mails = ($get_support_mails) ? $get_support_mails . ',' : '';

        $my_email = ($my_email) ? $my_email . ',' : '';

        $concat_mails = $callsign_mails . $get_support_mails;

        if (in_array($aircraft_callsign, $callsign_array)) {
            $concat_mails = $callsign_mails . $get_support_mails . $my_email;
        }

        $concat_mails = trim($concat_mails, ',');

        $concat_mails2 = $callsign_mails . $departure_aerodrome_mails . $destination_aerodrome_mails . $get_support_mails;

        if (in_array($aircraft_callsign, $callsign_array)) {
            $concat_mails2 = $concat_mails2 . $my_email;
        }

        $concat_mails2 = trim($concat_mails2, ',');

        $cc_mails = explode(",", $concat_mails);
        $cc_mails2 = explode(",", $concat_mails2);


        $get_support_mails = rtrim($get_support_mails, ',');
        $get_support_mails = explode(",", $get_support_mails);

        if (count($get_local_mails) == 1) {
            $get_local_mails = SupportMailsModel::get_local_mails();
        }
        if (env('APP_ENV') == 'local') {
            $result = $get_local_mails;
        } else if ($admin != '') {
            $result = ($get_support_mails) ? $get_support_mails : $get_local_mails;
        } else {
            $result = $cc_mails;
        }
        if ($aero_mails) {
            $result = $cc_mails2;
        }
//  print_r($result);exit;
        return $result;
    }

}
