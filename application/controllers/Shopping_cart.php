<?php

class Shopping_cart extends CI_Controller
{

    public function view_shopping_cart()
    {
        $this->load->model("Shopping_cart_model");
        $data['shopping_cart_items'] = $this->Shopping_cart_model->select_from_cart();
        $this->load->view('store/shopping_cart', $data);
    }


    public function add_product_to_shopping_cart($product_id)
    {
        //Calls Shopping_cart->add_to_cart($data) model to add an item to the shopping cart.
        //Get the information from the post
        $data['date_added'] = date('Y-m-d H:i:s');
        $data['product_id'] = $product_id;
        $data['quantity'] = $this->input->post('qty');
        $data['session_id'] = $this->session->session_id; //Current Session Id
        //Get more information about the product
        $this->load->model("Product_model");
        $product = $this->Product_model->get_product_by_id($product_id);
        $data['name'] = $product->name;
        $data['description'] = $product->description;
        $data['price'] = $product->price;
//        $data['total'] = $query->product_price * $data['quantity'];
        $data['image_path'] = $product->image_path;


        //Call model method to add to the cart
        $this->load->model("Shopping_cart_model");
        if (!$this->Shopping_cart_model->add_to_cart($data)) {
            echo "Error Adding to Shopping Cart </br>";
        } else {
            //Get all the information for this session from the shopping cart
            $this->load->library('table'); //t

            $data['query'] = $this->Shopping_cart_model->select_from_cart();

            $this->load->view('store/shopping_cart', $data);

            redirect(site_url('/shopping_cart/view_shopping_cart'));
        }

    }


    public function remove_product_from_cart($id)
    {

        $this->load->model("Shopping_cart_model");

        // Calls  model to remove an item from the shopping cart.
        $this->Shopping_cart_model->remove_from_cart($id);

        $data['query'] = $this->Shopping_cart_model->select_from_cart();

        $this->load->view('store/shopping_cart', $data);
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
            $table = "No items in basket.";
            $data['table'] = $table;
            $data['basket_total'] = $basket_total;
            $data['customer_details'] = $customer_details;
            initialize_header();
            $this->load->view('store/checkout_confirmation', $data);
        } else {
            $basket_total = 0;
            $session_customer_items = $session_customer_items->result();
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

    public
    function payment_authorisation()
    {

//        $this->load->model("Shopping_cart_model");
//
//        $data['query'] = $this->Shopping_cart_model->select_from_cart();

        $data['customer_id'] = 101; //future customer ID
        $data['order_date'] = date('Y-m-d H:i:s');
        $data['total_price'] = $this->input->post('total');


//        $this->load->model("Customer_order_model");
//
//        $this->Customer_order_model->add_customer_order($data);

        $this->load->model("Shopping_cart_model");

        // Calls  model to remove an item from the shopping cart.
        $this->Shopping_cart_model->clear_shopping_cart();

        $this->load->view('payment_successful');
    }

}

