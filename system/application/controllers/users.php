<?php
class Users extends Ext_Controller {
	function __construct() {
		parent::__construct();
	
		$this->checkRole();
		$this->load->model('user');
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