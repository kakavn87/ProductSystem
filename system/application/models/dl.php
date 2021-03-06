<?php
class Dl extends CI_Model {
	const TYPE_NORMAL = 'Normal';
	const TYPE_STANDARD = 'Standard';

	const STATUS_ACTIVE = 'ACTIVE';
	const STATUS_DONE = 'DONE';

	const CUSTOMER_ALLOW = 'Allow';
	const CUSTOMER_DENY = 'Deny';

	public function __construct() {
		parent::__construct ();
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

	public function getServicesByTechnical($type = self::TYPE_NORMAL, $orderId = null) {
		$this->db->select ( '*' );
		$this->db->from ( 'service' );
		$this->db->where('type', $type);
		if($orderId) {
			$this->db->where('order_id', $orderId);
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

	function getServiceInfo($id) {
		$this->db->select ( 's.*, r.description as rDescription, p.name as pName, GROUP_CONCAT(Role.name) as roleName' );
		$this->db->from ( 'service as s' );
		$this->db->join('requirement as r', 'r.id = s.requirement_id', "LEFT");
		$this->db->join('product as p', 'p.id = s.product_id', "LEFT");
		$this->db->join('service_roles as sr', 'sr.service_id = s.id', "LEFT");
		$this->db->join('role as Role', 'Role.id = sr.role_id', "LEFT");
		$this->db->where('s.id', $id);
		$this->db->group_by('s.id');
		$query = $this->db->get ();
		return $query->row ();
	}
}
