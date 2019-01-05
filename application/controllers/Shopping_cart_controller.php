<?php

class Shopping_cart_controller extends CI_Controller {
    

    public function add_product_to_shopping_cart($product_id) {
       //Calls Shopping_cart->add_to_cart($data) model to add an item to the shopping cart. 
        
        
        //Get the information from the post         
        $data['date_added'] = date('Y-m-d H:i:s');
        $data['product_id'] = $product_id;
        $data['quantity'] = $this->input->post('qty');       
        $data['session_id'] = $this->session->session_id; //Current Session Id
        
        //Get more information about the product
        $this->load->model("Product");
        $query = $this->Product->get_product_by_id($product_id);
        $data['product_name'] = $query->product_name;
        $data['product_desc'] = $query->product_desc;
        $data['price'] = $query->product_price * $data['quantity'];
        $data['image_path'] = "assests/Images/circuit_board.jpg";
        
//        echo $data['date_added']. "<br>";
//        echo $data['item_id']. "<br>";
//        echo $data['qty']. "<br>";
//        echo $data['session_id']. "<br>";
//        echo $data['product_name']. "<br>";
//        echo $data['product_desc']. "<br>";
//        echo $data['price']. "<br>";
//        echo $data['image_path']. "<br>";
        
        
        //Call model method to add to the cart
        $this->load->model("Shopping_cart_model");
        if (!$this->Shopping_cart_model->add_to_cart($data)) {
        echo "Error Adding to Shopping Cart </br>";
        } else {
        //Get all the information for this session from the shopping cart
        $this->load->library('table'); //t
        
        $data['query'] = $this->Shopping_cart_model->select_from_cart();
        
        $this->load->view('shopping_cart', $data);
        }
        
    }
    
    
    public function remove_product_from_cart($id){
        
         $this->load->model("Shopping_cart_model");
         
         // Calls  model to remove an item from the shopping cart.
         $this->Shopping_cart_model->remove_from_cart($id);
         
         
//         //Calls model to reload the shopping cart 
//         $data['display_block'] = $this->Shopping_cart_from->SelectFromCart();
//         
//         $this->load->view('shopping_cart', $data);
//         
//         //         redirect('Shopping_cart/select_from_cart');
         
         
         
         $data['query'] = $this->Shopping_cart_model->select_from_cart();
        
        $this->load->view('shopping_cart', $data);
    }
        
    }

