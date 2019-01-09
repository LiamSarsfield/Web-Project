<?php

class Customer_quote_model extends CI_Model
{

    function get_all_customer_quotes()
    {
        $this->db->select("customer_quote_id, name, description, price");
        $query = $this->db->get('customer_quote');
        if ($query->num_rows() > 0) {

            return $query->result_array();

        } else {
            return FALSE;
        }
    }

    function get_customer_quote_by_id($id)
    {
        $this->db->select("customer_quote_id, name, description, price");
        $this->db->where("customer_quote_id", $id);
        $query = $this->db->get('customer_quote');
        if ($query->num_rows() > 0) {
            return $query->row(0);
        }
        return false;
    }

    function add_customer_quote($data)
    {
        if ($this->db->insert("customer_quote", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_customer_quote($id)
    {
        $this->db->where('customer_quote_id', $id);
        $this->db->delete('customer_quote');

    }

    public function get_all_add_info($info = 0)
    {
        $customer_id = $info;
        $this->load->model("customer_model");
        $customer = $this->customer_model->get_customer_by_id($customer_id);
        // if customer is false (No customer was selected before hand...
        if (!$customer) {
            $model_info['labels_info'] = "<a href='customer.html'><div class='customerselect'>You need to select a Customer first</div></a>";
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
