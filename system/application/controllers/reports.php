<?php
class Reports extends  Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array('save_report')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array()),
				'role_customer' => array('action' => array('save_report'))
		);

		$this->checkRole();
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
}