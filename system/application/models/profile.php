<?php
class Profile extends CI_Model {
	const TYPE_MODUL = 'modul';
	const TYPE_ORGANIZATION = 'organization';
	const TYPE_PROVIDER = 'provider';

	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'profiles';
	}

	function getAll() {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}

	function getByUserId($user_id) {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('user_id', $user_id);
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}

	function getById($id) {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('id', $id);
		$query = $this->db->get ();
		return $query->row ();
	}

	function saveProfile($data) {
		$this->db->insert ( $this->_tableName, $data );
		return $this->db->insert_id();
	}

	function updateProfile($data) {
		$this->db->where('id', $data['id']);
		$this->db->update($this->_tableName, $data);
	}

	function deleteProfile($id) {
		return $this->db->delete($this->_tableName, array('id' => $id));
	}
}