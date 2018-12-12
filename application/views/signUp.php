<!DOCTYPE php>
<php>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript"src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
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

   <a href="<?php echo site_url()?>/Customer/login" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
            <i class="fa fa-pencil w3-xxlarge"></i>
            <p>Login</p>
  </a>

  <a href="<?php echo site_url()?>/Customer/signUp" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
        <i class="fa fa-user-plus w3-xxlarge"></i>
        <p>Sign Up</p>
</a>
</div>
</nav>


<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-black w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="#" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
    <a href="#about" class="w3-bar-item w3-button" style="width:25% !important">ABOUT</a>
  
    <a href="#contact" class="w3-bar-item w3-button" style="width:25% !important">CONTACT</a>
  </div>
</div>

<!-- Page Content -->

  <!-- Contact Section -->
  <div class="w3-padding-64 w3-content w3-text-grey" id="contact">
    <h2 class="w3-text-light-grey">Sign Up</h2>
    <hr style="width:200px" class="w3-opacity">


    <form action="/action_page.php" target="_blank">
      <p><input class="w3-input w3-padding-16" type="text" placeholder="First Name" required name="f_name"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Last Name" required name="l_name"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Email" required name="email"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Company Name" required name="cNane"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Address 1" required name="addressOne"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Address 2" required name="addressTwo"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="City" required name="city"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="State/Province" required name="state"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Country" required name="country"></p>
        <button class="w3-button w3-light-grey w3-padding-large" type="submit">
          <i class="fa fa-paper-plane"></i> Sign Up
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
</body>
</php>