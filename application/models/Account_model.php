<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 16/12/2018
 * Time: 18:49
 */

class Account_model extends CI_Model
{
    function login($data)
    {
        $encrypted_password = $data['password'];
        if (!preg_match('/[A-Fa-f0-9]{64}/', $data['password'])) {
            $encrypted_password = hash("sha256", $encrypted_password);
        }
        $this->db->select("account_id, permission_id, email, password");
        $this->db->where("email", $data['email']);
        $this->db->where("password", $encrypted_password);
        $this->db->from("account");
        $query = $this->db->get();
        if ($query->num_rows() === 0) {
            return false;
        } else {
            return $query->row();
        }
    }

    function add_account($data)
    {
        if ($this->db->insert("account", $data)) {
            return $this->db->insert_id();
        }
        return false;
    }

    function last_insert_id()
    {
        $this->db->select("LAST_INSERT_ID()");
    }

    public function get_account_view_info_from_account_id($account_id)
    {
        $this->db->select("CONCAT(`first_name`, ' ', `last_name`) AS 'name', `email");
        $this->db->where("account_id", $account_id);
        $this->db->from("account");
        return $this->db->get()->row_array();
    }

    public function check_if_email_is_unique($email)
    {
        $this->db->select("email");
        $this->db->from("account");
        $this->db->where("email", $email);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function password_matches($password, $account_id)
    {
        $this->db->select("email");
        $this->db->from("account");
        $this->db->where("password", $password);
        $this->db->where("account_id", $account_id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}