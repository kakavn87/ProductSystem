<?php
 class Counterpart extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'firstname' => null,
             'lastname' => null,
             'phone' => null,
             'mobile' => null,
             'email' => null,
             'comment' => null,
             'create_date' => null,
             'changed_date' => null
         );
     }

    function add() {
       $date = new DateTime('now');
       $date = $date->format('Y-m-d H:i:s');

       $data['firstname']      = $this->input->post('firstName');
       $data['lastname']       = $this->input->post('lastName');
       $data['phone']          = $this->input->post('phone');
       $data['mobile']         = $this->input->post('mobile');
       $data['email']          = $this->input->post('mail');
       $data['comment']        = $this->input->post('comment');
       $data['create_date']    = $date;
       $data['changed_date']   = $date;

       $this->db->insert('counterpart', $data); 

       return $this->db->insert_id();
    }

    function get($customer_id) {

       $this->db->select('counterpart.id, firstname, lastname, phone, mobile, email, comment');
       $this->db->from('counterpart');
       $this->db->join('customers_counterpart', 'counterpart.id = customers_counterpart.counterpart_id');
       $this->db->where('customers_counterpart.customer_id', $customer_id);

       $query = $this->db->get();
       $result = $query->result();
       return $result;   
    }

    function getData($counterpart_id) {
       $this->db->select('id, firstname, lastname, phone, mobile, email, comment');
       $this->db->from('counterpart');
       $this->db->where('id', $counterpart_id);

       $query = $this->db->get();
       $result = $query->result();
       $result = $result[0];
       return $result;   
    }

    function save($counterpart_id) {
       $date = new DateTime('now');
       $date = $date->format('Y-m-d H:i:s');

       $data['firstname']     = $this->input->post('firstName');
       $data['lastname']      = $this->input->post('lastName');
       $data['mobile']        = $this->input->post('mobile');
       $data['phone']         = $this->input->post('phone');
       $data['email']         = $this->input->post('mail');
       $data['comment']       = $this->input->post('comment');
       $data['changed_date']  = $date;

       $this->db->where('id', $counterpart_id);
       $this->db->update('counterpart', $data); 
    }

    function remove($counterpart_id) {
       $this->db->where('id', $counterpart_id);
       $this->db->delete('counterpart');   
    }

 }
?>