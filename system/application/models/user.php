<?php
 class User extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'mail' => null,
             'password' => null,
             'role' => null
         );
     }

    function check($mail, $password) {
       $this->db->select('mail'); //TODO Passwortabfrage
       $this->db->where('mail',$mail); 
       $this->db->where('password',$password); 
       $query = $this->db->get('user');
       $result = $query->result();


       if($result != null) {
        return true;
       }

       else {
        return false;
       }
    }

    function getRole($mail) {
       $this->db->select('role,id,short_name');
       $this->db->where('mail',$mail); 
       $query = $this->db->get('user');
       $result = $query->result();
       $result = $result[0];
       return $result;
    }

    function getAll() {
       $this->db->select('id,name');
       $query = $this->db->get('user');
       $result = $query->result();
       return $result;
    } 
     
 }
?>