<?php

class Supplier_order extends CI_Model{
    
    function get_all_supplier_orders() { 
          
      $this->db->select("order_id, supplier_id, order_date, quantity, status");        
      $query = $this->db->get('supplier_order');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_supplier_order_by_id($id){
       
        
//        $id = $this->input->post('order_id');
        
        $this->db->select("order_id, supplier_id, order_date, quantity, status");
        $this->db->where("order_id", $id);
        $query = $this->db->get('supplier_order');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}
    
}

