@extends('layouts.lnt_layout',array('aircraft_callsign'=>'vtauv'))
@section('content')
<style>
    .p-lr-0 {
        padding-left:0;
        padding-right:0;
    }
    .cust-container {
        margin:15px auto;
        background: #fff;
    }
    .cust_box_shadow {
        box-shadow: 3px 3px 12px 0px #999;
        margin-left: 0px;
        margin-right: 0px;
    }
    .search_heading {

        text-align: center;
        padding: 7px 0;
        font-weight: 600;
        font-size: 15px;
        color:#fff;
        font-family:'pt_sansregular', sans-serif;
        background: #a6a6a6;
        background: -moz-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -webkit-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -o-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: -ms-linear-gradient(left, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        background: linear-gradient(to right, #a6a6a6 0%, #212121 50%, #a6a6a6 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6a6a6', endColorstr='#a6a6a6', GradientType=1 );
    }

    .stats_from_date .ui-datepicker-trigger {
        height: 23.5px;
        top: 25px;;
        right:22px;
    }
    .stats_to_date .ui-datepicker-trigger {
        height: 23.5px;
        top: 25px;
        right:50px;
    }
    .stats_from_date .form-control,  .stats_to_date .form-control{
        font-size: 13px;
        text-align: left;
        padding-left: 20px;
    }
    .stats_fpl_head_date{
        font-size: 15px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 10px;
    }
    .stats_table {
        width:98%;
        margin:0 auto; 
        font-style: italic;
        font-size: 13px;
        margin-bottom: 10px;
    }
    .stats_table td {
        padding-left: 2px;
    }
    .stats_table_td_text {
        width: 80%;
        float: left;
    }
    .stats_table_td_text + span {
        font-style: normal;
        font-weight: bold;
        float: left;
    }
    .operator_search_btn1, .operator_search_btn2  {
        width: 40px;
        position: absolute;
        bottom: 15px;
        right: 16px;
        border-radius: 0 4px 4px 0;
    }
    .operator_search_btn2 {
        right:0;
    }
    .cust_label {
        width: 100%;
        font-size: 13px;
        text-align: center;
        text-transform: uppercase;
        font-weight: normal;
        margin-bottom: 0;
    }
    .no_label {
        visibility:hidden;
        margin-bottom: 0;
    }


</style>

<div class="page" id="app">  
    @include('includes.new_header',[])
    <section>
        <div class="container cust-container">
            <div class="row">
                <div class="col-md-12  p-lr-0">
                    <p class="search_heading">FPL STATS</p>
                </div>
                <div class="col-md-offset-1 col-md-10">
                    <form id="fpl_stats_form" @submit="get_stats" data-url="{{url('/Admin/get_fpl_stats')}}">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label  class="no_label">no label</label>
                                <input type="text" name="aircraft_callsign" v-model="aircraft_callsign" id="aircraft_callsign" class="form-control text_uppercase alpha_numeric" placeholder="Call Sign">
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="form-group stats_from_date">
                                <label  class="cust_label">From</label>
                                <input type="text" value="{{date('ymd')}}"  autocomplete="off" class="form-control font-bold from_date pointer fpl_from_box" placeholder="" name="from_date" id="from_date" minlength="6" maxlength="6" tabindex="5" readonly style="border-radius:4px;">
                            </div>
                        </div>
                        <div class="col-md-4 p-lr-0">
                            <div class="form-group stats_to_date">
                                <label class="cust_label">To</label>
                                 <input type="text" value="{{date('ymd')}}"  autocomplete="off" class="form-control font-bold to_date pointer fpl_to_box" placeholder="TO" name="to_date" id="to_date" minlength="6" maxlength="6" tabindex="5" readonly>
                                <button type="submit" name="flag" id="dates"  class="btn newbtnv1 operator_search_btn2"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>

                    </form>
                </div>
		<div class="col-md-12" style="text-align:center;padding:7px;">
		    <span class="success" id="success_message"> </span>					
		</div>
                <div id="filter_fpl_stats">
		    <div class="col-md-12">
			<p class="stats_fpl_head_date">FPL STATS for DD-MON-YYYY</p>
		    </div>
		    <div class="col-md-12 p-lr-0">
			<table class="stats_table" border="1">
			    <tr>
				<td><p class="stats_table_td_text">TOTAL PLANS</p><span>:</span></td>
				<td><p class="stats_table_td_text">ADC PLANS</p><span>:</span></td>				
			    </tr>
			    <tr>
				<td><p class="stats_table_td_text">APP PLANS</p><span>:</span></td>
				<td><p class="stats_table_td_text">HELICOPTER PLANS</p><span>:</span></td>				
			    </tr>
			    <tr>
				<td><p class="stats_table_td_text">CANCELLED PLANS</p><span>:</span></td>
				<td><p class="stats_table_td_text">FIXED WING PLANS</p><span>:</span></td>			
			    </tr>
			    <tr>
				<td><p class="stats_table_td_text">ACTIVE PLANS</p><span>:</span></td>
				<td><p class="stats_table_td_text">Wx NOTAMS PLANS</p><span>:</span></td>				
			    </tr>
			    <tr>
				<td><p class="stats_table_td_text">DEP TIME CHANGED PLANS</p><span>:</span></td>
				<td><p class="stats_table_td_text">NAV LOG PLANS</p><span>:</span></td>				
			    </tr>
			    <tr>
				<td><p class="stats_table_td_text">FPL REVISED PLANS</p><span>:</span></td>
				<td><p class="stats_table_td_text">LOAD TRIM PLANS</p><span>:</span></td>				
			    </tr>
			    <tr>
				<td><p class="stats_table_td_text">LATE ADC PLANS</p><span>:</span></td>
				<td><p class="stats_table_td_text">RWY ANALYSIS PLANS</p><span>:</span></td>				
			    </tr>
			</table>
		    </div>
		</div>
            </div>
	    <input type="hidden" name="date_of_flight" id="date_of_flight" value="{{date('ymd')}}" />
	</div>

    </section>

    @include('includes.new_footer',[])
</div>

<script>
    Vue.http.headers.common['X-CSRF-TOKEN'] = $("meta[name=_token]").attr('content');
    new Vue({
        el: "#app",
        data: {aircraft_callsign: '',
               operator: '',
               from_date: '',
               to_date: ''
        },
        methods: {
            get_stats: function (e) {
                e.preventDefault();
                var data_url = $("#fpl_stats_form").attr('data-url');
                var formdata = $("#fpl_stats_form").serializeArray();
                var flag = $("form").find("button[type=submit]:focus").attr('id');
              
                var data = {};		
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['flag'] = flag;
		console.log('data ',data);
                $(".success").html('<span style="text-align: center;color:red"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Fetching data Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
			 $(".success").html('');
                        $("#filter_fpl_stats").html(data.body);
                    }
                });
            },
        }
    });
</script>


@stop