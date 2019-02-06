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

    public function customer_quote_form()
    {
        $this->load->model("Customer_quote_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
//        is_restricted($uri);
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            initialize_header();
            $this->load->view("store/add_customer_quote_to_cart");
        } else {
            $this->Customer_quote_model->add_customer_quote_model();
            $this->session->set_flashdata('temp_info', 'Your Quote has been successfully added to your shopping cart. Checkout now to confirm.');
            redirect(site_url("store/view_store"));
        }
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

    public function confirm_checkout()
    {
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->model(array("Shopping_cart_model", "Customer_order_model"));
        $session_customer_items = $this->Shopping_cart_model->select_from_cart();
        if ($session_customer_items == FALSE) {
            redirect(site_url('store/view_store'));
        }
        $customer_order_id = $this->Customer_order_model->add_customer_order_by_checkout($session_customer_items);
        redirect(site_url("customer_account/view_my_customer_order/$customer_order_id"));
    }
}

