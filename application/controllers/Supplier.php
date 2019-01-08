<?php

class Supplier extends CI_Controller {
    

    public function maintain() {
        
        $this->load->view('maintain_supplier');
        
    }

    public function deleteSupplier() {
        
        $this->load->view('remove_supplier');
        
    }

    public function addSupplier() {
        
        $this->load->view('add_supplier');
        
    }

    public function addSucessful() {
        
        $this->load->view('success_add_supplier');
        
    }

    public function editSupplier() {
        
        $this->load->view('update_supplier');
        
    }
    
    
 
    public function materialReq() {
        
        $this->load->view('prepare_production_materials');
        
    }

    public function materialOutput() {
        
        $this->load->view('materials');
        
    }

    public function deliveries() {
        
        $this->load->view('accept_material_delivery');
        
    }

    public function deliveryInfo(){
        $this->load->view('accept_delivery');
        
    }
    
    
 
    public function materialDetails() {
        
        $this->load->view('maintain_material');
        
    }

    public function materialAdd() {
        
        $this->load->view('add_material');
        
    }

    public function materialDelete() {
        
        $this->load->view('remove_material');
        
    }

    public function materialUpdate() {
        
        $this->load->view('update_material');
        
    }

    public function orderReq() {
        
        $this->load->view('generate_supplier_order_request');
        
    }
    
    public function purchaseReq() {
        
        $this->load->view('supplier_purchase_request');
        
    }
    
 
    public function payment() {
        
        $this->load->view('searchsuppliers');
        
    }

    public function paySupplier() {
        
        $this->load->view('supplierpayment');
        
    }

    public function paymentScreen() {
        
        $this->load->view('paysupplier');
        
    }

    public function paymentSuccess(){

        $this->load->view('paymentsuccessfulsupplier');
    }

}