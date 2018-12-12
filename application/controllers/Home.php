<?php

//home is for people who are not logged in ONLY
class home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("sidebar");
        $login_info = $this->session->userdata('login_info');
        // if logged in...
        if(isset($login_info)){
            redirect(site_url() . site_url());
        }
        $this->load->view("template/header");
    }
    // show login page
    public function login()
    {
        $login_info = $this->session->userdata('login_info');
        //gets account status from session... e.g. 'customer/staff/admin
        $account_status = $login_info['account_status'];
        $header_data['css_data'] = array("global.css");
        $header_data['title'] = "Sub Home - $account_status";
        $this->load->view("header", $header_data);
        // this will return a side_bar object with the side_bar name, with an associative array of sub side bar icons
        // with side_bars associated with account info
        $data['side_bar'] = $this->sidebar->get_side_bar_icons($account_status);
        // dynamically create sub_main when first loading the sub_home page
        $data['sub_main'] = $this->load->view("default");
        $this->load->view("login");
    }
    // register as customer
    public function register()
    {
        $this->load->view("generic/signUp");
    }
    // show logged in page
    public function logged_in()
    {
        $this->load->view("logged_in");
    }

}