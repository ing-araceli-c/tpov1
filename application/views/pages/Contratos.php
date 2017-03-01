<?php getD3D("indicador1"); ?>

<center>
<script>
	function resizeIframe(obj) {
      obj.style.height = (obj.contentWindow.document.body.scrollHeight+70) + 'px';
   }
</script>
   <style>
   h2 {
    color: #01AECE;
    font-family: 'Lato', sans-serif;
   }
   table {
      font-size: small !important;
   }
   </style>

<link rel="stylesheet" href="graphs/tablero/css/dc.css" />
<link rel="stylesheet" href="graphs/tablero/css/stylenew.css" />
<link rel="stylesheet" href="graphs/tablero/css/introjs.css" />
<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<div class="container">


      <center>
            <div class="col-md-12 espacio">
                 <h3 class="docs-header">.</h3>
                 <div class="btn-group" aria-label="Basic example" role="group">
                    <a class="btn-outline-ayuda" role="button" href="#" autofocus onclick="javascript:introJs().setOption('showProgress', true).start();">
                      Ayuda
                    </a>
                    <a class="btn-outline-descarga" role="button" href="Sys_Export?exp=contratosyordenes" data-step="6"
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
           style="width:215px;height:77px;" id="Ejercido"> 
        <div class="chart-title" style="margin-top:-3;"> <strong> Ejercicio </strong> </div> 
        <select class="dc-select-menu" id="Ejercicio" >
           <option value="">Todos</option>
           <?php echo getD3D("ListaEjercicios"); ?>
        </select>
      </div>      
      <div class="2u chart-wrapper dc-chart" data-step="2"
           data-intro="Contratos<br>Muestra el número total de contratos en el periodo seleccionado."
           style="width:215px;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong>Contratos</strong></div> 
           <span class="number-display"><?php echo getD3D("indicador1"); ?></span>
      </div>

      <div class="2u chart-wrapper dc-chart" data-step="3"
           data-intro="Órdenes de compra<br>
Muestra el número de órdenes de compra que no están asociadas a un contrato, las órdenes de compra pueden ser órdenes de transmisión para radio y televisión, órdenes de inserción para medios impresos, órdenes de servicios para medios complementarios, internet y cine, en el periodo seleccionado."
      
      style="width:215px;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong>Órdenes de compra</strong></div> 
           <span class="number-display"><?php echo getD3D("indicador2"); ?></span>
      </div>

      <div class="2u chart-wrapper dc-chart" data-step="4"
           data-intro="Monto total gastado<br>Muestra el monto total gastado en contratos y órdenes de compra que no están asociadas a un contrato, en el periodo seleccionado."      
           style="width:215px;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong>Monto total gastado ($)</strong></div> 
           <span class="number-display"><?php echo number_format(getD3D("indicador3"),0,',',','); ?> k</span>
      </div>
     </div>
   </div>
   </center>
   <center>
      <!--div data-step="5" data-intro="Se muestran la gráfica de contratos y órdenes de compra por proveedor.">
   <iframe src="graphs/contratosyoc/index.php" frameborder="0" scrolling="no" onload="resizeIframe(this)" style="width:90%;" /> 
   </iframe>
      <div-->
   </center>
   <div class="page">
      <div style="width:90%;margin:auto;margin-top:150px;" data-step="5" data-intro="Se muestran contratos y órdenes de compra por proveedor, así como el monto ejercido.">
      <br>
<?php
    include_once(DIR_ROOT . 'xcrud/xcrud.php');

    $contratos = Xcrud::get_instance();
    $contratos->table('vlista_contratos');
    $contratos->table_name('Contratos');    
    $contratos->unset_remove();
    $contratos->unset_title();
?>
<center>
          <h2>Contratos</h2><br>
</center>
<?php
    if (getD3D("Ejercicio")<>'') {
       $contratos->where('ejercicio = ' . getD3D("Ejercicio") );
    }

    $contratos->columns('ejercicio, trimestre, numero_contrato, solicitante, contratante, proveedor, monto_contrato, monto_ejercido');

    $contratos->column_name('numero_contrato','Contrato');
    $contratos->column_name('contratante','Sujeto obligado contratante/ordenante');
    $contratos->column_name('solicitante','Sujeto obligado solicitante'); 	 
    $contratos->column_name('monto_contrato','Monto total de contrato');
    $contratos->column_name('monto_ejercido','Monto total ejercido');
    $contratos->column_name('proveedor','Proveedor');
    $contratos->change_type('monto_contrato', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $contratos->change_type('monto_ejercido', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));   
    $contratos->sum('monto_contrato');
    $contratos->sum('monto_ejercido');
    $contratos->button( URL_ROOT .'Sys_Detalle4?contrato={id_contrato}','contratoDetalle','icon-link','',array('target'=>'_new'));
    echo $contratos->render();

    $oc = Xcrud::get_instance();
    $oc->table('vlista_oc');
    $oc->unset_remove();
    if (getD3D("Ejercicio")<>'') {
       $oc->where('ejercicio = ' . getD3D("Ejercicio") );
    } 
    $oc->unset_title();
?>
   <center>
      <h2>Órdenes de compra</h2><br>
   </center>
<?php

    $oc->columns('ejercicio, trimestre, numero_orden_compra, solicitante, contratante, proveedor, monto_ejercido');

    $oc->column_name('proveedor','Proveedor');
    $oc->column_name('numero_orden_compra','Orden de compra');    
    $oc->column_name('contratante','Sujeto obligado contratante/ordenante');
    $oc->column_name('solicitante','Sujeto obligado solicitante'); 	 
    $oc->column_name('monto_ejercido','Total ejercido');
    $oc->change_type('monto_ejercido', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));   
    $oc->sum('monto_ejercido');
    $oc->button( URL_ROOT .'Sys_Detalle4?oc={id_orden_compra}','ocDetalle','icon-link','',array('target'=>'_new'));
    $oc->column_width('monto_ejercido','130px');    
    echo $oc->render();

?>
      </div>
   </div>

<script src="graphs/tablero/js/intro.js" type="text/javascript"></script>
<script>
	$('#Ejercicio').change(function() {
	   window.location = 'Sys_Screen?v=Contratos&g=pages&e=' + $(this).val();
	});
</script>
</center>

