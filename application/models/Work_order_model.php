<?php

class Work_order_model extends CI_Model
{
    public function view_all_unassigned_work_orders()
    {
        $this->db->select("work_order.work_order_id, customer_quote.name as 'quote_name', customer_quote.price as 'quote_price', 
                multi_customers_order_items.quantity as 'quote_quantity', CONCAT(account.first_name, ' ', account.last_name) as 'customer_name'");
        $this->db->from('work_order');
        $this->db->join('customer_quote', 'work_order.customer_quote_id = customer_quote.customer_quote_id', 'inner');
        $this->db->join('multi_customers_order_items', 'customer_quote.customer_quote_id = multi_customers_order_items.customer_quote_id', 'inner');
        $this->db->join('customer', 'customer_quote.customer_id = customer.customer_id', 'inner');
        $this->db->join('account', 'customer.account_id = account.account_id', 'inner');
        $this->db->where('work_order.staff_id IS NULL');
        $this->db->where('work_order.is_completed', '0');
        return $this->db->get()->result();
    }

    public function view_work_order($work_order_id)
    {
        $this->db->select("work_order.work_order_id, CONCAT(account.first_name, ' ', account.last_name) as 'customer_name', 
      customer_order.date_ordered as 'order_date', multi_customers_order_items.quantity as 'requested_quantity', 
      customer_quote.name as 'quote_name', customer_quote.description as 'quote_description', customer_quote.specs as 'quote_specs',
      customer_quote.price as 'quote_price', customer_quote.stock_quantity as 'quote_stock_quantity', work_order.status as 'quote_status'");
        $this->db->from('work_order');
        $this->db->join('customer_quote', 'work_order.customer_quote_id = customer_quote.customer_quote_id', 'inner');
        $this->db->join('multi_customers_order_items', 'customer_quote.customer_quote_id = multi_customers_order_items.customer_quote_id', 'inner');
        $this->db->join('customer_order', 'multi_customers_order_items.customer_order_id = customer_order.customer_order_id', 'inner');
        $this->db->join('customer', 'customer_quote.customer_id = customer.customer_id', 'inner');
        $this->db->join('account', 'customer.account_id = account.account_id', 'inner');
        $this->db->where('work_order.work_order_id', $work_order_id);
        return $this->db->get()->row();
    }

    public function assign_work_order($work_order_id, $staff_id)
    {
        $work_order_info = array(
            'staff_id' => $staff_id,
            'status' => 'Staff Assigned'
        );
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order', $work_order_info);
    }

    public function get_work_orders_by_staff_id($staff_id)
    {
        $this->db->select("work_order.work_order_id, work_order.status as'quote_status', CONCAT(account.first_name, ' ', account.last_name) as 'customer_name', 
      customer_order.date_ordered as 'order_date', multi_customers_order_items.quantity as 'requested_quantity', 
      customer_quote.name as 'quote_name', customer_quote.description as 'quote_description', customer_quote.specs as 'quote_specs',
      customer_quote.price as 'quote_price', customer_quote.stock_quantity as 'quote_stock_quantity'");
        $this->db->from('work_order');
        $this->db->join('customer_quote', 'work_order.customer_quote_id = customer_quote.customer_quote_id', 'inner');
        $this->db->join('multi_customers_order_items', 'customer_quote.customer_quote_id = multi_customers_order_items.customer_quote_id', 'inner');
        $this->db->join('customer_order', 'multi_customers_order_items.customer_order_id = customer_order.customer_order_id', 'inner');
        $this->db->join('customer', 'customer_quote.customer_id = customer.customer_id', 'inner');
        $this->db->join('account', 'customer.account_id = account.account_id', 'inner');
        $this->db->where('work_order.staff_id', $staff_id);
        return $this->db->get()->result();
    }

    public function edit_work_order($work_order_id, $work_order_data)
    {
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order', $work_order_data);
    }

    public function get_customer_quote_id_by_work_order_id($work_order_id)
    {
        $this->db->select('customer_quote_id');
        $this->db->from('work_order');
        $this->db->where('work_order_id', $work_order_id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return $result->row()->customer_quote_id;
        } else {
            return false;
        }
    }

    public function confirm_work_order_ownership_by_staff_id($work_order_id, $staff_id)
    {
        $this->db->select('staff_id');
        $this->db->from('work_order');
        $this->db->where('work_order_id', $work_order_id);
        $this->db->where('staff_id', $staff_id);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function unassign_work_order($work_order_id)
    {
        $this->db->set('staff_id', null);
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order');
    }

    public function complete_work_order($work_order_id)
    {
        $this->db->set('staff_id', null);
        $this->db->set('is_completed', '1');
        $this->db->where('work_order_id', $work_order_id);
        $this->db->update('work_order');
    }
//    function get_all_add_info($info = 0)
//    {
//        $staff_id = $info[0];
//        $product_id = $info[1];
//        $customer_quote_id = $info[2];
//        $this->load->model("staff_model");
//        $this->load->model("product_model");
//        $this->load->model("customer_quote_model");
//        $model_info['labels_info'] = "";
//        $staff = $this->staff_model->get_staff_by_id($staff_id);
//        $product = $this->product_model->product_model->get_product_by_product_id($product_id);
//        $customer_quote = $this->customer_quote_model->get_customer_quote_by_id($customer_quote_id);
//        // if staff doesn't exist prompt user for staff
//        if (!$staff) {
//            $model_info['labels_info'] = "<a href='staff.html'><div class='button'>Select Staff</div></a>";
//            $model_info['staff_id'] = "0";
//        } else if ($product) {
//            $model_info['labels_info'] =
//                "<p><label for='staff_id'>Staff ID:</label>
//                <input name='staff_id' type='text' readonly required id='staff_id' value='{$staff->staff_id}'></p>
//                <p><label for='staff_name'>Staff Name:</label>
//                <input name='staff_name' type='text' readonly required id='staff_name' value='{$staff->name}'></p>
//                <p><label for='product_id'>Product ID:</label>
//                <input name='product_id' type='text' readonly required id='staff_id' value='{$product->product_id}'></p>
//                <p><label for='name'>Product Name:</label>
//                <input name='name' type='text' readonly required id='name' value='{$product->name}'></p>";
//            $model_info['product_id'] = $product->product_id;
//        } else if ($customer_quote) {
//            $model_info['labels_info'] =
//                "<p><label for='staff_id'>Staff ID:</label>
//                <input name='staff_id' type='text' readonly required id='staff_id' value='{$staff->staff_id}'></p>
//                <p><label for='staff_name'>Staff Name:</label>
//                <input name='staff_name' type='text' readonly required id='staff_name' value='{$staff->name}'></p>
//                <p><label for='customer_quote'>Customer Quote ID:</label>
//                <input name='customer_quote_id' type='text' readonly required id='staff_id' value='{$customer_quote->customer_quote_id}'></p>
//                <p><label for='customer_quote'>Customer Quote Name:</label>
//                <input name='name' type='text' readonly required id='name' value='{$customer_quote->name}'></p>";
//            $model_info['customer_quote_id'] = $customer_quote->customer_quote_id;
//        } else {
//            $model_info['labels_info'] .= "<p><label for='staff_id'>Staff ID:</label>
//                <input name='staff_id' type='text' readonly required id='staff_id' value='{$staff->staff_id}'></p>
//                <p><label for='staff_name'>Staff Name:</label>
//                <input name='staff_name' type='text' readonly required id='staff_name' value='{$staff->name}'></p>";
//            $model_info['labels_info'] .= "<a href='product.html'><div class='button'>Select Product</div></a>";
//            $model_info['labels_info'] .= "<p>Or</p>";
//            $model_info['labels_info'] .= "<a href='customer_quote.html'><div class='button'>Select Customer Quote</div></a>";
//            $model_info['product_id'] = "0";
//            $model_info['customer_quote'] = "0";
//        }
//        return $model_info;
//    }

//    public function add_customer_quote_by_post()
//    {
//        $customer_quote_info = array(
//            "customer_id" => $this->input->post("customer_id"),
//            "name" => $this->input->post("name"),
//            "description" => $this->input->post("description"),
//            "specs" => $this->input->post("specs"),
//            "price" => $this->input->post("price"),
//        );
//        if ($this->db->insert("customer_quote", $customer_quote_info)) {
//            return TRUE;
//        } else {
//            return TRUE;
//        }
//    }
}
