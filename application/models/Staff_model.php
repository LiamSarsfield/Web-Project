<?php

class Staff_model extends CI_Model{
    
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
       
        
//        $id = $this->input->post('staff_id');
        
        $this->db->select("staff_id, first_name, last_name, dob, hired_date, left_date, position, phone, address1, address2, town, city");
        $this->db->where("staff_id", $id);
        $query = $this->db->get('staff');
        
        
       if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}

    function add_staff($data)
    {
        if ($this->db->insert("staff", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function delete_staff($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('staff_id', $id); 
        $this->db->delete('staff'); 
              
}

    function update_staff($id){
       
       $this->db->where('id', $id);
       $this->db->update('staff', $data); 
   }
   
   function get_all_customers() { 
          
      $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city");        
      $query = $this->db->get('customer');        
      
      if ($query->num_rows() > 0) {
             
            return $query;
            
         } else {
            return FALSE;
         }
}

    public function get_customer_by_id($id) {
        
      $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city");
      $this->db->where("customer_id", $id);
      $query = $this->db->get('customer'); 
      
      if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
        else{
            
            return false;
        
        } 
    }
   
   function add_customer($data)
    {
        if ($this->db->insert("customer", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    

    function update_customer($customer_id, $data){
              
       $this->db->where('customer_id', $customer_id);
       $this->db->update('customer', $data); 
   }
   
   
   function delete_customer($id) { 
                                       
        $this->db->where('customer_id', $id); 
        $this->db->delete('customer'); 
              
}
}

