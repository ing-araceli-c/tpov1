<?php defined('BASEPATH') OR exit('No direct script access allowed');
   class Sys_Export extends CI_Controller {
      public function __construct() {
         parent::__construct();
         $this->load->model("Graficas_model");
         $this->load->helper("d3d_helper");
         $this->load->helper('url'); 
      }

   private function getDateTimeMD5( $filename ) {  
      $file = IDIR_ROOT . 'data/' . $filename . '.csv';
      if (file_exists($file)) {
         $outstr = 'Archivo: ' . $filename . '.csv  Generado: ' . 
                   date("d/m/Y H:i:s", time()) . ' MD5=' .  md5_file ( $file ) . ': ';
      } else {
         $outstr = 'Archivo: ' . $filename . '.csv: \r\n';
      }
      return $outstr;
   }

   private function leeme70FXXIIIA() {
      return $this->getDateTimeMD5( '70FXXIIIA' ) . "70FXXIIIA\r\n
      Ejercicio\r\n
      Denominación del documento\r\n
      Fecha de publicación en el DOF\r\n
      Hipervínculo al documento\r\n
      Fecha de validación\r\n
      Área responsable de la información\r\n
      Año\r\n
      Fecha de actualización\r\n
      Nota\r\n";
   }

   private function leeme70FXXIIIB() {
      return $this->getDateTimeMD5( '70FXXIIIB' ) . "70FXXIIIB\r\n
      Función del sujeto obligado:\r\n
      Función del sujeto obligado:\r\n
      Área administrativa encargada de solicitar el servicio\r\n
      Clasificación de los servicios:\r\n
      Ejercicio\r\n
      Periodo que se informa\r\n
      Tipo de servicio\r\n
      Tipo de medio\r\n
      Descripción de unidad\r\n
      Tipo: Campaña o aviso institucional:\r\n
      Nombre de la campaña o Aviso Institucional\r\n
      Año de la campaña\r\n
      Tema de la campaña o aviso institucional\r\n
      Objetivo institucional\r\n
      Objetivo de comunicación\r\n
      Costo por unidad\r\n
      Clave única de identificación de campaña\r\n
      Autoridad que proporcionó la clave\r\n
      Cobertura\r\n
      Ámbito geográfico de cobertura\r\n
      Fecha de inicio de la campaña o aviso\r\n
      Fecha de término de los servicios contratados\r\n
      Sexo\r\n
      Lugar de residencia\r\n
      Nivel educativo\r\n
      Grupo de edad\r\n
      Nivel socioeconómico\r\n
      Respecto a los proveedores y su contratación (Factura-Orden de compra-Contrato-Proveedor)\r\n
      Respecto a los recursos y el presupuesto (Factura-Orden de compra-Contrato-Proveedor)\r\n
      Respecto al contrato y los montos (Factura-Orden de compra-Contrato-Proveedor)\r\n
      Fecha de validación\r\n
      Área responsable de la información\r\n
      Año\r\n
      Fecha de actualización\r\n
      Nota\r\n";
   }

   private function leemeF70FXXIIIB_tabla_10632() {
      return $this->getDateTimeMD5( 'F70FXXIIIB_tabla_10632' ) . "F70FXXIIIB_tabla_10632\r\n
      ID Respecto a los proveedores y su contratación (Factura-Orden de compra-Contrato-Proveedor)\r\n
      Procedimiento de contratación:\r\n
      Registro Federal de Contribuyentes\r\n
      Razón social\r\n
      Razones que justifican la elección\r\n
      Segundo apellido\r\n
      Fundamento jurídico\r\n
      Primer apellido\r\n
      Nombre (s)\r\n
      Nombre comercial\r\n";
   }

   private function leemeF70FXXIIIB_tabla_10633() {
      return $this->getDateTimeMD5( 'F70FXXIIIB_tabla_10633' ) . "F70FXXIIIB_tabla_10633\r\n
      ID Respecto a los recursos y el presupuesto (Factura-Orden de compra-Contrato-Proveedor\r\n
      Partida genérica\r\n
      Presupuesto ejercido al periodo\r\n
      Presupuesto total ejercido por concepto\r\n
      Presupuesto modificado por concepto\r\n
      Presupuesto modificado por partida\r\n
      Presupuesto asignado por concepto\r\n
      Denominación de cada partida\r\n
      Presupuesto total asignado a cada partida\r\n
      Nombre del concepto\r\n
      Clave del concepto\r\n";           
   }

   private function leemeF70FXXIIIB_tabla_10656() {
      return $this->getDateTimeMD5( 'F70FXXIIIB_tabla_10656' ) . "F70FXXIIIB_tabla_10656\r\n
      ID Respecto al contrato y los montos (Factura-Orden de compra-Contrato-Proveedor)\r\n
      Fecha de término\r\n
      Objeto del contrato\r\n
      Número o referencia de identificación del contrato\r\n
      Número de Factura\r\n
      Hipervínculo al convenio modificatorio, en su caso\r\n
      Monto pagado al periodo publicado\r\n
      Hipervínculo al contrato firmado\r\n
      Monto total del contrato\r\n
      Hipervínculo a la factura\r\n
      Fecha de firma de contrato\r\n
      Fecha de inicio\r\n";      
   }

   private function leemePNT() {
      return "TPO Ver 1.0a\n" .
             "A continuación se detalla la exportación de la opción \"PNT\", " . 
             "del sitio " . IURL_ROOT .  
             ", relacionandose los archivos por medio de los ID's. \n\n" .
      $this->leeme70FXXIIIA(). "\n\n".
      $this->leeme70FXXIIIB(). "\n\n".
      $this->leemeF70FXXIIIB_tabla_10632(). "\n\n".
      $this->leemeF70FXXIIIB_tabla_10633(). "\n\n".
      $this->leemeF70FXXIIIB_tabla_10656(). "\n\n";
   }

   private function leemeFacturas() {
      return $this->getDateTimeMD5( 'facturas' ) . "Facturas\r\n
      ID (Número de factura)\r\n
      Proveedor\r\n
      Contrato\r\n
      Orden\r\n
      Ejercicio\r\n
      Trimestre\r\n
      Sujeto obligado contratante\r\n
      Partida\r\n
      Monto\r\n
      Archivo factura en PDF (Vínculo al archivo)\r\n
      Archivo factura en XML (Vínculo al archivo)\r\n
      Fecha de erogación\r\n
      Estatus\r\n";
   }

   private function leemeDetalleFacturas() {
      return $this->getDateTimeMD5( 'facturas_detalle' ) . "Detalle de Facturas\r\n
      ID de subconcepto \r\n
      ID (Número de factura)\r\n
      Campaña o aviso institucional\r\n
      Nombre de la campaña o aviso\r\n
      Clasificación del servicio\r\n
      Categoría del servicio\r\n
      Subcategoría del servicio\r\n
      Unidad\r\n
      Sujeto obligado solicitante\r\n
      Área administrativa solicitante\r\n
      Descripción del servicio o producto adquirido\r\n
      Cantidad\r\n
      Precio unitario con I.V.A incluido\r\n
      Monto\r\n
      Estatus\r\n";
   }      

   private function leemeOrdenCompra() {
      return $this->getDateTimeMD5( 'orden_compra' ) ."Orden de compra \r\n
      ID (Orden de compra)\r\n
      Proveedor\r\n
      Procedimiento\r\n
      Contrato\r\n
      Ejercicio\r\n
      Trimestre\r\n
      Sujeto obligado ordenante\r\n
      Campaña o aviso institucional\r\n   
      Sujeto obligado solicitante\r\n
      Justificación\r\n
      Fecha de orden\r\n
      Archivo de la orden de compra en PDF (Vínculo al documento)\r\n
      Estatus\r\n";   
   }   

   private function leemeContratos() {
      return $this->getDateTimeMD5( 'contratos' ) . "Contratos\r\n
      ID (Número de contrato)\r\n
      Procedimiento\r\n
      Proveedor\r\n
      Ejercicio\r\n
      Trimestre\r\n
      Contratante\r\n
      Solicitante\r\n
      Objeto del contrato\r\n
      Descripción\r\n
      Fundamento jurídico\r\n
      Fecha celebración\r\n
      Fecha inicio\r\n
      Fecha fin\r\n
      Monto original del contrato\r\n
      Monto modificado\r\n
      Monto total\r\n
      Monto pagado a la fecha\r\n
      Archivo contrato en PDF (Vinculo al archivo)\r\n
      Estatus\r\n";
   }

   private function leemeConvenios() {
      return $this->getDateTimeMD5( 'convenios' ) ."Convenio modificatorio\r\n
      ID (Número de convenio modificatorio)\r\n
      ID (Número de contrato)\r\n
      Ejercicio\r\n
      Trimestre\r\n
      Objeto\r\n
      Fundamento jurídico\r\n
      Fecha celebración\r\n
      Monto\r\n
      Archivo convenio en PDF (Vinculo al archivo)\r\n
      Estatus\r\n";
   }
   private function leemeCampanasyAvisos () {
      return $this->getDateTimeMD5( 'campanasyavisos' ) . "Campañas y avisos institucionales\r\n
      ID de campaña o aviso institucional\r\n
      Tipo\r\n
      Subtipo\r\n
      Nombre\r\n
      Ejercicio\r\n
      Trimestre\r\n
      Sujeto obligado contratante\r\n
      Sujeto obligado solicitante\r\n
      Tema\r\n
      Objetivo institucional\r\n
      Objetivo de comunicación\r\n
      Cobertura\r\n
      Ámbito geográfico\r\n
      Fecha inicio\r\n
      Fecha término\r\n
      Tiempo oficial\r\n
      Fecha inicio tiempo oficial\r\n
      Fecha término tiempo oficial\r\n
      Publicación SEGOB.\r\n
      Documento del PACS\r\n
      Fecha publicación\r\n
      Estatus\r\n";
   }

   private function leemeCampanasyAvisosEdad () {
      return $this->getDateTimeMD5( 'campanasyavisos_edad' ) . "Grupo de edad \r\n
      ID de grupo de edad\r\n
      ID de campaña o aviso institucional\r\n";
   }
   private function leemeCampanasyAvisosLugar () {
      return $this->getDateTimeMD5( 'campanasyavisoslugar' ) . "Lugar\r\n
      ID de lugar\r\n
      ID de campaña o aviso institucional\r\n
      Lugar\r\n";
   }

   private function leemeCampanasyAvisosSocioeconomico () {
      return $this->getDateTimeMD5( 'campanasyavisos_socioeconomico' ) . "Nivel socioeconómico \r\n
      ID de nivel socioeconómico\r\n
      ID de campaña o aviso institucional\r\n
      Nivel socioeconómico\r\n";
   }

   private function leemeCampanasyAvisosEducacion () {
      return $this->getDateTimeMD5( 'campanasyavisos_educacion' ) . "Educación \r\n
      ID de educación\r\n
      ID de campaña o aviso institucional\r\n
      Educación\r\n";
   }

   private function leemeCampanasyAvisosSexo () {
      return $this->getDateTimeMD5( 'campanasyavisos_sexo' ) . "Sexo\r\n
      ID de sexo\r\n
      ID de campaña o aviso institucional\r\n
      Sexo\r\n";
   }

   private function leemeCampanasyAvisosAudios () {
      return $this->getDateTimeMD5( 'campanasyavisos_audios' ) . "Audios \r\n
      ID de audios\r\n
      ID de campaña o aviso institucional\r\n
      Audios (Vínculo al archivo)\r\n
      Audios (Vínculo al repositorio)\r\n";
   }

   private function leemeCampanasyAvisosImagenes () {
      return $this->getDateTimeMD5( 'campanasyavisos_imagenes' ) . "Imágenes \r\n
      ID de imágenes\r\n
      ID de campaña o aviso institucional\r\n
      Imágenes (Vínculo al archivo)\r\n
      Imágenes (Vínculo al repositorio)\r\n";
   }

   private function leemeCampanasyAvisosVideos () {
      return $this->getDateTimeMD5( 'campanasyavisos_videos' ) . "Videos \r\n
      ID de videos\r\n
      ID de campaña o aviso institucional\r\n
      Videos(Vínculo al archivo)\r\n
      Videos(Vínculo al repositorio)\r\n";
   }

   private function leemePresupuesto () {
      return $this->getDateTimeMD5( 'presupuesto' ) . "Presupuesto \r\n
      ID de presupuesto\r\n
      Ejercicio\r\n
      Sujeto obligado\r\n
      Presupuesto original\r\n
      Monto modificado\r\n
      Presupuesto modificado\r\n
      Programa Anual\r\n
      Estatus\r\n";
   }

   private function leemeDesglosePartidas () {
      return $this->getDateTimeMD5( 'desglosepartidas' ) . "Desglose de partidas \r\n
      ID de desglose\r\n
      ID de presupuesto\r\n
      Partida presupuestal\r\n
      Monto asignado\r\n
      Monto de modificación\r\n
      Estado\r\n";
   }

   private function leemeProveedores () {
      return $this->getDateTimeMD5( 'proveedores' ) . "Proveedores \r\n
      ID\r\n
      Personalidad jurídica\r\n
      Nombre o razón social\r\n
      Nombre comercial\r\n
      R.F.C.\r\n
      Estatus\r\n";
   }
   
   private function leemeGastoProveedores () {
      return $this->getDateTimeMD5( 'gasto_x_proveedor' ) . "Gasto x Proveedor \r\n
      ID de proveedor\r\n
      Personalidad jurídica\r\n
      Nombre o razón social\r\n
      Nombre comercial\r\n
      R.F.C.\r\n
      Monto total pagado\r\n
      Estatus\r\n";
   }

   private function leemeOCProveedores () {
      return $this->getDateTimeMD5( 'oc_x_proveedor' ) . "Órdenes de compra x Proveedor \r\n
      ID (Orden de compra) \r\n
      ID de proveedor\r\n
      Procedimiento\r\n
      ID (Número de contrato)\r\n
      Ejercicio\r\n
      Trimestre\r\n
      Sujeto obligado ordenante\r\n
      Campaña o aviso institucional\r\n
      Sujeto obligado solicitante\r\n
      Justificación\r\n
      Fecha de orden\r\n
      Archivo de la orden de compra en PDF\r\n
      Estatus\r\n";
   }

   private function leemeSujetosObligados () {
      return $this->getDateTimeMD5( 'sujetos_obligados' ) . "Detalle del sujeto obligado \r\n
      ID de S.O.\r\n
      Función\r\n
      Orden (Federal, Estatal, Municipal)\r\n
      Estado\r\n
      Nombre\r\n
      Siglas\r\n
      URL de página\r\n";
   }

   private function leemeInicio() {
      return "TPO Ver 1.0a\r\n" .
             "A continuación se detalla la exportación de la opción \"Inicio\", " . 
             "del sitio " . IURL_ROOT .  
             ", relacionandose los archivos por medio de los ID's. \r\n\r\n" .
      $this->leemeFacturas() . "\r\n\r\n" .
      $this->leemeDetalleFacturas() . "\r\n\r\n".
      $this->leemeOrdenCompra() . "\r\n\r\n".
      $this->leemeContratos(). "\r\n\r\n".
      $this->leemeConvenios(). "\r\n\r\n".
      $this->leemeCampanasyAvisos(). "\r\n\r\n".
      $this->leemeCampanasyAvisosEdad(). "\r\n\r\n".
      $this->leemeCampanasyAvisosLugar(). "\n\n".
      $this->leemeCampanasyAvisosSocioeconomico(). "\n\n".
      $this->leemeCampanasyAvisosEducacion(). "\n\n".
      $this->leemeCampanasyAvisosSexo(). "\n\n".
      $this->leemeCampanasyAvisosAudios(). "\n\n".
      $this->leemeCampanasyAvisosImagenes(). "\n\n".
      $this->leemeCampanasyAvisosVideos(). "\n\n".
      $this->leemePresupuesto(). "\n\n".
      $this->leemeDesglosePartidas(). "\n\n".
      $this->leemeProveedores(). "\n\n";     
   }

   private function leemePresupuestos() {
      return "TPO Ver 1.0a\n" .
             "A continuación se detalla la exportación de la opción \"Presupuesto\", " . 
             "del sitio " . IURL_ROOT .  
             ", relacionandose los archivos por medio de los ID's. \n\n" .
      $this->leemePresupuesto(). "\n\n".
      $this->leemeDesglosePartidas(). "\n\n";
   }
   
   private function leemePorProveedor() {
      return "TPO Ver 1.0a\n" .
             "A continuación se detalla la exportación de la opción \"Gasto por proveedor\", " . 
             "del sitio " . IURL_ROOT .  
             ", relacionandose los archivos por medio de los ID's. \n\n" .
      $this->leemeGastoProveedores(). "\n\n".
      $this->leemeOCProveedores(). "\n\n".
      $this->leemeContratos(). "\n\n";
   }
                  
   private function leemeGastoPorServicio() {
      return "TPO Ver 1.0a\n" .
             "A continuación se detalla la exportación de la opción \"Gasto por tipo de servicio\", " . 
             "del sitio " . IURL_ROOT .  
             ", relacionandose los archivos por medio de los ID's. \n\n" .
      $this->leemeFacturas() . "\n\n" .
      $this->leemeDetalleFacturas() . "\n\n";      
   }                  
                  
   private function leemeContratosyOrdenes() {
      return "TPO Ver 1.0a\n" .
             "A continuación se detalla la exportación de la opción \"Contratos y órdenes de compra\", " . 
             "del sitio " . IURL_ROOT .  
             ", relacionandose los archivos por medio de los ID's. \n\n" .
      $this->leemeGastoProveedores(). "\n\n".
      $this->leemeContratos(). "\n\n".
      $this->leemeConvenios(). "\n\n".
      $this->leemeOrdenCompra() . "\n\n";
   }                  

   private function leemeCampanasyAvisosIntitucionales() {
      return "TPO Ver 1.0a\n" .
             "A continuación se detalla la exportación de la opción \"Campañas y avisos intitucionales\", " . 
             "del sitio " . IURL_ROOT .  
             ", relacionandose los archivos por medio de los ID's. \n\n" .
      $this->leemeCampanasyAvisos(). "\n\n".
      $this->leemeCampanasyAvisosEdad(). "\n\n".
      $this->leemeCampanasyAvisosLugar(). "\n\n".
      $this->leemeCampanasyAvisosSocioeconomico(). "\n\n".
      $this->leemeCampanasyAvisosEducacion(). "\n\n".
      $this->leemeCampanasyAvisosSexo(). "\n\n".
      $this->leemeCampanasyAvisosAudios(). "\n\n".
      $this->leemeCampanasyAvisosImagenes(). "\n\n".
      $this->leemeCampanasyAvisosVideos(). "\n\n";
   }   
                                    
   private function leemeSO() {
      return "TPO Ver 1.0a\n" .
             "A continuación se detalla la exportación de la opción \"Sujetos obligados\", " . 
             "del sitio " . IURL_ROOT .  
             ", relacionandose los archivos por medio de los ID's. \n\n" .
      $this->leemeSujetosObligados() . "\n\n" .
      $this->leemeOrdenCompra() . "\r\n\r\n".
      $this->leemeContratos(). "\r\n\r\n".
      $this->leemeConvenios(). "\r\n\r\n";
   }

   private function leemeErogaciones() {
      return "TPO Ver 1.0a\n" .
             "A continuación se detalla la exportación de la opción \"Erogaciones\", " . 
             "del sitio " . IURL_ROOT .  
             ", relacionandose los archivos por medio de los ID's. \n\n" .
      $this->leemeFacturas() . "\n\n" .
      $this->leemeDetalleFacturas() . "\n\n";      
   }                                    

   private function facturas() {
      $sql = "SELECT * FROM vout_facturas;";
      $cols = array('ID (Número de factura)', 'Proveedor', 'Contrato', 'Orden', 'Ejercicio', 'Trimestre', 
                    'Sujeto obligado contratante', 'Partida', 'Monto', 'Archivo factura en PDF (Vínculo al archivo)', 
                    'Archivo factura en XML (Vínculo al archivo)', 'Fecha de erogación', 'Estatus');
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/facturas.csv"); 
   }

   private function facturas_desglose() {
      $sql = "SELECT * FROM vout_facturas_desglose;";
      $cols = array("ID de subconcepto", "ID (Número de factura)",
                    "Campaña o aviso institucional", "Nombre campaña o aviso institucional", 
                    "Clasificación del servicio", "Categoría del servicio",
                    "Subcategoría del servicio", "Unidad", "Sujeto obligado solicitante", "Área administrativa solicitante",
                    "Descripción del servicio o producto adquirido", "Cantidad", "Precio unitario con I.V.A incluido",
                    "Monto","Estatus");    
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/facturas_detalle.csv");
   }      

   private function orden_compra() {
      $sql = "SELECT * FROM vout_ordenes_compra;";
      $cols = array("ID (Orden de compra)","Proveedor","Procedimiento","Contrato","Ejercicio","Trimestre",
                    "Sujeto obligado ordenante","Campaña o aviso institucional","Sujeto obligado solicitante", "Número orden de compra",
                    "Justificación","Fecha de orden","Archivo de la orden de compra en PDF (Vínculo al documento)","Estatus");
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/orden_compra.csv");
   }      
      
   private function contratos() {
      $sql = "SELECT * FROM vout_contratos;";
      $cols = array("ID (Número de contrato)", "Procedimiento", "Proveedor", "Ejercicio", "Trimestre", "Contratante",
                    "Solicitante", "Objeto del contrato", "Descripción", "Fundamento jurídico", "Fecha celebración",
                    "Fecha inicio", "Fecha fin", "Monto original del contrato", "Monto modificado", "Monto total",
                    "Monto pagado a la fecha", "Archivo contrato en PDF (Vinculo al archivo)", "Estatus");
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/contratos.csv");
   }      

   private function convenios() {
      $sql = "SELECT * FROM vout_convenios_modificatorios;";
      $cols = array("ID (Número de convenio modificatorio)", "ID (Número de contrato)", "Ejercicio", "Trimestre",
                    "Objeto", "Fundamento jurídico", "Fecha celebración", "Monto", 
                    "Archivo convenio en PDF (Vinculo al archivo)", "Estatus");
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/convenios.csv");
   }      
   
   private function campanasyavisos() {
      $sql = "SELECT * FROM vout_campana_aviso;";
      $cols = array("ID de campaña o aviso institucional", "Tipo", "Subtipo", "Nombre", "Ejercicio", "Trimestre",
                    "Sujeto obligado contratante","Sujeto obligado solicitante","Tema","Objetivo institucional",
                    "Objetivo de comunicación", "Cobertura", "Ámbito geográfico", "Fecha inicio", "Fecha término",
                    "Tiempo oficial","Fecha inicio tiempo oficial","Fecha término tiempo oficial","Publicación SEGOB.",
                    "Documento del PACS","Fecha publicación","Evaluación","Estatus");
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/campanasyavisos.csv");
   }      
   
   private function campanasyavisos_edad() {
      $sql = "SELECT * FROM vout_campana_grupo_edad;";
      $cols = array("ID de grupo de edad", "ID de campaña o aviso institucional", "Grupo de edad");         
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/campanasyavisos_edad.csv");
   }      
      
   private function campanasyavisos_lugar() {
      $sql = "SELECT * FROM vout_campana_lugar;";
      $cols = array("ID de lugar", "ID de campaña o aviso institucional", "Lugar");         
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/campanasyavisos_lugar.csv");
   }      
   
   private function campanasyavisos_socioeconomico() {
      $sql = "SELECT * FROM vout_campana_nivel;";
      $cols = array("ID de nivel socioeconómico", "ID de campaña o aviso institucional", "Nivel socioeconómico");         
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/campanasyavisos_socioeconomico.csv");
   }      
   
   private function campanasyavisos_educacion() {
      $sql = "SELECT * FROM vout_campana_nivel_educativo;";
      $cols = array( "ID de educación", "ID de campaña o aviso institucional", "Educación" );         
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/campanasyavisos_educacion.csv");
   }      
   
   private function campanasyavisos_sexo() {
      $sql = "SELECT * FROM vout_campana_sexo;";
      $cols = array("ID de sexo", "ID de campaña o aviso institucional", "Sexo");
      $resultado = $this->Graficas_model->db->query($sql)->result();
      return dbToCSV(object_to_array($resultado), $cols, "data/campanasyavisos_sexo.csv");
   }      
   
   private function campanasyavisos_audios() {
      $sql = "SELECT * FROM vout_campana_maudio;";
      $cols = array("ID de audios", "ID de campaña o aviso institucional", 
                    "Audios (Vínculo al archivo)", "Audios (Vínculo al repositorio)");         
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/campanasyavisos_audios.csv");
   }      
   
   private function campanasyavisos_imagenes() {
      $sql = "SELECT * FROM vout_campana_mimagenes;";
      $cols = array("ID de imágenes", "ID de campaña o aviso institucional", 
                    "Imágenes (Vínculo al archivo)", "Imágenes (Vínculo al repositorio)");         
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/campanasyavisos_imagenes.csv");
   }      
   
   private function campanasyavisos_videos() {
      $sql = "SELECT * FROM vout_campana_mvideo;";
      $cols = array("ID de videos", "ID de campaña o aviso institucional", 
                    "Videos(Vínculo al archivo)", "Videos(Vínculo al repositorio)");   
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/campanasyavisos_videos.csv");
   }      
     
   private function presupuesto() {
      $sql = "SELECT * FROM vout_presupuestos;";
      $cols = array("ID de presupuesto", "Ejercicio", "Sujeto obligado", "Presupuesto original",
                    "Monto modificado", "Presupuesto modificado", "Presupuesto ejercido", "Programa Anual", "Estatus");
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/presupuesto.csv");
   }      

   private function desglosepartidas() {
      $sql = "SELECT * FROM vout_presupuestos_desglose;";
      $cols = array("ID de desglose", "ID de presupuesto", "Partida presupuestal", 
                    "Monto asignado", "Monto de modificación", "Estado");
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/desglosepartidas.csv");
   }      

   private function proveedores() {
      $sql = "SELECT * FROM vout_proveedores;";
      $cols = array("ID", "Personalidad jurídica", "Nombre o razón social", "Nombre comercial", "R.F.C.", "Estatus");
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/proveedores.csv");
   }      
   
   private function gasto_x_proveedor() {
      $sql = "SELECT * FROM vout_gasto_x_proveedor;";
      $cols = array("ID de proveedor", "Personalidad jurídica", "Nombre o razón social", "Nombre comercial", 
                    "R.F.C.", "Monto total pagado", "Estatus");

      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/gasto_x_proveedor.csv");
   }      
   
   private function oc_x_proveedor() {
      $sql = "SELECT * FROM vout_oc_x_proveedor;";
      $cols = array("ID (Orden de compra)", "ID de proveedor", "Nombre de proveedor", "Procedimiento", "ID (Número de contrato)", "Ejercicio", 
                    "Trimestre", "Sujeto obligado ordenante", "Campaña o aviso institucional", "Sujeto obligado solicitante", 
                    "Justificación", "Fecha de orden", "Archivo de la orden de compra en PDF", "Estatus");
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/oc_x_proveedor.csv");
   }      
   
   private function sujetos_obligados() {
      $sql = "SELECT * FROM vout_sujetos_obligados;";
      $cols = array("ID de S.O.","Función","Orden (Federal, Estatal, Municipal)","Estado","Nombre","Siglas","URL de página");      
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/sujetos_obligados.csv");
   }    

   private function F70FXXIIIA() {
      $sql = "select 
(select c.ejercicio from cat_ejercicios as c where c.id_ejercicio= a.id_ejercicio) as ejercicio,
a.denominacion as denominacion,
a.fecha_publicacion as publicacion,
a.file_programa_anual as hipervinculo,
a.fecha_validacion as validacion,
a.area_responsable as area_responsable,
a.anio as periodo, 
a.fecha_actualizacion as actualizacion,
a.nota as nota
from 
tab_presupuestos as a";
      $cols = array("Ejercicio", "Denominación del documento", "Fecha de publicación en el DOF", "Hipervínculo al documento","Fecha de validación","Área responsable de la información","Año","Fecha de actualización","Nota");      
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/70FXXIIIA.csv");
   }    

   private function F70FXXIIIB_reporte_formatos() {
      $sql = 'select 
(select f.nombre_so_atribucion from cat_so_atribucion as f where c.id_so_atribucion=f.id_so_atribucion)  as funcion, 
a.area_responsable, 
(select g.nombre_servicio_clasificacion from cat_servicios_clasificacion as g where b.id_servicio_clasificacion=g.id_servicio_clasificacion)  as id_servicio_clasificacion, 
(select h.ejercicio from cat_ejercicios as h where a.id_ejercicio=h.id_ejercicio)  as ejercicio, 
(select i.trimestre from cat_trimestres as i where a.id_trimestre=i.id_trimestre)  as trimestre, 
(select j.nombre_servicio_categoria from cat_servicios_categorias as j where b.id_servicio_categoria=j.id_servicio_categoria ) as id_servicio_categoria, 
(select k.nombre_servicio_subcategoria from cat_servicios_subcategorias as k where b.id_servicio_subcategoria=k.id_servicio_subcategoria ) as id_servicio_subcategoria, 
b.descripcion_servicios, 
(select l.nombre_campana_tipo from cat_campana_tipos as l where d.id_campana_tipo=l.id_campana_tipo) as id_campana_tipo, 
d.nombre_campana_aviso, 
(select m.ejercicio from cat_ejercicios as m where d.id_ejercicio=m.id_ejercicio)  as ejercicio_oc, 
(select n.nombre_campana_tema from cat_campana_temas as n where d.id_campana_tema=n.id_campana_tema)  as id_campana_tema, 
(select o.campana_objetivo from cat_campana_objetivos as o where d.id_campana_objetivo=o.id_campana_objetivo)  as id_campana_objetivo, 
d.objetivo_comunicacion, 
b.monto_desglose, 
d.clave_campana, 
d.autoridad, 
(select p.nombre_campana_cobertura from cat_campana_coberturas as p where d.id_campana_cobertura = p.id_campana_cobertura) as id_campana_cobertura, 
d.campana_ambito_geo,
d.fecha_inicio, 
d.fecha_termino, 
(SELECT GROUP_CONCAT(g.nombre_poblacion_sexo SEPARATOR " * ") FROM rel_campana_sexo as f, cat_poblacion_sexo as g 
 WHERE  f.id_campana_aviso = b.id_campana_aviso and f.id_poblacion_sexo = g.id_poblacion_sexo ) as sexo, 

(SELECT GROUP_CONCAT(f.poblacion_lugar SEPARATOR " * ") FROM rel_campana_lugar as f 
 WHERE  f.id_campana_aviso = b.id_campana_aviso) as lugar, 

(SELECT GROUP_CONCAT(g.nombre_poblacion_nivel_educativo SEPARATOR " * ") 
   FROM rel_campana_nivel_educativo as f, cat_poblacion_nivel_educativo as g 
  WHERE  f.id_campana_aviso = b.id_campana_aviso and f.id_poblacion_nivel_educativo = g.id_poblacion_nivel_educativo ) as educacion, 

(SELECT GROUP_CONCAT(g.nombre_poblacion_grupo_edad SEPARATOR " * ") FROM rel_campana_grupo_edad as f, cat_poblacion_grupo_edad as g 
 WHERE  f.id_campana_aviso = b.id_campana_aviso and f.id_poblacion_grupo_edad = g.id_poblacion_grupo_edad ) as grupo_edad, 

(SELECT GROUP_CONCAT(g.nombre_poblacion_nivel SEPARATOR " * ") 
   FROM rel_campana_nivel as f, cat_poblacion_nivel as g 
  WHERE  f.id_campana_aviso = b.id_campana_aviso and f.id_poblacion_nivel = g.id_poblacion_nivel ) as nivel_socioeconomico, 
concat(a.periodo,"-",a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor) as id_respecto_proveedor, 
concat(a.periodo,"-",a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor) as id_respecto_presupuesto, 
concat(a.periodo,"-",a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor) as id_respecto_contrato, 
a.fecha_validacion, 
a.area_responsable as "Area 2",
a.periodo, 
a.fecha_actualizacion, 
a.nota
from 
tab_facturas as a,
tab_facturas_desglose as b,
tab_sujetos_obligados as c,
tab_campana_aviso as d,
tab_proveedores as e
where
a.id_factura = b.id_factura and
a.id_so_contratante = c.id_sujeto_obligado and
b.id_campana_aviso = d.id_campana_aviso and
a.id_proveedor = e.id_proveedor';
      $cols = array(
"Función del sujeto obligado:",
"Área administrativa encargada de solicitar el servicio",
"Clasificación de los servicios:",
"Ejercicio",
"Periodo que se informa",
"Tipo de servicio",
"Tipo de medio",
"Descripción de unidad",
"Tipo: Campaña o aviso institucional:",
"Nombre de la campaña o Aviso Institucional",
"Año de la campaña",
"Tema de la campaña o aviso institucional",
"Objetivo institucional",
"Objetivo de comunicación",
"Costo por unidad (Unidades*Costo Unitario)",
"Clave única de identificación de campaña",
"Autoridad que proporcionó la clave",
"Cobertura",
"Ámbito geográfico de cobertura",
"Fecha de inicio de la campaña o aviso",
"Fecha de término de los servicios contratados",
"Sexo",
"Lugar de residencia",
"Nivel educativo",
"Grupo de edad",
"Nivel socioeconómico",
"Respecto a los proveedores y su contratación (Factura-Orden de compra-Contrato-Proveedor)",
"Respecto a los recursos y el presupuesto (Factura-Orden de compra-Contrato-Proveedor)",
"Respecto al contrato y los montos (Factura-Orden de compra-Contrato-Proveedor)",
"Fecha de validación",
"Área responsable de la información",
"Año",
"Fecha de actualización",
"Nota");      
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/F70FXXIIIB_reporte_formatos.csv");
   }    


   private function F70FXXIIIB_tabla_10632() {
      $sql = 'select 
concat(a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor) as id_respecto_proveedor, 
CONCAT((
select c.nombre_procedimiento	 
from tab_ordenes_compra as b, cat_procedimientos as c
where 
b.id_orden_compra > 1 and
b.id_procedimiento = c.id_procedimiento and
b.id_orden_compra = a.id_orden_compra
union
select c.nombre_procedimiento 
from tab_contratos as b, cat_procedimientos as c
where 
b.id_contrato > 1 and
b.id_procedimiento = c.id_procedimiento and
b.id_contrato = a.id_contrato), " ") as procedimiento, 
e.rfc,
e.nombre_razon_social as razon_social,
CONCAT((
select b.motivo_adjudicacion 
from tab_ordenes_compra as b
where 
b.id_orden_compra > 1 and
b.id_orden_compra = a.id_orden_compra
union
select b.descripcion_justificacion 
from tab_contratos as b
where 
b.id_contrato > 1 and
b.id_contrato = a.id_contrato), " ") as razones, 
e.segundo_apellido,
CONCAT((
select b.descripcion_justificacion
from tab_ordenes_compra as b
where 
b.id_orden_compra > 1 and
b.id_orden_compra = a.id_orden_compra
union
select b.fundamento_juridico 
from tab_contratos as b
where 
b.id_contrato > 1 and
b.id_contrato = a.id_contrato), " ") as fundamento, 
e.primer_apellido,
e.nombres,
e.nombre_comercial
from 
tab_facturas as a,
tab_proveedores as e
where
a.id_proveedor = e.id_proveedor';

      $cols = array(
"ID Respecto a los proveedores y su contratación (Factura-Orden de compra-Contrato-Proveedor)",
"Procedimiento de contratación:",
"Registro Federal de Contribuyentes",
"Razón social",
"Razones que justifican la elección", 
"Segundo apellido",
"Fundamento jurídico",
"Primer apellido",
"Nombre (s)",
"Nombre comercial");      
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/F70FXXIIIB_tabla_10632.csv");
   }    

   private function F70FXXIIIB_tabla_10633() {
/*
      $sql = 'select 
concat(a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor) as id_respecto_presupuesto, 
c.partida as "Partida genérica",
sum(b.monto_desglose) as "Presupuesto ejercido al periodo",
sum(b.monto_desglose) as "Presupuesto total ejercido por concepto", 
sum(e.monto_modificacion) as "Presupuesto modificado por concepto",
sum(e.monto_modificacion) as "Presupuesto modificado por partida",
sum(e.monto_presupuesto) as "Presupuesto asignado por concepto",
d.denominacion as "Denominación de cada partida",
(sum(e.monto_presupuesto) + sum(e.monto_modificacion))"Presupuesto total asignado a cada partida",
c.descripcion  as "Nombre del concepto",
c.concepto as "Clave del concepto"
from 
tab_facturas as a,
tab_facturas_desglose as b,
cat_presupuesto_conceptos as c,
tab_presupuestos as d,
tab_presupuestos_desglose as e
where
a.id_factura = b.id_factura and
a.id_presupuesto_concepto = c.id_presupesto_concepto and
a.id_presupuesto_concepto = e.id_presupuesto_concepto and
e.id_presupuesto_concepto = a.id_presupuesto_concepto 
group by 
concat(a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor),
c.partida,
d.denominacion,
c.descripcion,
c.concepto';
*/
      $sql = 'select 
concat(g.ejercicio,"-",c.partida) as id_respecto_presupuesto, 
c.partida as "Partida genérica",
(select sum(b.monto_desglose) from tab_facturas as a, tab_facturas_desglose as b where a.id_factura = b.id_factura and
 a.id_presupuesto_concepto = e.id_presupuesto_concepto) as "Presupuesto ejercido al periodo",
(select sum(b.monto_desglose) from tab_facturas as a, tab_facturas_desglose as b where a.id_factura = b.id_factura and
 a.id_presupuesto_concepto = e.id_presupuesto_concepto)  as "Presupuesto total ejercido por concepto", 
(sum(e.monto_presupuesto)+sum(e.monto_modificacion)) as "Presupuesto modificado por concepto",
(sum(e.monto_presupuesto)+sum(e.monto_modificacion)) as "Presupuesto modificado por partida",
sum(e.monto_presupuesto) as "Presupuesto asignado por concepto",
c.denominacion as "Denominación de cada partida",
(sum(e.monto_presupuesto)) as "Presupuesto total asignado a cada partida",
(select f.denominacion from cat_presupuesto_conceptos as f where f.capitulo = c.capitulo and trim(f.concepto="") and trim(f.partida="")) as "Nombre del concepto",
c.capitulo as "Clave del concepto"
from 
tab_presupuestos as d,
tab_presupuestos_desglose as e,
cat_presupuesto_conceptos as c,
cat_ejercicios as g
where
e.id_presupuesto = d.id_presupuesto and
e.id_presupuesto_concepto = c.id_presupesto_concepto and
d.id_ejercicio = g.id_ejercicio
group by 
e.id_presupuesto_concepto,
e.id_presupuesto,
d.denominacion';


      $cols = array(
"ID Respecto a los recursos y el presupuesto (Factura-Orden de compra-Contrato-Proveedor)",
"Partida genérica",
"Presupuesto ejercido al periodo",
"Presupuesto total ejercido por concepto", 
"Presupuesto modificado por concepto",
"Presupuesto modificado por partida",
"Presupuesto asignado por concepto",
"Denominación de cada partida",
"Presupuesto total asignado a cada partida",
"Nombre del concepto",
"Clave del concepto");           
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/F70FXXIIIB_tabla_10633.csv");
   }    

   private function F70FXXIIIB_tabla_10656() {
      $sql = 'select 
concat(a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor) as id_respecto_contrato, 
b.fecha_fin as "Fecha de término", 
b.objeto_contrato as "Objeto del contrato",
b.numero_contrato as  "Número o referencia de identificación del contrato",
a.numero_factura as "Número de Factura",
(select GROUP_CONCAT(c.file_convenio," * ") from tab_convenios_modificatorios as c where c.id_contrato=b.id_contrato) as "Hipervínculo al convenio modificatorio, en su caso",
sum(e.monto_desglose) as "Monto pagado al periodo publicado",
b.file_contrato as "Hipervínculo al contrato firmado",
b.monto_contrato as  "Monto total del contrato",
a.file_factura_pdf as  "Hipervínculo a la factura",
b.fecha_celebracion as "Fecha de firma de contrato",
b.fecha_inicio as "Fecha de inicio"
from 
tab_facturas as a,
tab_facturas_desglose as e,
tab_contratos as b
where
a.id_factura = e.id_factura and
a.id_contrato = b.id_contrato and
a.id_contrato > 1
group by 
concat(a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor), 
b.fecha_fin, 
b.objeto_contrato,
b.numero_contrato,
a.numero_factura,
b.file_contrato,
b.monto_contrato,
a.file_factura_pdf,
b.fecha_celebracion,
b.fecha_inicio
union
select 
concat(a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor) as id_respecto_contrato, 
"" as "Fecha de término", 
b.descripcion_justificacion as "Objeto del contrato",
b.numero_orden_compra as  "Número o referencia de identificación del contrato",
a.numero_factura as "Número de Factura",
"" as "Hipervínculo al convenio modificatorio, en su caso",
sum(e.monto_desglose) as "Monto pagado al periodo publicado",
"" as "Hipervínculo al contrato firmado",
0 as  "Monto total del contrato",
a.file_factura_pdf as  "Hipervínculo a la factura",
b.fecha_orden as "Fecha de firma de contrato",
b.fecha_orden as "Fecha de inicio"
from 
tab_facturas as a,
tab_facturas_desglose as e,
tab_ordenes_compra as b
where
a.id_factura = e.id_factura and
a.id_orden_compra = b.id_orden_compra and
a.id_orden_compra > 1
group by 
concat(a.id_factura,"-",a.id_orden_compra,"-",a.id_contrato,"-",a.id_proveedor), 
b.descripcion_justificacion,
b.numero_orden_compra,
a.numero_factura,
a.file_factura_pdf,
b.fecha_orden,
b.fecha_orden';

      $cols = array(
"ID Respecto al contrato y los montos (Factura-Orden de compra-Contrato-Proveedor)",
"Fecha de término", 
"Objeto del contrato",
"Número o referencia de identificación del contrato",
"Número de Factura",
"Hipervínculo al convenio modificatorio, en su caso",
"Monto pagado al periodo publicado",
"Hipervínculo al contrato firmado",
"Monto total del contrato",
"Hipervínculo a la factura",
"Fecha de firma de contrato",
"Fecha de inicio");      
      $resultado = $this->Graficas_model->db->query($sql)->result(); 
      return dbToCSV(object_to_array($resultado), $cols, "data/F70FXXIIIB_tabla_10656.csv");
   }    

      private function limpiarCadena($valor){
	$valor = str_ireplace("javascript:alert","",$valor);
	$valor = str_ireplace("alert","",$valor);
	$valor = str_ireplace("SELECT","",$valor);
        $valor = str_ireplace("INSERT","",$valor); 
	$valor = str_ireplace("COPY","",$valor);
	$valor = str_ireplace("DELETE","",$valor);
	$valor = str_ireplace("DROP","",$valor);
	$valor = str_ireplace("DUMP","",$valor);
	$valor = str_ireplace(" OR ","",$valor);
	$valor = str_ireplace(" AND ","",$valor);
	$valor = str_ireplace("%","",$valor);
	$valor = str_ireplace("LIKE","",$valor);
	$valor = str_ireplace("--","",$valor);
	$valor = str_ireplace("^","",$valor);
	$valor = str_ireplace("[","",$valor);
	$valor = str_ireplace("]","",$valor);
	$valor = str_ireplace("\\","",$valor);
	$valor = str_ireplace("!","",$valor);
	$valor = str_ireplace("¡","",$valor);
	$valor = str_ireplace("?","",$valor);
	$valor = str_ireplace("=","",$valor);
	$valor = str_ireplace("&","",$valor);
	$valor = str_ireplace("<?php","",$valor);
	$valor = str_ireplace("?>","",$valor);
	return $valor;
      }

      private function mysql_escape_mimic($inp) { 
         if(is_array($inp)) 
            return array_map(__METHOD__, $inp); 
 
         if(!empty($inp) && is_string($inp)) { 
            return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
         } 
         return $inp; 
      } 

   public function index() {	
         $input_arr = array(); 
         foreach ($_POST as $key => $input_arr) { 
	    $_POST[$key] = htmlspecialchars(addslashes($this->limpiarCadena($this->mysql_escape_mimic(strip_tags($input_arr))))); 
         }
         $input_arr = array(); 
         foreach ($_GET as $key => $input_arr) { 
	    $_GET[$key] = htmlspecialchars(addslashes($this->limpiarCadena($this->mysql_escape_mimic(strip_tags($input_arr))))); 
         }

      if (isset($_GET["exp"])) {
         if ($_GET["exp"]=="inicio") {          
            $urlfilename = "data/InicioData.zip";
            $filename = IDIR_ROOT . "data/InicioData.zip";
            $filetemp = IDIR_ROOT . 'data/' . time() . '.zip';
            if (file_exists ( $filename )) {
               unlink ( $filename );
            }            
            $continuar = $this->facturas();
            $continuar = $this->facturas_desglose();              
            $continuar = $this->orden_compra();
            $continuar = $this->contratos();
            $continuar = $this->convenios();
            $continuar = $this->campanasyavisos();
            $continuar = $this->campanasyavisos_edad();
            $continuar = $this->campanasyavisos_lugar();
            $continuar = $this->campanasyavisos_socioeconomico();
            $continuar = $this->campanasyavisos_educacion();
            $continuar = $this->campanasyavisos_sexo();
            $continuar = $this->campanasyavisos_audios();
            $continuar = $this->campanasyavisos_imagenes();
            $continuar = $this->campanasyavisos_videos();
            $continuar = $this->presupuesto();
            $continuar = $this->desglosepartidas(); 
            $continuar = $this->proveedores();   
            
            $files =array("data/facturas.csv", "data/facturas_detalle.csv", "data/orden_compra.csv", "data/contratos.csv",
                          "data/convenios.csv", "data/campanasyavisos.csv", "data/campanasyavisos_edad.csv", 
                          "data/campanasyavisos_lugar.csv", "data/campanasyavisos_socioeconomico.csv", 
                          "data/campanasyavisos_educacion.csv", "data/campanasyavisos_sexo.csv", "data/campanasyavisos_audios.csv",
                          "data/campanasyavisos_imagenes.csv","data/campanasyavisos_videos.csv", 
                          "data/presupuesto.csv","data/desglosepartidas.csv","data/proveedores.csv"
                          );
               
            $leemefile = 'leeme.txt';
            $leemetexto = $this->leemeInicio();                              
            creaZip($leemefile, $leemetexto, $files, $filetemp);
            rename( $filetemp, $filename );
            sleep( 1 );
            echo "<script> window.open('". $urlfilename ."', '_blank'); window.history.back(); </script>";               
         }	
         
         if ($_GET["exp"]=="presupuesto") {          
            $urlfilename = "data/PresupuestoData.zip";
            $filename = IDIR_ROOT . "data/PresupuestoData.zip";
            $filetemp = IDIR_ROOT . 'data/' . time() . '.zip';
            if (file_exists ( $filename )) {
               unlink ( $filename );
            }            
            $continuar = $this->campanasyavisos_videos();
            $continuar = $this->presupuesto();
            
            $files =array("data/presupuesto.csv","data/desglosepartidas.csv");
               
            $leemefile = 'leeme.txt';
            $leemetexto = $this->leemePresupuestos();                              
            creaZip($leemefile, $leemetexto, $files, $filetemp);
            rename( $filetemp, $filename );
            sleep( 1 );
            echo "<script> window.open('". $urlfilename ."', '_blank'); window.history.back(); </script>";               
         }	                                 
         
         if ($_GET["exp"]=="porproveedor") {          
            $urlfilename = "data/GastoXProveedorData.zip";
            $filename = IDIR_ROOT . "data/GastoXProveedorData.zip";
            $filetemp = IDIR_ROOT . 'data/' . time() . '.zip';
            if (file_exists ( $filename )) {
               unlink ( $filename );
            }            
            $continuar = $this->gasto_x_proveedor();
            $continuar = $this->oc_x_proveedor();
            $continuar = $this->contratos();
            $continuar = $this->convenios();

            $files =array("data/gasto_x_proveedor.csv","data/oc_x_proveedor.csv","data/contratos.csv", "data/convenios.csv");
               
            $leemefile = 'leeme.txt';
            $leemetexto = $this->leemePorProveedor();                              
            creaZip($leemefile, $leemetexto, $files, $filetemp);
            rename( $filetemp, $filename );
            sleep( 1 );
            echo "<script> window.open('". $urlfilename ."', '_blank'); window.history.back(); </script>";               
         }	                                 
         
         if ($_GET["exp"]=="porservicio") {          
            $urlfilename = "data/GastoPorServicioData.zip";
            $filename = IDIR_ROOT . "data/GastoPorServicioData.zip";
            $filetemp = IDIR_ROOT . 'data/' . time() . '.zip';
            if (file_exists ( $filename )) {
               unlink ( $filename );
            }            
            $continuar = $this->facturas();
            $continuar = $this->facturas_desglose();              
            
            $files =array("data/facturas.csv", "data/facturas_detalle.csv");
               
            $leemefile = 'leeme.txt';
            $leemetexto = $this->leemeGastoPorServicio();                              
            creaZip($leemefile, $leemetexto, $files, $filetemp);
            rename( $filetemp, $filename );
            sleep( 1 );
            echo "<script> window.open('". $urlfilename ."', '_blank'); window.history.back(); </script>";               
         }	
         
         if ($_GET["exp"]=="contratosyordenes") {          
            $urlfilename = "data/ContratosyOrdenesData.zip";
            $filename = IDIR_ROOT . "data/ContratosyOrdenesData.zip";
            $filetemp = IDIR_ROOT . 'data/' . time() . '.zip';
            if (file_exists ( $filename )) {
               unlink ( $filename );
            }            
//            $continuar = $this->gasto_x_proveedor();
            $continuar = $this->orden_compra();
            $continuar = $this->convenios();
            $continuar = $this->contratos();
            
            $files =array("data/orden_compra.csv", "data/contratos.csv", "data/convenios.csv");
               
            $leemefile = 'leeme.txt';
            $leemetexto = $this->leemeContratosyOrdenes();                              
            creaZip($leemefile, $leemetexto, $files, $filetemp);
            rename( $filetemp, $filename );
            sleep( 1 );
            echo "<script> window.open('". $urlfilename ."', '_blank'); window.history.back(); </script>";               
         }	
         
         if ($_GET["exp"]=="campanasyavisos") {          
            $urlfilename = "data/CampnasyAvisosData.zip";
            $filename = IDIR_ROOT . "data/CampnasyAvisosData.zip";
            $filetemp = IDIR_ROOT . 'data/' . time() . '.zip';
            if (file_exists ( $filename )) {
               unlink ( $filename );
            }            
            $continuar = $this->campanasyavisos();
            $continuar = $this->campanasyavisos_edad();
            $continuar = $this->campanasyavisos_lugar();
            $continuar = $this->campanasyavisos_socioeconomico();
            $continuar = $this->campanasyavisos_educacion();
            $continuar = $this->campanasyavisos_sexo();
            $continuar = $this->campanasyavisos_audios();
            $continuar = $this->campanasyavisos_imagenes();
            $continuar = $this->campanasyavisos_videos();
            
            $files =array("data/campanasyavisos.csv", "data/campanasyavisos_edad.csv", 
                          "data/campanasyavisos_lugar.csv", "data/campanasyavisos_socioeconomico.csv", 
                          "data/campanasyavisos_educacion.csv", "data/campanasyavisos_sexo.csv", "data/campanasyavisos_audios.csv",
                          "data/campanasyavisos_imagenes.csv","data/campanasyavisos_videos.csv");
               
            $leemefile = 'leeme.txt';
            $leemetexto = $this->leemeCampanasyAvisosIntitucionales();                              
            creaZip($leemefile, $leemetexto, $files, $filetemp);
            rename( $filetemp, $filename );
            sleep( 1 );
            echo "<script> window.open('". $urlfilename ."', '_blank'); window.history.back(); </script>";               
         }	
         
         if ($_GET["exp"]=="so") {          
            $urlfilename = "data/SujetosObligadosData.zip";
            $filename = IDIR_ROOT . "data/SujetosObligadosData.zip";
            $filetemp = IDIR_ROOT . 'data/' . time() . '.zip';
            if (file_exists ( $filename )) {
               unlink ( $filename );
            }            
            $continuar = $this->sujetos_obligados();
            $continuar = $this->orden_compra();
            $continuar = $this->contratos();
            $continuar = $this->convenios();
            
            $files =array("data/sujetos_obligados.csv", "data/orden_compra.csv", "data/contratos.csv",
                          "data/convenios.csv");
               
            $leemefile = 'leeme.txt';
            $leemetexto = $this->leemeSO();                              
            creaZip($leemefile, $leemetexto, $files, $filetemp);
            rename( $filetemp, $filename );
            sleep( 1 );
            echo "<script> window.open('". $urlfilename ."', '_blank'); window.history.back(); </script>";               
         }	
         
         if ($_GET["exp"]=="erogaciones") {          
            $urlfilename = "data/ErogacionesData.zip";
            $filename = IDIR_ROOT . "data/ErogacionesData.zip";
            $filetemp = IDIR_ROOT . 'data/' . time() . '.zip';
            if (file_exists ( $filename )) {
               unlink ( $filename );
            }            
            $continuar = $this->facturas();
            $continuar = $this->facturas_desglose();              
            
            $files =array("data/facturas.csv", "data/facturas_detalle.csv");
               
            $leemefile = 'leeme.txt';
            $leemetexto = $this->leemeErogaciones();                              
            creaZip($leemefile, $leemetexto, $files, $filetemp);
            rename( $filetemp, $filename );
            sleep( 1 );
            echo "<script> window.open('". $urlfilename ."', '_blank'); window.history.back(); </script>";               
         }	                  


         if ($_GET["exp"]=="PNT") {          
            $urlfilename = "data/PNT.zip";
            $filename = IDIR_ROOT . "data/PNT.zip";
            $filetemp = IDIR_ROOT . 'data/' . time() . '.zip';
            if (file_exists ( $filename )) {
               unlink ( $filename );
            }            
            $continuar = $this->F70FXXIIIA();
            $continuar = $this->F70FXXIIIB_reporte_formatos();              
            $continuar = $this->F70FXXIIIB_tabla_10633();              
            $continuar = $this->F70FXXIIIB_tabla_10656();              
            $continuar = $this->F70FXXIIIB_tabla_10632();              
            
            $files =array("data/70FXXIIIA.csv", "data/F70FXXIIIB_reporte_formatos.csv", "data/F70FXXIIIB_tabla_10633.csv",
                          "data/F70FXXIIIB_tabla_10656.csv", "data/F70FXXIIIB_tabla_10632.csv", "data/Manual de usuario.pdf");
               
            $leemefile = 'leeme.txt';
            $leemetexto = $this->leemePNT();                              
            creaZip($leemefile, $leemetexto, $files, $filetemp);
            rename( $filetemp, $filename );
            sleep( 3 );
            echo "<script> window.open('". $urlfilename ."', '_blank'); window.history.back(); </script>";               
         }	                  


      }	        
   }
}
?>

