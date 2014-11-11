<?php
class Report_document extends CI_Model {

	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'report_documents';
	}

	function getAll() {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('deleted', 0);
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	
	function updateReport($data) {
		$this->db->where('id', $data['id']);
		$this->db->update($this->_tableName, $data);
	}
	
	function deleteReport($id) {
		$data = array(
				'id' => $id,
				'deleted' => 1
		);
		$this->updateReport($data);
	}

	function saveReport($data) {
		$this->db->insert ( $this->_tableName, $data );
		return $this->db->insert_id();
	}

	function getById($id) {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('id', $id);
		$this->db->where('deleted', 0);
		$query = $this->db->get ();
		return $query->row ();
	}
}