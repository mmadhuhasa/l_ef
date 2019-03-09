<!-- resources/views/auth/login.blade.php -->
@extends('layouts.login',array('1'=>'1'))
@section('content')


<div class="container">
    <div class="card card-container">      
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card">
	    @include('includes.response',[])	   
	</p>
        <form class="form-signin" method="POST" action="{{url('/authenticate_user')}}">
            {!! csrf_field() !!}
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="User Name"  autofocus>
            <input type="password" name="password"  id="password" class="form-control" placeholder="Password" >
	    <!--            <div id="remember" class="checkbox">
			    <label>
				<input type="checkbox" value="remember-me"> I'm Awesome, Remember Me!
			    </label>
			</div>-->
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Log In</button>
        </form><!-- /form -->
        <a href="#" class="forgot-password">
            Forgot your password?
        </a>
	<a href="{{url('/account/register')}}" class="forgot-password" style="padding-left: 60px">
            Register
        </a>
    </div><!-- /card-container -->
</div><!-- /container -->


@stop