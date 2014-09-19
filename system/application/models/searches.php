<?php
 class Searches extends CI_Model {

    public function  __construct() {
         parent::__construct();
     }

    public function get_searchresult($data=false) {

      /****************** COMPANY ********************/

      if(!isset($data['categories'])) {
          $data['categories'][0] = 'none';
      } 

      if(!isset($data['groups'])) {
          $data['groups'][0] = 'none';
      } 

      if(!isset($data['branchs'])) {
          $data['branchs'][0] = 'none';
      }

      // get only company
      if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '' && $data['year'] == '') {

         $this->db->select('id as cid,name,street,town,zip,contact_phone,contact_fax,contact_email');
         $this->db->like('name',$data['companyname']);
         $query = $this->db->get('customers');
      }

      // get company and zipcode
      if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] != '' && $data['location'] == '' && $data['year'] == '') {
         $this->db->select('id as cid,name,street,town,zip as czip,contact_phone,contact_fax,contact_email');
         $this->db->like('zip',$data['zipcode'],'after');
         $this->db->like('name',$data['companyname']);
         $query = $this->db->get('customers');
      }

      // get company and location
      if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] != '' && $data['year'] == '') {
         $this->db->select('id as cid,name,street,town as clocation,zip,contact_phone,contact_fax,contact_email');
         $this->db->like('town',$data['location']);
         $this->db->like('name',$data['companyname']);
         $query = $this->db->get('customers');
      }

      // get year
      if($data['companyname'] == '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '' && $data['year'] != '') {
         $this->db->select('id as cid,name,street,town as clocation,zip,contact_phone,contact_fax,contact_email,year');
         $this->db->like('year',$data['year']);
         $this->db->like('name',$data['companyname']);
         $query = $this->db->get('customers');
      }

      // // get company and products
      // if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] != 'none' &&
      //    $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {

      //    $this->db->select('attendants.id as aid,firstname,lastname,attendants.birth,attendants.street, attendants.town,attendants.plz, attendants.phone, attendants.mobile,attendants.fax,attendants.email, customers.id as cid,customers.name, customers.contact_phone, customers.contact_mobile, customers.contact_fax, customers.contact_email, customers.street, customers.town, customers.zip');
      //    $this->db->join('customers_attendants','attendants.id = customers_attendants.attendants_id','left');
      //    $this->db->join('customers','customers.id = customers_attendants.customer_id','left');
      //    $this->db->join('attendants_products', 'attendants.id = attendants_products.attendants_id','left');
      //    $this->db->join('products', 'attendants_products.products_id = products.id','left');
      //    $this->db->join('categories', 'products.category_id = categories.id','left');

      //    for($i=0; $i <= sizeof($data['categories'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(products.category_id = '".$data['categories'][0]."' AND customers.name LIKE '%".$data['companyname']."%'  )";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(products.category_id = '".$data['categories'][$i]."' AND customers.name LIKE '%".$data['companyname']."%'  )";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    $this->db->distinct();

      //    $query = $this->db->get('attendants');
      //    echo '<pre>';
      //    echo $this->db->last_query();
      //    echo '</pre>';
      // }


      // // get company, product and group 
      // if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] != 'none' &&
      //    $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {

      //    $this->db->select('customers.id as cid,customers.name as name,customers.street,customers.town,customers.contact_phone,customers.contact_fax,customers.contact_email,
      //                       attendants.id as aid,attendants.firstname, attendants.lastname, attendants.birth, attendants.street, attendants.town, attendants.plz, attendants.phone,
      //                       attendants.mobile,attendants.fax,attendants.email, products.name as productname, groups.name as groupname');
        
      //    $this->db->join('customers_attendants','customers.id = customers_attendants.customer_id','left');
      //    $this->db->join('attendants','attendants.id = customers_attendants.attendants_id','left');
      //    $this->db->join('attendants_products', 'attendants.id = attendants_products.attendants_id','left');
      //    $this->db->join('products', 'attendants_products.products_id = products.id','left');

      //    $this->db->join('customers_groups','customers.id = customers_groups.customer_id','left');
      //    $this->db->join('groups', 'customers_groups.groups_id = groups.id','left');
       

      //    for($i=0; $i <= sizeof($data['products'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(attendants_products.products_id = '".$data['categories'][0]."')";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(attendants_products.products_id = '".$data['categories'][$i]."')";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(customers_groups.groups_id = '".$data['groups'][0]."' AND customers.name LIKE '%".$data['companyname']."%'  )";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(customers_groups.groups_id = '".$data['groups'][$i]."'  AND customers.name LIKE '%".$data['companyname']."%'  )";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    $this->db->distinct();

      //    $query = $this->db->get('customers');
      // }


      // // get company and branch

      // if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
      //    $data['groups'][0] == 'none' && $data['branchs'][0] != 'none' && $data['zipcode'] == '' && $data['location'] == '') {
      //    $this->db->select('customers.id as cid,customers.name as name,customers.street,customers.town,customers.zip as czip,contact_phone,contact_fax,contact_email,branchs.name as branchname');
      //    $this->db->join('customers_branchs', 'customers.id = customers_branchs.customer_id','left');
      //    $this->db->join('branchs', 'customers_branchs.branch_id = branchs.id','left');

      //    for($i=0; $i <= sizeof($data['branchs'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(customers_branchs.branch_id = '".$data['branchs'][0]."' AND customers.name LIKE '%".$data['companyname']."%'  )";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(customers_branchs.branch_id = '".$data['branchs'][$i]."' AND customers.name LIKE '%".$data['companyname']."%'  )";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    $this->db->distinct();

      //    $query = $this->db->get('customers');
      // }

      // get only branchs

      if($data['companyname'] == '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] != 'none' && $data['zipcode'] == '' && $data['location'] == '') {
         $this->db->select('customers.id as cid,customers.name as name,customers.street,customers.town,customers.zip as czip,contact_phone,contact_fax,contact_email,branchs.name as branchname');
         $this->db->join('customers_branchs', 'customers.id = customers_branchs.customer_id','left');
         $this->db->join('branchs', 'customers_branchs.branch_id = branchs.id','left');

         for($i=0; $i <= sizeof($data['branchs'])-1; $i++) {
          if ($i==0) {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][0]."' )";
            $this->db->where($where);
          } else {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][$i]."'  )";
            $this->db->or_where($where);
          }
         }

         $this->db->distinct();

         $query = $this->db->get('customers');
      }

      // get only product

      if($data['companyname'] == '' && $data['person'] == '' && $data['categories'][0] != 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {

         $this->db->select('products.id as pid,products.name as name');

         foreach ($data['categories'] as $category) {
          $this->db->where('products.category_id',$category);
         }

         $this->db->distinct();

         $query = $this->db->get('products');

      }

      // get company and groups

      if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {
         $this->db->select(' customers.id as cid,customers.name as name,customers.street,customers.town,customers.zip as czip,contact_phone,contact_fax,contact_email,groups.name as groupname');
         $this->db->join('customers_groups', 'customers.id = customers_groups.customer_id','left');
         $this->db->join('groups', 'customers_groups.groups_id = groups.id','left');

         for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
          if ($i==0) {
            $where = "(customers_groups.groups_id = '".$data['groups'][0]."' )";
            $this->db->where($where);
          } else {
            $where = "(customers_groups.groups_id = '".$data['groups'][$i]."'  )";
            $this->db->or_where($where);
          }
         }

         $this->db->distinct();

         $query = $this->db->get('customers');
      }

      // get only customer groups

      if($data['companyname'] == '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '' && $data['gs'] == 'gc') {

         $this->db->select(' customers.id as cid,customers.name as name,customers.street,customers.town,customers.zip as czip,contact_phone,contact_fax,contact_email, groups.name as groupname');
         $this->db->join('customers_groups', 'customers.id = customers_groups.customer_id','left');
         $this->db->join('groups', 'groups.id = customers_groups.groups_id','left');

         for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
          $this->db->or_where('customers_groups.groups_id',$data['groups'][0]);
         }

         $this->db->distinct();

         $query = $this->db->get('customers');
      }


      // get branchs and zipcode

      if($data['companyname'] == '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] != 'none' && $data['zipcode'] != '' && $data['location'] == '') {

         $this->db->select(' customers.id as cid,customers.name as name,customers.street,customers.town,customers.zip as czip,contact_phone,contact_fax,contact_email, branchs.name as branchname');
         $this->db->join('customers_branchs', 'customers.id = customers_branchs.customer_id','left');
         $this->db->join('branchs', 'branchs.id = customers_branchs.branch_id','left');

         $this->db->like('customers.zip',$data['zipcode'],'after');

         for($i=0; $i <= sizeof($data['branchs'])-1; $i++) {
          if ($i==0) {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][0]."')";
            $this->db->where($where);
          } else {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][$i]."')";
            $this->db->or_where($where);
          }
         }

         $this->db->distinct();

         $query = $this->db->get('customers');
      }

      // get branchs and location

      if($data['companyname'] == '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] != 'none' && $data['zipcode'] == '' && $data['location'] != '') {

         $this->db->select(' customers.id as cid,customers.name as name,customers.street,customers.town,customers.zip as czip,contact_phone,contact_fax,contact_email, branchs.name as branchname');
         $this->db->join('customers_branchs', 'customers.id = customers_branchs.customer_id','left');
         $this->db->join('branchs', 'branchs.id = customers_branchs.branch_id','left');

         $this->db->like('customers.town',$data['location']);

         for($i=0; $i <= sizeof($data['branchs'])-1; $i++) {
          if ($i==0) {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][0]."')";
            $this->db->where($where);
          } else {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][$i]."')";
            $this->db->or_where($where);
          }
         }

         $this->db->distinct();

         $query = $this->db->get('customers');
      }

      // get branchs,customer and zipcode

      if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] != 'none' && $data['zipcode'] != '' && $data['location'] == '') {

         $this->db->select(' customers.id as cid,customers.name as name,customers.street,customers.town,customers.zip as czip,contact_phone,contact_fax,contact_email, branchs.name as branchname');
         $this->db->join('customers_branchs', 'customers.id = customers_branchs.customer_id','left');
         $this->db->join('branchs', 'branchs.id = customers_branchs.branch_id','left');


         for($i=0; $i <= sizeof($data['branchs'])-1; $i++) {
          if ($i==0) {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][0]."' AND customers.name LIKE '%".$data['companyname']."%' AND customers.zip LIKE '".$data['zipcode']."%' )";
            $this->db->where($where);
          } else {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][$i]."'  AND customers.name LIKE '%".$data['companyname']."%' AND customers.zip LIKE '".$data['zipcode']."%'  )";
            $this->db->or_where($where);
          }
         }

         $this->db->distinct();

         $query = $this->db->get('customers');
      }

      // get branchs,customer and location

      if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] != 'none' && $data['zipcode'] == '' && $data['location'] != '') {

         $this->db->select(' customers.id as cid,customers.name as name,customers.street,customers.town as clocation,customers.zip as czip,contact_phone,contact_fax,contact_email, branchs.name as branchname');
         $this->db->join('customers_branchs', 'customers.id = customers_branchs.customer_id','left');
         $this->db->join('branchs', 'branchs.id = customers_branchs.branch_id','left');


         for($i=0; $i <= sizeof($data['branchs'])-1; $i++) {
          if ($i==0) {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][0]."' AND customers.name LIKE '%".$data['companyname']."%' AND customers.town LIKE '%".$data['location']."%' )";
            $this->db->where($where);
          } else {
            $where = "(customers_branchs.branch_id = '".$data['branchs'][$i]."'  AND customers.name LIKE '%".$data['companyname']."%' AND customers.town LIKE '%".$data['location']."%'  )";
            $this->db->or_where($where);
          }
         }

         $this->db->distinct();

         $query = $this->db->get('customers');
      }

      // get groups,customer and location

      if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] != '' && $data['location'] == '') {

         $this->db->select('customers.id as cid,customers.name as name,customers.street,customers.town as clocation,customers.zip as czip,contact_phone,contact_fax,contact_email, groups.name as groupname');
         $this->db->join('customers_groups', 'customers.id = customers_groups.customer_id','left');
         $this->db->join('groups', 'groups.id = customers_groups.groups_id','left');


         for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
          if ($i==0) {
            $where = "(customers_groups.groups_id = '".$data['groups'][0]."' AND customers.name LIKE '%".$data['companyname']."%' AND customers.zip LIKE '".$data['zipcode']."%' )";
            $this->db->where($where);
          } else {
            $where = "(customers_groups.groups_id = '".$data['groups'][$i]."'  AND customers.name LIKE '%".$data['companyname']."%' AND customers.zip LIKE '".$data['zipcode']."%'  )";
            $this->db->or_where($where);
          }
         }

         $this->db->distinct();

         $query = $this->db->get('customers');
      }

      // get groups,customer and location

      if($data['companyname'] != '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] != '') {

         $this->db->select('customers.id as cid,customers.name as name,customers.street,customers.town as clocation,customers.zip as czip,contact_phone,contact_fax,contact_email, groups.name as groupname');
         $this->db->join('customers_groups', 'customers.id = customers_groups.customer_id','left');
         $this->db->join('groups', 'groups.id = customers_groups.groups_id','left');


         for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
          if ($i==0) {
            $where = "(customers_groups.groups_id = '".$data['groups'][0]."' AND customers.name LIKE '%".$data['companyname']."%' AND customers.town LIKE '%".$data['location']."%' )";
            $this->db->where($where);
          } else {
            $where = "(customers_groups.groups_id = '".$data['groups'][$i]."'  AND customers.name LIKE '%".$data['companyname']."%' AND customers.town LIKE '%".$data['location']."%'  )";
            $this->db->or_where($where);
          }
         }

         $this->db->distinct();

         $query = $this->db->get('customers');
      }





























      /****************** PERSON ********************/

      // get only person
      if($data['companyname'] == '' && $data['person'] != '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {

         $this->db->select('attendants.id as aid,title,gender,firstname,lastname,birth,street,town,plz,phone,mobile,fax,email');
         $this->db->like('firstname',$data['person']);
         $this->db->or_like('lastname',$data['person']);
         $query = $this->db->get('attendants');
      }

      // get only zipcode
      if($data['companyname'] == '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] != '' && $data['location'] == '') {
         
         $this->db->select('attendants.id as aid, attendants.plz as azipcode, attendants.title, attendants.gender,attendants.firstname,attendants.lastname, attendants.birth, attendants.street,
                            attendants.town, attendants.plz,attendants.phone,attendants.mobile,attendants.fax,attendants.email, 
                            customers_attendants.customer_id as cid, customers.name,customers.contact_phone,customers.contact_mobile,customers.contact_fax,
                            customers.contact_email,customers.street,customers.town,customers.zip as czipcode');
         $this->db->from('attendants');
         $this->db->join('customers_attendants', 'attendants.id = customers_attendants.attendants_id','left');
         $this->db->join('customers', 'customers.id = customers_attendants.customer_id','left');
         $this->db->like('attendants.plz',$data['zipcode'],'after');
         $this->db->like('customers.zip',$data['zipcode'],'after');
         $query = $this->db->get();
      }

      // get person and company
      if($data['companyname'] != '' && $data['person'] != '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {

         $this->db->select('attendants.id as aid, attendants.plz as azipcode,attendants.title, attendants.gender, attendants.firstname,attendants.lastname, attendants.birth, attendants.street,
                            attendants.town, attendants.plz,attendants.phone,attendants.mobile,attendants.fax,attendants.email, 
                            customers.id as cid, customers.name,customers.contact_phone,customers.contact_mobile,customers.contact_fax,
                            customers.contact_email,customers.street,customers.town,customers.zip as czipcode');
         $this->db->from('attendants');
         $this->db->join('customers_attendants', 'attendants.id = customers_attendants.attendants_id','left');
         $this->db->join('customers', 'customers.id = customers_attendants.customer_id','left');
         $this->db->like('customers.name',$data['companyname']);
         $this->db->like('firstname',$data['person']);
         $this->db->or_like('lastname',$data['person']);
         $query = $this->db->get();

      }

      // get person and zipcode
      if($data['companyname'] == '' && $data['person'] != '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] != '' && $data['location'] == '') {
         $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town,plz as aplz,phone,mobile,fax,email');
         $this->db->like('plz',$data['zipcode'],'after');
         $this->db->like('firstname',$data['person']);
         $this->db->or_like('lastname',$data['person']);
         $query = $this->db->get('attendants');
      }

      // get person and location
      if($data['companyname'] == '' && $data['person'] != '' && $data['categories'][0] == 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] != '') {
         $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town as alocation,plz,phone,mobile,fax,email');
         $this->db->like('town',$data['location']);
         $this->db->like('firstname',$data['person']);
         $this->db->or_like('lastname',$data['person']);
         $query = $this->db->get('attendants');
      }

      // // get person and products
      // if($data['companyname'] == '' && $data['person'] != '' && $data['categories'][0] != 'none' &&
      //    $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {

      //    $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town,plz,phone,mobile,fax,email,products.name');
      //    $this->db->join('attendants_products', 'attendants.id = attendants_products.attendants_id','left');
      //    $this->db->where('attendants.id','attendants_products.attendants_id');

      //    for($i=0; $i <= sizeof($data['products'])-1; $i++) {
      //     if ($i==0) {
      //       $this->db->where('attendants_products.products_id',$data['products'][0]);
      //     } else {
      //       $this->db->or_where('attendants_products.products_id',$data['products'][$i]);
      //     }
      //    }

      //    $this->db->like('firstname',$data['person']);
      //    $this->db->or_like('lastname',$data['person']);
      //    $this->db->distinct();

      //    $query = $this->db->get('attendants');
      // }

      // get only products
      // if($data['companyname'] == '' && $data['person'] == '' && $data['products'][0] != 'none' &&
      //    $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {

      //    $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town,plz,phone,mobile,fax,email, products.name as productname');
      //    $this->db->join('attendants_products', 'attendants.id = attendants_products.attendants_id','left');
      //    $this->db->join('products', 'products.id = attendants_products.products_id','left');
      //    $this->db->where('attendants.id','attendants_products.attendants_id');

      //    for($i=0; $i <= sizeof($data['products'])-1; $i++) {
      //     $this->db->or_where('attendants_products.products_id',$data['products'][0]);
      //    }

      //    $this->db->distinct();

      //    $query = $this->db->get('attendants');
      // }


      // get person and groups

      // if($data['companyname'] == '' && $data['person'] != '' && $data['products'][0] == 'none' &&
      //    $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {
      //    $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town,plz,phone,mobile,fax,email,groups.name as groupname');
      //    $this->db->join('attendants_groups', 'attendants.id = attendants_groups.attendants_id','left');
      //    $this->db->join('groups', 'attendants_groups.groups_id = groups.id','left');

      //    for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(attendants_groups.groups_id = '".$data['groups'][0]."' AND attendants.firstname LIKE '%".$data['person']."%' OR attendants.lastname LIKE '%".$data['person']."%' )";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(attendants_groups.groups_id = '".$data['groups'][$i]."' AND attendants.firstname LIKE '%".$data['person']."%' OR attendants.lastname LIKE '%".$data['person']."%'  )";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    $this->db->distinct();

      //    $query = $this->db->get('attendants');
      // }

      // // get person, groups and zipcode

      // if($data['companyname'] == '' && $data['person'] != '' && $data['products'][0] == 'none' &&
      //    $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] != '' && $data['location'] == '') {
      //    $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town,plz,phone,mobile,fax,email,groups.name as groupname');
      //    $this->db->join('attendants_groups', 'attendants.id = attendants_groups.attendants_id','left');
      //    $this->db->join('groups', 'attendants_groups.groups_id = groups.id','left');

      //    for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(attendants_groups.groups_id = '".$data['groups'][0]."' AND attendants.plz LIKE '".$data['zipcode']."%' AND attendants.firstname LIKE '%".$data['person']."%' OR attendants.lastname LIKE '%".$data['person']."%' )";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(attendants_groups.groups_id = '".$data['groups'][$i]."' AND attendants.plz LIKE '".$data['zipcode']."%' AND attendants.firstname LIKE '%".$data['person']."%' OR attendants.lastname LIKE '%".$data['person']."%'  )";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    $this->db->distinct();

      //    $query = $this->db->get('attendants');
      // }


      // // get person, groups and location

      // if($data['companyname'] == '' && $data['person'] != '' && $data['products'][0] == 'none' &&
      //    $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] != '') {
      //    $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town,plz,phone,mobile,fax,email,groups.name as groupname');
      //    $this->db->join('attendants_groups', 'attendants.id = attendants_groups.attendants_id','left');
      //    $this->db->join('groups', 'attendants_groups.groups_id = groups.id','left');

      //    for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(attendants_groups.groups_id = '".$data['groups'][0]."' AND attendants.town LIKE '%".$data['location']."%' AND attendants.firstname LIKE '%".$data['person']."%' OR attendants.lastname LIKE '%".$data['person']."%' )";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(attendants_groups.groups_id = '".$data['groups'][$i]."' AND attendants.town LIKE '%".$data['location']."%' AND attendants.firstname LIKE '%".$data['person']."%' OR attendants.lastname LIKE '%".$data['person']."%'  )";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    $this->db->distinct();

      //    $query = $this->db->get('attendants');
      // }



      // // get person, product and group 
      // if($data['companyname'] == '' && $data['person'] != '' && $data['products'][0] != 'none' &&
      //    $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {

      //    $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town,plz,phone,mobile,fax,email, products.name as productname, groups.name as groupname');
      //    $this->db->join('attendants_products', 'attendants.id = attendants_products.attendants_id','left');
      //    $this->db->join('products', 'attendants_products.products_id = products.id','left');

      //    $this->db->join('attendants_groups','attendants.id = attendants_groups.attendants_id','left');
      //    $this->db->join('groups', 'attendants_groups.groups_id = groups.id','left');
       

      //    for($i=0; $i <= sizeof($data['products'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(attendants_products.products_id = '".$data['products'][0]."')";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(attendants_products.products_id = '".$data['products'][$i]."')";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(attendants_groups.groups_id = '".$data['groups'][0]."' AND attendants.firstname LIKE '%".$data['person']."%' OR attendants.lastname LIKE '%".$data['person']."%'  )";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(attendants_groups.groups_id = '".$data['groups'][0]."' AND attendants.firstname LIKE '%".$data['person']."%' OR attendants.lastname LIKE '%".$data['person']."%' )";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    $this->db->distinct();

      //    $query = $this->db->get('attendants');
      // }


      // get only persons groups

      if($data['companyname'] == '' && $data['person'] == '' &&
         $data['groups'][0] != 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == ''  && $data['gs'] == 'gp') {

         $this->db->distinct();

         $this->db->select('attendants.id as aid, attendants.title, attendants.gender,attendants.firstname,attendants.lastname,attendants.birth,attendants.street,attendants.town,attendants.plz,attendants.phone,attendants.mobile,attendants.fax,attendants.email, groups.name as groupname, customers.name as customername');
         $this->db->join('attendants_groups', 'attendants.id = attendants_groups.attendants_id','left');
         $this->db->join('groups', 'groups.id = attendants_groups.groups_id','left');
         $this->db->join('customers_attendants', 'attendants.id = customers_attendants.attendants_id','left');
         $this->db->join('customers', 'customers.id = customers_attendants.customer_id','left');
         $this->db->where('attendants.deleted','0');

         for($i=0; $i <= sizeof($data['groups'])-1; $i++) {
          $this->db->where('attendants_groups.groups_id',$data['groups'][0]);
         }

         $query = $this->db->get('attendants');
 
      }

      //get products and zipcode

      if($data['companyname'] == '' && $data['person'] == '' && $data['categories'][0] != 'none' &&
         $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] != '' && $data['location'] == '') {

         $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town,plz,phone,mobile,fax,email, products.name as productname');
         $this->db->join('attendants_products', 'attendants.id = attendants_products.attendants_id','left');
         $this->db->join('products', 'products.id = attendants_products.products_id','left');
         $this->db->join('categories', 'products.id = categories.product_id','left');

         $this->db->like('attendants.plz',$data['zipcode'],'after');

         for($i=0; $i <= sizeof($data['products'])-1; $i++) {
          if ($i==0) {
            $where = "(products.category_id = '".$data['categories'][0]."')";
            $this->db->where($where);
          } else {
            $where = "(products.category_id = '".$data['categories'][$i]."')";
            $this->db->or_where($where);
          }
         }

         $this->db->distinct();

         $query = $this->db->get('attendants');
      }


      // // get customers without branchs

      //  if($data['companyname'] == '' && $data['person'] == '' && $data['categories'][0] == 'none' &&
      //    $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] == '') {

      //    print_r('yo');

      //    $this->db->select('customers.id as cid,customers.name as name,customers.street,customers.town as clocation,customers.zip as czip,contact_phone,contact_fax,contact_email');
      //    $this->db->join('customers_branchs', 'customers.id = customers_branchs.customer_id','left');
      //    $this->db->where('customers.id != customers_branchs.customer_id');
      //    $this->db->distinct();

      //    $query = $this->db->get('customers');
      // }

      // // get products and location

      // if($data['companyname'] == '' && $data['person'] == '' && $data['products'][0] != 'none' &&
      //    $data['groups'][0] == 'none' && $data['branchs'][0] == 'none' && $data['zipcode'] == '' && $data['location'] != '') {

      //    $this->db->select('attendants.id as aid,firstname,lastname,birth,street,town,plz,phone,mobile,fax,email, products.name as productname');
      //    $this->db->join('attendants_products', 'attendants.id = attendants_products.attendants_id','left');
      //    $this->db->join('products', 'products.id = attendants_products.products_id','left');

      //    $this->db->like('attendants.town',$data['location']);

      //    for($i=0; $i <= sizeof($data['products'])-1; $i++) {
      //     if ($i==0) {
      //       $where = "(attendants_products.products_id = '".$data['products'][0]."')";
      //       $this->db->where($where);
      //     } else {
      //       $where = "(attendants_products.products_id = '".$data['products'][$i]."')";
      //       $this->db->or_where($where);
      //     }
      //    }

      //    $this->db->distinct();

      //    $query = $this->db->get('attendants');
      // }





      // print '<pre>';
      // print $this->db->last_query();
      // print '</pre>';

      if (isset($query)) {
        $result = $query->result_array();  
      } else {
        $result = '0';
      }

      return($result);


    }
     
 }
?>