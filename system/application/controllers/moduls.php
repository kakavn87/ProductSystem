<?php
class Moduls extends Ext_Controller {
	function __construct() {
		parent::__construct();
		
		$this->_role = array(
				'role_developer' => array('action' => array('overview', 'edit', 'add')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array()),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array())
		);
		
		$this->checkRole();
	}
	
	function overview($id = null) {
		$id = (int) $id;
		
		$data = array();
		
		$this->_save();
		
		// load modul lists
		$this->load->model('modul');
		$this->load->model('modul_pattern');
		$modul['modules'] = $this->modul->getAll();
		$modul['modul_standards'] = $this->modul_pattern->getAll();
		$data['contentModule'] = $this->load->view('public/modul/list_modul', $modul , TRUE);
		
		$data['title'] = 'Add New Module';
		$data['documents'] = array();
		
		if($id) {
			// get modul by id
			$data['modul'] = $this->modul->getById($id);
			
			// get documents by modul Id
			$this->load->model('document');
			$data['documents'] = $this->document->getByModulId($id);
		}
		$content = $this->load->view('public/modul/edit', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
	
	function add() {
		$this->overview();
	}
		
	function edit($id = null) {
		$this->overview($id);
	}
	
	function _save() {
		if($this->input->post()) {
			$data = $this->input->post('data');
			$modulData = $data['Modul'];
			
			$this->load->model('modul');
			$this->load->model('document');
			
			$this->db->trans_start();
			if(isset($modulData['type'])) {
				$modulData['type'] = $modulData['type'] == 'on' ? Modul::TYPE_STANDARD : Modul::TYPE_NORMAL;
			} else {
				$modulData['type'] = Modul::TYPE_NORMAL;
			}
			
			if(empty($modulData['id'])) {
				$modulId = $this->modul->saveModul($modulData);
			} else {
				$this->modul->updateModul($modulData);
				$modulId = $modulData['id'];
			}
			
			$documents = array();
			if(isset($data['Document'])) {
				$idx = 0;
				for($i=0, $n=count($data['Document']['link']); $i < $n ; $i ++) {
					$documents[] = array(
							'link' => $data['Document']['link'][$i],
							'description' => $data['Document']['description'][$i],
							'type' => $data['Document']['type'][$i],
							'modul_id' => $modulId
					);
				}
			}
			
			$this->document->deleteByModulId($modulId);
			if(!empty($documents)) {
				$this->document->saveAll($documents);
			}
			
			$this->db->trans_complete();
		}
	}
}