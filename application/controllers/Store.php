<?php

class Store extends CI_Controller {
    

    public function view_store() {
        
        
        $this->load->model("Product");
        
        $data['query'] = $this->Product->get_all_products();
        
        $this->load->view('store', $data);
        
    }
    
    public function view_selected_product($id) {
        
        
        
        $this->load->model("Product");
        
        $data['product'] = $this->Product->get_product_by_id($id);
         
        $this->load->view('view_product', $data);
        
    }
}

