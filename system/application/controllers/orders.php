<?php
class Orders extends  Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array('check_valid')),
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
}