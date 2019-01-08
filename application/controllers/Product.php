<?php

class Product extends CI_Controller {
    

    public function scrapNotes() {
        
        $this->load->view('prepare_scrap_notes');
        
    }

    public function scrapNoteDisplay() {
        
        $this->load->view('scrap_notes');
        
    }
    
    public function materials() {
        
        $this->load->view('material_enquiry');
        
    }

    public function details() {
        
        $this->load->view('view_products');
        
    }

    public function prodInfo() {
        
        $this->load->view('product_information');
        
    }

    public function edit() {
        
        $this->load->view('edit_product');
        
    }

    public function updateTraveller() {
        
        $this->load->view('lot_traveller');
        
    }

    public function travellerUpdateInfo() {
        
        $this->load->view('lot_traveller_information');
        
    }

    public function travellerEditInfo() {
        
        $this->load->view('edit_lot_traveller');
        
    }

    public function goodsNotes() {
        
        $this->load->view('customercreditnote');
        
    }

    public function goodsNoteCreate() {
        
        $this->load->view('createcreditnote');
        
    }

    public function goodsNoteSubmit() {
        
        $this->load->view('submitcreditnote');
        
    }

    public function generateTraveller() {
        
        $this->load->view('generate_lot_traveller');
        
    }

    public function generateTravellerProd() {
        
        $this->load->view('lot_traveller');
        
    }

    public function generateTravellerView() {
        
        $this->load->view('lot_traveller_information');
        
    }

    public function generateTravellerUpdate() {
        
        $this->load->view('edit_lot_traveller');
        
    }

    public function addProduct() {
        
        $this->load->view('add_product');
        
    }

    public function maintain() {
        
        $this->load->view('maintain_products');
        
    }


   
}