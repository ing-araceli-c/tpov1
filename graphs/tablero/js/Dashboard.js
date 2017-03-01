
queue().defer(d3.csv, sourcescv).await(makeGraphs);

function makeGraphs(error, apiData) {	
//Start Transformations
   var dataSet = apiData;
//   console.log(dataSet);
   var dateFormat = d3.time.format("%d/%m/%Y");
   dataSet.forEach(function(d) {
      d.fecha = dateFormat.parse(d.fecha);
      d.fecha.setDate(1);
      d.ejercido = +d.ejercido;
   });

//Create a Crossfilter instance
   var ndx = crossfilter(dataSet);

//Define Dimensions
   var ejercicio       = ndx.dimension(function(d) { return d.ejercicio;    });
   var fechaErogacion  = ndx.dimension(function(d) { return d.fecha;        });
   var partida         = ndx.dimension(function(d) { return d.partida;      });
   var tipoServicio    = ndx.dimension(function(d) { return d.servicio;     });
   var tipoCA          = ndx.dimension(function(d) { return d.tipo;         });
   var campanasyAvisos = ndx.dimension(function(d) { return d.campana;      });
   var proveedor       = ndx.dimension(function(d) { return d.proveedor;    });

//Define threshold values for data
   var minDate = fechaErogacion.bottom(1)[0].fecha;
   var maxDate = fechaErogacion.top(1)[0].fecha;
   

//Calculate metrics
   var ejercicioGroup            = ejercicio.group();
   var CampanaPorFecha           = fechaErogacion.group().reduceSum(function(d) {return Math.trunc(d.ejercido);});
   var CampanaPorPartida         = partida.group().reduceSum(function(d) {return Math.trunc(d.ejercido);});   
   var CampanaPortipoServicio    = tipoServicio.group().reduceSum(function(d) {return Math.trunc(d.ejercido);});
   var CampanaPortipoCA          = tipoCA.group().reduceSum(function(d) {return Math.trunc(d.ejercido);});
   var CampanaPorcampanasyAvisos = campanasyAvisos.group().reduceSum(function(d) {return Math.trunc(d.ejercido);});
   var CampanaPorProveedor       = proveedor.group().reduceSum(function(d) {return Math.trunc(d.ejercido);});
   var all = ndx.groupAll();
   
//Calculate Groups
   var totalPartida = partida.group().reduceSum(function(d) {
      return d.ejercido;
   });

   var totalTipoServicio = tipoServicio.group().reduceSum(function(d) {
      return d.servicio;
   });

   var totalTipoCA = tipoCA.group().reduceSum(function(d) {
      return d.tipo;
   });
   
   var totalCampanas = tipoCA.group().reduceSum(function(d) {
      return d.campanaaviso;
   });

   var totalProveedores = proveedor.group().reduceSum(function(d) { return d.proveedor; });

// net Totales
   var netTotalPresupuesto  = ndx.groupAll().reduceSum(function(d) {return d.presupuesto;});
   var netTotalModificacion = ndx.groupAll().reduceSum(function(d) {return d.modificacion;});   
   var netTotalEjercido     = ndx.groupAll().reduceSum(function(d) {return d.ejercido;});
//   var netTotalProveedores  = ndx.groupAll().reduceSum(function(d) {return d.ejercido;});
//   var netTotalCampanas     = ndx.groupAll().reduceSum(function(d) {return d.campanaaviso;});
   var netTotalProveedores  = ndx.groupAll().reduceSum(function(d) {return d.proveedores;});
   var netTotalCampanas     = ndx.groupAll().reduceSum(function(d) {return d.totalcampanas;});
  
// IDs Charts
   var ejercidoChart      = dc.lineChart("#chart-ejercido");
   var partidaChart       = dc.rowChart("#chart-partida");
   var tipoServicioChart  = dc.rowChart("#chart-servicio");
   var tipoCAChart        = dc.pieChart("#chart-tipoCA");
   var topCAChar          = dc.rowChart("#chart-TopCA");
   var topProveedores     = dc.barChart("#chart-TopProveedores");

// IDs Indicadores
   var netPresupuesto     = dc.numberDisplay("#Presupuesto");
   var netModificacion    = dc.numberDisplay("#Modificacion");
   var netEjercido        = dc.numberDisplay("#Ejercido");
   var totalProjects      = dc.numberDisplay("#Proveedores");
   var totalCampanas      = dc.numberDisplay("#Campanas");

// Select Ejercicio
   selectField = dc.selectMenu('#menuselect')
                   .dimension(ejercicio)
                   .group(ejercicioGroup); 

// Registros seleccionados
   dc.dataCount("#row-selection")
     .dimension(ndx)
     .group(all);

// Total de registros
   totalProjects.formatNumber(d3.format("d"))
		.valueAccessor(function(d){return d; })
		.group(netTotalProveedores)
                .formatNumber(d3.format(".0f"));

// Indicador presupuesto
   netPresupuesto.formatNumber(d3.format("d"))
                 .valueAccessor(function(d){return d; })
                 .group(netTotalPresupuesto)
                 .formatNumber(d3.format(".3s"));

// Indicador modificaciones
   netModificacion.formatNumber(d3.format("d"))
                  .valueAccessor(function(d){return d; })
                  .group(netTotalModificacion)
                  .formatNumber(d3.format(".3s"));

// Indicador Ejercido
   netEjercido.formatNumber(d3.format("d"))
              .valueAccessor(function(d){return d; })
              .group(netTotalEjercido)
              .formatNumber(d3.format(".2s"));

// Indicador Campanas
   totalCampanas.formatNumber(d3.format("d"))
                .valueAccessor(function(d){return d; })
                .group(netTotalCampanas)
                .formatNumber(d3.format(".0f"));
   
// GRAFICAS
   //.width(600)
// 1.- Recursos Ejercidos
   ejercidoChart.height(220)
                .margins({top: 10, right: 50, bottom: 30, left: 50})
                .dimension(fechaErogacion)
                .group(CampanaPorFecha)
                .renderArea(true)
                .transitionDuration(500)
                .x(d3.time.scale().domain([minDate, maxDate]))
                .elasticY(false)
                .renderHorizontalGridLines(true)
                .renderVerticalGridLines(true)
                .xAxisLabel("Ejercicio - Mes")
                .yAxisLabel("Monto ejercido en mdp")
                .yAxis().tickFormat(d3.format("s"));

// 2.- Por partidas
   //.width(300)   
   partidaChart.height(220)
               .dimension(partida)
               .elasticX(false)
               .group(CampanaPorPartida)
               .xAxis().tickFormat(d3.format("s"));

// 3.- Por Tipo de Servicio
   //.width(300)
   tipoServicioChart.height(220)
                    .dimension(tipoServicio)
                    .group(CampanaPortipoServicio)
                    .xAxis().tickFormat(d3.format("s"));

// 4.- Por tido de Campaña o Aviso
   //.width(350)
   tipoCAChart.height(220)
              .radius(90)
              .innerRadius(40)
              .transitionDuration(1000)
              .dimension(tipoCA)
              .group(CampanaPortipoCA);

// 5.- Top 10 Campañas
   //.width(300)
   topCAChar.height(220)
            .dimension(campanasyAvisos)
            .group(CampanaPorcampanasyAvisos)
            .xAxis().tickFormat(d3.format("s"));

// 6.- Top 10 Proveedores
   //.width(800)
   topProveedores.height(220)
                 .transitionDuration(1000)
                 .dimension(proveedor)
                 .group(CampanaPorProveedor)
                 .margins({top: 10, right: 50, bottom: 30, left: 50})
                 .centerBar(false)
                 .gap(5)
                 .elasticY(false)
                 .x(d3.scale.ordinal().domain(proveedor))
                 .xUnits(dc.units.ordinal)
                 .renderHorizontalGridLines(true)
                 .renderVerticalGridLines(true)
                .xAxisLabel("Proveedores")
                .yAxisLabel("Monto ejercido en mdp")
                 .ordering(function(d){return d.value;})
                 .yAxis().tickFormat(d3.format("s"));

    dc.renderAll();
};

