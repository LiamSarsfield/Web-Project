<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>View Pending Customer Orders</title>
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
<main>
 <a href="<?php echo site_url()?>/Staff/staffLogin"><div class="button">Back To Index</div></a>
  <table class="table_generic">
    <tbody>
      <tr>
        <th scope="col">Pending Order ID</th>
        <th scope="col">Order Name</th>
        <th scope="col">Date Requested</th>
        <th scope="col">Total Price</th>
        <th scope="col">View</th>
      </tr>
      <tr>
        <td>3002</td>
        <td>Machine Circuits</td>
        <td>21/11/2018</td>
        <td>4,600</td>
        <td><a href="<?php echo site_url()?>/Staff/orderInfo"><div class="button">View</div></a></td>
      </tr>
    </tbody>
  </table>
</main>
</body>
</html>
