<?php
 class Customers extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'headquarter' => null,
             'companyform' => null,
             'contact_firstname' => null,
             'contact_lastname' => null,
             'contact_birth' => null,
             'contact_gender' => null,
             'contact_phone' => null,
             'contact_mobile' => null,
             'contact_fax' => null,
             'contact_email' => null,
             'credit_rating' => null,
             'international' => null,
             'street' => null,
             'town' => null,
             'zip' => null,
             'name' => null,
             'country' => null,
             'state' => null,
             'year' => null,
             'firstcontact' => null,
             'page' => null,
             'deleted' => null,
             'branchs_id' => null,
             'avatar' => null,
             'create_date' => null,
             'changed_date' => null,
         );
     }

    function selectFirst() {
      $this->db->select("id");
      $this->db->from('customers');
      $this->db->where('deleted','0');
      $query = $this->db->get();
      $result = $query->first_row();
      return $result->id;   
    }

    function addFile($id,$file) {
      $data['avatar'] = $file;
      $this->db->where('id', $id);
      $this->db->update('customers', $data); 
    }


    function getCustomerData($id) {
       $query =  $this->db->get_where('customers', array('id' => $id, 'deleted' => '0'));
       $result = $query->result();
       if(!empty($result)) {
        $result = $result[0];
       }
       
       return $result;      
     }
     
     function getNames() {
       $this->db->select('id, name, town');
       $this->db->from('customers');
       $this->db->where('deleted','0');
       $this->db->order_by('name','asc');
       $query = $this->db->get();
       $result = $query->result();
       return $result;    
     }

     function getNamesFromAttendant() {
       $this->db->select('id, name');
       $this->db->from('customers');
     //  $this->db->join('customers_attendants', 'customers.id = customers_attendants.customer_id');
       $this->db->where('customers.deleted','0');
       //$this->db->where('customers.id','customers_attendants.customer_id');
       $query = $this->db->get();
       $result = $query->result();
       return $result;    
     }

     function saveCustomer($id) {

       $date = new DateTime('now');
       $date = $date->format('Y-m-d H:i:s');

       $data['headquarter']        = $this->input->post('headquarter');
       $data['companyform']        = $this->input->post('companyform');
       $data['contact_firstname']  = $this->input->post('firstName');
       $data['contact_lastname']   = $this->input->post('lastName');
       $data['contact_birth']      = $this->input->post('birth');
       $data['contact_gender']     = $this->input->post('gender');
       $data['contact_phone']      = $this->input->post('phone');
       $data['contact_mobile']     = $this->input->post('mobile');
       $data['contact_fax']        = $this->input->post('fax');
       $data['contact_email']      = $this->input->post('mail');
       $data['credit_rating']      = 'not set';
       $data['international']      = $this->input->post('international');
       $data['street']             = $this->input->post('street');
       $data['town']               = $this->input->post('town');
       $data['zip']                = $this->input->post('zipcode');
       $data['name']               = $this->input->post('company');
       $data['country']            = $this->input->post('country');
       $data['state']              = $this->input->post('state');
       $data['year']               = $this->input->post('year');
       $data['firstcontact']       = $this->input->post('firstcontact');
       $data['page']               = $this->input->post('page');
       $data['deleted']            = '0';
       $data['changed_date']       = $date;

       $this->db->where('id', $id);
       $this->db->update('customers', $data); 
     }

     function addCustomer() {
       if (isset($_POST["save"])) {
        $date = new DateTime('now');
        $date = $date->format('Y-m-d H:i:s');

        $data['headquarter']        = $this->input->post('headquarter');
        $data['companyform']        = $this->input->post('companyform');
        $data['contact_firstname']  = $this->input->post('firstName');
        $data['contact_lastname']   = $this->input->post('lastName');
        $data['contact_birth']      = $this->input->post('birth');
        $data['contact_gender']     = $this->input->post('gender');
        $data['contact_phone']      = $this->input->post('phone');
        $data['contact_mobile']     = $this->input->post('mobile');
        $data['contact_fax']        = $this->input->post('fax');
        $data['contact_email']      = $this->input->post('mail');
        $data['credit_rating']      = 'not set';
        $data['international']      = $this->input->post('international');
        $data['street']             = $this->input->post('street');
        $data['town']               = $this->input->post('town');
        $data['zip']                = $this->input->post('zipcode');
        $data['name']               = $this->input->post('company');
        $data['country']            = $this->input->post('country');
        $data['state']              = $this->input->post('state');
        $data['year']               = $this->input->post('year');
        $data['firstcontact']       = $this->input->post('firstcontact');
        $data['page']               = $this->input->post('page');
        $data['deleted']            = '0';
        $data['copy_attendant']     = $this->input->post('attendant');
        $data['create_date']        = $date;
        $data['changed_date']       = $date;
       
        $this->db->insert('customers', $data); 

        return $this->db->insert_id();
       }


     }

     function showAttendants($customer_id) {
        $query = $this->db->query("SELECT 
        customers_attendants.id, 
        customers_attendants.customer_id,
        customers_attendants.attendants_id as attendant_id,
        attendants.firstname, attendants.lastname
        FROM customers_attendants
        LEFT JOIN attendants 
        ON customers_attendants.attendants_id = attendants.id
        WHERE customers_attendants.customer_id = $customer_id
        AND attendants.deleted = '0' ORDER BY attendants.firstname ASC");
        $result = $query->result();
        return($result);
     }

     function bookAttendants($customer_id) {
       if (isset($_POST["save"])) {
        $date = new DateTime('now');
        $date = $date->format('Y-m-d H:i:s');

        $data['customer_id']    = $customer_id;
        $data['attendants_id']  = $this->input->post('chooseAttendant');
        $data['create_date']    = $date;
        $data['changed_date']   = $date;
        
        $this->db->insert('customers_attendants', $data); 
       }
     }

     function bookCustomer($attendants_id) {
       if (isset($_POST["save"])) {
        $date = new DateTime('now');
        $date = $date->format('Y-m-d H:i:s');

        $data['attendants_id']  = $attendants_id;
        $data['customer_id']    = $this->input->post('chooseCustomer');
        
        $this->db->insert('customers_attendants', $data); 
       }
     }

     function setDelete($customer_id) {
        $this->db->where('id', $customer_id);
        $data['deleted']    = '1';
        $this->db->update('customers', $data); 

        // $this->db->where('customer_id', $customer_id);
        // $this->db->delete('customers_branchs');    

        // $this->db->where('customer_id', $customer_id);
        // $this->db->delete('customers_counterpart');

        // $this->db->where('customer_id', $customer_id);
        // $this->db->delete('customers_groups');       

        // set deleted

     }

     function getCustomerName($customerData) {
        foreach ($customerData as $customer) {
          $this->db->select('id,name');
          $this->db->from('customers');
          $this->db->where('deleted','0');
          $this->db->where('id',$customer);
          $query = $this->db->get();
          $result = $query->result();
          
          $customerNew[] = $result;   
        }
        return ($customerNew);
     }
     
 }
?>