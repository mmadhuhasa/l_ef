@extends('layouts.fpl_layout',array('1'=>'1'))
@section('content')

<div id="page">
    @include('includes.header',[])
    <div class="container-fluid">
	<!--@include('includes.header',[])-->

	@if(Session::get('success'))
	<div class='alert alert-success'>
	    <button type="button" class="close" data-dismiss="alert" data-dismiss="alert">x</button>
	    {{Session::get('success')}}
	</div>
	@endif
	@if(Session::get('error'))
	<div class='alert alert-danger'>
	    <button type="button" class="close" data-dismiss="alert" data-dismiss="alert">x</button>
	    {{Session::get('error')}}
	</div>
	@endif
	<div class="row">

	    <div class="col-sm-12">

		<div class="box box-color box-bordered box-small">              
		    <div class="box-content">       

			<form onsubmit="submit_button.disabled = true;
                                submit_button.value = 'Please wait...';
                                return true;" action="{{url('')}}" name="form" action="" method="POST">

			    <div class="form-group">

				<label class="col-sm-offset-2 col-sm-10 control-label"><h4>Update Weather Data:</h4></label>

				<div class="col-sm-offset-2 col-sm-8">

				    <textarea  name="notam" id="notam" rows="15" class="form-control" cols="117"></textarea>    

				</div>   

				<input type="hidden" name="_token" value="{{ csrf_token() }}">

			    </div>

			    <div class="col-sm-12 margin-top text-center"> 

				<div id='result' class="margin-left"></div>

				<input type="submit" id="notam_update" value="Update" class="btn btn-primary margin-left margin-bottom" name="submit_button" />

				@if(Session::get('success'))
				<a href="all_notams.php?recent=_v" class="btn btn-info margin-bottom" id="view" name="view" target="_blank">Weather </a>            
				@endif
			    </div>

			    <span class="margin-bottom"></span>

			</form>

		    </div>

		</div> 

	    </div>

	</div>

    </div>
    @include('includes.footer',[])

    <!-- Beginning of Login Modal Box -->
    @include('includes.login',[])
    <!-- End of Login Modal Box --> 



</div>
@stop