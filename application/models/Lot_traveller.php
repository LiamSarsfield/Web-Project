<?php

class Lot_traveller extends CI_Model{
    
    function get_all_lot_travellers() { 
          
      $this->db->select("lot_traveller_id, product_id, status");        
      $query = $this->db->get('lot_traveller');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_lot_traveller_by_id($id){
       
        
//        $id = $this->input->post('lot_traveller_id');
        
        $this->db->select("lot_traveller_id, product_id, status");
        $this->db->where("lot_traveller_id", $id);
        $query = $this->db->get('lot_traveller');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}

    function add_lot_traveller($data)
    {
        if ($this->db->insert("lot_traveller", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function delete_lot_traveller($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('lot_traveller_id', $id); 
        $this->db->delete('lot_traveller'); 
              
}
    
}
