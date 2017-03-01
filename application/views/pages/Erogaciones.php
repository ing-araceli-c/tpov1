   <link rel="stylesheet" href="graphs/tablero/css/dc.css" />
   <link rel="stylesheet" href="graphs/tablero/css/stylenew.css" />
   <link rel="stylesheet" href="graphs/tablero/css/introjs.css" />
   <!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
   <!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
<center>
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

      <center>
            <div class="col-md-12 espacio">
                 <h3 class="docs-header">.</h3>
                 <div class="btn-group" aria-label="Basic example" role="group">
                    <a class="btn-outline-ayuda" role="button" href="#" autofocus onclick="javascript:introJs().setOption('showProgress', true).start();">
                      Ayuda
                    </a>
                    <a class="btn-outline-descarga" role="button" href="Sys_Export?exp=erogaciones"  data-step="6"
        data-intro="Datos abiertos: descarga los datos publicados en esta página en formato CSV para facilitar su uso y reutilización.">
                       Descargar Datos
                    </a>
                </div>
            </div>
      </center>
      
   <center>
   <div class="row" style="width:1000px;margin-top:50px;">
      <div class="2u chart-wrapper dc-chart" data-step="1"
           data-intro="Ejercicio<br> Selecciona un ejercicio fiscal para visualizar las cifras correspondientes a ese año. También puedes seleccionar “Todos” los años."                  
           style="width:300px;float:left;height:77px;" id="Ejercido"> 
        <div class="chart-title" style="margin-top:-3;"> <strong> Ejercicio </strong> </div> 
        <select class="dc-select-menu" id="Ejercicio" >
           <option value="">Todos</option>
           <?php echo getD3D("ListaEjercicios"); ?>
        </select>
      </div>      
      <div class="2u chart-wrapper dc-chart" data-step="2"
           data-intro="Proveedores<br>Muestra el número de facturas del periodo seleccionado."                  
           style="width:300px;float: left;height:77px;" id="Ejercido"> 
        <div class="chart-title"> <strong> Facturas </strong></div> 
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
<br><br><br><br>

   <center>
<div
     data-step="4"
     data-intro="Se muestran las erogaciones del sujeto obligado por mes.">
   <iframe src="graphs/erogaciones/index.php" frameborder="0" scrolling="no" onload="resizeIframe(this)" style="width:90%;height:400px;" /> 
</div>
   </iframe>
   </center>
<br><br>
<div style="width:90%;" 
     data-step="5"
     data-intro="Se muestran los registros de cada erogación realizada al periodo seleccionado.">
<?php
    include_once(DIR_ROOT . 'xcrud/xcrud.php');
    $xcrud = Xcrud::get_instance();
    $xcrud->table('vfacturas');
    if (getD3D("Ejercicio")<>'') {
       $xcrud->where('`Ejercicio` = ' . getD3D("Ejercicio"));
    }       
    $xcrud->columns('ejercicio,trimestre,proveedor, numero_factura,fecha_erogacion,monto_ejercido');  
    $xcrud->unset_title();
    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->column_name('numero_factura','Clave única');
	 $xcrud->column_name('fecha_erogacion','Fecha de erogación');
	 $xcrud->column_name('monto_ejercido','Monto total');
    $xcrud->sum('monto_ejercido','align-center');
    $xcrud->change_type('monto_ejercido', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $xcrud->button( URL_ROOT .'Sys_Detalle7?factura={id_factura}','Detalle','icon-link','',array('target'=>'_new'));
    $xcrud->column_name('proveedor','Proveedor');
  
    echo $xcrud->render();
?>
</div>
</center>

<script src="graphs/tablero/js/intro.js" type="text/javascript"></script>

<script>
	$('#Ejercicio').change(function() {
	   window.location = 'Sys_Screen?v=Erogaciones&g=pages&e=' + $(this).val();
	});
</script>


