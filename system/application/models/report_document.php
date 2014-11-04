<?php
class Report_document extends CI_Model {

	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'report_documents';
	}

	function getAll() {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}

	function saveReport($data) {
		$this->db->insert ( $this->_tableName, $data );
		return $this->db->insert_id();
	}

	function getById($id) {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('id', $id);
		$query = $this->db->get ();
		return $query->row ();
	}
}