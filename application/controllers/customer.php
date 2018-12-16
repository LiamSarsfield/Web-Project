<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 11/12/2018
 * Time: 14:36
 */

class customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $login_info = $this->session->userdata('login_info') ?? NULL;
//        if ($login_info['permission_status'] !== "staff" || $login_info['permission_status'] !== "admin") {
//            redirect(site_url() . "/home");
//        }
    }

    public function index()
    {
        redirect(site_url() . "/customer/view_customers");
    }

    public function view_customers()
    {
        $this->load->library(array('pagination','table'));
        $this->load->model("Customer_model");
        $this->load->view("template/header");
        //pagination
        $customer_row_count = $this->Customer_model->get_customer_rows();
        // lets say there is 200 customers in database
        $config['total_rows'] = 200;
        $config['per_page'] = 10;
        $config['base_url'] = site_url('Home/select_entries_per_page');

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3) ??  0;
        $data['pagination'] = $this->pagination->create_links();
        $customers = $this->Customer_model->get_customers_by_limit($config["per_page"], $page);

        //table
        $this->table->set_heading('Customer ID', 'Name', 'Email');
        foreach($customers as $customer){
            $this->table->add_row($customer->customer_id, $customer->first_name . " " . $customer ->last_name, $customer->email);
        }
        $data['table'] = $this->table->generate();
        $this->load->view("generic/generic_staff_view", $data);
    }
    //index - shop
    //    //view_product
    //    //add_product_to_cart - session
    //    //view_shopping_cart
    //    //order_products -- insert
    //    //view_account
    //    //view_orders -- update
    //    //logout
}