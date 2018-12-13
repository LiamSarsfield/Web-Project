<?php

class Supplier extends CI_Controller {
    

    public function index() {
        
        $this->load->view('index');
        
    }
    
    
 
    public function maintain_supplier() {
        
        $this->load->view('maintain_supplier');
        
    }

}