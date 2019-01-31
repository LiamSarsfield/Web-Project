<?php

class Product extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
//        if ($account_info['permission_status'] !== "staff" || $account_info['permission_status'] !== "admin") {
//            redirect(site_url() . "/home");
//        }
    }

    public function edit_product($product_id)
    {
        $this->load->model(array("Product_model", "Category_model"));
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (!isset($product_id)) {
            $this->session->set_flashdata('temp_info', 'You did not Enter a Product ID!');
            redirect(site_url("/functions/view/product/"));
        }
        $product_info = $this->Product_model->get_product_by_id($product_id);
        $product_info->category_name = $this->Category_model->get_category_display_info_by_id($product_info->category_id);
        $categories = $this->Category_model->get_all_categories();
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'specs',
                'label' => 'Specifications',
                'rules' => 'required',
            ),
            array(
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required|callback_is_money',
                'errors' => array(
                    'is_money' => 'Enter a valid Currency Format',
                ),
            ),
            array(
                'field' => 'stock_quantity',
                'label' => 'Stock Quantity',
                'rules' => 'required|numeric'
            )
        );
        $image_path = $_FILES['image_path']['name'] ?? NULL;
        if (!empty($image_path)) {
            $this->form_validation->set_rules('image_path', 'Image', 'callback_upload_product_image');
        }
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['categories'] = $categories;
            $data['product_info'] = $product_info;
            initialize_header();
            $this->load->view("product/edit_product", $data);
        } else {
            $this->Product_model->edit_product();
            $this->session->set_flashdata('temp_info', 'Product Successfully Edited.');
            redirect(site_url("functions/view/product/$product_id"));
        }
    }

    public function view_products()
    {
        $this->load->model("Product_model");
        $data['query'] = $this->Product_model->get_all_products();
        $this->load->view('list_of_products', $data);
    }

    public function delete_product($id)
    {
        $this->load->model("Product_model");
        $this->Product_model->delete_product($id);
        $data['query'] = $this->Product_model->get_all_products();
        $this->load->view('list_of_products', $data);
    }


    public function is_money($price)
    {
        if (preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $price)) {
            return true;
        } else {
            return false;
        }
    }

    public function upload_product_image()
    {
        $config['upload_path'] = './assets/images/product';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 20000;
        $config['max_width'] = 10243;
        $config['max_height'] = 7638;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image_path')) {
            $this->form_validation->set_message('upload_product_image', $this->upload->display_errors());
            return false;
        } else {
           return true;
        }
    }

}

