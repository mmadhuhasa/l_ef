<script>
    $(function () {
        if ($('#search_pilots_info').length > 0) {
            $('#search_pilots_info').each(function (e) {
                var url_fpl_list = $("#url").val();
                jQuery.fn.dataTableExt.sErrMode = 'throw';
                jQuery.fn.dataTableExt.oPagination.iFullNumbersShowPages = 10;
                var opt = {
                    "bSort": false, //disable soting of columns
                    "sDom": '<"top"iflp<"clear">>rt',
                    "bFilter": false,
                    "bLengthChange": false,
                    "iDisplayLength": 50,
                    "sPaginationType": "simple_numbers",
                    "bProcessing": false,
                    "bServerSide": true,
                    "info": false,
                    "sAjaxSource": url_fpl_list + '/Admin/pilot_list',
                    "fnServerParams": function (aoData, fnCallback) {
                        aoData.push({"name": "url", "value": $("#url").val()});
                        aoData.push({"name": "aircraft_callsign", "value": $("#aircraft_callsign").val()});
                        aoData.push({"name": "email", "value": $("#email").val()})
                        aoData.push({"name": "name", "value": $("#name").val()})
                        aoData.push({"name": "mobile_number", "value": $("#mobile_number").val()})
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
<div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
<div class="col-md-12">
    <table id="search_pilots_info" class="table table-hover table-responsive desk-plan">
        <thead>
            <tr>
                <th class="slno">Sl.No</th>
                <th class="dof">Callsign</th>
                <th class="calsign">Pilot</th>
                <th class="from">Mobile</th>
                <th class="from">Email</th>
                <th class="to">Pilot</th>
                <th class="dpt">Copilot</th>                                         
                <th class="weather">Signature</th>	
                <!--<th>Status</th>-->
                <th>Actions</th>
            </tr>
        </thead>
    
    </table>
</div>            
<input type="hidden" name="url" id="url" value="{{url('')}}" />      

