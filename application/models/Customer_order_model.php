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

    function get_order_by_id($id)
    {
//        $id = $this->input->post('order_id');
        $this->db->select("order_id, order_date, total_price, customer_id, customer_invoice_id, credit_note_id");
        $this->db->where("order_id", $id);
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
}
