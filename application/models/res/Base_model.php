<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   class Usuarios_model extends CI_Model {
      private $_table = "";
      public function __construct() {
         parent::__construct();
      }
      public function initialize($table = "") {
         $this->_table = $table;
      }
      public function get() {
         return $this->db->select("*")->from($this->_table)->get()->result();
      }
      public function insert($data = array()) {
         $this->db->set($data);
         $this->db->insert($this->_table);
      }
      public function update($data = array()) {
         $this->db->set($data);
         $this->db->set("updated_at", "NOW()", FALSE);
         $this->db->where("id", 2);
         $this->db->update($this->_table);      
      }
      public function delete() {
         $this->db->where("id", 1)->delete($this->_table);
      }
      public function find($id) {
         return $this->db->get_where($this->_table, array("id" => $id))->row();
      }
      public function innerJoin($id) {
         $query = $this->db->select("usuario,email,content")
                  ->from($this->_table)
                  ->join("posts", "usuarios.id = posts.userid", "LEFT")
                  ->where("usuarios.id", $id)
                  ->get();
         if($query->num_rows() > 0) {
            return $query->result();
         }
      }
      public function insertBatch() {
         $data = array(
            array(
                  "usuario"	=>	"Sergio",
                  "email"	=>	"sergio@uno-de-piera.com",
                  "password"	=>	12345678
            ),
            array(
                  "usuario"	=>	"Silvia",
                  "email"	=>	"silvia@uno-de-piera.com",
                  "password"	=>	1234567890
            ),
            array(
                  "usuario"	=>	"Julia",
                  "email"	=>	"julia@uno-de-piera.com",
                  "password"	=>	123456
            ),
         );
         $this->db->insert_batch($this->_table, $data);
      }
      public function updateBatch() {
         $data = array(
            array(
                  "usuario"	=>	"Sergio Pérez",
                  "email"	=>	"sergio@uno-de-piera.com",
                  "password"	=>	1234567834243243
            ),
            array(
                  "usuario"	=>	"Silvia Lózano",
                  "email"	=>	"silvia@uno-de-piera.com",
                  "password"	=>	1234567890543435
            ),
            array(
                  "usuario"	=>	"Julia Mitre",
                  "email"	=>	"julia@uno-de-piera.com",
                  "password"	=>	12345686565675
            ),
      );
      $this->db->update_batch($this->_table, $data, "email");
   }
   public function whereIn($ids = array()) {
      $query = $this->db->select("*")
                  ->from($this->_table)
                  ->where_in("id", $ids)
                  ->get();
      if($query->num_rows() > 0) {
         return $query->result_array();
      }
   }
   public function countAll() {
      return $this->db->count_all($this->_table);
   }
   public function countAllResults() {
      return $this->db->from($this->_table)->where("id >", 2)->count_all_results();
   }
}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */
