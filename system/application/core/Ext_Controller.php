<?php

@session_start();
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Ext_Controller extends CI_Controller {
	var $response = array (
			'status' => 0,
			'message' => '' 
	);
	var $_role = array (
			'role_developer' => array (
					'action' => array () 
			),
			'role_hotline' => array (
					'action' => array () 
			),
			'role_planer' => array (
					'action' => array () 
			),
			'role_entwickler' => array (
					'action' => array () 
			),
			'role_technical' => array (
					'action' => array () 
			) 
	);
	function __construct() {
		parent::__construct ();
		
		if($this->session->userdata('logged') != 'yes') {
			redirect('/login', 'refresh');
		}
		
		// set header charset of ouput is UTF-8
		$this->output->set_header ( 'Content-Type: text/html; charset=UTF-8' );
	}

	function checkRole() {
		$user = $this->session->userdata ( 'user' );
		$this->load->library('roleComponent');
		
		$roleComponent = new RoleComponent();
		if(!$roleComponent->checkRole($user->roleName, $this->_role)) {
			if ($this->input->is_ajax_request ()) {
				$this->sendAjax ( 1, 'You can not access this page' );
			}
			exit ( 'You can not access this page' );
		}
	}
	
	/**
	 * Response Ajax
	 * @param number $status
	 * @param string $message
	 */
	function sendAjax($status = 0, $message = '') {
		if ($status) {
			$this->response ['status'] = $status;
			$this->response ['message'] = $message;
		}
		$response = json_encode ( $this->response );
		echo $response;
		exit ();
	}
}