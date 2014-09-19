<?php
class Notification extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function newMessage($site,$id) {
    $viewData['site'] = $site;
    $viewData['id'] = $id;
    $this->load->view('public/notification/new',$viewData); 
  }

  public function sendMessage($site,$id) {
   
   switch ($site) {
    case "customer":
        $this->load->model('customers');
        $customers = new Customers;
        $data = $customers->getCustomerData($id);
        $mail = $data->contact_email;
        break;
    case "attendant":
        $this->load->model('attendants');
        $attendants = new Attendants;
        $data = $attendants->getAttendantData($id);
        $mail = $data->email;
        break;
    }

    $this->load->view('public/notification/new'); 

    $this->load->library('email');

    $this->email->from('info@revierkoenig.de', 'Revierkönig.de');
    $this->email->to($mail); 
    
    $this->email->subject('Kurznachricht von Revierkönig.de');
    $this->email->message($this->input->post('message'));
    
    $this->email->send();

    switch ($site) {
     case "customer":
        redirect('/customer/show/'.$id, 'refresh');
        break;
     case "attendant":
        redirect('/attendant/show/'.$id, 'refresh');
        break;  
    }  
  }

}
?>