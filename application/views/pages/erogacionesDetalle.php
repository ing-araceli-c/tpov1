   <style>
   h2 {
    color: #01AECE;
    font-family: 'Lato', sans-serif;
   }
   table {
      font-size: small !important;
   }
   </style>

<center>
   <div class="page" style="width:80%;">
      <div style="width:100%;margin:auto;">
      <br>
<?php
if (isset($_GET['factura'])) {    
    include_once(DIR_ROOT . 'xcrud/xcrud.php');

/* Facturas  */
    $facturas = Xcrud::get_instance();    
    $facturas->table('tab_facturas');
    $facturas->table_name('Facturas');
    $facturas->where('id_factura = ', $_GET['factura']);
    $facturas->unset_title();
    $facturas->unset_edit();
    $facturas->unset_add();
    $facturas->unset_list();
    $facturas->unset_remove();

    
    $facturas->after_upload('after_upload_factura', 'functions.php');
    $facturas->before_insert('validateFacturaI', 'functions.php');
    $facturas->before_update('validateFacturaU', 'functions.php');
    
    $facturas->unset_title();
    $facturas->columns('id_contrato, id_orden_compra, id_ejercicio, id_trimestre, numero_factura, fecha_erogacion, monto_total, active');
    $facturas->subselect('monto_total','SELECT SUM(monto_desglose) FROM tab_facturas_desglose WHERE id_factura = {id_factura} and active=1');
    $facturas->readonly('monto_total');

    $facturas->fields('id_proveedor, Nombre comercial del proveedor, id_contrato, id_orden_compra, id_ejercicio, id_trimestre, id_so_contratante, id_presupuesto_concepto, numero_factura, file_factura_pdf, file_factura_xml, fecha_erogacion, Monto total');

    $facturas->label('id_proveedor','Proveedor');
    $facturas->label('id_contrato','Contrato');
    $facturas->label('id_orden_compra','Orden de compra');
    $facturas->label('id_ejercicio','Ejercicio');
    $facturas->label('id_trimestre','Trimestre');
    $facturas->label('id_so_contratante','Sujeto obligado contratante/ordenante');
    $facturas->label('id_presupuesto_concepto','Partida');
    $facturas->label('numero_factura','Número de factura');
    $facturas->label('fecha_erogacion','Fecha de erogación');
    $facturas->label('monto_total','Monto');
    $facturas->label('file_factura_pdf','Archivo de la factura en PDF');
    $facturas->label('file_factura_xml','Archivo de la factura en XML');

    $facturas->column_tooltip('monto_total','Monto total de la factura, con I.V.A. incluido.');
    $facturas->column_tooltip('id_proveedor','Indica el nombre o razón social del proveedor');
    $facturas->column_tooltip('id_contrato','Clave o número de identificación único del contrato.');
    $facturas->column_tooltip('id_orden_compra','Clave o número de identificación único de la orden de compra.');
    $facturas->column_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $facturas->column_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril - junio, julio -septiembre,  octubre - diciembre ).');
    $facturas->column_tooltip('id_so_contratante','Indica el nombre del sujeto obligado contratante');
    $facturas->column_tooltip('id_presupuesto_concepto','Clasificador por objeto de gasto: el instrumento que permite registrar de manera ordenada, sistemática y homogénea las compras, los pagos y las erogaciones autorizados en capítulos, conceptos y partidas con base en la clasificación económica del gasto.');
    $facturas->column_tooltip('numero_factura','Clave única de la erogación o factura.');
    $facturas->column_tooltip('fecha_erogacion','Indica la fecha de erogación de recursos, con el formato dd/mm/aaaa (por ej. 31/12/2016).');
    $facturas->column_tooltip('file_factura_pdf','Hipervínculo a la factura en formato PDF)');
    $facturas->column_tooltip('file_factura_xml','Hipervínculo a la factura en formato XML)');

    $facturas->relation('id_proveedor','tab_proveedores','id_proveedor','nombre_razon_social');
    $facturas->relation('id_contrato','tab_contratos','id_contrato','numero_contrato');
    $facturas->relation('id_orden_compra','tab_ordenes_compra','id_orden_compra','numero_orden_compra');
    $facturas->relation('id_ejercicio','cat_ejercicios','id_ejercicio','ejercicio');
    $facturas->relation('id_trimestre','cat_trimestres','id_trimestre','trimestre');
    $facturas->relation('id_so_contratante','vso_contratante','id_sujeto_obligado','nombre_sujeto_obligado');
    $facturas->relation('id_presupuesto_concepto','vcapitulo_denominacion','id_presupesto_concepto', 'capitulo_denominacion');
    $facturas->relation('active','sys_active','id_active','name_active');

    $facturas->field_tooltip('monto_total','Monto total de la factura, con I.V.A. incluido.');
    $facturas->field_tooltip('id_proveedor','Indica el nombre de la persona física o moral proveedora del producto o servicio.');
    $facturas->field_tooltip('area_responsable','Área administrativa encargada de solicitar el servicio');

    $facturas->field_tooltip('Nombre comercial del proveedor','Indica el nombre comercial del proveedor del producto o servicio.');

    $facturas->field_tooltip('id_contrato','Clave o número de identificación único del contrato.');
    $facturas->field_tooltip('id_orden_compra','lave o número de identificación único de la orden de compra.');
    $facturas->field_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $facturas->field_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $facturas->field_tooltip('id_so_contratante','Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $facturas->field_tooltip('id_presupuesto_concepto','Indica la clave y el nombre del concepto o partida presupuestal.');
    $facturas->field_tooltip('numero_factura','Clave única de la erogación o factura.');
    $facturas->field_tooltip('fecha_erogacion','Indica la fecha de erogación de recursos, con el formato dd/mm/aaaa (por ej. 15/08/2016).');
    $facturas->field_tooltip('file_factura_pdf','Archivo electrónico de la factura en formato PDF.');
    $facturas->field_tooltip('file_factura_xml','Archivo electrónico de la factura en formato XML.');
    $facturas->field_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');

    $facturas->column_pattern('file_factura_pdf', '<a href="'.URL_DOCS.'data/facturas/{file_factura_pdf}" target="_new_file_factura_pdf">{file_factura_pdf}</a>');

    $facturas->column_pattern('file_factura_xml', '<a href="'.URL_DOCS.'data/facturas/{file_factura_xml}" target="_new_file_factura_xml">{file_factura_xml}</a>');

    $facturas->change_type('monto_total', 'price', '0', array('prefix'=>'$ '));

    $facturas->column_pattern('id_proveedor','{value} <a href="Sys_Detalle2?proveedor={id_proveedor}" target="_proveedor">(Ver detalle)</a>');
    $facturas->column_pattern('id_contrato','{value}  <a href="Sys_Detalle4?contrato={id_contrato}" target="_contrato">(Ver detalle)</a>');
    $facturas->column_pattern('id_orden_compra','{value} <a href="Sys_Detalle4?oc={id_orden_compra}" target="_orden_compra">(Ver detalle)</a>');
    $facturas->column_pattern('id_so_contratante','{value} <a href="Sys_Detalle6?so={id_so_contratante}" target="so_contratante">(Ver detalle)</a>');

    $facturas->condition('id_contrato','=','1','disabled','id_contrato');

    $facturas->field_tooltip('Monto total','Indica el monto total correspondiente a la factura.');

    $facturas->subselect('Monto total','SELECT sum(monto_desglose) FROM tab_facturas_desglose where id_factura = {id_factura}');
    $facturas->change_type('Monto total', 'price', '0', array('prefix'=>'$ '));

    $facturas->subselect('Nombre comercial del proveedor','SELECT nombre_comercial FROM tab_proveedores where id_proveedor = {id_proveedor}');

    echo $facturas->render('view', $_GET['factura']);


    $detalle = Xcrud::get_instance();
    $detalle->table('tab_facturas_desglose');
    $detalle->where('id_factura = ', $_GET['factura']);
    $detalle->table_name('Detalle de factura');

    echo '<h2>Subconceptos de factura asociados a la erogación</h2><br>';
    $detalle->unset_title();
    $detalle->unset_remove();
    $detalle->unset_title();
    $detalle->unset_edit();
    $detalle->unset_add();

    $detalle->columns('id_campana_aviso,  id_servicio_clasificacion, id_servicio_categoria, monto_desglose' );

//Categoría del servicio" y "Categoría"


    $detalle->fields('id_campana_aviso, id_servicio_clasificacion, id_servicio_categoria, id_servicio_subcategoria, id_servicio_unidad, id_so_solicitante, descripcion_servicios, monto_desglose, cantidad, precio_unitarios, area_responsable' );

    $detalle->label('area_responsable','Área administrativa encargada de solicitar el servicio');
    $detalle->field_tooltip('area_responsable','Área administrativa encargada de solicitar el servicio');

    $detalle->column_tooltip('id_campana_aviso','Indica el nombre de la Campaña o Aviso Institucional');
    $detalle->column_tooltip('id_so_solicitante','Indica el nombre del sujeto obligado solicitante');
    $detalle->column_tooltip('descripcion_servicios','Descripción del servicio o producto adquirido');
    $detalle->column_tooltip('cantidad','Indica la cantidad del producto o servicio adquirido');
    $detalle->column_tooltip('precio_unitarios','Indica el precio unitario del producto o servicio, con IVA incluido.');
    $detalle->column_tooltip('monto_desglose','Indica el monto correspondiente a cada subconcepto, calculado con la multiplicación de la cantidad por el precio unitario con IVA incluido del producto o servicio adquirido.');

    $detalle->label('id_campana_aviso','Campaña o aviso institucional');
    $detalle->label('id_ejercicio','Ejercicio');
    $detalle->label('id_trimestre','Trimestre');
    $detalle->label('id_so_solicitante','Sujeto obligado solicitante');
    $detalle->label('cantidad','Cantidad');
    $detalle->label('descripcion_servicios','Descripción del servicio o producto adquirido');
    $detalle->label('precio_unitarios','Precio unitario con I.V.A incluido');
    $detalle->label('monto_desglose','Monto del subconcepto');
    $detalle->label('active','Estatus');
    $detalle->label('clasificacion','Categoría del servicio');
    $detalle->label('subclasificacion','Subcategoría del servicio');
    $detalle->label('unidad','Unidad');
    $detalle->label('id_servicio_clasificacion','Clasificación');
    $detalle->label('id_servicio_categoria','Categoría del servicio');
    $detalle->label('id_servicio_subcategoria','Subcategoría del servicio');
    $detalle->label('id_servicio_unidad','Unidad');
    $detalle->label('monto_desglose','Monto del subconcepto');

    $detalle->field_tooltip('id_campana_aviso','Indica el nombre de la campaña o aviso institucional  a la que pertenece.');
       $detalle->field_tooltip('id_servicio_clasificacion','Indica el nombre de la clasificación general del servicio (Servicios de difusión en medios de comunicación; Otros servicios asociados a la comunicación).');
    $detalle->field_tooltip('id_servicio_categoria','Indica el nombre de la categoría del servicio de acuerdo a su clasificación (Análisis, estudios y métricas, Cine, Impresiones, Internet, etc).');
    $detalle->field_tooltip('id_servicio_subcategoria','Indica el nombre de la subcategoría del servicio (Artículos promocionales, Cadenas radiofónicas, Carteles o posters).');
    $detalle->field_tooltip('id_servicio_unidad','Indica la unidad de medida del producto o servicio asociado a la subcategoría.');
    $detalle->field_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $detalle->field_tooltip('descripcion_servicios','Breve descripción del servicio o producto adquirido.');
    $detalle->field_tooltip('cantidad','Indica la cantidad del servicio o producto adquirido.');
    $detalle->field_tooltip('precio_unitarios','Indica el precio unitario del producto o servicio, con I.V.A. incluido.');
    $detalle->field_tooltip('monto_desglose','Indica el monto correspondiente al subconcepto de la factura.');
    $detalle->field_tooltip('monto_desglose','Monto del subconcepto');

    $detalle->relation('id_campana_aviso','tab_campana_aviso','id_campana_aviso','nombre_campana_aviso');
    $detalle->relation('id_so_solicitante','vso_solicitante','id_sujeto_obligado','nombre_sujeto_obligado');

    $detalle->relation('id_servicio_clasificacion','cat_servicios_clasificacion','id_servicio_clasificacion', 'nombre_servicio_clasificacion');
    $detalle->relation('id_servicio_categoria','cat_servicios_categorias','id_servicio_categoria','nombre_servicio_categoria',
                       'active=1', '', '', '', '', 'id_servicio_clasificacion','id_servicio_clasificacion');
    $detalle->relation('id_servicio_subcategoria','cat_servicios_subcategorias','id_servicio_subcategoria','nombre_servicio_subcategoria',
                       'active=1', '', '', '', '', 'id_servicio_categoria','id_servicio_categoria');
    $detalle->relation('id_servicio_unidad','cat_servicios_unidades','id_servicio_unidad','nombre_servicio_unidad',
                       'active=1', '', '', '', '', 'id_servicio_subcategoria','id_servicio_subcategoria');     

    $detalle->relation('active','sys_active','id_active','name_active');
    $detalle->change_type('monto_desglose', 'price', '0', array('prefix'=>'$ ', 'decimals'=>0));
    $detalle->change_type('precio_unitarios', 'price', '0', array('prefix'=>'$ ', 'decimals'=>0));   
    $detalle->change_type('numero_partida', 'password', 'sha1');
    $detalle->readonly('monto_desglose');
    echo $detalle->render();
       
}      
?>
      </div>
   </div>
</center>

