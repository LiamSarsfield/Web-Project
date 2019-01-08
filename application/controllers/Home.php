<?php

class Home extends CI_Controller {
    

    public function index() {
        
        $this->load->view('index');
        
    }
    public function maintain_supplier() {
        
        $this->load->view('maintain_supplier');
        
    }

    public function maintenance(){
        $this->load->view('maintenance');
    }

   

}