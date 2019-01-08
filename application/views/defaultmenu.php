<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <a href="<?php echo site_url()?>/Home/index"><img src="<?php echo base_url(); ?>/assests/Images/MweLogo.png" style="width:100%"></a>
  
    <span style="font-size:30px;cursor:pointer" onclick="openNav()"  class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
    <div id="mySidenav" class="sidenav">
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="
    fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  
  <a href="#about" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>ABOUT</p>
  </a>
  
  <a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p>CONTACT</p>

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