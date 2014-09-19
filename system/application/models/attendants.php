<?php
 class Attendants extends CI_Model {

    public function  __construct() {
         parent::__construct();
         
         $this->load->database();
         
         $this->properties = array(
             'id' => null,
             'firstname' => null,
             'lastname' => null,
             'birth' => null,
             'additional_adress' => null,
             'street' => null,
             'town' => null,
             'plz' => null,
             'gender' => null,
             'country' => null,
             'phone' => null,
             'mobile' => null,
             'fax' => null,
             'email' => null,
             'groups' => null,
             'title' => null,
             'function' => null,
             'create_date' => null,
             'changed_date' => null
         );
     }

     function selectFirst() {
      $this->db->select("id");
      $this->db->from('attendants');
      $this->db->where('deleted','0');
      $query = $this->db->get();
      $result = $query->first_row();
      return $result->id;   
     }

    function addFile($id,$file) {
      $data['avatar'] = $file;
      $this->db->where('id', $id);
      $this->db->update('attendants', $data); 
    }

     function getAttendantData($id) {
      $this->db->select("*");
      $this->db->from('attendants');
      $this->db->where('attendants.deleted','0');
      $this->db->where('attendants.id',$id);
      $query = $this->db->get();
      $result = $query->result();
      $result = $result[0];
      return $result;     
     }

     function getAttendantReminder($id) {
      $this->db->select("*");
      $this->db->from('reminder');
      $this->db->where('reminder.deleted','0');
      $this->db->where('attendant_id',$id);
      $query = $this->db->get();
      $result = $query->result();

      if(!empty($result)) {
        $result = $result[0];
      }

      return $result;
     }
     
     function getNames() {
       $this->db->select('id, firstname, lastname');
       $this->db->where('deleted','0');
       $this->db->order_by('firstname','asc');
       $query = $this->db->get('attendants');

       $result = $query->result();
       return $result;
     }

     function db_fixtures($firstname, $lastname) {
        $data['firstname']   = $firstname;
        $data['lastname']    = $lastname;

        $this->db->insert('attendants', $data); 
     }
     
     function saveAttendant($id) {

       $date = new DateTime('now');
       $date = $date->format('Y-m-d H:i:s');

       $data['firstname']     = $this->input->post('firstName');
       $data['lastname']      = $this->input->post('lastName');
       $data['birth']         = $this->input->post('birth');
       $data['additional_adress'] = $this->input->post('additional_adress');
       $data['street']        = $this->input->post('street');
       $data['town']          = $this->input->post('town');
       $data['plz']           = $this->input->post('zipcode');
       $data['country']       = 'null';
       $data['mobile']        = $this->input->post('mobile');
       $data['phone']         = $this->input->post('phone');
       $data['fax']           = $this->input->post('fax');
       $data['email']         = $this->input->post('mail');
       $data['gender']        = $this->input->post('gender');
       $data['groups']        = $this->input->post('group');
       $data['title']         = $this->input->post('title');
       $data['function']      = $this->input->post('function');
       $data['changed_date']  = $date;

       $this->db->where('id', $id);
       $this->db->update('attendants', $data); 
     }
     
     function addAttendant() {
       if (isset($_POST["save"])) {

        $date = new DateTime('now');
        $date = $date->format('Y-m-d H:i:s');

        $data['firstname']     = $this->input->post('firstName');
        $data['lastname']      = $this->input->post('lastName');
        $data['birth']         = $this->input->post('birth');
        $data['additional_adress'] = $this->input->post('additional_adress');
        $data['street']        = $this->input->post('street');
        $data['town']          = $this->input->post('town');
        $data['plz']           = $this->input->post('zipcode');
        $data['mobile']        = $this->input->post('mobile');
        $data['phone']         = $this->input->post('phone');
        $data['fax']           = $this->input->post('fax');        
        $data['email']         = $this->input->post('mail');
        $data['gender']        = $this->input->post('gender');
        $data['title']         = $this->input->post('title');
        $data['function']      = $this->input->post('function');
        $data['create_date']   = $date;
        $data['changed_date']  = $date;
       
        $this->db->insert('attendants', $data); 
       }

       $customer_id = $this->input->post('customer');
       $attendant_id = $this->db->insert_id();

       return array($customer_id, $attendant_id);
     }

     function addCustomerCopy($customerData) {

        $date = new DateTime('now');
        $date = $date->format('Y-m-d H:i:s');

        $data['firstname']     = $customerData->contact_firstname;
        $data['lastname']      = $customerData->contact_lastname;
        $data['birth']         = $customerData->contact_birth;
        $data['companyname']   = $customerData->customer;
        $data['street']        = $customerData->street;
        $data['town']          = $customerData->town;
        $data['plz']           = $customerData->zip;
        $data['mobile']        = $customerData->contact_mobile;
        $data['phone']         = $customerData->contact_phone;
        $data['fax']           = $customerData->contact_fax;       
        $data['email']         = $customerData->contact_email;
        $data['create_date']   = $date;
        $data['changed_date']  = $date;


        $this->db->insert('attendants', $data); 

     }

     function setDelete($attendant_id) {
        $this->db->where('id', $attendant_id);
        $data['deleted']    = '1';
        $this->db->update('attendants', $data); 
     }

     function getCustomers($attendants_id) {
        $query = $this->db->query("SELECT 
        customers_attendants.customer_id, customers.name
        FROM customers_attendants
        LEFT JOIN customers
        ON customers_attendants.customer_id = customers.id
        WHERE customers_attendants.attendants_id = $attendants_id AND
        customers.deleted = '0'
        ");

        $result = $query->result();
        return($result);
     } 
 
     function stringToDate($reminderdate) {
       if($reminderdate == '') {
         $reminderdate = '0000-00-00';
       } else {
         $reminderdate = date('Y-m-d', strtotime($reminderdate));
       }
       return $reminderdate;
     }

     function dateToString($reminderdate) {
       if($reminderdate != '0000-00-00') {
        $reminderdate = date('d.m.Y', strtotime($reminderdate));
       } else {
        $reminderdate = '';
       }  
       return($reminderdate);
     }
} 
?>