<?php

class Staff extends CI_Model{
    
    function get_all_staff() { 
          
      $this->db->select("staff_id, first_name, last_name, dob, hired_date, left_date, position, phone, address1, address2, town, city");        
      $query = $this->db->get('staff');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_staff_by_id($id){
       
        
//        $id = $this->input->post('supplier_id');
        
        $this->db->select("staff_id, first_name, last_name, dob, hired_date, left_date, position, phone, address1, address2, town, city");
        $this->db->where("staff_id", $id);
        $query = $this->db->get('staff');
        
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $staff) {
                $staff_id = $staff->staff_id;
                $first_name = $staff->first_name;
                $last_name = $staff->last_name;
                $dob = $staff->dob;
                $hired_date = $staff->hired_date;
                $left_date = $staff->left_date;
                $position = $staff->position;
                $phone = $staff->phone;
                $address1 = $staff->address1;
                $address2 = $staff->address2;
                $town = $staff->town;
                $city = $staff->city;
                
            }           
            
            
            $data['data_array'] = array(
             'staff_id' => $staff_id,   
             'first_name' => $first_name,
             'last_name' => $last_name,
             'dob' => $dob,
             'hired_date' => $hired_date,
             'left_date' => $left_date,
             'position' => $position,
             'phone' => $phone,   
             'address1' => $address1,
             'address2' => $address2,
             'town' => $town,
             'city' => $city,            
             'country' => $country               
             );
            
        } 
        
        else             
            {           
               
            }
            
          return $data;  
}
}

