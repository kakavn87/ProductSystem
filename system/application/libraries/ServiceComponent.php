<?php
class ServiceComponent {
	
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
			
			$user = $CI->session->userdata ( 'user' );
		
			$data[] = array(
					'service_id' => $serviceId,
					'modul_id' => $modul_id,
					'position' => ++$idx, 
					'role' => $role,
					'user_id' => $user->id
			);
		}
		
		return $data;
	}
}