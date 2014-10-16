<?php
class Comment extends CI_Model {
	
	
	function saveComment($data) {
		$this->db->insert ( 'comments', $data );
		return $this->db->insert_id();
	}
	
	public function getCommentByService($serviceId) {
		$this->db->select ( 'comments.*, user.name' );
		$this->db->from ( 'comments' );
		$this->db->join('user',  'user.id = comments.user_id');
		$this->db->where('comments.service_id', $serviceId);
		$this->db->order_by('comments.created DESC');
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
}