<?php
class Document extends CI_Model {
	
	function getAlls() {
		$this->db->select ( '*' );
		$this->db->from ( 'document' );
		$this->db->where('deleted', 0);
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	
	function saveDocument($data) {
		$this->db->insert ( 'document', $data );
		return $this->db->insert_id();
	}
	
	function saveAll($data) {
		$this->db->insert_batch ( 'document', $data );
	}
	
	function deleteByModulId($modulId) {
		$this->db->where_in ( 'modul_id', $modulId );
		$this->db->delete ( 'document' );
	}
	
	function getByModulId($modulId, $serviceId = -1) {
		$this->db->select ( '*' );
		$this->db->from ( 'document' );
		$this->db->where('modul_id', $modulId);
		if($serviceId != -1) {
			$this->db->where('service_id', $serviceId);
		}
		$this->db->where('deleted', 0);
		$query = $this->db->get ();
		return $query->result ();
	}
	
	function getByServiceId($serviceId) {
		$this->db->select ( '*' );
		$this->db->from ( 'document' );
		$this->db->where('service_id', $serviceId);
		$this->db->where('deleted', 0);
		$query = $this->db->get ();
		return $query->result ();
	}
}