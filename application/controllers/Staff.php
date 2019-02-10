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