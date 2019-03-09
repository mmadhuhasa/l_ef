
@extends('layouts.notam_layout',array('1'=>'1'))
@section('content')
@push('watchhourcss') 
<link rel="stylesheet" type="text/css" href="{{url('/app/css/notams/watchhour.css')}}"></link> 
<link rel="stylesheet" type="text/css" href="{{url('app/css/notams/multipleDatePicker.css')}}"><link>
<link rel="stylesheet" type="text/css" href="{{url('app/css/notams/daterangepicker.css')}}"><link>
<script src="{{url('app/js/notams/daterangepicker.js')}}"></script>
<script src="{{url('app/js/notams/watchhours_edit.js')}}"></script>
<script src="{{url('app/js/notams/multipleDatePicker.js')}}"></script>
@endpush 
<style type="text/css">
    table{
        width: 500px;
    }
    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        width: 75%;
        border-radius: 5px;
        background: #fff;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .form-inline .form-control{
        width: 125px;
        margin: 10px 0px;
    }
    select.form-control{
        color: #000;
    }
</style>
<div class="page">
    <!-- @include('includes.new_fpl_header',[]) -->
    @include('includes.new_header',[])
    <main>
        <section class="bg-1 welcome infopage" ng-app="navlog" ng-controller="watchHoursEditCtrl">
            @include('includes.watchhours_modal',[])
            <div class="container container-notam card">
                <form class="form-inline" action="/riseset" method="POST">
                    {{ csrf_field()}}
                    <div class="form-group">
                        <select class="form-control" name="location">
                            <option value="0" @if($request['location']==0){{ 'selected'}} @endif  >Banglore</option>
                            <option value="1" @if($request['location']==1){{ 'selected'}} @endif>Delhi</option>
                            <option value="2" @if($request['location']==2){{ 'selected'}} @endif>Chennai</option>
                            <option value="3" @if($request['location']==3){{ 'selected'}} @endif>Mumbai</option>
                            <option value="4" @if($request['location']==4){{ 'selected'}} @endif>Kolkata</option>
                        </select>    </div>
                    <div class="form-group">
                        <select class="form-control" name="month" >
                            <option value="1" @if($request['month']==1){{ 'selected'}} @endif>Jan</option>
                            <option value="2" @if($request['month']==2){{ 'selected'}} @endif>Feb</option>
                            <option value="3" @if($request['month']==3){{ 'selected'}} @endif>Mar</option>
                            <option value="4" @if($request['month']==4){{ 'selected'}} @endif>Apr</option>
                            <option value="5" @if($request['month']==5){{ 'selected'}} @endif>May</option>
                            <option value="6" @if($request['month']==6){{ 'selected'}} @endif>June</option>
                            <option value="7" @if($request['month']==7){{ 'selected'}} @endif>July</option>
                            <option value="8" @if($request['month']==8){{ 'selected'}} @endif>Aug</option>
                            <option value="9" @if($request['month']==9){{ 'selected'}} @endif>Sep</option>
                            <option value="10" @if($request['month']==10){{ 'selected'}} @endif>Oct</option>
                            <option value="11" @if($request['month']==11){{ 'selected'}} @endif>Nov</option>
                            <option value="12" @if($request['month']==12){{ 'selected'}} @endif>Dec</option>
                        </select>    </div>
                    <div class="form-group">
                        <select class="form-control" name="year">
                            <option @if($request['year']==2017){{ 'selected'}} @endif>2017</option>
                            <option @if($request['year']==2018){{ 'selected'}} @endif>2018</option>
                            <option @if($request['year']==2019){{ 'selected'}} @endif>2019</option>
                            <option @if($request['year']==2020){{ 'selected'}} @endif>2020</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-default newbtnv1">Submit</button>
                </form>
                <table border="1">
                    <tr>
                        <th>Date</th>
                        <th>Rise time</th>
                        <th>Set time</th>
                    </tr>
                    @foreach($data as $val)
                    <tr>
                        <td>{!! $val[0] !!}</td>
                        <td>{!! $val[1] !!}</td>
                        <td>{!! $val[2] !!}</td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </section>
    </main>   
    <div id='v_toTop'><span></span></div>



    <script>
        $(window).scroll(function () {
            if ($(this).scrollTop()) {
                $('#v_toTop').fadeIn();
                $('#v_toTop_mid').fadeIn();
            } else {
                $('#v_toTop_mid').fadeOut();
                $('#v_toTop').fadeOut();
            }
        });
        $("#v_toTop").click(function () {
            $("html, body").animate({scrollTop: 0}, 500);
        });
    </script>

    @include('includes.new_footer',[])
</div>
@stop