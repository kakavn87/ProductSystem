<?php
 class Befragungs extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             
             `customer` => null, 
             `product` => null, 
             `type`=> null,
             `come` => null, 
             `conten` => null, 
             `layout` => null, 
             `price` => null, 
             `performance` => null, 
             `care` => null,
             `frendly` => null, 
             `completion` => null,
             `profess` => null, 
             `optimization` => null, 
             `continue` => null, 
             `comment` => null,
             `grundabsage` => null
     );
     }

     function getBefragung($product_id) {
       $this->db->select('*');
       $this->db->where('product', $product_id);      
       $query = $this->db->get('questions');
       $result = $query->result();
       return $result;
     }

     
     function addBefragung() {
       if (isset($_POST["save"])) {
        $radioInput = false;
        if (!isset($_POST['chkgekommen'])){
            $come = $this->input->post('txtgekommen');
        }
        else {
            $come = $_POST['chkgekommen'];
        }
        
        
        $data['customer']    = $this->input->post('customer');
        $data['product']  = $this->input->post('product');
        $data['type']          = $this->input->post('type');

        $data['come']         = $come;
        $data['conten']     = $this->input->post('conten');
        $data['layout']    = $this->input->post('layout');
        $data['price']    = $this->input->post('price');
        $data['performance']    = $this->input->post('performance');
        $data['care']    = $this->input->post('care');
        $data['frendly']    = $this->input->post('frendly');
        $data['completion']    = $this->input->post('completion');
        $data['profess']    = $this->input->post('profess');
        $data['optimization']    = $this->input->post('optimization');
        $data['continue']    = $this->input->post('continue');
        $data['comment']    = $this->input->post('comment');
        $data['grundabsage']    = $this->input->post('begruendung');
        $data['user_id']    = $this->input->post('user_id');
        $data['deleted']        = '0';
        
        $this->db->insert('questions', $data); 
        return($this->input->post('product'));
       }
     }

     function saveBefragung($id) {
      if (isset($_POST["save"])) {
        $radioInput = false;
        if (!isset($_POST['chkgekommen'])){
            $come = $this->input->post('txtgekommen');
        }
        else {
            $come = $_POST['chkgekommen'];
        }
        
       $data['customer']    = $this->input->post('customer');
        $data['product']  = $this->input->post('product');
        $data['type']          = $this->input->post('type');

        $data['come']         = $come;
        $data['conten']     = $this->input->post('conten');
        $data['layout']    = $this->input->post('layout');
        $data['price']    = $this->input->post('price');
        $data['performance']    = $this->input->post('performance');
        $data['care']    = $this->input->post('care');
        $data['frendly']    = $this->input->post('frendly');
        $data['completion']    = $this->input->post('completion');
        $data['profess']    = $this->input->post('profess');
        $data['optimization']    = $this->input->post('optimization');
        $data['continue']    = $this->input->post('continue');
        $data['comment']    = $this->input->post('comment');
        $data['grundabsage']    = $this->input->post('begruendung');
        $data['user_id']    = $this->input->post('user_id');
        $data['deleted']        = '0';
        
       $this->db->where('id', $id);
       $this->db->update('questions', $data); 
       return($this->input->post('product'));
      
      }
    }
          
 }
?>
