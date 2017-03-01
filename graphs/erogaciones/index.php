<html>
<head>
</head>
<body>
   <div id="container" style="min-width: 400px; max-width: 800px; height: 400px; margin: 0 auto"></div>

   <script src="js/jquery.min.js"></script>
   <script src="js/highcharts.js"></script>
   <script src="js/data.js"></script>
   <script src="js/drilldown.js"></script>
<script>
$(function () {
    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'pie'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Pulsar en la gráfica para ver el detalle.'
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:.3f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.3f}%</b> del total<br/>'
        },
        series: [{
            name: 'Erogaciones',
            colorByPoint: true,
            data: [            
               <?php 
               echo file_get_contents('../../data/pieh.json');
               ?>
            ]
        }],
        drilldown: {
            series: [
               <?php 
               echo file_get_contents('../../data/pied.json');
               ?>
         ]
        }
    });
});
</script>
</body>
</html>

