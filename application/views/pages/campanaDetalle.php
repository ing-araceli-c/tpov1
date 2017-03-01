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
<?php
if (isset($_GET['campana'])) {
    include_once(DIR_ROOT . 'xcrud/xcrud.php');
    $id = $_GET['campana'];
      
    $xcrud = Xcrud::get_instance();
    $xcrud->table('tab_campana_aviso');
    $xcrud->where('id_campana_aviso = ', $id);
?>
          <h2>Detalle de la campaña o aviso institucional</h2><br>
<?php
    $xcrud->unset_title();
    $xcrud->unset_edit();
    $xcrud->unset_add();
    $xcrud->unset_remove();
    $xcrud->unset_list();
    $xcrud->fields('id_campana_tipo, id_campana_subtipo, nombre_campana_aviso, clave_campana, autoridad, id_ejercicio, id_trimestre, id_so_contratante, id_so_solicitante, id_campana_tema, id_campana_objetivo, objetivo_comunicacion, id_campana_cobertura, campana_ambito_geo, fecha_inicio, fecha_termino, id_tiempo_oficial, fecha_inicio_to, fecha_termino_to, publicacion_segob, plan_acs, fecha_dof, active, monto_total');

    $xcrud->subselect('monto_total','SELECT SUM(monto_desglose) FROM tab_facturas_desglose WHERE id_campana_aviso = {id_campana_aviso}');
    $xcrud->change_type('monto_total',  'price', '0', array('prefix'=>'$ ', 'decimals'=>2));

    $xcrud->label('clave_campana','Clave de campaña o aviso');
    $xcrud->label('id_campana_tipo','Tipo');
    $xcrud->label('id_campana_subtipo','Subtipo');
    $xcrud->label('nombre_campana_aviso','Nombre');
    $xcrud->label('id_ejercicio','Ejercicio');
    $xcrud->label('id_trimestre','Trimestre');
    $xcrud->label('id_so_contratante','Sujeto obligado contratante');
    $xcrud->label('id_so_solicitante','Sujeto obligado solicitante');
    $xcrud->label('id_campana_tema','Tema');
    $xcrud->label('id_campana_objetivo','Objetivo institucional');
    $xcrud->label('objetivo_comunicacion','Objetivo de comunicación');
    $xcrud->label('id_campana_cobertura','Cobertura');
    $xcrud->label('campana_ambito_geo','Ámbito geográfico');
    $xcrud->label('fecha_inicio','Fecha de inicio');
    $xcrud->label('fecha_termino','Fecha de término');
    $xcrud->label('id_tiempo_oficial','Tiempo oficial');
    $xcrud->label('fecha_inicio_to','Fecha de inicio tiempo oficial');
    $xcrud->label('fecha_termino_to','Fecha de término tiempo oficial');
    $xcrud->label('publicacion_segob','Publicación SEGOB.');
    $xcrud->label('plan_acs','Documento del PACS');
    $xcrud->label('fecha_dof','Fecha de publicación');
    $xcrud->label('autoridad','Autoridad que proporcionó la clave');
    $xcrud->label('active','Estatus');
    $xcrud->label('monto_total','Monto total ejercido');

    $xcrud->field_tooltip('monto_total','Monto total ejercido');
    $xcrud->field_tooltip('id_campana_tipo','Indica si se registra una campaña o un aviso institucional');
    $xcrud->field_tooltip('id_campana_subtipo','Indica el subtipo de la campaña o aviso institucional, de acuerdo al tipo.');
    $xcrud->field_tooltip('nombre_campana_aviso','Título de la campaña o aviso institucional.');
    $xcrud->field_tooltip('id_ejercicio','Indica el año del ejercicio presupuestario.');
    $xcrud->field_tooltip('id_trimestre','Indica el trimestre que se reporta (enero – marzo, abril-junio, julio-septiembre,  octubre-diciembre ).');
    $xcrud->field_tooltip('autoridad','Autoridad que proporcionó la clave'); 
    $xcrud->field_tooltip('id_so_contratante',' Indica el nombre del sujeto obligado que celebra el contrato u orden de compra con el proveedor.');
    $xcrud->field_tooltip('id_so_solicitante','Indica el nombre del sujeto que solicitó el producto o servicio aunque éste no sea quien celebra el contrato u orden de compra con el proveedor (Ej. Sujeto obligado solicitante: Secretaría de Cultura; sujeto obligado contratante: Coordinación General de Comunicación Social).');
    $xcrud->field_tooltip('id_campana_tema',' Indica el tema de la campaña o aviso institucional (Ej. Salud, Educación, etc.)');
    $xcrud->field_tooltip('id_campana_objetivo','Objetivo institucional de la campaña o aviso institucional.');
    $xcrud->field_tooltip('objetivo_comunicacion','Objetivo de comunicación de la campaña o aviso institucional.');
    $xcrud->field_tooltip('id_campana_cobertura','Alcance geográfico de la campaña o aviso institucional.');
    $xcrud->field_tooltip('campana_ambito_geo','Descripción detallada de la campaña o aviso institucional.');
    $xcrud->field_tooltip('fecha_inicio','Fecha de inicio de la transmisión de la campaña o aviso institucional.');
    $xcrud->field_tooltip('fecha_termino','Fecha de término de la transmisión de la campaña o aviso institucional.');
    $xcrud->field_tooltip('id_tiempo_oficial','Indica si se utilizó o no, tiempo oficial en la transmisión de esa campaña o aviso institucional.');
    $xcrud->field_tooltip('fecha_inicio_to','Fecha de inicio del uso de tiempo oficial de la campaña o aviso institucional.');
    $xcrud->field_tooltip('fecha_termino_to','Fecha de término del uso de tiempo oficial de la campaña o aviso institucional.');
    $xcrud->field_tooltip('publicacion_segob','Hipervínculo a la información sobre la utilización de Tiempo Oficial, publicada por Dirección General de Radio, Televisión y Cinematografía, adscrita a la Secretaría de Gobernación.');
    $xcrud->field_tooltip('plan_acs','Nombre o denominación del documento del programa anual de comunicación social.');
    $xcrud->field_tooltip('fecha_dof','Fecha en la que se publicó en el Diario Oficial de la Federación, periódico o gaceta, o portal de Internet institucional correspondiente.');
    $xcrud->field_tooltip('active','Indica el estado de la información “Activa” o “Inactiva”.');

    $xcrud->relation('id_campana_objetivo','cat_campana_objetivos','id_campana_objetivo','campana_objetivo');
    $xcrud->relation('id_campana_cobertura','cat_campana_coberturas','id_campana_cobertura','nombre_campana_cobertura');
    $xcrud->relation('id_campana_tipo','cat_campana_tipos','id_campana_tipo','nombre_campana_tipo');
    $xcrud->relation('id_campana_subtipo','cat_campana_subtipos','id_campana_subtipo','nombre_campana_subtipo',
                     '','','',' ','','id_campana_tipo','id_campana_tipo');
    $xcrud->relation('id_ejercicio','cat_ejercicios','id_ejercicio','ejercicio');
    $xcrud->relation('id_campana_tema','cat_campana_temas','id_campana_tema','nombre_campana_tema');
    $xcrud->relation('id_trimestre','cat_trimestres','id_trimestre','trimestre');
    $xcrud->relation('id_tiempo_oficial','sys_logico','id_logico','logico');
    $xcrud->relation('id_so_contratante','vso_contratante','id_sujeto_obligado','nombre_sujeto_obligado');
    $xcrud->relation('id_so_solicitante','vso_solicitante','id_sujeto_obligado','nombre_sujeto_obligado');     
    $xcrud->relation('active','sys_active','id_active','name_active');

    $xcrud->column_pattern('id_so_contratante','{value} <a href="Sys_Detalle6?so={id_so_contratante}" target="_contratante">(Ver detalle)</a>');
    $xcrud->column_pattern('id_so_solicitante','{value} <a href="Sys_Detalle6?so={id_so_solicitante}" target="_solicitante">(Ver detalle)</a>');

    echo $xcrud->render('view', $id);

    $nivel = Xcrud::get_instance();
    $nivel->table('rel_campana_nivel');
    $nivel->where('id_campana_aviso = ', $id);
    $nivel->columns('id_poblacion_nivel' );
    $nivel->fields('id_poblacion_nivel' );
    $nivel->label('id_poblacion_nivel','Nivel socioeconómico');
    $nivel->relation('id_poblacion_nivel','cat_poblacion_nivel','id_poblacion_nivel','nombre_poblacion_nivel');
?>
          <h2>Nivel socioeconómico</h2><br>
<?php
    $nivel->unset_title();
    $nivel->unset_print();
    $nivel->unset_search();
    $nivel->unset_numbers();
    $nivel->unset_add();
    $nivel->unset_edit();
    $nivel->unset_view();
    $nivel->unset_remove();
    $nivel->unset_csv();
    $nivel->unset_pagination();
    $nivel->unset_limitlist();
    echo $nivel->render();

    $grupo_edad = Xcrud::get_instance();
    $grupo_edad->table('rel_campana_grupo_edad');
    $grupo_edad->where('id_campana_aviso = ', $id);
    $grupo_edad->columns('id_poblacion_grupo_edad' );
    $grupo_edad->fields('id_poblacion_grupo_edad' );
    $grupo_edad->label('id_poblacion_grupo_edad','Grupo de edad');
    $grupo_edad->relation('id_poblacion_grupo_edad','cat_poblacion_grupo_edad','id_poblacion_grupo_edad','nombre_poblacion_grupo_edad');
?>
          <h2>Grupos edad</h2><br>
<?php
    $grupo_edad->unset_title();
    $grupo_edad->default_tab('Grupos de edad');
    $grupo_edad->unset_print();
    $grupo_edad->unset_search();
    $grupo_edad->unset_numbers();
    $grupo_edad->unset_add();
    $grupo_edad->unset_edit();
    $grupo_edad->unset_view();
    $grupo_edad->unset_remove();
    $grupo_edad->unset_csv();
    $grupo_edad->unset_pagination();
    $grupo_edad->unset_limitlist();
    echo $grupo_edad->render();

    $lugar = Xcrud::get_instance();
    $lugar->table('rel_campana_lugar');
    $lugar->where('id_campana_aviso = ', $id);
    $lugar->columns('poblacion_lugar' );
    $lugar->fields('poblacion_lugar' );
    $lugar->label('poblacion_lugar','Lugar');
?>
          <h2>Lugares</h2><br>
<?php
    $lugar->unset_title();
    $lugar->default_tab('Lugares');
    $lugar->unset_print();
    $lugar->unset_search();
    $lugar->unset_numbers();
    $lugar->unset_add();
    $lugar->unset_edit();
    $lugar->unset_view();
    $lugar->unset_remove();
    $lugar->unset_csv();
    $lugar->unset_pagination();
    $lugar->unset_limitlist();
    echo $lugar->render();

    $educacion = Xcrud::get_instance();
    $educacion->table('rel_campana_nivel_educativo');
    $educacion->where('id_campana_aviso = ', $id);
    $educacion->columns('id_poblacion_nivel_educativo' );
    $educacion->fields('id_poblacion_nivel_educativo' );
    $educacion->label('id_poblacion_nivel_educativo','Educación');
    $educacion->relation('id_poblacion_nivel_educativo','cat_poblacion_nivel_educativo','id_poblacion_nivel_educativo','nombre_poblacion_nivel_educativo');    
?>
          <h2>Nivel educativo</h2><br>
<?php
    $educacion->unset_title();
    $educacion->default_tab('Educación');
    $educacion->unset_print();
    $educacion->unset_search();
    $educacion->unset_numbers();
    $educacion->unset_add();
    $educacion->unset_edit();
    $educacion->unset_view();
    $educacion->unset_remove();
    $educacion->unset_csv();
    $educacion->unset_pagination();
    $educacion->unset_limitlist();
    echo $educacion->render();

    $sexo = Xcrud::get_instance();
    $sexo->table('rel_campana_sexo');
    $sexo->where('id_campana_aviso = ', $id);
    $sexo->columns('id_poblacion_sexo' );
    $sexo->fields('id_poblacion_sexo' );
    $sexo->label('id_poblacion_sexo','Sexo');
    $sexo->relation('id_poblacion_sexo','cat_poblacion_sexo','id_poblacion_sexo','nombre_poblacion_sexo');
?>
          <h2>Sexo</h2><br>
<?php
    $sexo->unset_title();
    $sexo->default_tab('Sexo');
    $sexo->unset_print();
    $sexo->unset_search();
    $sexo->unset_numbers();
    $sexo->unset_add();
    $sexo->unset_edit();
    $sexo->unset_view();
    $sexo->unset_remove();
    $sexo->unset_csv();
    $sexo->unset_pagination();
    $sexo->unset_limitlist();
    echo $sexo->render();

    $maudio = Xcrud::get_instance();
    $maudio->table('rel_campana_maudio');
    $maudio->where('id_campana_aviso = ', $id);
    $maudio->columns('id_tipo_liga, nombre_campana_maudio, url_audio, file_audio' );
    $maudio->fields('id_tipo_liga, nombre_campana_maudio, url_audio, file_audio' );
    $maudio->label('id_tipo_liga','Tipo de liga');
    $maudio->label('nombre_campana_maudio','Nombre del audio');
    $maudio->label('url_audio','URL del audio');
    $maudio->label('file_audio','Archivo del audio');
    $maudio->relation('id_tipo_liga','cat_tipo_liga','id_tipo_liga','tipo_liga');
    $maudio->column_pattern('file_audio', '<a href="'.URL_DOCS.'data/campanas/audios/{file_audio}" target="_new_file_audio">{file_audio}</a>');
?>
          <h2>Audios</h2><br>
<?php
    $maudio->unset_title();
    $maudio->after_upload('after_upload_maudio', 'functions.php');
    $maudio->unset_print();
    $maudio->unset_search();
    $maudio->unset_numbers();
    $maudio->unset_add();
    $maudio->unset_edit();
    $maudio->unset_view();
    $maudio->unset_remove();
    $maudio->unset_csv();
    $maudio->unset_pagination();
    $maudio->unset_limitlist();
    echo $maudio->render();

    $mimagenes = Xcrud::get_instance();
    $mimagenes->table('rel_campana_mimagenes');
    $mimagenes->where('id_campana_aviso = ', $id);
    $mimagenes->columns('id_tipo_liga, nombre_campana_mimagen, url_imagen, file_imagen' );
    $mimagenes->fields('id_tipo_liga, nombre_campana_mimagen, url_imagen, file_imagen' );
    $mimagenes->label('id_tipo_liga','Tipo de liga');
    $mimagenes->label('nombre_campana_mimagen','Nombre de la imagen');
    $mimagenes->label('url_imagen','URL de la imagen');
    $mimagenes->label('file_imagen','Archivo de la imagen');
    $mimagenes->relation('id_tipo_liga','cat_tipo_liga','id_tipo_liga','tipo_liga');
    $mimagenes->column_pattern('file_imagen', '<a href="'.URL_DOCS.'data/campanas/imagenes/{file_imagen}" target="_new_file_imagen">{file_imagen}</a>');
?>
          <h2>Imágenes</h2><br>
<?php
    $mimagenes->unset_title();
    $mimagenes->default_tab('Imágenes');
    $mimagenes->unset_print();
    $mimagenes->unset_search();
    $mimagenes->unset_numbers();
    $mimagenes->unset_add();
    $mimagenes->unset_edit();
    $mimagenes->unset_view();
    $mimagenes->unset_remove();
    $mimagenes->unset_csv();
    $mimagenes->unset_pagination();
    $mimagenes->unset_limitlist();
    echo $mimagenes->render();

    $mvideo = Xcrud::get_instance();
    $mvideo->table('rel_campana_mvideo');
    $mvideo->where('id_campana_aviso = ', $id);
    $mvideo->after_upload('after_upload_mvideo', 'functions.php');
    $mvideo->columns('id_tipo_liga, nombre_campana_mvideo, url_video, file_video' );
    $mvideo->fields('id_tipo_liga, nombre_campana_mvideo, url_video, file_video' );
    $mvideo->label('id_tipo_liga','Tipo de liga');
    $mvideo->label('nombre_campana_mvideo','Nombre del video');
    $mvideo->label('url_video','URL del video');
    $mvideo->label('file_video','Archivo del video');
    $mvideo->relation('id_tipo_liga','cat_tipo_liga','id_tipo_liga','tipo_liga');
    $mvideo->column_pattern('file_video', '<a href="'.URL_DOCS.'data/campanas/videos/{file_video}" target="_new_file_video">{file_video}</a>');
?>
          <h2>Videos</h2><br>
<?php
    $mvideo->unset_title();
    $mvideo->default_tab('Videos');
    $mvideo->unset_print();
    $mvideo->unset_search();
    $mvideo->unset_numbers();
    $mvideo->unset_add();
    $mvideo->unset_edit();
    $mvideo->unset_view();
    $mvideo->unset_remove();
    $mvideo->unset_csv();
    $mvideo->unset_pagination();
    $mvideo->unset_limitlist();
    echo $mvideo->render();

    $evaluacion = Xcrud::get_instance();
    $evaluacion->table('tab_campana_aviso');
    $evaluacion->where('id_campana_aviso = ', $id);
?>
          <h2>Evaluación de la campaña o aviso institucional</h2><br>
<?php
    $evaluacion->unset_title();
    $evaluacion->unset_edit();
    $evaluacion->unset_add();
    $evaluacion->unset_remove();
    $evaluacion->unset_list();

    $evaluacion->label('evaluacion','Evaluación');
    $evaluacion->label('evaluacion_documento','Documento de evaluación');
    $evaluacion->label('nombre_campana_aviso','Nombre');

    $evaluacion->fields('nombre_campana_aviso, evaluacion, evaluacion_documento');
    $evaluacion->field_tooltip('nombre_campana_aviso','Título de la campaña o aviso institucional.');
    $evaluacion->change_type('evaluacion_documento', 'file', '', array('not_rename'=>true, 'path'=>'../data/campanas/evaluacion/'));
    echo $evaluacion->render('view', $id);

    $servicios = Xcrud::get_instance();    
    $servicios->table('vgasto_clasf_servicio');
    if (getD3D("Ejercicio")<>'') {
       $servicios->where('`vgasto_clasf_servicio`.`ejercicio` = ' . getD3D("Ejercicio") . ' and id_servicio_clasificacion = 1 ' .
                         ' and id_campana_aviso = ' . $id );
    } else {
       $servicios->where('id_servicio_clasificacion = 1 and id_campana_aviso = ' . $id);
    }  

?>
          <h2>Servicio de difusión en medios de comunicación relacionados con la campaña</h2><br>
<?php
    $servicios->unset_title();
    $servicios->columns('ejercicio, factura,fecha_erogacion,proveedor,nombre_servicio_categoria,nombre_servicio_subcategoria,tipo,nombre_campana_aviso,monto_servicio');    
    $servicios->label('factura','Factura')
          ->label('proveedor','Proveedor')
          ->label('fecha_erogacion','Fecha')
	  ->label('nombre_servicio_categoria','Categoría')
	  ->label('nombre_servicio_subcategoria','Subcategoría')
	  ->label('nombre_campana_aviso','Campaña o aviso')
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
	  ->column_tooltip('nombre_servicio_categoria','Categoría del servicio')
	  ->column_tooltip('nombre_servicio_subcategoria','Subcategoría del servicio')
	  ->column_tooltip('nombre_campana_aviso','Campaña o aviso institucional asociado')
	  ->column_tooltip('monto_servicio','Monto gastado');    

    $servicios->column_width('monto_servicio','130px');    
    
    $servicios->unset_remove();   
    echo $servicios->render();

    $otros = Xcrud::get_instance();    
    $otros->table('vgasto_clasf_servicio');
    if (getD3D("Ejercicio")<>'') {
       $otros->where('`vgasto_clasf_servicio`.`ejercicio` = ' . getD3D("Ejercicio") . ' and id_servicio_clasificacion = 2 ' .
                         ' and id_campana_aviso = ' . $id );
    } else {
       $otros->where('id_servicio_clasificacion = 2 and id_campana_aviso = ' . $id);
    }  
?>
          <h2>Otros servicios asociados a la comunicación relacionados con la campaña</h2><br>
<?php
    $otros->unset_title();
    $otros->columns('ejercicio, factura,fecha_erogacion,proveedor,nombre_servicio_categoria,nombre_servicio_subcategoria,tipo,nombre_campana_aviso,monto_servicio');    
    $otros->label('factura','Factura')
          ->label('proveedor','Proveedor')
          ->label('fecha_erogacion','Fecha')
	  ->label('nombre_servicio_categoria','Categoría')
	  ->label('nombre_servicio_subcategoria','Subcategoría')
	  ->label('nombre_campana_aviso','Campaña o aviso')
	  ->label('monto_servicio','Monto gastado');    
    $otros->sum('monto_servicio');        
    $otros->column_class('fecha_erogacion,monto_servicio', 'align-center');
    $otros->change_type('monto_servicio',  'price', '0', array('prefix'=>'$ ', 'decimals'=>2));
    $otros->button( URL_ROOT .'Sys_Detalle7?factura={id_factura}','Detalle factura','icon-link','',array('target'=>'_factura'));
    $otros->button( URL_ROOT .'Sys_Detalle2?proveedor={id_proveedor}','Detalle proveedor','icon-link','',array('target'=>'_proveedor'));
    $otros->button( URL_ROOT .'Sys_Detalle5?campana={id_campana_aviso}','Detalle de la campaña o aviso institucional','icon-link','',array('target'=>'_campana'));


    $otros->column_tooltip('factura','Número de factura');
    $otros->column_tooltip('proveedor','Nombre o razón social del proveedor');
    $otros->column_tooltip('fecha_erogacion','Fecha de erogación');
    $otros->column_tooltip('nombre_servicio_categoria','Categoría del servicio');
    $otros->column_tooltip('nombre_servicio_subcategoria','Subcategoría del servicio');
    $otros->column_tooltip('nombre_campana_aviso','Campaña o aviso institucional asociado');

    $otros->column_width('monto_servicio','130px');    

    
    $otros->unset_remove();   
    echo $otros->render();

}      
?>
      </div>
   </div>
</center>

