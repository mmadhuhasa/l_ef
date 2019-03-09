@extends('layouts.backend_layout',array('1'=>'1'))

@section('content')

<link rel="stylesheet" type="text/css" href="{{url('app/css/home/fullcalendar.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/pilot_profile.css')}}">
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/monthly.css')}}">
<link rel="shortcut icon" href="../favicon.ico"> 
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/default.css')}}" />
<link rel="stylesheet" type="text/css" href="{{url('app/css/home/component.css')}}" />
<script src="{{url('app/js/home/modernizr.custom.js')}}"></script>
<script src="{{url('app/js/navlog/moment.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.5/angular.js"></script>     

<script src="{{url('app/js/home/fullcalendar.js')}}"></script>
<script src="{{url('app/js/home/monthly.js')}}"></script>
<script src="{{url('app/js/home/pilot_profile.js')}}"></script>



@include('includes.new_header',[])


@include('includes.watchhours_modal',[])
<div class="container cust-container" >
    <div class="md-modal md-effect-1" id="modal-1">
        <div class="md-content">
            <h3>Modal Dialog</h3>
            <div>
                <p>This is a modal window. You can do the following things with it:</p>
                <ul>
                    <li><strong>Read:</strong> modal windows will probably tell you something important so don't forget to read what they say.</li>
                    <li><strong>Look:</strong> a modal window enjoys a certain kind of attention; just look at it and appreciate its presence.</li>
                    <li><strong>Close:</strong> click on the button below to close the modal.</li>
                </ul>
                <button class="md-close">Close me!</button>
            </div>
        </div>
    </div>
    <button class="md-trigger" data-modal="modal-1"></button>

    <div class="row">
        <div style="width:100%; max-width:660px; display:inline-block;padding: 15px;">

            <div class="monthly" id="mycalendar1"></div>
        </div>

        <div class="col-md-12 sec_mar">
            <div class="col-md-8" >
                <div id='mycalendar'>

                </div>
            </div>
            <div class="col-md-4" id='calendar1'></div>
        </div>
    </div>
</div>
<div class="md-overlay"></div><!-- the overlay element -->

<!-- classie.js by @desandro: https://github.com/desandro/classie -->
<script src="{{url('app/js/home/classie.js')}}"></script>
<script src="{{url('app/js/home/modalEffects.js')}}"></script>

<!-- for the blur effect -->
<!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
<script>
// this is important for IEs
var polyfilter_scriptpath = '/js/';
</script>
<script src="{{url('app/js/home/cssParser.js')}}"></script>
<script src="{{url('app/js/home/css-filters-polyfill.js')}}"></script>
@include('includes.new_footer',[])


<script type="text/javascript">
$(document).ready(function () {
    $(".m-d .monthly-indicator-wrap").each(function (index) {
        var childrens = $(this).children();
        if (childrens.length != 0) {
            $(this).parents().addClass(childrens[0].classList[1]);
        }
    });
});
</script>
@stop