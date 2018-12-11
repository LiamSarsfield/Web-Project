<?php

class Product_materials extends CI_Model{
    
    function get_all_product_materials() { 
          
      $this->db->select("product_product_id, material_material_id");        
      $query = $this->db->get('product_material');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_product_materials_by_id($id){
       
        
//        $id = $this->input->post('product_product_id');
        
        $this->db->select("product_product_id, material_material_id");
        $this->db->where("product_product_id", $id);
        $query = $this->db->get('product_material');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}
    
}

