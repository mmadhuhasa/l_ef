<div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
<div class="desk-view">
    <div class="row">
        <div class="col-md-12">
            <table class="filter_fuel_info table table-hover table-responsive desk-plan">
                <thead>
                    <tr>
                        <th class="slno">Sl</th>
                        <th class="dof thdof">Flight Date</th>
                        <th class="ficadc thficadc">Operator</th>
                        <th class="calsign thchange">Call Sign</th>
                        <th class="from thfrom">From</th>
                        <th class="to thto">To</th>
                        <th class="dpt thdpt">Dep. Time</th>
                        <th class="fildate thchange">Flying Time</th>
                        <th class="pdf pobwidth">POB</th>
                        <th class="pdf fuelwidth">Fuel</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("#from_date, #to_date,#date_of_flight,.ui-datepicker-trigger").click(function () {
            $(".notify-bg-v").fadeIn();
            $('.notify-bg-v').css('height', $(document).height());
        });
        if ($('.filter_fuel_info').length > 0) {
            $('.filter_fuel_info').each(function (e) {
                var url_fpl_list = $("#url").val();
                var date = $("#date_of_flight2").val();
                jQuery.fn.dataTableExt.sErrMode = 'throw';
                jQuery.fn.dataTableExt.oPagination.iFullNumbersShowPages = 10;
                var opt = {
                    //"bJQueryUI" : true,
                    "sDom": '<"top"iflp<"clear">>rt',
                    "bFilter": false,
                    "bLengthChange": false,
                    "iDisplayLength": 25,
                    "sPaginationType": "simple_numbers",
                    "bProcessing": false,
                    "bServerSide": true,
                    "info": false,
                    "sAjaxSource": url_fpl_list + '/fuel/list',
                    "fnServerParams": function (aoData, fnCallback) {
                        aoData.push({"name": "operator", "value": $("#operator2").val()});
                        aoData.push({"name": "from_date", "value": $("#from_date").val()});
                        aoData.push({"name": "to_date", "value": $("#to_date").val()});
                        aoData.push({"name": "aircraft_callsign", "value": $('#aircraft_callsign2').val()});
                        aoData.push({"name": "departure_aerodrome", "value": $('#departure_aerodrome2').val()});
                        aoData.push({"name": "destination_aerodrome", "value": $('#destination_aerodrome2').val()});
                        aoData.push({"name": "url", "value": $("#url").val()});
                        aoData.push({"name": "date_of_flight", "value": ''});
                    },
                    "sAjaxDataProp": "aaData",
                    "bPaginate": true,
                    "oLanguage": {
                        "sSearch": "<span>Search:</span> ",
                        "sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
                        "sLengthMenu": "_MENU_ <span>entries per page</span>",
                        "sLoadingRecords": "<span style='font-size:13px'>Please wait - loading...</span>",
                        "sProcessing": "<span style='font-size:13px'>Loading, please wait...</span>",
                        "sZeroRecords": "<p style='color:red'>NO MATCHING RECORDS FOUND</p>"
                    },
                    //                'sDom': "lfrtip",
                    //                    "aaSorting": [[0, 'desc']],
                    "aLengthMenu": [20, 50, 100, 200, 400],
                    //                "fnInitComplete": function () {
                    //                    $('[rel=popover]').popover({
                    //                        placement: "top",
                    //                        html: true,
                    //                    });
                    //                },
                    "fnDrawCallback": function (oSettings) {
                        $('[rel=popover]').popover({
                            placement: "top",
                            html: true,
                        });
                        //                    if ($('.fpl_info tr').length < 25) {
                        //                        $('.dataTables_paginate').hide();
                        //                    }
                    },
                    "initComplete": function (settings, json) {
                        //                    alert('DataTables has finished its initialisation.');
                        $('div.dt_loading').remove();
                    }
                };
                $.datepicker.setDefaults({
                    dateFormat: "dd-mm-yy"
                });
                var oTable = $(this).dataTable(opt);
                $(this).css("width", '100%');
                $('.dataTables_filter input').attr("placeholder", "Search here...");
                oTable.fnDraw();
                oTable.fnAdjustColumnSizing();
                //                oTable.$("[rel=popover]").popover();
                //                oTable.fnGetNodes().popover();

            });
        }
    });
    $(window).scroll(function () {
        if ($(this).scrollTop()) {
            $('#v_toTop').fadeIn();
        } else {
            $('#v_toTop').fadeOut();
        }
    });
    $("#v_toTop").click(function () {
        $("html, body").animate({scrollTop: 0}, 500);
    });
</script>
