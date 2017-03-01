<?php class Sys_Data extends CI_Controller {
     function __construct() {
         parent::__construct();
         $this->load->helper('url'); 
         $this->load->helper('file');  
         setD3D("source",   $this->input->get('s')); // file, sql
         setD3D("id",   $this->input->get('id'));    // id or file
         setD3D("target",   $this->input->get('t')); // j=json, x=xml, s=csv, e=xls
echo 'ejercicio,resource_type,poverty_level,grade_level,total_donations,funding_status,date_posted,modificacion,ejercido';

//echo 'Source-> '. getD3D("source");
//echo '<br>ID-> '. getD3D("id");
//echo '<br>Target-> '. getD3D("target");
  
      }
      public function index() {
         $string = read_file(base_url().'graphs/tablero/sampledata.csv');
         echo $string;
      }
   }
?>
