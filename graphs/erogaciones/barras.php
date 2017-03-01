<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<script src="js/jquery.min.js"></script>
	<script src="js/highcharts.js"></script>
	<script src="js/data.js"></script>
	<script src="js/drilldown.js"></script>
</head>
<body">
<div id="container" style="min-width: 310px; height: 600px; margin: 0 auto;margin-top:50px;"></div>

<!-- Data from www.netmarketshare.com. Select Browsers => Desktop share by version. Download as tsv. -->
<pre id="tsv" style="display:none">
Browser Version	Total Market Share
Tiempo de Respuesta 8.0	26.61%
Tiempo de Respuesta 9.0	16.96%
Abandono 18.0	8.01%
Abandono 19.0	7.73%
Disponibilidad 12	6.72%
Tiempo de Respuesta 6.0	6.40%
Disponibilidad 11	4.72%
Tiempo de Respuesta 7.0	3.55%
Oportunidad SLA 5.1	3.53%
Disponibilidad 13	2.16%
Disponibilidad 3.6	1.87%
Oportunidad WO 11.x	1.30%
Abandono 17.0	1.13%
Disponibilidad 10	0.90%
Oportunidad SLA 5.0	0.85%
Disponibilidad 9.0	0.65%
Disponibilidad 8.0	0.55%
Disponibilidad 4.0	0.50%
Abandono 16.0	0.45%
Disponibilidad 3.0	0.36%
Disponibilidad 3.5	0.36%
Disponibilidad 6.0	0.32%
Disponibilidad 5.0	0.31%
Disponibilidad 7.0	0.29%
Catalogado incorrectamente	0.29%
Abandono 18.0 - Maxthon Edition	0.26%
Abandono 14.0	0.25%
Abandono 20.0	0.24%
Abandono 15.0	0.18%
Abandono 12.0	0.16%
Oportunidad WO 12.x	0.15%
Oportunidad SLA 4.0	0.14%
Abandono 13.0	0.13%
Oportunidad SLA 4.1	0.12%
Abandono 11.0	0.10%
Disponibilidad 14	0.10%
Disponibilidad 2.0	0.09%
Abandono 10.0	0.09%
Oportunidad WO 10.x	0.09%
Tiempo de Respuesta 8.0 - Tencent Traveler Edition	0.09%</pre>

<script>	
	$(function () {

    Highcharts.data({
        csv: document.getElementById('tsv').innerHTML,
        itemDelimiter: '\t',
        parsed: function (columns) {

            var brands = {},
                brandsData = [],
                versions = {},
                drilldownSeries = [];

            // Parse percentage strings
            columns[1] = $.map(columns[1], function (value) {
                if (value.indexOf('%') === value.length - 1) {
                    value = parseFloat(value);
                }
                return value;
            });

            $.each(columns[0], function (i, name) {
                var brand,
                    version;

                if (i > 0) {

                    // Remove special edition notes
                    name = name.split(' -')[0];

                    // Split into brand and version
                    version = name.match(/([0-9]+[\.0-9x]*)/);
                    if (version) {
                        version = version[0];
                    }
                    brand = name.replace(version, '');

                    // Create the main data
                    if (!brands[brand]) {
                        brands[brand] = columns[1][i];
                    } else {
                        brands[brand] += columns[1][i];
                    }

                    // Create the version data
                    if (version !== null) {
                        if (!versions[brand]) {
                            versions[brand] = [];
                        }
                        versions[brand].push(['v' + version, columns[1][i]]);
                    }
                }

            });

            $.each(brands, function (name, y) {
                brandsData.push({
                    name: name,
                    y: y,
                    drilldown: versions[name] ? name : null
                });
            });
            $.each(versions, function (key, value) {
                drilldownSeries.push({
                    name: key,
                    id: key,
                    data: value
                });
            });

            // Create the chart
            $('#container').highcharts({
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },
                subtitle: {
                    text: 'Click en las columnas para ver detalles.'
                },
                xAxis: {
                    type: 'Tipo'
                },
                yAxis: {
                    title: {
                        text: 'Porcentake del total'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> del total<br/>'
                },

                series: [{
                    name: 'Erogaciones',
                    colorByPoint: true,
                    data: brandsData
                }],
                drilldown: {
                    series: drilldownSeries
                }
            });
        }
    });
});

</script>
</body>
</html>
