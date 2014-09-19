<?php
 class Groups extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'name' => null
         );
     }

    function selectFirst() {
      $this->db->select("id");
      $this->db->from('groups');
      $query = $this->db->get();
      $result = $query->first_row();
      return $result->id;   
    }

    function getBookedGroups($attendants_id) {
        $query = $this->db->query("SELECT 
        attendants_groups.groups_id, groups.name
        FROM attendants_groups
        LEFT JOIN groups
        ON attendants_groups.groups_id = groups.id
        WHERE attendants_groups.attendants_id = $attendants_id
        ");

        $result = $query->result();
        return($result);
    }

    function getBookedCustomerGroups($customer_id) {
        $query = $this->db->query("SELECT 
        customers_groups.groups_id, groups.name
        FROM customers_groups
        LEFT JOIN groups
        ON customers_groups.groups_id = groups.id
        WHERE customers_groups.customer_id = $customer_id
        ");

        $result = $query->result();
        return($result);
    }

    function saveGroup($id) {

       $data['name']     = $this->input->post('groupname');

       $this->db->where('id', $id);
       $this->db->update('groups', $data); 
     }

    function getNames() {
       $this->db->select('id, name');
       $this->db->order_by('name','asc');
       $query = $this->db->get('groups');

       $result = $query->result();
       return $result;
    }

    function bookGroup($attendants_id) {
       if (isset($_POST["save"])) {
        $date = new DateTime('now');
        $date = $date->format('Y-m-d H:i:s');

        $data['attendants_id']  = $attendants_id;
        $data['groups_id']      = $this->input->post('chooseGroup');
        
        $this->db->insert('attendants_groups', $data); 
       }
     }
     
     function bookCustomerGroup($customer_id) {
       if (isset($_POST["save"])) {
        $date = new DateTime('now');
        $date = $date->format('Y-m-d H:i:s');

        $data['customer_id']    = $customer_id;
        $data['groups_id']      = $this->input->post('chooseGroup');
        
        $this->db->insert('customers_groups', $data); 
       }
     }

    function add($name) {
       $data['name']   = $name;
       $this->db->insert('groups', $data); 
    } 
     
    function getGroupData($id) {
      $query =  $this->db->get_where('groups', array('id' => $id));
      $result = $query->result();
      $result = $result[0];
      return $result;     
    }

    function remove($group_id) {
       $this->db->where('id', $group_id);
       $this->db->delete('groups');    
       $this->db->select("*");
       $this->db->from('groups');
       $query = $this->db->get(); 
       $result = $query->first_row();
       return $result;
    }
 }
?>