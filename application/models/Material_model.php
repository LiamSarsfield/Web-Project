<?php

class Material_model extends CI_Model
{
    function get_all_materials()
    {
        $this->db->select("material_id, supplier_id, material_name, description, material_price");
        $query = $this->db->get('material');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_material_by_id($material_id)
    {
        $this->db->where("material_id", $material_id);
        $query = $this->db->get('material');
        if ($query->num_rows() > 0) {
            return $query->row(0);
        }
        return false;
    }

    function add_material($data)
    {
        if ($this->db->insert("material", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_material($id)
    {
        $this->db->where('material_id', $id);
        $this->db->delete('material');
    }

    public function edit_material()
    {
        $material_data = array(
            'supplier_id' => $this->input->post('supplier_id'),
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
            'price' => $this->input->post('price'),
            'stock_quantity' => $this->input->post('stock_quantity')
        );
        $this->db->where('material_id', $this->input->post('material_id'));
        $this->db->update('material', $material_data);
    }

    function get_all_add_info($info)
    {
        $supplier_id = $info[0];
        $this->load->model("supplier_model");
        // will retrieve labels: order id, , date ordered, supplier order name
        $supplier = $this->supplier_model->get_supplier_info_by_id($supplier_id);
        // if supplier is false (No supplier was selected before hand...
        if (!$supplier) {
            $model_info['labels_info'] = "<a href='supplier.html'><div class='button'>You need to select a Supplier</div></a>";
            $model_info['supplier_id'] = "0";
        } else {
            $model_info['labels_info'] =
                "<p><label for='supplier_id'>Supplier ID:</label>
                <input name='supplier_id' type='text' readonly required id='' value='{$supplier->supplier_id}'></p>
                <p><label for='name'>Supplier Name:</label>
                <input name='name' type='text' readonly required id='' value='{$supplier->name}'></p>";
            // need supplier id passed through for form action
            $model_info['supplier_id'] = $supplier->supplier_id;
        }
        return $model_info;
    }

    public function add_customer_quote_by_post()
    {
        $customer_quote_info = array(
            "customer_id" => $this->input->post("customer_id"),
            "name" => $this->input->post("name"),
            "description" => $this->input->post("description"),
            "specs" => $this->input->post("specs"),
            "price" => $this->input->post("price"),
        );
        if ($this->db->insert("customer_quote", $customer_quote_info)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }
}

