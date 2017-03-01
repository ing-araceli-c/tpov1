<html>
<head>
   <link href='graphs/campanasarbol/css/facebox.css' rel='stylesheet' type='text/css'>
   <script src='graphs/campanasarbol/js/jquery-1.9.1.min.js' type='text/javascript'></script>

   <link rel="stylesheet" href="graphs/tablero/css/dc.css" />
   <link rel="stylesheet" href="graphs/tablero/css/stylenew.css" />
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
   table {
      font-size: small !important;
   }
</style>
   <meta charset='utf-8'>
</head>
<body class='container'>

      <center>
            <div class="col-md-12 espacio">
                 <h3 class="docs-header">.</h3>
                 <div class="btn-group" aria-label="Basic example" role="group">
                    <a class="btn-outline-ayuda" role="button" href="#" autofocus onclick="javascript:introJs().setOption('showProgress', true).start();">
                      Ayuda
                    </a>
                    <a class="btn-outline-descarga" role="button" href="Sys_Export?exp=so"  data-step="6"
        data-intro="Datos abiertos: descarga los datos publicados en esta página en formato CSV para facilitar su uso y reutilización.">
                       Descargar Datos
                    </a>
                </div>
            </div>
      </center>
   <center>
   <div class="row" style="width:1000px;margin-top:50px;">
      <div class="2u chart-wrapper dc-chart" data-step="1"
           data-intro="Ejercicio<br>Selecciona un ejercicio fiscal para visualizar las cifras correspondientes a ese año. También puedes seleccionar “Todos” los años."
           style="width:200px;float:left;height:77px;" id="Ejercido"> 
        <div class="chart-title" style="margin-top:-3;"> <strong> Ejercicio </strong> </div> 
        <select class="dc-select-menu" id="Ejercicio" >
           <option value="">Todos</option>
           <?php echo getD3D("ListaEjercicios"); ?>
        </select>
      </div>     
      <div class="2u chart-wrapper dc-chart" data-step="2"
           data-intro="Sujetos obligados contratantes<br>Muestra el número de sujetos obligados  que tienen la atribución de contratar servicios o productos, y que son usuarios de la plataforma."
           
            style="width:220px;float: left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Sujetos obligados<br>contratantes </strong></div> 
           <span class="number-display"><?php echo getD3D("indicador1"); ?></span>
      </div>

      <div class="2u chart-wrapper dc-chart"  data-step="3"
           data-intro="Sujetos obligados solicitantes<br>Muestra el número de sujetos obligados  que tienen la atribución de solicitar servicios o productos, y que son usuarios de la plataforma."
           
           style="width:220px;float: left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Sujetos obligados<br>solicitantes </strong></div> 
           <span class="number-display"><?php echo getD3D("indicador2"); ?></span>
      </div>

      <div class="2u chart-wrapper dc-chart"  data-step="4"
           data-intro="Sujetos obligados solicitantes<br>Muestra el número de sujetos obligados  que tienen la atribución de solicitar y contratar servicios o productos, y que son usuarios de la plataforma."
           
           style="width:220px;float: left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Sujetos obligados<br>solicitantes y contratantes </strong></div> 
           <span class="number-display"><?php echo getD3D("indicador3"); ?></span>
      </div>

     </div>
   </div>

    <iframe src="graphs/treemap2/index.php?f=so.json" style="width:100%;height:555px;" frameborder="0" scrolling=auto  
            data-step="4"
            data-intro="Muestra los  sujetos obligados 	que hayan ejercido recursos en publicidad oficial, al periodo seleccionado."> </iframe>

<br><br><br><br>
<div style="width:90%;"  
     data-step="5"
     data-intro="Se muestran enlistados los sujetos obligados, así como el presupuesto ejercido en publicidad oficial por cada uno de ellos.">

          <h2>Detalle de sujetos obligados</h2><br>

<?php
    $debug_file_name = 'V->'.basename(__FILE__, ".php").'->> '; 
    include_once(DIR_ROOT . 'xcrud/xcrud.php');
    $xcrud = Xcrud::get_instance();
    $xcrud->table('vsujetosobligados');
    if (getD3D("Ejercicio")<>'') {
       $xcrud->where('`Ejercicio` = ' . getD3D("Ejercicio"));
    }   
        
    $xcrud->columns('ejercicio,funcion,orden,estado,nombre,siglas,monto_total');
    $xcrud->unset_title();
    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->default_tab('Sujetos obligados');

    $xcrud->label('id_so_atribucion','Función');
    $xcrud->label('funcion','Función');
    $xcrud->label('monto_total','Monto total');
    $xcrud->label('id_so_orden_gobierno','Orden');
    $xcrud->label('id_so_estado','Estado');
    $xcrud->label('nombre_sujeto_obligado','Nombre');
    $xcrud->label('siglas_sujeto_obligado','Siglas');
    $xcrud->label('url_sujeto_obligado','URL de página');    
    $xcrud->change_type('monto_total', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2 ));
    $xcrud->sum('monto_total','align-center');
    $xcrud->column_width('monto_total','170px'); 

    $xcrud->button( URL_ROOT .'Sys_Detalle6?so={id_sujeto_obligado}','Sujeto detalle','icon-link','',array('target'=>'_new'));


    echo $xcrud->render();
?>
</center>
    <script src='graphs/campanasarbol/js/d3.v3.min.js' type='text/javascript'></script>
    <script src='graphs/campanasarbol/js/underscore-min.js' type='text/javascript'></script>
    <script src='graphs/campanasarbol/js/facebox.js' type='text/javascript'></script>
    <script src='graphs/campanasarbol/js/budget.js' type='text/javascript'></script>
<script>
	$('#Ejercicio').change(function() {
	   window.location = 'Sys_Screen?v=Sujetos&g=pages&e=' + $(this).val();
	});
</script>
<script src="graphs/tablero/js/intro.js" type="text/javascript"></script>

</body>
</html>
