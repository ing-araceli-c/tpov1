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

<div style="width:90%;">
<br>
<?php
    echo '<h2>Información del proveedor</h2><br>';
    $id_proveedor = $_GET['proveedor'];
    include_once(DIR_ROOT . 'xcrud/xcrud.php');
    $pro = Xcrud::get_instance();
    $pro->table('tab_proveedores');
    $pro->where('id_proveedor =', $id_proveedor );
    $pro->fields("nombre_razon_social, nombre_comercial, rfc, id_personalidad_juridica, nombres, primer_apellido, segundo_apellido"); 
    $pro->columns("nombre_razon_social, nombre_comercial, rfc, id_personalidad_juridica"); 
    $pro->label('nombre_razon_social','Proveedor');
    $pro->label('nombre_comercial','Nombre comercial');
    $pro->label('rfc','RFC');
    $pro->label('nombres','Nombres');
    $pro->label('primer_apellido','Primer apellido');
    $pro->label('segundo_apellido','Segundo apellido');

    $pro->label('id_personalidad_juridica','Personalidad jurídica');
    $pro->relation('id_personalidad_juridica','cat_personalidad_juridica','id_personalidad_juridica','nombre_personalidad_juridica');
    $pro->unset_title();
    $pro->unset_edit();
    $pro->unset_add();
    $pro->unset_remove();
    $pro->unset_csv();
    $pro->unset_search();
    $pro->unset_print();
    $pro->unset_pagination();
    $pro->unset_numbers();
    $pro->unset_list();
    echo $pro->render( 'view', $id_proveedor ); 

// Ordenes de Compra
    echo '<h2>Órdenes de compra asociadas al proveedor</h2><br>';
    $oc = Xcrud::get_instance();
    $oc->table('vact_ordenes_compra_montos');
    $oc->where('id_proveedor =', $id_proveedor )->where('id_orden_compra > ', 1)->where('id_contrato =', 1);
    $oc->table_name('Órdenes de compra');

    $oc->unset_title();
    $oc->unset_remove();
    $oc->unset_title();
    $oc->unset_edit();
    $oc->unset_add();
    $oc->unset_view();
    $oc->columns('id_ejercicio, id_trimestre, numero_orden_compra, id_proveedor, id_campana_aviso, monto');
    $oc->button('Sys_Detalle4?oc={id_orden_compra}','Detalle de órden de compra','icon-link','',array('target'=>'_blank'));
	 
    $oc->label('id_proveedor','Proveedor');
    $oc->label('id_procedimiento','Procedimiento');
    $oc->label('id_contrato','Contrato');
    $oc->label('id_ejercicio','Ejercicio');
    $oc->label('id_trimestre','Trimestre');
    $oc->label('id_so_contratante','Sujeto obligado ordenante');
    $oc->label('id_campana_aviso','Campaña o aviso institucional');
    $oc->label('id_so_solicitante','Sujeto obligado solicitante');
    $oc->label('numero_orden_compra','Orden de compra');
    $oc->label('descripcion_justificacion','Justificación');
    $oc->label('id_servicio_clasificacion','Categoría');
    $oc->label('id_servicio_categoria','Categoría del servicio');
    $oc->label('id_servicio_subcategoria','Subcategoría del servicio');
    $oc->label('id_servicio_unidad','Unidad');
    $oc->label('servicio_activo','Estatus del servicio');
    $oc->label('fecha_orden','Fecha de orden');
    $oc->label('file_orden','Archivo de la orden de compra');
    $oc->label('monto', 'Monto');

    $oc->column_tooltip('id_procedimiento','ndica el tipo de procedimiento de contratación.');
    $oc->column_tooltip('id_proveedor','Indica el nombre de la persona física o moral proveedora del producto o servicio.');
    $oc->column_tooltip('id_contrato','Clave o número de identificación único del contrato.');
    $oc->column_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $oc->column_tooltip('id_trimestre','Indica el trimestre que e reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $oc->column_tooltip('id_so_contratante','Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $oc->column_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $oc->column_tooltip('id_campana_aviso','Indica el nombre de la campaña o aviso institucional  a la que pertenece.');
    $oc->column_tooltip('numero_orden_compra','Clave o número de identificación único de la orden de compra.');
    $oc->column_tooltip('descripcion_justificacion','Motivo o razones que justifican la elección del proveedor.');
    $oc->column_tooltip('fecha_orden','Fecha de la orden de compra con el formato dd/mm/aaaa (por ej. 31/12/2016)');
    $oc->column_tooltip('file_orden','Archivo electrónico de la orden de compra en formato PDF.');
    $oc->column_tooltip('id_servicio_clasificacion','Indica el nombre de la Categoría.');
    $oc->column_tooltip('id_servicio_categoria','Indica el nombre de la categoría del servicio.');
    $oc->column_tooltip('id_servicio_subcategoria','Indica el nombre de la subcategoría del servicio.');
    $oc->column_tooltip('id_servicio_unidad','Indica la unidad de medida del producto o servicio.');     
    $oc->column_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');
    $oc->column_tooltip('servicio_activo','Indica si el Servicio Contrado esta activo');

    $oc->relation('id_procedimiento','cat_procedimientos','id_procedimiento','nombre_procedimiento');
    $oc->relation('id_proveedor','vact_proveedores','id_proveedor','nombre_comercial');
    $oc->relation('id_contrato','vact_contratos','id_contrato','numero_contrato');
    $oc->relation('id_ejercicio','vact_ejercicios','id_ejercicio','ejercicio');
    $oc->relation('id_trimestre','cat_trimestres','id_trimestre','trimestre');
    $oc->relation('id_so_contratante','vso_contratante','id_sujeto_obligado','nombre_sujeto_obligado');
    $oc->relation('id_so_solicitante','vso_solicitante','id_sujeto_obligado','nombre_sujeto_obligado');
    
    $oc->relation('id_campana_aviso','vtipo_campana_proveedor','id_campana_aviso','campana_aviso');
//    $oc->column_width('id_campana_aviso','300px');
    $oc->change_type('id_campana_aviso', 'texteditor');

    
    $oc->change_type('monto', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));

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
    $oc->field_tooltip('id_contrato','Clave o número de identificación único del contrato.');
    $oc->field_tooltip('id_proveedor','Indica el nombre de la persona física o moral proveedora del producto o servicio.');
    $oc->field_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $oc->field_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $oc->field_tooltip('id_so_contratante','Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $oc->field_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $oc->field_tooltip('id_campana_aviso','Indica el nombre de la campaña o aviso institucional  a la que pertenece.');
    $oc->field_tooltip('numero_orden_compra','Clave o número de identificación único de la orden de compra.');
    $oc->field_tooltip('descripcion_justificacion','Motivo o razones que justifican la elección del proveedor.');
    $oc->field_tooltip('fecha_orden','Fecha de la orden de compra con el formato dd/mm/aaaa (por ej. 31/12/2016)');
    $oc->field_tooltip('file_orden','Archivo electrónico de la orden de compra en formato PDF.');
    $oc->field_tooltip('id_servicio_clasificacion','Indica el nombre de la Categoría.');
    $oc->field_tooltip('id_servicio_categoria','Indica el nombre de la categoría del servicio.');
    $oc->field_tooltip('id_servicio_subcategoria','Indica el nombre de la subcategoría del servicio.');
    $oc->field_tooltip('id_servicio_unidad','Indica la unidad de medida del producto o servicio.');     
    $oc->field_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');
    $oc->field_tooltip('servicio_activo','Indica si el Servicio Contrado esta activo');
    $oc->column_pattern('file_orden', '<a href="'.URL_DOCS.'data/ordenes/{file_orden}" target="_new_orden">{file_orden}</a>');
    $oc->default_tab('Órdenes de compra');
    $oc->column_width('monto','150px');

    echo $oc->render();


    echo '<h2>Contratos asociados al proveedor</h2><br>';
    $contratos = Xcrud::get_instance();
    $contratos->table('tab_contratos');
    $contratos->where('id_proveedor =', $id_proveedor )->where('id_contrato >', 1);    
    $contratos->table_name('Contratos');

    $contratos->unset_title();
    $contratos->unset_remove();
    $contratos->unset_title();
    $contratos->unset_edit();
    $contratos->unset_add();
    $contratos->unset_view();
    $contratos->button('Sys_Detalle4?contrato={id_contrato}','Detalle de contrato','icon-link','',array('target'=>'_blank'));

    $contratos->columns('id_ejercicio, id_trimestre, id_so_contratante, id_so_solicitante, numero_contrato, monto_contrato, Monto modificado, Monto total, Monto pagado');

    $contratos->label('id_procedimiento','Procedimiento');
    $contratos->label('id_proveedor','Proveedor');
    $contratos->label('id_ejercicio','Ejercicio');
    $contratos->label('id_trimestre','Trimestre');
    $contratos->label('id_so_contratante','Contratante');
    $contratos->label('id_so_solicitante','Solicitante');
    $contratos->label('numero_contrato','Contrato');
    $contratos->label('objeto_contrato','Objeto del contrato');
    $contratos->label('descripcion_justificacion','Descripción');
    $contratos->label('fundamento_juridico','Fundamento jurídico');
    $contratos->label('fecha_celebracion','Fecha celebración');
    $contratos->label('fecha_inicio','Fecha inicio');
    $contratos->label('fecha_fin','Fecha fin');
    $contratos->label('monto_contrato','Monto original del contrato');
    $contratos->label('file_contrato','Contrato');
    $contratos->label('active','Estatus');

    $contratos->subselect('Monto modificado','SELECT SUM(monto_convenio) FROM vact_convenios_modificatorios WHERE id_contrato = {id_contrato} and active=1'); 
    $contratos->subselect('Monto total','SELECT SUM(monto_convenio)+{monto_contrato} FROM vact_convenios_modificatorios WHERE id_contrato = {id_contrato} and active=1'); 

    $contratos->subselect('Monto pagado','SELECT SUM(a.monto_desglose) FROM tab_facturas_desglose a, tab_facturas b WHERE a.id_factura = b.id_factura and b.id_contrato = {id_contrato}');

    $contratos->change_type('Monto modificado', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $contratos->change_type('Monto total', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $contratos->change_type('Monto pagado', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));

    $contratos->column_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $contratos->column_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $contratos->column_tooltip('id_so_contratante','Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $contratos->column_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $contratos->column_tooltip('numero_contrato','Clave o número de identificación único del contrato.');
    $contratos->column_tooltip('monto_contrato','Monto total del contrato, con I.V.A. incluido.');
    $contratos->column_tooltip('Monto modificado','Suma de los  montos de los convenios modificatorios.');
    $contratos->column_tooltip('Monto total','Suma del monto original del contrato, más el monto modificado.');
    $contratos->column_tooltip('Monto pagado','Monto pagado a la fecha del período publicado.');
    $contratos->column_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');

    $contratos->column_tooltip('id_proveedor','Nombre o razón social del proveedor');
    $contratos->column_tooltip('descripcion_justificacion','Descripción breve de los motivos que justifican la elección del proveedor');
    $contratos->column_tooltip('fecha_celebracion','Fecha de firma de contrato, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $contratos->column_tooltip('objeto_contrato','Indica el objeto del contrato');
    $contratos->column_tooltip('id_procedimiento','Indica el tipo de procedimiento de contratación  [licitación pública, adjudicación directa, invitación restringida]');
    $contratos->column_tooltip('fundamento_juridico','Fundamento jurídico del procedimiento de contratación');

    $contratos->column_tooltip('fecha_inicio','Indica la fecha de inicio de los servicios contratados, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $contratos->column_tooltip('fecha_fin','Indica la fecha de término de los servicios contratados, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $contratos->column_tooltip('file_contrato','Contrato en formato PDF');

    $contratos->change_type('monto_contrato', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));

    $contratos->relation('id_ejercicio','vact_ejercicios','id_ejercicio','ejercicio');
    $contratos->relation('id_trimestre','cat_trimestres','id_trimestre','trimestre');
    $contratos->relation('id_so_contratante','vso_contratante','id_sujeto_obligado','nombre_sujeto_obligado');

    $contratos->relation('id_so_solicitante','vso_solicitante','id_sujeto_obligado','nombre_sujeto_obligado');
    $contratos->relation('id_proveedor','vact_proveedores','id_proveedor','nombre_comercial');
    $contratos->relation('id_procedimiento','cat_procedimientos','id_procedimiento','nombre_procedimiento');
    $contratos->relation('active','sys_active','id_active','name_active');
   
    $contratos->field_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $contratos->field_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $contratos->field_tooltip('id_so_contratante','Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $contratos->field_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $contratos->field_tooltip('numero_contrato','Clave o número de identificación único del contrato.');
    $contratos->field_tooltip('id_procedimiento','Indica el tipo de procedimiento administrativo que se llevó a cabo para la contratación.');
    $contratos->field_tooltip('id_proveedor','Indica el nombre de la persona física o moral proveedora del producto o servicio.');
    $contratos->field_tooltip('objeto_contrato','Indica las obligaciones  creadas y la razón de ser del contrato.');
    $contratos->field_tooltip('descripcion_justificacion','Descripción breve de las razones que justifican la elección de tal proveedor.');
    $contratos->field_tooltip('fundamento_juridico','Fundamento jurídico del procedimiento de contratación.');
    $contratos->field_tooltip('fecha_celebracion','Fecha de firma de contrato, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $contratos->field_tooltip('fecha_inicio','Indica la fecha de inicio de servicios.');
    $contratos->field_tooltip('fecha_fin','Indica la fecha de finalización de los servicios.');
    $contratos->field_tooltip('monto_contrato','Indica el monto total del contrato con I.V.A. incluido.');
    $contratos->field_tooltip('file_contrato','Archivo de la versión pública del contrato en formato PDF.');
    $contratos->field_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');
    $contratos->sum('monto_contrato');
    $contratos->column_pattern('file_contrato', '<a href="'.URL_DOCS.'data/contratos/{file_contrato}" target="_new_contrato">{file_contrato}</a>');
    $contratos->default_tab('Contrato');

    $convenios = $contratos->nested_table('Convenios','id_contrato', 'vact_convenios_modificatorios','id_contrato'); 
    $convenios->unset_title();
    $convenios->unset_remove();
    $convenios->columns('id_ejercicio, id_trimestre, numero_convenio, monto_convenio, active' );
    $convenios->table_name('Convenios modificatorios');

    $convenios->fields('id_ejercicio, id_trimestre, numero_convenio, objeto_convenio, fundamento_juridico, fecha_celebracion, monto_convenio, active, file_convenio' );
    $convenios->label('id_ejercicio','Ejercicio');
    $convenios->label('id_trimestre','Trimestre');
    $convenios->label('numero_convenio','Convenio modificatorio');
    $convenios->label('objeto_convenio','Objeto');
    $convenios->label('fundamento_juridico','Fundamento jurídico');
    $convenios->label('fecha_celebracion','Fecha celebración');
    $convenios->label('monto_convenio','Monto');
    $convenios->label('active','Estatus');

    $convenios->column_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $convenios->column_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $convenios->column_tooltip('numero_convenio','Número del convenio');
    $convenios->column_tooltip('objeto_convenio','Indica el objeto del contrato');
    $convenios->column_tooltip('fundamento_juridico','Fundamento jurídico del procedimiento de contratación');
    $convenios->column_tooltip('fecha_celebracion','Indica la fecha del concenio, con el formato dd/mm/aaaa (por ej. 31/03/2016)');
    $convenios->column_tooltip('monto_convenio','Indica el monto del convenio modificatorio, en caso que aplique.');

    $convenios->relation('id_ejercicio','vact_ejercicios','id_ejercicio','ejercicio');
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

    $convenios->change_type('monto_convenio', 'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $convenios->column_pattern('file_convenio', '<a href="'.URL_DOCS.'data/convenios/{file_convenio}" target="_new_convenio">{file_convenio}</a>');

    $convenios->default_tab('Convenios Modificatorios');

    $convenios->sum('monto_convenio');
    echo $contratos->render();


?>
</div>
</center>

