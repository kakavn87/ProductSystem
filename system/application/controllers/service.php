<?php
class Service extends Ext_Controller {
	function __construct() {
		parent::__construct();
		
		$this->_role = array(
				'role_developer' => array('action' => array('show')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array())
		);
		
		$this->checkRole();
	}
	
	function show() {
		
		$content = $this->load->view('public/service/show', null, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
}