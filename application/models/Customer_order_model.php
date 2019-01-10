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
        $this->db->select("order_id, date_ordered, total_price, customer_id, customer_invoice_id");
        $this->db->where("order_id", $customer_order);
        $query = $this->db->get('customer_order');
        if ($query->num_rows() > 0) {
            return $query->row(0);
        }
        return false;
    }

    //will inner join fks
    function get_customer_order_info_by_id($customer_order_id)
    {
        $concat_name = "CONCAT(account.first_name, ' ', account.last_name) AS name";
        $concat_address = "CONCAT (account.address_one, account.address_two, account.city, account.country) AS address";
        $this->db->select("customer_order.customer_order_id, customer_order.date_ordered, $concat_name, $concat_address");
        $this->db->join('customer', 'customer.customer_id = customer_order.customer_id', 'inner');
        $this->db->join('account', 'account.account_id = account.account_id', 'inner');
        $this->db->where('customer_order_id', $customer_order_id);
        $query = $this->db->get('customer_order');
        if ($query->num_rows() > 0) {
            return $query->row(0);
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

    function delete_customer_order($id)
    {
//        $id = $this->input->post('id');
        $this->db->where('order_id', $id);
        $this->db->delete('customer_order');
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
        $customer = $this->customer_model->get_customer_by_id($customer_id);
        // if customer is false (No customer was selected before hand...
        if (!$customer) {
            $model_info['labels_info'] = "<a href='customer.html'><div class='button'>You need to select a Customer first</div></a>";
            $model_info['customer_id'] = "0";
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
}
