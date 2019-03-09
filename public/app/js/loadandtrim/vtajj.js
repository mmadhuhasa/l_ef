$(function () {
    var currentDate = $("#current_date").val();//document.getElementById("utcdate").value;

    $(".from_date").datepicker("setDate", currentDate);

    $(window).on('load', function () {
        $("#weight18").css('border', 'red 1px solid');
        $("#weight19").css('border', 'red 1px solid');

        $("#departure_aerodrome").css('border', 'red 1px solid');
        $("#destination_aerodrome").css('border', 'red 1px solid');
        $("#departure_time").css('border', 'red 1px solid');
        $("#pilot_in_command").css('border', 'red 1px solid');
        $("#copilot").css('border', 'red 1px solid');

//        var imageUrl = 'media/images/lnt.png';
//        $('.highcharts-container').css('background-image', 'url(' + imageUrl + ')');

        var zero_fuel_weight = Number(0);
        var zero_fuel_moment = Number(0);

        var label_text = $.trim($(this).text());
        var input_name = $(this).children('input[type="checkbox"]').attr('name');
        var id = $(this).closest('label').attr('data-label');
        var value = $(this).children('input[type="checkbox"]:checked').val();

        var bags_weight = ($("#weight17").val()) ? parseInt($("#weight17").val()) : Number(0);
        var pax_count = Number(0);

        if (input_name == 'jump') {
            $("#" + id).val(value);
        } else {
            if (label_text == 'Adult') {
                $("#" + id).val(value);
            } else if (label_text == 'Child') {
                $("#" + id).val(value);
            } else {
                $("#" + id).val(value);
            }
        }

        for (var i = 4; i <= 17; i++) {
            var weight_id = $('#weight' + i).attr('id');
            var weight_value = $("#" + weight_id).val();

            if (weight_id == 'weight' + i) {
                var arm_id = 'arm' + i;
                var arm_value = $("#" + arm_id).val();
                var moment_id = 'moment' + i;
                var moment_val = ((weight_value * arm_value));
                if (moment_val && weight_value) {
                    $("#" + moment_id).val(moment_val.toFixed(2));
                } else {
                    $("#" + moment_id).val('');
                }
            }
            var weight_data = $("#weight" + i).val();
            var moment_data = $("#moment" + i).val();

            if (weight_data == '') {
                weight_data = Number(0);
            } else {
                pax_count++;
            }
            if (!moment_data) {
                moment_data = Number(0);
            }

            zero_fuel_weight = parseInt(zero_fuel_weight) + parseInt(weight_data);
            zero_fuel_moment = (parseFloat(zero_fuel_moment) + parseFloat(moment_data)).toFixed(2);
        }
        pax_count = pax_count - 2;

        var zero_fuel_arm = ((zero_fuel_moment / zero_fuel_weight)).toFixed(2);
        var zero_fuel_cg = (((zero_fuel_arm - 264.57) * 100) / 80.7).toFixed(2);

        $("#moment20").val(zero_fuel_moment);
        $("#weight20").val(zero_fuel_weight);
        $("#arm20").val(zero_fuel_arm);
        $("#cg20").val(zero_fuel_cg);
    });

    $(document).on('click', '.calculate_lnt', function () {
        var zero_fuel_weight = Number(0);
        var take_off_fuel_weight1 = ($("#weight18").val()) ? parseInt($("#weight18").val()) : Number(0);
        var landing_fuel_weight1 = ($("#weight19").val()) ? parseInt($("#weight19").val()) : Number(0);
        var zero_fuel_moment = Number(0);
        var url = base_url + "/load/vtajj";
        var data = {'take_off_fuel_weight1': take_off_fuel_weight1,
            'landing_fuel_weight1': landing_fuel_weight1,
            'zero_fuel_weight': parseInt($("#weight20").val())};
        var take_off_fuel_moment1 = Number(0);
        var landing_fuel_moment1 = Number(0);
        var take_off_fuel_arm1 = Number(0);
        var landing_fuel_arm1 = Number(0);
        var validation = true;


        var bags = $("#weight17").val();

        lnt_validation();

        if (!validation) {
            return false;
        } else {
            $(".save_lnt_data").removeClass('disabled')
        }
        if (!take_off_fuel_weight1) {
            $("#weight18").css('border', 'red solid 1px');
            validation = false;
        } else {
            $("#weight18").css('border', 'lightgrey solid 1px');
        }
        if (!landing_fuel_weight1) {
            $("#weight19").css('border', 'red solid 1px');
            validation = false;
        } else {
            $("#weight19").css('border', 'lightgrey solid 1px');
        }

        if (parseInt(landing_fuel_weight1) >= parseInt(take_off_fuel_weight1)) {
            $("#weight19").css('border', 'red 1px solid');
            validation = false;
        } else {
            $("#weight19").css('border', 'lightgrey 1px solid');
        }

        if (!validation) {
            return false;
        }
        if (take_off_fuel_weight1 && landing_fuel_weight1) {
            $.ajax({
                url: url,
                data: data,
                type: 'POST',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data, textStatus, jqXHR) {
                    take_off_fuel_moment1 = data.take_off_fuel_moment1;
                    landing_fuel_moment1 = data.landing_fuel_moment1;
                    take_off_fuel_arm1 = (data.take_off_fuel_arm1).toFixed(2);
                    landing_fuel_arm1 = (data.landing_fuel_arm1).toFixed(2);

                    if (take_off_fuel_moment1 && take_off_fuel_weight1) {
                        $("#moment18").val(take_off_fuel_moment1);
                    } else {
                        $("#moment18").val('');
                    }
                    if (landing_fuel_moment1 && landing_fuel_weight1) {
                        $("#moment19").val(landing_fuel_moment1);
                    } else {
                        $("#moment19").val('');
                    }
                    $("#arm18").val(take_off_fuel_arm1);
                    $("#arm19").val(landing_fuel_arm1);
                },
                async: false,
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        }

        for (var i = 4; i <= 17; i++) {
            var weight_id = $('#weight' + i).attr('id');
            var weight_value = $("#" + weight_id).val();
            var weight_data = $("#weight" + i).val();
            if (weight_id == 'weight' + i) {
                var arm_id = 'arm' + i;
                var arm_value = $("#" + arm_id).val();
                var moment_id = 'moment' + i;
                var moment_val = (weight_value * arm_value);
                if (moment_val) {
                    $("#" + moment_id).val(moment_val.toFixed(2));
                }
            }
            var weight_data = $("#weight" + i).val();
            var moment_data = $("#moment" + i).val();

            if (weight_data == '') {
                weight_data = Number(0);
            }
            if (!moment_data) {
                moment_data = Number(0);
            }

            zero_fuel_weight = parseInt(zero_fuel_weight) + parseInt(weight_data);
            zero_fuel_moment = (parseFloat(zero_fuel_moment) + parseFloat(moment_data)).toFixed(2);
        }

        $("#moment20").val(zero_fuel_moment);
        var take_off_fuel_weight2 = zero_fuel_weight + take_off_fuel_weight1;
        var landing_fuel_weight2 = zero_fuel_weight + landing_fuel_weight1;

        var take_off_fuel_moment1 = ($("#moment18").val()) ? parseFloat(take_off_fuel_moment1) : Number(0);
        var landing_fuel_moment1 = ($("#moment19").val()) ? parseFloat(landing_fuel_moment1) : Number(0);
        var zero_fuel_moment = ($("#moment20").val()) ? parseFloat($("#moment20").val()) : Number(0);

        var take_off_fuel_moment2 = (take_off_fuel_moment1 + zero_fuel_moment).toFixed(2);
        var landing_fuel_moment2 = (landing_fuel_moment1 + zero_fuel_moment).toFixed(2);

        var zero_fuel_arm = ((zero_fuel_moment / zero_fuel_weight)).toFixed(2);
        var take_off_fuel_arm = ((take_off_fuel_moment2 / take_off_fuel_weight2)).toFixed(2);
        var landing_fuel_arm = ((landing_fuel_moment2 / landing_fuel_weight2)).toFixed(2);

        var zero_fuel_cg = (((zero_fuel_arm - 264.57) * 100) / 80.71).toFixed(2);
        var take_off_fuel_cg = (((take_off_fuel_arm - 264.57) * 100) / 80.71).toFixed(2);
        var landing_fuel_cg = (((landing_fuel_arm - 264.57) * 100) / 80.71).toFixed(2);
        var curve_color = 'blue';

        $("#weight20").val(zero_fuel_weight);
        $("#weight21").val(take_off_fuel_weight2);
        $("#weight22").val(landing_fuel_weight2);

        $("#moment21").val(take_off_fuel_moment2);
        $("#moment22").val(landing_fuel_moment2);

        $("#arm20").val(zero_fuel_arm);
        $("#arm21").val(take_off_fuel_arm);
        $("#arm22").val(landing_fuel_arm);

        $("#cg20").val(zero_fuel_cg);
        $("#cg21").val(take_off_fuel_cg);
        $("#cg22").val(landing_fuel_cg);


        var y1 = (zero_fuel_weight);
        var y2 = (landing_fuel_weight2);
        var y3 = (take_off_fuel_weight2);

        var x1 = parseFloat(zero_fuel_cg);
        var x2 = parseFloat(landing_fuel_cg);
        var x3 = parseFloat(take_off_fuel_cg);

//        z.unshift([x1, y1]);
//        z.unshift([x2, y2]);
//        z.push([x3, y3]);
        var lr_data2 = [
            [x2, y2],
            [x3, y3],
        ];

        console.log(lr_data2)
        $("#Div1").highcharts({
            exporting: {
                allowHTML: true,
                chartOptions: {// specific options for the exported image
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: false
                            }
                        }
                    },
                    legend: {
                        enabled: true,
                        verticalAlign: 'bottom',
                        align: 'right',
                        y: 0
                    },
                    title: {
                        text: '<span style="font-size:7px; font-weight:bold;">Date: ' + $("#current_date2").val() + '<span style="color:white">.........</span></span>         '
                                + '<span style="font-size:7px;font-weight:bold;">From: ' + $("#departure_aerodrome").val() + '<span style="color:white">.........</span></span>             '
                                + '<span style="font-size:7px;font-weight:bold; ">To: ' + $("#destination_aerodrome").val() + '</span>'
                        ,
                        useHTML: true,
                        y: 100,
                        align: 'center',
                        x: -27,
                    },
                    subtitle: {
                    },
                    margin: 0,
                    chart: {
//                renderTo: 'Div1',

                        spacingBottom: 113,
                        spacingLeft: 63,
                        spacingRight: 55,
                        marginTop: 118,
                        marginRight: 80,
                        width: 360,
                        height: 550,
                        events: {
                            load: function () {
                                this.renderer.image('http://privateflight.co.in/media/lnt-8.png', '-12', '23', 350, 497)
                                        .add();

                            }
                        }
                    },
                },
                scale: 3,
                fallbackToExportServer: false,
//                sourceWidth: 1000,
//            sourceHeight: 200,
            },
            chart: {
//                renderTo: 'Div1',               
                width: 362,
                height: 508,
                marginTop: 74,
                marginRight: 42,
                spacingLeft: 42,
                spacingBottom: 34,
                events: {
                    load: function () {
                        this.renderer.image('http://privateflight.co.in/media/vtajj_graph.png', '-25', '19', 357, 500)
                                .add();

                    }
                }
            },
            credits: {
                enabled: false
            },
            navigation: {
                buttonOptions: {
                    enabled: false
                }
            },
            title: {
                showInLegend: false,
                text: 'Load & Trim Graph',
                x: -20 //center
            },
            xAxis: {
                lineColor: 'transparent',
//                    categories: [14,'15', '17', '19', '21', '23', '25', '27', '29', '31', '33', '35', '37', '39']
                min: 10,
                max: 50,
                tickInterval: 10,
//                tickPositions: [15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39],
                tickPosition: 'inside',
                tickLength: 0,
                labels: {
                    // y: 14,
                    style: {
                        color: '#0000',
                        fontSize: '9px'
                    },
                    y: 13,
                    enabled: false
                }
            },
            yAxis: {
                lineColor: 'transparent',
                gridLineWidth: 0,
                min: 10000,
                max: 19200,
                tickInterval: 400,
                title: {
                    text: ''

                },
                plotLines: [{
                        value: 0,
                        width: 10,
                        color: '#808080'
                    }],
                labels: {
//                        format: '{value:.2f}'
                    x: -10,
                    style: {
                        color: 'black',
                        fontSize: '9px'
                    },
                    enabled: false
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'top',
                borderWidth: 0
            },
            plotOptions: {
                spline: {
                    marker: {
                        enabled: false
                    }
                },
                series: {
//                        dataLabels: {
//                            enabled: true,
//                            format: '%MAC:{point.x:,.2f},{point.y:,.3f},'
//                        }
                    states: {
                        hover: {
                            enabled: false
                        }
                    }
                }
            },
            tooltip: {
//                formatter: function () {
//                    return '<b>' + this.series.name + '</b><br>' + ' %MAC: ' + this.key + ', Fuel: ' + Math.round(this.y * 1000);
//                },
                enabled: false
            },
            series: [{
                    showInLegend: false,
                    name: 'ZFW',
                    type: 'spline',
                    color: curve_color,
                    "marker": {
                        "symbol": "circle"
                    },
                    lineWidth: 1.1,
//                        pointInterval: 1000,
                    data: lr_data2
                }
            ]
        });
    });

    $(".label_radio").on('click', function (e) {
        var zero_fuel_weight = Number(0);
        var take_off_fuel_weight1 = ($("#weight18").val()) ? parseInt($("#weight18").val()) : Number(0);
        var landing_fuel_weight1 = ($("#weight19").val()) ? parseInt($("#weight19").val()) : Number(0);
        var zero_fuel_moment = Number(0);

        var label_text = $.trim($(this).text());
        var input_name = $(this).children('input[type="checkbox"]').attr('name');
        var id = $(this).closest('label').attr('data-label');
        var value = $(this).children('input[type="checkbox"]:checked').val();

        var bags_weight = ($("#weight17").val()) ? parseInt($("#weight17").val()) : Number(0);
        var pax_count = Number(0);

        $(".save_lnt_data").addClass('disabled');
        $(".graph_print").addClass('disabled');

        $("#zero_fuel_valid").removeClass('lt-c-error');
        $("#take_off_valid").removeClass('lt-c-error');
        $("#landing_valid").removeClass('lt-c-error');

        $("#max_zero_fuel").removeClass('max_zero_fuel');
        $("#max_landing_fuel").removeClass('max_landing_fuel');
        $("#max_takeoff_fuel").removeClass('max_takeoff_fuel');

        $("#zero_fuel_valid .lt-bg-red").addClass('lt-bg-grey');
        $("#take_off_valid .lt-bg-red").addClass('lt-bg-lgreen');
        $("#landing_valid .lt-bg-red").addClass('lt-bg-skyblue');

        $("#zero_fuel_valid .lt-bg-red").removeClass('lt-bg-red');
        $("#take_off_valid .lt-bg-red").removeClass('lt-bg-red');
        $("#landing_valid .lt-bg-red").removeClass('lt-bg-red');
        $("#weight23").removeClass("lt-bg-red");

        if (input_name == 'jump') {
            $("#" + id).val(value);
        } else {
            if (label_text == 'Adult') {
                $("#" + id).val(value);
            } else if (label_text == 'Child') {
                $("#" + id).val(value);
            } else {
//                $("#pax6").prop("checked", true)
                $("#" + id).val(value);
            }
        }

        for (var i = 4; i <= 16; i++) {
            var weight_id = $('#weight' + i).attr('id');
            var weight_value = $("#" + weight_id).val();

            if (weight_id == 'weight' + i) {
                var arm_id = 'arm' + i;
                var arm_value = $("#" + arm_id).val();
                var moment_id = 'moment' + i;
                var moment_val = ((weight_value * arm_value));
                if (moment_val && weight_value) {
                    $("#" + moment_id).val(moment_val.toFixed(2));
                } else {
                    $("#" + moment_id).val('');
                }
            }
            var weight_data = $("#weight" + i).val();
            var moment_data = $("#moment" + i).val();

            if (weight_data == '') {
                weight_data = Number(0);
            } else {
                pax_count++;
            }
            if (!moment_data) {
                moment_data = Number(0);
            }

            zero_fuel_weight = parseInt(zero_fuel_weight) + parseInt(weight_data);
            zero_fuel_moment = (parseFloat(zero_fuel_moment) + parseFloat(moment_data)).toFixed(2);
        }
        pax_count = pax_count - 2;
        bags_weight = (pax_count * 30) + 20;

        $("#weight17").val(bags_weight);
        bags_weight = ($("#weight17").val()) ? parseInt($("#weight17").val()) : Number(0);
        var bags_moment = ((bags_weight * parseInt($("#arm17").val()))).toFixed(2);
        $("#moment17").val(bags_moment);

        zero_fuel_weight = parseInt(zero_fuel_weight) + parseInt(bags_weight);
        zero_fuel_moment = (parseFloat(zero_fuel_moment) + parseFloat(bags_moment)).toFixed(2);
        $("#moment20").val(zero_fuel_moment);
        var take_off_fuel_weight2 = zero_fuel_weight + take_off_fuel_weight1;
        var landing_fuel_weight2 = zero_fuel_weight + landing_fuel_weight1;

        var take_off_fuel_moment1 = ($("#moment18").val()) ? parseFloat(take_off_fuel_moment1) : Number(0);
        var landing_fuel_moment1 = ($("#moment19").val()) ? parseFloat(landing_fuel_moment1) : Number(0);
        var zero_fuel_moment = ($("#moment20").val()) ? parseFloat($("#moment20").val()) : Number(0);

        var take_off_fuel_moment2 = take_off_fuel_moment1 + zero_fuel_moment;
        var landing_fuel_moment2 = landing_fuel_moment1 + zero_fuel_moment;

        var zero_fuel_arm = ((zero_fuel_moment / zero_fuel_weight)).toFixed(2);
        var take_off_fuel_arm = ((take_off_fuel_moment2 / take_off_fuel_weight2)).toFixed(2);
        var landing_fuel_arm = ((landing_fuel_moment2 / landing_fuel_weight2)).toFixed(2);

        var zero_fuel_cg = (((zero_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var take_off_fuel_cg = (((take_off_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var landing_fuel_cg = (((landing_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);

        $("#weight20").val(zero_fuel_weight);

//        $("#weight18").val('');
        $("#arm18").val('');
        $("#moment18").val('');

        $("#arm19").val('');
        $("#moment19").val('');

        $("#arm19").val('');
        $("#moment19").val('');

        $("#moment21").val('');
        $("#moment22").val('');

        $("#weight21").val('');
        $("#weight22").val('');
        $("#weight23").val('');

        $("#arm21").val('');
        $("#arm22").val('');

        $("#cg21").val('');
        $("#cg22").val('');

        $("#arm20").val(zero_fuel_arm);
        $("#cg20").val(zero_fuel_cg);

        var chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'Div1',
                width: 362,
                height: 508,
                marginTop: 74,
                marginRight: 42,
                spacingLeft: 42,
                spacingBottom: 34,
                events: {
                    load: function () {
                        this.renderer.image('http://privateflight.co.in/media/vtajj_graph.png', '-25', '19', 357, 500)
                                .add();

                    }
                }

            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Load & Trim Graph',
                x: -20 //center
            },
            xAxis: {
                lineColor: 'transparent',
//                    categories: [14,'15', '17', '19', '21', '23', '25', '27', '29', '31', '33', '35', '37', '39']
                min: 14,
                max: 40,
                tickInterval: 1,
                tickLength: 0,
                tickPosition: 'inside',
                tickPositions: [15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39],
                labels: {
                    style: {
                        fontSize: '9px'
                    },
                    enabled: false
                }
            },
            yAxis: {
                lineColor: 'transparent',
                min: 26,
                max: 50,
                tickInterval: 2,
                lineWidth: 1,
                title: {
                    text: ''

                },
                plotLines: [{
                        value: 0,
                        width: 10,
                        color: '#808080'
                    }],
                labels: {
                    style: {
                        fontSize: '9px'
                    },
                    enabled: false
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'top',
                borderWidth: 0
            },
//            tooltip: {
//                pointFormat: ' '
//            },

            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br>' + 'Fuel: ' + this.key + ', %MAC ' + this.y;
                }
            },
            series: [
                {
                    name: 'ZFW',
                    type: 'spline',
                    color: '#00ff00',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                },
                {
                    name: 'TOW',
                    type: 'spline',
                    color: 'gray',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                },
                {
                    name: 'LW',
                    type: 'spline',
                    color: 'blue',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                }
            ]
        });

    });

    $(".bags_fc").on('keyup', function (e) {
        var zero_fuel_weight = Number(0);
        var take_off_fuel_weight1 = ($("#weight18").val()) ? parseInt($("#weight18").val()) : Number(0);
        var landing_fuel_weight1 = ($("#weight19").val()) ? parseInt($("#weight19").val()) : Number(0);
        var zero_fuel_moment = Number(0);

        var label_text = $.trim($(this).text());
        var input_name = $(this).children('input[type="checkbox"]').attr('name');
        var id = $(this).closest('label').attr('data-label');
        var value = $('input[type="checkbox"]:checked').val()

        var bags_weight = ($("#weight17").val()) ? parseInt($("#weight17").val()) : Number(0);
        var pax_count = Number(0);

        $("#zero_fuel_valid").removeClass('lt-c-error');
        $("#take_off_valid").removeClass('lt-c-error');
        $("#landing_valid").removeClass('lt-c-error');

        $("#max_zero_fuel").removeClass('max_zero_fuel');
        $("#max_landing_fuel").removeClass('max_landing_fuel');
        $("#max_takeoff_fuel").removeClass('max_takeoff_fuel');

        $("#zero_fuel_valid .lt-bg-red").addClass('lt-bg-grey');
        $("#take_off_valid .lt-bg-red").addClass('lt-bg-lgreen');
        $("#landing_valid .lt-bg-red").addClass('lt-bg-skyblue');

        $("#zero_fuel_valid .lt-bg-red").removeClass('lt-bg-red');
        $("#take_off_valid .lt-bg-red").removeClass('lt-bg-red');
        $("#landing_valid .lt-bg-red").removeClass('lt-bg-red');
        $("#weight23").removeClass("lt-bg-red");

        if (input_name == 'jump') {
            if (label_text == 'Yes') {
                $("#" + id).val('170');
            } else {
                $("#" + id).val('');
            }
        } else {
            if (label_text == 'Adult') {
                $("#" + id).val('170');
            } else if (label_text == 'Child') {
                $("#" + id).val('77');
            } else {
//                $("#pax6").prop("checked", true)
                $("#" + id).val('192');
            }
        }

        for (var i = 4; i <= 17; i++) {
            var weight_id = $('#weight' + i).attr('id');
            var weight_value = $("#" + weight_id).val();
//            var weight_data = $("#weight" + i).val();
            if (weight_id == 'weight' + i) {
                var arm_id = 'arm' + i;
                var arm_value = $("#" + arm_id).val();
                var moment_id = 'moment' + i;
                var moment_val = ((weight_value * arm_value));
                if (moment_val) {
                    $("#" + moment_id).val(moment_val.toFixed(2));
                }
            }
            var weight_data = $("#weight" + i).val();
            var moment_data = $("#moment" + i).val();

            if (weight_data == '') {
                weight_data = Number(0);
            } else {
                pax_count++;
            }
            if (!moment_data) {
                moment_data = Number(0);
            }

            zero_fuel_weight = parseInt(zero_fuel_weight) + parseInt(weight_data);
            zero_fuel_moment = (parseFloat(zero_fuel_moment) + parseFloat(moment_data)).toFixed(2);
        }

        $("#moment20").val(zero_fuel_moment);

        var take_off_fuel_weight2 = zero_fuel_weight + take_off_fuel_weight1;
        var landing_fuel_weight2 = zero_fuel_weight + landing_fuel_weight1;

        var take_off_fuel_moment1 = ($("#moment18").val()) ? parseFloat(take_off_fuel_moment1) : Number(0);
        var landing_fuel_moment1 = ($("#moment19").val()) ? parseFloat(landing_fuel_moment1) : Number(0);
        var zero_fuel_moment = ($("#moment20").val()) ? parseFloat($("#moment20").val()) : Number(0);

        var take_off_fuel_moment2 = take_off_fuel_moment1 + zero_fuel_moment;
        var landing_fuel_moment2 = landing_fuel_moment1 + zero_fuel_moment;

        var zero_fuel_arm = ((zero_fuel_moment / zero_fuel_weight)).toFixed(2);
        var take_off_fuel_arm = ((take_off_fuel_moment2 / take_off_fuel_weight2)).toFixed(2);
        var landing_fuel_arm = ((landing_fuel_moment2 / landing_fuel_weight2)).toFixed(2);

        var zero_fuel_cg = (((zero_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var take_off_fuel_cg = (((take_off_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var landing_fuel_cg = (((landing_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);

        $("#weight20").val(zero_fuel_weight);

        $("#arm18").val('');
        $("#moment18").val('');

        $("#arm19").val('');
        $("#moment19").val('');

        $("#arm19").val('');
        $("#moment19").val('');

        $("#moment21").val('');
        $("#moment22").val('');

        $("#weight21").val('');
        $("#weight22").val('');
        $("#weight23").val('');

        $("#arm21").val('');
        $("#arm22").val('');

        $("#cg21").val('');
        $("#cg22").val('');

        $("#arm20").val(zero_fuel_arm);
        $("#cg20").val(zero_fuel_cg);

        var chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'Div1',
                width: 362,
                height: 508,
                marginTop: 74,
                marginRight: 42,
                spacingLeft: 42,
                spacingBottom: 34,
                events: {
                    load: function () {
                        this.renderer.image('http://privateflight.co.in/media/vtajj_graph.png', '-25', '19', 357, 500)
                                .add();

                    }
                }
            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Load & Trim Graph',
                x: -20 //center
            },
            xAxis: {
                lineColor: 'transparent',
//                    categories: [14,'15', '17', '19', '21', '23', '25', '27', '29', '31', '33', '35', '37', '39']
                min: 14,
                max: 40,
                tickInterval: 1,
                tickPosition: 'inside',
                tickLength: 0,
                tickPositions: [15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39],
                labels: {
                    style: {
                        fontSize: '9px'
                    },
                    y: 5,
                    enabled: false
                }
            },
            yAxis: {
                lineColor: 'transparent',
                min: 26,
                max: 50,
                tickInterval: 2,
                lineWidth: 1,
                title: {
                    text: ''

                },
                plotLines: [{
                        value: 0,
                        width: 10,
                        color: '#808080'
                    }],
                labels: {
//                        format: '{value:.2f}',
                    style: {
                        fontSize: '9px'
                    },
                    x: -10,
                    enabled: false
                }
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'top',
                borderWidth: 0
            },
//            tooltip: {
//                pointFormat: ' '
//            },

            plotOptions: {
                spline: {
                    marker: {
                        enabled: true
                    }
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br>' + 'Fuel: ' + this.key + ', %MAC ' + this.y;
                }
            },
            series: [
                {
                    name: 'ZFW',
                    type: 'spline',
                    color: '#00ff00',
                    "marker": {
                        "symbol": "circle"
                    },
                    data: [0, 0],
                },
                {
                    name: 'TOW',
                    type: 'spline',
                    color: 'gray',
                    "marker": {
                        "symbol": "circle"
                    },
                    data: [0, 0],
                },
                {
                    name: 'LW',
                    type: 'spline',
                    color: 'blue',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: [0, 0],
                }
            ]
        });

    });

    $("#weight16").on('keyup', function () {
        var fc = $(this).val();
        $(this).css('border', 'lightgrey 1px solid');
    });

    $("#weight17").on('keyup', function () {
        var bags = $(this).val();
        $(this).css('border', 'lightgrey 1px solid');
        if (bags < 20) {
            $(this).css('border', 'red 1px solid');
            return false;
        } else {
            $(this).css('border', 'lightgrey 1px solid');
        }
    });

    $("#weight18").on('keyup', function () {
        var take_off_fuel = $(this).val();
        var landing_fuel = $("#weight19").val();
        if (take_off_fuel.length >= 4) {
            $(this).css('border', 'lightgrey 1px solid');
        } else {
            $(this).css('border', 'red 1px solid');
        }
//        if (parseInt(landing_fuel) < parseInt(take_off_fuel) && take_off_fuel.length >= 4 && landing_fuel.length >= 4) {
//            $("#weight19").css('border', 'lightgrey 1px solid');
//            $(".calculate_lnt").removeAttr('disabled');
//        } else {
//            $("#weight19").css('border', 'red 1px solid');
//            $(".calculate_lnt").attr('disabled', 'disabled');
//            return false;
//        }

    });

    $("#weight19").on('keyup', function () {
        var landing_fuel = $(this).val();
        var take_off_fuel = $("#weight18").val();
        if (landing_fuel.length >= 4) {
            $(this).css('border', 'lightgrey 1px solid');
        } else {
            $(this).css('border', 'red 1px solid');
        }
//        if (parseInt(landing_fuel) < parseInt(take_off_fuel) && take_off_fuel.length >= 4 && landing_fuel.length >= 4) {
//            $("#weight19").css('border', 'lightgrey 1px solid');
//            $(".calculate_lnt").removeAttr('disabled');
//        } else {
//            $("#weight19").css('border', 'red 1px solid');
//            $(".calculate_lnt").attr('disabled', 'disabled');
//            return false;
//        }
    });

    $("input:checkbox").on('click mouseenter', function () {
        var group = "input:checkbox[name='" + $(this).attr("name") + "']:checked";
        var count = $(group).length;
        var not_checked_id = $("input:checkbox[name='" + $(this).attr("name") + "']:not(:checked)");

        if (count == 1) {
            $(not_checked_id).attr('disabled', 'disabled');
        } else {
            $("input:checkbox[name='" + $(this).attr("name") + "']").removeAttr('disabled')
        }
    });

    /* --------- aeroplane js ---------*/
    var grph_ht = $("#Div1").height();
    $(".aeroplane_div").css('height', (grph_ht - 50));

    $(".seats li.front_seatbg").click(function () {
        $(this).toggleClass("front_seatbg_selected front_seatbg");
    });
    $(".seats li.back_seatbg").click(function () {
        $(this).toggleClass("back_seatbg_selected back_seatbg");
    });
    $(".seats li.rotate_seatbg").click(function () {
        $(this).toggleClass("rotate_seatbg_selected rotate_seatbg");
    });
    $(".seats li").on('click', function () {
        var spanval = $(this).children().text();
        console.log(spanval);
//        alert(spanval);
    });

    $("#departure_time").on('keyup', function () {
        var departure_time = $(this).val();
        if (departure_time == '' || departure_time.length < 4) {
            $(this).css('border', 'red 1px solid');
        } else {
            $(this).css('border', 'lightgrey 1px solid');
        }
    });

    $(".print_lnt").on('click', function () {
        var data = $('form[id="lnt_form"]').serialize();
        var no_of_pax = $('.pax_checkbox input:checkbox:checked').length;
        var jump = $("input:checkbox[id='jump_yes']").length;

        data += '&no_of_pax=' + no_of_pax + '&jump=' + jump
        console.log('data', data);
//        window.location = base_url + "/postlnt/print_lnt?" + data
        window.open(base_url + "/postlnt/print_lnt?" + data, '_blank');
    });

    $(".save_lnt_data").on('click', function (e) {
        var data = $('form[id="lnt_form"]').serialize();
        var url = $(this).attr('data-url');
        var no_of_pax = $('.pax_checkbox input:checkbox:checked').length;
        var jump = $("input:checkbox[id='jump_yes']").length;

        data += '&no_of_pax=' + no_of_pax + '&jump=' + jump + '&landing_fuel_trim_setting' + landing_fuel_trim_setting
        var landing_fuel_trim_setting = $("#landing_fuel_trim_setting").val();

        if ($(this).hasClass('disabled')) {
            e.preventDefault();
            return false;
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
                if (data.id) {
                    window.open(base_url + "/postlnt/print_lnt?id=" + data.id + '&landing_fuel_trim_setting=' + landing_fuel_trim_setting, '_blank');
                }

            },
            async: false,
            error: function (jqXHR, textStatus, errorThrown) {

            },
        });
    });

    $(".lnt_validation").on('keyup', function () {
        var id = $(this).attr('id');
        var value = $(this).val();
        if (id == 'weight18' || id == 'weight19') {
            if (value.length == 3) {
                if (value[2] == 0 || value[2] == 5) {
                    return true;
                } else {
                    $(this).val(value[0] + value[1]);
                }
            }
            if (value.length == 4) {
                if (value[3] == 0) {
                    return true;
                } else {
                    $(this).val(value[0] + value[1] + value[2] + '0');
                }
            }
        }
        $(".save_lnt_data").addClass('disabled');
        $(".graph_print").addClass('disabled')
        lnt_validation();
    });

});