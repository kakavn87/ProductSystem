<?php
class Reminder extends CI_Controller {

  protected $navstate;

  public function __construct()
  {
    parent::__construct();
    $this->navstate = 'reminder';
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function index() {
    redirect('/reminder/show', 'refresh');
  }
  
  public function show() {

   $user_id = $this->session->userdata('user_id');

   $this->load->model('reminders');
   $reminder = new Reminders;
   $viewData['reminder'] = $reminder->getReminder($user_id);
   $viewData['navstate'] = $this->navstate; 

   $this->load->view('public/reminder/overview',$viewData);
  }

  public function remove($aid = false) {

   $this->load->model('reminders');
   $reminder = new Reminders;
   $reminder->removeReminder($this->input->post('reminderRemove'),$aid);
   redirect('/reminder/show/', 'refresh');
  }

  public function save($id) {
   $this->load->model('attendants');
   $attendants = new Attendants;
   $reminderdate = $attendants->stringToDate($this->input->post('reminderdate'));

   $user_id = $this->input->post('user_id');
   $priority = $this->input->post('priority');

   $this->load->model('reminders');
   $reminder = new Reminders;
   $reminder->saveReminder($id,$reminderdate,$user_id,$priority);
   
   redirect('/attendant/show/'.$id, 'refresh');
  }


}

?>