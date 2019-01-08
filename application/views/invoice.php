<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Maintain Supplier</title>
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
<h1>Customer Invoice</h1>

<div id="leftCol" style=" margin-left:15%;">
  


<h2>Invoice</h2>
<br>
<p><b>Billed To:</b></p>
<p>John Smith</p>
<p>1234 Main</p>
<p>Apt. 4B</p>
<p>Springfield, ST 54321 </p>

<br>

<p><b>Payment Method:</b></p>
<p>Visa ending **** 4242</p>
<p>jsmith@email.com </p>
</div>

<div id="rightCol">
   <div id="legend">


   </div>

<br>
<p></p>

</div>
<div id="col3">
   <div id="legend">



   </div>

<h2>Order # 12345</h2>
<br>
<p><b>Shipped To:</b></p>
<p>Jane Smith</p>
<p>1234 Main</p>
<p>Apt. 4B</p>
<p>Springfield, ST 54321 </p>

<br>

<p><b>Order Date:</b></p>
<p>March 7, 2014</p>


</div>

<section>
    <table style="width:80%; margin-left:10%;">
  <tr>
    <th>Items</th>
    <th>Price</th> 
    <th>Quantity</th>
	<th>Totals</th>
  </tr>
  <tr>
    <td>BS-200</td>
    <td>$10.99</td>
    <td>1</td>
	<td>$10.99</td>
  </tr>
  <tr>
    <td>BS-400</td>
    <td>$20.00</td>
    <td>3</td>
	<td>$60.00</td>
  </tr>
  <tr>
    <td>BS-1000</td>
    <td>$600.00</td>
    <td>1</td>
	<td>$600.00</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
	<td></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Subtotal:</td>
	<td>$670.00</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Shipping:</td>
	<td>$15.00</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td>Total:</td>
	<td>$685.99</td>
  </tr>
</table>
  </section>

<footer style=" margin-left:10%;">
  <p>Copyright © 2018 Website by Dream Team </p>
</footer>
</div>

</body>
</html>
