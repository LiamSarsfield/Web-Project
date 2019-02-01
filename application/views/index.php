<!DOCTYPE php>
<php>
<title>MWE Home</title>
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

  <a href="<?php echo site_url()?>/Customer/signUp" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
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
   
    
  </header>

  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h2 class="w3-text-light-grey">About our Company</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>Mid-West Electronics Ltd.<br><br>

Located in the Shannon region, MWE is a supplier of high quality products and services to the electronics industry.<br>

MWE has three main areas of operation<br> 

•	Manufacture of high precision sockets for electronic components<br>

•	Manufacture of custom built circuit boards<br>

•	Distributor of electronic components from other manufacturers/suppliers<br><br>

The socket range is dynamic, with new products being added continually. Most of the volume production is for the standard socket products - manufacturing “runs” of 2,000 to 5,000 are the normal quantities produced for each standard socket.<br>
A significant proportion of sockets are manufactured to suit customer requirements.<br><br>

Circuit boards are always built to customer specifications and are low volume production, but high revenue generators.<br>

The range of products distributed from other manufacturers is quite limited – usually sockets and boards that MWE do not produce, or small toolkits for engineers.<br>



    </p>
  
    <div class="w3-row w3-center w3-padding-16 w3-section w3-light-grey">
      <div class="w3-quarter w3-section">
        <span class="w3-xlarge">11+</span><br>
        Suppliers
      </div>
      <div class="w3-quarter w3-section">
        <span class="w3-xlarge">55+</span><br>
        Custom Orders Completed
      </div>
      <div class="w3-quarter w3-section">
        <span class="w3-xlarge">890+</span><br>
        Happy Customers
      </div>
      <div class="w3-quarter w3-section">
        <span class="w3-xlarge">150+</span><br>
        Worldwide Customers
      </div>

    
    
  <!-- End About Section -->
  </div>
  <!-- Contact Section -->
  <div class="w3-padding-64 w3-content w3-text-grey" id="contact">
    <h2 class="w3-text-light-grey">Contact US</h2>
    <hr style="width:200px" class="w3-opacity">

    <p>Lets get in touch. Send me a message:</p>

    <form action="/action_page.php" target="_blank">
      <p><input class="w3-input w3-padding-16" type="number" placeholder="Name" required name="Name"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Email" required name="Email"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Subject" required name="Subject"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Message" required name="Message"></p>
      <p>
        <button class="w3-button w3-light-grey w3-padding-large" type="submit">
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </p>
    </form>
  <!-- End Contact Section -->
  </div>
  
    <!-- Footer -->
  <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
        <a href="<?php echo site_url()?>/Home/maintenance"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
        <a href="<?php echo site_url()?>/Home/maintenance"></a><i class="fa fa-instagram w3-hover-opacity"></i></a>
        <a href="<?php echo site_url()?>/Home/maintenance"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
    <p class="w3-medium">Midwest Electronics </p>
  <!-- End footer -->
  </footer>

<!-- END PAGE CONTENT -->
</div>


<script>
    
        function openNav() {
                var x = document.getElementById("mySidenav");
             if (x.style.display === "none") {
          x.style.display = "block";
        } else {
            x.style.display = "none";
     }
    }




        
</script>
</body>
</php>