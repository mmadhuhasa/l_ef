<script>
$(function(){   
	alert("ss");
if ($('.navlog_info').length > 0) 
{

    $('.navlog_info').each(function (e) 
    {
        var url_fpl_list = $("#url").val();
        var date = $("#date_of_flight2").val();
        jQuery.fn.dataTableExt.sErrMode = 'throw';
        jQuery.fn.dataTableExt.oPagination.iFullNumbersShowPages = 10;
        var opt = {
        "sDom": '<"top"iflp<"clear">>rt',
                "bFilter": false,
                "bLengthChange": false,
                "iDisplayLength": 25,
                "sPaginationType": "simple_numbers",
                "bProcessing": false,
                "bServerSide": true,
                "info": false,
                "sAjaxSource": url_fpl_list + '/navlog_list',
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
                        "sZeroRecords": "<p style='color:red'>NO MATCHING RECORDS FOUND</p>"
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
});
</script>