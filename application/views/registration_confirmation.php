<!DOCTYPE php>
<php>
<title>Confirmation</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="w3-black">

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <a href="<?php echo site_url()?>/Home/index"><img src="<?php echo base_url(); ?>/assests/Images/MweLogo.png" style="width:100%"></a>
  
    <span style="font-size:30px;cursor:pointer" onclick="openNav()"  class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
    <div id="mySidenav" class="sidenav">
  <a href="<?php echo site_url()?>/Home/index" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="
    fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  
  <a href="<?php echo site_url()?>/Store_controller/view_store" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-shopping-basket w3-xxlarge"></i>
    <p>STORE</p>
  </a>
  
  <a href="<?php echo site_url()?>/Shopping_cart_controller/view_shopping_cart" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-shopping-cart w3-xxlarge"></i>
    <p>SHOPPING CART</p>

    <a href="<?php echo site_url()?>/Customer/login" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-pencil w3-xxlarge"></i>
            <p>Login</p>
  </a>

  <a href="<?php echo site_url()?>/Customer_controller/sign_up" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
        <i class="fa fa-user-plus w3-xxlarge"></i>
        <p>Sign Up</p>
</a>
    
    <a href="<?php echo site_url()?>/Staff_controller/staffLogin" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-key w3-xxlarge"></i>
            <p>STAFF</p>
  </a>
</div>
</nav>


<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="<?php echo site_url()?>/Home/index" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
    <a href="#about" class="w3-bar-item w3-button" style="width:25% !important">ABOUT</a>
  
    <a href="#contact" class="w3-bar-item w3-button" style="width:25% !important">CONTACT</a>
  </div>
</div>

<!-- Page Content -->
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
        <img src="<?php echo base_url(); ?>/assests/Images/banner2.png" alt="boy" class="w3-image" width="620" height="420">
   
        <br><br><br> 
  </header>

<main style="margin-left:10%; margin-right:10%;">
<!--  <form action="<?php echo site_url()?>/Staff/viewCustomers" class="search_product_id generic_search">
    <fieldset>
      <legend>Search Customer ID</legend>
      <div class="flex_container">
        <input type="text" class="generic_item_search_input generic_input" placeholder="Customer ID">
        <input type="image" src="<?php echo base_url(); ?>/assests/Images/search-image-icon.png" alt="Submit" class="generic_search_submit" />
      </div>
    </fieldset>
  </form>-->
    <br>
    <h1>Thank you</h1>
    <br><br>
    <h1>Registration Successful !!!</h1>
    <br><br><br>
    <center><a href="<?php echo site_url('Customer_controller/login'); ?>"><button>Login</button></a></center>
    <br><br>
</main>
</body>
</html>

                    
                    
                    