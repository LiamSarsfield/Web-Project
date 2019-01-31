<?php

class Supplier_model extends CI_Model
{
    public function get_all_suppliers()
    {
        $this->db->select('supplier_id, name');
        return $this->db->get('supplier')->result();
    }

    function get_supplier_by_id($id)
    {
//        $id = $this->input->post('supplier_id');

        $this->db->select("supplier_id, name, address1, address2, town, city, phone, country");
        $this->db->where("supplier_id", $id);
        $query = $this->db->get('supplier');
        if ($query->num_rows() > 0) {
            return $query->row_array();
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

    public function get_supplier_edit_info($supplier_id)
    {
        $this->db->from("supplier");
        $this->db->where("supplier_id", $supplier_id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return false;
        }
    }

    public function edit_supplier()
    {
        $supplier_data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address_one' => $this->input->post('address_one'),
            'address_two' => $this->input->post('address_two'),
            'city' => $this->input->post('city'),
            'province' => $this->input->post('province'),
            'postal_code' => $this->input->post('postal_code'),
            'country' => $this->input->post('country')
        );
        $this->db->where('supplier_id', $this->input->post('supplier_id'));
        $this->db->update('supplier', $supplier_data);
    }

    public function get_supplier_email_by_supplier_id($supplier_id)
    {
        $this->db->select("email");
        $this->db->from("supplier");
        $this->db->where("supplier_id", $supplier_id);
        $result = $this->db->get()->row();
        return $result->email;
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

    public function get_supplier_display_info_by_id($supplier_id)
    {
        $this->db->select("name");
        $this->db->from("supplier");
        $this->db->where("supplier_id", $supplier_id);
        return $this->db->get()->row()->name;
    }
}

