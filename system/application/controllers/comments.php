<?php
class Comments extends Ext_Controller {
	function __construct() {
		parent::__construct();
		
		$this->_role = array(
				'role_developer' => array('action' => array('save')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array('save')),
				'role_customer' => array('action' => array('save'))
		);
		
		$this->checkRole();
	}
	
	
	function save() {
		if ($this->input->is_ajax_request ()) {
			$user = $this->session->userdata ( 'user' );
			
			$this->load->model('comment');
			$data['comment'] = trim(strip_tags($this->input->post('comment')));
			if(!strlen($data['comment'])) {
				$this->sendAjax(1, 'Invalid comment');
			}
			$data['user_id'] = $user->id;
			$data['service_id'] = $this->input->post('service_id');
			
			if($this->comment->saveComment($data)) {
				$this->response['user_name'] = $user->name;
				$this->response['comment'] = $data['comment'];
				$this->sendAjax();
			} else {
				$this->sendAjax(1, 'Invalid comment');
			}
		}
		exit ( 'You can not access this page' );
	}
}