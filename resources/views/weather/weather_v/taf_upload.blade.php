@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
<link rel="stylesheet" type="text/css" href="{{url('app/css/weather/taf_upload.css')}}">
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
                <form action="{{url('/weather/taf/upload')}}" method="post">
                    {{ csrf_field() }}
<!--                    <div class="col-md-2 nopadding">
                        <div class="form-group">
                            <select class="form-control">
                                <option selected disabled>Select TAF to Upload</option>
                                <option>Long Taf</option>
                                <option>Short Taf</option>
                            </select>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <textarea rows="10" class="form-control" id="" name="taf" placeholder="PASTE TAF DATA"><?php
                            if (!empty(Session::get('error'))) {
                                echo htmlentities($_POST['taf']);
                            }
                            ?></textarea>
                    </div>
                    <button type="submit" class="btn newbtnv1 upload_btn pull-right">Upload</button>
                </form>
            </div>
        </div>
    </div>
    @include('includes.new_footer',[])
</div>
@stop