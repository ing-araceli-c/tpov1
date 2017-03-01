   <link rel="stylesheet" href="graphs/tablero/css/dc.css" />
   <link rel="stylesheet" href="graphs/tablero/css/stylenew.css" />
   <link rel="stylesheet" href="graphs/tablero/css/introjs.css" />
   <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
   <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

<style>
path {  stroke: #fff; }
path:hover {  opacity:0.9; }
rect:hover {  fill:blue; }
.axis {  font: 10px sans-serif; }
.legend tr{    border-bottom:1px solid grey; }
.legend tr:first-child{    border-top:1px solid grey; }

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.x.axis path {  display: none; }
.legend{
    margin-bottom:7px;
    display:block;
    border-collapse: collapse;
    border-spacing: 0px;
    margin-left: 35%;
    margin-top: 25px;
}
.legend td{
    padding:4px 5px;
    vertical-align:bottom;
}
.legendFreq {
    align:right;
    width:100px;
}
.legendPerc{
    align:right;
    width:50px;
}

   .intro_button{
      margin-top: 38px;
      margin: center;
      background-color: #01AECE;
      color: white;
   }
   #wrapper {
      margin: 0 auto;
  }
   table {
      font-size: small !important;
   }

  @media (max-width: 400px) {
    #dashboard { display: none; }
  }
   
</style>

      <center>
            <div class="col-md-12 espacio">
                 <h3 class="docs-header">.</h3>
                 <div class="btn-group" aria-label="Basic example" role="group">
                    <a class="btn-outline-ayuda" role="button" href="#" autofocus onclick="javascript:introJs().setOption('showProgress', true).start();">
                      Ayuda
                    </a>
                    <a class="btn-outline-descarga" role="button" href="Sys_Export?exp=porservicio" data-step="6"
            data-intro="Datos abiertos: descarga los datos publicados en esta página en formato CSV para facilitar su uso y reutilización.">
                       Descargar Datos
                    </a>
                </div>
            </div>
      </center>

   <center>
   <div class="row" style="width:1000px;">
      <div class="2u chart-wrapper dc-chart"  data-step="1"
           data-intro="Ejercicio<br> Selecciona un ejercicio fiscal para visualizar las cifras correspondientes a ese año. También puedes seleccionar “Todos” los años."                  
           style="width:300px;float:left;height:77px;" id="Ejercido"> 
        <div class="chart-title" style="margin-top:-3;"> <strong> Ejercicio </strong> </div> 
        <select class="dc-select-menu" id="Ejercicio" >
           <option value="">Todos</option>
           <?php echo getD3D("ListaEjercicios"); ?>
        </select>
      </div>     
      <div class="2u chart-wrapper dc-chart" data-step="2"
           data-intro="Monto gastado de servicios de difusión en medios de comunicación $<br><br>
Muestra el monto gastado en servicios de difusión, estos pueden ser: radio, televisión, cine, medios impresos, medios complementarios, Internet, otros, en el periodo seleccionado."                  
           style="width:300px;float:left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong>Monto gastado de servicios de <br>difusión en medios de comunicación $</strong></div> 
           <span class="number-display"><?php echo number_format(getD3D("indicador1"),0,',',','); ?> k</span>
      </div>

      <div class="2u chart-wrapper dc-chart" data-step="3"
           data-intro="Monto gastado en otros servicios asociados a la comunicación $<br><br>
Muestra el monto gastado en otros servicios relacionados con la comunicación, como son: producción de contenidos, impresiones, estudios y métricas, en el periodo seleccionado."           
           style="width:300px;float:left;height:77px;" id="Ejercido">        
        <div class="chart-title"> <strong>Monto gastado en otros <br>servicios asociados a la comunicación $</strong></div> 
           <span class="number-display"><?php echo number_format(getD3D("indicador2"),0,',',','); ?> k</span>
      </div>
     </div>
   </div>
<br><br><br><br><br><br>
<center>
<table style="width:777px;">
<tr>
<td>1) Servicios de difusión en medios de comunicación</td>
<td>2) Otros servicios asociados a la comunicación</td>
</tr>
<tr>
<td>* Radio</td>
<td>* Producción de contenidos</td>
</tr>
<tr>
<td>* Televisión</td>
<td>* Impresiones</td>
</tr>
<tr>
<td>* Cine</td>
<td>* Análisis, estudios y métricas</td>
</tr>
<tr>
<td>* Medios impresos</td>
</tr>
<tr>
<td>* Medios complementarios</td>
</tr>
<tr>
<td>* Internet</td>
</tr>
</table>




   <div id='dashboard' data-step="4" data-intro="Gráfica<br>Muestra el gasto por tipo de difusión: radio, televisión, cine, medios impresos, medios complementarios, Internet, otros, en el periodo seleccionado, en el periodo seleccionado.">
   </div>
</center>

<script src="graphs/porservicio/js/d3.v3.min.js"></script>
<script>
function dashboard(id, fData){
    var barColor = 'steelblue';
    function segColor(c){ return {    
    <?php
       $i = 1;
       foreach ($categorias as $categoria) {
          if ($i === 1) { 
             echo $categoria['titulo_grafica'] . ': "' . $categoria['color_grafica'] . '"';
          } else {
             echo ',' . $categoria['titulo_grafica'] . ': "' . $categoria['color_grafica'] . '"';
          }          
          $i++;
       }    
    ?>
    }[c]; }
     
    // compute total for each state.    
      <?php
       $i = 1;
       $outstr = '';
       foreach ($categorias as $categoria) {
          if ($i === 1) { 
             $outstr = 'fData.forEach(function(d){d.total=d.freq.' . $categoria['titulo_grafica'];
          } else {
             $outstr = $outstr . '+d.freq.' . $categoria['titulo_grafica'];
          }          
          $i++;
       }    
       echo $outstr;
    ?>;});
/*    
    fData.forEach(function(d){
      d.total=d.freq.Radio+d.freq.TV+d.freq.Cine+d.freq.Impresos+d.freq.Complementarios+d.freq.Internet+d.freq.Produccion+d.freq.Analisis+d.freq.Impresiones+d.freq.Streaming;});
*/

    // function to handle histogram.
    function histoGram(fD){
        var hG={},    hGDim = {t: 60, r: 0, b: 30, l: 0};
        hGDim.w = 500 - hGDim.l - hGDim.r, 
        hGDim.h = 300 - hGDim.t - hGDim.b;
            
        //create svg for histogram.
        var hGsvg = d3.select(id).append("svg")
            .attr('class','histo')
            .attr("width", hGDim.w + hGDim.l + hGDim.r)
            .attr("height", hGDim.h + hGDim.t + hGDim.b).append("g")
            .attr("transform", "translate(" + hGDim.l + "," + hGDim.t + ")");

        // create function for x-axis mapping.
        var x = d3.scale.ordinal().rangeRoundBands([0, hGDim.w], 0.1)
                .domain(fD.map(function(d) { return d[0]; }));

        // Add x-axis to the histogram svg.
        hGsvg.append("g").attr("class", "x axis")
            .attr("transform", "translate(0," + hGDim.h + ")")
            .call(d3.svg.axis().scale(x).orient("bottom"));

        // Create function for y-axis map.
        var y = d3.scale.linear().range([hGDim.h, 0])
                .domain([0, d3.max(fD, function(d) { return d[1]; })]);

        // Create bars for histogram to contain rectangles and freq labels.
        var bars = hGsvg.selectAll(".bar").data(fD).enter()
                .append("g").attr("class", "bar");
        

        //create the rectangles.
        bars.append("rect")
            .attr("x", function(d) { return x(d[0]); })
            .attr("y", function(d) { return y(d[1]); })
            .attr("width", x.rangeBand())
            .attr("height", function(d) { return hGDim.h - y(d[1]); })
            .attr('fill',barColor)
            .on("mouseover",mouseover)// mouseover is defined below.
            .on("mouseout",mouseout);// mouseout is defined below.

        //Create the frequency labels above the rectangles.
        bars.append("text").text(function(d){ return d3.format(",")(d[1])})
            .attr("x", function(d) { return x(d[0])+x.rangeBand()/2; })
            .attr("y", function(d) { return y(d[1])-5; })
            .attr("text-anchor", "middle");
        
        function mouseover(d){  // utility function to be called on mouseover.
            // filter for selected state.
            var st = fData.filter(function(s){ return s.State == d[0];})[0],
                nD = d3.keys(st.freq).map(function(s){ return {type:s, freq:st.freq[s]};});
               
            // call update functions of pie-chart and legend.    
            pC.update(nD);
            leg.update(nD);
        }
        
        function mouseout(d){    // utility function to be called on mouseout.
            // reset the pie-chart and legend.    
            
            pC.update(tF);
            leg.update(tF);
        }
        
        // create function to update the bars. This will be used by pie-chart.
        hG.update = function(nD, color){
            // update the domain of the y-axis map to reflect change in frequencies.
            y.domain([0, d3.max(nD, function(d) { return d[1]; })]);
            
            // Attach the new data to the bars.
            var bars = hGsvg.selectAll(".bar").data(nD);
            
            // transition the height and color of rectangles.
            bars.select("rect").transition().duration(500)
                .attr("y", function(d) {return y(d[1]); })
                .attr("height", function(d) { return hGDim.h - y(d[1]); })
                .attr("fill", color);

            // transition the frequency labels location and change value.
            bars.select("text").transition().duration(500)
                .text(function(d){ return d3.format(",")(d[1])})
                .attr("y", function(d) {return y(d[1])-5; });            
        }        
        return hG;
    }
    
    
    // function to handle pieChart.
    function pieChart(pD){
        var pC ={},    pieDim ={w:210, h: 210};
        pieDim.r = Math.min(pieDim.w, pieDim.h) / 2;
                
        // create svg for pie chart.
        var piesvg = d3.select(id).append("svg")
            .attr('class','pie')
            .attr("width", pieDim.w).attr("height", pieDim.h).append("g")
            .attr("transform", "translate("+pieDim.w/2+","+pieDim.h/2+")");
        
        // create function to draw the arcs of the pie slices.
        var arc = d3.svg.arc().outerRadius(pieDim.r - 10).innerRadius(0);

        // create a function to compute the pie slice angles.
        var pie = d3.layout.pie().sort(null).value(function(d) { return d.freq; });

        var div = d3.select("body").append("div")   
            .attr("class", "tooltip")               
            .style("opacity", 0);
        // Draw the pie slices.
                
        piesvg.selectAll("path").data(pie(pD)).enter().append("path").attr("d", arc)
            .each(function(d) { this._current = d; })
            .style("fill", function(d) { return segColor(d.data.type); })
            .on("mouseover",mouseover).on("mouseout",mouseout);

        // create function to update pie-chart. This will be used by histogram.
        pC.update = function(nD){
            piesvg.selectAll("path").data(pie(nD)).transition().duration(500)
                .attrTween("d", arcTween);
        }        

        function currencyFormat(num) {
            return "$" + num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        }

        // Utility function to be called on mouseover a pie slice.
        function mouseover(d){
            // call the update function of histogram with new data.
            hG.update(fData.map(function(v){ 
                return [v.State,v.freq[d.data.type]];}),segColor(d.data.type));
            div.transition()        
                    .duration(200)      
                    .style("opacity", .9);   

            div .html( "<b>" + d.data.type + ": " + currencyFormat( d.data.freq ) + "</b>")
                .style("left", (d3.event.pageX) + "px")     
                .style("top", (d3.event.pageY - 28) + "px");    
                             
        }
        //Utility function to be called on mouseout a pie slice.
        function mouseout(d){
            // call the update function of histogram with all data.
            hG.update(fData.map(function(v){
                return [v.State,v.total];}), barColor);

            div.transition()        
                    .duration(500)      
                    .style("opacity", 0);   
        }
        // Animating the pie-slice requiring a custom function which specifies
        // how the intermediate paths should be drawn.
        function arcTween(a) {
            var i = d3.interpolate(this._current, a);
            this._current = i(0);
            return function(t) { return arc(i(t));    };
        }    
        $(".pie").prependTo(".histo")
        return pC;
    }
    
    // function to handle legend.
    function legend(lD){
        var mytitles =  ['Radio', 'Televisión', 'Cine', 'Medios impresos', 'Medios complementarios', 'Internet', 'Producción de contenidos', 'Análisis, estudios y métricas', 'Impresiones', 'Streaming'];
  
        var basetitles =  ['Radio', 'TV', 'Cine', 'Medios', 'Complementarios', 'Internet', 'Contenidos', 'Estudios', 'Impresiones', 'Streaming'];        
        
        var leg = {};
            
        // create table for legend.
        var legend = d3.select(id).append("table").attr('class','legend');
        
//        legend.attr("width","444px");
        
        // create one row per segment.
        var tr = legend.append("tbody").selectAll("tr").data(lD).enter().append("tr");
            
        // create the first column for each segment.
        tr.append("td").append("svg").attr("width", '16').attr("height", '16').append("rect")
            .attr("width", '16').attr("height", '16')
			.attr("fill",function(d){ return segColor(d.type); });
            
        // create the second column for each segment.
        tr.append("td").text(function(d){ return mytitles[basetitles.indexOf(d.type)]; });

        // create the third column for each segment.
        tr.append("td").attr("class",'legendFreq')
            .text(function(d){ return ' $ ' + d3.format(",")(d.freq);});

        // create the fourth column for each segment.
        tr.append("td").attr("class",'legendPerc')
            .text(function(d){ return getLegend(d,lD);});

        // Utility function to be used to update the legend.
        leg.update = function(nD){
            // update the data attached to the row elements.
            var l = legend.select("tbody").selectAll("tr").data(nD);

            // update the frequencies.
            l.select(".legendFreq").text(function(d){ return ' $ ' + d3.format(",")(d.freq);});

            // update the percentage column.
            l.select(".legendPerc").text(function(d){ return getLegend(d,nD);});        
        }
        
        function getLegend(d,aD){ // Utility function to compute percentage.
            return d3.format("%")(d.freq/d3.sum(aD.map(function(v){ return v.freq; })));
        }

        return leg;
    }    

    // calculate total frequency by segment for all state.    
    <?php
       $i = 1;
       $outstr = '';
       foreach ($categorias as $categoria) {
          if ($i === 1) { 
             $outstr = "var tF = ['" . $categoria['titulo_grafica'] . "'";
          } else {
             $outstr = $outstr . ",'" . $categoria['titulo_grafica'] . "'";
          }          
          $i++;
       }    
       echo $outstr;
    ?>].map(function(d){
        return {type:d, freq: d3.sum(fData.map(function(t){ return t.freq[d];}))}; 
    });    
    
    // calculate total frequency by state for all segment.
    var sF = fData.map(function(d){return [d.State,d.total];});

    var hG = histoGram(sF); // create the histogram.
    var pC = pieChart(tF); // create the pie-chart.
    var leg= legend(tF);  // create the legend.
}

</script>

<script>
   var freqData= <?php echo $json_gxs; ?>;
   dashboard('#dashboard',freqData);
   $('#Ejercicio').change(function() {
      window.location = 'Sys_Screen?v=Porservicio&g=pages&e=' + $(this).val();
   });
</script>

<center>
<br><br><br>
<div style="width:90%;" data-step="5" data-intro="Se muestra cada erogación asociada  por tipo de servicio, como son: televisión, medios impresos, Internet, entre otros.">
<?php
    include_once(DIR_ROOT . 'xcrud/xcrud.php');
    $xcrud = Xcrud::get_instance();    
    $xcrud->table('vgasto_clasf_servicio');
    if (getD3D("Ejercicio")<>'') {
       $xcrud->where('`vgasto_clasf_servicio`.`ejercicio` = ' . getD3D("Ejercicio") );
    }  

    $xcrud->table_name('Gasto por Tipo de Servicio');   
    $xcrud->columns('ejercicio, factura,fecha_erogacion,proveedor,nombre_servicio_clasificacion,nombre_servicio_categoria,nombre_servicio_subcategoria,tipo,nombre_campana_aviso,monto_servicio');    
    $xcrud->label('factura','Factura')
          ->label('proveedor','Proveedor')
          ->label('fecha_erogacion','Fecha')
	  ->label('nombre_servicio_clasificacion','Clasificación')
	  ->label('nombre_servicio_categoria','Categoría')
	  ->label('nombre_servicio_subcategoria','Subcategoría')
	  ->label('nombre_campana_aviso','Campaña o aviso')
	  ->label('monto_servicio','Monto gastado');    
    $xcrud->sum('monto_servicio');        
    $xcrud->column_class('fecha_erogacion,monto_servicio', 'align-center');
    $xcrud->change_type('monto_servicio',  'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $xcrud->table_name('Gasto por tipo de servicio');
    $xcrud->button( URL_ROOT .'Sys_Detalle7?factura={id_factura}','Detalle factura','icon-link','',array('target'=>'_factura'));
    $xcrud->button( URL_ROOT .'Sys_Detalle2?proveedor={id_proveedor}','Detalle proveedor','icon-link','',array('target'=>'_proveedor'));
    $xcrud->button( URL_ROOT .'Sys_Detalle5?campana={id_campana_aviso}','Detalle campaña o aviso institucional','icon-link','',array('target'=>'_campana'));

    $xcrud->column_tooltip('nombre_servicio_clasificacion','Clasificación del servicio');
    $xcrud->column_tooltip('nombre_servicio_categoria','Categoría del servicio');
    $xcrud->column_tooltip('nombre_servicio_subcategoria','Subcategoría del servicio');
    $xcrud->column_tooltip('fecha_erogacion','Fecha de erogación');
    $xcrud->column_tooltip('proveedor','Nombre o razón social del proveedor');
    $xcrud->column_tooltip('nombre_campana_aviso','Campaña o aviso institucional');

    $xcrud->column_width('monto_servicio','120px');    

    $xcrud->unset_title();
    $xcrud->unset_remove();   
    echo $xcrud->render();
?>
</div>
</center>
<script src="graphs/tablero/js/intro.js" type="text/javascript"></script>
<script>
$('#Ejercicio').change(function() {
   window.location = 'Sys_Screen?v=Porservicio&g=pages&e=' + $(this).val();
});
</script>

