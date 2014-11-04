<?php
class Moduls extends Ext_Controller {
	function __construct() {
		parent::__construct();

		$this->_role = array(
				'role_developer' => array('action' => array('overview', 'edit', 'add', 'saveAjax', 'saveOutSourcingAjax')),
				'role_hotline' => array('action' => array()),
				'role_planer' => array('action' => array('overview', 'edit', 'add', 'saveAjax')),
				'role_entwickler' => array('action' => array()),
				'role_technical' => array('action' => array()),
				'role_customer' => array('action' => array('overview', 'edit', 'add', 'saveAjax', 'saveOutSourcingAjax'))
		);

		$this->checkRole();
	}

	function overview($id = null, $type='normal') {
		$id = (int) $id;

		$this->load->library('roleComponent');

		$this->_save();

		$this->load->model('modul');
		$this->load->model('modul_pattern');

		$data = array();
		$data['title'] = 'Add New Module';
		$data['documents'] = array();

		$user = $this->session->userdata ( 'user' );
		$data['user'] = $user;

		if($id) {
			// get modul by id
			if($type == 'normal') {
				$data['modul'] = $this->modul->getById($id);
			} else {
				$data['modul'] = $this->modul_pattern->getById($id);
			}

			$data['type'] = $type;
			// get documents by modul Id
			$this->load->model('document');
			$data['documents'] = $this->document->getByModulId($id);
		}
		// load modul lists
		$modul['modules'] = $this->modul->getByUserId($user->id);
		$modul['modul_standards'] = $this->modul_pattern->getByUserId($user->id);
		$modul['show_normal'] = true;
		if($user->roleName == RoleComponent::ROLE_PLANER) {
			$modul['show_normal'] = false;
		}
		$data['contentModule'] = $this->load->view('public/modul/list_modul', $modul , TRUE);

		$content = $this->load->view('public/modul/edit', $data, TRUE);

		$this->load->library('template');
		$this->template->load($content);
	}

	function add() {
		$this->overview();
	}

	function edit($id = null, $type = "normal") {
		$this->overview($id, $type);
	}

	function saveAjax() {
		if ($this->input->is_ajax_request ()) {
			$data = $this->input->post('data');
			$this->load->model('modul');
			$this->load->model('document');
			if(isset($data['normal'])) {
				$result = $this->_saveModulNormal($data);
				if(!$result['status']) {
					$modul = $this->modul->getById($result['return_id']);
				}
			} else {
				$result = $this->_saveModulStandard($data);
				if(!$result['status']) {
					$modul = $this->modul_pattern->getById($result['return_id']);
				}
			}
			if(!$result['status']) {
				$data = array('id' => $modul->id, 'modul' => $modul->name, 'type' => 'normal', 'color' => $modul->color);
				$this->response['modul'] = json_encode($data);
				$this->sendAjax();
			}
			$this->sendAjax(1, $result['message']);
		} else {
			exit ( 'You can not access this page' );
		}
	}

	function saveOutSourcingAjax() {
		if ($this->input->is_ajax_request ()) {
			$data = $this->input->post('data');

			if(!isset($data['modulRequirement'])) {
				$this->sendAjax(1, 'Please add requirement');
			}
			$this->load->model('modul');
			$this->load->model('document');
			$this->load->model('application');
			$this->load->model('modul_requirement');

			$result = $this->_saveModulNormal($data);
			if(!$result['status']) {
				$modul = $this->modul->getById($result['return_id']);

				$user = $this->session->userdata ( 'user' );
				$appId = $this->application->saveApplication(array(
					'modul_id' => $modul->id,
					'service_id' => '-' . $user->id
				));

				$datas = array();
				foreach($data['modulRequirement']['name'] as $key => $value) {
					$tmp = array();
					$tmp['name'] = $value;
					$tmp['type'] = $data['modulRequirement']['type'][$key];
					$tmp['organization'] = $data['modulRequirement']['description'][$key];
					$tmp['operator'] = $data['modulRequirement']['operator'][$key];
					$tmp['value'] = $data['modulRequirement']['value'][$key];
					$tmp['app_id'] = $appId;
					$tmp['developer_id'] = $user->id;

					$datas[] = $tmp;
				}
				$this->modul_requirement->saveData($datas);

				$data = array('id' => $modul->id, 'modul' => $modul->name, 'type' => 'normal', 'color' => $modul->color, 'appid' => $appId);
				$this->response['modul'] = json_encode($data);
				$this->sendAjax();
			}
			$this->sendAjax(1, $result['message']);
		} else {
			exit ( 'You can not access this page' );
		}
	}

	function _save() {
		if($this->input->post()) {
			$data = $this->input->post('data');
			$this->load->model('modul');
			$this->load->model('document');
			if(isset($data['normal'])) {
				$this->_saveModulNormal($data);
			} else {
				$this->_saveModulStandard($data);
			}

			redirect('/moduls/add');
		}
	}

	function _saveModulStandard($data) {
		$this->load->model('modul_pattern');
		$this->load->model('stakeholder');

		$modulData = $data['Modul'];

		$user = $this->session->userdata ( 'user' );
		$user_id = $user->id;
		$role = $user->roleName;

		$modulData['holder_id'] = $this->stakeholder->saveStake($user_id, $role);

		if($modulData['holder_id'] != -1) {
			$this->db->trans_start();

			if(empty($modulData['id'])) {
				$modulData['color'] = $this->_getColor(@$modulData['type']);
				$modulId = $this->modul_pattern->saveModul($modulData);
			} else {

				if('normal' == $data['old_type']) {
					if(isset($modulData['id'])) {
						unset($modulData['id']);
					}
					$modulData['color'] = $this->_getColor(@$modulData['type']);
					$modulId = $this->modul_pattern->saveModul($modulData);
				} else {
					$this->modul_pattern->updateModul($modulData);
					$modulId = $modulData['id'];
				}
			}
			$this->db->trans_complete();
			return array('status' => 0, 'return_id' => $modulId);
		}
		return array('status' => 1, 'message' => 'You can not access this page');
	}

	function _saveModulNormal($data) {
		$this->load->model('modul');
		$this->load->model('stakeholder');

		$modulData = $data['Modul'];
		$user = $this->session->userdata ( 'user' );
		$user_id = $user->id;
		$role = $user->roleName;

		$modulData['holder_id'] = $this->stakeholder->saveStake($user_id, $role);

		$this->db->trans_start();
		if($modulData['holder_id'] != -1) {
			$this->db->trans_start();

			if(empty($modulData['id'])) {
				$modulData['color'] = $this->_getColor(@$modulData['type']);
				$modulId = $this->modul->saveModul($modulData);
			} else {
				if('standard' == $data['old_type']) {
					if(isset($modulData['id'])) {
						unset($modulData['id']);
					}
					$modulData['color'] = $this->_getColor(@$modulData['type']);
					$modulId = $this->modul->saveModul($modulData);
				} else {
					$this->modul->updateModul($modulData);
					$modulId = $modulData['id'];
				}
			}

			$documents = array();
			if(isset($data['Document'])) {

				$idx = 0;
				for($i=0, $n=count($data['Document']['description']); $i < $n ; $i ++) {
					if($data['Document']['type'][$i] == 'PDF') {
						if(isset($_FILES['file'])) {
							$target_dir = "uploads/pdf/";
							list($filename, $ext) = explode('.', $_FILES["file"]["name"][$i]);
							$target_dir = $target_dir . md5($filename) . '.' . $ext;

							move_uploaded_file($_FILES["file"]["tmp_name"][$i], $target_dir);
						}
					} else {
						$target_dir = $data['Document']['link'][$i];
					}
					$documents[] = array(
							'link' => $target_dir,
							'description' => $data['Document']['description'][$i],
							'type' => $data['Document']['type'][$i],
							'modul_id' => $modulId
					);
				}

				$this->document->deleteByModulId($modulId);
				if(!empty($documents)) {
					$this->document->saveAll($documents);
				}
			}

			$this->db->trans_complete();
			return array('status' => 0, 'return_id' => $modulId);
		}
		return array('status' => 1, 'message' => 'You can not access this page');
	}

	function _getColor($type) {
		switch($type) {
			case 'sub':
				$color = '#0d3839';
				break;
			case 'support':
				$color = '#0060b6';
				break;
			case 'child' :
				$color = '#fafafa';
				break;
			case 'main':
			default:
				$user = $this->session->userdata ( 'user' );
				$this->load->library('roleComponent');
				if($user->roleName == RoleComponent::ROLE_DEVELOPER) {
					$color = '#e3fc03';
				} else if($user->roleName == RoleComponent::ROLE_PLANER) {
					$color = '#d70318';
				} else {
					$color = '#ff00ff';
				}

				break;
		}
		return $color;
	}
}