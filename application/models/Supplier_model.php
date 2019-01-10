<?php

class Supplier_model extends CI_Model
{
    function get_all_suppliers()
    {
        $this->db->select("supplier_id, name, address1, address2, town, city, phone, country");
        $query = $this->db->get('supplier');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_supplier_by_id($id)
    {
//        $id = $this->input->post('supplier_id');

        $this->db->select("supplier_id, name, address1, address2, town, city, phone, country");
        $this->db->where("supplier_id", $id);
        $query = $this->db->get('supplier');
        if ($query->num_rows() > 0) {
            return $query->row(0);

        }
        return false;
    }

    function add_supplier($data)
    {
        if ($this->db->insert("supplier", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_supplier($id)
    {

//        $id = $this->input->post('id');

        $this->db->where('supplier_id', $id);
        $this->db->delete('supplier');

    }

    function update_supplier($data)
    {

        $this->db->where('id', $id);
        $this->db->update('customer', $data);
    }

    function get_all_add_info($info)
    {

    }

    public function add_supplier_by_post()
    {
        $supplier_info = array(
            "name" => $this->input->post("name"),
            "address1" => $this->input->post("address1"),
            "address2" => $this->input->post("address2"),
            "town" => $this->input->post("town"),
            "city" => $this->input->post("city"),
            "phone" => $this->input->post("city"),
            "email" => $this->input->post("email"),
            "country" => $this->input->post("country")
        );
        if ($this->db->insert("supplier", $supplier_info)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    public function get_supplier_info_by_id($supplier_id)
    {
        $this->db->select("supplier_id, name");
        $this->db->where("supplier_id", $supplier_id);
        $query = $this->db->get('supplier');
        if ($query->num_rows() > 0) {
            return $query->row(0);
        }
        return false;
    }
}

