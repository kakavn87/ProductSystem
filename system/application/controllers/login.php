<?php
@session_start();
class Login extends Ext_Controller {

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
       $this->session->set_userdata('user', $result);
       $this->session->set_userdata('logged','yes');

       $this->load->library('roleComponent');
       $roleComponent = new RoleComponent();
       $url = $roleComponent->redirect($result->roleName, true);
       
       $show_popup = false;
       $allow_role = array(RoleComponent::ROLE_DEVELOPER, RoleComponent::ROLE_CUSTOMER);
       if(in_array($result->roleName, $allow_role)) {
       		$show_popup = true;
       }
       
       $this->response['show_popup'] = $show_popup;
       $this->response['url'] = $url;
       $this->response['user'] = $result;
       
       $this->response['viewHtmlPopup'] = $this->load->view('public/login/order_popup', array(), true);
       $this->sendAjax();
    }
    else {
      $this->sendAjax(1, "Zugangsdaten nicht vorhanden oder fehlerhaft");
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