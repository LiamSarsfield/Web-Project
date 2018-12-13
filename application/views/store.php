
<!DOCTYPE html>
<html>
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo base_url(); ?>/assests/CSS/style.css">
<script rel="text/javascript" src="<?php echo base_url(); ?>/assests/script/navs.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="w3-black">

<!-- Icon Bar (Sidebar - hidden on small screens) -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <img src="MweLogo.png" style="width:100%">
  
    <span style="font-size:30px;cursor:pointer" onclick="openNav()"  class="w3-bar-item  w3-button w3-padding-large w3-hover-black">&#9776;</span>
    <div id="mySidenav" class="sidenav">
        <button class="dropdown-btn w3-bar-item w3-button w3-padding-large w3-hover-black">
  <a href="#" class="w3-bar-item w3-button w3-hover-black" >
    <i class="
    
fa fa-shopping-basket w3-xxlarge"></i>
    <p><strong>CART</strong></p>
  </a>
</button>

  <div  class="dropdown-container" style="color: violet">
    <a href="#" class=" w3-bar-item w3-button w3-padding-large w3-hover-black">VIEW</a>
    <a href="#" class=" w3-bar-item w3-button w3-padding-large w3-hover-black">UPDATE</a>
    <a href="#" class=" w3-bar-item w3-button w3-padding-large w3-hover-black">DELETE</a>
    </div>
    <a href="#about" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
      <i class="fa fa-user w3-xxlarge"></i>
      <p>ABOUT</p>
    </a>
    
    <a href="#contact" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
      <i class="fa fa-envelope w3-xxlarge"></i>
      <p>CONTACT</p>
  
      <a href="login.html" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
              <i class="fa fa-pencil w3-xxlarge"></i>
              <p>Login</p>
    </a>
  
    <a href="signUp.html" class="w3-bar-item w3-button w3-padding-large w3-hover-black">
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
<div class="w3-padding-large" id="main">
  <!-- Header/Home -->
  <header class="w3-container w3-padding-32 w3-center w3-black" id="home">
        <img src="banner2.png" alt="boy" class="w3-image" width="620" height="420">
   
    
  </header>

  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
    <h3 class="w3-text-light-grey"><strong>Circuit Boards</strong></h3>
    <hr style="width:200px" class="w3-opacity">
    <p>
    </p>
  
    <div class="w3-row w3-center w3-padding-16 w3-section">
      <?php 
       echo $display_block;  
      ?> 
     
  <!-- End About Section -->
  </div>
  </div>
    <!-- About Section -->
<!--    <div class="w3-content w3-justify w3-text-grey w3-padding-64" id="about">
      <h3 class="w3-text-light-grey"><strong>Circuit Boards</strong></h3>
      <hr style="width:200px" class="w3-opacity">
      <p>
      </p>
    
      <div class="w3-row w3-center w3-padding-16 w3-section w3-light-grey">
        <div class="w3-quarter w3-section">
          <span class="w3-xlarge"><img src="circuit_board.jpg" alt="circuit_board" class="w3-image" width="620" height="420"></span><br>
          This is a custom built circuit board, you can customize your circuit board to suit your own needs.
          €10.00
        </div>
        <div class="w3-quarter w3-section">
          <span class="w3-xlarge"><img src="circuit_board.jpg" alt="circuit_board" class="w3-image" width="620" height="420"></span><br>
          This is a custom built circuit board, you can customize your circuit board to suit your own needs.
          €10.00
        </div>
        <div class="w3-quarter w3-section">
          <span class="w3-xlarge"><img src="circuit_board.jpg" alt="circuit_board" class="w3-image" width="620" height="420"></span><br>
          This is a custom built circuit board, you can customize your circuit board to suit your own needs.
          v
        </div>
        <div class="w3-quarter w3-section">
          <span class="w3-xlarge"><img src="circuit_board.jpg" alt="circuit_board" class="w3-image" width="620" height="420"></span><br>
          This is a custom built circuit board, you can customize your circuit board to suit your own needs.
          €10.00
        </div>
  
      
      
     End About Section 
    </div>-->

  
    <!-- Footer -->
  <footer class="w3-content w3-padding-64 w3-text-grey w3-xlarge">
        <a href="maintenance.html"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
        <a href="maintenance.html"></a><i class="fa fa-instagram w3-hover-opacity"></i></a>
        <a href="maintenance.html"><i class="fa fa-snapchat w3-hover-opacity"></i></a>
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

 
      var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}


        
</script>
</body>
</html>


