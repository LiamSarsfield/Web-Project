<?php
/**
 * Created by PhpStorm.
 * User: liam1
 * Date: 03/02/2019
 * Time: 21:13
 */

class Account extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
        // if not signed in
        if (!isset($account_info)) {
            redirect(site_url() . "/home");
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('home/login'));
    }

}