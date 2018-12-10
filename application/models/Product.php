<?php

class Product extends CI_Model{
    
    function get_all_products() { 
          
      $this->db->select("product_id, product_name, product_desc, product_price");        
      $query = $this->db->get('product');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_product_by_id($id){
       
        
//        $id = $this->input->post('supplier_id');
        
        $this->db->select("product_id, product_name, product_desc, product_price");
        $this->db->where("product_id", $id);
        $query = $this->db->get('product');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
         
            
           
}
    
}

