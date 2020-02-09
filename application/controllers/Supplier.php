<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 30/01/2019
 * Time: 20:33
 */

class Supplier extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
        if (!isset($account_info['permission_id'])) {
            redirect(site_url() . "/home");
        }
    }

    public function edit_supplier($supplier_id)
    {
        $this->load->model("Supplier_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        $supplier_id = $supplier_id ?? "-1";
        $supplier_info = $this->Supplier_model->get_supplier_edit_info($supplier_id);
        if ($supplier_info == FALSE) {
            $this->session->set_flashdata('temp_info', 'Supplier of that ID does not exist.');
            redirect(site_url('functions/view/supplier'));
        }
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'required|callback_validate_edit_supplier_email[' . $this->input->post('supplier_id') . ']|regex_match[/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/]',
                'errors' => array(
                    'required' => 'You must provide a {field}.',
                    'validate_edit_supplier_email' => '{field} already exists in DB.',
                    'regex_match' => 'The {field} you entered is not an {field}.',
                ),
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
            $data['supplier_info'] = $supplier_info;
            initialize_header();
            $this->load->view("supplier/edit_supplier", $data);
        } else {
            $this->Supplier_model->edit_supplier();
            $this->session->set_flashdata('temp_info', 'Supplier Successfully Edited.');
            redirect(site_url("functions/view/supplier/$supplier_id"));
        }
    }

    public function validate_edit_supplier_email($changed_supplier_email, $supplier_id = "0")
    {
        $supplier_email = $this->Supplier_model->get_supplier_email_by_supplier_id($supplier_id);
        if ($changed_supplier_email == $supplier_email)
            return true;
        $this->load->model("Account_model");
        $email_is_unique = $this->Account_model->check_if_email_is_unique($changed_supplier_email);
        if ($email_is_unique) {
            return true;
        } else {
            return false;
        }
    }
}