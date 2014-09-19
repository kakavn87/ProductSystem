<?php
 class Products extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'attendance' => null,
             'description' => null,
             'costs' => null,
             'name' => null,
             'traineramount' => null,
             'label' => null,
             'status' => null,
             'trainer_id' => null,
             'category_id' => null
         );
     }

     function selectFirst() {
      $this->db->select("id");
      $this->db->from('products');
      $this->db->where('deleted','0');
      $query = $this->db->get();
      $result = $query->first_row();
      return $result->id;   
     }
     
     
     function getProductData($id) {
       $this->db->select('*');
       $this->db->from('products');
       $this->db->where('products.id', $id); 
    //   $this->db->join('trainer', 'products.trainer_id = trainer.trainer_id');
       $query = $this->db->get();
       $result = $query->result();
       $result = $result[0];
       return $result;     
     }
     
     function getNames() {
       $this->db->select('id, name, label');
       $this->db->where('deleted', '0');
       $this->db->order_by('name','asc');
       $query = $this->db->get('products');
       $result = $query->result();
       return $result;
     }

     function getNamesT() {
       $this->db->select('id, name');
       $this->db->where('deleted', '0');
       $this->db->order_by('name','asc');
       $query = $this->db->get('products');
       $result = $query->result();
       return $result;
     }

     
     
     function saveProduct($id) {
       $data['name']           = $this->input->post('productname');
       $data['attendance']     = $this->input->post('attendance');
       $data['description']    = $this->input->post('description');
       $data['traineramount']  = $this->input->post('traineramount');
       $data['label']          = $this->input->post('label');
       $data['status']         = $this->input->post('status');
       $data['trainer_id']     = $this->input->post('trainername');
       $data['category_id']    = $this->input->post('categories');
       $data['deleted']        = '0';

       $this->db->where('id', $id);
       $this->db->update('products', $data); 
     }
     
     function addProduct() {
       if (isset($_POST["save"])) {

        $data['name']           = $this->input->post('productname');
        $data['attendance']     = $this->input->post('attendance');
        $data['description']    = $this->input->post('description');
        $data['traineramount']  = $this->input->post('traineramount');
        $data['label']          = $this->input->post('label');
        $data['status']         = $this->input->post('status');
        $data['trainer_id']     = $this->input->post('trainername');
        $data['category_id']    = $this->input->post('categories');
        $data['deleted']        = '0';
        
        $this->db->insert('products', $data); 
       }
     }

     function bookProduct($attendants_id) {
      $actdate = date("Y-m-d");
      $actuhrzeit = date("H:i");

       if($this->input->post('datepicker2')) {
         $date = explode(".", $this->input->post('datepicker2'));
         $date = $date[2]."-".$date[1]."-".$date[0];
         $uhrzeit = '00:00';
       } else {
        $date = '0000-00-00';
        $uhrzeit = '00:00';
       }

       if (isset($_POST["save"])) {

        $company = NULL;

        if ($this->input->post('chooseCompany') != "") { 
          $company = $this->input->post('chooseCompany');
        }

        $data['attendants_id']  = $attendants_id;
        $data['products_id']    = $this->input->post('chooseProduct');
        $data['customer_id']    = $company;
        $data['product_date']   = $date." ".$uhrzeit;
        $data['create_date']    = $actdate." ".$actuhrzeit;
        $data['changed_date']   = $actdate." ".$actuhrzeit;
        $data['deleted']        = NULL;
        
        $this->db->insert('attendants_products', $data); 
       }
     }

    function getBookedProducts($id) {
      $query = $this->db->query("SELECT 
      date_format(product_date, '%d.%m.%Y') AS date, 
      attendants_products.id as ap_id,
      attendants_products.products_id as product_id, 
      attendants_products.attendants_id as attendants_id,
      products.name as name
      FROM attendants_products
      LEFT JOIN products
      ON attendants_products.products_id = products.id 
      WHERE attendants_id = $id 
      AND attendants_products.deleted IS NULL
      -- AND products.deleted = '0'
      order by product_date desc");

      return($query->result());
    }

    function getBookedAttProducts($customer_id) {

      $query = $this->db->query("SELECT *
      FROM attendants_products
      LEFT JOIN products
      ON attendants_products.products_id = products.id 
      LEFT JOIN attendants 
      ON attendants_products.attendants_id = attendants.id
      WHERE attendants_products.customer_id = $customer_id 
      AND attendants_products.deleted IS NULL
      AND products.deleted = '0'
      AND attendants.deleted = '0'
      order by product_date desc");

      return($query->result());
    }


     function setDelete($product_id) {
      $this->db->where('id', $product_id);
      $data['deleted']  = '1';
      $this->db->update('products', $data); 
     }

 }
?>
