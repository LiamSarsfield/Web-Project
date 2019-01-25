<?php

class Store extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $account_info = $this->session->userdata('account_info') ?? NULL;
        if (!isset($account_info['permission_id'])) {
            redirect(site_url() . "/home");
        }
    }

    public function view_store()
    {

        $data['display_block'] = "";

        $this->load->model("Product_model");

        $data['query'] = $this->Product_model->get_all_products();

        //If no details found 
        if ($data['query']->num_rows() < 1) {
            $display_block = "<p><em>Sorry, no items to display.</em></p>";
        } else {
            //store items in the associative array $products
            foreach ($data['query']->result_array() as $product) {
                $product_id = $product['product_id'];
                $name = $product['name'];
                $description = $product['description'];
                $price = $product['price'];

                //Create a link that when clicked calls the method GetCategoryItems in the CategoryItems_controller
                $tag = '/Web-Project/index.php/Store/view_selected_product/' . $product_id;

// 	$data['display_block'] .= "<p><strong><a href=".$tag.">".$name."</a></strong><br/>".$description."</p>"; 


                $data['display_block'] .= '<div class="w3-quarter w3-section w3-light-grey">';
                $data['display_block'] .= '<span class="w3-xlarge"><a href="product_view.html"><img src="circuit_board.jpg" alt="circuit_board" class="w3-image" width="620" height="420"></a></span><br>';
                $data['display_block'] .= "$name";
                $data['display_block'] .= "<br>$description";
                $data['display_block'] .= "<strong>€$price</strong>";
                $data['display_block'] .= "<a href=" . $tag . "><button>View</button></a>";
                $data['display_block'] .= '</div>';
            }
        }
        //Load the view passing in all the store items to be displayed

        $this->load->view('customer/store', $data);

    }

    public function view_selected_product()
    {

        $this->load->view('view_product');

    }
}

