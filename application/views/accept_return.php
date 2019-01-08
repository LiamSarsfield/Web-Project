<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Return Details</title>
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
<br><br>
<h1>RETURN DETAILS</h1>

<div id="sup" style="margin-left:25%;">
  
<h2>Customer</h2>
<br>
<p>John Doe</p>
<p>1234 Main</p>
<p>Apt. 4B</p>
<p>Springfield, ST 54321 </p>
<br>
</div>

<div id="mid">
   <div id="legend">

   </div>

<p></p>

</div>
<div id="ord">
   <div id="legend">



   </div>

<h2>Order # 12345</h2>
<br>
<p><b>Order Date:</b></p>
<p>March 7, 2014</p>



</div>

<section>
    <table style="width:80%; margin-left:10%;">
  <tr>
    <th>Material ID</th>
	<th>Name</th>
    <th>Description</th> 
    <th>Quantity</th>
	<th>Return Condidtion</th>
  </tr>
  <tr>
    <td>SOCK_123</td>
    <td>Socket 1</td>
    <td>General, all-purpose socket.</td>
	<td>20</td>
	<td>Good</td>
  </tr>
  <tr>
    <td>SOCK_4252</td>
    <td>Socket 2</td>
    <td>General, all-purpose socket.</td>
	<td>10</td>
	<td>Used</td>
  </tr>
  <tr>
    <td>SOCK_9439</td>
    <td>Socket 3</td>
    <td>General, all-purpose socket.</td>
	<td>60</td>
	<td>Broken</td>
  </tr>
  
</table>
  </section>
<p style="margin-left:30%;">
       <input type="submit" name="submit" id="submit" value="ACCEPT">
 
       <input type="submit" name="submit" id="submit" value="REJECT">
 </p>
<footer style="margin-left:10%;">
  <p>Copyright © 2018 Website by Dream Team </p>
</footer>
</div>

</body>
</html>
