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

    public function view($model, $search_string = NULL)
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
        $data['sidebars'] = $sidebars;
        $this->load->view("template/header", $header_data);
        $data['model_info'] = $this->$model_formatted->get_all_search_info();
        $this->load->view("{$model}/{$model}_view_search", $data);
    }


}