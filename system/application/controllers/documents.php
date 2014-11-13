<?php
class Documents extends Ext_Controller {
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

	function update() {
		$data = $this->input->post('data');
		$documents = array();
		$t = 0;
		foreach($data['Document']['link'] as $key => $item) {
			$desc = '';
			if($data['Document']['type'][$key] == 'PDF') {
				$file = $data['Document']['tmp_link'][$t++];
				$list = explode ( '/', $file );
				list ( $name, $ext ) = explode ( '.', end ( $list ) );
				$desc = 'uploads/pdf/' . md5 ( $name ) . '.' . $ext;
				
				@copy ($file, $desc );
				
				@unlink('files/thumbnail/' . $name.'.'.$ext);
				@unlink('files/' . $name.'.'.$ext);
			}
			$documents[] = array(
					'link' => $data['Document']['type'][$key] == 'VIDEO'?$item:$desc,
					'description' => $data['Document']['description'][$key],
					'type' => $data['Document']['type'][$key],
					'modul_id' => $data['Modul']['id']
			);
		}
		if(!empty($documents)) {
			$this->document->saveAll($documents);
		}
		$this->response['documents'] = $documents;
		$this->sendAjax();
	}
}