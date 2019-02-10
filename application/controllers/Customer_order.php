<?php
/**
 * Created by PhpStorm.
 * User: liam1
 * Date: 31/01/2019
 * Time: 14:59
 */

class Customer_order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function edit_customer_order($customer_order_id = NULL)
    {
        //unfinished, not ready for testing
        $this->load->model(array("Customer_order_model", "Customer_model"));
        $this->load->helper(array('form'));
        $this->load->library(array('form_validation', 'table'));
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (!isset($customer_order_id)) {
            $this->session->set_flashdata('temp_info', 'You did not Enter a Customer Order ID!');
            redirect(site_url("/functions/view/customer_order/"));
        }
        $customer_order_info = $this->Customer_order_model->get_customer_order_info_by_id($customer_order_id);
        $customers = $this->Customer_model->get_all_customers();
        //products and customer quote info
        $products = $this->Customer_order_model->get_customer_order_products_by_customer_order_id($customer_order_id);
        $product_table = "No Products in Customer Order";
        if (!empty($products)) {
            $this->table->set_heading("Product ID", "Name", "Price", "quantity");
            foreach ($products as $product) {
                $this->table->add_row($product->product_id, $product->name, $product->price, $product->quantity);
            }
            $product_table = $this->table->generate();
        }
        $customer_quotes = $this->Customer_order_model->get_customer_order_customer_quotes_by_customer_order_id($customer_order_id);
        $customer_quote_table = "No Customer Quotes in Customer Order";
        if (!empty($customer_quotes)) {
            $this->table->set_heading("Customer Quote ID", "Name", "Price", "quantity");
            foreach ($customer_quotes as $customer_quote) {
                $this->table->add_row($customer_quote->customer_quote_id, $customer_quote->name, $customer_quote->price, $customer_quote->quantity);
            }
            $customer_quote_table = $this->table->generate();
        }
        $config = array(
            array(
                'field' => 'date_ordered',
                'label' => 'Date Ordered',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['customer_order_id'] = $customer_order_id;
            $data['customer_order_info'] = $customer_order_info;
            $data['customers'] = $customers;
            $data['product_table'] = $product_table;
            $data['customer_quote_table'] = $customer_quote_table;
            initialize_header();
            $this->load->view("customer/edit_customer_order", $data);
        } else {
            $this->Customer_order_model->edit_customer_order_model();
            $this->session->set_flashdata('temp_info', 'Customer Order Successfully Edited.');
            redirect(site_url("functions/view/customer/$customer_order_id"));
        }
    }

    public function edit_change_customer_order_products($customer_order_id = NULL, $product_id = NULL, $quantity = NULL)
    {
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (!isset($customer_order_id)) {
            $this->session->set_flashdata('temp_info', 'You have not selected a Customer Order ID.');
            redirect(site_url('functions/view/customer_order'));
        } else if (isset($product_id) && isset($quantity)) {
            $this->session->set_flashdata('temp_info', 'You have not selected a Customer Order ID.');
            redirect(site_url('customer_order/edit_change_customer_order_products'));
        } else {
            $this->load->model(array("Customer_order_model", "Product_model"));
            $this->load->library(array('table'));
            $products = $this->Product_model->get_all_products();
            $products_selected = $this->session->userdata("changed_edit_product_info") ?? $this->Customer_order_model->get_customer_order_products_by_customer_order_id($customer_order_id);
            $this->table->set_heading("Product ID", "Name", "Price", "Quantity", "Select");
            foreach ($products as $product) {
                $default_stock_value = 0;
                foreach ($products_selected as $product_selected) {
                    if ($product_selected->product_id == $product->product_id) {
                        $default_stock_value = $product_selected->quantity;
                        $product->stock_quantity = $product_selected->quantity;
                    }
                }
                if ($product->stock_quantity == 0 && $default_stock_value == 0) {
                    $select_quantity = "Out of Stock";
                } else {
                    $select_quantity = "<select name='quantity'>";
                    for ($i = 0; $i <= $product->stock_quantity; $i++) {
                        if ($i == $default_stock_value) {
                            $select_quantity .= "<option selected value='{$i}'>$i</option>";
                        } else {
                            $select_quantity .= "<option value='{$i}'>$i</option>";
                        }
                    }
                    $select_quantity .= "</select>";
                }
                $this->table->add_row($product->product_id, $product->name, $product->price, $select_quantity,
                    "<a href='" . site_url("customer_order/edit_change_customer_order_products/{$customer_order_id}") . "'>
                    <div class='button'>Select</div>
                </a>");
            }
            $products_table = $this->table->generate();
            $data['products_table'] = $products_table;
            initialize_header();
            $this->load->view("customer/edit_customer_order_products", $data);
        }

    }
}