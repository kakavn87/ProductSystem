<?php
class Comment extends CI_Model {
	
	
	function saveComment($data) {
		$this->db->insert ( 'comments', $data );
		return $this->db->insert_id();
	}
	
	public function getCommentByService($serviceId) {
		$this->db->select ( '*' );
		$this->db->from ( 'comments' );
		$this->db->where('service_id', $serviceId);
		$this->db->order_by('created DESC');
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
}