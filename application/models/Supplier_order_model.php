<?php

class Supplier_order_model extends CI_Model
{

    function get_all_supplier_orders()
    {

        $this->db->select("order_id, supplier_id, order_date, quantity, status");
        $query = $this->db->get('supplier_order');

        if ($query->num_rows() > 0) {

            return $query->result_array();

        } else {
            return FALSE;
        }
    }

    function get_supplier_order_by_id($id)
    {


//        $id = $this->input->post('order_id');

        $this->db->select("order_id, supplier_id, order_date, quantity, status");
        $this->db->where("order_id", $id);
        $query = $this->db->get('supplier_order');


        if ($query->num_rows() > 0) {
            return $query->row(0);

        }

        return false;

    }

    function add_supplier_order($data)
    {
        if ($this->db->insert("supplier_order", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_supplier_order($id)
    {

//        $id = $this->input->post('id');

        $this->db->where('order_id', $id);
        $this->db->delete('supplier_order');

    }

    function update_supplier_order($data)
    {

        $this->db->where('id', $id);
        $this->db->update('supplier_order', $data);
    }

    function get_all_add_info($info)
    {
        // suppler info
        // material cart info
        $supplier_id = $info[0];
        // if staff_shopping_cart have materials... else they don't therefore false
        $materials = $this->session->userdata("staff_cart") ?? FALSE;
        $this->load->model("supplier_model");
        $this->load->model("material_model");
        $supplier = $this->supplier_model->get_supplier_by_id($supplier_id);
        $model_info['labels_info'] = "";
        // if supplier was not selected, you need to select supplier
        // else if supplier was selected, get materials supplier have
        if (!$supplier) {
            $model_info['labels_info'] = "<a href='supplier.html'><div class='button'>Select Supplier</div></a>";
            $model_info['supplier_id'] = "0";
        } else if (!$materials) {
            $model_info['labels_info'] =
                "<p><label for='material_id'>Supplier ID:</label>
                <input name='material_id' type='text' readonly required id='' value='{$supplier->supplier_id}'></p>
                <p><label for='name'>Supplier Name:</label>
                <input name='name' type='text' readonly required id='' value='{$supplier->name}'></p>
                <a href='materials.html'><div class='button'>Select Materials</div></a>";
            $model_info['supplier_id'] = "0";
        } else {
            $material_labels = "";
            foreach ($materials as $material) {
                $material_labels .= "{$material->name} ({$material->stock_quantity})";
            }
            $model_info['labels_info'] =
                "<p><label for='material_id'>Supplier ID:</label>
                <input name='material_id' type='text' readonly required id='' value='{$supplier->supplier_id}'></p>
                <p><label for='name'>Supplier Name:</label>
                <input name='name' type='text' readonly required id='' value='{$supplier->name}'></p>
                <p><label for='name'>Supplier Name:</label> $material_labels";
            $model_info['material_id'] = $supplier->supplier_id;
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

