<?php

class Shopping_cart_model extends CI_Model
{
    public function add_to_cart($data)
    {
        try {
            //returns shopping cart id if session is already in db, otherwise false
            $shopping_cart_id = $this->session_in_db($data['session_id']);
            if (!$shopping_cart_id) {
                $shopping_cart_data['session_id'] = $data['session_id'];
                $this->db->insert("shopping_cart", $shopping_cart_data);
                $shopping_cart_id = $this->db->insert_id();
            }
            // now to insert into multi table...
            if ($this->product_already_in_cart($shopping_cart_id, $data['product_id'], $data['quantity'])) {
                $multi_data['product_id'] = $data['product_id'];
                $multi_data['shopping_cart_id'] = $shopping_cart_id;
                $multi_data['quantity'] = $data['quantity'];
                $this->db->replace("shopping_cart_items", $multi_data);
            } else {
                $multi_data['shopping_cart_id'] = $shopping_cart_id;
                $multi_data['product_id'] = $data['product_id'];
                $multi_data['quantity'] = $data['quantity'];
                $this->db->insert("shopping_cart_items", $multi_data);
            }
        } catch (exception $e) {
            return false;
        }

        return true;
    }

    public function select_from_cart()
    {
        $this->db->select('shopping_cart.shopping_cart_id, shopping_cart.session_id, product.product_id, product.name, 
        product.description, product.price, product.image_path, shopping_cart_items.quantity,(product.price * shopping_cart_items.quantity) as total');
        $this->db->from('shopping_cart');
        $this->db->join('shopping_cart_items', 'shopping_cart_items.shopping_cart_id = shopping_cart.shopping_cart_id ', 'inner');
        $this->db->join('product', 'product.product_id = shopping_cart_items.product_id ', 'inner');
        $this->db->where('session_id =', $this->session->session_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return NULL;
        }
    }

    public function remove_from_cart($shopping_cart_id, $product_id)
    {
        $this->db->where('shopping_cart_id', $shopping_cart_id);
        $this->db->where('product_id', $product_id);
        $this->db->delete('shopping_cart_items');
    }

    public function clear_shopping_cart()
    {
        $session_id = $this->session->session_id;
        $shopping_cart_id = $this->get_shopping_cart_id_by_session_id($session_id);
        $this->db->where('shopping_cart_id', $shopping_cart_id);
        $this->db->delete('shopping_cart_items');
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

    public function get_shopping_cart_id_by_session_id($session_id)
    {
        $this->db->select("shopping_cart_id");
        $this->db->from("shopping_cart");
        $this->db->where("session_id", $session_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->shopping_cart_id;
        } else {
            return false;
        }
    }

    public function product_already_in_cart($shopping_cart_id, $product_id, $quantity)
    {
        $this->db->from("shopping_cart_items");
        $this->db->where("shopping_cart_id", $shopping_cart_id);
        $this->db->where("product_id", $product_id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $result_row = $result->row();
            $updated_result_row['product_id'] = $result_row->product_id;
            $updated_result_row['shopping_cart_id'] = $result_row->shopping_cart_id;
            $updated_result_row['quantity'] = $result_row->quantity + $quantity;
            $this->db->replace("shopping_cart_items", $updated_result_row);
            return true;
        }
        return false;
    }
}

