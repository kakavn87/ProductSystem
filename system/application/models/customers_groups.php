<?php
 class Customers_groups extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'attendants_id' => null,
             'groups_id' => null
         );
     }

    function removeGroup($group_id,$customer_id) {
       $this->db->where('groups_id', $group_id);
       $this->db->where('customer_id', $customer_id);
	   $this->db->delete('customers_groups');     
    }
     
 }
?>