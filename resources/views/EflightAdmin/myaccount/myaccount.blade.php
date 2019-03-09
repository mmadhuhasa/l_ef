@extends('layouts.myaccount_layout',array('1'=>'1'))
@section('content')
<div id="page">
    @include('includes.header',[])  
    <div id="page">
	<div class="search-band">
	    <div class="container cust-container">
		<div class="row">
		    <div class="col-md-4 count-row">
			<div class="row">
			    <div class="count">
				<div class="col-md-6 count-text caption">Todays FPL</div>
				<div class="col-md-6 count-text"><div class="counter"><span class="number">{{$get_day_count_fpl}}</span></div></div>
			    </div>
			</div>            	
		    </div>
		    <div class="col-md-4 count-row">
			<div class="row">
			    <div class="count">
				<div class="col-md-6 count-text">This Month FPL</div>
				<div class="col-md-6 count-text"><div class="counter"><span class="number">{{$get_month_count_fpl}}</span></div></div>
			    </div>
			</div>            	
		    </div>
		    <div class="col-md-4 count-row">
			<div class="row">
			    <div class="count">
				<div class="col-md-6 count-text">Total FPL Filed <span>(till Date)</span></div>
				<div class="col-md-6 count-text"><div class="counter"><span class="number">{{$get_total_count_fpl}}</span></div></div>
			    </div>
			</div>            	
		    </div>
		</div>
		<div class="row">
		    <?php
		    $departure_aerodrome = (array_key_exists('departure_aerodrome', $input_data)) ? $input_data['departure_aerodrome'] : '';
		    $destination_aerodrome = (array_key_exists('destination_aerodrome', $input_data)) ? $input_data['destination_aerodrome'] : '';
		    $date_of_flight = (array_key_exists('date_of_flight', $input_data)) ? $input_data['date_of_flight'] : '';
		    $aircraft_callsign = (array_key_exists('aircraft_callsign', $input_data)) ? $input_data['aircraft_callsign'] : '';
		    $from_date = (array_key_exists('from_date', $input_data)) ? $input_data['from_date'] : '';
		    $to_date = (array_key_exists('to_date', $input_data)) ? $input_data['to_date'] : '';
		    ?>
		    <form name="search" id="search" method="post" action="{{url('/Admin/myaccount')}}">
			<div class="col-md-5">
			    <div class="row">
				<div class="col-md-6 nopad">
				    <div class="form-group">
					<div class="input-group">
					    <input type="text" autocomplete="off" value="{{ $from_date }}"  style="background: white; text-align:center;width: 207px;" class="form-control text-center font-bold from_date pointer" placeholder="FROM DATE" name="from_date" id="from_date" minlength="6" maxlength="6" tabindex="5" readonly>
<!--					    <span class="input-group-addon calendar-addon">
					      <span class="glyphicon glyphicon-calendar"></span>
						<span class="calendar"></span>
					    </span>-->
					</div>
				    </div>
				</div>

				<div class="col-md-6">
				    <div class="form-group">
					<div class="input-group">
					    <input type="text" autocomplete="off" value="{{ $to_date }}"  style="background: white; text-align:center;width: 207px;" class="form-control text-center font-bold to_date pointer" placeholder="TO DATE" name="to_date" id="to_date" minlength="6" maxlength="6" tabindex="5" readonly>
  <!--					    <span class="input-group-addon calendar-addon">
						<span class="glyphicon glyphicon-calendar"></span>
						  <span class="calendar"></span>
					      </span>-->
					</div>
				    </div>
				</div>         	
			    </div>
			</div>
			<div class="col-md-5 pull-right">
			    <div class="row">
				<div class="col-md-5">
				    <div class="form-group">
					<input type="text" class="form-control text_uppercase alpha_numeric font-bold" minlength="4" maxlength="4" id="departure_aerodrome" value="{{$departure_aerodrome}}" name="departure_aerodrome" placeholder="Dep AeroDrome">
				    </div>
				</div>
				<div class="col-md-5 norightpad">
				    <div class="form-group">
					<input type="text" class="form-control destination text_uppercase alpha_numeric font-bold" minlength="4" maxlength="4" id="destination_aerodrome" value="{{$destination_aerodrome}}" name="destination_aerodrome" placeholder="Dest AeroDrome">
				    </div>
				</div>	
				<div class="col-md-2 nopad">                     	                           		
				    <button type="submit" class="btn btn-primary searchbtn"><span class="glyphicon glyphicon-search"></span></button>
				</div>
			    </div>
			</div>
			<div>
			    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			</div>
		    </form>
		</div>
	    </div>
	</div>
	<section>
	    <div class="container cust-container nopad">
		<div class="row">
		    <div class="col-md-12">
			<div class="success">
			    <div id="mysuccess"></div>
			    @if(Session::get('success'))
			    <div class="success-left animated infinite zoomIn custdelay accmsg">
				<p>{{Session::get('success')}}</p>								  
			    </div>
			    @endif			    
			</div>
			<p class="error">
			    @if(Session::get('error'))
			<div id="div2" style="color: red;font-weight: bold"><small>Something went wrong!</small>
			</div>
			@endif
			</p>
		    </div>	
		</div>
		@if(isset($get_all))<div style="text-align: right">{!! $get_all->links() !!}</div>@endif
		<div class="desk-view">
		    <div class="row">
			<div class="col-md-12">
			    <table class="table table-hover table-responsive desk-plan">
				<thead>
				    <tr>
					<th class="slno">Sl.No</th>
					<th class="dof">Flight Date</th>
					<th class="calsign">Call Sign</th>
					<th class="from">From</th>
					<th class="to">To</th>
					<th class="dpt">Departure Time</th>
					<th class="ficadc">FIC-ADC</th>
					<th class="weather">Weather</th>
					<th class="weather">NOTAM</th>                                
					<th class="pdf">PDF</th>
					<th class="fildate">Change FPL</th>
				    </tr>
				</thead>
				<tbody>
				    <?php
				    $i = 1;
				    ?>
				    @foreach($get_all as $fpl_details)
				    <?php
				    $id = ($fpl_details) ? $fpl_details->id : '';
				    $date_of_flight = ($fpl_details) ? $fpl_details->date_of_flight : '';
				    $aircraft_callsign = ($fpl_details) ? $fpl_details->aircraft_callsign : '';
				    $departure_aerodrome = ( $fpl_details) ? $fpl_details->departure_aerodrome : '';
				    $destination_aerodrome = ( $fpl_details) ? $fpl_details->destination_aerodrome : '';
				    $equipment = ( $fpl_details) ? $fpl_details->equipment : '';
				    $departure_time_hours = ( $fpl_details) ? $fpl_details->departure_time_hours : '';
				    $departure_time_minutes = ( $fpl_details) ? $fpl_details->departure_time_minutes : '';
				    $fic = ( $fpl_details) ? $fpl_details->fic : '';
				    $adc = ( $fpl_details) ? $fpl_details->adc : '';
				    $plan_status = ( $fpl_details) ? $fpl_details->plan_status : '';
				    $plan_status_class = ($plan_status == 2) ? "company_color" : '';
				    $current_date = date('ymd');
				    $is_plan_active = '';
				    $is_fic_active = '';
				    if ($date_of_flight >= $current_date && $plan_status == 1) {
					$is_plan_active = 1;
				    }
				    if ($date_of_flight == $current_date && $plan_status == 1) {
					$is_fic_active = 1;
				    }
				    $cursor_disable = ($is_plan_active) ? '' : 'cursor_disable';
				    $departure_station = '';
				    $destination_station = '';
				    if ($departure_aerodrome == 'ZZZZ') {
					$departure_station = $fpl_details->departure_station;
				    }
				    if ($destination_aerodrome == 'ZZZZ') {
					$destination_station = $fpl_details->destination_station;
				    }
				    ?>
				    <tr>
					<td class="slno">{{$i}}</td> 
					<td class="dof"><span class="flightdate {{$plan_status_class}} add_cancel_class{{$id}}">{{$date_of_flight}}</span> <span class="delete {{$cursor_disable}}" data-toggle="{{($is_plan_active) ? 'modal' : ''}}" data-target="#cancel_plan{{$id}}"><img src="{{url('media/ananth/images/close.png')}}" class="img-responsive {{$cursor_disable}}" alt="delete"></span></td>
					<td class="calsign"><span class="csgn {{$plan_status_class}} add_cancel_class{{$id}}">{{$aircraft_callsign}}</span><span class="eye" data-toggle="modal" data-target="#preview{{$id}}"><img src="{{url('media/ananth/images/preview.png')}}" class="img-responsive" alt="preview"></span></td>
					<td class="from {{$plan_status_class}}"><span href="#" data-toggle="popover" data-placement="bottom" class="add_cancel_class{{$id}}" data-content="{{$departure_station}}">{{$departure_aerodrome}}</span></td>
					<td class="to {{$plan_status_class}}"><span href="#" data-toggle="popover" data-placement="bottom" class="add_cancel_class{{$id}}" data-content="{{$destination_station}}">{{$destination_aerodrome}}</span></td>
					<td class="dpt">
					    <div class="depart-time">
						<form action="{{url('Admin/revice_time')}}" name="" id="" method="POST" >
						    <div class="mod-time">
							<input type="text"  value="{{$departure_time_hours.$departure_time_minutes}}" id="departure_time{{$id}}" data-value="{{$id}}" name="departure_time{{$id}}" disabled="disabled" class="form-control alt-time {{$plan_status_class}} add_cancel_class{{$id}} enable_class numeric departure_time" minlength="4" maxlength="4" placeholder="Time">
						    </div>
						    <div class="time-icon">
							<img src="{{url('media/ananth/images/time.png')}}" class="img-responsive {{$cursor_disable}}" data-value="{{$id}}" data-toggle="{{($is_plan_active) ? 'modal' : ''}}" data-target="#revisetime{{$id}}">
						    </div>
						    <div class="send">
							<input type="button" value="Send" class="form-control sendbtn" style="height: 27px;" {{($cursor_disable) ? 'style=cursor:not-allowed' : ''}} data-toggle="{{($is_plan_active) ? 'modal' : ''}}" data-target="#cnfrevise{{$id}}">
						    </div>
						</form>
					    </div>                                   
					</td>
					<td class="ficadc">
					    <div class="fic-adc">
						<form method="post" name="ficadc" action="#">
						    <div class="fic">
							<input type="text" data-toggle ="popover" data-placement="bottom" class="form-control numeric fic_valid add_cancel_class{{$id}}" data-value="{{$id}}" {{($is_fic_active) ? '' : 'disabled="disabled"'}} id="fic{{$id}}" value="{{$fic}}" name="fic{{$id}}" {{(isset($fic) && $fic!='') ? 'readonly=readonly': ''}} placeholder="FIC" minlength="4" maxlength="4">
						    </div>
						    <div class="adc">
							<input type="text" data-toggle ="popover" data-dept-aero='{{$departure_aerodrome}}' data-dest-aero='{{$destination_aerodrome}}' data-placement="bottom" class="form-control adc_valid text_uppercase add_cancel_class{{$id}}" {{(isset($adc) && $adc != '') ? 'readonly=readonly': ''}} data-value="{{$id}}" {{($is_fic_active) ? '' : 'disabled="disabled"'}} id="adc{{$id}}" name="adc{{$id}}" value="{{$adc}}" placeholder="ADC">
						    </div>
						    <div class="send">
							<input type="button" class="form-control sendbtn" style="height: 27px;" {{(!$is_fic_active) ? 'style=cursor:not-allowed' : ''}} value="Send" data-toggle="{{($is_fic_active) ? 'modal' : ''}}" data-target="#sendficadc{{$id}}" >
						    </div>
						</form>
					    </div>	
					</td>
					<td class="weather">
					    <a href="../weather/" target="_blank"><img src="{{url('media/ananth/images/weather.png')}}" class="img-responsive" alt="weather"></a>
					</td>
					<td class="notam">
					    <a href="../NOTAMS/" target="_blank"><img src="{{url('media/ananth/images/notam.png')}}" class="img-responsive" alt="notam"></a>
					</td>
					<td class="pdf">
					    <a href="{{url('fpl/file_plan/'.$id)}}" target="_self"><img src="{{url('media/ananth/images/pdf.png')}}" class="img-responsive" alt="pdf"></a>
					</td>
					<td class="fildate">
					    <span class="flmodify"><a href="#" target="_self" data-toggle="{{($is_plan_active) ? 'modal' : ''}}" data-target="#changeplan{{$id}}"><img src="{{url('media/ananth/images/modify.png')}}" class="img-responsive {{$cursor_disable}}" alt="modify"></a></span>                                    
					</td>
				    </tr>
				    @include('includes.myaccount_modals',['i'=>$i])				   
				    <?php $i++; ?>
				    @endforeach
				</tbody>
			    </table>
			</div>
		    </div>
		</div>
	    </div>
	</section>    	
    </div>       
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('.number').counterUp({
                delay: 10,
                time: 1000
            });
        });
    </script>   
    @include('includes.footer',[])   
</div>
@stop