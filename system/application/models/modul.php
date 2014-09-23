<?php
class Modul extends CI_Model {
	
	function getAlls() {
		$this->db->select ( '*' );
		$this->db->from ( 'modul' );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	
	function saveModul($data) {
		$this->db->insert ( 'modul', $data );
		return $this->db->insert_id();
	}
	
	function updateModul($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('modul', $data);
	}
	
	function getById($id) {
		$this->db->select ( '*' );
		$this->db->from ( 'modul' );
		$this->db->where('id', $id);
		$query = $this->db->get ();
		return $query->row ();
	}
}