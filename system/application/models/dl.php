<?php
class Dl extends CI_Model {
	const TYPE_NORMAL = 'Normal';
	const TYPE_STANDARD = 'Standard';

	const CUSTOMER_ALLOW = 'Allow';
	const CUSTOMER_DENY = 'Deny';

	public function __construct() {
		parent::__construct ();
		$this->properties = array (
				'id' => null,
				'name' => null,
				'product_id' => null,
				'requirement_id' => null,
				'order_id' => null,
				'role_id' => null,
				'description' => null,
				'status' => null,
				'create_date' => null,
				'modied_date' => null,
				'deleted' => null,
				'status' => null
		);
	}
	public function getServices($type = self::TYPE_NORMAL, $orderId = null, $isCustomer = false) {
		$this->db->select ( '*' );
		$this->db->from ( 'service' );
		$this->db->where('type', $type);
		if($orderId) {
			$this->db->where('order_id', $orderId);
		}
		if($isCustomer) {
			$this->db->where('customer_view', self::CUSTOMER_ALLOW);
		}
		$this->db->order_by('created DESC');
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}

	function getById($id) {
		$this->db->select ( '*' );
		$this->db->from ( 'service' );
		$this->db->where('id', $id);
		$query = $this->db->get ();
		return $query->row ();
	}

	function saveService($data) {
		$this->db->insert ( 'service', $data );
		return $this->db->insert_id();
	}

	function updateService($data, $id) {
		$this->db->update('service', $data, array('id' => $id));
	}
}
