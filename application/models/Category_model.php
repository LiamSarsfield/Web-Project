<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 08/01/2019
 * Time: 11:09
 */

class Category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_category($data)
    {
        if ($this->db->insert("category", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    public function get_all_categories()
    {
        $this->db->select("name");
        $this->db->from("category");
        return $this->db->get()->result();
    }

    public function get_category_by_id($category_id){
        $this->db->select("category_id, name");
        $this->db->where("category_id", $category_id);
        $this->db->from("category");
        $query_result =  $this->db->get();
        if($query_result->num_rows() > 0){
            return $query_result->row_array();
        }
        return false;
    }
    public function get_all_add_info()
    {
        return NULL;
    }
}