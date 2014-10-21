<?php
class Report_document_detail extends CI_Model {
	function saveData($data) {
		$this->db->insert_batch ( 'report_document_details', $data );
	}

	function deleteData($serviceId) {
		$this->db->where_in ( 'service_id', $serviceId );
		$this->db->delete ( 'report_document_details' );
	}

	function getReportsByService($serviceId) {
		$this->db->select ( '*' );
		$this->db->from ( 'report_document_details' );
		$this->db->where ( 'service_id', $serviceId );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}

	function getReportsByServiceByTechnical($serviceId) {
		$this->db->select ( 'rdd.id as rddId, rdd.url as rddUrl, rd.name as rdName' );
		$this->db->from ( 'report_document_details as rdd' );
		$this->db->join ('report_documents as rd', 'rd.id = rdd.report_id');
		$this->db->where ( 'rdd.service_id', $serviceId );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
}