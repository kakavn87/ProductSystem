<?php
class Profiles extends Ext_Controller {
	const STANDARD_TYPE = 'standard';
	const NORMAL_TYPE = 'Normal';

	function __construct() {
		parent::__construct();

		$this->_role = array(
				'role_developer' => array('action' => array('view_profile')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array('index', 'edit', 'save')),
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

	function save() {
		$data = $this->input->post('data');
		$user = $this->session->userdata ( 'user' );
		$data['user_id'] = $user->id;

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
}