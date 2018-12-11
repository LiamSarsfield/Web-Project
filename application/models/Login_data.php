<?php

class Login_data extends CI_Model{
    
    function add_login($data)
    {
        if ($this->db->insert("login_data", $data)) {
            return TRUE;
        }
        else
        {
            return TRUE;
        }
    }
    
    function delete_login($id) { 
                 
//        $id = $this->input->post('id');
                       
        $this->db->where('login_id', $id); 
        $this->db->delete('login_data'); 
              
}
    
}

