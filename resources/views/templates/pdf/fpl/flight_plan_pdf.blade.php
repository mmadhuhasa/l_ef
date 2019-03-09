<?php
$img = 'pdfbg.png';
?>
<table border="0" cellpadding="0" cellspacing="0"  height="500" width="700"   style='background-repeat: no-repeat;'>
    <tr>
        <td>
            <table border="0" width="330" height="500" cellpadding="0" cellspacing="0">
                <tr>
                    <td  style="color:#333333 !important; font-size:20px; font-family: Arial, Verdana, sans-serif;" height="40">                     
                        <img src="{{$img}}" alt="Smiley face" height="950" width="720" />    
                        <?php
                        $emergency_uhf = ($emergency_uhf == "NO") ? '<img src="media/pdf/fpl/UHF Tick.png" />' : '<img src="media/pdf/fpl/UHF Blank.png" />';
                        $emergency_vhf = ($emergency_vhf == "NO") ? '<img src="media/pdf/fpl/VHF Tick.png" />' : '<img src="media/pdf/fpl/VHF Blank.png" />';
                        $emergency_elba = ($emergency_elba == "NO") ? '<img src="media/pdf/fpl/ELT Tick.png" />' : '<img src="media/pdf/fpl/ELT Blank.png" />';
                        $polar = ($polar == "NO") ? '<img src="media/pdf/fpl/POLAR Tick.png" />' : '<img src="media/pdf/fpl/POLAR Blank.png" />';
                        $desert = ($desert == "NO") ? '<img src="media/pdf/fpl/DESERT Tick.png" />' : '<img src="media/pdf/fpl/DESERT Blank.png" />';
                        $maritime = ($maritime == "NO") ? '<img src="media/pdf/fpl/MARITIME Tick.png" />' : '<img src="media/pdf/fpl/MARITIME Blank.png" />';
                        $jungle = ($jungle == "NO") ? '<img src="media/pdf/fpl/JACKETS Tick.png" />' : '<img src="media/pdf/fpl/JACKETS Blank.png" />';
                        $light = ($light == "NO") ? '<img src="media/pdf/fpl/LIGHT Tick.png" />' : '<img src="media/pdf/fpl/LIGHT Blank.png" />';
                        $floures = ($floures == "NO") ? '<img src="media/pdf/fpl/FLUORES Tick.png" />' : '<img src="media/pdf/fpl/FLUORES Blank.png" />';
                        $jacket_uhf = ($jacket_uhf == "NO") ? '<img src="media/pdf/fpl/UHF Tick1.png" />' : '<img src="media/pdf/fpl/UHF Blank1.png" />';
                        $jacket_vhf = ($jacket_vhf == "NO") ? '<img src="media/pdf/fpl/VHF Tick1.png" />' : '<img src="media/pdf/fpl/VHF Blank1.png" />';
                        $cover = ($cover == "NO") ? '<img src="media/pdf/fpl/COVER Tick.png"/> ' : '<img src="media/pdf/fpl/COVER Blank.png" />';
                        $pbn = ($pbn) ? ' PBN/' . $pbn . ' ' : '';
                        $nav = ($nav) ? 'NAV/' . $nav . ' ' : '';
                        $departure_latlong = ($departure_latlong) ? 'DEP/' . $departure_latlong . ' ' : '';
                        $departure_station = ($departure_station && $departure_aerodrome =="ZZZZ") ? '' . $departure_station . ' ' : '';
                        $destination_latlong = ($destination_latlong) ? 'DEST/' . $destination_latlong . ' ' : '';
                        $destination_station = ($destination_station && $destination_aerodrome == "ZZZZ") ? $destination_station . ' ' : '';
                        $fir_crossing_time = ($fir_crossing_time) ? ' EET/' . $fir_crossing_time : '';
                        $sel = ($sel) ? 'SEL/' . $sel : '';
                        $code = ($code) ? ' CODE/' . $code : '';
                        $per = ($per) ? ' PER/' . $per : '';
                        $route_altn = ($route_altn) ? ' RALT/' . $route_altn : '';
                        $take_off_altn = ($take_off_altn) ? ' TALT/' . $take_off_altn : '';
//			if ($first_alternate_aerodrome == 'ZZZZ' || $second_alternate_aerodrome == 'ZZZZ') {
//			    $alternate_station = 'ALL OPEN SPACES AND HELIPAD ENROUTE';
//			}
                        $alternate_station = ($alternate_station) ? ' ALTN/' . $alternate_station : '';
                        if ($destination_aerodrome == 'VAPO') {
                            $remarks_value = ' RMK/ARRIVAL COORDINATED WITH PUNE ATC ' . $remarks;
                        } else {
                            $remarks_value = ($remarks) ? ' RMK/' . $remarks : ' RMK/';
                        }
                        if(substr($aircraft_callsign, 0, 5)=="VTRNK"||substr($aircraft_callsign, 0, 5)=="VTCLN"||substr($aircraft_callsign, 0, 5)=="VTCLR")
                         $credit='';
                        else
                         $credit = ($credit == "NO") ? '  NO CREDIT FACILITY' : '  CREDIT FACILITY AVAILABLE WITH AAI';

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

                        $indian_value = ($indian == "YES" && $display_all_indians) ? " ALL INDIANS ON BOARD " : '';

//			$foreigner = ($indian == "NO") ? ' FOREIGNER ON BOARD' : '';
                        $foreigner_nationality = ($indian == "NO" && $callsigns_text_not) ? ' FOREIGNER ON BOARD ' . $foreigner_nationality : '';

                        $aircraft_callsign_exists = "media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png";
                        $aircraft_callsign_path = url("media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png");
                        $aircraft_callsign_signature = (file_exists($aircraft_callsign_exists)) ? '<img width="62px" height="21px" src=' . $aircraft_callsign_path . ' />' : '';

                        $pilot_in_command_strip = preg_replace('/( *)/', '', $pilot_in_command);

                        $pilot_in_command_exists = "media/pdf/fpl/signatures/" . $pilot_in_command_strip . ".png";
                        $pilot_in_command_path = url('media/pdf/fpl/signatures/' . $pilot_in_command_strip . '.png');

                        $pilot_in_command_signature = (file_exists($pilot_in_command_exists)) ? '<img width="62px" height="21px" src=' . $pilot_in_command_path . ' />' : '';

                        $signature = (file_exists($pilot_in_command_exists)) ? $pilot_in_command_signature : $aircraft_callsign_signature;
//			echo $aircraft_callsign_exists;
                        // $filing_time = '2015-12-15';
                        $filing_date = substr($filing_time, '8', '2');
                        $filing_time = substr($filing_time, '11', '5');
                        $filing_time = date("H:i", strtotime("-330 minutes", strtotime($filing_time)));
                        $filing_time = str_replace(':', '', $filing_time);

                        if (strpos($equipment, '/') === FALSE) {
                            $transponder_value = ($transponder) ? '/' . $transponder : '';
                        } else {
                            $transponder_value = ($transponder) ? $transponder : '';
                        }

                        $equipment = $equipment . '' . $transponder_value;
                        $tcas_value = ($tcas == 'YES') ? " TCAS EQUIPPED" : '';

                        if (substr($aircraft_callsign, 0, 2) == 'VT') {
                            $aircraft_callsign = strtoupper(substr($aircraft_callsign, 0, 5));
                        } else {
                            $aircraft_callsign = $aircraft_callsign;
                        }
                        ?>

                        <div id='station_addresses_data'>{!!$station_addresses_data!!}</div>
                        <div id='originator'>{!!strtoupper($originator)!!}</div>
                        <div id='aircraft_callsign'>{{$aircraft_callsign}}</div>
                        <div id='departure_aerodrome'>{{strtoupper($departure_aerodrome)}}</div>
                        <div id='destination_aerodrome'>{{strtoupper($destination_aerodrome)}}</div>
                        <div id='equipment'>{!!strtoupper($equipment)!!}</div>
                        <div id='departure_time'>{{$departure_time_hours.''.$departure_time_minutes}}</div>
                        <div id='flight_rules'>{{strtoupper($flight_rules)}}</div>
                        <div id='flight_type'>{{strtoupper($flight_type)}}</div>
                        <div id='aircraft_type'>{{strtoupper($aircraft_type)}}</div>
                        <div id='weight_category'>{{strtoupper($weight_category)}}</div>
                        <div id='crushing_speed_indication'>{{strtoupper($crushing_speed_indication.''.$crushing_speed)}}</div>
                        <div id='level'>{{strtoupper($flight_level_indication.''.$flight_level)}}</div>
                        <div id='route'>{{strtoupper(substr($route,0,48))}}</div>
                        <div id='route2'>{{strtoupper(substr($route,48))}}</div>
                        <div id='total_flying_time'>{{strtoupper($total_flying_hours.''.$total_flying_minutes)}}</div>
                        <div id='first_alternate_aerodrome'>{{strtoupper($first_alternate_aerodrome)}}</div>
                        <div id='second_alternate_aerodrome'>{{strtoupper($second_alternate_aerodrome)}}</div>
                        <div id='endurance'>{{strtoupper($endurance_hours.''.$endurance_minutes)}}</div>
                        <div id='tbn'>{{strtoupper($tbn)}}</div>
                        <div id='number'>{{strtoupper($number)}}</div>
                        <div id='capacity'>{{strtoupper($capacity)}}</div>
                        <div id='color'>{{strtoupper($color)}}</div>
                        <div id='aircraft_color'>{{strtoupper($aircraft_color)}}</div>
                        <!--                        <div id='remarks'>{{$remarks}}</div>-->
                        <div id='pilot_in_command'>{{strtoupper($pilot_in_command).' MOB '.$mobile_number}}</div>
                        <div id='date'>{{$date_of_flight}}</div>
                        <div id='date1'>{{$date_of_flight}}</div>
                        <div id='date2'>{{$date_of_flight}}</div>
                        <div id='emergency_uhf'>{!!$emergency_uhf!!}</div>
                        <div id='emergency_vhf'>{!!$emergency_vhf!!}</div>
                        <div id='emergency_elba'>{!!$emergency_elba!!}</div>
                        <div id='polar'>{!!$polar!!}</div>
                        <div id='desert'>{!!$desert!!}</div>
                        <div id='maritime'>{!!$maritime!!}</div>
                        <div id='jungle'>{!!$jungle!!}</div>
                        <div id='light'>{!!$light!!}</div>
                        <div id='floures'>{!!$floures!!}</div>
                        <div id='jacket_uhf'>{!!$jacket_uhf!!}</div>
                        <div id='jacket_vhf'>{!!$jacket_vhf!!}</div>
                        <div id='signature'>{!!$signature!!}</div>
                        <div id='signature1'>{!!$signature!!}</div>
                        <div id='signature2'>{!!$signature!!}</div>
                        <div id='cover'>{!!$cover!!}</div>
                        <div id='filing_time'>{!!$filing_date.''.$filing_time!!}</div>
                        <div id='other_info'>{!! strtoupper($pbn.''.$nav.''.$departure_latlong.''.$departure_station.''.$destination_latlong.''.$destination_station.'DOF/'.$date_of_flight
                            .' REG/'.$registration.''.$fir_crossing_time.' '.$sel.''.$code.' OPR/'.$operator.''.$alternate_station.''.$per.''.$route_altn.''.$take_off_altn.''.$remarks_value
                            .''.$tcas_value.''.$credit.' PIC '.$pilot_in_command.''.' MOB '.$mobile_number.''.$indian_value.' '.$foreigner_nationality)!!}</div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<style>
    .image { 
        position: relative; 
        width: 100%; /* for IE 6 */
    }

    h2 { 
        position: absolute; 
        width: 100%;
    }
    h3 { 
        position: absolute; 
        top: 120px; 
        left: 0; 
        width: 100%; 
    }
    h4 { 
        position: absolute; 
        top: 145px; 
        left: 0; 
        width: 100%; 
    }
    h5#citation { 
        position: absolute; 
        top: 180px; 
        left: 0; 
        width: 100%; 
    }
    h5#date { 
        position: absolute; 
        top: 340px; 
        left: 0; 
        width: 100%; 
    }

    #aircraft_callsign { 
        position: absolute; 
        top: 158px;
        left: 203px; 
        width: 100%;
        font-size: 15px;
        letter-spacing: 11px;
        font-weight: bold;
        font-family:courier;
    }
    #departure_aerodrome{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 89px;
        top: 230px;
        font-weight: bold;
        font-family:courier;
    }

    #destination_aerodrome{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 89px;
        top: 375px;
        font-weight: bold;
        font-family:courier;
    }

    #equipment { 
        position: absolute; 
        top: 195px;
        left: 350px; 
        width: 100%;
        font-size: 15px;
        font-weight: bold;
        font-family:courier;
    }
    #departure_time{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 265px;
        top: 230px;
        font-weight: bold;
        font-family:courier;
    }
    #filing_time { 
        position: absolute; 
        top: 102px;
        left: 13px; 
        width: 100%;
        font-size: 13px;
        letter-spacing: 11px;
        font-weight: bold;
        font-family:courier;
    }
    #flight_rules { 
        position: absolute; 
        top: 155px;
        left: 475px; 
        width: 100%;
        font-size: 15px;
        letter-spacing: 11px;
        font-weight: bold;
        font-family:courier;
    }
    #flight_type { 
        position: absolute; 
        top: 155px;
        left: 632px; 
        width: 100%;
        font-size: 15px;
        letter-spacing: 11px;
        font-weight: bold;
        font-family:courier;
    }
    #aircraft_type { 
        position: absolute; 
        top: 195px;
        left: 102px; 
        width: 100%;
        font-size: 15px;
        letter-spacing: 9px;
        font-weight: bold;
        font-family:courier;
    }
    #weight_category { 
        position: absolute; 
        top: 195px;
        left: 252px; 
        width: 100%;
        font-size: 15px;
        letter-spacing: 9px;
        font-weight: bold;
        font-family:courier;
    }
    #crushing_speed_indication{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 30px;
        top: 285px;
        font-weight: bold;
        font-family:courier;
    }
    #level{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 148px;
        top: 285px;
        font-weight: bold;
        font-family:courier;
    }
    #route{
        position: absolute; 
        font-size: 15px;
        left: 270px;
        top: 285px;
        font-weight: bold;
        line-height: 115%;
        font-family:courier;
    }
    #route2{
        position: absolute; 
        font-size: 15px;
        left: 10px;
        top: 308px;
        font-weight: bold;
        line-height: 115%;
        font-family:courier;
    }
    #total_flying_time{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 264px;
        top: 375px;
        font-weight: bold;
        font-family:courier;
    }
    #first_alternate_aerodrome{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 421px;
        top: 375px;
        font-weight: bold;
        font-family:courier; 
    }
    #second_alternate_aerodrome{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 575px;
        top: 375px;
        font-weight: bold;
        font-family:courier; 
    }
    #endurance{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 93px;
        top: 551px;
        font-weight: bold;
        font-family:courier;  
    }
    #tbn{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 263px;
        top: 551px;
        font-weight: bold;
        font-family:courier;  
    }
    #number{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 89px;
        top: 656px;
        font-weight: bold;
        font-family:courier;  
    }
    #capacity{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 148px;
        top: 656px;
        font-weight: bold;
        font-family:courier;
    }
    #color{
        position: absolute; 
        font-size: 15px;
        left: 264px;
        top: 656px;
        font-weight: bold;
        font-family:courier;
    }
    #aircraft_color{
        position: absolute; 
        font-size: 15px;
        left: 93px;
        top: 702px;
        font-weight: bold;
        font-family:courier;
    }
    #remarks{
        position: absolute; 
        font-size: 13px;
        left: 93px;
        top: 722px;
        font-weight: bold;
        font-family:courier;
    }
    #pilot_in_command{
        position: absolute; 
        font-size: 15px;
        left: 93px;
        top: 765px;
        font-weight: bold;
        font-family:courier;
    }
    #date{
        position: absolute; 
        font-size: 15px;
        left: 312px;
        top: 800px;
        font-weight: bold;
        font-family:courier;
    }
    #date1{
        position: absolute; 
        font-size: 15px;
        left: 312px;
        top: 840px;
        font-weight: bold;
        font-family:courier;
    }
    #date2{
        position: absolute; 
        font-size: 15px;
        left: 312px;
        top: 880px;
        font-weight: bold;
        font-family:courier;
    }
    #emergency_uhf{
        position: absolute; 
        left: 530px;
        top: 551px;
    }
    #emergency_vhf{
        position: absolute; 
        left: 590px;
        top: 551px;
    }
    #emergency_elba{
        position: absolute; 
        left: 650px;
        top: 551px; 
    }
    #polar{
        position: absolute; 
        left: 140px;
        top: 595px; 
    }
    #desert{
        position: absolute; 
        left: 200px;
        top: 595px;
    }
    #maritime{
        position: absolute; 
        left: 260px;
        top: 595px;
    }
    #jungle{
        position: absolute; 
        left: 325px;
        top: 595px;
    }
    #light{
        position: absolute; 
        left: 475px;
        top: 595px; 
    }
    #floures{
        position: absolute; 
        left: 530px;
        top: 595px; 
    }
    #jacket_uhf{
        position: absolute; 
        left: 590px;
        top: 595px; 
    }
    #jacket_vhf{
        position: absolute; 
        left: 650px;
        top: 595px; 
    }
    #signature{
        position: absolute; 
        left: 585px;
        top: 791px; 
    }
    #signature1{
        position: absolute; 
        left: 585px;
        top: 831px; 
    }
    #signature2{
        position: absolute; 
        left: 505px;
        top: 909px; 
    }
    #cover{
        position: absolute; 
        left: 217px;
        top: 652px;
    }
    #other_info{
        position: absolute; 
        left: 25px;
        top: 413px;
        font-size: 12px;
        line-height: 23px;
        font-weight: bold;
        font-family:courier;
    }
    #station_addresses_data { 
        position: absolute; 
        top: 47px;
        left: 123px; 
        line-height: 19px;
        width: 100%;
        font-size: 13px;
        font-weight: bold;
        font-family:courier;
    }
    #originator { 
        position: absolute; 
        top: 104px;
        left: 148px; 
        width: 100%;
        font-size: 13px;
        letter-spacing: 11px;
        font-weight: bold;
        font-family:courier;
    }
</style>