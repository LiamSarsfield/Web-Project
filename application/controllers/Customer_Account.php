<?php
/**
 * Created by PhpStorm.
 * User: liam1
 * Date: 03/02/2019
 * Time: 21:18
 */

class Customer_Account extends CI_Controller
{
    function __construct()
    {
        // Customer Account = ONLY THINGS CUSTOMERS CAN ACCESS
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
        // if not signed in
        if (!isset($account_info) || $account_info['permission_id'] != "1") {
            redirect(site_url() . "/home");
        }
    }

    public function view_my_customer_orders()
    {
        $this->load->model("Customer_order_model");
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->library("table");
        $customer_orders = $this->Customer_order_model->get_customer_orders_by_customer_id($account_info['customer_id']);
        if ($customer_orders == FALSE) {
            $this->session->set_flashdata('temp_info', 'You have no Customer Orders.');
            redirect(site_url('dashboard/home'));
        }
        $this->table->set_heading('Date Ordered', 'Total Price', 'View');
        foreach ($customer_orders as $customer_order) {
            $view_customer_order_href = site_url("customer_account/view_my_customer_order/{$customer_order->customer_order_id}");
            $this->table->add_row($customer_order->date_ordered, $customer_order->total_price,
                "<a href='{$view_customer_order_href}'><div class='button'>View</div></div></a>");
        }
        $data['table'] = $this->table->generate();
        initialize_header();
        $this->load->view("customer/view_my_customer_orders", $data);
    }

    public function view_my_customer_order($customer_order_id = NULL)
    {
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->model(array("Customer_order_model", "Customer_model", "Product_model"));
        $this->load->helper(array('form'));
        $this->load->library(array('form_validation', 'table'));
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
//        is_restricted($uri);
        if (!isset($customer_order_id)) {
            $this->session->set_flashdata('temp_info', 'You did not select a Customer Order!');
            redirect(site_url("/customer_account/view_my_customer_orders"));
        }
        if ($this->Customer_order_model->confirm_customer_owns_order($account_info['customer_id'], $customer_order_id) == FALSE) {
            $this->session->set_flashdata('temp_info', 'That is not your Customer Order!');
            redirect(site_url("/customer_account/view_my_customer_orders"));
        }
        $customer_order_info = $this->Customer_order_model->get_customer_order_info_by_id($customer_order_id);
        $current_date = new DateTime(date("Y-m-d"));
        $date_ordered = new DateTime($customer_order_info->date_ordered);
        $day_difference = (int)$current_date->diff($date_ordered)->format("%a");
        if (empty($customer_quotes)) {
            if ($day_difference >= 0 && $day_difference < 3) {
                $customer_order_info->delivery = "In Processing";
            } else if ($day_difference >= 3 && $day_difference < 7) {
                $customer_order_info->delivery = "In Shipping";
            } else if ($day_difference >= 7) {
                $customer_order_info->delivery = "Delivered";
            } else {
                $customer_order_info->delivery = "Error receiving Delivery Info";
            }
        } else {
            $customer_quotes_are_finished = true;
            foreach ($customer_quotes as $customer_quote) {
                if ($customer_quote->is_completed == FALSE) {
                    $customer_quotes_are_finished = FALSE;
                    break;
                }
            }
            if ($customer_quotes_are_finished) {
                if ($day_difference >= 0 && $day_difference < 3) {
                    $customer_order_info->delivery = "Processing";
                } else if ($day_difference >= 3 && $day_difference < 7) {
                    $customer_order_info->delivery = "In Shipping";
                } else if ($day_difference >= 7) {
                    $customer_order_info->delivery = "Delivered";
                } else {
                    $customer_order_info->delivery = "Error receiving Delivery Info";
                }
            } else {
                $customer_order_info->delivery = "Awaiting Customer Quote Production";
            }
        }
        //products and customer quote info
        $products = $this->Customer_order_model->get_customer_order_products_by_customer_order_id($customer_order_id);
        $product_table = "No Products in Customer Order";
        if (!empty($products)) {
            if ($day_difference < 3) {
                $this->table->set_heading("Product ID", "Name", "Price", "Quantity", "Remove");
                foreach ($products as $product) {
                    $remove_href = site_url("customer_account/edit_customer_order/{$customer_order_id}/product/delete/{$product->product_id}");
                    $this->table->add_row($product->product_id, $product->name, $product->price, $product->quantity, "<a href='{$remove_href}'><div class='button'>Remove</div></a>");
                }
                $product_table = $this->table->generate();
            } else {
                $this->table->set_heading("Product ID", "Name", "Price", "Quantity");
                foreach ($products as $product) {
                    $this->table->add_row($product->product_id, $product->name, $product->price, $product->quantity);
                }
                $product_table = $this->table->generate();
            }
        }
        $customer_quotes = $this->Customer_order_model->get_customer_order_customer_quotes_by_customer_order_id($customer_order_id);
        $customer_quote_table = "No Customer Quotes in Customer Order";
        if (!empty($customer_quotes)) {
            if ($day_difference < 3) {
                $this->table->set_heading("Customer Quote ID", "Name", "Price", "Quantity", "Remove");
                foreach ($customer_quotes as $customer_quote) {
                    $remove_href = site_url("customer_account/edit_customer_order/{$customer_order_id}/customer_quote/delete/{$customer_quote->customer_quote_id}");
                    $this->table->add_row($customer_quote->customer_quote_id, $customer_quote->name, $customer_quote->price, $customer_quote->quantity, "<a href='{$remove_href}'><div class='button'>Remove</div></a>");
                }
                $customer_quote_table = $this->table->generate();
            } else {
                $this->table->set_heading("Customer Quote ID", "Name", "Price", "Quantity");
                foreach ($customer_quotes as $customer_quote) {
                    $this->table->add_row($customer_quote->customer_quote_id, $customer_quote->name, $customer_quote->price, $customer_quote->quantity);
                }
                $customer_quote_table = $this->table->generate();
            }
        }
        // delivery info
        //available functions
        $available_functions = array();
        if ($day_difference < 3) {
            $available_function = new stdClass();
            $available_function->name = "Cancel Order";
            $available_function->anchor_tag = site_url("customer_account/cancel_my_customer_order/{$customer_order_id}");
            $available_functions[] = $available_function;
        } else {
            $available_function = new stdClass();
            $available_function->name = "Request Credit Note";
            $available_function->anchor_tag = site_url("customer_account/request_credit_note/{$customer_order_id}");
            $available_functions[] = $available_function;
        }
        $data['customer_order_id'] = $customer_order_id;
        $data['customer_order_info'] = $customer_order_info;
        $data['product_table'] = $product_table;
        $data['customer_quote_table'] = $customer_quote_table;
        $data['available_functions'] = $available_functions;
        initialize_header();
        $this->load->view("customer/view_my_customer_order", $data);
    }

    public function edit_my_customer_order($customer_order_id = NULL, $item_name = NULL, $function = NULL, $item_id = NULL)
    {
        // can only change quantity, delete existing products, delete existing customer orders
        if (isset($function) && isset($item_id)) {

        } else if (isset($item_name)) {

        } else if (isset($customer_order_id)) {

        } else {
            $this->session->set_flashdata('temp_info', 'You did not select a Customer Order!');
            redirect(site_url("/customer_account/view_my_customer_orders"));
        }
    }

    public function cancel_my_customer_order($customer_order_id = NULL)
    {
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->model(array("Customer_order_model", "Customer_model"));
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
//        is_restricted($uri);
        if (!isset($customer_order_id)) {
            $this->session->set_flashdata('temp_info', 'You did not select a Customer Order!');
            redirect(site_url("/customer_account/view_my_customer_orders"));
        }
        if ($this->Customer_order_model->confirm_customer_owns_order($account_info['customer_id'], $customer_order_id) == FALSE) {
            $this->session->set_flashdata('temp_info', 'That is not your Customer Order!');
            redirect(site_url("/customer_account/view_my_customer_orders"));
        }
        $this->Customer_order_model->delete_customer_order($customer_order_id);
        $this->session->set_flashdata('temp_info', 'Your Customer Order has been Successfully Cancelled');
        redirect(site_url("/dashboard/home"));
    }

    public function edit_my_account()
    {
        $this->load->model("Customer_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        $account_info = $this->session->userdata('account_info') ?? NULL;
        if (!isset($account_info['customer_id'])) {
            $this->session->set_flashdata('temp_info', 'Cannot find your Customer ID.');
            redirect('dashboard/home');
        }
        $customer_info = $this->Customer_model->get_customer_edit_info($account_info['customer_id']);
        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'last_name',
                'label' => 'Last name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|callback_validate_edit_customer_email[' . $account_info['customer_id'] . ']',
                'errors' => array(
                    'validate_edit_customer_email' => '{field} already exists in DB.',
                )
            ),
            array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required'
            ),
            array(
                'field' => 'address_one',
                'label' => 'Address One',
                'rules' => 'required'
            ),
            array(
                'field' => 'address_two',
                'label' => 'Address Two',
                'rules' => 'required'
            ),
            array(
                'field' => 'city',
                'label' => 'City',
                'rules' => 'required'
            ),
            array(
                'field' => 'province',
                'label' => 'Province',
                'rules' => 'required'
            ),
            array(
                'field' => 'postal_code',
                'label' => 'Postal Code',
                'rules' => 'required'
            ),
            array(
                'field' => 'company',
                'label' => 'Company',
                'rules' => 'required'
            ),
            array(
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['customer_info'] = $customer_info;
            initialize_header();
            $this->load->view("customer/view_my_account", $data);
        } else {
            $this->Customer_model->edit_customer($account_info['customer_id']);
            $this->session->set_flashdata('temp_info', 'You have successfully edited your account.');
            redirect(site_url("dashboard/home"));
        }
    }

    public function validate_edit_customer_email($changed_customer_email, $customer_id = "0")
    {
        $customer_email = $this->Customer_model->get_customer_email_by_customer_id($customer_id);
        if ($changed_customer_email == $customer_email)
            return true;
        $this->load->model("Account_model");
        $email_is_unique = $this->Account_model->check_if_email_is_unique($changed_customer_email);
        if ($email_is_unique) {
            return true;
        } else {
            return false;
        }
    }
}