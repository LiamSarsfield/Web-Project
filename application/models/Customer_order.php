<?php

class Customer_order extends CI_Model{
    
    function get_all_orders() { 
          
      $this->db->select("order_id, order_date, last_name, total_price, customer_id, customer_invoice_id, credit_note_id");        
      $query = $this->db->get('customer_order');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_order_by_id($id){
       
        
//        $id = $this->input->post('order_id');
        
        $this->db->select("order_id, order_date, total_price, customer_id, customer_invoice_id, credit_note_id");
        $this->db->where("order_id", $id);
        $query = $this->db->get('customer_order');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}
}
