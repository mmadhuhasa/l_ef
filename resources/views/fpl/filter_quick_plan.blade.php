<script>
    $(document).ready(function () {
        if ($('.fpl_info').length > 0) {
            $('.fpl_info').each(function (e) {
                jQuery.fn.dataTableExt.sErrMode = 'throw';
                var data = $('form[id="fpl_search"]').serialize();
                var url_fpl_list = $("#url").val();
                var clicked_btn = $("#clicked_btn").val();
                var filter_stats = $("#filter_stats").val();
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
                    "sAjaxSource": url_fpl_list + "/new_fpl/fpl_list",
                    "fnServerParams": function (aoData, fnCallback) {
                        if (clicked_btn == 'first') {
                            /*aoData.push({"name": "from_date", "value": ''});
                            aoData.push({"name": "to_date", "value": ''});*/
                            aoData.push({"name": "from_date", "value": $("#from_date").val()});
                            aoData.push({"name": "to_date", "value": $("#to_date").val()});
                            aoData.push({"name": "aircraft_callsign", "value": $('#aircraft_callsign2').val()});
                            aoData.push({"name": "departure_aerodrome", "value": $('#departure_aerodrome2').val()});
                            aoData.push({"name": "destination_aerodrome", "value": $('#destination_aerodrome2').val()});
                            aoData.push({"name": "url", "value": $("#url").val()});
                            aoData.push({"name": "date_of_flight", "value": ''});
                            aoData.push({"name": "clicked_btn", "value": clicked_btn})
                        } else {
                            aoData.push({"name": "from_date", "value": $("#from_date").val()});
                            aoData.push({"name": "to_date", "value": $("#to_date").val()});
                            aoData.push({"name": "aircraft_callsign", "value": $('#aircraft_callsign2').val()});
                            aoData.push({"name": "departure_aerodrome", "value": $('#departure_aerodrome2').val()});
                            aoData.push({"name": "destination_aerodrome", "value": $('#destination_aerodrome2').val()});
                            aoData.push({"name": "url", "value": $("#url").val()});
                            aoData.push({"name": "date_of_flight", "value": ''});
                        }
                        if (filter_stats && filter_stats != '') {
                            aoData.push({"name": "filter_stats", "value": filter_stats});
                            aoData.push({"name": "wing_type", "value": $("#wing_type").val()});
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
//                    'sDom': "lfrtip",
                    "aaSorting": [[1, 'desc'], [5, 'desc']],
                    "aLengthMenu": [20, 50, 100, 200, 400],
//                    "fnInitComplete": function () {
//                        $('[rel=popover]').popover({
//                            placement: "top",
//                            html: true,
//                        });
//                    },
                    "fnDrawCallback": function (oSettings) {
                        $('[rel=popover]').popover({
                            placement: "top",
                            html: true,
                        });
//                        if ($('.fpl_info tr').length < 25) {
//                            $('.dataTables_paginate').hide();
//                        }
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

        $(".revise_time").on('click', function (e) {
            var data_value = $(this).attr('data-value');
            var id = $(this).attr('id');
            $("#departure_time" + data_value).removeAttr('disabled');
            $("#departure_time" + data_value).focus();
            $("#revisetime").modal('hide');
        });

        $(".confirm_revise").on('click', function (e) {
            var data_value = $(this).attr('data-value');
            var departure_time = $("#departure_time" + data_value).val();
            var data_url = $(this).attr('data-url');
            var current_time = $("#current_time").val();
            var current_dept_time = $("#current_dept_time").val();
            $("#cnfrevise").modal('hide');
            $("#mysuccess").html('Processing please wait...');
            $.ajax({
                type: 'POST',
                url: data_url,
                data: {'flag': 'revise_time', 'id': data_value, 'departure_time': departure_time},
                dataType: 'json',
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data, textStatus, jqXHR) {
                    $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
                    $("#fic" + data_value).removeAttr('readonly');
                    $("#adc" + data_value).removeAttr('readonly');
//                    $("#departure_time" + data_value).attr('readonly', 'readonly')
                },
                error: function (jqXHR, textStatus, errorThrown) {

                }
            })
        });

        $(document).on('keyup', ".departure_time", function () {
            $(".departure_time").popover({
                html: true,
                trigger: "hover"
            });
            var data_value = $(this).attr('data-value');
            var departure_time = $("#departure_time" + data_value).val();
            var current_time = $("#current_time").val();
            var current_dept_time = $("#current_dept_time" + data_value).val();
            var sum = Number(current_dept_time) + Number(5);
            var sub = Number(current_dept_time) + Number(-5);
            var current_dof = $("#current_dof").val();
            var a_current_date = $("#a_current_date").val();
//        console.log('sum ' + current_dof + 'sub ' + a_current_date + ' departure_time ' + departure_time + 'current_time' + current_time);
            if (current_dof == a_current_date) {
                if ((current_time > departure_time) || departure_time.length < 4 || (departure_time > current_dept_time && departure_time < sum) || (departure_time < current_dept_time && departure_time > sub)) {
                    $("#departure_time" + data_value).css('border', 'red solid 1px')
                    $("#departure_time" + data_value).attr('data-content', 'Departure Time should be less or more by 5 Minutes than Filed Plan Time');
                } else {
                    $('#time_img' + data_value).addClass('modal_class');
                    $("#departure_time" + data_value).css("border", "lightgrey solid 1px");
                    $("#departure_time" + data_value).popover('destroy');
                }
            } else if (departure_time == '0000') {
                $("#departure_time" + data_value).css('border', 'red solid 1px');
                $("#departure_time" + data_value).attr('data-content', 'Revise Time can not be 0000');
                $('#time_img' + data_value).removeClass('modal_class');
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

            console.log('departure_time ' + departure_time + ' current_time ' + current_time);
            console.log('current_dept_time ' + current_dept_time + ' sum ' + sum + ' sub ' + sub);
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

        $(".cancel_plan").on('click', function (e) {
            var data_value = $(this).attr('data-value');
            var data_url = $(this).attr('data-url');
            $("#cancel_plan").modal('hide');
            $("#mysuccess").html('Processing please wait...');
            $.ajax({
                type: 'POST',
                url: data_url,
                data: {'id': data_value},
                dataType: 'json',
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data, textStatus, jqXHR) {
                    $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
                    $('.add_cancel_class' + data_value).addClass('company_color');
                    $('.add_cancel_class' + data_value).removeClass('text-black');
                },
                error: function (data, textStatus, jqXHR) {
                    console.log(data);
                }
            })
        });

        $(".change_ficadc").on('click', function (e) {
            var data_value = $(this).attr('data-value');
            var fic = $("#fic" + data_value).val();
            var adc = $("#adc" + data_value).val();
            var data_url = $(this).attr('data-url');
            var validation = true;
            $("#sendficadc").modal('hide');
            $("#mysuccess").html('Processing please wait...');
            console.log("#sendficadc" + data_value)
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
            $.ajax({
                type: 'POST',
                url: data_url,
                data: {'flag': 'revise_time', 'id': data_value, 'fic': fic, 'adc': adc},
                dataType: 'json',
                cache: false,
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data, textStatus, jqXHR) {
                    $("#mysuccess").html('<div class="success-left animated infinite zoomIn custdelay accmsg success-font">' + data.success + '</div>');
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
            console.log(data_value)
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
            console.log('Filter')
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
            var encodedid = $("#encodedid").val();
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
    .fic input, .adc input {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
</style>
<div class="desk-view">
    <div class="dt_loading"><i style="width:100%;text-align:center;margin-top:18px;color:#f1292b" class="fa-2x fa fa-spinner fa-spin"></i></div>
    <div class="row">
        <div class="col-md-12">
            <table class="fpl_info table table-hover table-responsive desk-plan">
                <thead>
                    <tr>
                        <th class="slno">Sl</th>
                        <th class="dof thdof"> Flight Date </th>
                        <th class="calsign thcalsign">  Call Sign  </th>
                        <th class="dpt thdpt">    Dep. Time    </th>
                        <th class="ficadc thficadc">        FIC-ADC        </th>
                        <th class="from thfrom">           From          </th>
                        <th class="to thto">          To          </th>
                        <th class="fildate thchange">Change</th>
                        <th class="pdf thpdf"> FPL</th>
                        <th class="weather thnotam">NOTAM</th>                                
                        <th class="weather thweather">Wx</th>

                    </tr>
                </thead>
                @include('includes.new_myaccount_modals')	
            </table>
            <input type="hidden" name="clicked_btn" id="clicked_btn" value="{{(isset($clicked_btn)) ? $clicked_btn : ''}}" />
            <input type="hidden" name="filter_stats" id="filter_stats" value="{{(isset($filter_stats)) ? $filter_stats : ''}}" />
            <input type="hidden" name="wing_type" id="wing_type" value="{{(isset($wing_type)) ? $wing_type : ''}}" />
        </div>
    </div>
</div>