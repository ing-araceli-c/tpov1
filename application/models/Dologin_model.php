<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   class Dologin_model extends CI_Model {
      private $_table = "";
      public function __construct() {
         parent::__construct();
      }
      public function initialize($table = "") {
         $this->_table = $table;
      }
      public function doCount( $condiciones ) {
         $tokens = explode(",", $condiciones); 
         $sqltext = "select count(*) as total from " . $tokens[0] . ' where '.$tokens[1];  
         $resultado = $this->db->query( $sqltext )->result();
         $total = $resultado[0]->total;
         return $total;
      }

      public function update($data = array()) {
         $this->db->set($data);
         $this->db->set("updated_at", "NOW()", FALSE);
         $this->db->where("id", 2);
         $this->db->update($this->_table);
      }
      public function find1($id1, $valor1, $order)
      {
	$sqltext = 'select * from '.$this->_table.' where ' . $id1 . '=' . $valor1 . ' order by ' . $order;
	return $this->db->query( $sqltext )->result();
      }
      public function find($key, $id) {
         return $this->db->get_where($this->_table, array($key => $id))->row();
      }
      public function findWhere($datos) {
         return $this->db->get_where($this->_table, $datos)->row();
      }
      public function countAllResults($key, $logical, $id) {
         return $this->db->from($this->_table)->where($key . $logical, $id)->count_all_results();
      }
      public function countAllWhere($datos) {
         return $this->db->from($this->_table)->where($datos)->count_all_results();
      } 
      public function update1($data = array(), $var, $valor )
      {
		$this->db->set($data);
		$this->db->where( $var, $valor );
		$this->db->update($this->_table);
      }
      public function insert($data = array())
      {
		$this->db->set($data);
		$this->db->insert($this->_table);
                $data = $this->db->query( 'select last_insert_id() as ultimo;' )->result();
                foreach($data as $ultimos) {
                   $ultimo = $ultimos->ultimo; 
                }      
                return $ultimo;
     }	
   }
?>
