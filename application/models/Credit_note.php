<?php

class Credit_note extends CI_Model{
    
    function get_all_credit_notes() { 
          
      $this->db->select("credit_note_id, customers_id, amount, reason");        
      $query = $this->db->get('credit_note');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_credit_note_by_id($id){
       
        
//        $id = $this->input->post('credit_note_id');
        
        $this->db->select("credit_note_id, customers_id, amount, reason");
        $this->db->where("credit_note_id", $id);
        $query = $this->db->get('credit_note');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}

    function add_credit_note($data)
    {
        if ($this->db->insert("credit_note", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function delete_credit_note($id) { 
                
//        $id = $this->input->post('id');
                       
        $this->db->where('credit_note_id', $id); 
        $this->db->delete('credit_note'); 
              
}
    
}

