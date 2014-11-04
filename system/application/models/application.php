<?php
class Application extends CI_Model {
	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'applications';
	}

	function getAll() {
		$this->db->select ( 'ma.id as mrId, app.*, modul.name as modulName, service.name as serviceName' );
		$this->db->from ( $this->_tableName  . ' as app');
		$this->db->join('modul', 'modul.id = app.modul_id');
		$this->db->join('service', 'service.id = app.service_id');
		$this->db->join('modul_applies as ma', 'app.id = ma.app_id', "LEFT");
		$this->db->where('app.status', 0);
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}

	function getByPartnerId($partner_id) {
		$this->db->select ( 'ma.id as mrId, app.*, modul.name as modulName, service.name as serviceName' );
		$this->db->from ( $this->_tableName  . ' as app');
		$this->db->join('modul', 'modul.id = app.modul_id');
		$this->db->join('service', 'service.id = app.service_id');
		$this->db->join('modul_applies as ma', "app.id = ma.app_id AND `ma`.`partner_id` = $partner_id", "LEFT");
		$this->db->where('app.status', 0);
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

	function getApp($modul_id, $service_id) {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('modul_id', $modul_id);
		$this->db->where('service_id', $service_id);
		$query = $this->db->get ();
		return $query->row ();
	}

	function getAppDetail($modul_id, $service_id) {
		$this->db->select ( 'mr.*' );
		$this->db->from ( $this->_tableName . ' as app');
		$this->db->where('modul_id', $modul_id);
		$this->db->where('service_id', $service_id);
		$this->db->join('modul_requirements as mr', 'mr.app_id = app.id');
		$query = $this->db->get ();
		return $query->result ();
	}

	function saveApplication($data) {
		$app = $this->getApp($data['modul_id'], $data['service_id']);
		if(empty($app)) {
			$this->db->insert ( $this->_tableName, $data );
			return $this->db->insert_id();
		}
		return $app->id;
	}

	function updateApplication($data) {
		$this->db->where('id', $data['id']);
		$this->db->update($this->_tableName, $data);
	}
}