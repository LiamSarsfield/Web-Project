<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Remove Material</title>
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
  <form action="<?php echo site_url()?>/Staff/viewCustomers" class="search_product_id generic_search">
    <fieldset>
      <legend>Search Customer ID</legend>
      <div class="flex_container">
        <input type="text" class="generic_item_search_input generic_input" placeholder="Customer ID">
        <input type="image" src="<?php echo base_url(); ?>/assests/Images/search-image-icon.png" alt="Submit" class="generic_search_submit" />
      </div>
    </fieldset>
  </form>
  <table class="table_generic">
  <tr>
    <th>Material Name</th>
	<th>Description</th>
    <th>Price</th> 
	<th>Quantity</th>
    <th>Action</th>
  </tr>
  <tr>
    <td>Socket type 1</td>
    <td>General, all-purpose socket</td>
	<td>€20</td>
	<td>810</td>
    <td><a href="">Remove</a></td>
  </tr>
  <tr>
    <td>Socket type 2</td>
    <td>General, all-purpose socket</td>
	<td>€201</td>
	<td>8</td>
    <td><a href="">Remove</a></td>
  </tr>
  <tr>
    <td>Socket type 3</td>
    <td>General, all-purpose socket</td>
	<td>€1</td>
	<td>223</td>
    <td><a href="">Remove</a></td>
  </tr>
</table>
</main>
</body>
</html>
