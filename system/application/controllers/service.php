<?php
class Service extends Ext_Controller {
	function __construct() {
		parent::__construct();
		
		$this->_role = array(
				'role_developer' => array('action' => array('show', 'save', 'load_service')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array())
		);
		
		$this->checkRole();
	}
	
	function show($id = null) {
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
		
		if($id) {
			$this->load->model('service_modul');
			$data['service'] = $this->service_modul->getServiceDetail($id);
			
			if(empty($data['service'])) {
				exit('Service id is no exists');
			}
			$listModules = array();
			foreach($data['service'] as $service) {
				$listModules[] = array('id' => $service->modulId, 'modul' => $service->modulName);
			}
			$data['listModules'] = $listModules;
		}
		
		
		$content = $this->load->view('public/service/show', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
	
	function save() {
		if ($this->input->is_ajax_request ()) {
			// TODO: save service 
			$service = $this->input->post();
			
			$modules = $service['modul'];
			unset($service['modul']);
			
			if(empty($service['id'])) {
	 			$this->load->model('dl');
	 			$serviceId = $this->dl->saveService($service);
			} else {
				$serviceId = (int)$service['id'];
			}
 			
 			$data = array();
 			$idx = 0;
 			foreach($modules as $modul) {
 				$data[] = array(
 						'service_id' => $serviceId,
 						'modul_id' => $modul,
 						'position' => ++$idx
 				);
 			}
 			
 			$this->load->model('service_modul');
 			$this->service_modul->deleteData($serviceId);
 			$this->service_modul->saveData($data);
			
 			$this->response['serviceId'] = $serviceId;
 			$this->sendAjax();
		}
		exit ( 'You can not access this page' );
	}
}