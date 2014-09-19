<?php
class Attendant extends CI_Controller {
  protected $navstate;

  public function __construct()
  {
    parent::__construct();
    $this->navstate = 'attendant';
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function index() {
    redirect('/attendant/show', 'refresh');
  }

  public function save($id) {
   $this->load->model('attendants');
   $attendants = new Attendants; 
   $attendants->saveAttendant($id);
   redirect('/attendant/show/'.$id, 'refresh');
  }
  
  public function show($attendants_id = false) {

   if ($attendants_id == false) {
    $this->load->model('attendants');
    $attendants = new Attendants;
    $attendants_id = $attendants->selectFirst();
   }

   $this->load->model('attendants');
   $attendants = new Attendants;

   $viewData['navstate'] = $this->navstate; 
   $viewData['formular'] = $attendants->getAttendantData($attendants_id);
   $viewData['reminder'] = $attendants->getAttendantReminder($attendants_id);
   $viewData['nav'] = $attendants->getNames();
   $viewData['customers'] = $attendants->getCustomers($attendants_id);

   if(!empty($viewData['reminder'])) {
    $viewData['reminderdate'] = $attendants->dateToString($viewData['reminder']->reminderdate);
    $viewData['user_id'] = $viewData['reminder']->user_id;
    $viewData['priority'] = $viewData['reminder']->priority;
   } else {
    $viewData['reminderdate'] = '';
    $viewData['priority'] = '';
    $viewData['user_id'] = '0';
   }
   
   $this->load->model('groups');
   $groups = new Groups;
   $viewData['groups'] = $groups->getBookedGroups($attendants_id);

   $this->load->model('notice');
   $notice = new Notice;
   $viewData['notice'] = $notice->getShort($attendants_id, 0);

   $this->load->model('products');
   $products = new Products;
   $viewData['products'] = $products->getBookedProducts($attendants_id);

   $this->load->model('user');
   $user = new User;
   $viewData['mintern'] = $user->getAll();

   $this->load->view('public/attendants/overview',$viewData);
  }

  public function addFile($id, $file) {
   $this->load->model('attendants');
   $attendants = new Attendants;
   $attendants->addFile($id,$file);

   redirect('/attendant/show/'.$id, 'refresh');

  }

  public function add($customer_id = false) {



   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }

   $this->load->model('customers');
   $customers = new Customers;
   $viewData['customers'] = $customers->getNames();

   $viewData['customer_id'] = $customer_id;

   $this->load->model('attendants');
   $attendants = new Attendants;

   $ids = $attendants->addAttendant();
   $groups = $this->input->post('group');

   if($groups) {
      $this->load->model('attendants_groups');
      $attendants_groups = new attendants_groups;
      $attendants_groups->add($groups,$ids[1]);
   }

   $customer_id = $ids[0];
   $attendant_id = $ids[1];

   $this->load->model('customers_attendants');
   $customers_attendants = new customers_attendants;
   $customers_attendants->add($customer_id,$attendant_id);

   $this->load->model('groups');
   $groups = new Groups;
   $viewData['groups'] = $groups->getNames();


   $viewData['navstate'] = $this->navstate; 

   if (isset($_POST['save'])) {
    $this->session->unset_userdata('street');
    $this->session->unset_userdata('zipcode');
    $this->session->unset_userdata('town');
    $this->session->unset_userdata('country');
    $this->session->unset_userdata('mobile');
    $this->session->unset_userdata('phone');
    $this->session->unset_userdata('fax');
    $this->session->unset_userdata('mail');
    $this->session->unset_userdata('company');
    redirect('attendant/show/'.$attendant_id, 'refresh');
   }
   else {
    $this->load->view('public/attendants/add',$viewData);  
   }

  }


  public function bookNewProduct($attendants_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('products');
   $products = new Products;
   $viewData['products'] = $products->getNames();
   $viewData['attendant_id'] = $attendants_id;

   $this->load->model('attendants');
   $attendants = new Attendants;
   $viewData['customers'] = $attendants->getCustomers($attendants_id);

   $this->load->view('public/attendants/bookProduct',$viewData); 
  }

  public function bookProduct($attendants_id) {
   $this->load->model('products');
   $products = new Products;
   $products->bookProduct($attendants_id);
   redirect('attendant/show/'.$attendants_id, 'refresh');
  }

  public function editBookedProduct($attendants_id,$product_id) {
   $this->load->model('attendants_products');
   $attendants_products = new Attendants_products;
   $product_date = $attendants_products->getProductDate($attendants_id,$product_id);
   $viewData['product_date'] = date('d.m.Y', strtotime($product_date->product_date));

   if ($viewData['product_date'] == '01.01.1970') {
      $viewData['product_date'] = date("d.m.Y");
   }

   $viewData['attendants_id'] = $attendants_id;
   $viewData['product_id'] = $product_id;

   $this->load->view('public/attendants/editProductDate',$viewData); 
  }

  public function saveProductDate($attendants_id,$product_id) {
   $this->load->model('attendants_products');
   $attendants_products = new Attendants_products;
   $product_date = $this->input->post('datepicker2');
   $product_date = date('Y-m-d', strtotime($product_date));
   $attendants_products->saveProductDate($attendants_id,$product_id,$product_date);
   
   redirect('attendant/show/'.$attendants_id, 'refresh');
  }


  public function bookNewGroup($attendants_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('groups');
   $groups = new Groups;
   $viewData['groups'] = $groups->getNames();
   $viewData['attendant_id'] = $attendants_id;
   $this->load->view('public/attendants/bookGroup',$viewData); 
  }

  public function bookNewCustomer($attendants_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('customers');
   $customers = new Customers;
   $viewData['customers'] = $customers->getNames();
   $viewData['attendant_id'] = $attendants_id;
   $this->load->view('public/attendants/bookCustomer',$viewData); 
  }

  public function bookCustomer($attendants_id) {
   $this->load->model('customers');
   $customers = new Customers;
   $customers->bookCustomer($attendants_id);
   redirect('attendant/show/'.$attendants_id, 'refresh');
  }

  public function bookGroup($attendants_id) {
   $this->load->model('groups');
   $groups = new Groups;
   $groups->bookGroup($attendants_id);
   redirect('attendant/show/'.$attendants_id, 'refresh');
  }

  public function removeGroup($group_id,$attendants_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('Attendants_groups');
   $attendants_groups = new Attendants_groups;
   $attendants_groups->removeGroup($group_id,$attendants_id);
   redirect('attendant/show/'.$attendants_id, 'refresh');
  }

  public function removeCustomer($customer_id,$attendants_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('customers_attendants');
   $customers_attendants = new Customers_attendants;
   $customers_attendants->removeCustomer($customer_id,$attendants_id);
   redirect('attendant/show/'.$attendants_id, 'refresh');
  }

  public function removeProduct($product_id,$attendants_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('attendants_products');
   $attendants_products = new Attendants_products;
   $attendants_products->removeProduct($product_id,$attendants_id);
   redirect('attendant/show/'.$attendants_id, 'refresh');
  }

  public function removeNotice($notice_id,$attendants_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/customer/show/', 'refresh');
   }
   $this->load->model('notice');
   $notice = new notice;
   $notice->removeNoticeAtt($notice_id,$attendants_id);
   redirect('attendant/show/'.$attendants_id, 'refresh');
  }

  public function setDelete($attendant_id) {
   $this->load->model('attendants');
   $attendant = new Attendants;
   $attendant->setDelete($attendant_id);
   redirect('attendant/show/', 'refresh');
  }

  public function db_fixtures() {
    $firstname = array("Peter", "Bernd", "Claudia", "Tobias", "Thorsten", "Danny", "Manuel", "Christian", "Sascha",
                       "Ute", "Christine", "Sandra", "Malene", "Frederike", "Leonie", "Jessica", "Sarah", "Lisa");

    $lastname =  array("Müller", "Schmidt", "Klein", "Schmidt", "Körber", "Wagner", "Meier", "Maier", "Meyer");

    for ($i=0; $i<40000; $i++) {
      $rand_firstname = array_rand($firstname, 1);
      $rand_lastname  = array_rand($lastname, 1);

      $this->load->model('attendants');
      $attendants = new attendants;
      $attendants->db_fixtures($firstname[$rand_firstname], $lastname[$rand_lastname]);
    }

    redirect('customer/show/', 'refresh');
  }




}

?>