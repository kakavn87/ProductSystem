<?php
class Role extends CI_Model {
	
	public function __construct() {
		parent::__construct ();
	}
	
	function getAlls() {
		$this->db->select ( '*' );
		$this->db->from ( 'role' );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
}