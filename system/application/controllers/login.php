<?php
@session_start();
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
    if (!empty($result)) {
       $this->session->set_userdata('user',$result);
       $this->session->set_userdata('logged','yes');

       $this->load->library('roleComponent');
       
       $roleComponent = new RoleComponent();
       $roleComponent->redirect($result->roleName);
    }
    else {
      $data['errorMail'] = "<span class='error'>Zugangsdaten nicht vorhanden oder fehlerhaft.</span><br/>";
      $this->load->view('public/login/login',$data); 
    }
  }

  public function logout() {
    $this->session->unset_userdata('user');
    $this->session->unset_userdata('logged');
    session_destroy();
    $this->load->view('public/login/login'); 
  }

}

?>