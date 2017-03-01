<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
   class Sec_menu_model extends CI_Model {
      private $_table = "";
      public function __construct() {
         parent::__construct();
      }
      public function doSections() {
         if ($_SESSION["user_id"]!=1) {
            $this->_table = 'vsec_menu';
            $this->db->distinct();   
            return $this->db->select("*")->from($this->_table)
                   ->where('father=0 and id_user = ' . $_SESSION["user_id"])
                   ->order_by("order_option", "asc")->get()->result();
         } else {
            $this->_table = 'vsec_options';
            $this->db->distinct();
            return $this->db->select("id_option, label,modul,icon,option")
                   ->from($this->_table)->where('father=0')->order_by("order_option", "asc")->get()->result();
         }
      }
      public function doMenus( $section ) {
         if ($_SESSION["user_id"]!=1) {
            $this->_table = 'vsec_menu';
            $this->db->distinct();
            return $this->db->select("*")->from($this->_table)
                   ->where('father = ' .$section. ' and id_user = ' . $_SESSION["user_id"])
                   ->order_by("order_option", "asc")->get()->result();
         } else {
            $this->_table = 'vsec_options';
            $this->db->distinct();
            return $this->db->select("id_option, label,modul,icon,option")
                   ->from($this->_table)->where('father = ' .$section )->order_by("order_option", "asc")->get()->result();
         }
      }
      public function doOptions( $menu ) {
         if ($_SESSION["user_id"]!=1) {
            $this->_table = 'vsec_menu';
            $this->db->distinct();
            return $this->db->select("*")->from($this->_table)
                   ->where('father = ' .$menu. ' and id_user = ' . $_SESSION["user_id"])
                   ->order_by("order_option", "asc")->get()->result();
         } else {
            $this->_table = 'vsec_options';
            $this->db->distinct();
            return $this->db->select("id_option, label,modul,icon,option, parameters")
                   ->from($this->_table)->where('father = ' .$menu)
                   ->order_by("order_option", "asc")->get()->result();
         }
      }
   }
?>
