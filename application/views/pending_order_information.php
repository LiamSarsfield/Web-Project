<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pending Order Information</title>
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

<main style="width:60%;">
 <a href="<?php echo site_url()?>/Staff/viewOrders"><div class="button">Back to View All Pending Orders</div></a>
  <section class="generic_section generic_item_information">
    <h2 class="generic_item_header">Pending Order Information</h2>
    <p><span class="generic_item_label">Pending Order ID: </span>1001</p>
    <p><span class="generic_item_label">Order Name: </span>Machine Circuits</p>
    <p><span class="generic_item_label">Date Received: </span>21/11/2018</p>
    <p><span class="generic_item_label">Total Price: </span>4,600</p>
    <p><span class="generic_item_label">Products Requested: </span>MSX Titan (2)</p>
  </section>
  <section class="generic_section generic_item_information">
    <h2 class="generic_item_header">Available Functions</h2>
    <div class="generic_item_content">
      <a href="<?php echo site_url()?>/Staff/acceptOrder"><div class="button">Accept Customer Order</div></a>
      <div class="button">Reject Customer Order</div>
    </div>
  </section>
</main>
</body>
</html>
