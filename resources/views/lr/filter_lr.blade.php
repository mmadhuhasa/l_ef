
<script>
    $(document).ready(function () {
        var order_by = "asc";
        var sZeroRecords =  "<p style='color:#333;font-weight:bold'>NO RECORDS FOUND</p>";
        var action = $("#action").val();
        if($("#status_type").val() == 'expire'){
            order_by = "desc";
             sZeroRecords = "<p style='color:#333;font-weight:bold'>NO RECORDS FOUND IN EXPIRED LIST, CLICK VALID TAB TO VIEW CURRENT RECORDS.</p>";
        }
        
        var dt = $('#filter_lr_info').dataTable({
            "sDom": '<"top"iflp<"clear">>rt',
            "bProcessing": false,
            "bFilter": false,
            "bLengthChange": false,
            "iDisplayLength": 25,
            "sPaginationType": "simple_numbers",
            "info": false,
            "bSortable": true,
            "bRetrieve": true,
//            "order": [[6, order_by],[1, "asc"]],
            "aoColumnDefs": [
                {"aTargets": [0], "bSortable": false},
                {"aTargets": [1], "bSortable": true},
                {"aTargets": [2], "bSortable": true},
                {"aTargets": [7], "bSortable": false},
                {"aTargets": [5], "bSortable": false}
            ],
            "sAjaxSource": base_url + '/lr/list',
            "fnServerParams": function (aoData, fnCallback) {
                aoData.push({"name": "status_type", "value": $("#status_type").val()});
                aoData.push({"name": "filter_user_name", "value": $("#filter_user_name").val()});
                aoData.push({"name": "filter_license_type", "value": $("#filter_license_type").val()});
                aoData.push({"name": "filter_from_date", "value": $("#filter_from_date").val()});
                aoData.push({"name": "filter_to_date", "value": $("#filter_to_date").val()});
                aoData.push({"name": "filter_operator", "value": $("#filter_operator").val()});
                aoData.push({"name": "s_type", "value": $("#s_type").val()});
                aoData.push({"name": "add_licence_type", "value": $("#add_licence_type").val()});
                aoData.push({"name": "action", "value": $("#action").val()});
            },
            "fnRowCallback": function (nRow, aData, iDisplayIndex) {
                var oSettings = dt.fnSettings();
                $("td:first", nRow).html(oSettings._iDisplayStart + iDisplayIndex + 1);
              
                 if (aData[0] == "1" && action == "edit")
                    {
                        $('td', nRow).css('background-color', 'lightgreen');
                    }
                return nRow;
            },
            "oLanguage": {
                        "sZeroRecords": sZeroRecords
                    },
             "initComplete": function (settings, json) {
                // alert('DataTables has finished its initialisation.');
                $('div.dt_loading').remove();
            }
        });
        $('#date1').datepicker();
        $('#date1').datepicker('setDate', 'today');
        $("#date1").datepicker("option", "dateFormat", "yy-mm-dd");
    });
</script>

<div class="col-md-12">
    <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:20px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
    <table id="filter_lr_info" class="table table-hover table-responsive desk-plan">
        <thead>
            <tr class="bg-v-333">
                <th class="slno">SL</th>
                <th class="uname">NAME</th>
                <th class="ltype">LICENSE NAME</th>
                <th class="rdate">OPERATOR</th>
                <th class="lnum">LICENSE NUMBER</th>
                <th class="exp-date">EXPIRY DATE</th>
                <th class="vdays">DAYS</th>
                <th class="action">ACTIONS</th>
            </tr>
        </thead>                                  
    </table>
</div>
<div>
    <input type="hidden" name="status_type" id="status_type" value="{{(isset($flag)) ? $flag : ''}}" />
    <input type="hidden" name="s_type" id="s_type" value="{{(isset($s_type)) ? $s_type : ''}}" />
    <input type="hidden" name="add_licence_type" id="add_licence_type" value="{{(isset($add_licence_type)) ? $add_licence_type : ''}}" />
    <input type="hidden" name="action" id="action" value="{{(isset($action)) ? $action : ''}}" />
</div>