@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@push('css')
    <link href="{{url('app/css/ltrim/vtanf.css')}}" rel="stylesheet">
    <style>
    .ltim_container,.graph_container {
      background: #fff;
     /* width:900px;*/
          width: 1350px;
      margin: 15px auto;
      padding-right: 0;
      padding-left: 0;
    }
    .ltrim_sec {
      padding-top: 30px;
    }
    .ui-datepicker-trigger {
      height: 24px;
      top:5px;
      right:6px;
    }
    .ltrim_sec .form-control {
      margin-bottom: 30px;
      z-index: 0;
    }
    /*        START OF  PLACEHOLDER STYLES*/
    .ltrim_sec .popupHeader {
        font-size: 14px;
    }
    .ltrim_sec div.dynamiclabel
    { 
        display: block;
        position: relative;
        text-align: left;
    }

    .ltrim_sec div.dynamiclabel label{
        position: absolute;
        color:#000;
        font-size:11px;
        font-weight:normal;
        background: transparent;
        /*            border: 1px solid #333;*/
        border-radius: 2px;
        -webkit-border-radius:2px;
        -moz-border-radius:2px;
        -khtml-border-radius:2px;
        -webkit-backface-visibility: hidden;
        top: 10px;           
        -moz-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        -webkit-transition: all 0.6s ease-in-out; 
        -o-transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        transition: all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        opacity: 0;
        z-index: -1;
        line-height: 0px;
        white-space: nowrap;
    }
    .ltrim_sec div.dynamiclabel > *:focus{
        border-color:#f1292b;
    }
    .ltrim_sec div.dynamiclabel > *:not(:placeholder-shown) + label{
       opacity: 1;
        z-index:1;
        top: -10px;
        left:5px;
        text-transform: uppercase;
   }
    .ltrim_sec div.dynamiclabel > *:focus + label{
        opacity: 1;
        z-index:100;
        top: -10px;
        left:5px;
        text-transform: uppercase;
    }
    .ltrim_sec div.dynamiclabel [placeholder]::-webkit-input-placeholder {
        transition: opacity 0.4s 0.4s ease; 
        text-align: left;
    }
    .ltrim_sec div.dynamiclabel [placeholder]:focus::-webkit-input-placeholder {
        transition: opacity 0.4s 0.4s ease; 
        opacity: 0;
    }
    .ltrim_sec div.dynamiclabel .form-control {
        text-align: left;
        font-weight: bold;
        color: #333;
    }
    .ltrim_sec div.dynamiclabel .form-control:focus {
        border-bottom: 1px solid #ff0000;
    }
    .vtobr_heading {
    margin-bottom: 30px;
    text-align: center;
    padding: 7px 0;
    font-weight: 600;
    font-size: 15px;
    color: #fff;
    font-family: 'pt_sansregular', sans-serif;
    background: #a6a6a6;
    background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
}
.p-lr-0{
  padding-right: 0 !important;
  padding-left: 0;

}
select.form-control {
    background-position: 95% !important;
}
    </style>
@endpush
@section('content')
<div class="page">
    @include('includes.new_header',[])
    <main>
         <div class="container ltim_container">
         <div class="col-md-12 p-lr-0"><p class="vtobr_heading" style="text-transform: uppercase;">METARS</p></div>
           
            @if(isset($data)) 
                 @if(count($data)>0)
                 <table class="table table-striped table-bordered">
                    <thead>
                      <!-- <tr>
                        <th>Raw</th>
                      </tr> -->
                    </thead>
                    <tbody>
                     @foreach($data as $d)
                       <tr>
                        <th scope="row">{{$d['raw_text']}}</th>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                  @else
                     <p style="text-align: center;font-weight: bold;margin-bottom: 10px;">No Data is Available</p>
                  @endif
              @endif
            </div>
    </main>
    @include('includes.new_footer',[])
</div>
<script src="{{url('app/js/common/validation.js')}}" type="text/javascript"></script>
@endsection