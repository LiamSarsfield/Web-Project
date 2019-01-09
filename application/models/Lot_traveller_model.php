<?php

class Lot_traveller_model extends CI_Model
{

    function get_all_lot_travellers()
    {
        $this->db->select("lot_traveller_id, product_id, status");
        $query = $this->db->get('lot_traveller');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_lot_traveller_by_id($id)
    {
//        $id = $this->input->post('lot_traveller_id');
        $this->db->select("lot_traveller_id, product_id, status");
        $this->db->where("lot_traveller_id", $id);
        $query = $this->db->get('lot_traveller');


        if ($query->num_rows() > 0) {
            return $query->row(0);
        }

        return false;

    }

    function add_lot_traveller($data)
    {
        if ($this->db->insert("lot_traveller", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_lot_traveller($id)
    {
//      $id = $this->input->post('id');
        $this->db->where('lot_traveller_id', $id);
        $this->db->delete('lot_traveller');
    }

    public function get_all_add_info($info = 0)
    {
        $product_id = $info;
        $this->load->model("product_model");
        $product = $this->product_model->get_product_by_id($product_id);
        // if product is false (No product was selected before hand...
        if (!$product) {
            $model_info['product_label'] = "<a href=\"lot_traveller.html\"><div class=\"button\">You need to select a product first</div></a>";
            $model_info['product_id'] = "0";
        } else {
            $model_info['product_labels_info'] =
                "<p><label for='name'>Product ID:</label>
                <input name='product_id' type='text' readonly required id='' value='{$product->product_id}'></p>
                <p><label for='name'>Product Name:</label>
                <input name='name' type='text' readonly required id='' value='{$product->name}'></p>";
            $model_info['product_id'] = $product->product_id;
        }
        return $model_info;
    }

    public function add_lot_traveller_by_post()
    {
        $lot_traveller_info = array(
            "product_id" => $this->input->post("product_id"),
            "status" => $this->input->post("status"),
            "production_quantity" => $this->input->post("production_quantity"),
        );
        if ($this->db->insert("lot_traveller", $lot_traveller_info)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }
}
