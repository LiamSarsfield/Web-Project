<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 10/12/2018
 * Time: 10:56
 */

class staff extends CI_Controller
{
    function __construct() {
        parent::__construct();
            $login_info = $this->session->userdata('login_info') ?? NULL;
            if(!iset($login_info['account_status'])){
                redirect(site_url(). "/home");
            }
    }

    public function index()
    {

    }
    public function home(){
        $this->load->view("admin_home");
    }
    public function sub_home(){
        $this->load->view("admin_sub_home");
    }
}