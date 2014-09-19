<?php
 class Customers_counterpart extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'counterpart_id' => null,
             'customer_id' => null
         );
     }

    function add($customer_id, $counterpart_id) {
       $data['customer_id']     = $customer_id;
       $data['counterpart_id']  = $counterpart_id;

       $this->db->insert('customers_counterpart', $data); 
    }

     function remove($counterpart_id, $customer_id) {
       $this->db->where('counterpart_id', $counterpart_id);
       $this->db->where('customer_id', $customer_id);
       $this->db->delete('customers_counterpart');   
    }


 }
?>