<?php
class Modul_requirement extends CI_Model {
	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'modul_requirements';
	}

	function saveData($data) {
		$this->db->insert_batch ( $this->_tableName, $data );
	}
	function deleteData($app_id) {
		$this->db->where ( 'app_id', $app_id );
		$this->db->delete ( $this->_tableName );
	}

	function getByAppId($app_id) {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('app_id', $app_id);
		$query = $this->db->get ();
		return $query->result ();
	}
	
	function getModulAndServiceByUserId($developer_id) {
		$this->db->select ( 'mr.*, app.status as appStatus, modul.name as modulName, service.name as serviceName' );
		$this->db->from ( $this->_tableName . ' as mr');
		$this->db->join('applications as app', 'app.id = mr.app_id');
		$this->db->join('modul', 'modul.id = app.modul_id');
		$this->db->join('service', 'service.id = app.service_id');
		$this->db->where('mr.developer_id', $developer_id);
		$this->db->group_by('mr.app_id');
		$query = $this->db->get ();
		return $query->result ();
	}
}