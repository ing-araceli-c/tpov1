<?php class Sys_Detalle7 extends CI_Controller {
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
		setD3D("page_act",  "Erogaciones");
	 }
	 $this->load->view('system/base/Top');
	 $this->load->view('system/base/Menu', $data, FALSE);

         if (isset($_GET['factura'])) {
            if (ctype_digit($_GET['factura'])) {
               $string = $_GET['factura'];
            } else {
               $string = 1;
            } 

            $this->Tpo_model->initialize("tab_facturas");
            $facturas = $this->Tpo_model->find1("id_factura", $string, 1);
            setD3D("numero_factura",  $facturas[0]->numero_factura);

            setD3D("page_act",  "erogacionesDetalle");
            $data['page'] = getD3D("page_act");
            $data['factura'] = $string;
            $this->load->view('system/base/bread', $data, FALSE);            
            $data1['ScreenTarget'] = 'Sys_Screen?v='.  getD3D("page_act") . '&g=' . getD3D("group_act") .'&factura=' . $string;
            $this->load->view("system/base/Iframe", $data1, FALSE);
         }     
         $this->load->view("system/base/Footer");
      }
   }
?>
