@extends('layouts.check_quick_plan_layout')
@section('content')
<div class="page" id="app">  
    @include('includes.new_header',[])
<style>

.progress {
    position: relative;
	height: 25px;
    margin-top: 12px;
}
.progress > .progress-type {
	position: absolute;
	left: 0px;
	font-weight: 800;
	padding: 3px 30px 2px 10px;
	color: rgb(255, 255, 255);
	background-color: rgba(25, 25, 25, 0.2);
}
.progress > .progress-completed {
	position: absolute;
	right: 0px;
	font-weight: 800;
	padding: 3px 10px 2px;
}
.progress-bar{
    border-bottom: 2px solid #f1292b;
    background:-webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#f37858));
}




</style>
<div class="container">
	<div class="row col-md-6" style="margin-right:15px;">
    <h6>FPL BREAK UP</h6>                 
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:28%;">
                <span class="sr-only">60% Complete</span>
            </div>
            <span class="progress-type">NAV LOG PLANS</span>
            <span class="progress-completed">28%</span>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 18%">
                <span class="sr-only">40% Complete (success)</span>
            </div>
            <span class="progress-type">Wx NOTAMS PLANS</span>
            <span class="progress-completed">18%</span>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                <span class="sr-only">20% Complete (info)</span>
            </div>
            <span class="progress-type">ADC PLANS</span>
            <span class="progress-completed">20%</span>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                <span class="sr-only">60% Complete (warning)</span>
            </div>
            <span class="progress-type">ADC DELAYED PLANS</span>
            <span class="progress-completed">60%</span>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                <span class="sr-only">80% Complete (danger)</span>
            </div>
            <span class="progress-type">FPL REVISED PLANS</span>
            <span class="progress-completed">80%</span>
        </div>
	</div>

    <div class="row col-md-6">
    <h6>FPL BREAK UP</h6>                         
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:28%;">
                <span class="sr-only">60% Complete</span>
            </div>
            <span class="progress-type">NAV LOG PLANS</span>
            <span class="progress-completed">28%</span>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 18%">
                <span class="sr-only">40% Complete (success)</span>
            </div>
            <span class="progress-type">Wx NOTAMS PLANS</span>
            <span class="progress-completed">18%</span>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                <span class="sr-only">20% Complete (info)</span>
            </div>
            <span class="progress-type">ADC PLANS</span>
            <span class="progress-completed">20%</span>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                <span class="sr-only">60% Complete (warning)</span>
            </div>
            <span class="progress-type">ADC DELAYED PLANS</span>
            <span class="progress-completed">60%</span>
        </div>
        <div class="progress">
            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                <span class="sr-only">80% Complete (danger)</span>
            </div>
            <span class="progress-type">FPL REVISED PLANS</span>
            <span class="progress-completed">80%</span>
        </div>
	</div>

</div>




    @include('includes.new_footer',[])
</div>
@stop