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

    public function get_select_info($table_name)
    {
        $this->db->select('COLUMN_NAME as name');
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $table_name);
        $this->db->where("COLUMN_KEY != ", "PRI");
        $this->db->from("INFORMATION_SCHEMA`.`COLUMNS");
        $this->db->limit(1);
        $display_col = $this->db->get()->row()->name;
        // getting first col (pk), getting first non column key col
        $this->db->select("{$table_name}_id, $display_col");
        $this->db->from($table_name);
        return $this->db->get()->result();
    }

    public function get_all_col_names($table_name)
    {
        // returns all form fields, as well as data type
        $this->db->select("COLUMN_NAME AS label, DATA_TYPE as data_type, IS_NULLABLE as can_be_null");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $table_name);
        $this->db->where("COLUMN_KEY != ", "PRI");
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
        $this->db->where("TABLE_NAME", $table_name);
        $this->db->where("COLUMN_KEY != ", "PRI");
        $this->db->from("INFORMATION_SCHEMA`.`COLUMNS");
        $form_fields = $this->db->get()->result();
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

    public function get_non_primary_and_foreign_key_columns($table_name)
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
        $this->db->select("REFERENCED_TABLE_NAME as table");
        $this->db->where("TABLE_SCHEMA", $this->db->database);
        $this->db->where("TABLE_NAME", $table_name);
        $this->db->where("CONSTRAINT_NAME != ", "PRIMARY");
        $this->db->from("INFORMATION_SCHEMA`.`KEY_COLUMN_USAGE");
        $result = $this->db->get()->result_array();
        return array_map(function ($value) {
            return $value['table'];
        }, $result);
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

    public function tables_are_multi_related($table_name, $foreign_table = 2)
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
        return ($result[0]->name == "{$table_name}_id") ?  true : false;
    }

    public function add_data($table_name)
    {
        // form field names is array with form
        $model_insert_data = array();
        $table_post_data = $this->input->post($table_name);
        $table_post_data_keys = array_keys($table_post_data);
        foreach ($table_post_data_keys as $table_post_data_key) {
            if ($table_post_data[$table_post_data_key] == "image_path") {
                // getting absolute path, replacing backslashes with forward slashes due to full_path data is forward slash
                $absolute_path = str_replace('\\', '/', FCPATH);
                //finding absolute path in full_path and reverting it to project path to be used as image
                $image_path = "/" . str_replace($absolute_path, "", $this->upload->data('full_path'));
                $model_insert_data[$table_post_data[$table_post_data_key]] = $image_path;
            } else {
                $model_insert_data[$table_post_data_key] = $table_post_data[$table_post_data_key];
            }
        }
        $this->db->insert($table_name, $model_insert_data);
    }

    public function view_data($model, $table_id)
    {
        $col_names = $this->get_col_names($model);
        $this->load->model($model);
        $model_function = "get_{$model}_by_id";
        $this->$model->$model_function($table_id);
    }
}