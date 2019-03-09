@extends('layouts.new_index_layout',array('1'=>'1'))
@section('content')
<div class="page">   
    <style>
        .btn {
            height: 34px;
            padding: 8px 15px;
            width:140px;

        }
        .has-error .form-control {
            border-color: #f1292b;
        }
        form .form-control:focus,.has-error .form-control:focus {
            border-color: #f1292b;
        }
        .btn.focus, .btn:focus, .btn:hover {
            color: white;
            text-decoration: none;
        }
    </style>
    <script>
        $(function () {
            $('#password').on('keyup', function () {
                var password = $('#password').val();
                if (password.length < 1 || password == '') {
                    $("#password").css("border", "red solid 1px");
                } else {
                    $("#password").css("border", "lightgrey solid 1px");
                }
            });
            $('#password_confirmation').on('keyup', function () {
                var password = $('#password_confirmation').val();
                if (password.length < 1 || password == '') {
                    $("#password_confirmation").css("border", "red solid 1px");
                } else {
                    $("#password_confirmation").css("border", "lightgrey solid 1px");
                }
            });
        })
    </script>
    @include('includes.new_fpl_header',[])
    <div class="container">
        <div class="row">
            <div class="reset-section">
                <div class="reset">        
                    <div class="col-md-12">
                        <div class="reset-form">
                            <div class="row">
                                <div class="col-md-12">   
                                    <div class="reset-heading">Reset Password</div>
                                </div>
                            </div>
                            <div class="row">     
                                <div class="reset-body">
                                    <div class="col-md-12">
                                        <form class="form-horizontal" dat-toggle="validator" data-base-url ="{{url('')}}" data-toggle="validator" id="reset_password_form" onsubmit="return ResetPassword()" data-url="{{ url('password/reset') }}" role="form" method="POST">
                                            {!! csrf_field() !!}
                                            <?php
                                            $email = $decrypt; //decrypt(Input::get('_key'));
                                            ?>   
                                            <div id="error_message"></div>
                                            <div id="success_message"></div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label class="col-md-4 control-label">Mobile Number</label>
                                                        <div class="col-md-6">
                                                            <input type="text" required="required" readonly="readonly" class="form-control" name="mobile_number" value="{{$email}}">
                                                            @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                        <label class="col-md-4 control-label">Password</label>
                                                        <div class="col-md-6">
                                                            <input type="password" required="required"  class="form-control" id="password" autocomplete="off" name="password">
                                                            @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                                        <label class="col-md-4 control-label">Confirm Password</label>
                                                        <div class="col-md-6">
                                                            <input type="password" required="required" class="form-control" id="password_confirmation" autocomplete="off" name="password_confirmation">

                                                            @if ($errors->has('password_confirmation'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="_key" value="{{Input::get('_key')}}" />
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="reset-submit">    
                                                        <div class="form-group">                            
                                                            <div class="col-md-2 col-sm-2">
                                                                <button style="opacity:1" type="submit" class="form-control btn newbtnv1" value="">Reset Password</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.new_footer',[])
</div>
@endsection
