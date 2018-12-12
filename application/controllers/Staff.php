<?php

class Staff extends CI_Controller {
    

    public function staffLogin() {
        
        $this->load->view('staffLoggedIn');
        
    }
    
    public function viewCustomers() {
        
        $this->load->view('customersearch');
        
    }
    
    public function maintainCustomers() {
        
        $this->load->view('maintaincustomer');
        
    }
    
    public function editCustomer() {
        
        $this->load->view('editcustomer');
        
    }
    
}