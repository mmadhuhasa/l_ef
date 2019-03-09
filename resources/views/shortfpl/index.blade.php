@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" href="{{url('app/css/navlog/navlog.css')}}">
<script src="{{url('app/js/navlog/angular.min.js')}}"></script>
<script src="{{url('app/js/navlog/moment.min.js')}}"></script>
<script src="{{url('app/js/navlog/jquery.redirect.js')}}"></script>
<script src="{{url('app/js/navlog/navlog.js')}}"></script>
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
    .container-short-fpl .nlg_process_btn:hover {
    transition: 0.25s all ease;
    webkit-transition: 0.25s all ease;
    }
    @media only screen and (max-width: 767px) and (min-width: 320px) {
        .container-fluid {
            margin-top: 56px;
        }
    }
</style>
<div class="page"  ng-app="navlog" ng-controller="shortfplCtrl">  
    @include('includes.new_header',[])
    @include('includes.navlog_modal',[])
    <main id="navlog-main">
        <section>
            <div class="container container-short-fpl m-tb-20" style="background: #fff;padding-top: 10px;padding-bottom: 20px;border-radius: 4px;border:1px solid #bbb;">
                <form >
                    <textarea id="shortfpl" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Paste fpl'" data-toggle="popover" data-placement="top" rows="14"  cols="100" ng-model="shortFpl.text" placeholder="Paste fpl"></textarea>
                    <button  class="newbtnv1 b-radius-5 btn nlg_process_btn" ng-click="process()">Process</button>
                </form>
            </div>
        </section>
    </main>
    @include('includes.new_footer',[])

    @include('includes.xml_reset',[])
</div>
@stop