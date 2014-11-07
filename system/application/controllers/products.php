<?php
class Products extends Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array('add', 'delete')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array()),
				'role_customer' => array('action' => array('add', 'delete'))
		);

		$this->checkRole();
		$this->load->model('product');
	}

	function add() {
		$data = $this->input->post();
		if(empty($data['name'])) {
			$this->sendAjax(1, 'Name can not empty');
		}

		if(empty($data['id'])) {
			$re_id = $this->product->saveProduct($data);
			$this->response['type'] = 'add';
		} else {
			$re_id = $data['id'];
			$this->product->updateProduct($data);
			$this->response['type'] = 'update';
		}

		$this->response['product_id'] = $re_id;
		$this->sendAjax();
	}

	function delete($id) {
		$this->product->deleteProduct($id);
		$this->sendAjax();
	}
}