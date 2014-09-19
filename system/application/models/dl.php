<?php
class Dl extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->properties = array (
				'id' => null,
				'name' => null,
				'description' => null,
				'status' => null,
				'create_date' => null,
				'modied_date' => null,
				'deleted' => null,
				'status' => null
		);
	}
}