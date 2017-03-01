<?php class Sys_Export_CSV extends CI_Controller {
     function __construct() {
         parent::__construct();
         $this->load->helper('url'); 
      }
      public function index() {
          exportAllToCsv();
      }
   }
?>

