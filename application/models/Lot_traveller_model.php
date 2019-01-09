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
        return "<a href=\"lot_traveller.html\"><div class=\"button\">You need to select a product first</div></a>";
        };
        return "<label for='name'>Product Name:</label>
                <input name='name' type='text' readonly required id='' value='{$product->name}'>";
    }
}
