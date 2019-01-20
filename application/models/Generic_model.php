<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 08/01/2019
 * Time: 12:34
 */

class Generic_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_table($table_name){
        return $this->db->get($table_name)->result();
    }
    public function get_select_info($table_name)
    {
        $this->db->select('COLUMN_NAME as name');
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $table_name);
        $this->db->where("(`COLUMN_KEY` != 'PRI' OR COLUMN_NAME = 'account_id')");
        $this->db->from("INFORMATION_SCHEMA`.`COLUMNS");
        $this->db->limit(1);
        $display_col = $this->db->get()->row()->name;
        $dd = $this->db->last_query();
        if ($display_col)
            $select_cols = array("{$table_name}_id", "$display_col");
        $columns = $this->get_all_col_names($table_name);
        foreach ($columns as $column) {
            if ($column->label == "price") {
                $select_cols[] = $column->label;
                break;
            }
        }
        // getting first col (pk), getting first non column key col
        $this->db->select($select_cols);
        $this->db->from($table_name);
        return $this->db->get()->result_array();
    }

    public function get_all_col_names($table_name)
    {
        // returns all form fields, as well as data type
        $this->db->select("COLUMN_NAME AS label, DATA_TYPE as data_type, IS_NULLABLE as can_be_null, COLUMN_KEY as column_key");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $table_name);
        $this->db->from("INFORMATION_SCHEMA`.`COLUMNS");
        $form_fields = $this->db->get()->result();
        foreach ($form_fields as $form_field) {
            $form_field->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $form_field->label)));
            $form_field->is_required = ($form_field->can_be_null == "NO") ? TRUE : FALSE;
        }
        return $form_fields;
    }

    public function get_col_names($table_name)
    {
        // returns all form fields, as well as data type
        $this->db->select("COLUMN_NAME AS label, DATA_TYPE as data_type, IS_NULLABLE as can_be_null");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        if ($table_name)
            $this->db->where("TABLE_NAME", $table_name);
        $this->db->where("(`COLUMN_KEY` = '' OR `COLUMN_KEY` = 'UNI')");
        $this->db->from("INFORMATION_SCHEMA`.`COLUMNS");
        $form_fields = $this->db->get()->result();
        $dd = $this->db->last_query();
        foreach ($form_fields as $form_field) {
            $form_field->field = str_replace("Id", "ID", ucwords(str_replace("_", " ", $form_field->label)));
            $form_field->is_required = ($form_field->can_be_null == "NO") ? TRUE : FALSE;
        }
        return $form_fields;
    }

    public function get_required_col_names($table_name)
    {
        $this->db->select("COLUMN_NAME AS name");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $table_name);
        $this->db->where("COLUMN_KEY", "");
        $this->db->from("INFORMATION_SCHEMA`.`COLUMNS");
        $result = $this->db->get()->result_array();
        return array_map(function ($value) {
            return $value['name'];
        }, $result);
    }

    public function get_non_primary_and_non_foreign_key_columns($table_name)
    {
        $this->db->select("COLUMN_NAME AS name, DATA_TYPE as data");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $table_name);
        $this->db->where("COLUMN_KEY", "");
        $this->db->from("INFORMATION_SCHEMA`.`COLUMNS");
        return $this->db->get()->result();
    }

    public function get_foreign_key_table_names($table_name)
    {
        $this->db->select("LEFT(COLUMN_NAME,length(COLUMN_NAME)-3)  as 'name'");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $table_name);
        $this->db->where("COLUMN_KEY != ", "");
        $this->db->where("COLUMN_KEY != ", "UNI");
        $this->db->where("ORDINAL_POSITION != ", "1");
        $this->db->from("`INFORMATION_SCHEMA`.`COLUMNS`");
        $result = $this->db->get()->result_array();
        $dd = $this->db->last_query();
        return array_map(function ($value) {
            return $value['name'];
        }, $result);
    }

    public function inner_join_tables_by_foreign_pk($table_name, $foreign_table, $join_id)
    {
        $this->db->from("$table_name");
        $this->db->join("$foreign_table", "{$foreign_table}.{$foreign_table}_id = $table_name.{$foreign_table}_id", 'inner');
        $this->db->where("{$table_name}.{$foreign_table}_id", $join_id);
        $result = $this->db->get()->row();
        $dd = $this->db->last_query();
        return $result;
    }

    public function get_multi_foreign_key_table_names($table_name)
    {
        $this->db->select("TABLE_NAME as table");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("REFERENCED_TABLE_NAME", $table_name);
        $this->db->from("INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE");
        $this->db->like('TABLE_NAME', 'multi_');
        $result = $this->db->get()->result_array();
        return array_map(function ($value) {
            return $value['table'];
        }, $result);
    }

    public function get_multi_foreign_table_info($multi_foreign_table_name)
    {
        $this->db->select("LEFT(COLUMN_NAME,length(COLUMN_NAME) - 3)  as name, IS_NULLABLE as can_be_null");
        $this->db->from("INFORMATION_SCHEMA.COLUMNS");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $multi_foreign_table_name);
        $this->db->where("COLUMN_KEY != ", "");
        $this->db->where("ORDINAL_POSITION != ", "1");
        return $this->db->get()->result();
    }

    public function tables_are_multi_related($table_name, $foreign_table)
    {
        $foreign_table_potential = $this->get_multi_foreign_key_table_names($table_name);
        if (empty($foreign_table_potential)) {
            return FALSE;
        }
        $foreign_table_name = $foreign_table_potential[0];
        $this->db->select("COLUMN_NAME as name");
        $this->db->from("INFORMATION_SCHEMA.COLUMNS");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $foreign_table_name);
        $this->db->where("ORDINAL_POSITION != ", "1");
        $foreign_table_column_names = array_map(function ($value) {
            return $value['name'];
        }, $this->db->get()->result_array());
        foreach ($foreign_table_column_names as $foreign_table_column_name) {
            if (strtolower($foreign_table_column_name) == strtolower($foreign_table . "_id"))
                return $foreign_table_potential[0];
        }
        return FALSE;
    }

    public function form_is_multi_related($table_name, $multi_table)
    {
        $this->db->select("COLUMN_NAME as name");
        $this->db->from("INFORMATION_SCHEMA.COLUMNS");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $multi_table);
        $result = $this->db->get()->result();
        return ($result[0]->name == "{$table_name}_id") ? true : false;
    }

    public function get_account_name_by_account_id($account, $account_id)
    {
        $this->db->select("CONCAT(`first_name`, ' ', `last_name`) AS 'name'");
        $this->db->from("$account");
        $this->db->join('account', "{$account}.account_id = account.account_id", 'inner');
        $this->db->where("account.account_id", $account_id);
        $result = $this->db->get()->row()->name;
        $dd = $this->db->last_query();
        return $result;
    }

    public function get_account_name_by_foreign_account_id($account, $account_id)
    {
        $this->db->select("CONCAT(`first_name`, ' ', `last_name`) AS 'name'");
        $this->db->from("$account");
        $this->db->join('account', "{$account}.account_id = account.account_id", 'inner');
        $this->db->where("{$account}.{$account}_id", $account_id);
        $result = $this->db->get()->row()->name;
        $dd = $this->db->last_query();
        return $result;
    }

    public function get_table_row_by_primary_key($table_name, $primary_key_id = "0")
    {
        $this->db->where("{$table_name}_id", $primary_key_id);
        $result = $this->db->get($table_name)->row_array();
        if (empty($result)) {
            return FALSE;
        }
        return $result;
    }
    public function get_multi_table_rows_by_col($table_name, $col_name, $col_value){
        $this->db->where("$col_name", $col_value);
        return $this->db->get($table_name)->result();
    }
    public function add_data($table_name)
    {
        // form field names is array with form
        $table_post_data = $this->input->post($table_name);
        if ($table_name == "staff" || $table_name == "customer") {
            $this->add_account($table_post_data, $table_name);
        } else {
            if (isset($_FILES['image_path'])) {
                // getting absolute path, replacing backslashes with forward slashes due to full_path data is forward slash
                $absolute_path = str_replace('\\', '/', FCPATH);
                //finding absolute path in full_path and reverting it to project path to be used as image
                $image_path = "/" . str_replace($absolute_path, "", $this->upload->data('full_path'));
                $table_post_data['image_path'] = $image_path;
            }
            $this->db->insert($table_name, $table_post_data);
            $insert_id = $this->db->insert_id();
            $multi_tables = $this->get_multi_foreign_key_table_names($table_name);
            foreach ($multi_tables as $multi_table) {
                $multi_table_add_data = $_SESSION["{$table_name}_add_data"][$multi_table] ?? array();
                foreach ($multi_table_add_data as $multi_table_cols) {
                    foreach ($multi_table_cols as $multi_tables_value) {
                        $multi_tables_value["{$table_name}_id"] = $insert_id;
                        $this->db->insert($multi_table, $multi_tables_value);
                    }
                }
                unset($_SESSION["{$table_name}_add_data"][$multi_table]);
            }
        }
    }

    public function add_account($model_data, $account_type)
    {
        $columns_class = $this->Generic_model->get_non_primary_and_non_foreign_key_columns($account_type);
        $data = array();
        foreach ($columns_class as $column_class) {
            $data[$column_class->name] = $model_data[$column_class->name];
            unset($model_data[$column_class->name]);
        }
        if ($account_type != "staff")
            $model_data['permission_id'] = "1";
        $model_data['password'] = hash('sha256', $model_data['password']);
        $this->db->insert('account', $model_data);
        $data['account_id'] = $this->db->insert_id();
        unset($data['permission_id']);
        $this->db->insert($account_type, $data);
    }

    public function view_data($model, $table_id)
    {
        $col_names = $this->get_col_names($model);
        $this->load->model($model);
        $model_function = "get_{$model}_by_id";
        $this->$model->$model_function($table_id);
    }
}