<?php
 class Trainer extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'trainer_id' => null,
             'firstname' => null,
             'costs' => null,
             'lastname' => null,
             'telefon' => null,
             'driverlicence' => null,
             'street' => null,
             'zip' => null,
             'town' => null,
             'country' => null,
             'mobile' => null,
             'roles' => null,
             'email' => null
         );
     }
     

    function getNames() {
       $this->db->select('trainer_id, firstname, lastname');
       $this->db->order_by('firstname','asc');
       $query = $this->db->get('trainer');
       $result = $query->result();
       return $result;
    }
 }
?>