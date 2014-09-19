<?php
 class Attendants_products extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'attendants_id' => null,
             'products_id' => null,
             'deleted' => null
         );
     }

    function removeProduct($ap_id,$attendants_id) {
       $actdate = date("d.m.Y");
       $actuhrzeit = date("H:i");

       $this->db->where('id', $ap_id);
       $this->db->where('attendants_id', $attendants_id);
       $data['deleted']         = '1';
       $data['changed_date']    = $actdate." ".$actuhrzeit;
       $this->db->update('attendants_products', $data);    
    }

    function getNames($products_id) {
       $this->db->select('customer_id');
       $this->db->from('attendants_products');
       $this->db->where('products_id', $products_id);
       $this->db->where('deleted', NULL);
       $query = $this->db->get();
       $result = $query->result();
       return $result;    
    }

    function getProductDate($attendants_id,$product_id) {
       $this->db->select('product_date');
       $this->db->from('attendants_products');
       $this->db->where('products_id', $product_id);
       $this->db->where('attendants_id', $attendants_id);
       $this->db->where('deleted', NULL);
       $query = $this->db->get();
       $result = $query->result();
       return $result[0]; 
    }

    function saveProductDate($attendants_id,$product_id,$product_date) {

        $this->db->where('attendants_id', $attendants_id);
        $this->db->where('products_id', $product_id);

        $data['product_date']  = $product_date;
        $this->db->update('attendants_products', $data); 
    }
 }
?>