<!DOCTYPE html>
<head>
   <link rel="stylesheet" href="graphs/tablero/css/dc.css" />
   <link rel="stylesheet" href="graphs/tablero/css/stylenew.css" />
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
   <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
   <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
<style>
#box {
  height: 777px;
  width: 960px;
}

.node rect {
  cursor: move;
  fill-opacity: .9;
  shape-rendering: crispEdges;
}

.node text {
  pointer-events: none;
  text-shadow: 0 1px 0 #fff;
}

.link {
  fill: none;
  stroke: #000;
  stroke-opacity: .2;
}

.link:hover {
  //stroke-opacity: .5;
}

.btn-outline-descarga:hover {
   color: #fff !important;
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

#mylabel {
    /* Other styling.. */
    text-align: right;
    clear: both;
    float:left;
    margin-right:15px;
}
  

#slider {
  border-radius: 0px;
  border: 0px dotted #888;
    clear: both;
    float:left;
    margin-right:15px;
}
  
input[type=range] {
  -webkit-appearance: none;
  margin: 18px 0;
  width: 100%;
}
input[type=range]:focus {
  outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  animate: 0.2s;
  border-radius: 8px;
/*
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border: 0.2px solid #010101;
*/
  background: #01AECE;
}
input[type=range]::-webkit-slider-thumb {
  height: 20px;
  width: 20px;
  border: 1px solid #cacaca;
  border-radius: 50%;
/*  
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
*/  
  background: #ffffff;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -5px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
  background: #01AECE;
}
input[type=range]::-moz-range-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  animate: 0.2s;
/*  
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border-radius: 1.3px;
  border: 0.2px solid #010101;
*/  
  background: #01AECE;
}
input[type=range]::-moz-range-thumb {
  height: 36px;
  width: 16px;
/*  
  border: 1px solid #000000;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border-radius: 3px;
*/  
  background: #ffffff;
  cursor: pointer;
}
input[type=range]::-ms-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  animate: 0.2s;
  background: transparent;
  border-color: transparent;
  border-width: 16px 0;
  color: transparent;
}
input[type=range]::-ms-fill-lower {
  background: #2a6495;
/*  
  border: 0.2px solid #010101;
  border-radius: 2.6px;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  */
}
input[type=range]::-ms-fill-upper {
  background: #3071a9;
/*  
  border: 0.2px solid #010101;
  border-radius: 2.6px;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
*/  
}
input[type=range]::-ms-thumb {
/*
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  border: 1px solid #000000;
  border-radius: 3px;
*/  
  height: 36px;
  width: 16px;
  background: #ffffff;
  cursor: pointer;
}
input[type=range]:focus::-ms-fill-lower {
  background: #3071a9;
}
input[type=range]:focus::-ms-fill-upper {
  background: #367ebd;
}

#mylabel {
    /* Other styling.. */
    text-align: right;
    clear: both;
    float:left;
    margin-right:15px;
}

span.number-display {
    color: white;
    font-size: 33px;
    text-align: center;
    line-height: 35px;
    display: inline-block;
    padding: 5px 5px 4px;
    font-family: 'Lato', sans-serif;
    font-weight: 400;
}

         .nombre-filtro {
         color: #fff;
         font-family: 'Lato', sans-serif;
         font-weight: bold;
         font-size: 14px;
         height: 20px;
         margin-top: 0px;
         margin-bottom: 0px;
         }
   table {
      font-size: small !important;
   }

</style>
<link rel="stylesheet" href="graphs/tablero/css/introjs.css" />   

</head>
<body>
      <center>
            <div class="col-md-12 espacio">
                 <h3 class="docs-header">.</h3>
                 <div class="btn-group" aria-label="Basic example" role="group">
                    <a class="btn-outline-ayuda" role="button" href="#" autofocus onclick="javascript:introJs().setOption('showProgress', true).start();">
                      Ayuda
                    </a>
                    <a class="btn-outline-descarga" role="button" href="Sys_Export?exp=porproveedor" data-step="7"
            data-intro="Datos abiertos: descarga los datos publicados en esta página en formato CSV para facilitar su uso y reutilización.">
                       Descargar Datos
                    </a>
                </div>
            </div>
      </center>

   <center>
   <div class="row" style="width:1000px;">
      <div class="2u chart-wrapper dc-chart" data-step="1"
           data-intro="Ejercicio<br> Selecciona un ejercicio fiscal para visualizar las cifras correspondientes a ese año. También puedes seleccionar “Todos” los años."                  
           style="width:300px;float:left;height:77px;" id="Ejercido"> 
        <div class="chart-title" style="margin-top:-3px;"> 
          <p class="nombre-filtro">Ejercicio  </p>
        </div> 
        <select class="dc-select-menu" id="Ejercicio1" >
           <option value="">Todos</option>
           <?php echo getD3D("ListaEjercicios"); ?>
        </select>
      </div>      
      <div class="2u chart-wrapper dc-chart" data-step="2"
           data-intro="Proveedores<br>Muestra el número de proveedores contratados en el periodo seleccionado."                  
           style="width:300px;float: left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Proveedores </strong></div> 
           <span class="number-display"><?php echo getD3D("indicador1"); ?></span>
      </div>

      <div class="2u chart-wrapper dc-chart" data-step="3"
           data-intro="Monto gastado<br>Muestra el monto total gastado en el periodo seleccionado por el total de proveedores."                        
           style="width:300px;float: left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Monto Gastado ($) </strong></div> 
           <span class="number-display"><?php echo number_format(getD3D("indicador2"),0,',',','); ?> k</span>
      </div>
     </div>
   </div>
<br><br><br><br><br><br>
    <div data-step="4" data-intro="El valor del filtro inicia en el promedio del monto total ejercido en el ejercicio seleccionado. Se puede manipular el filtro a montos mayores del promedio." style="width:350px;height:55px;">
 <form action="#" style="width:333px;">
    <p class="range-field">
      <?php
         if (isset($_GET['filtro'])) {
      ?>
      <label for="fader" id="mylabel">Montos mayores a: $ 
          <output for="fader" id="filtro"> <?php echo number_format($_GET['filtro']); ?></output>
      </label>
   <input type="range" id="slider" min="<?php echo getD3D("maximo"); ?>" step="10000" max="<?php echo getD3D("total"); ?>" value="<?php echo $_GET['filtro']; ?>" oninput="outputUpdate(value)" onchange="goValue(this.value);"/>
      <?php
         } else {
      ?>
       <label for="fader" id="mylabel">Montos mayores a: $ 
          <output for="fader" id="filtro"> <?php echo number_format(getD3D("maximo")); ?></output>
       </label>
   <input type="range" id="slider" min="<?php echo getD3D("maximo"); ?>" step="10000" max="<?php echo getD3D("total"); ?>" value="<?php echo getD3D("maximo"); ?>" oninput="outputUpdate(value)" onchange="goValue(this.value);"/>
      <?php
         }
      ?>       
    </p>
  </form>
</div>  
			   
    <div id="box" data-step="5" data-intro='Se muestran los tipos de servicio como son: televisión, medios impresos, Internet, entre otros, adquiridos por contrato u orden de compra, asociados a los proveedores cuya erogación total, por cada tipo de servicio, sea mayor al valor seleccionado en el filtro "Montos mayores a"'>
          <div id="sankey">
		       <p id="chart" class="chart"></p>
		    </div>
    </div>
   </center>
<script src="graphs/porproveedor/js/d3.v2.min.js" charset="utf-8"></script>
<script src="graphs/porproveedor/js/sankey.js"></script>
<script src="graphs/tablero/js/intro.js" type="text/javascript"></script>

<script>

var margin = {top: 1, right: 1, bottom: 6, left: 1},
    width = 960 - margin.left - margin.right,
    height = 777 - margin.top - margin.bottom;

var formatNumber = d3.format(",.2f"),
    format = function(d) { return "$ " + formatNumber(d); },
    color = d3.scale.category20();

var svg = d3.select("#chart").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

var sankey = d3.sankey()
    .nodeWidth(15)
    .nodePadding(10)
    .size([width, height]);

var path = sankey.link();

d3.json("data/porproveedor.json", function(energy) {

  sankey.nodes(energy.nodes)
      .links(energy.links)
      .layout(32);

  var link = svg.append("g").selectAll(".link")
      .data(energy.links)
    .enter().append("path")
      .attr("class", "link")
      .attr("d", path)
      .style("stroke-width", function(d) { return Math.max(1, d.dy); })
      .sort(function(a, b) { return b.dy - a.dy; });

  link.append("title")
      .text(function(d) { return d.source.name + " → " + d.target.name + "\nMonto ejercido: " + format(d.value) + "\n" + d.tipo + ": " + d.numero; });

  var node = svg.append("g").selectAll(".node")
      .data(energy.nodes)
    .enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { return "translate(" + d.x + "," + d.y + ")"; })
    .call(d3.behavior.drag()
      .origin(function(d) { return d; })
      .on("dragstart", function() { this.parentNode.appendChild(this); })
      .on("drag", dragmove));

  node.append("rect")
      .attr("height", function(d) { return d.dy; })
      .attr("width", sankey.nodeWidth())
      .style("fill", function(d) { return d.color = color(d.name.replace(/ .*/, "")); })
      .style("stroke", function(d) { return d3.rgb(d.color).darker(2); })
    .append("title")
      .text(function(d) { return d.name + "\n" + format(d.value); });

  node.append("text")
      .attr("x", -6)
      .attr("y", function(d) { return d.dy / 2; })
      .attr("dy", ".35em")
      .attr("text-anchor", "end")
      .attr("transform", null)
      .text(function(d) { return d.name.substring(0, 35); })
    .filter(function(d) { return d.x < width / 2; })
      .attr("x", 6 + sankey.nodeWidth())
      .attr("text-anchor", "start");

  function dragmove(d) {
    d3.select(this).attr("transform", "translate(" + d.x + "," + (d.y = Math.max(0, Math.min(height - d.dy, d3.event.y))) + ")");
    sankey.relayout();
    link.attr("d", path);
  }
});

</script>

<script>
	$('#Ejercicio1').change(function() {
//	   window.location = 'Sys_Screen?v=Porproveedor&g=pages&e=' + $(this).val() + '&filtro=' + document.querySelector('#filtro').value();
	   window.location = 'Sys_Screen?v=Porproveedor&g=pages&e=' + $(this).val();
	});

   function outputUpdate(vol) {
	   document.querySelector('#filtro').value = vol;
   };

function goValue(vol) {
	   window.location = 'Sys_Screen?v=Porproveedor&g=pages&e=' + $('#Ejercicio1').val() + '&filtro=' + vol.toString();
}


</script>

<center>
<div style="margin-top:350px;">
<div style="width:90%;" data-step="6" data-intro="Se muestra el presupuesto ejercido en publicidad oficial por proveedor.">
<style>
a {
  color: #000 !important;;
}
</style>

<?php
// Proveedor
    include_once(DIR_ROOT . 'xcrud/xcrud.php');
    $pro = Xcrud::get_instance();
    $pro->table('vtab_proveedores');
    if (getD3D("Ejercicio")<>'') {
       $pro->where('`Ejercicio` = ' . getD3D("Ejercicio"));
    }   
    $pro->columns("ejercicio, nombre, contratos, ordenes, monto"); 
    $pro->label('nombre','Proveedor');
    $pro->label('ordenes','Órdenes de compra');
    $pro->label('monto','Monto total pagado');

//    $pro->unset_pagination();

    $pro->change_type('monto',  'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $pro->sum('contratos');
    $pro->sum('ordenes');
    $pro->sum('monto');
    $pro->unset_view( true );
    $pro->button( URL_ROOT .'Sys_Detalle2?proveedor={id_proveedor}','Detalle','icon-link','',array('target'=>'_new'));
    $pro->column_class('contratos, ordenes, monto, ejercicio', 'align-center');
    $pro->table_name('Gasto por proveedor');
//    $pro->column_width('monto','200px');

//    $pro->limit_list('5,10,15,20');
    $pro->unset_title();
    echo $pro->render();
?>
</div>
</div>
</center>

</body>
</html>
