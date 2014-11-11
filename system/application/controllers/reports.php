<?php
class Reports extends  Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array('save_report', 'get_report', 'add', 'delete')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array()),
				'role_customer' => array('action' => array('save_report', 'get_report', 'add', 'delete'))
		);

		$this->checkRole();
		$this->load->model('report_document');
	}
	
	function add() {
		$data = $this->input->post();
		if(empty($data['name'])) {
			$this->sendAjax(1, 'Name can not empty');
		}
		
		if(empty($data['id'])) {
			$re_id = $this->report_document->saveReport($data);
			$this->response['type'] = 'add';
		} else {
			$re_id = $data['id'];
			$this->report_document->updateReport($data);
			$this->response['type'] = 'update';
		}
		
		$this->response['report_id'] = $re_id;
		$this->sendAjax();
	}
		
	function delete($id) {
		$this->report_document->deleteReport($id);
		$this->sendAjax();
	}

	function save_report() {
		$user = $this->session->userdata ( 'user' );
		$data = $this->input->post('data');
		$report = $data['Report'];
		$report['user_id'] = $user->id;

		$this->load->model('report_document');
		$newId = $this->report_document->saveReport($report);
		$this->response['report_id'] = $newId;
		$this->sendAjax();
	}

	function get_report() {
		$report_id = (int)$this->input->post('report_id');
		$this->load->model('report_document');

		$data['report'] = $this->report_document->getById($report_id);
		$this->load->view ( 'public/reports/detail', $data );
	}
}