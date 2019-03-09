@extends('layouts.check_quick_plan_layout')
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
font-weight: bold;
margin-bottom: 0;
}
.no_label {
visibility:hidden;
margin-bottom: 0;
}
</style>
<div class="page" id="app">  
    @include('includes.new_header',[])
    <?php
    $get_fpl_stats_ui = App\models\FPLStatsUIModel::get_all();

    $helicopter_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->helicopter_plans : '';
    $helicopter_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $helicopter_list);
    $helicopter_list = str_replace("'", "", $helicopter_list);

    $helicopter_list_count = count(explode(",", $helicopter_list));

    $navlog_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->navlog_plans : '';
    $navlog_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $navlog_list);
    $navlog_list = str_replace("'", "", $navlog_list);

    $navlog_list_count = count(explode(",", $navlog_list));

    $weather_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->weather_plans : '';
    $weather_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $weather_list);
    $weather_list = str_replace("'", "", $weather_list);

    $weather_list_count = count(explode(",", $weather_list));

    $lnt_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->lnt_plans : '';
    $lnt_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $lnt_list);
    $lnt_list = str_replace("'", "", $lnt_list);

    $lnt_list_count = count(explode(",", $lnt_list));

    $runway_list = ($get_fpl_stats_ui) ? $get_fpl_stats_ui->runway_plans : '';
    $runway_list = preg_replace('/[^a-zA-Z0-9,\']/', "", $runway_list);
    $runway_list = str_replace("'", "", $runway_list);

    $runway_list_count = count(explode(",", $runway_list));

    $fpl_all_callsign = \App\models\FlightPlanDetailsModel::where('is_active', 1)
            ->where('plan_status', 1)
            ->whereNOTIN(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), explode("," ,$weather_list))
            ->whereNOTIN(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"), explode("," ,$navlog_list))
            ->where(DB::raw("SUBSTRING(`aircraft_callsign`,1,2)"), 'VT')
            ->select(DB::raw("SUBSTRING(`aircraft_callsign`,1,5) as cs"))
            ->groupBy(DB::raw("SUBSTRING(`aircraft_callsign`,1,5)"))
            ->get()
    ;
    $fpl_all_callsign_count = count($fpl_all_callsign);
    $callsign_list = [];
    foreach ($fpl_all_callsign as $value) {
        $callsign_list[] = $value->cs;
    }
    $adc_callsign_list = implode(",", $callsign_list);
  
    ?>
    <section>
        <div class="container cust-container">
            <div class="row">
                <div class="col-md-12  p-lr-0">
                    <p class="search_heading">FPL STATS</p>
                </div>
                <div class="success_stats" style="text-align: center;"></div>
                <div class="col-md-offset-1 col-md-10">
                    <form id="fpl_stats_ui_form" @submit="get_stats_ui" style="margin-top: 10px" data-url="{{url('/Admin/update_fplstats')}}">   
                        <div class="col-md-6">
                            <div class="form-group stats_from_date">
                                <label  class="cust_label">NavLog ({{$navlog_list_count}})</label>
                                <textarea id="navlog_plans" name="navlog_plans"  class="form-control" rows="7" placeholder="NavLog">{!!$navlog_list!!} </textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group stats_from_date">
                                <label  class="cust_label">WX/NOTAMs ({{$weather_list_count}})</label>
                                <textarea id="weather_plans" name="weather_plans" class="form-control" rows="7" placeholder="WX/NOTAMs">{!!$weather_list!!}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group stats_from_date">
                                <label  class="cust_label">ADC ({{$fpl_all_callsign_count}})</label>
                                <textarea  class="form-control" rows="10" placeholder="ADC">{{$adc_callsign_list}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group stats_from_date">
                                <label  class="cust_label">Helicopter ({{$helicopter_list_count}})</label>
                                <textarea name="helicopter_plans" id="helicopter_plans" class="form-control" rows="10" placeholder="Helicopter">{!!$helicopter_list!!}</textarea>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!--<div class="form-group stats_from_date">
                                <label  class="cust_label">Runway Analysis ({{$runway_list_count}})</label>
                                <textarea id="runway_plans" name="runway_plans" class="form-control" rows="2" placeholder="Runway Analysis">
                                    {!!$runway_list!!}
                                </textarea>
                            </div>-->
                        </div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-3">
                            <div class="form-group stats_from_date">
                                <button type="submit" name="flag" id="dates" style="margin-top: 32px;width: 161px;margin-left: 20px;"  class="btn newbtnv1">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
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
            get_stats_ui: function (e) {
                e.preventDefault();
                var data_url = $("#fpl_stats_ui_form").attr('data-url');
                var formdata = $("#fpl_stats_ui_form").serializeArray();
                var flag = $("form").find("button[type=submit]:focus").attr('id');

                var data = {};
                $(formdata).each(function (index, obj) {
                    data[obj.name] = obj.value;
                });
                data['flag'] = flag;
                console.log('data ', data);
                $(".success_stats").html('<span style="text-align: center;color:red;padding-top:10px"><a style="color:red"><i class="fa fa-spinner fa-spin"></i></a> Please wait ...</span>');
                this.$http.post(data_url, data).then(function (data) {
                    if (data.body) {
                        $(".success_stats").html('<p class="success animated  zoomIn custdelay" style="text-align:center;color:red;padding-top:10px">' + data.body.STATUS_DESC + '</p>');
                        setTimeout(function () {
//                            $(".success_stats").html('');
                            location.reload();
                        }, 5700)
                    }
                });
            },
        }
    });
</script>
@stop