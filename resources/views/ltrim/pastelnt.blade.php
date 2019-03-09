@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
<link rel="stylesheet" href="{{url('app/css/navlog/navlog.css')}}">
<script src="{{url('app/js/navlog/angular.min.js')}}"></script>
<script src="{{url('app/js/navlog/moment.min.js')}}"></script>
<script src="{{url('app/js/navlog/jquery.redirect.js')}}"></script>
<script src="{{url('app/js/loadandtrim/pastelnt.js')}}"></script>
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
<div class="page"  ng-app="eflight" ng-controller="pasteLntCtrl">  
    @include('includes.new_header',[])
    @include('includes.navlog_modal',[])
    <main id="navlog-main">
   
        <section>
           @if (session('status'))
       <div class="alert alert-danger" style="text-align: center;text-align: center;margin-top: 19px;width: 38%;margin-left: 31%;">
        {{ session('status') }}
      </div>
    @endif
            <div class="container container-short-fpl m-tb-20" style="background: #fff;padding-top: 10px;padding-bottom: 20px;border-radius: 4px;border:1px solid #bbb;">

                <form >
                    <textarea id="pasteLntTextArea" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Paste Load and trim'" data-trigger="manual" data-toggle="popover" popover-hoverable="false" data-placement="top" rows="14"  cols="100" ng-model="pasteLnt.text" placeholder="Paste Load and trim"></textarea>
                    <button  class="btn nlg_process_btn" ng-click="process()">Process</button>
                </form>
            </div>
        </section>
    </main>
    @include('includes.new_footer',[])

    @include('includes.xml_reset',[])
</div>
@stop