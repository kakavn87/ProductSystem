<?php
class User extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->_tableName = 'user';
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
		$query = $this->db->get ( $this->_tableName );
		$result = $query->result ();
		$result = $result [0];
		return $result;
	}

	function getAll() {
		$user = $this->session->userdata ( 'user' );
		
		$this->db->select ( 'user.*, role.name as roleName' );
		$this->db->join('role', 'role.id = user.role_id');
		$this->db->where ( 'user.id <>', $user->id );
		$query = $this->db->get ( $this->_tableName );
		$result = $query->result ();
		return $result;
	}
	
	function addUser($user) {
		$user['password'] = sha1($user['password']);
		$this->db->insert ( $this->_tableName, $user );
		return $this->db->insert_id();
	}
	
	function updateUser($key, $data) {
		$this->db->where($key, $data[$key]);
		$this->db->update($this->_tableName, $data);
	}
	
	function getById($id) {
		$this->db->select ( '*' ); // TODO Passwortabfrage
		$this->db->where ( 'id', $id );
		$query = $this->db->get ( 'user' );
		$result = $query->row ();
		return $result;
	}
}
?>