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

    public function viewInvoices() {
        
        $this->load->view('prepare_customer_invoice');
        
    }

    public function submitInvoice() {
        
        $this->load->view('invoice');
        
    }
    
    public function viewReturns() {
        
        $this->load->view('accept_returned_goods');
        
    }

    public function acceptReturns() {
        
        $this->load->view('accept_return');
        
    }
    
    public function viewOrders() {
        
        $this->load->view('view_pending_customer_orders');
        
    }

    public function orderInfo() {
        
        $this->load->view('pending_order_information');
        
    }

    public function acceptOrder() {
        
        $this->load->view('convert_to_work_order');
        
    }
   
    
}