<?php

class Customer_invoice_model extends CI_Model
{

    function get_all_customer_invoices()
    {
        $this->db->select("invoice_id, customer_id, order_number, quantity, price");
        $query = $this->db->get('customer_invoice');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return FALSE;
        }
    }

    function get_customer_invoice_by_id($id)
    {
        $this->db->select("invoice_id, customer_id, order_number, quantity, price");
        $this->db->where("invoice_id", $id);
        $query = $this->db->get('customer_invoice');
        if ($query->num_rows() > 0) {
            return $query->row(0);
        }
        return false;
    }

    function add_customer_invoice($data)
    {
        if ($this->db->insert("customer_invoice", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_customer_invoice($id)
    {
        $this->db->where('invoice_id', $id);
        $this->db->delete('customer_invoice');
    }

    public function get_all_add_info($info = 0)
    {
        $customer_order_id = $info;
        $this->load->model("customer_order_model");
        // will retrieve labels: order id, , date ordered, customer order name
        $customer = $this->customer_order_model->get_customer_order_info_by_id($customer_order_id);
        // if customer is false (No customer was selected before hand...
        if (!$customer) {
            $model_info['labels_info'] = "<a href='customer.html'><div class='button'>You need to select a Customer Order to view its Invoice</div></a>";
            $model_info['customer_order_id'] = "0";
        } else {
            $model_info['labels_info'] =
                "<p><label for='customer_order_id'>Order ID:</label>
                <input name='customer_order_id' type='text' readonly required id='' value='{$customer->customer_order_id}'></p>
                <p><label for='date_ordered'>Ordered Date:</label>
                <input name='date_ordered' type='text' readonly required id='' value='{$customer->date_ordered}'></p>
                <p><label for='name'>Customer Name:</label>
                <input name='name' type='text' readonly required id='' value='{$customer->name}'></p>";
            $model_info['customer_order_id'] = $customer->customer_order_id;
        }
        return $model_info;
    }

    public function add_customer_invoice_by_post()
    {
        $customer_invoice = array(
            "customer_order_id" => $this->input->post("customer_order_id"),
            "total_price" => $this->input->post("total_price"),
        );
        if ($this->db->insert("customer_invoice", $customer_invoice)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    public function get_customer_invoices_by_customer_id($customer_id)
    {
        $this->db->from("customer_invoice");
        $this->db->join("customer_order", "customer_invoice.customer_order_id = customer_order.customer_order_id", "inner");
        $this->db->where("customer_order.customer_id", $customer_id);
        return $this->db->get()->result();
    }
}
