<?php

class Product_model extends CI_Model
{
    function get_all_products()
    {
        $this->db->select("product_id, product_name, product_desc, product_price, image_path");
        $query = $this->db->get('product');
        if ($query->num_rows() > 0) {
            //            return $query->result_array();
            return $query;
        } else {
            return FALSE;
        }
    }

    function get_product_by_id($product_id)
    {
        $this->db->select("product_id, name, description, price, specs, stock_quantity, image_path");
        $this->db->where("product_id", $product_id);
        $query = $this->db->get('product');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function add_product($data)
    {
        $this->load->model("lot_traveller");
        $this->db->initialize_lot_traveller();
        $lot_traveller_id = $this->db->insert_id();
        $data['lot_traveller_id'] = $lot_traveller_id;
        if ($this->db->insert("product", $data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    public function add_product_by_post()
    {
        $this->load->model("lot_traveller");
        $this->db->initialize_lot_traveller();
        $lot_traveller_id = $this->db->insert_id();
        // image path is file path without base_url
        $image_path = "/" . str_replace(str_replace('\\', '/', FCPATH), "", $this->upload->data('full_path'));
        $product_data = array(
            "category_id" => "1",
            "lot_traveller_id" => $lot_traveller_id,
            "name" => $this->input->post("name"),
            "description" => $this->input->post("description"),
            "specs" => $this->input->post("description"),
            "image_path" => $image_path,
        );
        if ($this->db->insert("product", $product_data)) {
            return TRUE;
        } else {
            return TRUE;
        }
    }

    function add_entry()
    {

    }

    function delete_product($id)
    {
        //        $id = $this->input->post('id');
        $this->db->where('product_id', $id);
        $this->db->delete('product');
    }

    function update_customer_details($data)
    {
        $this->db->where('id', $id);
        $this->db->update('product', $data);
    }

    public function get_field_names()
    {
        return $this->db->list_fields('product');
    }

    public function get_form_field_names()
    {
        $this->db->select("COLUMN_NAME");
        $this->db->where("TABLE_SCHEMA", "account");
        $this->db->where("TABLE_NAME", "account");
        $this->db->where("COLUMN_KEY", "");
        $this->db->from("INFORMATION_SCHEMA`.`COLUMNS");
        return $this->db->get()->result();
    }

    public function get_all_add_info($info)
    {
        $this->load->model("category_model");
        $category_id = $info[0];
        $category = $this->category_model->get_category_by_id($category_id);
        if (!$category) {
            $model_info['labels_info'] = "<a href=\"category.html\"><div class=\"button\">Select Category</div></a>";
            $model_info['category_id'] = "0";
        } else {
            $model_info['labels_info'] = "<p><label for='category_id'>Category ID:</label>
                <input name='category_id' type='text' readonly required id='category_id' value='{$category->category_id}'></p>
                <p><label for='name'>Category Name:</label>
                <input name='name' type='text' readonly required id='' value='{$category->name}'></p>";
            $model_info['category_id'] = $category_id;
        }
        return $model_info;
    }

    public function get_select_info()
    {
        $this->db->select("product_id, name");
    }

}

