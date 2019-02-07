<?php

class Work_order_model extends CI_Model
{
    function get_all_add_info($info = 0)
    {
        $staff_id = $info[0];
        $product_id = $info[1];
        $customer_quote_id = $info[2];
        $this->load->model("staff_model");
        $this->load->model("product_model");
        $this->load->model("customer_quote_model");
        $model_info['labels_info'] = "";
        $staff = $this->staff_model->get_staff_by_id($staff_id);
        $product = $this->product_model->product_model->get_product_by_product_id($product_id);
        $customer_quote = $this->customer_quote_model->get_customer_quote_by_id($customer_quote_id);
        // if staff doesn't exist prompt user for staff
        if (!$staff) {
            $model_info['labels_info'] = "<a href='staff.html'><div class='button'>Select Staff</div></a>";
            $model_info['staff_id'] = "0";
        } else if ($product) {
            $model_info['labels_info'] =
                "<p><label for='staff_id'>Staff ID:</label>
                <input name='staff_id' type='text' readonly required id='staff_id' value='{$staff->staff_id}'></p>
                <p><label for='staff_name'>Staff Name:</label>
                <input name='staff_name' type='text' readonly required id='staff_name' value='{$staff->name}'></p>
                <p><label for='product_id'>Product ID:</label>
                <input name='product_id' type='text' readonly required id='staff_id' value='{$product->product_id}'></p>
                <p><label for='name'>Product Name:</label>
                <input name='name' type='text' readonly required id='name' value='{$product->name}'></p>";
            $model_info['product_id'] = $product->product_id;
        } else if ($customer_quote) {
            $model_info['labels_info'] =
                "<p><label for='staff_id'>Staff ID:</label>
                <input name='staff_id' type='text' readonly required id='staff_id' value='{$staff->staff_id}'></p>
                <p><label for='staff_name'>Staff Name:</label>
                <input name='staff_name' type='text' readonly required id='staff_name' value='{$staff->name}'></p>
                <p><label for='customer_quote'>Customer Quote ID:</label>
                <input name='customer_quote_id' type='text' readonly required id='staff_id' value='{$customer_quote->customer_quote_id}'></p>
                <p><label for='customer_quote'>Customer Quote Name:</label>
                <input name='name' type='text' readonly required id='name' value='{$customer_quote->name}'></p>";
            $model_info['customer_quote_id'] = $customer_quote->customer_quote_id;
        } else {
            $model_info['labels_info'] .= "<p><label for='staff_id'>Staff ID:</label>
                <input name='staff_id' type='text' readonly required id='staff_id' value='{$staff->staff_id}'></p>
                <p><label for='staff_name'>Staff Name:</label>
                <input name='staff_name' type='text' readonly required id='staff_name' value='{$staff->name}'></p>";
            $model_info['labels_info'] .= "<a href='product.html'><div class='button'>Select Product</div></a>";
            $model_info['labels_info'] .= "<p>Or</p>";
            $model_info['labels_info'] .= "<a href='customer_quote.html'><div class='button'>Select Customer Quote</div></a>";
            $model_info['product_id'] = "0";
            $model_info['customer_quote'] = "0";
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
