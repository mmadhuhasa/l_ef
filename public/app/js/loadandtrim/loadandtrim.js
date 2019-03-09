$(function () {
    var currentDate = $("#current_date").val();//document.getElementById("utcdate").value;

    $(".from_date").datepicker("setDate", currentDate);

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
        pax_count = pax_count - 2;
        bags_weight = (pax_count * 30) + 20;

        $("#weight17").val(bags_weight);
        bags_weight = ($("#weight17").val()) ? parseInt($("#weight17").val()) : Number(0);
        var bags_moment = ((bags_weight * parseInt($("#arm17").val())) / 1000).toFixed(2);
        zero_fuel_weight = parseInt(zero_fuel_weight) + parseInt(bags_weight);
        zero_fuel_moment = (parseFloat(zero_fuel_moment) + parseFloat(bags_moment)).toFixed(2);
        var zero_fuel_arm = ((zero_fuel_moment / zero_fuel_weight) * 1000).toFixed(2);
        $("#moment17").val(bags_moment)
        $("#moment20").val(zero_fuel_moment);
        $("#weight20").val(zero_fuel_weight);
        $("#arm20").val(zero_fuel_arm);



    });

    $(document).on('click', '.calculate_lnt', function () {
        var zero_fuel_weight = Number(0);
        var take_off_fuel_weight1 = ($("#weight18").val()) ? parseInt($("#weight18").val()) : Number(0);
        var landing_fuel_weight1 = ($("#weight19").val()) ? parseInt($("#weight19").val()) : Number(0);
        var zero_fuel_moment = Number(0);
        var url = base_url + "/postlnt";
        var data = {'take_off_fuel_weight1': take_off_fuel_weight1,
            'landing_fuel_weight1': landing_fuel_weight1,
            'zero_fuel_weight': parseInt($("#weight20").val())};
        var take_off_fuel_moment1 = Number(0);
        var landing_fuel_moment1 = Number(0);
        var take_off_fuel_arm1 = Number(0);
        var landing_fuel_arm1 = Number(0);
        var validation = true;
        var landing_fuel_increment_moment_array = [];
        var landing_fuel_increment_arm_array = [];
        var bags = $("#weight17").val();
        $(".lnt_loading2").html("Please wait ...");

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

        if (bags < 20) {
            $(this).css('border', 'red 1px solid');
            validation = false;
        } else {
            $(this).css('border', 'lightgrey 1px solid');
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
                    $(".lnt_loading2").html('');
                    take_off_fuel_moment1 = data.take_off_fuel_moment1;
                    landing_fuel_moment1 = data.landing_fuel_moment1;
                    take_off_fuel_arm1 = (data.take_off_fuel_arm1).toFixed(2);
                    landing_fuel_arm1 = (data.landing_fuel_arm1).toFixed(2);
                    landing_fuel_increment_moment_array = data.landing_fuel_increment_moment_array;
                    landing_fuel_increment_arm_array = data.landing_fuel_increment_arm_array;

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
        var zfg_x = [];
        var zfg_y = [];
        var zfg_z = [
            [38.25, 26.75431],
            [34.61, 27.09431]
        ];
        var dow_weight = parseFloat(27094.31);
        var dow_moment = parseFloat(14091.48);
        var dow_arm = '';
        var zfg_cg = '';
        var lr_data2 = [];

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
            } else {
                if (i >= 5 && i <= 15) {
                    dow_weight = dow_weight + parseInt(weight_data);
                    dow_moment = dow_moment + parseFloat(moment_data);
                    dow_arm = parseFloat((dow_moment / dow_weight) * 1000);
                    zfg_cg = (parseFloat(((dow_arm - 488.025) / 92.64) * 100)).toFixed(2);
                    zfg_y.push(dow_weight);
                    zfg_x.push(parseFloat(zfg_cg));

                }
            }
            if (!moment_data) {
                moment_data = Number(0);
            }

            zero_fuel_weight = parseInt(zero_fuel_weight) + parseInt(weight_data);
            zero_fuel_moment = (parseFloat(zero_fuel_moment) + parseFloat(moment_data)).toFixed(2);
        }
        for (var i = 0; i < zfg_x.length; i++) {
            zfg_z.push([zfg_x[i], zfg_y[i] / 1000]);
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
        var curve_color = 'blue';


        if (zero_fuel_weight > 32000) {
            $("#zero_fuel_valid").addClass('lt-c-error');
            $("#max_zero_fuel").addClass('max_zero_fuel');
            $("#zero_fuel_valid .lt-bg-grey").addClass('lt-bg-red');
            $("#zero_fuel_valid .lt-bg-grey").removeClass('lt-bg-grey');
            var zero_fuel_color = 'red';
            curve_color = 'red';
            validation = false;
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
            curve_color = 'red';
            validation = false;
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
            curve_color = 'red';
            validation = false;
        } else {
            $("#landing_valid").removeClass('lt-c-error');
            $("#max_landing_fuel").removeClass('max_landing_fuel');
            $("#landing_valid .lt-bg-red").addClass('lt-bg-skyblue');
            $("#landing_valid .lt-bg-red").removeClass('lt-bg-red');
            var landing_fuel_color = '#0fa0db';
        }

        if (take_off_fuel_weight2 <= 38000 && take_off_fuel_cg > 35) {
            curve_color = 'red';
            validation = false;
        }
        if (take_off_fuel_weight2 >= 43000 && take_off_fuel_cg > 38) {
            curve_color = 'red';
            validation = false;
        }
        if (take_off_fuel_cg > 38) {
            $("#weight23").addClass("lt-bg-red");
            validation = false;
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

        if (!validation) {
            $('.graph_print').addClass('disabled');
        } else {
            $('.graph_print').removeClass('disabled');
        }

        if (take_off_fuel_weight1 && landing_fuel_weight1) {
            $.ajax({
                url: take_off_fuel_cg_url,
                data: {'take_off_fuel_cg': take_off_fuel_cg, 'landing_fuel_cg': landing_fuel_cg},
                type: 'POST',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                success: function (data, textStatus, jqXHR) {
                    var take_off_trim_setting = data.take_off_trim_setting;
                    $("#weight23").val(take_off_trim_setting);
                    $("#landing_fuel_trim_setting").val(data.landing_fuel_trim_setting);
                    $(".save_lnt_data").removeClass('hidden');
                },
                async: false,
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
        }

        var y1 = (zero_fuel_weight / 1000);
        var y2 = (landing_fuel_weight2 / 1000);
        var y3 = (take_off_fuel_weight2 / 1000);
        var y = [];
        var x = [];
        var z = [];

        for (var i = zero_fuel_weight; i <= take_off_fuel_weight2; i += 50) {
            y.push(parseFloat(i / 1000));
        }

        $.each(landing_fuel_increment_moment_array, function (index, value) {
            var landing_fuel_increment_moment = (zero_fuel_moment + value).toFixed(2);
            var landing_fuel_increment_weight = parseInt(zero_fuel_weight) + parseInt(index);
            var landing_fuel_increment_arm = ((landing_fuel_increment_moment / landing_fuel_increment_weight) * 1000).toFixed(2);
            x.push(parseFloat((((landing_fuel_increment_arm - 488.025) / 92.64) * 100).toFixed(2)));
        });

        for (var j = 0; j < x.length; j++) {
            z.push([x[j], y[j]]);
        }

        var x1 = parseFloat(zero_fuel_cg);
        var x2 = parseFloat(landing_fuel_cg);
        var x3 = parseFloat(take_off_fuel_cg);

//        z.unshift([x1, y1]);
//        z.unshift([x2, y2]);
//        z.push([x3, y3]);
        var lr_data = z;
        var lr_data2 = [
            [x1, y1],
            [x2, y2],
            [x3, y3],
            [34.61, 27.094],
            [38.25, 26.754]
        ];
        var zfg_color = '#2cc38a';
        zfg_z.push([x1, y1]);
        var lr_data3 = zfg_z;
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
                        //  text: '<span style="font-size:9px;">Date: '+$("#date_of_flight").val() +'<span style="color:white">.........</span></span>         '                                 
                        //          +'<span style="font-size:9px;">From: '+$("#departure_aerodrome").val()  +'<span style="color:white">.........</span></span>             '                               
                        //          +'<span style="font-size:9px;">To: '+$("#destination_aerodrome").val()  +'</span>'
                        //       ,
                        // useHTML: true, 
                        // y:500
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
                marginTop: 55,
                marginRight: 32,
                spacingLeft: 14,
                spacingBottom: 19,
                events: {
                    load: function () {
                        this.renderer.image('http://privateflight.co.in/media/lntt.png', '-25', '19', 357, 500)
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
                min: 14,
                max: 40,
                tickInterval: 1,
                tickPositions: [15, 17, 19, 21, 23, 25, 27, 29, 31, 33, 35, 37, 39],
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
                    data: lr_data
                },
                {
                    showInLegend: false,
                    name: 'DOW',
                    type: 'scatter',
                    color: '#C009F9',
                    "marker": {
                        enabled: true,
                        "symbol": "circle",
                        radius: 2.5
                    },
//                        pointInterval: 1000,
                    data: [lr_data2[3]]
                },
                {
                    showInLegend: false,
                    name: 'OEW',
                    type: 'scatter',
                    color: 'black',
                    "marker": {
                        enabled: true,
                        "symbol": "circle",
                        radius: 2.5
                    },
//                        pointInterval: 1000,
                    data: [lr_data2[4]]
                },
                {
                    showInLegend: false,
                    name: 'ZFW',
                    type: 'scatter',
                    color: zero_fuel_color,
                    "marker": {
                        enabled: true,
                        "symbol": "square",
                        radius: 2.5
                    },
//                        pointInterval: 1000,
                    data: [lr_data2[0]],
                    dataLabels: {
                        enabled: true,
//                            format: 'ZERO WT C.G.({point.x:,.2f},{point.y:,.3f} lbs)'
                        formatter: function () {
                            return   this.key + ' (' + Math.round(this.y * 1000) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'},
//                        align: 'top',
//                        color: 'red',
//                        x: 10
                    }
                },
                {
                    showInLegend: false,
                    name: 'LW',
                    type: 'scatter',
                    color: landing_fuel_color,
                    "marker": {
                        enabled: true,
                        "symbol": "triangle",
                        radius: 2.5
                    },
//                        pointInterval: 1000,
                    data: [lr_data2[1]],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return  this.key + ' (' + Math.round(this.y * 1000) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'}
                    }
                },
                {
                    showInLegend: false,
                    name: 'TOW',
                    type: 'scatter',
                    color: take_off_fuel_color,
                    "marker": {
                        "symbol": "circle",
                        radius: 2.5
                    },
//                        pointInterval: 1000,
                    data: [lr_data2[2]],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return   this.key + ' (' + Math.round(this.y * 1000) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'}
//                        color: take_off_fuel_color
                    }
                },
                {
                    showInLegend: false,
                    name: 'ZFG',
                    type: 'spline',
                    color: zfg_color,
                    "marker": {
                        "symbol": "circle"
                    },
                    lineWidth: 1.1,
//                        pointInterval: 1000,
                    data: lr_data3
                },
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

//        if (parseInt(landing_fuel_weight1) < parseInt(take_off_fuel_weight1) && $("#weight18").val().length >= 4) {
//            $("#weight18").css('border', 'lightgrey 1px solid');
//            $(".calculate_lnt").removeAttr('disabled');
//        } else {
//            $("#weight18").css('border', 'red 1px solid');
//            $(".calculate_lnt").attr('disabled', 'disabled');
//        }

//        if (parseInt(landing_fuel_weight1) < parseInt(take_off_fuel_weight1) && $("#weight19").val().length >= 4) {
//            $("#weight19").css('border', 'lightgrey 1px solid');
//            $(".calculate_lnt").removeAttr('disabled');
//        } else {
//            $("#weight19").css('border', 'red 1px solid');
//            $(".calculate_lnt").attr('disabled', 'disabled');
//        }

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
        pax_count = pax_count - 2;
        bags_weight = (pax_count * 30) + 20;

        $("#weight17").val(bags_weight);
        bags_weight = ($("#weight17").val()) ? parseInt($("#weight17").val()) : Number(0);
        var bags_moment = ((bags_weight * parseInt($("#arm17").val())) / 1000).toFixed(2);
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
                marginTop: 55,
                marginRight: 43,
                spacingLeft: 14,
                spacingBottom: 19,
                events: {
                    load: function () {
                        this.renderer.image('http://privateflight.co.in/media/lntt.png', '-25', '19', 357, 500)
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

//        if (parseInt(landing_fuel_weight1) < parseInt(take_off_fuel_weight1) && $("#weight18").val().length >= 4) {
//            $("#weight18").css('border', 'lightgrey 1px solid');
//            $(".calculate_lnt").removeAttr('disabled');
//        } else {
//            $("#weight18").css('border', 'red 1px solid');
//            $(".calculate_lnt").attr('disabled', 'disabled');
//        }

//        if (parseInt(landing_fuel_weight1) < parseInt(take_off_fuel_weight1) && $("#weight19").val().length >= 4) {
//            $("#weight19").css('border', 'lightgrey 1px solid');
//            $(".calculate_lnt").removeAttr('disabled');
//        } else {
//            $("#weight19").css('border', 'red 1px solid');
//            $(".calculate_lnt").attr('disabled', 'disabled');
//        }

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
                marginTop: 55,
                marginRight: 43,
                spacingLeft: 14,
                spacingBottom: 19,
                events: {
                    load: function () {
                        this.renderer.image('http://privateflight.co.in/media/lntt.png', '-25', '19', 357, 500)
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
            console.log('hii');
            e.preventDefault();
            return false;
        }

        console.log(data)

        $.ajax({
            url: url,
            type: 'POST',
            data: data,
            dataType: 'json',
            cache: false,
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            success: function (data, textStatus, jqXHR) {
//                $(".save_lnt_data").addClass('hidden');
//                $('.print_lnt').removeClass('hidden');
//                $(".print_lnt").attr('href', base_url + '/postlnt/print_lnt?id=' + data.id)
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
        $(".save_lnt_data").addClass('disabled');
        $(".graph_print").addClass('disabled')
        lnt_validation();
    });

});