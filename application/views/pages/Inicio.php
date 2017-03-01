<!DOCTYPE HTML>
<html>
   <head>
      <title>TPO Ver. 1.0</title>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <meta name="description" content="" />
      <meta name="keywords" content="" />
      <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
      <!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
      <script src="graphs/tablero/js/skel.min.js"></script>
      <script src="graphs/tablero/js/skel-panels.min.js"></script>
      <script src="graphs/tablero/js/init.js"></script>   
      <link rel="stylesheet" href="graphs/tablero/css/dc.css" />
      <link rel="stylesheet" href="graphs/tablero/css/stylenew.css" />
      <link rel="stylesheet" href="graphs/tablero/css/style.css" />
      <link rel="stylesheet" href="graphs/tablero/css/introjs.css" />
      <!--[if lte IE 8]>
      <link rel="stylesheet" href="css/ie/v8.css" />
      <![endif]-->
      <!--[if lte IE 9]>
      <link rel="stylesheet" href="css/ie/v9.css" />
      <![endif]-->
      <style>
         .intro_button{
         margin-top: 38px;
         margin: center;
         background-color: #01AECE;
         color: white;
         }
         #wrapper {
         margin: 0 auto;
         }
         .chart-title a {
         color: #01AECE;
         font-weight: bold;
         font-size: 1.3em;
         text-decoration: none;
         }
         .chart-title a span.arrow {
         color: #000;
         font-weight: bold;
         font-size: 2em;
         text-decoration: none;
         position: absolute;
         margin: -10px 5px;
         }
         .nombre-filtro {
         color: #fff;
         font-family: 'Lato', sans-serif;
         font-weight: bold;
         font-size: 14px;
         height: 20px;
         margin-top: -7px;
         margin-bottom: 0px;
         }
         div.inline { display: inline; margin:auto; }
   table {
      font-size: small !important;
   }
   .ver {
         color: #fff;
         font-weight: bold;
         font-size: 1.3em;
   }
      </style>
   </head>
   <body>
<!-- Version -->
<div class="ver">
TPO Ver. 1a
</div>
      <div id="wrapper">
         <center>
            <div class="col-md-12 espacio">
               <h3 class="docs-header">.</h3>
               <div class="btn-group" aria-label="Basic example" role="group">
                  <div class="inline">      
                  <a class="btn-outline-ayuda" role="button" href="#" autofocus onclick="javascript:introJs().setOption('showProgress', true).start();">
                  Ayuda
                  </a>
                  </div>
                  <div class="inline">
                  <a class="btn-outline-descarga" role="button" href="Sys_Export?exp=inicio" data-step="14" data-intro="Datos abiertos: descarga los datos publicados en esta página en formato CSV para facilitar su uso y reutilización.">
                  Descargar Datos
                  </a>
                  </div>
                  <div class="inline">
                  <a class="btn-outline-descarga" role="button" href="Sys_Export?exp=PNT" data-step="15" data-intro="Descarga en formato de la Plataforma Nacional de Transparencia.">
                  Datos Plataforma Nacional de Transparencia
                  </a>
                  </div>
               </div>
            </div>
<!-- KPIs -->
            <div class="row" style="margin-left:0px;width:1000px;">
               <div class="2u chart-wrapper" data-step="1" 
                  data-intro="Ejercicio<br> Selecciona un ejercicio fiscal para visualizar las cifras correspondientes a ese año. También puedes seleccionar “Todos” los años."
                  style="width:158px;font-weight: normal; background-color:#000000;height:77px;" data-position="right" id="menuselect">
                  <div class="chart-title">
                     <p class="nombre-filtro">Ejercicio </p>
                  </div>
               </div>
               <div class="2u chart-wrapper" data-step="2" 
                  data-intro="Presupuesto original<br>Muestra el presupuesto original asignado a los sujetos obligados usuarios de la plataforma, para la difusión en medios de comunicación y otros servicios asociados a la comunicación, de acuerdo al ejercicio seleccionado en el filtro “Ejercicio”."
                  style="width:158px;font-weight: normal; height:77px;" data-position="bottom" id="Presupuesto">
                  <div class="chart-title">
                     <p class="nombre-filtro">Presupuesto ($)  </p>
                  </div>
               </div>
               <div class="2u chart-wrapper" data-step="3" 
                  data-intro="Presupuesto modificado<br>Muestra el presupuesto modificado (contemplando las ampliaciones y reducciones al presupuesto original, a la fecha) de los sujetos obligados usuarios de la plataforma, para la difusión en medios de comunicación y otros servicios asociados a la comunicación, de acuerdo al ejercicio seleccionado en el filtro."
                  style="width:158px;font-weight: normal; height:77px;" data-position="bottom" id="Modificacion">
                  <div class="chart-title"">
                     <p class="nombre-filtro">Modificación ($)  </p>
                  </div>
               </div>
               <div class="2u chart-wrapper"  data-step="4" 
                  data-intro="Presupuesto gastado<br>Muestra el monto total gastado a la fecha, es decir, la suma de las erogaciones realizadas por los sujetos obligados usuarios de la plataforma."
                  style="font-weight: normal; height:77px;" data-position="bottom" id="Ejercido">
                  <div class="chart-title">
                     <p class="nombre-filtro">Ejercido ($)  </p>
                  </div>
               </div>
               <div class="2u chart-wrapper"  data-step="5" 
                  data-intro="Proveedores<br>Muestra el número de proveedores que han prestado servicios de difusión en medios de comunicación u otros servicios asociados a la comunicación, de acuerdo al ejercicio seleccionado en el filtro “Ejercicio”."
                  style="width:158px;font-weight: normal; height:77px;" data-position="bottom" id="Proveedores">
                  <div class="chart-title">
                     <p class="nombre-filtro" style="margin-top:-17px;">Proveedores</p>
                  </div>
               </div>
               <div class="2u chart-wrapper"  data-step="6" 
                  data-intro="Campañas/Avisos<br>Muestra el número de campañas y avisos institucionales registrados por los sujetos obligados usuarios de la plataforma, durante el ejercicio seleccionado en el filtro “Ejercicio”."
                  style="width:158px;font-weight: normal; height:77px;" data-position="bottom" id="Campanas">
                  <div class="chart-title">
                     <p class="nombre-filtro" style="margin-top:-17px;">Campañas/Avisos</p>
                  </div>
               </div>
            </div>
<!-- Registros-->
            <div class="row" style="width:1000px;">
               <div class="3u dc-data-count dc-chart"  data-step="7" 
                  data-intro="X/X Registros (quitar filtros)<br>Indica cuántos registros están representados en las cifras destacadas y gráficas de la página principal, de acuerdo al ejercicio seleccionado en el filtro “Ejercicio”.<br>Selecciona “Quitar filtros” para limpiar la búsqueda y volver a visualizar la información de todos los registros."
                  style="font-weight: normal" data-position="left"  id="row-selection"><br>		
                  <span class="filter-count">_</span> / <span class="total-count">_</span> Registros <br>
                  <span  data-step="11" data-intro="Pulsar para quitar los filtros.	"style="font-weight: normal" data-position="left" > 
                  <a href='javascript:dc.filterAll();dc.redrawAll();'><font color="#01AECE">Quitar Filtros</font></a>
                  </span><br>
               </div>
            </div>
<!--Graficas -->
            <div class="row" style="width:1000px;">
               <div class="4u chart-wrapper"  data-step="8" 
                  data-intro="Recursos ejercidos (gráfica)<br>Gráfica el monto total de recursos ejercidos en el ejercicio o ejercicios seleccionados en el filtro. Si se selecciona sólo un ejercicio fiscal, mostrará los recursos ejercidos por cada mes de ese año."
                  style="font-weight: normal" data-position="right"  id="chart-ejercido">
                  <div class="chart-title bold">
                     <a target="_parent" href="Sys_Hub?v=Erogaciones&g=pages" style="margin-left:-160px;"> Recursos ejercidos <span class="arrow"> &gt; </span> </a>
                  </div>
               </div>
               <div class="4u chart-wrapper"  
                  data-step="9" 
                  data-intro="Gasto por partida (gráfica)<br>Gráfica los recursos ejercidos en materia de comunicación social y  publicidad oficial, por partida presupuestal."
                  style="font-weight: normal" data-position="right"  id="chart-partida">
                  <div class="chart-title">  
                     <a target="_parent" href="Sys_Hub?v=Presupuesto&g=pages" style="margin-left:-167px;"> Gasto por partida <span class="arrow"> &gt; </span> </a>
                  </div>
               </div>
               <div class="4u chart-wrapper" data-step="10" 
                  data-intro="Gasto por tipo de servicio (gráfica)<br>Gráfica los recursos ejercidos por tipo de servicio, tanto servicios de difusión en medios de comunicación, así como otros servicios asociados a la comunicación."
                  style="font-weight: normal" data-position="left"  id="chart-servicio">
                  <div class="chart-title">  
                     <a target="_parent" href="Sys_Hub?v=Porservicio&amp;g=pages" style="margin-left:-110px;"> Gasto por tipo de servicio <span class="arrow"> &gt; </span> </a>
                  </div>
               </div>
            </div>
<!--Graficas-->
            <div class="row" style="width:1000px;">
               <div class="4u chart-wrapper"  
                  data-step="11" 
                  data-intro="Campañas y avisos institucionales (gráfica)<br>Gráfica el porcentaje de campañas y avisos institucionales en comparación con el total realizado, de acuerdo al ejercicio seleccionado en el filtro “Ejercicio”."
                  style="font-weight: normal" data-position="right"  id="chart-tipoCA">
                  <div class="chart-title">
                     <a target="_parent" href="Sys_Hub?v=Campanasavisos&amp;g=pages" style="margin-left:-40px;"> Campañas y avisos institucionales <span class="arrow"> &gt; </span> </a>
                     </a--> 
                  </div>
               </div>
               <div class="4u chart-wrapper"  
                  data-step="12" 
                  data-intro="Muestra de forma global las 10 campañas o avisos institucionales que registran el mayor gasto, de acuerdo al ejercicio seleccionado en el filtro “Ejercicio”."
                  style="font-weight: normal" data-position="top" id="chart-TopCA">
                  <div class="chart-title">  
                     <a target="_parent" href="Sys_Hub?v=Campanasavisos&g=pages" style="margin-left:-110px;"> Top 10 campañas y avisos <span class="arrow"> &gt; </span> </a>
                  </div>
               </div>
               <div class="4u chart-wrapper"  
                  data-step="13" 
                  data-intro="Muestra de forma global los 10 proveedores con mayor gasto,
                  de acuerdo al ejercicio seleccionado en el filtro “Ejercicio”."
                  style="font-weight: normal" data-position="left"  id="chart-TopProveedores">
                  <div class="chart-title">  
                     <a target="_parent" href="Sys_Hub?v=Porproveedor&amp;g=pages" style="margin-left:-150px;"> Top 10 proveedores <span class="arrow"> &gt; </span> </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src='graphs/tablero/js/crossfilter.js' type='text/javascript'></script>
      <script src='graphs/tablero/js/d3.js' type='text/javascript'></script>
      <script src='graphs/tablero/js/dc.js' type='text/javascript'></script>
      <script src='graphs/tablero/js/queue.js' type='text/javascript'></script>
      <?php $data1 = exportData1ToCsv(); ?>
      <script>
          var sourcescv = 'data/inicio.csv';
      </script>
      <script src='graphs/tablero/js/Dashboard.js' type='text/javascript'></script>
      <script src="graphs/tablero/js/intro.js" type="text/javascript"></script>
   </body>
</html>

