<?php
class Service extends Ext_Controller {
	function __construct() {
		parent::__construct();
		
		$this->_role = array(
				'role_developer' => array('action' => array('show', 'save', 'load_service', 'show_modul_detail')),
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
	
		// load service non-standard
		$this->load->model('dl');
		$service['services'] = $this->dl->getServices();
		$data['contentModule'] = $this->load->view('public/service/list_service', $service , TRUE);
		
		$data['service_standards'] = $this->dl->getServices(Dl::TYPE_STANDARD); 
		
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
			

			$this->load->model('comment');
			$data['comments'] = $this->comment->getCommentByService($id);
		}
		
		$content = $this->load->view('public/service/show', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
	
	function show_modul_detail() {
		if ($this->input->is_ajax_request ()) {
			$modul_id = (int)$this->input->post('modul_id');
			
			$this->load->model('modul');
			$this->load->model('document');
			
			$data['modul'] = $this->modul->getById($modul_id);
			$data['documents'] = $this->document->getByModulId($modul_id);
			
			$this->load->view('public/service/show_modul_detail', $data);
		} else {
			exit ( 'You can not access this page' );
		}
	}
	
	function save() {
		if ($this->input->is_ajax_request ()) {
			$this->load->model('dl');
			
			// TODO: save service 
			$service = $this->input->post();
			
			$roleList = $service['role_id'];
			unset($service['role_id']);
			
			$modules = $service['modul'];
			unset($service['modul']);
			$service['type'] = $service['type'] == 'true' ? Dl::TYPE_STANDARD : Dl::TYPE_NORMAL;
			$service['customer_view'] = $service['customer_view'] == 'true' ? Dl::CUSTOMER_ALLOW : Dl::CUSTOMER_DENY;
			
			if(empty($service['id'])) {
	 			$serviceId = $this->dl->saveService($service);
			} else {
				$serviceId = (int)$service['id'];
				unset($service['id']);
				$this->dl->updateService($service, $serviceId);
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