<?php  if ( ! defined('BASEPATH')) exit('...');

class Tpo_model extends CI_Model 
{
	private $_table = "";

	public function __construct()
	{
		parent::__construct();
	}

	public function initialize($table = "")
	{
		$this->_table = $table;
	}

	public function get()
	{
		return $this->db->select("*")->from($this->_table)->get()->result();
	}
        public function findWhere($datos) {
           return $this->db->get_where($this->_table, $datos)->row();
        }
	public function find1($id1, $valor1, $order)
	{
		$sqltext = 'select * from '.$this->_table.' where ' . $id1 . '=' . $valor1 . ' order by ' . $order;
		return $this->db->query( $sqltext )->result();
	}

	public function find2($id1, $valor1, $id2, $valor2, $order)
	{
		$sqltext = 'select * from '.$this->_table.' where ' . $id1 . '=' . $valor1 . ' and ' . $id2 . '=' . $valor2 . ' order by ' . $order;
		return $this->db->query( $sqltext )->result();
	}

	public function delDebug()
	{
		$sqltext = 'delete from '. $this->_table . ' where 1=1;';
		$this->db->query( $sqltext );
		return true;
	}

	public function delParam( $t )
	{
		$sqltext = 'delete from '. $this->_table . ' where id_token = "'. $t .'";';
		$this->db->query( $sqltext );
		return true;
	}

	public function insert($data = array())
	{
		$this->db->set($data);
		$this->db->insert($this->_table);
                return null;
	}	
        public function maxQuery($id, $where) {
            $data = $this->db->query( 'select max('.$id.') as total from ' . $this->_table . ' where ' . $where )->result();
            foreach($data as $cuantos) {
                   $total = $cuantos->total; 
            }      
            return $total;
        }

	public function countAllResults( $condicion, $valor )
	{
		return $this->db->from($this->_table)->where( $condicion, $valor )->count_all_results();
	}
	
	public function countAll( )
	{		
		return $this->db->from($this->_table)->count_all_results();
	}

	public function update($data = array(), $var, $valor )
	{
		$this->db->set($data);
		$this->db->where( $var, $valor );
		$this->db->update($this->_table);
	}
        public function countAllWhere($datos) {
            return $this->db->from($this->_table)->where($datos)->count_all_results();
        } 
        public function countAllQuery($where) {
            $data = $this->db->query( 'select count(*) as total from ' . $this->_table . ' where ' . $where )->result();
            foreach($data as $cuantos) {
                   $total = $cuantos->total; 
            }      
            return $total;
        }
	public function updateWhere($data = array(), $where = array() )
	{
		$this->db->set( $data );
		$this->db->where( $where );
		$this->db->update($this->_table);
	}
	public function update1($id1, $valor1, $where)
	{
		$sqltext = 'update ' . $this->_table . 
                           ' set ' . $id1 . ' = ' . $valor1 .
                           ' where ' .  $where;
		return $this->db->query( $sqltext );
	}
   
   public function get_url_docs() {
      $datas = $this->db->query( 'select url_docs from sys_settings where id_settings = 1' )->result();
      foreach($datas as $data) {
         $recaptcha = $data->url_docs; 
      }      
      return $recaptcha;
   }

}
