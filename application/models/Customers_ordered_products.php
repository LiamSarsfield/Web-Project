<?php

class Customers_ordered_products extends CI_Model{
    
    function get_all_customers_ordered_products() { 
          
      $this->db->select("order_id, product_id, customer_quote_id, product_quantity");        
      $query = $this->db->get('customers_ordered_products');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_customer_ordered_products_by_id($id){
       
        
//        $id = $this->input->post('order_id');
        
        $this->db->select("order_id, product_id, customer_quote_id, product_quantity");
        $this->db->where("order_id", $id);
        $query = $this->db->get('customers_ordered_products');
        
        
        if ($query->num_rows() > 0) {
            return $query->row(0);
            
        } 
                           
        return false;
                   
}

    function add_customer_ordered_products($data)
    {
        if ($this->db->insert("customers_ordered_products", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function delete_customer_ordered_products($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('order_id', $id); 
        $this->db->delete('customers_ordered_products'); 
              
}
}

