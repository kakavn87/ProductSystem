<?php
class Service extends Ext_Controller {
	const STANDARD_TYPE = 'standard';
	const NORMAL_TYPE = 'Normal';

	function __construct() {
		parent::__construct();

		$this->_role = array(
				'role_developer' => array('action' => array('show', 'save', 'load_service', 'show_modul_detail', 'get_standard')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array()),
				'role_customer' => array('action' => array())
		);

		$this->checkRole();
	}

	function show($type = null, $id = null, $orderId = null) {
		$data['orderId'] = $orderId;
		$data['type'] = $type;

		$this->load->model('product');
		$product = new Product();
		$data['products'] = $product->getProducts();

		// load Roles
		$this->load->model('role');
		$data['roles'] = $this->role->getAlls();

		// load requirement
		$this->load->model('requirement');
		$data['requirements'] = $this->requirement->getAlls();

		// load modul
		$this->load->model('modul');
		$data['modules'] = $this->modul->getAll();

		// load standard modul
		$this->load->model('modul_pattern');
		$data['modul_standards'] = $this->modul_pattern->getAll();

		// load service non-standard
		$this->load->model('dl');
		$service['services'] = $this->dl->getServices(Dl::TYPE_NORMAL, $orderId);
		$service['orderId'] = $orderId;
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
				$listModules[] = array('id' => $service->modulId, 'modul' => $service->modulName, 'type' => 'normal', 'color' => $service->color);
			}
			$data['listModules'] = $listModules;


			$this->load->model('comment');
			$data['comments'] = $this->comment->getCommentByService($id);

			$this->load->model('service_role');
			$data['service_role'] = $this->service_role->getRolesByService($id);
		}

		$content = $this->load->view('public/service/show', $data, TRUE);

		$this->load->library('template');
		$this->template->load($content);
	}

	function show_modul_detail() {
		if ($this->input->is_ajax_request ()) {
			$modul_id = (int)$this->input->post('modul_id');
			$modul_type = $this->input->post('modul_type');

			$this->load->model('modul');
			$this->load->model('modul_pattern');
			$this->load->model('document');

			if($modul_type == 'normal') {
				$data['modul'] = $this->modul->getById($modul_id);
				$data['documents'] = $this->document->getByModulId($modul_id);
			} else {
				$data['modul'] = $this->modul_pattern->getById($modul_id);
				$data['documents'] = array();
			}
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

				$serviceData = $this->dl->getById($serviceId);
				if($service['type'] == Dl::TYPE_NORMAL) {
					if($serviceData->type == Dl::TYPE_NORMAL) {
						$this->dl->updateService($service, $serviceId);
					} else {
						$serviceId = $this->dl->saveService($service);
					}
				} else {
					if($serviceData->type == Dl::TYPE_STANDARD) {
						$this->dl->updateService($service, $serviceId);
					} else {
						$serviceId = $this->dl->saveService($service);
					}
				}
			}

			$data = array();
			$idx = 0;
			foreach($roleList as $role) {
				$data[] = array(
						'service_id' => $serviceId,
						'role_id' => $role,
				);
			}

			$this->load->model('service_role');
			$this->service_role->deleteData($serviceId);
			$this->service_role->saveData($data);

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

	function get_standard($id = null) {
		if(!$id) {
			$this->sendAjax(1, 'NOt exists service id');
		}

		$this->load->model('service_modul');
		$data['service'] = $this->service_modul->getServiceDetail($id);

		if(empty($data['service'])) {
			exit('Service id is no exists');
		}
		$listModules = array();
		foreach($data['service'] as $service) {
			$listModules[] = array('id' => $service->modulId, 'modul' => $service->modulName, 'type' => 'normal', 'color' => $service->color);
		}
		$this->response['listModules'] = $listModules;
		$this->sendAjax();
	}
}