<?php

class Supplier extends CI_Model{
    
    function get_all_suppliers() { 
          
      $this->db->select("supplier_id, name, address1, address2, town, city, phone, country");        
      $query = $this->db->get('supplier');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_supplier_by_id($id){
       
        
//        $id = $this->input->post('supplier_id');
        
        $this->db->select("supplier_id, name, address1, address2, town, city, phone, country");
        $this->db->where("supplier_id", $id);
        $query = $this->db->get('supplier');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}
}

