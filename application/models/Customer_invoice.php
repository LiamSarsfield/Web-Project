<?php

class Customer_invoice extends CI_Model{
    
    function get_all_customer_invoices() { 
          
      $this->db->select("invoice_id, customer_id, order_number, quantity, price");        
      $query = $this->db->get('customer_invoice');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_supplier_order_by_id($id){
       
        
//        $id = $this->input->post('invoice_id');
        
        $this->db->select("invoice_id, customer_id, order_number, quantity, price");
        $this->db->where("invoice_id", $id);
        $query = $this->db->get('customer_invoice');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}
}
