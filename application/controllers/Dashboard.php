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

    public function sub_home($function_name)
    {
        // where you go when you click a sub label
        if (!isset($function_name)) {
            redirect(site_url() . "/dashboard/home");
        }
        $this->load->model("sidebar_model");
        $account_info = $this->session->userdata("account_info");
        $sidebar_info = $this->sidebar_model->get_sub_sidebar_info_by_name($function_name);
        if (!$this->sidebar_model->is_permitted_to_view_sub_sidebar($account_info['permission_id'], $sidebar_info->sub_sidebar_id)) {
            redirect(site_url() . "/dashboard/home");
        }
        // what you need is function_names view all ...(e.g. customer, or order, or product, or lot traveller)..
        $model_name = $sidebar_info->model_name;
        $model_function = $sidebar_info->model_function;
        $this->load->model($model_name);
        $this->$sidebar_info->model_name->$model_function();
        $this->load->view($sidebar_info->view_location);
    }

    //ajax will load this function
    public function load_sub_main($page_view = "default")
    {
        return $this->load->view($page_view, '', TRUE);
    }

    public function search_supplier()
    {
        $header_data['css_data'] = array("global.css");
        $header_data['title'] = "Sub Home";
        $this->load->view("template/header", $header_data);
        $this->load->view("supplier/searchsuppliers");
    }
}