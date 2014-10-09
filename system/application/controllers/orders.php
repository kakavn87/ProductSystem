<?php
class Orders extends  Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array('check_valid', 'lists')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array())
		);

		$this->checkRole();
	}

	function check_valid() {
		$orderId = (int)$this->input->post('orderId');
		$this->load->model('order');

		$result = $this->order->getOrderId($orderId);
		if(!empty($result)) {
			$this->sendAjax();
		}
		$this->sendAjax(1, 'Invalid OrderId');
	}

	function lists() {
		$this->load->model('order');

		// get finished orders
		$data['order_finished'] = $this->order->getAlls(Order::STATUS_FINISHED);

		// get unfinished orders
		$data['order_unfinished'] = $this->order->getAlls(Order::STATUS_UNFINISHED);

		$content = $this->load->view('public/orders/lists', $data, TRUE);

		$this->load->library('template');
		$this->template->load($content);
	}
}