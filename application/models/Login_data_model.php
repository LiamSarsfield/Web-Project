<?php

class Login_data_model extends CI_Model
{

    function add_login($data)
    {
        if ($this->db->insert("login_data", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_login($id)
    {
//        $id = $this->input->post('id');
        $this->db->where('login_id', $id);
        $this->db->delete('login_data');
    }

    //DEPRECIATED
    function generic_login($data)
    {
        //check customer, supplier, staff
        $this->load->model("Customer_model");
        $this->load->model("Staff");
        if ($this->Customer_model->login($data)) {

        } else if ($this->staff_model->login($data)) {

        } else {
            return false;
        }

    }
}

