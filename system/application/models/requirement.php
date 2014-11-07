<?php
class Requirement extends CI_Model {
	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'requirement';
	}

	function getAlls() {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('deleted', 0);
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

	function saveRe($data) {
		$this->db->insert ( $this->_tableName, $data );
		return $this->db->insert_id();
	}

	function updateRe($data) {
		$this->db->where('id', $data['id']);
		$this->db->update($this->_tableName, $data);
	}

	function deleteRe($id) {
// 		return $this->db->delete($this->_tableName, array('id' => $id));
		$data = array(
			'id' => $id,
			'deleted' => 1
		);
		$this->updateRe($data);
	}
}
?>
