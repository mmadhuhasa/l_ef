<!-- resources/views/auth/login.blade.php -->
@extends('layouts.login',array('1'=>'1'))
@section('content')
@include('includes.response',[])
<div class="container">
    <div class="card card-container">      
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" method="POST" action="{{url('/account/register')}}">
            {!! csrf_field() !!}
	    <input type="text" name="name"  id="name" class="form-control" placeholder="Name" required />
            <!--<span id="reauth-email" class="reauth-email"></span>-->           
	    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email" required>
	    <input type="text" name="mobile_number" minlength="10" maxlength="10"  placeholder="Mobile" id="mobile_number" class="form-control"  required>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>	    
	    <input type="password" name="password_confirmation"  id="password_confirmation" class="form-control" placeholder="Confirm Password" required>                    
	    <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Register</button>
	    <a href="{{url('/account/login')}}" class="forgot-password" style="padding-left: 60px">
		Back to login Page
	    </a>
        </form>     
    </div><!-- /card-container -->
</div><!-- /container -->
@stop

<!--<div class="container">
    <div class="card card-container">      
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" method="POST" action="{{url('/account/register')}}">
            {!! csrf_field() !!}
	   <div>
        Name
        <input type="text" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit">Register</button>
    </div>
        </form>     
    </div> /card-container 
</div> /container -->