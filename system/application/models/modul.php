<?php
class Modul extends CI_Model {
	
	
	function getAlls() {
		$this->db->select ( '*' );
		$this->db->from ( 'modul' );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
}