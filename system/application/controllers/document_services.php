<?php
class Document_services extends Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array('update', 'upload')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array()),
				'role_customer' => array('action' => array('update', 'upload'))
		);

		$this->checkRole();
		$this->load->model('document');
	}
	
	function upload() {
		$this->load->library ( 'uploadHandler' );
	}
}