<?php
class Materials extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
//        if ($account_info['permission_status'] !== "staff" || $account_info['permission_status'] !== "admin") {
//            redirect(site_url() . "/home");
//        }
    }

    public function materialsView()
    {
        $this->load->view("supplier/materials/material_display");
    }
}