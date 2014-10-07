<?php
class Modul extends CI_Model {
	
	const TYPE_NORMAL = 'Normal';
	const TYPE_STANDARD = 'Standard';
	
	function getAlls() {
		$this->db->select ( '*' );
		$this->db->from ( 'modul' );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	
	function getStandard() {
		$this->db->select ( '*' );
		$this->db->from ( 'modul' );
		$this->db->where('type', self::TYPE_STANDARD);
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	
	function getNormal() {
		$this->db->select ( '*' );
		$this->db->from ( 'modul' );
		$this->db->where('type', self::TYPE_NORMAL);
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