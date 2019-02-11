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

    public function view_my_work_orders($work_order_id = NULL)
    {
        $this->load->model(array("Work_order_model", "Permission_model"));
        $this->load->library("table");
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (isset($work_order_id)) {
            $ownership = $this->Work_order_model->confirm_work_order_ownership_by_staff_id($work_order_id, $account_info['staff_id']);
            if ($ownership == FALSE) {
                $this->session->set_flashdata('temp_info', 'You do not own this Work Order.');
                redirect(site_url('staff_account/view_my_work_orders'));
            }
            $work_order_info = $this->Work_order_model->view_work_order($work_order_id);
            $available_functions = $this->Permission_model->get_available_functions("{$uri}", $account_info['permission_id']);
            $data['available_functions'] = $available_functions;
            $data['temp_info'] = $_SESSION['temp_info'] ?? "";
            $data['work_order_info'] = $work_order_info;
            initialize_header();
            $this->load->view('staff/view_my_work_order', $data);
        } else {
            $staff_orders = $this->Work_order_model->get_work_orders_by_staff_id($account_info['staff_id']);
            if ($staff_orders == FALSE) {
                $this->session->set_flashdata('temp_info', 'You have no Staff Orders.');
                redirect(site_url('dashboard/home'));
            }
            $this->table->set_heading("Quote Name", "Quote Price", "Requested Quantity", "Customer", "Status", "View");
            foreach ($staff_orders as $staff_order) {
                $view_href = site_url("staff_account/view_my_work_orders/{$staff_order->work_order_id}");
                $this->table->add_row($staff_order->quote_name, "€$staff_order->quote_price",
                    $staff_order->requested_quantity, $staff_order->customer_name, $staff_order->quote_status, "<a href='{$view_href}'><div class='button'>View</div></a>");
            }
            $data['work_order_table'] = $this->table->generate();
            initialize_header();
            $this->load->view("staff/view_my_work_orders", $data);
        }
    }

    public function edit_my_work_order($work_order_id = NULL)
    {
        $this->load->model(array("Work_order_model", "Permission_model", "Customer_quote_model"));
        $this->load->library("table");
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (isset($work_order_id)) {
            $ownership = $this->Work_order_model->confirm_work_order_ownership_by_staff_id($work_order_id, $account_info['staff_id']);
            if ($ownership == FALSE) {
                $this->session->set_flashdata('temp_info', 'You do not own this Work Order.');
                redirect(site_url('staff_account/view_my_work_orders'));
            }
            $this->load->helper('form');
            $this->load->library('form_validation');
            $config = array(
                array(
                    'field' => 'status',
                    'label' => 'Status',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'stock_quantity',
                    'label' => 'Stock Quantity',
                    'rules' => 'required',
                    'errors' => array(
                        'required' => '{field} is required.',
                    ),
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                $work_order_info = $this->Work_order_model->view_work_order($work_order_id);
                $data['temp_info'] = $_SESSION['temp_info'] ?? "";
                $data['work_order_info'] = $work_order_info;
                initialize_header();
                $this->load->view('staff/edit_my_work_order', $data);
            } else {
                $work_order_data = array(
                    'status' => $this->input->post('status')
                );
                $this->Work_order_model->edit_work_order($work_order_id, $work_order_data);
                $customer_quote_id = $this->Work_order_model->get_customer_quote_id_by_work_order_id($work_order_id);
                $customer_quote_data = array(
                    'stock_quantity' => $this->input->post('stock_quantity')
                );
                $this->Customer_quote_model->edit_customer_quote($customer_quote_id, $customer_quote_data);
                redirect(site_url("Staff_account/view_my_work_orders/{$work_order_id}"));
            }
        } else {
            $this->session->set_flashdata('temp_info', 'You did not select a work order.');
            redirect(site_url("Staff_Account/view_my_work_orders"));
        }

    }

    public function view_unassigned_work_orders($work_order_id = NULL)
    {
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        $this->load->model(array("Work_order_model", "Permission_model"));
        $this->load->library("table");
        $account_info = $this->session->userdata('account_info') ?? NULL;
        if (isset($work_order_id)) {
            $unassigned_work_order_info = $this->Work_order_model->view_work_order($work_order_id);
            $available_functions = $this->Permission_model->get_available_functions("{$uri}", $account_info['permission_id']);
            $data['available_functions'] = $available_functions;
            $data['temp_info'] = $_SESSION['temp_info'] ?? "";
            $data['work_order_info'] = $unassigned_work_order_info;
            initialize_header();
            $this->load->view('staff/view_unassigned_work_order', $data);
        } else {
            $unassigned_work_orders = $this->Work_order_model->view_all_unassigned_work_orders();
            $this->table->set_heading("Quote Name", "Quote Price", "Requested Quantity", "Customer", "View");
            foreach ($unassigned_work_orders as $unassigned_work_order) {
                $view_href = site_url("staff_account/view_unassigned_work_orders/{$unassigned_work_order->work_order_id}");
                $this->table->add_row($unassigned_work_order->quote_name, "€$unassigned_work_order->quote_price",
                    $unassigned_work_order->quote_quantity, $unassigned_work_order->customer_name, "<a href='{$view_href}'><div class='button'>View</div></a>");
            }
            $work_order_table = $this->table->generate();
            $data['work_order_table'] = $work_order_table;
            initialize_header();
            $this->load->view('staff/view_unassigned_work_orders', $data);
        }
    }

    public function assign_work_order($work_order_id = NULL)
    {
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (isset($work_order_id)) {
            $this->load->model(array("Work_order_model"));
            $account_info = $this->session->userdata('account_info') ?? NULL;
            $this->Work_order_model->assign_work_order($work_order_id, $account_info['staff_id']);
        }
        $this->session->set_flashdata('temp_info', 'Work Order assigned successfully.');
        redirect(site_url('staff_account/view_my_work_orders'));
    }

    public function unassign_my_work_order($work_order_id = NULL)
    {
        $this->load->model(array("Work_order_model"));
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        $account_info = $this->session->userdata('account_info') ?? NULL;
        if (isset($work_order_id)) {
            $ownership = $this->Work_order_model->confirm_work_order_ownership_by_staff_id($work_order_id, $account_info['staff_id']);
            if ($ownership == FALSE) {
                $this->session->set_flashdata('temp_info', 'You do not own this Work Order.');
                redirect(site_url('staff_account/view_my_work_orders'));
            } else {
                $this->load->model(array("Work_order_model"));
                $this->Work_order_model->unassign_work_order($work_order_id);
                $this->session->set_flashdata('temp_info', 'Work Order unassigned successfully.');
                redirect(site_url('staff_account/view_my_work_orders'));
            }
        } else {
            redirect(site_url('staff_account/view_my_work_orders'));
        }

    }

    public function complete_my_work_order($work_order_id = NULL)
    {
        $this->load->model(array("Work_order_model"));
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        $account_info = $this->session->userdata('account_info') ?? NULL;
        if (isset($work_order_id)) {
            $ownership = $this->Work_order_model->confirm_work_order_ownership_by_staff_id($work_order_id, $account_info['staff_id']);
            if ($ownership == FALSE) {
                $this->session->set_flashdata('temp_info', 'You do not own this Work Order.');
                redirect(site_url('staff_account/view_my_work_orders'));
            } else {
                $this->load->model(array("Work_order_model"));
                $this->Work_order_model->complete_work_order($work_order_id);
                $this->session->set_flashdata('temp_info', 'Work Order completed successfully.');
                redirect(site_url('staff_account/view_my_work_orders'));
            }
        }
        $this->session->set_flashdata('temp_info', 'Work Order successfully completed.');
        redirect(site_url('staff_account/view_my_work_orders'));
    }

    public function view_unassigned_lot_travellers($lot_traveller_id = NULL)
    {
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        $this->load->model(array("Lot_traveller_model", "Permission_model"));
        $this->load->library("table");
        $account_info = $this->session->userdata('account_info') ?? NULL;
        if (isset($lot_traveller_id)) {
            $unassigned_lot_traveller_info = $this->Lot_traveller_model->view_lot_traveller($lot_traveller_id);
            $available_functions = $this->Permission_model->get_available_functions("{$uri}", $account_info['permission_id']);
            $data['available_functions'] = $available_functions;
            $data['temp_info'] = $_SESSION['temp_info'] ?? "";
            $data['lot_traveller_info'] = $unassigned_lot_traveller_info;
            initialize_header();
            $this->load->view('staff/view_unassigned_lot_traveller', $data);
        } else {
            $unassigned_lot_travellers = $this->Lot_traveller_model->view_all_unassigned_lot_travellers();
            $this->table->set_heading("Product Name", "Product Price", "Production Quantity", "Status", "View");
            foreach ($unassigned_lot_travellers as $unassigned_lot_traveller) {
                $view_href = site_url("staff_account/view_unassigned_lot_travellers/{$unassigned_lot_traveller->lot_traveller_id}");
                $this->table->add_row($unassigned_lot_traveller->product_price, "€$unassigned_lot_traveller->product_price",
                    $unassigned_lot_traveller->production_quantity, $unassigned_lot_traveller->status, "<a href='{$view_href}'><div class='button'>View</div></a>");
            }
            $lot_traveller_table = $this->table->generate();
            $data['lot_traveller_table'] = $lot_traveller_table;
            initialize_header();
            $this->load->view('staff/view_unassigned_lot_travellers', $data);
        }
    }

    public function view_my_lot_travellers($lot_traveller_id = NULL)
    {
        $this->load->model(array("Lot_traveller_model", "Permission_model"));
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->library("table");
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (isset($lot_traveller_id)) {
            $ownership = $this->Lot_traveller_model->confirm_lot_traveller_ownership_by_staff_id($lot_traveller_id, $account_info['staff_id']);
            if ($ownership == FALSE) {
                $this->session->set_flashdata('temp_info', 'You do not own this Work Order.');
                redirect(site_url('staff_account/view_my_lot_travellers'));
            }
            $lot_traveller_info = $this->Lot_traveller_model->view_lot_traveller($lot_traveller_id);
            $available_functions = $this->Permission_model->get_available_functions("{$uri}", $account_info['permission_id']);
            $data['available_functions'] = $available_functions;
            $data['temp_info'] = $_SESSION['temp_info'] ?? "";
            $data['lot_traveller_info'] = $lot_traveller_info;
            initialize_header();
            $this->load->view('staff/view_my_lot_traveller', $data);
        } else {
            $lot_travellers = $this->Lot_traveller_model->get_lot_travellers_by_staff_id($account_info['staff_id']);
            if ($lot_travellers == FALSE) {
                $this->session->set_flashdata('temp_info', 'You have no Staff Orders.');
                redirect(site_url('dashboard/home'));
            }
            $this->table->set_heading("Product Name", "Product Price", "Production Quantity", "Status", "View");
            foreach ($lot_travellers as $lot_traveller) {
                $view_href = site_url("staff_account/view_my_lot_travellers/{$lot_traveller->lot_traveller_id}");
                $this->table->add_row($lot_traveller->product_price, "€$lot_traveller->product_price",
                    $lot_traveller->production_quantity, $lot_traveller->status, "<a href='{$view_href}'><div class='button'>View</div></a>");
            }
            $lot_traveller_table = $this->table->generate();
            $data['lot_traveller_table'] = $lot_traveller_table;
            initialize_header();
            $this->load->view("staff/view_my_lot_travellers", $data);
        }
    }

    public function assign_lot_traveller($lot_traveller_id = NULL)
    {
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (isset($lot_traveller_id)) {
            $this->load->model(array("Lot_traveller_model"));
            $account_info = $this->session->userdata('account_info') ?? NULL;
            $this->Lot_traveller_model->assign_lot_traveller($lot_traveller_id, $account_info['staff_id']);
        }
        $this->session->set_flashdata('temp_info', 'Work Order assigned successfully.');
        redirect(site_url('staff_account/view_my_lot_travellers'));
    }

    public function edit_my_lot_traveller($lot_traveller_id = NULL)
    {
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->model(array("Lot_traveller_model", "Staff_model"));
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (!isset($lot_traveller_id)) {
            $this->session->set_flashdata('temp_info', 'You did not select a Lot Traveller!');
            redirect(site_url("/staff_account/view_my_lot_travellers"));
        }
        if ($this->Lot_traveller_model->confirm_lot_traveller_ownership_by_staff_id($account_info['staff_id'], $lot_traveller_id) == FALSE) {
            $this->session->set_flashdata('temp_info', 'That is not your Lot Traveller!');
            redirect(site_url("/staff_account/view_my_lot_travellers"));
        }
        $this->load->helper('form');
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'status',
                'label' => 'Status',
                'rules' => 'required'
            ),
            array(
                'field' => 'production_quantity',
                'label' => 'Product Quantity',
                'rules' => 'required|numeric',
                'errors' => array(
                    'required' => '{field} is required.',
                ),
            )
        );
        $this->form_validation->set_rules($config);
        $lot_traveller_info = $this->Lot_traveller_model->get_lot_traveller_by_id($lot_traveller_id);
        if ($this->form_validation->run() == FALSE) {
            $data['lot_traveller_info'] = $lot_traveller_info;
            initialize_header();
            $this->load->view("staff/edit_my_lot_traveller", $data);
        } else {
            $lot_traveller_info = array(
                'status' => $this->input->post('status'),
                'production_quantity' => $this->input->post('production_quantity')
            );
            $this->Lot_traveller_model->edit_lot_traveller($lot_traveller_id, $lot_traveller_info);
            $this->session->set_flashdata('temp_info', 'Lot Traveller Edited Successful');
            redirect(site_url("/staff_account/view_my_lot_travellers/$lot_traveller_id"));
        }
    }

    public function finish_my_lot_traveller($lot_traveller_id)
    {
        $account_info = $this->session->userdata('account_info') ?? NULL;
        $this->load->model(array("Lot_traveller_model", "Staff_model"));
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (!isset($lot_traveller_id)) {
            $this->session->set_flashdata('temp_info', 'You did not select a Lot Traveller!');
            redirect(site_url("/staff_account/view_my_lot_travellers"));
        }
        if (!$this->Lot_traveller_model->confirm_lot_traveller_ownership_by_staff_id($account_info['staff_id'], $lot_traveller_id) == FALSE) {
            $this->session->set_flashdata('temp_info', 'That is not your Lot Traveller!');
            redirect(site_url("/staff_account/view_my_lot_travellers"));
        }
        $this->Lot_traveller_model->finish_lot_traveller($lot_traveller_id);
        $this->session->set_flashdata('temp_info', 'Lot Traveller Edited Successful');
        redirect(site_url('staff_account/view_my_lot_travellers'));
    }

    public function edit_my_account()
    {
        $this->load->model("Staff_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
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