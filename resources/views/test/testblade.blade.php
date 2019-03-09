@extends('layouts.master',array('1'=>'1'))
@section('content')
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
<!-- resources/views/auth/login.blade.php -->
<div class="container-fluid">
    <form method="POST" action="{{url('/test/test')}}">
	{!! csrf_field() !!}
	<div class="row">
	    <div class="form-group text-center">
		<label class="control-label col-sm-1"> Email: </label>
		<div class=" col-sm-2">
		    <input type="text" class="form-control" name="name" value="">
		</div>
	    </div>
	</div>
	<div  class="form-group">
	    <button type="submit">Login</button>
	</div>
    </form>
</div>
@stop