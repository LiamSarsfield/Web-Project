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
        $data['product'] = $this->Product_model->get_product_by_product_id($id);
        $this->load->view('store/view_product', $data);

    }

    public function customer_quote_form()
    {
        $this->load->model("Customer_quote_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required|callback_is_money',
                'errors' => array(
                    'is_money' => '{field} you entered is not money.'
                ),
            ),
            array(
                'field' => 'quantity',
                'label' => 'Quantity',
                'rules' => 'required|numeric'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            initialize_header();
            $this->load->view("store/customer_quote_form");
        } else {
            $account_info = $this->session->userdata('account_info') ?? NULL;
            $customer_quotes = $this->session->userdata('customer_quote_basket') ?? array();
            $customer_quote = array(
                'customer_id' => $account_info['customer_id'],
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'specs' => $this->input->post('specs'),
                'price' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
            );
            $customer_quotes[] = $customer_quote;
            $this->session->set_userdata('customer_quote_basket', $customer_quotes);
            $this->session->set_flashdata('temp_info', 'Your Quote has been successfully added to your shopping cart. Checkout now to confirm.');
            redirect(site_url("store/view_store"));
        }
    }

    public function checkout()
    {
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $data['logged_in'] = ($account_info == NULL) ? FALSE : TRUE;
        $this->load->library('table');
        $this->table->set_heading('Product', 'Quantity', 'Price');
        $this->load->model(array("Shopping_cart_model", "Customer_model"));
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        // will return array with customer items, else false
        $session_customer_products = $this->Shopping_cart_model->select_from_cart() ?? array();
        $session_customer_quotes = $this->session->userdata('customer_quote_basket') ?? array();
        $basket_total = "";
        $customer_details = "";
        if ($data['logged_in'] == FALSE) {
            initialize_header();
            $this->load->view('store/checkout_confirmation', $data);
        } else if ($session_customer_products == FALSE && $session_customer_quotes == FALSE) {
            $data['basket_total'] = $basket_total;
            $data['customer_details'] = $customer_details;
            initialize_header();
            $this->load->view('store/checkout_confirmation', $data);
        } else {
            $basket_total = 0;
            if (!empty($session_customer_products)) {
                $this->table->set_heading("Name", "Quantity", "Price");
                foreach ($session_customer_products as $session_customer_item) {
                    $basket_total += $session_customer_item->total;
                    $this->table->add_row($session_customer_item->name, $session_customer_item->quantity, $session_customer_item->total);
                }
                $product_table = $this->table->generate();
            } else {
                $product_table = "";
            }
            if (!empty($session_customer_quotes)) {
                $this->table->set_heading("Name", "Quantity", "Price");
                foreach ($session_customer_quotes as $session_customer_item) {
                    $customer_quote_total = $session_customer_item['quantity'] * $session_customer_item['price'];
                    $this->table->add_row($session_customer_item['name'], $session_customer_item['quantity'], $customer_quote_total);
                    $basket_total += $customer_quote_total;
                }
                $customer_quote_table = $this->table->generate();
            } else {
                $customer_quote_table = "";
            }
            $customer_details = $this->Customer_model->get_customer_info_by_id($account_info['customer_id']);
            $data['product_table'] = $product_table;
            $data['customer_quote_table'] = $customer_quote_table;
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
        $session_customer_products = $this->Shopping_cart_model->select_from_cart();
        $session_customer_quotes = $_SESSION['customer_quote_basket'] ?? array();
        if ($session_customer_products == FALSE && empty($session_customer_quotes)) {
            redirect(site_url('store/view_store'));
        }
        $customer_order_id = $this->Customer_order_model->add_customer_order_by_checkout($session_customer_products, $session_customer_quotes);
        $this->Shopping_cart_model->clear_shopping_cart();
        unset($_SESSION['customer_quote_basket']);
        redirect(site_url("customer_account/view_my_customer_order/$customer_order_id"));
    }

    public function is_money($price)
    {
        if (preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $price)) {
            return true;
        } else {
            return false;
        }
    }
}

