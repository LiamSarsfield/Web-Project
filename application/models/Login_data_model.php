<?php

class Login_data_model extends CI_Model
{

    function add_login($data)
    {
        if ($this->db->insert("login_data", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function delete_login($id)
    {
//        $id = $this->input->post('id');
        $this->db->where('login_id', $id);
        $this->db->delete('login_data');
    }

    //DEPRECIATED
    function generic_login($data)
    {
        //check customer, supplier, staff
        $this->load->model("Customer_model");
        $this->load->model("Staff");
        if ($this->Customer_model->login($data)) {
        } else if ($this->staff_model->login($data)) {

        } else {
            return false;
        }
    }

    function get_all_add_info($info = 0)
    {
        $customer_id = $info;
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

