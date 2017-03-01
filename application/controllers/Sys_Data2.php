<?php class Sys_Data2 extends CI_Controller {
     function __construct() {
         echo 'ejercicio,resource_type,poverty_level,grade_level,total_donations,funding_status,date_posted,modificacion,ejercido';
         parent::__construct();
         $this->load->helper('url'); 
         $this->load->helper('file');  
      }
      public function index() {
         $string = read_file(base_url().'graphs/tablero/sampledata.csv');
         echo $string;
      }
   }
?>
