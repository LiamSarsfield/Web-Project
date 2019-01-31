<?php

class Material extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function edit_material($material_id = NULL)
    {
        $this->load->model(array("Material_model", "Supplier_model"));
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
//        is_restricted($uri);
        if (!isset($material_id)) {
            $this->session->set_flashdata('temp_info', 'You did not Enter a Material ID!');
            redirect(site_url("/functions/view/material/"));
        }
        $material_info = $this->Material_model->get_material_by_id($material_id);
        $material_info->supplier_name = $this->Supplier_model->get_supplier_display_info_by_id($material_info->supplier_id);
        $suppliers = $this->Supplier_model->get_all_suppliers();
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required'
            ),
            array(
                'field' => 'price',
                'label' => 'Price',
                'rules' => 'required'
            ),
            array(
                'field' => 'stock_quantity',
                'label' => 'Stock_quantity',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['material_info'] = $material_info;
            $data['suppliers'] = $suppliers;
            initialize_header();
            $this->load->view("product/edit_material", $data);
        } else {
            $this->Material_model->edit_material();
            $this->session->set_flashdata('temp_info', 'Material Successfully Edited.');
            redirect(site_url("functions/view/material/$material_id"));
        }
    }
}