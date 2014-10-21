<?php
class RoleComponent {
	const ROLE_ADMINISTRATOR = 'administrator';
	const ROLE_DEVELOPER = 'developer';
	const ROLE_TECHNICAL = 'technical';
	const ROLE_HOTLINE = 'hotline';
	const ROLE_PLANER = 'partner';
	const ROLE_ENTWICKLER = 'entwickler';
	const ROLE_CUSTOMER = 'customer';

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
				if (isset ( $roleList ['role_technical'] )) {
					$roles = $roleList ['role_technical'];
				}
				break;
			case self::ROLE_HOTLINE :
				if (isset ( $roleList ['role_hotline'] )) {
					$roles = $roleList ['role_hotline'];
				}
				break;
			case self::ROLE_PLANER :
				if (isset ( $roleList ['role_planer'] )) {
					$roles = $roleList ['role_planer'];
				}
				break;
			case self::ROLE_ENTWICKLER :
				if (isset ( $roleList ['role_entwickler'] )) {
					$roles = $roleList ['role_entwickler'];
				}
				break;
			case self::ROLE_CUSTOMER:
				if (isset ( $roleList ['role_customer'] )) {
					$roles = $roleList ['role_customer'];
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

	public function redirect($roleUser, $return = false) {
		$url = '';
		switch ($roleUser) {
			case self::ROLE_CUSTOMER:
			case self::ROLE_DEVELOPER :
				$url = 'service/show/';
				break;
			case self::ROLE_TECHNICAL :
				$url = 'orders/lists/';
				break;
			case self::ROLE_HOTLINE :
				$url = 'service/show/';
				break;
			case self::ROLE_PLANER :
				$url = 'moduls/overview/';
				break;
			case self::ROLE_ENTWICKLER :
				$url = 'service/show/';
				break;
			case self::ROLE_ADMINISTRATOR :
			default :
				$url = 'service/show/';
				break;
		}

		if(!$return) {
			redirect('/' . $url, 'refresh');
		}
		return $url;
	}

	public function getSidebars() {
		$CI =& get_instance();
		$user = $CI->session->userdata ( 'user' );

		$sidebar = array();
		switch ($user->roleName) {
			case self::ROLE_CUSTOMER:
			case self::ROLE_DEVELOPER :
				$sidebar = array(
					array('id' => 'moduls', 'url' => 'moduls/overview', 'name' => 'Module'),
					array('id' => 'orders', 'url' => 'orders/lists', 'name' => 'Order'),
				);
				break;
			case self::ROLE_TECHNICAL :
				$sidebar = array(
						array('id' => 'moduls', 'url' => 'moduls/overview', 'name' => 'Module'),
						array('id' => 'orders', 'url' => 'orders/lists', 'name' => 'Order'),
				);
				break;
			case self::ROLE_HOTLINE :
				$sidebar = array(
					array('id' => 'moduls', 'url' => 'moduls/overview', 'name' => 'Module'),
					array('id' => 'orders', 'url' => 'orders/lists', 'name' => 'Order'),
				);
				break;
			case self::ROLE_PLANER :
				$sidebar = array(
					array('id' => 'moduls', 'url' => 'moduls/overview', 'name' => 'Module'),
				);
				break;
			case self::ROLE_ENTWICKLER :
				$sidebar = array(
					array('id' => 'moduls', 'url' => 'moduls/overview', 'name' => 'Module'),
					array('id' => 'orders', 'url' => 'orders/lists', 'name' => 'Order'),
				);
				break;
			case self::ROLE_ADMINISTRATOR :
			default :
				$sidebar = array(
					array('id' => 'moduls', 'url' => 'moduls/overview', 'name' => 'Module'),
					array('id' => 'orders', 'url' => 'orders/lists', 'name' => 'Order'),
				);
				break;
		}

		return $sidebar;
	}
}