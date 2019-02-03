<?php

class Staff_controller extends CI_Controller {
   
    
    public function staffLogin() {
        
        $this->load->view('staffLoggedIn');
        
    }
    
    public function view_customers() {
        
        
        $this->load->model("Staff_model");       
        $data['query'] = $this->Staff_model->get_all_customers();
        $this->load->view('view_customers', $data);
        
    }
    
    public function view_selected_customer($id) {
        
        $this->load->model("Staff_model");       
        $data['query'] = $this->Staff_model->get_customer_by_id($id);
        $this->load->view('maintain_customer', $data);
        
    }
    
    public function search_customer_by_id() {
        
        $id = $this->input->post("customer_id");
        $this->load->model("Staff_model");       
        $data['query'] = $this->Staff_model->search_customer_by_id($id);
        $this->load->view('view_customers', $data);
        
    }
    
    public function add_customer() {
        
        if($this->input->post('submit')){
            
            $data['first_name'] = $this->input->post('first_name');
            $data['last_name'] = $this->input->post('last_name');
            $data['email'] = $this->input->post('email');
            $data['phone'] = $this->input->post('phone');
            $data['address1'] = $this->input->post('address1');
            $data['address2'] = $this->input->post('address2');
            $data['town'] = $this->input->post('town');
            $data['city'] = $this->input->post('city');
            
            $this->load->model("Staff_model");
            $this->Staff_model->add_customer($data);
            
            redirect(site_url('/Staff_controller/view_customers'));
            
        }
        else{
            
        $this->load->view('add_customer');
        
        }
    }
    
    
    public function edit_customer($id) {
        
        $this->load->model("Staff_model");       
        $data['query'] = $this->Staff_model->get_customer_by_id($id);
        $this->load->view('edit_customer', $data);
        
    }
    
    public function update_customer($customer_id) {
        
//        $customer_id = $this->input->post("customer_id");
        $data['first_name'] = $this->input->post("first_name");
        $data['last_name'] = $this->input->post("last_name");
        $data['email'] = $this->input->post("email");
        $data['address1'] = $this->input->post("address1");
        $data['address2'] = $this->input->post("address2");
        $data['town'] = $this->input->post("town");
        $data['city'] = $this->input->post("city");
        
           
        $this->load->model("Staff_model");
        
        $this->Staff_model->update_customer($customer_id, $data);
        
        redirect(site_url('/Staff_controller/view_customers'));
        
        
    }
    
    public function delete_customer($id) {
        
        $this->load->model("Staff_model");
        $this->Staff_model->delete_customer($id);
        
        $data['query'] = $this->Staff_model->get_all_customers();
        $this->load->view('view_customers', $data); 
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