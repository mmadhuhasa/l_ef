@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/weather/weather_upload.css')}}">
@endpush
@section('content')
<div id="page">
    @include('includes.new_header',[])
    <div class="container cust-container">
        <div class="row">
            <div class="col-md-12">
                @if(Session::has('error'))
                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                @if(Session::has('message'))
                <p class="alert alert-info">{{ Session::get('message') }}</p>
                @endif
            </div>
            <div class="col-md-12">
                <form action="{{url('/weather/upload')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea rows="10" class="form-control" id="wx" name="wx" placeholder="PASTE METAR DATA"><?php if(!empty(Session::get('error'))) {echo htmlentities ($_POST['wx']); }?></textarea>
                    </div>
                    <button type="submit" class="btn newbtnv1 upload_btn pull-right">Upload</button>
                </form>
            </div>
        </div>
    </div>
    @include('includes.new_footer',[])
</div>
@stop