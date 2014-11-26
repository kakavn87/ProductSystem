<?php
class Role_requirement extends CI_Model {
	const TYPE_MODUL = 'modul';
	const TYPE_ORGANIZATION = 'organization';
	const TYPE_PROVIDER = 'provider';

	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'role_requirement';
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

	function getRequirement($role_id, $service_id) {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		// $this->db->join ( 'role', 'role_requirement.role_id = role.id');
		// $this->db->join ( 'service', 'role_requirement.service_id = service.id' );
		$this->db->where ( 'role_requirement.service_id', $service_id );
		$this->db->where ( 'role_requirement.role_id', $role_id );
		$this->db->order_by('role_requirement.id ASC');
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

	function save($data) {
		$this->db->insert ( $this->_tableName, $data );
		return $this->db->insert_id();
	}

	function update($data) {

		$this->db->where('id', $data['id']);
		$this->db->update($this->_tableName, $data);
	}

	function deleteRequirement($id) {
		return $this->db->delete($this->_tableName, array('id' => $id));
	}
}