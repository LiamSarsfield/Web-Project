<?php

class Customer extends CI_Model{
    
    function get_all_customers() { 
          
      $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city, country");        
      $query = $this->db->get('customer');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_customer_by_id($id){
       
        
//        $id = $this->input->post('supplier_id');
        
        $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city, country");
        $this->db->where("customer_id", $id);
        $query = $this->db->get('customer');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}
    
}

