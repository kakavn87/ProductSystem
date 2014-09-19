<?php
 class Customers_attendants extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'customer_id' => null,
             'attendants_id' => null
         );
     }

    function add($customer_id, $attendant_id) {
        $data['customer_id'] = $customer_id;
        $data['attendants_id'] = $attendant_id;
       
        $this->db->insert('customers_attendants', $data); 
    }

    function bookAttendant($customer_id,$attendants_id) {
       if (isset($_POST["save"])) {
        $data['customer_id']    = $customer_id;
        $data['attendants_id']  = $attendants_id;
        
        $this->db->insert('customers_attendants', $data); 
       }
    }

    function removeAttendant($attendant_id,$customer_id) {
       $this->db->where('attendants_id', $attendant_id);
       $this->db->where('customer_id', $customer_id);
       $this->db->delete('customers_attendants');     

       $this->db->where('attendants_id', $attendant_id);
       $data['deleted']    = '1';
       $this->db->update('attendants_products', $data);   
    }

    function removeCustomer($customer_id,$attendants_id) {
       $this->db->where('customer_id', $customer_id);
       $this->db->where('attendants_id', $attendants_id);
       $this->db->delete('customers_attendants');     
    }
     
 }
?>