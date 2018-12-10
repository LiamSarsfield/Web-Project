<?php

class Supplier extends CI_Model{
    
    function get_all_suppliers() { 
          
      $this->db->select("supplier_id, name, address1, address2, town, city, phone, country");        
      $query = $this->db->get('supplier');        
      
      if ($query->num_rows() > 0) {
             
            return $query->result_array();
            
         } else {
            return FALSE;
         }
}

    function get_supplier_by_id($id){
       
        
//        $id = $this->input->post('supplier_id');
        
        $this->db->select("supplier_id, name, address1, address2, town, city, phone, country");
        $this->db->where("supplier_id", $id);
        $query = $this->db->get('supplier');
        
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $supplier) {
                $supplier_id = $supplier->supplier_id;
                $name = $supplier->name;
                $address1 = $supplier->address1;
                $address2 = $supplier->address2;
                $town = $supplier->town;
                $city = $supplier->city;
                $phone = $supplier->phone;
                $country = $supplier->country;

            }           
            
            
            $data['data_array'] = array(
             'supplier_id' => $supplier_id,   
             'name' => $name,
             'address1' => $address1,
             'address2' => $address2,
             'town' => $town,
             'city' => $city,
             'phone' => $phone,
             'country' => $country               
             );
            
        } 
        
        else             
            {           
               
            }
            
          return $data;  
}
}

