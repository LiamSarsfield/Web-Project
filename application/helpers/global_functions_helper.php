<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function initialize_header($header_title = "MWE", $css_data = array("global.css_data"))
{
    $ci =& get_instance();
    $account_info = $ci->session->userdata("account_info");
    $header_data['sidebars'] = $ci->sidebar_model->get_sidebars_by_permission_id($account_info['permission_id']);
    $header_data['title'] = $header_title;
    $header_data['css_data'] = $css_data;
    $sidebars = $ci->sidebar_model->get_sidebars_by_permission_id($account_info['permission_id']);
    $header_data['sidebars'] = $sidebars;
    $ci->load->view("template/header", $header_data);
}

function is_restricted($uri = NULL)
{
    $ci =& get_instance();
    if (!isset($uri)) {
        $uri = uri_string();
    }
    $ci->load->model("Permission_model");
    $has_permission = $ci->Permission_model->user_has_access_to_function($uri);
    if (!$has_permission) {
        $ci->session->set_flashdata('temp_info', "You do not have permission to access: $uri");
        redirect("dashboard/home");
    }
}

function get_additional_table_cols($table_name)
{
    return "";
}

?>