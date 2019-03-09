<script>
    $(function () {
        if ($('#filter_users_info').length > 0) {
            $('#filter_users_info').each(function (e) {
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
                    "sAjaxSource": url_fpl_list + '/Admin/user_list',
                    "fnServerParams": function (aoData, fnCallback) {
                        aoData.push({"name": "operator", "value": $("#operator2").val()});
                        aoData.push({"name": "name", "value": $("#name2").val()});
                        aoData.push({"name": "email", "value": $("#email2").val()});
                        aoData.push({"name": "mobile_number", "value": $("#mobile2").val()});
                        aoData.push({"name": "user_role_id", "value": $("#user_role_select").val()})
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
                    createdRow: function (row, data, index) {
                        $(row).addClass("row-hover-style");
                        // $(row).addClass("sumit-warning");
                    },
                    "aLengthMenu": [20, 50, 100, 200, 400],
                    "fnDrawCallback": function (oSettings) {
                        $('[rel=popover]').popover({
                            placement: "top",
                            html: true,
                        });
                    },
                    "initComplete": function (settings, json) {
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
            });
        }
    })
</script>
<div class="dt_loading"><i style="width:100%;text-align:center;margin-top:18px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
<div class="col-md-12">
    <table id="filter_users_info" class="table table-hover table-responsive desk-plan">
        <thead>
            <tr>
                <th class="slno">Sl.</th>
                <th class="dof">Name</th>
                <th class="calsign">Email</th>
                <th class="from">Mobile</th>
                <th class="from">Operator</th>
                <th class="from">Admin Email</th>
                <th class="to">ROLE</th>                                  
                <th class="weather"><span style="padding-right: 9px">E</span><span style="padding-left: 6px">D</span></th>
            </tr>
        </thead>	  
    </table>
</div>