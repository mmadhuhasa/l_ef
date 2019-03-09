<div class="row">
    <input type="hidden" name="utcdate" id="utcdate" value="{{date("d-M-Y")}}" />
    <input type="hidden" name="gmt_time" id="gmt_time" value="{{gmdate("H:i",strtotime('0 hour +30 minutes'))}}" />
    <input type="hidden" name="is_process_click" id="is_process_click" value="" />
    <input type="hidden" name="is_new_plan" id="is_new_plan" value="{{(isset($is_new_plan)) ? $is_new_plan : ''  }}" />
    <input type="hidden" name="flight_rules" id="flight_rules" value="{{(isset($flight_rules)) ? $flight_rules : ''  }}" />
    <input type="hidden" name="flight_type" id="flight_type" value="{{(isset($flight_type)) ? $flight_type : ''  }}" />
    <input type="hidden" name="aircraft_type" id="aircraft_type" value="{{(isset($aircraft_type)) ? $aircraft_type : ''  }}" />
    <input type="hidden" name="weight_category" id="weight_category" value="{{(isset($weight_category)) ? $weight_category : ''  }}" />
    <input type="hidden" name="equipment" id="equipment" value="{{(isset($equipment)) ? $equipment : ''  }}" />
    <input type="hidden" name="transponder" id="transponder" value="{{(isset($transponder)) ? $transponder : ''  }}" />
    <input type="hidden" name="alternate_station" id="alternate_station" value="{{(isset($alternate_station)) ? $alternate_station : ''  }}" />
    <input type="hidden" name="registration" id="registration" value="{{(isset($registration)) ? $registration : ''  }}" />
    <input type="hidden" name="operator" id="operator" value="{{(isset($operator)) ? $operator : ''  }}" />

    <input type="hidden" name="sel" id="sel" value="{{(isset($sel)) ? $sel : ''  }}" />
    <input type="hidden" name="pbn" id="pbn" value="{{(isset($pbn)) ? $pbn : ''  }}" />
    <input type="hidden" name="nav" id="nav" value="{{(isset($nav)) ? $nav : ''  }}" />
    <input type="hidden" name="code" id="code" value="{{(isset($code)) ? $code : ''  }}" />
    <input type="hidden" name="per" id="per" value="{{(isset($per)) ? $per : ''  }}" />
    <input type="hidden" name="tcas" id="tcas" value="{{(isset($tcas)) ? $tcas : ''  }}" />
    <input type="hidden" name="credit" id="credit" value="{{(isset($credit)) ? $credit : ''  }}" />
    <input type="hidden" name="emergency_uhf" id="emergency_uhf" value="{{(isset($emergency_uhf)) ? $emergency_uhf : ''  }}" />
    <input type="hidden" name="emergency_vhf" id="emergency_vhf" value="{{(isset($emergency_vhf)) ? $emergency_vhf : ''  }}" />
    <input type="hidden" name="emergency_elba" id="emergency_elba" value="{{(isset($emergency_elba)) ? $emergency_elba : ''  }}" />
    <input type="hidden" name="polar" id="polar" value="{{(isset($polar)) ? $polar : ''  }}" />
    <input type="hidden" name="desert" id="desert" value="{{(isset($desert)) ? $desert : ''  }}" />
    <input type="hidden" name="maritime" id="maritime" value="{{(isset($maritime)) ? $maritime : ''  }}" />
    <input type="hidden" name="jungle" id="jungle" value="{{(isset($jungle)) ? $jungle : ''  }}" />
    <input type="hidden" name="light" id="light" value="{{(isset($light)) ? $light : ''  }}" />
    <input type="hidden" name="floures" id="floures" value="{{(isset($floures)) ? $floures : ''  }}" />

    <input type="hidden" name="jacket_uhf" id="jacket_uhf" value="{{(isset($jacket_uhf)) ? $jacket_uhf : ''  }}" />
    <input type="hidden" name="jacket_vhf" id="jacket_vhf" value="{{(isset($jacket_vhf)) ? $jacket_vhf : ''  }}" />
    <input type="hidden" name="number" id="number" value="{{(isset($number)) ? $number : ''  }}" />
    <input type="hidden" name="capacity" id="capacity" value="{{(isset($capacity)) ? $capacity : ''  }}" />
    <input type="hidden" name="cover" id="cover" value="{{(isset($cover)) ? $cover : ''  }}" />
    <input type="hidden" name="color" id="color" value="{{(isset($color)) ? $color : ''  }}" />
    <input type="hidden" name="aircraft_color" id="aircraft_color" value="{{(isset($aircraft_color)) ? $aircraft_color : ''  }}" />
    <input type="hidden" name="filing_date" id="filing_date" value="{{(isset($filing_date)) ? $filing_date : ''  }}" />
    <input type="hidden" name="filed_date" id="filed_date" value="{{(isset($filed_date)) ? $filed_date : ''  }}" />

    <input type="hidden" required name="departure_time_hours" id="departure_time_hours" value="{{(isset($departure_time_hours)) ? $departure_time_hours : '' }}" />
    <input type="hidden" required name="departure_time_minutes" id="departure_time_minutes" value="{{(isset($departure_time_minutes)) ? $departure_time_minutes : '' }}" />
    <input type="hidden" name="crushing_speed_indication" id="crushing_speed_indication" value="{{(isset($crushing_speed_indication)) ? $crushing_speed_indication : ''  }}" />
    <input type="hidden" name="crushing_speed" id="crushing_speed" value="{{(isset($crushing_speed)) ? $crushing_speed : ''  }}" />
    <input type="hidden" name="flight_level_indication" id="flight_level_indication" value="{{(isset($flight_level_indication)) ? $flight_level_indication : ''  }}" />
    <input type="hidden" name="flight_level" id="flight_level" value="{{(isset($flight_level)) ? $flight_level : ''  }}" />
    <input type="hidden" name="total_flying_hours" id="total_flying_hours" value="{{(isset($total_flying_hours)) ? $total_flying_hours : ''  }}" />
    <input type="hidden" name="total_flying_minutes" id="total_flying_minutes" value="{{(isset($total_flying_minutes)) ? $total_flying_minutes : ''  }}" />
    <input type="hidden" name="route" id="route" value="{{(isset($route)) ? $route : ''  }}" />
    <input type="hidden" name="route1" id="route1" value="" />
    <input type="hidden" name="route_altn" id="route_altn" value="{{(isset($route_altn)) ? $route_altn : ''  }}" />
    <input type="hidden" name="first_alternate_aerodrome" id="first_alternate_aerodrome" value="{{(isset($first_alternate_aerodrome)) ? $first_alternate_aerodrome : ''  }}" />
    <input type="hidden" name="second_alternate_aerodrome" id="second_alternate_aerodrome" value="{{(isset($second_alternate_aerodrome)) ? $second_alternate_aerodrome : ''  }}" />
    <input type="hidden" name="take_off_altn" id="take_off_altn" value="{{(isset($take_off_altn)) ? $take_off_altn : ''  }}" />
    <input type="hidden" name="indian" id="indian" value="{{(isset($indian))?  (($indian == 'YES') ? "YES" : "NO" ) : "NO" }}" />
    <input type="hidden" name="foreigner" id="foreigner" value="{{(isset($indian))?  (($indian == 'NO') ? "YES" : "NO" ) : "" }}" />
    <input type="hidden" name="foreigner_nationality" id="foreigner_nationality" value="{{(isset($foreigner_nationality)) ? $foreigner_nationality : ''  }}" />
    <input type="hidden" name="endurance_hours" id="endurance_hours" value="{{(isset($endurance_hours)) ? $endurance_hours : ''  }}" />
    <input type="hidden" name="endurance_minutes" id="endurance_minutes" value="{{(isset($endurance_minutes)) ? $endurance_minutes : ''  }}" />
    <input type="hidden" name="fir_crossing_time" id="fir_crossing_time" value="{{(isset($fir_crossing_time)) ? $fir_crossing_time : ''  }}" />
    <!--<input type="hidden" name="remarks" id="remarks" value="{{(isset($remarks)) ? substr($remarks,0,50) : ''  }}" />-->
    <input type="hidden" name="remarks1" id="remarks1" value="" />
</div>