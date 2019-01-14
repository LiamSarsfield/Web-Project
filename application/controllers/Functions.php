<?php
/**
 * Created by PhpStorm.
 * User: liam1
 * Date: 05/01/2019
 * Time: 13:20
 */

class Functions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
        // if session is not set redirect to sign in
        if (!isset($account_info['permission_id']) && $account_info['permission_id'] !== "unregistered") {
            redirect(site_url() . "/home/login");
        }
    }

    public function view($table_name, $search_id = NULL)
    {
        $this->load->library('table');
        $this->load->model(array("Generic_model"));
        if (isset($search_id)) {

        } else {
            $table_rows = $this->Generic_model->get_select_info($table_name);
            foreach ($table_rows as $table_row) {
                foreach ($table_row as $table_column_key => $table_column_value) {
                    if ($table_column_key != "{$table_name}_id" && substr($table_column_key, -2) == "id") {
                        if ($table_column_key == "account_id") {
                            $this->load->model("Account_model");
                            $test = $this->Account_model->get_account_view_info_from_account_id($table_column_value);
                            $table_row = array_merge($table_row, $test);
                        }
                        unset($table_row[$table_column_key]);
                    }
                    $changed_table_row = $table_row;
                }
                $add_button = site_url("/functions/view/{$table_name}/{$table_name}_id");
                $table_row[] = "<p><a href='{$add_button}'><div class='button'>Add</div></a></p>";
                $this->table->add_row($table_row);
                // if table_row has a foreign key in it, remove it
            }
            if (!empty($table_rows)) {
                $column_headers = array();
                foreach ($changed_table_row as $column => $value) {
                    $column_headers[] = str_replace("Id", "ID", ucwords(str_replace("_", " ", $column)));
                }
                $column_headers[] = "View";
                $this->table->set_heading($column_headers);
                $data['table'] = $this->table->generate();
                initialize_header();
                $this->load->view("generic/view_form", $data);
            }
            $dd = 2;
        }


    }

    public function add($model)
    {
        $model_formatted = $model . "_model";
        try {
            $this->load->model(array($model_formatted, "Generic_model", "Sidebar_model"));
        } catch (RuntimeException $e) {
            redirect(site_url() . "/dashboard/home");
        }
        $this->load->library(array('form_validation'));
        $foreign_form_field_data = array();
        $form_field_data = array();
        // if your adding staff or customer, account table cols need to be displayed
        if ($model == "staff" || $model == "customer") {
            $form_field_data = array_merge($form_field_data, $this->Generic_model->get_col_names("account"));
            // if adding staff, you can change permission type
            if ($model == "staff") {
                $foreign_form_field_data = array_merge($foreign_form_field_data, $this->initialize_foreign_data("account"));
            }
        } else {
//      returns foreign field data in array within array of id and name or else button
            $foreign_form_field_data = array_merge($foreign_form_field_data, $this->initialize_foreign_data($model));
        }
        $form_field_data = array_merge($form_field_data, $this->Generic_model->get_col_names($model));
        $this->initialize_form_validation($model, $form_field_data);
        // if form validation is invalid or if image is needed, and upload is invalid...
        if ($this->form_validation->run() == FALSE) {
            initialize_header();
//          add info includes id (foreign keys) the table might need for data, (need which customer id for customer order)
//          $add_info = array($this->uri->segment(4, "0"), $this->uri->segment(5, "0"), $this->uri->segment(6, "0"));
//          possible info the view might need, returns an assoc. array
//          $data['model_info'] = $this->$model_formatted->get_all_add_info($add_info);
            $data['form_field_data'] = $form_field_data;
            $data['foreign_form_field_data'] = $foreign_form_field_data;
            $data['table_name'] = $model;
//          $this->Generic_model->add($model);
            $this->load->view("generic/add_form", $data);
        } else {
            $this->Generic_model->add_data($model);
            redirect(site_url() . "/dashboard");
        }
    }

    public function select($table_name = NULL, $foreign_table = NULL, $id = "0")
    {
        if (!isset($table_name) || !isset($foreign_table)) {
            redirect(site_url("home/dashboard"));
        }
        $this->load->library('table');
        $this->load->model("Generic_model");
        // tables are multi related
        $multi_related_tables = $this->Generic_model->tables_are_multi_related($table_name, $foreign_table);
        $foreign_table_data = $this->Generic_model->get_select_info($foreign_table);
        $columns = array();
        $column_headers = array();
        if (!empty($foreign_table_data)) {
            $foreign_table_columns = array_keys($foreign_table_data[0]);
            foreach ($foreign_table_columns as $foreign_table_column) {
                $column_class = new stdClass();
                $column_class->label = $foreign_table_column;
                $column_class->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $foreign_table_column)));;
                $columns[] = $column_class;
                $column_headers[] = $column_class->field;
            }
        }

        if (!$multi_related_tables) {

        } else {
            $multi_columns = $this->Generic_model->get_non_primary_and_non_foreign_key_columns($multi_related_tables);
            foreach ($multi_columns as $multi_column) {
                $column_class = new stdClass();
                $column_class->label = $multi_column->name;
                $column_class->field = ucwords(str_replace("_", " ", $multi_column->name));
                $column_class->data = $multi_column->data;
                $columns[] = $column_class;
                $column_headers[] = $column_class->field;
            }
        };
        $column_headers[] = "Add";
        $this->table->set_heading($column_headers);
        foreach ($foreign_table_data as $foreign_table_datum) {
            $rows = array();
            foreach ($columns as $column) {
                if ($column->label == "quantity")
                    $rows[] = "<select name=\"amount\" class=\"w3-input w3-padding-16\">
                      <option value='1'>1</option>
                      <option value='2'>2</option>
                      <option value='3'>3</option>
                      <option value='4'>4</option>
                      <option value='5'>5</option>
                      <option value='6'>6</option>
                      <option value='7'>7</option>
                      <option value='8'>8</option>
                      <option value='9'>9</option>
                      <option value='10'>10</option>
                      </select>";
                else
                    $rows[] = $foreign_table_datum[$column->label];
            }
            $add_button = site_url("/functions/add/{$table_name}/{$rows[0]}");
            $rows[] = "<p><a href='{$add_button}'><div class='button'>Add</div></a></p>";
            $this->table->add_row($rows);
        }
        $table_template = array(
            'table_open' => "<table style='width:60%; margin-left:20%;'>"
        );
        $this->table->set_template($table_template);
        $data['table'] = $this->table->generate();

        initialize_header();
        $this->load->view("generic/select_form", $data);
    }

    public function initialize_form_validation($table_name, $form_field_data)
    {
        // getting all the required fields for the form
        foreach ($form_field_data as $form_field) {
            // display name - replaces _ with spaces and capitalises first word, capitilized ID
            $rules = array();
            $rules_error = array();
            if ($form_field->is_required == FALSE && $form_field->label == "image_path") {
                $rules[] = "callback_upload_image";
                if (!isset($_FILES['image_path'])) {
                    $rules[] = "required";
                    $rules_error['required'] = "You must provide a {field}";
                }
            } else if ($form_field->can_be_null == "NO") {
                $rules[] = "required";
                $rules_error['required'] = "{field} is required.";
            }
            if ($form_field->data_type == "DECIMAL") {
                $rules[] = "numeric";
                $rules_error['numeric'] = "{field} must be numeric.";
            }
            $this->form_validation->set_rules("{$table_name}[{$form_field->label}]", $form_field->field, $rules, $rules_error);
        }
    }

    public function initialize_foreign_data($table_name)
    {
        $uri_strings = explode('/', uri_string());
        $uri_strings = array_splice($uri_strings, "3");
        $foreign_tables = $this->Generic_model->get_foreign_key_table_names($table_name);
        $foreign_multi_tables = $this->Generic_model->get_multi_foreign_key_table_names($table_name);
        $all_single_tables_info_exist = FALSE;
        $foreign_form_field_data = array();
        for ($i = 0; $i < count($foreign_tables); $i++) {
            $foreign_table = new stdClass();
            $foreign_table->name = $foreign_tables[$i];
            $foreign_table->exists = FALSE;
            $foreign_table->is_multi_table = FALSE;
            $foreign_table->can_be_null = FALSE;
            $foreign_table->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $foreign_table->name)));
            $foreign_table_id = $uri_strings[$i] ?? NULL;
            $foreign_table_formatted = $foreign_tables[$i] . "_model";
            $this->load->model($foreign_table_formatted);
            // if uri has an id in it, find the needed info for it to display what the user selected
            $foreign_table_row_result = $this->Generic_model->get_table_row_by_primary_key($foreign_tables[$i], $foreign_table_id);
            // if info was found... will return 1d array with pk first and a human readable name second (e.g. name)
            if ($foreign_table_row_result) {
                foreach ($foreign_table_row_result as $key => $value) {
                    // if value is not primary key and ends in id, it must be foreign key, therefore strip it from array of values
                    if ($key != "{$foreign_tables[$i]}_id" && substr($key, -2) == "id") {
                        unset($foreign_table_row_result[$key]);
                    }
                }
                $foreign_table_info_required = array_slice($foreign_table_row_result, 0, 2);
                $foreign_table->exists = TRUE;
                // if this info exists then we know the user can select from a multi table
                $all_single_tables_info_exist = TRUE;
                $foreign_table_columns = array_keys($foreign_table_info_required);
                foreach ($foreign_table_columns as $foreign_table_column) {
                    $foreign_table_column_class = new stdClass();
                    $foreign_table_column_class->value = $foreign_table_info_required[$foreign_table_column];
                    $foreign_table_column_class->label = $foreign_table_column;
                    $foreign_table_column_class->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $foreign_table_column)));
                    $foreign_table->columns[] = $foreign_table_column_class;
                    if ($foreign_table_column == "customer_id") {
                        $foreign_table_column_class = new stdClass();
                        $this->load->model("Customer_model");
                        $foreign_table_column_class->value = $this->Customer_model->get_customer_account_name_by_customer_id($foreign_table_id);
                        $foreign_table_column_class->label = "name";
                        $foreign_table_column_class->field = "Name";
                        $foreign_table->columns[] = $foreign_table_column_class;
                    }
                }
            }
            array_push($foreign_form_field_data, $foreign_table);
        }
        if ($all_single_tables_info_exist && !empty($foreign_multi_tables)) {
            // if there are more than 1 multi relationship...
            foreach ($foreign_multi_tables as $foreign_multi_table) {
                if (!$this->Generic_model->form_is_multi_related($table_name, $foreign_multi_table))
                    continue;
                // getting specific multi info
                $foreign_multi_table_data = $this->Generic_model->get_multi_foreign_table_info($foreign_multi_table);
                if ($foreign_multi_table_data) {
                    foreach ($foreign_multi_table_data as $foreign_multi_table_column) {
                        $foreign_table = new stdClass();
                        $foreign_table->exists = TRUE;
                        $foreign_table->name = $foreign_multi_table_column->name;
                        $foreign_table->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $foreign_multi_table_column->name)));
                        $foreign_table->is_multi_table = TRUE;
                        $foreign_table->can_be_null = ($foreign_multi_table_column->can_be_null == "YES") ? TRUE : FALSE;
                        $foreign_table->columns = (isset($_SESSION[$foreign_multi_table])) ? $this->session->userdata($foreign_multi_table) : array();
                        $foreign_form_field_data[] = $foreign_table;
                    }
                }
            }

        }
        return $foreign_form_field_data;
    }

    public function upload_image()
    {
        $config['upload_path'] = './assets/images/product';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 20000;
        $config['max_width'] = 10243;
        $config['max_height'] = 7638;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('image_path')) {
            return true;
        } else {
            $this->form_validation->set_message('upload_image', $this->upload->display_errors());
            return false;
        }
    }

    public function manage_permissions()
    {

    }
}