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

    public function get_all_add_info()
    {
        return NULL;
    }
}