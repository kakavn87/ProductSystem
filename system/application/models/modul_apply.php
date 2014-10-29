<?php
class Modul_apply extends CI_Model {
	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'modul_applies';
	}

	function apply($data) {
		$this->db->insert ( $this->_tableName, $data );
		return $this->db->insert_id();
	}
}