<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 11/12/2018
 * Time: 14:36
 */

class customer extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
//        if ($account_info['permission_status'] !== "staff" || $account_info['permission_status'] !== "admin") {
//            redirect(site_url() . "/home");
//        }
    }

    public function index()
    {
        redirect(site_url() . "/customer/view_customers");
    }


    //index - shop
    //    //view_product
    //    //add_product_to_cart - session
    //    //view_shopping_cart
    //    //order_products -- insert
    //    //view_account
    //    //view_orders -- update
    //    //logout
}