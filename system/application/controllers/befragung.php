<?php
class Befragung extends CI_Controller {

  protected $navstate;

  public function __construct()
  {
    parent::__construct();
    $this->navstate = 'befragung';
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function index() {
   redirect('/product/show', 'refresh');
  }

  public function add() {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }

   $this->load->model('befragungs');
   $befragung = new Befragungs;
   $product_id = $befragung->addBefragung();

   
    redirect('/product/show/'.$product_id, 'refresh');

  }

  public function save($id)//$attendants_id=false) 
  {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }

   $this->load->model('befragungs');
   $befragung = new Befragungs;
   $product_id = $befragung->saveBefragung($id);

   
    redirect('/product/show/'.$product_id, 'refresh');

  }



}

?>
