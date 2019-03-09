<script>
    $(document).ready(function () {
        if ($('.navlog_info').length > 0) {
            $('.navlog_info').each(function (e) {
                jQuery.fn.dataTableExt.sErrMode = 'throw';
                var data = $('form[id="navlog_search"]').serialize();
                var url_fpl_list = $("#url").val();
                var clicked_btn = $("#clicked_btn").val();
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
                    "sAjaxSource": url_fpl_list + "/test_navlog_list",
                    "fnServerParams": function (aoData, fnCallback) {

                        if (clicked_btn == 'first') {
                            aoData.push({"name": "aircraft_callsign", "value": $('#aircraft_callsign2').val()});
                            aoData.push({"name": "departure_aerodrome", "value": $('#departure_aerodrome2').val()});
                            aoData.push({"name": "destination_aerodrome", "value": $('#destination_aerodrome2').val()});
                            aoData.push({"name": "url", "value": $("#url").val()});
                            aoData.push({"name": "clicked_btn", "value": clicked_btn});
                            aoData.push({"name": "live_test_mode", "value": 2});
                            aoData.push({"name": "from_date", "value": $("#from_date").val()});
                            aoData.push({"name": "to_date", "value": $("#to_date").val()});
                        }
                         else if(clicked_btn == 'second') {
                            aoData.push({"name": "from_date", "value": $("#from_date").val()});
                            aoData.push({"name": "to_date", "value": $("#to_date").val()});
                            aoData.push({"name": "aircraft_callsign", "value": $('#aircraft_callsign2').val()});
                            aoData.push({"name": "departure_aerodrome", "value": $('#departure_aerodrome2').val()});
                            aoData.push({"name": "destination_aerodrome", "value": $('#destination_aerodrome2').val()});
                            aoData.push({"name": "url", "value": $("#url").val()});
                            aoData.push({"name": "clicked_btn", "value": clicked_btn});
                            aoData.push({"name": "live_test_mode", "value": 2});
                        }
                        else if (clicked_btn == '3rd') {
                            $("#tbl_head th").addClass('pending');       
                            aoData.push({"name": "url", "value": $("#url").val()});
                            aoData.push({"name": "clicked_btn", "value": clicked_btn});
                            aoData.push({"name": "plan_status", "value": 2});
                            aoData.push({"name": "live_test_mode", "value": 2});
                            aoData.push({"name": "from_date", "value": $("#from_date").val()});
                            aoData.push({"name": "to_date", "value": $("#to_date").val()});
                            $(".dataTables_empty p").html('ss');
                        }
                        else if (clicked_btn == '4th') {
                            $("#tbl_head th").addClass('completed');       
                            aoData.push({"name": "url", "value": $("#url").val()});
                            aoData.push({"name": "clicked_btn", "value": clicked_btn});
                            aoData.push({"name": "plan_status", "value": 3});
                            aoData.push({"name": "live_test_mode", "value": 2});
                        }
                        else if (clicked_btn == '5th') {
                            aoData.push({"name": "url", "value": $("#url").val()});
                            aoData.push({"name": "clicked_btn", "value": clicked_btn});
                            aoData.push({"name": "plan_status", "value": 2});
                            aoData.push({"name": "live_test_mode", "value": 2});
                            aoData.push({"name": "from_date", "value": $("#from_date").val()});
                            aoData.push({"name": "to_date", "value": $("#to_date").val()});
                        }
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
                    "aaSorting": [[1, 'desc'], [5, 'desc']],
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
                 //  if (clicked_btn == '3rd'||clicked_btn == '4th'||clicked_btn == '5th') {
                 //    $(".dataTables_empty p").html('NO RECORDS FOUND');
                 // }
                 // else
                 // {
                 //     $(".dataTables_empty p").html('NO MATCHING RECORDS sFOUND');
                 // }
            });
        }
        pending_cancelled_completed();
        function pending_cancelled_completed()
        {
            $.ajax({
                url: '/pending_cancelled_completed',
                 data:{'live_test_mode':2,'from_date':$("#from_date").val(),'to_date':$("#to_date").val()},
                success: function(result) {
                   $('#pend').html(' ('+result.pending+')');
                   $('#canc').html(' ('+result.cancelled+')');

                }
            });
        }    
        $(document).on('keyup', ".navlog_departure_time", function () {
            $(".departure_time").popover({
                html: true,
                trigger: "hover"
            });
            var data_value = $(this).attr('data-value');
            var departure_time = $("#departure_time" + data_value).val();
            var current_time = $("#current_time").val();
            var current_dof = $("#current_dof").val();
            var a_current_date = $("#a_current_date").val();
            var current_dept_time = $("#current_dept_time" + data_value).val();
            var sum = Number(current_dept_time) + Number(5);
            var sub = Number(current_dept_time) + Number(-5);
            var current_dof = $("#current_dof").val();
            var current_dept_time = $("#current_dept_time" + data_value).val();
            var a_current_date = $("#a_current_date").val();
            var now = new Date();
            var utc_now = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(),departure_time.substr(0,2),departure_time.substr(2,2),00,000);
            var utc_10min = new Date(now.getUTCFullYear(),now.getUTCMonth(),now.getUTCDate(),now.getUTCHours(),now.getUTCMinutes()+10,now.getUTCSeconds(),now.getUTCMilliseconds());
            if (current_dof == a_current_date) {
                if (departure_time.length < 4 || (departure_time > current_dept_time && departure_time < sum) || (departure_time < current_dept_time && departure_time > sub)) {
                   // console.log('first if');
                    $("#departure_time" + data_value).css('border', 'red solid 1px')
                    $(".tooltip_revise_time").addClass('tooltip_revise_valid');
                    $("[data-toggle='popover']").popover({
                        html: true,
                        trigger: "hover"
                    });
                    // $("#departure_time" + data_value).attr('data-content', 'Revise Time in multiples of 5 only');
                } 
                else if(((departure_time.length ==4)&&(parseInt(utc_10min.getTime())>parseInt(utc_now.getTime()))) || ((departure_time.length ==4)&&(current_time > departure_time))) {
                   // console.log('2nd if');
                    $("#departure_time" + data_value).css('border', 'red solid 1px');
                    $("[data-toggle='popover']").popover({
                        html: true,
                        trigger: "hover"
                    });
                    $("#departure_time" + data_value).attr('data-content', 'Enter more than 10 min from current time');
                }
                else {
                    //console.log('3rd if');
                    $('#time_img' + data_value).addClass('navlog_modal_class');
                    $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
                    $("#departure_time" + data_value).popover('destroy');
                    $(".tooltip_revise_time").removeClass('tooltip_revise_valid');
                }
            } else {
                
                $('#time_img' + data_value).addClass('navlog_modal_class');
                $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
                $("#departure_time" + data_value).popover('destroy');
                $(".tooltip_revise_time").removeClass('tooltip_revise_valid');
            }

            if (departure_time.length == 4) {
                if ((departure_time[3] == 0 || departure_time[3] == 5) && departure_time < 2359) {
                    return true;
                } else {
                    $(this).val(departure_time[0] + departure_time[1] + departure_time[2]);
                }
            }
            if (departure_time.substring(2, 4) > 59 && departure_time.substring(0, 2) <= 23) {
                $(this).val(departure_time.substring(0, 2) + '00');
            }

        });

        $(document).on('dblclick', '.navlog_departure_time', function () {
            var data_value = $(this).attr('data-value');
            $('#time_img' + data_value).removeClass('navlog_modal_class');
            $("#departure_time" + data_value).removeAttr('readonly');
            $(".tooltip_revise_time").removeClass('tooltip_revise_dbl');
        });
        
        $(document).on('blur', '.navlog_departure_time', function () {
            var data_value = $(this).attr('data-value');
            $("#departure_time" + data_value).attr('readonly', 'readonly');
            $(".tooltip_revise_time").addClass('tooltip_revise_dbl');
            $(".tooltip_revise_time").removeClass('tooltip_revise_valid');
        });

        $(document).on('click', '.check_revise', function () {
            var data_value = $(this).attr('data-value');
            var departure_time = $("#departure_time" + data_value).val();
            var current_time = $("#current_time").val();
            var current_dept_time = $("#current_dept_time" + data_value).val();
            var sum = Number(current_dept_time) + Number(5);
            var sub = Number(current_dept_time) + Number(-5);
            var current_dof = $("#current_dof").val();
            var a_current_date = $("#a_current_date").val();
            $("#departure_time" + data_value).focus();
            $("#departure_time" + data_value).select();
            $("#departure_time" + data_value).removeAttr('readonly');
            if (current_dof == a_current_date) {
                if ((current_time > departure_time) || departure_time.length < 4 || (departure_time > current_dept_time && departure_time < sum) || (departure_time < current_dept_time && departure_time > sub)) {
                    $("#departure_time" + data_value).css('border', 'red solid 1px');
                    $("[data-toggle='popover']").popover({
                        html: true,
                        trigger: "hover"
                    });
                    $("#departure_time" + data_value).attr('data-content', 'Departure Time should be less or more by 5 Minutes than Filed Plan Time');
                } else if (departure_time == current_dept_time) {
                    $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
                } else {
                    $("#departure_time" + data_value).popover('destroy');
                    $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
                    $('#time_img' + data_value).addClass('modal_class');
                    $('#time_img' + data_value).removeClass('check_revise');
                }
            } else if (departure_time == '0000') {
                $('#time_img' + data_value).removeClass('modal_class');
                $("#departure_time" + data_value).css('border', 'red solid 1px');
                $("#departure_time" + data_value).attr('data-content', 'Revise Time can not be 0000');
            } else {
                if (departure_time.length < 4) {
                    $("#departure_time" + data_value).css('border', 'red solid 1px')
                    $("#departure_time" + data_value).attr('data-content', 'Departure Time should be less or more by 5 Minutes than Filed Plan Time');
                } else {
                    $('#time_img' + data_value).addClass('modal_class');
                    $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
                    $("#departure_time" + data_value).popover('destroy');
                }
            }
        });
        $(".navlog_change_ficadc").on('click', function (e) {
            var data_value = $(this).attr('data-value');
            var fic = $("#fic" + data_value).val();
            var adc = $("#adc" + data_value).val();
            var data_url = $(this).attr('data-url');
            var validation = true;
            $("#sendficadc").modal('hide');
            // $("#mysuccess").removeClass('hide');
            // $("#mysuccess").html('<a href=""><i class="fa fa-spinner fa-spin"></i></a> Processing please wait...');
            if ((fic == '') || (fic.length < '4')) {
                $("#fic" + data_value).attr('data-content', 'Min. 4 & Max. 4 Characters, only Numbers allowed');
                $("#fic" + data_value).css("border", "red solid 1px");
                validation = false;
            } else {
                $("#fic" + data_value).popover('destroy');
                $("#fic" + data_value).css("border", "lightgrey solid 1px");
            }
            if (!validation) {
                return false;
            }
            $(".overlay").show(); 
            $.ajax({
                type: 'POST',
                url: data_url,
                data: {'flag': 'revise_time', 'id': data_value, 'fic': fic, 'adc': adc},
                dataType: 'json',
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data, textStatus, jqXHR) {
                    $(".overlay").fadeOut();
                    $("#mysuccess").removeClass('hide');
                    $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
                    hidemsg();
                    $("#fic" + data_value).attr('readonly', 'readonly');
                    $("#adc" + data_value).attr('readonly', 'readonly');
                },
                error: function (data, textStatus, jqXHR) {
                    console.log(data);
                }
            })
        });
        $(document).on('keyup', '.fic_valid', function (e) {
            var data_value = $(this).attr('data-value');
            var fic = $("#fic" + data_value).val();
            var adc = $("#adc" + data_value).val();
            var data_url = $(this).attr('data-url');
            var validation = true;
            $("#sendficadc").modal('hide');
            if ((fic == '') || (fic.length < '4')) {
                $("[data-toggle = 'popover']").popover({
                    html: true,
                    trigger: "hover"
                });
                $("#fic" + data_value).attr('data-content', 'Min. 4 & Max. 4 Characters, only Numbers allowed');
                $("#fic" + data_value).css("border", "red solid 1px");
                validation = false;
            } else {
                $("#fic" + data_value).popover('destroy');
                $("#fic" + data_value).css("border", "lightgrey solid 1px");
            }
        });
        $(document).on('keypress', ".adc_valid", function (e) {
            var data_value = $(this).attr('data-value');
            var dept_aero = $(this).attr('data-dept-aero');
            var dest_aero = $(this).attr('data-dest-aero');
            var adc = $("#adc" + data_value).val();
            var adc_length = adc.length;
            var dept_aero_length = dept_aero.length;
            var dept_aero_sub = dept_aero.substr(0, 2);
            if (dept_aero_sub == 'VO' && dept_aero_length <=4) {
                $("#adc" + data_value).attr('maxlength', 5);
                $("#adc" + data_value).attr('minlength', 3);
                if (adc_length == 1) {
                    return (adc == 'C') ? number(e) : false;
                } else if (adc_length <= 3 && adc_length >= 1) {
                    number(e)
                } else {
                    alpha(e);
                }
            } else if (dept_aero_sub == 'VA' && dept_aero != 'VAAH' && dept_aero_length <=4) {
                $("#adc" + data_value).attr('maxlength', 5);
                $("#adc" + data_value).attr('minlength', 3);
                if (adc_length == 1) {
                    return (adc == 'M' || adc == 'N' || adc == 'P') ? number(e) : false;
                } else if (adc_length <= 3 && adc_length >= 1) {
                    number(e)
                } else {
                    alpha(e);
                }
            } else if (dept_aero_sub == 'VE' && dept_aero_length <=4) {
                $("#adc" + data_value).attr('maxlength', 5);
                $("#adc" + data_value).attr('minlength', 3);
                if (adc_length == 1) {
                    return (adc == 'K') ? alpha(e) : false;
                } else if (adc_length == 2) {
                    return (adc == 'KX' || adc == 'KY') ? number(e) : false;
                } else if (adc_length <= 4 && adc_length >= 2) {
                    number(e)
                } else {
                    alpha(e);
                }
            } else if (dept_aero == 'VAAH' && dept_aero_length <=4) {
                $("#adc" + data_value).attr('maxlength', 6);
                $("#adc" + data_value).attr('minlength', 6);
                if (adc_length == 1) {
                    return (adc == 'W') ? alpha(e) : false;
                } else if (adc_length == 2) {
                    return (adc == 'WM') ? number(e) : false;
                } else if (adc_length <= 4 && adc_length >= 2) {
                    number(e)
                } else {
                    alpha(e);
                }
            } else if (dept_aero_sub == 'VI' && dept_aero_length <=4) {
                $("#adc" + data_value).attr('maxlength', 5);
                $("#adc" + data_value).attr('minlength', 3);
                if (adc_length == 1) {
                    return (adc == 'X' || adc == 'Y' || adc == 'Z') ? true : false;
                } else if (adc_length == 2) {
                    return (adc == 'XX' || adc == 'YY' || adc == 'ZZ' || !isNaN(adc.substr(1, 1))) ? number(e) : false;
                } else if (adc_length <= 4 && adc_length >= 2) {
                    number(e)
                } else {
                    alpha(e);
                }
            }
        });
        $(document).on('keyup', ".adc_valid", function (e) {
            var data_value = $(this).attr('data-value');
            var min_length = $(this).attr('minlength');
            var adc = $("#adc" + data_value).val();
            var adc_length = adc.length;
            if (adc == '' || adc_length >= min_length) {
                $("#adc" + data_value).css("border", "lightgrey solid 1px");
            } else {
                $("#adc" + data_value).css("border", "red solid 1px");
            }
        });

        $(document).on('keypress', '.numeric', function (e) {
            var regex = new RegExp("^[0-9]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

        $(".edit_full_plan").on('click', function () {
            var id = $("#id").val();
//            window.location = base_url + "/fpl?id=" + id;
            var encodedid = $("#encodedid").val();
//            window.location = base_url + "/fpl?_key=" + encodedid;
            window.open(base_url + "/fpl?_key=" + encodedid, '_blank');

        })

    });

    function alpha(e) {
        var regex = new RegExp("^[a-zA-Z]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    }

    function number(e) {
        var regex = new RegExp("^[0-9]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    }
</script>

<style>
    .modal_btn_navlog{
      width: 65px;
      height: 34px;
      color: #fff !important;
    }
    .desk-plan>thead>tr>th:nth-child(9), .desk-plan>tbody>tr>td:nth-child(9) {
        border-right:0;
    }
    .desk-plan>thead>tr>th:nth-child(10), .desk-plan>tbody>tr>td:nth-child(10) {
        border-left: 0;
        border-right:0;
    }
    .desk-plan>thead>tr>th:nth-child(11), .desk-plan>tbody>tr>td:nth-child(11) {
        border-left:0;
    }
    .desk-plan>thead>tr>th:nth-child(9), .desk-plan>thead>tr>th:nth-child(10), .desk-plan>thead>tr>th:nth-child(11) {
        letter-spacing: -0.7px;
    }

    .dataTables_wrapper .dataTables_paginate .previous {
        background: #333 !important;
        color: #fff !important;
    }
    .dataTables_wrapper .dataTables_paginate .next {
        background: #333 !important;
        color: #fff !important;
    }
    /*.fic input, .adc input {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }*/
    .lntstyle{
        border-left: 0px!important;
        padding-left: 4px!important;
        padding-right: 4px!important;
    }
    .kitstyle{
        border-left: 0px!important;
        padding-left: 4px!important;
        padding-right: 4px!important;
    }
    .navstyle{
        padding-left: 4px!important;
    }
    #DataTables_Table_1_previous:hover, #DataTables_Table_1_next:hover {
        background: #eee !important;
        color: #333 !important;
    }
</style>
<div class="desk-view">
    <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:18px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
    <div class="row">
        <div class="col-md-12">
            <table class="navlog_info table table-hover table-responsive desk-plan">
                <thead id="tbl_head">
                    <tr>
                        <th class="slno">Sl</th>
                        <th class="dof thdof" style="width: 10%">Flight Date</th>
                        <th class="calsign " style="width: 10%">Call Sign</th>
                        <th class="dpt thdpt" >Dep. Time</th>
                        <th class="from thfrom">From</th>
                        <th class="to thto">To</th>
                        <th class="fildate">Change</th>
                        <th class="pdf">NAV</th>
                        <th class="weather">Others</th>  
                    </tr>
                </thead>
                @include('includes.new_navlog_modal')
            </table>
            <input type="hidden" name="clicked_btn" id="clicked_btn" value="{{(isset($clicked_btn)) ? $clicked_btn : ''}}" />
        </div>
    </div>
</div>