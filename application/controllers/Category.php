<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 28/01/2019
 * Time: 23:03
 */

class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
//        if(!iset($account_info['permission_status'])){
//            redirect(site_url(). "/home");
//        }
    }

    public function edit_category($category_id = NULL)
    {
        $this->load->model("Category_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (!isset($category_id)) {
            $this->session->set_flashdata('temp_info', 'You did not Enter a Category ID!');
            redirect(site_url("/functions/view/category/"));
        }
        $category_info = $this->Category_model->get_category_by_id($category_id);
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['category_info'] = $category_info;
            initialize_header();
            $this->load->view("product/edit_category", $data);
        } else {
            $this->Category_model->edit_category();
            $this->session->set_flashdata('temp_info', 'Category Successfully Edited.');
            redirect(site_url("functions/view/category/$category_id"));
        }
    }


}