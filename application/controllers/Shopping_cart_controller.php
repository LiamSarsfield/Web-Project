<?php

class Shopping_cart_controller extends CI_Controller {
    
    
    public function view_shopping_cart() {
        
        $this->load->model("Shopping_cart_model");
        
        $data['query'] = $this->Shopping_cart_model->select_from_cart();
        
        $this->load->view('shopping_cart', $data);
        
    }
    

    public function add_product_to_shopping_cart($product_id) {
       //Calls Shopping_cart->add_to_cart($data) model to add an item to the shopping cart. 
        
        
        //Get the information from the post         
        $data['date_added'] = date('Y-m-d H:i:s');
        $data['product_id'] = $product_id;
        $data['quantity'] = $this->input->post('qty');       
        $data['session_id'] = $this->session->session_id; //Current Session Id
        
        //Get more information about the product
        $this->load->model("Product_model");
        $query = $this->Product_model->get_product_by_id($product_id);
        $data['product_name'] = $query->product_name;
        $data['product_desc'] = $query->product_desc;
        $data['price'] = $query->product_price;
//        $data['total'] = $query->product_price * $data['quantity'];
        $data['image_path'] = $query->image_path;
        
        
        
        //Call model method to add to the cart
        $this->load->model("Shopping_cart_model");
        if (!$this->Shopping_cart_model->add_to_cart($data)) {
        echo "Error Adding to Shopping Cart </br>";
        } else {
        //Get all the information for this session from the shopping cart
        $this->load->library('table'); //t
        
        $data['query'] = $this->Shopping_cart_model->select_from_cart();
        
        $this->load->view('shopping_cart', $data);
        
        redirect(site_url('/shopping_cart_controller/view_shopping_cart'));
        }
        
    }
    
    
    public function remove_product_from_cart($id){
        
         $this->load->model("Shopping_cart_model");
         
         // Calls  model to remove an item from the shopping cart.
         $this->Shopping_cart_model->remove_from_cart($id);
                 
         $data['query'] = $this->Shopping_cart_model->select_from_cart();
        
        $this->load->view('shopping_cart', $data);
    }
    
    public function checkout(){
        
        $this->load->model("Shopping_cart_model");
        
        $data['query'] = $this->Shopping_cart_model->select_from_cart();
        
//        $data['total'] = $data['query']->price;
        
        $this->load->view('payment', $data);
    }
    
    public function payment_authorisation() {
        
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

