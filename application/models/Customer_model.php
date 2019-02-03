<?php

class Customer_model extends CI_Model{
    
//    function get_all_customers() { 
//          
//      $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city, country");        
//      $query = $this->db->get('customer');        
//      
//      if ($query->num_rows() > 0) {
//             
//            return $query->result_array();
//            
//         } else {
//            return FALSE;
//         }
//}

    function get_customer_by_id($id){
       
        
//        $id = $this->input->post('customer_id');
        
        $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city, country");
        $this->db->where("customer_id", $id);
        $query = $this->db->get('customer');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
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
    
    
    function delete_customer($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('customer_id', $id); 
        $this->db->delete('customer'); 
              
}


    function update_customer_details($data){
       
       $this->db->where('id', $id);
       $this->db->update('customer', $data); 
   } 
    
}

