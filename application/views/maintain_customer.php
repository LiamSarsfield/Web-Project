<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Customer Information</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
    </head>

    <body>
	<!-- Icon Bar (Sidebar - hidden on small screens) -->
    <?php require_once('adminmenu.php'); ?>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
    <a href="#about" class="w3-bar-item w3-button" style="width:25% !important">ABOUT</a>
  
    <a href="#contact" class="w3-bar-item w3-button" style="width:25% !important">CONTACT</a>
  </div>
</div>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
        <img src="<?php echo base_url(); ?>/assests/Images/banner2.png" alt="boy" class="w3-image" width="620" height="420">
   
    
  </header>
<main style="margin-left:10%; margin-right:10%;">
       
            <a href="<?php echo site_url()?>/Staff_controller/view_customers"><div class="button">Back to View All Customers</div></a>
            <section class="generic_section generic_item_information">
                <h2 class="generic_item_header">Customer Information</h2>
                <p><span class="generic_item_label">Customer ID: </span><?php echo $query->customer_id ?></p>
                <p><span class="generic_item_label">Customer Name: </span><?php echo $query->first_name . " " . $query->last_name ?></p>
                <p><span class="generic_item_label">Customer Email: </span><?php echo $query->email ?></p>
                <p><span class="generic_item_label">Phone Number: </span><?php echo $query->phone ?></p>
                <p><span class="generic_item_label">Address 1: </span><?php echo $query->address1 ?></p>
                <p><span class="generic_item_label">Address 2: </span><?php echo $query->address2 ?></p>
                <p><span class="generic_item_label">Town: </span><?php echo $query->town ?></p>
                <p><span class="generic_item_label">City: </span><?php echo $query->city ?></p>
            </section>
            <section class="generic_section generic_item_information">
                <h2 class="generic_item_header">Available Functions</h2>
                <div class="generic_item_content">
                    <a href="<?php echo site_url()?>/Staff_controller/edit_customer/<?php echo $query->customer_id ?>"><div class="button">Edit Customer</div></a>
                </div>
            </section>
        </main>
    </body>
</html>

