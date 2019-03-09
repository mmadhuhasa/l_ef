@extends('layouts.check_quick_plan_layout',array('1'=>'1'))
@section('content')
<div class="page">
    <style>
        table.dataTable thead .sorting, 
        table.dataTable thead .sorting_asc, 
        table.dataTable thead .sorting_desc {
            background : none;
        }
        .p-r-9 {
            padding-right:9px;
        }
        .m-l-7 {
            margin-left:7px;
        }
        .tooltip_cancel {
            position: relative;
        }
        .tooltip_cancel_position,.tooltip_fpl_position, .tooltip_info_position, .tooltip_revise_position,.tooltip_change_position {
            position: absolute;
            top: -25px;
            left: 45px;
            padding: 3px 11px;
            color: #fff;
            border-radius: 4px;
            visibility: hidden;
            font-size: 10px;
            font-weight: normal;
            box-shadow: 0 0 1px 1px #ccc;
            background: #F26232;
            background: linear-gradient(to top, #fa9b5b, #F26232);
            background: black;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f1292b', endColorstr='#c35033');
            background: -webkit-gradient(linear, left top, left bottom, from(#f1292b), to(#c35033));
            background: -moz-linear-gradient(top, #f1292b, #c35033);
        }
        .tooltip_cancel:hover .tooltip_cancel_position,.tooltip_cancel:hover .tooltip_fpl_position, .tooltip_cancel:hover .tooltip_info_position,.tooltip_cancel:hover .tooltip_revise_position,.tooltip_cancel:hover .tooltip_change_position  {
            visibility: visible;
        }

        .tooltip_fpl_position {
            left: 41px;
            width: 81px;
        }
        .tooltip_info_position  {
            left: 35px;
        }
        .tooltip_revise_position {
            left: 54px;
            width: 78px;
        }

        .tooltip_change_position {
            left: -15px;
            width: 79px;
        }
        .new_fpl_heading,.search_heading {
            margin-bottom: 30px;
            text-align: center;
            padding: 7px 0;
            background: #eee;
            font-weight: 600;
            font-size: 15px;
            color:#000;
            font-family:'pt_sansregular', sans-serif;
            background: rgba(249,249,249,1);
            background: -moz-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
            background: -webkit-gradient(left top, right top, color-stop(0%, rgba(249,249,249,1)), color-stop(0%, rgba(255,255,255,1)), color-stop(50%, rgba(204,204,204,1)), color-stop(100%, rgba(249,249,249,1)));
            background: -webkit-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
            background: -o-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
            background: -ms-linear-gradient(left, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
            background: linear-gradient(to right, rgba(249,249,249,1) 0%, rgba(255,255,255,1) 0%, rgba(204,204,204,1) 50%, rgba(249,249,249,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f9f9f9', endColorstr='#f9f9f9', GradientType=1 );
        }
        .search_heading {
            margin-bottom: 0;
            text-transform: uppercase;
        }
        .dof_label {
            position: absolute;
            top:-24px;
            left:0px;
            font-size: 13px;
            color: #222;
        }
        .fpl_search_from_label, .fpl_search_to_label {
            position: absolute;
            top:-20px;
            left:26%;
            font-size: 13px;
            color:#222;
        }        
        .form-row .deskview {
            width: 40%;
        }
        .form-row .deskprocess {
            width: 58%;
        }
        .search-band {
            padding-top:0px;
        }

        #process {
            width: 120px;
        }
        .form-row .form-search-row-right .ui-datepicker-trigger {
            height: 21px;
            top:6px;
        }
        .from_dp_pos .ui-datepicker-trigger {
            right: 9px;
            height: 23.5px;
            top: 5px;
        }

        .form-row .deskview .ui-datepicker-trigger {
            right: 10px;
            height: 21px;
            top: 6px;
        }
        #date_of_flight {
            font-size: 13px;
            font-weight: normal;
            color: #222;           
            background: white; 
            text-align:left;
            padding-left:5px; 
            border-radius:4px;

        }
        .q_filter {
            width: 100%;
            float:left;
            padding-left: 10px;
            padding-right: 10px;
        }
        .q_filter .depstatns, .q_filter .destatns {
            width:25%;


        }
        .from_to_adj_width {
            width:25%;
            padding-right: 15px;

        }
        .from_dp_pos {
            width: 100%;
        }
        .from_widthv {
            width: 40% !important;
        }
        #from_date {
            text-align: left;
            font-size: 13px; 
            font-weight: normal; 
            color: #222;
        }
        #to_date {
            padding-left: 5px;
            font-size:13px;
            font-weight: normal;
            color: #222;
            text-align: left;
            width: 151%;
            border-radius: 5px;
        }
        .to_widthv {
            width: 58% !important;
        }
        .top {
            margin-top:10px;
            margin-bottom: 10px;
            width: 100%;
            float: left;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active {
            background: #eeeeee;
        }

        .fic-adc .send {
            width: 21%;
            padding-left: 5px;
            padding-right: 7px;   
        }
        .desk-plan>tbody>tr>td {
            font-size: 13px;
        }

        @media only screen and (min-width : 320px) and (max-width : 767px) {
            .form-row .deskprocess {
                width: 49%;
            }
            .form-row .search-time-left {
                width: 23%;
            }
            .form-row .deskview {
                width: 49%;
            }
            .xs-p-lr-5 {
                padding-left: 5px;
                padding-right: 5px;
            }
            .xs-m-r-0 {
                margin-right:0;
            }
            .q_filter .depstatns, .q_filter .destatns {
                width: 100%;
            }
            .destatns {
                margin-bottom: 25px;
            }
            .from_widthv {
                width: 34% !important;
            }
            .fpl_from_box {
                width: 120px;
            }
            .fpl_to_box {
                width: 100px;
                margin-left: -10px;
            }
            .desk-view {
                width: 95%;
                margin: 0 auto;
                border-radius: 0px;
                overflow-x: scroll;
            }
            .fpl_deptime_label {
                margin-top: -15px;
            }
            label.timedpt {
                width: 50%;
                margin-top: 11px;
            }
            .sm-m-t-25 {
                margin-top:25px;
            }
            .dof_label {
                top:-19px;
                left:23%;
            }
            .from_to_adj_width {
                width: 100%;
            }

            .xs-p-l-10 {
                padding-left: 10px;
            }
            .desk-view {
                overflow-x: scroll;
            }

            .desk-plan {
                width: 1000px !important;
            }

            .plan-form {
                margin: 15px;
                width: 90%;
            }
            .success-note {
                width: 100%;
                margin:0 auto;
            }
            .buttons {
                width: 100%;
                margin:0;
            }
            .supplementary, .fdtl-info, .atc_after_process {
                border-right: none;
            }
            #process {
                width: 135px;
            }
            .from_widthv {
                width:33%;
            }
            #to_date {
                width:110%;
            }
            #date_of_flight {
                padding-left: 31px;
            }
            .xs-m-t-25 {
                margin-top: 25px;
            }

        }

        @media only screen and (min-width : 768px) and (max-width : 1024px) {
            .container {
                padding-left: 0px;
                padding-right:0px;
            }
            .q_filter .depstatns, .q_filter .destatns {
                width: 50%;
            }
            .q_filter .depstatns, .q_filter .destatns {

            }
            .q_filter {
                width: 100%;
            }

            .desk-view {
                width: 95%;
                margin: 0 auto;
                border-radius: 0px;
            }
            .fpl_deptime_label {
                margin-top:-20px;
            }
            .md-m-t-7 {
                margin-top: 7px;
            }
            .form-row .deskview {
                width: 49%;
            }
            .from_to_adj_width {
                width: 50%;
            }
            .desk-view {
                overflow-x: scroll;
            }
            .form-row .deskprocess {
                width: 49%;
            }
            .from_widthv {
                width: 40%;
            }
            .desk-plan {
                width: 1000px !important;
            }
            .supplementary, .fdtl-info, .atc_after_process {
                border-right: none;
            }
            #date_of_flight {
                padding-left: 50px;
            }
            #from_date {
                padding-left: 33px;
            }
            #to_date {
                padding-left: 40px;
                width:127%;
                border-radius:5px;
            }
            #process {
                width: 165px;
            }
            .depstatns {
                margin-bottom:10px;
            }
            .dof_label {
                top:-20px;
                left:30%;
            }
        }



    </style>
    <script>
        $(function () {
	    $(document).on('keyup',"#adc", function(){
//		$(this).attr('border','lightgrey solid 1px');
		$("#adc").css('border', 'lightgrey solid 1px');
	    });
            $("#adc_form").on('submit', function (e) {
                e.preventDefault();
		
                var data_url = base_url+'/adc';
                var data = $("form#adc_form").serialize();		
                $.ajax({
                    url: data_url,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    cache: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    success: function (data, textStatus, jqXHR) {
                         $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
                    },
                    error: function (jqXHR, textStatus, errorThrown) {

                    },
                    async: false
                });
            })
        })


    </script>
    @include('includes.v_header',[])
    <main>
        <div class="container">
            <div class="bg-white">
                <div class=" fpl_sec">
                    <!--<div class="page_section">-->
                    <form data-toggle="validator"  method="POST" role="form" name="adc_form" id="adc_form">     
                        <div class="search-band">
                            <!--<div class="container cust-container">-->
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="new_fpl_heading">Enter FIC ADC Message</p>
                                </div>
				<div class="success">
                                    <div class="success-note">
                                        <div class="success-left animated infinite zoomIn custdelay">
                                            <div id="mysuccess">
                                              
                                            </div>
                                        </div>                      
                                    </div>
                                </div>
				<div class="col-md-9">
				    <div class="form-group">
					<input type="text" style="margin-left: 20px;" autocomplete="off" class="form-control" id="adc" name="adc" />
				    </div>
				</div>
				<div class="col-md-3">
				    <div class="form-group">
					<input type="submit" style="margin-left: 75px;" name="button" class="btn btn-danger" value="Enter" />
				    </div>
				</div>
			    </div>                         
			</div>
			{{csrf_field()}}
                    </form>
                    <section>
                    </section>
                </div>
            </div>
        </div>
    </main>   
    @include('includes.new_footer',[])
</div>
@stop