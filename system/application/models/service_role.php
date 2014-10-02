<?php
class Service_role extends CI_Model {
	function saveData($data) {
		$this->db->insert_batch ( 'service_roles', $data );
	}
	function deleteData($serviceId) {
		$this->db->where_in ( 'service_id', $serviceId );
		$this->db->delete ( 'service_roles' );
	}
	function getRolesByService($serviceId) {
		$this->db->select ( '*' );
		$this->db->from ( 'service_roles AS ServiceRole' );
		$this->db->where ( 'service_id', $serviceId );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
}