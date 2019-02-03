<?php

class Store extends CI_Controller
{


    public function view_store()
    {
        $this->load->model("Product_model");
        $data['query'] = $this->Product_model->get_all_products();
        $this->load->view('store/store', $data);
    }

    public function view_selected_product($id)
    {
        $this->load->model("Product_model");
        $data['product'] = $this->Product_model->get_product_by_id($id);
        $this->load->view('store/view_product', $data);

    }
}

