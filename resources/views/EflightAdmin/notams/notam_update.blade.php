<!-- resources/views/auth/login.blade.php -->
@extends('layouts.master',array('1'=>'1'))
@section('content')

<div class="container-fluid">
    <!--@include('includes.header',[])-->
    <div class='login_info'>   

        <span>

            <img style="height: 63px" src="media/logo/eflightlogo.png">

        </span>

    </div>
    @if(Session::get('success'))
    <div class='alert alert-success'>
        <button type="button" class="close" data-dismiss="alert" data-dismiss="alert">x</button>
        {{Session::get('success')}}
    </div>
    @endif
    @if(Session::get('error'))
    <div class='alert alert-danger'>
        <button type="button" class="close" data-dismiss="alert" data-dismiss="alert">x</button>
        {{Session::get('error')}}
    </div>
    @endif
    <div class="row">

        <div class="col-sm-12">

            <div class="box box-color box-bordered box-small">

                <div class="box-title">

                    <h3><i class="fa fa-external-link"></i>Bulk Update of Notams</h3>

                    <div class="actions">

                        <a href="search_notams.php" role="button" class="btn btn-mini"><i class="fa fa-history"></i> View Notams</a>              

                    </div>

                </div>

                <div class="box-content">       

                    <form onsubmit="submit_button.disabled = true;
                            submit_button.value = 'Please wait...';
                            return true;" action="{{url('/notams')}}" name="form" action="" method="POST">

                        <div class="form-group">

                            <label class="col-sm-offset-2 col-sm-10 control-label"><h4>Update Notams Data:</h4></label>

                            <div class="col-sm-offset-2 col-sm-8">

                                <textarea  name="notam" id="notam" rows="15" class="form-control" cols="117"></textarea>    

                            </div>   

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        </div>

                        <div class="col-sm-12 margin-top text-center"> 

                            <div id='result' class="margin-left"></div>

                            <input type="submit" id="notam_update" value="Update" class="btn btn-primary margin-left margin-bottom" name="submit_button" />

			    @if(Session::get('success'))
                            <a href="all_notams.php?recent=_v" class="btn btn-info margin-bottom" id="view" name="view" target="_blank">Recent Updated NOTAMS</a>            

                            <a href="view_new_notams.php?recent=_all" class="btn btn-success margin-bottom" id="view_new"  target="_blank">New NOTAMS</a>

                            <a href="view_routes.php" class="btn btn-danger margin-bottom" id="view_route"  target="_blank">Routes</a>

                            <a href="all_notams.php?dupe=_dupes" class="btn btn-default margin-bottom" id="view_dupes"  target="_blank">Duplicates</a>

                            <a href="view_coordinates.php?_recent=_all" class="btn btn-warning margin-bottom" id="coordinates"  target="_blank">Coordinates</a>
			    @endif
                        </div>

                        <span class="margin-bottom"></span>

                    </form>

                </div>

            </div> 

        </div>

    </div>

</div>
@stop