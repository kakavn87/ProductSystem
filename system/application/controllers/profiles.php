<?php
class Profiles extends Ext_Controller {
	const STANDARD_TYPE = 'standard';
	const NORMAL_TYPE = 'Normal';

	function __construct() {
		parent::__construct();

		$this->_role = array(
				'role_developer' => array('action' => array('view_profile')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array('index', 'edit', 'save', 'delete', 'get_profiles')),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array()),
				'role_customer' => array('action' => array())
		);

		$this->checkRole();
		$this->load->model('profile');
	}

	function index() {
		$user = $this->session->userdata ( 'user' );
		$data['profiles'] = $this->profile->getByUserId($user->id);

		$content = $this->load->view('public/profiles/lists', $data, TRUE);

		$this->load->library('template');
		$this->template->load($content);
	}

	function edit($id = null) {
		$data = array();
		if($id) {
			$data['profile'] = $this->profile->getById($id);
		}

		$content = $this->load->view('public/profiles/edit', $data, TRUE);

		$this->load->library('template');
		$this->template->load($content);
	}

	function delete($id = null) {
		if($id) {
			$this->profile->deleteProfile($id);
		}

		redirect('/profiles/index');
	}

	function save() {
		$data = $this->input->post('data');
		$user = $this->session->userdata ( 'user' );
		$data['user_id'] = $user->id;

		if($data['type'] != Profile::TYPE_MODUL) {
			$data['operator'] = $data['value'] = null;
		}
		if(empty($data['id'])) {
			$this->profile->saveProfile($data);
		} else {
			$this->profile->updateProfile($data);
		}

		redirect('/profiles/index');
	}

	function view_profile() {
		$post = $this->input->post();
		$data['profiles'] = $this->profile->getByUserId($post['user_id']);
		$this->load->view('public/profiles/view_profile', $data);
	}

	function get_profiles() {
		$keyword = trim(strip_tags($this->input->get('q')));
		$type = trim($this->input->get('type'));

		$this->load->model('modul_requirement');

		$lists = $this->modul_requirement->getByKeyword($keyword, $type);

		$data = array();
		foreach($lists as $item) {
			$data[] = array(
				'name' => $item->name
			);
		}

		echo json_encode($data);
		exit;
	}
}