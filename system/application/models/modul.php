<?php
class Modul extends CI_Model {
	function getAll() {
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
	
	function getByUserId($user_id) {
		$this->db->select ( 'm.*' );
		$this->db->from ( 'modul as m' );
		$this->db->join('stakeholders as s', 's.id = m.holder_id');
		$this->db->where('s.user_id', $user_id);
		$query = $this->db->get ();
		return $query->result ();
	}
	
	function updateBackground($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('modul', $data);
		
	}
	
	
}