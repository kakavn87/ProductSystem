<?php
class Service extends Ext_Controller {
	function __construct() {
		parent::__construct();
		
		$this->_role = array(
				'role_developer' => array('action' => array('show')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array())
		);
		
		$this->checkRole();
	}
	
	function show() {
		$this->load->model('product');
		$product = new Product();
		$data['products'] = $product->getProducts();
		
		$this->load->model('role');
		$data['roles'] = $this->role->getAlls();
		
		$this->load->model('order');
		$data['orders'] = $this->order->getAlls();
		
		$this->load->model('requirement');
		$data['requirements'] = $this->requirement->getAlls();
		
		$content = $this->load->view('public/service/show', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
}