<style type="text/css">
    /*    #progress_bar{
	    background-color:#f1292b;	
	}*/
    .ui-widget-content{
	border:none;
    }
    #progress_bar .ui-widget-header {
	background: repeating-linear-gradient( 45deg, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) 10px, rgba(0, 0, 0, 0.3) 10px, rgba(0, 0, 0, 0.3) 20px );
	height: 15px;
	/*width: 100% !important;*/
    }
    .modal-body{
    	padding: 0 20px;
    text-align: center;
    font-size: 14px;
    }
    #notam-pg-box .modal-container{
    	/*background: none;*/
    	box-shadow: none;
    }
    .modal-backdrop.in {
	opacity: 0.4;
}
    /*    .ui-progressbar-value {
		background: url(http://www.netanimations.net/Animated-fighter-plane-fly-by.gif) no-repeat;
		border:none;
	    }
	    .ui-progressbar {
		height: 20px
	    }*/
    /*.ui-autocomplete-loading { background:url("http://www.gifs.cc/aircraft/harrier-jet-animated-1.gif") no-repeat right center }*/
</style>
<div id="statsmodal" class="modal fade" style="display:none;" >
    <div class="modal-dialog modal-container">
	<header class="popupHeader">
            <span class="header_title">STATS</span>
            <span class="modal_close" data-dismiss="modal">
                <i class="fa fa-times-circle"></i>
            </span>
        </header>
	<section class="popupBody modal-body">
		<div class="row stats-strip">
        <div class="dash-box-n">
            <p class="dash-box-n-value"><img class="plan-till-img" src="{{url('media/images/profile/plan-till-date.png')}}">150</p>
            <p class="dash-box-n-label">PLANS FILED TILL DATE</p>
        </div>
        <div class="dash-box-n">

            <p class="dash-box-n-value">
                <img class="eflight-img" src="{{url('media/images/profile/eflight-ops.png')}}">25</p>
            <p class="dash-box-n-label">BY EFLIGHT</p>
        </div>
        <div class="dash-box-n">
            <p class="dash-box-n-value"> <img class="eflight-img" src="{{url('media/images/profile/company-ops.png')}}">150</p>
            <p class="dash-box-n-label">BY COMPANY OPS</p>
        </div>
        <div class="dash-box-n">
            <p class="dash-box-n-value"><img class="eflight-img" src="{{url('media/images/profile/self.png')}}">150</p>
            <p class="dash-box-n-label">BY SELF</p>
        </div>
        <div class="dash-box-n">
            <p class="dash-box-n-value"><img class="mobileapp-img" src="{{url('media/images/profile/laptop.png')}}">150</p>
            <p class="dash-box-n-label">THRU LAPTOP</p>
        </div>
        <div class="dash-box-n">
            <p class="dash-box-n-value"><img class="mobileapp-img" src="{{url('media/images/mobile-icon1.png')}}">25</p>
            <p class="dash-box-n-label">THRU APP</p>
        </div>
    </div>  
    <div class="row stats-strip stats-strip2">


        <div class="dash-box-n dash-box-n2">
            <p class="dash-box-n-value"><img class="month-img-icon" src="{{url('media/images/profile/domestic.png')}}">150</p>
            <p class="dash-box-n-label">THIS MONTH DOMESTIC</p>
        </div>
        <div class="dash-box-n dash-box-n2">
            <p class="dash-box-n-value"><img class="month-img-icon" src="{{url('media/images/profile/intl.png')}}">150</p>
            <p class="dash-box-n-label">THIS MONTH INTL</p>
        </div>
        <div class="dash-box-n dash-box-n2">
            <p class="dash-box-n-value"><img class="year-img-icon" src="{{url('media/images/profile/year01.png')}}">150</p>
            <p class="dash-box-n-label">THIS YEAR DOMESTIC</p>
        </div>
        <div class="dash-box-n dash-box-n2">
            <p class="dash-box-n-value"><img class="year-img-icon" src="{{url('media/images/profile/year01.png')}}">150</p>
            <p class="dash-box-n-label">THIS YEAR INTL</p>
        </div>
    </div>
	</section>
    </div>
</div>

