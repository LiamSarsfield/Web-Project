<?php

class Customer_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

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

    public function get_rows_by_limit($limit, $start)
    {
        $this->db->limit($limit, $start);
        return $this->db->get("customer")->result_array();
    }

    function get_customer_by_id($customer_id)
    {
        $this->db->select("CONCAT(first_name, ' ', last_name) AS name, customer_id");
        $this->db->join('account', 'account.account_id = customer.account_id', 'inner');
        $this->db->where("customer_id", $customer_id);
        $query = $this->db->get('customer');
        if ($query->num_rows() > 0) {
            return $query->row(0);
        }
        return false;
    }

    function get_info_for_display_by_id($id)
    {
        $this->db->select("customer_id AS Customer ID, 
        CONCAT(first_name, ' ', last_name) AS name, 
        email AS Email, phone as Phone, company AS Company, 
        address_one AS Address One, address_two AS Address Two,
        city AS City, postcode AS Postcode, state AS State, country AS Country");
        $this->db->where("customer_id", $id);
        $query = $this->db->get('customer');
        if ($query->num_rows() > 0) {
            return $query->row_array(0);
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

    function delete_customer($id)
    {
        $this->db->where('customer_id', $id);
        $this->db->delete('customer');
    }

    public function get_rows()
    {
        $this->db->select("customer_id");
        $this->db->from('customer');
        return $this->db->get()->num_rows();
    }

    function update_customer_details($data)
    {
        $this->db->where('id', $id);
        $this->db->update('customer', $data);
    }

    function login_customer($data)
    {
        $encrypted_password = $data['password'];
        if (!preg_match('/[A-Fa-f0-9]{64}/', $data['password'])) {
            $encrypted_password = hash("sha256", $encrypted_password);
        }
        $this->db->select("customer_id, email, password");
        $this->db->where("email", $data['email']);
        $this->db->where("password", $encrypted_password);
        $this->db->from("customer");
        $query = $this->db->get();
        if ($query->num_rows() === 0) {
            return false;
        } else {
            return $query->row()->customer_id;
        }

    }

    public function get_customer_id_by_account_id($account_id)
    {
        $this->db->select("customer_id, account_id");
        $this->db->where("account_id", $account_id);
        $this->db->from("customer");
        $query = $this->db->get();
        if ($query->num_rows() === 0) {
            return false;
        }
        return $query->row()->customer_id;
    }

    function get_field_names()
    {
        return $this->db->list_fields('customer');
    }

    public function get_all_search_info()
    {
        $this->db->select("customer_id, CONCAT(`first_name`, ' ', `last_name`) AS 'customer_name', email");
        $this->db->from("customer");
        $this->db->join('account', 'customer.account_id = account.account_id', 'left');
        return $this->db->get()->result();

    }
}

