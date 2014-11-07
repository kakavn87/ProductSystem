<?php
class Requirements extends Ext_Controller {
	function __construct() {
		parent::__construct();
		$this->_role = array(
				'role_developer' => array('action' => array('add', 'delete')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array()),
				'role_customer' => array('action' => array('add', 'delete'))
		);

		$this->checkRole();
		$this->load->model('requirement');
	}

	function add() {
		$data = $this->input->post();
		if(empty($data['description'])) {
			$this->sendAjax(1, 'Description can not empty');
		}

		$re_id = $this->requirement->saveRe($data);
		$this->response['requirement_id'] = $re_id;
		$this->sendAjax();
	}

	function delete($id) {
		$this->requirement->deleteRe($id);
		$this->sendAjax();
	}
}