<?php

class Customer_quote extends CI_Model{
    
    function get_all_customer_quotes() { 
          
      $this->db->select("customer_quote_id, name, description, price");        
      $query = $this->db->get('customer_quote');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_customer_quote_by_id($id){
       
        
//        $id = $this->input->post('customer_quote_id');
        
        $this->db->select("customer_quote_id, name, description, price");
        $this->db->where("customer_quote_id", $id);
        $query = $this->db->get('customer_quote');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}
}
