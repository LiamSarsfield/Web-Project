<?php

class Product extends CI_Controller {
    
    public function add_product() {
        
            
        if ($this->input->post('submit')) {
            
            $data['category_id'] = $this->input->post('category_id');
            $data['product_name'] = $this->input->post('product_name');
            $data['product_desc'] = $this->input->post('product_desc');
            $data['product_specs'] = $this->input->post('product_specs');
            $data['product_price'] = $this->input->post('product_price');
            $data['quantity'] = $this->input->post('quantity');
            
            $config['upload_path']          = './uploads/';
//            $config['upload_path']          = './assets/images/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['overwrite'] = false;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('picture'))
            {
                    $error = array('error' => $this->upload->display_errors());

                    $this->load->view('add_product', $error);
            }
            else
            {

                    $data_upload_files = $this->upload->data();
                    $data['image_path'] = 'assets/images/'.$data_upload_files['file_name'];

            }
            
            $this->load->model("Product_model");
            $this->Product_model->add_product($data);
        }
        
        $this->load->view('add_product');
    }
    
}

