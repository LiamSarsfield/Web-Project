<?php

class Shopping_cart_model extends CI_Model{
    
    public function add_to_cart($data){
               
       if ($this->db->insert("shopping_cart", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
       
   }
   
   public function select_from_cart(){
       
                
       $this->db->select('id, session_id, item_id, quantity, price, date_added, (price * quantity) AS Total');
       $this->db->from('shopping_cart');
       $this->db->where('session_id =', $this->session->session_id);
       $query = $this->db->get();  
       
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
         
   }
   
   public function remove_from_cart ($id){
       
       $this->db->where('id', $id);
       $this->db->delete('shopping_cart');

   }
    
}

