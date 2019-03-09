@extends('layouts.backend_layout',array('1'=>'1'))
@section('content')
<div id="page">
    @include('includes.new_header',[])  
    <section class="bg-1 welcome page-box">
    <div class="container">
	<form action="{{url('Admin/pilots')}}" id="pilots_form" enctype="multipart/form-data" role="form"  data-toggle="validator" method="POST">		   
	    <div class="row">
		<div class="col-sm-3">
		    <div class="form-group">
			<label>Call Sign</label>
			<input type="text" required="required" name="aircraft_callsign" id="aircraft_callsign" autocomplete="off" minlength="5" maxlength="5" class="numeric form-control">
		    </div>
		</div>
		<div class="col-sm-3">
		    <div class="form-group">
			<label>Email</label>
			<input type="text" required="required" id="pilot_email" name="pilot_email" autocomplete="off" class="form-control">
		    </div>	
		</div>
		<div class="col-sm-3">
		    <div class="form-group">
			<label>Pilot Name</label>
			<input type="text" required="required" id="pilot_name" name="pilot_name" autocomplete="off" class="form-control">
		    </div>	
		</div>
		<div class="col-sm-3">
		    <div class="form-group">
			<label>Mobile</label>
			<input type="text" required="required" id="pilot_mobile_number" name="pilot_mobile_number" autocomplete="off" class="form-control">
		    </div>	
		</div>
	    </div>
	    <div class="row">
		<div class="col-sm-3">
		    <div class="form-group">
			<label>CoPilot Email</label>
			<input type="text" required="required" id="copilot_email" name="copilot_email" autocomplete="off" class="form-control">
		    </div>
		</div>
		<div class="col-sm-3">
		    <div class="form-group">
			<label>CoPilot Name</label>
			<input type="text" required="required" id="copilot_name" name="copilot_name" autocomplete="off" class="form-control">
		    </div>				
		</div>
		<div class="col-sm-3">
		    <div class="form-group">
			<label>CoPilot Mobile</label>
			<input type="text" required="required" id="copilot_mobile_number" name="copilot_mobile_number" autocomplete="off" class="form-control">
		    </div>	
		</div>
		<div class="col-sm-3">
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
		<div class="col-md-3 col-sm-12">
		    <div class="form-group">
			<label> Signature</label>
			<p id="signature"></p>
		    </div>
		</div>	
		<div class="col-md-3 col-sm-12">
		    <div class="form-group">
			<label>Update Signature</label>
			<input type="file" name="signature2" id="signature2">	
		    </div>
		</div>	
		<div class="col-md-3 col-md-offset-3">						
		    <div class="actbtns updbtns">
			<div class="form-group">
			    <input type="submit" id="update_pilots" value="Update" class="form-control red_buttons">				
			</div>				
		    </div>						
		</div>	
	    </div>
	    <input type="hidden" name="id" id="id" />
	    {!! csrf_field() !!}
	</form>
    </div>
    </section>
    @include('includes.new_footer',[])  
</div>
@stop