<?php

class Customer_order_model extends CI_Model
{

    function get_all_orders()
    {
        $this->db->select("order_id, order_date, last_name, total_price, customer_id, customer_invoice_id, credit_note_id");
        $query = $this->db->get('customer_order');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    // just returns table data with fks
    function get_customer_order_by_id($customer_order)
    {
        $this->db->where("customer_order_id", $customer_order);
        $query = $this->db->get('customer_order');
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    //will inner join fks
    function get_customer_order_info_by_id($customer_order_id)
    {
        $concat_name = "CONCAT(account.first_name, ' ', account.last_name) AS customer_name";
        $concat_address = "CONCAT (account.address_one,', ', account.address_two, ', ', account.city, ', ', account.country) AS address";
        $this->db->select("customer_order.customer_id, customer_order.customer_order_id, customer_order.date_ordered, $concat_name, $concat_address");
        $this->db->join('customer', 'customer.customer_id = customer_order.customer_id', 'inner');
        $this->db->join('account', 'account.account_id = account.account_id', 'inner');
        $this->db->where('customer_order_id', $customer_order_id);
        $query = $this->db->get('customer_order');
        if ($query->num_rows() > 0) {
            return $query->row(0);
        }
        return false;
    }

    public function get_customer_order_products_by_customer_order_id($customer_order_id)
    {
        $this->db->select("product.product_id, product.name, product.price, multi_customers_order_items.quantity");
        $this->db->join('product', 'multi_customers_order_items.product_id = product.product_id', 'inner');
        $this->db->where('customer_order_id', $customer_order_id);
        $this->db->from("multi_customers_order_items");
        return $this->db->get()->result();
    }

    public function get_customer_order_customer_quotes_by_customer_order_id($customer_order_id)
    {
        $this->db->select("customer_quote.customer_quote_id, customer_quote.name, customer_quote.price, multi_customers_order_items.quantity");
        $this->db->join('customer_quote', 'multi_customers_order_items.product_id = customer_quote.customer_quote_id', 'inner');
        $this->db->where('customer_order_id', $customer_order_id);
        $this->db->from("multi_customers_order_items");
        return $this->db->get()->result();
    }

    public function get_customer_orders_by_customer_id($customer_id)
    {
        $this->db->from('customer_order');
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function add_customer_order($data)
    {
        if ($this->db->insert("customer_order", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }


    public function get_all_search_info()
    {
        $this->db->select("customer_order.order_id, CONCAT(account.first_name, ' ', account.last_name) AS 'customer_name', 
        customer_order.date_ordered, customer_order.total_price");
        $this->db->from("customer_order");
        $this->db->join('customer', 'customer_order.customer_id = customer.customer_id', 'inner');
        $this->db->join('account', 'customer.account_id = account.account_id', 'inner');
        return $this->db->get()->result();
    }

    public function get_detailed_info_by_order_id($order_id)
    {
        $this->db->select("customer_order.order_id, CONCAT(account.first_name, ' ', account.last_name) AS 'customer_name', 
        customer_order.date_ordered,  customer_order.total_price");
        $this->db->from("customer_order");
        $this->db->join('customer', 'customer_order.customer_id = customer.customer_id', 'inner');
        $this->db->join('account', 'customer.account_id = account.account_id', 'inner');
        $this->db->where("customer_order.order_id", $order_id);
        $customer_order = $this->db->get()->row();
        $this->load->model("Customers_ordered_products_model");
        $this->load->model("Customers_ordered_products_model");
        $customer_order->products = $this->Customers_ordered_products_model->get_products_by_order_id($order_id);
        return $customer_order;
    }

    public function get_all_add_info($info = array('0'))
    {
        $customer_id = $info[0];
        $this->load->model("customer_model");
        $customer = $this->customer_model->get_customer_info_by_id($customer_id);
        $items = $this->session->userdata("staff_cart") ?? FALSE;
        $model_info['labels_info'] = "";
        // if customer is false (No customer was selected before hand...
        if (!$customer) {
            $model_info['labels_info'] = "<a href='customer.html'><div class='button'>You need to select a Customer first</div></a>";
            $model_info['customer_id'] = "0";
        } else if (!$items) {
            $model_info['labels_info'] =
                "<p><label for='customer_id'>Customer ID:</label>
                <input name='customer_id' type='text' readonly required id='' value='{$customer->customer_id}'></p>
                <p><label for='name'>Supplier Name:</label>
                <input name='name' type='text' readonly required id='' value='{$customer->name}'></p>
                <a href='materials.html'><div class='button'>Select Materials</div></a>";
            $model_info['supplier_id'] = "0";
        } else {
            $model_info['labels_info'] =
                "<p><label for='customer_id'>Customer ID:</label>
                <input name='customer_id' type='text' readonly required id='' value='{$customer->customer_id}'></p>
                <p><label for='name'>Customer Name:</label>
                <input name='name' type='text' readonly required id='' value='{$customer->name}'></p>";
            $model_info['customer_id'] = $customer->customer_id;
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

    public function add_customer_order_by_checkout($session_items)
    {
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $basket_total = 0;
        foreach ($session_items as $session_item) {
            $basket_total += $session_item->total;
        }
        $customer_order_info = array(
            'customer_id' => $account_info['customer_id'],
            'date_ordered' => date("Y-m-d H:i:s"),
            'total_price' => $basket_total
        );
        $this->db->insert('customer_order', $customer_order_info);
        $inserted_customer_order_id = $this->db->insert_id();
        foreach ($session_items as $session_item) {
            $multi_info = array(
                'customer_order_id' => $inserted_customer_order_id,
                'product_id' => $session_item->product_id,
                'quantity' => $session_item->quantity
            );
            $this->db->insert('multi_customers_order_items', $multi_info);
        }
        return $inserted_customer_order_id;
    }

    public function confirm_customer_owns_order($customer_id, $order_id)
    {
        $this->db->select('customer_order_id');
        $this->db->from('customer_order');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('customer_order_id', $order_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function confirm_customer_paid_for_order($order_id)
    {
        $this->db->select('`customer_order`.`customer_order_id`');
        $this->db->from('customer_invoice');
        $this->db->join('customer_order', "customer_invoice.customer_order_id = customer_order.customer_order_id", "inner");
        $this->db->where('`customer_invoice.`customer_order_id`', $order_id);
        $this->db->where('`customer_order.`customer_order_id`', $order_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function confirm_customer_order_has_customer_quote($order_id)
    {
        $this->db->select('`multi_customers_order_items`.`customer_order_id`');
        $this->db->from('customer_order');
        $this->db->join('multi_customers_order_items', 'customer_order.customer_order_id = multi_customers_order_items.customer_order_id', 'inner');
        $this->db->where('multi_customers_order_items.customer_quote_id IS NOT NULL');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function remove_product_from_customer_order_by_order_id($order_id, $product_id)
    {
        // get total price of product being removed to subtract from total
        $this->db->select("(product.price * multi_customers_order_items.quantity) as total");
        $this->db->from('multi_customers_order_items');
        $this->db->join('product', 'multi_customers_order_items.product_id = product.product_id', 'inner');
        $this->db->where('multi_customers_order_items.customer_order_id', $order_id);
        $this->db->where('multi_customers_order_items.product_id', $product_id);
        $product_total_price = $this->db->get()->row()->total;

        $this->db->where('customer_order_id', $order_id);
        $this->db->set('total_price', "total_price-{$product_total_price}", FALSE);
        $this->db->update('customer_order');

        $this->db->where('customer_order_id', $order_id);
        $this->db->where('product_id', $product_id);
        $this->db->delete('multi_customers_order_items');
        return true;
    }

    function delete_customer_order($order_id)
    {
        $this->db->where('customer_order_id', $order_id);
        $this->db->delete('multi_customers_order_items');
        $this->db->where('customer_order_id', $order_id);
        $this->db->delete('customer_order');
    }
}
