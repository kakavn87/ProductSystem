<?php
class Product extends CI_Controller {

  protected $navstate;

  public function __construct()
  {
    parent::__construct();
    $this->navstate = 'product';
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function index() {
   redirect('/product/show', 'refresh');
  }

  public function add($attendants_id=false) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }

   $this->load->model('products');
   $products = new Products;
   $product_id = $products->addProduct();

   $this->load->model('target');
   $target = new Target;
   $viewData['targets'] = $target->getNames();

   $this->load->model('trainer');
   $trainer = new Trainer;
   $viewData['trainername'] = $trainer->getNames();

   $this->load->model('categories');
   $categories = new Categories;
   $viewData['categories'] = $categories->getNames();

   $viewData['navstate'] = $this->navstate; 
   $this->load->view('public/products/add',$viewData); 

   if($this->input->post('save')) {
     redirect('/product/show/', 'refresh');
   }
   
  }

  public function save($id) {
   $this->load->model('products');
   $products = new Products;
   $products->saveProduct($id);
   
   redirect('/product/show/'.$id, 'refresh');
  }
  
  public function show($products_id = false) {

   if ($products_id == false) {
    $this->load->model('products');
    $products = new Products;
    $products_id = $products->selectFirst();
   }

   $this->load->model('products');
   $products = new Products;
   $viewData['formular'] = $products->getProductData($products_id);
   $viewData['nav'] = $products->getNames();

   $this->load->model('trainer');
   $trainer = new Trainer;
   $viewData['trainers'] = $trainer->getNames();

   $this->load->model('target');
   $target = new Target;
   $viewData['targets'] = $target->getNames();

   $this->load->model('categories');
   $categories = new Categories;
   $viewData['categories'] = $categories->getNames();

   $this->load->model('attendants_products');
   $attendants_products = new Attendants_products;
   $customer = $attendants_products->getNames($products_id);

   if(!empty($customer)) {
      foreach ($customer as $customer) {
        $customerData[] = $customer->customer_id;
      }

      $this->load->model('customers');
      $customers = new Customers;
      $viewData['customers'] = $customers->getCustomerName($customerData);
   } else {
      $viewData['customers'] = 'keine';
   }
   //Data for Befragung list
   $this->load->model('befragungs');
   $befragungs = new Befragungs;
   $viewData['befragunglist'] = $befragungs->getBefragung($products_id);


   $viewData['navstate'] = $this->navstate; 
    
   $this->load->view('public/products/overview',$viewData);
  }

  public function setDelete($product_id) {
   $this->load->model('products');
   $product = new Products;
   $product->setDelete($product_id);
   redirect('product/show/', 'refresh');
  }

  // public function attEdit($product_id) {
  //  $this->load->model('products');
  //  $products = new Products;
  //  $viewData['chooseProduct'] = $products->editAttProduct($product_id);
  //  $viewData['products'] = $products->getAttProduct($product_id);

  //  $this->load->view('public/products/attEdit',$viewData); 
  // }

  // public function attSave($id) {
  //  $this->load->model('products');
  //  $products = new Products;

  //  $attendants_id = $_POST['attendants_id'];

  //  $products->attSave($id);
  //  redirect('attendant/show/'.$attendants_id, 'refresh');
  // }
  



}

?>
