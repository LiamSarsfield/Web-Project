<?php

class Customer_controller extends CI_Controller {
    

    public function login() {
        
        $this->load->view('login');
        
    }
    
    public function sign_up() {
        
        if($this->input->post('first_name')){
            
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['password'] = $this->input->post('password');
            $data['address1'] = $this->input->post('address1');
            $data['address2'] = $this->input->post('address2');
            $data['town'] = $this->input->post('town');
            $data['city'] = $this->input->post('city');
            
            $this->load->model("Customer_model");
            $this->Customer_model->add_customer($data);
            
            $this->load->view('registration_confirmation');
            
        }
            
        else{
        
        $this->load->view('signUp');
        
        }
        
        
        
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
        
         $this->load->view('maintaincustomer');
    }

}