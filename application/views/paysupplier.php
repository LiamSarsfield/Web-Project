<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Supplier Payment</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
    </head>

    <body>
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
        <main style="width:40%">
            <form action="<?php echo site_url()?>/Supplier/paymentSuccess">
                <fieldset class="generic_edit_item_form">
                    <h2 class="generic_item_header">Supplier Bank Details</h2>
                    <p>
                        <label class="generic_label generic_item_edit_label">Supplier No: </label>
                        <input class="generic_input" type="text" value="301" disabled>
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Bank Address: </label>
                        <input class="generic_input" type="text">
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Bank Account No: </label>
                        <input class="generic_input" type="text">
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Sort Code:</label>
                        <input class="generic_input" type="text">
                    </p>
                    <p>
                        <label class="generic_label generic_item_edit_label">Amount to be paid:</label>
                        <input class="generic_input" type="text">
                    </p>
                    <input class="button submit_button" value="Pay" type="submit">

                </fieldset>
            </form>
        </main>
    </body>
</html>
