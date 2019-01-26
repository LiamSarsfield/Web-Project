<?php

class Customer_order_model extends CI_Model{
    
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

    function add_customer_order($data)
    {
        if ($this->db->insert("customer_order", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    
    function delete_customer_order($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('order_id', $id); 
        $this->db->delete('customer_order'); 
              
}
}
