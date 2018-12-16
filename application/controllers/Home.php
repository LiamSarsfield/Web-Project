<?php

//home is for people who are not logged in ONLY
class home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("sidebar");
        $account_info = $this->session->userdata('account_info');
        // if logged in...
        if (isset($account_info)) {
            redirect(site_url() . "/dashboard");
        }
    }

    public function index()
    {
        redirect(site_url() . "/home/login");
    }

    // show login page
    public function login()
    {
        $this->load->library('form_validation');
        //if form validate successful
        $email = $this->input->post("email");
        $password = $this->input->post("password");
        $config = array(
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => "required|callback_validate_login[$password]",
                'errors' => array(
                    'required' => 'You must provide a {field}.',
                    'validate_login' => "Your details are incorrect"
                ),
            ),
            array(
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You musts provide a {field}.'
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $account_info = $this->session->userdata("account_info");
            $header_data['sidebars'] = $this->sidebar->get_sidebars_by_permission($account_info['permission_status']);
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
        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field}.',
                ),
            ),
            array(
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You musts provide a {field}.'
                ),
            ),
            array(
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => 'required|is_unique[customer.email]|regex_match[/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/]|callback_validate_if_staff_email',
                'errors' => array(
                    'required' => 'You must provide a {field}.',
                    'is_unique' => 'The {field} you entered is already in our database.',
                    'regex_match' => 'The {field} you entered is not an {field} ',
                    'validate_if_staff_email' => "Your email is already registered as a Staff Email"
                ),
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[6]|max_length[20]',
                'errors' => array(
                    'required' => 'You must provide an {field}.',
                    'min_length' => "{field}'s must have 6 characters",
                    'max_length' => "{field}'s must be less than 30 characters"
                ),
            ),
            array(
                'field' => 'phone',
                'label' => 'Phone Number',
                'rules' => 'required|min_length[8]',
                'errors' => array(
                    'required' => 'You must provide a {field}.',
                    'min_length' => 'Your {field} needs to have at least 8 digits'
                ),
            ),
            array(
                'field' => 'address_one',
                'label' => 'Address One',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field}.'
                ),
            ),
            array(
                'field' => 'address_two',
                'label' => 'Address Two',
                'rules' => '',
                'errors' => array(),
            ),
            array(
                'field' => 'city',
                'label' => 'City',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field}.'
                ),
            ), array(
                'field' => 'postcode',
                'label' => 'Postcode',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field}.'
                ),
            ), array(
                'field' => 'state',
                'label' => 'State',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field}.'
                ),
            ),
            array(
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field}.'
                ),
            ));
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $account_info = $this->session->userdata("account_info");
            $header_data['sidebars'] = $this->sidebar->get_sidebars_by_permission($account_info['permission_status']);
            $header_data['title'] = "Register";
            $this->load->view("template/header");
            $this->load->view("generic/signUp");
        } else {
            $this->load->model("Customer_model");
            $this->load->model("Login_data");
            // this assoc array must have same key as DB field names
            $customer_data = array(
                "first_name" => $this->input->post("first_name"),
                "last_name" => $this->input->post("last_name"),
                "email" => $this->input->post("email"),
                "password" => hash("sha256", $this->input->post("password")),
                "phone" => $this->input->post("phone"),
                "address_one" => $this->input->post("address_one"),
                "address_two" => $this->input->post("address_two"),
                "city" => $this->input->post("city"),
                "postcode" => $this->input->post("postcode"),
                "state" => $this->input->post("state"),
                "country" => $this->input->post("country"),
            );

            $this->Customer_model->add_customer($customer_data);
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
        $this->load->model("Customer_model");
        $this->load->model("Supplier");
        $this->load->model("Staff");
        $this->load->model("Permission");
        $validate_login_customer = $this->Customer_model->login_customer($data);
        if ($validate_login_customer !== FALSE) {
            $account_status = "customer";
            $account_info = array(
                "account_id" => $validate_login_customer,
                "permission_id" => $this->Permission->get_permission_id_by_permission_name("$account_status"),
                "permission_status" => $account_status,
            );
            $this->session->set_userdata("account_info", $account_info);
            return true;
        } else {
            $validate_login_staff = $this->Staff->login_staff($data);
            if ($validate_login_staff !== FALSE) {
                $account_status = "staff";
                $account_info = array(
                    "account_id" => $validate_login_staff,
                    "permission_id" => $this->permission->get_permission_id_by_permission_name("$account_status"),
                    "permission_status" => $account_status,

                );
                $this->session->set_userdata("account_info", $account_info);
                return true;
            }
        }
        return false;
    }

    public function validate_if_staff_email($email)
    {
        $this->load->model("staff");
        $query_result = $this->staff->get_staff_by_email($email);
        if (count($query_result) > 0) {
            return false;
        }
        return true;
    }

    // show logged in page
    public function logged_in()
    {
        $this->load->view("logged_in");
    }
    public function debugger(){
        $var = "staff";
        $this->load->model($var);
        $var_method = "get_all_staff";
        $this->$var->$var_method();
    }
}