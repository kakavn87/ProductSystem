<?php
class Applications extends Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array()),
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
		$this->load->model('modul_requirement');
	}

	function lists() {
		$data = array();
		$data['apps'] = $this->application->getAll();
		$content = $this->load->view('public/applications/lists', $data, TRUE);

		$this->load->library('template');
		$this->template->load($content);
	}

	function apply() {
		if ($this->input->is_ajax_request ()) {
			$user = $this->session->userdata ( 'user' );
			$data = $this->input->post();
			$app_id = (int)$data['app_id'];

			$appInfo = $this->application->getById($app_id);
			$listModulRequiment = $this->modul_requirement->getByModulAndService($appInfo->modul_id, $appInfo->service_id);
			$profiles = $this->profile->getByUserId($user->id);

			$flag = false;
			foreach($listModulRequiment as $item) {
				foreach($profiles as &$profile) {
					if(strtolower($item->name) === strtolower($profile->name)) {
						$flag = true;
						$profile->flag = true;
					}
				}
			}
			if(!$flag) {
				$this->sendAjax(1, 'You can not apply this modul');
			}

			$values = array(
				'app_id' => $app_id,
				'partner_id' => $user->id
			);
			$this->modul_apply->apply($values);
			$this->sendAjax();
		} else {
			exit ( 'You can not access this page' );
		}
	}
}