<?php

class Upload extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    if($this->session->userdata('logged') != 'yes') {
     redirect('/login', 'refresh');
    } 
  }


  function start($path,$id)
  {
    $viewData['error'] = "";
    $viewData['path'] = $path;
    $viewData['id'] = $id;
    $this->load->view('public/upload/form',$viewData);
  }

  function do_upload($path,$id) {

    $config['upload_path'] = './uploads/images/'.$path;
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '200';
    $config['max_width']  = '210';
    $config['max_height']  = '400';
    $config['file_name']  = $id.'_avatar';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload())
    {
      $error = array('error' => $this->upload->display_errors());
      redirect('/'.$path.'/show/'.$id, 'refresh');
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());
      $file = $data['upload_data']['file_name'];
      redirect('/'.$path.'/addFile/'.$id.'/'.$file, 'refresh');
    }
  }
}
?>