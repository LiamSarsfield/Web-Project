<?php

//dashboard is when you're logged in
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
        // if session is not set redirect to sign in
        if (!isset($account_info['permission_id']) && $account_info['permission_id'] !== "unregistered") {
            redirect(site_url() . "/home/login");
        }
    }

    public function index()
    {
        redirect(site_url() . "/dashboard/home");
    }

    public function home()
    {
        $this->load->model(array("sidebar_model", "Permission_model"));
        $account_info = $this->session->userdata('account_info');
        //gets account status from session... e.g. 'customer/staff/admin
        $sidebars = $this->sidebar_model->get_sidebars_by_permission_id($account_info['permission_id']);
        $data['sidebars'] = $sidebars;
        $data['temp_info'] = $this->session->userdata('temp_info') ?? "";
        $data['permission_name'] = $this->Permission_model->get_permission_name_by_permission_id($account_info['permission_id']);
        initialize_header();
        // this will return a side_bar object with the side_bar name, with an associative array of sub side bar icons
        // with side_bars associated with account info
        $this->load->view("generic/dashboard", $data);
        // dynamically create sub_main when first loading the sub_home page
    }
}