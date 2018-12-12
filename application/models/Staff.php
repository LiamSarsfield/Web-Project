<?php

class Staff extends CI_Model
{

    function get_all_staff()
    {

        $this->db->select("staff_id, first_name, last_name, dob, hired_date, left_date, position, phone, address1, address2, town, city");
        $query = $this->db->get('staff');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_staff_by_id($id)
    {
//        $id = $this->input->post('staff_id');
        $this->db->select("staff_id, first_name, last_name, dob, hired_date, left_date, position, phone, address1, address2, town, city");
        $this->db->where("staff_id", $id);
        $query = $this->db->get('staff');
        if ($query->num_rows() > 0) {
            return $query->row(0);

        }

        return false;

    }
    function login_staff($data){
        $encrypted_password = hash("sha256", $data['password']);
        $this->db->select("staff_id, email, password");
        $this->db->where("email", $data['email']);
        $this->db->where("password", $encrypted_password);
        $this->db->from("staff");
        $query = $this->db->get();
        if($query->num_rows() === 0){
            return false;
        } else{
            $user_data['staff_id'] = $query->first_row()->staff_id;
            $this->session->set_userdata('user_data', $user_data);
            return true;
        }
    }
    function add_staff($data)
    {
        if ($this->db->insert("staff", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_staff($id)
    {

//        $id = $this->input->post('id');

        $this->db->where('staff_id', $id);
        $this->db->delete('staff');

    }

    function update_staff($id)
    {
        $this->db->where('id', $id);
        $this->db->update('staff', $data);
    }
}

