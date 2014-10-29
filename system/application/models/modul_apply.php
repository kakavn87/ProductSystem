<?php
class Modul_apply extends CI_Model {
	const STATUS_SELECTED = 'selected';
	
	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'modul_applies';
	}

	function apply($data) {
		$this->db->insert ( $this->_tableName, $data );
		return $this->db->insert_id();
	}
	
	function getPartnerByAppId($app_id) {
		$this->db->select ( 'ma.*, u.name as uName' );
		$this->db->from ( $this->_tableName . ' as ma' );
		$this->db->join('user as u', 'u.id = ma.partner_id');
		$this->db->where('app_id', $app_id);
		$query = $this->db->get ();
		return $query->result ();
	}
	
	function updateData($data) {
		$this->db->where('id', $data['id']);
		$this->db->update($this->_tableName, $data);
	}
}