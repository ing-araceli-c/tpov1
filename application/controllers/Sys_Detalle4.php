<?php class Sys_Detalle4 extends CI_Controller {
     function __construct() {
         parent::__construct();
         $this->load->helper('url'); 
         $this->load->model("Tpo_model", "fechaact");
         $this->fechaact->initialize("sec_users");
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

         $data['fechaact'] = $this->fechaact->get();
 	 if (getD3D("page_act")=='') {
		setD3D("group_act", "pages/");
		setD3D("page_act",  "Contratos");
	 }
	 $this->load->view('system/base/Top');
	 $this->load->view('system/base/Menu', $data, FALSE);

         if(isset($_GET['contrato'])) {
            $string = $_GET['contrato'];
            $this->Tpo_model->initialize("tab_contratos");
            $contrato = $this->Tpo_model->find1("id_contrato", $string, 1);
            setD3D("numero_contrato",  $contrato[0]->numero_contrato);
            setD3D("page_act",  "contratoDetalle");
            $data['page'] = getD3D("page_act");
            $data['contrato'] = $string;
            $data['oc'] = '';
            $this->load->view('system/base/bread', $data, FALSE);
            $data1['ScreenTarget'] = 'Sys_Screen?v='.  getD3D("page_act") . '&g=' . getD3D("group_act") .'&contrato=' . $string;         
            $this->load->view("system/base/Iframe", $data1, FALSE);
         }   
            
         if(isset($_GET['oc'])) {
            $string = $_GET['oc'];
            $this->Tpo_model->initialize("tab_ordenes_compra");
            $oc = $this->Tpo_model->find1("id_orden_compra", $string, 1);
            setD3D("numero_oc",  $oc[0]->numero_orden_compra);
            setD3D("page_act",  "ocDetalle");
            $data['page'] = getD3D("page_act");
            $data['oc'] = $string;
            $this->load->view('system/base/bread', $data, FALSE);
            $data1['ScreenTarget'] = 'Sys_Screen?v='.  getD3D("page_act") . '&g=' . getD3D("group_act") .'&oc=' . $string;         
            $this->load->view("system/base/Iframe", $data1, FALSE);
         }     
         $this->load->view("system/base/Footer");
      }
   }
?>
