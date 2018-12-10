<?php

class Customer extends CI_Model{
    
    function get_all_customers() { 
          
      $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city, country");        
      $query = $this->db->get('customer');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_customer_by_id($id){
       
        
//        $id = $this->input->post('supplier_id');
        
        $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city, country");
        $this->db->where("customer_id", $id);
        $query = $this->db->get('customer');
        
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $customer) {
                $customer_id = $customer->customer_id;
                $first_name = $customer->first_name;
                $last_name = $customer->last_name;
                $email = $customer->email;
                $phone = $customer->phone;
                $address1 = $customer->address1;
                $address2 = $customer->address2;
                $town = $customer->town;
                $city = $customer->city;
                $country = $customer->country;

            }           
            
            
            $data['data_array'] = array(
             'customer_id' => $customer_id,   
             'first_name' => $first_name,
             'last_name' => $last_name,
             'email' => $email,
             'phone' => $phone,   
             'address1' => $address1,
             'address2' => $address2,
             'town' => $town,
             'city' => $city,            
             'country' => $country               
             );
            
        } 
        
        else             
            {           
               
            }
            
          return $data;  
}
    
}

