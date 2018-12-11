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
        $login_info = $this->session->userdata('login_info') ?? NULL;
        if (!iset($login_info['account_status'])) {
            redirect(site_url() . "/home");
        }
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