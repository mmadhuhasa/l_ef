@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<div class="page" id="quick_app">
    @include('includes.new_header',[])
    <main>
        <div class="container">
            <div class="bg-white" style="margin: 10px">
                <div></div>
                <form name="" id="" method="post" action="{{url('fplupload')}}" enctype="multipart/form-data">
                    <div class="row" style="border: 1px solid lightgray">
                        @if(Session::get('success'))  
                        <div class="alert alert-success" style="margin-top: 3px">
                            <!--Success!-->
                            <span> Updated FPL count: {{Session::get('update_count')}}</span><br/>
                            <span> New FPL count: {{Session::get('insert_count')}}</span>
                        </div>
                        @endif
                        <div class="col-md-offset-1 col-md-4" style="margin: 15px">
                            <input type="file" class="form-control" name="fx" id="fx" />
                        </div>
                        <div class="col-md-2" style="margin: 20px">
                            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT" />
                        </div>
                    </div>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </main>
    @include('includes.new_footer',[])
</div>

@stop