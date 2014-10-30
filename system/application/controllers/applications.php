<?php
class Applications extends Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array('view_list', 'getPartnerApply', 'selected', 'viewPartnerApply')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array('lists', 'apply', 'view')),
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
		$user = $this->session->userdata ( 'user' );

		$data = array();
		$data['apps'] = $this->application->getByPartnerId($user->id);
		$content = $this->load->view('public/applications/lists', $data, TRUE);

		$this->load->library('template');
		$this->template->load($content);
	}

	function apply() {
		if ($this->input->is_ajax_request ()) {
			$user = $this->session->userdata ( 'user' );
			$data = $this->input->post();
			$app_id = (int)$data['app_id'];

			$listModulRequiment = $this->modul_requirement->getByAppId($app_id);
			$profiles = $this->profile->getByUserId($user->id);

			$flag = false;
			foreach($listModulRequiment as $item) {
				foreach($profiles as &$profile) {
					if(strtolower($item->name) === strtolower($profile->name)) {
						$flag = true;
						break;
					}
				}
			}
			$data = array();
			$data['profiles'] = $profiles;
			$data['listModulRequiment'] = $listModulRequiment;
			$this->response['view'] = $this->load->view('public/applications/view', $data, TRUE);

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

	function view() {
		if ($this->input->is_ajax_request ()) {
			$user = $this->session->userdata ( 'user' );
			$data = $this->input->post();
			$app_id = (int)$data['app_id'];

			$listModulRequiment = $this->modul_requirement->getByAppId($app_id);
			$profiles = $this->profile->getByUserId($user->id);

			foreach($listModulRequiment as $item) {
				foreach($profiles as &$profile) {
					if(strtolower($item->name) === strtolower($profile->name)) {
						$profile->flag = true;
					}
				}
			}

			$data = array();
			$data['profiles'] = $profiles;
			$data['listModulRequiment'] = $listModulRequiment;
			$this->load->view('public/applications/view', $data);
		} else {
			exit ( 'You can not access this page' );
		}
	}

	function view_list() {
		$user = $this->session->userdata ( 'user' );
		$data['apps'] = $this->modul_requirement->getModulAndServiceByUserId($user->id);
		$content = $this->load->view('public/applications/view_list', $data, TRUE);

		$this->load->library('template');
		$this->template->load($content);
	}

	function getPartnerApply() {
		if ($this->input->is_ajax_request ()) {
			$user = $this->session->userdata ( 'user' );
			$data = $this->input->post();
			$app_id = (int)$data['app_id'];

			$array['partners'] = $this->modul_apply->getPartnerByAppId($app_id);
			$this->load->view('public/applications/partners', $array);
		} else {
			exit ( 'You can not access this page' );
		}
	}

	function viewPartnerApply() {
		if ($this->input->is_ajax_request ()) {
			$user = $this->session->userdata ( 'user' );
			$data = $this->input->post();
			$app_id = (int)$data['app_id'];

			$array['partners'] = $this->modul_apply->getPartnerByAppId($app_id);
			$this->load->view('public/applications/view_partners', $array);
		} else {
			exit ( 'You can not access this page' );
		}
	}

	function selected() {
		if ($this->input->is_ajax_request ()) {
			$user = $this->session->userdata ( 'user' );
			$data = $this->input->post();
			$app_id = (int)$data['app_id'];
			$id = (int)$data['id'];

			$value['id'] = $app_id;
			$value['developer_id'] = $user->id;
			$value['status'] = 1;
			$this->application->updateApplication($value);


			$this->modul_apply->updateData(array(
				'id' => $id,
				'status' => Modul_apply::STATUS_SELECTED
			));

			$this->sendAjax();
		} else {
			exit ( 'You can not access this page' );
		}
	}
}