$(document).ready(function () {
    if ($('.pilots_info').length > 0) {
        $('.pilots_info').each(function (e) {
            if (!$(this).hasClass("dataTable-custom")) {
                jQuery.fn.dataTableExt.sErrMode = 'throw';
                jQuery.fn.dataTableExt.oPagination.iFullNumbersShowPages = 10;
                var opt = {
                    //"bJQueryUI" : true,
                    "iDisplayLength": 20,
                    "sPaginationType": "simple_numbers",
                    "bProcessing": true,
                    "bServerSide": true,
                    //                    "sAjaxSource": $(this).attr('data-swfurl') + '/dnbo/orders/ordersList', //"https://hifives.in/new_production/dnbo/products/getlists",
                    "sAjaxSource": "http://localhost:8080/testpvtflight/public/Admin/pilot_details_list",
                    "sAjaxDataProp": "aaData",
                    "bPaginate": true,
                    "oLanguage": {
                        "sSearch": "<span>Search:</span> ",
                        "sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
                        "sLengthMenu": "_MENU_ <span>entries per page</span>",
                        "sLoadingRecords": "Please wait - loading...",
                        "sProcessing": "Loading, please wait..."
                    },
                    'sDom': "lfrtip",
                    //                    "aaSorting": [[0, 'desc']],
                    "aLengthMenu": [20, 50, 100, 200, 400],
                    "fnInitComplete": function () {
                        $('[rel=popover]').popover({
                            placement: "top",
                            html: true,
                        });
                    },
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
                //                oTable.$("[rel=popover]").popover();
                //                oTable.fnGetNodes().popover();
            }
        });
    }

    if ($('.fpl_info').length > 0) {
        $('.fpl_info').each(function (e) {
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
                "sAjaxSource": url_fpl_list + '/new_fpl/fpl_list',
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

    $("#fpl_search").on('submit', function (e) {
        e.preventDefault();
        var clicked_btn = $(this).find("button[type=submit]:focus").attr('id');
        var data_url = $(this).attr('data-url');
        var data = $('form[id="fpl_search"]').serialize();
        data = data + '&clicked_btn=' + clicked_btn;
        var aircraft_callsign2 = $("#aircraft_callsign2").val();
        var departure_aerodrome2 = $("#departure_aerodrome2").val();
        var destination_aerodrome2 = $("#destination_aerodrome2").val();
        var from_date = $("#from_date").val();
        var to_date = $("#to_date").val();

        console.log('data ', data)

        if (clicked_btn == 'first') {
            if (aircraft_callsign2 == '' && departure_aerodrome2 == '' && destination_aerodrome2 == '') {
                $("#alert_validation").modal();
                $(".modal_message").html("Please enter any one field");
                $(".header_title").html('Validation Fail Message')
                return false;
            }
        }
        if (from_date != '' && to_date == '') {
            $("#alert_validation").modal();
            $(".modal_message").html("Please enter To Date");
            $(".header_title").html('Validation Fail Message')
            return false;
        }
        if (to_date != '' && from_date == '') {
            $("#alert_validation").modal();
            $(".modal_message").html("Please enter From Date");
            $(".header_title").html('Validation Fail Message')
            return false;
        }

        $(".dt_loading").html('<i style="width:100%;text-align:center;padding-top:12px;color:#f1292b" class="fa-2x fa fa-spinner"></i>');
        $.ajax({
            url: data_url,
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data, textStatus, jqXHR) {
                $("#result").html(data);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown)
            }
        })

    });

    $(document).on('click', ".modal_class", function (e) {
        var data_value = $(this).attr('data-value');
        var url = $(this).attr('data-url');
        var modal_type = $(this).attr('modal-type');
        var is_plan_active = $(this).attr('is-plan-active');
        var is_fic_active = $(this).attr('is-fic-active');
        var data_encoded = $(this).attr('data-encoded');
        console.log('data_value ' + data_value + ' url ' + url + ' modal_type ' + modal_type);
        switch (modal_type) {
            case 'cancel':
                $(".cancel_plan").attr('data-value', data_value);
                if (is_plan_active) {
                    $("#cancel_plan").modal();
                }
                break;
            case 'preview':
                $("#preview").modal();
                break;
            case 'revise_confirm':
                $(".departure_time").attr('data-content', '');
//                $("#departure_time" + data_value).attr('readonly', 'readonly');
                $("#confirm_revise").attr('data-value', data_value);
                if (is_plan_active) {
                    $("#cnfrevise").modal();
                }
                break;
            case 'fic_adc':
                if (is_fic_active) {
                    var fic = $("#fic" + data_value).val();
                    var adc = $("#adc" + data_value).val();
                    var from= $(this).attr('data-from');
                    var dof= $(this).attr('data-dof');
                    var data_url = $(this).attr('data-url');
                    var maxlength = $("#adc" + data_value).attr('maxlength');
                    var minlength = $("#adc" + data_value).attr('minlength');
                    var validation = true;

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
                    if (adc != '') {
                        if (adc.length > maxlength) {
                            $("#adc" + data_value).css("border", "red solid 1px");
                            validation = false;
                        } else if (adc.length < minlength) {
                            $("#adc" + data_value).css("border", "red solid 1px");
                            validation = false;
                        } else {
                            $("#adc" + data_value).css("border", "lightgrey solid 1px");
                        }
                    } else {
                        validation = false;
                        $("#adc" + data_value).css("border", "red solid 1px");
                    }

                    $.ajax({
                        url: base_url + '/api/fpl/get_adc_count',
                        type: 'GET',
                        data: {'adc': adc, 'id': data_value,'from':from,'dof':dof,'fic':fic},
                        cache: false,
                        async: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        success: function (data, textStatus, jqXHR) {
                            console.log('data ', data)
                            /*
                            if (data == 1) {
                                $("#adc" + data_value).attr('data-content', 'CHECK ADC NUMBER ENTERED, DUPLICATE NOT ALLOWED');
                                $("#adc" + data_value).css("border", "red solid 1px");
                                validation = false;
                            } */
                            if (data.adc == 1) {
                                $("#adc" + data_value).attr('data-content', 'CHECK ADC NUMBER ENTERED, DUPLICATE NOT ALLOWED');
                                $("#adc" + data_value).css("border", "red solid 1px");
                               
                                validation = false;
                            }
                            if (data.fic >=1) {
                                $("#fic" + data_value).attr('data-content', 'CHECK FIC NUMBER ENTERED, DUPLICATE NOT ALLOWED');
                                $("#fic" + data_value).css("border", "red solid 1px");
                            
                                validation = false;
                            }
                            if(data.adc == 1 || data.fic >=1){
                               $("#alert_msg").html("RE-CHECK FIC/ ADC NUMBER ENTERED, DUPLICATE NOT ALLOWED"); 
                               $("#alert").modal();
                            }
                               
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(errorThrown)
                        }
                    })

                    if (!validation) {
                        return false;
                    }

                    $("#sendficadc").modal();
                    $(".change_ficadc").attr('data-value', data_value);
                }
                break;
            case 'change_plan':
                var is_change_allowed = $(this).attr('is_change_allowed');
                if (is_plan_active && is_change_allowed == '') {
                    $("#changeplan").modal();
                }
                $("#id").val(data_value);
                $("#encodedid").val(data_encoded)
                break;
            case 'tableview':
                $("#tableview").modal();
                break;
            default:
                break;
        }
        var data = {'id': data_value, 'modal_type': modal_type}
        console.log(data)
        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data, textStatus, jqXHR) {
                $(".header_title").html(data.header_title);
                $(".modal_message").html(data.modal_message);
                $("[data-toggle = 'popover']").popover({
                    html: true,
                    trigger: "hover"
                });
                console.log(data)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown)
            }
        })

    });

    $(document).on('mouseenter', '.deptpopover', function () {
        $("[data-toggle = 'popover']").popover({
            html: true,
            trigger: "hover"
        });
    });

    $(document).on('keyup', "#aircraft_callsign2", function () {
        var aircraft_callsign2 = $("#aircraft_callsign2").val();
        if (aircraft_callsign2.length >= 1 && aircraft_callsign2.length < 5) {
            $("#aircraft_callsign2").css('border', 'red solid 1px');
        } else {
            $("#aircraft_callsign2").css('border', 'lightgrey solid 1px');
        }
    });

    $(document).on('keyup', '#departure_aerodrome2', function () {
        var departure_aerodrome2 = $("#departure_aerodrome2").val();
        if (departure_aerodrome2.length >= 1 && departure_aerodrome2.length < 4) {
            $("#departure_aerodrome2").css('border', 'red solid 1px');
        } else {
            $("#departure_aerodrome2").css('border', 'lightgrey solid 1px');
        }
    });

    $(document).on('keyup', '#destination_aerodrome2', function () {
        var destination_aerodrome2 = $("#destination_aerodrome2").val();
        if (destination_aerodrome2.length >= 1 && destination_aerodrome2.length < 4) {
            $("#destination_aerodrome2").css('border', 'red solid 1px');
        } else {
            $("#destination_aerodrome2").css('border', 'lightgrey solid 1px');
        }
    });

    $(document).on('click', ".fdtl_popup", function () {
        var dept = $(this).attr('data-dept-aero');
        var dest = $(this).attr('data-dest-aero');
        var date_of_flight = $(this).attr('data-dof');
        var callsign = $(this).attr('data-callsign');
        var fdtl_id = $(this).attr('data-value');

        var Months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun",
            "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
        ];

        var dd = date_of_flight.substr(4);
        var MON = Months[date_of_flight.substr(3, 1) - 1];
        var year = '20' + date_of_flight.substr(0, 2);

        var dof = dd + '-' + MON + '-' + year;

        var fdtl_text = "FDTL FOR " + callsign + " " + dept + " " + dest + " OF " + dof;

        $("#fdtl_departure_aerodrome").val(dept);
        $("#fdtl_destination_aerodrome").val(dest);
        $("#fdtl_date_of_flight").val(date_of_flight);
        $("#fdtl_aircraft_callsign").val(callsign);
        $("#fdtl_id").val(fdtl_id);

        $("#fdtl_text").html(fdtl_text);
        $.get(base_url + "/api/fpl/getFDTLPopup", {'id': fdtl_id}, function (data) {
            $("#chocks_on").val(data.data.chocks_on);
            $("#chocks_off").val(data.data.chocks_off);
            $("#landing_time").val(data.data.landing_time);
            $("#airborne_time").val(data.data.airborne_time);
            $("#fdtl_popup_modal").modal();
        });

    });

    $(document).on('click', '.fpl_notams', function () {
        var dof = $(this).attr('data-dof');
        var data_value = $(this).attr('data-value');        
        var data = {
            "fromdate": dof,
            "todate": dof,
            "startTime": "0000",
            "endTime": "2359",
            "airportcode": "VIDN,VABB",
            "data_value": data_value,
            "_token" : $('meta[name="_token"]').attr('content')
        }
        $.redirect(base_url + '/notams/fplnotams', data, 'POST', '_blank');
    });

});
