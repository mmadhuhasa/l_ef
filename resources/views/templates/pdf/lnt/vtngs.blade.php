<?php
$img = url('media/pdf/lnt/lnt.jpg');
?>
<table border="0" cellpadding="0" cellspacing="0"  height="500" width="700"   style='background-repeat: no-repeat;'>
    <tr>
        <td>
            <table border="0" width="330" height="500" cellpadding="0" cellspacing="0">
                <tr>
                    <td  style="color:#333333 !important; font-size:20px; font-family: Arial, Verdana, sans-serif;" height="40">                                           
			<img src="{{$img}}" alt="Lnt PDF" height="950" width="720" /> 
			<?php
			$date_of_flight = date('d-M-Y', strtotime('20' . trim($date_of_flight)));

			$aircraft_callsign = (isset($aircraft_callsign)) ? $aircraft_callsign : '';

			$aircraft_callsign_exists = "media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ";
			$aircraft_callsign_path = url("media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ");
			$aircraft_callsign_signature = (file_exists($aircraft_callsign_exists)) ? '<img width="72px" height="21px" src=' . $aircraft_callsign_path . ' />' : '';

			$pilot_in_command_strip = preg_replace('/( *)/', '', $pilot_in_command);
			$pilot_in_command_exists = "media/pdf/fpl/signatures/" . $pilot_in_command_strip . ".png";
			$pilot_in_command_path = url('media/pdf/fpl/signatures/' . $pilot_in_command_strip . '.png');
			$pilot_in_command_signature = (file_exists($pilot_in_command_exists)) ? '<img width="72px" height="21px" src=' . $pilot_in_command_path . ' />' : '';

			$signature = (file_exists($pilot_in_command_exists)) ? $pilot_in_command_signature : $aircraft_callsign_signature;
			?>
                        <div class="lnt-family" id="date" name="date">{{isset($date_of_flight) ? $date_of_flight : ''}}</div>

                        <div class="lnt-family" id="from" name="from">{{isset($departure_aerodrome) ? $departure_aerodrome : ''}}</div>
                        <div class="lnt-family" id="to" name="to">{{isset($destination_aerodrome) ? $destination_aerodrome : ''}}</div>

                        <div class="lnt-family" id="pic" name="pic">{{isset($pilot_in_command) ? $pilot_in_command : ''}}</div>
                        <div class="lnt-family" id="sic" name="sic">{{isset($copilot) ? $copilot : ''}}</div>

			<div class="lnt-family" id="weight5" name="weight5">{{isset($weight5) ? $weight5 : ''}}</div>
			<div class="lnt-family" id="weight6" name="weight6">{{$weight6}}</div>
			<div class="lnt-family" id="weight7" name="weight7">{{$weight7}}</div>
			<div class="lnt-family" id="weight8" name="weight8">{{$weight8}}</div>
			<div class="lnt-family" id="weight9" name="weight9">{{$weight9}}</div>
			<div class="lnt-family" id="weight10" name="weight10">{{$weight10}}</div>
			<div class="lnt-family" id="weight11" name="weight11">{{$weight11}}</div>
			<div class="lnt-family" id="weight12" name="weight12">{{$weight12}}</div>
			<div class="lnt-family" id="weight13" name="weight13">{{$weight13}}</div>
			<div class="lnt-family" id="weight14" name="weight14">{{$weight14}}</div>
			<div class="lnt-family" id="weight15" name="weight15">{{$weight15}}</div>
			<div class="lnt-family" id="weight16" name="weight16">{{isset($fc) ? $fc : '0'}}</div>
			<div class="lnt-family" id="weight17" name="weight17">{{$bags}}</div>

			<div class="lnt-family" id="moment5" name="moment5">{{$moment5}}</div>						
			<div class="lnt-family" id="moment6" name="moment6">{{$moment6}}</div>					
			<div class="lnt-family" id="moment7" name="moment7">{{$moment7}}</div>						
			<div class="lnt-family" id="moment8" name="moment8">{{$moment8}}</div>						
			<div class="lnt-family" id="moment9" name="moment9">{{$moment9}}</div>						
			<div class="lnt-family" id="moment10" name="moment10">{{$moment10}}</div>						
			<div class="lnt-family" id="moment11" name="moment11">{{$moment11}}</div>						
			<div class="lnt-family" id="moment12" name="moment12">{{$moment12}}</div>						
			<div class="lnt-family" id="moment13" name="moment13">{{$moment13}}</div>						
			<div class="lnt-family" id="moment14" name="moment14">{{$moment14}}</div>						
			<div class="lnt-family" id="moment15" name="moment15">{{$moment15}}</div>					
			<div class="lnt-family" id="moment16" name="moment16">{{$moment16}}</div>						
			<div class="lnt-family" id="moment17" name="moment17">{{$moment17}}</div>

			<div class="lnt-family" id="takeoff" name="takeoff">{{$take_off_fuel}}</div>
			<div class="lnt-family" id="landing" name="landing">{{isset($landing_fuel) ? $landing_fuel : ''}}</div>   

                        <div class="lnt-family" id="zerofuel_wt" name="zerofuel_wt">{{isset($zero_fuel_weight) ? $zero_fuel_weight : ''}}</div>
                        <div class="lnt-family" id="takeoff_wt" name="takeoff_wt">{{isset($take_off_fuel_weight) ? $take_off_fuel_weight : ''}}</div>
                        <div class="lnt-family" id="landing_wt" name="landing_wt">{{isset($landing_fuel_weight) ? $landing_fuel_weight : ''}}</div>
                        <div class="lnt-family" id="takeoff_setting" name="takeoff_setting">{{isset($trim_setting) ? round($trim_setting,1) : ''}}</div>
			<div class="lnt-family" id="landing_trim_setting" name="landing_trim_setting">{{isset($landing_fuel_trim_setting) ? round($landing_fuel_trim_setting,1) : ''}}</div>

                        <div class="lnt-family" id="max_Allow_takeoff" name="max_Allow_takeoff">48200</div>
                        <div class="lnt-family" id="tripfuel" name="tripfuel">{{isset($landing_fuel) ? ($take_off_fuel-$landing_fuel) : ''}}</div>
<!--                        <div class="lnt-family" id="pob" name="pob">{{isset($landing_fuel) ? $landing_fuel : ''}}</div>-->
                        <div class="lnt-family" id="noof_passengers" name="noof_passengers">{{isset($no_of_pax) ? $no_of_pax : ''}}</div>                                              
                        <!--<div class="lnt-family" id="atpl_no" name="atpl_no">{{isset($landing_fuel) ? $landing_fuel : ''}}</div>-->  

			<div class="lnt-family" id="zero_fuel_arm" name="zero_fuel_arm">{{isset($zero_fuel_arm) ? $zero_fuel_arm : ''}}</div>
			<div class="lnt-family" id="zero_fuel_moment" name="zero_fuel_moment">{{isset($zero_fuel_moment) ? $zero_fuel_moment : ''}}</div>
			<div class="lnt-family" id="zero_fuel_cg" name="zero_fuel_cg">{{isset($zero_fuel_cg) ? $zero_fuel_cg : ''}}</div>

			<div class="lnt-family" id="take_off_fuel_arm" name="take_off_fuel_arm">{{isset($take_off_fuel_arm) ? $take_off_fuel_arm : ''}}</div>
			<div class="lnt-family" id="take_off_fuel_moment" name="take_off_fuel_moment">{{isset($take_off_fuel_moment) ? $take_off_fuel_moment : ''}}</div>
			<div class="lnt-family" id="take_off_fuel_cg" name="take_off_fuel_cg">{{isset($take_off_fuel_cg) ? $take_off_fuel_cg : ''}}</div>

			<div class="lnt-family" id="landing_fuel_arm" name="landing_fuel_arm">{{isset($landing_fuel_arm) ? $landing_fuel_arm : ''}}</div>
			<div class="lnt-family" id="landing_fuel_moment" name="landing_fuel_moment">{{isset($landing_fuel_moment) ? $landing_fuel_moment : ''}}</div>
			<div class="lnt-family" id="landing_fuel_cg" name="landing_fuel_cg">{{isset($landing_fuel_cg) ? $landing_fuel_cg : ''}}</div>

			<div class="lnt-family" id='signature'>{!!$signature!!}</div>

                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<style>
    .lnt-family{
	font-family:sans-serif;
	color: #000000 !important
    }
    #date{
	position: absolute; 
        font-size: 12px;
        letter-spacing: 0px;
        left: 500px;
        top: 155px;
        font-weight: bold;      
    }
    #from{
	position: absolute; 
        font-size: 12px;
        letter-spacing: 0px;
        left: 230px;
        top: 193px;
        font-weight: bold;

    }
    #to{
	position: absolute; 
        font-size: 12px;
        letter-spacing: 0px;
        left: 500px;
        top: 193px;
        font-weight: bold;

    }
    #pic{
	position: absolute; 
        font-size: 12px;
        letter-spacing: 0px;
        left: 230px;
        top: 225px;
        font-weight: bold;

    }
    #sic{
	position: absolute; 
        font-size: 12px;
        letter-spacing: 0px;
        left: 500px;
        top: 225px;
        font-weight: bold;

    }

    #weight5{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 352px;
        font-weight: bold;

    }
    #moment5{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 352px;
        font-weight: bold;

    }    
    #weight6{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 368px;
        font-weight: bold;

    }
    #moment6{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 368px;
        font-weight: bold;

    }    
    #weight7{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 384px;
        font-weight: bold;

    }
    #moment7{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 384px;
        font-weight: bold;

    }

    #weight8{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 400px;
        font-weight: bold;

    }
    #moment8{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 400px;
        font-weight: bold;

    }

    #weight9{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 416px;
        font-weight: bold;

    }
    #moment9{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 416px;
        font-weight: bold;

    }
    #weight10{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 432px;
        font-weight: bold;

    }
    #moment10{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 432px;
        font-weight: bold;

    }
    #weight11{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 448px;
        font-weight: bold;

    }
    #moment11{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 448px;
        font-weight: bold;

    }
    #weight12{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 464px;
        font-weight: bold;

    }
    #moment12{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 464px;
        font-weight: bold;

    }
    #weight13{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 480px;
        font-weight: bold;

    }
    #moment13{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 480px;
        font-weight: bold;

    }
    #weight14{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 496px;
        font-weight: bold;

    }
    #moment14{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 496px;
        font-weight: bold;

    }
    #weight15{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 512px;
        font-weight: bold;

    }
    #moment15{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 512px;
        font-weight: bold;

    }
    #weight16{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 528px;
        font-weight: bold;

    }
    #moment16{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 528px;
        font-weight: bold;

    }
    #weight17{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 248px;
        top: 544px;
        font-weight: bold;

    }
    #moment17{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 396px;
        top: 544px;
        font-weight: bold;

    }

    #takeoff{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 248px;
        top: 575px;
        font-weight: bold;

    }
    #landing{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 248px;
        top: 592px;
        font-weight: bold;

    }
    #zerofuel_wt{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 248px;
        top: 607px;
        font-weight: bold;

    }
    #takeoff_wt{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 248px;
        top: 638px;
        font-weight: bold;

    }
    #landing_wt{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 248px;
        top: 670px;
        font-weight: bold;

    }
    #takeoff_setting{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 223px;
        top: 700px;
        font-weight: bold;

    }
    
    #landing_trim_setting{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 450px;
        top: 700px;
        font-weight: bold;

    }
    
    #max_Allow_takeoff{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 305px;
        top: 776px;
        font-weight: bold;

    }
    #tripfuel{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 170px;
        top: 796px;
        font-weight: bold;

    }
    #pob{
	position: absolute; 
        font-size: 13px;
        letter-spacing: 0px;
        left: 355px;
        top: 796px;
        font-weight: bold;

    }
    #noof_passengers{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 215px;
        top: 816px;
        font-weight: bold;

    }
    #preparedby{
	position: absolute; 
        font-size: 13px;
        letter-spacing: 0px;
        left: 156px;
        top: 842px;
        font-weight: bold;

    }
    #signaturepic{
	position: absolute; 
        font-size: 13px;
        letter-spacing: 0px;
        left: 500px;
        top: 842px;
        font-weight: bold;

    }
    #atpl_no{
	position: absolute; 
        font-size: 13px;
        letter-spacing: 0px;
        left: 430px;
        top: 858px;
        font-weight: bold;

    }

    #zero_fuel_arm{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 310px;
        top: 607px;
        font-weight: bold;

    }
    #zero_fuel_moment{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 370px;
        top: 607px;
        font-weight: bold;

    }

    #zero_fuel_cg{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 450px;
        top: 607px;
        font-weight: bold;

    }   
    #take_off_fuel_arm{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 310px;
        top: 639px;
        font-weight: bold;

    }
    #take_off_fuel_moment{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 370px;
        top: 639px;
        font-weight: bold;

    }    
    #take_off_fuel_cg{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 450px;
        top: 639px;
        font-weight: bold;

    }

    #landing_fuel_arm{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 310px;
        top: 671px;
        font-weight: bold;

    }
    #landing_fuel_moment{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 370px;
        top: 671px;
        font-weight: bold;
    }    
    #landing_fuel_cg{
	position: absolute; 
        font-size: 11px;
        letter-spacing: 0px;
        left: 450px;
        top: 671px;
        font-weight: bold;
    }
    #signature{
	position: absolute; 
        font-size: 10px;
        letter-spacing: 0px;
        left: 490px;
        top: 832px;
        font-weight: bold;
    }
</style>