@extends('layouts.backend_layout',array('1'=>'1'))
@section('content')
<style>
    .fa-2x {
	font-size: 1.6em;
    }
    a:hover { 
	color: #f1292b;
    }
    table.dataTable thead .sorting, 
    table.dataTable thead .sorting_asc, 
    table.dataTable thead .sorting_desc {
	background : none;
    }
    .form_pilots_top {
	padding:20px 15px 20px 44px;
	width: 100%;
	float:left;
	border:1px solid #ccc;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	margin-top: 15px;
	background: #f2f2f2;
    }
    .pilots_main {
	border:1px solid #999;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
	margin-top: 15px;
	background: #fff;

    }
    .width-x {
	width: 195px;
    }
    .width-y {
	width: 100px;
    }
    .thumb-image{float:left;width:100px;position:relative;padding:5px;}
</style>
<script>
    $(function () {
        if ($('#pilots_info').length > 0) {
            $('#pilots_info').each(function (e) {
                var url_fpl_list = $("#url").val();
                var date = $("#date_of_flight2").val();
                jQuery.fn.dataTableExt.sErrMode = 'throw';
                jQuery.fn.dataTableExt.oPagination.iFullNumbersShowPages = 10;
                var opt = {
                    "bSort": false, //disable soting of columns
                    "sDom": '<"top"iflp<"clear">>rt',
                    "bFilter": false,
                    "bLengthChange": false,
                    "iDisplayLength": 25,
                    "sPaginationType": "simple_numbers",
                    "bProcessing": false,
                    "bServerSide": true,
                    "info": false,
                    "sAjaxSource": url_fpl_list + '/Admin/pilot_list',
                    "fnServerParams": function (aoData, fnCallback) {
                        aoData.push({"name": "url", "value": $("#url").val()});
                        aoData.push({"name": "date_of_flight", "value": $("#date_of_flight2").val()});
                        aoData.push({"name": "email", "value": $("#email").val()})
                    },
                    "sAjaxDataProp": "aaData",
                    "bPaginate": true,
                    "oLanguage": {
                        "sSearch": "<span>Search:</span> ",
                        "sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
                        "sLengthMenu": "_MENU_ <span>entries per page</span>",
                        "sLoadingRecords": "<span style='font-size:13px'>Please wait - loading...</span>",
                        "sProcessing": "<span style='font-size:13px'>Loading, please wait...</span>",
//                    "sZeroRecords": "No records to display"
                    },
//                'sDom': "lfrtip",
//                    "aaSorting": [[0, 'desc']],
                    "aLengthMenu": [20, 50, 100, 200, 400],
                    "fnDrawCallback": function (oSettings) {
                        $('[rel=popover]').popover({
                            placement: "top",
                            html: true,
                        });
                    },
                };
                $.datepicker.setDefaults({
                    dateFormat: "dd-mm-yy"
                });
                var oTable = $(this).dataTable(opt);
                $(this).css("width", '100%');
                $('.dataTables_filter input').attr("placeholder", "Search here...");
                oTable.fnDraw();
                oTable.fnAdjustColumnSizing();
            });
        }
    });


    $("#signature2").on('change', function () {
        //Get count of selected files
        var countFiles = $(this)[0].files.length;
        var imgPath = $(this)[0].value;
        var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
        var image_holder = $("#image-holder");
        image_holder.empty();
        if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof (FileReader) != "undefined") {
                //loop for each file selected for uploaded.
                for (var i = 0; i < countFiles; i++)
                {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("<img />", {
                            "src": e.target.result,
                            "class": "thumb-image"
                        }).appendTo(image_holder);
                    }
                    image_holder.show();
                    reader.readAsDataURL($(this)[0].files[i]);
                }
            } else {
                alert("This browser does not support FileReader.");
            }
        } else {
            alert("Pls select only images");
        }
    });


</script>
<div id="page">
    @include('includes.new_header',[])  
    <form enctype="multipart/form-data" action="#" method="Post">
	<div id="page">
	    <section>
		<div class="container cust-container nopad">				
		    <div class="">

			<div class="row pilots_main">
			    <div class="col-md-12">
				<div class="form_pilots_top">
				    <div class="col-md-2 width-x">
					<input type="text" class="form-control" placeholder="call sign">
				    </div>
				    <div class="col-md-2 width-x">
					<input type="text" class="form-control" placeholder="pilot name">
				    </div>
				    <div class="col-md-2 width-x">
					<input type="text" class="form-control" placeholder="pilot email">
				    </div>
				    <div class="col-md-2 width-x">
					<input type="text" class="form-control" placeholder="pilot mobile">
				    </div>
				    <div class="col-md-2 width-y">
					<input type="button" class="btn newbtnv1" value="Search" style="line-height:1">
				    </div>

				</div>
			    </div>
			    <div class="co-md-12">
				<div class="success">
				    <div class="success-note">
					<div class="success-left animated infinite zoomIn custdelay">
					    <div id="mysuccess">
						@if(Session::get('success'))
						<div class="success-left animated infinite zoomIn custdelay">                                                  
						    <span class="success-font">{{Session::get('success')}}</span>                                                                     
						</div>
						@endif
					    </div>
					</div>                      
				    </div>
				</div>
			    </div>
			    <div class="col-md-12">
				<table id="pilots_info" class="table table-hover table-responsive desk-plan">
				    <thead>
					<tr>
					    <th class="slno">Sl.No</th>
					    <th class="dof">Callsign</th>
					    <th class="calsign">Pilot</th>
					    <th class="from">Mobile</th>
					    <th class="from">PilotEmail</th>
					    <th class="to">Copilot</th>
					    <th class="dpt">Copilot_mob</th>
					    <th class="dpt">Copilot_Email</th>
					    <th class="weather">Signature</th>	
					    <th>Status</th>
					    <th>Actions</th>
					</tr>
				    </thead>
				    @include('includes.ops.edit_pilots')
				</table>
			    </div>
			</div>
		    </div>
		</div>
	    </section>    	
	</div>  
	<input type="hidden" name="date_of_flight" id="date_of_flight" />
	<input type="hidden" name="url" id="url" value="{{url('')}}" />
    </form>
    @include('includes.new_footer',[])  
</div>
@stop