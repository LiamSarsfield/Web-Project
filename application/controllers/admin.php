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
        $account_info = $this->session->userdata('account_info') ?? NULL;
//        if(!iset($account_info['permission_status'])){
//            redirect(site_url(). "/home");
//        }
    }
    public function index()
    {

    }
    public function home(){
        $this->load->model("sidebar_model");
        $account_info = $this->session->userdata('account_info');
        //gets account status from session... e.g. 'customer/staff/admin
        $account_status = $account_info['permission_status'];
        $sidebars = $this->sidebar_model->get_sidebars_by_permission("admin");
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
    public function view()
    {
        $this->load->library(array('pagination','table'));
        $this->load->model("Customer_model");
        $this->load->model("sidebar_model");
        //pagination
        $customer_row_count = $this->Customer_model->get_customer_rows();
        // lets say there is 200 customers in database
        $config['total_rows'] = 200;
        $config['per_page'] = 10;
        $config['base_url'] = site_url('Home/select_entries_per_page');

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3) ??  0;
        $data['pagination'] = $this->pagination->create_links();
        $customers = $this->Customer_model->get_customers_by_limit($config["per_page"], $page);

        //table
        $this->table->set_heading('Customer ID', 'Name', 'Email', 'View');
        foreach($customers as $customer){
            $this->table->add_row($customer->customer_id, $customer->first_name . " " . $customer ->last_name, $customer->email,
                "<a href='" . site_url("admin/maintain/$customer->customer_id") . "'><div class='button'>View info</div></a>");
        }
        $template = array(
            'table_open' => '<table class="table_generic">'
        );
        $this->table->set_template($template);
        $data['table'] = $this->table->generate();

        $account_info = $this->session->userdata("account_info");
        $header_data['sidebars'] = $this->sidebar_model->get_sidebars_by_permission($account_info['permission_status']);
        $header_data['title'] = "Register";
        $this->load->view("template/header", $header_data);
        $this->load->view("generic/staff_view", $data);
    }

    public function maintain($id){
        $this->load->model("customer_model");
        $this->load->model("sidebar_model");
        $account_info = $this->session->userdata("account_info");
        $header_data['sidebars'] = $this->sidebar_model->get_sidebars_by_permission($account_info['permission_status']);

        $customer_assoc_array = $this->customer_model->get_info_for_display_by_id($id);
        if($customer_assoc_array === FALSE){
            redirect(site_url("customer/view_customers"));
        }
        $customers = array();
        foreach($customer_assoc_array as $key => $value)
        {
            $key = str_replace("_"," ",$key);
            $key = ucwords($key);
            $customers[$key] = $value;
        }
        $header_data['title'] = "Register";
        $this->load->view("template/header");
        $data['customers'] = $customers;
        $this->load->view("generic/maintain", $data);

    }
}