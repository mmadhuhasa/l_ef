@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<div class="page" id="quick_app">
    @include('includes.new_header',[])
    <main>
        <div class="container">
            <div class="bg-white" style="margin: 10px">
                <div style="font-weight: bold;font-family: monospace;text-align: center;margin-bottom: 12px;font-size: 18px">Upload LR Data</div>
                <form name="" id="" method="post" action="{{url('lr/lr_upload')}}" enctype="multipart/form-data">
                    <div class="row" style="border: 1px solid lightgray">
                        @if(Session::get('success'))  
                         <!--Success!-->
                        <div class="alert alert-success" style="margin-top: 3px">
                            <span> Updated LR count: {{Session::get('update_count')}}</span><br/>
                            <span> New LR count: {{Session::get('insert_count')}}</span>
                        </div>
                        @endif
                        <div class="col-md-offset-1 col-md-4" style="margin: 15px">
                            <input type="file" class="form-control" name="fx" id="fx" />
                        </div>
                        <div class="col-md-2" style="margin: 20px">
                            <input type="submit" class="btn btn-success" name="submit" value="SUBMIT" />
                        </div>
                        
                        <div class="col-md-4" style="margin: 25px 15px 15px 15px;">
                            <a  href="{{url('/lr/lr_excel_download')}}">Download Excel</a>
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