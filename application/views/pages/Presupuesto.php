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
   <link rel="stylesheet" href="graphs/tablero/css/introjs.css" />
   <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
   <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
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
</head>
<body style="width:90%;margin: 0 auto;">
   <link rel="stylesheet" href="graphs/tablero/css/dc.css" />
   <link rel="stylesheet" href="graphs/tablero/css/stylenew.css" />
   <link rel="stylesheet" href="graphs/tablero/css/introjs.css" />
   <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
   <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>


      <center>
            <div class="col-md-12 espacio">
                 <h3 class="docs-header">.</h3>
                 <div class="btn-group" aria-label="Basic example" role="group">
                    <a class="btn-outline-ayuda" role="button" href="#" autofocus onclick="javascript:introJs().setOption('showProgress', true).start();">
                      Ayuda
                    </a>
                    <a class="btn-outline-descarga" role="button" href="Sys_Export?exp=presupuesto" data-step="7" 
               data-intro="Datos abiertos: descarga los datos publicados en esta página en formato CSV para facilitar su uso y reutilización.">
                       Descargar Datos
                    </a>
                </div>
            </div>
      </center>
      <center>
   <div class="row" style="width:1000px;">


               <div class="2u chart-wrapper dc-chart col-md-3" data-step="1" 
                    data-intro="Ejercicio<br> Selecciona un ejercicio fiscal para visualizar las cifras correspondientes a ese año. También puedes seleccionar “Todos” los años."
                    style="width:215px;float:left;font-weight: normal; background-color:#000000;height:66px;" id="Ejerciciohelp">
                  <div class="chart-title" style="margin-top:-10px;">  
                     <p class="nombre-filtro">Ejercicio  </p> </div>
           <select class="dc-select-menu" id="Ejercicio" >
              <option value="">Todos</option>
              <?php echo getD3D("ListaEjercicios"); ?>
           </select>
					
               </div>

      <div class="2u chart-wrapper dc-chart  col-md-3" data-step="2"
           data-intro="Presupuesto original<br> Muestra el presupuesto original asignado a los sujetos obligados usuarios de la plataforma, para la difusión en medios de comunicación y otros servicios asociados a la comunicación, de acuerdo al ejercicio seleccionado en el filtro “Ejercicio”."                  
           style="width:215px;float: left; height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Presupuesto original ($) </strong></div> 
           <span class="number-display"><?php echo number_format(floor(getD3D("indicador1")/1000),0,',',','); ?> k</span>
      </div>

      <div class="2u chart-wrapper dc-chart  col-md-3"  data-step="3"
           data-intro="Presupuesto ejercido<br>Muestra el monto total gastado en el periodo seleccionado, es decir, la suma de las erogaciones realizadas por los sujetos obligados usuarios de la plataforma."                  
           style="width:215px;float: left; height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Presupuesto ejercido ($) </strong></div> 
           <span class="number-display"><?php echo number_format(floor(getD3D("indicador2")/1000),0,',',','); ?> k</span>
      </div>

      <div class="2u chart-wrapper dc-chart  col-md-3" data-step="4"
           data-intro="Presupuesto modificado<br>Muestra el presupuesto modificado (contemplando las ampliaciones y reducciones al presupuesto original, a la fecha) de los sujetos obligados usuarios de la plataforma, para la difusión en medios de comunicación y otros servicios asociados a la comunicación, de acuerdo al ejercicio seleccionado en el filtro."                              
           style="width:215px;float: left; height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Presupuesto modificado ($) </strong></div> 
           <span class="number-display"><?php echo number_format(floor(getD3D("indicador3")/1000),0,',',','); ?> k</span>
      </div>

     </div>
   </div>

   </center>

   <div id="barras" class="barras" data-step="5"
           data-intro="Gráfica<br>Muestra por partida el presupuesto original, modificado y ejercido en el periodo seleccionado.">   
       <iframe src="Sys_Screen?v=graficaPresupuesto&g=pages" style="width:100%;height:350px;" frameborder="0" scrolling=auto > </iframe>

   </div>

   <div class="page">
      <div style="width:90%;margin:auto;" data-step="6"
           data-intro="En la tabla se muestra el desglose de presupuesto organizado por partida y por año, con los siguientes datos:  monto original, monto modificado, presupuesto modificado y presupuesto ejercido a la fecha.">   
<?php
    include_once(DIR_ROOT . 'xcrud/xcrud.php');
    $xcrud = Xcrud::get_instance();
    $xcrud->table('vtab_presupuesto');
    if (getD3D("Ejercicio")<>'') {
       $xcrud->where('Ejercicio = ', getD3D("Ejercicio"));
    }
    $xcrud->table_name("Presupuesto");
    $xcrud->unset_title();
    $xcrud->unset_remove();
    $xcrud->unset_pagination();
    $xcrud->unset_numbers();
//    $xcrud->unset_print();
    
    $xcrud->columns('ejercicio, partida, descripcion, original, modificaciones, presupuesto, ejercido');
//    	Descripción	Ejercicio	Prespuesto Original	Monto Modificado	Prespuesto Modificado	Presupuesto Ejercido
    $xcrud->label('partida','Clave de partida');
    $xcrud->label('descripcion','Descripción');
    $xcrud->label('ejercicio','Ejercicio');
    $xcrud->label('original','Presupuesto original');
    $xcrud->label('modificaciones','Monto modificado');
    $xcrud->label('presupuesto','Presupuesto modificado');
    $xcrud->label('ejercido','Presupuesto ejercido');
    
    $xcrud->change_type('original', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2 ));
    $xcrud->change_type('modificaciones', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $xcrud->change_type('presupuesto', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $xcrud->change_type('ejercido', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $xcrud->column_pattern('descripcion','{descripcion}');
    $xcrud->column_pattern('ejercicio','<center>{ejercicio}</center>');

    $xcrud->column_width('descripcion','22%');

    $xcrud->sum('original','align-center');
    $xcrud->sum('modificaciones','align-center');
    $xcrud->sum('presupuesto','align-center');
    $xcrud->sum('ejercido','align-center');
    $xcrud->column_class('original,modificaciones,presupuesto,ejercido', 'align-center');

    echo $xcrud->render();
?>
      </div>
   </div>
<script src="graphs/tablero/js/intro.js" type="text/javascript"></script>
 
<script>
$('#Ejercicio').change(function() {
   window.location = 'Sys_Screen?v=Presupuesto&g=pages&e=' + $(this).val();
});
</script>

	</body>	
</html>
