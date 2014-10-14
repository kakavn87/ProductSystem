<?php
class Stakeholder extends CI_Model {
	var $_listRoles = array(
		'developer', 'partner', 'customer'
	);
	
	function getAll() {
		$this->db->select ( '*' );
		$this->db->from ( 'stakeholders' );
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}
	
	function saveModul($data) {
		$this->db->insert ( 'stakeholders', $data );
		return $this->db->insert_id();
	}
	
	function updateModul($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('stakeholders', $data);
	}
	
	function getStake($user_id, $role) {
		$this->db->select ( '*' );
		$this->db->from ( 'stakeholders' );
		$this->db->where('user_id', $user_id);
		$this->db->where('role', $role);
		$query = $this->db->get ();
		return $query->row ();
	}
	
	function saveStake($user_id, $role) {
		if(in_array($role, $this->_listRoles)) {
			$stake = $this->getStake($user_id, $role);
			if($stake) {
				return $stake->id;
			}else {
				$data = array();
				$data['user_id'] = $user_id;
				$data['role'] = $role;
				$this->db->insert ( 'stakeholders', $data );
				return $this->db->insert_id();
			}
		}
		return -1;
	}
}