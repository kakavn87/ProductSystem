<?php
class User extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->properties = array (
				'id' => null,
				'name' => null,
				'organisation_id' => null,
				'role_id' => null,
				'mail' => null,
				'password' => null,
				'deleted' => null,
				'status' => null 
		);
	}
	function check($mail, $password) {
		$this->db->select ( 'role.name as roleName, user.*' ); // TODO Passwortabfrage
		$this->db->join('role', 'role.id = user.role_id', 'LEFT');
		$this->db->where ( 'mail', $mail );
		$this->db->where ( 'password', $password );
		$query = $this->db->get ( 'user' );
		$result = $query->row ();
		return $result;
	}
	
	function getRole($mail) {
		$this->db->select ( 'role,id,short_name' );
		$this->db->where ( 'mail', $mail );
		$query = $this->db->get ( 'user' );
		$result = $query->result ();
		$result = $result [0];
		return $result;
	}

	function getAll() {
		$this->db->select ( 'id,name' );
		$query = $this->db->get ( 'user' );
		$result = $query->result ();
		return $result;
	}
}
?>