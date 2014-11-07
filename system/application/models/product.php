<?php
class Product extends CI_Model {
	public function __construct() {
		parent::__construct ();

		$this->_tableName = 'product';
	}

	function getProducts() {
		$this->db->select ( '*' );
		$this->db->from ( $this->_tableName );
		$this->db->where('deleted', 0);
		$query = $this->db->get ();
		$result = $query->result ();
		return $result;
	}

	function saveProduct($data) {
		$this->db->insert ( $this->_tableName, $data );
		return $this->db->insert_id();
	}

	function updateProduct($data) {
		$this->db->where('id', $data['id']);
		$this->db->update($this->_tableName, $data);
	}

	function deleteProduct($id) {
// 		return $this->db->delete($this->_tableName, array('id' => $id));
		$data = array(
				'id' => $id,
				'deleted' => 1
		);
		$this->updateProduct($data);
	}
}
?>
