<?php
class Document_service extends CI_Model {
	
	function saveAll($data) {
		$this->db->insert_batch ( 'document_services', $data );
	}
	
	function deleteByModulId($modulId) {
		$this->db->where_in ( 'modul_id', $modulId );
		$this->db->delete ( 'document_services' );
	}
	
	function getByServiceId($serviceId) {
		$this->db->select ( '*' );
		$this->db->from ( 'document_services' );
		$this->db->where('service_id', $serviceId);
		$this->db->where('deleted', 0);
		$query = $this->db->get ();
		return $query->result ();
	}
}