<?php
class RoleComponent {
	const ROLE_ADMINISTRATOR = 'administrator';
	const ROLE_DEVELOPER = 'developer';
	const ROLE_TECHNICAL = 'technical';
	const ROLE_HOTLINE = 'hotline';
	const ROLE_PLANER = 'planer';
	const ROLE_ENTWICKLER = 'entwickler';
	
	/**
	 * check role of user
	 */
	public function checkRole($roleUser, $roleList) {
		$roles ['action'] = array ();
		switch ($roleUser) {
			case self::ROLE_DEVELOPER :
				if (isset ( $roleList ['role_developer'] )) {
					$roles = $roleList ['role_developer'];
				}
				break;
			case self::ROLE_TECHNICAL :
				if (isset ( $roleList ['role_developer'] )) {
					$roles = $roleList ['role_technical'];
				}
				break;
			case self::ROLE_HOTLINE :
				if (isset ( $roleList ['role_developer'] )) {
					$roles = $roleList ['role_hotline'];
				}
				break;
			case self::ROLE_PLANER :
				if (isset ( $roleList ['role_developer'] )) {
					$roles = $roleList ['role_planer'];
				}
				break;
			case self::ROLE_ENTWICKLER :
				if (isset ( $roleList ['role_developer'] )) {
					$roles = $roleList ['role_entwickler'];
				}
				break;
			case self::ROLE_ADMINISTRATOR :
			default :
				
				foreach ( $roleList as $r ) {
					$roles ['action'] = array_merge ( $roles ['action'], $r ['action'] );
				}
				break;
		}
		
		$CI =& get_instance();
		// get action
		$action = $CI->uri->segment (2);
	
		if (! in_array ( $action, $roles ['action'] )) {
			return false;
		}
		return true;
	}
	
	public function redirect($roleUser) {
		switch ($roleUser) {
			case self::ROLE_DEVELOPER :
				redirect('/service/show/', 'refresh');
				break;
			case self::ROLE_TECHNICAL :
				redirect('/service/show/', 'refresh');
				break;
			case self::ROLE_HOTLINE :
				redirect('/service/show/', 'refresh');
				break;
			case self::ROLE_PLANER :
				redirect('/service/show/', 'refresh');
				break;
			case self::ROLE_ENTWICKLER :
				redirect('/service/show/', 'refresh');
				break;
			case self::ROLE_ADMINISTRATOR :
			default :
				redirect('/service/show/', 'refresh');
				break;
		}
	
	}
}