<?php

//dashboard is when you're logged in
class dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $login_info = $this->session->userdata('login_info') ?? NULL;
        // if session is not set redirect to sign in
        if (!isset($login_info['account_status'])) {
            redirect(site_url() . "/user/sign_in");
        }
    }

    public function index()
    {
        redirect(site_url() . "/dashboard/sub_home");
    }

    public function home()
    {
        $this->load->model("sidebar");
        $login_info = $this->session->userdata('login_info');
        //gets account status from session... e.g. 'customer/staff/admin
        $account_status = $login_info['account_status'];
        $header_data['css_data'] = array("global.css");
        $header_data['title'] = "Sub Home - $account_status";
        $header_data['side_bars'] = $this->sidebar->get_sidebars_by_permission($account_status);
        $this->load->view("template/header", $header_data);
        // this will return a side_bar object with the side_bar name, with an associative array of sub side bar icons
        // with side_bars associated with account info
        if ($account_status === "customer") {
            redirect(site_url(). "store/view_store");

        } else if ($account_status === "") {

        }
        // dynamically create sub_main when first loading the sub_home page

    }

    //ajax will load this function
    public function load_sub_main($page_view = "default")
    {
        return $this->load->view($page_view, '', TRUE);
    }


}