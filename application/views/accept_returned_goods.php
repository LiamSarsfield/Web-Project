<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Accept Returned Goods</title>
<link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
</head>

<body>
<div id="page">
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
<br>

<h1>ACCEPT RETURNED GOODS</h1>

<section>
    <table style="width:80%; margin-left:10%;">
  <tr>
    <th>Customer Name</th>
    <th>Order Number</th>
    <th>Order Date</th>	
    <th>Action</th>
  </tr>
  <tr>
    <td>John Doe</td>
    <td>SOCK_1312</td>
	<td>2018/10/14</td>
    <td><a href="<?php echo site_url()?>/Staff/acceptReturns">Accept</a></td>
  </tr>
  <tr>
    <td>Limerick IT</td>
    <td>SOCK_82134211</td>
	<td>2018/11/09</td>
    <td><a href="<?php echo site_url()?>/Staff/acceptReturns">Accept</a></td>
  </tr>
  <tr>
    <td>Vancot Limited</td>
    <td>SOCK_10112</td>
	<td>2018/11/01</td>
    <td><a href="<?php echo site_url()?>/Staff/acceptReturns">Accept</a></td>
  </tr>
</table>
  </section>

<footer style=" margin-left:10%;">
  <p>Copyright © 2018 Website by Dream Team </p>
</footer>
</div>

</body>
</html>
