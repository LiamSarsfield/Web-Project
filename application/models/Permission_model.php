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

    public function get_permission_id_by_permission_name($name = "Unregistered")
    {
        $this->db->from('permission');
        $this->db->where("name", $name);
        return $this->db->get()->row()->permission_id ?? "0";
    }

    public function get_permission_name_by_permission_id($permission_id)
    {
        $this->db->where("permission_id", $permission_id);
        $this->db->from("permission");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->name;
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
        // if the sub side bar function has the permission..
        $this->db->select("`multi_sub_sidebar_function_permissions`.`permission_id`");
        $this->db->from('multi_sub_sidebar_function_permissions');
        $this->db->join("sub_sidebar_functions", "`multi_sub_sidebar_function_permissions`.`sub_sidebar_functions_id` = `sub_sidebar_functions`.`sub_sidebar_functions_id`", "inner");
        $this->db->where("`multi_sub_sidebar_function_permissions`.`permission_id`", $account_info['permission_id']);
        $this->db->where("`sub_sidebar_functions`.`anchor_tag`", $url);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        }
        return false;
    }

    public function get_available_functions($sub_sidebar_anchor_tag, $permission_id)
    {
        $this->db->select("`sub_sidebar_functions`.`name`, `sub_sidebar_functions`.`anchor_tag`");
        $this->db->from("multi_sub_sidebar_function_permissions");
        $this->db->join("sub_sidebar_functions", "`multi_sub_sidebar_function_permissions`.`sub_sidebar_functions_id` = `sub_sidebar_functions`.`sub_sidebar_functions_id`", "inner");
        $this->db->join("sub_sidebar", "`sub_sidebar_functions`.`sub_sidebar_id` = `sub_sidebar`.`sub_sidebar_id`", "inner");
        $this->db->where("`multi_sub_sidebar_function_permissions`.`permission_id`", $permission_id);
        $this->db->where("`sub_sidebar`.`anchor_tag`", $sub_sidebar_anchor_tag);
        $result = $this->db->get()->result();
        return $result;
        // select all functions where permission id is $permission id and sub sidebar = sub sidebar
        //Permission ID, sub sidebar ID

    }
}