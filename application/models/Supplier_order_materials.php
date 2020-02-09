<?php

class Supplier_order_materials extends CI_Model
{

    function get_all_supplier_order_materials()
    {
        $this->db->select("order_id, material_id, supplier_id, quantity");
        $query = $this->db->get('supplier_order_materials');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_supplier_order_materials_by_id($id)
    {


//        $id = $this->input->post('order_id');

        $this->db->select("order_id, material_id, supplier_id, quantity");
        $this->db->where("order_id", $id);
        $query = $this->db->get('supplier_order_materials');


        if ($query->num_rows() > 0) {
            return $query->row(0);

        }

        return false;

    }

    function add_supplier_order_materials($data)
    {
        if ($this->db->insert("supplier_order_materials", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_supplier_order_materials($id)
    {

//        $id = $this->input->post('id');

        $this->db->where('order_id', $id);
        $this->db->delete('supplier_order_materials');

    }

}

