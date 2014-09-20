<?php
class Role extends CI_Model {
	
	public function __construct() {
		parent::__construct ();
		$this->properties = array (
				'id' => null,
				'name' => null,
				'deleted' => null,
				'status' => null
		);
	}
	
	function getAlls() {
		$this->db->select ( '*' );
		$this->db->from ( 'role' );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
}