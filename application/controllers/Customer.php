<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 11/12/2018
 * Time: 14:36
 */

class Customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
//        if ($account_info['permission_status'] !== "staff" || $account_info['permission_status'] !== "admin") {
//            redirect(site_url() . "/home");
//        }
    }

    public function view_my_orders($order_id)
    {
        $this->load->model("Customer_order_model");
        $this->load->library('table');
        $account_info = $this->session->userdata('account_info') ?? NULL;
        if (!isset($account_info['customer_id'])) {
            redirect(site_url('dashboard/home'));
        }
        if (isset($order_id)) {
            $order_info = $this->Customer_order_model->get_customer_order_by_id($order_id);
            $product_items = $this->Customer_order_model->get_customer_order_products_by_customer_order_id($order_id);
            $quote_items = $this->Customer_order_model->get_customer_order_customer_quotes_by_customer_order_id($order_id);
            $product_table = "";
            if (!empty($product_items)) {
                $this->table->set_heading("Name", "Product Price (€)", "Quantity", "Total Price(€)");
                foreach ($product_items as $product_item) {
                    $this->table->add_row($product_item->name, $product_item->price, $product_item->quantity, $product_item->price * $product_item->quantity);
                }
                $product_table = $this->table->generate();
            }
            $quote_table = "";
            if (!empty($quote_items)) {
                $this->table->set_heading("Name", "Quote Price (€)", "Quantity", "Total Price(€)");
                foreach ($quote_items as $quote_item) {
                    $this->table->add_row($quote_item->name, $quote_item->price, $quote_item->quantity, $quote_item->price * $quote_item->quantity);
                }
                $quote_table = $this->table->generate();
            }
            $data['product_table'] = $product_table;
            $data['quote_table'] = $quote_table;
            $data['order_info'] = $order_info;
            initialize_header();
            $this->load->view('customer/view_customer_order', $data);
        } else {

        }
    }

    public function edit_customer($customer_id = NULL)
    {
        $this->load->model("Customer_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
//        is_restricted($uri);
        if (!isset($customer_id)) {
            $this->session->set_flashdata('temp_info', 'You did not Enter a Customer ID!');
            redirect(site_url("/functions/view/customer/"));
        }
        $customer_info = $this->Customer_model->get_customer_edit_info($customer_id);
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
                'rules' => 'required|callback_validate_edit_customer_email[' . $this->input->post('customer_id') . ']',
                'errors' => array(
                    'validate_edit_customer_email' => '{field} already exists in DB.}',
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
            $this->load->view("customer/edit_customer", $data);
        } else {
            $this->Customer_model->edit_customer();
            $this->session->set_flashdata('temp_info', 'Customer Successfully Edited.');
            redirect(site_url("functions/view/customer/$customer_id"));
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

    public function login()
    {

        $this->load->view('login');

    }

    public function signUp()
    {

        $this->load->view('signUp');

    }

    public function loggedIn()
    {
        $this->load->view('loggedin');
    }


    public function quotes()
    {
        $this->load->view('searchquotes');
    }


    public function viewQuote()
    {
        $this->load->view('customerquote');
    }

    public function payQuote()
    {
        $this->load->view('payquote');
    }

    public function declineQuote()
    {
        $this->load->view('declinequote');
    }

    public function paymentSuccess()
    {
        $this->load->view('paymentsuccesfulquote');
    }

    public function view_customers()
    {

    }

    public function view_selected_customers($id)
    {

    }

    public function add_customer()
    {

        $this->load->view('maintaincustomer');
    }

}