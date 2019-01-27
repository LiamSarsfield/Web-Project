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
        $this->load->model("Permission_model");
        // if session is not set redirect to sign in
        if (!isset($account_info['permission_id']) && $account_info['permission_id'] !== "unregistered") {
            redirect(site_url() . "/home/login");
        }
    }

    public function view($table_name = NULL, $search_id = NULL)
    {
        if (!isset($table_name)) {
            redirect(site_url("dashboard/home"));
        }
        $this->load->library('table');
        $this->load->model(array("Generic_model"));
        //if uri after search id is set, engage in a foreach to search if it matches a foreign table
        // if matches foreign table, display info from its primary keys
        // if it isn't set AND foreign table is a multi table, display button to select all
        if (isset($search_id)) {
            $view_data = $this->get_all_table_details_by_pk($table_name, $search_id);
            $multi_foreign_table_names = $this->Generic_model->get_multi_foreign_key_table_names($table_name);
            $multi_table_info = array();
            foreach ($multi_foreign_table_names as $multi_foreign_table_name) {
                // this specific multi table
                $meta_multi_foreign_table_rows = $this->Generic_model->get_multi_foreign_table_info($multi_foreign_table_name);
                foreach ($meta_multi_foreign_table_rows as $meta_multi_foreign_table_row) {
                    $skimmed_multi_foreign_table_rows = array();
                    // multi table cols/table name
                    $multi_foreign_table_rows = $this->Generic_model->inner_join_multi_tables_by_foreign_pk($multi_foreign_table_name, $table_name, $meta_multi_foreign_table_row->name, $search_id);
                    foreach ($multi_foreign_table_rows as $multi_foreign_table_row) {
                        $skimmed_multi_foreign_table_row = array();
                        $col_counter = 0;
                        foreach ($multi_foreign_table_row as $multi_foreign_table_col => $multi_foreign_table_value) {
                            if (substr($multi_foreign_table_col, -2) !== "id") {
                                $skimmed_multi_foreign_table_row[$multi_foreign_table_col] = $multi_foreign_table_value;
                                $col_counter++;
                            }
                            if ($col_counter == 2) {
                                break;
                            }
                        }
                        $skimmed_multi_foreign_table_rows[] = $skimmed_multi_foreign_table_row;
                    }
                    $multi_table_info[$meta_multi_foreign_table_row->name] = $skimmed_multi_foreign_table_rows;
                }
            }
            $multi_tables = array();
            foreach ($multi_table_info as $multi_table_name => $multi_table_array) {
                $table = "";
                $table .= "<h3>" . ucwords(str_replace("_", " ", $multi_table_name)) . "s</h3>";
                if (!empty($multi_table_array)) {
                    $column_headers = array();
                    foreach ($multi_table_array[0] as $multi_table_column => $multi_table_value) {
                        $column_headers[] = str_replace("Id", "ID", ucwords(str_replace("_", " ", $multi_table_column)));
                    }
                    $this->table->set_heading($column_headers);
                }
                foreach ($multi_table_array as $multi_table_row) {
                    $this->table->add_row($multi_table_row);
                }
                if (!empty($multi_table_array)) {
                    $table .= $this->table->generate();
                    $multi_tables[] = $table;
                }
            }
            foreach ($view_data as $view_info_key => $view_table) {
                $columns = array();
                foreach ($view_table as $table_column => $table_value) {
                    if ($table_column == "password")
                        continue;
                    if ($table_column == "image_path") {
                        $table_column = "Image";
                        $table_value = base_url($table_value);
                        $table_value = "<img class = 'view_image' src='$table_value' alt='Image'>";
                    }
                    $column = new stdClass();
                    $column->label = $table_column;
                    $column->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $table_column)));
                    $column->value = $table_value;
                    $columns[] = $column;
                    unset($view_data[$view_info_key][$table_column]);
                }
                $view_data[$view_info_key] = new stdClass();
                $view_data[$view_info_key]->columns = $columns;
//                    $view_data[$view_info_key] = $columns;
            }
            $data['table_name'] = ucwords(str_replace("_", " ", $table_name));
            $data['view_data'] = $view_data;
            $data['multi_tables'] = $multi_tables;
            initialize_header();
            $this->load->view("generic/view_selected_form", $data);
            //customer table will have account table, inner join every foreign table with main table

        } else {
            $column_headers = array();
            $table_rows = $this->Generic_model->get_select_info($table_name);
            foreach ($table_rows as $table_row) {
                foreach ($table_row as $table_column_key => $table_column_value) {
                    if ($table_column_key != "{$table_name}_id" && substr($table_column_key, -2) == "id") {
                        if ($table_column_key == "account_id") {
                            $this->load->model("Account_model");
                            $account_info = $this->Account_model->get_account_view_info_from_account_id($table_column_value);
                            $table_row = array_merge($table_row, $account_info);
                        }
                        //unsets foreign key from table view
                        unset($table_row[$table_column_key]);
                    }
                }
                $table_row_primary_key = "{$table_name}_id";
                $add_button = site_url("/functions/view/{$table_name}/$table_row[$table_row_primary_key]");
                $table_row['View'] = "<p><a href='{$add_button}'><div class='button'>View</div></a></p>";
                $this->table->add_row($table_row);
                // if table_row has a foreign key in it, remove it
            }
            if (!empty($table_rows)) {
                foreach ($table_row as $column => $value) {
                    $column_headers[] = str_replace("Id", "ID", ucwords(str_replace("_", " ", $column)));
                }
                $this->table->set_heading($column_headers);
                $data['table'] = $this->table->generate();
            } else {
                redirect(site_url(('dashboard/home')));
            }
            initialize_header();
            $this->load->view("generic/view_form", $data);
        }


    }

    public function add($model)
    {
        $uri_strings = explode('/', uri_string());
        $uri_strings = array_splice($uri_strings, "3");
        $this->session->set_userdata("{$model}_add_uris", $uri_strings);
        $model = strtolower($model);
        $model_formatted = $model . "_model";
        $this->load->model(array($model_formatted, "Generic_model", "Sidebar_model"));
        $this->load->library(array('form_validation', 'table'));
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
            $foreign_form_field_data = $this->initialize_foreign_data($model);
        }
        foreach ($foreign_form_field_data as $foreign_form_field_data_index => $table) {
            $multi_basket_info = array();
            if ($table->is_multi_table) {
                foreach ($table->multi_table_cols as $multi_class_index => $multi_class) {
                    $basket_info = $this->get_multi_table_basket_info($model, $multi_class->name, $table->name);
                    $table_info = "";
                    if (!empty($basket_info)) {
                        $columns = array();
                        foreach ($basket_info[0] as $column => $row) {
                            if (substr($column, 0, 5) != "meta_") {
                                $columns[] = str_replace("Id", "ID", ucwords(str_replace("_", " ", $column)));
                            }
                        }
                        $this->table->set_heading($columns);
                        foreach ($basket_info as $row) {
                            $table_row = array();
                            foreach ($row as $row_col => $row_value) {
                                if (substr($row_col, 0, 5) != "meta_") {
                                    $table_row[] = $row_value;
                                }
                            }
                            $this->table->add_row($table_row);
                        }
                        $table_info = $this->table->generate();
                    }
                    $foreign_form_field_data[$foreign_form_field_data_index]->multi_table_cols[$multi_class_index]->basket_values = $basket_info;
                    $foreign_form_field_data[$foreign_form_field_data_index]->multi_table_cols[$multi_class_index]->table = $table_info;
                }
                $foreign_form_field_data[$foreign_form_field_data_index]->multi_table_values = $multi_basket_info;
            }
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

    public function select($table_name = NULL, $foreign_table = NULL, $id = NULL, $quantity = NULL)
    {
        $this->load->library('table');
        $this->load->model("Generic_model");
        if (!isset($table_name) || !isset($foreign_table)) {
            redirect(site_url("home/dashboard"));
        }
        $multi_related_table_name = $this->Generic_model->tables_are_multi_related($table_name, $foreign_table);
        $foreign_table_data = $this->Generic_model->get_select_info($foreign_table);
        if (isset($id)) {
            if ($multi_related_table_name) {
                $multi_add_data = $this->session->userdata("{$table_name}_add_data") ?? array(
                        "$multi_related_table_name" => array(),
                    );
                $multi_table_row_info["{$foreign_table}_id"] = $id;
                if (isset($quantity)) {
                    $multi_table_row_info['quantity'] = $quantity;
                }
                $already_added = false;
                if (isset($multi_add_data["$multi_related_table_name"][$foreign_table])) {
                    foreach ($multi_add_data["$multi_related_table_name"][$foreign_table] as $multi_add_index => $multi_add_datum) {
                        if ($multi_table_row_info["{$foreign_table}_id"] == $multi_add_datum["{$foreign_table}_id"]) {
                            if (isset($quantity) && $quantity == "0") {
                                unset($multi_add_data["$multi_related_table_name"][$foreign_table][$multi_add_index]);
                            } else {
                                $multi_add_data["$multi_related_table_name"][$foreign_table][$multi_add_index] = $multi_table_row_info;
                            }
                            $already_added = true;
                            break;
                        }
                    }
                }
                if (!$already_added) {
                    $multi_add_data["$multi_related_table_name"][$foreign_table][] = $multi_table_row_info;
                }
                $this->session->set_userdata("{$table_name}_add_data", $multi_add_data);
                redirect(site_url("functions/select/{$table_name}/{$foreign_table}/"));
            }
        }
        $table_name = strtolower($table_name);
        $foreign_table = strtolower(($foreign_table));
        // tables are multi related
        $columns = array();
        $column_headers = array();
        if (!empty($foreign_table_data)) {
            foreach ($foreign_table_data[0] as $foreign_table_column => $foreign_table_value) {
                $column_class = new stdClass();
                if ($foreign_table_column == "account_id")
                    $foreign_table_column = "Name";
                $column_class->label = $foreign_table_column;
                $column_class->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $foreign_table_column)));
                $columns[] = $column_class;
                $column_headers[] = $column_class->field;
            }
        }
        // if you're selecting many from a multi table (productS for customer_order)
        if ($multi_related_table_name) {
            $data['multi_related_table_name'] = $multi_related_table_name;
            $multi_columns = $this->Generic_model->get_non_primary_and_non_foreign_key_columns($multi_related_table_name);
            foreach ($multi_columns as $multi_column) {
                $column_class = new stdClass();
                $column_class->label = $multi_column->name;
                $column_class->field = ucwords(str_replace("_", " ", $multi_column->name));
                $column_class->data = $multi_column->data;
                $columns[] = $column_class;
                $column_headers[] = $column_class->field;
            }
            $column_headers[] = "Add";
        } else
            $column_headers[] = "Select";
        $this->table->set_heading($column_headers);

        //now to add the rows
        foreach ($foreign_table_data as $foreign_table_datum) {
            $rows = array();
            foreach ($columns as $column_value) {
                if ($column_value->label == "quantity") {
                    $select_info = "";
                    $select_info .= "<select name=\"amount\" class=\"w3-input w3-padding-16\">";
                    // we need to see if it is set otherwise quantity starts at 0
                    if (isset($_SESSION["{$table_name}_add_data"][$multi_related_table_name][$foreign_table])) {
                        for ($i = 0; $i < 11; $i++) {
                            $temp_select_info = "<option value='$i'>$i</option>";
                            foreach ($_SESSION["{$table_name}_add_data"][$multi_related_table_name][$foreign_table] as $multi_basket) {
                                if ($multi_basket["{$foreign_table}_id"] == $foreign_table_datum["{$foreign_table}_id"] && $i == $multi_basket['quantity']) {
                                    $temp_select_info = "<option selected='selected' value='$i'>$i</option>";
                                    break;
                                }
                            }
                            $select_info .= $temp_select_info;
                        }
                    } else {
                        $select_info .= "<option value='1'>1</option>
                      <option value='2'>2</option>
                      <option value='3'>3</option>
                      <option value='4'>4</option>
                      <option value='5'>5</option>
                      <option value='6'>6</option>
                      <option value='7'>7</option>
                      <option value='8'>8</option>
                      <option value='9'>9</option>
                      <option value='10'>10</option>";
                    }
                    $select_info .= "</select>";
                    $rows[] = $select_info;
                } else if ($column_value->label == "Name") {
                    $rows [] = $this->Generic_model->get_account_name_by_account_id($foreign_table, $foreign_table_datum['account_id']);
                } else {
                    $rows[] = $foreign_table_datum[$column_value->label];
                }
            }
            $add_uris = (!empty($_SESSION["{$table_name}_add_uris"])) ? implode("/", $_SESSION["{$table_name}_add_uris"]) . "/" : "";
            $add_button = site_url("/functions/add/{$table_name}/$add_uris{$rows[0]}");
            if ($multi_related_table_name) {
                $multi_table_params = ($column_class->label == "quantity") ? "$rows[0]/1" : "$rows[0]";
                //if quantity is set, then an extra param will be set
                $rows[] = "<p><a href='$multi_table_params'><div class='button'>Add</div></a></p>";
            } else {
                $rows[] = "<p><a href='{$add_button}'><div class='button'>Select</div></a></p>";
            }
            if ($table_name == "credit_note" && $foreign_table != "customer_order") {
                if (!isset($_SESSION["{$table_name}_add_uris"][0]))
                    break;
                $customer_order_rows = $this->Generic_model->get_table("multi_customers_order_items");
                foreach ($customer_order_rows as $row) {
                    if (isset($row->product_id) && $row->product_id == $_SESSION["{$table_name}_add_uris"][0]) {
                        $this->table->add_row($rows);
                        continue;
                    }
                }
            } else {
                $this->table->add_row($rows);
            }
        }
        $table_template = array(
            'table_open' => "<table style='width:60%; margin-left:20%;'>"
        );
        $this->table->set_template($table_template);
        $data['table'] = $this->table->generate();
        $data['table_name'] = $table_name;
        $data['foreign_table'] = $foreign_table;
        // if the user selected something from the multi table its added to a session
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
        if (empty($foreign_table)) {
            $all_single_tables_info_exist = TRUE;
        }
        for ($i = 0; $i < count($foreign_tables); $i++) {
            $foreign_table = new stdClass();
            $foreign_table->name = $foreign_tables[$i];
            $foreign_table->exists = FALSE;
            $foreign_table->is_multi_table = FALSE;
            $foreign_table->can_be_null = $this->Generic_model->col_can_be_null($table_name, $foreign_table->name, TRUE);
            $foreign_table->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $foreign_table->name)));
            $foreign_table_id = $uri_strings[$i] ?? NULL;
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
                    if ($foreign_table_column == "customer_id" || $foreign_table_column == "staff_id") {
                        $foreign_table_column_class = new stdClass();
                        $foreign_table_column_class->value = $this->Generic_model->get_account_name_by_foreign_account_id($foreign_tables[$i], $foreign_table_id);
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
                    $foreign_table = new stdClass();
                    $foreign_table->exists = TRUE;
                    $foreign_table->name = $foreign_multi_table;
                    $foreign_table->field = ucwords(str_replace("_", " ", str_replace("multi_", "", $foreign_multi_table)));
                    $foreign_table->is_multi_table = TRUE;
                    $foreign_table->can_be_null = TRUE;
                    $foreign_table->multi_table_cols = array();
                    foreach ($foreign_multi_table_data as $foreign_multi_table_column) {
                        $foreign_table_multi_col = new stdClass();
                        $foreign_table_multi_col->exists = TRUE;
                        $foreign_table_multi_col->is_multi_table = TRUE;
                        $foreign_table_multi_col->name = $foreign_multi_table_column->name;
                        $foreign_table_multi_col->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $foreign_multi_table_column->name)));
                        $foreign_table_multi_col->multi_table_name = $foreign_multi_table;
                        $foreign_table_multi_col->can_be_null = ($foreign_multi_table_column->can_be_null == "YES") ? TRUE : FALSE;
                        $foreign_table->multi_table_cols[] = $foreign_table_multi_col;
                    }
                    $foreign_form_field_data[] = $foreign_table;
                }
            }
        }
        return $foreign_form_field_data;
    }

    public function get_all_table_details_by_pk($table_name, $primary_id)
    {
        $foreign_tables = $this->initialize_foreign_data($table_name);
        $table_row = $this->Generic_model->get_table_row_by_primary_key($table_name, $primary_id);
        if ($table_row == false) {
            return array();
        }
        $result_table_row = array();
        foreach ($foreign_tables as $foreign_table) {
            if (substr($foreign_table->name, 0, 6) !== "multi_") {
                $result_table_row = $this->get_all_table_details_by_pk($foreign_table->name, $table_row["{$foreign_table->name}_id"]);
            }

        }
        foreach ($table_row as $table_column => $table_value) {
            if (substr($table_column, -2) == "id" && $table_column != NULL)
                unset($table_row[$table_column]);
            else
                break;
        }
        $result_table_row["$table_name"] = $table_row;
        return $result_table_row;
        // recursive function returns ALL data related to a table

    }

    public function get_all_edit_table_details_by_pk($table_name, $primary_id)
    {
        $foreign_tables = $this->initialize_foreign_data($table_name);
        $table_row = $this->Generic_model->get_table_row_by_primary_key($table_name, $primary_id);
        $result_table_row = array();
        foreach ($foreign_tables as $foreign_table) {
            $test = substr($foreign_table->name, 0, 5);
            if (substr($foreign_table->name, 0, 6) !== "multi_") {
                $result_table_row = $this->get_all_table_details_by_pk($foreign_table->name, $table_row["{$foreign_table->name}_id"]);
            }

        }
        $result_table_row["$table_name"] = $table_row;
        return $result_table_row;
        // recursive function returns ALL data related to a table

    }

    public function get_multi_table_basket_info($table_name, $foreign_table, $multi_related_table_name)
    {
        $selected_data_rows = $_SESSION["{$table_name}_add_data"]["$multi_related_table_name"][$foreign_table] ?? array();
        $selected_basket_details = array();
        // foreach sub table col
        foreach ($selected_data_rows as $selected_data_row_index => $selected_data_row) {
            foreach ($selected_data_row as $row_col => $row_value) {
                //if it is equal to id, then we get its all the id's info
                if (substr($row_col, -2) == "id") {
                    $selected_basket_details = array();
                    $basket_table_name = substr($row_col, 0, -3);
                    $selected_basket_details['meta_table_name'] = $basket_table_name;
                    $selected_basket_details['meta_multi_table_name'] = $multi_related_table_name;
                    $all_table_basket_details = $this->Generic_model->get_table_row_by_primary_key($basket_table_name, $row_value);
                    if ($basket_table_name == "product" || $basket_table_name == "customer_quote") {
                        $selected_basket_details['Name'] = $all_table_basket_details['name'];
                        $selected_basket_details['Price'] = $all_table_basket_details['price'];
                    } else if ($basket_table_name == "customer" || $basket_table_name == "staff") {
                        $selected_basket_details['Name'] = $this->Generic_model->get_account_name_by_foreign_account_id($basket_table_name, $all_table_basket_details["{$basket_table_name}_id"]);
                    } else {
                        foreach ($all_table_basket_details as $basket_col => $basket_value) {
                            if (substr($basket_col, -2) == "id") {
                                unset($all_table_basket_details[$basket_col]);
                            } else
                                break;
                        }
                        $all_table_basket_details = array_slice($all_table_basket_details, 0, 2);
                        $selected_basket_details = $all_table_basket_details;
                    }
                }
            }
            $selected_data_rows[$selected_data_row_index] = array_merge($selected_data_rows[$selected_data_row_index], $selected_basket_details);
        }
        return $selected_data_rows;
    }

    public function edit($table_name = NULL, $search_id = NULL, $multi_table = NULL)
    {
        if (!isset($table_name)) {
            redirect(site_url('dashboard/home'));
        } else if (!isset($search_id)) {
            redirect(site_url("functions/view/{$search_id}/"));
        } else if (isset($multi_table)) {

        } else {
            $this->load->model("Generic_model");
            $table_info = $this->get_all_edit_table_details_by_pk($table_name, $search_id);
            $sss = 2;
        }
    }

    public function upload_image()
    {
        $config['upload_path'] = './assets/images/product';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 20000;
        $config['max_width'] = 10243;
        $config['max_height'] = 7638;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("image_path")) {
            return true;
        } else {
            $this->form_validation->set_message('upload_image', $this->upload->display_errors());
            return false;
        }
    }

    public
    function manage_permissions()
    {

    }
}