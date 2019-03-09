@extends('layouts.new_weather_layout',array('1'=>'1'))
@section('content')
<div class="page">
    <style>
        table.dataTable thead .sorting, 
        table.dataTable thead .sorting_asc, 
        table.dataTable thead .sorting_desc {
            background : none;
        }
    </style>
    @include('includes.new_header',[])
    <main>
	<section class="bg-1 welcome page-box">
            <div class="container">        
                <div class="row">
                    <div class="wheather_sec p-10">
			@foreach($data as $api_list)
			<?php
			$aero_name = ($api_list) ? $api_list->aero_name : '';
			?>
			<p style="line-height: 30px;color: blue;font-size: 14px;font-weight: bold;font-family: monospace"><span style="display: inline-block;width: 144px;color: #F1292b;">{{$aero_name}}</span>{{$api_list->raw_report}} </p>
			@endforeach
		    </div>
		</div>
	    </div>
	</section>
    </main>   
    @include('includes.new_footer',[])
</div>
@stop