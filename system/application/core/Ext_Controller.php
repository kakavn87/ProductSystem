<?php
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
		
		// set header charset of ouput is UTF-8
		$this->output->set_header ( 'Content-Type: text/html; charset=UTF-8' );
	}
	
	/** 
	 * check role of user
	 */
	protected function checkRole() {
		$this->load->model ( 'role' );
		$roles = array ();
		$userRole = $this->session->userdata ( 'role' );
		switch ($userRole) {
			case Role::ROLE_DEVELOPER :
				if (isset ( $this->_role ['role_developer'] )) {
					$roles = $this->_role ['role_developer'];
				}
				break;
			case Role::ROLE_TECHNICAL :
				if (isset ( $this->_role ['role_developer'] )) {
					$roles = $this->_role ['role_technical'];
				}
				break;
			case Role::ROLE_HOTLINE :
				if (isset ( $this->_role ['role_developer'] )) {
					$roles = $this->_role ['role_hotline'];
				}
				break;
			case Role::ROLE_PLANER :
				if (isset ( $this->_role ['role_developer'] )) {
					$roles = $this->_role ['role_planer'];
				}
				break;
			case Role::ROLE_ENTWICKLER :
				if (isset ( $this->_role ['role_developer'] )) {
					$roles = $this->_role ['role_entwickler'];
				}
				break;
			case Role::ROLE_ADMINISTRATOR :
			default :
				$roles ['action'] = array ();
				foreach ( $this->_role as $r ) {
					$roles ['action'] = array_merge ( $roles ['action'], $r ['action'] );
				}
				break;
		}
		// get action
		$action = $this->uri->segment ( 1 );
		
		if (! in_array ( $action, $roles ['action'] )) {
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