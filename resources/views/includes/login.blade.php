<!-- Beginning of Login Modal Box -->
<style>
    #signin a:hover { 
        color: #999;
    } 
    #signin a { 
        color: #f1292b;
    }
    #signin .remember{
        color: #999;
    }
    #signin .best-view{
        font-size: 9px;
        font-weight: bold;
        font-style: italic;
        line-height: 10px;  
    }

    #signin .user_login label{
        text-transform: uppercase;
        font-size: 11px;
        margin-bottom:0px;
    } 
    #signin .user-name-label{
        margin-top: 8px;
    }
</style>
<div id="popupbox" class="modal fade" style="display:none;">
    <div id="signin">
        <div class="modal-dialog modal-container">
            <header class="popupHeader"> <span class="header_title">Login</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody"> 	
                <!-- Username & Password Login form -->
                <div class="user_login">
                    <div id="login_error"></div>
                    <form method="post"  data-toggle="validator"  onsubmit="return checklogin()" data-url="{{url('/authenticate_user')}}" id="login_form">
                        {!! csrf_field() !!}
                        <div class="form-group user-name-label">
                            <label>Username</label>
                            <input type="text" required="required" data-url="{{url('get_user_details')}}" name="mobile_number" id="mobile_number" autocomplete="off" minlength="10" maxlength="10" class="numeric form-control user_valid">
                            <span class="login_mobile_checker"></span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" required="required" id="password" name="password" autocomplete="off" class="form-control">
                        </div>
                        <div class="action_btns">
                            <div class="one_half">
                                <input id="remember" type="checkbox" checked="checked" />
                                <span class="remember">Remember me</span> </div>
                            <div class="one_half last actbtns">

                                <button  type="submit"  style="padding: 5px 8px 5px 10px;border: none !important"  class="newbtn_black login_but">Login</button>
                                &nbsp;</div>
                        </div>
                        <div class="one_half_row">
                            <div class="one_half">
                                <p><a href="#forgot" class="a-forgot">Forgot Password?</a></p>
                            </div>
                            <div class="one_half last">
                                <p><a href="#change" class="a-change">Change Password?</a></p>
                            </div>
                        </div>
                        <div class="best-view">
                            This website is best viewed in latest version of Google Chrome and Mozilla Firefox.
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <div id="forgot">
        <div class="modal-dialog modal-container">
            <header class="popupHeader"> <span class="header_title">Forgot Password</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody"> 			
                <div class="user_login">
                    <div id="error_message_forgot"></div>
                    <div id="success_message_forgot"></div>
                    <form  id="forgot_password_form" method="post"  data-toggle="validator" data-base-url ="{{url('')}}"  onsubmit="return ForgotPassword()" data-url="{{url('/forgot_password')}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>Email Id</label>
                            <input type="email" name="email2" id="email2" data-url="{{url('get_user_details')}}" autocomplete="off" class="form-control email_validation">
                            <span class="forgot_email_checker"></span>
                         <!--<a><i class="fa fa-spinner"> Checking ...</i></a>-->
                        </div>
                        <div class="form-group rowor">
                            <div class="orclass">
                                <span> OR</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" id="mobile_number2" data-url="{{url('get_user_details')}}" name="mobile_number2" maxlength="10" autocomplete="off" class="form-control numeric user_valid">
                            <span class="mobile_checker"></span>
                        </div>
                        <div class="action_btns">

                            <div class="newbtnv1" style="height:28px;margin-left:42%;">
                                <input name="" type="submit" value="SUBMIT"  class="btn_appearance" style="height: 26px;line-height: 1;width: 100%;" />
                                &nbsp;</div>
                        </div>
                        <div class="one_half_row">
                            <div class="one_half">
                                <p><a href="#signin" class="a-login">Login</a></p>
                            </div>
                            <div class="one_half last">
                                <p><a href="#change" class="a-change">Change Password?</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
    <div id="change">
        <div class="modal-dialog modal-container">
            <header class="popupHeader"> <span class="header_title">Change Password</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
            <section class="popupBody"> 		
                <div class="user_login">
                    <div id="error_message_change"></div>
                    <div id="success_message_change"></div>
                    <form id="change_password_form" method="post"  data-toggle="validator"  data-base-url ="{{url('')}}" onsubmit="return ChangePassword()" data-url="{{url('/change_password')}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label>Email Id</label>
                            <input type="email" required="required" data-url="{{url('get_user_details')}}" name="email" id="email" autocomplete="off" class="form-control email_validation">
                            <span class="change_email_checker"></span>
                        </div>
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" required="required" id="oldp_assword" name="old_password" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" required="required" id="password" name="password" autocomplete="off" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" required="required" id="password_confirmation" name="password_confirmation" autocomplete="off" class="form-control">
                        </div>
                        <div class="action_btns">

                            <div class="newbtnv1" style="height:28px;margin-left:42%;">
                                <input name="" type="submit" value="SUBMIT"  class="btn_appearance" style="height: 26px;line-height: 1;width: 100%;" />
                                &nbsp;</div>
                        </div>
                        <div class="one_half_row">
                            <div class="one_half">
                                <p><a href="#signin" class="a-login">Login</a></p>
                            </div>
                            <div class="one_half last">
                                <p><a href="#forgot" class="a-forgot">Forgot Password?</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>