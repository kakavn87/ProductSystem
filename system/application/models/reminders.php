<?php
 class Reminders extends CI_Model {

    public function  __construct() {
         parent::__construct();
         $this->properties = array(
             'id' => null,
             'attendant_id' => null,
             'user_id' => null,
             'reminderdate' => null,
             'deleted' => null
         );
     }

    function add($aid) {

      $data = array(
        'attendant_id' => $aid,
      );

      $this->db->insert('reminder', $data); 
    }

    function saveReminder($aid,$reminderdate,$user_id,$priority) {

      $data1 = array(
        'deleted' => '1'
      );

      $this->db->where('attendant_id', $aid);
      $this->db->update('reminder', $data1); 

      $data2 = array(
        'attendant_id' => $aid,
        'reminderdate' => $reminderdate,
        'user_id' => $user_id,
        'priority' => $priority,
        'deleted' => '0'
      );

      $this->db->insert('reminder', $data2); 


    }

    function getReminderDate($aid) {
      $this->db->select('reminderdate');
      $this->db->from('reminder');
      $this->db->where('attendant_id', $aid);
      $query = $this->db->get();
      $result = $query->result();
      $result = $result[0]->reminderdate;
      return($result);
    }

    function getReminder($user_id) {
      $this->db->select('attendants.firstname as firstname, attendants.lastname as lastname, attendants.id as aid, reminder.reminderdate as date,reminder.id as id, reminder.priority as priority');
      $this->db->from('reminder');
      $this->db->where('reminder.user_id', $user_id);
      $this->db->where('reminder.deleted', '0');
      $this->db->where('attendants.deleted', '0');
      $this->db->not_like('reminder.reminderdate', '0000-00-00');
      $this->db->join('attendants', 'attendants.id = reminder.attendant_id');
      $this->db->order_by("reminder.reminderdate", "asc"); 

      $query = $this->db->get();
      $result = $query->result();
      return($result);
    }

    function removeReminder($reminders,$aid) {

      foreach($reminders as $reminder) { 
        $data = array(
          'deleted' => '1',
        );

        $this->db->where('id', $reminder);
        $this->db->where('deleted', '0');
        $this->db->update('reminder', $data); 
      }

    }
     
 }
?>