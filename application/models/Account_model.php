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
    function add_account($data){
        if ($this->db->insert("account", $data)) {
            return $this->db->insert_id();
        }
        return false;
    }
    function last_insert_id(){
        $this->db->select("LAST_INSERT_ID()");
    }

}