<?php
class Group extends CI_Controller {

  protected $navstate;

  public function __construct()
  {
    parent::__construct();
    $this->navstate = 'group';
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function index() {
    redirect('/group/show', 'refresh');
  }

  public function save($id) {
   $this->load->model('groups');
   $groups = new Groups;
   $groups->saveGroup($id);
   
   redirect('/group/show/'.$id, 'refresh');
  }
  

  public function show($group_id = false) {


   if ($group_id == false) {
    $this->load->model('groups');
    $groups = new Groups;
    $group_id = $groups->selectFirst();
   }

   $this->load->model('groups');
   $groups = new Groups;

   $viewData['formular'] = $groups->getGroupData($group_id);
   $viewData['nav'] = $groups->getNames();
   $viewData['navstate'] = $this->navstate; 
   // $viewData['customers'] = $attendants->getCustomers($attendants_id);

   $this->load->view('public/groups/overview',$viewData);
  }

  public function showAdd() {
    $this->load->view('public/groups/add');
  }

  public function add() {
   $this->load->model('groups');
   $groups = new Groups;
   $groups->add($this->input->post('groupname'));
   
   redirect('/group/show/', 'refresh');
  }

  public function remove($group_id)
  {
   if ($this->session->userdata('role') == "view" || $this->session->userdata('role') == "edit") {
    redirect('/group/show/', 'refresh');
   }
   $this->load->model('groups');
   $groups = new groups;
   $groups->remove($group_id);
   redirect('/group/show/', 'refresh');
  }
  
}

?>