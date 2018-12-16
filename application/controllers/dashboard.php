<?php

//dashboard is when you're logged in
class dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $login_info = $this->session->userdata('login_info') ?? NULL;
        // if session is not set redirect to sign in
        if (!isset($login_info['permission_status']) && $login_info['permission_status'] !== "unregistered") {
            redirect(site_url() . "/home/login");
        }
    }

    public function index()
    {
        redirect(site_url() . "/dashboard/home");
    }

    public function home()
    {
        $this->load->model("sidebar");
        $login_info = $this->session->userdata('login_info');
        //gets account status from session... e.g. 'customer/staff/admin
        $account_status = $login_info['permission_status'];
        $header_data['css_data'] = array("global.css");
        $header_data['title'] = "Sub Home - $account_status";
        $header_data['side_bars'] = $this->sidebar->get_sidebars_by_permission($account_status);
        $this->load->view("template/header", $header_data);
        // this will return a side_bar object with the side_bar name, with an associative array of sub side bar icons
        // with side_bars associated with account info
        if ($account_status === "customer") {
            redirect(site_url() . "/store/view_store");
        } else if ($account_status === "staff") {
            $this->load->view("staff/dashboard");
        } else if ($account_status === "admin") {
            $this->load->view("staff/dashboard");
        }
        // dynamically create sub_main when first loading the sub_home page
    }
    public function sub_home($function_name){
        // where you go when you click a sub label
        if(!isset($function_name)){
            redirect(site_url() . "/dashboard/home");
        }
        $this->load->model("sidebar");
        $account_info = $this->session->userdata("login_info");
        $sidebar_info = $this->sidebar->get_sub_sidebar_info_by_name($function_name);
        if(!$this->sidebar->is_permitted_to_view_sub_sidebar($account_info['permission_id'], $sidebar_info->sub_sidebar_id)){
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


}