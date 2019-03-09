<!-- Beginning of Login Modal Box -->
<div id="logoutbox" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-container">
	<header class="popupHeader"> <span class="header_title">Logout</span> <span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
	<section class="popupBody"> 
	    <!-- Social Login --> 

	    <!-- Username & Password Login form -->
	    <div class="user_login">
		<h5>ARE YOU SURE TO LOG OUT?</h5>
		<div class="action_btns">
		    <div class="row">
			<div class="actbtns">
			    <div class="col-md-6">
				    <!--<input type="button" value="Yes" class="form-control red_buttons">-->
				<a href="{{url('account/logout')}}" class="form-control text-capitalize red_btn_skew" >Yes</a>
			    </div>
			    <div class="col-md-6">

                                <button  data-dismiss="modal" type="button"  class=" modal_close form-control red_buttons text-capitalize black_btn_skew">No</button>
                            </div>
			</div>
		    </div>
		</div>

	    </div>
	</section>
    </div>
</div>
<!-- End of Login Modal Box --> 