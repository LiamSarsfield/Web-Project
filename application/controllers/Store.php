<?php

class Store extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $login_info = $this->session->userdata('login_info') ?? NULL;
        if (!isset($login_info['account_status'])) {
            redirect(site_url() . "/home");
        }
    }

    public function view_store()
    {

        $data['display_block'] = "";

        $this->load->model("Product");

        $data['query'] = $this->Product->get_all_products();

        //If no details found 
        if ($data['query']->num_rows() < 1) {
            $display_block = "<p><em>Sorry, no items to display.</em></p>";
        } else {
            //store items in the associative array $products
            foreach ($data['query']->result_array() as $product) {
                $product_id = $product['product_id'];
                $product_name = $product['product_name'];
                $product_desc = $product['product_desc'];
                $product_price = $product['product_price'];

                //Create a link that when clicked calls the method GetCategoryItems in the CategoryItems_controller
                $tag = '/Web-Project/index.php/Store/view_selected_product/' . $product_id;

// 	$data['display_block'] .= "<p><strong><a href=".$tag.">".$product_name."</a></strong><br/>".$product_desc."</p>"; 


                $data['display_block'] .= '<div class="w3-quarter w3-section w3-light-grey">';
                $data['display_block'] .= '<span class="w3-xlarge"><a href="product_view.html"><img src="circuit_board.jpg" alt="circuit_board" class="w3-image" width="620" height="420"></a></span><br>';
                $data['display_block'] .= "$product_name";
                $data['display_block'] .= "<br>$product_desc";
                $data['display_block'] .= "<strong>€$product_price</strong>";
                $data['display_block'] .= "<a href=" . $tag . "><button>View</button></a>";
                $data['display_block'] .= '</div>';
            }
        }
        //Load the view passing in all the store items to be displayed

        $this->load->view('store', $data);

    }

    public function view_selected_product()
    {

        $this->load->view('view_product');

    }
}

