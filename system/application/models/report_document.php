<?php
class Report_document extends CI_Model {
	
	function getAll() {
		$this->db->select ( '*' );
		$this->db->from ( 'report_documents' );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	
	function saveModul($data) {
		$this->db->insert ( 'modul_patterns', $data );
		return $this->db->insert_id();
	}
	
	function updateModul($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('modul_patterns', $data);
	}
	
	function getById($id) {
		$this->db->select ( '*' );
		$this->db->from ( 'modul_patterns' );
		$this->db->where('id', $id);
		$query = $this->db->get ();
		return $query->row ();
	}
	
	function getByUserId($user_id) {
		$this->db->select ( 'm.*' );
		$this->db->from ( 'modul_patterns as m' );
		$this->db->join('stakeholders as s', 's.id = m.holder_id');
		$this->db->where('s.user_id', $user_id);
		$query = $this->db->get ();
		return $query->result ();
	}
}