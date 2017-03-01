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
   h2 {
    color: #01AECE;
    font-family: 'Lato', sans-serif;
   }
   table {
      font-size: small !important;
   }
</style>
   <meta charset='utf-8'>
</head>
<body class='container'>
<div style="width:80%;margin-left:10%;"  
     data-step="5"
     data-intro="Se muestran enlistados los sujetos obligados, así como el presupuesto ejercido en publicidad oficial por cada uno de ellos.">
   <center>
      <h2>Detalle del sujeto obligado</h2><br>
   </center>
<?php
    $debug_file_name = 'V->'.basename(__FILE__, ".php").'->> '; 
if (isset($_GET["so"])) {
    include_once(DIR_ROOT . 'xcrud/xcrud.php');
    $xcrud = Xcrud::get_instance();
    $xcrud->table('tab_sujetos_obligados');
        
    $xcrud->unset_title();
    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->unset_list();
    $xcrud->fields('id_so_atribucion, id_so_orden_gobierno, id_so_estado, nombre_sujeto_obligado, siglas_sujeto_obligado, url_sujeto_obligado, Órdenes de compra asociadas al sujeto obligado, Contratos asociados al sujeto obligado');


    $xcrud->label('id_so_atribucion','Función');
    $xcrud->label('id_so_orden_gobierno','Orden');
    $xcrud->label('id_so_estado','Estado');
    $xcrud->label('nombre_sujeto_obligado','Nombre del sujeto obligado');
    $xcrud->label('siglas_sujeto_obligado','Siglas del sujeto obligado');
    $xcrud->label('url_sujeto_obligado','URL de la página del sujeto obligado');    
    $xcrud->label('ordenes','Órdenes de compra asociadas al sujeto obligado');    
    $xcrud->label('contratos','Contratos asociados al sujeto obligado');    

    $xcrud->relation('id_so_atribucion','cat_so_atribucion','id_so_atribucion','nombre_so_atribucion');
    $xcrud->relation('id_so_orden_gobierno','cat_so_ordenes_gobierno','id_so_orden_gobierno','nombre_so_orden_gobierno');
    $xcrud->relation('id_so_estado','cat_so_estados','id_so_estado','nombre_so_estado');

    $xcrud->column_pattern('url_sujeto_obligado', '<a href="{url_sujeto_obligado}" target="_new" style="color:#000;">{url_sujeto_obligado}</a>');

    $xcrud->subselect('Órdenes de compra asociadas al sujeto obligado','select count(*) as ordenes from tab_ordenes_compra as a where a.id_contrato = 1 and a.id_so_contratante =  {id_sujeto_obligado} and id_orden_compra > 1'); 

    $xcrud->subselect('Contratos asociados al sujeto obligado','select count(*) as contratos from tab_contratos as a where a.id_so_contratante =  {id_sujeto_obligado} and a.id_contrato > 1'); 


/*

En el "detalle del sujeto" agregar cifras destacadas, 
	Órdenes de compra asociados al sujeto obligado, 
	contratos asociados al sujeto obligado. 
	Agregar link único a la sección de “Contratos y órdenes de compra” hacia el detalle del contrato y a la orden de compra para abrirlos en otra ventana según corresponda.
*/

    echo $xcrud->render('view', $_GET["so"]);

    $contratos = Xcrud::get_instance();
    $contratos->table('vlista_contratos');
?>
   <center>
      <h2>Contratos asociados al sujeto obligado</h2><br>
   </center>
<?php
    $contratos->unset_remove();
    $contratos->unset_title();

    if (getD3D("Ejercicio")<>'') {
       $contratos->where('ejercicio = ' . getD3D("Ejercicio") . ' and contratante = (select nombre_sujeto_obligado from tab_sujetos_obligados where id_sujeto_obligado = ' . $_GET["so"]  . ')');
    } else {
       $contratos->where('contratante = (select nombre_sujeto_obligado from tab_sujetos_obligados where id_sujeto_obligado = ' . $_GET["so"]  . ')' );
    }

    $contratos->columns('ejercicio, trimestre, numero_contrato, solicitante, contratante, proveedor, monto_contrato, monto_ejercido');

    $contratos->column_name('numero_contrato','Contrato');
    $contratos->column_name('contratante','Sujeto obligado contratante/ordenante');
    $contratos->column_name('solicitante','Sujeto obligado solicitante'); 	 
    $contratos->column_name('monto_contrato','Monto total de contrato');
    $contratos->column_name('monto_ejercido','Monto total ejercido');
    $contratos->column_name('proveedor','Proveedor');
    $contratos->change_type('monto_contrato', 'price', '0', array('prefix'=>'$ ', 'decimals'=>0));
    $contratos->change_type('monto_ejercido', 'price', '0', array('prefix'=>'$ ', 'decimals'=>0));   
    $contratos->sum('monto_contrato');
    $contratos->sum('monto_ejercido');
    $contratos->button( URL_ROOT .'Sys_Detalle4?contrato={id_contrato}','contratoDetalle','icon-link','',array('target'=>'_new'));
    echo $contratos->render();

    $oc = Xcrud::get_instance();
    $oc->table('vlista_oc');
    $oc->unset_title();    
    $oc->unset_remove();
    if (getD3D("Ejercicio")<>'') {
       $oc->where('ejercicio = ' . getD3D("Ejercicio") . ' and contratante = (select nombre_sujeto_obligado from tab_sujetos_obligados where id_sujeto_obligado = ' . $_GET["so"]  . ')' );
    } else {
       $oc->where('contratante = (select nombre_sujeto_obligado from tab_sujetos_obligados where id_sujeto_obligado = ' . $_GET["so"]  . ')' );
    }

?>
   <center>
      <h2>Órdenes de compra asociadas al sujeto obligado</h2><br>
   </center>
<?php
    $oc->columns('ejercicio, trimestre, numero_orden_compra, solicitante, contratante, proveedor, monto_ejercido');
    $oc->column_name('proveedor','Proveedor');
    $oc->column_name('numero_orden_compra','Orden de compra');    
    $oc->column_name('contratante','Sujeto obligado contratante/ordenante');
    $oc->column_name('solicitante','Sujeto obligado solicitante'); 	 
    $oc->column_name('monto_ejercido','Total ejercido');
    $oc->change_type('monto_ejercido', 'price', '0', array('prefix'=>'$ ', 'decimals'=>0));   
    $oc->sum('monto_ejercido');
    $oc->button( URL_ROOT .'Sys_Detalle4?oc={id_orden_compra}','ocDetalle','icon-link','',array('target'=>'_new'));
    $oc->column_width('monto_ejercido','130px');    

    echo $oc->render();

}
?>
</body>
</html>
