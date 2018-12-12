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

}