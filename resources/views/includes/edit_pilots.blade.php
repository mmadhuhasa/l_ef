
<?php
$i = 1;

use App\myfolder\myFunction;
use App\models\FlightPlanDetailsModel;
?>
@foreach($get_all as $fpl_details)
<?php
$id = ($pilot_details) ? $pilot_details->id : '';
$aircraft_callsign = ($pilot_details) ? $pilot_details->callsign : '';
$pilot_in_command = ($pilot_details) ? $pilot_details->pilot : '';
$mobile = ( $pilot_details) ? $pilot_details->mobile : '';
$copilot = ( $pilot_details) ? $pilot_details->copilot : '';
$copilot_mob = ( $pilot_details) ? $pilot_details->copilot_mob : '';
$is_active = ( $pilot_details) ? $pilot_details->is_active : '';
$plan_status = ( $pilot_details) ? $pilot_details->plan_status : '';

$aircraft_callsign_exists = "media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ";
$aircraft_callsign_path = url("media/pdf/fpl/signatures/" . substr($aircraft_callsign, 0, 5) . ".png  ");
$aircraft_callsign_signature = (file_exists($aircraft_callsign_exists)) ? '<img src=' . $aircraft_callsign_path . ' />' : ''; //				     
$pilot_in_command_strip = preg_replace('/( *)/', '', $pilot_in_command);
$pilot_in_command_exists = "media/pdf/fpl/signatures/" . $pilot_in_command_strip . ".png";
$pilot_in_command_path = url('media/pdf/fpl/signatures/' . $pilot_in_command_strip . '.png');
$pilot_in_command_signature = (file_exists($pilot_in_command_exists)) ? '<img src=' . $pilot_in_command_path . ' />' : '';
$signature = (file_exists($pilot_in_command_exists)) ? $pilot_in_command_signature : $aircraft_callsign_signature;
?>
<div id="edit_pilots{{$id}}" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-lg modal-container fdtlpop">
	<header class="popupHeader"> <span class="header_title">Update Pilot Details</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
	<section class="popupBody"> 	
	    <!-- Username & Password Login form -->
	    <div>
		<div id="success"></div>
		<form method="post"  data-toggle="validator" onsubmit="return checklogin()" action="{{url('/authenticate_user')}}" id="login_form" name="login">
		    {!! csrf_field() !!}
		    <div class="row">
			<div class="col-sm-4">
			    <div class="form-group">
				<label>Call Sign</label>
				<input type="text" required="required" name="callsign" id="callsign" autocomplete="off" minlength="10" maxlength="10" class="numeric form-control">
			    </div>

			    <!-- <div class="action_btns">		
				<div class="one_half last actbtns">
				    <input name="" type="submit" value="Update"  class="red_button" />
				    &nbsp;</div>
			    </div> -->
			</div>
			<div class="col-sm-4">
			    <div class="form-group">
				<label>Pilot Name</label>
				<input type="password" required="required" id="password" name="password" autocomplete="off" class="form-control">
			    </div>	
			</div>
			<div class="col-sm-4">
			    <div class="form-group">
				<label>Mobile Number</label>
				<input type="text" required="required" id="pic-mobile" name="pic-mobile" autocomplete="off" class="form-control">
			    </div>	
			</div>
		    </div>
		    <div class="row">
			<div class="col-sm-4">
			    <div class="form-group">
				<label>Co-Pilot Name</label>
				<input type="text" required="required" id="copic" name="copic" autocomplete="off" class="form-control">
			    </div>				
			</div>
			<div class="col-sm-4">
			    <div class="form-group">
				<label>Co Pilot Mobile Number</label>
				<input type="text" required="required" id="copic-mobile" name="copic-mobile" autocomplete="off" class="form-control">
			    </div>	
			</div>
			<div class="col-sm-4">
			    <div class="form-group">
				<label>Status</label>
				<select class="form-control">
				    <option value="active">Active</option>
				    <option value="inactive">Inactive</option>
				</select>
			    </div>	
			</div>
		    </div>
		    <div class="row">
			<div class="col-md-4 col-sm-12">

			    <div class="form-group">
				<label>Update Signature Copy</label>
				<input type="file">	
			    </div>

			</div>	
			<div class="col-md-4 col-md-offset-4 col-sm-12">						
			    <div class="actbtns updbtns">
				<div class="form-group">
				    <input type="button" value="Update" class="form-control red_buttons">				
				</div>				
			    </div>						
			</div>	
		    </div>

		</form>
	    </div>
	</section>
    </div>
</div>
@endforeach
