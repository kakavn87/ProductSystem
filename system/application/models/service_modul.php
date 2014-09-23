<?php
class Service_modul extends CI_Model {
	function saveData($data) {
		$this->db->insert_batch ( 'service_modul', $data );
	}
	function deleteData($serviceId) {
		$this->db->where_in ( 'service_id', $serviceId );
		$this->db->delete ( 'service_modul' );
	}
	function getServiceDetail($id) {
		$this->db->select ( 'Service.*, Modul.name as modulName, Modul.id as modulId' );
		$this->db->from ( 'service_modul AS ServiceModul' );
		$this->db->join ( 'service AS Service', 'Service.id = ServiceModul.service_id', "LEFT" );
		$this->db->join ( 'modul AS Modul', 'Modul.id = ServiceModul.modul_id', "LEFT" );
		$this->db->where ( 'ServiceModul.service_id', $id );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
}