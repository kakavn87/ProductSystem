<?php

class Search extends CI_Controller {

  protected $navstate;

  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->navstate = 'search';
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }

  public function show() {

    $this->load->model('categories');
    $categories = new Categories;

    $this->load->model('groups');
    $groups = new Groups;

    $this->load->model('branchs');
    $branchs = new Branchs;

    $viewdata['categories'] = $categories->getNames();
    $viewdata['groups']   = $groups->getNames();
    $viewdata['branchs']  = $branchs->getNames();
    $viewdata['navstate'] = $this->navstate; 

    $this->load->view('public/search/overview',$viewdata); 
  }

  public function result() {
    $this->load->model('searches');
    $searches = new Searches;
    $dataArray = $this->input->post();

    $viewdata['data'] = $searches->get_searchresult($dataArray);
    $viewdata['navstate'] = $this->navstate; 

    $i = 0;


    if($viewdata['data'] != 0) {

      foreach ($viewdata['data'] as $record) { 

        $record = (object)$record;

        if(isset($record->pid)) {
          $viewdata['linkProduct'][$i] = 'onclick="document.location.href = \''.base_url().'product/show/'.$record->pid .'\'"';
        }

        if(isset($record->firstname) || isset($record->lastname)) {
          $viewdata['linkAttendant'][$i] = 'onclick="document.location.href = \''.base_url().'attendant/show/'.$record->aid .'\'"';
        } 
        if(isset($record->name) && isset($record->cid)) {
          $viewdata['linkCustomer'][$i] = 'onclick="document.location.href = \''.base_url().'customer/show/'.$record->cid .'\'"';
        } 

        $i++;
      }

    }

    $viewdata['searchstring'] = $dataArray;
    $viewdata['filename'] = $this->exportAsCsv($viewdata['data']);
    $viewData['navstate'] = $this->navstate; 
    $this->load->view('public/search/result',$viewdata); 
  }

  public function exportAsCsv($data) {

    if($data!='0') {
      $filename = date('Ymd_his') . '.csv';
      $fp = fopen('csv/'.$filename, 'w');
      
      foreach ($data as $fields) {
          fputcsv($fp, $fields);
      }
      
      fclose($fp);
      return $filename;
    }
  }

  public function product(){
    $this->load->model('products');
     $products = new Products;
     $products->getNames();
     echo json_encode($products->getNames());
     //print_r($products);
     //redirect('/product/show/'.$id, 'refresh');
  }

  public function customer(){
    $this->load->model('customers');
   $customers = new Customers;
   $customers->getNames();
   echo json_encode($customers->getNames());
   
  }

  public function attendant(){
    $this->load->model('attendants');
   $attendants = new Attendants;
   $attendants->getNames();
   echo json_encode($attendants->getNames());
   
  }

  public function branch(){
   $this->load->model('branchs');
   $branchs = new Branchs;
   $branchs->getNames();
   echo json_encode($branchs->getNames());
   
  }

  public function group(){
    $this->load->model('groups');
   $groups = new Groups;
   $groups->getNames();
   echo json_encode($groups->getNames());
   
  }  

}
?>