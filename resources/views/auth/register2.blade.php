<!-- resources/views/auth/login.blade.php -->
@extends('layouts.login',array('1'=>'1'))
@section('content')
@include('includes.response',[])
<div class="container">
    <div class="card card-container">      
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form class="form-signin" method="POST" action="{{url('/fpl/register')}}">
            {!! csrf_field() !!}
	    <input type="text" name="name"  id="name" class="form-control" placeholder="Password" required />
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="User Name" required autofocus>
            <input type="password" name="password"  id="password" class="form-control" placeholder="Password" required>
	    <input type="password" name="password_confirmation"  id="password_confirmation" class="form-control" placeholder="Password" required>          
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Let's Go!</button>
        </form><!-- /form -->        
    </div><!-- /card-container -->
</div><!-- /container -->
@stop