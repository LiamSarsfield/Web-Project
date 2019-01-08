<?php
/**
 * Created by PhpStorm.
 * User: liam1
 * Date: 05/01/2019
 * Time: 13:20
 */

class Functions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
        // if session is not set redirect to sign in
        if (!isset($account_info['permission_id']) && $account_info['permission_id'] !== "unregistered") {
            redirect(site_url() . "/home/login");
        }
    }

    public function view($model, $search_id = NULL)
    {
        $model_formatted = $model . "_model";
        try {
            $this->load->model($model_formatted);
        } catch (RuntimeException $e) {
            redirect(site_url() . "/dashboard/home");
        }
        $this->load->model("sidebar_model");
        $account_info = $this->session->userdata('account_info');
        //gets account status from session... e.g. 'customer/staff/admin
        $header_data['css_data'] = array("global.css");
        $header_data['title'] = "Sub Home";
        $sidebars = $this->sidebar_model->get_sidebars_by_permission_id($account_info['permission_id']);
        $header_data['sidebars'] = $sidebars;
        $this->load->view("template/header", $header_data);
        if (isset($search_id)) {
            $data['model_info'] = $this->$model_formatted->get_detailed_info_by_order_id($search_id);
            $this->load->view("functions/{$model}_search", $data);
        } else {
            $data['model_info'] = $this->$model_formatted->get_all_search_info();
            $this->load->view("functions/{$model}_view", $data);
        }
    }

    public function add($model)
    {
        $model_formatted = $model . "_model";
        try {
            $this->load->model(array($model_formatted, "Generic_model", "Sidebar_model"));
        } catch (RuntimeException $e) {
            redirect(site_url() . "/dashboard/home");
        }
        $this->load->library(array('form_validation', 'upload'));
        $config = array();
        $form_field_names = $this->Generic_model->get_form_field_names($model);
        // getting all the required fields for the form
        foreach ($form_field_names as $form_field_name) {
            $rules = "required";
            $error_array = array(
                'required' => 'You must provide a {field}.',
                'do_upload' => ''
            );
            if($form_field_name->name === "image_path"){
                $rules .= "|callback_do_upload";
                $error_array['do_upload'] .= $this->upload->display_errors();
            }
            $form_field_name_config = array(
                'field' => $form_field_name->name,
                'label' => ucfirst($form_field_name->name),
                'rules' => $rules,
                'errors' => $error_array
            );
            array_push($config, $form_field_name_config);
        }

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $account_info = $this->session->userdata("account_info");
            $header_data['sidebars'] = $this->sidebar_model->get_sidebars_by_permission_id($account_info['permission_id']);
            $header_data['title'] = "MWE - Login";
            $data['model_info'] = $this->$model_formatted->get_all_add_info();
            $header_data['css_data'] = array("global.css");
            $header_data['title'] = "Sub Home";
            $sidebars = $this->sidebar_model->get_sidebars_by_permission_id($account_info['permission_id']);
            $header_data['sidebars'] = $sidebars;
            $this->load->view("template/header", $header_data);
            $this->load->view("functions/{$model}_add");
        } else {
            $model_add_function = "add_{$model}_by_post";
            $this->$model_formatted->$model_add_function();
            redirect(site_url() . "/dashboard");
        }
    }

    public function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 5000;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {
           return true;
        } else {
            return false;
        }
    }

}