<?php
class Document extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->properties = array (
				'id' => null,
				'link' => null,
				'description' => null,
				'type' => null,
				'deleted' => null,
				'status' => null
		);
	}
}