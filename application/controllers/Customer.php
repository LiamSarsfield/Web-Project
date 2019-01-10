<?php

class Customer extends CI_Controller {
    

    public function login() {
        
        $this->load->view('login');
        
    }
    
    public function signUp() {
        
        $this->load->view('signUp');
        
    }

    public function loggedIn(){
        $this->load->view('loggedin');
    }
    
   

    public function quotes(){
        $this->load->view('searchquotes');
    }


    public function viewQuote(){
        $this->load->view('customerquote');
    }

    public function payQuote(){
        $this->load->view('payquote');
    }

    public function declineQuote(){
        $this->load->view('declinequote');
    }

    public function paymentSuccess(){
        $this->load->view('paymentsuccesfulquote');
    }
    
    public function view_customers() {
        
    }
    
    public function view_selected_customers($id) {
        
    }
    
    public function add_customer() {
        
    }

}