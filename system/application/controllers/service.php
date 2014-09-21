<?php
class Service extends Ext_Controller {
	function __construct() {
		parent::__construct();
		
		$this->_role = array(
				'role_developer' => array('action' => array('show', 'save')),
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
		
		// load Roles
		$this->load->model('role');
		$data['roles'] = $this->role->getAlls();
		
		// load Orders
		$this->load->model('order');
		$data['orders'] = $this->order->getAlls();
		
		// load requirement
		$this->load->model('requirement');
		$data['requirements'] = $this->requirement->getAlls();
		
		// load modul
		$this->load->model('modul');
		$data['modules'] = $this->modul->getAlls();
	
		// load service
		$this->load->model('dl');
		$service['services'] = $this->dl->getServices();
		$data['contentModule'] = $this->load->view('public/service/list_service', $service , TRUE);
		
		$content = $this->load->view('public/service/show', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
	
	function save() {
		//if ($this->input->is_ajax_request ()) {
			// TODO: save service 
			$service = $this->input->post();
			print_r($service);
// 			$this->load->model('service');
// 			$this->service->saveService($service);
			
// 			$this->sendAjax();
		//}
		//exit ( 'You can not access this page' );
	}
}