<?php

class Admin_model extends CI_Model{
    
    function add_admin($data)
    {
        if ($this->db->insert("admin", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function delete_admin($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('admin_id', $id); 
        $this->db->delete('admin'); 
              
}
    
}

