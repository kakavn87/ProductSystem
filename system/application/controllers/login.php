<?php
session_start();
class Login extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('user');
  }

  public function index() {
    $this->load->view('public/login/login'); 
  }

  public function check() {

    $password = $this->input->post('password');
    $password = sha1($password);

    $user = new User;
    $result = $user->check($this->input->post('mail'), $password);

    if ($result == "1") {
       $role = $user->getRole($this->input->post('mail'));  

       $this->session->set_userdata('role',$role->role);
       $this->session->set_userdata('user_id',$role->id);
       $this->session->set_userdata('short_name',$role->short_name);
       $this->session->set_userdata('logged','yes');

       redirect('/customer/show/', 'refresh');
    }
    else {
      $data['errorMail'] = "<span class='error'>Zugangsdaten nicht vorhanden oder fehlerhaft.</span><br/>";
      $this->load->view('public/login/login',$data); 
    }
  }

  public function logout() {
    $this->session->unset_userdata('role');
    $this->session->unset_userdata('logged');
    session_destroy();
    $this->load->view('public/login/login'); 
  }

}

?>