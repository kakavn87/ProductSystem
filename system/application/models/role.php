<?php
class Role extends CI_Model {
	const ROLE_ADMINISTRATOR = 'administrator';
	const ROLE_DEVELOPER = 'developer';
	const ROLE_TECHNICAL = 'technical';
	const ROLE_HOTLINE = 'hotline';
	const ROLE_PLANER = 'planer';
	const ROLE_ENTWICKLER = 'entwickler';
	
	public function __construct() {
		parent::__construct ();
		$this->properties = array (
				'id' => null,
				'name' => null,
				'deleted' => null,
				'status' => null
		);
	}
}