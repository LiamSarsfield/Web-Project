<?php

class dashboard extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $login_info = $this->session->userdata('login_info') ?? NULL;
        // if session is not set redirect to sign in
        if(!iset($login_info['account_status'])){
            redirect(site_url(). "/user/sign_in");
        }
    }
    public function sub_home(){
        $this->load->model("sidebar");
        $login_info = $this->session->userdata('login_info');
        //gets account status from session... e.g. 'customer/staff/admin
        $account_status = $login_info['account_status'];
        $header_data['css_data']  = array("global.css");
        $header_data['title'] = "Sub Home - $account_status";
        $this->load->view("header", $header_data);
        // this will return a side_bar object with the side_bar name, with an associative array of sub side bar icons
        // with side_bars associated with account info
        $data['side_bar'] = $this->sidebar->get_side_bar_icons($account_status);
        // dynamically create sub_main when first loading the sub_home page
        $data['sub_main'] = $this->load->view("default");
        $this->load->view("admin_sub_home", $data);
    }
    //ajax will load this function
    public function load_sub_main($page_view = "default"){
        return $this->load->view($page_view, '', TRUE);
    }

}