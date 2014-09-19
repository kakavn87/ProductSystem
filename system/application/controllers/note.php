<?php
class Note extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function index() {

  }

  public function anew($attendant,$attendants_id,$customer,$customers_id) {
   $this->load->model('notice');
   $notice = new Notice;
   $viewData['attendant'] = $attendants_id;
   $viewData['customer'] = $customers_id;

   $this->load->view('public/notice/add',$viewData); 
  }

  public function add($attendant,$attendants_id,$customer,$customers_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('notice');
   $notice = new Notice;
   $notice->add($attendants_id,$customers_id);

   if ($customers_id == 0) {
     redirect('attendant/show/'.$attendants_id, 'refresh');
   } else {
     redirect('customer/show/'.$customers_id, 'refresh');
   }
  }

  public function edit($id,$customer,$customers_id) {
   if ($this->session->userdata('role') == "view") {
    redirect('/attendant/show/', 'refresh');
   }
   $this->load->model('notice');
   $notice = new Notice;
   $viewData['notice'] = $notice->getLong($id);
   $viewData['customer'] = $customers_id;
   $this->load->view('public/notice/edit',$viewData); 
  }

  public function save($id) {
   $this->load->model('notice');
   $notice = new Notice;
   $notice->save($id);

   if ($_POST['customers_id'] == 0) {
    redirect('attendant/show/'.$_POST['attendants_id'], 'refresh');
   }
   else {
    redirect('customer/show/'.$_POST['customers_id'], 'refresh');
   }
  }

}

?>