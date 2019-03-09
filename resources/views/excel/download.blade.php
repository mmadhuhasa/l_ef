@extends('layouts.lnt_layout',array('1'=>'1'))
@section('content')
<small class="font-grey-4">(Template format
    <a  href="{{url('/excels?format=xls&template_name=abcd')}}">Click here ( .XLS ) <span class="fa fa-download-alt"></span></a>
    <a  href="{{url('/excels?format=xlsx&template_name=abcd')}}">Click here ( .XLSX ) <span class="fa fa-download-alt"></span></a>
    )</small> 
@stop
