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

    function add_supplier($data)
    {
        if ($this->db->insert("supplier", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function delete_supplier($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('supplier_id', $id); 
        $this->db->delete('supplier'); 
              
}

    function update_supplier($data){
       
       $this->db->where('id', $id);
       $this->db->update('customer', $data); 
   } 
}

