<?php
class Service_modul extends CI_Model {
	const ROLE_DEVELOPER = 'developer';
	const ROLE_CUSTOMER = 'customer';
	
	function saveData($data) {
		$this->db->insert_batch ( 'service_modul', $data );
	}
	function deleteData($serviceId) {
		$this->db->where_in ( 'service_id', $serviceId );
		$this->db->delete ( 'service_modul' );
	}
	function getServiceDetail($id) {
		$this->db->select ( 'Service.*, Modul.name as modulName, Modul.id as modulId, Modul.color, ServiceModul.role as serviceModulRole, ServiceModul.id as smId, ServiceModul.status as smStatus' );
		$this->db->from ( 'service_modul AS ServiceModul' );
		$this->db->join ( 'service AS Service', 'Service.id = ServiceModul.service_id', "LEFT" );
		$this->db->join ( 'modul AS Modul', 'Modul.id = ServiceModul.modul_id', "LEFT" );
		$this->db->where ( 'ServiceModul.service_id', $id );
		$this->db->order_by('ServiceModul.position ASC');
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	
	function allowServiceModul($id) {
		$this->db->where('id', $id);
		$this->db->update('service_modul', array('status' => 'allow'));
	}
}