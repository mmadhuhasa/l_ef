 
<div id="pilots_modal" class="modal fade" style="display:none;">
    <form  data-toggle="validator"  data-url="{{url('Admin/pilots')}}" id="pilots_form2" enctype="multipart/form-data" role="form"  data-toggle="validator" method="POST">		   
    <div class="modal-dialog modal-lg modal-container fdtlpop">
	<header class="popupHeader"> <span class="header_title">Update Pilot Details</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
	<section class="popupBody"> 		   
	   
		<div class="row">
		    <div class="col-sm-4">
			<div class="form-group">
			    <label>Call Sign</label>
			    <input type="text" required="required" name="aircraft_callsign2" id="aircraft_callsign2" autocomplete="off" minlength="5" maxlength="7" class="form-control alpha_numeric text_uppercase">
			</div>
		    </div>

		    <div class="col-sm-4">
			<div class="form-group">
			    <label>Name</label>
			    <input type="text" required="required" id="name2" name="name2" autocomplete="off" class="form-control pilot_in_command text_uppercase">
			</div>	
		    </div>

		    <div class="col-sm-4">
			<div class="form-group">
			    <label>Email</label>
			    <input type="text" required="required" id="email2" name="email2" autocomplete="off" class="form-control text_lowercase">
			</div>	
		    </div>

		   
		</div>
		<div class="row">
		     <div class="col-sm-4">
			<div class="form-group">
			    <label>Mobile</label>
                            <input type="text" required="required" id="mobile_number2" name="mobile_number2" maxlength="10" autocomplete="off" class="form-control numeric">
			</div>	
		    </div>
		    <div class="col-sm-2">
			<div class="form-group">
			    <label>Pilot</label>
			    <select name="is_pilot" id="is_pilot" class="form-control">
				<option value="1">YES</option>
				<option value="0">NO</option>
			    </select>
			</div>	
		    </div>
		    <div class="col-sm-2">
			<div class="form-group">
			    <label>Co-pilot</label>
			    <select name="is_copilot" id="is_copilot" class="form-control">
				<option value="1">YES</option>
				<option value="0">NO</option>
			    </select>
			</div>				
		    </div>		 
		    <div class="col-sm-4">
			<div class="form-group">
			    <label>Status</label>
			    <select name="is_active" class="form-control">
				<option value="1">Active</option>
				<option value="0">Inactive</option>
			    </select>
			</div>	
		    </div>
		</div>
		<div class="row">
		    <div class="col-md-4">
			<div class="form-group">
			    <label> Signature</label>
			    <p id="signature"></p>
			</div>
		    </div>	
		    <div class="col-md-4">
			<div class="form-group">
			    <label>Update Signature</label>
			    <input type="file" name="signature2" id="signature2">	
			</div>
			<div id="image-holder"></div>
		    </div>	
		    <div class="col-md-4">						
<!--			<div class="actbtns updbtns">-->
			      <label>Update</label>
			    <div class="form-group">
                                <button type="submit" id="update_pilots" value="Update" class="form-control btn btn-danger newbtnv1">Update</button>				
			    </div>				
			<!--</div>-->						
		    </div>	
		</div>
		<input type="hidden" name="id" id="id" />
                <input type="hidden" name="img_sign" id="img_sign" />
		{!! csrf_field() !!}
	      
	</section>
    </div>
          </form>	
</div>
