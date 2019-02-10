<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 16/12/2018
 * Time: 16:50
 */

class Staff extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
//        if(!iset($account_info['permission_status'])){
//            redirect(site_url(). "/home");
//        }
    }

    public function home()
    {
        $this->load->model("sidebar_model");
        $account_info = $this->session->userdata('account_info');
        //gets account status from session... e.g. 'customer/staff/admin
        $sidebars = $this->sidebar_model->get_sidebars_by_permission_id(1);
        $header_data['css_data'] = array("global.css");
        $header_data['sidebars'] = $sidebars;
        $data['sidebars'] = $sidebars;
        $this->load->view("template/header", $header_data);
        $this->load->view("staff/dashboard", $data);
    }

    public function sub_home()
    {
        $this->load->view("admin_sub_home");
    }

    public function view_all($object)
    {
        $object .= "_model";
        $this->load->library(array('pagination', 'table'));
        $this->load->model($object);
        $this->load->model("sidebar_model");
        //pagination
        $customer_row_count = $this->$object->get_rows();
        // lets say there is 200 customers in database
        $config['total_rows'] = 200;
        $config['per_page'] = 10;
        $config['base_url'] = site_url('Home/select_entries_per_page');

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3) ?? 0;
        $data['pagination'] = $this->pagination->create_links();
        $objects = $this->$object->get_rows_by_limit($config["per_page"], $page);

        //table
        $this->table->set_heading('Customer ID', 'Name', 'Email', 'View');
        foreach ($objects as $object_key => $object_value) {
            $this->table->add_row($object_value->customer_id, $customer->first_name . " " . $customer->last_name, $customer->email,
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

    public function edit_staff($staff_id = NULL)
    {
        $this->load->model("Staff_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
//        is_restricted($uri);
        $staff_id = $staff_id ?? "-1";
        $staff_info = $this->Staff_model->get_staff_edit_info($staff_id);
        if ($staff_info == FALSE) {
            $this->session->set_flashdata('temp_info', 'Staff of that ID does not exist.');
            redirect(site_url('functions/view/staff'));
        }
        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'last_name',
                'label' => 'Last name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|callback_validate_edit_staff_email[' . $this->input->post('staff_id') . ']',
                'errors' => array(
                    'validate_edit_staff_email' => '{field} already exists in DB.',
                )
            ),
            array(
                'field' => 'phone',
                'label' => 'Phone',
                'rules' => 'required'
            ),
            array(
                'field' => 'address_one',
                'label' => 'Address One',
                'rules' => 'required'
            ),
            array(
                'field' => 'address_two',
                'label' => 'Address Two',
                'rules' => 'required'
            ),
            array(
                'field' => 'city',
                'label' => 'City',
                'rules' => 'required'
            ),
            array(
                'field' => 'province',
                'label' => 'Province',
                'rules' => 'required'
            ),
            array(
                'field' => 'postal_code',
                'label' => 'Postal Code',
                'rules' => 'required'
            ),
            array(
                'field' => 'dob',
                'label' => 'Date of Birth',
                'rules' => 'required'
            ),
            array(
                'field' => 'hired_date',
                'label' => 'Hired Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'position',
                'label' => 'Position',
                'rules' => 'required'
            ),
            array(
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['staff_info'] = $staff_info;
            initialize_header();
            $this->load->view("staff/edit_staff", $data);
        } else {
            $this->Staff_model->edit_staff();
            $this->session->set_flashdata('temp_info', 'Staff Successfully Edited.');
            redirect(site_url("functions/view/staff/$staff_id"));
        }
    }

    public function maintain($id)
    {
        $this->load->model("customer_model");
        $this->load->model("sidebar_model");
        $account_info = $this->session->userdata("account_info");
        $header_data['sidebars'] = $this->sidebar_model->get_sidebars_by_permission($account_info['permission_status']);

        $customer_assoc_array = $this->customer_model->get_info_for_display_by_id($id);
        if ($customer_assoc_array === FALSE) {
            redirect(site_url("customer/view_customers"));
        }
        $customers = array();
        foreach ($customer_assoc_array as $key => $value) {
            $key = str_replace("_", " ", $key);
            $key = ucwords($key);
            $customers[$key] = $value;
        }
        $header_data['title'] = "Register";
        $this->load->view("template/header");
        $data['customers'] = $customers;
        $this->load->view("generic/maintain", $data);
    }

    public function validate_edit_staff_email($changed_staff_email, $staff_id = "0")
    {
        $staff_email = $this->Staff_model->get_staff_email_by_staff_id($staff_id);
        if ($changed_staff_email == $staff_email)
            return true;
        $this->load->model("Account_model");
        $email_is_unique = $this->Account_model->check_if_email_is_unique($changed_staff_email);
        if ($email_is_unique) {
            return true;
        } else {
            return false;
        }
    }
}