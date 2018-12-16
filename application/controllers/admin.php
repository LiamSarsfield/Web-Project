<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 10/12/2018
 * Time: 10:58
 */

class admin extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $login_info = $this->session->userdata('login_info') ?? NULL;
//        if(!iset($login_info['permission_status'])){
//            redirect(site_url(). "/home");
//        }
    }
    public function index()
    {

    }
    public function home(){
        $this->load->model("sidebar");
        $login_info = $this->session->userdata('login_info');
        //gets account status from session... e.g. 'customer/staff/admin
        $account_status = $login_info['permission_status'];
        $sidebars = $this->sidebar->get_sidebars_by_permission("admin");
        $header_data['css_data'] = array("global.css");
        $header_data['title'] = "Sub Home - $account_status";
        $header_data['sidebars'] = $sidebars;
        $data['sidebars'] = $sidebars;
        $this->load->view("template/header", $header_data);
        $this->load->view("staff/admin_home", $data);
    }
    public function sub_home(){
        $this->load->view("admin_sub_home");
    }
}