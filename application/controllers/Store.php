<?php

class Store extends CI_Controller
{


    public function view_store()
    {
        $this->load->model("Product_model");
        $data['query'] = $this->Product_model->get_all_products();
        initialize_header();
        $this->load->view('store/store', $data);
    }

    public function view_selected_product($id)
    {
        $this->load->model("Product_model");
        $data['product'] = $this->Product_model->get_product_by_id($id);
        $this->load->view('store/view_product', $data);

    }
    public function checkout()
    {
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->library('table');
        $this->table->set_heading('Product', 'Quantity', 'Price');
        $this->load->model(array("Shopping_cart_model", "Customer_model"));
        // will return array with customer items, else false
        $session_customer_items = $this->Shopping_cart_model->select_from_cart();
        $table = "";
        $basket_total = "";
        $customer_details = "";
        $this->table->set_heading("Name", "Quantity", "Price");
        if ($session_customer_items == FALSE) {
            $table = "";
            $data['table'] = $table;
            $data['basket_total'] = $basket_total;
            $data['customer_details'] = $customer_details;
            initialize_header();
            $this->load->view('store/checkout_confirmation', $data);
        } else {
            $basket_total = 0;
            foreach ($session_customer_items as $session_customer_item) {
                $basket_total += $session_customer_item->total;
                $this->table->add_row($session_customer_item->name, $session_customer_item->quantity, $session_customer_item->total);
            }
            $table = $this->table->generate();
            $customer_details = $this->Customer_model->get_customer_info_by_id($account_info['customer_id']);
            $data['table'] = $table;
            $data['basket_total'] = $basket_total;
            $data['customer_details'] = $customer_details;
            initialize_header();
            $this->load->view('store/checkout_confirmation', $data);
        }
    }
    public function confirm_checkout(){
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->model(array("Shopping_cart_model", "Customer_order_model"));
        $session_customer_items = $this->Shopping_cart_model->select_from_cart();
        if($session_customer_items == FALSE){
            redirect(site_url('store/view_store'));
        }
        $customer_order_id = $this->Customer_order_model->add_customer_order_by_checkout($session_customer_items);
        redirect(site_url("customer/view_my_orders/$customer_order_id"));
    }
}

