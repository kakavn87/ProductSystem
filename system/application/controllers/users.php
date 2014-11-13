<?php
class Users extends Ext_Controller {
	function __construct() {
		parent::__construct();
		
		$this->_role = array(
				'role_developer' => array('action' => array('profile')),
				'role_hotline' => array('action' => array('profile')),
				'role_planer' => array('action' => array('profile')),
				'role_entwickler' => array('action' => array('profile')),
				'role_technical' => array('action' => array('profile')),
				'role_customer' => array('action' => array('profile'))
		);
		
	
		$this->checkRole();
		$this->load->model('user');
	}
	
	function profile($id) {
		$data['user'] = $this->user->getById($id);
		$this->load->view('public/users/profile', $data);
	}
	
	function lists() {
		$data['users'] = $this->user->getAll();
		
		$content = $this->load->view('public/users/lists', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
	
	function add() {
		$this->load->model('role');
		$data['roles'] = $this->role->getAlls();
		
		$content = $this->load->view('public/users/edit', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
	
	function edit($id = null) {
		$this->load->model('role');
		$data['roles'] = $this->role->getAlls();
		$data['user'] = $this->user->getById($id);
		
		$content = $this->load->view('public/users/edit', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
	
	function save() {
		$data = $this->input->post('data');
		if(empty($data['id'])) {
			$this->user->addUser($data);
		} else {
			$this->user->updateUser('id', $data);
		}
		
		redirect('/users/lists');
	}
	
	function block($id = null) {
		$data = array(
			'id' => $id,
			'deleted' => 1
		);
		$this->user->updateUser('id', $data);
		
		redirect('/users/lists');
	}
	
	function unblock($id = null) {
		$data = array(
				'id' => $id,
				'deleted' => 0
		);
		$this->user->updateUser('id', $data);
	
		redirect('/users/lists');
	}
}