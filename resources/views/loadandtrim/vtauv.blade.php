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
        width:980px;
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
    @media (max-width:992px) {
        .stats_table_div {
            overflow-x: scroll;
            margin:0 15px;
        }
    }
    @media (max-width:768px) {
        .stats_to_date {
            padding-left: 15px;
            padding-right: 15px;
        }
        .stats_form .form-group {
            margin-bottom: 7px;
        }
        .operator_search_btn2 {
            right: 16px;
            bottom:0;
        }
        .operator_search_btn1 {
            bottom:0;
        }
        .stats_to_date .ui-datepicker-trigger {
            right:65px;
        }
    }
    @media (min-width:768px) and (max-width:992px) {
        .operator_search_btn1, .operator_search_btn2 {
            bottom: 7px;
        }
    }

</style>

<div class="page">  
    @include('includes.new_header',[])
    <section>
        <div class="container cust-container">
            <div class="row">
                <div class="col-md-12  p-lr-0">
                    <p class="search_heading">FPL STATS</p>
                </div>
                <div class="col-sm-12 col-md-offset-1 col-md-10">
                    <form class="stats_form">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label  class="no_label">no label</label>
                                <input type="text" class="form-control" placeholder="Call Sign">
                            </div>
                        </div>
                        <div class="col-sm-5 col-md-6">
                            <div class="form-group">
                                <label  class="no_label">no label</label>
                                <input type="text" class="form-control" placeholder="Operator">                                            
                                <button type="submit" class="btn newbtnv1 operator_search_btn1"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group stats_from_date">
                                <label  class="cust_label">From</label>
                                <input type="text" class="form-control datepicker">
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-2 p-lr-0">
                            <div class="form-group stats_to_date">
                                <label class="cust_label">To</label>
                                <input type="text" class="form-control datepicker">
                                <button type="submit" class="btn newbtnv1 operator_search_btn2"><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-12">
                    <p class="stats_fpl_head_date">FPL STATS for DD-MON-YYYY</p>
                </div>
                <div class="col-md-12 p-lr-0 stats_table_div">
                    <table class="stats_table" border="1">
                        <tr>
                            <td><p class="stats_table_td_text">TOTAL PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">FPL PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH TOTAL PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH FPL PLANS</p><span>:</span></td>
                        </tr>
                        <tr>
                            <td><p class="stats_table_td_text">APP PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">HELICOPTER PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH APP PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH HELICOPTER PLANS</p><span>:</span></td>
                        </tr>
                        <tr>
                            <td><p class="stats_table_td_text">CANCELLED PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">FIXED WING PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH CANCELLED PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH FIXED WING PLANS</p><span>:</span></td>
                        </tr>
                        <tr>
                            <td><p class="stats_table_td_text">ACTIVE PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">WEATHER PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH ACTIVE PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH WEATHER PLANS</p><span>:</span></td>
                        </tr>
                        <tr>
                            <td><p class="stats_table_td_text">DEP TIME CHANGED PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">NAV LOG PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH DEP TIME CHANGED</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH NAV LOG PLANS</p><span>:</span></td>
                        </tr>
                        <tr>
                            <td><p class="stats_table_td_text">FPL REVISED PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">LOAD TRIM PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH FPL REVISED PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH LOAD TRIM PLANS</p><span>:</span></td>
                        </tr>
                        <tr>
                            <td><p class="stats_table_td_text">LATE ADC PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">RUNWAY ANALYSIS PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH LATE ADC PLANS</p><span>:</span></td>
                            <td><p class="stats_table_td_text">THIS MONTH RUNWAY ANALYSIS PLANS</p><span>:</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @include('includes.new_footer',[])
</div>
@stop