<!DOCTYPE html>
<html>

    <head>
	<script src="https://cdn.zingchart.com/zingchart.min.js"></script>
	<script>
            zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
            ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
	</script>
	<style>
	    html,
	    body,
	    #myChart {
		height: 100%;
		width: 100%;
	    }
	</style>
    </head>

    <body>
	<div id='myChart'></div>
	<script>
            var myConfig = {
                "type": "line",
                "plot": {
                    "aspect": "spline"
                },
                "series": [{
                        "values": [
                            [0.000276992196762, 685.1875],
                            [0.000553984393493, 683.71],
                            [0.00083097659018, 680.3636],
                            [0.00110796878705, 678.7259],
                            [0.00138496098367, 672.8303],
                            [0.00166195318037, 669.1924]
                        ]
                    }]
            };

            zingchart.render({
                id: 'myChart',
                data: myConfig,
                height: "100%",
                width: "100%"
            });
	</script>
    </body>

</html>