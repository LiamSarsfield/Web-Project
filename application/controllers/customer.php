<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 10/12/2018
 * Time: 10:57
 */

class customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $login_info = $this->session->userdata('login_info') ?? NULL;
        if (!iset($login_info['account_status'])) {
            redirect(site_url() . "/home");
        }
    }

    public function index()
    {

    }

    public function home()
    {
        $this->load->view("admin_home");
    }

    public function sub_home()
    {
        $this->load->model("sidebar");
        // this will return a side_bar object with the side_bar name, with an associative array of sub side bar icons
        $data['side_bar'] = $this->sidebar->get_side_bar_icons("customer");
        // dynamically create submain when first loading the sub_home page
        $data['sub_main'] = $this->load_sub_main();
        $this->load->view("admin_sub_home", $data);
    }

    //ajax will load this function
    public function load_sub_main($page_view = "default")
    {
        return $this->load->view($page_view, '', TRUE);
    }
}