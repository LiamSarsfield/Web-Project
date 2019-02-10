<?php
/**
 * Created by PhpStorm.
 * User: liam1
 * Date: 03/02/2019
 * Time: 21:18
 */

class Staff_Account extends CI_Controller
{
    function __construct()
    {
        // Staff Account = ONLY THINGS STAFF CAN ACCESS
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
        // if not signed in
        if (!isset($account_info)) {
            redirect(site_url() . "/home");
        }
    }

    public function view_my_work_orders()
    {
        $this->load->model("Staff_order_model");
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->library("table");
        $staff_orders = $this->Staff_order_model->get_staff_orders_by_staff_id($account_info['staff_id']);
        if ($staff_orders == FALSE) {
            $this->session->set_flashdata('temp_info', 'You have no Staff Orders.');
            redirect(site_url('dashboard/home'));
        }
        $this->table->set_heading('Date Ordered', 'Total Price', 'View');
        foreach ($staff_orders as $staff_order) {
            $view_staff_order_href = site_url("staff_account/view_my_staff_order/{$staff_order->staff_order_id}");
            $this->table->add_row($staff_order->date_ordered, $staff_order->total_price,
                "<a href='{$view_staff_order_href}'><div class='button'>View</div></div></a>");
        }
        $data['table'] = $this->table->generate();
        initialize_header();
        $this->load->view("staff/view_my_staff_orders", $data);
    }

    public function view_my_lot_travellers()
    {
        $this->load->model("Staff_order_model");
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->library("table");
        $staff_orders = $this->Staff_order_model->get_staff_orders_by_staff_id($account_info['staff_id']);
        if ($staff_orders == FALSE) {
            $this->session->set_flashdata('temp_info', 'You have no Staff Orders.');
            redirect(site_url('dashboard/home'));
        }
        $this->table->set_heading('Date Ordered', 'Total Price', 'View');
        foreach ($staff_orders as $staff_order) {
            $view_staff_order_href = site_url("staff_account/view_my_staff_order/{$staff_order->staff_order_id}");
            $this->table->add_row($staff_order->date_ordered, $staff_order->total_price,
                "<a href='{$view_staff_order_href}'><div class='button'>View</div></div></a>");
        }
        $data['table'] = $this->table->generate();
        initialize_header();
        $this->load->view("staff/view_my_staff_orders", $data);
    }


    public function edit_my_work_order($staff_order_id = NULL, $item_name = NULL, $function = NULL, $item_id = NULL)
    {
        $this->load->model("Staff_order_model");
        // can only change quantity, delete existing products, delete existing staff orders
        if (isset($function) && isset($item_id)) {
            if ($item_name == 'product') {
                if ($function == 'delete') {
                    $products = $this->Staff_order_model->get_staff_order_products_by_staff_order_id($staff_order_id);
                    if (count($products > 2)) {
                        $this->session->set_flashdata('temp_info', 'You cannot delete the last product in a staff order!');
                        redirect(site_url("staff_account/view_my_staff_order/{$staff_order_id}"));
                    }
                    $this->Staff_order_model->remove_product_from_staff_order_by_order_id($staff_order_id, $item_id);
                    redirect(site_url("staff_account/view_my_staff_order/{$staff_order_id}"));
                }
            } else if ($function == 'staff_quote') {
                redirect(site_url("staff_account/view_my_staff_order/{$staff_order_id}"));
            } else {

            }
        } else if (isset($staff_order_id)) {
            redirect(site_url('staff_account/view_my_staff_orders'));
        } else {
            $this->session->set_flashdata('temp_info', 'You did not select a Staff Order!');
            redirect(site_url("/staff_account/view_my_staff_orders"));
        }
    }

    public function edit_my_lot_traveller($staff_order_id = NULL)
    {
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->model(array("Staff_order_model", "Staff_model"));
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
//        is_restricted($uri);
        if (!isset($staff_order_id)) {
            $this->session->set_flashdata('temp_info', 'You did not select a Staff Order!');
            redirect(site_url("/staff_account/view_my_staff_orders"));
        }
        if ($this->Staff_order_model->confirm_staff_owns_order($account_info['staff_id'], $staff_order_id) == FALSE) {
            $this->session->set_flashdata('temp_info', 'That is not your Staff Order!');
            redirect(site_url("/staff_account/view_my_staff_orders"));
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'card_number',
                'label' => 'Card Number',
                'rules' => 'required'
            ),
            array(
                'field' => 'expiry',
                'label' => 'Expiry',
                'rules' => 'required',
                'errors' => array(
                    'required' => '{field} is required.',
                ),
            ),
            array(
                'field' => 'cvv',
                'label' => 'CVV',
                'rules' => 'required',
                'errors' => array(
                    'required' => '{field} is required.',
                ),
            )
        );
        $this->form_validation->set_rules($config);
        $staff_order_info = $this->Staff_order_model->get_staff_order_by_id($staff_order_id);
        if ($this->form_validation->run() == FALSE) {
            $data['staff_order_info'] = $staff_order_info;
            initialize_header();
            $this->load->view("staff/pay_for_my_order", $data);
        } else {
            $this->load->model("Staff_invoice_model");
            $staff_invoice_data = array(
                'staff_order_id' => $staff_order_id,
                'total_price' => $staff_order_info->total_price
            );
            $this->Staff_invoice_model->add_staff_invoice($staff_invoice_data);
            $this->session->set_flashdata('temp_info', 'Payment Successful');
            redirect(site_url("/staff_account/view_my_staff_order/$staff_order_id"));
        }
    }

    public function edit_my_account()
    {
        $this->load->model("Staff_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
//        is_restricted($uri);
        $account_info = $this->session->userdata('account_info') ?? NULL;
        if (!isset($account_info['staff_id'])) {
            $this->session->set_flashdata('temp_info', 'Cannot find your Staff ID.');
            redirect('dashboard/home');
        }
        $staff_info = $this->Staff_model->get_staff_edit_info($account_info['staff_id']);
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
                'rules' => 'required|callback_validate_edit_staff_email[' . $account_info['staff_id'] . ']',
                'errors' => array(
                    'validate_edit_staff_email' => '{field} already exists in DB.',
                )
            ),
            array(
                'field' => 'old_password',
                'label' => 'Old Password',
                'rules' => "required|callback_validate_old_password[{$account_info['account_id']}]",
                'errors' => array(
                    'validate_old_password' => '{field} is incorrect.',
                )
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[6]'
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
                'field' => 'country',
                'label' => 'Country',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['staff_info'] = $staff_info;
            initialize_header();
            $this->load->view("staff/view_my_account", $data);
        } else {
            $this->Staff_model->edit_staff($account_info['staff_id']);
            $this->session->set_flashdata('temp_info', 'You have successfully edited your account.');
            redirect(site_url("dashboard/home"));
        }
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

    public function validate_old_password($old_password, $account_id)
    {
        $this->load->model("Account_model");
        $encrypted_password = hash("sha256", $old_password);
        return $this->Account_model->password_matches($encrypted_password, $account_id);
    }
}