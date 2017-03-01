<html>
<head>
   <link rel="stylesheet" href="graphs/tablero/css/dc.css" />
   <link rel="stylesheet" href="graphs/tablero/css/stylenew.css" />
   <link rel="stylesheet" href="graphs/tablero/css/introjs.css" />
   <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
   <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
   <meta charset='utf-8'>
<style>
   .intro_button{
      margin-top: 38px;
      margin: center;
      background-color: #01AECE;
      color: white;
   }
   h2 {
    color: #01AECE;
    font-family: 'Lato', sans-serif;
   }
   table {
      font-size: small !important;
   }
</style>
</head>
<body class='container' style="heigth:1000px;">
      <center>
            <div class="col-md-12 espacio">
                 <h3 class="docs-header">.</h3>
                 <div class="btn-group" aria-label="Basic example" role="group">
                    <a class="btn-outline-ayuda" role="button" href="#" autofocus onclick="javascript:introJs().setOption('showProgress', true).start();">
                      Ayuda
                    </a>
                    <a class="btn-outline-descarga" role="button" href="Sys_Export?exp=campanasyavisos"  data-step="8"
        data-intro="Datos abiertos: descarga los datos publicados en esta página en formato CSV para facilitar su uso y reutilización.">
                       Descargar Datos
                    </a>
                </div>
            </div>
      </center>

   <center>
   <div class="row" style="width:1000px;margin-top:50px;heigth:2000px;">
      <div class="2u chart-wrapper dc-chart" data-step="1"
           data-intro="Ejercicio<br>Selecciona un ejercicio fiscal para visualizar las cifras correspondientes a ese año. También puedes seleccionar “Todos” los años."
           style="width:215px;float:left;height:77px;" id="Ejercido"> 
        <div class="chart-title" style="margin-top:-3;"> <strong> Ejercicio </strong> </div> 
        <select class="dc-select-menu" id="Ejercicio" >
           <option value="">Todos</option>
           <?php echo getD3D("ListaEjercicios"); ?>
        </select>
      </div>      
      <div class="2u chart-wrapper dc-chart" data-step="2"
           data-intro="Campañas<br>Muestra el total de campañas en el periodo seleccionado." 
           style="width:215px;float: left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Campañas </strong></div> 
           <span class="number-display"><?php echo getD3D("indicador1"); ?></span>
      </div>

      <div class="2u chart-wrapper dc-chart" data-step="3"
           data-intro="Avisos institucionales<br>Muestra el total de avisos institucionales en el periodo seleccionado."       
           style="width:215px;float: left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Avisos institucionales </strong></div> 
           <span class="number-display"><?php echo getD3D("indicador2"); ?></span>
      </div>

      <div class="2u chart-wrapper dc-chart" data-step="4"
           data-intro="Monto total ejercido<br>Muestra el monto total ejercido en avisos institucionales y campañas, en el periodo seleccionado."       
           style="width:215px;float: left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Monto total ejercido ($) </strong></div> 
           <span class="number-display"><?php echo number_format(getD3D("indicador3"),0,',',','); ?> k
      </div>
     </div>

<br><br><br>  <br><br>
   <!--div class="2u chart-wrapper dc-chart" style="width:215px;heigth:200px;background:#01AECE;" id="Tipos"> 
      <div class="row"  data-step="5"
        data-intro="Selecciona una opción para ver los resultados por sujeto obligado, proveedor o tipo de servicio."    
        style="width:215px;margin-top:-10px;heigth:200px;">
        <div class="chart-title" style="margin-top:-3;"> <strong> Seleccionar </strong> </div> 
        <select class="dc-select-menu" id="tipo" >
           <option value="Sujeto Obligado">Sujeto Obligado</option>
           <option value="Sujeto Obligado">Proveedor</option>
           <option value="Sujeto Obligado">Tipo de servicio</option>
        </select>
      </div>
   </div-->
</center>

<center data-step="6" data-intro="Muestra las campañas o avisos institucionales al periodo seleccionado">
    <iframe src="graphs/treemap2/index.php?f=ca_so.json" style="width:100%;height:555px;" frameborder="0" scrolling=auto > </iframe>
</center>
<center>
<br><br><br>
<div style="width:90%;" data-step="7" data-intro="Se muestran enlistadas las campañas y avisos institucionales, así como el presupuesto  ejercido en cada elemento por trimestre y al período seleccionado.">
<?php
    include_once(DIR_ROOT . 'xcrud/xcrud.php');

/*** Campañas ***/
    $campana = Xcrud::get_instance();
/* validar vista que muestre las que no tiene detalle de factura */
    $campana->table('vcampanasyavisos');    
    if (getD3D("Ejercicio")<>'') {
       $campana->where('ejercicio = ' . getD3D("Ejercicio") . ' and id_campana_tipo = 2');
    } else {
       $campana->where('id_campana_tipo = 2');
    }  

    $campana->unset_title();    
?>
   <center>
      <h2>Campañas</h2><br>
   </center>
<?php
    $campana->columns('ejercicio,trimestre,nombre_campana_tipo,nombre_campana_aviso,contratante,solicitante,nombre_tipo_tiempo,monto_total');    
    $campana->unset_remove();
    $campana->unset_edit();
    $campana->unset_add();  
    $campana->column_name('ejercicio','Ejercicio');
    $campana->column_name('trimestre','Trimestre'); 
    $campana->column_name('nombre_campana_tipo','Tipo');
    $campana->column_name('nombre_campana_aviso','Nombre de la campaña o aviso institucional');
    $campana->column_name('contratante','Contratante');
    $campana->column_name('solicitante','Solicitante');
    $campana->column_name('nombre_tipo_tiempo','Tiempo oficial');
    $campana->column_name('monto_total','Monto total ejercido');
    $campana->change_type('monto_total', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2 ));
    $campana->button( URL_ROOT .'Sys_Detalle5?campana={id_campana_aviso}','Detalle','icon-link','',array('target'=>'_new'));
    $campana->sum('monto_total','align-center');
    $campana->column_width('monto_total','150px'); 
    echo $campana->render();


/*** Avisos ***/
    $avisos = Xcrud::get_instance();
    $avisos->table('vcampanasyavisos');    
    if (getD3D("Ejercicio")<>'') {
       $avisos->where('ejercicio = ' . getD3D("Ejercicio") . ' and id_campana_tipo = 1');
    } else {
       $avisos->where('id_campana_tipo = 1');
    }  

    $avisos->unset_title();    
?>
   <center>
      <h2>Avisos institucionales</h2><br>
   </center>
<?php
    $avisos->columns('ejercicio,trimestre,nombre_campana_tipo,nombre_campana_aviso,contratante,solicitante,nombre_tipo_tiempo,monto_total');    
    $avisos->unset_remove();
    $avisos->unset_edit();
    $avisos->unset_add();  
    $avisos->column_name('ejercicio','Ejercicio');
    $avisos->column_name('trimestre','Trimestre'); 
    $avisos->column_name('nombre_campana_tipo','Tipo');
    $avisos->column_name('nombre_campana_aviso','Nombre de la campaña o aviso institucional');
    $avisos->column_name('contratante','Contratante');
    $avisos->column_name('solicitante','Solicitante');
    $avisos->column_name('nombre_tipo_tiempo','Tiempo oficial');
    $avisos->column_name('monto_total','Monto total ejercido');
    $avisos->change_type('monto_total', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2 ));
    $avisos->button( URL_ROOT .'Sys_Detalle5?campana={id_campana_aviso}','Detalle','icon-link','',array('target'=>'_new'));
    $avisos->sum('monto_total','align-center');
    echo $avisos->render();

?>

</div>
</center>
<script>
	$('#Ejercicio').change(function() {
	   window.location = 'Sys_Screen?v=Campanasavisos&g=pages&e=' + $(this).val();
	});
</script>
<script src="graphs/tablero/js/intro.js" type="text/javascript"></script>
</body>
</html>
