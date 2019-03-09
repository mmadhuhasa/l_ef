@extends('layouts.new_fpl_layout',array('1'=>'1'))
@section('content')
<div id="page">
    <header>
	<div class="topband">
	    <div class="container cust-container">
		<div class="row">
		    <div class="col-md-6 col-md-offset-6">
			<div class="row">
			    <div id="timeTM" class="col-md-5 col-md-offset-5 time"> </div>
			    <div class="col-md-2 login logtoggle">
				<a data-toggle="dropdown" class="dropdown dropdown-toggle"><img src="{{url('media/ananth/images/user.png')}}" alt="user" class="img-responsive"></a>
				<ul class="dropdown-menu">
				    <li><a href="#">My Account</a></li>        
				    <li class="logout"><a  href="#">Logout</a></li>
				</ul>
			    </div>
			</div>
		    </div>
		</div>
	    </div>
	</div>
	<div class="navigation">
	    <div class="container cust-container">
		<div class="row">
		    <div class="col-md-3 logo"> <a href="#" ><img src="{{url('media/ananth/images/logo.png')}}" class="img-responsive" alt="eflight-logo"></a></div>
		    <div class="col-md-7 desk-menu pull-right">
			<nav class="menu">
			    <ul class="nav shadow clearfix nojs" id="menu">
				<li><a href="#" >Home</a></li>
				<li><a href="#" >About Us</a></li>
				<li><a href="#" >Services</a></li>                                                                                                                                              			              <li><a href="#">Trip Support</a></li> <li> <a href="#">Airports</a> </li>
				<li><a href="#">Contact Us</a></li>
			    </ul>
			</nav>
		    </div>
		</div>
	    </div>
	</div>
	<div class="mobile-nav">
	    <div class="container">
		<div class="row">
		    <div class="col-md-12">
			<nav>
			    <ul>
				<li><a href="#" >Home</a></li>
				<li><a href="#" >About Us</a></li>
				<li><a href="#" >Services</a>
				    <ul>
					<li><a href="#" >Online FPL</a></li>
					<li><a href="#" >FDTL</a></li>
					<li><a href="#" >Nav Log</a></li>
					<li><a href="#" >Load Trim</a></li>
					<li><a href="#" >Runway Analysis</a></li>
					<li><a href="#" >NOTAMS</a></li>
					<li><a href="#" >Weather</a></li>
					<li><a href="#" >License Reminders</a></li>
				    </ul>

				</li>
				<li> <a href="#" >Trip Support</a>
				    <ul>
					<li><a href="#" >International</a></li>
					<li><a href="#" >Domestic</a></li>
				    </ul>

				</li>
				<li> <a href="#" >Airports</a> </li>
				<li> <a href="#" >Contact Us</a> </li>
			    </ul>
			</nav>
		    </div>
		</div>
	    </div>
	</div>
    </header>
    <section>
	<div class="container cust-container">
	    <div class="row">
		<div class="banner">
		    <div class="col-md-9 page-left-content noleftpad">
			    <!--<img class="img-responsive" alt="eflight-slider-1" src="assets/images/sliders/1.jpg">   -->			
			<div id="eflight-slider" class="carousel slide" data-ride="carousel">
			    <!-- Indicators -->
			    <ol class="carousel-indicators slide-indicators">
                                <!-- <li data-target="#eflight-slider" data-slide-to="0" class="active"></li> -->
                                <li data-target="#eflight-slider" data-slide-to="1"></li>
                                <li data-target="#eflight-slider" data-slide-to="2"></li>
                                <li data-target="#eflight-slider" data-slide-to="3"></li>
                                <li data-target="#eflight-slider" data-slide-to="4"></li>
                                <li data-target="#eflight-slider" data-slide-to="5"></li>
                                <li data-target="#eflight-slider" data-slide-to="6"></li>
                                <li data-target="#eflight-slider" data-slide-to="7"></li>
			    </ol>

			    <!-- Wrapper for slides -->
			    <div class="carousel-inner" role="listbox">
                                <!-- <div class="item active">
                                  <img src="assets/images/sliders/7.jpg" class="img-responsive" alt="30-day-free-trial">
                                </div> -->
                                <div class="item active">
				    <img src="{{url('media/ananth/images/sliders/1.jpg')}}" class="img-responsive" alt="30-day-free-trial">
                                </div>
                                <div class="item">
				    <img src="{{url('media/ananth/images/sliders/2.jpg')}}" class="img-responsive" alt="30-day-free-trial">
                                </div>
                                <div class="item">
				    <img src="{{url('media/ananth/images/sliders/3.jpg')}}" class="img-responsive" alt="30-day-free-trial">
                                </div>
                                <div class="item">
				    <img src="{{url('media/ananth/images/sliders/4.jpg')}}" class="img-responsive" alt="30-day-free-trial">
                                </div>
                                <div class="item">
				    <img src="{{url('media/ananth/images/sliders/5.jpg')}}" class="img-responsive" alt="30-day-free-trial">
                                </div>
                                <div class="item">
				    <img src="{{url('media/ananth/images/sliders/6.jpg')}}" class="img-responsive" alt="30-day-free-trial">
                                </div>
                                <div class="item">
				    <img src="{{url('media/ananth/images/sliders/7.jpg')}}" class="img-responsive" alt="30-day-free-trial">
                                </div>
			    </div>

			    <!-- Controls -->
			    <a class="left carousel-control" href="#" role="button" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
			    </a>
			    <a class="right carousel-control" href="#eflight-slider" role="button" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
			    </a>
			</div>                         
		    </div>	
		    <div class="col-md-3 page-right-content nopad">
			<ul class="list">
			    <li><a href="#" >Online FPL</a></li>
			    <li><a href="#" >FDTL</a></li>
			    <li><a href="#" >NAV LOG</a></li>
			    <li><a href="#" >LOAD TRIM</a></li>
			    <li><a href="#" >RUNWAY ANALYSIS</a></li>
			    <li><a href="#" >NOTAMS</a></li>
			    <li><a href="#" >WEATHER</a></li>
			    <li><a href="#" >LICENSE REMINDERS</a></li>

			</ul>	
		    </div>
		</div>	
	    </div>
	    <div class="row">
		<div class="col-md-12 nopad">
		    <div class="home-content">
			<h3>Welcome to <span>Eflight</span></h3>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>

		    </div>
		</div>
	    </div>
	    <div class="row">
		<div class="col-md-12 nopad">
		    <div class="client-slider"> 
			<div class="clients_wrapper">                       	
			    <ul id="carousel">
				<li class="img-responsive client-logo client-logo1"></li>
				<li class="img-responsive client-logo client-logo2"></li>
				<li class="img-responsive client-logo client-logo3"></li>
				<li class="img-responsive client-logo client-logo4"></li>
				<li class="img-responsive client-logo client-logo5"></li>
				<li class="img-responsive client-logo client-logo6"></li>
				<li class="img-responsive client-logo client-logo7"></li>
				<li class="img-responsive client-logo client-logo8"></li>
				<li class="img-responsive client-logo client-logo9"></li>
				<li class="img-responsive client-logo client-logo10"></li>
				<li class="img-responsive client-logo client-logo11"></li>
				<li class="img-responsive client-logo client-logo12"></li>
				<li class="img-responsive client-logo client-logo13"></li>
				<li class="img-responsive client-logo client-logo14"></li>
				<li class="img-responsive client-logo client-logo15"></li>
			    </ul>
			</div>   
		    </div>
		</div>
	    </div>
	</div>	
    </section>
    <footer>
	<section id="bottom">
	    <div class="container cust-container">
		<div class="row">      
		    <div class="col-md-2">
			<h4>About <span>Eflight</span></h4>
			<ul class="arrow">
			    <li><a href="#">Overview</a></li>
			    <li><a href="#">Mission &amp; Vision</a></li>
			    <li><a href="#">Team</a></li>
			    <li><a href="#">Testimonials</a></li>
			    <li><a href="#">Our Clients</a></li>
			</ul>
		    </div>
		    <!--/.col-md-3-->        
		    <div class="col-md-4">
			<div class="row">	
			    <div class="col-sm-12">
				<h4 class="services">Services</h4>
			    </div>
			</div>   
			<div class="row">
			    <div class="col-md-6">
				<ul class="arrow">
				    <li><a href="#">Online Flight Plan</a></li>
				    <li><a href="#">NAV LOG</a></li>
				    <li><a href="#">Load Trim</a></li>
				    <li><a href="#">NOTAMS</a></li>                           
				</ul>
			    </div>
			    <div class="col-md-6">
				<ul class="arrow">
				    <li><a href="#">Weather</a></li>
				    <li><a href="#">FDTL</a></li>
				    <li><a href="#">License Reminder</a></li>
				    <li><a href="#">Pilot LogBook</a></li>                           
				</ul>
			    </div> 	

			</div>
		    </div>
		    <div class="col-md-2">
			<h4>Trip Support</h4>
			<ul class="arrow">
			    <li><a href="#">Ground Handling</a></li>
			    <li><a href="#">Pre &amp; Post Medical</a></li>
			    <li><a href="#">Hotel Booking</a></li>
			    <li><a href="#">Fuel Services</a></li>            
			</ul>
		    </div>
		    <div class="col-md-2">
			<h4>Airports</h4>
			<ul class="arrow">
			    <li><a href="#">Domestic</a></li>
			    <li><a href="#">International</a></li>
			    <li><a href="#">Private</a></li>
			    <li><a href="#">Defense</a></li>            
			</ul>
		    </div>
		    <div class="col-md-2">
			<h4>Contact Us</h4>
			<ul class="arrow">
			    <li><a href="#">Contact Us</a></li>                      
			</ul>
		    </div>


		</div>
	    </div>
	</section>
	<!--/#bottom-->

	<div class="copyright">
	    <div class="container cust-container">
		<div class="row"><div class="col-md-12"> &copy; 2016 EFLIGHT - A Unit of <a href="http://www.pravahya.com/" target="blank">PRAVAHYA</a> </div>

		</div>
	    </div>
	</div>
    </footer>
    <!-- Beginning of Login Modal Box -->
    <div id="loginbox" class="modal fade" style="display:none;">
	<div class="modal-dialog modal-container">
	    <header class="popupHeader"> <span class="header_title">Login</span> <span class="modal_close" data-dismiss="modal"><i class="icon-remove"></i></span> </header>
	    <section class="popupBody"> 
		<!-- Social Login --> 

		<!-- Username & Password Login form -->
		<div class="user_login">
		    <form method="post" action="#" name="login">
			<div class="form-group">
			    <label>Username</label>
			    <input type="text" class="form-control">
			</div>
			<div class="form-group">
			    <label>Password</label>
			    <input type="password" class="form-control">
			</div>
			<div class="action_btns">
			    <div class="one_half">
				<input id="remember" type="checkbox" />
				<span>Remember me</span> </div>
			    <div class="one_half last">
				<input name="" type="button" value="Login" class="red_button" />
				&nbsp;</div>
			</div>
			<div class="one_half_row">
			    <div class="one_half">
				<p><a href="#">Forgot Password?</a></p>
			    </div>
			    <div class="one_half last">
				<p><a href="#">Change password?</a></p>
			    </div>
			</div>
		    </form>
		</div>
	    </section>
	</div>
    </div>
    <!-- End of Login Modal Box -->	
</div>	
@stop
