$(function () {

    $(document).on("change", "#range_slider", function () {
        var number = $("#range_slider").val();
        $("#loader_slider").html("<a href='#'><i class=fa fa-spinner> Loading ...</i></a>")
        switch (number) {
            case number:
                $("#color-bar").css('width', number + "0%");
                $("#loader_slider").html("");
                break;
            default :
                break;
        }
        $("#passengers").val(number);
    });

    $(window).on('load', function () {
        $("#weight18").css('border', 'red 1px solid');
        $("#weight19").css('border', 'red 1px solid');

//        var imageUrl = 'media/images/lnt.png';
//        
//        $('.highcharts-container').css('background-image', 'url(' + imageUrl + ')');

    });

    $(document).on('click', '.calculate_lnt', function () {
        var zero_fuel_weight = Number(0);
        var take_off_fuel_weight1 = ($("#weight18").val()) ? parseInt($("#weight18").val()) : Number(0);
        var landing_fuel_weight1 = ($("#weight19").val()) ? parseInt($("#weight19").val()) : Number(0);

        var zero_fuel_moment = Number(0);
        var url = base_url + "/lnt";
        var data = {'take_off_fuel_weight1': take_off_fuel_weight1, 'landing_fuel_weight1': landing_fuel_weight1};

        var take_off_fuel_moment1 = Number(0);
        var landing_fuel_moment1 = Number(0);
        var take_off_fuel_arm1 = Number(0);
        var landing_fuel_arm1 = Number(0);
        var validation = true;

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
                    take_off_fuel_arm1 = data.take_off_fuel_arm1;
                    landing_fuel_arm1 = data.landing_fuel_arm1;

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
                var moment_val = (weight_value * arm_value) / 1000;
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

        var zero_fuel_arm = ((zero_fuel_moment / zero_fuel_weight) * 1000).toFixed(2);
        var take_off_fuel_arm = ((take_off_fuel_moment2 / take_off_fuel_weight2) * 1000).toFixed(2);
        var landing_fuel_arm = ((landing_fuel_moment2 / landing_fuel_weight2) * 1000).toFixed(2);

        var zero_fuel_cg = (((zero_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var take_off_fuel_cg = (((take_off_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var landing_fuel_cg = (((landing_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);


        if (zero_fuel_weight > 32000) {
            $("#zero_fuel_valid").addClass('lt-c-error');
            $("#max_zero_fuel").addClass('max_zero_fuel');
            $("#zero_fuel_valid .lt-bg-grey").addClass('lt-bg-red');
            $("#zero_fuel_valid .lt-bg-grey").removeClass('lt-bg-grey');
            var zero_fuel_color = 'red';
        } else {
            $("#zero_fuel_valid").removeClass('lt-c-error');
            $("#max_zero_fuel").removeClass('max_zero_fuel');
            $("#zero_fuel_valid .lt-bg-red").addClass('lt-bg-grey');
            $("#zero_fuel_valid .lt-bg-red").removeClass('lt-bg-red');
            var zero_fuel_color = 'darkgrey';
        }

        if (take_off_fuel_weight2 > 48200) {
            $("#max_takeoff_fuel").addClass('max_takeoff_fuel');
            $("#take_off_valid").addClass('lt-c-error');
            var take_off_fuel_color = 'red';
            $("#take_off_valid .lt-bg-lgreen").addClass('lt-bg-red');
            $("#take_off_valid .lt-bg-lgreen").removeClass('lt-bg-lgreen');
        } else {
            $("#take_off_valid").removeClass('lt-c-error');
            $("#takeoff-max-border").removeClass('max_takeoff_fuel');
            $("#take_off_valid .lt-bg-red").addClass('lt-bg-lgreen');
            $("#take_off_valid .lt-bg-red").removeClass('lt-bg-red');
            var take_off_fuel_color = '#00ff00';
        }

        if (landing_fuel_weight2 > 38000) {
            $("#max_landing_fuel").addClass('max_landing_fuel');
            $("#landing_valid").addClass('lt-c-error');
            $("#landing_valid .lt-bg-skyblue").addClass('lt-bg-red');
            $("#landing_valid .lt-bg-skyblue").removeClass('lt-bg-skyblue');
            var landing_fuel_color = 'red';
        } else {
            $("#landing_valid").removeClass('lt-c-error');
            $("#max_landing_fuel").removeClass('max_landing_fuel');
            $("#landing_valid .lt-bg-red").addClass('lt-bg-skyblue');
            $("#landing_valid .lt-bg-red").removeClass('lt-bg-red');
            var landing_fuel_color = '#0fa0db';
        }

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

        var take_off_fuel_cg_url = $("#cg21").attr('data-url');
//        $("#item23").val("Loading please wait ...");
        if (take_off_fuel_weight1 && landing_fuel_weight1) {
            $.ajax({
                url: take_off_fuel_cg_url,
                data: {'take_off_fuel_cg': take_off_fuel_cg},
                type: 'POST',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data, textStatus, jqXHR) {
                    var trim_setting = data.trim;
                    $("#weight23").val(trim_setting);
                },
                async: false,
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        }


        var y1 = (zero_fuel_weight / 1000);
        var y3 = (take_off_fuel_weight2 / 1000);
        var y2 = (landing_fuel_weight2 / 1000);

        var x1 = parseFloat(zero_fuel_cg);
        var x3 = parseFloat(take_off_fuel_cg);
        var x2 = parseFloat(landing_fuel_cg);

        var lr_data = [
            [x1, y1],
            [33, 28],
            [x2, y2],
            [33, 43],
            [x3, y3],
        ];

//        console.log('lr_data',lr_data)

        var chart1 = new Highcharts.Chart({
            chart: {
                renderTo: 'Div1',
                width: 360,
                height: 510

            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Load Trim Graph',
                x: -20 //center
            },
            xAxis: {
                lineColor: 'black',
//                    categories: [14,'15', '17', '19', '21', '23', '25', '27', '29', '31', '33', '35', '37', '39']
                min: 14,
                max: 40,
                tickInterval: 1,
                tickPositions: [14, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39],
            },
            yAxis: {
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
//                        format: '{value:.2f}'
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
                        enabled: true
                    }
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + '</b><br>' + ' %MAC: ' + this.key + ', Fuel: ' + Math.round(this.y * 1000);
                }
            },
            series: [{
                    name: 'ZFW',
                    type: 'spline',
                    color: 'blue',
                    "marker": {
                        "symbol": "circle"
                    },
//                        pointInterval: 1000,
                    data: lr_data
                }]
//            series: [{
//                    name: 'ZFW',
//                    type: 'scatter',
//                    color: zero_fuel_color,
//                    "marker": {
//                        "symbol": "circle"
//                    },
////                        pointInterval: 1000,
//                    data: [lr_data[0]]
//                },
//                {
//                    name: 'TOW',
//                    type: 'scatter',
//                    color: take_off_fuel_color,
//                    "marker": {
//                        "symbol": "circle"
//                    },
////                        pointInterval: 1000,
//                    data: [lr_data[1]]
//                },
//                {
//                    name: 'LW',
//                    type: 'scatter',
//                    color: landing_fuel_color,
//                    "marker": {
//                        "symbol": "circle"
//                    },
////                        pointInterval: 1000,
//                    data: [lr_data[2]]
//                }
//                    {
//                        name: 'Alt Fuel',
//                        type: 'spline',
//                        color: 'green',
////                        pointInterval: 1000,
//                        data: [
//                            [38.3, 26.8],
//                            [33, 27.2],
//                            [29, 28]
//
//                        ]
//                    }

//            ]
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
        console.log('value', value)
        var bags_weight = ($("#weight17").val()) ? parseInt($("#weight17").val()) : Number(0);
        var pax_count = Number(0);

        if (parseInt(landing_fuel_weight1) < parseInt(take_off_fuel_weight1) && $("#weight18").val().length >= 4) {
            $("#weight18").css('border', 'lightgrey 1px solid');
            $(".calculate_lnt").removeAttr('disabled');
        } else {
            $("#weight18").css('border', 'red 1px solid');
            $(".calculate_lnt").attr('disabled', 'disabled');
        }

        if (parseInt(landing_fuel_weight1) < parseInt(take_off_fuel_weight1) && $("#weight19").val().length >= 4) {
            $("#weight19").css('border', 'lightgrey 1px solid');
            $(".calculate_lnt").removeAttr('disabled');
        } else {
            $("#weight19").css('border', 'red 1px solid');
            $(".calculate_lnt").attr('disabled', 'disabled');
        }

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

        if (input_name == 'jump') {
//            if (label_text == 'Yes') {
            $("#" + id).val(value);
//            } else {
//                $("#" + id).val(value);
//            }
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

        for (var i = 4; i <= 17; i++) {
            var weight_id = $('#weight' + i).attr('id');
            var weight_value = $("#" + weight_id).val();
//            var weight_data = $("#weight" + i).val();
            if (weight_id == 'weight' + i) {
                var arm_id = 'arm' + i;
                var arm_value = $("#" + arm_id).val();
                var moment_id = 'moment' + i;
                var moment_val = ((weight_value * arm_value) / 1000);
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
        pax_count = pax_count - 3;
        var bags_weight = (pax_count * 30) + 20;
        $("#moment20").val(zero_fuel_moment);
        $("#weight17").val(bags_weight);
        var take_off_fuel_weight2 = zero_fuel_weight + take_off_fuel_weight1;
        var landing_fuel_weight2 = zero_fuel_weight + landing_fuel_weight1;

        var take_off_fuel_moment1 = ($("#moment18").val()) ? parseFloat(take_off_fuel_moment1) : Number(0);
        var landing_fuel_moment1 = ($("#moment19").val()) ? parseFloat(landing_fuel_moment1) : Number(0);
        var zero_fuel_moment = ($("#moment20").val()) ? parseFloat($("#moment20").val()) : Number(0);

        var take_off_fuel_moment2 = take_off_fuel_moment1 + zero_fuel_moment;
        var landing_fuel_moment2 = landing_fuel_moment1 + zero_fuel_moment;

        var zero_fuel_arm = ((zero_fuel_moment / zero_fuel_weight) * 1000).toFixed(2);
        var take_off_fuel_arm = ((take_off_fuel_moment2 / take_off_fuel_weight2) * 1000).toFixed(2);
        var landing_fuel_arm = ((landing_fuel_moment2 / landing_fuel_weight2) * 1000).toFixed(2);

        var zero_fuel_cg = (((zero_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var take_off_fuel_cg = (((take_off_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var landing_fuel_cg = (((landing_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);

        $("#weight20").val(zero_fuel_weight);

//        $("#weight18").val('');
        $("#arm18").val('');
        $("#moment18").val('');

//        $("#weight19").val('');
        $("#arm19").val('');
        $("#moment19").val('');

        $("#arm19").val('');
        $("#moment19").val('');

        $("#moment21").val('');
        $("#moment22").val('');

//        $("#weight21").val(take_off_fuel_weight2);
//        $("#weight22").val(landing_fuel_weight2);


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
                width: 360,
                height: 510

            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Load Trim Graph',
                x: -20 //center
            },
            xAxis: {
                lineColor: 'black',
//                    categories: [14,'15', '17', '19', '21', '23', '25', '27', '29', '31', '33', '35', '37', '39']
                min: 14,
                max: 40,
                tickInterval: 1,
                tickPositions: [14, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39],
            },
            yAxis: {
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
//                        format: '{value:.2f}'
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
//                    {
//                        name: 'Alt Fuel',
//                        type: 'spline',
//                        color: 'green',
////                        pointInterval: 1000,
//                        data: [
//                            [38.3, 26.8],
//                            [33, 27.2],
//                            [29, 28]
//
//                        ]
//                    }

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

        if (parseInt(landing_fuel_weight1) < parseInt(take_off_fuel_weight1) && $("#weight18").val().length >= 4) {
            $("#weight18").css('border', 'lightgrey 1px solid');
            $(".calculate_lnt").removeAttr('disabled');
        } else {
            $("#weight18").css('border', 'red 1px solid');
            $(".calculate_lnt").attr('disabled', 'disabled');
        }

        if (parseInt(landing_fuel_weight1) < parseInt(take_off_fuel_weight1) && $("#weight19").val().length >= 4) {
            $("#weight19").css('border', 'lightgrey 1px solid');
            $(".calculate_lnt").removeAttr('disabled');
        } else {
            $("#weight19").css('border', 'red 1px solid');
            $(".calculate_lnt").attr('disabled', 'disabled');
        }

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
                var moment_val = ((weight_value * arm_value) / 1000);
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

        var zero_fuel_arm = ((zero_fuel_moment / zero_fuel_weight) * 1000).toFixed(2);
        var take_off_fuel_arm = ((take_off_fuel_moment2 / take_off_fuel_weight2) * 1000).toFixed(2);
        var landing_fuel_arm = ((landing_fuel_moment2 / landing_fuel_weight2) * 1000).toFixed(2);

        var zero_fuel_cg = (((zero_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var take_off_fuel_cg = (((take_off_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);
        var landing_fuel_cg = (((landing_fuel_arm - 488.025) / 92.64) * 100).toFixed(2);

        $("#weight20").val(zero_fuel_weight);

//        $("#weight18").val('');
        $("#arm18").val('');
        $("#moment18").val('');

//        $("#weight19").val('');
        $("#arm19").val('');
        $("#moment19").val('');

        $("#arm19").val('');
        $("#moment19").val('');

        $("#moment21").val('');
        $("#moment22").val('');

//        $("#weight21").val(take_off_fuel_weight2);
//        $("#weight22").val(landing_fuel_weight2);

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
                width: 360,
                height: 510

            },
            credits: {
                enabled: false
            },
            title: {
                text: 'Load Trim Graph',
                x: -20 //center
            },
            xAxis: {
                lineColor: 'black',
//                    categories: [14,'15', '17', '19', '21', '23', '25', '27', '29', '31', '33', '35', '37', '39']
                min: 14,
                max: 40,
                tickInterval: 1,
                tickPositions: [14, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39],
            },
            yAxis: {
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
//                        format: '{value:.2f}'
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
//                    {
//                        name: 'Alt Fuel',
//                        type: 'spline',
//                        color: 'green',
////                        pointInterval: 1000,
//                        data: [
//                            [38.3, 26.8],
//                            [33, 27.2],
//                            [29, 28]
//
//                        ]
//                    }

            ]
        });

    });

    $("#weight16").on('keyup', function () {
        var fc = $(this).val();
//        if (fc.length >= 1) {
        $(this).css('border', 'lightgrey 1px solid');
//        } else {
//            $(this).css('border', 'red 1px solid');
//        }
    });

    $("#weight17").on('keyup', function () {
        var bags = $(this).val();
        $(this).css('border', 'lightgrey 1px solid');
    });

    $("#weight18").on('keyup', function () {
        var take_off_fuel = $(this).val();
        var landing_fuel = $("#weight19").val();
        if (take_off_fuel.length >= 4) {
            $(this).css('border', 'lightgrey 1px solid');
        } else {
            $(this).css('border', 'red 1px solid');
        }
        if (parseInt(landing_fuel) < parseInt(take_off_fuel) && take_off_fuel.length >= 4 && landing_fuel.length >= 4) {
            $("#weight19").css('border', 'lightgrey 1px solid');
            $(".calculate_lnt").removeAttr('disabled');
        } else {
            $("#weight19").css('border', 'red 1px solid');
            $(".calculate_lnt").attr('disabled', 'disabled');
            return false;
        }

    });

    $("#weight19").on('keyup', function () {
        var landing_fuel = $(this).val();
        var take_off_fuel = $("#weight18").val();
        if (landing_fuel.length >= 4) {
            $(this).css('border', 'lightgrey 1px solid');
        } else {
            $(this).css('border', 'red 1px solid');
        }
        if (parseInt(landing_fuel) < parseInt(take_off_fuel) && take_off_fuel.length >= 4 && landing_fuel.length >= 4) {
            $("#weight19").css('border', 'lightgrey 1px solid');
            $(".calculate_lnt").removeAttr('disabled');
        } else {
            $("#weight19").css('border', 'red 1px solid');
            $(".calculate_lnt").attr('disabled', 'disabled');
            return false;
        }
    });

    $("input:checkbox").on('click mouseenter', function () {
        var group = "input:checkbox[name='" + $(this).attr("name") + "']:checked";
        var count = $(group).length;
        var not_checked_id = $("input:checkbox[name='" + $(this).attr("name") + "']:not(:checked)");
        console.log(not_checked_id)
        if (count == 1) {
            $(not_checked_id).attr('disabled', 'disabled');
        } else {
            $("input:checkbox[name='" + $(this).attr("name") + "']").removeAttr('disabled')
        }
//        $(group).attr("checked", false);
//        $(this).attr("checked", true);
    });

});