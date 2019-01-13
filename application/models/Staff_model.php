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
        $this->db->select("staff_id, CONCAT(account.first_name, ' ', account.last_name) as 'name'");
        $this->db->join("account", "account.account_id = staff.account_id", "inner");
        $this->db->where("staff_id", $id);
        $query = $this->db->get('staff');
        if ($query->num_rows() > 0) {
            return $query->row_array();
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

    function get_all_add_info($info = 0)
    {
        $customer_id = $info;
        $this->load->model("customer_model");
        $customer = $this->customer_model->get_customer_by_id($customer_id);
        // if customer is false (No customer was selected before hand...
        if (!$customer) {
            $model_info['labels_info'] = "<a href='customer.html'><div class='button'>You need to select a Customer first</div></a>";
            $model_info['customer_id'] = "0";
        } else {
            $model_info['labels_info'] =
                "<p><label for='customer_id'>Customer ID:</label>
                <input name='customer_id' type='text' readonly required id='' value='{$customer->customer_id}'></p>
                <p><label for='name'>Customer Name:</label>
                <input name='name' type='text' readonly required id='' value='{$customer->name}'></p>";
            $model_info['customer_id'] = $customer->customer_id;
        }
        return $model_info;
    }

    public function add_customer_quote_by_post()
    {
        $customer_quote_info = array(
            "customer_id" => $this->input->post("customer_id"),
            "name" => $this->input->post("name"),
            "description" => $this->input->post("description"),
            "specs" => $this->input->post("specs"),
            "price" => $this->input->post("price"),
        );
        if ($this->db->insert("customer_quote", $customer_quote_info)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }
}

