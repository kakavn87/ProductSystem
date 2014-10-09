<?php
class Order extends CI_Model {
	const STATUS_FINISHED = 'Finished';
	const STATUS_UNFINISHED = 'Unfinished';

	public function __construct() {
		parent::__construct ();
		$this->properties = array (
				'id' => null,
				'number' => null,
				'deleted' => 0,
				'status' => null
		);
	}

	function getAlls($status = null) {
		$this->db->select ( '*' );
		$this->db->from ( 'order' );
		if($status) {
			$this->db->where('status', $status);
		}
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}

	function getOrderId($id) {
		$this->db->select ( '*' );
		$this->db->from ( 'order' );
		$this->db->where('number', $id);
		$query = $this->db->get ();
		return $query->row ();
	}
}
?>
