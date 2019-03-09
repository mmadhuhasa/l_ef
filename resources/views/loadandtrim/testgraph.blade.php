<!DOCTYPE HTML>
<html>
    <head>  
	<script type="text/javascript">
            window.onload = function () {
                var chart = new CanvasJS.Chart("chartContainer", {
                    title: {
                        text: "Line Chart"
                    },
                    axisX: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },
                    data: [{
                            type: "line",
                            dataPoints: [
                                {x: 15, y: 26},
                                {x: 17, y: 28},
                                {x: 19, y: 30},
                                {x: 21, y: 32},
                                {x: 23, y: 34},
                                {x: 25, y: 36},
                                {x: 27, y: 38},
                                {x: 29, y: 40},
                                {x: 31, y: 42},
                                {x: 33, y: 44},
                                {x: 35, y: 46},
                                {x: 37, y: 48}
                            ]
                        }]
                });
                chart.render();
            }
	</script>
    </head>
    <body>
	<div id="chartContainer" style="height: 400px; width: 100%;"></div>
    </body>
    <script type="text/javascript" src="{{url('app/plugins/canvasjs-1.8.1/canvasjs.min.js')}}"></script>
</head>
<body>
    <div id="chartContainer" style="height: 300px; width: 100%;">
    </div>
</body>
</html>
