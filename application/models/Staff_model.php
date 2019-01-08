<?php

class Staff_model extends CI_Model
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

    public function get_staff_id_by_account_id($account_id)
    {
        $this->db->select("staff_id, account_id");
        $this->db->where("account_id", $account_id);
        $this->db->from("staff");
        $query = $this->db->get();
        if ($query->num_rows() === 0) {
            return false;
        }
        return $query->row()->customer_id;
    }
    function login_staff($data)
    {
        $encrypted_password = $data['password'];
        if (!preg_match('/[A-Fa-f0-9]{64}/', $data['password'])) {
            $encrypted_password = hash("sha256", $encrypted_password);
        }
        $this->db->select("staff_id, email, password");
        $this->db->where("email", $data['email']);
        $this->db->where("password", $encrypted_password);
        $this->db->from("staff");
        $query = $this->db->get();
        if ($query->num_rows() === 0) {
            return false;
        } else {
            return $query->row()->staff_id;
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

    function delete_staff_by_id($id)
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

    public function get_staff_by_email($email)
    {
        $this->db->where("email", $email);
        $this->db->from("staff");
        return $this->db->get()->result();
    }

}
