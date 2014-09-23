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
	
	function overview() {
		$data = array();
		
		$this->_save();
		
		// load modul lists
		$this->load->model('modul');
		$modul['modules'] = $this->modul->getAlls();
		$data['contentModule'] = $this->load->view('public/modul/list_modul', $modul , TRUE);
		
		$data['title'] = 'Add New Module';
		
		$content = $this->load->view('public/modul/edit', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
	
	function add() {
		$this->overview();
	}
		
	function edit($id = null) {
		$id = (int) $id;
		
		$this->_save();
		
		$data['title'] = 'Edit Module';
		
		// load modul lists
		$this->load->model('modul');
		$modul['modules'] = $this->modul->getAlls();
		$data['contentModule'] = $this->load->view('public/modul/list_modul', $modul , TRUE);
		
		// get modul by id
		$data['modul'] = $this->modul->getById($id);
		
		// get documents by modul Id
		$this->load->model('document');
		$data['documents'] = $this->document->getByModulId($id);
		$content = $this->load->view('public/modul/edit', $data, TRUE);
		
		$this->load->library('template');
		$this->template->load($content);
	}
	
	function _save() {
		if($this->input->post()) {
			$data = $this->input->post('data');
			
			$modulData = $data['Modul'];
			
			$this->load->model('modul');
			$this->load->model('document');
			
			$this->db->trans_start();
			if(empty($modulData['id'])) {
				$modulId = $this->modul->saveModul($modulData);
			} else {
				$modulId = $modulData['id'];
			}
			
			if(isset($data['Document'])) {
				$documents = array();
				$idx = 0;
				for($i=0, $n=count($data['Document']['link']); $i < $n ; $i ++) {
					$documents[] = array(
							'link' => $data['Document']['link'][$i],
							'description' => $data['Document']['description'][$i],
							'type' => $data['Document']['type'][$i],
							'modul_id' => $modulId
					);
				}
				
				$this->document->deleteByModulId($modulId);
				$this->document->saveAll($documents);
			}
			
			$this->db->trans_complete();
		}
	}
}