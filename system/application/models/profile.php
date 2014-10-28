<?php
class Profile extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	function getAll() {
		$this->db->select ( '*' );
		$this->db->from ( 'profiles' );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	
	function getById($id) {
		$this->db->select ( '*' );
		$this->db->from ( 'profiles' );
		$this->db->where('id', $id);
		$query = $this->db->get ();
		return $query->row ();
	}
	
	function saveProfile($data) {
		$this->db->insert ( 'profiles', $data );
		return $this->db->insert_id();
	}
	
	function updateProfile($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('profiles', $data);
	}
}