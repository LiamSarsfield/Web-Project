<?php

class Store extends CI_Controller {
    

    public function view_store() {
        
        $data['display_block'] = ""; 
        
        $this->load->model("Product");
        
        $data['query'] = $this->Product->get_all_products();
        
        //If no details found 
      if ($data['query']->num_rows() < 1 ) { 
       $display_block = "<p><em>Sorry, no items to display.</em></p>"; 
    } else { 
 	//store items in the associative array $products 	 	 
 	foreach ($data['query']->result_array() as $product) { 	 	 	 	 
 	   $product_id  = $product['product_id']; 
 	   $product_name = $product['name']; 
 	   $product_desc = $product['desc'];
           $product_price = $product['price'];
 	 
            //Create a link that when clicked calls the method GetCategoryItems in the CategoryItems_controller 	 	 	 	 	 	 
 	   $tag = '/Web-Project/index.php/Store/view_selected_product/'.$product_id; 	  
 	 	 	 	 
// 	$data['display_block'] .= "<p><strong><a href=".$tag.">".$product_name."</a></strong><br/>".$product_desc."</p>"; 
        
        
        
        
        
    $data['display_block'] .= '<div class="w3-quarter w3-section w3-light-grey" style="margin-right:5%; padding: 2%; max-width: 30%; border-radius: 3%;">';
    $data['display_block'] .= '<span class="w3-xlarge"><a href="product_view.html"><img src='.base_url().'assets/images/circuit_board.jpg width="200px" style="border-radius: 3%;"></a></span><br>';
    $data['display_block'] .= "<strong>$product_name</strong><hr>";
    $data['display_block'] .= "<em>$product_desc</em><hr>"; 
    // Need to limit the $product_desc so it doesn't overflow within the div
    $data['display_block'] .= "<strong>€$product_price</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
    $data['display_block'] .= "<a href=".$tag."><button>View</button></a>"; 
    $data['display_block'] .= '</div>';

        
        
        
 	 	 	 	 
           } 
     } 	 	 
    //Load the view passing in all the store items to be displayed 
        
        $this->load->view('store', $data);
        
    }
    
    public function view_selected_product($id) {
        
        $data['display_block'] = ""; 
        
        $this->load->model("Product");
        
        $product = $this->Product->get_product_by_id($id);
        
        
        
               
        $product_id  = $product->product_id; 
 	$product_name = $product->name; 
 	$product_desc = $product->desc;
        $product_price = $product->price;
        
       
        
        
         $data['display_block'] .= '<div class="w3-half" style="border-right: 1px solid  lightgray; padding-right: 10%;"><h1>'.$product_name.'</h1></div>';
         $data['display_block'] .= '<div><img src='.base_url().'assets/images/circuit_board.jpg width="100px" style="border-radius: 3%;"></div>';
         $data['display_block'] .= '<p>';
         $data['display_block'] .= "<em>$product_desc</em>";
         $data['display_block'] .= ' </p>';
         $data['display_block'] .= ' <br>';
      
         
         
         $this->load->view('view_product', $data);
        
    }
}

