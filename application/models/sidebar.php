<?php
/**
 * Created by PhpStorm.
 * User: Liam
 * Date: 10/12/2018
 * Time: 16:07
 */

class sidebar extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_sidebars_by_permission($name = "unregistered")
    {
        //get permission id for the name
        $this->load->model("Permission");
        $permission_id = $this->Permission->get_permission_id_by_permission_name($name);
        $sidebar_ids = $this->get_permitted_sidebar_ids_by_permission_id($permission_id);
        $sidebar_mains = array();
        foreach ($sidebar_ids as $sidebar_id) {
            $sidebar_main = $this->get_sidebar_info_by_sidebar_id($sidebar_id);
            $sidebar_main->sub_sidebar_array = array();
            //get sub_sidebar_ids that the user has permission to access
            $permitted_sub_sidebar_ids = $this->get_permitted_sub_sidebar_ids_by_sidebar_id($permission_id, $sidebar_id);
            foreach ($permitted_sub_sidebar_ids as $permitted_sub_sidebar_id) {
                //returning sub_side_field info related to the sidebar that we want
                $sub_side_info = $this->get_sub_sidebar_info_by_sub_sidebar_id($permitted_sub_sidebar_id);
                // pushing the sub_sidebar info/fields into the sub_sidebar_array
                $sidebar_main->sub_sidebar_array[] = $sub_side_info;
            }
            //appending the sidebar we just got with the established sidebar_main
            $sidebar_mains[] = $sidebar_main;
            // optimization method(clears query memory)
            //$query->free_result();
        }
        //returns an array of classes that include sidebar info + array of sub_sidebars classes within each sidebar
        return $sidebar_mains;
    }

    public function get_all_sidebars()
    {

    }

    //getting sidebar ids and sub_side_bar_ids related to it
    public function get_permitted_sidebar_ids_by_permission_id($permission_id = "1")
    {
        $this->db->select("sidebar_id", "permission_id");
        $this->db->where('permission_id', $permission_id);
        $this->db->order_by("sidebar_id", "asc");
        $this->db->from('sidebar_permissions');
        $query = $this->db->get();
        $sidebar_ids = array();
        foreach ($query->result() as $row) {
            $sidebar_ids[] = $row->sidebar_id;
        }
        return $sidebar_ids;
    }

    public function get_permitted_sub_sidebar_ids_by_sidebar_id($permission_id = "0", $sidebar_id = "0")
    {
        $this->db->select("permission_id, sidebar_id, sub_sidebar_id");
        $this->db->where('permission_id', $permission_id);
        $this->db->where('sidebar_id', $sidebar_id);
        $this->db->from('sub_sidebar_permissions');
        $query = $this->db->get();
        $sub_sidebar_ids = array();
        foreach ($query->result() as $row) {
            $sub_sidebar_ids[] = $row->sub_sidebar_id;
        }
        return $sub_sidebar_ids;
    }

    public function get_permitted_sub_sidebar_id_by_sidebar_name($permission_id = "0", $sub_sidebar_name = "No Function")
    {
        $this->db->select("permission_id, sidebar_id, sub_sidebar_id");
        $this->db->where('permission_id', $permission_id);
        $this->db->where('sub_sidebar_id', $sub_sidebar_name);
        $this->db->from('sub_sidebar_permissions');
        return $this->db->get()->row();
    }

    public function get_sidebar_info_by_sidebar_id($sidebar_id = "0")
    {
        //going to return one sidebar info but NOT sub_side bar info (until further down)
        $this->db->where('sidebar_id', $sidebar_id);
        $this->db->from('sidebar');
        $query = $this->db->get();
        return $query->row();
    }

    //returns sub_main with a property of of sidebar_ids array
    public function get_sub_sidebar_ids_by_sidebar_id($sidebar_id)
    {
        $this->db->where('sidebar_id', $sidebar_id);
        $this->db->from('sidebars_have_sub_sidebars');
        $query = $this->db->get();
        // returning an array of all sub side bars associated with the sidebar
        $sub_sidebar_ids = array();

        foreach ($query->result() as $row) {
            $sub_sidebar_ids[] = $row->sub_sidebar_id;
        };
        return $sub_sidebar_ids;
    }

    //returns name of sub_sidebar by its id
    public function get_sub_sidebar_info_by_sub_sidebar_id($sub_sidebar_id = "0")
    {
        $this->db->where("sub_sidebar_id", $sub_sidebar_id);
        $this->db->from('sub_sidebar');
        return $this->db->get()->row();
    }
    public function is_permitted_to_view_sub_sidebar($permission_id, $sub_sidebar_id){
        $this->db->where("sub_sidebar_id", $sub_sidebar_id);
        $this->db->where("permission_id", $permission_id);
        $this->db->from("sub_sidebar_permissions");
        if($this->db->get()->num_rows() === 1){
            return true;
        };
        return false;
    }
    public function get_sub_sidebar_info_by_name($name)
    {
        $this->db->where("name", $name);
        $this->db->from("sub_sidebar");
        return $this->db->get()->row();
    }
}