<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 13/12/2018
 * Time: 11:26
 */

class permission_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_permissions()
    {
        $this->db->from("permission_model");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_permission_id_by_permission_name($name = "unregistered")
    {
        $this->db->from('permission');
        $this->db->where("name", $name);
        return $this->db->get()->row()->permission_id ?? "0";
    }

    public function get_permission_function_by_id($permission_id)
    {
        $this->db->where("permission_id", $permission_id);
        $this->db->from("permission_functions");
        $query = $this->db->get()->result();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        }
        return false;
    }

    public function get_permission_by_name($permission_name)
    {
        $this->db->where("permission_name", $permission_name);
        $this->db->from("permission_functions");
        $query = $this->db->get()->result();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        }
        return false;
    }

    public function get_function_header_by_id($functions_header_id)
    {
        $this->db->where("function_header_id", $functions_header_id);
        $this->db->from("functions_header");
        $query = $this->db->get()->result();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        }
        return false;
    }

    public function get_function_header_by_name($name)
    {
        $this->db->where("name", $name);
        $this->db->from("permission_functions");
        $query = $this->db->get()->result();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        }
        return false;
    }

    public function get_function_by_id($function_id)
    {
        $this->db->where("function_id", $function_id);
        $this->db->from("function_header");
        $query = $this->db->get()->result();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        }
        return false;
    }

    public function get_function_by_name($name)
    {
        $this->db->where("name", $name);
        $this->db->from("permission_functions");
        $query = $this->db->get()->result();
        if ($query->num_rows() > 0) {
            return $query->first_row();
        }
        return false;
    }

    public function user_has_access_to_function($url = "")
    {
        $account_info = $this->session->userdata("account_info") ?? FALSE;
        if ($account_info == FALSE) {
            return false;
        }
        // if the sub side bar has the permission ...
        $this->db->select("multi_sub_sidebar_permissions.permission_id");
        $this->db->from('sub_sidebar');
        $this->db->join("multi_sub_sidebar_permissions", "sub_sidebar.sub_sidebar_id = multi_sub_sidebar_permissions.sub_sidebar_id", 'inner');
        $this->db->where("sub_sidebar.anchor_tag", $url);
        $this->db->where("multi_sub_sidebar_permissions.permission_id", $account_info['permission_id']);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        }
        // if the side bar has permissions...
        $this->db->select("multi_sidebar_permissions.permission_id");
        $this->db->from('sidebar');
        $this->db->join("multi_sidebar_permissions", "sidebar.sidebar_id = multi_sidebar_permissions.sidebar_id", 'inner');
        $this->db->where("sidebar.anchor_tag", $url);
        $this->db->where("multi_sidebar_permissions.permission_id", $account_info['permission_id']);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }
}