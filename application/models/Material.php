<?php

class MWE_model extends CI_Model{
    
    function get_all_materials() { 
          
      $this->db->select("material_id, supplier_id, material_name, description, material_price");        
      $query = $this->db->get('material');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_material_by_id($id){
       
        
//        $id = $this->input->post('material_id');
        
        $this->db->select("material_id, supplier_id, material_name, description, material_price");
        $this->db->where("material_id", $id);
        $query = $this->db->get('material');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}

    function add_material($data)
    {
        if ($this->db->insert("material", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function delete_material($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('material_id', $id); 
        $this->db->delete('material'); 
              
}

    function update_material($data){
       
       $this->db->where('id', $id);
       $this->db->update('material', $data); 
   } 
    
}

