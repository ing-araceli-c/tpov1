   <center>
   <style>
   h2 {
    color: #01AECE;
    font-family: 'Lato', sans-serif;
   }
   table {
      font-size: small !important;
   }
   </style>
   <div class="page">
      <div style="width:90%;margin:auto;" data-step="5" data-intro="Tabla">
          <h2>Información del contrato</h2><br>
<?php
if (isset($_GET['contrato'])) {
    $id = $_GET['contrato'];
    if ($id == 1) {
       echo "<script>parent.window.close();</script>";
    }

    include_once(DIR_ROOT . 'xcrud/xcrud.php');  
    $xcrud = Xcrud::get_instance();
    $xcrud->table('tab_contratos');
    $xcrud->where('id_contrato = ', $id)->where('id_contrato > ', 1);
    $xcrud->table_name('Contratos');
    $xcrud->after_upload('after_upload_contrato', 'functions.php');

    $xcrud->unset_title();
    $xcrud->unset_remove();
    $xcrud->unset_edit();
    $xcrud->unset_add();
    $xcrud->unset_list();
    $xcrud->columns('id_ejercicio, id_trimestre, id_so_contratante, id_so_solicitante, numero_contrato, id_proveedor, monto_contrato, Monto modificado, Monto total, Monto pagado');

    $xcrud->fields('id_ejercicio, id_trimestre, numero_contrato, id_so_contratante, id_so_solicitante, id_proveedor, Nombre comercial del proveedor, fecha_celebracion, objeto_contrato, id_procedimiento, descripcion_justificacion, fundamento_juridico, monto_contrato, Monto total, Monto modificado,  Monto pagado, fecha_inicio, fecha_fin, file_contrato, fecha_validacion, area_responsable, periodo, fecha_actualizacion, 	nota');

    $xcrud->label('id_procedimiento','Procedimiento');
    $xcrud->label('id_proveedor','Proveedor');
    $xcrud->label('id_ejercicio','Ejercicio');
    $xcrud->label('id_trimestre','Trimestre');
    $xcrud->label('id_procedimiento','Tipo de adjudicación');
    $xcrud->label('id_so_contratante','Sujeto obligado contratante');
    $xcrud->label('id_so_solicitante','Sujeto obligado solicitante');
    $xcrud->label('numero_contrato','Número de contrato');
    $xcrud->label('monto_contrato','Monto del contrato');
    $xcrud->label('objeto_contrato','Objeto');
    $xcrud->label('descripcion_justificacion','Descripción');
    $xcrud->label('fundamento_juridico','Fundamento jurídico');
    $xcrud->label('fecha_celebracion','Fecha de celebración');
    $xcrud->label('fecha_inicio','Fecha de inicio');
    $xcrud->label('fecha_fin','Fecha de término');
    $xcrud->label('file_contrato','Vínculo al archivo del contrato');
    $xcrud->label('descripcion_justificacion','Motivo de adjudicación');

    $xcrud->label('fecha_validacion','Fecha de validación');
    $xcrud->label('area_responsable','Área responsable de la información');
    $xcrud->label('periodo','Año');
    $xcrud->label('fecha_actualizacion','Fecha de actualización');
    $xcrud->label('nota','Nota');

    $xcrud->label('active','Estatus');
    $xcrud->subselect('Monto modificado','SELECT SUM(monto_convenio) FROM tab_convenios_modificatorios WHERE id_contrato = {id_contrato} and active=1'); 
    $xcrud->subselect('Monto total','SELECT SUM(monto_convenio)+{monto_contrato} FROM tab_convenios_modificatorios WHERE id_contrato = {id_contrato} and active=1'); 
    $xcrud->subselect('Nombre comercial del proveedor','SELECT nombre_comercial as "Nombre comercial del proveedor" FROM tab_proveedores WHERE id_proveedor = {id_proveedor}'); 



    $xcrud->subselect('Monto pagado','SELECT SUM(a.monto_desglose) FROM tab_facturas_desglose a, tab_facturas b WHERE a.id_factura = b.id_factura and b.id_contrato = {id_contrato}');

    $xcrud->change_type('Monto modificado', 'price', '0', array('prefix'=>'$ '));
    $xcrud->change_type('Monto total', 'price', '0', array('prefix'=>'$ '));
    $xcrud->change_type('Monto pagado', 'price', '0', array('prefix'=>'$ '));

    $xcrud->field_tooltip('fecha_validacion','Fecha de validación');
    $xcrud->field_tooltip('area_responsable','Área responsable de la información');
    $xcrud->field_tooltip('periodo','Año');
    $xcrud->field_tooltip('fecha_actualizacion','Fecha de actualización');
    $xcrud->field_tooltip('nota','Nota');

    $xcrud->column_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $xcrud->column_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $xcrud->column_tooltip('id_so_contratante','Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $xcrud->column_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $xcrud->column_tooltip('numero_contrato','Clave o número de identificación único del contrato.');
    $xcrud->column_tooltip('monto_contrato','Monto total del contrato, con I.V.A. incluido.');
    $xcrud->column_tooltip('Monto modificado','Suma de los  montos de los convenios modificatorios.');
    $xcrud->column_tooltip('Monto total','Suma del monto original del contrato, más el monto modificado.');
    $xcrud->column_tooltip('Monto pagado','Monto pagado al periodo publicado.');
    $xcrud->column_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');

    $xcrud->column_tooltip('id_proveedor','Nombre o razón social del proveedor');
    $xcrud->column_tooltip('descripcion_justificacion','Descripción breve de los motivos que justifican la elección del proveedor');
    $xcrud->column_tooltip('fecha_celebracion','Fecha de firma de contrato, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $xcrud->column_tooltip('objeto_contrato','Indica el objeto del contrato');
    $xcrud->column_tooltip('id_procedimiento','Indica el tipo de procedimiento de contratación  [licitación pública, adjudicación directa, invitación restringida]');
    $xcrud->column_tooltip('fundamento_juridico','Fundamento jurídico del procedimiento de contratación');

    $xcrud->column_tooltip('fecha_inicio','Indica la fecha de inicio de los servicios contratados, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $xcrud->column_tooltip('fecha_fin','Indica la fecha de término de los servicios contratados, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $xcrud->column_tooltip('file_contrato','Archivo contrato en PDF');

    $xcrud->change_type('monto_contrato', 'price', '0', array('prefix'=>'$ '));

    $xcrud->relation('id_ejercicio','cat_ejercicios','id_ejercicio','ejercicio');
    $xcrud->relation('id_trimestre','cat_trimestres','id_trimestre','trimestre');

    $xcrud->relation('id_so_contratante','vso_contratante','id_sujeto_obligado','nombre_sujeto_obligado');

    $xcrud->relation('id_so_solicitante','vso_solicitante','id_sujeto_obligado','nombre_sujeto_obligado');
    $xcrud->relation('id_proveedor','tab_proveedores','id_proveedor','nombre_razon_social');
    $xcrud->relation('id_procedimiento','cat_procedimientos','id_procedimiento','nombre_procedimiento');
    $xcrud->relation('active','sys_active','id_active','name_active');
    $xcrud->column_pattern('file_contrato', '<a href="'.URL_DOCS.'data/contratos/{file_contrato}" target="_new_file_contrato">{file_contrato}</a>');

    $xcrud->field_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $xcrud->field_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $xcrud->field_tooltip('id_so_contratante','Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $xcrud->field_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $xcrud->field_tooltip('numero_contrato','Clave o número de identificación único del contrato.');
    $xcrud->field_tooltip('id_procedimiento','Indica el tipo de procedimiento administrativo que se llevó a cabo para la contratación.');
    $xcrud->field_tooltip('id_proveedor','Indica el nombre de la persona física o moral proveedora del producto o servicio.');
    $xcrud->field_tooltip('objeto_contrato','Indica las obligaciones  creadas y la razón de ser del contrato.');
    $xcrud->field_tooltip('descripcion_justificacion','Descripción breve de las razones que justifican la elección de tal proveedor.');
    $xcrud->field_tooltip('fundamento_juridico','Fundamento jurídico del procedimiento de contratación.');
    $xcrud->field_tooltip('fecha_celebracion','Fecha de firma de contrato, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $xcrud->field_tooltip('fecha_inicio','Indica la fecha de inicio de servicios.');
    $xcrud->field_tooltip('fecha_fin','Indica la fecha de finalización de los servicios.');
    $xcrud->field_tooltip('monto_contrato','Indica el monto total del contrato con I.V.A. incluido.');
    $xcrud->field_tooltip('file_contrato','Archivo de la versión pública del contrato en formato PDF.');
    $xcrud->field_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');
    $xcrud->field_tooltip('Monto modificado', 'Monto modificado');
    $xcrud->field_tooltip('Monto total', 'Monto total');
    $xcrud->field_tooltip('Monto pagado', 'Monto pagado');
    $xcrud->field_tooltip('Nombre comercial del proveedor', 'Nombre comercial del proveedor');
    $xcrud->column_pattern('file_contrato', '<a href="'.URL_DOCS.'data/contratos/{file_contrato}" target="_new_file_contrato">{file_contrato}</a>');

    $xcrud->column_pattern('id_proveedor','{value} <a href="Sys_Detalle2?proveedor={id_proveedor}" target="_proveedor">(Ver detalle)</a>');
    $xcrud->column_pattern('id_so_contratante','{value} <a href="Sys_Detalle6?so={id_so_contratante}" target="_contratante">(Ver detalle)</a>');
    $xcrud->column_pattern('id_so_solicitante','{value} <a href="Sys_Detalle6?so={id_so_solicitante}" target="_solicitante">(Ver detalle)</a>');

    echo $xcrud->render('view', $id);

    echo '<h2>Convenios modificatorios asociados al contrato</h2><br>';

    $convenios = Xcrud::get_instance();
    $convenios->table('tab_convenios_modificatorios');
    $convenios->where('id_contrato = ', $id);
    $convenios->unset_title();
    $convenios->unset_remove();
    $convenios->unset_edit();
    $convenios->unset_add();
    $convenios->columns('id_ejercicio, id_trimestre, numero_convenio, monto_convenio' );
    $convenios->table_name('Convenios modificatorios');

    $convenios->fields('
id_ejercicio, 
id_trimestre, 
numero_convenio, 
objeto_convenio, 
fundamento_juridico, 
fecha_celebracion, 
monto_convenio, 
file_convenio,
fecha_validacion, 
area_responsable, 
periodo, 
fecha_actualizacion, 
nota' );
/*
ejercicio, 
trimestre, 
convenio modificatorio, 
objeto, 
fundamento jurídico, 
fecha de celebración, 
monto, 
archivo del convenio en PDF, 
fecha de validación, 
área responsable, 
año, 
fecha de actualización, 
nota
*/                         
    $convenios->label('file_convenio','Archivo del convenio en PDF');    
    $convenios->label('id_ejercicio','Ejercicio');
    $convenios->label('id_trimestre','Trimestre');
    $convenios->label('numero_convenio','Convenio modificatorio');
    $convenios->label('objeto_convenio','Objeto');
    $convenios->label('fundamento_juridico','Fundamento jurídico');
    $convenios->label('fecha_celebracion','Fecha de celebración');
    $convenios->label('monto_convenio','Monto');
    $convenios->label('fecha_validacion','Fecha de validación');
    $convenios->label('fecha_actualizacion','Fecha de actualización');
    $convenios->label('area_responsable','Área responsable');
    $convenios->label('periodo','Año');


    $convenios->label('active','Estatus');

    $convenios->column_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $convenios->column_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $convenios->column_tooltip('numero_convenio','Número del convenio');
    $convenios->column_tooltip('objeto_convenio','Indica el objeto del contrato');
    $convenios->column_tooltip('fundamento_juridico','Fundamento jurídico del procedimiento de contratación');
    $convenios->column_tooltip('fecha_celebracion','Indica la fecha del concenio, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $convenios->column_tooltip('monto_convenio','Indica el monto del convenio modificatorio, en caso que aplique.');

    $convenios->relation('id_ejercicio','cat_ejercicios','id_ejercicio','ejercicio');
    $convenios->relation('id_trimestre','cat_trimestres','id_trimestre','trimestre');
    $convenios->relation('active','sys_active','id_active','name_active');

    $convenios->field_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $convenios->field_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $convenios->field_tooltip('numero_convenio',' Clave o número de identificación único del convenio.');
    $convenios->field_tooltip('monto_convenio','Indica el monto total del convenio modificatorio con I.V.A. incluido.');
    $convenios->field_tooltip('objeto_convenio','Indica el objeto del contrato');
    $convenios->field_tooltip('fundamento_juridico','Fundamento jurídico del procedimiento de contratación');
    $convenios->field_tooltip('fecha_celebracion','Indica la fecha del concenio, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $convenios->field_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');

    $convenios->change_type('monto_convenio', 'price', '0', array('prefix'=>'$ '));
    $convenios->column_pattern('file_convenio', '<a href="'.URL_DOCS.'data/convenios/{file_convenio}" target="_new_file_convenio">{file_convenio}</a>');
//    $convenios->default_tab('Convenio modificatorio');

    $convenios->sum('monto_convenio','align-center');

    echo $convenios->render();

?>
          <h2>Órdenes de compra asociadas al contrato</h2><br>
<?php
    $oc = xcrud::get_instance();
    $oc->table('tab_ordenes_compra');
    $oc->where('id_contrato =', $id);
    $oc->table_name('Órdenes de compra');
    $oc->after_upload('after_upload_oc', 'functions.php');

    $oc->unset_title();
    $oc->unset_remove();
    $oc->unset_view();
    $oc->unset_edit();
    $oc->unset_add();
    $oc->columns('id_ejercicio, id_trimestre, numero_orden_compra, id_contrato, fecha_orden, id_so_solicitante,  id_campana_aviso,Monto');

    $oc->subselect('Monto','SELECT monto  FROM vmonto_oc where id_orden_compra = {id_orden_compra}'); 
    $oc->fields('id_proveedor,id_procedimiento,id_contrato,id_ejercicio,id_trimestre,id_so_contratante,id_campana_aviso,id_so_solicitante,numero_orden_compra,descripcion_justificacion,Monto,fecha_orden,file_orden');

    $oc->label('id_proveedor','Proveedor');
    $oc->label('id_procedimiento','Procedimiento');
    $oc->label('id_contrato','Contrato');
    $oc->label('id_ejercicio','Ejercicio');
    $oc->label('id_trimestre','Trimestre');
    $oc->label('id_so_contratante','Sujeto obligado contratante');
    $oc->label('id_campana_aviso','Campaña 	o aviso institucional');
    $oc->label('id_so_solicitante','Sujeto obligado solicitante');
    $oc->label('numero_orden_compra','Orden de compra');
    $oc->label('descripcion_justificacion','Justificación');
    $oc->label('active','Estatus');
    $oc->label('fecha_orden','Fecha de orden');
    $oc->label('file_orden','Archivo de la orden de compra en PDF');


    $oc->column_tooltip('id_procedimiento','Indica el tipo de procedimiento de contratación.');
    $oc->column_tooltip('Monto','Indica el monto de la órden de compra.');
    $oc->column_tooltip('id_proveedor','Indica el nombre de la persona física o moral proveedora del producto o servicio.');
    $oc->column_tooltip('id_contrato','Clave o número de identificación único del contrato.');
    $oc->column_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $oc->column_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $oc->column_tooltip('id_so_contratante','Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $oc->column_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $oc->column_tooltip('id_campana_aviso','Indica el nombre de la campaña o aviso institucional  a la que pertenece.');
    $oc->column_tooltip('numero_orden_compra','Clave o número de identificación único de la orden de compra.');
    $oc->column_tooltip('descripcion_justificacion','Motivo o razones que justifican la elección del proveedor.');
    $oc->column_tooltip('fecha_orden','Fecha de la orden de compra con el formato dd/mm/aaaa (por ej. 31/12/2016)');
    $oc->column_tooltip('file_orden','Archivo electrónico de la orden de compra en formato PDF.');
    $oc->column_tooltip('id_servicio_clasificacion','Indica el nombre de la Categoría del servicio.');
    $oc->column_tooltip('id_servicio_categoria','Indica el nombre de la categoría del servicio.');
    $oc->column_tooltip('id_servicio_subcategoria','Indica el nombre de la subcategoría del servicio.');
    $oc->column_tooltip('id_servicio_unidad','Indica la unidad de medida del producto o servicio.');     
    $oc->column_tooltip('monto_servicio','Monto total de la orden de compra, con I.V.A. incluido. ');
    $oc->column_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');
    $oc->column_tooltip('servicio_activo','Indica si el Servicio Contrado esta activo');

    $oc->relation('id_procedimiento','cat_procedimientos','id_procedimiento','nombre_procedimiento');
    $oc->relation('id_proveedor','tab_proveedores','id_proveedor','nombre_razon_social');
    $oc->relation('id_contrato','tab_contratos','id_contrato','numero_contrato');
    $oc->relation('id_ejercicio','cat_ejercicios','id_ejercicio','ejercicio');
    $oc->relation('id_trimestre','cat_trimestres','id_trimestre','trimestre');
    $oc->relation('id_so_contratante','vso_contratante','id_sujeto_obligado','nombre_sujeto_obligado');
    $oc->relation('id_so_solicitante','vso_solicitante','id_sujeto_obligado','nombre_sujeto_obligado');
    $oc->relation('id_campana_aviso','tab_campana_aviso','id_campana_aviso','nombre_campana_aviso');
    $oc->relation('servicio_activo','sys_active','id_active','name_active');
    $oc->relation('active','sys_active','id_active','name_active');

    $oc->relation('id_servicio_clasificacion','cat_servicios_clasificacion','id_servicio_clasificacion', 'nombre_servicio_clasificacion');
    $oc->relation('id_servicio_categoria','cat_servicios_categorias','id_servicio_categoria','nombre_servicio_categoria',
                     'active=1', '', '', '', '', 'id_servicio_clasificacion','id_servicio_clasificacion');
    $oc->relation('id_servicio_subcategoria','cat_servicios_subcategorias','id_servicio_subcategoria','nombre_servicio_subcategoria',
                     'active=1', '', '', '', '', 'id_servicio_categoria','id_servicio_categoria');
    $oc->relation('id_servicio_unidad','cat_servicios_unidades','id_servicio_unidad','nombre_servicio_unidad',
                     'active=1', '', '', '', '', 'id_servicio_subcategoria','id_servicio_subcategoria');     


    $oc->field_tooltip('id_procedimiento','ndica el tipo de procedimiento de contratación.');
    $oc->field_tooltip('id_proveedor','Indica el nombre de la persona física o moral proveedora del producto o servicio.');
    $oc->field_tooltip('id_contrato','Clave o número de identificación único del contrato.');
    $oc->field_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $oc->field_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $oc->field_tooltip('id_so_contratante','Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $oc->field_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $oc->field_tooltip('id_campana_aviso','Indica el nombre de la campaña o aviso institucional  a la que pertenece.');
    $oc->field_tooltip('numero_orden_compra','Clave o número de identificación único de la orden de compra.');
    $oc->field_tooltip('descripcion_justificacion','Motivo o razones que justifican la elección del proveedor.');
    $oc->field_tooltip('fecha_orden','Fecha de la orden de compra con el formato dd/mm/aaaa (por ej. 31/12/2016)');
    $oc->field_tooltip('file_orden','Archivo electrónico de la orden de compra en formato PDF.');
    $oc->field_tooltip('id_servicio_clasificacion','Indica el nombre de la Categoría del servicio.');
    $oc->field_tooltip('id_servicio_categoria','Indica el nombre de la categoría del servicio.');
    $oc->field_tooltip('id_servicio_subcategoria','Indica el nombre de la subcategoría del servicio.');
    $oc->field_tooltip('id_servicio_unidad','Indica la unidad de medida del producto o servicio.');     
    $oc->field_tooltip('monto_servicio','Monto total de la orden de compra, con I.V.A. incluido. ');
    $oc->field_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');
    $oc->field_tooltip('servicio_activo','Indica si el Servicio Contrado esta activo');
    $oc->field_tooltip('Monto','Indica el monto de la órden de compra.');

    $oc->change_type('Monto', 'price', '0', array('prefix'=>'$ '));
    $oc->column_pattern('file_orden', '<a href="'.URL_DOCS.'data/ordenes/{file_orden}" target="_new_file_orden">{file_orden}</a>');

    $oc->default_tab('Órden de compra');
    $oc->button( URL_ROOT .'Sys_Detalle4?oc={id_orden_compra}','ocDetalle','icon-link','',array('target'=>'_new'));

    echo $oc->render();

    $servicios = Xcrud::get_instance();    
    $servicios->table('vgasto_clasf_servicio');
    if (getD3D("Ejercicio")<>'') {
       $servicios->where('`vgasto_clasf_servicio`.`ejercicio` = ' . getD3D("Ejercicio") . ' and id_servicio_clasificacion = 1 ' .
                         ' and id_contrato = ' . $id );
    } else {
       $servicios->where('id_servicio_clasificacion = 1 and id_contrato = ' . $id);
    }  
?>
          <h2>Servicio de difusión en medios de comunicación relacionados con el contrato</h2><br>
<?php
    $servicios->columns('ejercicio, factura,fecha_erogacion,proveedor,nombre_servicio_categoria,nombre_servicio_subcategoria,tipo,nombre_campana_aviso,monto_servicio');  
/*
Factura (no debe aparecer como Número de factura)
Nombre o razón social (no debe aparecer como Nombre o razón social del proveedor) 
Categoría (no debe aparecer como clasificación)
Subcategoría (no debe aparecer como su clasificación)
Tipo
Campaña o aviso institucional (no debe aparecer como Campaña o aviso institucional asociado)
Monto gastado.
*/
  
    $servicios->label('factura','Factura')
          ->label('proveedor','Proveedor')
          ->label('fecha_erogacion','Fecha')
	  ->label('nombre_servicio_categoria','Categoría')
	  ->label('nombre_servicio_subcategoria','Subcategoría')
	  ->label('nombre_campana_aviso','Campaña o aviso institucional')
	  ->label('monto_servicio','Monto gastado');    
    $servicios->sum('monto_servicio');        
    $servicios->column_class('fecha_erogacion,monto_servicio', 'align-center');
    $servicios->change_type('monto_servicio',  'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $servicios->button( URL_ROOT .'Sys_Detalle7?factura={id_factura}','Detalle factura','icon-link','',array('target'=>'_factura'));
    $servicios->button( URL_ROOT .'Sys_Detalle2?proveedor={id_proveedor}','Detalle proveedor','icon-link','',array('target'=>'_proveedor'));
    $servicios->button( URL_ROOT .'Sys_Detalle5?campana={id_campana_aviso}','Detalle campaña o aviso institucional','icon-link','',array('target'=>'_campana'));
    
    $servicios->unset_remove();   
    $servicios->unset_title();   
    echo $servicios->render();

    $otros = Xcrud::get_instance();    
    $otros->table('vgasto_clasf_servicio');
    if (getD3D("Ejercicio")<>'') {
       $otros->where('`vgasto_clasf_servicio`.`ejercicio` = ' . getD3D("Ejercicio") . ' and id_servicio_clasificacion = 2 ' .
                         ' and id_contrato = ' . $id );
    } else {
       $otros->where('id_servicio_clasificacion = 2 and id_contrato = ' . $id);
    }  
?>
          <h2>Otros servicios asociados a la comunicación relacionados con el contrato</h2><br>
<?php
    $otros->columns('ejercicio, factura,fecha_erogacion,proveedor,nombre_servicio_categoria,nombre_servicio_subcategoria,tipo,nombre_campana_aviso,monto_servicio');    
    $otros->label('factura','Factura')
          ->label('proveedor','Proveedor')
          ->label('fecha_erogacion','Fecha')
	  ->label('nombre_servicio_categoria','Categoría')
	  ->label('nombre_servicio_subcategoria','Subcategoría')
	  ->label('nombre_campana_aviso','Campaña o aviso institucional')
	  ->label('monto_servicio','Monto gastado');    
    $otros->sum('monto_servicio');        
    $otros->column_class('fecha_erogacion,monto_servicio', 'align-center');
    $otros->change_type('monto_servicio',  'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $otros->button( URL_ROOT .'Sys_Detalle7?factura={id_factura}','Detalle factura','icon-link','',array('target'=>'_factura'));
    $otros->button( URL_ROOT .'Sys_Detalle2?proveedor={id_proveedor}','Detalle proveedor','icon-link','',array('target'=>'_proveedor'));
    $otros->button( URL_ROOT .'Sys_Detalle5?campana={id_campana_aviso}','Detalle campaña o aviso institucional','icon-link','',array('target'=>'_campana'));

    $otros->column_tooltip('factura','Número de factura')
          ->column_tooltip('proveedor','Nombre o razón social del proveedor')
          ->column_tooltip('fecha_erogacion','Fecha de erogación')
	  ->column_tooltip('nombre_servicio_categoria','Categoría del servicio')
	  ->column_tooltip('nombre_servicio_subcategoria','Subcategoría del servicio')
	  ->column_tooltip('nombre_campana_aviso','Campaña o aviso institucional asociado')
	  ->column_tooltip('monto_servicio','Monto gastado');    
    
    $otros->column_width('monto_servicio','130px');    

    $otros->unset_title();
    $otros->unset_remove();   
    echo $otros->render();

}
?>
      </div>
   </div>

