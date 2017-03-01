<?php defined('BASEPATH') OR exit('No direct script access allowed');
   class Sys_Hub extends CI_Controller {
      public function __construct() {
         parent::__construct();
         $this->load->model("Tpo_model", "fechaact");
         $this->fechaact->initialize("sec_users");
         $this->load->model("Tpo_model", "settings");
         $this->settings->initialize("sys_settings");
   
         //Debug
         //$this->output->enable_profiler(TRUE);
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
         initSessionD3D();
         resetDebugD3D();
         if (isset($_GET['v'])) {
            setD3D("page_act", $_GET['v']);
         } else {
            setD3D("page_act", '');
         }
         
         if (isset($_GET['g'])) {
            $group_act = $_GET['g'];
         } else {
            $group_act = '';
         }

         if (strlen(trim($group_act))==0) {
	    setD3D("group_act",  "");
	 } else {
            setD3D("group_act",  $group_act . "/");
         }	 

         setD3D("page_title", $this->lang->line( 'title_' . getD3D("page_act") ));  
	 $this->load->view('system/base/Top');
	 $this->load->view('system/base/Menu', $data, FALSE);
         if (getD3D("page_act")=='') {
	    setD3D("group_act", "pages/");
	    setD3D("page_act",  "Inicio");
	 }
         $data['page'] = getD3D("page_act");
	 $this->load->view('system/base/bread', $data, FALSE);
         $data1['ScreenTarget'] = 'Sys_Screen?v='.  getD3D("page_act") . '&g=' . getD3D("group_act");
         
         $this->load->view("system/base/Iframe", $data1, FALSE);
         $this->load->view("system/base/Footer");
      }
   }
?>

