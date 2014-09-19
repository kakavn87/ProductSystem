<?php
 class Categories extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'name' => null
         );
     }

    function getNames() {
       $this->db->select('id,name');
       $this->db->from('categories');
       $this->db->order_by('name','asc');

       $query = $this->db->get();
       $result = $query->result();
       return $result;   
    }

 }
?>