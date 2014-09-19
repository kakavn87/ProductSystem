<?php
 class Notice extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'attendants_id' => null,
             'notice' => null
         );
     }

    function add($attendants_id,$customers_id) {
       $date = new DateTime('now');
       $date = $date->format('Y-m-d H:i:s');

       $data['notice']         = $this->input->post('notice');
       $data['attendants_id']  = $attendants_id;
       $data['customers_id']   = $customers_id;
       $data['create_date']    = $date;
       $data['changed_date']   = $date;
       $data['short_name']     = $this->session->userdata('short_name');


       $this->db->insert('notice', $data); 
    }

    function save($id) {
       $date = new DateTime('now');
       $date = $date->format('Y-m-d H:i:s');
      
       $data['notice']         = $this->input->post('notice');
       $data['changed_date']   = $date;

       $this->db->where('id', $id);
       $this->db->update('notice', $data); 
    }

    function getShort($attendants_id, $customers_id) {
      $query = $this->db->query("SELECT 
                                date_format(create_date, '%d.%m.%Y') AS date, 
                                IF(LENGTH(`notice`) > 90, CONCAT(LEFT(`notice`, 90), '...'), `notice`) AS notice,
                                id, short_name FROM notice 
                                  WHERE attendants_id = $attendants_id 
                                  AND customers_id = $customers_id 
                                order by create_date desc");
      $result = $query->result();
      return($result);
    }

    function getLong($id) {
      $this->db->select('notice,id,attendants_id');
      $this->db->from('notice');
      $this->db->where('id', $id);
      $query = $this->db->get();
      $result = $query->result();
      $result = $result[0];
      return($result);
    }

    function removeNotice($notice_id,$customer_id) {
      $this->db->where('id', $notice_id);
      $this->db->where('customers_id', $customer_id);
      $this->db->delete('notice');     
    }

    function removeNoticeAtt($notice_id,$attendants_id) {
      $this->db->where('id', $notice_id);
      $this->db->where('attendants_id', $attendants_id);
      $this->db->delete('notice');     
    }
     
 }
?>