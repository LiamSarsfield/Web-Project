<?php

class home extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model("sidebar");
    }
    public function sub_home(){
        $login_info = array();
        if($this->session->has_userdata('login_info')){
            $login_info = $this->session_userdata('login_info');
        }
        else{
            $login_info['account_status'] = "Unregistered";
        }

        //gets account status from session... e.g. 'customer/staff/admin
        $account_status = $login_info['account_status'];
        $header_data['css_data']  = array("global.css");
        $header_data['title'] = "Sub Home - $account_status";
       // $this->load->view("header", $header_data);
        // this will return a side_bar object with the side_bar name, with an associative array of sub side bar icons
        // with side_bars associated with account info
        $data['side_bars'] = $this->sidebar->get_sidebars_by_permission($account_status);
        // dynamically create sub_main when first loading the sub_home page
        //$data['sub_main'] = $this->load->view("default");
        $this->load->view("loggedin", $data);
    }
    //ajax will load this function
    public function load_sub_main($page_view = "default"){
        return $this->load->view($page_view, '', TRUE);
    }
}