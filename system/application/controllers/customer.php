<?php
class Customer extends CI_Controller {



  protected $navstate;

  public function __construct()
  {
    parent::__construct();
    $this->navstate = 'customer';
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function index() {
    redirect('/customer/show', 'refresh');
  }

  // public function save($id) {
  //  $this->load->model('attendants');
  //  $attendants = new Attendants;
  //  $attendants->saveAttendants($id);
   
  //  redirect('/attendant/show/'.$id, 'refresh');
  // }
  
  public function show($customer_id = false) {



   if ($customer_id == false) {
     $this->load->model('customers');
     $customers = new Customers;
     $customer_id = $customers->selectFirst();
   }

   $this->load->model('customers');
   $customers = new Customers;

   $viewData['formular'] = $customers->getCustomerData($customer_id);
   $viewData['nav'] = $customers->getNames();
   $viewData['attendants'] = $customers->showAttendants($customer_id);
   
   $this->load->model('products');
   $products = new Products;
   $viewData['products'] = $products->getBookedAttProducts($customer_id);

   $this->load->model('groups');
   $groups = new Groups;
   $viewData['groups'] = $groups->getBookedCustomerGroups($customer_id);

   $this->load->model('notice');
   $notice = new Notice;
   $viewData['notice'] = $notice->getShort(0,$customer_id);

   $this->load->model('branchs');
   $branchs = new Branchs;
   $viewData['branchs'] = $branchs->getCustomersBranchs($customer_id);

   $this->load->model('counterpart');
   $counterpart = new Counterpart;
   $viewData['counterpart'] = $counterpart->get($customer_id);

   $viewData['navstate'] = $this->navstate; 

   $this->load->view('public/customers/overview',$viewData);
  }

  public function addFile($id, $file) {
   $this->load->model('customers');
   $customers = new Customers;
   $customers->addFile($id,$file);

   redirect('/customer/show/'.$id, 'refresh');

  }
  

  public function save($id) {
   $this->load->model('customers');
   $customers = new Customers;
   $customers->saveCustomer($id);
   
   redirect('/customer/show/'.$id, 'refresh');
  }

  public function add() {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }

   $this->load->model('customers');
   $customers = new Customers;
   $customer_id = $customers->addCustomer();

   $customerData = $customers->getCustomerData($customer_id);

   if (!empty($customerData->copy_attendant)) {
      $copy = "1";
   } 
   else {
      $copy = "0";
   }

   if ($copy == "1") {

     $formular = array(
                   'company'       => $this->input->post('company'),
                   'street'        => $this->input->post('street'),
                   'zipcode'       => $this->input->post('zipcode'),
                   'town'          => $this->input->post('town'),
                   'country'       => $this->input->post('country'),
                   'phone'         => $this->input->post('phone'),
                   'fax'           => $this->input->post('fax'),
                   'mail'          => $this->input->post('mail')
               );

     $this->session->set_userdata($formular);

     redirect('/attendant/add/', 'refresh');
   }

   if (isset($_POST['save'])) {
    redirect('customer/show/'.$customer_id, 'refresh');
   }
   else {
    $viewData['navstate'] = $this->navstate; 
    $this->load->view('public/customers/add',$viewData); 
   }
   
  }

  public function bookNewAttendant($customer_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('attendants');
   $attendants = new Attendants;
   $viewData['attendants'] = $attendants->getNames();
   $viewData['customer_id'] = $customer_id;
   $this->load->view('public/customers/bookAttendant',$viewData); 
  }

  public function bookAttendant($customer_id) {
   $attendants_id = $this->input->post('chooseAttendant');
   $this->load->model('Customers_attendants');
   $customer_attendants = new Customers_attendants;

   $viewData['attendants'] = $customer_attendants->bookAttendant($customer_id, $attendants_id);
   redirect('customer/show/'.$customer_id, 'refresh');
  }


  public function bookNewBranch($customer_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('branchs');
   $branchs = new Branchs;
   $viewData['branchs'] = $branchs->getNames();
   $viewData['customer_id'] = $customer_id;
   $this->load->view('public/customers/bookBranch',$viewData); 
  }

  public function bookBranch($customer_id) {
   $attendants_id = $this->input->post('chooseBranch');
   $this->load->model('customers_branchs');
   $customers_branchs = new Customers_branchs;

   $viewData['branchs'] = $customers_branchs->bookBranch($customer_id);
   redirect('customer/show/'.$customer_id, 'refresh');
  }

  public function removeAttendant($attendant_id,$customer_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('customers_attendants');
   $customers_attendants = new Customers_attendants;
   $customers_attendants->removeAttendant($attendant_id,$customer_id);
   redirect('customer/show/'.$customer_id, 'refresh');
  }

  public function removeBranch($branch_id,$customer_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('customers_branchs');
   $customers_branchs = new Customers_branchs;
   $customers_branchs->removeBranch($branch_id,$customer_id);
   redirect('customer/show/'.$customer_id, 'refresh');
  }

  public function setDelete($customer_id) {
   $this->load->model('customers');
   $customers = new Customers;
   $customers->setDelete($customer_id);
   redirect('customer/show/', 'refresh');

  }

  public function bookNewGroup($customer_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('groups');
   $groups = new Groups;
   $viewData['groups'] = $groups->getNames();
   $viewData['customer_id'] = $customer_id;
   $this->load->view('public/customers/bookGroup',$viewData); 
  }

  public function bookGroup($customer_id) {
   $this->load->model('groups');
   $groups = new Groups;
   $groups->bookCustomerGroup($customer_id);
   redirect('customer/show/'.$customer_id, 'refresh');
  }


  public function removeGroup($group_id,$customer_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/customer/show/', 'refresh');
   }
   $this->load->model('Customers_groups');
   $customer_groups = new Customers_groups;
   $customer_groups->removeGroup($group_id,$customer_id);
   redirect('customer/show/'.$customer_id, 'refresh');
  }

  public function removeNotice($notice_id,$customer_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/customer/show/', 'refresh');
   }
   $this->load->model('notice');
   $notice = new notice;
   $notice->removeNotice($notice_id,$customer_id);
   redirect('customer/show/'.$customer_id, 'refresh');
  }


  public function bookCounterpart($customer,$customer_id) {
   $this->load->model('notice');
   $notice = new Notice;
   $viewData['customer'] = $customer_id;

   $this->load->view('public/counterpart/add',$viewData); 
  }

  public function addCounterpart($customer,$customer_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('counterpart');
   $counterpart = new Counterpart;
   $counterpart_id = $counterpart->add();

   $this->load->model('customers_counterpart');
   $customers_counterpart = new Customers_counterpart;
   $customers_counterpart->add($customer_id,$counterpart_id);

   redirect('customer/show/'.$customer_id, 'refresh');
  }

  public function editCounterpart($counterpart_id, $customer_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('counterpart');
   $counterpart = new Counterpart;
   $viewData['data'] = $counterpart->getData($counterpart_id);
   $viewData['customer_id'] = $customer_id;

   $this->load->view('public/counterpart/edit',$viewData); 
  }

  public function saveCounterpart($counterpart_id, $customer_id) {
   $this->load->model('counterpart');
   $counterpart = new counterpart;
   $counterpart->save($counterpart_id);
   redirect('/customer/show/'.$customer_id, 'refresh');
  }

  public function removeCounterpart($counterpart_id, $customer_id) {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('counterpart');
   $counterpart = new Counterpart;
   $counterpart->remove($counterpart_id);

   $this->load->model('customers_counterpart');
   $customers_counterpart = new Customers_counterpart;
   $customers_counterpart->remove($counterpart_id, $customer_id);

   redirect('customer/show/'.$customer_id, 'refresh');
  }

}

?>