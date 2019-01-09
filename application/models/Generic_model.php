<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 08/01/2019
 * Time: 12:34
 */

class Generic_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_required_form_field_names($table_name){
    $this->db->select("COLUMN_NAME AS name");
    $this->db->where("TABLE_SCHEMA", $this->db->database);
    $this->db->where("TABLE_NAME", $table_name);
    $this->db->where("COLUMN_KEY", "");
    $this->db->from("INFORMATION_SCHEMA`.`COLUMNS");
    return $this->db->get()->result();
}
}