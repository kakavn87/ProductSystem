<?php
class Applications extends Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array('saveOutsourcing')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array('lists', 'apply')),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array()),
				'role_customer' => array('action' => array())
		);

		$this->checkRole();
		$this->load->model('application');
		$this->load->model('modul_apply');
		$this->load->model('profile');
	}

	function lists() {
		$data = array();
		$data['apps'] = $this->application->getAll();
		$content = $this->load->view('public/applications/lists', $data, TRUE);

		$this->load->library('template');
		$this->template->load($content);
	}

	/**
	 * developer click outsource, this function will call
	 */
	function saveOutsourcing() {
		if ($this->input->is_ajax_request ()) {
			$data = $this->input->post();
			$app_id = $this->application->saveApplication($data);
			$this->sendAjax();
		} else {
			exit ( 'You can not access this page' );
		}
	}

	function apply() {
		if ($this->input->is_ajax_request ()) {
			$user = $this->session->userdata ( 'user' );
			$data = $this->input->post();
			$app_id = (int)$data['app_id'];

			$appInfo = $this->application->getById($app_id);


			$this->modul_apply->apply($data);

			$this->sendAjax();
		} else {
			exit ( 'You can not access this page' );
		}
	}
}