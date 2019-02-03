<?php

class Shopping_cart_model extends CI_Model
{

    public function add_to_cart($data)
    {
        //returns shopping cart id if session is already in db, otherwise false
        $session_in_db = $this->session_in_db($data['session_id']);
        if (!$session_in_db) {
            $shopping_cart_data['session_id'] = $data['session_id'];
            $this->db->insert("shopping_cart", $shopping_cart_data);
            $session_in_db = $this->db->insert_id();
        }
        // now to insert into multi table...
        if ($this->product_already_in_cart($session_in_db, $data['product_id'], $data['quantity']))
            return true;
        $multi_data['shopping_cart_id'] = $session_in_db;
        $multi_data['product_id'] = $data['product_id'];
        $multi_data['quantity'] = $data['quantity'];
        $this->db->insert("multi_product_has_shopping_cart", $multi_data);
        return true;
    }

    public function select_from_cart()
    {
        $this->db->select('shopping_cart.shopping_cart_id, shopping_cart.session_id, product.product_id, product.name, 
        product.description, product.price, product.image_path, multi_product_has_shopping_cart.quantity,(product.price * multi_product_has_shopping_cart.quantity) as total');
        $this->db->from('shopping_cart');
        $this->db->join('multi_product_has_shopping_cart', 'multi_product_has_shopping_cart.shopping_cart_id = shopping_cart.shopping_cart_id ', 'inner');
        $this->db->join('product', 'product.product_id = multi_product_has_shopping_cart.product_id ', 'inner');
        $this->db->where('session_id =', $this->session->session_id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query;

        } else {
            return FALSE;
        }
    }

    public function remove_from_cart($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('shopping_cart');
    }

    public function clear_shopping_cart()
    {
        $session_id = $this->session->session_id;
        $this->db->where('session_id', $session_id);
        $this->db->delete('shopping_cart');
    }

    public function session_in_db($session_id)
    {
        $this->db->select("shopping_cart_id");
        $this->db->from("shopping_cart");
        $this->db->where("session_id", $session_id);
        $result = $this->db->get();
        // if more than one row
        if ($result->num_rows() > 0) {
            $result_object = $result->result();
            return $result->row()->shopping_cart_id;
        } else {
            return false;
        }
    }

    public function product_already_in_cart($shopping_cart_id, $product_id, $quantity)
    {
        $this->db->from("multi_product_has_shopping_cart");
        $this->db->where("shopping_cart_id", $shopping_cart_id);
        $this->db->where("product_id", $product_id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $result_row = $result->row();
            $updated_result_row['product_id'] = $result_row->product_id;
            $updated_result_row['shopping_cart_id'] = $result_row->shopping_cart_id;
            $updated_result_row['quantity'] =  $result_row->quantity + $quantity;
            $this->db->update("multi_product_has_shopping_cart", $updated_result_row);
            return true;
        }
        return false;
    }
}

