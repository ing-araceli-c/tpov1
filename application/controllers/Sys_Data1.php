<?php class Sys_Data1 extends CI_Controller {
     function __construct() {
         parent::__construct();
         $this->load->helper('url'); 
         $this->load->helper('file');  
      }
      public function index() {
         $data1 = exportData1ToCsv();
      }
   }
?>
