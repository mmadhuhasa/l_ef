$(document).ready(function(){        
$('.calculate').click(function()  {
   // cal();
    //function cal(){
                $.ajax({
                     url: "/ltrim_graph",
                     dataType: 'json',
                     headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
                    success: function (data, textStatus, jqXHR) {
                        console.log(data);
                         take_off_data=[data.max_zero_fuel_weight,data.total_take_off_weight.weight];
                         landing_data=[data.max_landing_weight,data.total_landing_weight.weight];
                         from=data.from;
                         to=data.to;
                         date=data.date;
                    },
                async: false,
                error: function (jqXHR, textStatus, errorThrown) {

                }
            });
//console.log('landing_data');                
console.log(landing_data);
var lr_data = [take_off_data,landing_data]; 
console.log('take_off_data');
console.log(take_off_data); 
    var curve_color = 'blue';
    var zero_fuel_color = 'darkgrey';
    var landing_fuel_color = '#0fa0db';
    var take_off_fuel_color = '#00ff00';
    var zfg_color = '#2cc38a';  
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
                        text: '<span style="font-size:7px; font-weight:bold;text-transform: uppercase;">Date: ' + date + '<span style="color:white">.........</span></span>'
                                + '<span style="font-size:7px;font-weight:bold;text-transform: uppercase;">From: ' + from + '<span style="color:white">.........</span></span>'
                                + '<span style="font-size:7px;font-weight:bold; text-transform: uppercase;">To: ' + to + '</span>'
                        ,
                        useHTML: true,
                        y: 10,
                        align: 'center',
                        x: -27,
                    },
                    subtitle: {
                    },
                    margin: 0,
                    chart: {
                    // width: 900,
                    // height: 536,
                    // marginTop: 30,
                    // marginLeft: 130,
                    // spacingBottom: 40,
                    width: 900,
                    height: 482,
                    marginTop: 0,
                    marginLeft: 130,
                    spacingRight:52,
                    spacingBottom: 0,
        
                        events: {
                             load: function () {
                        // this.renderer.image('http://demo.privateflight.co.in/media/vt_avs.png', '0', '19', 900, 536)
                        //         .add();
                           this.renderer.image('http://demo.privateflight.co.in/media/vt_avs.png', '-6.5', '0', 900, 482)
                                .add();
                            }
                        }
                    },

                },
                scale: 3,
                fallbackToExportServer: false,
            },
            chart: {
                width: 900,
                height: 482,
                marginTop: 10,
                marginLeft: 130,
                // spacingBottom: 27,
                spacingRight:52,
                spacingBottom: 40,
                events: {
                    load: function () {
                        this.renderer.image('media/vt_avs.png', '-6.5', '0', 900, 482)
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
                text: '',
                x: -20 //center
            },
            xAxis: {
               
                lineColor: 'red',
                min: 10,
                max: 50,
                tickInterval: 10,
                tickPositions: [10,20,30,40,50],
                tickPosition: 'inside',
                tickLength: 0,
                tickColor:'blue',
                tickWidth:5,
                labels: {
                    style: {
                        color: '#0000',
                        fontSize: '9px'
                    },
                    // y: 13,
                    enabled: true
                }
            },
            yAxis: {
         
                lineColor: 'red',
                gridLineWidth: 0,
                min: 6200,
                max: 11000,
                tickPositions: [6200,6600,7000,7400,7800,8200,8600,9000,9400,9800,10200,10600,11000],
                 tickLength: 0,
                 tickWidth:1,
                 tickColor:'yellow',
                tickInterval: 400,
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
                    // x: -10,
                    style: {
                        color: 'black',
                        fontSize: '9px'
                    },
                    enabled: true
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
                    states: {
                        hover: {
                            enabled: false
                        }
                    }
                }
            },
            tooltip: {
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
                    data: lr_data
                },
                {
                    showInLegend: false,
                    name: 'LW',
                    type: 'scatter',
                    color: landing_fuel_color,
                    "marker": {
                        enabled: true,
                        "symbol": "circle",
                        radius: 3
                    },
                    data: [landing_data],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            return  parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
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
                        "symbol": "triangle",
                        radius: 3
                    },
                       data: [take_off_data],
                     // data: [[10.00,7000.00]],
                    dataLabels: {
                        enabled: true,
                        formatter: function () {
                            
                          return   parseFloat(this.key).toFixed(2) + ' (' + Math.round(this.y) + ' lbs)';
                        },
                        style: {fontFamily: '\'Lato\', sans-serif', lineHeight: '0px', fontSize: '9px', fontWeight: 'bold'}
                    }
                },
            ]
        });
//}
   });

});