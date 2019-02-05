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
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
        // if not signed in
        if (!isset($account_info) || $account_info['permission_id'] != "1") {
            redirect(site_url() . "/home");
        }
    }

    public function view_my_orders()
    {
        $this->load->model("Customer_order");
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->library("table");
        $customer_orders = $this->Customer_order->get_customer_orders_by_customer_id($account_info['customer_id']);
        $this->table->set_heading('Date Ordered', 'Total Price', 'View');
        foreach ($customer_orders as $customer_order) {
            $this->table->add_row($customer_order->date_ordered, $customer_order->total_price, "Testing");
        }
        $data = $this->table->generate();
        $this->load->view("view_customer_orders", $data);
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