<?php

//home is for people who are not logged in ONLY
class home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("sidebar");
        $login_info = $this->session->userdata('login_info');
        // if logged in...
        if (isset($login_info)) {
            redirect(site_url() . "/dashboard");
        }
    }
    public function index(){
        redirect(site_url() . "/home/login");
    }
    // show login page
    public function login()
    {
        $this->load->library('form_validation');
        //if form validate successful
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $this->form_validation->set_rules('email', 'Email', "required|callback_validate_login[$password]");
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            $account_info = $this->session->userdata("account_info");
            $header_data['sidebars'] = $this->sidebar->get_sidebars_by_permission($account_info['account_status']);
            $header_data['title'] = "MWE - Login";
            $this->load->view("template/header", $header_data);
            $this->load->view("generic/login");
        } else {
            redirect(site_url() . "/dashboard");
        }
    }

// register as customer
    public function register()
    {
        $this->load->library('form_validation');
        //if form validate successful
        $this->form_validation->set_rules('email', 'email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $account_info = $this->session->userdata("account_info");
            $header_data['sidebars'] = $this->sidebar->get_sidebars_by_permission($account_info['account_status']);
            $header_data['title'] = "Register";
            $this->load->view("template/header");
            $this->load->view("generic/signUp");
        } else {
            $this->load->model("customer");
            $this->load->model("Login_data");
            // this assoc array must have same key as DB field names
            $customer_data = array(
                "first_name" => $this->input->post("first_name"),
                "last_name" => $this->input->post("last_name"),
                "email" => $this->input->post("email"),
                "password" => hash("sha256", $this->input->post("password")),
                "phone" => $this->input->post("phone"),
                "address_one" => $this->input->post("address_one"),
                "address_two" => $this->input->post("address_one"),
                "town" => $this->input->post("town"),
                "city" => $this->input->post("city"),
                "country" => $this->input->post("country"),
            );
            $this->customer->add_customer($customer_data);
            $this->validate_login($customer_data['email'], $customer_data['password']);

            redirect(site_url() . "/dashboard");
        }


    }

    public function validate_login($email, $password)
    {
        $this->load->model("Login_data");
        $encrypted_password = $password;
        // if password is not encrypted
        if (!preg_match('/[A-Fa-f0-9]{64}/', $encrypted_password)) {
            $encrypted_password = hash("sha256", $encrypted_password);
        }
        $data = array(
            "email" => $email,
            "password" => $encrypted_password
        );
        $this->load->model("Customer");
        $this->load->model("Supplier");
        $this->load->model("Staff");

        if ($this->Customer->login_customer($data) !== FALSE) {
            $login_info = array(
                "customer_id" => $this->Customer->login_customer($data),
                "account_status" => "customer"
            );
            $this->session->set_userdata("login_info", $login_info);
            return true;
        } else if ($this->Staff->login_staff($data) !== FALSE) {
            return true;
        } else {
            return false;
        }
    }


    // show logged in page
    public function logged_in()
    {
        $this->load->view("logged_in");
    }

}