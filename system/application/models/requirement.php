<?php
class Requirement extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->properties = array (
				'id' => null,
				'description' => null,
				'deleted' => 0,
				'status' => null 
		);
	}
	
	function getAlls() {
		$this->db->select ( '*' );
		$this->db->from ( 'requirement' );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
}
?>
