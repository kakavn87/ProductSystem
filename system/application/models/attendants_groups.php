<?php
 class Attendants_groups extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'attendants_id' => null,
             'groups_id' => null
         );
     }

    function add($groups,$attendants_id) {
        foreach($groups as $group_id) {
            $data['attendants_id'] = $attendants_id;
            $data['groups_id'] = $group_id;
            $this->db->insert('attendants_groups', $data); 
        }
        
    }

    function removeGroup($group_id,$attendants_id) {
       $this->db->where('groups_id', $group_id);
       $this->db->where('attendants_id', $attendants_id);
	   $this->db->delete('attendants_groups');     
    }
     
 }
?>