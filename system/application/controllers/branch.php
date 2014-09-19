<?php
class Branch extends CI_Controller {

  protected $navstate;

  public function __construct()
  {
    parent::__construct();
    $this->navstate = 'branch';
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function index() {
    redirect('/branch/show', 'refresh');
  }

  public function save($id) {
   $this->load->model('branchs');
   $branchs = new Branchs;
   $branchs->saveBranch($id);
   
   redirect('/branch/show/'.$id, 'refresh');
  }
  

  public function show($branch_id = false) {


   if ($branch_id == false) {
    $this->load->model('branchs');
    $branchs = new Branchs;
    $branch_id = $branchs->selectFirst();
   }

   $this->load->model('branchs');
   $branchs = new Branchs;

   $viewData['formular'] = $branchs->getBranchData($branch_id);
   $viewData['nav'] = $branchs->getNames();
   $viewData['navstate'] = $this->navstate; 
   // $viewData['customers'] = $attendants->getCustomers($attendants_id);

   $this->load->view('public/branchs/overview',$viewData);
  }

  public function showAdd() {
    $this->load->view('public/branchs/add');
  }

  public function add() {
   $this->load->model('branchs');
   $branchs = new Branchs;
   $branchs->add($this->input->post('branchname'));
   
   redirect('/branch/show/', 'refresh');
  }

  public function remove($branch_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/branch/show/', 'refresh');
   }
   $this->load->model('branchs');
   $branchs = new Branchs;
   $branchs->remove($branch_id);
   redirect('/branch/show/', 'refresh');
  }
  
}

?>