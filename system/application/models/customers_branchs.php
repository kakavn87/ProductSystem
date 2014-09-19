<?php
 class Customers_branchs extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'customer_id' => null,
             'branch_id' => null
         );
     }

    function removeBranch($branch_id,$customer_id) {
       $this->db->where('branch_id', $branch_id);
       $this->db->where('customer_id', $customer_id);
       $this->db->delete('customers_branchs');     
    }

    function bookBranch($customer_id) {
      if (isset($_POST["save"])) {
       $date = new DateTime('now');
       $date = $date->format('Y-m-d H:i:s');

       $data['customer_id']  = $customer_id;
       $data['branch_id']  = $this->input->post('chooseBranch');
       
       $this->db->insert('customers_branchs', $data); 
      }
    }
     
 }
?>