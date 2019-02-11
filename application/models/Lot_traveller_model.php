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

    public function get_lot_travellers_by_staff_id($lot_traveller_id)
    {
        $this->db->select("product.name as 'product_price' , product.price as 'product_price', lot_traveller.lot_traveller_id, lot_traveller.status, lot_traveller.production_quantity, 
                lot_traveller.is_completed");
        $this->db->from('lot_traveller');
        $this->db->join("product", "lot_traveller.product_id = product.product_id", "inner");
        $this->db->where('lot_traveller.staff_id', $lot_traveller_id);
        $this->db->where('lot_traveller.is_completed', '0');
        return $this->db->get()->result();
    }

    public function confirm_lot_traveller_ownership_by_staff_id($lot_traveller_id, $staff_id)
    {
        $this->db->select('staff_id');
        $this->db->from('lot_traveller');
        $this->db->where('lot_traveller_id', $lot_traveller_id);
        $this->db->where('staff_id', $staff_id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_lot_traveller_by_id($id)
    {
        $this->db->select("product.name as 'product_name' , product.price as 'product_price', lot_traveller.lot_traveller_id, lot_traveller.status, lot_traveller.production_quantity, 
                lot_traveller.is_completed");
        $this->db->from('lot_traveller');
        $this->db->join("product", "lot_traveller.product_id = product.product_id", "inner");
        $this->db->where('lot_traveller.lot_traveller_id', $id);
        return $this->db->get()->row();
    }

    function edit_lot_traveller($lot_traveller_id, $lot_traveller_data)
    {
        $this->db->where('lot_traveller_id', $lot_traveller_id);
        $this->db->update('lot_traveller', $lot_traveller_data);
    }

    public function finish_lot_traveller($lot_traveller_id)
    {
        //update lot traveller, get requested stock add it to product stock level
        $lot_traveller_info = array(
            'is_completed' => '1',
            'staff_id' => null
        );
        $this->db->where('lot_traveller_id', $lot_traveller_id);
        $this->db->update('lot_traveller', $lot_traveller_info);
    }

    function add_lot_traveller($data)
    {
        if ($this->db->insert("lot_traveller", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    public function initialize_lot_traveller()
    {
        $lot_traveller_initialization = array(
            "status" => "Not Produced",
            "production_quantity" => "0"
        );
        if ($this->db->insert("lot_traveller", $lot_traveller_initialization)) {
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

    public function get_all_add_info($info)
    {
        // get product, get work order for lot traveller
        // if product has lot traveller already, cannot create a new lot traveller
        $product_id = $info[0];
        $this->load->model("product_model");
        $product = $this->product_model->get_product_by_product_id($product_id);
        // if product is false (No product was selected before hand...
        if (!$product) {
            $model_info['labels_info'] = "<a href=\"lot_traveller.html\"><div class=\"button\">You need to select a product first</div></a>";
            $model_info['lot_traveller_id'] = "0";
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

    public function view_all_unassigned_lot_travellers()
    {
        $this->db->select("product.name as 'product_price' , product.price as 'product_price', lot_traveller.lot_traveller_id, lot_traveller.status, lot_traveller.production_quantity, 
                lot_traveller.is_completed");
        $this->db->from('lot_traveller');
        $this->db->join("product", "lot_traveller.product_id = product.product_id", "inner");
        $this->db->where('lot_traveller.staff_id IS NULL');
        $this->db->where('lot_traveller.is_completed', '0');
        return $this->db->get()->result();
    }

    public function view_lot_traveller($lot_traveller_id)
    {
        $this->db->select("lot_traveller.lot_traveller_id, lot_traveller.status, lot_traveller.production_quantity, product.name, product.price");
        $this->db->from('lot_traveller');
        $this->db->join('product', 'lot_traveller.product_id = product.product_id', 'inner');
        $this->db->where('lot_traveller.lot_traveller_id', $lot_traveller_id);
        return $this->db->get()->row();
    }

    public function assign_lot_traveller($lot_traveller_id, $staff_id)
    {
        $lot_traveller_info = array(
            'staff_id' => $staff_id,
            'status' => 'Staff Assigned'
        );
        $this->db->where('lot_traveller_id', $lot_traveller_id);
        $this->db->update('lot_traveller', $lot_traveller_info);
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
