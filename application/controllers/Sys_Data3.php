<?php class Sys_Data3 extends CI_Controller {
     function __construct() {
         parent::__construct();
         $this->load->helper('url'); 
         $this->load->helper('file');  
      }
      public function index() {
         exportData2ToJson();
         $string = read_file(base_url().'graphs/data2.json');
         echo $string;
      }
   }
?>
