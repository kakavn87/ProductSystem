<?php
class Modul_requirement extends CI_Model {
	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'modul_requirements';
	}

	function saveData($data) {
		$this->db->insert_batch ( $this->_tableName, $data );
	}
	function deleteData($serviceId, $modulId) {
		$this->db->where ( 'service_id', $serviceId );
		$this->db->where ( 'modul_id', $modulId );
		$this->db->delete ( $this->_tableName );
	}

	function getByModulAndService($modul_id, $service_id) {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('modul_id', $modul_id);
		$this->db->where('service_id', $service_id);
		$query = $this->db->get ();
		return $query->result ();
	}
}