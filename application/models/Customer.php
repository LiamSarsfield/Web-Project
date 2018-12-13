<?php

class Customer extends CI_Model
{

    function get_all_customers()
    {
        $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city, country");
        $query = $this->db->get('customer');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_customer_by_id($id)
    {
        $this->db->select("customer_id, first_name, last_name, email, phone, address1, address2, town, city, country");
        $this->db->where("customer_id", $id);
        $query = $this->db->get('customer');
        if ($query->num_rows() > 0) {
            return $query->row(0);
        }
        return false;
    }

    function add_customer($data)
    {
        if ($this->db->insert("customer", $data)) {
            return TRUE;
        }
        return false;
    }
    function login_customer($data){
        $encrypted_password = $data['password'];
        if(!preg_match('/[A-Fa-f0-9]{64}/', $data['password'])) {
            $encrypted_password = hash("sha256", $encrypted_password);
        }
        $this->db->select("customer_id, email, password");
        $this->db->where("email", $data['email']);
        $this->db->where("password", $encrypted_password);
        $this->db->from("customer");
        $query = $this->db->get();
        $debugger = $this->db->last_query();
        if($query->num_rows() === 0){
            return false;
        } else{
            return $query->first_row()->customer_id;
        }

    }

    function delete_customer($id)
    {

//        $id = $this->input->post('id');

        $this->db->where('customer_id', $id);
        $this->db->delete('customer');

    }


    function update_customer_details($data)
    {
        $this->db->where('id', $id);
        $this->db->update('customer', $data);
    }

}

