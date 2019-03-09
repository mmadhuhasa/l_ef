@extends('layouts.backend_layout2',array('1'=>'1'))
@section('content')
<script src="{{url('app/new_temp/js/jquery.flexslider.js')}}"></script>
<link rel="stylesheet" href="{{url('app/new_temp/css/flexslider.css')}}"/>
<div class="page" id="app">
    <style>
	.fa-spinner:hover{color: grey !important}
	.fa-spinner{color: #f1292b !important}
	@media (min-width:1200px) {
	    .container {
		width: 1000px;
	    }
	}
	ul.read-list {
	    font-weight: bold;
	}
    </style>
    <script>
        $(function () {
            $(window).load(function () {
                $('.flexslider').flexslider({
                    start: function (slider) {
                        $('body').removeClass('loading');
                    }
                });

                $('.slides').removeClass('hidden');
                $("#loader_img").addClass('hidden');
            });
        })
    </script>
    @include('includes.ops.admin_header',[])
    <main>
	<section>
	    <div class="flexslider">
		<ul class="slides hidden">
		    <li>
			<img src="{{url('media/images/home/banner-1.jpg')}}">

			<p class="flex-caption">INDIA'S # 1 TRIP SUPPORT COMPANY</p>
		    </li>
		    <li>
			<img src="{{url('media/images/home/banner-2-a.jpg')}}">
			<p class="flex-caption">PLAN ON LAPTOP, MOBILE &amp; TABLET</p>
		    </li>
		    <li>
			<img src="{{url('media/images/home/banner-3.jpg')}}">
			<p class="flex-caption">MADE IN INDIA &amp; GOING GLOBAL</p>
		    </li>
		    <li>
			<img src="{{url('media/images/home/banner-9.jpg')}}">
			<p class="flex-caption">TRY FREE 14 DAYS TRIAL OFFER</p>
		    </li>
		</ul>
		<div class="loader_img" id="loader_img" width="100%" style="width: 100%;height: 100%;text-align: center;margin-top: 100px"><a href="#"><img src="{{url('media/images/home/loader.gif')}}" alt="loader" class="img-responsive"></a></div>
	    </div>
        </section>
    </main>
    @include('includes.v_footer',[])
</div>
@stop

