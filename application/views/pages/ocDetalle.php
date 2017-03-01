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
<?php
    include_once(DIR_ROOT . 'xcrud/xcrud.php');  

?>
          <h2>Información de la orden de compra</h2><br>
<?php
    $id = $_GET['oc'];
    $oc = xcrud::get_instance();
    $oc->table('tab_ordenes_compra');
    $oc->where('id_orden_compra >', 1)->where('id_orden_compra =', $id);
    $oc->after_upload('after_upload_oc', 'functions.php');

    $oc->unset_title();
    $oc->unset_remove();
    $oc->unset_title();
    $oc->unset_edit();
    $oc->unset_add();
    $oc->unset_list();
    $oc->columns('id_ejercicio, id_trimestre, id_proveedor,id_campana_aviso, numero_orden_compra,Monto');

    $oc->subselect('Monto','SELECT monto  FROM vmonto_oc where id_orden_compra = {id_orden_compra}'); 

    $oc->fields('id_ejercicio,id_trimestre,numero_orden_compra,fecha_orden,id_so_contratante,id_so_solicitante,id_proveedor,Nombre comercial del proveedor,id_procedimiento,descripcion_justificacion,
Monto, id_campana_aviso, file_orden');

/*
Ejercicio
Trimestre
Clave de la orden
Fecha
Sujeto obligado ordenante (Con un vínculo a la página única del detalle del sujeto obligado)
Sujeto obligado solicitante (Con un vínculo a la página única del detalle del sujeto obligado)
Nombre o  razón social del proveedor  (Con un vínculo a la página única del detalle del proveedor)

Categoría del servicio
Categoría
Sub Categoría

Tipo de adjudicación
Motivo de adjudicación
Monto total
Campaña o aviso institucional  asociado
Vínculo al archivo .pdf o .xml de la orden de compra
*/

    $oc->label('id_proveedor','Proveedor');
    $oc->label('id_procedimiento','Tipo de adjudicación');
    $oc->label('id_contrato','Contrato');
    $oc->label('id_ejercicio','Ejercicio');
    $oc->label('id_trimestre','Trimestre');
    $oc->label('id_so_contratante','Sujeto obligado ordenante');
    $oc->label('id_campana_aviso','Campaña o aviso institucional asociado');
    $oc->label('id_so_solicitante','Sujeto obligado solicitante');
    $oc->label('numero_orden_compra','Clave de la orden');
    $oc->label('descripcion_justificacion','Motivo de adjudicación');
    $oc->label('Monto','Monto total');
    $oc->label('fecha_orden','Fecha');
    $oc->label('file_orden','Vínculo al archivo .pdf o .xml de la orden de compra');


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
    $oc->column_tooltip('id_servicio_clasificacion','Indica el nombre de la Categoría.');
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

    $oc->subselect('Nombre comercial del proveedor','SELECT nombre_comercial as "Nombre comercial del proveedor" FROM tab_proveedores WHERE id_proveedor = {id_proveedor}'); 

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
    $oc->field_tooltip('id_servicio_clasificacion','Indica el nombre de la Categoría.');
    $oc->field_tooltip('id_servicio_categoria','Indica el nombre de la categoría del servicio.');
    $oc->field_tooltip('id_servicio_subcategoria','Indica el nombre de la subcategoría del servicio.');
    $oc->field_tooltip('id_servicio_unidad','Indica la unidad de medida del producto o servicio.');     
    $oc->field_tooltip('monto_servicio','Monto total de la orden de compra, con I.V.A. incluido. ');
    $oc->field_tooltip('active','Indica el estado de la información correspondiente al registro, “Activa” o “Inactiva”.');
    $oc->field_tooltip('servicio_activo','Indica si el Servicio Contrado esta activo');
    $oc->field_tooltip('Monto','Indica el monto de la órden de compra.');
    $oc->field_tooltip('Nombre comercial del proveedor', 'Nombre comercial del proveedor');

    $oc->change_type('Monto', 'price', '0', array('prefix'=>'$ '));
    $oc->column_pattern('file_orden', '<a href="'.URL_DOCS.'data/ordenes/{file_orden}" target="_new_file_orden">{file_orden}</a>');

    $oc->column_pattern('id_proveedor','{value} <a href="Sys_Detalle2?proveedor={id_proveedor}" target="_proveedor">(Ver detalle)</a>');
    $oc->column_pattern('id_so_contratante','{value} <a href="Sys_Detalle6?so={id_so_contratante}" target="_contratante">(Ver detalle)</a>');
    $oc->column_pattern('id_so_solicitante','{value} <a href="Sys_Detalle6?so={id_so_solicitante}" target="_solicitante">(Ver detalle)</a>');
    $oc->column_pattern('id_campana_aviso','{value} <a href="Sys_Detalle5?campana={id_campana_aviso}" target="_campana">(Ver detalle)</a>');

    echo $oc->render('view', $id);

    $servicios = Xcrud::get_instance();    
    $servicios->table('vgasto_clasf_servicio');
    if (getD3D("Ejercicio")<>'') {
       $servicios->where('`vgasto_clasf_servicio`.`ejercicio` = ' . getD3D("Ejercicio") . ' and id_servicio_clasificacion = 1 ' .
                         ' and id_orden_compra = ' . $id );
    } else {
       $servicios->where('id_servicio_clasificacion = 1 and id_orden_compra = ' . $id);
    }  

?>
          <h2>Servicio de difusión en medios de comunicación relacionados con la orden de compra</h2><br>
<?php
   
    $servicios->columns('ejercicio, factura,fecha_erogacion,proveedor,nombre_servicio_categoria,nombre_servicio_subcategoria,tipo,nombre_campana_aviso,monto_servicio');    
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

    $servicios->column_tooltip('factura','Número de factura')
          ->column_tooltip('proveedor','Nombre o razón social del proveedor')
          ->column_tooltip('fecha_erogacion','Fecha de erogación')
	  ->column_tooltip('nombre_servicio_categoria','Categoría')
	  ->column_tooltip('nombre_servicio_subcategoria','Subcategoría')
	  ->column_tooltip('nombre_campana_aviso','Campaña o aviso institucional asociado')
	  ->column_tooltip('monto_servicio','Monto gastado');    

    $servicios->column_width('monto_servicio','130px');    
    
    $servicios->unset_remove();   
    $servicios->unset_title();   
    echo $servicios->render();

?>
          <h2>Otros servicios asociados a la comunicación relacionados con la orden de compra</h2><br>
<?php
    $otros = Xcrud::get_instance();    
    $otros->table('vgasto_clasf_servicio');
    if (getD3D("Ejercicio")<>'') {
       $otros->where('`vgasto_clasf_servicio`.`ejercicio` = ' . getD3D("Ejercicio") . ' and id_servicio_clasificacion = 2 ' .
                         ' and id_orden_compra = ' . $id );
    } else {
       $otros->where('id_servicio_clasificacion = 2 and id_orden_compra = ' . $id);
    }  

    $otros->unset_title();   
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
	  ->column_tooltip('nombre_servicio_categoria','Categoría')
	  ->column_tooltip('nombre_servicio_subcategoria','Subcategoría')
	  ->column_tooltip('nombre_campana_aviso','Campaña o aviso institucional asociado')
	  ->column_tooltip('monto_servicio','Monto gastado');    

    $otros->column_width('monto_servicio','130px');    
    
    $otros->unset_remove();   
    echo $otros->render();

?>
      </div>
   </div>

