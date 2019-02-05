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

    public function view_my_orders(){
        $this->load->model("Customer_order");
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->library("table");
        $customer_orders = $this->Customer_order->get_customer_orders_by_customer_id($account_info['customer_id']);
        $this->table->set_heading('Date Ordered', 'Total Price', 'View');
        foreach($customer_orders as $customer_order){
            $this->table->add_row($customer_order->date_ordered, $customer_order->total_price, "Testing");
        }
        $data = $this->table->generate();
        $this->load->view("view_customer_orders", $data);
    }
}