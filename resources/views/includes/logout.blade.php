<!-- Beginning of Login Modal Box -->
<div id="logoutbox" class="modal fade" style="display:none;">
    <div class="modal-dialog modal-container">
	<header class="popupHeader"> <span class="header_title">Logout</span><span class="modal_close" data-dismiss="modal"><i class="fa fa-times-circle"></i></span> </header>
	<section class="popupBody"> 
	    <!-- Social Login --> 

	    <!-- Username & Password Login form -->
	    <div class="user_login">
		<h5>ARE YOU SURE TO LOG OUT?</h5>
		<div class="action_btns">
<!--		    <div class="row">
			<div class="actbtns">
			    <div class="col-md-6 col-sm-6 col-xs-6">
				<a href="{{url('account/logout')}}" class="form-control text-capitalize newbtnv1" >Yes</a>
			    </div>
			</div>
		    </div>-->
                    <div class="row">
		    <div class="col-md-12 yesedit">
			<a href="{{url('account/logout')}}" class="btn newbtn_black">Yes</a>
		    </div>  
		</div>
		</div>

	    </div>
	</section>
    </div>
</div>
<!-- End of Login Modal Box --> 