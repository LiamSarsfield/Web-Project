<?php

class Credit_note_model extends CI_Model
{

    function get_all_credit_notes()
    {
        $this->db->select("credit_note_id, customers_id, amount, reason");
        $query = $this->db->get('credit_note');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_credit_note_by_id($id)
    {


//        $id = $this->input->post('credit_note_id');

        $this->db->select("credit_note_id, customers_id, amount, reason");
        $this->db->where("credit_note_id", $id);
        $query = $this->db->get('credit_note');


        if ($query->num_rows() > 0) {
            return $query->row(0);

        }

        return false;

    }

    function add_credit_note($data)
    {
        if ($this->db->insert("credit_note", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_credit_note($id)
    {
//        $id = $this->input->post('id');
        $this->db->where('credit_note_id', $id);
        $this->db->delete('credit_note');
    }

    public function get_all_add_info($info)
    {
        $customer_order_id = $info[0] ?? "0";
        $products = $this->session->userdata("staff_cart");
        $this->load->model("customer_order_model");
        $customer_order = $this->customer_order_model->get_customer_order_by_id($customer_order_id);
        $model_info['labels_info'] = "";
        // if customer_order is false (No customer_order was selected before hand...
        if (!$customer_order) {
            $model_info['labels_info'] = "<a href='lot_traveller.html'><div class='button'>Select Customer Order ID</div></a>";
            $model_info['customer_order_id'] = "0";
        } else if (!$products) {
            $model_info['labels_info'] .=
                "<p><label for='customer_order_id'>Customer Order ID:</label>
                <input name='customer_order_id' type='text' readonly required id='customer_order_id' value='{$customer_order->customer_order_id}'></p>
                <p><label for='date_ordered'>Customer Order Date:</label>
                <input name='date_ordered' type='text' readonly required id='date_ordered' value='{$customer_order->date_ordered}'></p>";
            $model_info['labels_info'] .= "<a href='credit_note.html'><div class='button'>Select Products For Credit Note</div></a>";
            $model_info['customer_order_id'] = $customer_order_id;
        } else {
            $product_labels = "";
            foreach ($products as $product) {
                $product_labels .= "{$product->name} ({$product->stock_quantity})";
            }
            $model_info['labels_info'] .=
                "<p><label for='customer_order_id'>Customer Order ID:</label>
                <input name='customer_order_id' type='text' readonly required id='customer_order_id' value='{$customer_order->customer_order_id}'></p>
                <p><label for='date_ordered'>Customer Order Date:</label>
                <input name='date_ordered' type='text' readonly required id='date_ordered' value='{$customer_order->date_ordered}'></p>";
            $model_info['labels_info'] .= "<p>Products</p> $product_labels";
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

