<?php

//home is for people who are not logged in ONLY
class home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("sidebar_model");
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
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You musts provide a {field}.'
                )
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $account_info = $this->session->userdata("account_info");
            initialize_header();
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
                'rules' => 'required|is_unique[account.email]|regex_match[/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/]',
                'errors' => array(
                    'required' => 'You must provide a {field}.',
                    'is_unique' => 'The {field} you entered is already in our database.',
                    'regex_match' => 'The {field} you entered is not an {field}.',
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
                'field' => 'postal_code',
                'label' => 'Postal Code',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a {field}.'
                ),
            ), array(
                'field' => 'province',
                'label' => 'Province',
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
            $header_data['sidebars'] = $this->sidebar_model->get_sidebars_by_permission($account_info['permission_status']);
            $header_data['title'] = "Register";
            $this->load->view("template/header", $header_data);
            $this->load->view("generic/sign_up");
        } else {
            $this->load->model("Customer_model");
            $this->load->model("account_model");
            // this assoc array must have same key as DB field names
            $account_data = array(
                "permission_id" => "1",
                "first_name" => $this->input->post("first_name"),
                "last_name" => $this->input->post("last_name"),
                "email" => $this->input->post("email"),
                "password" => hash("sha256", $this->input->post("password")),
                "phone" => $this->input->post("phone"),
                "address_one" => $this->input->post("address_one"),
                "address_two" => $this->input->post("address_two"),
                "city" => $this->input->post("city"),
                "province" => $this->input->post("province"),
                "postal_code" => $this->input->post("postal_code"),
                "country" => $this->input->post("country")
            );
            $account_id = $this->account_model->add_account($account_data);
            $customer_data = array(
                "account_id" => $account_id,
                "company" => $this->input->post("company")
            );
            $this->Customer_model->add_customer($customer_data);
            $this->validate_login($account_data['email'], $account_data['password']);
            redirect(site_url() . "/dashboard");
        }


    }

    public function about()
    {
        initialize_header();
        $this->load->view("generic/about");
    }

    public function contact()
    {
        initialize_header();
        $this->load->view("generic/contact");
    }

    public function validate_login($email, $password)
    {
        $this->load->model("login_data_model");
        $encrypted_password = $password;
        // if password is not encrypted, encrypt it
        if (!preg_match('/[A-Fa-f0-9]{64}/', $encrypted_password)) {
            $encrypted_password = hash("sha256", $encrypted_password);
        }
        $data = array(
            "email" => $email,
            "password" => $encrypted_password
        );
        $this->load->model("account_model");
        $account_info = $this->account_model->login($data);
        if ($account_info !== FALSE) {
            $this->load->model("Customer_model");
            $this->load->model("Staff_model");
            $account_session_info['account_id'] = $account_info->account_id;
            $account_session_info['permission_id'] = $account_info->permission_id;
            $customer_id = $this->Customer_model->get_customer_id_by_account_id($account_info->account_id);
            $staff_id = $this->Staff_model->get_staff_id_by_account_id($account_info->account_id);
            if ($customer_id !== FALSE) {
                $account_session_info['customer_id'] = $customer_id;
            } else if ($staff_id !== FALSE) {
                $account_session_info['staff_id'] = $staff_id;
            }
            $this->session->set_userdata("account_info", $account_session_info);
            return true;
        }
        return false;
    }

    public function validate_if_staff_email($email)
    {
        $this->load->model("Staff_model");
        $query_result = $this->staff_model->get_staff_by_email($email);
        if (count($query_result) > 0) {
            return false;
        }
        return true;
    }

}