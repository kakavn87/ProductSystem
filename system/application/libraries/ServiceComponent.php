<?php
class ServiceComponent {
	
	public function uploadDocument($serviceId, $documents) {
		$CI =& get_instance();
		
		$CI->load->model('document');
		unset($documents['description'][count($documents['description']) - 1]);
		$data = array();
		$t = 0;
		foreach($documents['description'] as $key => $doc) {
			$desc = '';
			if($documents['type'][$key] == 'PDF') {
				$file = $documents['files'][$t++]['url'];
				$list = explode ( '/', $file );
				list ( $name, $ext ) = explode ( '.', end ( $list ) );
				$desc = 'uploads/pdf/' . md5 ( $name ) . '.' . $ext;
			
				@copy ($file, $desc );
			
				@unlink('files/thumbnail/' . $name.'.'.$ext);
				@unlink('files/' . $name.'.'.$ext);
			} else {
				$desc = $documents['link'][$key];
			}
			
			$data[] = array(
					'link' => $desc,
					'description' => $doc,
					'type' => $documents['type'][$key],
					'service_id' => $serviceId
			);
		}
		
		if(!empty($data)) {
			$CI->document->saveAll($data);
		}
		
		return $data;
	}

	public function getDataToCreateServiceModul($serviceId, $modules, $role = 'developer'){
		$CI =& get_instance();
		$data = array();
		$idx = 0;
		foreach($modules as $modul) {
			$modul_id = $modul['id'];

			// save to normal if modul is standard
			if($modul['type'] == 'standard') {

				$CI->load->model('modul_pattern');
				$CI->load->model('modul');

				$modulStandard = (array)$CI->modul_pattern->getById($modul_id);
				unset($modulStandard['id']);
				$modul_id = $CI->modul->saveModul($modulStandard);
			}

			if(isset($modul['appid'])) {
				$CI->load->model('application');

				$CI->application->updateApplication(array(
					'id' => $modul['appid'],
					'service_id' => $serviceId
				));
			}

			$user = $CI->session->userdata ( 'user' );

			$data[] = array(
					'service_id' => $serviceId,
					'modul_id' => $modul_id,
					'position' => ++$idx,
					'role' => $role,
					'status' => $modul['status'],
					'user_id' => $user->id
			);
		}

		return $data;
	}
}