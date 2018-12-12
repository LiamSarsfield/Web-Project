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
        $permission_id = $this->get_permission_id_by_permission_name($name);
        $side_bar_ids = $this->get_permitted_side_bar_ids_by_permission_id($permission_id);
        $side_bar_mains = array();
        foreach ($side_bar_ids as $side_bar_id) {
            $side_bar_main = $this->get_side_bar_info_by_side_bar_id($side_bar_id);
            $side_bar_main->sub_side_bar_array = array();
            //get sub_side_bar_ids that the user has permission to access
            $permitted_sub_side_bar_ids = $this->get_permitted_sub_side_bar_ids_by_permission_id($permission_id, $side_bar_id);
            foreach ($permitted_sub_side_bar_ids as $permitted_sub_side_bar_id) {
                //returning sub_side_field info related to the side_bar that we want
                $sub_side_info = $this->get_sub_side_bar_info_by_sub_side_bar_id($permitted_sub_side_bar_id);
                    // pushing the sub_side_bar info/fields into the sub_side_bar_array
                $side_bar_main->sub_side_bar_array[] = $sub_side_info;
            }
            //appending the side_bar we just got with the established side_bar_main
            $side_bar_mains[] = $side_bar_main;
            // optimization method(clears query memory)
            //$query->free_result();
        }
        //returns an array of classes that include side_bar info + array of sub_side_bars classes within each side_bar
        return $side_bar_mains;
    }

    public function get_all_sidebars()
    {

    }
    public function get_permission_id_by_permission_name($name = "unregistered"){
        $this->db->from('permissions');
        $this->db->where("name", $name);
        return $this->db->get()->row()->permission_id ?? "0";
    }
    public function get_permitted_side_bar_ids_by_permission_id($permission_id = "1")
    {
        $this->db->select("side_bar_id", "permission_id");
        $this->db->from('side_bar_permissions');
        $this->db->where('permission_id', $permission_id);
        $query = $this->db->get();
        $side_bar_ids = array();
        foreach ($query->result() as $row)
        {
            $side_bar_ids[] = $row->side_bar_id;
        }
        return $side_bar_ids;
    }

    public function get_permitted_sub_side_bar_id_by_permission_id($permission_id ="1", $sub_side_bar_id = "0"){
        $this->db->select("sub_side_bar_id");
        $this->db->from('sub_side_bar_permissions');
        $this->db->where('sub_side_bar_id', $sub_side_bar_id);
        $this->db->where('permission_id', $permission_id);
        $query = $this->db->get();
        $sub_side_bar_ids = array();
        foreach ($query->result() as $row)
        {
            $sub_side_bar_ids[] = $row->sub_side_bar_id;
        }
        return $sub_side_bar_ids;
    }

    public function get_side_bar_info_by_side_bar_id($side_bar_id = "0")
    {
        $this->db->from('side_bar');
        //going to return one side_bar info but NOT sub_side bar info (until further down)
        $this->db->where('side_bar_id', $side_bar_id);
        $query = $this->db->get();
        return $query->row();
    }

    //returns sub_main with a property of of side_bar_ids array
    public function get_sub_side_bar_ids_by_side_bar_id($side_bar_id)
    {
        $this->db->from('side_bars_have_sub_side_bars');
        $this->db->where('side_bar_id', $side_bar_id);
        $query = $this->db->get();
        // returning an array of all sub side bars associated with the side_bar
        $sub_side_bar_ids = array();

        foreach($query->result() as $row){
            $sub_side_bar_ids[] = $row->sub_side_bar_id;
        };
        return $sub_side_bar_ids;
    }

    //returns name of sub_side_bar by its id
    public function get_sub_side_bar_info_by_sub_side_bar_id($sub_side_bar_id = "1")
    {
        $this->db->from("sub_side_bar_permissions");
        $this->db->where("sub_side_bar_id", $sub_side_bar_id);
        $this->db->from('sub_side_bar');
        $this->db->where('sub_side_bar_id', $sub_side_bar_id);
        return $this->db->get()->row();
    }

}