<?php

class Shopping_cart_controller extends CI_Controller {
    

    public function add_product_to_shopping_cart($product_id) {
                
        //Calls Shopping_cart->add_to_cart($data) model to add an item to the shopping cart. 
        
        
        //Get the information from the post that you wish to add to your cart 
        
        $data['date_added'] = date('Y-m-d H:i:s');
        $data['item_id'] = $product_id;
        $data['qty'] = $this->input->post('qty');
//        $data['price'] = $this->input->post('price');        
        $data['session_id'] = $this->session->session_id; //Current Session Id
        
        echo $data['date_added']. "<br>";
        
        echo $data['qty']. "<br>";
        echo $data['session_id']. "<br>";
        
//        //Call model method to add to the cart
//        if (!$this->Shopping_cart_model->add_to_cart($data)) {
//        echo "Error Adding to Shopping Cart </br>";
//        } else {
//        //Get all the information for this session from the shopping cart
//        $this->load->library('table'); //t
//        
//        $data['display_block'] = $this->Shopping_cart_model->select_from_cart();
//        
//        $this->load->view('shopping_cart', $data);
//        }
        
    }
    
    
    public function remove_product_from_cart($id){
         
         // Calls  model to remove an item from the shopping cart.
         $this->Shopping_cart_model->remove_from_cart($id);
         
         
         //Calls model to reload the shopping cart 
         $data['display_block'] = $this->Shopping_cart_from->SelectFromCart();
         
         $this->load->view('shopping_cart', $data);
         
         //         redirect('Shopping_cart/select_from_cart');
    }
        
    }

