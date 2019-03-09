<?php
$img = url('media/pdf/AnnexureCopy.png');
?>
<table border="0" cellpadding="0" cellspacing="0"  height="500" width="700"   style='background-repeat: no-repeat;'>
    <tr>
        <td>
            <table border="0" width="330" height="500" cellpadding="0" cellspacing="0">
                <tr>
                    <td  style="color:#333333 !important; font-size:20px; font-family: Arial, Verdana, sans-serif;" height="40">                                           
                        <img src="{{$img}}" alt="Smiley face" height="950" width="720" /> 
			<?php
//			$aircraft_callsign = 'TESTA';
//			$pilot_in_command  ='Anand';
			$date_of_flight    = date('d-M-Y',strtotime('20'.$date_of_flight));
			$aircraft_callsign_exists = "media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ";
			$aircraft_callsign_path = url("media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ");

//			$pilot_in_command_exists = "media/pdf/fpl/signatures/" . $pilot_in_command . ".png  ";
//			$pilot_in_command_path = url("media/pdf/fpl/signatures/" . $pilot_in_command . ".png  ");
//			$pilot_in_command_signature = (file_exists($pilot_in_command_exists)) ? '<img src=' . $pilot_in_command_path . '  />' : '';
//			$signature = (file_exists($aircraft_callsign_exists)) ? '<img src=' . $aircraft_callsign_path . '  />' : $pilot_in_command_signature;
//			
//			
//			$aircraft_callsign_exists = "media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ";
//			$aircraft_callsign_path = url("media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ");

			$pilot_in_command_strip = preg_replace('/( *)/', '', $pilot_in_command);

			$pilot_in_command_exists = "media/pdf/fpl/signatures/" . $pilot_in_command_strip . ".png";
			$pilot_in_command_path = url('media/pdf/fpl/signatures/' . $pilot_in_command_strip . '.png');

			$pilot_in_command_signature = (file_exists($pilot_in_command_exists)) ? '<img src=' . $pilot_in_command_path . ' />' : '';

			$signature = (file_exists($aircraft_callsign_exists)) ? '<img src=' . $aircraft_callsign_path . '  />' : $pilot_in_command_signature;
			?>
			<div id='date_of_flight'>{!!$date_of_flight!!}</div>
                        <div id='place'>Mumbai</div>
                        <div id='from_to'>{!!substr($aircraft_callsign, 0, 5).' '.$departure_aerodrome.' - '.$destination_aerodrome.' '.$departure_time_hours.$departure_time_minutes !!}</div>
                        <div id='signature'>{!!$signature!!}</div>               
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<style>
    #date_of_flight { 
        position: absolute; 
        top: 908px;
        left: 70px; 
        width: 100%;
        font-size: 15px;        
        font-weight: bold;
        font-family:courier;
    }
    #place{
        position: absolute; 
        font-size: 15px;
        left: 70px;
        top: 935px;
        font-weight: bold;
        font-family:courier;
    }
    #from_to{
        position: absolute; 
        font-size: 15px;
        left: 70px;
        top: 960px;
        font-weight: bold;
        font-family:courier;
    }
    #signature{
        position: absolute; 
        font-size: 15px;
        letter-spacing: 9px;
        left: 585px;
        top: 890px;
        font-weight: bold;
        font-family:courier;
    }
</style>