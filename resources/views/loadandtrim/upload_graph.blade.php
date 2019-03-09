@extends('layouts.lnt_layout',array('aircraft_callsign'=>'1'))
@section('content')



<div class="page">  
    @include('includes.new_header',[])
    <section>
        <div class="container">
            <div class="row">
                <div class="lt-sec">
                    <div class="col-xs-12 col-sm-12 col-md-12 lt-xs-pad-5">
                        <form action="{{url('postlnt/upload')}}" method="POST" enctype="multipart/form-data" role="form" id="upload_graph" class="lt-tc-form">
			    <div class="col-sm-3">
				<div class="form-group">
				    <label class="control-label">CallSign</label>   
				    <input type="text" placeholder="Callsign" name="aircraft_callsign" id="aircraft_callsign" class="form-control" value="" />
				</div>
			    </div>
			    <div class="col-sm-3">
				<div class="form-group">
				    <label class="control-label">Pilot Name</label>   
				    <input type="text" name="pilot_in_command" placeholder="Pilot Name" id="pilot_in_command" class="form-control" value="" />
				</div>
			    </div>
			    <div class="col-sm-3">
				<div class="form-group">
				    <label class="control-label">Image</label>   
				    <input type="file" name="graph_image" id="graph_image" class="form-control" value="" />
				</div>
			    </div>
			    <div class="col-sm-3">
				<div class="form-group">
				    <label class="control-label">Action</label>
				    <input type="submit" name="" id="" class="btn-primary form-control" value="Upload" />
				</div>
			    </div>


			    <!--Hidden fields-->
                            <input type="hidden" name="aircraft_callsign" id="aircraft_callsign" value="vtngs" />
                            <input type="hidden" name="current_date" id="current_date" value="{{date('ymd')}}" />			  
			    <input type="hidden" name="_token" value="{{csrf_token()}}" />			
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('includes.new_footer',[])
</div>
@stop