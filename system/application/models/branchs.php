<?php
 class Branchs extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'name' => null
         );
     }

    function selectFirst() {
      $this->db->select("id");
      $this->db->from('branchs');
      $query = $this->db->get();
      $result = $query->first_row();
      return $result->id;   
    }

    function getCustomersBranchs($customer_id) {
        $query = $this->db->query("SELECT 
        branchs.id,
        branchs.name
        FROM branchs
        LEFT JOIN customers_branchs 
        ON branchs.id = customers_branchs.branch_id
        WHERE customers_branchs.customer_id = $customer_id");
        $result = $query->result();
        return($result);
    }

    function saveBranch($id) {

       $data['name']     = $this->input->post('branchname');

       $this->db->where('id', $id);
       $this->db->update('branchs', $data); 
     }

    function getNames() {
       $this->db->select('id, name');
       $this->db->from('branchs');
       $this->db->order_by('name','asc');
       $query = $this->db->get();
       $result = $query->result();
       return $result;    
    }

    function add($name) {
       $data['name']   = $name;
       $this->db->insert('branchs', $data); 
    } 
     
    function getBranchData($id) {
      $query =  $this->db->get_where('branchs', array('id' => $id));
      $result = $query->result();
      $result = $result[0];
      return $result;     
    }

    function remove($branch_id) {
       $this->db->where('id', $branch_id);
       $this->db->delete('branchs');    
       $this->db->select("*");
       $this->db->from('branchs');
       $query = $this->db->get(); 
       $result = $query->first_row();
       return $result;
    }
 }
?>