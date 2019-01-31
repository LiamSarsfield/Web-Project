<?php
/**
 * Created by PhpStorm.
 * User: liam1
 * Date: 31/01/2019
 * Time: 14:49
 */

class Credit_note extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
//        if(!iset($account_info['permission_status'])){
//            redirect(site_url(). "/home");
//        }
    }

    public function edit_credit_note($credit_note_id = NULL)
    {
        $this->load->model("Credit_note_model");
        $this->load->helper('form');
        $this->load->library('form_validation');
        $uri = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        is_restricted($uri);
        if (!isset($credit_note_id)) {
            $this->session->set_flashdata('temp_info', 'You did not Enter a Credit_note ID!');
            redirect(site_url("/functions/view/credit_note/"));
        }
        $credit_note_info = $this->Credit_note_model->get_credit_note_by_id($credit_note_id);
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required'
            )
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $data['credit_note_info'] = $credit_note_info;
            initialize_header();
            $this->load->view("product/edit_credit_note", $data);
        } else {
            $this->Credit_note_model->edit_credit_note();
            $this->session->set_flashdata('temp_info', 'Credit_note Successfully Edited.');
            redirect(site_url("functions/view/credit_note/$credit_note_id"));
        }
    }

}