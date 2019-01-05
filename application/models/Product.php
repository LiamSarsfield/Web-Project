<?php

class Product extends CI_Model{
    
    function get_all_products() { 
          
      $this->db->select("product_id, product_name, product_desc, product_price");
      $query = $this->db->get('product');        
      
      if ($query->num_rows() > 0) {
             
//            return $query->result_array();
            return $query;
            
         } else {
            return FALSE;
         }
}

    function get_product_by_id($id){
       
        
//        $id = $this->input->post('product_id');
        
        $this->db->select("product_id, product_name, product_desc, product_price");
        $this->db->where("product_id", $id);
        $query = $this->db->get('product');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}

    function add_product($data)
    {
        if ($this->db->insert("product", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function delete_product($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('product_id', $id); 
        $this->db->delete('product'); 
              
}

    function update_customer_details($data){
       
       $this->db->where('id', $id);
       $this->db->update('product', $data); 
   } 
    
}

