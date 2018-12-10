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
       
        
//        $id = $this->input->post('supplier_id');
        
        $this->db->select("order_id, order_date, total_price, customer_id, customer_invoice_id, credit_note_id");
        $this->db->where("order_id", $id);
        $query = $this->db->get('customer_order');
        
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $order) {
                $order_id = $order->order_id;
                $order_date = $order->order_date;
                $total_price = $order->total_price;
                $customer_id = $order->customer_id;
                $customer_invoice_id = $order->customer_invoice_id;
                $credit_note_id = $order->credit_note_id;
                
            }           
            
            
            $data['data_array'] = array(
             'order_id' => $order_id,   
             'order_date' => $order_date,
             'total_price' => $total_price,
             'customer_id' => $customer_id,
             'customer_invoice_id' => $customer_invoice_id,
             'credit_note_id' => $credit_note_id
                        
             );
            
        } 
        
        else             
            {           
               
            }
            
          return $data;  
}
}
