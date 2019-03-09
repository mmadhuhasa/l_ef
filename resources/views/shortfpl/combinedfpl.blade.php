@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" href="{{url('app/css/navlog/navlog.css')}}">
<script src="{{url('app/js/navlog/angular.min.js')}}"></script>
<script src="{{url('app/js/navlog/moment.min.js')}}"></script>
<script src="{{url('app/js/navlog/jquery.redirect.js')}}"></script>
<script src="{{url('app/js/navlog/combinedfpl.js')}}"></script>
<style>
    .m-tb-20 {
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .nlg_process_btn {
        line-height: 0;
    }
    .social-stat .fa {
        font: 400 22px/35px "FontAwesome";
    }
    @media only screen and (max-width: 767px) and (min-width: 320px) {
        .container-fluid {
            margin-top: 56px;
        }
    }
</style>
<div class="page"  ng-app="eflight" ng-controller="combinedfplCtrl">  
    @include('includes.new_header',[])
    @include('includes.navlog_modal',[])
    <main id="navlog-main">
        <section>
            <div class="container container-short-fpl m-tb-20" style="background: #fff;padding-top: 10px;padding-bottom: 20px;border-radius: 4px;border:1px solid #bbb;width: 1000px !important;">
                <div class="row">
                <form class="col-md-5">
                    <textarea id="pasteLntTextArea" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Paste Nav Log data'" data-toggle="popover" data-placement="top" rows="14"  cols="100" ng-model="pasteLnt.text" placeholder="Paste Nav Log data"></textarea>
                    <button  class="btn nlg_process_btn newbtnv1" ng-click="next()">Next</button>
                </form>
                <i  class="fa fa-arrow-right col-md-2 arrow-icon"></i>
                 <form class="col-md-5">
                    <textarea id="shortfpl" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Paste fpl'" data-toggle="popover" data-placement="top" rows="14"  cols="100" ng-model="shortFpl.text" placeholder="Paste fpl"></textarea>
                    <button ng-disabled="!enableProcess"  class="btn nlg_process_btn newbtnv1" ng-click="process()">Process</button>
                </form>
                </div>
            </div>
        </section>
    </main>
    @include('includes.new_footer',[])

    @include('includes.xml_reset',[])
</div>
@stop