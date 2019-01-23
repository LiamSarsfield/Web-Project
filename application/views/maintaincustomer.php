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
                <p><span class="generic_item_label">Customer ID: </span>101</p>
                <p><span class="generic_item_label">Customer Name: </span>Keith Clifford</p>
                <p><span class="generic_item_label">Customer Email: </span>keithclifford500@gmail.com</p>
                <p><span class="generic_item_label">Address 1: </span>16 Upper St</p>
                <p><span class="generic_item_label">Address 2: </span>lower center</p>
                <p><span class="generic_item_label">Town: </span>Limerick</p>
                 <p><span class="generic_item_label">Country: </span>Ireland</p>
            </section>
            <section class="generic_section generic_item_information">
                <h2 class="generic_item_header">Available Functions</h2>
                <div class="generic_item_content">
                    <a href="<?php echo site_url()?>/Staff_controller/editCustomer"><div class="button">Edit Customer</div></a>
                </div>
            </section>
        </main>
    </body>
</html>

