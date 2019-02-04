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
        return $query->row()->staff_id;
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

    public function add_staff_by_post($model_data)
    {
        $this->load->model("Generic_model");
        $columns_class = $this->Generic_model->get_non_primary_and_non_foreign_key_columns("staff");
        $staff_data = array();
        foreach ($columns_class as $column_class) {
            $staff_data[$column_class->name] = $model_data[$column_class->name];
            unset($model_data[$column_class->name]);
        }
        $model_data['permission_id'] = "2";
        $model_data['password'] = hash('sha256', $model_data['password']);
        $this->db->insert('account', $model_data);
        $staff_data['account_id'] = $this->db->insert_id();
        $this->db->insert('staff', $staff_data);
        $ss = 2;
    }

    function delete_staff_by_id($id)
    {
//        $id = $this->input->post('id');
        $this->db->where('staff_id', $id);
        $this->db->delete('staff');
    }

    public function get_staff_edit_info($staff_id)
    {
        $this->db->join('account', 'account.account_id = staff.account_id', 'inner');
        $this->db->from("staff");
        $this->db->where("staff.staff_id", $staff_id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    public function edit_staff()
    {
        $account_data = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address_one' => $this->input->post('address_one'),
            'address_two' => $this->input->post('address_two'),
            'city' => $this->input->post('city'),
            'province' => $this->input->post('province'),
            'postal_code' => $this->input->post('postal_code'),
            'country' => $this->input->post('country')
        );
        $account_id = $this->get_account_id_by_staff_id($this->input->post('staff_id'));
        $this->db->where('account_id', $account_id);
        $this->db->update('account', $account_data);
        $staff_data = array(
            'dob' => $this->input->post('dob'),
            'hired_date' => $this->input->post('hired_date'),
            'left_date' => $this->input->post('left_date'),
            'position' => $this->input->post('position'),
        );
        $this->db->where('staff_id', $this->input->post('staff_id'));
        $this->db->update('staff', $staff_data);
    }

    public function get_account_id_by_staff_id($staff_id)
    {
        $this->db->select('account_id');
        $this->db->from('staff');
        $this->db->where('staff_id', $staff_id);
        return $this->db->get()->row()->account_id;
    }

    public function get_staff_email_by_staff_id($staff_id)
    {
        $this->db->select("account.email as email");
        $this->db->from("staff");
        $this->db->join('account', 'account.account_id = staff.account_id', 'inner');
        $this->db->where("staff.staff_id", $staff_id);
        $result = $this->db->get()->row();
        return $result->email;
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

